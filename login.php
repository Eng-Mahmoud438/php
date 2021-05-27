<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    
    <link rel="icon" href="img/mahmoud.jpg"/>
    <link rel="shortcut" href="img/mahmoud.jpg"/>
    <link rel="apple-touch-icon" href="img/mahmoud.jpg"/>
   
<style>

</style>
</head>
<body>
<?php
require_once 'nav.php';
?>
<main class="container" style="text-align:right!important;" >
<form method="POST">
 <p class="font-weight-bolder mt-3">:البريد الإلكتروني</p>
 <input style="border-radius:16px;" class="form-control " type="email" name="email" required/>
<p class="font-weight-bolder mt-3">:كلمة المرور</p>
<input class="form-control" style="border-radius:16px;" type="password" name="password" required/>
<a href="reset.php">هل نسيت كلمة المرور؟</a><br>
<a class="btn btn-dark mt-3" href="register.php"> Register-تسجيل</a>
<button class="btn btn-warning mt-3" type="submit" name="login">Login-دخول</button>
</form>


</main>

<?php
if(isset($_POST['login'])){
    require_once 'connectDatabase.php';
$LogIn=$database->prepare("SELECT * FROM users WHERE EMAIL=:email AND PASSWORD= :password");
$LogIn->bindParam("email",$_POST['email']);
//$passwordUser=$_POST['password'];
$LogIn->bindParam("password",$_POST['password']);
$LogIn->execute();

if($LogIn->rowCount()===1){
    $user=$LogIn->fetchObject();
if($user->ACTIVATED ==="1"){
    session_start();
$_SESSION['user']=$user;
    //echo '<div class="alert alert-warning" role="alert">Welcome'.$user->NAME.'</div>';
    if($user->ROLE==='USER'){
header("location:user/index.php",true);
    }else if($user->ROLE==='ADMIN'){
        header("location:admin/index.php",true);
            }else if($user->ROLE==='SUPER-ADMIN'){
                header("location:super-admin/index.php",true);
                    }
}else{
    echo '<div  class="alert alert-warning" role="alert">يرجى تفعيل حسابك في البداية لقد ارسلنارمز تحقق إلى البريد الإلكتروني الخاص بك</div>';
}
}else{
    echo '<div  class="alert alert-danger" role="alert">كلمة المرور او البريد الإلكتروني غيرصحيح </div>';
}
}

?>
 
</body>
</html>




