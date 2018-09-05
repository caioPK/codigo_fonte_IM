<?php

	if ($okequipe == 1) 
	{
		$nomeequipe = $_POST["nomeequipe"];
		$senhaequipe = $_POST["senhaequipe"];
		$csenhaequipe = $_POST["confirmarsenhaequipe"];
		$jogoequipe = $_POST["jogo"];
		$configuraoequipe = 3;
		/*
			CONFIGURAÇÃO EQUIPE:
				1 - ATIVA = NÃO ACEITARÁ MAIS INSCRIÇÕES
				3 - ESPERANDO INSCRIÇÕES
		*/
		if($senhaequipe == $csenhaequipe)
		{
			if(($nomeequipe=="")||($senhaequipe=="")||($csenhaequipe=="")||($jogoequipe==""))
			{
				$mensagem = "preencha todos os campos";
			}
			elseif($jogoequipe=="")
			{
				$mensagem = "ainda não existe nenhum jogo disponível";
			}
			else
			{
				$nomeequipe=strtoupper($nomeequipe);
				$inserir="INSERT INTO equipe (NomeEquipe, SenhaEquipe, CodJogo, ConfEquipe) VALUES ('".$nomeequipe."',old_password('".$senhaequipe."'),'".$codjogo."','".$configuraoequipe."')";
				mysqli_query($con, $inserir) or die("erro1:".mysqli_error($con));

				$select= "SELECT CodEquipe FROM equipe WHERE NomeEquipe = '".$nomeequipe."' AND CodJogo = '".$codjogo."'";
				$resultado=mysqli_query($con, $select);
				$campo=mysqli_fetch_object($resultado); 
				$codequipe = $campo->CodEquipe;
				
				$inserir2 = "INSERT INTO requipejogador (CodEquipe, CodJogador, Tipo) VALUES ('".$codequipe."', '".$_SESSION['usuarioID']."', '1')";
				mysqli_query($con, $inserir2) or die("erro1:".mysqli_error($con));

				$alterar="update jogadores SET Confirmacao='1' WHERE CodJogador='".$_SESSION['usuarioID']."'";
				mysqli_query($con, $alterar) or die("erro2:".mysql_error());

				$ok = 1;
			}
		}
		else
		{
			$mensagem = "digite senhas iguais";
		}
	}
	if ($okfilia == 1) 
	{
		$nomeequipe = $_POST["nomeequipe"];
		$jogoequipe = $_POST["jogo"];
		$configuraoequipe = 3;
		/*
			CONFIGURAÇÃO EQUIPE:
				1 - ATIVA = NÃO ACEITARÁ MAIS INSCRIÇÕES
				3 - ESPERANDO INSCRIÇÕES
		*/
		if($senhaequipe == $csenhaequipe)
		{
			if(($nomeequipe=="")||($jogoequipe==""))
			{
				echo $nomeequipe;
				echo $jogoequipe;
				$mensagem = "preencha todos os campos";
			}
			elseif($jogoequipe=="")
			{
				$mensagem = "ainda não existe nenhum jogo disponível";
			}
			else
			{
				$select= "SELECT CodEquipe FROM equipe WHERE NomeEquipe = '".$nomeequipe."' AND CodJogo = '".$codjogo."'";
				$resultado=mysqli_query($con, $select);
				$campo=mysqli_fetch_object($resultado); 
				$codequipe = $campo->CodEquipe;
				
				$inserir2 = "INSERT INTO requipejogador (CodEquipe, CodJogador, Tipo) VALUES ('".$codequipe."', '".$_SESSION['usuarioID']."', '2')";
				mysqli_query($con, $inserir2) or die("erro1:".mysqli_error($con));

				$alterar="update jogadores SET Confirmacao='2' WHERE CodJogador='".$_SESSION['usuarioID']."'";
				mysqli_query($con, $alterar) or die("erro2:".mysql_error());

				$ok = 1;
			}
		}
		else
		{
			$mensagem = "digite senhas iguais";
		}
	}

?>