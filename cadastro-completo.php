<?php
session_start();
include_once 'verifica_login.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Cadastro de Usuário</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script type="text/javascript" src="js/jquery.js"></script>
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
$login = $_SESSION['login'];
?>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/img-01.png" alt="IMG">
          
				</div>

				<form enctype="multipart/form-data" class="login100-form validate-form" method="POST" action="cadastrofinalizado.php">
					<span class="login100-form-title">
						Cadastro Especial
					</span>
          <div class="wrap-input100 validate-input" data-validate = "Nome é obrigatório">
						<input class="input100" type="text" name="nome" id="nome" placeholder="Nome Completo">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>
          <div class="wrap-input100 validate-input" data-validate = "Profissão é obrigatório">
						<input class="input100" type="text" name="profissao" id="profissao" placeholder="Profissão">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-suitcase" aria-hidden="true"></i>
						</span>
					</div>
					<div class="wrap-input100 validate-input">
					Selecione um estado:
  					<select id="estado" name="estado">

                    <?php
                        include_once "databaseconnect.php";
                        $sqlestado = "SELECT * FROM estado ORDER BY estado ASC";
                        $listagem = $conn->query($sqlestado);
                        while ($lista = $listagem->fetch(PDO::FETCH_ASSOC)){
                                echo '<option value="'.$lista['idestado'].'">'.$lista['estado'].'</option>';
                        }
                        ?>
                </select>
					</div>
          <div class="wrap-input100 validate-input" data-validate = "Cidade é obrigatório">
						<select id="cidade" name="cidade" style="display:none"> </select>
					</div>
          <div>
            <label>Selecione uma foto</label>
            <input type="file" name="imagem" id="imagem">    
          </div>					
          
           <input type="hidden" id="login" name="login" value="<?php echo "$login"; ?>">

					<div class="container-login100-form-btn">
						        <input type="submit" class="login100-form-btn" value="Finalizar cadastro" id="entrar" name="entrar">
					</div>
					

					<div class="text-center p-t-136">
					
					</div>
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
<script>
		$("#estado").on("change", function(){
			var idEstado = $("#estado").val();
			$.ajax({
				url:'pegacidade.php',
				type: 'POST',
				data:{id:idEstado},
				beforeSend: function(){
						$("#cidade").css({'display': 'block'});
						$("#cidade").html("Carregando...");
				},
                success: function(data){
						$("#cidade").css({'display': 'block'});
						$("#cidade").html(data);
				},
                error: function(data){
						$("#cidade").css({'display': 'block'});
						$("#cidade").html("Houve um erro ao carregar...");
				}
			});
		});
</script>