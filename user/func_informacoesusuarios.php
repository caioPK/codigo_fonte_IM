<?php

	$select = "SELECT * FROM jogadores j, usuarios u WHERE j.CodJogador= '".$_SESSION['usuarioID']."' AND u.CodJogador = j.CodJogador";
	$resultado=mysqli_query($con, $select);
	$campo=mysqli_fetch_object($resultado);
	$usuario = $campo->NomeUsuario;
	$nome = $campo->NomeJogador;
	$email = $campo->Email;
	$cpf = $campo->Cpf;
	$endereco = $campo->Endereco; 
	$bairro = $campo->Bairro;
	$estado = $campo->Estado;
	$cidade = $campo->Cidade;
	$rg = $campo->Rg;
	$profissao = $campo->Profissao;
	$redsenha = $campo->RedSenha;
	$complemento = $campo->Complemento;
	$nascimento=substr($campo->DataNascimento,8,2)."/".substr($campo->DataNascimento,5,2)."/".substr($campo->DataNascimento,0,4);

	$errocampo=0;

	if($rec=="salvar")
	{
		$usuario = $_POST["usuario"];
		$nome = $_POST["nome"];
		$email = $_POST["email"];
		$cpf = $_POST["cpf"];
		$endereco = $_POST["endereco"]; 
		$bairro = $_POST["bairro"];
		$estado = $_POST["estado"];
		$cidade = $_POST["cidade"];
		$rg = $_POST["rg"];
		$profissao = $_POST["profissao"];
		$complemento = $_POST["complemento"];
		$senha = $_POST["senha"];
		$confirmarsenha = $_POST["confirmarsenha"];
		$nascimento = $_POST["datanascimento"];
		$Dia=substr($nascimento,0,2);
		$Mes=substr($nascimento,3,2);
		$Ano=substr($nascimento,6,4);	
		$nascimento=$Ano."-".$Mes."-".$Dia;

		if(($usuario== "")||($nome== "")||($email== "")||($cpf== "")||($endereco== "")||($bairro== "")||($estado== "")||($rg== "")||($profissao== "")||($complemento== "")||($nascimento== "")||($profissao== "")||($senha== "")||($confirmarsenha == ""))
		{
			$errocampo = 1;
		}
		else
		{
			
			$Inclui="Update jogadores SET Cpf='$cpf', NomeJogador='$nome', Email='$email',
			Endereco='$endereco', Complemento='$complemento', Bairro='$bairro', Cidade='$cidade',
			Estado='$estado', Rg='$rg', Profissao='$profissao', DataNascimento='$nascimento'
			 WHERE CodJogador='".$_SESSION['usuarioID']."'";
				mysqli_query($con, $Inclui) or die("erro1:".mysqli_error());
			$redsenha = $redsenha + 1;
			$Inclui="Update usuarios SET NomeUsuario='$usuario', Senha=old_password('".$senha."'), RedSenha='$redsenha'
			 WHERE CodJogador='".$_SESSION['usuarioID']."'";
				mysqli_query($con, $Inclui) or die("erro2:".mysqli_error());
			 expulsaVisitante(); // TERMINA A SESSÃO E O USUÁRIO É ENVIADO PARA A PÁGINA DE LOGIN
		}
	}
?>
