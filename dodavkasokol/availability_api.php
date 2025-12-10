<?php
/**
 * Veřejný API endpoint pro získání dostupnosti
 * Bez autentizace - pro zobrazení na webu
 */

header('Content-Type: application/json; charset=utf-8');

require_once 'config_db.php';

$pdo = getDbConnection();
if (!$pdo) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Chyba připojení k databázi']);
    exit;
}

try {
    $year = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');
    $month = isset($_GET['month']) ? (int)$_GET['month'] : date('m');
    
    $startDate = sprintf('%04d-%02d-01', $year, $month);
    $endDate = date('Y-m-t', strtotime($startDate));
    
    // Získání všech záznamů, které se překrývají s požadovaným měsícem
    // Záznam se překrývá, pokud: datum <= konec_měsíce AND (datum_do IS NULL OR datum_do >= začátek_měsíce)
    $stmt = $pdo->prepare("SELECT datum, datum_do, status, poznamka FROM dostupnost 
        WHERE datum <= ? AND (datum_do IS NULL OR datum_do >= ?)");
    $stmt->execute([$endDate, $startDate]);
    $results = $stmt->fetchAll();
    
    $availability = [];
    foreach ($results as $row) {
        $datumOd = new DateTime($row['datum']);
        $datumDo = $row['datum_do'] ? new DateTime($row['datum_do']) : $datumOd;
        
        // Projdeme všechny dny v rozsahu
        $current = clone $datumOd;
        while ($current <= $datumDo) {
            $dateStr = $current->format('Y-m-d');
            // Zkontrolujeme, zda je den v požadovaném měsíci
            if ($dateStr >= $startDate && $dateStr <= $endDate) {
                $availability[$dateStr] = [
                    'status' => $row['status'],
                    'poznamka' => $row['poznamka']
                ];
            }
            $current->modify('+1 day');
        }
    }
    
    echo json_encode(['success' => true, 'data' => $availability]);
    
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Databázová chyba']);
}

