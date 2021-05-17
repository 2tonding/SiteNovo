<?php
include_once "databaseconnect.php";
$sql = "SELECT * FROM cidade WHERE idestado = '".$_POST['id']."'";
$listagem = $conn->query($sql);
		while ($lista = $listagem->fetch(PDO::FETCH_ASSOC)){
				echo '<option value="'.$lista['idcidade'].'">'.$lista['cidade'].'</option>';
		}
		?>