<?php
	$pc = 0;$pi=0;$pd = 0;$j=0;$c=0;$d=0;$m=0;$f=0;$n=0;
	if ($okjogo==1) 
	{

		$nome = $_POST["nome"];
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

		$prazocada = $_POST["prazocada"];
		$Dia=substr($prazocada,0,2);
		$Mes=substr($prazocada,3,2);
		$Ano=substr($prazocada,6,4);
		$tprazo = $Ano."-".$Mes."-".$Dia;
		if(($tprazo == "")||($Dia<=0)||($Dia>31)||($Mes<0)||($Mes>12))
		{
			$pc=1; $mensagem2= " prazo de cadastro;";
		}

		$prazodecisao = $_POST["prazodecisa"];
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

		$tamanhoinicial = $_POST["inicialdemanda"];
		$tamanhofinal = $_POST["finaldemanda"];
		if(($tamanhoinicial<=0)||($tamanhoinicial=="")||($tamanhofinal<=0)||($tamanhofinal==""))
		{
			$d = 1;
			$mensagem6 = " informações sobre demanda;";
		}

		$multiplosmaquinas = $_POST["multiplomaquinas"];
		$numeromaquinas = $_POST["numeromaquina"];
		if(($multiplosmaquinas<=0)||($multiplosmaquinas=="")||($numeromaquinas<=0)||($numeromaquinas==""))
		{
			$m = 1;
			$mensagem7 = " informações sobre máquinas;";
		}

		$integrantesequipe = $_POST["numeroequipe"];
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
			$fasedojogo = 0;
			$jogada = 1;
			$novojogo = "INSERT INTO jogos (Descricao, Equipe, DataInicio, PrazoCada, Rodadas, PrazoDecisao, TamanhoInicial,
			 TamanhoFinal, MaxEmprestimo, CapInicial, FaseJogo, adm_par, func_par, numaquina, 
			 maxmaquina, Jogada, InicioJogo) 
				VALUES ('".$nome."','".$integrantesequipe."','".$datainicio."','".$prazocada."','".$totalrodadas."','".$prazodecisao."','".$tamanhoinicial."',
					'".$tamanhofinal."','".$maximoemprestimo."','".$capitalinicial."','".$fasedojogo."','".$parameadm."','".$paramefunc."','".$numeromaquinas."',
					'".$multiplosmaquinas."','".$jogada."', '".$datainicio."')";
			
			mysqli_query($con, $novojogo);
			$ok=1;
		}
	}
?>