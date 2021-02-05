<?php
session_start();
if(isset($_SESSION['login_flag']) && $_SESSION['login_flag']===true){
            echo "<script>location='./admin/index.php#/'</script>";
}
?>

<!DOCTYPE html>  
<html lang="en">  
<head>  
    <meta charset="UTF-8">  
    <title>Login to CVE Hunter</title>  
    <link rel="stylesheet" type="text/css" href="login.css"/>  
</head>  
<body>  
    <div id="login">  
        <h1>CVE Hunter</h1>  
        <form method="post" action="login.php">  
            <input type="text" required="required" placeholder="Username" name="username"></input>  
            <input type="password" required="required" placeholder="Password" name="password"></input>  
            <button class="but" type="submit">登录</button>  
        </form>  
    </div>  
</body>  
</html>

