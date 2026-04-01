<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>KRC Accomplishment Report Generator (DB Sync)</title>
    <style>
        body { font-family: "Times New Roman", serif; margin: 40px; background: #f0f2f5; }
        .editor-container { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-bottom: 30px; }
        .day-block { border: 1px solid #ddd; padding: 15px; margin-bottom: 15px; background: #fafafa; position: relative; border-left: 5px solid #3498db; }
        .task-row { display: flex; gap: 10px; margin-bottom: 5px; align-items: center; }
        input, select { padding: 5px; border: 1px solid #ccc; border-radius: 3px; }
        
        .t-start, .t-end { width: 90px; text-align: center; font-size: 12px; }

        #report-preview { background: white; padding: 0.5in; display: none; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid black; padding: 4px 8px; font-size: 12px; vertical-align: top; }
        .name-line { font-weight: bold; text-decoration: underline; text-transform: uppercase; display: block; margin-top: 20px; }

        .copy-tool { background: #e8f4fd; padding: 8px; margin-bottom: 10px; border-radius: 4px; font-size: 0.9em; display: flex; align-items: center; gap: 10px; }

        .btn-save { background: #2980b9; color: white; padding: 10px 20px; border: none; cursor: pointer; border-radius: 4px; margin-right: 5px; }
        .btn-print { background: #27ae60; color: white; padding: 10px 20px; border: none; cursor: pointer; border-radius: 4px; }

        @media print {
            .editor-container { display: none; }
            #report-preview { display: block; }
            body { background: white; margin: 0; }
        }
    </style>
</head>
<body>

<datalist id="activity-suggestions"></datalist>
<datalist id="time-suggestions"></datalist>

<div class="editor-container">
    <h2>Activity Editor (Connected to MySQL)</h2>
    <div id="inputs"></div>
    <hr>
    <button onclick="addDay()">+ Add New Day</button>
    <button onclick="duplicateLastDay()">👯 Duplicate Last Day</button>
    <button onclick="saveToDB()" class="btn-save">💾 Save to Database</button>
    <button onclick="window.print()" class="btn-print">🖨️ Generate & Print PDF</button>
</div>

<div id="report-preview">
    <div style="text-align: left;">
        <h3 style="margin:0;">ACCOMPLISHMENT REPORT</h3>
        <p style="margin:2px 0;">Period Covered: MAR 01-31, 2026</p>
        <p style="margin:2px 0;">Employee Name: Jeffrey A. Oderio</p>
        <p style="margin:2px 0;">Department/Unit: Knowledge Resource Center</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 15%;">Date</th>
                <th style="width: 55%;">Activity/Accomplishment</th>
                <th style="width: 20%;">Allotted Time</th>
                <th style="width: 10%;">Remarks</th>
            </tr>
        </thead>
        <tbody id="table-output"></tbody>
    </table>

    <div style="display: grid; grid-template-columns: 1fr 1fr; margin-top: 30px;">
        <div>Prepared by:<br><span class="name-line">JEFFREY A. ODERIO</span> COS</div>
        <div>Noted by:<br><span class="name-line">College Librarian</span></div>
    </div>
    <div style="margin-top: 20px;">
        Reviewed and Approved:<br>
        <span class="name-line">ELEN G. AVILA, MAED, LPT</span>
        Administrative Officer V (HRMO III)
    </div>
</div>

<script>
    // --- DATABASE SYNC LOGIC ---

    async function saveToDB() {
        const data = [];
        document.querySelectorAll('.day-block').forEach(block => {
            const date = block.querySelector('.d-date').value;
            const rows = block.querySelectorAll('.task-row');
            rows.forEach(row => {
                data.push({
                    date: date,
                    desc: row.querySelector('.t-desc').value,
                    start: row.querySelector('.t-start').value,
                    end: row.querySelector('.t-end').value
                });
            });
        });

        try {
            const response = await fetch('api.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });
            const result = await response.json();
            if(result.status === "success") alert("Data synced to MySQL!");
        } catch (e) {
            alert("Error saving to database. Make sure Apache and MySQL are running.");
        }
    }

    async function loadFromDB() {
        try {
            const response = await fetch('api.php');
            const savedData = await response.json();

            if (savedData.length > 0) {
                document.getElementById('inputs').innerHTML = '';
                // Group data by date
                const grouped = savedData.reduce((acc, curr) => {
                    if (!acc[curr.report_date]) acc[curr.report_date] = { tasks: [], starts: [], ends: [] };
                    acc[curr.report_date].tasks.push(curr.activity);
                    acc[curr.report_date].starts.push(curr.start_time);
                    acc[curr.report_date].ends.push(curr.end_time);
                    return acc;
                }, {});

                for (const date in grouped) {
                    addDay({
                        date: date,
                        tasks: grouped[date].tasks,
                        starts: grouped[date].starts,
                        ends: grouped[date].ends
                    });
                }
            } else {
                addDay(); // Add empty day if DB is empty
            }
        } catch (e) {
            console.log("No existing data found or server offline.");
            addDay();
        }
    }

    // --- ORIGINAL CORE LOGIC (Modified for handleInput) ---

    function updateSuggestions() {
        const activityList = document.getElementById('activity-suggestions');
        const timeList = document.getElementById('time-suggestions');
        const activities = new Set();
        const times = new Set();

        document.querySelectorAll('.t-desc').forEach(i => { if(i.value) activities.add(i.value) });
        document.querySelectorAll('.t-start, .t-end').forEach(i => { if(i.value) times.add(i.value) });

        activityList.innerHTML = Array.from(activities).map(a => `<option value="${a}">`).join('');
        timeList.innerHTML = Array.from(times).map(t => `<option value="${t}">`).join('');
        updateCopyDropdowns();
    }

    function updateCopyDropdowns() {
        const allDates = Array.from(document.querySelectorAll('.d-date'))
            .map(input => input.value)
            .filter(v => v.trim() !== "");
        
        document.querySelectorAll('.copy-select').forEach(select => {
            const currentVal = select.value;
            select.innerHTML = '<option value="">-- Copy tasks from date --</option>';
            [...new Set(allDates)].forEach(date => {
                const opt = document.createElement('option');
                opt.value = date;
                opt.textContent = date;
                select.appendChild(opt);
            });
            select.value = currentVal;
        });
    }

    function copyTasks(selectElement) {
        const sourceDate = selectElement.value;
        if (!sourceDate) return;
        const targetBlock = selectElement.closest('.day-block');
        const sourceBlock = Array.from(document.querySelectorAll('.day-block'))
            .find(b => b.querySelector('.d-date').value === sourceDate);

        if (sourceBlock && sourceBlock !== targetBlock) {
            const taskList = targetBlock.querySelector('.task-list');
            taskList.innerHTML = ''; 
            sourceBlock.querySelectorAll('.task-row').forEach(row => {
                addTaskRowToElement(taskList, 
                    row.querySelector('.t-desc').value, 
                    row.querySelector('.t-start').value, 
                    row.querySelector('.t-end').value);
            });
            handleInput();
        }
    }

    function getNextMinute(timeStr) {
        if (!timeStr) return "";
        try {
            const [time, modifier] = timeStr.trim().split(' ');
            let [hours, minutes] = time.split(':');
            if (hours === '12') hours = '00';
            let date = new Date();
            date.setHours(modifier === 'PM' ? parseInt(hours) + 12 : hours, parseInt(minutes) + 1);
            return date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: true });
        } catch (e) { return ""; }
    }

    function addDay(data = null) {
        const container = document.getElementById('inputs');
        const dayDiv = document.createElement('div');
        dayDiv.className = 'day-block';
        
        const defaultDate = data ? data.date : "";
        const tasks = data ? data.tasks : ["- Activity Name"];
        const starts = data ? data.starts : ["08:00 AM"];
        const ends = data ? data.ends : ["05:00 PM"];

        dayDiv.innerHTML = `
            <div class="copy-tool">
                <label>📋 Quick Copy:</label>
                <select class="copy-select" onchange="copyTasks(this)"></select>
            </div>
            <div style="margin-bottom: 10px;">
                <label>Date:</label> <input type="text" class="d-date" value="${defaultDate}" placeholder="Mar 02, 2026" oninput="handleInput()">
            </div>
            <div class="task-list"></div>
            <button onclick="addTaskRow(this)">+ Add Task</button>
            <button onclick="this.parentElement.remove(); handleInput();" style="color:red; margin-left: 10px; border:none; background:none; cursor:pointer; font-size:12px;">Delete Day</button>
        `;
        
        const taskList = dayDiv.querySelector('.task-list');
        tasks.forEach((t, i) => addTaskRowToElement(taskList, t, starts[i], ends[i]));
        container.appendChild(dayDiv);
        handleInput();
    }

    function addTaskRowToElement(taskList, desc="", start="", end="") {
        const row = document.createElement('div');
        row.className = 'task-row';
        row.innerHTML = `
            <input type="text" class="t-desc" value="${desc}" placeholder="Activity" list="activity-suggestions" style="flex: 2;" oninput="handleInput()">
            <input type="text" class="t-start" value="${start}" list="time-suggestions" oninput="handleInput()">
            <span>to</span>
            <input type="text" class="t-end" value="${end}" placeholder="End Time" list="time-suggestions" oninput="handleInput()">
            <button onclick="this.parentElement.remove(); handleInput();" style="border:none; background:none; cursor:pointer;">❌</button>
        `;
        taskList.appendChild(row);
    }

    function addTaskRow(btn) {
        const list = btn.previousElementSibling;
        const lastRow = list.querySelector('.task-row:last-child');
        const lastEnd = lastRow ? lastRow.querySelector('.t-end').value : "08:00 AM";
        const autoStart = getNextMinute(lastEnd);
        addTaskRowToElement(list, "", autoStart, "");
        handleInput();
    }

    function handleInput() {
        updateSuggestions();
        renderTable();
    }

    function duplicateLastDay() {
        const blocks = document.querySelectorAll('.day-block');
        if (blocks.length === 0) return addDay();
        const last = blocks[blocks.length - 1];
        addDay({
            date: last.querySelector('.d-date').value,
            tasks: Array.from(last.querySelectorAll('.t-desc')).map(i => i.value),
            starts: Array.from(last.querySelectorAll('.t-start')).map(i => i.value),
            ends: Array.from(last.querySelectorAll('.t-end')).map(i => i.value)
        });
    }

    function renderTable() {
        const output = document.getElementById('table-output');
        output.innerHTML = '';
        document.querySelectorAll('.day-block').forEach(block => {
            const date = block.querySelector('.d-date').value;
            const tasks = block.querySelectorAll('.t-desc');
            const starts = block.querySelectorAll('.t-start');
            const ends = block.querySelectorAll('.t-end');

            tasks.forEach((task, index) => {
                const tr = document.createElement('tr');
                const startVal = starts[index] ? starts[index].value.replace(/\s/g, '') : '';
                const endVal = ends[index] ? ends[index].value.replace(/\s/g, '') : '';
                const formattedTime = `${startVal} – ${endVal}`;
                
                tr.innerHTML = `
                    <td style="${index !== 0 ? 'border-top:none; border-bottom:none;' : ''}">${index === 0 ? date : ''}</td>
                    <td>${task.value}</td>
                    <td style="text-align:center;">${formattedTime}</td>
                    <td>-DONE</td>
                `;
                output.appendChild(tr);
            });
        });
    }

    window.onload = () => {
        loadFromDB(); 
    };
</script>
</body>
</html>