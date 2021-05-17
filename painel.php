<?php
session_start();
include_once 'verifica_login.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Painel do usuário</title>
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
include_once "databaseconnect.php";
$login_sessao = $_SESSION['login'];
$sql = "select * from users where login = '$login_sessao'";
$listagem = $conn->query($sql);
while ($lista = $listagem->fetch(PDO::FETCH_ASSOC)){
	$id = $lista['id'];
  	$nome = $lista['nome'];
	$login = $lista['login'];
	$profissao = $lista['profissao'];
	$cidade = $lista['cidade'];
	$estado = $lista['estado'];
	$imagem = $lista['imagem'];
}

$caminho = "img_associado/";
$url = $caminho.$imagem;

$sqlestado = "select e.estado, c.cidade from estado e join cidade c on c.idestado = e.idestado WHERE c.idcidade = '$cidade'";
$listaestado = $conn->query($sqlestado);
while ($listaest = $listaestado->fetch(PDO::FETCH_ASSOC)){
	$cidade2 = $listaest['cidade'];
	$estado2 = $listaest['estado'];
}


?>
<div class="limiter">
		<div class="container-login100">
    		<div class="wrap-painel">
    			<span class="painel-title">
						Área do Associado
            <p class="logout">Não é <?php echo $nome; ?> ? <a href='logout.php'>Sair</a></p>
				</span>	
				<span class="painel-title">
				<p><a href='busca.php'>Acessar a ferramenta de busca</a></p></p>
				</span>	
			</div>
			<div class="wrap-painel">
				<div>
						<?php 
						echo '<img src='.$url.' height="250" width="250">';
						?>
            <div>
    						
    			</div>
					    <form enctype="multipart/form-data" class="login100-form validate-form" method="POST" action="atualizafoto.php">
						    <div class="wrap-input100 validate-input" data-validate = "Você precisa selecionar uma foto">
                  <input type="file" name="imagem" id="imagem" class="hidden">
              		<label for="file">Selecione um arquivo para alterar sua foto de perfil</label>
              
						    </div>
						
			            <input type="hidden" id="login" name="login" value="<?php echo "$login"; ?>">
					      <div class="container-login100-form-btn">
						       <input type="submit" class="login100-form-btn" value="Atualizar foto" id="atualiza" name="atualiza">
					      </div>
				      </form>
            </div>	

    			<form class="login100-form validate-form" method="POST" action="atualiza.php">
        			<span class="painel-texto">
    						Nome do usuário
    				</span>
    				<div class="wrap-input100" data-validate = "O nome não pode ficar em branco">
    					<input class="input100" type="text" name="nome" placeholder="<?php echo"$nome"; ?>">
    					<span class="focus-input100"></span>
    					<span class="symbol-input100">
    						<i class="fa fa-user" aria-hidden="true"></i>
    					</span>
    				</div>
    				
    				<span class="painel-texto">
    						Login (não pode ser alterado)
    				</span>
    				<div class="wrap-input100">
    					<input class="input100" type="text" name="login" placeholder="<?php echo"$login"; ?>" readonly>
    					<span class="focus-input100"></span>
    					<span class="symbol-input100">
    						<i class="fa fa-user" aria-hidden="true"></i>
    					</span>
    				</div>
    				
    				<span class="painel-texto">
    						Profissão
    				</span>
    				<div class="wrap-input100" data-validate = "A profissão não pode ficar em branco">
    					<input class="input100" type="text" name="profissao" placeholder="<?php echo"$profissao"; ?>">
    					<span class="focus-input100"></span>
    					<span class="symbol-input100">
    						<i class="fa fa-user" aria-hidden="true"></i>
    					</span>
    				</div>
    				
    				<span class="painel-texto">
    						Estado
    				</span>
    				<div class="wrap-input100" data-validate = "O Estado não pode ficar em branco">
    					
    				
					<select id="estado" name="estado">

                    <?php
                        include_once "databaseconnect.php";
                        $sqlestado = "SELECT * FROM estado ORDER BY estado ASC";
                        $listagem = $conn->query($sqlestado);
						echo '<option value="0" selected>'.$estado2.'</option>';
                        while ($lista = $listagem->fetch(PDO::FETCH_ASSOC)){
                                echo '<option value="'.$lista['idestado'].'">'.$lista['estado'].'</option>';
                        }
                        ?>
                </select>
    				</div>
    				<span class="painel-texto">
    						Cidade
    				</span>
    				<div class="wrap-input100" data-validate = "A Cidade não pode ficar em branco">
    				
					<select id="cidade" name="cidade">
             <?php echo '<option value="0" selected>'.$cidade2.'</option>'; ?>
          </select>

    				</div>
					<div class="container-login100-form-btn">
						        <input type="submit" class="login100-form-btn" value="Atualizar Dados" id="entrar" name="entrar">
					</div>

    				
				</form>

        		<div>
    			<span class="painel-title">
						Caixa de Mensagens
				</span>	
				<div>

					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#enviadas" aria-controls="profile" role="tab" data-toggle="tab">__Enviadas__</a></li>
						<li role="presentation"><a href="#recebidas" aria-controls="profile" role="tab" data-toggle="tab">__Recebidas__</a></li>
					</ul>

					<!-- Tab panes -->
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="enviadas">
							<h5> Mensagens Enviadas</h5>
							<?php
					
					$sqlenviadas = "SELECT * FROM users JOIN conversa on conversa.id = users.id WHERE conversa.remetente = '$id' order by `data_envio` DESC";
					// $sqlmensagem = "select * from conversa where remetente = '$id' order by `data_envio` DESC";
					$listagemenviadas = $conn->query($sqlenviadas);
					while ($listaenviadas = $listagemenviadas->fetch(PDO::FETCH_ASSOC)){
						$remetenteenviadas = $listaenviadas['remetente'];
						$destinatarioenviadas = $listaenviadas['destinatario'];

						$sqlRem = "select * from users where id = '$remetenteenviadas'";
						$listagemRem = $conn->query($sqlRem);
							while ($lista1 = $listagemRem->fetch(PDO::FETCH_ASSOC)){
								$remetenteNomeenviadas = $lista1['nome'];
							}
						$sqlDes = "select * from users where id = '$destinatarioenviadas'";
						$listagemDes = $conn->query($sqlDes);
							while ($lista2 = $listagemDes->fetch(PDO::FETCH_ASSOC)){
								$destinatarioNomeenviadas = $lista2['nome'];
							}


						echo "<div><p>Remetente: ".$remetenteNomeenviadas."</p>";
						echo "<p>Destinatário: ".$destinatarioNomeenviadas."</p></div>";
						echo "<div><p>Mensagem Enviada: ".$listaenviadas['mensagem']."</p>";
						echo "<p><b>Data do Envio:</b> ".$listaenviadas['data_envio']."</p></div>";
						echo"==================================================================================";
					}
					?>	
						</div>
						<div role="tabpanel" class="tab-pane" id="recebidas">
							<h5> Mensagens Recebidas</h5>
							<?php
					
					$sql3 = "SELECT * FROM users JOIN conversa on conversa.id = users.id WHERE conversa.destinatario = '$id' order by `data_envio` DESC";
					// $sqlmensagem = "select * from conversa where destinatario = '$id' order by `data_envio` DESC";
					$listagemdestinatario = $conn->query($sql3);
					while ($listadestinatario = $listagemdestinatario->fetch(PDO::FETCH_ASSOC)){
						$remetentedestinatario = $listadestinatario['remetente'];
						$destinatariodestinatario = $listadestinatario['destinatario'];

						$sqlRemdestinatario = "select * from users where id = '$remetentedestinatario'";
						$listagemRemdestinatario = $conn->query($sqlRemdestinatario);
							while ($lista3destinatario = $listagemRemdestinatario->fetch(PDO::FETCH_ASSOC)){
								$remetenteNomedestinatario = $lista3destinatario['nome'];
							}
						$sqlDesdestinatario = "select * from users where id = '$destinatariodestinatario'";
						$listagemDesdestinatario = $conn->query($sqlDesdestinatario);
							while ($lista2destinatario = $listagemDesdestinatario->fetch(PDO::FETCH_ASSOC)){
							$destinatarioNomedestinatario = $lista2destinatario['nome'];
							}


						echo "<div><p>Remetente: ".$remetenteNomedestinatario."</p>";
						echo "<p>Destinatário: ".$destinatarioNomedestinatario."</p></div>";
						echo "<div><p>Mensagem Enviada: ".$listadestinatario['mensagem']."</p>";
						echo "<p><b>Data do Envio:</b> ".$listadestinatario['data_envio']."</p></div>";
						echo"==================================================================================";
					}
					?>	
						</div>
							
					</div>

				</div>

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