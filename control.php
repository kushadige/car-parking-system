<?php

    include('connection.php');
    include('functions.php');

    // get json from python
    $api_json = file_get_contents('php://input');
    // store json in php
    $post_data = json_decode($api_json, true);
    // get data 
    $data = $post_data["data"];
    $section = $post_data["section"];

    if(!empty($data)){


        // plaka databasete aranıyor
        $query = "SELECT plaka FROM users WHERE plaka='$data';";
        $result = mysqli_query($con, $query);

        // araç hala otoparkta mı? değil mi? kontrolü yapılıyor
        $control = false;
        $sql = "SELECT * FROM io_info WHERE plaka='$data';";
        $c_query = mysqli_query($con, $sql);
        
        while($row = mysqli_fetch_assoc($c_query)){
            if($row['cikis_gun'] == NULL){
                $control = true;
            }
        }
        
        // araç otoparktaysa çıkış işlemi başlatılıyor
        if($result && mysqli_num_rows($result) > 0 && ($control == true)){
            echo $data . " cikis yapti..";

            date_default_timezone_set("Europe/Istanbul");
            $cikis_gun = date('Y/m/d');
            $cikis_saat = date('h:i:sa');

            // ücret hesabı
            $kayit = mysqli_query($con,"SELECT * FROM io_info WHERE plaka = '{$data}' AND cikis_gun IS NULL;");
            $satir = mysqli_fetch_assoc($kayit);
            $giris_saat = $satir['giris_saat'];
            $giris_gun = $satir['giris_gun'];

            $otoparktaGecenToplamDakika = floor(intval(strtotime($cikis_gun) - strtotime($giris_gun)) / 60) + floor(intval(strtotime("$cikis_saat") - strtotime("$giris_saat")) / 60);
            $ucret = ($otoparktaGecenToplamDakika * 0.08) + 1.99;
            $kayit = "UPDATE io_info SET ucret = $ucret WHERE plaka = '{$data}' AND cikis_gun IS NULL;";
            mysqli_query($con, $kayit);

            // cikis islemi
            $kayit = "UPDATE io_info SET cikis_gun='{$cikis_gun}', cikis_saat='{$cikis_saat}' WHERE plaka = '{$data}' AND cikis_gun IS NULL;";
            mysqli_query($con, $kayit);

            // araç park alanından ayrıldığı için ayrıldığı alan null olarak güncelleniyor
            $kayit = "UPDATE otopark SET plaka = NULL WHERE plaka = '$data';";
            mysqli_query($con, $kayit);

            die;

        } else if($result && mysqli_num_rows($result) > 0) {
            // araç otoparkta değilse giriş işlemi başlatılıyor..

            // park alani dolu mu bos mu kontrol ediliyor
            $sql = "SELECT * FROM otopark WHERE section = '$section';";
            $results = mysqli_query($con, $sql);
            if(mysqli_fetch_assoc($results)['plaka'] != NULL){
                echo "\"" . $section . "\" Park alani dolu.. Lutfen park icin bos bir alan seciniz..";
                die;
            }

            // park alani bos ise giriş yapabilir..
            echo $data . " giris yapti..";

            date_default_timezone_set("Europe/Istanbul");
            $giris_gun = date('Y/m/d');
            $giris_saat = date('h:i:sa');

            $kayit = "INSERT INTO io_info VALUES('$data','$giris_gun','$giris_saat',NULL,NULL,'$section',NULL);";
            mysqli_query($con, $kayit);

            // park alani bilgisi otopark tablosuna kaydediliyor
            $kayit = "UPDATE otopark SET plaka = '$data' WHERE section = '$section';";
            mysqli_query($con, $kayit);
            die;
        } else {
            // kayıtlı olmayan kullanıcılar giriş yapamaz
            echo "Kayıtlı olmayan kullanıcılar giriş yapamaz " . $data . " kayitli degil!!";
        }

        die;

    } else {
        echo "Plaka bilgisi doğru alınamadı!";
    }

?>
