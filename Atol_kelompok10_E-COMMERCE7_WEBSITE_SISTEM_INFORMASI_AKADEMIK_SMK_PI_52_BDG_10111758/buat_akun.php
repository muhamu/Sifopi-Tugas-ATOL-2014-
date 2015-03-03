<style>

#body{

    background-image:url(images/backback.jpg);   

}

#main {
	width: 700px;
	height: 500px;
	background:white;
	text-align: center;
	margin-top: 40px;
	border-radius: 30px;
	;
	margin-right: auto;
	margin-bottom: auto;
	margin-left: auto;
}

#head {
	width: 700px;
	height: 100px;
	background:#003399;
	margin-bottom: 30px;
	text-align: center;
	padding-top: 10px;
	border-top-left-radius: 30px;
	border-top-right-radius: 30px;
	font-family:Helvetica;
}

#isi {

    width: 700px;

    height: 500px;

    padding-left: 150px;  

    font-family:arial; 

    text-align: left;

    font-weight:bold;

    font-family:Helvetica;

}

#input1 {   

        padding: 6px;  

        border: solid 1px #E5E5E5;  

        outline: 0;  

        font: normal 13px/100% Verdana, Tahoma, sans-serif;  

        width: 400px;

        height: 50px;  

        background: #FFFFFF url('../../test/bg_form.png') left top repeat-x;  

        background: -webkit-gradient(linear, left top, left 25, from(#FFFFFF), color-stop(4%, #EEEEEE), to(#FFFFFF));  

        background: -moz-linear-gradient(top, #FFFFFF, #EEEEEE 1px, #FFFFFF 25px);  

        box-shadow: rgba(0,0,0, 0.1) 0px 0px 8px;  

        -moz-box-shadow: rgba(0,0,0, 0.1) 0px 0px 8px;  

        -webkit-box-shadow: rgba(0,0,0, 0.1) 0px 0px 8px;

        margin: 3px;  

        }  

#textarea {   

        width: 400px;  

        max-width: 400px;  

        height: 150px;  

        line-height: 150%;  

        }  

    input:hover, textarea:hover,  

    input:focus, textarea:focus {   

        border-color: #C9C9C9;   

        -webkit-box-shadow: rgba(0, 0, 0, 0.15) 0px 0px 8px;  

        }  

#label {   

        color:#FF8040;

        margin-bottom: 10px;   

        }  

#submit1 {  

        width: 250px;  

        padding: 15px;  

        background: #617798;  

        border: 0;  

        font-size: 14px;  

        color: #FFFFFF;  

        -moz-border-radius: 5px;  

        -webkit-border-radius: 5px;

        margin-left: 80px;

        margin-top: 10px;

        border-radius: 10px;

        }  

.style1 {color: #FFFFFF}
</style>

<?php

session_start();

if (!empty($_SESSION['username'])) {

header('location:index.php');

}

?>

<html>

<title>Selamat Datang | Sistem Akademik SMK PI 52 Bandung</title><head>

</head>

<body id="body">

<div id="main">

<div id="head">
  <h1 class="style1"><img src="images/logo.png" width="272" height="84"></h1>
</div>

<div id="isi">

<?php 

//kode php ini kita gunakan untuk menampilkan pesan eror

if (!empty($_GET['error'])) {

if ($_GET['error'] == 1) {

echo 'Username dan Password belum diisi';

} else if ($_GET['error'] == 2) {

echo 'Username belum diisi!';

} else if ($_GET['error'] == 3) {

echo '<h3>Password belum diisi!</h3>';

} else if ($_GET['error'] == 4) {

echo 'Username dan Password tidak terdaftar';

}

}

?>

<form id="form" name="login" action="../../test/otentikasi.php" method="post">

     <label id="label">Username :</label><br />
   <input id="input1" type="text" name="username" size="30"/><br />  
  <label id="label">Password :</label><br />
   <input id="input1" type="password" name="password" size="30"/><br />
  <input id="submit1" type="submit" name="login" value="Login" />
 </form>

</div>
</div>
</body>
</html>