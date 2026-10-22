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
    <title>KRC Task Tracker | Daily Accomplishment Report</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
<link rel="manifest" href="manifest.json">
<link rel="icon" type="image/png" href="logo.png">
    <script>
        // Apply saved theme BEFORE first paint (no flash of wrong theme)
        (function () {
            try {
                var saved = localStorage.getItem('krc_theme');
                if (!saved) {
                    saved = window.matchMedia && window.matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'dark';
                }
                document.documentElement.setAttribute('data-theme', saved);
            } catch (e) {
                document.documentElement.setAttribute('data-theme', 'dark');
            }
        })();
    </script>
    <style>



/* =========================================================
   THEME TOKENS  (dark = default, light = toggle)
   ========================================================= */
:root {
    --app-bg: #070b16;
    --app-text: #e2e8f0;
    --app-muted: #94a3b8;
    --app-surface: rgba(15, 23, 42, 0.55);
    --app-surface-2: rgba(255, 255, 255, 0.05);
    --app-border: rgba(255, 255, 255, 0.10);
    --app-shadow: 0 30px 70px -20px rgba(0, 0, 0, 0.75);
    --app-orb-opacity: 0.55;
}

html[data-theme="light"] {
    --app-bg: #e9eef8;
    --app-text: #1e293b;
    --app-muted: #64748b;
    --app-surface: rgba(255, 255, 255, 0.72);
    --app-surface-2: rgba(255, 255, 255, 0.55);
    --app-border: rgba(15, 23, 42, 0.10);
    --app-shadow: 0 24px 60px -24px rgba(15, 23, 42, 0.30);
    --app-orb-opacity: 0.42;
}

/* =========================================================
   AMBIENT BACKDROP (shared with login.php)
   ========================================================= */
.ambient {
    position: fixed;
    inset: 0;
    z-index: 0;
    overflow: hidden;
    pointer-events: none;
}

.orb {
    position: absolute;
    border-radius: 9999px;
    filter: blur(90px);
    opacity: var(--app-orb-opacity);
    will-change: transform;
    transition: opacity 0.6s ease;
}

.orb-1 {
    width: 560px; height: 560px;
    top: -200px; left: -160px;
    background: radial-gradient(circle at 30% 30%, #3b82f6, #1e40af 55%, transparent 72%);
    animation: drift-a 24s ease-in-out infinite;
}

.orb-2 {
    width: 520px; height: 520px;
    bottom: -220px; right: -140px;
    background: radial-gradient(circle at 60% 40%, #06b6d4, #0e7490 55%, transparent 72%);
    animation: drift-b 28s ease-in-out infinite;
}

.orb-3 {
    width: 400px; height: 400px;
    top: 38%; left: 60%;
    background: radial-gradient(circle at 50% 50%, #a855f7, #4c1d95 60%, transparent 74%);
    opacity: calc(var(--app-orb-opacity) * 0.55);
    animation: drift-c 32s ease-in-out infinite;
}

@keyframes drift-a {
    0%, 100% { transform: translate3d(0, 0, 0) scale(1); }
    50%      { transform: translate3d(70px, 60px, 0) scale(1.12); }
}
@keyframes drift-b {
    0%, 100% { transform: translate3d(0, 0, 0) scale(1.05); }
    50%      { transform: translate3d(-80px, -50px, 0) scale(0.95); }
}
@keyframes drift-c {
    0%, 100% { transform: translate3d(0, 0, 0) scale(0.9); }
    50%      { transform: translate3d(-60px, 40px, 0) scale(1.15); }
}

.grid-overlay {
    position: absolute;
    inset: 0;
    background-image:
        linear-gradient(rgba(255,255,255,0.035) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,0.035) 1px, transparent 1px);
    background-size: 58px 58px;
    mask-image: radial-gradient(ellipse at 50% 30%, #000 5%, transparent 70%);
    -webkit-mask-image: radial-gradient(ellipse at 50% 30%, #000 5%, transparent 70%);
    transition: opacity 0.5s ease;
}

html[data-theme="light"] .grid-overlay {
    background-image:
        linear-gradient(rgba(15,23,42,0.05) 1px, transparent 1px),
        linear-gradient(90deg, rgba(15,23,42,0.05) 1px, transparent 1px);
}

.noise {
    position: absolute;
    inset: 0;
    opacity: 0.14;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='160' height='160'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='3'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.5'/%3E%3C/svg%3E");
}

.particle {
    position: absolute;
    width: 4px; height: 4px;
    border-radius: 9999px;
    background: rgba(125, 211, 252, 0.7);
    box-shadow: 0 0 12px rgba(56, 189, 248, 0.8);
    animation: float-up linear infinite;
}

@keyframes float-up {
    0%   { transform: translateY(20px) scale(0.6); opacity: 0; }
    12%  { opacity: 0.9; }
    100% { transform: translateY(-620px) scale(1.1); opacity: 0; }
}

/* =========================================================
   THEME TOGGLE BUTTON
   ========================================================= */
.theme-toggle {
    position: relative;
    width: 42px;
    height: 42px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 14px;
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.12);
    color: #93c5fd;
    cursor: pointer;
    overflow: hidden;
    transition: transform 0.35s cubic-bezier(.2,.8,.2,1), box-shadow 0.35s ease,
                background 0.35s ease, border-color 0.35s ease, color 0.35s ease;
}

.theme-toggle:hover {
    transform: translateY(-2px) rotate(-8deg);
    color: #22d3ee;
    border-color: rgba(96, 165, 250, 0.55);
    box-shadow: 0 0 26px -4px rgba(59, 130, 246, 0.65);
    background: rgba(59, 130, 246, 0.14);
}

.theme-toggle:active { transform: translateY(0) scale(0.94); }

.theme-toggle svg {
    width: 19px; height: 19px;
    position: absolute;
    transition: transform 0.5s cubic-bezier(.2,.8,.2,1), opacity 0.35s ease;
}

/* Dark theme => show sun (click to go light), Light theme => show moon */
.theme-toggle .icon-sun  { opacity: 0; transform: rotate(-90deg) scale(0.5); }
.theme-toggle .icon-moon { opacity: 1; transform: rotate(0deg) scale(1); }

html[data-theme="light"] .theme-toggle .icon-sun  { opacity: 1; transform: rotate(0deg) scale(1); }
html[data-theme="light"] .theme-toggle .icon-moon { opacity: 0; transform: rotate(90deg) scale(0.5); }

/* =========================================================
   LIGHT MODE OVERRIDES
   ========================================================= */
html[data-theme="light"] body {
    background: var(--app-bg);
    color: var(--app-text);
}

html[data-theme="light"] nav {
    background: rgba(255, 255, 255, 0.72) !important;
    border-color: rgba(15, 23, 42, 0.08) !important;
    box-shadow: 0 10px 30px -18px rgba(15, 23, 42, 0.35);
}

html[data-theme="light"] nav p.text-white { color: #0f172a !important; }

html[data-theme="light"] .sticky-actions {
    background: rgba(255, 255, 255, 0.78) !important;
    border-color: rgba(59, 130, 246, 0.18) !important;
    box-shadow: 0 12px 30px -20px rgba(15, 23, 42, 0.4);
}

html[data-theme="light"] .day-block {
    background: rgba(255, 255, 255, 0.78) !important;
    border-color: rgba(15, 23, 42, 0.09) !important;
    box-shadow: var(--app-shadow);
}

html[data-theme="light"] .day-block:hover { border-color: rgba(59, 130, 246, 0.35) !important; }

html[data-theme="light"] .day-block > div:first-child {
    background: rgba(15, 23, 42, 0.035) !important;
    border-color: rgba(15, 23, 42, 0.07) !important;
}

html[data-theme="light"] .task-row {
    background: rgba(255, 255, 255, 0.85) !important;
    border-color: rgba(15, 23, 42, 0.08) !important;
}

html[data-theme="light"] .glass-input {
    background: rgba(255, 255, 255, 0.92) !important;
    border-color: rgba(15, 23, 42, 0.13) !important;
    color: #0f172a !important;
}

html[data-theme="light"] .glass-input:focus {
    background: #ffffff !important;
    border-color: #3b82f6 !important;
    box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.12), 0 0 18px -4px rgba(59, 130, 246, 0.45);
}

html[data-theme="light"] .glass-input::placeholder { color: #94a3b8 !important; }

html[data-theme="light"] .d-date { color: #0f172a !important; }

html[data-theme="light"] .copy-select {
    background: #ffffff !important;
    color: #334155 !important;
    box-shadow: inset 0 0 0 1px rgba(15, 23, 42, 0.1);
}

html[data-theme="light"] .toast {
    background: rgba(255, 255, 255, 0.92) !important;
    color: #0f172a !important;
    border-color: rgba(59, 130, 246, 0.28) !important;
    box-shadow: 0 18px 40px -16px rgba(15, 23, 42, 0.45);
}

html[data-theme="light"] .toast-error {
    border-color: rgba(239, 68, 68, 0.35) !important;
    box-shadow: 0 0 18px -6px rgba(239, 68, 68, 0.45);
}

html[data-theme="light"] .theme-toggle {
    background: rgba(15, 23, 42, 0.05);
    border-color: rgba(15, 23, 42, 0.12);
    color: #f59e0b;
}

html[data-theme="light"] .theme-toggle:hover {
    background: rgba(245, 158, 11, 0.12);
    border-color: rgba(245, 158, 11, 0.5);
    box-shadow: 0 0 26px -6px rgba(245, 158, 11, 0.6);
}

html[data-theme="light"] .drag-handle,
html[data-theme="light"] .drag-order-btn {
    background: rgba(15, 23, 42, 0.05);
    border-color: rgba(15, 23, 42, 0.12);
    color: #64748b;
}

html[data-theme="light"] .drag-handle:hover,
html[data-theme="light"] .drag-order-btn:hover {
    color: #2563eb;
    border-color: rgba(59, 130, 246, 0.5);
    background: rgba(59, 130, 246, 0.1);
}

html[data-theme="light"] .neon-text-blue { text-shadow: none; }

html[data-theme="light"] #view-toggle-btn {
    background: rgba(15, 23, 42, 0.05) !important;
    color: #475569 !important;
    border-color: rgba(15, 23, 42, 0.12) !important;
}

html[data-theme="light"] #view-toggle-btn:hover {
    background: rgba(59, 130, 246, 0.1) !important;
    color: #1d4ed8 !important;
}

html[data-theme="light"] #add-entry-btn {
    border-color: rgba(15, 23, 42, 0.18) !important;
    background: rgba(255, 255, 255, 0.5) !important;
}

html[data-theme="light"] #add-entry-btn:hover {
    border-color: rgba(59, 130, 246, 0.45) !important;
    background: rgba(59, 130, 246, 0.07) !important;
}

html[data-theme="light"] .day-block button[title="Remove Entry"] {
    background: rgba(15, 23, 42, 0.05) !important;
    color: #64748b !important;
    border-color: rgba(15, 23, 42, 0.1) !important;
}

html[data-theme="light"] .day-block button[title="Remove Entry"]:hover {
    background: rgba(239, 68, 68, 0.12) !important;
    color: #dc2626 !important;
}

@media (prefers-reduced-motion: reduce) {
    .orb, .particle { animation: none !important; }
    * { transition-duration: 0.01ms !important; }
}

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
            background-color: var(--app-bg);
            color: var(--app-text);
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
            transition: background-color 0.5s ease, color 0.5s ease;
        }

        /* Keep app content above the ambient layer */
        main, #report-preview {
            position: relative;
            z-index: 10;
        }

        @media print {
            .ambient { display: none !important; }
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
            -webkit-backdrop-filter: blur(12px);
            background: rgba(15, 23, 42, 0.85);
            border-bottom: 1px solid rgba(59, 130, 246, 0.2);
            transition: background 0.5s ease, border-color 0.5s ease;
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


.signatory-section {
        page-break-inside: avoid !important;
        break-inside: avoid !important;
        display: block !important;
        margin-top: 30px !important; /* Adds breathing room after the table */
    }

    /* Optional: Ensure the names and titles don't separate from their "Prepared by" label */
    .signatory-section > div {
        page-break-inside: avoid !important;
        break-inside: avoid !important;
    }








   
    
    @page { 
        size: portrait; 
        margin: 0.4in; /* Slightly smaller margin to give the table more room */
    }
    
    .no-print { display: none !important; }

    /* Report Container - Compact Font */
    #report-preview { 
        display: table !important; 
        width: 100%; 
        background: white !important;
        border-collapse: collapse !important;
        font-size: 9.5pt !important; /* Reduced from 12pt to save vertical space */
        color: black !important;
    }

    /* Header AND footer repeat on every printed page */
    thead { display: table-header-group; }
    tfoot { display: table-footer-group; }

    /* Header Text Arrangement - Tightened */
    .report-header-text {
        text-align: center;
        margin-top: 5px; /* Reduced */
        margin-bottom: 10px; /* Reduced */
    }

    .report-header-text h3 {
        font-size: 11pt; /* Scaled down */
        font-weight: bold;
        text-decoration: underline;
        text-transform: uppercase;
    }

    /* Fixed Footer Position - UNCHANGED */
 

    /* Grid Lines & Compact Spacing */
    .styled-table {
        width: 100%;
        border-collapse: collapse !important;
        border: 1pt solid black !important; /* Thinner border for cleaner look */
        margin-top: 5px;
    }

    .styled-table th {
        background-color: #f2f2f2 !important;
        border: 1pt solid black !important;
        padding: 4px 2px !important; /* Half the original padding */
        font-size: 9pt;
        font-weight: bold;
        text-align: center;
        text-transform: uppercase;
    }

    .styled-table td {
        border: 1pt solid black !important;
        padding: 2px 4px !important; /* Very tight padding to match your image */
        vertical-align: middle; /* Middle looks cleaner for small rows */
        line-height: 1.1; /* Tighter line spacing */
    }

    /* Optimized Column Widths */
    .col-date { text-align: center; font-weight: bold; width: 12%; font-size: 8.5pt; }
    .col-task { text-align: left; width: 50%; }
    .col-time { text-align: center; width: 23%; white-space: nowrap; font-size: 8.5pt; }
    .col-rem  { text-align: center; font-weight: bold; width: 15%; font-size: 8.5pt; }

    .print-img-header, .print-img-footer {
        width: 100%;
        display: block;
    }

    /* Footer pinned to the very bottom of EVERY printed page
       (repeats on each page, even when the data does not fill the page) */
    .print-footer {
        display: block !important;
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        z-index: 10;
    }

    /* Clearance so the last rows never hide behind the fixed footer */
    .footer-spacer {
        height: 0.75in;
    }

    /* Shrink the Signatory Section Gap */
    .signatory-section { margin-top: 10px !important; }
    .flex.justify-between.mb-12 { margin-bottom: 15px !important; }
    .mb-10 { margin-bottom: 10px !important; }
}

/* Screen visibility - UNCHANGED */
#report-preview { display: none; }
.print-footer { display: none; }

/* FORCE TILED GRID ON ALL DEVICES */
#inputs.view-grid {
    display: grid !important;
    /* This allows 2 columns even on some smaller phones, or 1 very tight column */
    grid-template-columns: repeat(auto-fill, minmax(160px, 1fr)) !important; 
    gap: 10px !important;
    padding: 10px !important;
}

/* SHRINK THE DATA BLOCKS */
#inputs.view-grid .day-block {
    padding: 0 !important;
    margin: 0 !important;
    border-radius: 12px !important;
    background: rgba(15, 23, 42, 0.9) !important;
}

/* Hide the "Clone Data" and "Remove" labels on tiled mobile to save space */
#inputs.view-grid .day-block label, 
#inputs.view-grid .copy-select,
#inputs.view-grid .h-8 {
    display: none !important;
}

/* Shrink the Date Header */
#inputs.view-grid .d-date {
    font-size: 14px !important;
    text-align: center;
}

/* Shrink the Task Rows into "Mini Bars" */
#inputs.view-grid .task-row {
    flex-direction: column !important;
    gap: 4px !important;
    margin-bottom: 8px !important;
    padding: 5px !important;
    border-bottom: 1px solid rgba(255,255,255,0.1) !important;
}

#inputs.view-grid .t-desc, 
#inputs.view-grid .t-start, 
#inputs.view-grid .t-end, 
#inputs.view-grid .t-remarks {
    font-size: 10px !important;
    padding: 4px 8px !important;
    height: auto !important;
}

/* Make the 'Add Row' button tiny */
#inputs.view-grid button[onclick="addTaskRow(this)"] {
    font-size: 10px !important;
    padding: 2px !important;
    justify-content: center;
}

/* -------------------------------------------------------------
   DRAG & DROP REORDERING OF DAY ENTRIES
   ------------------------------------------------------------- */
.day-block.dragging {
    opacity: 0.35;
}

.drag-handle {
    cursor: grab;
    user-select: none;
    -webkit-user-select: none;
    touch-action: none;
    flex-shrink: 0;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    color: #64748b;
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.08);
    transition: all 0.2s ease;
}

.drag-handle:hover {
    color: #3b82f6;
    border-color: rgba(59, 130, 246, 0.45);
    background: rgba(59, 130, 246, 0.1);
}

.drag-handle:active {
    cursor: grabbing;
}

.drag-order-btn {
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    font-size: 10px;
    color: #64748b;
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.08);
    transition: all 0.2s ease;
}

.drag-order-btn:hover {
    color: #60a5fa;
    border-color: rgba(59, 130, 246, 0.45);
}

.drag-order-btn:disabled {
    opacity: 0.25;
    cursor: not-allowed;
}




    </style>
</head>
<body class="text-slate-200 min-h-screen">

<!-- Ambient background -->
<div class="ambient" aria-hidden="true">
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>
    <div class="orb orb-3"></div>
    <div class="grid-overlay"></div>
    <div class="noise"></div>
    <div id="particles"></div>
</div>

<nav class="no-print border-b border-white/10 bg-slate-900/50 backdrop-blur-md sticky top-0 z-50 h-20">
    <div class="max-w-6xl mx-auto px-6 h-full flex items-center justify-between">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-gradient-to-tr from-blue-600 to-cyan-400 rounded-xl flex items-center justify-center shadow-[0_0_15px_rgba(59,130,246,0.5)]">
                <span class="text-white font-bold">K</span>
            </div>
            <div>
                <h1 class="font-bold text-lg leading-tight tracking-tight neon-text-blue">KRC TASK TRACKER</h1>
                <p class="text-[10px] text-blue-400 uppercase tracking-[0.2em] font-semibold">Accomplishment Report</p>
            </div>
        </div>

        <div class="flex items-center space-x-4 md:space-x-6">
       

            <div class="hidden md:block">
                <p class="text-[10px] text-slate-500 uppercase tracking-widest text-right">Logged in as</p>
                <p class="text-sm font-semibold text-white"><?php echo $employee_name; ?></p>
            </div>

            <button id="themeToggle" class="theme-toggle" title="Toggle dark / light mode" aria-label="Toggle dark or light mode">
                <svg class="icon-sun" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4V2m0 20v-2m8-8h2M2 12h2m13.66-5.66l1.42-1.42M4.92 19.08l1.42-1.42m0-11.32L4.92 4.92m14.16 14.16l-1.42-1.42M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                <svg class="icon-moon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/>
                </svg>
            </button>

            <a href="logout.php" class="px-5 py-2 rounded-lg bg-red-500/10 text-red-400 border border-red-500/20 hover:bg-red-500 hover:text-white transition-all duration-300 text-sm font-medium">Logout</a>
        </div>
    </div>
</nav>
 

    <div class="sticky-actions no-print mb-8">
        <div class="max-w-5xl mx-auto px-6 py-4 flex flex-col md:flex-row md:items-center justify-between gap-4">
         

   
            <div class="flex items-center gap-4">

                   <button onclick="saveToDB()" class="btn-thick px-8 py-3 rounded-xl bg-blue-600 border-blue-700 border-b-blue-900 text-white font-bold shadow-[0_5px_15px_rgba(59,130,246,0.3)] hover:bg-blue-500 transition-all active:scale-95 flex items-center">
                  Save
                </button>

                <button onclick="window.print()" class="btn-thick px-8 py-3 rounded-xl bg-blue-600 border-blue-700 border-b-blue-900 text-white font-bold shadow-[0_5px_15px_rgba(59,130,246,0.3)] hover:bg-blue-500 transition-all active:scale-95 flex items-center">
                    Print
                </button>


                    <button onclick="toggleView()" class="p-3 rounded-xl bg-slate-800 border border-white/10 text-slate-400 hover:text-white transition-all flex items-center gap-2" id="view-toggle-btn">
        <svg id="grid-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
        </svg>
        <span class="text-xs font-bold uppercase tracking-wider hidden sm:block">Switch View</span>
    </button> 
            </div>
        </div>
    </div>

    <main class="max-w-5xl mx-auto p-6 md:p-12 pt-0 no-print">
        <div id="inputs" class="space-y-8"></div>
        <button onclick="createNewDay()" id="add-entry-btn" class="group mt-10 w-full py-8 rounded-3xl border-2 border-dashed border-slate-700 hover:border-blue-500/50 hover:bg-blue-500/5 transition-all flex flex-col items-center justify-center gap-2">
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
            </td>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td>
                <div class="print-content-body p-2">
                    
                    <div class="text-center mt-4">
                        <h3 class="font-bold border-b border-black inline-block px-4">ACCOMPLISHMENT REPORT</h3>
                        <p class="text-sm mt-1">Period Covered: <span id="print-period" class="font-bold"></span></p>
                    </div>

                    <div class="mt-4 mb-4 text-sm">
                        <p>Employee Name: <span class="font-bold"><?php echo $employee_name; ?></span></p>
                        <p>Department/Unit: <span class="font-bold"><?php echo $department; ?></span></p>
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

                    <div class="signatory-section mt-12 text-sm" style="page-break-inside: avoid; break-inside: avoid;">
                        <div class="flex justify-between mb-12">
                            <div class="w-1/2 text-center">
                                <p class="mb-14">Prepared by:</p>
                                <div class="inline-block text-center">
                                    <p class="font-bold underline uppercase"><?php echo $staff_name; ?></p>
                                    <p><?php echo $staff_position; ?></p>
                                </div>
                            </div>

                            <div class="w-1/2 text-center">
                                <p class="mb-14">Noted by:</p>
                                <div class="inline-block text-center">
                                    <p class="font-bold underline uppercase"><?php echo $head_name; ?></p>
                                    <p><?php echo $head_title; ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-10 text-center" style="page-break-inside: avoid; break-inside: avoid;">
                            <p class="mb-14">Reviewed and Approved:</p>
                            <div class="inline-block text-center">
                                <p class="font-bold underline uppercase"><?php echo $administrative_name; ?></p>
                                <p><?php echo $administrative_title; ?></p>
                            </div>
                        </div>
                    </div> </div> </td>
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

<div class="print-footer" aria-hidden="true">
    <img src="footer.png" class="print-img-footer" alt="">
</div>



<script>
    // -----------------------------------------------------------------
    // 1. GLOBAL STATE & DATALISTS
    // -----------------------------------------------------------------
    let history = JSON.parse(localStorage.getItem('krc_history')) || {
        tasks: [],
        times: ["4 hrs", "8 hrs", "2 hrs", "1 hr"],
        remarks: ["-DONE", "IN PROGRESS", "PENDING"]
    };

    function updateDataLists() {
        let taskList = document.getElementById('history-tasks');
        let timeList = document.getElementById('history-times');
        let remarkList = document.getElementById('history-remarks');

        if (!taskList) {
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

    // -----------------------------------------------------------------
    // 1b. AMBIENCE & THEME (DARK / LIGHT)
    // -----------------------------------------------------------------
    function applyTheme(theme) {
        document.documentElement.setAttribute('data-theme', theme);
        try { localStorage.setItem('krc_theme', theme); } catch (e) {}
    }

    function initTheme() {
        const btn = document.getElementById('themeToggle');
        if (!btn) return;

        const current = document.documentElement.getAttribute('data-theme') || 'dark';
        applyTheme(current);

        btn.addEventListener('click', () => {
            const next = (document.documentElement.getAttribute('data-theme') === 'light') ? 'dark' : 'light';
            applyTheme(next);
            notify(next === 'light' ? 'Light Mode Enabled' : 'Dark Mode Enabled', 'success');
        });
    }

    function initAmbience() {
        const host = document.getElementById('particles');
        if (!host) return;
        for (let i = 0; i < 16; i++) {
            const p = document.createElement('span');
            p.className = 'particle';
            p.style.left = Math.random() * 100 + '%';
            p.style.bottom = '-20px';
            p.style.animationDuration = (12 + Math.random() * 16) + 's';
            p.style.animationDelay = (Math.random() * 16) + 's';
            p.style.opacity = (0.2 + Math.random() * 0.55);
            const s = 2 + Math.random() * 4;
            p.style.width = s + 'px';
            p.style.height = s + 'px';
            host.appendChild(p);
        }
    }

    // -----------------------------------------------------------------
    // 2. LIFECYCLE & INITIALIZATION
    // -----------------------------------------------------------------
    window.onload = async function() {
        initTheme();
        initAmbience();
        updateDataLists();
        await loadFromDB();

        const savedView = localStorage.getItem('krc_view_pref');
        if (savedView === 'tiled') {
            document.getElementById('inputs').classList.add('view-grid');
        }
    };

    function handleInput() { 
        renderTable(); 
        updateCopyDropdowns(); 
    }

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

        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => toast.remove(), 500);
        }, 4000);
    }

    // -----------------------------------------------------------------
    // 3. GALLERY / TILED VIEW LOGIC
    // -----------------------------------------------------------------
    function toggleView() {
        const container = document.getElementById('inputs');
        container.classList.toggle('view-grid');
        const isTiled = container.classList.contains('view-grid');

        if (isTiled) {
            const blocks = document.querySelectorAll('.day-block');
            const summaryData = Array.from(blocks).map((block, index) => ({
                date: block.querySelector('.d-date').value || "No Date",
                tasks: block.querySelectorAll('.task-row').length,
                index: index
            }));

            container.setAttribute('data-original-html', container.innerHTML);
            container.innerHTML = summaryData.map(data => `
                <div onclick="jumpToDate(${data.index})" class="bg-slate-900/80 border border-blue-500/30 p-6 rounded-2xl hover:border-blue-500 hover:bg-blue-500/10 transition-all cursor-pointer flex flex-col items-center justify-center text-center shadow-lg group">
                    <div class="text-blue-400 text-[10px] font-bold uppercase tracking-widest mb-1 group-hover:text-blue-300">Entry Date</div>
                    <div class="text-white font-bold text-lg">${data.date}</div>
                    <div class="mt-2 px-3 py-1 bg-blue-500/20 rounded-full text-[10px] text-blue-300 font-bold uppercase">${data.tasks} Activities</div>
                </div>
            `).join('');
            
            localStorage.setItem('krc_view_pref', 'tiled');
            notify("Gallery View: Select a date to edit", "success");
        } else {
            localStorage.setItem('krc_view_pref', 'editor');
            location.reload();
        }
    }

    async function jumpToDate(index) {
        const container = document.getElementById('inputs');
        container.classList.remove('view-grid');
        localStorage.setItem('krc_view_pref', 'editor');
        
        await loadFromDB(); 
        
        setTimeout(() => {
            const blocks = document.querySelectorAll('.day-block');
            if (blocks[index]) {
                blocks[index].scrollIntoView({ behavior: 'smooth', block: 'center' });
                blocks[index].classList.add('ring-2', 'ring-blue-500');
                setTimeout(() => blocks[index].classList.remove('ring-2', 'ring-blue-500'), 2000);
            }
        }, 100);
    }

    // -----------------------------------------------------------------
    // 4. DAY & TASK ROW GENERATION + DURATION PARSING
    // -----------------------------------------------------------------
    function calculateDuration(startTimeStr, endTimeStr) {
        if (!startTimeStr || !endTimeStr) return "";

        const parseTime = (timeStr) => {
            const match = timeStr.match(/^(\d{1,2}):(\d{2})\s*(AM|PM)$/i);
            if (!match) return null;
            let hours = parseInt(match[1]);
            const minutes = parseInt(match[2]);
            const ampm = match[3].toUpperCase();

            if (ampm === "PM" && hours < 12) hours += 12;
            if (ampm === "AM" && hours === 12) hours = 0;

            return hours * 60 + minutes;
        };

        const startMin = parseTime(startTimeStr);
        const endMin = parseTime(endTimeStr);

        if (startMin === null || endMin === null) return startTimeStr;

        let diffMin = endMin - startMin;
        if (diffMin < 0) diffMin += 24 * 60;

        const hours = Math.floor(diffMin / 60);
        const mins = diffMin % 60;

        let result = "";
        if (hours > 0) result += `${hours} hr${hours > 1 ? 's' : ''}`;
        if (mins > 0) result += `${hours > 0 ? ' ' : ''}${mins} min${mins > 1 ? 's' : ''}`;

        return result || "0 hrs";
    }

    // Helper to extract numeric hours from strings like "4 hrs", "2.5 hrs", "30 mins"
    function parseDurationToHours(durationStr) {
        if (!durationStr) return 0;

        let totalHours = 0;
        const hrMatch = durationStr.match(/([\d.]+)\s*hr/i);
        const minMatch = durationStr.match(/([\d.]+)\s*min/i);

        if (hrMatch) totalHours += parseFloat(hrMatch[1]);
        if (minMatch) totalHours += parseFloat(minMatch[1]) / 60;

        // Fallback for raw numeric entries
        if (!hrMatch && !minMatch) {
            const rawNum = parseFloat(durationStr);
            if (!isNaN(rawNum)) totalHours += rawNum;
        }

        return totalHours;
    }

    function createNewDay() {
        const blocks = document.querySelectorAll('.d-date');
        let nextDate = "";
        let latestDate = null;

        blocks.forEach(input => {
            const parsed = new Date(input.value);
            if (!isNaN(parsed.getTime()) && (!latestDate || parsed > latestDate)) {
                latestDate = parsed;
            }
        });

        if (latestDate) {
            latestDate.setDate(latestDate.getDate() + 1);
            nextDate = latestDate.toLocaleDateString('en-US', { month: 'short', day: '2-digit', year: 'numeric' });
        } else {
            nextDate = new Date().toLocaleDateString('en-US', { month: 'short', day: '2-digit', year: 'numeric' });
        }
        addDay({ date: nextDate });
    }

    function addDay(data = null) {
        const container = document.getElementById('inputs');
        const dayDiv = document.createElement('div');
        dayDiv.className = 'bg-slate-900/40 border border-white/5 rounded-3xl overflow-hidden neon-border-blue transition-all duration-500 hover:border-white/10 day-block relative';
        
        const defaultDate = (data && data.date) ? data.date : "";
        const tasks = (data && data.tasks) ? data.tasks : [""];
        const durations = (data && data.durations) ? data.durations : (data && data.starts ? data.starts : ["4 hrs"]);
        const remarks = (data && data.remarks) ? data.remarks : ["-DONE"];

        dayDiv.innerHTML = `
        <div class="px-6 py-5 bg-white/5 border-b border-white/5 flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-center gap-3 flex-1 min-w-[240px]">
                <div class="drag-handle" title="Drag to reorder" aria-label="Drag to reorder entry">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 pointer-events-none" fill="currentColor" viewBox="0 0 20 20">
                        <circle cx="7" cy="5" r="1.4"/><circle cx="13" cy="5" r="1.4"/>
                        <circle cx="7" cy="10" r="1.4"/><circle cx="13" cy="10" r="1.4"/>
                        <circle cx="7" cy="15" r="1.4"/><circle cx="13" cy="15" r="1.4"/>
                    </svg>
                </div>

                <div class="flex flex-wrap items-center gap-4 sm:gap-8 flex-1">
                    <div class="min-w-[140px]">
                        <label class="block text-[10px] uppercase font-bold text-blue-400 tracking-widest mb-1">Entry Date</label>
                        <input type="text" class="d-date bg-transparent text-white font-bold border-none p-0 focus:ring-0 text-lg w-full" value="${defaultDate}" oninput="handleInput()">
                    </div>
                    
                    <div class="h-8 w-[1px] bg-white/10 hidden md:block"></div>
                    
                    <div class="flex-1 min-w-[150px] max-w-xs">
                        <label class="block text-[10px] uppercase font-bold text-slate-500 tracking-widest mb-1">Clone Data From</label>
                        <select class="copy-select w-full bg-slate-800 border-none text-xs text-slate-300 rounded-md py-2 px-3 focus:ring-1 focus:ring-blue-500" onchange="copyTasks(this)"></select>
                    </div>
                </div>
            </div>
            
            <div class="flex items-center gap-2">
                <button onclick="moveDayBlock(this.closest('.day-block'), -1)" class="drag-order-btn" title="Move Up" aria-label="Move entry up">&#9650;</button>
                <button onclick="moveDayBlock(this.closest('.day-block'), 1)" class="drag-order-btn" title="Move Down" aria-label="Move entry down">&#9660;</button>
                <button onclick="this.closest('.day-block').remove(); handleInput(); refreshOrderButtons();" 
                    class="w-10 h-10 rounded-full flex items-center justify-center text-slate-400 bg-slate-800/50 hover:bg-red-500/20 hover:text-red-400 transition-all shadow-sm border border-white/5" 
                    title="Remove Entry">
                    &#10005;
                </button>
            </div>
        </div>
        <div class="p-6">
            <div class="task-list space-y-4"></div>
            <button onclick="addTaskRow(this)" class="mt-4 text-sm font-bold text-blue-400 hover:text-blue-300 transition-colors flex items-center gap-2">
                <span class="flex items-center justify-center w-5 h-5 rounded-full border-2 border-blue-400 text-xs">+</span> Add Row
            </button>
        </div>
        `;

        const taskList = dayDiv.querySelector('.task-list');
        tasks.forEach((t, i) => addTaskRowToElement(taskList, t, durations[i] || "4 hrs", "", remarks[i]));
        container.appendChild(dayDiv);
        handleInput();
        refreshOrderButtons();
    }

    function addTaskRowToElement(container, task = "", start = "4 hrs", end = "", remarks = "-DONE") {
        const row = document.createElement('div');
        row.className = 'task-row flex flex-col md:flex-row gap-3 items-center bg-slate-800/40 p-3 rounded-2xl border border-white/5';

        const durationVal = (start && end) ? calculateDuration(start, end) : (start || "4 hrs");

        row.innerHTML = `
            <div class="flex-1 w-full">
                <input type="text" list="history-tasks" placeholder="Activity / Task description..." value="${task}" 
                    class="t-desc glass-input w-full px-4 py-2 rounded-xl text-sm text-white placeholder-slate-500" oninput="handleInput()">
            </div>
            <div class="w-full md:w-36">
                <input type="text" list="history-times" placeholder="Duration (e.g. 4 hrs)" value="${durationVal}" 
                    class="t-duration glass-input w-full px-4 py-2 rounded-xl text-sm text-center text-white placeholder-slate-500" oninput="handleInput()">
            </div>
            <div class="w-full md:w-32">
                <input type="text" list="history-remarks" placeholder="Remarks" value="${remarks}" 
                    class="t-remarks glass-input w-full px-4 py-2 rounded-xl text-sm text-center text-white placeholder-slate-500" oninput="handleInput()">
            </div>
            <button onclick="this.closest('.task-row').remove(); handleInput();" 
                class="text-slate-500 hover:text-red-400 p-2 transition-colors">✕</button>
        `;
        container.appendChild(row);
    }

    function addTaskRow(btn) {
        const taskList = btn.previousElementSibling;
        addTaskRowToElement(taskList, "", "4 hrs", "", "-DONE");
        handleInput();
    }

    // -----------------------------------------------------------------
    // 4b. MANUAL ORDERING (DRAG & DROP / MOVE UP / MOVE DOWN)
    // -----------------------------------------------------------------
    let draggedBlock = null;

    function getDayBlocks() {
        return Array.from(document.getElementById('inputs').querySelectorAll('.day-block'));
    }

    function refreshOrderButtons() {
        const blocks = getDayBlocks();
        blocks.forEach((block, i) => {
            const up = block.querySelector('button[title="Move Up"]');
            const down = block.querySelector('button[title="Move Down"]');
            if (up) up.disabled = (i === 0);
            if (down) down.disabled = (i === blocks.length - 1);
        });
    }

    function moveDayBlock(block, direction) {
        if (!block) return;
        const container = document.getElementById('inputs');
        const blocks = getDayBlocks();
        const index = blocks.indexOf(block);
        const target = blocks[index + direction];
        if (!target) return;

        if (direction < 0) {
            container.insertBefore(block, target);
        } else {
            target.after(block);
        }

        handleInput();
        refreshOrderButtons();
        saveToDB();
    }

    // Init drag & drop once for the whole container (blocks are dynamic)
    const inputsContainer = document.getElementById('inputs');

    inputsContainer.addEventListener('mousedown', (e) => {
        const handle = e.target.closest('.drag-handle');
        if (!handle) return;
        const block = handle.closest('.day-block');
        if (block) block.draggable = true;
    });

    inputsContainer.addEventListener('mouseup', () => {
        // If the handle was pressed but no drag actually started, disarm the block
        if (!draggedBlock) {
            document.querySelectorAll('#inputs .day-block').forEach(b => { b.draggable = false; });
        }
    });

    inputsContainer.addEventListener('dragstart', (e) => {
        const block = e.target.closest('.day-block');
        if (!block || !block.draggable) {
            e.preventDefault();
            return;
        }
        draggedBlock = block;
        block.classList.add('dragging');
        e.dataTransfer.effectAllowed = 'move';
        try { e.dataTransfer.setData('text/plain', ''); } catch (err) {}
    });

    inputsContainer.addEventListener('dragover', (e) => {
        if (!draggedBlock) return;
        e.preventDefault();
        e.dataTransfer.dropEffect = 'move';

        const overBlock = e.target.closest('.day-block');
        if (!overBlock || overBlock === draggedBlock) return;

        const rect = overBlock.getBoundingClientRect();
        const isBelow = (e.clientY - rect.top) > (rect.height / 2);

        if (isBelow) {
            overBlock.after(draggedBlock);
        } else {
            overBlock.before(draggedBlock);
        }
    });

    inputsContainer.addEventListener('dragend', () => {
        if (draggedBlock) {
            draggedBlock.classList.remove('dragging');
            draggedBlock.draggable = false;
        }
        draggedBlock = null;
        refreshOrderButtons();
        handleInput();
        saveToDB();
    });

    inputsContainer.addEventListener('drop', (e) => {
        e.preventDefault();
        if (draggedBlock) {
            draggedBlock.classList.remove('dragging');
            draggedBlock.draggable = false;
            draggedBlock = null;
            refreshOrderButtons();
            handleInput();
            saveToDB();
        }
    });

    // -----------------------------------------------------------------
    // 5. CLONE / COPY TASKS LOGIC
    // -----------------------------------------------------------------
    function updateCopyDropdowns() {
        const allDates = Array.from(document.querySelectorAll('.d-date')).map(i => i.value).filter(v => v.trim() !== "");
        document.querySelectorAll('.copy-select').forEach(select => {
            const currentVal = select.value;
            select.innerHTML = '<option value="">Copy From...</option>';
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
        const sourceBlock = Array.from(document.querySelectorAll('.day-block')).find(b => b.querySelector('.d-date').value === sourceDate);
        if (sourceBlock && sourceBlock !== targetBlock) {
            const taskList = targetBlock.querySelector('.task-list');
            taskList.innerHTML = '';
            sourceBlock.querySelectorAll('.task-row').forEach(row => {
                addTaskRowToElement(
                    taskList, 
                    row.querySelector('.t-desc').value, 
                    row.querySelector('.t-duration').value, 
                    "",
                    row.querySelector('.t-remarks').value
                );
            });
            handleInput();
        }
    }

    // -----------------------------------------------------------------
    // 6. DB SAVE & LOAD (API INTEGRATION)
    // -----------------------------------------------------------------
    async function saveToDB() {
        const data = [];
        document.querySelectorAll('.day-block').forEach(block => {
            const date = block.querySelector('.d-date').value;
            block.querySelectorAll('.task-row').forEach(row => {
                data.push({
                    date: date,
                    desc: row.querySelector('.t-desc').value,
                    start: row.querySelector('.t-duration').value,
                    end: "",
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
            if (result.status === "success") notify("System Synced Successfully", "success");
        } catch (e) { 
            notify("Network Error", "error"); 
        }
    }

    async function loadFromDB() {
        try {
            const response = await fetch('api.php');
            const savedData = await response.json();
            if (savedData && savedData.length > 0) {
                document.getElementById('inputs').innerHTML = '';

                // Group rows into consecutive blocks (rows of one day entry are saved
                // contiguously), so the manual order set via drag & drop is preserved.
                const groups = [];
                savedData.forEach(curr => {
                    const last = groups[groups.length - 1];
                    if (!last || last.date !== curr.report_date) {
                        groups.push({ date: curr.report_date, tasks: [], durations: [], remarks: [] });
                    }
                    const group = groups[groups.length - 1];

                    group.tasks.push(curr.activity);

                    const durationVal = (curr.start_time && curr.end_time)
                        ? calculateDuration(curr.start_time, curr.end_time)
                        : (curr.start_time || "4 hrs");

                    group.durations.push(durationVal);
                    group.remarks.push(curr.remarks || "");
                });

                groups.forEach(group => {
                    addDay({
                        date: group.date,
                        tasks: group.tasks,
                        durations: group.durations,
                        remarks: group.remarks
                    });
                });
            } else { 
                createNewDay(); 
            }
        } catch (e) { 
            createNewDay(); 
        }
    }

    // -----------------------------------------------------------------
    // 7. REPORT TABLE RENDERER (WITH PER-DAY TOTAL ROW)
    // -----------------------------------------------------------------
    function renderTable() {
        const output = document.getElementById('table-output');
        if (!output) return;
        output.innerHTML = '';
        
        const blocks = document.querySelectorAll('.day-block');
        
        if (blocks.length > 0) {
            const dateInputs = Array.from(document.querySelectorAll('.d-date'))
                .map(input => new Date(input.value))
                .filter(d => !isNaN(d.getTime()));

            if (dateInputs.length > 0) {
                dateInputs.sort((a, b) => a - b);
                const firstDate = dateInputs[0];
                const lastDate = dateInputs[dateInputs.length - 1];
                const monthNames = ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"];
                const monthStr = monthNames[lastDate.getMonth()];
                const yearNum = lastDate.getFullYear();
                const startDay = String(firstDate.getDate()).padStart(2, '0');
                const absoluteLastDay = new Date(yearNum, lastDate.getMonth() + 1, 0).getDate();
                const endDay = String(absoluteLastDay).padStart(2, '0');

                const printPeriod = document.getElementById('print-period');
                if (printPeriod) {
                    printPeriod.textContent = `${monthStr} ${startDay}-${endDay}, ${yearNum}`;
                }
            }
        }

        blocks.forEach(block => {
            const dateValue = block.querySelector('.d-date').value;
            const taskRows = block.querySelectorAll('.task-row');
            
            let totalDayHours = 0;
            // Total row increases rowspan count by 1
            const totalRowsCount = taskRows.length + 1;

            taskRows.forEach((row, index) => {
                const tr = document.createElement('tr');
                
                let dateCell = "";
                if (index === 0) {
                    dateCell = `<td rowspan="${totalRowsCount}" class="col-date text-center font-bold">${dateValue}</td>`;
                }

                const desc = row.querySelector('.t-desc').value;
                const duration = row.querySelector('.t-duration').value || "4 hrs";
                let remark = row.querySelector('.t-remarks').value || "-DONE";

                // Accumulate numerical total
                totalDayHours += parseDurationToHours(duration);

                tr.innerHTML = `
                    ${dateCell}
                    <td class="col-task">- ${desc}</td>
                    <td class="col-time text-center">${duration}</td>
                    <td class="col-rem text-center">${remark.toUpperCase()}</td>
                `;
                output.appendChild(tr);
            });

            // Append "TOTAL" summary row for the day
            if (taskRows.length > 0) {
                const totalTr = document.createElement('tr');
                totalTr.className = 'font-bold bg-slate-100/10';
                
                // Format display string
                const displayTotal = (totalDayHours % 1 === 0) 
                    ? `${totalDayHours} hrs` 
                    : `${totalDayHours.toFixed(1)} hrs`;

                totalTr.innerHTML = `
                    <td class="col-task text-right font-extrabold pr-4 uppercase">TOTAL:</td>
                    <td class="col-time text-center font-extrabold">${displayTotal}</td>
                    <td class="col-rem text-center"></td>
                `;
                output.appendChild(totalTr);
            }
        });
    }
</script>


</body>
</html>