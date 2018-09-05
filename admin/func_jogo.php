<?php

	$select="select * from jogos WHERE CodJogo='".$_SESSION['codjogo']."'";
	$resultado=mysqli_query($con, $select);  
	$idjogo=$_SESSION['codjogo'];
	
	$campojogo=mysqli_fetch_object($resultado);
	$prazocada=substr($campojogo->PrazoCada,8,2)."/".substr($campojogo->PrazoCada,5,2)."/".substr($campojogo->PrazoCada,0,4);
	$datainicio=substr($campojogo->DataInicio,8,2)."/".substr($campojogo->DataInicio,5,2)."/".substr($campojogo->DataInicio,0,4);
	$prazodecisao=substr($campojogo->PrazoDecisao,8,2)."/".substr($campojogo->PrazoDecisao,5,2)."/".substr($campojogo->PrazoDecisao,0,4);
	/*
	  Fase Jogo
		0 - o jogo ainda não começou
		1 - o jogo está em andamento
		2 - o jogo jah foi terminou
	*/
	switch ($campojogo->FaseJogo) 
	{
		case 0: $StatusJogo = "Em fase de cadastros"; break;
		case 1: $StatusJogo = "Em andamento"; break;
		case 2: $StatusJogo = "Terminado"; break;
	}

	$select="SELECT * FROM equipe WHERE CodJogo=".$_SESSION['codjogo'];
	$resultado=mysqli_query($con, $select);  
	$rowsjogo = mysqli_num_rows($resultado);

	$pc = 0;$pi=0;$pd = 0;$j=0;$c=0;$d=0;$m=0;$f=0;$n=0;
	
	if ($editar==1) {
		
		$nome = $_POST["nomejogo"];
		if ($nome == "") {
			$n = 1; $mensagem0 = " nome do jogo;";
		}
		
		$mensagem = "Preencha corretamente: ";
		$hoje = date("m-d-y"); 

		$datainicio = $_POST["datainicio"];
		$Dia=substr($datainicio,0,2);
		$Mes=substr($datainicio,3,2);
		$Ano=substr($datainicio,6,4);
		$tinicio=$Ano."-".$Mes."-".$Dia;
		if(($tinicio == "")||($Dia<=0)||($Dia>31)||($Mes<0)||($Mes>12))
		{
			$pi=1; $mensagem1 = " prazo de início;";
		}

		$prazocada = $_POST["prazodecadastro"];
		$Dia=substr($prazocada,0,2);
		$Mes=substr($prazocada,3,2);
		$Ano=substr($prazocada,6,4);
		$tprazo = $Ano."-".$Mes."-".$Dia;
		if(($tprazo == "")||($Dia<=0)||($Dia>31)||($Mes<0)||($Mes>12))
		{
			$pc=1; $mensagem2= " prazo de cadastro;";
		}
	

		$prazodecisao = $_POST["datadecisao"];
		$Dia=substr($prazodecisao,0,2);
		$Mes=substr($prazodecisao,3,2);
		$Ano=substr($prazodecisao,6,4);	
		$tdecisao = $Ano."-".$Mes."-".$Dia;
		if(($tdecisao == "")||($Dia<=0)||($Dia>31)||($Mes<0)||($Mes>12))
		{
			$pd=1; $mensagem3 = " prazo de decisão;";
		}

		$totalrodadas = $_POST["totalrodadas"];
		if(($totalrodadas<=0)||($totalrodadas==""))
		{
			$j = 1;
			$mensagem4 = " informações sobre jogadas;";
		}

		$capitalinicial = $_POST["capitalinicial"];
		$maximoemprestimo = $_POST["maximoemprestimo"];
		if(($maximoemprestimo<=0)||($maximoemprestimo=="")||($capitalinicial<=0)||($capitalinicial==""))
		{
			$c = 1;
			$mensagem5 = " informações sobre capital;";
		}

		$tamanhoinicial = $_POST["tamanhoinicial"];
		$tamanhofinal = $_POST["tamanhofinal"];
		if(($tamanhoinicial<=0)||($tamanhoinicial=="")||($tamanhofinal<=0)||($tamanhofinal==""))
		{
			$d = 1;
			$mensagem6 = " informações sobre demanda;";
		}

		$multiplosmaquinas = $_POST["multiplosmaquinas"];
		$numeromaquinas = $_POST["numeromaquinas"];
		if(($multiplosmaquinas<=0)||($multiplosmaquinas=="")||($numeromaquinas<=0)||($numeromaquinas==""))
		{
			$m = 1;
			$mensagem7 = " informações sobre máquinas;";
		}

		$integrantesequipe = $_POST["integrantesequipe"];
		$paramefunc = $_POST["paramefunc"];
		$parameadm = $_POST["parameadm"];
		if(($paramefunc<=0)||($paramefunc=="")||($parameadm<=0)||($parameadm=="")||($integrantesequipe<=0)||($integrantesequipe==""))
		{
			$f = 1;
			$mensagem8 = " informações sobre os funcionários;";
		}
		$fasedojogo = $campojogo->FaseJogo;
		$mensagem = "".$mensagem."".$mensagem0."".$mensagem1."".$mensagem2."".$mensagem3."".$mensagem4."".$mensagem5."".$mensagem6."".$mensagem7."".$mensagem8; 

		if(($pi==0)&&($pc==0)&&($pd==0)&&($j==0)&&($j==0)&&($c==0)&&($d==0)&&($m==0)&&($f==0)&&($n==0))
		{

			$prazocada = $tprazo;
			$prazodecisao = $tdecisao;
			$datainicio=$tinicio;
			if ($fasedojogo==3) {
				$fasedojogo=3;
			}
			elseif ($hoje>$prazodecada) {
				$fasedojogo = 1;
			}
			else
			{
				$fasedojogo = 0;
			}
			
			
			$Inclui="Update jogos SET Descricao='$nome', Equipe='$integrantesequipe', DataInicio='$datainicio',
			PrazoCada='$prazocada', Rodadas='$totalrodadas',PrazoDecisao='$prazodecisao', TamanhoInicial= '$tamanhoinicial', TamanhoFinal= '$tamanhofinal', MaxEmprestimo= '$maximoemprestimo',
			CapInicial='$capitalinicial', FaseJogo='$fasedojogo', adm_par='$parameadm', func_par='$paramefunc', numaquina='$numeromaquinas', maxmaquina='$multiplosmaquinas'

			 WHERE CodJogo='".$_SESSION['codjogo']."'";
			 mysqli_query($con, $Inclui) or die("erro1:".mysqli_error());
			$ok = 1;

		}
		
	}
	
?>