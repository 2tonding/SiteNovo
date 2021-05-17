<?php
session_start();
include_once "databaseconnect.php";

$login = $_SESSION['login'];
$nome = $_POST['nome'];
$profissao = $_POST['profissao'];
$estado = $_POST['estado'];
$cidade = $_POST['cidade'];

$sqlestado = "select e.estado, c.cidade from estado e join cidade c on c.idestado = e.idestado WHERE c.idcidade = '$cidade'";

$listaestado = $conn->query($sqlestado);
while ($listaest = $listaestado->fetch(PDO::FETCH_ASSOC)){
	$cidade2 = $listaest['cidade'];
	$estado2 = $listaest['estado'];
}

$imagem = $_POST['imagem'];

$imagem = $_FILES['imagem'];
$extensao = strtolower(substr($_FILES['imagem']['name'], -4));
$novo_nome = md5(time()) . $extensao;
$diretorio = "img_associado/";
move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio.$novo_nome);

$sql2 = "UPDATE `users` SET `profissao` = '$profissao', `cidade` = '$cidade2', `estado` = '$estado2', `nome` = '$nome', `imagem` = '$novo_nome' WHERE `login` = '$login'";
$atualiza = $conn->query($sql2);

if($atualiza){
  echo"<script language='javascript' type='text/javascript'>
      alert('Cadastro finalizado com sucesso!');window.location.href='painel.php'
      </script>";
}else{
  echo "<br> NÃO cadastrou <br>";
}

?>
