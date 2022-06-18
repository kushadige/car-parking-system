<?php
session_start();

    include('connection.php');
    include('functions.php');

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        //something was posted
        $email = $_POST['email'];
        $sifre = $_POST['sifre'];

        if(!empty($email) && !empty($sifre) && !is_numeric($email)){
            // read from database
            $query = "SELECT * FROM users WHERE email = '$email';";

            $result = mysqli_query($con, $query);

            // parola kontrol
            if($result){

                if($result && mysqli_num_rows($result) > 0){
                    
                    $user_data = mysqli_fetch_assoc($result);

                    if($user_data['sifre'] === $sifre){

                        $_SESSION['email'] = $user_data['email'];
                        header("Location: index.php");
                        die;
                    }
                }
            }

            echo "<div style='width: 100%; text-align: center; display: flex; justify-content:center; margin:0; padding: 0;'>
                    <p style='width: 310px; padding: 0 20px; box-sizing:border-box; margin: 10px 0 0; color: yellow; font-size: 14px; text-shadow: 0 0 5px #000'>Hatalı giriş, lütfen tekrar deneyin veya yeni bir hesap oluşturun.</p>
                </div>";
        
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
        <title>Form Styling</title>
        <!-- FONT AWASOME -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0/css/all.min.css" integrity="sha512-c93ifPoTvMdEJH/rKIcBx//AL1znq9+4/RmMGafI/vnTFe/dKwnn1uoeszE2zJBQTS1Ck5CqSBE+34ng2PthJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- CUSTOM CSS -->
        <link 
            href="https://fonts.googleapis.com/css?family=Raleway"
            rel="stylesheet"
        />
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class="container">
            <div class="form">
                <div id="form-header">
                    <h1>Üye Girişi</h1>
                    <p>Otopark sistemine hoşgeldiniz.</p>
                </div>
                <div id="form-content">
                    <form method="post">
                        <div class="input-fields">
                            <label for="email">Email</label><br>
                            <input type="email" name="email" id="email">
                        </div>
                        <div class="input-fields">
                            <label for="password">Şifre</label><br>
                            <input type="password" name="sifre" id="sifre">
                        </div>
                        <div class="submit-button">
                            <input type="submit" value="Giriş Yap" id="btn-submit">
                        </div>
                        <input id="ip" name="ip" type="hidden" value="123">
                    </form>
                </div>
                <div id="form-footer">
                    <p>Hala üye değil misiniz? <a href="signup.php">Kayıt ol</a></p>
                    <p><a href="changepass.php">Şifremi unuttum</a></p>
                </div>
            </div>
        </div>
        <script src="script/script.js"></script>
    </body>
</html>