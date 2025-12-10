<?php
require_once 'config_db.php';
requireAdminLogin();
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f5f5;
            color: #333;
        }
        
        .admin-header {
            background: #2c3e50;
            color: white;
            padding: 20px 0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
            border-bottom: 3px solid #34495e;
        }
        
        .admin-header .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .admin-header h1 {
            font-size: 24px;
        }
        
        .admin-header .user-info {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .btn-logout {
            background: #34495e;
            color: white;
            border: 1px solid #445a6f;
            padding: 8px 16px;
            border-radius: 6px;
            text-decoration: none;
            transition: all 0.3s;
            font-weight: 500;
        }
        
        .btn-logout:hover {
            background: #445a6f;
            border-color: #556b7f;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px 20px;
        }
        
        .admin-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .admin-actions h2 {
            color: #2c3e50;
            font-size: 24px;
            font-weight: 600;
            margin: 0;
        }
        
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-block;
            letter-spacing: 0.3px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.12);
        }
        
        .btn-primary {
            background: #3498db;
            color: white;
            border: none;
        }
        
        .btn-primary:hover {
            background: #2980b9;
            box-shadow: 0 2px 6px rgba(52, 152, 219, 0.35);
            transform: translateY(-1px);
        }
        
        .btn-primary:active {
            transform: translateY(0);
            box-shadow: 0 1px 3px rgba(52, 152, 219, 0.25);
        }
        
        .btn-secondary {
            background: #6c757d;
            color: white;
        }
        
        .btn-secondary:hover {
            background: #5a6268;
            box-shadow: 0 2px 6px rgba(108, 117, 125, 0.35);
            transform: translateY(-1px);
        }
        
        .btn-secondary:active {
            transform: translateY(0);
            box-shadow: 0 1px 3px rgba(108, 117, 125, 0.25);
        }
        
        .btn-danger {
            background: #e74c3c;
            color: white;
        }
        
        .btn-danger:hover {
            background: #c0392b;
            box-shadow: 0 2px 6px rgba(231, 76, 60, 0.35);
            transform: translateY(-1px);
        }
        
        .btn-danger:active {
            transform: translateY(0);
            box-shadow: 0 1px 3px rgba(231, 76, 60, 0.25);
        }
        
        .btn-success {
            background: #27ae60;
            color: white;
        }
        
        .btn-success:hover {
            background: #229954;
            box-shadow: 0 2px 6px rgba(39, 174, 96, 0.35);
            transform: translateY(-1px);
        }
        
        .btn-success:active {
            transform: translateY(0);
            box-shadow: 0 1px 3px rgba(39, 174, 96, 0.25);
        }
        
        /* Tlačítka v tabulce */
        .btn-table {
            padding: 6px 14px;
            font-size: 13px;
            margin-right: 6px;
        }
        
        .btn-table:last-child {
            margin-right: 0;
        }
        
        .table-container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.12);
            overflow: hidden;
            border: 1px solid #e0e0e0;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        thead {
            background: #34495e;
        }
        
        th {
            padding: 16px;
            text-align: left;
            font-weight: 600;
            color: white;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        td {
            padding: 16px;
            border-bottom: 1px solid #e8e8e8;
            color: #333;
            font-size: 14px;
        }
        
        tbody tr {
            transition: background-color 0.2s;
        }
        
        tbody tr:hover {
            background: #f5f7fa;
        }
        
        tbody tr:last-child td {
            border-bottom: none;
        }
        
        .status-badge {
            display: inline-block;
            padding: 6px 14px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .status-dostupne {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .status-rezervovano {
            background: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }
        
        .status-blokovano {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }
        
        .modal.active {
            display: flex;
        }
        
        .modal-content {
            background: white;
            border-radius: 8px;
            padding: 32px;
            width: 90%;
            max-width: 500px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            border: 1px solid #e0e0e0;
        }
        
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 2px solid #e8e8e8;
        }
        
        .modal-header h2 {
            color: #2c3e50;
            font-size: 22px;
            font-weight: 600;
            margin: 0;
        }
        
        .close-modal {
            background: none;
            border: none;
            font-size: 28px;
            cursor: pointer;
            color: #999;
            line-height: 1;
        }
        
        .close-modal:hover {
            color: #333;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
        }
        
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #d0d0d0;
            border-radius: 4px;
            font-size: 14px;
            font-family: inherit;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }
        
        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }
        
        .form-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            margin-top: 20px;
        }
        
        .message {
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
            display: none;
        }
        
        .message.success {
            background: #d4edda;
            color: #155724;
            border-left: 4px solid #28a745;
        }
        
        .message.error {
            background: #f8d7da;
            color: #721c24;
            border-left: 4px solid #dc3545;
        }
        
        .message.active {
            display: block;
        }
        
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #999;
        }
        
        .empty-state svg {
            width: 64px;
            height: 64px;
            margin-bottom: 20px;
            opacity: 0.5;
        }
        
        /* Flatpickr styling */
        .flatpickr-calendar {
            z-index: 10000 !important;
        }
        
        #dateRange {
            background: white;
        }
    </style>
</head>
<body>
    <div class="admin-header">
        <div class="container">
            <h1>Admin Panel</h1>
            <div class="user-info">
                <span>Přihlášen jako: <strong><?php echo htmlspecialchars($_SESSION['admin_username']); ?></strong></span>
                <a href="admin_logout.php" class="btn-logout">Odhlásit se</a>
            </div>
        </div>
    </div>
    
    <div class="container">
        <div id="message" class="message"></div>
        
        <div class="admin-actions">
            <h2>Dostupnost vozidla</h2>
            <button class="btn btn-primary" onclick="openAddModal()">+ Přidat záznam</button>
        </div>
        
        <div class="table-container">
            <table id="availabilityTable">
                <thead>
                    <tr>
                        <th>Datum od - do</th>
                        <th>Status</th>
                        <th>Poznámka</th>
                        <th>Vytvořeno</th>
                        <th>Akce</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <tr>
                        <td colspan="5" class="empty-state">
                            <div>Načítání dat...</div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Modal pro přidání/úpravu -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalTitle">Přidat záznam</h2>
                <button class="close-modal" onclick="closeModal()">&times;</button>
            </div>
            <form id="editForm">
                <input type="hidden" id="editId" name="id">
                <div class="form-group">
                    <label for="dateRange">Datum rezervace *</label>
                    <input type="text" id="dateRange" name="dateRange" placeholder="Vyberte datum nebo rozsah" required readonly style="cursor: pointer;">
                    <input type="hidden" id="editDatum" name="datum">
                    <input type="hidden" id="editDatumDo" name="datum_do">
                    <small style="color: #666; font-size: 12px; display: block; margin-top: 5px;">
                        Klikněte pro výběr jednoho dne nebo rozsahu dnů (klikněte a táhněte)
                    </small>
                </div>
                <div class="form-group">
                    <label for="editStatus">Status *</label>
                    <select id="editStatus" name="status" required>
                        <option value="dostupne">Dostupné</option>
                        <option value="rezervovano">Rezervováno</option>
                        <option value="blokovano">Blokováno</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="editPoznamka">Poznámka</label>
                    <textarea id="editPoznamka" name="poznamka" placeholder="Volitelná poznámka..."></textarea>
                </div>
                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeModal()">Zrušit</button>
                    <button type="submit" class="btn btn-primary">Uložit</button>
                </div>
            </form>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        let currentEditId = null;
        let dateRangePicker = null;
        
        // Načtení dat při načtení stránky
        document.addEventListener('DOMContentLoaded', function() {
            loadData();
        });
        
        // Načtení dat z API
        async function loadData() {
            try {
                const response = await fetch('admin_api.php?action=list');
                
                // Kontrola, zda je odpověď JSON
                const contentType = response.headers.get('content-type');
                if (!contentType || !contentType.includes('application/json')) {
                    const text = await response.text();
                    console.error('Neočekávaná odpověď:', text);
                    showMessage('Chyba: Server vrátil neočekávanou odpověď. Zkontrolujte, zda je databáze vytvořena a správně nakonfigurována.', 'error');
                    document.getElementById('tableBody').innerHTML = '<tr><td colspan="5" class="empty-state">Chyba při načítání dat</td></tr>';
                    return;
                }
                
                const result = await response.json();
                
                if (result.success) {
                    renderTable(result.data);
                } else {
                    showMessage('Chyba při načítání dat: ' + result.message, 'error');
                    document.getElementById('tableBody').innerHTML = '<tr><td colspan="5" class="empty-state">' + result.message + '</td></tr>';
                }
            } catch (error) {
                console.error('Chyba:', error);
                showMessage('Chyba při načítání dat: ' + error.message, 'error');
                document.getElementById('tableBody').innerHTML = '<tr><td colspan="5" class="empty-state">Chyba připojení k serveru</td></tr>';
            }
        }
        
        // Vykreslení tabulky
        function renderTable(data) {
            const tbody = document.getElementById('tableBody');
            
            if (data.length === 0) {
                tbody.innerHTML = '<tr><td colspan="5" class="empty-state">Žádné záznamy</td></tr>';
                return;
            }
            
            tbody.innerHTML = data.map(item => {
                const statusLabels = {
                    'dostupne': 'Dostupné',
                    'rezervovano': 'Rezervováno',
                    'blokovano': 'Blokováno'
                };
                
                const dateOd = new Date(item.datum);
                const formattedDateOd = dateOd.toLocaleDateString('cs-CZ');
                let dateRange = formattedDateOd;
                
                if (item.datum_do && item.datum_do !== item.datum) {
                    const dateDo = new Date(item.datum_do);
                    const formattedDateDo = dateDo.toLocaleDateString('cs-CZ');
                    dateRange = `${formattedDateOd} - ${formattedDateDo}`;
                }
                
                const createdDate = new Date(item.vytvoreno);
                const formattedCreated = createdDate.toLocaleString('cs-CZ');
                
                return `
                    <tr>
                        <td>${dateRange}</td>
                        <td><span class="status-badge status-${item.status}">${statusLabels[item.status]}</span></td>
                        <td>${item.poznamka || '-'}</td>
                        <td>${formattedCreated}</td>
                        <td>
                            <button class="btn btn-success btn-table" onclick="editRecord(${item.id})">Upravit</button>
                            <button class="btn btn-danger btn-table" onclick="deleteRecord(${item.id})">Smazat</button>
                        </td>
                    </tr>
                `;
            }).join('');
        }
        
        // Funkce pro formátování data v lokálním čase (YYYY-MM-DD)
        function formatDateLocal(date) {
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        }
        
        // Inicializace date range pickeru
        function initDateRangePicker(defaultDate = null) {
            if (dateRangePicker) {
                dateRangePicker.destroy();
            }
            
            const pickerOptions = {
                mode: "range",
                dateFormat: "d.m.Y",
                allowInput: false,
                locale: {
                    firstDayOfWeek: 1,
                    weekdays: {
                        shorthand: ["Ne", "Po", "Út", "St", "Čt", "Pá", "So"],
                        longhand: ["Neděle", "Pondělí", "Úterý", "Středa", "Čtvrtek", "Pátek", "Sobota"]
                    },
                    months: {
                        shorthand: ["Led", "Úno", "Bře", "Dub", "Kvě", "Čer", "Čvc", "Srp", "Zář", "Říj", "Lis", "Pro"],
                        longhand: ["Leden", "Únor", "Březen", "Duben", "Květen", "Červen", "Červenec", "Srpen", "Září", "Říjen", "Listopad", "Prosinec"]
                    }
                },
                onChange: function(selectedDates, dateStr, instance) {
                    if (selectedDates.length === 1) {
                        // Jednodenní rezervace - čekáme na druhý klik nebo použijeme stejný den
                        document.getElementById('editDatum').value = formatDateLocal(selectedDates[0]);
                        document.getElementById('editDatumDo').value = '';
                    } else if (selectedDates.length === 2) {
                        // Rozsah rezervace
                        document.getElementById('editDatum').value = formatDateLocal(selectedDates[0]);
                        document.getElementById('editDatumDo').value = formatDateLocal(selectedDates[1]);
                    } else {
                        document.getElementById('editDatum').value = '';
                        document.getElementById('editDatumDo').value = '';
                    }
                },
                onClose: function(selectedDates, dateStr, instance) {
                    // Pokud je vybrán jen jeden den, použijeme ho jako jednodenní rezervaci
                    if (selectedDates.length === 1) {
                        document.getElementById('editDatum').value = formatDateLocal(selectedDates[0]);
                        document.getElementById('editDatumDo').value = '';
                    }
                }
            };
            
            // Pokud je zadáno defaultní datum, nastavíme ho pro zobrazení správného měsíce
            if (defaultDate) {
                pickerOptions.defaultDate = defaultDate;
            }
            
            dateRangePicker = flatpickr("#dateRange", pickerOptions);
        }
        
        // Otevření modalu pro přidání
        function openAddModal() {
            currentEditId = null;
            document.getElementById('modalTitle').textContent = 'Přidat záznam';
            document.getElementById('editForm').reset();
            document.getElementById('editId').value = '';
            document.getElementById('editDatum').value = '';
            document.getElementById('editDatumDo').value = '';
            document.getElementById('dateRange').value = '';
            document.getElementById('editModal').classList.add('active');
            
            // Inicializace date pickeru po otevření modalu
            setTimeout(() => {
                initDateRangePicker();
            }, 100);
        }
        
        // Otevření modalu pro úpravu
        async function editRecord(id) {
            try {
                const response = await fetch(`admin_api.php?action=get&id=${id}`);
                const contentType = response.headers.get('content-type');
                if (!contentType || !contentType.includes('application/json')) {
                    const text = await response.text();
                    console.error('Neočekávaná odpověď:', text);
                    showMessage('Chyba: Server vrátil neočekávanou odpověď.', 'error');
                    return;
                }
                
                const result = await response.json();
                
                if (result.success) {
                    currentEditId = id;
                    document.getElementById('modalTitle').textContent = 'Upravit záznam';
                    document.getElementById('editId').value = result.data.id;
                    document.getElementById('editDatum').value = result.data.datum;
                    document.getElementById('editDatumDo').value = result.data.datum_do || '';
                    document.getElementById('editStatus').value = result.data.status;
                    document.getElementById('editPoznamka').value = result.data.poznamka || '';
                    
                    document.getElementById('editModal').classList.add('active');
                    
                    // Inicializace date pickeru s hodnotami a správným měsícem
                    setTimeout(() => {
                        if (result.data.datum) {
                            const dates = [result.data.datum];
                            if (result.data.datum_do && result.data.datum_do !== result.data.datum) {
                                dates.push(result.data.datum_do);
                            }
                            // Nastavíme defaultní datum na první datum, aby se kalendář otevřel na správném měsíci
                            initDateRangePicker(result.data.datum);
                            dateRangePicker.setDate(dates, false);
                        } else {
                            initDateRangePicker();
                        }
                    }, 100);
                } else {
                    showMessage('Chyba při načítání záznamu: ' + result.message, 'error');
                }
            } catch (error) {
                console.error('Chyba:', error);
                showMessage('Chyba při načítání záznamu: ' + error.message, 'error');
            }
        }
        
        // Zavření modalu
        function closeModal() {
            document.getElementById('editModal').classList.remove('active');
            currentEditId = null;
            if (dateRangePicker) {
                dateRangePicker.destroy();
                dateRangePicker = null;
            }
        }
        
        // Odeslání formuláře
        document.getElementById('editForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const data = {
                datum: formData.get('datum'),
                status: formData.get('status'),
                poznamka: formData.get('poznamka')
            };
            
            // Přidání datum_do, pokud je vyplněno
            const datumDo = formData.get('datum_do');
            if (datumDo && datumDo.trim() !== '') {
                data.datum_do = datumDo;
            }
            
            if (currentEditId) {
                data.id = currentEditId;
            }
            
            try {
                const url = 'admin_api.php';
                const options = {
                    method: currentEditId ? 'PUT' : 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                };
                
                const response = await fetch(url, options);
                const contentType = response.headers.get('content-type');
                if (!contentType || !contentType.includes('application/json')) {
                    const text = await response.text();
                    console.error('Neočekávaná odpověď:', text);
                    showMessage('Chyba: Server vrátil neočekávanou odpověď.', 'error');
                    return;
                }
                
                const result = await response.json();
                
                if (result.success) {
                    showMessage(result.message, 'success');
                    closeModal();
                    loadData();
                } else {
                    showMessage('Chyba: ' + result.message, 'error');
                }
            } catch (error) {
                console.error('Chyba:', error);
                showMessage('Chyba: ' + error.message, 'error');
            }
        });
        
        // Smazání záznamu
        async function deleteRecord(id) {
            if (!confirm('Opravdu chcete smazat tento záznam?')) {
                return;
            }
            
            try {
                const response = await fetch(`admin_api.php?id=${id}`, {
                    method: 'DELETE'
                });
                const contentType = response.headers.get('content-type');
                if (!contentType || !contentType.includes('application/json')) {
                    const text = await response.text();
                    console.error('Neočekávaná odpověď:', text);
                    showMessage('Chyba: Server vrátil neočekávanou odpověď.', 'error');
                    return;
                }
                
                const result = await response.json();
                
                if (result.success) {
                    showMessage(result.message, 'success');
                    loadData();
                } else {
                    showMessage('Chyba: ' + result.message, 'error');
                }
            } catch (error) {
                console.error('Chyba:', error);
                showMessage('Chyba: ' + error.message, 'error');
            }
        }
        
        // Zobrazení zprávy
        function showMessage(text, type) {
            const messageEl = document.getElementById('message');
            messageEl.textContent = text;
            messageEl.className = `message ${type} active`;
            
            setTimeout(() => {
                messageEl.classList.remove('active');
            }, 5000);
        }
        
        // Zavření modalu při kliknutí mimo
        document.getElementById('editModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
        
        // Validace před odesláním formuláře
        document.getElementById('editForm').addEventListener('submit', function(e) {
            const datumOd = document.getElementById('editDatum').value;
            const datumDo = document.getElementById('editDatumDo').value;
            
            if (!datumOd) {
                e.preventDefault();
                showMessage('Vyberte prosím datum', 'error');
                return false;
            }
            
            if (datumDo && datumDo < datumOd) {
                e.preventDefault();
                showMessage('Datum do musí být větší nebo rovno datu od', 'error');
                return false;
            }
        });
    </script>
</body>
</html>

