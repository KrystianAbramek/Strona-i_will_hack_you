<?php
$con = mysqli_connect("localhost", "root", "", "baza")or die("Nie połączono z serwerem");

if (!isset($_POST['login']) || !isset($_POST['password'])) exit;
$login=trim($_POST['login']);
$password=trim($_POST['password']);
if (empty($login) || empty($password)) 
{
	include("index_login.html");
	echo("<script> alert('Brak loginu lub hasła!'); location.reload(index_login.html); </script>");
	exit;
}

$try_login=$_POST['login'];
$try_login=sha1($try_login); //szyfrowanie loginu
$try_password=$_POST['password'];
$try_password=sha1($try_password); //szyfrowanie hasła

$con = mysqli_connect("localhost", "root", "", "baza")or die("Nie połączono z serwerem");

$host = "localhost";
$user = "root";
$pass = "";
$db = "baza";

$wynik=mysqli_query($con, "SELECT count(*) from dane_logowania where login='$try_login' and password='$try_password';");
if (!$wynik){
	include("index_login.html");
	echo("<script> alert('Błąd w wykonaniu zapytania! Skontaktuj się z administratorem strony'); location.reload(index_login.html); </script>");
	exit;
}
$wiersz=mysqli_fetch_row($wynik);
$ile_znaleziono=$wiersz[0];
if ($ile_znaleziono>0){
	include("index.php");
}
else{
	include("index_login.html");
	echo("<script> alert('Błędne dane logowania!'); location.reload(index_login.html); </script>");   
}

/* WERSJA BETA
$try= mysqli_query($con, "SELECT login, password FROM dane_logowania");
				if(mysqli_num_rows($try)>0)
				{
					while($r = mysqli_fetch_array($try))
					{
						$key_login = $r['login'];
                        $key_pass = $r['password'];
					}
				}
mysqli_close($con);

if($user_login == $key_login && $user_password == $key_pass){
    include("index.php"); 
}
else if($user_login != $key_login && $user_password == $key_pass){
	include("index_login.php"); 
    echo("<script> alert('Błędny login'); location.reload(index_login.php); </script>");
}
else if($user_login == $key_login && $user_password != $key_pass){
	include("index_login.php"); 
    echo("<script> alert('Błędne hasło'); location.reload(index_login.php); </script>");
}
else{
	include("index_login.php"); 
    echo("<script> alert('Błędne dane logowania'); location.reload(index_login.php); </script>");
}
*/  
?>