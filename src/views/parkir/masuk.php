<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartPark - Masuk Kendaraan</title>
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
            background: linear-gradient(45deg, #667eea, #764ba2);
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
            background: linear-gradient(45deg, #667eea, #764ba2);
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
            border-color: #667eea;
            box-shadow: 0 0 25px rgba(102, 126, 234, 0.4);
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-2px);
        }

        .form-input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .form-select {
            width: 100%;
            padding: 18px 25px;
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            color: white;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .form-select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 25px rgba(102, 126, 234, 0.4);
            background: rgba(255, 255, 255, 0.15);
        }

        .form-select option {
            background: #1a1a2e;
            color: white;
            padding: 10px;
        }

        .vehicle-type-selector {
            display: flex;
            gap: 20px;
            margin-top: 10px;
        }

        .vehicle-option {
            flex: 1;
            padding: 20px;
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .vehicle-option:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }

        .vehicle-option.selected {
            background: linear-gradient(45deg, #667eea, #764ba2);
            border-color: transparent;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
        }

        .vehicle-icon {
            font-size: 2.5rem;
            margin-bottom: 10px;
            display: block;
        }

        .vehicle-label {
            font-weight: 500;
            font-size: 1.1rem;
        }

        .datetime-display {
            background: rgba(102, 126, 234, 0.2);
            border: 1px solid rgba(102, 126, 234, 0.3);
            border-radius: 15px;
            padding: 18px 25px;
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.9);
            text-align: center;
            margin-top: 10px;
            backdrop-filter: blur(10px);
        }

        .submit-btn {
            width: 100%;
            padding: 18px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            border: none;
            border-radius: 15px;
            color: white;
            font-size: 1.2rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 30px;
            position: relative;
            overflow: hidden;
        }

        .submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.5);
        }

        .submit-btn:active {
            transform: translateY(-1px);
        }

        .submit-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .submit-btn:hover::before {
            left: 100%;
        }

        .success-message {
            background: rgba(46, 204, 113, 0.2);
            border: 1px solid rgba(46, 204, 113, 0.3);
            border-radius: 15px;
            padding: 20px;
            margin-top: 20px;
            text-align: center;
            display: none;
            animation: fadeInScale 0.5s ease-out;
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

        .success-icon {
            font-size: 3rem;
            color: #2ecc71;
            margin-bottom: 10px;
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

            .vehicle-type-selector {
                flex-direction: column;
                gap: 15px;
            }

            .vehicle-option {
                padding: 15px;
            }

            .vehicle-icon {
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
                <a href="../parkir/add" class="nav-link active">Masuk Kendaraan</a>
                <a href="../parkir/delete" class="nav-link">Keluar Kendaraan</a>
                <a href="../parkir/aktif" class="nav-link">Dashboard</a>
                <a href="../admin/tarif" class="nav-link">Kelola Tarif</a>
                <a href="../admin/laporan" class="nav-link">Laporan Harian</a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="form-card">
            <div class="form-header">
                <div class="form-icon">🚗</div>
                <h1 class="form-title">Masuk Kendaraan</h1>
                <p class="form-subtitle">Daftarkan kendaraan yang akan masuk area parkir</p>
            </div>

            <form id="entryForm" method="POST" action="<?= BASEURL ?>/parkir/add-parkir">
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

                <div class="form-group">
                    <label class="form-label">Jenis Kendaraan</label>
                    <div class="vehicle-type-selector">
                        <div class="vehicle-option" onclick="selectVehicle('motor', this)">
                            <span class="vehicle-icon">🏍️</span>
                            <div class="vehicle-label">Motor</div>
                        </div>
                        <div class="vehicle-option" onclick="selectVehicle('mobil', this)">
                            <span class="vehicle-icon">🚗</span>
                            <div class="vehicle-label">Mobil</div>
                        </div>
                    </div>
                    <input type="hidden" id="jenisKendaraan" name="jenis" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Waktu Masuk</label>
                    <div class="datetime-display" id="waktuMasuk">
                        <!-- Will be populated by JavaScript -->
                    </div>
                </div>

                <button type="submit" class="submit-btn">
                    <span>🎫 Buat Tiket Masuk</span>
                </button>
            </form>
            <?php
            if (isset($_SESSION['success'])): ?>
                <div class="success-message" style="display: block;">
                    <div class="success-icon">✅</div>
                    <h3><?= $_SESSION['success'] ?></h3>
                </div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="success-message error" style="display: block; background: rgba(231, 76, 60, 0.2); border-color: rgba(231, 76, 60, 0.3);">
                    <div class="success-icon">❌</div>
                    <h3><?= $_SESSION['error'] ?></h3>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>            
        </div>
    </div>

    <script>
        let selectedVehicleType = '';

        // Update current time
        function updateDateTime() {
            const now = new Date();
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                timeZone: 'Asia/Jakarta'
            };
            document.getElementById('waktuMasuk').textContent = 
                now.toLocaleDateString('id-ID', options) + ' WIB';
        }

        // Update time every second
        setInterval(updateDateTime, 1000);
        updateDateTime();

        // Vehicle selection
        function selectVehicle(type, element) {
            // Remove previous selection
            document.querySelectorAll('.vehicle-option').forEach(opt => {
                opt.classList.remove('selected');
            });
            
            // Add selection to clicked element
            element.classList.add('selected');
            selectedVehicleType = type;
            document.getElementById('jenisKendaraan').value = type;
        }

        // Form submission
        // document.getElementById('entryForm').addEventListener('submit', function(e) {
        //     e.preventDefault();
            
        //     const platNomor = document.getElementById('platNomor').value.trim().toUpperCase();
        //     const jenisKendaraan = document.getElementById('jenisKendaraan').value;
            
        //     if (!platNomor || !jenisKendaraan) {
        //         alert('Mohon lengkapi semua data!');
        //         return;
        //     }

        //     // Simulate API call
        //     const submitBtn = document.querySelector('.submit-btn');
        //     const originalText = submitBtn.innerHTML;
            
        //     submitBtn.innerHTML = '<span>⏳ Memproses...</span>';
        //     submitBtn.disabled = true;

        //     setTimeout(() => {
        //         // Simulate successful entry
        //         const ticketNumber = 'SP' + Date.now().toString().slice(-6);
        //         const currentTime = new Date().toLocaleString('id-ID', {
        //             timeZone: 'Asia/Jakarta',
        //             hour12: false
        //         });

        //         document.getElementById('ticketInfo').innerHTML = `
        //             <strong>Nomor Tiket:</strong> ${ticketNumber}<br>
        //             <strong>Plat Nomor:</strong> ${platNomor}<br>
        //             <strong>Jenis:</strong> ${jenisKendaraan.charAt(0).toUpperCase() + jenisKendaraan.slice(1)}<br>
        //             <strong>Waktu Masuk:</strong> ${currentTime} WIB
        //         `;

        //         document.getElementById('successMessage').style.display = 'block';
                
        //         // Reset form
        //         document.getElementById('entryForm').reset();
        //         document.querySelectorAll('.vehicle-option').forEach(opt => {
        //             opt.classList.remove('selected');
        //         });
        //         selectedVehicleType = '';
                
        //         submitBtn.innerHTML = originalText;
        //         submitBtn.disabled = false;

        //         // Hide success message after 5 seconds
        //         setTimeout(() => {
        //             document.getElementById('successMessage').style.display = 'none';
        //         }, 5000);
                
        //     }, 1500);
        // });

        document.getElementById('entryForm').addEventListener('submit', function(e) {
            const platNomor = document.getElementById('platNomor').value.trim().toUpperCase();
            const jenisKendaraan = document.getElementById('jenisKendaraan').value;
            
            if (!platNomor || !jenisKendaraan) {
                e.preventDefault();
                alert('Mohon lengkapi semua data!');
                return;
            }

            // Show loading state
            const submitBtn = document.querySelector('.submit-btn');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<span>⏳ Memproses...</span>';
            submitBtn.disabled = true;
        });        

        // Plate number formatting
        document.getElementById('platNomor').addEventListener('input', function(e) {
            // Auto uppercase and format
            let value = e.target.value.toUpperCase();
            e.target.value = value;
        });

        // Navigation function
        function goToExit() {
            // In real app, this would navigate to exit form
            alert('Navigasi ke halaman Keluar Kendaraan');
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
    </script>
</body>
</html>