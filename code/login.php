<?php
include("./admin/conn.php");

session_start();
if(isset($_SESSION['login_flag']) && $_SESSION['login_flag']===true){	
    echo "<script>location='./admin/index.php#/'</script>";
}


header("Content-type:text/html;charset=utf-8");


$username = $_POST['username'];
$password = $_POST['password'];
if(isset($username) && isset($password)){
    if($username == "" || $password == ""){
        echo "<script type='text/javascript'>alert('Username or Password is NULL');location='./index.php';</script>";
    }
    if(isset($username) && $username != "Railgun"){
        echo "<script type='text/javascript'>alert('Username or Password invaild!');location='./index.php';</script>";
    }
    $sql = "select * from user where username='Railgun' and password='".md5($password)."'";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_array($result);

    if($rows){
	#session_start();	
        $_SESSION['expire_time'] = time() + 3600;
        #setcookie('admin_id', $rows['id'], $expire_time);
        #setcookie('username', $rows['username'], $expire_time);
	#setcookie('login_flag','logined',$expire_time);
	$_SESSION["login_flag"] = true;
	$_SESSION["username"] = $rows['username'];
        echo "<script>location='./admin/index.php#/';</script>";
    }else{
        echo "<script type='text/javascript'>alert('Username or Password invaild!');location='./index.php';</script>";
    }

}


?>
