<?php
    
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
                    <h1>Üye Girişi</h1>
                    <p>Otopark sistemine hoşgeldiniz.</p>
                </div>
                <div id="form-content">
                    <form method="post">
                        <div class="input-fields">
                            <label for="email">Email</label><br>
                            <input type="email" name="email" id="email">
                        </div>
                        <div class="submit-button">
                            <input type="submit" value="Şifreyi Gönder" id="btn-submit">
                        </div>
                    </form>
                </div>
                <div id="form-footer">
                    <p>Hala üye değil misiniz? <a href="signup.php">Kayıt ol</a></p>
                    <p><a href="index.php">Anasayfa</a></p>
                </div>
            </div>
        </div>
    </body>
</html>