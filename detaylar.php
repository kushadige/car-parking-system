<?php
session_start();

    include('connection.php');
    include('functions.php');

    $user_data = check_login($con);
    $nacount = check_count($con);

    // io_info tablosundan ucret cekiliyor
    $plaka = $user_data['plaka'];

    $sql = "SELECT SUM(ucret) AS ucret FROM io_info WHERE plaka = '{$plaka}';";

    if($query = mysqli_query($con, $sql)){
        $content = mysqli_fetch_assoc($query);
    }
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
        
    <div class="greeting">
        <p><i class="fa-solid fa-circle-user fa-2x"></i></p>
        <h1>Hoşgeldiniz, <?php echo "<br>{$user_data['fname']} {$user_data['lname']}<br> <span style='font-size:25px;color:yellow;display:inline-block;margin-top:5px;'>{$user_data['plaka']}</span>"; ?></h1>
    </div>

    <header>
        <nav class="navbar">
            <ul>
                <li><a href="index.php">Anasayfa</a></li>
                <li><a href="logout.php">Çıkış</a></li>
            </ul>
        </nav>
    </header>
    
    </main> 
        <div class="container">
            <p class="text" style="color:#fff;">Toplam borcunuz ₺<span id="count"><?php echo number_format($content['ucret'], 2, '.', ','); ?>
            </span></p>
            <div class="screen"><p>TOPLAM PARK ALANI: 48</p><p>BOŞ PARK ALANI: <span><?php echo $nacount; ?></span></p></div>

            <ul class="showcase">
                <li>
                    <div class="seat"></div>
                    <small>N/A</small>
                </li>
                <li>
                    <div class="seat occupied"><i class="fa-solid fa-car"></i></div>
                    <small>Occupied</small>
                </li>
            </ul>

            <div class="row">
                
            </div>

        </div>
    </main>
    <script src="script/app.js"></script>
</body>
</html>