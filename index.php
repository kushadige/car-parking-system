<?php
session_start();

    include('connection.php');
    include('functions.php');

    $user_data = check_login($con);

    // otoparktaki toplam boş alan sayısı
    $nacount = check_count($con);

    // otopark tablosundan park halindeki araçların bilgisi çekiliyor
    $query = get_contents($con);
    $contents = mysqli_fetch_all($query, MYSQLI_ASSOC);
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- FONT AWASOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- CUSTOM CSS -->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <title>Otopark Sistemi</title>
</head>
<body>
    
    <header>
        <div class="greeting">
            <p><i class="fa-solid fa-circle-user fa-2x"></i></p>
            <h1>Hoşgeldiniz, <?php echo "<br>{$user_data['fname']} {$user_data['lname']}<br><span style='font-size:25px;color:yellow;display:inline-block;margin-top:5px;'>{$user_data['plaka']}</span>"; ?></h1>
        </div>
        <nav class="navbar">
            <ul>
                <li></li>
                <li><a href="logout.php">Çıkış</a></li>
            </ul>
        </nav>
        <div class="vars" style="display:none;">
            <?php foreach($contents as $content) : ?>
                <div class="park-halindeki-araclar">
                    <p class='section'><?php echo $content['section']; ?></p>
                    <p class='plaka'><?php echo $content['plaka']; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </header>
    
    </main> 
        <div class="container">
            <p class="msg" style="display:none;"><?php echo $user_data['plaka']; ?></p>
            <p class="info"></p>
            <div class="screen"><p>TOPLAM PARK ALANI: 48</p><p>BOŞ PARK ALANI: <span><?php echo $nacount; ?></span></p><p style="margin-top: 10px;"class="text-info"><i class="fa-solid fa-credit-card"></i> Ücret <span>1,99 TL + 0,79/dk</span></p></div>

            <ul class="showcase">
                <li>
                    <div class="seat"></div>
                    <small>N/A</small>
                </li>
                <li>
                    <div class="seat occupied" style="background: none"><i class="fa-solid fa-car"></i></div>
                    <small>Occupied</small>
                </li>
            </ul>

            <div class="row">
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
            </div>
            <div class="row">
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
            </div>
            <div class="row">
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
            </div>
            <div class="row">
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
            </div>
            <div class="row">
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
            </div>
            <div class="row">
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
                <div class="seat"></div>
            </div>
        </div>
        <p class="text">Kullanım detaylarınızı görüntülemek için <a href="detaylar.php">tıklayınız.</a></p>
    </main>
    <script src="script/app.js"></script>
</body>
</html>