<?php
require_once 'config/services.php';

// Získání ID služby z URL
$service_id = isset($_GET['id']) ? $_GET['id'] : '';

// Kontrola, zda služba existuje
if (!isset($services[$service_id])) {
    header('Location: index.php');
    exit;
}

$service = $services[$service_id];
$page_title = $service['title'];
$base_path = '';

include 'includes/header.php';
?>

<section class="service-detail">
    <div class="container">
        <div class="service-detail-header">
            <a href="index.php#services" class="back-link">← Zpět na služby</a>
            <h1 class="service-detail-title"><?php echo $service['title']; ?></h1>
            <p class="service-detail-subtitle"><?php echo $service['short_description']; ?></p>
        </div>

        <div class="service-detail-content">
            <div class="service-detail-main">
                <div class="service-detail-section">
                    <h2>O službě</h2>
                    <p><?php echo $service['description']; ?></p>
                </div>

                <div class="service-detail-section">
                    <h2>Co zahrnuje</h2>
                    <ul class="service-detail-features">
                        <?php foreach ($service['features'] as $feature): ?>
                            <li><?php echo $feature; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="service-detail-section">
                    <h2>Výhody pro vás</h2>
                    <ul class="service-detail-benefits">
                        <?php foreach ($service['benefits'] as $benefit): ?>
                            <li><?php echo $benefit; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="service-detail-section">
                    <h2>Investice</h2>
                    <p><?php echo $service['price_info']; ?></p>
                </div>
            </div>

            <div class="service-detail-sidebar">
                <div class="cta-box">
                    <h3>Zajímá vás tato služba?</h3>
                    <p>Kontaktujte mě a domluvíme se na spolupráci</p>
                    <a href="index.php#contact" class="btn btn-primary">Kontaktovat</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>

