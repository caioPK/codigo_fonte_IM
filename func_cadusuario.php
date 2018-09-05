<?php
	$salvo = 0;
	$erro = 0;
	if ($okusuario == 1) 
	{
		
		$hoje = date("Y-m-d");
		$usuario = $_POST["usuario"];
		$senha = $_POST["senha"];
		$confirmarsenha = $_POST["confirmarsenha"];
		$equipe = $_POST["equipe"];
		$nome = $_POST["nome"];
		$email = $_POST["email"];
		$cpf = $_POST["cpf"];
		$endereco = $_POST["endereco"];
		$complemento = $_POST["complemento"];
		$bairro = $_POST["bairro"];
		$cidade = $_POST["cidade"];
		$estado = $_POST["estado"];
		$rg = $_POST["rg"];
		$datanascimento = $_POST["datanascimento"];
		$profissao = $_POST["profissao"];
		$no = $_POST["radAnswerN"];
		$numequipe = $_POST["codequipe"];
		
		
		if(($usuario == "")||($senha == "")||($nome == "")||($email == "")||($email == "")||($cpf == "")||
			($endereco == "")||($bairro == "")||($cidade == "")||($rg == "")||($estado == "")||
			($datanascimento == "")||($datanascimento == "__/__/____")||($profissao == ""))
		{
			$mensagem = "digite todas as informações.";
			$erro = 1;
		}
		elseif(($criarequipe == "")&&($numequipe == "")&&($no != ""))
		{
			$mensagem = "digite o número da equipe.";
			$erro = 1;
		}
		else
		{
			if($senha == $confirmarsenha)
			{
				$usuario=strtoupper($usuario);
				$Dia=substr($datanascimento,0,2);
				$Mes=substr($datanascimento,3,2);
				$Ano=substr($datanascimento,6,4);	
				$datanascimento=$Ano."-".$Mes."-".$Dia;
				$confirmacao = 2;
				$tipo = 1;
				$injog="INSERT INTO jogadores (NomeJogador, Cpf, Email, Endereco, Complemento, Bairro, Cidade, Estado, RG, Profissao, DataNascimento, Confirmacao)
				VALUES('".$nome."','".$cpf."','".$email."','".$endereco."','".$complemento."','".$bairro."','".$cidade."','".$estado."','".$rg."','".$profissao."', '".$datanascimento."', '".$confirmacao."')";
				mysqli_query($con, $injog) or die("erro1:".mysqli_error());

				$select = "SELECT CodJogador from jogadores WHERE Cpf = '".$cpf."' AND Email='".$email."'";
				$pegau = mysqli_query($con, $select);
				$campo = mysqli_fetch_object($pegau);
				$idjogador = $campo->CodJogador;

				$inusu="INSERT INTO usuarios (NomeUsuario, Senha, CodJogador, Tipo) VALUES ('".$usuario."',old_password('".$senha."'), '".$idjogador."' ,'".$tipo."')";
				mysqli_query($con, $inusu) or die("erro1:".mysqli_error());

				if($numequipe!="")
				{
					$inusu="INSERT INTO requipejogador (CodEquipe, CodJogador) VALUES ('".$numequipe."', '".$idjogador."')";
					mysqli_query($con, $inusu) or die("erro1:".mysqli_error());
				}

				$salvo = 1;

			}
			else
			{
				$mensagem = "digite senhas iguais.";
				$erro = 1;
			}
			
		}
	}
	
?>