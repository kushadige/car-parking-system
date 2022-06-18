<?php
session_start();

    include('connection.php');
    include('functions.php');

    
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        //something was posted
        $first_name = $_POST['fname'];
        $last_name = $_POST['lname'];
        $email = $_POST['email'];
        $plaka = $_POST['plaka'];
        $sifre = $_POST['sifre'];

        if(!empty($first_name) && !empty($last_name) && !empty($email) && !empty($plaka) && !empty($sifre) && !is_numeric($first_name)){

            // save to database
            $query = "INSERT INTO users VALUES('$first_name','$last_name','$email','$plaka','$sifre');";

            mysqli_query($con, $query);

            header("Location: login.php");
            die;
        }else {
            echo "Please enter some valid information!";
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <title>Form Styling</title>
        <link 
            href="https://fonts.googleapis.com/css?family=Raleway"
            rel="stylesheet"
        />
    </head>
    <body>
        <div class="container">
            <div class="form">
                <div id="form-header">
                    <h1>Kayıt Ol</h1>
                    <p>Hızlı ve kolay, sadece birkaç dakika.</p>
                </div>
                <div id="form-content">
                    <form method="post">
                        <div class="input-fields">
                            <label for="fname">İsim</label><br>
                            <input type="text" name="fname" id="fname">
                        </div>
                        <div class="input-fields">
                            <label for="lname">Soyisim</label><br>
                            <input type="text" name="lname" id="lname">
                        </div>
                        <div class="input-fields">
                            <label for="email">Email</label><br>
                            <input type="email" name="email" id="email">
                        </div>
                        <div class="input-fields">
                            <label for="password">Plaka</label><br>
                            <input type="text" name="plaka" id="plaka">
                        </div>
                        <div class="input-fields">
                            <label for="password">Şifre</label><br>
                            <input type="password" name="sifre" id="sifre">
                        </div>
                        <div class="submit-button">
                            <input type="submit" value="Kayıt Ol" id="btn-submit">
                        </div>
                    </form>
                </div>
                <div id="form-footer">
                    <p>By clicking the Sign Up button, you agree to our <a href="#">Terms & Conditions and Privacy Policy</a></p>
                </div>
            </div>
            <div id="form-bottom">
                <p>Zaten bir hesabın var mı? <a href="login.php">Giriş Yap</a></p>
            </div>
        </div>
    </body>
</html>