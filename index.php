<?php
    include("database.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kaydol</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #B8E3FF;
            font-family:Arial, Helvetica, sans-serif;
        }
        .kayit-ol {
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
        .kayit-ol h1 {
            margin-top: 35px;
            color: #fff;
            font-size: 50px;
        }
        .kayit-ol input{
            display: block;
            width: 100%;
            padding: 0 16px;
            height: 44px;
            text-align: center;
            box-sizing: border-box;
            border: none;
            font-family: Arial, Helvetica, sans-serif;
        }
        .gir {
            margin: 20px 0;
            border-radius: 15px;
        }
        .buton {
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
        .kayit-ol a{
            color: #2a9df4;
            text-decoration: none;
        }
        .kayit-ol a:hover{
            color: #fff;
        }
        .cinsiyet input{
            display: inline-block;
            width: 12px;
            height: 12px;
        }
        .tarih {
            padding: 20px;
        }
        .tarih input{
            display: inline-block;
            width: auto;
            height: 26px;
        }
        
        label {
            color: #fff;
        }
        p {
            color: #B8E3FF;
        }
    </style>
</head>
<body>
    <div class="kayit-ol">
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
            <h1>Kaydol</h1>
            <input type="text" placeholder="Kullanıcı adın" class="gir" name="username">        
            <input type="text" placeholder="Adın" class="gir" name="name">      
            <input type="text" placeholder="Soyadın" class="gir" name="surname">   
            <input type="email" placeholder="E-posta adresin" class="gir" name="email">
            <input type="password" placeholder="Parolan" class="gir" name="password">
            <div class="cinsiyet">
                <label for="gender">Cinsiyetin: </label>
                <input type="radio" id="male" name="gender" value="Erkek">
                <label for="male">Erkek</label>
                <input type="radio" id="female" name="gender" value="Kadın">
                <label for="female">Kadın</label> 
            </div>
            <div class="tarih">
                <label for="date">Doğum tarihin: </label>
                <input type="date" id="date" name="dob">
            </div>           
            <input type="submit" value="Kaydol" class="buton" name="register">
            <div id="hesap">
                <p>Zaten bir hesabın var mı?</p> 
                <a href="giris-yap.php">Giriş yap</a>
            </div>
        </form>   
    </div>
</body>
</html>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_SPECIAL_CHARS);
        $surname = filter_input(INPUT_POST, "surname", FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $gender = filter_input(INPUT_POST, "gender", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
        $dob = filter_input(INPUT_POST, "dob", FILTER_SANITIZE_SPECIAL_CHARS);
        
        if(empty($username)){
            echo '<script>alert("Kullanıcı adınızı giriniz")</script>';
        }
        elseif(empty($name)){
            echo '<script>alert("Adınızı giriniz")</script>';
        }
        elseif(empty($surname)){
            echo '<script>alert("Soyadınızı giriniz")</script>';
        }
        elseif(empty($email)){
            echo '<script>alert("E-posta adresinizi giriniz")</script>';
        }
        elseif(empty($password)){
            echo '<script>alert("Parolanızı giriniz")</script>';
        }
        elseif(empty($gender)){
            echo '<script>alert("Cinsiyetinizi seçiniz")</script>';
        }
        elseif(empty($dob)){
            echo '<script>alert("Doğum tarihinizi seçiniz")</script>';
        }
        else{
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO users2 (username, name, surname, email, password, gender, dob) VALUES ('$username', '$name', '$surname', '$email', '$hash', '$gender', '$dob')";
            try{
                mysqli_query($connection, $sql);
                // ob_start();
                // echo '<script>alert("Your account has been created succesfully!")</script>';
                // ob_end_flush();                
                // header("Location: giris-yap.php");
                // exit;
                // header("Location: giris-yap.php");
                // echo '<script>alert("Your account has been created succesfully!")</script>'; // neden ikisi aynı anda çalışmıyor?    
                echo "<script> alert('Hesabınız başarıyla oluşturuldu!');
                window.location.href='giris-yap.php';
                </script>";            
            }
            catch(mysqli_sql_exception){              
                echo '<script>alert("Kullanıcı adınız/e-posta adresiniz başkası tarafından kullanılıyor!")</script>';
            }
        }
    }
    mysqli_close($connection);   
?>