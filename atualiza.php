<?php
session_start();
include_once "databaseconnect.php";
$login = $_SESSION['login'];
//$login = $_POST['login'];

$sql = "select * from users where login = '$login'";
$listagem = $conn->query($sql);
while ($lista = $listagem->fetch(PDO::FETCH_ASSOC)){
	$nomeOriginal = $lista['nome'];
	$loginOriginal = $lista['login'];
	$profissaoOriginal = $lista['profissao'];
	$cidadeOriginal = $lista['cidade'];
	$estadoOriginal = $lista['estado'];
}

//======== Validando campos vazios
if (!empty($_POST['nome'])) {
  $nome = $_POST['nome'];
}else{
  $nome = $nomeOriginal;
}
if (!empty($_POST['cidade'])) {
  $cidade = $_POST['cidade'];
}else{
  $cidade = $cidadeOriginal;
}
if (!empty($_POST['estado'])) {
  $estado = $_POST['estado'];
}else{
  $estado = $estadoOriginal;
}
if (!empty($_POST['profissao'])) {
  $profissao = $_POST['profissao'];
}else{
  $profissao = $profissaoOriginal;
}

// ===========fim da validação =====================


$sql2 = "UPDATE `users` SET `profissao` = '$profissao', `cidade` = '$cidade', `estado` = '$estado', `nome` = '$nome' WHERE `login` = '$login'";
$atualiza = $conn->query($sql2);

if($atualiza){
  echo"<script language='javascript' type='text/javascript'>
      alert('Usuário atualizado com sucesso!');window.location.href='painel.php'
      </script>";
}else{
  echo "<br> NAO atualizou <br>";
}

?>
