<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartPark - Laporan Harian</title>
    <?php
    // Format tanggal untuk ditampilkan
    $formattedDate = date('d F Y', strtotime($tanggal));
    ?>    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            min-height: 100vh;
            color: white;
            overflow-x: hidden;
        }

        .floating-shapes {
            position: fixed;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
            pointer-events: none;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            animation: float 20s infinite linear;
        }

        .shape:nth-child(1) {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 10%;
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            width: 120px;
            height: 120px;
            top: 60%;
            right: 15%;
            animation-delay: -5s;
            background: rgba(103, 126, 234, 0.2);
        }

        .shape:nth-child(3) {
            width: 60px;
            height: 60px;
            bottom: 30%;
            left: 20%;
            animation-delay: -10s;
            background: rgba(118, 75, 162, 0.2);
        }

        .shape:nth-child(4) {
            width: 100px;
            height: 100px;
            top: 10%;
            right: 30%;
            animation-delay: -15s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(-30px) rotate(120deg); }
            66% { transform: translateY(20px) rotate(240deg); }
        }

        .header {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            padding: 20px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            z-index: 10;
        }

        .header-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 20px;
        }

        .logo {
            font-size: 2rem;
            font-weight: bold;
            background: linear-gradient(45deg, #667eea, #764ba2, #f093fb);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: gradientShift 3s ease-in-out infinite;
        }

        @keyframes gradientShift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        .nav-links {
            display: flex;
            gap: 20px;
        }

        .nav-link {
            padding: 10px 20px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 25px;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 0.9rem;
            backdrop-filter: blur(10px);
        }

        .nav-link.active {
            background: linear-gradient(45deg, #667eea, #764ba2);
            border-color: transparent;
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }

        .nav-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
            position: relative;
            z-index: 10;
        }

        .page-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .page-title {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 10px;
            background: linear-gradient(45deg, #e74c3c, #f39c12, #f1c40f);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .page-subtitle {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1.1rem;
        }

        .admin-icon {
            font-size: 4rem;
            margin-bottom: 20px;
            background: linear-gradient(45deg, #e74c3c, #f39c12);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .filter-section {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 30px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            margin-bottom: 30px;
        }

        .filter-form {
            display: flex;
            gap: 20px;
            align-items: end;
            flex-wrap: wrap;
        }

        .filter-group {
            flex: 1;
            min-width: 200px;
        }

        .filter-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.9);
        }

        .filter-input {
            width: 100%;
            padding: 15px 20px;
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            color: white;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .filter-input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 20px rgba(102, 126, 234, 0.4);
            background: rgba(255, 255, 255, 0.15);
        }

        .filter-btn {
            padding: 15px 25px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            border: none;
            border-radius: 10px;
            color: white;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 10px;
        }

        .filter-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 25px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            text-align: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(45deg, #667eea, #764ba2);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }

        .stat-card.revenue::before {
            background: linear-gradient(45deg, #f39c12, #e74c3c);
        }

        .stat-card.vehicles::before {
            background: linear-gradient(45deg, #2ecc71, #27ae60);
        }

        .stat-card.motor::before {
            background: linear-gradient(45deg, #3498db, #2980b9);
        }

        .stat-card.mobil::before {
            background: linear-gradient(45deg, #9b59b6, #8e44ad);
        }

        .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 5px;
            color: #fff;
        }

        .stat-label {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
        }

        .report-section {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 30px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .report-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .report-title {
            font-size: 1.5rem;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .export-btn {
            padding: 10px 20px;
            background: linear-gradient(45deg, #2ecc71, #27ae60);
            border: none;
            border-radius: 10px;
            color: white;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .export-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(46, 204, 113, 0.4);
        }

        .report-table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
        }

        .report-table th {
            background: rgba(102, 126, 234, 0.3);
            padding: 15px;
            text-align: left;
            font-weight: bold;
            color: #fff;
            border-bottom: 2px solid rgba(255, 255, 255, 0.2);
        }

        .report-table td {
            padding: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.9);
        }

        .report-table tr:last-child td {
            border-bottom: none;
        }

        .report-table tr:hover {
            background: rgba(255, 255, 255, 0.05);
        }

        .vehicle-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .vehicle-badge.motor {
            background: rgba(52, 152, 219, 0.3);
            color: #3498db;
        }

        .vehicle-badge.mobil {
            background: rgba(155, 89, 182, 0.3);
            color: #9b59b6;
        }

        .currency {
            color: #f39c12;
            font-weight: bold;
        }

        .no-data {
            text-align: center;
            color: rgba(255, 255, 255, 0.6);
            font-style: italic;
            padding: 40px;
        }

        .loading {
            text-align: center;
            padding: 40px;
            color: rgba(255, 255, 255, 0.8);
        }

        .loading-spinner {
            display: inline-block;
            width: 40px;
            height: 40px;
            border: 4px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: #667eea;
            animation: spin 1s ease-in-out infinite;
            margin-bottom: 10px;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 15px;
            }

            .nav-links {
                gap: 10px;
                flex-wrap: wrap;
            }

            .nav-link {
                padding: 8px 15px;
                font-size: 0.8rem;
            }

            .page-title {
                font-size: 2rem;
            }

            .filter-form {
                flex-direction: column;
                gap: 15px;
            }

            .filter-group {
                min-width: auto;
            }

            .report-header {
                flex-direction: column;
                gap: 15px;
                align-items: start;
            }

            .report-table {
                font-size: 0.9rem;
            }

            .report-table th,
            .report-table td {
                padding: 10px 8px;
            }
        }
    </style>
</head>
<body>
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="header">
        <div class="header-content">
            <div class="logo">SmartPark</div>
            <div class="nav-links">
                <a href="../parkir/add" class="nav-link">Masuk Kendaraan</a>
                <a href="../parkir/delete" class="nav-link">Keluar Kendaraan</a>
                <a href="../parkir/aktif" class="nav-link">Dashboard</a>
                <a href="../admin/tarif" class="nav-link">Kelola Tarif</a>
                <a href="../admin/laporan" class="nav-link active">Laporan Harian</a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="page-header">
            <div class="admin-icon">📊</div>
            <h1 class="page-title">Laporan Harian Parkir</h1>
            <p class="page-subtitle">Monitoring dan analisis data parkir harian</p>
        </div>

        <div class="filter-section">
            <form class="filter-form" id="filterForm" method="GET" action="<?= BASEURL ?>/admin/laporan">
                <div class="filter-group">
                    <label class="filter-label">Tanggal</label>
                    <input 
                        type="date" 
                        class="filter-input" 
                        id="tanggal"
                        name="tanggal"
                        value="<?= $tanggal ?>"
                    >
                </div>
                <div class="filter-group">
                    <label class="filter-label">Jenis Kendaraan</label>
                    <select class="filter-input" id="jenisFilter" name="jenis">
                        <option value="">Semua Jenis</option>
                        <option value="motor" <?= $jenisFilter === 'motor' ? 'selected' : '' ?>>Motor</option>
                        <option value="mobil" <?= $jenisFilter === 'mobil' ? 'selected' : '' ?>>Mobil</option>
                    </select>
                </div>
                <div class="filter-group">
                    <button type="submit" class="filter-btn">
                        🔍 Tampilkan Laporan
                    </button>
                </div>
            </form>            
        </div>

        <div class="stats-grid">
            <div class="stat-card revenue">
                <div class="stat-icon">💰</div>
                <div class="stat-value" id="totalRevenue">Rp <?= number_format($statistik['total_pendapatan'] ?? 0, 0, ',', '.') ?></div>
                <div class="stat-label">Total Pendapatan</div>
            </div>
            <div class="stat-card vehicles">
                <div class="stat-icon">🚗</div>
                <div class="stat-value" id="totalVehicles"><?= $statistik['total_kendaraan'] ?? 0 ?></div>
                <div class="stat-label">Total Kendaraan</div>
            </div>
            <div class="stat-card motor">
                <div class="stat-icon">🏍️</div>
                <div class="stat-value" id="totalMotor"><?= $statistik['total_motor'] ?? 0 ?></div>
                <div class="stat-label">Motor</div>
            </div>
            <div class="stat-card mobil">
                <div class="stat-icon">🚙</div>
                <div class="stat-value" id="totalMobil"><?= $statistik['total_mobil'] ?? 0 ?></div>
                <div class="stat-label">Mobil</div>
            </div>
        </div>

        <div class="report-section">
            <div class="report-header">
                <h2 class="report-title">
                    📋 Detail Transaksi
                    <span id="reportDate"></span>
                </h2>
                <a href="<?= BASEURL ?>/admin/export-csv?tanggal=<?= $tanggal ?>&jenis=<?= $jenisFilter ?>" class="export-btn">
                    📄 Export CSV
                </a>
            </div>

            <div id="loadingState" class="loading" style="display: none;">
                <div class="loading-spinner"></div>
                <p>Memuat data laporan...</p>
            </div>

            <div style="overflow-x: auto;">
                <table class="report-table" id="reportTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Plat Nomor</th>
                            <th>Jenis</th>
                            <th>Waktu Masuk</th>
                            <th>Waktu Keluar</th>
                            <th>Durasi</th>
                            <th>Biaya</th>
                        </tr>
                    </thead>
                    <tbody id="reportTableBody">
                        <?php if (empty($transaksi)) : ?>
                            <tr>
                                <td colspan="7" class="no-data">
                                    Tidak ada data transaksi pada tanggal yang dipilih
                                </td>
                            </tr>
                        <?php else : ?>
                            <?php $no = 1; ?>
                            <?php foreach ($transaksi as $t) : ?>
                                <?php
                                // Hitung durasi
                                $durasi = '';
                                if ($t['waktu_masuk'] && $t['waktu_keluar']) {
                                    $masuk = new DateTime($t['waktu_masuk']);
                                    $keluar = new DateTime($t['waktu_keluar']);
                                    $interval = $masuk->diff($keluar);
                                    $durasi = $interval->format('%h jam %i menit');
                                }
                                ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><strong><?= htmlspecialchars($t['plat_nomor']) ?></strong></td>
                                    <td>
                                        <span class="vehicle-badge <?= $t['jenis'] ?>">
                                            <?= $t['jenis'] === 'motor' ? '🏍️' : '🚗' ?>
                                            <?= ucfirst($t['jenis']) ?>
                                        </span>
                                    </td>
                                    <td><?= date('d/m/Y H:i', strtotime($t['waktu_masuk'])) ?></td>
                                    <td><?= $t['waktu_keluar'] ? date('d/m/Y H:i', strtotime($t['waktu_keluar'])) : '-' ?></td>
                                    <td><?= $durasi ?></td>
                                    <td><span class="currency">Rp <?= number_format($t['biaya'], 0, ',', '.') ?></span></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>