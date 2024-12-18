<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ana Sayfa</title>
    <style>
        body{
            margin: 0;
            padding: 0;
            background-color: #B8E3FF;
            font-family:Arial, Helvetica, sans-serif;
        }
        div{
            background-color: #03254c;
            position: absolute;
            color: #fff;
            width: 400px;
            padding: 20px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            overflow: hidden;
            border-radius: 20px;
        }
        .buton{
            margin-top: 40px;
            margin-bottom: 20px;
            cursor: pointer;
            border-radius: 50px;
            background-color: #2a9df4;
            color: #fff;
            display: block;
            transition: 0.8s;
            width: 120px;
            height: 40px;
        }
        .buton:hover {
            transform: scale(0.95);
            background-color: #fff;
            color: #03254c;
        }
    </style>
</head> 
<body>
    <div>
        <h1>This is the home page</h1>
        <form action="home.php" method="post">
            <input type="submit" name="logout" value="Log Out" class="buton">
    </form>
</div>
</body>
</html>

<?php
    if(isset($_POST["logout"])){
        header("Location: index.php");
    }

?>