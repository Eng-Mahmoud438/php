<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mahmoud</title>
    
    <meta name="keywords" content="PHP-MySQL افضل دورة لتعلم لغة تصميم مواقع الويب"/>
    <meta property="og:title" content="Mahmoud Hassan-مهندس إتصالات  وبرمجيات"/>
    <meta property="og:description" content="PHP-MySQL افضل دورة لتعلم لغة تصميم مواقع الويب"/>
    <meta property="og:image" content="img/mahmoud.jpg"/>
    <meta property="og:image:width" content="1200"/>
    <meta property="og:image:height" content="630"/>
    <meta name="twitter:title" content="Mahmoud Hassan-مهندس إتصالات  وبرمجيات"/>
    <meta name="twitter:description" content="PHP-MySQL افضل دورة لتعلم لغة تصميم مواقع الويب"/>
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:image" content="img/mahmoud.jpg"/>
    <link rel="icon" href="img/mahmoud.jpg"/>
    <link rel="shortcut" href="img/mahmoud.jpg"/>
    <link rel="apple-touch-icon" href="img/mahmoud.jpg"/>
   
</head>
<body>
<?php require_once 'nav.php';
?>
<main class="container" style="text-align:right!important;" >
<form method="POST">
 <p class="font-weight-bolder mt-3">:البريد الإلكتروني</p>
 <input class="form-control " type="email" name="email" required/>
<p class="font-weight-bolder mt-3">:كلمة المرور</p>
<input class="form-control" type="password" name="password" required/>
<a href="reset.php">هل نسيت كلمة المرور؟</a><br>
<a class="btn btn-dark mt-3" href="register.php"> Register-تسجيل</a>
<button class="btn btn-warning mt-3" type="submit" name="login">Login-دخول</button>
</form>


</main>
</body>
</html>