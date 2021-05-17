<?php
session_start();
include_once "databaseconnect.php";
$login = $_SESSION['login'];

if ($_FILES['imagem']['name']){
  $imagem = $_FILES['imagem'];
}else{
    echo"<script language='javascript' type='text/javascript'>
     alert('Nenhum arquivo foi selecionado');window.location.href='painel.php'
       </script>";
    die();
}

$extensao = strtolower(substr($_FILES['imagem']['name'], -4));
$novo_nome = md5(time()) . $extensao;
$diretorio = "img_associado/";
move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio.$novo_nome);

$sql2 = "UPDATE `users` SET `imagem` = '$novo_nome' WHERE `login` = '$login'";
$atualiza = $conn->query($sql2);

if($atualiza){
  echo"<script language='javascript' type='text/javascript'>
      alert('Foto atualizada com sucesso!');window.location.href='painel.php'
      </script>";
}else{
  echo "<br> NÃO cadastrou <br>";
}

?>
