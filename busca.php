<?php
session_start();
// include_once 'verifica_login.php';
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
	$nome = $lista['nome'];
	$login = $lista['login'];
	$profissao = $lista['profissao'];
	$cidade = $lista['cidade'];
	$estado = $lista['estado'];
	$imagem = $lista['imagem'];
}

$caminho = "img_associado/";
$url = $caminho.$imagem;
?>
<div class="limiter">
		<div class="container-login100">
    		<div class="wrap-painel">
    			<span class="painel-title">
						Busca por parceiros
              	<p class="logout">
                	<?php if (!$_SESSION['login']){
                  	echo "Seja bem vindo visitante! <a href='login.html'>Faca aqui o seu login</a>";
                	}else{echo "Não é " .$nome. "? <a href='logout.php'>Sair</a>"; } 
                	?>
              	</p>
				  <p class="logout">
                	<a href='painel.php'>Ir para o Painel de controle</a>
              	</p>
        		</span>	
			<div class="painel-title">
              <form class="login100-form-title" name="frmBusca" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>?a=buscar" >
              <input type="text" name="palavra" />
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
				<select id="cidade" name="cidade" style="display:none"> </select>
			
			<div class="painel-title">
              <input type="submit"  value="Buscar" />
          	 </div> </form>
          	</div>
    		
<div class="logout">
<?php            
$a = $_GET['a'];
if ($a == "buscar") {
    $palavra = trim($_POST['palavra']);
    $cid = $_POST['cidade'];
//achar o estado
$sqlestado = "select e.estado, c.cidade from estado e join cidade c on c.idestado = e.idestado WHERE c.idcidade = '$cid'";
$listaestado = $conn->query($sqlestado);
while ($listaest = $listaestado->fetch(PDO::FETCH_ASSOC)){
	$cidade2 = $listaest['cidade'];
	$estado2 = $listaest['estado'];
}
	// if ($_POST['estado'] == 'estado'){
	// 	$est = '';
	// }else{
	// 	$est = $_POST['estado'];
	// }
	$sql2 = "SELECT * FROM users WHERE nome LIKE '%".$palavra."%' AND estado LIKE '%".$estado2."%' ORDER BY estado, nome";
	// echo $sql2;
	$verifica = $conn->query($sql2);
    $conex = $verifica->fetchAll();
    if ($conex<=0){
        echo"Não achei ninguem";
    }else{
		foreach($conex as $item){
   			echo "<div class='logout'>Nome do usuário: <a href='perfil.php?id=".$item['id']."'>".$item['nome'] . "</a>  | Estado de atuação: ".$item['estado'] . "</p></div>";
		}
    }
}
?>		     
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