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
    --app-shadow: 0 30px 70px -20px rgba(0, 0, 0, 0.75);
}

html[data-theme="light"] {
    --app-bg: #e9eef8;
    --app-text: #1e293b;
    --app-shadow: 0 24px 60px -24px rgba(15, 23, 42, 0.30);
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

        /* Keep app content above background layers */
        main, #report-preview {
            position: relative;
            z-index: 10;
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
            background: rgba(15, 23, 42, 0.95);
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
    .signatory-section {
        page-break-inside: avoid !important;
        break-inside: avoid !important;
        display: block !important;
        margin-top: 30px !important;
    }

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

    /* Fixed Footer Position - UNCHANGED */
 

    /* Grid Lines & Compact Spacing */
    .styled-table {
        width: 100%;
        border-collapse: collapse !important;
        table-layout: fixed;
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

    .print-task-list {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .print-task-list li {
        padding-left: 12px;
        text-indent: -12px;
    }

    .print-remark-list { display: block; }
    .print-remark-line { line-height: 1.15; }

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
#inputs.view-grid .d-am,
#inputs.view-grid .d-pm,
#inputs.view-grid .d-remarks {
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

/* =========================================================
   PROFILE, SETTINGS, CHAT
   ========================================================= */
.profile-btn {
    width: 42px;
    height: 42px;
    border-radius: 9999px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    color: #fff;
    background: linear-gradient(135deg, #2563eb, #06b6d4);
    border: 2px solid rgba(255, 255, 255, 0.18);
    cursor: pointer;
    font-size: 15px;
    user-select: none;
}

.profile-menu {
    position: absolute;
    top: 52px;
    right: 0;
    width: 230px;
    background: #0f172a;
    border: 1px solid rgba(255, 255, 255, 0.12);
    border-radius: 14px;
    box-shadow: 0 18px 40px -12px rgba(0, 0, 0, 0.65);
    overflow: hidden;
    z-index: 80;
}

html[data-theme="light"] .profile-menu {
    background: #ffffff;
    border-color: rgba(15, 23, 42, 0.12);
}

.profile-menu button,
.profile-menu a {
    display: block;
    width: 100%;
    text-align: left;
    padding: 11px 16px;
    font-size: 13px;
    font-weight: 600;
    color: inherit;
    background: transparent;
    border: none;
    cursor: pointer;
}

.profile-menu button:hover,
.profile-menu a:hover {
    background: rgba(59, 130, 246, 0.14);
}

.icon-btn {
    width: 42px;
    height: 42px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 14px;
    background: rgba(255, 255, 255, 0.06);
    border: 1px solid rgba(255, 255, 255, 0.12);
    color: #93c5fd;
    cursor: pointer;
}

.icon-btn:hover {
    background: rgba(59, 130, 246, 0.14);
    border-color: rgba(96, 165, 250, 0.55);
}

html[data-theme="light"] .icon-btn {
    background: rgba(15, 23, 42, 0.05);
    border-color: rgba(15, 23, 42, 0.12);
    color: #2563eb;
}

#settingsModal.hidden,
#chatPanel.hidden,
#profileMenu.hidden {
    display: none !important;
}

.modal-overlay {
    position: fixed;
    inset: 0;
    z-index: 90;
    background: rgba(2, 6, 23, 0.65);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 16px;
}

.modal-card {
    width: 100%;
    max-width: 680px;
    max-height: 88vh;
    overflow-y: auto;
    background: #0f172a;
    border: 1px solid rgba(255, 255, 255, 0.12);
    border-radius: 18px;
    color: #e2e8f0;
}

html[data-theme="light"] .modal-card {
    background: #ffffff;
    border-color: rgba(15, 23, 42, 0.12);
    color: #1e293b;
}

.modal-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 16px 20px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
}

html[data-theme="light"] .modal-head {
    border-bottom-color: rgba(15, 23, 42, 0.08);
}

.modal-close {
    width: 34px;
    height: 34px;
    border-radius: 10px;
    border: 1px solid rgba(255, 255, 255, 0.12);
    background: transparent;
    color: inherit;
    cursor: pointer;
    font-size: 18px;
}

.template-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 9px 12px;
    border-radius: 10px;
    border: 1px solid rgba(255, 255, 255, 0.07);
    margin-bottom: 7px;
    cursor: pointer;
}

.template-item:hover {
    background: rgba(59, 130, 246, 0.08);
}

html[data-theme="light"] .template-item {
    border-color: rgba(15, 23, 42, 0.08);
}

.template-item input {
    width: 16px;
    height: 16px;
    accent-color: #3b82f6;
}

.settings-section-toggle {
    cursor: pointer;
    background: transparent;
    border: 0;
    color: inherit;
    transition: background-color 0.2s ease;
}

.settings-section-toggle:hover {
    background: rgba(59, 130, 246, 0.08);
}

.settings-section-toggle .settings-chevron {
    transition: transform 0.25s ease;
}

.settings-section-toggle[aria-expanded="true"] .settings-chevron {
    transform: rotate(180deg);
}

.settings-section-body {
    animation: settingsFlyDown 0.22s ease;
}

@keyframes settingsFlyDown {
    from { opacity: 0; transform: translateY(-6px); }
    to { opacity: 1; transform: translateY(0); }
}

.chat-panel {
    position: fixed;
    right: 22px;
    bottom: 22px;
    width: 760px;
    max-width: calc(100vw - 24px);
    height: 540px;
    max-height: calc(100vh - 40px);
    background: #0f172a;
    border: 1px solid rgba(255, 255, 255, 0.12);
    border-radius: 18px;
    box-shadow: 0 25px 60px -18px rgba(0, 0, 0, 0.8);
    z-index: 95;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    color: #e2e8f0;
}

html[data-theme="light"] .chat-panel {
    background: #ffffff;
    border-color: rgba(15, 23, 42, 0.12);
    color: #1e293b;
}

.chat-body {
    flex: 1;
    display: flex;
    min-height: 0;
}

.chat-users {
    width: 220px;
    border-right: 1px solid rgba(255, 255, 255, 0.08);
    overflow-y: auto;
    flex-shrink: 0;
}

html[data-theme="light"] .chat-users {
    border-right-color: rgba(15, 23, 42, 0.08);
}

.chat-user {
    display: flex;
    align-items: center;
    gap: 9px;
    padding: 10px 12px;
    cursor: pointer;
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
}

.chat-user:hover,
.chat-user.active {
    background: rgba(59, 130, 246, 0.14);
}

.chat-user-info {
    min-width: 0;
}

.chat-user-info p {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.status-dot {
    width: 9px;
    height: 9px;
    border-radius: 9999px;
    background: #64748b;
    flex-shrink: 0;
}

.status-dot.online {
    background: #22c55e;
}

.chat-conv {
    flex: 1;
    display: flex;
    flex-direction: column;
    min-width: 0;
}

.chat-messages {
    flex: 1;
    overflow-y: auto;
    padding: 14px;
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.msg {
    max-width: 78%;
    padding: 8px 12px;
    border-radius: 12px;
    font-size: 13px;
    line-height: 1.35;
    word-wrap: break-word;
}

.msg .msg-meta {
    font-size: 10px;
    opacity: 0.6;
    margin-top: 3px;
}

.msg.mine {
    align-self: flex-end;
    background: #2563eb;
    color: #fff;
    border-bottom-right-radius: 3px;
}

.msg.other {
    align-self: flex-start;
    background: rgba(148, 163, 184, 0.16);
    border-bottom-left-radius: 3px;
}

html[data-theme="light"] .msg.other {
    background: rgba(15, 23, 42, 0.08);
}

.chat-input-row {
    display: flex;
    gap: 8px;
    padding: 10px;
    border-top: 1px solid rgba(255, 255, 255, 0.08);
}

html[data-theme="light"] .chat-input-row {
    border-top-color: rgba(15, 23, 42, 0.08);
}

@media (max-width: 640px) {
    .chat-users {
        width: 150px;
    }
    .chat-panel {
        right: 8px;
        bottom: 8px;
        height: calc(100vh - 16px);
    }
}

    </style>
</head>
<body class="text-slate-200 min-h-screen">

<nav class="no-print border-b border-white/10 bg-slate-900/90 sticky top-0 z-50 h-20">
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

        <div class="flex items-center space-x-3 md:space-x-4">

            <button id="chatToggle" class="icon-btn" title="Messages" aria-label="Open messages">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h8m-8 4h5m-9 6V7a2 2 0 012-2h12a2 2 0 012 2v9a2 2 0 01-2 2H8l-5 4z"/>
                </svg>
            </button>

            <button id="themeToggle" class="theme-toggle" title="Toggle dark / light mode" aria-label="Toggle dark or light mode">
                <svg class="icon-sun" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4V2m0 20v-2m8-8h2M2 12h2m13.66-5.66l1.42-1.42M4.92 19.08l1.42-1.42m0-11.32L4.92 4.92m14.16 14.16l-1.42-1.42M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                <svg class="icon-moon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/>
                </svg>
            </button>

            <div class="relative">
                <button id="profileBtn" class="profile-btn" title="<?php echo htmlspecialchars($employee_name ?? ''); ?>">
                    <?php echo strtoupper(substr(trim($employee_name ?? ''), 0, 1)); ?>
                </button>
                <div id="profileMenu" class="profile-menu hidden">
                    <div class="px-4 py-3 border-b border-white/10">
                        <p class="text-sm font-semibold"><?php echo htmlspecialchars($employee_name ?? ''); ?></p>
                        <p class="text-[11px] opacity-60">@<?php echo htmlspecialchars($username); ?></p>
                    </div>
                    <button type="button" onclick="openSettings()">Settings</button>
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>
</nav>
 

    <div class="sticky-actions no-print mb-8">
        <div class="max-w-5xl mx-auto px-6 py-4 flex flex-col md:flex-row md:items-center justify-between gap-4">

            <div class="flex items-center gap-3">
                <label for="monthFilter" class="text-[10px] uppercase font-bold text-slate-400 tracking-widest">Month</label>
                <select id="monthFilter" onchange="applyMonthFilter()" class="glass-input rounded-xl px-4 py-2.5 text-sm font-semibold bg-slate-800 text-white">
                </select>
            </div>

            <div class="flex items-center gap-4">

                   <button onclick="saveToDB()" class="btn-thick px-8 py-3 rounded-xl bg-blue-600 border-blue-700 border-b-blue-900 text-white font-bold shadow-[0_5px_15px_rgba(59,130,246,0.3)] hover:bg-blue-500 transition-all active:scale-95 flex items-center">
                  Save
                </button>

                <button onclick="printReport()" class="btn-thick px-8 py-3 rounded-xl bg-blue-600 border-blue-700 border-b-blue-900 text-white font-bold shadow-[0_5px_15px_rgba(59,130,246,0.3)] hover:bg-blue-500 transition-all active:scale-95 flex items-center">
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
                        <p class="text-sm mt-1">Covered Period: <span id="print-period" class="font-bold"></span></p>
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
                                <th width="25%" style="padding:0 !important;">
                                    <div style="padding:4px 2px;">Allotted Time</div>
                                    <table style="width:100%;border-collapse:collapse;table-layout:fixed;">
                                        <tr>
                                            <td style="width:50%;border:none !important;border-top:1pt solid #000 !important;border-right:2px solid #000 !important;text-align:center;padding:2px 3px !important;">AM</td>
                                            <td style="width:50%;border:none !important;border-top:1pt solid #000 !important;text-align:center;padding:2px 3px !important;">PM</td>
                                        </tr>
                                    </table>
                                </th>
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
                                    <p class="font-bold underline"><?php echo $staff_name; ?></p>
                                    <p><?php echo $staff_position; ?></p>
                                </div>
                            </div>

                            <div class="w-1/2 text-center">
                                <p class="mb-14">Noted by:</p>
                                <div class="inline-block text-center">
                                    <p class="font-bold underline"><?php echo $head_name; ?></p>
                                    <p><?php echo $head_title; ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-10 text-center" style="page-break-inside: avoid; break-inside: avoid;">
                            <p class="mb-14">Review and evaluated by:</p>
                            <div class="inline-block text-center">
                                <p class="font-bold underline"><?php echo $administrative_name; ?></p>
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

<!-- SETTINGS MODAL -->
<div id="settingsModal" class="modal-overlay hidden">
    <div class="modal-card">
        <div class="modal-head">
            <div>
                <h2 class="font-bold text-lg">Settings</h2>
                <p class="text-[11px] opacity-60">Account details, daily tasks, and copying from other users</p>
            </div>
            <button type="button" class="modal-close" onclick="closeSettings()">&times;</button>
        </div>

        <div class="settings-section">
            <button type="button" class="settings-section-toggle w-full flex items-center justify-between gap-4 px-5 py-4 text-left" aria-expanded="false" onclick="toggleSettingsSection(this)">
                <div>
                    <h3 class="font-bold text-sm uppercase tracking-wider text-blue-400 mb-1">Account details</h3>
                    <p class="text-xs opacity-60">Update the information from your registration form, username, and password.</p>
                </div>
                <span class="settings-chevron text-slate-400 text-sm">&#9660;</span>
            </button>
            <div class="settings-section-body hidden px-5 pb-5">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[10px] uppercase font-bold opacity-60 mb-1">Full Name</label>
                        <input type="text" id="acctEmployeeName" class="glass-input w-full rounded-lg px-3 py-2 text-sm" placeholder="Full name">
                    </div>
                    <div>
                        <label class="block text-[10px] uppercase font-bold opacity-60 mb-1">Username</label>
                        <input type="text" id="acctUsername" class="glass-input w-full rounded-lg px-3 py-2 text-sm" placeholder="Username">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-[10px] uppercase font-bold opacity-60 mb-1">New Password</label>
                        <input type="password" id="acctPassword" class="glass-input w-full rounded-lg px-3 py-2 text-sm" placeholder="Leave blank to keep current password" autocomplete="new-password">
                    </div>
                    <div>
                        <label class="block text-[10px] uppercase font-bold opacity-60 mb-1">Prepared By - Name</label>
                        <input type="text" id="acctStaffName" class="glass-input w-full rounded-lg px-3 py-2 text-sm">
                    </div>
                    <div>
                        <label class="block text-[10px] uppercase font-bold opacity-60 mb-1">Prepared By - Title</label>
                        <input type="text" id="acctStaffPosition" class="glass-input w-full rounded-lg px-3 py-2 text-sm">
                    </div>
                    <div>
                        <label class="block text-[10px] uppercase font-bold opacity-60 mb-1">Noted By - Name</label>
                        <input type="text" id="acctHeadName" class="glass-input w-full rounded-lg px-3 py-2 text-sm">
                    </div>
                    <div>
                        <label class="block text-[10px] uppercase font-bold opacity-60 mb-1">Noted By - Title</label>
                        <input type="text" id="acctHeadTitle" class="glass-input w-full rounded-lg px-3 py-2 text-sm">
                    </div>
                    <div>
                        <label class="block text-[10px] uppercase font-bold opacity-60 mb-1">Reviewed &amp; Approved - Name</label>
                        <input type="text" id="acctAdminName" class="glass-input w-full rounded-lg px-3 py-2 text-sm">
                    </div>
                    <div>
                        <label class="block text-[10px] uppercase font-bold opacity-60 mb-1">Reviewed &amp; Approved - Title</label>
                        <input type="text" id="acctAdminTitle" class="glass-input w-full rounded-lg px-3 py-2 text-sm">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-[10px] uppercase font-bold opacity-60 mb-1">Department / Unit</label>
                        <input type="text" id="acctDepartment" class="glass-input w-full rounded-lg px-3 py-2 text-sm">
                    </div>
                </div>

                <button type="button" onclick="saveAccount()" class="mt-4 px-5 py-2.5 rounded-xl bg-blue-600 text-white font-bold text-sm">Save Account</button>
            </div>
        </div>

        <div class="settings-section border-t border-white/10">
            <button type="button" class="settings-section-toggle w-full flex items-center justify-between gap-4 px-5 py-4 text-left" aria-expanded="false" onclick="toggleSettingsSection(this)">
                <div>
                    <h3 class="font-bold text-sm uppercase tracking-wider text-blue-400 mb-1">Styles</h3>
                    <p class="text-xs opacity-60">Choose how accomplishment details are aligned, then assign it to specific dates or repeating weekdays.</p>
                </div>
                <span class="settings-chevron text-slate-400 text-sm">&#9660;</span>
            </button>
            <div class="settings-section-body hidden px-5 pb-5">
                <div class="rounded-2xl bg-slate-800/40 border border-white/5 p-3 mb-3">
                    <label class="block text-[10px] uppercase font-bold opacity-60 mb-2">Alignment</label>
                    <div id="styleAlignControl" class="flex items-center gap-1 p-1 rounded-xl bg-slate-900/60 border border-white/10">
                        <button type="button" data-align="left" onclick="setStyleAlign('left')" class="style-align-btn flex-1 px-3 py-2 rounded-lg text-xs font-bold transition-all">Left</button>
                        <button type="button" data-align="center" onclick="setStyleAlign('center')" class="style-align-btn flex-1 px-3 py-2 rounded-lg text-xs font-bold transition-all">Center</button>
                        <button type="button" data-align="right" onclick="setStyleAlign('right')" class="style-align-btn flex-1 px-3 py-2 rounded-lg text-xs font-bold transition-all">Right</button>
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-2 mb-3">
                    <button type="button" id="styleModeDateBtn" onclick="setStyleMode('date')" class="px-3 py-2 rounded-lg text-xs font-bold border transition-all">Assign by specific date</button>
                    <button type="button" id="styleModeWeekdayBtn" onclick="setStyleMode('weekday')" class="px-3 py-2 rounded-lg text-xs font-bold border transition-all">Assign Monday to Sunday</button>
                </div>

                <div id="styleDateWrap">
                    <div class="flex items-center justify-between mb-2 gap-3">
                        <label class="block text-[10px] uppercase font-bold opacity-60">Month</label>
                        <input type="month" id="styleMonth" onchange="renderStyleDates()" class="glass-input rounded-lg px-3 py-1.5 text-xs">
                    </div>
                    <div id="styleDateList" class="grid grid-cols-2 sm:grid-cols-4 gap-1 max-h-52 overflow-y-auto pr-1"></div>
                    <p class="text-[10px] opacity-50 mt-2">Checked dates use the selected alignment. A specific date overrides the weekday rule.</p>
                </div>

                <div id="styleWeekdayWrap" class="hidden">
                    <div id="styleWeekdayList" class="grid grid-cols-2 sm:grid-cols-4 gap-1"></div>
                    <p class="text-[10px] opacity-50 mt-2">Checked weekdays repeat the selected alignment on every matching date.</p>
                </div>
            </div>
        </div>

        <div class="settings-section border-t border-white/10">
            <button type="button" class="settings-section-toggle w-full flex items-center justify-between gap-4 px-5 py-4 text-left" aria-expanded="false" onclick="toggleSettingsSection(this)">
                <div>
                    <h3 class="font-bold text-sm uppercase tracking-wider text-blue-400 mb-1">Auto-generate daily tasks</h3>
                    <p class="text-xs opacity-60">Check the tasks you do regularly. Saving applies them to every working day (Monday&ndash;Friday) of the selected month; Saturday and Sunday are skipped.</p>
                </div>
                <span class="settings-chevron text-slate-400 text-sm">&#9660;</span>
            </button>
            <div class="settings-section-body hidden px-5 pb-5">
                <label class="flex items-start justify-between gap-3 p-3 rounded-xl bg-slate-800/40 border border-white/5 mb-3 cursor-pointer">
                    <span class="block">
                        <span class="block text-xs font-bold">Generate all month task</span>
                        <span class="block text-[10px] opacity-60 mt-0.5">When on, saving fills every date of the selected month with your checked tasks. Saturday and Sunday stay empty unless included below.</span>
                    </span>
                    <input type="checkbox" id="genAllMonth" onchange="saveGenerationSettings()" class="mt-1 w-4 h-4 accent-blue-500 shrink-0">
                </label>

                <div class="flex flex-wrap items-center gap-3 mb-3 text-xs">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" id="genIncludeSaturday" onchange="saveGenerationSettings()" class="w-4 h-4 accent-blue-500">
                        Include Saturday
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" id="genIncludeSunday" onchange="saveGenerationSettings()" class="w-4 h-4 accent-blue-500">
                        Include Sunday
                    </label>
                    <div class="flex items-center gap-2 ml-auto">
                        <span class="text-[10px] uppercase font-bold opacity-60">Month</span>
                        <input type="month" id="genMonth" onchange="saveGenerationSettings()" class="glass-input rounded-lg px-2 py-1">
                    </div>
                </div>

                <div id="recentTasksList" class="max-h-64 overflow-y-auto pr-1">
                    <p class="text-sm opacity-60">Loading recent tasks...</p>
                </div>
            </div>
        </div>

        <div class="settings-section border-t border-white/10">
            <button type="button" class="settings-section-toggle w-full flex items-center justify-between gap-4 px-5 py-4 text-left" aria-expanded="false" onclick="toggleSettingsSection(this)">
                <div>
                    <h3 class="font-bold text-sm uppercase tracking-wider text-blue-400 mb-1">Copy tasks from another user</h3>
                    <p class="text-xs opacity-60">Copy a single day or a whole month into your own report.</p>
                </div>
                <span class="settings-chevron text-slate-400 text-sm">&#9660;</span>
            </button>
            <div class="settings-section-body hidden px-5 pb-5">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-[10px] uppercase font-bold opacity-60 mb-1">User</label>
                        <select id="copyUser" class="glass-input w-full rounded-lg px-3 py-2 text-sm"></select>
                    </div>
                    <div>
                        <label class="block text-[10px] uppercase font-bold opacity-60 mb-1">Copy</label>
                        <select id="copyMode" onchange="toggleCopyMode()" class="glass-input w-full rounded-lg px-3 py-2 text-sm">
                            <option value="day">Daily tasks</option>
                            <option value="month">Whole month</option>
                        </select>
                    </div>
                    <div id="copyDateWrap">
                        <label class="block text-[10px] uppercase font-bold opacity-60 mb-1">Date</label>
                        <input type="date" id="copyDate" class="glass-input w-full rounded-lg px-3 py-2 text-sm">
                    </div>
                    <div id="copyMonthWrap" class="hidden">
                        <label class="block text-[10px] uppercase font-bold opacity-60 mb-1">Month</label>
                        <input type="month" id="copyMonth" class="glass-input w-full rounded-lg px-3 py-2 text-sm">
                    </div>
                </div>

                <button type="button" onclick="copyFromUser()" class="mt-4 px-5 py-2.5 rounded-xl bg-blue-600 text-white font-bold text-sm">Copy Tasks</button>
            </div>
        </div>

        <div class="settings-section border-t border-white/10">
            <button type="button" class="settings-section-toggle w-full flex items-center justify-between gap-4 px-5 py-4 text-left" aria-expanded="false" onclick="toggleSettingsSection(this)">
                <div>
                    <h3 class="font-bold text-sm uppercase tracking-wider text-blue-400 mb-1">Download report</h3>
                    <p class="text-xs opacity-60">Export your accomplishment report as a Microsoft Word (.doc) file you can edit and print.</p>
                </div>
                <span class="settings-chevron text-slate-400 text-sm">&#9660;</span>
            </button>
            <div class="settings-section-body hidden px-5 pb-5">
                <button type="button" onclick="exportToWord()" id="exportWordBtn" class="px-5 py-2.5 rounded-xl bg-blue-600 text-white font-bold text-sm">Export Word (.doc)</button>
            </div>
        </div>
    </div>
</div>

<!-- CHAT PANEL -->
<div id="chatPanel" class="chat-panel hidden">
    <div class="modal-head">
        <div>
            <h2 class="font-bold text-base">Messages</h2>
            <p id="chatHeaderStatus" class="text-[11px] opacity-60">Everyone</p>
        </div>
        <button type="button" class="modal-close" onclick="closeChat()">&times;</button>
    </div>

    <div class="chat-body">
        <div id="chatUserList" class="chat-users"></div>
        <div class="chat-conv">
            <div id="chatMessages" class="chat-messages"></div>
            <form id="chatForm" class="chat-input-row" onsubmit="sendChat(event)">
                <input id="chatInput" type="text" autocomplete="off" placeholder="Type a message..." class="glass-input flex-1 rounded-xl px-4 py-2 text-sm">
                <button type="submit" class="px-5 py-2 rounded-xl bg-blue-600 text-white font-bold text-sm">Send</button>
            </form>
        </div>
    </div>
</div>

<script>
    // -----------------------------------------------------------------
    // 1. GLOBAL STATE & DATALISTS
    // -----------------------------------------------------------------
    const CURRENT_USER = <?php echo json_encode($username); ?>;

    let history = JSON.parse(localStorage.getItem('krc_history')) || {
        tasks: [],
        times: ["4 hours", "8 hours", "2 hours", "1 hour"],
        remarks: ["DONE", "IN PROGRESS", "PENDING"]
    };

    let allUsers = [];
    let activeChat = '';
    let chatPollTimer = null;
    let recentTaskState = [];
    let generationSettings = { generate_all_month: 0, include_saturday: 0, include_sunday: 0 };
    let saveTimer = null;
    let isLoadingData = false;

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

    // -----------------------------------------------------------------
    // 2. LIFECYCLE & INITIALIZATION
    // -----------------------------------------------------------------
    window.onload = async function() {
        initTheme();
        initUiEvents();
        updateDataLists();
        loadStyleState();

        await sendHeartbeat();
        await loadFromDB();

        const savedView = localStorage.getItem('krc_view_pref');
        if (savedView === 'tiled') {
            document.getElementById('inputs').classList.add('view-grid');
        }

        setInterval(async () => {
            const generated = await sendHeartbeat();
            if (generated > 0 && document.getElementById('chatPanel').classList.contains('hidden')) {
                await loadFromDB();
                notify(generated + ' daily task(s) added automatically', 'success');
            }
        }, 60000);
    };

    function initUiEvents() {
        const profileBtn = document.getElementById('profileBtn');
        const profileMenu = document.getElementById('profileMenu');
        if (profileBtn && profileMenu) {
            profileBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                profileMenu.classList.toggle('hidden');
            });
        }

        document.addEventListener('click', (e) => {
            if (profileMenu && !profileMenu.classList.contains('hidden') && !e.target.closest('#profileMenu') && e.target.id !== 'profileBtn') {
                profileMenu.classList.add('hidden');
            }
        });

        const chatToggle = document.getElementById('chatToggle');
        if (chatToggle) chatToggle.addEventListener('click', openChat);

        document.querySelectorAll('[id$="Modal"]').forEach((el) => {
            el.addEventListener('click', (e) => {
                if (e.target === el) closeSettings();
            });
        });
    }

    async function sendHeartbeat() {
        try {
            const r = await fetch('app_api.php?action=heartbeat', { method: 'POST' });
            const d = await r.json();
            return (d && d.status === 'ok') ? (parseInt(d.generated, 10) || 0) : 0;
        } catch (e) {
            return 0;
        }
    }

    function handleInput() {
        renderTable();
        updateCopyDropdowns();
        scheduleSave();
    }

    // Keep the database in sync with the form automatically (debounced).
    function scheduleSave() {
        if (isLoadingData) return;
        if (saveTimer) clearTimeout(saveTimer);
        saveTimer = setTimeout(() => {
            saveTimer = null;
            saveToDB(true);
        }, 900);
    }

    // Always rebuild the printed report from the current form values before printing.
    function printReport() {
        if (saveTimer) {
            clearTimeout(saveTimer);
            saveTimer = null;
        }
        renderTable();
        saveToDB(true);
        window.print();
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
    // 2b. STYLES: ACCOMPLISHMENT DETAIL ALIGNMENT (LEFT / CENTER / RIGHT)
    // -----------------------------------------------------------------
    let styleState = { align: 'left', mode: 'date', dates: {}, weekdays: {} };

    function pad2(n) {
        return String(n).padStart(2, '0');
    }

    function isoFromDate(d) {
        return d.getFullYear() + '-' + pad2(d.getMonth() + 1) + '-' + pad2(d.getDate());
    }

    function loadStyleState() {
        try {
            const raw = localStorage.getItem('krc_styles');
            if (raw) {
                const parsed = JSON.parse(raw);
                styleState = {
                    align: ['left', 'center', 'right'].includes(parsed.align) ? parsed.align : 'left',
                    mode: parsed.mode === 'weekday' ? 'weekday' : 'date',
                    dates: (parsed.dates && typeof parsed.dates === 'object') ? parsed.dates : {},
                    weekdays: (parsed.weekdays && typeof parsed.weekdays === 'object') ? parsed.weekdays : {}
                };
            }
        } catch (e) {}
        applyStyleUi();
    }

    function saveStyleState() {
        try { localStorage.setItem('krc_styles', JSON.stringify(styleState)); } catch (e) {}
    }

    function applyStyleUi() {
        document.querySelectorAll('#styleAlignControl [data-align]').forEach(btn => {
            const active = btn.dataset.align === styleState.align;
            btn.classList.toggle('bg-blue-600', active);
            btn.classList.toggle('text-white', active);
            btn.classList.toggle('text-slate-400', !active);
            btn.classList.toggle('hover:text-white', !active);
        });

        const isDate = styleState.mode !== 'weekday';
        const dateBtn = document.getElementById('styleModeDateBtn');
        const wdBtn = document.getElementById('styleModeWeekdayBtn');
        if (dateBtn) dateBtn.className = `px-3 py-2 rounded-lg text-xs font-bold border transition-all ${isDate ? 'bg-blue-600 border-blue-600 text-white' : 'border-white/10 text-slate-400 hover:text-white'}`;
        if (wdBtn) wdBtn.className = `px-3 py-2 rounded-lg text-xs font-bold border transition-all ${!isDate ? 'bg-blue-600 border-blue-600 text-white' : 'border-white/10 text-slate-400 hover:text-white'}`;

        const dateWrap = document.getElementById('styleDateWrap');
        const wdWrap = document.getElementById('styleWeekdayWrap');
        if (dateWrap) dateWrap.classList.toggle('hidden', !isDate);
        if (wdWrap) wdWrap.classList.toggle('hidden', isDate);
    }

    function setStyleAlign(align) {
        if (!['left', 'center', 'right'].includes(align)) return;
        styleState.align = align;
        saveStyleState();
        applyStyleUi();
        renderStyleDates();
        renderStyleWeekdays();
        renderTable();
    }

    function setStyleMode(mode) {
        styleState.mode = mode === 'weekday' ? 'weekday' : 'date';
        saveStyleState();
        applyStyleUi();
    }

    function renderStyleDates() {
        const list = document.getElementById('styleDateList');
        const monthInput = document.getElementById('styleMonth');
        if (!list || !monthInput) return;

        const monthKey = monthInput.value || monthKeyOf(new Date());
        const parts = monthKey.split('-');
        const y = parseInt(parts[0], 10);
        const m = parseInt(parts[1], 10);
        if (!y || !m) { list.innerHTML = ''; return; }

        const last = new Date(y, m, 0).getDate();
        let html = '';
        for (let day = 1; day <= last; day++) {
            const dt = new Date(y, m - 1, day);
            const iso = isoFromDate(dt);
            const assigned = styleState.dates[iso] || '';
            const checked = assigned === styleState.align;
            html += `<label class="flex items-center gap-2 px-2 py-1.5 rounded-lg bg-slate-800/40 border border-white/5 text-xs cursor-pointer hover:bg-slate-800/70 transition-colors">
                <input type="checkbox" ${checked ? 'checked' : ''} onchange="toggleStyleDate('${iso}', this.checked)" class="accent-blue-500">
                <span>${dt.toLocaleDateString('en-US', { month: 'short', day: '2-digit' })}</span>
                <span class="ml-auto text-[9px] uppercase font-bold opacity-50">${assigned ? assigned.charAt(0) : dt.toLocaleDateString('en-US', { weekday: 'short' })}</span>
            </label>`;
        }
        list.innerHTML = html;
    }

    function toggleStyleDate(iso, checked) {
        if (checked) styleState.dates[iso] = styleState.align;
        else if (styleState.dates[iso] === styleState.align) delete styleState.dates[iso];
        saveStyleState();
        renderStyleDates();
        renderTable();
    }

    function renderStyleWeekdays() {
        const list = document.getElementById('styleWeekdayList');
        if (!list) return;

        const order = [1, 2, 3, 4, 5, 6, 0];
        let html = '';
        order.forEach(wd => {
            const name = new Date(2024, 0, 7 + wd).toLocaleDateString('en-US', { weekday: 'long' });
            const assigned = styleState.weekdays[String(wd)] || '';
            const checked = assigned === styleState.align;
            html += `<label class="flex items-center gap-2 px-2 py-2 rounded-lg bg-slate-800/40 border border-white/5 text-xs cursor-pointer hover:bg-slate-800/70 transition-colors">
                <input type="checkbox" ${checked ? 'checked' : ''} onchange="toggleStyleWeekday('${wd}', this.checked)" class="accent-blue-500">
                <span>${name}</span>
                <span class="ml-auto text-[9px] uppercase font-bold opacity-50">${assigned || ''}</span>
            </label>`;
        });
        list.innerHTML = html;
    }

    function toggleStyleWeekday(wd, checked) {
        if (checked) styleState.weekdays[String(wd)] = styleState.align;
        else if (styleState.weekdays[String(wd)] === styleState.align) delete styleState.weekdays[String(wd)];
        saveStyleState();
        renderStyleWeekdays();
        renderTable();
    }

    // Specific date assignment wins over the repeating weekday assignment.
    function resolveAlignForDate(dateValue) {
        const d = new Date(dateValue);
        if (!isNaN(d.getTime())) {
            const iso = isoFromDate(d);
            if (styleState.dates[iso]) return styleState.dates[iso];
            const wd = styleState.weekdays[String(d.getDay())];
            if (wd) return wd;
        }
        return 'left';
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
            const summaryData = Array.from(blocks).map((block, index) => {
                const dateValue = block.querySelector('.d-date').value || "No Date";
                const parsed = new Date(dateValue);
                return {
                    date: dateValue,
                    weekday: isNaN(parsed.getTime()) ? '' : parsed.toLocaleDateString('en-US', { weekday: 'long' }),
                    tasks: block.querySelectorAll('.task-row').length,
                    index: index
                };
            });

            container.setAttribute('data-original-html', container.innerHTML);
            container.innerHTML = summaryData.map(data => `
                <div onclick="jumpToDate(${data.index})" class="bg-slate-900/80 border border-blue-500/30 p-6 rounded-2xl hover:border-blue-500 hover:bg-blue-500/10 transition-all cursor-pointer flex flex-col items-center justify-center text-center shadow-lg group">
                    <div class="text-blue-400 text-[10px] font-bold uppercase tracking-widest mb-1 group-hover:text-blue-300">Entry Date</div>
                    <div class="text-white font-bold text-lg">${data.date}</div>
                    ${data.weekday ? `<div class="text-blue-300 text-[10px] font-bold uppercase tracking-widest mt-1">${data.weekday}</div>` : ''}
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
    // 4. DAY & TASK ROW GENERATION
    // -----------------------------------------------------------------
    // MONTH FILTER (current month + 6 recent months / data months)
    // -----------------------------------------------------------------
    function monthKeyOf(dateObj) {
        return dateObj.getFullYear() + '-' + String(dateObj.getMonth() + 1).padStart(2, '0');
    }

    function monthLabel(key) {
        const parts = key.split('-');
        const d = new Date(parseInt(parts[0], 10), parseInt(parts[1], 10) - 1, 1);
        return d.toLocaleDateString('en-US', { month: 'long', year: 'numeric' });
    }

    function populateMonthFilter() {
        const select = document.getElementById('monthFilter');
        if (!select) return;

        const previous = select.value;
        const dataKeys = [];
        const keys = new Set();

        document.querySelectorAll('.day-block .d-date').forEach(input => {
            const d = new Date(input.value);
            if (!isNaN(d.getTime())) {
                const key = monthKeyOf(d);
                if (!keys.has(key)) dataKeys.push(key);
                keys.add(key);
            }
        });

        const now = new Date();
        for (let i = 0; i < 6; i++) {
            keys.add(monthKeyOf(new Date(now.getFullYear(), now.getMonth() - i, 1)));
        }

        const sorted = Array.from(keys).sort().reverse();
        select.innerHTML = sorted.map(k => `<option value="${k}">${monthLabel(k)}</option>`).join('');

        if (previous && keys.has(previous)) {
            select.value = previous;
        } else if (dataKeys.length > 0) {
            dataKeys.sort();
            select.value = dataKeys[dataKeys.length - 1];
        } else {
            select.value = monthKeyOf(now);
        }

        applyMonthFilter();
    }

    function applyMonthFilter() {
        const select = document.getElementById('monthFilter');
        const value = select ? select.value : '';

        document.querySelectorAll('.day-block').forEach(block => {
            const d = new Date(block.querySelector('.d-date').value);
            const key = isNaN(d.getTime()) ? '' : monthKeyOf(d);
            block.style.display = (!value || key === value) ? '' : 'none';
        });

        renderTable();
    }

    function createNewDay() {
        const filter = document.getElementById('monthFilter');
        const selectedMonth = filter ? filter.value : '';
        const visibleBlocks = Array.from(document.querySelectorAll('.day-block'))
            .filter(b => b.style.display !== 'none');

        let latestDate = null;
        visibleBlocks.forEach(block => {
            const input = block.querySelector('.d-date');
            const parsed = new Date(input.value);
            if (!isNaN(parsed.getTime()) && (!latestDate || parsed > latestDate)) {
                latestDate = parsed;
            }
        });

        let nextDate;
        if (latestDate) {
            latestDate.setDate(latestDate.getDate() + 1);
            nextDate = latestDate;
        } else if (selectedMonth) {
            const now = new Date();
            const parts = selectedMonth.split('-');
            const isCurrentMonth = now.getFullYear() === parseInt(parts[0], 10) && (now.getMonth() + 1) === parseInt(parts[1], 10);
            nextDate = isCurrentMonth ? now : new Date(parseInt(parts[0], 10), parseInt(parts[1], 10) - 1, 1);
        } else {
            nextDate = new Date();
        }

        addDay({
            date: nextDate.toLocaleDateString('en-US', { month: 'short', day: '2-digit', year: 'numeric' })
        });
    }

    function isWeekendDateValue(dateStr) {
        const d = new Date(dateStr);
        return !isNaN(d.getTime()) && (d.getDay() === 0 || d.getDay() === 6);
    }

    // Keep AM/PM exactly as saved. No automatic "4 hours" fallback, so an
    // intentionally empty value stays empty after reload and on the report.
    function normalizeDayTime(value) {
        return String(value == null ? '' : value).trim();
    }

    function applyDayTimeDefaults(block) {
        if (!block) return;
        const am = block.querySelector('.d-am');
        const pm = block.querySelector('.d-pm');
        if (am) am.value = normalizeDayTime(am.value);
        if (pm) pm.value = normalizeDayTime(pm.value);
    }

    function applyAllDayTimeDefaults() {
        document.querySelectorAll('.day-block').forEach(applyDayTimeDefaults);
    }

    function updateDayWeekday(input) {
        const block = input ? input.closest('.day-block') : null;
        if (!block) return;
        const label = block.querySelector('.day-weekday');
        if (!label) return;
        const d = new Date(input.value);
        label.textContent = isNaN(d.getTime())
            ? ''
            : d.toLocaleDateString('en-US', { weekday: 'long' });
    }

    function addDay(data = null) {
        const container = document.getElementById('inputs');
        const dayDiv = document.createElement('div');
        dayDiv.className = 'bg-slate-900/40 border border-white/5 rounded-3xl overflow-hidden neon-border-blue transition-all duration-500 hover:border-white/10 day-block relative';
        
        const defaultDate = (data && data.date) ? data.date : "";
        const tasks = (data && data.tasks) ? data.tasks : [""];
        const parsedDefaultDate = new Date(defaultDate);
        const isWeekend = !isNaN(parsedDefaultDate.getTime())
            && (parsedDefaultDate.getDay() === 0 || parsedDefaultDate.getDay() === 6);
        let dayAm = '';
        let dayPm = '';
        let dayRemarks = isWeekend ? '' : 'DONE';
        if (data) {
            if (Array.isArray(data.ams)) dayAm = normalizeDayTime(data.ams[0], isWeekend);
            else if (Array.isArray(data.durations)) dayAm = normalizeDayTime(data.durations[0], isWeekend);
            else if (data.am != null) dayAm = normalizeDayTime(data.am, isWeekend);

            if (Array.isArray(data.pms)) dayPm = normalizeDayTime(data.pms[0], isWeekend);
            else if (data.pm != null) dayPm = normalizeDayTime(data.pm, isWeekend);

            if (Array.isArray(data.remarks)) dayRemarks = data.remarks[0] ?? '';
            else if (data.remarks != null) dayRemarks = data.remarks;
        }

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
                        <div class="flex items-center justify-between gap-2 mb-1">
                            <label class="block text-[10px] uppercase font-bold text-blue-400 tracking-widest">Entry Date</label>
                            <span class="day-weekday text-[10px] uppercase font-bold text-blue-300 tracking-widest"></span>
                        </div>
                        <input type="text" class="d-date bg-transparent text-white font-bold border-none p-0 focus:ring-0 text-lg w-full" value="${defaultDate}" oninput="updateDayWeekday(this); handleInput()" onchange="applyDayTimeDefaults(this.closest('.day-block')); updateDayWeekday(this); handleInput()">
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
            <div class="day-meta grid grid-cols-1 sm:grid-cols-3 gap-3 mb-4 p-3 rounded-2xl bg-slate-800/30 border border-white/5">
                <div>
                    <label class="block text-[9px] uppercase font-bold text-blue-400 tracking-widest mb-1 text-center">AM</label>
                    <input type="text" list="history-times" placeholder="AM" 
                        class="d-am glass-input w-full px-4 py-2 rounded-xl text-sm text-center text-white placeholder-slate-500" oninput="handleInput()">
                </div>
                <div>
                    <label class="block text-[9px] uppercase font-bold text-blue-400 tracking-widest mb-1 text-center">PM</label>
                    <input type="text" list="history-times" placeholder="PM" 
                        class="d-pm glass-input w-full px-4 py-2 rounded-xl text-sm text-center text-white placeholder-slate-500" oninput="handleInput()">
                </div>
                <div>
                    <label class="block text-[9px] uppercase font-bold text-blue-400 tracking-widest mb-1 text-center">Remarks</label>
                    <input type="text" list="history-remarks" placeholder="Remarks" 
                        class="d-remarks glass-input w-full px-4 py-2 rounded-xl text-sm text-center text-white placeholder-slate-500" oninput="handleInput()">
                </div>
            </div>
            <div class="task-list space-y-4"></div>
            <button onclick="addTaskRow(this)" class="mt-4 text-sm font-bold text-blue-400 hover:text-blue-300 transition-colors flex items-center gap-2">
                <span class="flex items-center justify-center w-5 h-5 rounded-full border-2 border-blue-400 text-xs">+</span> Add Row
            </button>
        </div>
        `;

        const taskList = dayDiv.querySelector('.task-list');
        dayDiv.querySelector('.d-am').value = dayAm;
        dayDiv.querySelector('.d-pm').value = dayPm;
        dayDiv.querySelector('.d-remarks').value = dayRemarks;
        tasks.forEach(t => addTaskRowToElement(taskList, t));
        updateDayWeekday(dayDiv.querySelector('.d-date'));
        container.appendChild(dayDiv);
        handleInput();
        refreshOrderButtons();
    }

    function addTaskRowToElement(container, task = "") {
        const row = document.createElement('div');
        row.className = 'task-row flex flex-col md:flex-row gap-3 items-center bg-slate-800/40 p-3 rounded-2xl border border-white/5';

        row.innerHTML = `
            <div class="flex-1 w-full">
                <input type="text" list="history-tasks" placeholder="Activity / Task description..." value="${task}" 
                    class="t-desc glass-input w-full px-4 py-2 rounded-xl text-sm text-white placeholder-slate-500" oninput="handleInput()">
            </div>
            <button onclick="this.closest('.task-row').remove(); handleInput();" 
                class="text-slate-500 hover:text-red-400 p-2 transition-colors">✕</button>
        `;
        container.appendChild(row);
    }

    function addTaskRow(btn) {
        const taskList = btn.previousElementSibling;
        addTaskRowToElement(taskList, "");
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
            targetBlock.querySelector('.d-am').value = sourceBlock.querySelector('.d-am').value;
            targetBlock.querySelector('.d-pm').value = sourceBlock.querySelector('.d-pm').value;
            targetBlock.querySelector('.d-remarks').value = sourceBlock.querySelector('.d-remarks').value;
            sourceBlock.querySelectorAll('.task-row').forEach(row => {
                addTaskRowToElement(taskList, row.querySelector('.t-desc').value);
            });
            handleInput();
        }
    }

    // -----------------------------------------------------------------
    // 6. DB SAVE & LOAD (API INTEGRATION)
    // -----------------------------------------------------------------
    let saveQueue = Promise.resolve();

    // Serialize saves so overlapping requests never interleave DELETE/INSERT.
    function saveToDB(silent = false) {
        if (saveTimer) {
            clearTimeout(saveTimer);
            saveTimer = null;
        }
        saveQueue = saveQueue.then(() => performSave(silent)).catch(() => false);
        return saveQueue;
    }

    async function performSave(silent) {
        const data = [];
        document.querySelectorAll('.day-block').forEach(block => {
            const date = block.querySelector('.d-date').value;
            const start = block.querySelector('.d-am').value;
            const end = block.querySelector('.d-pm').value;
            const remarks = block.querySelector('.d-remarks').value;
            let hasRow = false;
            block.querySelectorAll('.task-row').forEach(row => {
                hasRow = true;
                data.push({
                    date: date,
                    desc: row.querySelector('.t-desc').value,
                    start: start,
                    end: end,
                    remarks: remarks
                });
            });
            // Keep standalone AM/PM/remarks edits (days without activities) in sync too.
            if (!hasRow && (date || start || end || remarks)) {
                data.push({
                    date: date,
                    desc: '',
                    start: start,
                    end: end,
                    remarks: remarks
                });
            }
        });
        try {
            const response = await fetch('api.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });
            const result = await response.json();
            if (result.status === "success" && !silent) notify("System Synced Successfully", "success");
            return result.status === "success";
        } catch (e) {
            if (!silent) notify("Network Error", "error");
            return false;
        }
    }

    async function loadFromDB() {
        // Flush any pending edits before pulling fresh data from the server.
        if (saveTimer) {
            clearTimeout(saveTimer);
            saveTimer = null;
            saveToDB(true);
        }
        await saveQueue.catch(() => {});

        isLoadingData = true;
        try {
            const response = await fetch('api.php');
            const savedData = await response.json();
            if (savedData && savedData.length > 0) {
                document.getElementById('inputs').innerHTML = '';

                // Group all rows with the same date together (not only consecutive
                // ones), so auto-generated/weekend rows never split a day into
                // duplicate blocks or hide its AM/PM values.
                const groupsByDate = new Map();
                savedData.forEach(curr => {
                    const key = curr.report_date;
                    if (!groupsByDate.has(key)) {
                        groupsByDate.set(key, { date: key, tasks: [], ams: [], pms: [], remarks: [] });
                    }
                    const group = groupsByDate.get(key);

                    group.tasks.push(curr.activity);

                    const am = normalizeDayTime(curr.start_time);
                    const pm = normalizeDayTime(curr.end_time);

                    group.ams.push(am);
                    group.pms.push(pm);
                    group.remarks.push(curr.remarks || "");
                });

                groupsByDate.forEach(group => {
                    addDay({
                        date: group.date,
                        tasks: group.tasks,
                        ams: group.ams,
                        pms: group.pms,
                        remarks: group.remarks
                    });
                });
            } else { 
                createNewDay(); 
            }
        } catch (e) { 
            createNewDay(); 
        }

        applyAllDayTimeDefaults();
        renderTable();
        updateCopyDropdowns();
        arrangeDayBlocksByDate();
        populateMonthFilter();
        isLoadingData = false;
    }

    // Arrange every day block by date number so the whole month is in order.
    function arrangeDayBlocksByDate() {
        const container = document.getElementById('inputs');
        if (!container) return;

        const parseBlockDate = block => {
            const input = block.querySelector('.d-date');
            const d = input ? new Date(input.value) : new Date(NaN);
            return isNaN(d.getTime()) ? null : d;
        };

        const blocks = Array.from(container.querySelectorAll('.day-block'));

        blocks.sort((a, b) => {
            const da = parseBlockDate(a);
            const db = parseBlockDate(b);
            if (da && db) return da - db;
            if (da) return -1;
            if (db) return 1;
            return 0;
        });

        blocks.forEach(block => container.appendChild(block));
    }

    // -----------------------------------------------------------------
    // 7. REPORT TABLE RENDERER (WITH PER-DAY TOTAL ROW)
    // -----------------------------------------------------------------
    function renderTable() {
        const output = document.getElementById('table-output');
        if (!output) return;
        output.innerHTML = '';
        
        const blocks = Array.from(document.querySelectorAll('.day-block'))
            .filter(block => block.style.display !== 'none');
        
        if (blocks.length > 0) {
            const dateInputs = blocks
                .map(block => new Date(block.querySelector('.d-date').value))
                .filter(d => !isNaN(d.getTime()));

            if (dateInputs.length > 0) {
                dateInputs.sort((a, b) => a - b);
                const firstDate = dateInputs[0];
                const lastDate = dateInputs[dateInputs.length - 1];
                const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                const startMonth = monthNames[firstDate.getMonth()];
                const endMonth = monthNames[lastDate.getMonth()];
                const startYear = firstDate.getFullYear();
                const endYear = lastDate.getFullYear();
                const startDay = String(firstDate.getDate()).padStart(2, '0');
                const endDay = String(lastDate.getDate()).padStart(2, '0');

                const printPeriod = document.getElementById('print-period');
                if (printPeriod) {
                    printPeriod.textContent = `${startMonth} ${startDay}, ${startYear} - ${endMonth} ${endDay}, ${endYear}`;
                }
            }
        }

        blocks.forEach(block => {
            const dateValue = block.querySelector('.d-date').value;
            const taskRows = Array.from(block.querySelectorAll('.task-row'));
            if (taskRows.length === 0) return;

            const rowAlign = resolveAlignForDate(dateValue);
            const liStyle = rowAlign === 'left' ? '' : ' style="padding-left:0;text-indent:0;"';

            // Print exactly what is in the form (no hidden defaults) so the
            // report always matches the AM/PM values shown on screen.
            const am = block.querySelector('.d-am').value.trim();
            const pm = block.querySelector('.d-pm').value.trim();
            const remark = block.querySelector('.d-remarks').value.trim();

            // Empty days (no AM, PM, or remarks) are plain labels like "Sunday".
            // When Style is set to center/right, the bullet is removed too.
            const noBullet = (rowAlign !== 'left') || (!am && !pm && !remark);
            const tasksHtml = taskRows.map(row => {
                const desc = row.querySelector('.t-desc').value.trim();
                return `<li${liStyle}>${noBullet ? '' : '• '}${escapeHtml(desc)}</li>`;
            }).join('');

            const timeRowsHtml = `<tr>
                <td style="width:50%;border:none !important;text-align:center;vertical-align:middle;padding:2px 3px !important;">${escapeHtml(am)}</td>
                <td style="width:50%;border:none !important;text-align:center;vertical-align:middle;padding:2px 3px !important;">${escapeHtml(pm)}</td>
            </tr>`;
            const remarksHtml = `<div class="print-remark-line">${remark ? escapeHtml(remark) : '&nbsp;'}</div>`;

            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td class="col-date text-center font-bold">${escapeHtml(dateValue)}</td>
                <td class="col-task" style="text-align:${rowAlign};"><ul class="print-task-list">${tasksHtml}</ul></td>
                <td class="col-time text-center" style="padding:0 !important;position:relative;">
                    <div style="position:absolute;left:50%;top:0;bottom:0;width:0;border-left:2px solid #000;"></div>
                    <table style="width:100%;height:100%;border-collapse:collapse;table-layout:fixed;">
                        ${timeRowsHtml}
                    </table>
                </td>
                <td class="col-rem text-center"><div class="print-remark-list">${remarksHtml}</div></td>
            `;
            output.appendChild(tr);
        });
    }

    // -----------------------------------------------------------------
    // 7b. EXPORT REPORT AS MICROSOFT WORD (.doc)
    // -----------------------------------------------------------------
    function imageToDataURL(src) {
        return fetch(src, { cache: 'force-cache' })
            .then(res => res.blob())
            .then(blob => new Promise((resolve, reject) => {
                const reader = new FileReader();
                reader.onload = () => resolve(reader.result);
                reader.onerror = reject;
                reader.readAsDataURL(blob);
            }))
            .catch(() => src);
    }

    async function exportToWord() {
        const btn = document.getElementById('exportWordBtn');
        if (btn) btn.disabled = true;

        try {
            renderTable();

            const preview = document.getElementById('report-preview');
            if (!preview) return;

            const clone = preview.cloneNode(true);

            const headerData = await imageToDataURL('header.png');
            const footerData = await imageToDataURL('footer.png');

            const outerThead = clone.querySelector(':scope > thead');
            if (outerThead) outerThead.remove();
            const outerTfoot = clone.querySelector(':scope > tfoot');
            if (outerTfoot) outerTfoot.remove();

            clone.querySelectorAll('.signatory-section > .flex').forEach(row => {
                const cols = Array.from(row.children);
                const tbl = document.createElement('table');
                tbl.setAttribute('width', '100%');
                tbl.setAttribute('style', 'width:100%;border-collapse:collapse;margin-bottom:24px;');
                const tr = document.createElement('tr');
                cols.forEach(col => {
                    const td = document.createElement('td');
                    td.setAttribute('width', '50%');
                    td.setAttribute('style', 'width:50%;text-align:center;vertical-align:top;padding:0 10px;');
                    td.innerHTML = col.innerHTML;
                    tr.appendChild(td);
                });
                tbl.appendChild(tr);
                row.replaceWith(tbl);
            });

            const contentCell = clone.querySelector('tbody > tr > td');
            const reportContent = contentCell ? contentCell.innerHTML : clone.innerHTML;

            const periodEl = clone.querySelector('#print-period');
            const periodText = periodEl ? periodEl.textContent.trim() : '';
            const fileLabel = periodText.replace(/[^A-Za-z0-9]+/g, '_').replace(/^_+|_+$/g, '') || 'Report';

            const wordStyles = `
                @page WordSection1 {
                    size: 8.5in 11in;
                    margin: 2.15in 0.4in 0.98in 0.4in;
                    mso-header-margin: 0.4in;
                    mso-footer-margin: 0.35in;
                    mso-header: h1;
                    mso-footer: f1;
                }
                div.WordSection1 { page: WordSection1; }
                body { font-family: Arial, Helvetica, sans-serif; font-size: 10pt; color: #000; }
                p.MsoHeader, p.MsoFooter { margin: 0; padding: 0; }
                table { border-collapse: collapse; }
                .styled-table { width: 100%; border-collapse: collapse; table-layout: fixed; border: 1pt solid #000; margin-top: 5px; }
                .styled-table th { background-color: #f2f2f2; border: 1pt solid #000; padding: 4px 2px; font-size: 9pt; font-weight: bold; text-align: center; text-transform: uppercase; }
                .styled-table td { border: 1pt solid #000; padding: 2px 4px; vertical-align: middle; line-height: 1.15; }
                .styled-table td table td { border: 1pt solid #000; }
                .col-date { text-align: center; font-weight: bold; width: 12%; font-size: 8.5pt; }
                .col-task { text-align: left; width: 50%; }
                .col-time { text-align: center; width: 23%; font-size: 8.5pt; }
                .col-rem { text-align: center; font-weight: bold; width: 15%; font-size: 8.5pt; }
                .print-task-list { list-style: none; margin: 0; padding: 0; }
                .print-task-list li { padding-left: 12px; text-indent: -12px; }
                .print-remark-list { display: block; }
                .print-remark-line { line-height: 1.15; }
                .text-center { text-align: center; }
                .text-left { text-align: left; }
                .font-bold { font-weight: bold; }
                .underline { text-decoration: underline; }
                .inline-block { display: inline-block; }
                .border-b { border-bottom: 1pt solid #000; }
                .mt-1 { margin-top: 4px; }
                .mt-4 { margin-top: 12px; }
                .mt-10 { margin-top: 24px; }
                .mt-12 { margin-top: 28px; }
                .mb-4 { margin-bottom: 12px; }
                .mb-10 { margin-bottom: 24px; }
                .mb-12 { margin-bottom: 28px; }
                .mb-14 { margin-bottom: 40px; }
                .p-2 { padding: 6px; }
                .signatory-section { page-break-inside: avoid; }
                .signatory-section td { page-break-inside: avoid; }
            `;

            const html = `<!DOCTYPE html>
<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:w="urn:schemas-microsoft-com:office:word" xmlns="http://www.w3.org/TR/REC-html40">
<head>
<meta charset="utf-8">
<title>Accomplishment Report</title>
<!--[if gte mso 9]><xml><w:WordDocument><w:View>Print</w:View><w:Zoom>100</w:Zoom></w:WordDocument></xml><![endif]-->
<style>${wordStyles}</style>
</head>
<body>
<div class="WordSection1">
${reportContent}
</div>
<div style="mso-element:header" id="h1">
<p class="MsoHeader" style="margin:0;text-align:center;"><img src="${headerData}" style="width:7.7in;height:1.75in;" alt="Header"></p>
</div>
<div style="mso-element:footer" id="f1">
<p class="MsoFooter" style="margin:0;text-align:center;"><img src="${footerData}" style="width:7.7in;height:0.63in;" alt="Footer"></p>
</div>
</body>
</html>`;

            const blob = new Blob(['\ufeff', html], { type: 'application/msword' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = `Accomplishment_Report_${fileLabel}.doc`;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            setTimeout(() => URL.revokeObjectURL(url), 1000);

            notify('Word document downloaded', 'success');
        } catch (e) {
            notify('Could not export Word document', 'error');
        } finally {
            if (btn) btn.disabled = false;
        }
    }

    // -----------------------------------------------------------------
    // 8. SETTINGS: AUTO DAILY TASKS + COPY FROM OTHER USERS
    // -----------------------------------------------------------------
    function escapeHtml(value) {
        return String(value === null || value === undefined ? '' : value)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#39;');
    }

    function escapeAttr(value) {
        return escapeHtml(value);
    }

    function toggleSettingsSection(btn) {
        if (!btn) return;
        const body = btn.nextElementSibling;
        if (!body) return;
        const expanded = btn.getAttribute('aria-expanded') === 'true';
        btn.setAttribute('aria-expanded', String(!expanded));
        body.classList.toggle('hidden', expanded);
    }

    function collapseSettingsSections() {
        document.querySelectorAll('#settingsModal .settings-section-toggle').forEach(btn => {
            btn.setAttribute('aria-expanded', 'false');
            const body = btn.nextElementSibling;
            if (body) body.classList.add('hidden');
        });
    }

    function openSettings() {
        const menu = document.getElementById('profileMenu');
        if (menu) menu.classList.add('hidden');

        const modal = document.getElementById('settingsModal');
        if (!modal) return;
        modal.classList.remove('hidden');
        collapseSettingsSections();

        const now = new Date();
        document.getElementById('copyDate').value = now.getFullYear() + '-' +
            String(now.getMonth() + 1).padStart(2, '0') + '-' +
            String(now.getDate()).padStart(2, '0');
        document.getElementById('copyMonth').value = monthKeyOf(now);

        const styleMonth = document.getElementById('styleMonth');
        const monthFilter = document.getElementById('monthFilter');
        if (styleMonth) styleMonth.value = (monthFilter && monthFilter.value) ? monthFilter.value : monthKeyOf(now);
        const genMonth = document.getElementById('genMonth');
        if (genMonth) genMonth.value = (monthFilter && monthFilter.value) ? monthFilter.value : monthKeyOf(now);
        applyStyleUi();
        renderStyleDates();
        renderStyleWeekdays();

        loadAccount();
        loadSettings();
        fillCopyUsers();
    }

    async function loadAccount() {
        try {
            const r = await fetch('app_api.php?action=get_account');
            const data = await r.json();
            if (data.status !== 'ok' || !data.account) return;

            const a = data.account;
            const set = (id, value) => {
                const el = document.getElementById(id);
                if (el) el.value = value || '';
            };
            set('acctEmployeeName', a.employee_name);
            set('acctUsername', a.username);
            set('acctStaffName', a.staff_name);
            set('acctStaffPosition', a.staff_position);
            set('acctHeadName', a.head_name);
            set('acctHeadTitle', a.head_title);
            set('acctAdminName', a.administrative_name);
            set('acctAdminTitle', a.administrative_title);
            set('acctDepartment', a.department);
            set('acctPassword', '');
        } catch (e) {}
    }

    async function saveAccount() {
        const val = id => {
            const el = document.getElementById(id);
            return el ? el.value.trim() : '';
        };

        const payload = {
            employee_name: val('acctEmployeeName'),
            username: val('acctUsername'),
            password: document.getElementById('acctPassword') ? document.getElementById('acctPassword').value : '',
            staff_name: val('acctStaffName'),
            staff_position: val('acctStaffPosition'),
            head_name: val('acctHeadName'),
            head_title: val('acctHeadTitle'),
            administrative_name: val('acctAdminName'),
            administrative_title: val('acctAdminTitle'),
            department: val('acctDepartment')
        };

        if (!payload.employee_name || !payload.username) {
            notify('Name and username are required', 'error');
            return;
        }

        try {
            const r = await fetch('app_api.php?action=update_account', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload)
            });
            const data = await r.json();
            if (data.status === 'ok') {
                notify('Account updated', 'success');
                setTimeout(() => window.location.reload(), 700);
            } else {
                notify(data.message || 'Could not update account', 'error');
            }
        } catch (e) {
            notify('Network error', 'error');
        }
    }

    function closeSettings() {
        const modal = document.getElementById('settingsModal');
        if (modal) modal.classList.add('hidden');
    }

    async function loadSettings() {
        const host = document.getElementById('recentTasksList');
        try {
            const r = await fetch('app_api.php?action=settings');
            const data = await r.json();

            const seen = new Set();
            recentTaskState = [];

            (data.recent || []).forEach(item => {
                if (!item.activity || seen.has(item.activity)) return;
                seen.add(item.activity);
                const tpl = (data.templates || []).find(t => t.activity === item.activity);
                recentTaskState.push({
                    activity: item.activity,
                    start_time: tpl ? (tpl.start_time || '') : (item.start_time || ''),
                    end_time: tpl ? (tpl.end_time || '') : (item.end_time || ''),
                    remarks: tpl ? (tpl.remarks || 'DONE') : (item.remarks || 'DONE'),
                    enabled: !!tpl
                });
            });

            (data.templates || []).forEach(tpl => {
                if (seen.has(tpl.activity)) return;
                seen.add(tpl.activity);
                recentTaskState.push({
                    activity: tpl.activity,
                    start_time: tpl.start_time || '',
                    end_time: tpl.end_time || '',
                    remarks: tpl.remarks || 'DONE',
                    enabled: true
                });
            });

            renderRecentTasks();
            applyGenerationSettings(data.settings || {});
        } catch (e) {
            host.innerHTML = '<p class="text-sm text-red-400">Unable to load settings.</p>';
        }
    }

    function renderRecentTasks() {
        const host = document.getElementById('recentTasksList');
        if (!recentTaskState.length) {
            host.innerHTML = '<p class="text-sm opacity-60">No recent tasks yet. Add a task first.</p>';
            return;
        }

        host.innerHTML = recentTaskState.map((item, index) => `
            <label class="template-item">
                <input type="checkbox" ${item.enabled ? 'checked' : ''} onchange="toggleTemplate(${index}, this.checked)">
                <span class="flex-1 min-w-0">
                    <span class="block text-xs font-semibold truncate">${escapeHtml(item.activity)}</span>
                    <span class="block text-[10px] opacity-60">${escapeHtml(item.start_time || '')} | ${escapeHtml(item.end_time || '')} · ${escapeHtml(item.remarks || '')}</span>
                </span>
            </label>
        `).join('');
    }

    function toggleTemplate(index, checked) {
        if (!recentTaskState[index]) return;
        recentTaskState[index].enabled = checked;
        saveTemplates();
    }

    async function saveTemplates() {
        const templates = recentTaskState
            .filter(t => t.enabled)
            .map(t => ({
                activity: t.activity,
                start_time: t.start_time,
                end_time: t.end_time,
                remarks: t.remarks
            }));

        const monthFilter = document.getElementById('monthFilter');
        const month = monthFilter && monthFilter.value ? monthFilter.value : '';

        try {
            const r = await fetch('app_api.php?action=save_templates', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ templates, month })
            });
            const data = await r.json();
            if (data.status === 'ok') {
                notify('Auto-task settings saved', 'success');
                if (data.generated > 0) {
                    await loadFromDB();
                }
            } else {
                notify(data.message || 'Could not save settings', 'error');
            }
        } catch (e) {
            notify('Network error', 'error');
        }
    }

    function applyGenerationSettings(settings) {
        generationSettings = {
            generate_all_month: settings && settings.generate_all_month ? 1 : 0,
            include_saturday: settings && settings.include_saturday ? 1 : 0,
            include_sunday: settings && settings.include_sunday ? 1 : 0
        };

        const all = document.getElementById('genAllMonth');
        if (all) all.checked = !!generationSettings.generate_all_month;
        const sat = document.getElementById('genIncludeSaturday');
        if (sat) sat.checked = !!generationSettings.include_saturday;
        const sun = document.getElementById('genIncludeSunday');
        if (sun) sun.checked = !!generationSettings.include_sunday;

        const monthEl = document.getElementById('genMonth');
        if (monthEl && !monthEl.value) {
            const mf = document.getElementById('monthFilter');
            monthEl.value = (mf && mf.value) ? mf.value : monthKeyOf(new Date());
        }
    }

    async function saveGenerationSettings() {
        const all = document.getElementById('genAllMonth');
        const sat = document.getElementById('genIncludeSaturday');
        const sun = document.getElementById('genIncludeSunday');
        const monthEl = document.getElementById('genMonth');
        const monthFilter = document.getElementById('monthFilter');
        const month = (monthEl && monthEl.value)
            || (monthFilter && monthFilter.value)
            || monthKeyOf(new Date());

        const payload = {
            generate_all_month: !!(all && all.checked),
            include_saturday: !!(sat && sat.checked),
            include_sunday: !!(sun && sun.checked),
            month
        };

        try {
            const r = await fetch('app_api.php?action=save_generation', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload)
            });
            const data = await r.json();
            if (data.status === 'ok') {
                applyGenerationSettings(data.settings || payload);
                if (data.generated > 0) {
                    notify(data.generated + ' task(s) generated for ' + month, 'success');
                    await loadFromDB();
                } else {
                    notify('Generation settings saved', 'success');
                }
            } else {
                notify(data.message || 'Could not save settings', 'error');
            }
        } catch (e) {
            notify('Network error', 'error');
        }
    }

    function toggleCopyMode() {
        const mode = document.getElementById('copyMode').value;
        document.getElementById('copyDateWrap').classList.toggle('hidden', mode === 'month');
        document.getElementById('copyMonthWrap').classList.toggle('hidden', mode !== 'month');
    }

    async function fetchUsers(force) {
        if (allUsers.length && !force) return allUsers;
        try {
            const r = await fetch('app_api.php?action=users');
            const data = await r.json();
            allUsers = data.users || [];
        } catch (e) {
            allUsers = [];
        }
        return allUsers;
    }

    async function fillCopyUsers() {
        const select = document.getElementById('copyUser');
        if (!select) return;
        const users = await fetchUsers();
        const previous = select.value;
        select.innerHTML = '<option value="">Select user...</option>' + users
            .filter(u => u.username !== CURRENT_USER)
            .map(u => `<option value="${escapeAttr(u.username)}">${escapeHtml(u.employee_name || u.username)}</option>`)
            .join('');
        if (previous) select.value = previous;
    }

    function mergeTasksIntoDay(dateStr, tasks) {
        const target = Array.from(document.querySelectorAll('.day-block')).find(block =>
            block.querySelector('.d-date').value.trim().toLowerCase() === String(dateStr).trim().toLowerCase()
        );

        const targetDate = new Date(dateStr);
        const targetWeekend = !isNaN(targetDate.getTime())
            && (targetDate.getDay() === 0 || targetDate.getDay() === 6);

        const first = tasks[0] || {};
        const sourceAm = normalizeDayTime(first.start, targetWeekend);
        const sourcePm = normalizeDayTime(first.end, targetWeekend);
        if (!target) {
            addDay({
                date: dateStr,
                tasks: tasks.map(t => t.desc || ''),
                am: sourceAm,
                pm: sourcePm,
                remarks: first.remarks || 'DONE'
            });
            return;
        }

        const setIfEmpty = (selector, value) => {
            const el = target.querySelector(selector);
            if (el && !el.value.trim() && value) el.value = value;
        };
        setIfEmpty('.d-am', sourceAm);
        setIfEmpty('.d-pm', sourcePm);
        setIfEmpty('.d-remarks', first.remarks || 'DONE');

        const taskList = target.querySelector('.task-list');
        tasks.forEach(t => {
            addTaskRowToElement(taskList, t.desc || '');
        });
        handleInput();
    }

    async function copyFromUser() {
        const username = document.getElementById('copyUser').value;
        const mode = document.getElementById('copyMode').value;

        if (!username) {
            notify('Please select a user', 'error');
            return;
        }

        const payload = { username, mode };
        if (mode === 'month') {
            payload.month = document.getElementById('copyMonth').value;
            if (!payload.month) {
                notify('Please select a month', 'error');
                return;
            }
        } else {
            payload.date = document.getElementById('copyDate').value;
            if (!payload.date) {
                notify('Please select a date', 'error');
                return;
            }
        }

        try {
            const r = await fetch('app_api.php?action=copy_from_user', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload)
            });
            const data = await r.json();

            if (data.status !== 'ok') {
                notify(data.message || 'Copy failed', 'error');
                return;
            }

            let total = 0;
            (data.groups || []).forEach(group => {
                mergeTasksIntoDay(group.date, group.tasks || []);
                total += (group.tasks || []).length;
            });

            if (total === 0) {
                notify('No tasks found for that selection', 'error');
                return;
            }

            await saveToDB();
            populateMonthFilter();
            closeSettings();
            notify(total + ' task(s) copied', 'success');
        } catch (e) {
            notify('Network error', 'error');
        }
    }

    // -----------------------------------------------------------------
    // 9. CHAT (EVERYONE + PRIVATE) WITH ONLINE STATUS
    // -----------------------------------------------------------------
    function isOnline(lastSeen) {
        if (!lastSeen) return false;
        const d = new Date(String(lastSeen).replace(' ', 'T'));
        if (isNaN(d.getTime())) return false;
        const diff = Date.now() - d.getTime();
        return diff < 120000 && diff > -300000;
    }

    function formatLastSeen(lastSeen) {
        if (!lastSeen) return 'Offline';
        const d = new Date(String(lastSeen).replace(' ', 'T'));
        if (isNaN(d.getTime())) return 'Offline';

        let diff = Date.now() - d.getTime();
        if (diff < 0) diff = 0;

        const mins = Math.floor(diff / 60000);
        if (mins < 1) return 'Just now';
        if (mins < 60) return mins + ' min ago';

        const hours = Math.floor(mins / 60);
        if (hours < 24) return hours + ' hour' + (hours > 1 ? 's' : '') + ' ago';

        const days = Math.floor(hours / 24);
        if (days < 30) return days + ' day' + (days > 1 ? 's' : '') + ' ago';

        const months = Math.floor(days / 30);
        return months + ' month' + (months > 1 ? 's' : '') + ' ago';
    }

    function formatClock(value) {
        const d = new Date(String(value).replace(' ', 'T'));
        if (isNaN(d.getTime())) return '';
        return d.toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit' });
    }

    async function openChat() {
        const panel = document.getElementById('chatPanel');
        if (!panel) return;
        panel.classList.remove('hidden');

        await fetchUsers(true);
        renderChatUsers();
        await selectChat(activeChat, null);

        if (chatPollTimer) clearInterval(chatPollTimer);
        chatPollTimer = setInterval(async () => {
            if (panel.classList.contains('hidden')) return;
            await fetchUsers(true);
            renderChatUsers();
            await loadChatMessages();
        }, 5000);
    }

    function closeChat() {
        const panel = document.getElementById('chatPanel');
        if (panel) panel.classList.add('hidden');
        if (chatPollTimer) {
            clearInterval(chatPollTimer);
            chatPollTimer = null;
        }
    }

    function renderChatUsers() {
        const host = document.getElementById('chatUserList');
        if (!host) return;

        const entries = [{ username: '', employee_name: 'Everyone', group: true }]
            .concat(allUsers.filter(u => u.username !== CURRENT_USER));

        host.innerHTML = entries.map(u => {
            const online = u.group ? false : isOnline(u.last_seen);
            const status = u.group ? 'Group conversation' : (online ? 'Online' : formatLastSeen(u.last_seen));
            const active = (activeChat || '') === (u.username || '');
            return `
                <div class="chat-user ${active ? 'active' : ''}" data-username="${escapeAttr(u.username)}" data-name="${escapeAttr(u.employee_name || u.username)}">
                    <span class="status-dot ${online ? 'online' : ''}" ${u.group ? 'style="display:none"' : ''}></span>
                    <div class="chat-user-info">
                        <p class="text-xs font-semibold">${escapeHtml(u.employee_name || u.username)}</p>
                        <p class="text-[10px] opacity-60">${escapeHtml(status)}</p>
                    </div>
                </div>
            `;
        }).join('');

        host.querySelectorAll('.chat-user').forEach(el => {
            el.addEventListener('click', () => selectChat(el.dataset.username, el.dataset.name));
        });
    }

    async function selectChat(username, label) {
        activeChat = username || '';
        const header = document.getElementById('chatHeaderStatus');
        if (header) {
            header.textContent = activeChat === '' ? 'Everyone' : (label || activeChat);
        }
        renderChatUsers();
        await loadChatMessages();
    }

    async function loadChatMessages() {
        const box = document.getElementById('chatMessages');
        if (!box) return;

        try {
            const r = await fetch('app_api.php?action=messages&with=' + encodeURIComponent(activeChat));
            const data = await r.json();
            const messages = data.messages || [];

            if (!messages.length) {
                box.innerHTML = '<p class="text-xs opacity-50 text-center mt-4">No messages yet. Say hello!</p>';
                return;
            }

            box.innerHTML = messages.map(m => {
                const mine = !!m.mine;
                const name = mine ? 'You' : (m.employee_name || m.username);
                return `
                    <div class="msg ${mine ? 'mine' : 'other'}">
                        <div>${escapeHtml(m.message)}</div>
                        <div class="msg-meta">${escapeHtml(name)} · ${formatClock(m.created_at)}</div>
                    </div>
                `;
            }).join('');

            box.scrollTop = box.scrollHeight;
        } catch (e) {
            box.innerHTML = '<p class="text-xs text-red-400 text-center mt-4">Unable to load messages.</p>';
        }
    }

    async function sendChat(event) {
        event.preventDefault();
        const input = document.getElementById('chatInput');
        const text = input.value.trim();
        if (!text) return;

        input.value = '';

        try {
            await fetch('app_api.php?action=send_message', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ message: text, recipient: activeChat })
            });
            await loadChatMessages();
        } catch (e) {
            notify('Network error', 'error');
        }
    }
</script>


</body>
</html>