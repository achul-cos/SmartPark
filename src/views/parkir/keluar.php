<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartPark - Keluar Kendaraan</title>
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
            max-width: 800px;
            margin: 0 auto;
            padding: 40px 20px;
            position: relative;
            z-index: 10;
        }

        .form-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 40px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            animation: slideInUp 0.8s ease-out;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .form-title {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 10px;
            background: linear-gradient(45deg, #e74c3c, #f39c12);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .form-subtitle {
            color: rgba(255, 255, 255, 0.8);
            font-size: 1.1rem;
        }

        .form-icon {
            font-size: 4rem;
            margin-bottom: 20px;
            background: linear-gradient(45deg, #e74c3c, #f39c12);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.9);
            font-size: 1rem;
        }

        .form-input {
            width: 100%;
            padding: 18px 25px;
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            color: white;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: #e74c3c;
            box-shadow: 0 0 25px rgba(231, 76, 60, 0.4);
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-2px);
        }

        .form-input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .search-btn {
            width: 100%;
            padding: 18px;
            background: linear-gradient(45deg, #e74c3c, #f39c12);
            border: none;
            border-radius: 15px;
            color: white;
            font-size: 1.2rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 20px;
            position: relative;
            overflow: hidden;
        }

        .search-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(231, 76, 60, 0.5);
        }

        .search-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .search-btn:hover::before {
            left: 100%;
        }

        .vehicle-info {
            background: rgba(46, 204, 113, 0.2);
            border: 1px solid rgba(46, 204, 113, 0.3);
            border-radius: 15px;
            padding: 30px;
            margin-top: 30px;
            display: none;
            animation: fadeInScale 0.5s ease-out;
        }

        .vehicle-info.error {
            background: rgba(231, 76, 60, 0.2);
            border-color: rgba(231, 76, 60, 0.3);
        }

        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.8);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .info-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
            font-size: 1.5rem;
            font-weight: bold;
        }

        .vehicle-icon {
            font-size: 3rem;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .info-item {
            background: rgba(255, 255, 255, 0.1);
            padding: 15px;
            border-radius: 10px;
            backdrop-filter: blur(10px);
        }

        .info-label {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.7);
            margin-bottom: 5px;
        }

        .info-value {
            font-size: 1.2rem;
            font-weight: bold;
        }

        .duration-display {
            background: rgba(52, 152, 219, 0.2);
            border: 1px solid rgba(52, 152, 219, 0.3);
            border-radius: 15px;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
        }

        .duration-text {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .duration-detail {
            color: rgba(255, 255, 255, 0.8);
        }

        .cost-display {
            background: linear-gradient(45deg, rgba(46, 204, 113, 0.2), rgba(39, 174, 96, 0.2));
            border: 1px solid rgba(46, 204, 113, 0.3);
            border-radius: 15px;
            padding: 25px;
            text-align: center;
            margin-bottom: 30px;
        }

        .cost-amount {
            font-size: 2.5rem;
            font-weight: bold;
            color: #2ecc71;
            margin-bottom: 10px;
        }

        .cost-breakdown {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
        }

        .checkout-btn {
            width: 100%;
            padding: 20px;
            background: linear-gradient(45deg, #2ecc71, #27ae60);
            border: none;
            border-radius: 15px;
            color: white;
            font-size: 1.3rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .checkout-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(46, 204, 113, 0.5);
        }

        .success-message {
            background: rgba(46, 204, 113, 0.2);
            border: 1px solid rgba(46, 204, 113, 0.3);
            border-radius: 15px;
            padding: 30px;
            margin-top: 30px;
            text-align: center;
            display: none;
            animation: fadeInScale 0.5s ease-out;
        }

        .success-icon {
            font-size: 4rem;
            color: #2ecc71;
            margin-bottom: 15px;
        }

        .receipt {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
            backdrop-filter: blur(10px);
        }

        .receipt-title {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 15px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            padding-bottom: 10px;
        }

        .receipt-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 0.9rem;
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

            .form-card {
                padding: 30px 20px;
                margin: 20px 10px;
            }

            .form-title {
                font-size: 2rem;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .cost-amount {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>  
<?php
if (isset($_SESSION['exit_data'])) {
    $exit_data = $_SESSION['exit_data'];
    unset($_SESSION['exit_data']);
    echo "<script>showVehicleInfoOnExit(".json_encode($exit_data).");</script>";
}

if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
    echo "<script>showErrorOnExit('".addslashes($error)."');</script>";
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
                <a href="../parkir/delete" class="nav-link active">Keluar Kendaraan</a>
                <a href="../parkir/aktif" class="nav-link">Dashboard</a>
                <a href="../admin/tarif" class="nav-link">Kelola Tarif</a>
                <a href="../admin/laporan" class="nav-link">Laporan Harian</a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="form-card">
            <div class="form-header">
                <div class="form-icon">🚙</div>
                <h1 class="form-title">Keluar Kendaraan</h1>
                <p class="form-subtitle">Masukkan nomor plat untuk menghitung biaya parkir</p>
            </div>

            <form id="exitForm" method="POST" action="<?= BASEURL ?>/parkir/delete-parkir">
                <div class="form-group">
                    <label class="form-label">Nomor Plat Kendaraan</label>
                    <input 
                        type="text" 
                        class="form-input" 
                        id="platNomor"
                        name="plat_nomor"
                        placeholder="Contoh: B 1234 CD"
                        required
                        style="text-transform: uppercase;"
                    >
                </div>

                <button type="submit" class="search-btn">
                    <span>🔍 Cari Kendaraan</span>
                </button>
            </form>

            <div class="vehicle-info" id="vehicleInfo">
                <div class="info-header">
                    <span class="vehicle-icon" id="vehicleIcon">🚗</span>
                    <div>
                        <div>Kendaraan Ditemukan</div>
                        <div style="font-size: 1rem; font-weight: normal; color: rgba(255,255,255,0.8);" id="plateDisplay"></div>
                    </div>
                </div>

                <div class="info-grid">
                    <div class="info-item">
                        <div class="info-label">Jenis Kendaraan</div>
                        <div class="info-value" id="vehicleType"></div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Waktu Masuk</div>
                        <div class="info-value" id="entryTime"></div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Waktu Keluar</div>
                        <div class="info-value" id="exitTime"></div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Nomor Tiket</div>
                        <div class="info-value" id="ticketNumber"></div>
                    </div>
                </div>

                <div class="duration-display">
                    <div class="duration-text" id="durationText">2 jam 35 menit</div>
                    <div class="duration-detail">Durasi parkir total</div>
                </div>

                <div class="cost-display">
                    <div class="cost-amount" id="totalCost">Rp 15.000</div>
                    <div class="cost-breakdown" id="costBreakdown">
                        Tarif: Rp 5.000/jam × 3 jam = Rp 15.000
                    </div>
                </div>

                <button class="checkout-btn" onclick="processCheckout()">
                    💳 Proses Pembayaran & Keluar
                </button>
            </div>

            <div class="vehicle-info error" id="errorInfo" style="display: none;">
                <div class="info-header">
                    <span class="vehicle-icon">❌</span>
                    <div>Kendaraan Tidak Ditemukan</div>
                </div>
                <p style="text-align: center; margin-top: 20px; color: rgba(255,255,255,0.8);">
                    Nomor plat tidak ditemukan dalam sistem atau kendaraan sudah keluar.
                </p>
            </div>

            <div class="success-message" id="successMessage">
                <div class="success-icon">✅</div>
                <h3>Pembayaran Berhasil!</h3>
                <p>Kendaraan telah berhasil keluar dari area parkir</p>
                
                <div class="receipt">
                    <div class="receipt-title">🧾 STRUK PEMBAYARAN PARKIR</div>
                    <div class="receipt-item">
                        <span>Nomor Plat:</span>
                        <span id="receiptPlate"></span>
                    </div>
                    <div class="receipt-item">
                        <span>Jenis Kendaraan:</span>
                        <span id="receiptType"></span>
                    </div>
                    <div class="receipt-item">
                        <span>Waktu Masuk:</span>
                        <span id="receiptEntry"></span>
                    </div>
                    <div class="receipt-item">
                        <span>Waktu Keluar:</span>
                        <span id="receiptExit"></span>
                    </div>
                    <div class="receipt-item">
                        <span>Durasi:</span>
                        <span id="receiptDuration"></span>
                    </div>
                    <div class="receipt-item" style="border-top: 1px solid rgba(255,255,255,0.2); padding-top: 10px; font-weight: bold; font-size: 1rem;">
                        <span>Total Biaya:</span>
                        <span id="receiptTotal"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showErrorOnExit(message) {
            // Hide vehicle info
            document.getElementById('vehicleInfo').style.display = 'none';
            
            // Show error message
            document.getElementById('errorInfo').style.display = 'block';
            const errorMessage = document.getElementById('errorInfo').querySelector('p');
            if (errorMessage) {
                errorMessage.textContent = message;
            }
        }        
        function showVehicleInfoOnExit(data) {
            // Set nilai input plat nomor
            document.getElementById('platNomor').value = data.plat_nomor;
            
            // Tampilkan info kendaraan
            document.getElementById('vehicleIcon').textContent = data.jenis === 'mobil' ? '🚗' : '🏍️';
            document.getElementById('plateDisplay').textContent = data.plat_nomor;
            document.getElementById('vehicleType').textContent = data.jenis.charAt(0).toUpperCase() + data.jenis.slice(1);
            document.getElementById('entryTime').textContent = data.waktu_masuk;
            document.getElementById('ticketNumber').textContent = 'SP' + (Date.now().toString().slice(-6)); // Simulasikan nomor tiket
            document.getElementById('durationText').textContent = data.durasi;
            document.getElementById('totalCost').textContent = 'Rp ' + data.biaya.toLocaleString('id-ID');
            document.getElementById('costBreakdown').textContent = `Tarif: Rp ${tarifs[data.jenis].toLocaleString('id-ID')}/jam × ${hours} jam = Rp ${data.biaya.toLocaleString('id-ID')}`;
            
            // Set waktu keluar ke waktu sekarang
            updateExitTime();
            
            // Show vehicle info
            document.getElementById('vehicleInfo').style.display = 'block';
        }

        function showErrorOnExit(message) {
            // Hide vehicle info
            document.getElementById('vehicleInfo').style.display = 'none';
            
            // Show error message
            document.getElementById('errorInfo').style.display = 'block';
            document.getElementById('errorInfo').querySelector('p').textContent = message;
        }

        // Sample data for demonstration
        const parkedVehicles = {
            'B1234CD': {
                id: 1,
                plat_nomor: 'B 1234 CD',
                jenis: 'mobil',
                waktu_masuk: new Date(Date.now() - 2.5 * 60 * 60 * 1000), // 2.5 hours ago
                ticket: 'SP' + (Date.now().toString().slice(-6))
            },
            'D5678EF': {
                id: 2,
                plat_nomor: 'D 5678 EF',
                jenis: 'motor',
                waktu_masuk: new Date(Date.now() - 1.2 * 60 * 60 * 1000), // 1.2 hours ago
                ticket: 'SP' + (Date.now().toString().slice(-5))
            }
        };

        const tariffs = {
            mobil: 5000,
            motor: 2000
        };

        let currentVehicle = null;

        // Real-time clock update
        function updateExitTime() {
            const now = new Date();
            const timeString = now.toLocaleString('id-ID', {
                timeZone: 'Asia/Jakarta',
                hour12: false
            }) + ' WIB';
            
            const exitTimeElement = document.getElementById('exitTime');
            if (exitTimeElement) {
                exitTimeElement.textContent = timeString;
            }
        }

        setInterval(updateExitTime, 1000);

        // Form submission
        // document.getElementById('exitForm').addEventListener('submit', function(e) {
        //     e.preventDefault();
            
        //     const platNomor = document.getElementById('platNomor').value.trim().toUpperCase().replace(/\s+/g, '');
            
        //     if (!platNomor) {
        //         alert('Mohon masukkan nomor plat!');
        //         return;
        //     }

        //     // Simulate API call
        //     const searchBtn = document.querySelector('.search-btn');
        //     const originalText = searchBtn.innerHTML;
            
        //     searchBtn.innerHTML = '<span>⏳ Mencari...</span>';
        //     searchBtn.disabled = true;

        //     setTimeout(() => {
        //         const vehicle = parkedVehicles[platNomor];
                
        //         if (vehicle) {
        //             showVehicleInfo(vehicle);
        //         } else {
        //             showError();
        //         }
                
        //         searchBtn.innerHTML = originalText;
        //         searchBtn.disabled = false;
        //     }, 1500);
        // });

        function showVehicleInfo(vehicle) {
            currentVehicle = vehicle;
            
            // Hide error info
            document.getElementById('errorInfo').style.display = 'none';
            
            // Calculate duration and cost
            const now = new Date();
            const entryTime = vehicle.waktu_masuk;
            const durationMs = now - entryTime;
            const durationHours = Math.ceil(durationMs / (1000 * 60 * 60)); // Round up to next hour
            const cost = durationHours * tariffs[vehicle.jenis];
            
            // Format duration
            const hours = Math.floor(durationMs / (1000 * 60 * 60));
            const minutes = Math.floor((durationMs % (1000 * 60 * 60)) / (1000 * 60));
            const durationText = hours > 0 ? `${hours} jam ${minutes} menit` : `${minutes} menit`;
            
            // Update display
            document.getElementById('vehicleIcon').textContent = vehicle.jenis === 'mobil' ? '🚗' : '🏍️';
            document.getElementById('plateDisplay').textContent = vehicle.plat_nomor;
            document.getElementById('vehicleType').textContent = vehicle.jenis.charAt(0).toUpperCase() + vehicle.jenis.slice(1);
            document.getElementById('entryTime').textContent = entryTime.toLocaleString('id-ID', {
                timeZone: 'Asia/Jakarta',
                hour12: false
            }) + ' WIB';
            document.getElementById('ticketNumber').textContent = vehicle.ticket;
            document.getElementById('durationText').textContent = durationText;
            document.getElementById('totalCost').textContent = `Rp ${cost.toLocaleString('id-ID')}`;
            document.getElementById('costBreakdown').textContent = 
                `Tarif: Rp ${tariffs[vehicle.jenis].toLocaleString('id-ID')}/jam × ${durationHours} jam = Rp ${cost.toLocaleString('id-ID')}`;
            
            updateExitTime();
            
            // Show vehicle info
            document.getElementById('vehicleInfo').style.display = 'block';
        }

        function showError() {
            document.getElementById('vehicleInfo').style.display = 'none';
            document.getElementById('errorInfo').style.display = 'block';
        }

        function processCheckout() {
            if (!currentVehicle) return;
            
            const checkoutBtn = document.querySelector('.checkout-btn');
            const originalText = checkoutBtn.innerHTML;
            
            checkoutBtn.innerHTML = '⏳ Memproses Pembayaran...';
            checkoutBtn.disabled = true;

            setTimeout(() => {
                // Calculate final values for receipt
                const now = new Date();
                const entryTime = currentVehicle.waktu_masuk;
                const durationMs = now - entryTime;
                const durationHours = Math.ceil(durationMs / (1000 * 60 * 60));
                const cost = durationHours * tariffs[currentVehicle.jenis];
                
                const hours = Math.floor(durationMs / (1000 * 60 * 60));
                const minutes = Math.floor((durationMs % (1000 * 60 * 60)) / (1000 * 60));
                const durationText = hours > 0 ? `${hours} jam ${minutes} menit` : `${minutes} menit`;
                
                // Update receipt
                document.getElementById('receiptPlate').textContent = currentVehicle.plat_nomor;
                document.getElementById('receiptType').textContent = currentVehicle.jenis.charAt(0).toUpperCase() + currentVehicle.jenis.slice(1);
                document.getElementById('receiptEntry').textContent = entryTime.toLocaleString('id-ID', {
                    timeZone: 'Asia/Jakarta',
                    hour12: false
                }) + ' WIB';
                document.getElementById('receiptExit').textContent = now.toLocaleString('id-ID', {
                    timeZone: 'Asia/Jakarta',
                    hour12: false
                }) + ' WIB';
                document.getElementById('receiptDuration').textContent = durationText;
                document.getElementById('receiptTotal').textContent = `Rp ${cost.toLocaleString('id-ID')}`;
                
                // Hide vehicle info and show success
                document.getElementById('vehicleInfo').style.display = 'none';
                document.getElementById('successMessage').style.display = 'block';
                
                // Reset form
                document.getElementById('exitForm').reset();
                currentVehicle = null;
                
                // Remove from parked vehicles (simulate database update)
                const plateKey = currentVehicle?.plat_nomor.replace(/\s+/g, '').toUpperCase();
                if (plateKey && parkedVehicles[plateKey]) {
                    delete parkedVehicles[plateKey];
                }
                
                checkoutBtn.innerHTML = originalText;
                checkoutBtn.disabled = false;

                // Hide success message after 8 seconds
                setTimeout(() => {
                    document.getElementById('successMessage').style.display = 'none';
                }, 8000);
                
            }, 2000);
        }

        // Plate number formatting
        document.getElementById('platNomor').addEventListener('input', function(e) {
            let value = e.target.value.toUpperCase();
            e.target.value = value;
        });

        // Navigation function
        function goToEntry() {
            alert('Navigasi ke halaman Masuk Kendaraan');
        }

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
        function showVehicleInfoOnExit(data) {
            // Set nilai input plat nomor
            document.getElementById('platNomor').value = data.plat_nomor;
            
            // Tampilkan info kendaraan
            document.getElementById('vehicleIcon').textContent = data.jenis === 'mobil' ? '🚗' : '🏍️';
            document.getElementById('plateDisplay').textContent = data.plat_nomor;
            document.getElementById('vehicleType').textContent = data.jenis.charAt(0).toUpperCase() + data.jenis.slice(1);
            document.getElementById('entryTime').textContent = data.waktu_masuk;
            document.getElementById('ticketNumber').textContent = 'SP' + (Date.now().toString().slice(-6));
            document.getElementById('durationText').textContent = data.durasi;
            document.getElementById('totalCost').textContent = 'Rp ' + data.biaya.toLocaleString('id-ID');
            document.getElementById('costBreakdown').textContent = 'Tarif: Rp ...'; // Anda bisa sesuaikan jika ada data tarif per jam
            
            // Set waktu keluar ke waktu sekarang
            updateExitTime();
            
            // Show vehicle info
            document.getElementById('vehicleInfo').style.display = 'block';
        }        
    </script>
</body>
</html>