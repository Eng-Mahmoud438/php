<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
   
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
<?php
require_once 'nav.php';
?>
<div class="container" dir="rtl" style="text-align:right !important;">
    
    
    
    <form method="POST">
<div class="text text-weight-bold mt-3 mb-1">الاسم:</div>
<input style="border-radius:16px;" class="form-control "  type="text" name="name" required/><br>
<div> تاريخ الميلاد:</div>
<input style="border-radius:16px;" class="form-control" type="date" name="age" required/><br>
<div>البريد الإلكتروني:</div>
<input style="border-radius:16px;" class="form-control" type="email" name="email" required/><br>
<div>كلمة المرور:</div>
<input style="border-radius:16px; " class="form-control" type="password" name="password" required/><br>
<button type="submit" class="btn btn-dark" name="register" >تسجيل-Register</button>
<a class="btn btn-warning " href="login.php">دخول-Login</a>



</form>
</div>
<?php
if(isset($_POST['register'])){
    require_once 'connectDatabase.php';
$checkEmail=$database->prepare("SELECT * FROM users WHERE EMAIL=:email");
$checkEmail->bindParam("email",$_POST['email']);
$checkEmail->execute();
if($checkEmail->rowCount()>0){
echo '<div class="alert alert-danger" role="alert">
هذا الحساب مستخدم سابقا
</div>';
}else{
    $name = $_POST['name'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $Password =$_POST['password'] ;
    $addUser=$database->prepare("INSERT INTO users(NAME,AGE,EMAIL,PASSWORD,SECURITY_CODE,ROLE) VALUES(:name,:age,:email,:Password,:SEC,'USER')");
    $addUser->bindParam("name",$name);
    $addUser->bindParam("age",$age);
    $addUser->bindParam("email",$email);
    $addUser->bindParam("Password",$Password);
    $securityCode=md5(date("h:i:s"));
    $addUser->bindParam("SEC",$securityCode);
if($addUser->execute()){
    echo '<div  class="alert alert-success" role="alert">تم انشاء حسابك بنجاح لقد قمنا بإرسال رسالة إلى البريد الإلكتروني الخاص بك</div>';
require_once 'mail.php';
$mail->addAddress($email);//destination email
$mail->setFrom('alaroomimahmoud155@gmail.com',' Mahmoud');
$mail->Subject='رسالة تحقق من البريد الإلكتروني';
$mail->Body=
'<h1>شكرا لتسجيلك في موقعنا  حسابك</h1>'
."<div>انقر على الرابط التالي لتفعيل حسابك </div>"
."<a href='http://localhost/app/active.php?email=".$email."&code=".$securityCode."'>http://localhost/app/active.php?email=".$email."&code=".$securityCode."</a>";
$mail->send();







}else{
    echo '<div class="alert alert-danger" role="alert">
    حدث خطأ غير متوقع يرجى المحاولة مرة اخرى
    </div>';
}

}
}

?>

</body>
</html>

   