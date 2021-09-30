<?php
	
	try{
		$pdo = new PDO("mysql:dbname=projeto_ordenar;host=localhost","root","");// conectando o banco chamando a classe PDO que conecta o banco com o login e senha

	}



catch(PDOException $e){ // garantindo segurança com o PDOexception da classe PDO


	echo "Erro na conexão".$e->getMessege(); // se ouver erro na conexão com o bd é enviado uma messagem
	exit;


}

if(isset($_GET['ordem']) && empty($_GET['ordem']) == false){
		$ordem = addslashes($_GET['ordem']);
		$sql = "SELECT * FROM usuarios ORDER BY ".$ordem;
	}else{
		$ordem = '';
		$sql = "SELECT * FROM usuarios";
	}



 ?>
<form method "GET">

		<select name ="ordem" onchange = "this.form.submit()">
			<option></option>
			<option value = "usuario" <?php echo($ordem =="usuario")?'selected ="selected"':'' ?>>Pelo nome</option>
			<option value = "idade" <?php echo($ordem =="idade")?'selected ="selected"':'' ?> >Pela idade</option>

		</select>

</form>
 <table border = "1" width = "400">
 		<tr>
 			<th>NOME</th>
 			<th>IDADE</th>


 		</tr>

<?php
	

	$sql = $pdo->query($sql);
	if($sql->rowCount() > 0 ){

		foreach ($sql->fetchAll() as $usuarios) :?>

		<tr>
			<td><?php  echo $usuarios['usuario']?></td>
			<td><?php  echo $usuarios['idade']?></td>


		</tr>
			
		
	<?php

	endforeach;
	}


?>


 </table>