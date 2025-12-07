<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' - ' : ''; ?>SMMA - Social Media Marketing Agency</title>
    <link rel="stylesheet" href="<?php echo isset($base_path) ? $base_path : ''; ?>style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="container">
            <div class="nav-content">
                <div class="logo"><a href="<?php echo isset($base_path) ? $base_path : ''; ?>index.php" style="text-decoration: none; background: none; -webkit-text-fill-color: inherit;">SMMA</a></div>
                <ul class="nav-menu">
                    <li><a href="<?php echo isset($base_path) ? $base_path : ''; ?>index.php#home">Domů</a></li>
                    <li><a href="<?php echo isset($base_path) ? $base_path : ''; ?>index.php#services">Služby</a></li>
                    <li><a href="<?php echo isset($base_path) ? $base_path : ''; ?>index.php#mistakes">Chyby v reklamě</a></li>
                    <li><a href="<?php echo isset($base_path) ? $base_path : ''; ?>index.php#contact">Kontakt</a></li>
                </ul>
                <button class="menu-toggle" aria-label="Toggle menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
    </nav>

