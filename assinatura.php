<?php
session_start();
include_once "databaseconnect.php";
$login_sessao = $_SESSION['login'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Assinaturas</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="../images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../css/util.css">
	<link rel="stylesheet" type="text/css" href="../css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<span class="login100-form-title">
						Selecione a sua assinatura
					</span>

				<form class="login100-form validate-form" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>?a=pacote">
					<span class="login100-form-title">
						Pacote de Serviços
					</span>
						-> CRIAÇÃO E VEICULAÇÃO DO SEU PERFIL NO SITE<br>
						-> MENSAGENS ILIMITADAS*<br>
						-> ACESSO AO SITE E REDES SOCIAIS DOS OUTROS ASSOCIADOS<br>
						-> ACELERADOR DE NEGOCIAÇÃO<br>
						-> 01 ANÚNCIO PREFERENCIAL BÔNUS<br>
						-> POSIÇÃO PRIVILEGIADA NO RESULTADO DAS BUSCAS<br>
						-> DESCONTO NA COMPRA DE SMS<br>
						-> CONSULTOR EXCLUSIVO<br>
					
					
					<div class="container-login100-form-btn">
						        <input type="submit" class="login100-form-btn" value="QUERO ESTE" id="entrar" name="entrar">
					</div>
				</form>
				<form class="login100-form validate-form" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>?a=gold">
					<span class="login100-form-title">
						Pacote GOLD
					</span>
                        -> ACESSO <B>DIRETO</B> AOS TELEFONES<br>
						-> CRIAÇÃO E VEICULAÇÃO DO SEU PERFIL NO SITE<br>
						-> MENSAGENS ILIMITADAS*<br>
						-> ACESSO AO SITE E REDES SOCIAIS DOS OUTROS ASSOCIADOS<br>
						-> ACELERADOR DE NEGOCIAÇÃO<br>
						-> POSIÇÃO PRIVILEGIADA NO RESULTADO DAS BUSCAS<br>
						-> DESCONTO NA COMPRA DE SMS<br>
						-> CONSULTOR EXCLUSIVO<br>
					
					
					<div class="container-login100-form-btn">
						        <input type="submit" class="login100-form-btn" value="QUERO ESTE" id="entrar" name="entrar">
					</div>
				</form>
			<div class="logout">
			<?php           
				$tipoAssinatura = $_GET['a'];
				// $path = $_SERVER['DOCUMENT_ROOT'];
				// $file = $path . '/databaseconnect.php';
				// //echo $file;
				include_once 'databaseconnect.php'; 
				if ($tipoAssinatura == "pacote") {
					$sqlassinatura = "select * from pacote WHERE tipo = 'pacote'";
					$lista = $conn->query($sqlassinatura);
					while ($listaass = $lista->fetch(PDO::FETCH_ASSOC)){
						echo "<div class='logout'>Assinatura ".$listaass['nome'].
						" - R$ ".$listaass['valor']." a cada ciclo de pagamento
						<form action='pagseguro/efetuarPagamento.php'>
						<input type='hidden' id='link' name='link' value='".$listaass['link']."'>
						<input type='hidden' id='nome' name='nome' value='".$listaass['nome']."'>
						<input type='hidden' id='valor' name='valor' value='".$listaass['valor']."'>
						<input type='submit' value='Assinar' /></form>
						</div>";
					}
				}else if ($tipoAssinatura == "gold") {
					$sqlgold = "select * from pacote WHERE tipo = 'gold'";
					$listag = $conn->query($sqlgold);
					while ($listaassg = $listag->fetch(PDO::FETCH_ASSOC)){
						echo "<div class='logout'>Assinatura ".$listaassg['nome'].
						" - R$ ".$listaassg['valor']." a cada ciclo de pagamento
						<form action='pagseguro/efetuarPagamento.php'>
						<input type='hidden' id='link' name='link' value='".$listaassg['link']."'>
						<input type='hidden' id='nome' name='nome' value='".$listaassg['nome']."'>
						<input type='hidden' id='valor' name='valor' value='".$listaassg['valor']."'>
						<input type='submit' value='Assinar' /></form>
						</div>";
						//<input type="hidden" id="login" name="login" value='".$listaassg['link'].";'>
					}
				}

					
				?>		

			</div>				
			</div>

		</div>
	</div>
	

	
<!--===============================================================================================-->	
	<script src="../vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/bootstrap/js/popper.js"></script>
	<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="../vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="../js/main.js"></script>

</body>
</html>