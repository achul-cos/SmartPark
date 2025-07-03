<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartPark - Admin Tarif Parkir</title>
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
            background: linear-gradient(45deg, #f39c12, #e74c3c);
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
            background: linear-gradient(45deg, #f39c12, #e74c3c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .tarif-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }

        .tarif-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 30px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .tarif-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(45deg, #667eea, #764ba2);
        }

        .tarif-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
        }

        .vehicle-icon {
            font-size: 2.5rem;
        }

        .vehicle-type {
            font-size: 1.5rem;
            font-weight: bold;
            text-transform: capitalize;
        }

        .current-tarif {
            background: rgba(46, 204, 113, 0.2);
            border: 1px solid rgba(46, 204, 113, 0.3);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            text-align: center;
        }

        .tarif-amount {
            font-size: 2rem;
            font-weight: bold;
            color: #2ecc71;
            margin-bottom: 5px;
        }

        .tarif-label {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.9);
        }

        .form-input {
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

        .form-input:focus {
            outline: none;
            border-color: #f39c12;
            box-shadow: 0 0 20px rgba(243, 156, 18, 0.4);
            background: rgba(255, 255, 255, 0.15);
        }

        .update-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(45deg, #f39c12, #e74c3c);
            border: none;
            border-radius: 10px;
            color: white;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .update-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(243, 156, 18, 0.4);
        }

        .update-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .update-btn:hover::before {
            left: 100%;
        }

        .history-section {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 30px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            margin-top: 40px;
        }

        .history-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .history-table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            overflow-x: auto;
        }

        .history-table th {
            background: rgba(243, 156, 18, 0.3);
            padding: 15px;
            text-align: left;
            font-weight: bold;
            color: #fff;
        }

        .history-table td {
            padding: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .history-table tr:last-child td {
            border-bottom: none;
        }

        .history-table tr:hover {
            background: rgba(255, 255, 255, 0.05);
        }

        .success-message {
            background: rgba(46, 204, 113, 0.2);
            border: 1px solid rgba(46, 204, 113, 0.3);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            text-align: center;
            display: none;
            animation: slideInDown 0.5s ease-out;
        }

        .success-message.show {
            display: block;
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .error-message {
            background: rgba(231, 76, 60, 0.2);
            border: 1px solid rgba(231, 76, 60, 0.3);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            text-align: center;
            display: none;
            animation: slideInDown 0.5s ease-out;
        }

        .error-message.show {
            display: block;
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

            .tarif-cards {
                grid-template-columns: 1fr;
            }

            .tarif-card {
                padding: 20px;
            }

            .tarif-amount {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
<?php
if (isset($_SESSION['success'])) {
    echo "<script>showMessage('".addslashes($_SESSION['success'])."', 'success');</script>";
    unset($_SESSION['success']);
}
if (isset($_SESSION['error'])) {
    echo "<script>showMessage('".addslashes($_SESSION['error'])."', 'error');</script>";
    unset($_SESSION['error']);
}
?>    
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
                <a href="../admin/tarif" class="nav-link active">Kelola Tarif</a>
                <a href="../admin/laporan" class="nav-link">Laporan Harian</a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="page-header">
            <div class="admin-icon">⚙️</div>
            <h1 class="page-title">Kelola Tarif Parkir</h1>
            <p class="page-subtitle">Atur dan kelola tarif parkir untuk setiap jenis kendaraan</p>
        </div>

        <div class="success-message" id="successMessage">
            <strong>✅ Berhasil!</strong> Tarif parkir berhasil diperbarui.
        </div>

        <div class="error-message" id="errorMessage">
            <strong>❌ Error!</strong> Terjadi kesalahan saat memperbarui tarif.
        </div>

        <div class="tarif-cards">
            <!-- Tarif Mobil -->
            <div class="tarif-card">
                <div class="card-header">
                    <div class="vehicle-icon">🚗</div>
                    <div class="vehicle-type">Mobil</div>
                </div>
                
                <div class="current-tarif">
                    <div class="tarif-amount" id="currentTarifMobil">
                        Rp <?= number_format($tarifMobil['tarif_per_jam'] ?? 0, 0, ',', '.') ?>
                    </div>
                    <div class="tarif-label">Per Jam</div>
                </div>

                <!-- Form Mobil -->
                <form id="formTarifMobil" method="POST" action="<?= BASEURL ?>/admin/tarif-update">
                    <input type="hidden" name="jenis" value="mobil">
                    <div class="form-group">
                        <label class="form-label">Tarif Baru (Rp/jam)</label>
                        <input 
                            type="number" 
                            class="form-input" 
                            id="tarifMobil"
                            name="tarif_per_jam"
                            placeholder="<?= $tarifMobil['tarif_per_jam'] ?>"
                            min="1000"
                            max="50000"
                            step="500"
                            required
                        >
                    </div>
                    <button type="submit" class="update-btn">
                        💰 Update Tarif Mobil
                    </button>
                </form>
            </div>

            <!-- Tarif Motor -->
            <div class="tarif-card">
                <div class="card-header">
                    <div class="vehicle-icon">🏍️</div>
                    <div class="vehicle-type">Motor</div>
                </div>
                
                <div class="current-tarif">
                    <div class="tarif-amount" id="currentTarifMobil">
                        Rp <?= number_format($tarifMotor['tarif_per_jam'] ?? 0, 0, ',', '.') ?>
                    </div>
                    <div class="tarif-label">Per Jam</div>
                </div>

                <!-- Form Motor -->
                <form id="formTarifMotor" method="POST" action="<?= BASEURL ?>/admin/tarif-update">
                    <input type="hidden" name="jenis" value="motor">
                    <div class="form-group">
                        <label class="form-label">Tarif Baru (Rp/jam)</label>
                        <input 
                            type="number" 
                            class="form-input" 
                            id="tarifMotor"
                            name="tarif_per_jam"
                            placeholder="<?= $tarifMotor['tarif_per_jam'] ?>"
                            min="500"
                            max="20000"
                            step="500"
                            required
                        >
                    </div>
                    <button type="submit" class="update-btn">
                        💰 Update Tarif Motor
                    </button>
                </form>
            </div>
        </div>

        <!-- <div class="history-section">
            <h2 class="history-title">
                📊 Riwayat Perubahan Tarif
            </h2>
            <div style="overflow-x: auto;">
                <table class="history-table">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Jenis Kendaraan</th>
                            <th>Tarif Lama</th>
                            <th>Tarif Baru</th>
                            <th>Admin</th>
                        </tr>
                    </thead>
                    <tbody id="historyTableBody">
                    </tbody>
                </table>
            </div>
        </div> -->
    </div>
</body>
</html>