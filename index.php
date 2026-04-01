<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
$employee_name = $_SESSION['employee_name'];
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KRC | Neon Accomplishment</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { 
            font-family: 'Outfit', sans-serif; 
            background-color: #0f172a; 
        }
        
        .neon-border-blue {
            box-shadow: 0 0 10px rgba(59, 130, 246, 0.2), inset 0 0 5px rgba(59, 130, 246, 0.1);
        }

        .neon-text-blue {
            text-shadow: 0 0 8px rgba(59, 130, 246, 0.5);
        }

        .glass-input {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .glass-input:focus {
            background: rgba(255, 255, 255, 0.07);
            border-color: #3b82f6;
            box-shadow: 0 0 15px rgba(59, 130, 246, 0.3);
            outline: none;
        }

        .sticky-actions {
            position: sticky;
            top: 5rem;
            z-index: 40;
            backdrop-filter: blur(12px);
            background: rgba(15, 23, 42, 0.85);
            border-bottom: 1px solid rgba(59, 130, 246, 0.2);
        }

        .btn-thick {
            border-bottom-width: 4px;
            transition: all 0.1s ease;
        }
        
        .btn-thick:active {
            border-bottom-width: 0px;
            transform: translateY(4px);
        }

        @media print {
            .no-print { display: none !important; }
            #report-preview { display: block !important; }
            body { background: white; color: black; }
        }
    </style>
</head>
<body class="text-slate-200 min-h-screen">

    <nav class="no-print border-b border-white/10 bg-slate-900/50 backdrop-blur-md sticky top-0 z-50 h-20">
        <div class="max-w-6xl mx-auto px-6 h-full flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-tr from-blue-600 to-cyan-400 rounded-xl flex items-center justify-center shadow-[0_0_15px_rgba(59,130,246,0.5)]">
                    <span class="text-white font-bold">K</span>
                </div>
                <div>
                    <h1 class="font-bold text-lg leading-tight tracking-tight neon-text-blue">KRC SYSTEM</h1>
                    <p class="text-[10px] text-blue-400 uppercase tracking-[0.2em] font-semibold">Accomplishment Portal</p>
                </div>
            </div>
            <div class="flex items-center space-x-6">
                <div class="hidden md:block">
                    <p class="text-[10px] text-slate-500 uppercase tracking-widest text-right">Logged in as</p>
                    <p class="text-sm font-semibold text-white"><?php echo $employee_name; ?></p>
                </div>
                <a href="logout.php" class="px-5 py-2 rounded-lg bg-red-500/10 text-red-400 border border-red-500/20 hover:bg-red-500 hover:text-white transition-all duration-300 text-sm font-medium">Logout</a>
            </div>
        </div>
    </nav>

    <div class="sticky-actions no-print mb-8">
        <div class="max-w-5xl mx-auto px-6 py-4 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex flex-col">
                <span class="text-blue-400 text-[10px] font-bold uppercase tracking-widest">Active Session</span>
                <h2 class="text-xl font-bold text-white tracking-tight">Editor <span class="text-slate-500">Mode</span></h2>
            </div>
            <div class="flex items-center gap-4">
                <button onclick="saveToDB()" class="btn-thick px-8 py-3 rounded-xl bg-slate-800 border border-slate-600 border-b-blue-500 text-white font-bold hover:bg-slate-700 hover:border-blue-400 transition-all active:scale-95 flex items-center shadow-lg">
                    <span class="mr-2 italic text-blue-400 font-bold">Sync</span> Database
                </button>
                <button onclick="window.print()" class="btn-thick px-8 py-3 rounded-xl bg-blue-600 border-blue-700 border-b-blue-900 text-white font-bold shadow-[0_5px_15px_rgba(59,130,246,0.3)] hover:bg-blue-500 transition-all active:scale-95 flex items-center">
                    Print Report
                </button>
            </div>
        </div>
    </div>

    <main class="max-w-5xl mx-auto p-6 md:p-12 pt-0 no-print">
        <div id="inputs" class="space-y-8"></div>
        <button onclick="createNewDay()" class="group mt-10 w-full py-8 rounded-3xl border-2 border-dashed border-slate-700 hover:border-blue-500/50 hover:bg-blue-500/5 transition-all flex flex-col items-center justify-center gap-2">
            <div class="w-12 h-12 rounded-full bg-slate-800 flex items-center justify-center group-hover:bg-blue-600 transition-all group-hover:shadow-[0_0_20px_rgba(59,130,246,0.4)]">
                <span class="text-3xl text-white">+</span>
            </div>
            <span class="text-slate-500 font-bold tracking-widest uppercase text-xs group-hover:text-blue-400">Add Next Entry</span>
        </button>
    </main>

    <div id="report-preview" class="hidden bg-white p-12 text-black font-serif">
        <h2 class="text-center text-2xl font-bold border-b-2 border-black pb-4 mb-6 uppercase">Accomplishment Report</h2>
        <table class="w-full border-collapse border border-black">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-black p-2 text-xs">Date</th>
                    <th class="border border-black p-2 text-left text-xs">Activity</th>
                    <th class="border border-black p-2 text-xs">Time Range</th>
                    <th class="border border-black p-2 text-xs">Remarks</th>
                </tr>
            </thead>
            <tbody id="table-output"></tbody>
        </table>
    </div>

    <script>
        function createNewDay() {
            const blocks = document.querySelectorAll('.d-date');
            let nextDate = "";
            if (blocks.length > 0) {
                const lastDateValue = blocks[blocks.length - 1].value;
                const lastDate = new Date(lastDateValue);
                if (!isNaN(lastDate.getTime())) {
                    lastDate.setDate(lastDate.getDate() + 1);
                    nextDate = lastDate.toLocaleDateString('en-US', { month: 'short', day: '2-digit', year: 'numeric' });
                }
            } else {
                nextDate = new Date().toLocaleDateString('en-US', { month: 'short', day: '2-digit', year: 'numeric' });
            }
            addDay({ date: nextDate });
        }

        function addDay(data = null) {
            const container = document.getElementById('inputs');
            const dayDiv = document.createElement('div');
            dayDiv.className = 'bg-slate-900/40 border border-white/5 rounded-3xl overflow-hidden neon-border-blue transition-all duration-500 hover:border-white/10 day-block';
            
            const defaultDate = (data && data.date) ? data.date : "";
            const tasks = (data && data.tasks) ? data.tasks : [""];
            const starts = (data && data.starts) ? data.starts : ["08:00 AM"];
            const ends = (data && data.ends) ? data.ends : ["05:00 PM"];
            const remarks = (data && data.remarks) ? data.remarks : [""];

            dayDiv.innerHTML = `
                <div class="px-8 py-5 bg-white/5 border-b border-white/5 flex items-center justify-between">
                    <div class="flex items-center gap-6">
                        <div class="space-y-1">
                            <label class="block text-[10px] uppercase font-bold text-blue-400 tracking-widest">Entry Date</label>
                            <input type="text" class="d-date bg-transparent text-white font-bold border-none p-0 focus:ring-0 text-lg" value="${defaultDate}" oninput="handleInput()">
                        </div>
                        <div class="h-8 w-[1px] bg-white/10 hidden md:block"></div>
                        <div class="hidden md:block">
                            <label class="block text-[10px] uppercase font-bold text-slate-500 tracking-widest">Clone Data</label>
                            <select class="copy-select bg-slate-800 border-none text-xs text-slate-300 rounded-md py-1 px-3 focus:ring-1 focus:ring-blue-500" onchange="copyTasks(this)"></select>
                        </div>
                    </div>
                    <button onclick="this.closest('.day-block').remove(); handleInput();" class="w-10 h-10 rounded-full flex items-center justify-center text-slate-500 hover:bg-red-500/10 hover:text-red-400 transition-all">✕</button>
                </div>
                <div class="p-8">
                    <div class="task-list space-y-4"></div>
                    <button onclick="addTaskRow(this)" class="mt-4 text-sm font-bold text-blue-400 hover:text-blue-300 transition-colors flex items-center gap-2">
                        <span class="flex items-center justify-center w-5 h-5 rounded-full border-2 border-blue-400 text-xs">+</span> Add Row
                    </button>
                </div>
            `;
            
            const taskList = dayDiv.querySelector('.task-list');
            tasks.forEach((t, i) => addTaskRowToElement(taskList, t, starts[i], ends[i], remarks[i]));
            container.appendChild(dayDiv);
            handleInput();
        }
// Change the last parameter to default to "-Doned"
function addTaskRowToElement(taskList, desc="", start="", end="", remarks="-Doned") {
    const row = document.createElement('div');
    row.className = 'task-row flex flex-col gap-3 group animate-in fade-in slide-in-from-left-4 duration-300 mb-6';
    row.innerHTML = `
        <div class="flex flex-col lg:flex-row gap-4 items-start lg:items-center">
            <div class="flex-1 w-full">
                <input type="text" class="t-desc w-full glass-input rounded-xl px-5 py-3 text-sm text-white font-medium" value="${desc}" placeholder="Describe activity..." oninput="handleInput()">
            </div>
            <div class="flex items-center gap-3 w-full lg:w-auto">
                <input type="text" class="t-start w-28 glass-input text-center rounded-xl py-3 text-xs text-blue-400 font-bold" value="${start}" oninput="handleInput()">
                <span class="text-slate-600 font-bold text-xs uppercase">To</span>
                <input type="text" class="t-end w-28 glass-input text-center rounded-xl py-3 text-xs text-blue-400 font-bold" value="${end}" oninput="handleInput()">
                <button onclick="this.closest('.task-row').remove(); handleInput();" class="p-2 text-slate-700 hover:text-red-400 transition-colors">✕</button>
            </div>
        </div>
        <div class="w-full pl-2">
            <input type="text" class="t-remarks w-full bg-transparent border-b border-white/10 px-2 py-1 text-xs text-slate-400 focus:border-blue-500 outline-none transition-colors" value="${remarks}" placeholder="Remarks..." oninput="handleInput()">
        </div>
    `;
    taskList.appendChild(row);
}

        async function saveToDB() {
            const data = [];
            document.querySelectorAll('.day-block').forEach(block => {
                const date = block.querySelector('.d-date').value;
                block.querySelectorAll('.task-row').forEach(row => {
                    data.push({
                        date: date,
                        desc: row.querySelector('.t-desc').value,
                        start: row.querySelector('.t-start').value,
                        end: row.querySelector('.t-end').value,
                        remarks: row.querySelector('.t-remarks').value
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
                if(result.status === "success") alert("System Synced Successfully");
            } catch (e) { alert("Network Error"); }
        }

        async function loadFromDB() {
            try {
                const response = await fetch('api.php');
                const savedData = await response.json();
                if (savedData && savedData.length > 0) {
                    document.getElementById('inputs').innerHTML = '';
                    const grouped = savedData.reduce((acc, curr) => {
                        if (!acc[curr.report_date]) acc[curr.report_date] = { tasks: [], starts: [], ends: [], remarks: [] };
                        acc[curr.report_date].tasks.push(curr.activity);
                        acc[curr.report_date].starts.push(curr.start_time);
                        acc[curr.report_date].ends.push(curr.end_time);
                        acc[curr.report_date].remarks.push(curr.remarks || "");
                        return acc;
                    }, {});
                    for (const date in grouped) {
                        addDay({ 
                            date: date, 
                            tasks: grouped[date].tasks, 
                            starts: grouped[date].starts, 
                            ends: grouped[date].ends,
                            remarks: grouped[date].remarks 
                        });
                    }
                } else { createNewDay(); }
            } catch (e) { createNewDay(); }
        }

    function addTaskRow(btn) {
    // We pass "-Doned" as the 5th argument
    addTaskRowToElement(btn.previousElementSibling, "", "08:00 AM", "05:00 PM", "-Doned");
    handleInput();
}

        function handleInput() { renderTable(); updateCopyDropdowns(); }

        function renderTable() {
            const output = document.getElementById('table-output');
            output.innerHTML = '';
            document.querySelectorAll('.day-block').forEach(block => {
                const date = block.querySelector('.d-date').value;
                const rows = block.querySelectorAll('.task-row');
                rows.forEach((row, index) => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td class="border border-black p-2 text-center text-xs font-bold">${index === 0 ? date : ''}</td>
                        <td class="border border-black p-2 text-sm">${row.querySelector('.t-desc').value}</td>
                        <td class="border border-black p-2 text-center text-xs">
                            ${row.querySelector('.t-start').value} - ${row.querySelector('.t-end').value} - Doned
                        </td>
                        <td class="border border-black p-2 text-xs italic">${row.querySelector('.t-remarks').value}</td>
                    `;
                    output.appendChild(tr);
                });
            });
        }

        function updateCopyDropdowns() {
            const allDates = Array.from(document.querySelectorAll('.d-date')).map(i => i.value).filter(v => v.trim() !== "");
            document.querySelectorAll('.copy-select').forEach(select => {
                const currentVal = select.value;
                select.innerHTML = '<option value="">Copy From...</option>';
                [...new Set(allDates)].forEach(date => {
                    const opt = document.createElement('option');
                    opt.value = date; opt.textContent = date;
                    select.appendChild(opt);
                });
                select.value = currentVal;
            });
        }

        function copyTasks(selectElement) {
            const sourceDate = selectElement.value;
            if (!sourceDate) return;
            const targetBlock = selectElement.closest('.day-block');
            const sourceBlock = Array.from(document.querySelectorAll('.day-block')).find(b => b.querySelector('.d-date').value === sourceDate);
            if (sourceBlock && sourceBlock !== targetBlock) {
                const taskList = targetBlock.querySelector('.task-list');
                taskList.innerHTML = '';
                sourceBlock.querySelectorAll('.task-row').forEach(row => {
                    addTaskRowToElement(
                        taskList, 
                        row.querySelector('.t-desc').value, 
                        row.querySelector('.t-start').value, 
                        row.querySelector('.t-end').value,
                        row.querySelector('.t-remarks').value
                    );
                });
                handleInput();
            }
        }

        window.onload = loadFromDB;
    </script>
</body>
</html>