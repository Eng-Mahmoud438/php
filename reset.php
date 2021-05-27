<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
   
</head>
<body>
<?php require_once 'nav.php';?>
    <main class="container m-auto text-center" style="max-width: 80%; margin-top:50px !important;" dir="rtl">
<?php 
//if no variable code or email in the link
if(!isset($_GET['email'])){
echo '<form  method="POST">
<div class="shadow p-3 mb-3 ">البريد الإلكتروني:</div>
<input class="form-control" type="email" name="email" placeholder="ضع بريدك الإلكتروني هنا" required/><br>
<button class="btn btn-warning w-100 mt-3" type="submit" name="resetPassword">إعادة تعيين كلمة المرور</button></form>';
}else if(isset($_GET['email'])&&isset($_GET['code'])){
    echo '<form  method="POST"><div class="shadow p-3 mb-3">ضع كلمة المرور الجديدة:</div><input class="form-control" type="password" name="password"/>
        <button class="btn btn-warning w-100 mt-3" type="submit" name="newPassword">حفظ</button></form>';
}

?>
    <?php  
    if(isset($_POST['resetPassword'])){

        require_once 'connectDatabase.php';
$checkEmail= $database ->prepare("SELECT EMAIL,SECURITY_CODE FROM users WHERE EMAIL=:email")   ;

$checkEmail->bindParam("email",$_POST['email']);
$checkEmail->execute();
if($checkEmail->rowCount()>0){

$User=$checkEmail->fetchObject();


require_once 'mail.php';
$mail->addAddress($_POST['email']);
$mail->setFrom('alaroomimahmoud155@gmail.com','Engineer Mahmoud');
$mail->Subject='إعادة تعيين كلمة المرور';
  $mail->Body='<div>رابط إعادة تعيين كلمة المرور</div>'
.'<a href="http://localhost/app/reset.php?email='.$_POST['email'].'&code='.$User->SECURITY_CODE.'">
http://localhost/app/reset.php?email='.$_POST['email'].'&code='.$User->SECURITY_CODE.
'</a>';
$mail->send();

echo '<div class="alert alert-success mt-3 ">تم إرسال رابط إعادة تعيين كلمة المرور إلى البريد الإلكتروني الخاص بك</div>';

}else{
    echo '<div class="alert alert-warning mt-3 ">هذاالبريد الإلكتروني غير مسجل في موقعنا</div>';
}
    }
    
    ?>
    <?php
    if(isset($_POST['newPassword'])){
        require_once 'connectDatabase.php';
        $updatePassword=$database->prepare("UPDATE users SET PASSWORD=:Password WHERE EMAIL=:email");
        $updatePassword->bindParam("Password",$_POST['password']);
        $updatePassword->bindParam("email",$_GET['email']);//الرابط الذي تم ارساله من خلال الرابط
        if($updatePassword->execute()){
echo '<div class="alert alert-success mt-3 ">تم إعادة تعيين كلمة المرور بنجاح</div>';
        }else{
            echo '<div class="alert alert-danger mt-3 ">فشل إعادة تعيين كلمة المرور</div>';
        }

    }
    
    ?>
    </main>
</body>
</html>


