<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Seja bem Vindo!!</title>
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
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/logoRD.png" alt="IMG">
				</div>

				<form class="login100-form validate-form">
					<span class="login100-form-title">
						<?php if ($_SESSION['login']): ?>
  							<p>Bem-Vindo Associado!!!!</p>
							<span class="painel-title">
							<p><a href='busca.php'>Acessar a ferramenta de busca</a></p></p>
							</span>
                            <p><font color='red'>OU</font></p>
							<span class="painel-title">
                            <p><a href="painel.php">Acesse o seu painel</a></p>
							</span>
                            <p><font color='red'>OU</font></p>
							<span class="painel-title">
							<p> <a href="logout.php">Faça o seu logout</a></p>
							</span>
						<?php else: ?>
  							<p>Bem-Vindo Visitante!</p>
                            <p>Essas informações são somente para usuários logados</p>
<div class="container-login100-form-btn">
						<button type="reset" class="login100-form-btn" onclick="window.location='http://marciof4.sg-host.com/login.html'">
						    Já tenho cadastro
						</button>
					</div>
          <div class="container-login100-form-btn">
						<button type="reset" class="login100-form-btn" onclick="window.location='http://marciof4.sg-host.com/cadastro.html'">
						    Quero me cadastrar
						</button>
					</div>
						<?php endif; ?>
					</span>
          
					<span style="display:block; height: 180px;"></span>
				</form>
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