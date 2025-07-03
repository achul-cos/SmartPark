<?php
// File: src/views/parkir/aktif.php
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartPark - Kendaraan Terparkir</title>
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

        .dashboard-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .dashboard-title {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 10px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .dashboard-subtitle {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1.1rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-bottom: 50px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 30px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            text-align: center;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }

        .stat-icon {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .stat-label {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1.1rem;
        }

        .table-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 30px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            overflow-x: auto;
        }

        .parking-table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
        }

        .parking-table th {
            background: rgba(102, 126, 234, 0.3);
            padding: 15px;
            text-align: left;
            font-weight: bold;
            color: #fff;
        }

        .parking-table td {
            padding: 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .parking-table tr:last-child td {
            border-bottom: none;
        }

        .parking-table tr:hover {
            background: rgba(255, 255, 255, 0.05);
        }

        .vehicle-icon-cell {
            font-size: 1.5rem;
            text-align: center;
        }

        .no-data {
            text-align: center;
            padding: 30px;
            color: rgba(255, 255, 255, 0.6);
        }

        .action-button {
            padding: 8px 15px;
            background: rgba(231, 76, 60, 0.3);
            border: 1px solid rgba(231, 76, 60, 0.5);
            border-radius: 8px;
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .action-button:hover {
            background: rgba(231, 76, 60, 0.5);
        }

        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 15px;
            }

            .nav-links {
                gap: 10px;
            }

            .nav-link {
                padding: 8px 15px;
                font-size: 0.8rem;
            }

            .dashboard-title {
                font-size: 2rem;
            }

            .stat-card {
                padding: 20px;
            }

            .stat-value {
                font-size: 2rem;
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
                <a href="../parkir/aktif" class="nav-link active">Dashboard</a>
                <a href="../admin/tarif" class="nav-link">Kelola Tarif</a>
                <a href="../admin/laporan" class="nav-link">Laporan Harian</a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="dashboard-header">
            <h1 class="dashboard-title">Kendaraan Terparkir</h1>
            <p class="dashboard-subtitle">Daftar kendaraan yang saat ini berada di area parkir</p>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">🚗</div>
                <div class="stat-value"><?= count($AllKendaraan) ?></div>
                <div class="stat-label">Total Kendaraan</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">⏱️</div>
                <div class="stat-value"><?= 
                    // Hitung jumlah mobil
                    array_reduce($AllKendaraan, function($carry, $item) {
                        return $carry + ($item['jenis'] === 'mobil' ? 1 : 0);
                    }, 0)
                ?></div>
                <div class="stat-label">Kendaraan Mobil</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">🏍️</div>
                <div class="stat-value"><?= 
                    // Hitung jumlah motor
                    array_reduce($AllKendaraan, function($carry, $item) {
                        return $carry + ($item['jenis'] === 'motor' ? 1 : 0);
                    }, 0)
                ?></div>
                <div class="stat-label">Kendaraan Motor</div>
            </div>
        </div>

        <div class="table-container">
            <?php if (count($AllKendaraan) > 0): ?>
                <table class="parking-table">
                    <thead>
                        <tr>
                            <th style="width: 50px;"></th>
                            <th>Nomor Plat</th>
                            <th>Jenis</th>
                            <th>Waktu Masuk</th>
                            <th>Durasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($AllKendaraan as $kendaraan): ?>
                            <?php
                            $masuk = new DateTime($kendaraan['waktu_masuk']);
                            $sekarang = new DateTime();
                            $durasi = $sekarang->diff($masuk);
                            $durasiText = $durasi->format('%H jam %i menit');
                            ?>
                            <tr>
                                <td class="vehicle-icon-cell">
                                    <?= $kendaraan['jenis'] === 'mobil' ? '🚗' : '🏍️' ?>
                                </td>
                                <td><?= htmlspecialchars($kendaraan['plat_nomor']) ?></td>
                                <td><?= ucfirst($kendaraan['jenis']) ?></td>
                                <td><?= 
                                    date('d M Y H:i', strtotime($kendaraan['waktu_masuk']))
                                ?></td>
                                <td><?= $durasiText ?></td>
                                <td>
                                    <form method="POST" action="<?= BASEURL ?>/parkir/delete-parkir">
                                        <input type="hidden" name="plat_nomor" value="<?php echo $kendaraan['plat_nomor']; ?>">
                                        <button class="action-button">Keluar</button>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="no-data">
                    <h3>Tidak ada kendaraan terparkir</h3>
                    <p>Belum ada kendaraan yang masuk hari ini</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        // Parallax effect for floating shapes
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const shapes = document.querySelectorAll('.shape');
            
            shapes.forEach((shape, index) => {
                const speed = (index + 1) * 0.5;
                shape.style.transform = `translateY(${scrolled * speed}px)`;
            });
        });

        // Mouse movement effect
        document.addEventListener('mousemove', (e) => {
            const shapes = document.querySelectorAll('.shape');
            const x = e.clientX / window.innerWidth;
            const y = e.clientY / window.innerHeight;
            
            shapes.forEach((shape, index) => {
                const speed = (index + 1) * 15;
                const xPos = (x - 0.5) * speed;
                const yPos = (y - 0.5) * speed;
                
                shape.style.transform += ` translate(${xPos}px, ${yPos}px)`;
            });
        });
    </script>
</body>
</html>