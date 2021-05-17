<?php
include_once "databaseconnect.php";
$select = conexao ->prepare(“SELECT * FROM estado ORDER BY nome ASC”);
$select-> execute();
$fetchAll = $select->fetchAll();
Foreach ($fetchAll as $estado){
	echo ‘<option value="'.$estado['id'].'">'.$estado['nome'].'</option>’;
}


?>




<select id="estado" name="estado">
				<option class="input100" value="estado">Estados</option>    
				<?php
					include_once "databaseconnect.php";
					$sqlEstado = "select DISTINCT estado from users order by estado";
					$listanova = $conn->query($sqlEstado);
					while ($listas = $listanova->fetch(PDO::FETCH_ASSOC)){
				?>
			    <option value="<?php echo $listas['estado']; ?>"><?php echo $listas['estado']; ?></option>
			    <?php } ?>
				</select>



$.ajax({
				url:'pegacidade.php',
				type: 'POST',
				data:{id:idEstado};
			});





$.ajax({
				url:'pegacidade.php',
				type: 'POST',
				data:{id:idEstado};
			});