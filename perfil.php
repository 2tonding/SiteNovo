<?php
session_start();

// include_once 'verifica_login.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Perfil do Cliente</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->

</head>
<body>	
<?php
include_once "databaseconnect.php";
$id = $_GET['id'];
$sql = "select * from users where id = '$id'";
$listagem = $conn->query($sql);
while ($lista = $listagem->fetch(PDO::FETCH_ASSOC)){
	$nome = $lista['nome'];
	$login = $lista['login'];
	$profissao = $lista['profissao'];
	$cidade = $lista['cidade'];
	$estado = $lista['estado'];
	$imagem = $lista['imagem'];
	$telefone = $lista['telefone'];
}
$caminho = "img_associado/";
$url = $caminho.$imagem;

$login_sessao = $_SESSION['login'];
$sqlenvia = "select u.id, u.nome, u.acesso, c.credito, c.idwhats from users u join creditos c on u.idwhats = c.idwhats WHERE login = '$login_sessao'";
$listagemenvia = $conn->query($sqlenvia);
while ($lista2 = $listagemenvia->fetch(PDO::FETCH_ASSOC)){
	$nomeenvia = $lista2['nome'];
  	$idenvia = $lista2['id'];
  	$acesso = $lista2['acesso'];
	$credito = $lista2['credito'];
  $idwhats = $lista2['idwhats'];
}
?>

<div class="limiter">
		<div class="container-login100">
    		<div class="wrap-painel">
    			<span class="painel-title">
						Perfil do associado
              	<p class="logout">
                	<?php if (!$_SESSION['login']){
                  	echo "Seja bem vindo visitante! <a href='login.html'>Faca aqui o seu login</a>";
                	}else{echo "Não é " .$nomeenvia. "? <a href='logout.php'>Sair</a>"; } 
                	?>
              	</p>
        		</span>	
			<div class="painel-title">
				<div>
					<?php echo '<img src='.$url.' height="150" width="150" class="imagemperfil">';?>
				</div>
				<div>
					
					<h2><?php echo $nome; ?></h2>
					<p><?php echo $profissao; ?></p>
					<p><?php echo $cidade; ?></p>
					<p><?php echo $estado; ?></p>
				</div>

				<div>
					<button class="btn-perfil" type="button" onclick="loadDoc()">Ver Email</button>
					<script>
							function loadDoc() {
								var acesso = '<?php echo $acesso?>'; 
								var login = '<?php echo $login?>'; 

								if(acesso != 0){
									alert ("O email do usuário é "+login);
									
								}else{
									alert("Você precisa ter o pacote premium para ver o email. Você será direcionado para a página das assinaturas");
									window.location.href='assinatura.php';

								}
							}
					</script>
					




			  	</div>
			  	<div>
					<button class="btn-perfil" type="button" onclick="loadWA()">Enviar WhatsApp</button>
					<script>
					function loadWA() {
						var telefone = '<?php echo $telefone?>'; 
						var acesso = '<?php echo $acesso?>';
						var credito = '<?php echo $credito?>';
            			var idwhats = '<?php echo $idwhats?>';
            
						if(acesso != 0){
							if(credito > 0){
								alert("Você será direcionado ao WhatsApp. Você ainda possui "+credito+" créditos de WhatsApp");
              				<?php
                    				--$credito;
                    				$sqlcredito = "UPDATE `creditos` SET `credito` = '$credito' WHERE `idwhats` = '$idwhats'";
                    				$conn->query($sqlcredito);
							?>
							window.location.href='https://wa.me/55'+telefone;
							}else{
								alert("Você não possui créditos para envio do ZAP");
								
							}
						}else{
							alert("Você precisa ter o pacote premium para enviar WhatsApp");
						}
					}
					</script>
				</div>





				<div>
					<form class="login100-form validate-form" method="POST" action="mensagem.php" id="mensagem">
    				<div class="wrap-input100" data-validate = "Você deve digitar uma mensagem">
    					<textarea class="input100" form ="mensagem" name="mensagem" id="taid" cols="35" rows ="20" wrap="soft"></textarea>
						<span class="focus-input100"></span>
    					<span class="symbol-input100">
    						<i class="fa fa-envelope" aria-hidden="true"></i>
    					</span>
						<input type="hidden" id="nomeE" name="nomeE" value="<?php echo "$idenvia"; ?>">
						<input type="hidden" id="nomeR" name="nomeR" value="<?php echo "$id"; ?>">
    				</div>
					<div class="container-login100-form-btn">
						        <input type="submit" class="login100-form-btn" value="Enviar proposta" id="enviar" name="enviar">
					</div>
                    
				</div

        </div>
      </div>
</div>
</div>
			
	
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>

