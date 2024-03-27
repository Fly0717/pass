<?php
    // 连接数据库
    require "config.php";
	// $ip = $_SERVER['SERVER_ADDR'];
	$ip = shell_exec("/sbin/ip -4 a s $networkname | awk '$1==\"inet\"{ print $2 }'");
    $remote_ip = $_SERVER['REMOTE_ADDR'];
    
    function get_str(){
         $length = 32;
         $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $len = strlen($str)-1;
            $randstr = '';
            for ($i = 0; $i < $length; $i++) {
                $num = mt_rand(0, $len);
                $randstr .= $str[$num];
            }
            return $randstr;
        
   }
?>
<!DOCTYPE html>
<html lang="zh">

<head>

    <title>用户注册</title>
	<link rel="icon" href="./assets/favicon.png" type="image/x-icon" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <link rel="stylesheet" href="stylesheets/style.css" type="text/css" media="all"> -->
	<style>
		html {
			scroll-behavior: smooth;
		}
	
		body,
		html {
			margin: 0;
			padding: 0;
			color: #000000;
		}
	
		* {
			box-sizing: border-box;
			font-family: 'Mukta', sans-serif;
		}
	
		/*  wrapper */
		.wrapper {
			width: 100%;
			padding-right: 15px;
			padding-left: 15px;
			margin-right: auto;
			margin-left: auto;
		}
	
		@media (min-width: 576px) {
			.wrapper {
				max-width: 540px;
			}
		}
	
		@media (min-width: 768px) {
			.wrapper {
				max-width: 720px;
			}
		}
	
		@media (min-width: 992px) {
			.wrapper {
				max-width: 960px;
			}
		}
	
		@media (min-width: 1200px) {
			.wrapper {
				max-width: 1140px;
			}
		}
	
		/*  /wrapper */
	
		.d-grid {
			display: grid;
		}
	
		button,
		input,
		select {
			-webkit-appearance: none;
			outline: none;
		}
	
		button,
		.btn,
		select {
			cursor: pointer;
		}
	
		a {
			text-decoration: none;
		}
	
		h1,
		h2,
		h3,
		h4,
		h5,
		h6,
		p,
		ul,
		ol {
			margin: 0;
			padding: 0;
		}
	
		body {
			background: #f1f1f1;
			margin: 0;
			padding: 0;
			font-family: 'Mukta', sans-serif;
		}
	
		form,
		fieldset {
			border: 0;
			padding: 0;
			margin: 0;
		}
	
		/*-- forms styling--*/
		section.forms {
			padding: 30px;
		}
	
		.logo {
			text-align: center;
		}
	
		.logo a {
			color: #012725;
			font-size: 36px;
			line-height: 4px;
			display: inline;
			margin-bottom: 30px;
		}
	
		.logo_icon {
			width: 75px;
			height: 75px;
			margin-bottom: 20px;
		}
	
		.forms-grid {
			align-items: center;
			display: flex;
			justify-content: center;
			margin: 40px auto;
			max-width: 1200px;
			width: 100%;
		}
	
	
		.btn {
			align-items: center;
			background: rgb(0, 0, 0);
			border-radius: 36px;
			border-color: #000000;
			border: 1;
			color: #ffffff;
			cursor: pointer;
			display: flex;
			font-size: 16px;
			padding: 15px 45px;
			transition: 0.2s;
			font-weight: 600;
			margin: 10px auto 0;
		}
	
		.btn:hover {
			/*transform: translateY(-2px);*/
			background: rgb(17, 72, 167);
		}
	
		.btn2 {
			align-items: center;
			background: rgb(255, 255, 255);
			border-color: #000000;
			border-radius: 36px;
			border: 1;
			color: #000000;
			cursor: pointer;
			display: flex;
			font-size: 16px;
			padding: 15px 45px;
			transition: 0.2s;
			font-weight: 600;
			margin: 10px auto 0;
		}
	
		.btn2:hover {
			background: rgb(17, 72, 167);
			color: #ffffff;
		}
	
		.main {
			background-size: cover;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			-ms-background-size: cover;
			min-height: 100vh;
			padding: 0em 0;
			position: relative;
			z-index: 1;
			justify-content: center;
			/*display: grid;*/
			align-items: center;
			overflow: hidden;
		}
	
		.main:before {
			position: absolute;
			content: '';
			top: 0;
			left: 0;
			bottom: 0;
			right: 0;
			background: rgb(255 255 255 / 0%);
			z-index: -1;
		}
	
		.container {
			border-radius: 8px;
			box-shadow: 0px 0px 15px 5px rgba(0, 0, 0, 0.3);
			height: 100%;
			max-height: 580px;
			padding: 30px 15px;
			text-align: center;
			width: 100%;
			background: #ffffff;
			overflow: auto;
			box-sizing: border-box;
			margin: 20px 0px;
		}
	
		.container_big {
			max-height: 620px;
		}
	
		.main-container {
			width: 100%;
			height: 100%;
			max-width: 420px;
			position: absolute;
			vertical-align: top;
			left: 50%;
			z-index: 1;
			transform: translate(-50%, 0%);
			overflow: hidden;
			padding: 0px 20px 0px 20px;
			display: flex;
			flex-flow: column nowrap;
			justify-content: center;
		}
	
		@media (max-width: 420px) {
			.container {
				width: 100%;
				height: 100%;
				margin: 0em;
				border-radius: 0px 0px 0px 0px;
				box-shadow: 0px 0px 0px 0px;
			}
	
			.main-container {
				width: 100%;
				height: 100%;
				padding: 0px;
			}
	
			.main:before {
				background: rgb(255 255 255 / 100%);
			}
		}
	
		@media (max-height: 620px) {
			.main-container {
				width: 100%;
				height: 100%;
			}
	
			.container {
				max-height: 100% !important;
			}
	
		}
	
		.container strong {
			color: #3b3663;
			display: block;
			font-size: 28px;
		}
	
		.container .create-account {
			border-top: 1px solid rgb(226 226 226 / 17%);
			display: flex;
			justify-content: center;
			margin-top: 25px;
			padding-top: 20px;
			color: rgb(0, 0, 0);
			opacity: 0.8;
		}
	
		.container .create-account strong {
			font-size: 16px;
			margin-left: 5px;
			text-decoration: underline;
		}
	
		.container .icon {
			display: inline-block;
			width: 56px;
			height: 56px;
			background: #a3a3a3;
			border-radius: 50%;
		}
	
		.container .icon span.fa {
			color: rgb(0, 0, 0);
			line-height: 50px;
			font-size: 24px;
		}
	
		p.foot {
			color: rgb(0, 0, 0);
			opacity: 0.8;
			margin-top: 12px;
		}
	
		p.foot a {
			color: rgb(5, 26, 61);
		}
	
		p.foot a:hover {
			color: rgb(17, 72, 167);
			text-decoration: underline;
			transition: 0.3s ease;
			-webkit-transition: 0.3s ease;
			-o-transition: 0.3s ease;
			-moz-transition: 0.3s ease;
			-ms-transition: 0.3s ease;
		}
	
		.container .form {
			margin-top: 30px;
			padding: 0 5px;
		}
	
		.container .form .form-row {
			position: relative;
			text-align: left;
		}
	
		.container .form .form-row .fa {
			font-size: 16px;
			position: absolute;
			right: 10px;
			top: 20px;
			color: rgb(0, 0, 0);
			/*opacity: .6;*/
		}
	
		.container .form .form-row.bottom {
			display: flex;
			justify-content: space-between;
		}
	
		.container .form .form-row.bottom .forgot {
			color: #4d61fc;
			font-size: 18px;
			opacity: .7;
		}
	
		.container .form .form-row.bottom .forgot:hover {
			opacity: 1;
		}
	
		.container .form .form-row.button-login {
			display: inline;
			text-align: center;
		}
	
		.container .form .form-row.button-login .fa {
			position: static;
		}
	
		.container .form .form-label {
			color: #696687;
			font-size: 17px;
			opacity: .7;
		}
	
		.container .form-password,
		.container .form-text {
			color: rgb(0, 0, 0);
			font-size: 16px;
			border: 0;
			height: 55px;
			margin-bottom: 15px;
			padding: 0 40px 0 0px;
			width: 100%;
			background: #ffffff no-repeat;
			transition: 100ms all linear 0s;
			background-image: linear-gradient(to bottom, rgba(155, 155, 155, 0.63) 0%, rgb(0, 0, 0) 90%), linear-gradient(to bottom, #e1e1e1, #e1e1e1);
			background-size: 0 2px, 100% 1px;
			background-position: 50% 100%, 50% 100%;
			transition: background-size 0.3s cubic-bezier(0.64, 0.09, 0.08, 1);
		}
	
		.container .form-password:focus,
		.container .form-text:focus {
			background-size: 100% 2px, 100% 1px;
			outline: none;
		}
	
		.container .form .form-row .button-login {
			margin-top: 20px;
		}
	
		.container .btn-login .fas.fa-arrow-right,
		.login .btn-login .fas.fa-arrow-right {
			color: rgb(0, 0, 0);
			opacity: 1;
		}
	
		::-webkit-input-placeholder {
			/* Edge */
			color: rgb(0, 0, 0);
			opacity: .6;
		}
	
		:-ms-input-placeholder {
			/* Internet Explorer 10-11 */
			color: rgb(0, 0, 0);
			opacity: .6;
		}
	
		::placeholder {
			color: rgb(0, 0, 0);
			opacity: .6;
		}
	
		.container .social-media {
			font-size: 20px;
			margin-top: 10px;
		}
	
		.container .social-media .fa {
			margin: 0 5px;
			color: rgb(0, 0, 0);
		}
	
		@media (max-width: 870px) {
			.forms-grid {
				flex-wrap: wrap;
				flex-direction: column;
				margin: 30px auto;
			}
		}
	
		@media (max-width: 480px) {
			.logo a {
				font-size: 32px;
				line-height: 42px;
				display: inline;
				margin: 30px 0;
			}
		}
	
		@media (max-width: 415px) {
			.logo a {
				font-size: 30px;
				line-height: 40px;
			}
		}
	
		@media (max-width: 384px) {
			section.forms {
				padding: 30px 15px;
			}
	
			.container .form .form-row.bottom .forgot,
			.login .form .form-row.bottom .forgot,
			.container .form .form-row .form-check input[type="checkbox"]+label,
			.login .form .form-row .form-check input[type="checkbox"]+label {
				font-size: 17px;
			}
	
			.container strong {
				font-size: 25px;
			}
	
		}
	</style>
</head>

<body>

    <div class="main" style="background: url(./assets/bg.jpg) no-repeat bottom;">
		<div class="main-container">
			<div class="container container_big">
				<img src="./assets/logo.png" class="logo_icon"/>
				<h1>注册新账户</h1>
				<p></p>
				<div>
					<form action="" method="post" class="form">
						<div class="form-row">
							<span class="fa fa-user"></span>
							<input type="text" class="form-text" name="username" id="username" autocomplete="off" placeholder="用户名 (数字、英文字符和下划线)" required="" onkeyup="this.value=this.value.replace(/[^\w_]/g,'');">
						</div>
						<div class="form-row">
							<span class="fa fa-lock"></span>
							<input type="password" class="form-text" name="password1" id="password1" autocomplete="new-password" placeholder="密码" required="">
						</div>
						<div class="form-row">
							<span class="fa fa-lock"></span>
							<input type="password" class="form-text" name="password2" id="password2" autocomplete="off" placeholder="确认密码" required="">
						</div>
						<?php
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                $username = $_POST["username"];
                                $password1 = $_POST["password1"];
                                $password2 = $_POST["password2"];
                                
                                if (!$username) {
                                    echo "请输入用户名。";
                                }
                                else if (!$password1) {
                                    echo "请输入密码。";
                                }
                                else if (!$password2) {
                                    echo "请输入密码。";
                                }
                                else if ($password1 != $password2) {
                                    echo "两次输入密码不一致。";
                                }
                                else {
                                    $md5Pwd = md5($password1);
                                    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
                                    if ($conn->connect_error) {
                                        die("连接失败: " . $conn->connect_error);
                                    }
                        
                                    // 查询数据
                                    $sql = "SELECT * FROM user WHERE username='$username'";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        echo "用户已存在！";
                                    } else {
                                        $uid = get_str();
                                        $sql = "INSERT INTO user (uid, username, md5passwd) VALUES ('$uid', '$username', '$md5Pwd')";
                                        if ($conn->query($sql) === TRUE) {
                                            echo "注册成功！";
                                        } else {
                                            echo "错误: " . $sql . "<br>" . $conn->error;
                                        }
                                    }
                                    // 关闭连接
                                    $conn->close();
                                }
                    
                                
                            }
                        ?>
						<div class="form-row">
							<input type="submit" value="注册" id="regbtn" class="btn btn-login" />
						</div>
					</form>
				</div>
				<div style="margin-top: 50px;"></div>
				<p class="foot">
				    <a id="already-account" href="./index.php">已有账号?点此登录</a>
				    <?php 
                        echo "<br><br><span style=\"font-size: 14px; color: gray;\">本次为您服务的服务器IP：$ip<br>您的IP：$remote_ip</span>";
				    ?>
				</p>
			</div>
		</div>
    </div>
</body>


</html>