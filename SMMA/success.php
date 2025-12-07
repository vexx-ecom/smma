<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Děkuji za vyplnění formuláře</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            min-height: 100vh;
            background: #0a0e27;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Abstract geometric background */
        .background-pattern {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, transparent 50%),
                linear-gradient(225deg, rgba(139, 92, 246, 0.08) 0%, transparent 50%),
                linear-gradient(45deg, rgba(30, 41, 59, 0.9) 0%, rgba(15, 23, 42, 0.95) 100%);
            z-index: 0;
        }

        .geometric-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            opacity: 0.6;
        }

        .shape {
            position: absolute;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.15), rgba(139, 92, 246, 0.1));
            border: 1px solid rgba(99, 102, 241, 0.2);
        }

        .shape-1 {
            width: 300px;
            height: 300px;
            top: 10%;
            left: 5%;
            transform: rotate(45deg);
            clip-path: polygon(50% 0%, 0% 100%, 100% 100%);
        }

        .shape-2 {
            width: 200px;
            height: 200px;
            top: 60%;
            right: 10%;
            transform: rotate(30deg);
            clip-path: polygon(30% 0%, 70% 0%, 100% 30%, 100% 70%, 70% 100%, 30% 100%, 0% 70%, 0% 30%);
        }

        .shape-3 {
            width: 250px;
            height: 250px;
            bottom: 15%;
            left: 15%;
            transform: rotate(-20deg);
            clip-path: polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%);
        }

        .shape-4 {
            width: 180px;
            height: 180px;
            top: 30%;
            right: 20%;
            transform: rotate(60deg);
            clip-path: polygon(25% 0%, 100% 0%, 75% 100%, 0% 100%);
        }

        .shape-5 {
            width: 150px;
            height: 150px;
            bottom: 30%;
            right: 5%;
            transform: rotate(-45deg);
            clip-path: polygon(0% 0%, 100% 0%, 100% 75%, 75% 75%, 75% 100%, 50% 75%, 0% 75%);
        }

        .content {
            position: relative;
            z-index: 2;
            text-align: center;
            padding: 2rem;
            max-width: 800px;
            animation: fadeInUp 0.8s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        h1 {
            font-size: 3.5rem;
            font-weight: 800;
            color: white;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }

        .highlight {
            color: #3b82f6;
            background: linear-gradient(135deg, #3b82f6 0%, #6366f1 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .subtitle {
            font-size: 1.5rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 3rem;
            line-height: 1.6;
        }

        .back-button {
            display: inline-block;
            padding: 1rem 2.5rem;
            background: rgba(255, 255, 255, 0.95);
            color: #1e293b;
            text-decoration: none;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .back-button:hover {
            background: white;
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.2);
        }

        .back-button::after {
            content: ' →';
            display: inline-block;
            margin-left: 0.5rem;
            transition: transform 0.3s ease;
        }

        .back-button:hover::after {
            transform: translateX(5px);
        }

        .logo {
            position: absolute;
            bottom: 30px;
            left: 30px;
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #3b82f6 0%, #6366f1 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 800;
            font-size: 1.5rem;
            z-index: 3;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.3);
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 2.5rem;
            }

            .subtitle {
                font-size: 1.2rem;
            }

            .back-button {
                padding: 0.875rem 2rem;
                font-size: 1rem;
            }

            .logo {
                width: 40px;
                height: 40px;
                font-size: 1.2rem;
                bottom: 20px;
                left: 20px;
            }
        }

        @media (max-width: 480px) {
            h1 {
                font-size: 2rem;
            }

            .subtitle {
                font-size: 1rem;
                margin-bottom: 2rem;
            }

            .content {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="background-pattern"></div>
    <div class="geometric-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
        <div class="shape shape-4"></div>
        <div class="shape shape-5"></div>
    </div>
    
    <div class="content">
        <h1>Vyplněný formulář už je v <span class="highlight">MediaFlow</span>!</h1>
        <p class="subtitle">Děkuji za vyplnění! Na Vašem emailu už máte e-book!</p>
        <a href="index.php" class="back-button">Zpět</a>
    </div>

    <div class="logo">M</div>
</body>
</html>

