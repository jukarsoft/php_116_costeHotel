<?php
	header('Content-Type: text/html; charset=UTF-8');
	$precioNoche=60;
	$noches=$precioDestino=$diasAlquiler=0;
	$total=null;
	
	if (isset($_POST['enviar'])) {
		//recuperar datos
		$noches=$_POST['noches'];
		$precioDestino=$_POST['ciudad'];
		$diasAlquiler=$_POST['coche'];
		if ($noches=='' || !is_numeric($noches)) {
			$total="no informado noches hotel";
		} else {
			$total=costeHotel($noches,$precioNoche); 
			//aplica coste del viaje en avión
			$total+=$precioDestino;
			$total+=costeCoche($diasAlquiler);
		}
	}

	//obtiene coste del hotel
	function costeHotel($n,$p) {
		return $total=$n*$p;

	}

	//obtiene coste del alquiler del coche
	function costeCoche($dias_alq) {
		$alqxdia=40;
		$coche=$dias_alq*$alqxdia;
		if ($dias_alq>6) {
			$coche-=50;
		} else if ($dias_alq>2) {
			$coche-=20;
		} 
		return $coche;
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Coste del viaje</title>
	<style type="text/css">
		label {
			width: 150px;
			display: inline-block;
		}
	</style>
</head>
<body>
	<form method="post" action="#">
		<label for="noches">Número de noches:</label>
		<input type="number" name="noches" id="noches" min="1" value="<?=$noches;?>" /><br><br>
		<label for="ciudad">Destino:</label>
		<select name="ciudad" id="ciudad">
			<option value="150" <?php if ($precioDestino=='150') {echo 'selected';}?> >Madrid</option>
			<option value="250" <?php if ($precioDestino=='250') {echo 'selected';}?> >Paris</option>
			<option value="450" <?php if ($precioDestino=='450') {echo 'selected';}?> >Los Angeles</option>
			<option value="200" <?php if ($precioDestino=='200') {echo 'selected';}?> >Roma</option>
		</select><br><br>
		<label for="coche">Días alquiler coche:</label>
		<input type="number" name="coche" id="coche" min="0" value="<?=$diasAlquiler;?>" /><br><br>
		<input type="submit" name="enviar" /><br><br>
		<label>Coste total: </label><input type="text" name="Total" value="<?=$total;?>" disabled />
	</form>
</body>
</html>