<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>UI KPI Toko Roti Wonosari</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="css/login.css" />   
    <title>login</title>
</head>

<body>
    <div class="main">
        <div class="main-image">
            <img src="img/logo-wonosari.png" alt="" class="main-image" />
        </div>
        <div class="main-text">
            <strong>CAPAIAN.ID</strong>
            <small>Pantau kinerja harianmu</small>
        </div>
    </div>
    <div class="login-panel">
        <div class="login-panel-span">
            <span>SISTEM PENILAIAN KARYAWAN</span>
        </div>
        <h2>Kelola &amp; Pantau Kinerja Tim dengan Mudah</h2>
        <p>
            Platform digital untuk mencatat, mengevaluasi, dan meningkatkan
            produktivitas karyawan setiap tim.
        </p>
        <form action="{{ route('login') }}" method="GET">
            <button type="submit">Masuk ke akun Anda</button>
        </form>
    </div>
</body>

</html>