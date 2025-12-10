<?php
/**
 * API endpointy pro správu dostupnosti
 * Vyžaduje admin přihlášení
 */

// Vypnutí zobrazení chyb pro produkci (aby se nezobrazovaly jako HTML)
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

// Session musí být spuštěna před jakýmkoli výstupem
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Nastavení JSON hlavičky
header('Content-Type: application/json; charset=utf-8');

require_once 'config_db.php';

// Kontrola přihlášení
if (!isAdminLoggedIn()) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Neautorizováno']);
    exit;
}

$pdo = getDbConnection();
if (!$pdo) {
    http_response_code(500);
    echo json_encode([
        'success' => false, 
        'message' => 'Chyba připojení k databázi. Zkontrolujte, zda je databáze vytvořena a obsahuje potřebné tabulky. Otevřete test_db.php pro diagnostiku.'
    ]);
    exit;
}

$method = $_SERVER['REQUEST_METHOD'];
$action = isset($_GET['action']) ? $_GET['action'] : '';

try {
    switch ($method) {
        case 'GET':
            if ($action === 'list') {
                // Získání seznamu všech záznamů dostupnosti
                $startDate = isset($_GET['start_date']) ? $_GET['start_date'] : null;
                $endDate = isset($_GET['end_date']) ? $_GET['end_date'] : null;
                
                $sql = "SELECT * FROM dostupnost WHERE 1=1";
                $params = [];
                
                if ($startDate) {
                    $sql .= " AND datum >= ?";
                    $params[] = $startDate;
                }
                
                if ($endDate) {
                    $sql .= " AND datum <= ?";
                    $params[] = $endDate;
                }
                
                $sql .= " ORDER BY datum ASC";
                
                $stmt = $pdo->prepare($sql);
                $stmt->execute($params);
                $results = $stmt->fetchAll();
                
                echo json_encode(['success' => true, 'data' => $results]);
            } elseif ($action === 'get') {
                // Získání jednoho záznamu
                $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
                if ($id > 0) {
                    $stmt = $pdo->prepare("SELECT * FROM dostupnost WHERE id = ?");
                    $stmt->execute([$id]);
                    $result = $stmt->fetch();
                    if ($result) {
                        echo json_encode(['success' => true, 'data' => $result]);
                    } else {
                        http_response_code(404);
                        echo json_encode(['success' => false, 'message' => 'Záznam nenalezen']);
                    }
                } else {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'message' => 'Neplatné ID']);
                }
            } else {
                // Získání dostupnosti pro kalendář (pro frontend)
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
            }
            break;
            
        case 'POST':
            // Vytvoření nového záznamu
            $data = json_decode(file_get_contents('php://input'), true);
            
            if (!isset($data['datum']) || !isset($data['status'])) {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'Chybí povinná pole']);
                break;
            }
            
            $datum = $data['datum'];
            $datumDo = isset($data['datum_do']) && !empty($data['datum_do']) ? $data['datum_do'] : null;
            $status = $data['status'];
            $poznamka = isset($data['poznamka']) ? $data['poznamka'] : null;
            
            // Validace - datum_do musí být >= datum
            if ($datumDo && $datumDo < $datum) {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'Datum do musí být větší nebo rovno datu od']);
                break;
            }
            
            // Validace statusu
            if (!in_array($status, ['dostupne', 'rezervovano', 'blokovano'])) {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'Neplatný status']);
                break;
            }
            
            // Kontrola překrývání s existujícími záznamy
            // Dva rozsahy se překrývají, pokud: datum_od_nového <= datum_do_existujícího AND datum_do_nového >= datum_od_existujícího
            $datumDoCheck = $datumDo ?: $datum;
            $checkSql = "SELECT id FROM dostupnost WHERE 
                ? <= COALESCE(datum_do, datum) AND 
                ? >= datum";
            $stmt = $pdo->prepare($checkSql);
            $stmt->execute([$datumDoCheck, $datum]);
            $existing = $stmt->fetch();
            if ($existing) {
                http_response_code(409);
                echo json_encode(['success' => false, 'message' => 'Záznam se překrývá s existující rezervací']);
                break;
            }
            
            $stmt = $pdo->prepare("INSERT INTO dostupnost (datum, datum_do, status, poznamka) VALUES (?, ?, ?, ?)");
            $stmt->execute([$datum, $datumDo, $status, $poznamka]);
            
            $id = $pdo->lastInsertId();
            echo json_encode(['success' => true, 'message' => 'Záznam vytvořen', 'id' => $id]);
            break;
            
        case 'PUT':
            // Aktualizace záznamu
            $data = json_decode(file_get_contents('php://input'), true);
            
            if (!isset($data['id'])) {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'Chybí ID']);
                break;
            }
            
            $id = (int)$data['id'];
            $updates = [];
            $params = [];
            
            if (isset($data['datum'])) {
                $updates[] = "datum = ?";
                $params[] = $data['datum'];
            }
            
            if (isset($data['datum_do'])) {
                $updates[] = "datum_do = ?";
                $params[] = !empty($data['datum_do']) ? $data['datum_do'] : null;
            }
            
            if (isset($data['status'])) {
                if (!in_array($data['status'], ['dostupne', 'rezervovano', 'blokovano'])) {
                    http_response_code(400);
                    echo json_encode(['success' => false, 'message' => 'Neplatný status']);
                    break;
                }
                $updates[] = "status = ?";
                $params[] = $data['status'];
            }
            
            if (isset($data['poznamka'])) {
                $updates[] = "poznamka = ?";
                $params[] = $data['poznamka'];
            }
            
            // Validace - datum_do musí být >= datum
            $datum = isset($data['datum']) ? $data['datum'] : null;
            $datumDo = isset($data['datum_do']) ? (!empty($data['datum_do']) ? $data['datum_do'] : null) : null;
            
            // Pokud aktualizujeme oba, zkontrolujme validitu
            if ($datum && $datumDo && $datumDo < $datum) {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'Datum do musí být větší nebo rovno datu od']);
                break;
            }
            
            if (empty($updates)) {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'Žádná data k aktualizaci']);
                break;
            }
            
            // Pokud aktualizujeme datum nebo datum_do, zkontrolujme překrývání s ostatními záznamy (kromě aktuálního)
            if (isset($data['datum']) || isset($data['datum_do'])) {
                // Nejdřív získáme aktuální hodnoty, pokud je neaktualizujeme
                $stmt = $pdo->prepare("SELECT datum, datum_do FROM dostupnost WHERE id = ?");
                $stmt->execute([$id]);
                $current = $stmt->fetch();
                
                $finalDatum = $datum ?: $current['datum'];
                $finalDatumDo = $datumDo !== null ? ($datumDo ?: $current['datum_do']) : $current['datum_do'];
                $finalDatumDoCheck = $finalDatumDo ?: $finalDatum;
                
                // Kontrola překrývání s ostatními záznamy (kromě aktuálního)
                $checkSql = "SELECT id FROM dostupnost WHERE id != ? AND 
                    ? <= COALESCE(datum_do, datum) AND 
                    ? >= datum";
                $stmt = $pdo->prepare($checkSql);
                $stmt->execute([$id, $finalDatumDoCheck, $finalDatum]);
                if ($stmt->fetch()) {
                    http_response_code(409);
                    echo json_encode(['success' => false, 'message' => 'Záznam se překrývá s existující rezervací']);
                    break;
                }
            }
            
            $params[] = $id;
            $sql = "UPDATE dostupnost SET " . implode(', ', $updates) . " WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            
            echo json_encode(['success' => true, 'message' => 'Záznam aktualizován']);
            break;
            
        case 'DELETE':
            // Smazání záznamu
            $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
            
            if ($id <= 0) {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'Neplatné ID']);
                break;
            }
            
            $stmt = $pdo->prepare("DELETE FROM dostupnost WHERE id = ?");
            $stmt->execute([$id]);
            
            if ($stmt->rowCount() > 0) {
                echo json_encode(['success' => true, 'message' => 'Záznam smazán']);
            } else {
                http_response_code(404);
                echo json_encode(['success' => false, 'message' => 'Záznam nenalezen']);
            }
            break;
            
        default:
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Metoda není podporována']);
    }
} catch (PDOException $e) {
    http_response_code(500);
    // Logování chyby místo zobrazení uživateli
    error_log("Admin API Error: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Databázová chyba. Zkontrolujte, zda je databáze vytvořena.']);
} catch (Exception $e) {
    http_response_code(500);
    error_log("Admin API Error: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Chyba serveru: ' . $e->getMessage()]);
}

