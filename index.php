<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Database Connection to fetch Signatories
$conn = new mysqli("localhost", "root", "", "krc_system");
$username = $_SESSION['username'];

$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user_data = $result->fetch_assoc();

// Assigning variables for the report
$employee_name = $user_data['employee_name']; 
$staff_name = $user_data['staff_name']; 

// or 'full_name'
$staff_position = $user_data['staff_position'];
$head_name = $user_data['head_name'];
$head_title = $user_data['head_title'];
$administrative_name = $user_data['administrative_name'];
$administrative_title = $user_data['administrative_title'];
$department = $user_data['department'];
?>








<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | KRC Dailytask Tracker</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
<link rel="manifest" href="manifest.json">

    <style>



/* Neon Toast System */
#toast-container {
    position: fixed;
    bottom: 2rem;
    right: 2rem;
    z-index: 100;
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.toast {
    background: rgba(15, 23, 42, 0.8);
    backdrop-filter: blur(12px);
    border: 1px solid rgba(59, 130, 246, 0.3);
    padding: 1rem 1.5rem;
    border-radius: 1rem;
    color: white;
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.5), 0 0 15px rgba(59, 130, 246, 0.1);
    display: flex;
    align-items: center;
    gap: 12px;
    transform: translateX(120%);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.toast.show {
    transform: translateX(0);
}

.toast-success { border-left: 4px solid #3b82f6; }
.toast-error { 
    border-left: 4px solid #ef4444; 
    border-color: rgba(239, 68, 68, 0.3); 
    box-shadow: 0 0 15px rgba(239, 68, 68, 0.1); 
}

.toast-icon {
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    font-size: 12px;
    font-weight: bold;
}

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
        @page { 
            size: portrait; 
            margin: 0.5in; 
        }
        
        .no-print { display: none !important; }

        /* Report Container - Standard Font 12 */
        #report-preview { 
            display: table !important; 
            width: 100%; 
            background: white !important;
            border-collapse: collapse !important;
            font-size: 12pt !important; /* Standard Font Size */
            color: black !important;
        }

        thead { display: table-header-group; }

        /* Header Text Arrangement */
        .report-header-text {
            text-align: center;
            margin-top: 15px;
            margin-bottom: 20px;
        }

        .report-header-text h3 {
            font-size: 14pt;
            font-weight: bold;
            text-decoration: underline;
            text-transform: uppercase;
        }

        /* Fixed Footer Algorithm */
        .print-footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            width: 100%;
            z-index: 1000;
        }

        .footer-spacer {
            height: 130px; /* Adjust to footer height */
        }

        /* Grid Lines & Standard Spacing */
        .styled-table {
            width: 100%;
            border-collapse: collapse !important;
            border: 1.5pt solid black !important;
            margin-top: 10px;
        }

        .styled-table th {
            background-color: #f2f2f2 !important; /* Slight tint for header */
            border: 1pt solid black !important;
            padding: 8px !important;
            font-weight: bold;
            text-align: center;
            text-transform: uppercase;
        }

        .styled-table td {
            border: 1pt solid black !important;
            padding: 8px !important;
            vertical-align: top; /* Standard report alignment */
            line-height: 1.4;
        }

        /* Specific Column Alignment */
        .col-date { text-align: center; font-weight: bold; width: 15%; }
        .col-task { text-align: left; width: 45%; }
        .col-time { text-align: center; width: 25%; white-space: nowrap; }
        .col-rem  { text-align: center; font-weight: bold; width: 15%; }

        .print-img-header, .print-img-footer {
            width: 100%;
            display: block;
        }
    }

    /* Screen visibility controls */
    #report-preview, .print-footer { display: none; }
    @media print {
        #report-preview { display: table !important; }
        .print-footer { display: block !important; }
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
                <h1 class="font-bold text-lg leading-tight tracking-tight neon-text-blue">KRC TASK TRACKER </h1>
                <p class="text-[10px] text-blue-400 uppercase tracking-[0.2em] font-semibold">Accomplishment Report</p>
            </div>
        </div>

        <div class="flex items-center space-x-4 md:space-x-6">
       

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

                   <button onclick="saveToDB()" class="btn-thick px-8 py-3 rounded-xl bg-blue-600 border-blue-700 border-b-blue-900 text-white font-bold shadow-[0_5px_15px_rgba(59,130,246,0.3)] hover:bg-blue-500 transition-all active:scale-95 flex items-center">
                  Save
                </button>

                <button onclick="window.print()" class="btn-thick px-8 py-3 rounded-xl bg-blue-600 border-blue-700 border-b-blue-900 text-white font-bold shadow-[0_5px_15px_rgba(59,130,246,0.3)] hover:bg-blue-500 transition-all active:scale-95 flex items-center">
                    Print
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



<table id="report-preview">
    <thead>
        <tr>
            <td>
                <img src="header.png" class="print-img-header" alt="Header">
                <div class="text-center mt-4">
                    <h3 class="font-bold border-b border-black inline-block px-4">ACCOMPLISHMENT REPORT</h3>
                    <p class="text-sm mt-1">Period Covered: <span id="print-period" class="font-bold"></span></p>
                </div>
            </td>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td>
                <div class="print-content-body">
                    <div class="mt-4 mb-4 text-sm">
                        <p>Employee Name: <span class="font-bold"><?php echo $employee_name; ?></span></p>
                        <p>Department/Unit: <span class="font-bold"> <?php echo $department; ?> </span></p>
                    </div>

                    <table class="styled-table">
                        <thead>
                            <tr>
                                <th width="15%">Date</th>
                                <th width="45%">Activity/Accomplishment</th>
                                <th width="25%">Allotted Time</th>
                                <th width="15%">Remarks</th>
                            </tr>
                        </thead>
                        <tbody id="table-output">
                            </tbody>
                    </table>

<div class="signatory-section mt-12 text-sm">
    <div class="flex justify-between mb-12">
        <div class="w-1/2 text-center">
            <p class="mb-10">Prepared by:</p>
            <div class="inline-block text-center">
                <p class="font-bold underline uppercase"><?php echo $staff_name; ?></p>
                <p><?php echo $staff_position; ?></p>
            </div>
        </div>

        <div class="w-1/2 text-center">
            <p class="mb-10">Noted by:</p>
            <div class="inline-block text-center">
                <p class="font-bold underline uppercase"><?php echo $head_name; ?></p>
                <p><?php echo $head_title; ?></p>
            </div>
        </div>
    </div>

    <div class="mt-10 text-center">
        <p class="mb-10">Reviewed and Approved:</p>
        <div class="inline-block text-center">
            <p class="font-bold underline uppercase"><?php echo $administrative_name; ?></p>
            <p><?php echo $administrative_title; ?></p>
        </div>
    </div>
</div>
                    
                </div>
            </td>
        </tr>
    </tbody>

    <tfoot>
        <tr>
            <td>
                <div class="footer-spacer"></div>
            </td>
        </tr>
    </tfoot>
</table>

<div class="print-footer no-screen">
    <img src="footer.png" class="print-img-footer" alt="Footer">
</div>


    <script>





function notify(message, type = 'success') {
    let container = document.getElementById('toast-container');
    if (!container) {
        container = document.createElement('div');
        container.id = 'toast-container';
        document.body.appendChild(container);
    }

    const toast = document.createElement('div');
    toast.className = `toast toast-${type}`;
    
    const icon = type === 'success' ? '✓' : '✕';
    const color = type === 'success' ? 'bg-blue-500' : 'bg-red-500';

    toast.innerHTML = `
        <div class="${color} toast-icon shadow-lg shadow-inherit">${icon}</div>
        <div>
            <p class="text-[10px] uppercase tracking-[0.2em] font-bold opacity-50">${type}</p>
            <p class="text-sm font-semibold tracking-wide">${message}</p>
        </div>
    `;

    container.appendChild(toast);
    setTimeout(() => toast.classList.add('show'), 10);

    // Auto-remove after 4 seconds
    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => toast.remove(), 500);
    }, 4000);
}



















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
    <div class="px-6 py-5 bg-white/5 border-b border-white/5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 sm:gap-6 w-full sm:w-auto">
            <div class="space-y-1 w-full sm:w-auto">
                <label class="block text-[10px] uppercase font-bold text-blue-400 tracking-widest">Entry Date</label>
                <input type="text" class="d-date bg-transparent text-white font-bold border-none p-0 focus:ring-0 text-lg w-full" value="${defaultDate}" oninput="handleInput()">
            </div>
            
            <div class="h-8 w-[1px] bg-white/10 hidden sm:block"></div>
            
            <div class="w-full sm:w-auto">
                <label class="block text-[10px] uppercase font-bold text-slate-500 tracking-widest mb-1">Clone Data</label>
                <select class="copy-select w-full bg-slate-800 border-none text-xs text-slate-300 rounded-md py-2 px-3 focus:ring-1 focus:ring-blue-500" onchange="copyTasks(this)"></select>
            </div>
        </div>
        
        <button onclick="this.closest('.day-block').remove(); handleInput();" class="absolute top-4 right-4 sm:static w-10 h-10 rounded-full flex items-center justify-center text-slate-500 hover:bg-red-500/10 hover:text-red-400 transition-all">✕</button>
    </div>
    <div class="p-6">
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
function addTaskRowToElement(taskList, desc="", start="", end="", remarks="-DONE") {
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
    addTaskRowToElement(btn.previousElementSibling, "", "08:00 AM", "05:00 PM", "-DONE");
    handleInput();
}

        function handleInput() { renderTable(); updateCopyDropdowns(); }

function renderTable() {
    const output = document.getElementById('table-output');
    output.innerHTML = '';
    
    const blocks = document.querySelectorAll('.day-block');
    
    // Update Period Covered header based on first and last entry
    if(blocks.length > 0) {
        const firstDate = blocks[0].querySelector('.d-date').value;
        const lastDate = blocks[blocks.length-1].querySelector('.d-date').value;
        document.getElementById('print-period').textContent = `${firstDate} - ${lastDate}`;
    }

    blocks.forEach(block => {
        const dateValue = block.querySelector('.d-date').value;
        const taskRows = block.querySelectorAll('.task-row');
        
        taskRows.forEach((row, index) => {
            const tr = document.createElement('tr');
            
            // 1. Handle Date Column (Rowspan)
            let dateCell = "";
            if (index === 0) {
                dateCell = `<td rowspan="${taskRows.length}" class="text-center font-bold">${dateValue}</td>`;
            }

            // 2. Get Data from Inputs
            const desc = row.querySelector('.t-desc').value;
            const start = row.querySelector('.t-start').value;
            const end = row.querySelector('.t-end').value;
            let remark = row.querySelector('.t-remarks').value;
            
            // Default remark if empty
            if (!remark || remark.trim() === "") remark = "-DONE";

            tr.innerHTML = `
                ${dateCell}
                <td>- ${desc}</td>
                <td class="text-center">${start} — ${end}</td>
                <td class="text-center font-bold">${remark.toUpperCase()}</td>
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




<script>
    // 1. Initialize memory from LocalStorage or empty arrays
let history = JSON.parse(localStorage.getItem('krc_history')) || {
    tasks: [],
    times: ["08:00 AM", "05:00 PM", "12:00 PM", "01:00 PM"],
    remarks: ["-DONE", "IN PROGRESS", "PENDING"]
};

// 2. Function to update DataLists in the DOM
function updateDataLists() {
    let taskList = document.getElementById('history-tasks');
    let timeList = document.getElementById('history-times');
    let remarkList = document.getElementById('history-remarks');

    if(!taskList) { // Create them if they don't exist
        const container = document.createElement('div');
        container.innerHTML = `
            <datalist id="history-tasks"></datalist>
            <datalist id="history-times"></datalist>
            <datalist id="history-remarks"></datalist>
        `;
        document.body.appendChild(container);
        taskList = document.getElementById('history-tasks');
        timeList = document.getElementById('history-times');
        remarkList = document.getElementById('history-remarks');
    }

    taskList.innerHTML = history.tasks.map(t => `<option value="${t}">`).join('');
    timeList.innerHTML = history.times.map(t => `<option value="${t}">`).join('');
    remarkList.innerHTML = history.remarks.map(t => `<option value="${t}">`).join('');
}

// 3. Modified addTaskRowToElement to include 'list' attribute
function addTaskRowToElement(taskList, desc="", start="", end="", remarks="-DONE") {
    const row = document.createElement('div');
    row.className = 'task-row flex flex-col gap-3 group animate-in fade-in slide-in-from-left-4 duration-300 mb-6';
    row.innerHTML = `
        <div class="flex flex-col lg:flex-row gap-4 items-start lg:items-center">
            <div class="flex-1 w-full">
                <input type="text" list="history-tasks" class="t-desc w-full glass-input rounded-xl px-5 py-3 text-sm text-white font-medium" value="${desc}" placeholder="Describe activity..." oninput="handleInput()">
            </div>
            <div class="flex items-center gap-3 w-full lg:w-auto">
                <input type="text" list="history-times" class="t-start w-28 glass-input text-center rounded-xl py-3 text-xs text-blue-400 font-bold" value="${start}" oninput="handleInput()">
                <span class="text-slate-600 font-bold text-xs uppercase">To</span>
                <input type="text" list="history-times" class="t-end w-28 glass-input text-center rounded-xl py-3 text-xs text-blue-400 font-bold" value="${end}" oninput="handleInput()">
                <button onclick="this.closest('.task-row').remove(); handleInput();" class="p-2 text-slate-700 hover:text-red-400 transition-colors">✕</button>
            </div>
        </div>
        <div class="w-full pl-2">
            <input type="text" list="history-remarks" class="t-remarks w-full bg-transparent border-b border-white/10 px-2 py-1 text-xs text-slate-400 focus:border-blue-500 outline-none transition-colors" value="${remarks}" placeholder="Remarks..." oninput="handleInput()">
        </div>
    `;
    taskList.appendChild(row);
}

// 4. Update saveToDB to also save to Local History
async function saveToDB() {
    const data = [];
    const newTasks = [];
    const newRemarks = [];
    const newTimes = [];

    // 1. Collect data from the UI
    document.querySelectorAll('.day-block').forEach(block => {
        const date = block.querySelector('.d-date').value;
        block.querySelectorAll('.task-row').forEach(row => {
            const d = row.querySelector('.t-desc').value;
            const s = row.querySelector('.t-start').value;
            const e = row.querySelector('.t-end').value;
            const r = row.querySelector('.t-remarks').value;

            data.push({ date: date, desc: d, start: s, end: e, remarks: r });
            
            // Collect for local history (remember feature)
            if(d) newTasks.push(d);
            if(s) newTimes.push(s);
            if(e) newTimes.push(e);
            if(r) newRemarks.push(r);
        });
    });

    // 2. Update Local History (The "Remember" List)
    history.tasks = [...new Set([...history.tasks, ...newTasks])].slice(-50); 
    history.times = [...new Set([...history.times, ...newTimes])].slice(-20);
    history.remarks = [...new Set([...history.remarks, ...newRemarks])].slice(-20);
    
    localStorage.setItem('krc_history', JSON.stringify(history));
    updateDataLists(); // Refresh the datalist suggestions

    // 3. Modern Sync Process
    try {
        // Optional: Show a "Processing" toast here if you like
        const response = await fetch('api.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        });

        if (!response.ok) throw new Error('Network response was not ok');
        
        const result = await response.json();

        if(result.status === "success") {
            // Neon Success Notification
            notify("System Synced & History Updated", "success");
        } else {
            notify("Sync failed: " + (result.message || "Unknown error"), "error");
        }
    } catch (e) {
        // Neon Error Notification
        notify("Network Error: Could not reach KRC Server", "error");
        console.error("Sync Error:", e);
    }
}


// 5. Initialize on load
window.onload = function() {
    loadFromDB();
    updateDataLists();
};







    </script>



</body>
</html>