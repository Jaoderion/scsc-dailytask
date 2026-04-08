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
    <style>
        body { 
            font-family: 'Outfit', sans-serif; 
            background-color: #0f172a; 
            overflow: hidden;
        }
        
        /* Subtle animated background glow */
        .bg-glow {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.15) 0%, rgba(15, 23, 42, 0) 70%);
            z-index: -1;
        }

        .glass-card {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.3), 0 0 20px rgba(59, 130, 246, 0.1);
        }

        .neon-input {
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .neon-input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 15px rgba(59, 130, 246, 0.3);
            outline: none;
        }

        .btn-glow {
            transition: all 0.3s ease;
            text-shadow: 0 0 8px rgba(255, 255, 255, 0.3);
        }

        .btn-glow:hover {
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.6);
            transform: translateY(-1px);
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-4">

    <div class="bg-glow"></div>

    <div class="glass-card w-full max-w-md rounded-[2.5rem] p-10 md:p-12 transition-all">
        
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-tr from-blue-600 to-cyan-400 rounded-2xl shadow-lg shadow-blue-500/20 mb-6">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-white tracking-tight">KRC <span class="text-blue-500">Task Tracker</span></h1>
            <p class="text-slate-400 text-sm mt-2 font-medium tracking-wide">Enter your portal credentials</p>
        </div>

      <form method="POST" class="space-y-6">
    
    <?php if(isset($error)): ?>
        <div class="bg-red-500/10 border border-red-500/20 text-red-400 text-xs py-3 px-4 rounded-xl text-center font-semibold tracking-wide animate-pulse">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <div class="space-y-2">
        <label class="block text-[10px] uppercase font-bold text-slate-500 tracking-[0.2em] ml-1">Username</label>
        <input type="text" name="username" required 
            class="neon-input w-full px-5 py-4 rounded-2xl text-white placeholder-slate-600 focus:ring-0" 
            placeholder="e.g. username">
    </div>

    <div class="space-y-2">
        <label class="block text-[10px] uppercase font-bold text-slate-500 tracking-[0.2em] ml-1">Password</label>
        <input type="password" name="password" required 
            class="neon-input w-full px-5 py-4 rounded-2xl text-white placeholder-slate-600 focus:ring-0" 
            placeholder="••••••••">
    </div>

    <button type="submit" 
        class="btn-glow w-full bg-blue-600 hover:bg-blue-500 text-white font-bold py-4 rounded-2xl transition-all flex items-center justify-center group">
        Sign In
        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
        </svg>
    </button>
</form>

<div class="mt-6 pt-6 border-t border-white/5 space-y-4">
    <p class="text-center text-slate-500 text-xs tracking-widest uppercase font-bold">New here?</p>
    
    <a href="register.php" 
        class="btn-glow w-full bg-slate-800 hover:bg-slate-700 text-blue-400 border border-slate-700 font-bold py-4 rounded-2xl transition-all flex items-center justify-center group">
        Create Account
        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
        </svg>
    </a>
</div>

<div class="mt-4 flex justify-center w-full">
    <button id="pwaInstall" 
        class="hidden btn-glow w-full bg-slate-800 hover:bg-slate-700 text-blue-400 border border-slate-700 font-bold py-4 rounded-2xl transition-all flex items-center justify-center group">
        Install KRC App
        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
        </svg>
    </button>
</div>


        <div class="mt-10 text-center">
            <p class="text-[10px] text-slate-600 uppercase font-bold tracking-widest">
                Knowledge Resource Center &copy; 2026
            </p>
        </div>
    </div>
<script>
    let deferredPrompt;
    const installBtn = document.getElementById('pwaInstall');

    // DIAGNOSTIC: Let's see why it's failing
    window.addEventListener('load', () => {
        if (window.isSecureContext === false) {
            alert("❌ PWA BLOCKED: Connection is not secure (Needs HTTPS or Localhost)");
        }
    });

    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('sw.js')
            .then(reg => console.log("SW Active"))
            .catch(err => alert("❌ SW Failed: " + err));
    }

    window.addEventListener('beforeinstallprompt', (e) => {
        alert("✅ PWA Ready to Install!"); // This will pop up if everything is correct
        e.preventDefault();
        deferredPrompt = e;
        installBtn.classList.remove('hidden');
    });

    installBtn.addEventListener('click', async () => {
        if (deferredPrompt) {
            deferredPrompt.prompt();
            deferredPrompt = null;
            installBtn.classList.add('hidden');
        }
    });
</script>

</body>
</html>