<?php

include_once('config.php');

	if(isset($_POST['submit']))
	{
		//print_r($_POST['cep']);
		//print_r('<br>');
		//print_r($_POST['logradouro']);
		//print_r('<br>');
		//print_r($_POST['uf']);
		//print_r('<br>');
		//print_r($_POST['localidade']);
		//print_r('<br>');
		//print_r($_POST['bairro']);
		//print_r('<br>');
		//print_r($_POST['siafi']);
		//print_r('<br>');
		//print_r($_POST['ibge']);
		//print_r('<br>');
		//print_r($_POST['ddd']);
		//print_r('<br>');
		//print_r($_POST['gia']);

		$cep = $_POST['cep'];
		$logradouro = $_POST['logradouro'];
		$uf = $_POST['uf'];
		$localidade = $_POST['localidade'];
		$bairro = $_POST['bairro'];
		$siafi = $_POST['siafi'];
		$ibge = $_POST['ibge'];
		$ddd = $_POST['ddd'];
		$gia = $_POST['gia'];

		$result = mysqli_query($conexao, "INSERT INTO formulario_cep(cep,logradouro,estado,cidade,bairro,siafi,ibge,ddd,gia)
		VALUES ('$cep','$logradouro','$uf','$localidade','$bairro','$siafi','$ibge','$ddd','$gia')");

		header('Location: index.php');
		exit();
	}

	function exibirRegistros($colunaOrdenacao = 'cidade', $ordem = 'ASC') {
		$registros = carregarRegistros($colunaOrdenacao, $ordem);
	
		foreach ($registros as $registro) {
			echo '<li>' . $registro['cidade'] . '/' . $registro['estado'] . ' - ' . $registro['bairro'] . ' - ' . $registro['logradouro'] . '</li>';
		}
	}

    function carregarRegistros($colunaOrdenacao = 'cidade', $ordem = 'ASC') {
		global $conexao;
		$registros = [];
	
		$result = mysqli_query($conexao, "SELECT * FROM formulario_cep ORDER BY $colunaOrdenacao $ordem");
		while ($row = mysqli_fetch_assoc($result)) {
			$registros[] = $row;
		}
	
		return $registros;
	}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/script.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</head>
<body>
    <div class="container"> 
        <div class="box" id="appCep">
            <h2>Endereço</h2>
            <span id="message"></span>
            <form action="index.php" method="POST">
                <input type="text" name="cep" id="cep" v-model="endereco.cep" @change="cepEvento" placeholder="Cep" class="input">
                <input type="text" name="logradouro" id="logradouro" v-model="endereco.logradouro" placeholder="Logradouro" class="input">
                <input type="text" name="uf" id="uf" v-model="endereco.uf" placeholder="Estado" class="input">
                <input type="text" name="localidade" id="localidade" v-model="endereco.localidade" placeholder="Cidade" class="input">
                <input type="text" name="bairro" id="bairro" v-model="endereco.bairro" placeholder="Bairro" class="input">
                <input type="text" name="siafi" id="siafi" v-model="endereco.siafi" placeholder="SIAFI" class="input">
                <input type="text" name="ibge" id="ibge" v-model="endereco.ibge" placeholder="IBGE" class="input">
                <input type="text" name="ddd" id="ddd" v-model="endereco.ddd" placeholder="DDD" class="input">
                <input type="text" name="gia" id="gia" v-model="endereco.gia" placeholder="Gia" class="input">
				<input type="submit" name="submit" id="submit">
			</form>

			<h2>Registros Armazenados</h2>
            <ul class="registro-list">
                <?php exibirRegistros(); ?>
            </ul>
			
        </div>
    </div>
</body>
</html>