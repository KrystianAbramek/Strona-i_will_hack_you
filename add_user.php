<?php

$con = mysqli_connect("localhost", "root", "", "baza")or die("Nie połączono z serwerem");

		$host = "localhost";
		$user = "root";
		$pass = "";
		$db = "serwer";

        if (!isset($_POST['imie']) || !isset($_POST['nazwisko']) || !isset($_POST['login']) || !isset($_POST['passwd'])) exit;
        $try_imie=trim($_POST['imie']);
        $try_nazwisko=trim($_POST['nazwisko']);
        $try_login=trim($_POST['login']);
        $try_password=trim($_POST['passwd']);
        if (empty($try_imie) || empty($try_nazwisko) || empty($try_login) || empty($try_password)) 
        {
            include("index.php");
	        echo("<script> alert('Podaj pełne dane'); location.reload(index.php); </script>");
	        exit;
        }

		$name=$_POST['imie'];
		$surname=$_POST['nazwisko'];
		$login=$_POST['login'];
		$password=$_POST['passwd'];

        $login=sha1($login);
        $password=sha1($password);

		$add_user=mysqli_query($con, "INSERT INTO dane_logowania (imie, nazwisko, login, password) VALUES ('$name', '$surname', '$login', '$password')");
		
		if($add_user){	
            include("index.php");
	        echo("<script> alert('Poprawnie dodano użytkownika'); location.reload(index.php); </script>");
		}
		else{
            include("index.php");
            echo("<script> alert('Nie dodano użytkownika'); location.reload(index.php); </script>");
        }


?>