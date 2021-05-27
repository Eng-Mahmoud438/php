<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>active</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  
</head>
<body>
<main class="container">
<?php
if(isset($_GET['email'])&& isset($_GET['code'])){
    require_once 'connectDatabase.php';
$checkCode=$database->prepare("SELECT SECURITY_CODE FROM users WHERE  SECURITY_CODE=:CODE AND EMAIL=:email ");
$SecurityCode=$_GET['code'];
$email=$_GET['email'];
$checkCode->bindParam("CODE",$SecurityCode);
$checkCode->bindParam("email",$email);
$checkCode->execute();
if($checkCode->rowCount()>0){
$newCode=$database->prepare("
UPDATE users SET SECURITY_CODE=:NewCode,ACTIVATED=1 WHERE SECURITY_CODE=:SEC AND EMAIL=:email ");
$NewSecurity=md5(date("h:i:s"));
$newCode->bindParam("NewCode",$NewSecurity);
$newCode->bindParam("email",$email);
$newCode->bindParam("SEC",$SecurityCode);
if($newCode->execute()){
echo '<div class="alert alert-success" role="alert">
تم التحقق من  حسابك بنجاح
</div>';
echo "<a class='btn btn-warning' href='login.php'>دخول</a>";
}


}else{
    echo '<div class="alert alert-danger">رمز التحقق هذا لم يعد صالح للاستخدام</div>';
}

}
?>
</main>
</body>
</html>

