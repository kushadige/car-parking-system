<?php

function check_login($con){

    if(isset($_SESSION['email'])){
        
        $email = $_SESSION['email'];
        $query = "SELECT * FROM users WHERE email = '$email';";

        $result = mysqli_query($con,$query);
        if($result && mysqli_num_rows($result) > 0){

            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }

    //redirect to login
    header('Location: login.php');
    die;

}

function check_count($con){
    // otoparktaki boş alan sayısı
    $sql = "SELECT count(*) c FROM otopark GROUP BY(plaka) HAVING c > 1;";
    $result = mysqli_query($con, $sql);
    $nacount = mysqli_fetch_assoc($result);

    return $nacount['c'];
}

function get_contents($con){

    $sql = "SELECT section, plaka FROM otopark WHERE plaka IS NOT NULL;";
    $result = mysqli_query($con, $sql);

    return $result;
}
