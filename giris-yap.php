<?php
    include("database.php");
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #B8E3FF;
            font-family:Arial, Helvetica, sans-serif;
        }
        .giris-yap {
            width: 300px;
            padding: 20px;
            text-align: center;
            background-color: #03254c;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            overflow: hidden;
            border-radius: 20px;
        }
        .giris-yap h1 {
            margin-top: 50px;
            color: #fff;
            font-size: 50px;
        }
        .giris-yap input{
            display: block;
            width: 100%;
            padding: 0 16px;
            height: 44px;
            text-align: center;
            box-sizing: border-box;
            border: none;
        }
        .gir {
            margin: 20px 0;
            border-radius: 15px;
        }
        .buton {
            margin-top: 40px;
            margin-bottom: 20px;
            cursor: pointer;
            border-radius: 50px;
            background-color: #2a9df4;
            color: #fff;
            display: block;
            transition: 0.8s;
        }
        .buton:hover {
            transform: scale(0.95);
            background-color: #fff;
            color: #03254c;
        }
        .giris-yap a{
            color: #2a9df4;
            text-decoration: none;
        }
        .giris-yap a:hover{
            color: #fff;
        }
        p {
            color: #B8E3FF;
        }
        

    </style>
</head>
<body>
    <div class="giris-yap">
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
            <h1>Giriş Yap</h1>
            <input type="email" placeholder="E-posta adresi" class="gir" name="email">
            <input type="password" placeholder="Şifre" class="gir" name="sifre">
            <input type="submit" value="Giriş Yap" class="buton">
            <a href="#">Şifreni mi unuttun?</a>
            <div>
                <p>Hesabın yok mu?</p>
                <a href="index.php">Yeni hesap oluştur</a>
            </div>           
        </form>       
    </div>
</body>
</html>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, "sifre", FILTER_SANITIZE_SPECIAL_CHARS);    
    if(empty($email)){
        echo '<script>alert("E-posta adresinizi giriniz")</script>';
    }
    elseif(empty($password)){
        echo '<script>alert("Parolanızı giriniz")</script>';
    }
    else{
        // $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "SELECT * FROM users2 WHERE email = '$email'";
        $result = mysqli_query($connection, $sql);
    
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            $hash = $row["password"];
            if(password_verify($password, $hash)){
                echo "<script> alert('Giriş başarılı! Merhaba {$row["username"]}');
                window.location.href='home.php';
                </script>";
            }
            else{
                echo "<script> alert('Şifre yanlış!')</script>";
            }
        }
        else{
            echo "<script> alert('Kullanıcı bulunamadı!')</script>";
        }
    }
}
mysqli_close($connection);
?>