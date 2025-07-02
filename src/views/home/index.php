<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - <?= $title ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            overflow-x: hidden;
            color: white;
        }

        .hero-section {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
        }

        .floating-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
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

        .hero-content {
            text-align: center;
            z-index: 10;
            position: relative;
            max-width: 800px;
            padding: 0 20px;
        }

        .logo {
            font-size: 3.5rem;
            font-weight: bold;
            margin-bottom: 20px;
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

        .tagline {
            font-size: 1.3rem;
            margin-bottom: 30px;
            opacity: 0;
            animation: fadeInUp 1s ease-out 0.5s forwards;
        }

        .description {
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 40px;
            opacity: 0;
            animation: fadeInUp 1s ease-out 1s forwards;
            color: rgba(255, 255, 255, 0.9);
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .cta-buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
            opacity: 0;
            animation: fadeInUp 1s ease-out 1.5s forwards;
        }

        .btn {
            padding: 15px 30px;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            position: relative;
            overflow: hidden;
        }

        .btn-primary {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }

        .btn-secondary {
            background: transparent;
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
        }

        .btn-primary:hover {
            box-shadow: 0 15px 35px rgba(102, 126, 234, 0.5);
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn:hover::before {
            left: 100%;
        }

        .features {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            padding: 80px 20px;
            text-align: center;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 40px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 40px 30px;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
            opacity: 0;
            transform: translateY(50px);
            animation: cardSlideUp 0.8s ease-out forwards;
        }

        .feature-card:nth-child(1) { animation-delay: 0.2s; }
        .feature-card:nth-child(2) { animation-delay: 0.4s; }
        .feature-card:nth-child(3) { animation-delay: 0.6s; }

        @keyframes cardSlideUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .feature-card:hover {
            transform: translateY(-10px);
            background: rgba(255, 255, 255, 0.15);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .feature-icon {
            font-size: 3rem;
            margin-bottom: 20px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .feature-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .feature-description {
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.6;
        }

        .demo-section {
            padding: 80px 20px;
            text-align: center;
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        }

        .demo-preview {
            max-width: 800px;
            margin: 40px auto;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 30px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .demo-screen {
            background: #1a1a2e;
            border-radius: 15px;
            padding: 20px;
            min-height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid rgba(102, 126, 234, 0.3);
            position: relative;
            overflow: hidden;
        }

        .demo-screen::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(102, 126, 234, 0.1), transparent);
            animation: scan 3s infinite;
        }

        @keyframes scan {
            0% { left: -100%; }
            100% { left: 100%; }
        }

        .demo-text {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.7);
        }

        .scroll-indicator {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            animation: bounce 2s infinite;
        }

        .scroll-arrow {
            width: 30px;
            height: 30px;
            border-right: 2px solid rgba(255, 255, 255, 0.6);
            border-bottom: 2px solid rgba(255, 255, 255, 0.6);
            transform: rotate(45deg);
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateX(-50%) translateY(0); }
            40% { transform: translateX(-50%) translateY(-10px); }
            60% { transform: translateX(-50%) translateY(-5px); }
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 20px;
            opacity: 0;
            animation: fadeInUp 1s ease-out forwards;
        }

        .section-subtitle {
            font-size: 1.2rem;
            margin-bottom: 40px;
            color: rgba(255, 255, 255, 0.8);
            opacity: 0;
            animation: fadeInUp 1s ease-out 0.3s forwards;
        }

        .parking-animation {
            position: absolute;
            top: 50%;
            right: 10%;
            transform: translateY(-50%);
            width: 200px;
            height: 150px;
            opacity: 0.3;
        }

        .car {
            width: 60px;
            height: 30px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            border-radius: 10px;
            position: absolute;
            animation: parkingMove 4s ease-in-out infinite;
        }

        @keyframes parkingMove {
            0%, 100% { transform: translateX(0) translateY(0); }
            25% { transform: translateX(50px) translateY(-20px); }
            50% { transform: translateX(100px) translateY(0); }
            75% { transform: translateX(50px) translateY(20px); }
        }

        @media (max-width: 768px) {
            .logo { font-size: 2.5rem; }
            .tagline { font-size: 1.1rem; }
            .description { font-size: 1rem; }
            .cta-buttons { flex-direction: column; align-items: center; }
            .btn { width: 200px; }
            .parking-animation { display: none; }
            .features-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="hero-section">
        <div class="floating-shapes">
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
            <div class="shape"></div>
        </div>
        
        <div class="parking-animation">
            <div class="car"></div>
        </div>

        <div class="hero-content">
            <h1 class="logo">SmartPark</h1>
            <p class="tagline">Sistem Parkir Cerdas untuk Masa Depan</p>
            <p class="description">
                Kelola sistem parkir pusat perbelanjaan Anda dengan teknologi terdepan. 
                Otomatis, efisien, dan mudah digunakan untuk semua jenis kendaraan.
            </p>
            <div class="cta-buttons">
                <a href="#demo" class="btn btn-primary" onclick="showDemo()">Lihat Demo</a>
                <a href="#features" class="btn btn-secondary" onclick="scrollToFeatures()">Fitur Lengkap</a>
            </div>
        </div>

        <div class="scroll-indicator">
            <div class="scroll-arrow"></div>
        </div>
    </div>

    <div class="features" id="features">
        <h2 class="section-title">Fitur Unggulan</h2>
        <p class="section-subtitle">Teknologi canggih untuk pengelolaan parkir yang optimal</p>
        
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">🚗</div>
                <h3 class="feature-title">Kelola Masuk & Keluar</h3>
                <p class="feature-description">
                    Sistem otomatis untuk mencatat waktu masuk dan keluar kendaraan dengan akurasi tinggi
                </p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">💰</div>
                <h3 class="feature-title">Hitung Biaya Otomatis</h3>
                <p class="feature-description">
                    Perhitungan biaya parkir otomatis berdasarkan durasi dan jenis kendaraan
                </p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">📊</div>
                <h3 class="feature-title">Laporan Lengkap</h3>
                <p class="feature-description">
                    Dashboard analitik dengan laporan harian, pemasukan, dan statistik kendaraan
                </p>
            </div>
        </div>
    </div>

    <div class="demo-section" id="demo">
        <h2 class="section-title">Preview Sistem</h2>
        <p class="section-subtitle">Antarmuka yang intuitif dan mudah digunakan</p>
        
        <div class="demo-preview">
            <div class="demo-screen">
                <div class="demo-text" id="demo-content">
                    🚀 Sistem siap digunakan! <br>
                    Klik "Mulai Demo" untuk melihat fitur-fitur canggih SmartPark
                </div>
            </div>
            <br>
            <button class="btn btn-primary" onclick="startInteractiveDemo()">Mulai Demo Interaktif</button>
        </div>
    </div>

    <script>
        // Smooth scrolling
        function scrollToFeatures() {
            document.getElementById('features').scrollIntoView({ 
                behavior: 'smooth' 
            });
        }

        function showDemo() {
            document.getElementById('demo').scrollIntoView({ 
                behavior: 'smooth' 
            });
        }

        // Interactive demo
        function startInteractiveDemo() {
            const demoContent = document.getElementById('demo-content');
            const scenarios = [
                {
                    text: "🏢 Selamat datang di SmartPark Dashboard",
                    delay: 1000
                },
                {
                    text: "🚗 Kendaraan masuk: B 1234 CD (Mobil)<br>⏰ Waktu masuk: 14:30 WIB",
                    delay: 2000
                },
                {
                    text: "📋 Status: PARKIR AKTIF<br>🎫 Tiket #SP001 berhasil diterbitkan",
                    delay: 2000
                },
                {
                    text: "🚗 Kendaraan keluar: B 1234 CD<br>⏰ Waktu keluar: 16:45 WIB<br>⏱️ Durasi: 2 jam 15 menit",
                    delay: 3000
                },
                {
                    text: "💰 Biaya parkir: Rp 15.000<br>✅ Pembayaran berhasil<br>📊 Total pemasukan hari ini: Rp 450.000",
                    delay: 3000
                },
                {
                    text: "🎉 Demo selesai!<br>Sistem SmartPark siap membantu bisnis Anda",
                    delay: 2000
                }
            ];

            let currentIndex = 0;
            
            function showNextScenario() {
                if (currentIndex < scenarios.length) {
                    demoContent.innerHTML = scenarios[currentIndex].text;
                    currentIndex++;
                    setTimeout(showNextScenario, scenarios[currentIndex - 1]?.delay || 2000);
                } else {
                    setTimeout(() => {
                        demoContent.innerHTML = "🚀 Demo dapat diulang kapan saja!<br>Klik 'Mulai Demo' untuk melihat lagi";
                    }, 2000);
                }
            }

            showNextScenario();
        }

        // Add parallax effect to floating shapes
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const shapes = document.querySelectorAll('.shape');
            
            shapes.forEach((shape, index) => {
                const speed = (index + 1) * 0.5;
                shape.style.transform = `translateY(${scrolled * speed}px)`;
            });
        });

        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.feature-card, .section-title, .section-subtitle').forEach(el => {
            observer.observe(el);
        });

        // Add mouse movement effect to hero section
        document.addEventListener('mousemove', (e) => {
            const shapes = document.querySelectorAll('.shape');
            const x = e.clientX / window.innerWidth;
            const y = e.clientY / window.innerHeight;
            
            shapes.forEach((shape, index) => {
                const speed = (index + 1) * 20;
                const xPos = (x - 0.5) * speed;
                const yPos = (y - 0.5) * speed;
                
                shape.style.transform += ` translate(${xPos}px, ${yPos}px)`;
            });
        });
    </script>
</body>
</html>