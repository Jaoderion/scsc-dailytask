<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KRC | Create Account</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Outfit', sans-serif; 
            background-color: #0f172a; 
        }
        .neon-border-blue {
            box-shadow: 0 0 15px rgba(59, 130, 246, 0.2), inset 0 0 5px rgba(59, 130, 246, 0.1);
        }
        .neon-text-blue {
            text-shadow: 0 0 10px rgba(59, 130, 246, 0.5);
        }
        .glass-card {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.05);
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
        .btn-thick {
            border-bottom-width: 4px;
            transition: all 0.1s ease;
        }
        .btn-thick:active {
            border-bottom-width: 0px;
            transform: translateY(4px);
        }
    </style>
</head>
<body class="text-slate-200 flex items-center justify-center min-h-screen p-6">

    <div class="w-full max-w-md animate-in fade-in zoom-in duration-500">
        <div class="flex flex-col items-center mb-8">
            <div class="w-16 h-16 bg-gradient-to-tr from-blue-600 to-cyan-400 rounded-2xl flex items-center justify-center shadow-[0_0_25px_rgba(59,130,246,0.5)] mb-4">
                <span class="text-white text-3xl font-bold">K</span>
            </div>
            <h1 class="text-2xl font-bold text-white tracking-tight neon-text-blue">Join Team</h1>
            <p class="text-slate-400 text-sm mt-1">Create your developer account</p>
        </div>

        <div class="glass-card neon-border-blue rounded-[2.5rem] p-10">
          <form action="signup_process.php" method="POST" class="space-y-6">
    <!-- User Account Fields -->
    <div class="space-y-2">
        <label class="text-[10px] uppercase font-bold text-blue-400 tracking-[0.2em] ml-1">Full Name</label>
        <input type="text" name="full_name" required 
            class="glass-input w-full rounded-2xl px-5 py-4 text-white placeholder-slate-600" 
            placeholder="e.g. John Doe">
    </div>

    <div class="space-y-2">
        <label class="text-[10px] uppercase font-bold text-blue-400 tracking-[0.2em] ml-1">Username</label>
        <input type="text" name="username" required 
            class="glass-input w-full rounded-2xl px-5 py-4 text-white placeholder-slate-600" 
            placeholder="jdoe_dev">
    </div>

    <div class="space-y-2">
        <label class="text-[10px] uppercase font-bold text-blue-400 tracking-[0.2em] ml-1">Password</label>
        <input type="password" name="password" required 
            class="glass-input w-full rounded-2xl px-5 py-4 text-white placeholder-slate-600" 
            placeholder="••••••••">
    </div>

    <!-- Officials Registration Section -->
    <div class="mt-8 pt-6 border-t border-white/5">
        <h2 class="text-blue-400 font-bold text-sm uppercase tracking-widest mb-4">Officials Registration</h2>

        <!-- Prepared by -->
        <div class="space-y-2">
            <label class="text-[10px] uppercase font-bold text-blue-400 tracking-[0.2em] ml-1">Prepared By - Name</label>
            <input type="text" name="staff_name" 
                class="glass-input w-full rounded-2xl px-5 py-4 text-white placeholder-slate-600" 
                placeholder="JEFFREY A. ODERIO">

            <label class="text-[10px] uppercase font-bold text-blue-400 tracking-[0.2em] ml-1">Prepared By - Title</label>
            <input type="text" name="staff_position" 
                class="glass-input w-full rounded-2xl px-5 py-4 text-white placeholder-slate-600" 
                placeholder="COS">
        </div>

        <!-- Noted by -->
        <div class="space-y-2 mt-4">
            <label class="text-[10px] uppercase font-bold text-blue-400 tracking-[0.2em] ml-1">Noted By - Name</label>
            <input type="text" name="head_name" 
                class="glass-input w-full rounded-2xl px-5 py-4 text-white placeholder-slate-600" 
                placeholder="ALGEAN B. TAGLE, RL, MLIS">

            <label class="text-[10px] uppercase font-bold text-blue-400 tracking-[0.2em] ml-1">Noted By - Title</label>
            <input type="text" name="head_title" 
                class="glass-input w-full rounded-2xl px-5 py-4 text-white placeholder-slate-600" 
                placeholder="College Librarian">
        </div>

        <!-- Reviewed and Approved -->
        <div class="space-y-2 mt-4">
            <label class="text-[10px] uppercase font-bold text-blue-400 tracking-[0.2em] ml-1">Reviewed & Approved - Name</label>
            <input type="text" name="administrative_name" 
                class="glass-input w-full rounded-2xl px-5 py-4 text-white placeholder-slate-600" 
                placeholder="ELEN G. AVILA, MAED, LPT">

            <label class="text-[10px] uppercase font-bold text-blue-400 tracking-[0.2em] ml-1">Reviewed & Approved - Title</label>
            <input type="text" name="administrative_title" 
                class="glass-input w-full rounded-2xl px-5 py-4 text-white placeholder-slate-600" 
                placeholder="Administrative Officer V (HRMO III)">



                    <label class="text-[10px] uppercase font-bold text-blue-400 tracking-[0.2em] ml-1">Department/unit</label>
            <input type="text" name="department" 
                class="glass-input w-full rounded-2xl px-5 py-4 text-white placeholder-slate-600" 
                placeholder="Department/Unit">
        </div>
    </div>






    <!-- Submit Button -->
    <button type="submit" 
        class="btn-thick w-full py-4 rounded-2xl bg-blue-600 border-blue-700 border-b-blue-900 text-white font-bold text-lg shadow-[0_5px_15px_rgba(59,130,246,0.3)] hover:bg-blue-500 transition-all mt-4">
        Create Account
    </button>
</form>

            <div class="mt-8 pt-6 border-t border-white/5 text-center">
                <p class="text-slate-500 text-sm">
                    Already have an account? 
                    <a href="login.php" class="text-blue-400 font-bold hover:text-blue-300 transition-colors ml-1">Log In</a>
                </p>
            </div>
        </div>

        <p class="text-center text-[10px] text-slate-600 uppercase tracking-widest mt-10">
            &copy; 2026 KRC SYSTEM • Secure Access
        </p>
    </div>




</body>
</html>