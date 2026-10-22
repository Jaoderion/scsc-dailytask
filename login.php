<?php

session_start();
$conn = new mysqli("localhost", "root", "", "krc_system");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // Updated Query to fetch all signatory details
    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($pass, $row['password'])) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['employee_name'] = $row['employee_name'];
            $_SESSION['staff_name'] = $row['staff_name'];
            
            // Store Signatories in Session
            $_SESSION['staff_position'] = $row['staff_position'];
            $_SESSION['head_name'] = $row['head_name'];
            $_SESSION['head_title'] = $row['head_title'];
            $_SESSION['admin_name'] = $row['administrative_name'];
            $_SESSION['admin_title'] = $row['administrative_title'];
            $_SESSION['department'] = $row['department'];

            header("Location: index.php"); 
            exit();
        } else {
            $error = "Access Denied: Invalid Credentials";
        }
    } else {
        $error = "Access Denied: Invalid Credentials";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | KRC Dailytask Tracker</title>
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
        :root {
            --glass: rgba(255, 255, 255, 0.055);
            --glass-strong: rgba(255, 255, 255, 0.09);
            --stroke: rgba(255, 255, 255, 0.10);
            --mx: 50%;
            --my: 50%;
        }

        * { -webkit-tap-highlight-color: transparent; }

        body { 
            font-family: 'Outfit', sans-serif; 
            background-color: #070b16;
            color: #e2e8f0;
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
        }

        /* ============ AMBIENT BACKDROP ============ */
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
            opacity: 0.55;
            will-change: transform;
        }

        .orb-1 {
            width: 560px; height: 560px;
            top: -180px; left: -140px;
            background: radial-gradient(circle at 30% 30%, #3b82f6, #1e40af 55%, transparent 72%);
            animation: drift-a 22s ease-in-out infinite;
        }

        .orb-2 {
            width: 520px; height: 520px;
            bottom: -200px; right: -120px;
            background: radial-gradient(circle at 60% 40%, #06b6d4, #0e7490 55%, transparent 72%);
            animation: drift-b 26s ease-in-out infinite;
        }

        .orb-3 {
            width: 380px; height: 380px;
            top: 42%; left: 58%;
            background: radial-gradient(circle at 50% 50%, #a855f7, #4c1d95 60%, transparent 74%);
            opacity: 0.32;
            animation: drift-c 30s ease-in-out infinite;
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

        /* Fine grid + noise for depth */
        .grid-overlay {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.035) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.035) 1px, transparent 1px);
            background-size: 58px 58px;
            mask-image: radial-gradient(ellipse at 50% 40%, #000 10%, transparent 72%);
            -webkit-mask-image: radial-gradient(ellipse at 50% 40%, #000 10%, transparent 72%);
        }

        .noise {
            position: absolute;
            inset: 0;
            opacity: 0.16;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='160' height='160'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='3'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.5'/%3E%3C/svg%3E");
        }

        /* ============ FLOATING PARTICLES ============ */
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
            100% { transform: translateY(-560px) scale(1.1); opacity: 0; }
        }

        /* ============ GLASS CARD ============ */
        .glass-card {
            position: relative;
            background: linear-gradient(145deg, rgba(255,255,255,0.085), rgba(255,255,255,0.02));
            backdrop-filter: blur(26px) saturate(160%);
            -webkit-backdrop-filter: blur(26px) saturate(160%);
            border: 1px solid var(--stroke);
            box-shadow:
                0 30px 70px -20px rgba(0, 0, 0, 0.75),
                0 0 60px -20px rgba(59, 130, 246, 0.35),
                inset 0 1px 0 rgba(255, 255, 255, 0.14);
            transition: transform 0.5s cubic-bezier(.2,.8,.2,1), box-shadow 0.5s ease, border-color 0.5s ease;
        }

        /* Mouse-follow spotlight */
        .glass-card::before {
            content: "";
            position: absolute;
            inset: 0;
            border-radius: inherit;
            background: radial-gradient(340px circle at var(--mx) var(--my), rgba(96, 165, 250, 0.18), transparent 62%);
            opacity: 0;
            transition: opacity 0.4s ease;
            pointer-events: none;
        }

        /* Top light sweep */
        .glass-card::after {
            content: "";
            position: absolute;
            top: -1px; left: -60%;
            width: 55%; height: 100%;
            background: linear-gradient(100deg, transparent, rgba(255,255,255,0.14), transparent);
            transform: skewX(-18deg);
            transition: left 0.9s cubic-bezier(.2,.8,.2,1);
            pointer-events: none;
        }

        .glass-card:hover {
            transform: translateY(-6px);
            border-color: rgba(147, 197, 253, 0.28);
            box-shadow:
                0 40px 90px -22px rgba(0, 0, 0, 0.8),
                0 0 80px -18px rgba(59, 130, 246, 0.5),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
        }

        .glass-card:hover::before { opacity: 1; }
        .glass-card:hover::after { left: 125%; }

        /* ============ LOGO MEDALLION ============ */
        .logo-medallion {
            position: relative;
            width: 104px;
            height: 104px;
            border-radius: 9999px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: radial-gradient(circle at 30% 25%, rgba(255,255,255,0.18), rgba(255,255,255,0.03));
            border: 1px solid rgba(255,255,255,0.18);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            box-shadow:
                0 18px 40px -12px rgba(0,0,0,0.7),
                inset 0 1px 0 rgba(255,255,255,0.25);
            cursor: pointer;
            transition: transform 0.45s cubic-bezier(.2,.8,.2,1), box-shadow 0.45s ease, border-color 0.45s ease;
            transform-style: preserve-3d;
        }

        .logo-medallion::after {
            content: "";
            position: absolute;
            inset: -6px;
            border-radius: 9999px;
            border: 1px solid rgba(96, 165, 250, 0.25);
            opacity: 0;
            transform: scale(0.94);
            transition: opacity 0.45s ease, transform 0.45s ease;
        }

        .logo-medallion:hover {
            transform: scale(1.07);
            border-color: rgba(147, 197, 253, 0.55);
            box-shadow:
                0 22px 55px -12px rgba(0,0,0,0.75),
                0 0 45px -6px rgba(59, 130, 246, 0.55),
                inset 0 1px 0 rgba(255,255,255,0.35);
        }

        .logo-medallion:hover::after {
            opacity: 1;
            transform: scale(1);
            animation: halo 1.8s ease-out infinite;
        }

        @keyframes halo {
            0%   { transform: scale(0.95); opacity: 0.75; }
            100% { transform: scale(1.22); opacity: 0; }
        }

        .logo-medallion img {
            width: 78px;
            height: 78px;
            object-fit: contain;
            filter: drop-shadow(0 4px 12px rgba(0,0,0,0.5));
            transition: transform 0.45s cubic-bezier(.2,.8,.2,1), filter 0.45s ease;
        }

        .logo-medallion:hover img {
            transform: scale(1.06) rotate(-3deg);
            filter: drop-shadow(0 6px 18px rgba(59,130,246,0.6));
        }

        /* ============ TITLE ============ */
        .brand-title {
            background: linear-gradient(100deg, #ffffff 0%, #93c5fd 42%, #22d3ee 78%, #ffffff 100%);
            background-size: 220% 100%;
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            transition: background-position 0.8s ease, filter 0.8s ease, transform 0.5s cubic-bezier(.2,.8,.2,1);
            display: inline-block;
        }

        .brand-title:hover {
            background-position: 100% 0;
            filter: drop-shadow(0 0 18px rgba(59, 130, 246, 0.55));
            transform: translateY(-2px);
        }

        .brand-title .accent {
            background: linear-gradient(100deg, #22d3ee, #3b82f6);
            background-size: 220% 100%;
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            transition: background-position 0.8s ease;
        }

        .brand-title:hover .accent { background-position: 100% 0; }

        .brand-sub {
            letter-spacing: 0.28em;
            transition: color 0.5s ease, letter-spacing 0.5s ease, text-shadow 0.5s ease;
        }

        .brand-sub:hover {
            color: #7dd3fc;
            letter-spacing: 0.34em;
            text-shadow: 0 0 16px rgba(56, 189, 248, 0.7);
        }

        /* ============ INPUTS ============ */
        .field {
            position: relative;
            display: flex;
            align-items: center;
        }

        .field .field-icon {
            position: absolute;
            left: 18px;
            width: 18px; height: 18px;
            color: rgba(148, 163, 184, 0.75);
            pointer-events: none;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .field:focus-within .field-icon {
            color: #60a5fa;
            transform: scale(1.1) translateX(2px);
        }

        .neon-input {
            width: 100%;
            background: rgba(15, 23, 42, 0.55);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.35s cubic-bezier(.2,.8,.2,1);
        }

        .neon-input:focus {
            outline: none;
            background: rgba(15, 23, 42, 0.75);
            border-color: rgba(96, 165, 250, 0.65);
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.12), 0 0 26px -4px rgba(59, 130, 246, 0.55);
            transform: translateY(-1px);
        }

        .field input.neon-input:focus {
            padding-left: 48px;
        }

        .toggle-pass {
            position: absolute;
            right: 16px;
            width: 22px; height: 22px;
            color: rgba(148, 163, 184, 0.7);
            cursor: pointer;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .toggle-pass:hover { color: #60a5fa; transform: scale(1.12); }

        /* ============ BUTTONS ============ */
        .btn-glow {
            position: relative;
            overflow: hidden;
            transition: transform 0.3s cubic-bezier(.2,.8,.2,1), box-shadow 0.35s ease, filter 0.35s ease;
        }

        .btn-glow:hover {
            transform: translateY(-2px);
            box-shadow: 0 0 30px rgba(59, 130, 246, 0.6), 0 12px 30px -12px rgba(0,0,0,0.7);
            filter: brightness(1.08);
        }

        .btn-glow:active { transform: translateY(0) scale(0.985); }

        .btn-glow .shine {
            position: absolute;
            top: 0; left: -75%;
            width: 45%; height: 100%;
            background: linear-gradient(100deg, transparent, rgba(255,255,255,0.35), transparent);
            transform: skewX(-20deg);
            transition: left 0.7s cubic-bezier(.2,.8,.2,1);
            pointer-events: none;
        }

        .btn-glow:hover .shine { left: 130%; }

        .btn-ghost {
            transition: all 0.3s cubic-bezier(.2,.8,.2,1);
        }

        .btn-ghost:hover {
            transform: translateY(-2px);
            border-color: rgba(96, 165, 250, 0.5);
            box-shadow: 0 0 24px -6px rgba(59, 130, 246, 0.55);
            color: #bfdbfe;
        }

        /* ============ ERROR ============ */
        .error-box {
            background: rgba(239, 68, 68, 0.12);
            border: 1px solid rgba(239, 68, 68, 0.32);
            animation: shake 0.5s cubic-bezier(.36,.07,.19,.97) both;
        }

        @keyframes shake {
            10%, 90% { transform: translateX(-1px); }
            20%, 80% { transform: translateX(2px); }
            30%, 50%, 70% { transform: translateX(-4px); }
            40%, 60% { transform: translateX(4px); }
        }

        /* ============ LINKS ============ */
        .link-hover {
            position: relative;
            transition: color 0.3s ease;
        }

        .link-hover::after {
            content: "";
            position: absolute;
            left: 0; bottom: -2px;
            height: 1px; width: 0;
            background: linear-gradient(90deg, #60a5fa, #22d3ee);
            transition: width 0.35s ease;
        }

        .link-hover:hover { color: #93c5fd; }
        .link-hover:hover::after { width: 100%; }

        /* Scrollbar for long viewports */
        body::-webkit-scrollbar { width: 8px; }
        body::-webkit-scrollbar-track { background: rgba(255,255,255,0.03); }
        body::-webkit-scrollbar-thumb {
            background: rgba(96, 165, 250, 0.35);
            border-radius: 9999px;
        }
        body::-webkit-scrollbar-thumb:hover { background: rgba(96, 165, 250, 0.6); }

        /* ============ THEME TOGGLE ============ */
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

        .theme-toggle .icon-sun  { opacity: 0; transform: rotate(-90deg) scale(0.5); }
        .theme-toggle .icon-moon { opacity: 1; transform: rotate(0deg) scale(1); }

        html[data-theme="light"] .theme-toggle .icon-sun  { opacity: 1; transform: rotate(0deg) scale(1); }
        html[data-theme="light"] .theme-toggle .icon-moon { opacity: 0; transform: rotate(90deg) scale(0.5); }

        /* ============ LIGHT MODE ============ */
        html[data-theme="light"] body {
            background: #e9eef8;
            color: #1e293b;
        }

        html[data-theme="light"] .orb { opacity: 0.40; }

        html[data-theme="light"] .grid-overlay {
            background-image:
                linear-gradient(rgba(15,23,42,0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(15,23,42,0.05) 1px, transparent 1px);
        }

        html[data-theme="light"] .glass-card {
            background: linear-gradient(145deg, rgba(255,255,255,0.92), rgba(255,255,255,0.62));
            border-color: rgba(15, 23, 42, 0.10);
            box-shadow:
                0 30px 70px -22px rgba(15, 23, 42, 0.32),
                0 0 60px -24px rgba(59, 130, 246, 0.25),
                inset 0 1px 0 rgba(255, 255, 255, 0.9);
        }

        html[data-theme="light"] .glass-card:hover {
            border-color: rgba(59, 130, 246, 0.35);
            box-shadow:
                0 40px 90px -24px rgba(15, 23, 42, 0.36),
                0 0 80px -22px rgba(59, 130, 246, 0.35),
                inset 0 1px 0 rgba(255, 255, 255, 1);
        }

        html[data-theme="light"] .neon-input {
            background: rgba(255, 255, 255, 0.92);
            border-color: rgba(15, 23, 42, 0.13);
        }

        html[data-theme="light"] .neon-input:focus {
            background: #ffffff;
            border-color: rgba(59, 130, 246, 0.75);
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.14), 0 0 20px -6px rgba(59, 130, 246, 0.5);
        }

        html[data-theme="light"] .neon-input::placeholder { color: #94a3b8; }

        html[data-theme="light"] .brand-title {
            background-image: linear-gradient(100deg, #0f172a 0%, #1d4ed8 42%, #0891b2 78%, #0f172a 100%);
        }

        html[data-theme="light"] .brand-title .accent {
            background-image: linear-gradient(100deg, #0891b2, #1d4ed8);
        }

        html[data-theme="light"] .brand-sub { color: #475569; }
        html[data-theme="light"] .brand-sub:hover { color: #0369a1; }

        html[data-theme="light"] .text-slate-400 { color: #475569 !important; }
        html[data-theme="light"] .text-slate-500 { color: #64748b !important; }
        html[data-theme="light"] .text-slate-600 { color: #64748b !important; }
        html[data-theme="light"] .text-blue-400 { color: #2563eb !important; }
        html[data-theme="light"] .text-blue-500 { color: #2563eb !important; }
        html[data-theme="light"] .text-blue-300 { color: #1d4ed8 !important; }
        html[data-theme="light"] .text-red-300  { color: #dc2626 !important; }

        html[data-theme="light"] .btn-ghost {
            background: rgba(15, 23, 42, 0.04) !important;
            border-color: rgba(15, 23, 42, 0.12) !important;
        }

        html[data-theme="light"] .btn-ghost:hover {
            background: rgba(59, 130, 246, 0.10) !important;
            border-color: rgba(59, 130, 246, 0.4) !important;
        }

        html[data-theme="light"] #pwaInstall {
            background: rgba(15, 23, 42, 0.04) !important;
            border-color: rgba(15, 23, 42, 0.12) !important;
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

        html[data-theme="light"] .field .field-icon { color: #94a3b8; }

        @media (prefers-reduced-motion: reduce) {
            .orb, .particle { animation: none !important; }
            * { transition-duration: 0.01ms !important; }
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-4">

    <!-- Ambient background -->
    <div class="ambient">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
        <div class="grid-overlay"></div>
        <div class="noise"></div>
        <div id="particles"></div>
    </div>

    <div class="glass-card w-full max-w-md rounded-[2.5rem] p-8 md:p-12 z-10">

        <button id="themeToggle" class="theme-toggle absolute top-5 right-5" title="Toggle dark / light mode" aria-label="Toggle dark or light mode">
            <svg class="icon-sun" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4V2m0 20v-2m8-8h2M2 12h2m13.66-5.66l1.42-1.42M4.92 19.08l1.42-1.42m0-11.32L4.92 4.92m14.16 14.16l-1.42-1.42M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
            <svg class="icon-moon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/>
            </svg>
        </button>

        <!-- Brand -->
        <div class="text-center mb-9">
            <div class="inline-flex items-center justify-center mb-6">
                <div class="logo-medallion" id="logoMedallion">
                    <img src="logo.png" alt="Knowledge Resource Center Logo">
                </div>
            </div>

            <h1 class="text-3xl md:text-[2.1rem] font-bold tracking-tight brand-title">
                KRC <span class="accent">Task Tracker</span>
            </h1>
            <p class="text-slate-400 text-sm mt-3 font-medium tracking-wide brand-sub text-[10px] uppercase">
                Daily Accomplishment Report
            </p>
        </div>

      <form method="POST" class="space-y-5">
    
    <?php if(isset($error)): ?>
        <div class="error-box text-red-300 text-xs py-3 px-4 rounded-xl text-center font-semibold tracking-wide">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <div class="space-y-2">
        <label class="block text-[10px] uppercase font-bold text-slate-500 tracking-[0.2em] ml-1">Username</label>
        <div class="field">
            <svg class="field-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            <input type="text" name="username" required 
                class="neon-input w-full pl-12 pr-5 py-4 rounded-2xl text-white placeholder-slate-600 focus:ring-0" 
                placeholder="e.g. username">
        </div>
    </div>

    <div class="space-y-2">
        <label class="block text-[10px] uppercase font-bold text-slate-500 tracking-[0.2em] ml-1">Password</label>
        <div class="field">
            <svg class="field-icon" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c1.657 0 3-1.343 3-3V6a3 3 0 00-6 0v2c0 1.657 1.343 3 3 3z"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 11h16v9H4z"/>
            </svg>
            <input type="password" id="passwordField" name="password" required 
                class="neon-input w-full pl-12 pr-12 py-4 rounded-2xl text-white placeholder-slate-600 focus:ring-0" 
                placeholder="••••••••">
            <svg id="togglePass" class="toggle-pass" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24" title="Show / hide password">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.964-7.178z"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
        </div>
    </div>

    <button type="submit" 
        class="btn-glow w-full bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-500 hover:to-cyan-400 text-white font-bold py-4 rounded-2xl flex items-center justify-center group mt-2">
        <span class="shine"></span>
        Sign In
        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
        </svg>
    </button>
</form>

<div class="mt-7 pt-7 border-t border-white/10 space-y-4">
    <p class="text-center text-slate-500 text-xs tracking-widest uppercase font-bold">New here?</p>
    
    <a href="register.php" 
        class="btn-ghost w-full bg-white/5 hover:bg-white/10 text-blue-300 border border-white/10 font-bold py-4 rounded-2xl flex items-center justify-center group">
        Create Account
        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
        </svg>
    </a>
</div>

<div class="mt-4 flex justify-center w-full">
    <button id="pwaInstall" 
        class="hidden btn-glow w-full bg-white/5 text-blue-300 border border-white/10 font-bold py-4 rounded-2xl flex items-center justify-center group">
        <span class="shine"></span>
        Install KRC App
        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
        </svg>
    </button>
</div>


        <div class="mt-9 text-center">
            <p class="text-[10px] text-slate-600 uppercase font-bold tracking-widest">
                Knowledge Resource Center &copy; 2026
            </p>
        </div>
    </div>

<script>
    // ---------- Ambient floating particles ----------
    (function createParticles() {
        const host = document.getElementById('particles');
        if (!host) return;
        for (let i = 0; i < 18; i++) {
            const p = document.createElement('span');
            p.className = 'particle';
            p.style.left = Math.random() * 100 + '%';
            p.style.bottom = '-20px';
            p.style.animationDuration = (11 + Math.random() * 16) + 's';
            p.style.animationDelay = (Math.random() * 16) + 's';
            p.style.opacity = (0.25 + Math.random() * 0.6);
            const s = 2 + Math.random() * 4;
            p.style.width = s + 'px';
            p.style.height = s + 'px';
            host.appendChild(p);
        }
    })();

    // ---------- Card spotlight follows the mouse ----------
    (function spotlight() {
        const card = document.querySelector('.glass-card');
        if (!card) return;
        card.addEventListener('mousemove', (e) => {
            const r = card.getBoundingClientRect();
            card.style.setProperty('--mx', (e.clientX - r.left) + 'px');
            card.style.setProperty('--my', (e.clientY - r.top) + 'px');
        });
    })();

    // ---------- 3D tilt on the logo medallion ----------
    (function tiltLogo() {
        const logo = document.getElementById('logoMedallion');
        if (!logo) return;
        logo.addEventListener('mousemove', (e) => {
            const r = logo.getBoundingClientRect();
            const x = (e.clientX - r.left) / r.width - 0.5;
            const y = (e.clientY - r.top) / r.height - 0.5;
            logo.style.transform = `scale(1.07) rotateX(${(-y * 14).toFixed(2)}deg) rotateY(${(x * 14).toFixed(2)}deg)`;
        });
        logo.addEventListener('mouseleave', () => {
            logo.style.transform = '';
        });
    })();

    // ---------- Show / hide password ----------
    (function passwordToggle() {
        const btn = document.getElementById('togglePass');
        const field = document.getElementById('passwordField');
        if (!btn || !field) return;
        btn.addEventListener('click', () => {
            const isHidden = field.type === 'password';
            field.type = isHidden ? 'text' : 'password';
            btn.style.color = isHidden ? '#60a5fa' : '';
            btn.style.transform = isHidden ? 'scale(1.12)' : '';
        });
    })();

    // ---------- Theme toggle (shared with index.php) ----------
    (function themeToggle() {
        const btn = document.getElementById('themeToggle');
        if (!btn) return;
        btn.addEventListener('click', () => {
            const next = (document.documentElement.getAttribute('data-theme') === 'light') ? 'dark' : 'light';
            document.documentElement.setAttribute('data-theme', next);
            try { localStorage.setItem('krc_theme', next); } catch (e) {}
        });
    })();

    // ---------- PWA ----------
    let deferredPrompt = null;
    const installBtn = document.getElementById('pwaInstall');

    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/sw.js')
            .then(() => console.log('SW Active'))
            .catch(err => console.warn('SW registration failed:', err));
    }

    window.addEventListener('beforeinstallprompt', (e) => {
        e.preventDefault();
        deferredPrompt = e;
        installBtn.classList.remove('hidden');
    });

    if (installBtn) {
        installBtn.addEventListener('click', async () => {
            if (deferredPrompt) {
                deferredPrompt.prompt();
                deferredPrompt = null;
                installBtn.classList.add('hidden');
            }
        });
    }
</script>
</body>
</html>
