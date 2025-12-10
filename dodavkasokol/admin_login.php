<?php
session_start();

// Pokud je uživatel již přihlášen, přesměruj na admin panel
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: admin.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'config_db.php';
    
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    
    if (!empty($username) && !empty($password)) {
        $pdo = getDbConnection();
        
        if ($pdo) {
            $stmt = $pdo->prepare("SELECT id, username, password_hash FROM admin_users WHERE username = ?");
            $stmt->execute([$username]);
            $user = $stmt->fetch();
            
            if ($user && password_verify($password, $user['password_hash'])) {
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_user_id'] = $user['id'];
                $_SESSION['admin_username'] = $user['username'];
                header('Location: admin.php');
                exit;
            } else {
                $error = 'Neplatné přihlašovací údaje';
            }
        } else {
            $error = 'Chyba připojení k databázi';
        }
    } else {
        $error = 'Vyplňte prosím všechna pole';
    }
}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Dodávka Sokol</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }
        
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: #2c3e50;
            z-index: 10;
        }
        
        body::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                linear-gradient(135deg, rgba(52, 152, 219, 0.04) 0%, rgba(44, 62, 80, 0.04) 100%),
                repeating-linear-gradient(
                    45deg,
                    transparent,
                    transparent 60px,
                    rgba(52, 152, 219, 0.015) 60px,
                    rgba(52, 152, 219, 0.015) 120px
                ),
                radial-gradient(circle at 20% 50%, rgba(52, 152, 219, 0.05) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(44, 62, 80, 0.05) 0%, transparent 50%);
            z-index: 0;
        }
        
        /* Dekorativní tvary */
        .bg-shape {
            position: absolute;
            border-radius: 50%;
            opacity: 0.05;
            z-index: 0;
        }
        
        .bg-shape-1 {
            width: 400px;
            height: 400px;
            background: #3498db;
            top: -200px;
            right: -200px;
            animation: float 20s ease-in-out infinite;
        }
        
        .bg-shape-2 {
            width: 300px;
            height: 300px;
            background: #2c3e50;
            bottom: -150px;
            left: -150px;
            animation: float 25s ease-in-out infinite reverse;
        }
        
        .bg-shape-3 {
            width: 200px;
            height: 200px;
            background: #34495e;
            top: 50%;
            left: 10%;
            animation: float 30s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% {
                transform: translate(0, 0) rotate(0deg);
            }
            33% {
                transform: translate(30px, -30px) rotate(120deg);
            }
            66% {
                transform: translate(-20px, 20px) rotate(240deg);
            }
        }
        
        .login-container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
            padding: 40px;
            width: 100%;
            max-width: 400px;
            border: 1px solid #e0e0e0;
            position: relative;
            z-index: 1;
            backdrop-filter: blur(10px);
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .login-header h1 {
            color: #2c3e50;
            font-size: 28px;
            margin-bottom: 10px;
            font-weight: 600;
        }
        
        .login-header p {
            color: #7f8c8d;
            font-size: 14px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
            font-size: 14px;
        }
        
        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #d0d0d0;
            border-radius: 4px;
            font-size: 15px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        
        .form-group input:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }
        
        .btn-login {
            width: 100%;
            padding: 12px;
            background: #3498db;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 1px 3px rgba(0,0,0,0.12);
            letter-spacing: 0.3px;
        }
        
        .btn-login:hover {
            background: #2980b9;
            box-shadow: 0 2px 6px rgba(52, 152, 219, 0.35);
            transform: translateY(-1px);
        }
        
        .btn-login:active {
            transform: translateY(0);
            box-shadow: 0 1px 3px rgba(52, 152, 219, 0.25);
        }
        
        .error-message {
            background: #f8d7da;
            color: #721c24;
            padding: 12px;
            border-radius: 4px;
            margin-bottom: 20px;
            border-left: 4px solid #dc3545;
            font-size: 14px;
        }
        
        .back-link {
            text-align: center;
            margin-top: 20px;
        }
        
        .back-link a {
            color: #3498db;
            text-decoration: none;
            font-size: 14px;
            transition: color 0.2s;
        }
        
        .back-link a:hover {
            color: #2980b9;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1>Admin Panel</h1>
            <p>Přihlaste se pro správu dostupnosti</p>
        </div>
        
        <?php if ($error): ?>
            <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Uživatelské jméno</label>
                <input type="text" id="username" name="username" required autofocus>
            </div>
            
            <div class="form-group">
                <label for="password">Heslo</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit" class="btn-login">Přihlásit se</button>
        </form>
        
        <div class="back-link">
            <a href="index.php">← Zpět na web</a>
        </div>
    </div>
    
    <div class="bg-shape bg-shape-1"></div>
    <div class="bg-shape bg-shape-2"></div>
    <div class="bg-shape bg-shape-3"></div>
</body>
</html>

