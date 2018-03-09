<?php
	header("Cache-Control", "no-cache, no-store, must-revalidate");
	$login = $_GET['login'];
	$username = $_GET['username'];
	if($login==0) 
		include("header.php");
	else if($login==1)
	{
		$_SESSION['username'] = $username;
		include("login_header.php");
	}
	include("side_menu.php");
	//include("connect.php");
	$conn = mysqli_connect("localhost","root","");
	mysqli_select_db($conn,"ita");
	$sql = "SELECT * FROM products where pid like '1%' ORDER BY pid "; 
	$result = $conn->query($sql);
?>
<HTML>
<HEAD>
<TITLE>Men's Wear</TITLE>
<!--<link href="imageStyles.css" rel="stylesheet" type="text/css" />-->
<style>
div.box  {
	width: 300px;
	height: 350px;
	border-style: solid;
	border-radius: 15px;
	border-color: grey;
	padding-top: 15px;
	padding-right: 25px;
	padding-left: 25px;
	padding-bottom: 370px;
	margin: 5px;
	text-align: center;
	background-color: #d6ebd9;
}

div.box img {
	width: 100%;
	height: 200px;
	-webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.5s;
}

div.box img:hover {
	transform: scale(1.2);
}

div.box h3 {
	text-align: center;
	font-family: arial;
	padding-top: 20px; 
}
div.box h4 {
	text-align: center;
	font-family: Times New Roman;
	padding-top: 20px; 
}

div.box input {
	text-align: center;
	align-content: center;
	float: center;
	margin-bottom: 30px;
	background-color: #4CAF50;
	-webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
}

div.box input:hover {
	background-color: #367477; 
    color: white;	
}

.gallery {
	width: 200px;
	height: 200px;
	padding: 35px;
}
</style>

</HEAD>
<BODY bgcolor="#E6E6FA">
<br><br>
<div class="main">
<table align="center">
<?php
	$i=0;
	while($row = mysqli_fetch_assoc($result))
	{
		$pid = $row['pid'];
		$login = $_GET['login'];
		//echo "$name";
		if($i%3==0){
			echo"<tr>";
		}
		echo"<td><div class = 'box'><img src = 'images/men/{$row['image']}' alt = '{$row['pid']}'>
		<h4><b>{$row['pname']}<b></h4>
		<h3>Price: <b>Rs.{$row['price']}</b></h3>
		<br>
		<form action = 'men_shop.php?pid=$pid & login=$login' method = 'post'>
		<input type='submit' class='btn btn-primary' align='center' name='{$pid}' value='Buy'></input></form></div></td>";
		if($i%3==2){
			echo"</tr>";
		}
		$i++;
	} 
/*{
	echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['pic'] ).'"/>';
	//header("Content-type: " . $row["pic"]); 
	//echo $row["pic"]; 
}*/
?>
</table>
</div>

</BODY>
</HTML>
<?php
	echo "<br>"; 
	include("footer.php");
?>
