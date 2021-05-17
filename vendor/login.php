<?php
session_start();
include_once "databaseconnect.php";
if (isset($_POST['login']) && !empty($_POST['login']) && isset($_POST['senha']) && !empty($_POST['senha'])){
    $login = $_POST['login'];
    $entrar = $_POST['entrar'];
    $senha = md5($_POST['senha']);

    if (isset($entrar)) {
          $sql = "SELECT COUNT(*) FROM usuarios WHERE login = '$login' AND senha = '$senha'";
          $verifica = $conn->query($sql);
          $count = $verifica->fetchColumn();
          
            if ($count<=0){
              echo"<script language='javascript' type='text/javascript'>
                    alert('Login e/ou senha incorretos');window.location.href='login.html';
                </script>";
            }else{
                $_SESSION['login'] = $login;
                //setcookie("login", $login);
                header('Location:painel.php');
                exit();
            }
    }      
}else{
  echo"<script language='javascript' type='text/javascript'>
            alert('Login e/ou senha ficaram em branco');window.location.href='login.html';
      </script>";
    exit();
}
?>

    