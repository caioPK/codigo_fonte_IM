<?php
	$quebralinha = "<br/>";
	ob_start();
	include("../seguranca.php"); // Inclui o arquivo com o sistema de segurança
	protegePagina(); // VERIFICA SE O USUÁRIO ESTÁ LOGADO. SE NÃO, SERÁ ENVIADO PARA PÁGINA DE LOGIN.

	$exit = $_POST[sair]; // VARIÁVEL QUE RECEBE SE O USUÁRIO QUER SAIR OU NÃO
	if (($exit != "") || ($_SESSION['usuarioTipo'] == 1)) // VERIFICA SE O USUÁRIO QUER SAIR OU SE O USUÁRIO NÃO É DO TIPO 1 = TIPO DIFERENTE DE ADM
	{
	  expulsaVisitante(0); // TERMINA A SESSÃO E O USUÁRIO É ENVIADO PARA A PÁGINA DE LOGIN
	}
	include("../conecta.php");
	mysqli_set_charset($con,'utf8');
	
	$jogo = $_SESSION['codjogo'];
	// FUNÇÃO PARA CALCULAR OS VALORES IQUALIDADE, IMARKETING E ASSIM POR DIANTE
	function calculavalor($jog, $val1, $val2, $val3, $chave){
		if (($val1==0)||($val2==0)||($val3==0)) 
		{
			$val1 = 50; $val2 = 50; $val3 = 50;
		}
        $Valor = 0;

        if ($jog == 1)
        {
        	$Valor = $val1;
        }

        elseif(($jog==2)||($chave == True)&&($jog>=2))
        {
        	$jog2=$jog-1;
        	$Valor = ($jog*$val1 + $jog2*$val2)/($jog + $jog2);
          	
        }

        elseif(($jog>3)&&($chave == False))
        {
        	$jog2 = $jog-1;
        	$jog3 = $jog2-1;
			$Valor = ($jog*$val1 + $jog2*$val2 + $jog3*$val3)/($jog + $jog2 + $jog3);
        }
        
        return $Valor;
    }


	include("../conecta.php");

	// AQUI SELECIONA A JOGADA
	$select = "SELECT Jogada, Equipe, Rodadas from jogos WHERE CodJogo = '".$jogo."'";
	$pegajo = mysqli_query($con, $select);
	$campo = mysqli_fetch_object($pegajo);
	$jogada = $campo->Jogada;
	$rodadas = $campo->Rodadas;
	$num = $campo->Equipe;
	// AQUI SERÁ CALCULADA A QUANTIDADE DE EQUIPES NO JOGO
	$select = "SELECT Equipe FROM produto WHERE Jogo='".$jogo."' GROUP BY Equipe HAVING count(`Equipe`)>1";
	
	$resultado = mysqli_query($con, $select);

	$num = mysqli_num_rows($resultado);

	$rows = [];
	$i = 0;
	while($row = mysqli_fetch_array($resultado)){
	    $rows[] = $row;
	    $i++;
	}
	// AQUI SERÁ CALCULADA A QUANTIDADE DE EQUIPES NO JOGO
	$BackOrderAtual[] = 5;
	for ($pd=1; $pd <= 4; $pd++) { 
		${"q".$pd}[] = $num;
		${"Qi".$p}[] = $num;
	}
	$QualTotal[] = $num; $PubliTotal[] = $num; $MarkTotal[] = $num; $PeDTotal[] = $num; $iSalario[] = $num;
	for ($i=0; $i <= $num-1; $i++) {	
		$QualTotal[$i] = 0;
		$PubliTotal[$i] = 0;
		$MarkTotal[$i] = 0;
		$PeDTotal[$i] = 0;
		for ($p=1; $p <= 4; $p++) 
		{ 

			${"Qualidade".$p}[] = $num; ${"Publicidade".$p}[] = $num; ${"Marketing".$p}[] = $num; ${"PeD".$p}[] = $num;
			${"iQualidade".$p}[] = $num; ${"iPeD".$p}[] = $num; ${"iPublicidade".$p}[] = $num; ${"iPrecoQtde".$p}[] = $num;
			$Equipe = $rows[$i][0];
			// SELECIONA AS DECISÕES DO JOGADOR PARA CALCULAR OS ÍNDICES
			$select = "SELECT * from produto WHERE Jogo = '".$jogo."' AND Equipe='".$rows[$i][0]."' AND Jogada=".$jogada." AND produto=".$p."";
			$pegau = mysqli_query($con, $select);
			$campo = mysqli_fetch_object($pegau);
			${"Qualidade".$p}[$i] = $campo->Qualidade;	${"Publicidade".$p}[$i] = $campo->Publicidade;	${"Marketing".$p}[$i] = $campo->Marketing;	${"PeD".$p}[$i] = $campo->PeD;

			
			$QualTotal[$i] = $QualTotal[$i] + ${"Qualidade".$p}[$i];
			$PubliTotal[$i] = $PubliTotal[$i] + ${"Publicidade".$p}[$i];
			$MarkTotal[$i] = $MarkTotal[$i] + ${"Marketing".$p}[$i];
			$PeDTotal[$i] = $PeDTotal[$i] + ${"PeD".$p}[$i];

			if ($jogada > 1) {
				$jogadaant = $jogada - 1;
				$select = "SELECT Qualidade, Publicidade, Marketing, PeD, ValEstoque, Estoque from produto WHERE Jogo = '".$jogo."' AND Equipe='".$rows[$i][0]."' AND Jogada=".$jogadaant." AND produto=".$p."";
				$pegau = mysqli_query($con, $select);
				$campo = mysqli_fetch_object($pegau);
				$Qualidadeant = $campo->Qualidade;	$Publicidadeant = $campo->Publicidade;	$Marketingant = $campo->Marketing;	$PeDant = $campo->PeD;
				${"ValorEstAnt".$p}[$i] = $campo->ValEstoque;
				${"EstoqueAnt".$p}[$i] = $campo->Estoque;
			}
			else{
				$Qualidadeant = 0; $Publicidadeant = 0; $Marketingant = 0; $PeDant = 0;
				${"ValorEstAnt".$p}[$i] = 0;
				${"EstoqueAnt".$p}[$i] = 0;
			}
			
			if ($jogada > 2) 
			{
				$jogadaant2 = $jogadaant - 1;
				$select = "SELECT Publicidade, Marketing from produto WHERE Jogo = '".$jogo."' AND Equipe='".$rows[$i][0]."' AND Jogada=".$jogadaant2." AND produto=".$p."";
				$pegau = mysqli_query($con, $select);
				$campo = mysqli_fetch_object($pegau);
				$Publicidadeant2 = $campo->Publicidade;	$Marketingant2 = $campo->Marketing;
			}
			else
			{
				$Publicidadeant2 = 0; $Publicidadeant = 0; $Marketingant2 = 0;
			}
			// SELECIONA AS DECISÕES DO JOGADOR PARA CALCULAR OS ÍNDICES

			// AQUI SÃO CALCULADOS OS ÍNDICES DE CADA DECISÃO DO JOGADOR
			$iQualidade = calculavalor($jogada, ${"Qualidade".$p}[$i], $Qualidadeant, 0, True);
			$iPublicidade = calculavalor($jogada, ${"Publicidade".$p}[$i], $Publicidadeant, $Publicidadeant2, False);
			$iPeD = calculavalor($jogada, ${"PeD".$p}[$i], $PeDant, 0, True);
			$iMarketing = calculavalor($jogada, ${"Marketing".$p}[$i], $Marketingant, $Marketingant2, False);
			// AQUI SÃO CALCULADOS OS ÍNDICES DE CADA DECISÃO DO JOGADOR

			$select = "SELECT Preco, Qtde from produto WHERE Jogo = '".$jogo."' AND Equipe='".$rows[$i][0]."' AND Jogada=".$jogada." AND produto=".$p."";
			$pegau = mysqli_query($con, $select);
			$campo = mysqli_fetch_object($pegau);
			$Preco = floatval($campo->Preco);
			$Qtde = $campo->Qtde;

			// CALCULOS DOS ÍNDICES, COMO ESTÁ NO DELPHI
			switch ($p){
				case 1: 
					${"iQualidade".$p}[$i] = round(0.4*(1-(pow(1.00001, -$iQualidade))),6);
					${"iPeD".$p}[$i] = round(0.3*(1-(pow(1.00016,-(pow($iPeD, 0.51))))),6);
					${"iPublicidade".$p}[$i] = round(0.7*(1-(pow(1.00004,-$iPublicidade))),6);
					${"iPrecoQtde".$p}[$i] = round(25000 - ($Preco*(pow(1.00037206396165,$Preco))),6);
					if ($iMarketing<470000)
					{
						${"iMarketing".$p}[$i] = 1 + round(1-(pow(1.000004, -(1000000-(1.7*$iMarketing)))), 6);
					}
					else
					{
						${"iMarketing".$p}[$i] = 1 + round(1-(pow(1.0000025, -$iMarketing)),6);
					}

				case 2: 
					${"iQualidade".$p}[$i] = round(0.42*(1-(pow(1.00002,-$iQualidade))),6);
					${"iPublicidade".$p}[$i] = round(0.6*(1-(pow(1.00006,-$iPublicidade))),6);
					${"iPeD".$p}[$i] = round(0.41*(1-(pow(1.002,-(pow($iPeD, 0.51))))),6);
					${"iPrecoQtde".$p}[$i] = round(20000 - ($Preco*(pow(1.00019474323112,$Preco))),6);
					if ($iMarketing<270000)
					{
						${"iMarketing".$p}[$i] = 1 + round(1-(pow(1.000005, -(3*$iMarketing))), 6);
					}
					else
					{
						${"iMarketing".$p}[$i] = 1 + round(1-(pow(1.000005, -$iMarketing)),6);
					}	

				case 3: 
					${"iQualidade".$p}[$i] = round(0.45*(1-(pow(1.000025,-$iQualidade))),6);
					${"iPublicidade".$p}[$i] = round(0.5*(1-(pow(1.00009,-$iPublicidade))),6);
					${"iPeD".$p}[$i] = round(0.49*(1-(pow(1.003,-(pow($iPeD, 0.51))))),6);
					${"iPrecoQtde".$p}[$i] = round(18000 - ($Preco*(pow(1.00009856202696,$Preco))),6);
					if ($iMarketing<170000)
					{
						${"iMarketing".$p}[$i] = 1 + round(1-(pow(1.000005, -(5*$iMarketing))), 6);
					}
					else
					{
						${"iMarketing".$p}[$i] = 1 + round(1-(pow(1.000005, -$iMarketing)),6);
					}

				case 4: 
					${"iQualidade".$p}[$i] = round(0.50*(1-(pow(1.00003,-$iQualidade))),6);
					${"iPublicidade".$p}[$i] = round(0.4*(1-(pow(1.000013863,-$iPublicidade))),6);
					${"iPeD".$p}[$i] = round(0.57*(1-(pow(1.004,-(pow($iPeD, 0.51))))),6);
					${"iPrecoQtde".$p}[$i] = round(15000 - ($Preco*(pow(1.00002728260784,$Preco))),6);
					if ($iMarketing<70000)
					{
						${"iMarketing".$p}[$i] = 1 + round(1-(pow(1.000005, -(9*$iMarketing))), 6);
					}
					else
					{
						${"iMarketing".$p}[$i] = 1 + round(1-(pow(1.000005, -$iMarketing)),6);
					}		
			}
			if(${"iPrecoQtde".$p}[$i]<0){
				${"iPrecoQtde".$p}[$i] = 1;
			}
			$select = "SELECT SalOperarios, SalaMont, MediOper, MediMont, MediAdmi, MediDema from decisao WHERE Jogo = '".$jogo."' AND Equipe='".$rows[$i][0]."' AND Jogada=".$jogada."";
			$pegau = mysqli_query($con, $select);
			$campo = mysqli_fetch_object($pegau);
			$SalOperarios = $campo->SalOperarios;
			$SalMontagem = $campo->SalaMont;
			
			$SalOperarios = $SalOperarios + $SalMontagem;
			$CaixaSalario[$i] = $campo->MediMont + $campo->MediOper + $campo->MediAdmi + $campo->MediDema;
			$iSalario[$i] = round(0.1*(1-(pow(1.0008,-$SalOperarios))),6);

			// CALCULA ÍNDICE Qi
			${"Qi".$p}[$i] = ${"iPrecoQtde".$p}[$i]*(${"iPublicidade".$p}[$i] + ${"iQualidade".$p}[$i] + ${"iPeD".$p}[$i] + ${"iMarketing".$p}[$i] + $iSalario[$i]);

			// CALCULA PARTE DO EMPRESA NO TOTAL DA REGIÃO
			switch ($p) 
			{
				case 1:	
					$q1[$i] = ${"Qi".$p}[$i];
					$QiT1 = $q1[$i] + $QiT1;
				case 2:	
					$q2[$i] = ${"Qi".$p}[$i];
					$QiT2 = $q2[$i] + $QiT2;
				case 3:	
					$q3[$i] = ${"Qi".$p}[$i];
					$QiT3 = $q3[$i] + $QiT3;
				case 4:	
					$q4[$i] = ${"Qi".$p}[$i];
					$QiT4 = $q4[$i] + $QiT4;
			}
			// CALCULA PARTE DO EMPRESA NO TOTAL DA REGIÃO
		}	
	}

	//ROTINA PARA CALCULAR QUANTIDADE PRODUÇÃO POSSÍVEL POR MÁQUINA
	for ($i=0; $i <= $num-1; $i++) {
		$StatusHoraExtra[$i] = 0; $SomaMaqHoraExtra[$i] = 0;
		for ($m=1; $m <= 7 ; $m++) 
		{
			// FOR PRODUTO 1 ATÉ PRODUTO 4
			for ($p=1; $p <= 4 ; $p++) 
			{ 
				$select = "SELECT Qtde from produto WHERE Jogo = '".$jogo."' AND Equipe='".$rows[$i][0]."' AND Jogada=".$jogada." AND produto=".$p."";
				$pegau = mysqli_query($con, $select);
				$campo = mysqli_fetch_object($pegau);

				${"QtdProd".$p}[$i] = $campo->Qtde;
				if($m == 1){
					${"aux".$p}[$i] = ${"QtdProd".$p}[$i];
				}

				$select = "SELECT Maq".$m."Prod".$p." from constantes WHERE CodConst = 3";
				$pegau = mysqli_query($con, $select);
				$campo = mysqli_fetch_object($pegau);
				${"TempoMaq".$m} = $campo->{"Maq".$m."Prod".$p};
				
				if($m == 7){
					$select = "SELECT MontProd".$p." from constantes WHERE CodConst = 3";
					$pegau = mysqli_query($con, $select);
					$campo = mysqli_fetch_object($pegau);
					$TempoMaq8 = $campo->{"MontProd".$p};
					${"TempoIdealP".$p."m8"}[$i] = ${"QtdProd".$p}[$i]*$TempoMaq8;
				}

				${"TempoIdealP".$p."m".$m}[$i] = ${"QtdProd".$p}[$i]*${"TempoMaq".$m};
			}

			$select = "SELECT * from constantes WHERE CodConst = 3";
			$pegau = mysqli_query($con, $select);
			$campo = mysqli_fetch_object($pegau);
			$HDisOperMaq = $campo->HorasOp;
			$HorasExOp = $campo->HorasExOp;
			$HorasJorn = $campo->HorasOp;
			$FatorConversao = $campo->FatorCon;
			${"PotenciaMaq".$m} = $campo->{"HpMaq".$m};
			${"ValorMaq".$m} = $campo->{"ValorMaq".$m};

			$select = "SELECT * from decisao WHERE Jogo = '".$jogo."' AND Equipe='".$rows[$i][0]."' AND Jogada=".$jogada."";
			$pegau = mysqli_query($con, $select);
			$campo = mysqli_fetch_object($pegau);
			${"QtdMaq".$m} = $campo->{"Maq".$m};
			$OperariosMont = $campo->Montagem;
			$select = "SELECT * from decisao WHERE Jogo = '".$jogo."' AND Equipe='".$rows[$i][0]."' AND Jogada=".($jogada-1)."";
			$pegau = mysqli_query($con, $select);
			$campo = mysqli_fetch_object($pegau);
			${"QtdMaqAnt".$m} = $campo->{"Maq".$m};

			if (${"QtdMaq".$m} < ${"QtdMaqAnt".$m}){
					${"QtdMaq".$m} = ${"QtdMaqAnt".$m};
			}
			$TempoProducaoTotal[$m] = ${"QtdMaq".$m} * ($HorasJorn);
			${"TempoNecessario".$m}[$i] = ${"TempoIdealP1m".$m}[$i] + ${"TempoIdealP2m".$m}[$i] + ${"TempoIdealP3m".$m}[$i] + ${"TempoIdealP4m".$m}[$i];

			if(${"TempoNecessario".$m}[$i] > $TempoProducaoTotal[$m]){
				$StatusHoraExtra[$i] = 1;
				if($m == 1)
					$QtdHoras = (${"TempoNecessario".$m}[$i] - $TempoProducaoTotal[$m])/0.8;
				else
					$QtdHoras = (${"TempoNecessario".$m}[$i] - $TempoProducaoTotal[$m]);
				if(($HorasExOp*${"QtdMaq".$m}) < $QtdHoras){
					$QtdHoras = $HorasExOp*${"QtdMaq".$m};
				}
				$QtdHoras = abs(ceil($QtdHoras));
				//echo "Qtd horas $m = ".$QtdHoras."<br>";
				$SomaMaqHoraExtra[$i] = ceil($QtdHoras + $SomaMaqHoraExtra[$i]);
				$TempoProducaoTotal[$m] = $QtdHoras + $TempoProducaoTotal[$m];

				for($p = 1; $p <= 4; $p++){
					$Correcao = intval(($TempoProducaoTotal[$m]/${"TempoNecessario".$m}[$i])*${"QtdProd".$p}[$i]);
					$select = "SELECT Maq".$m."Prod".$p." from constantes WHERE CodConst = 3";
					$pegau = mysqli_query($con, $select);
					$campo = mysqli_fetch_object($pegau);
					${"TempoMaq".$m} = $campo->{"Maq".$m."Prod".$p};
					if(${"TempoMaq".$m} == 0)
						$Correcao = 0;
					if((${"aux".$p}[$i] > $Correcao)&&($Correcao != 0)){						
						${"aux".$p}[$i] = $Correcao;
					}					
				}
			}
			if($m == 7){
				$m = 8;
				${"TempoNecessario".$m}[$i] = ${"TempoIdealP1m".$m}[$i] + ${"TempoIdealP2m".$m}[$i] + ${"TempoIdealP3m".$m}[$i] + ${"TempoIdealP4m".$m}[$i];
				$TempoProducaoTotal[$m] = $OperariosMont * ($HorasJorn);
				if(${"TempoNecessario".$m}[$i] > $TempoProducaoTotal[$m]){
					$StatusHoraExtra[$i] = 1;
					$QtdHoras = (${"TempoNecessario".$m}[$i] - $TempoProducaoTotal[$m]);
					if($HorasExOp*$OperariosMont < $QtdHoras){
						$QtdHoras = $HorasExOp*$OperariosMont;
					}
					$QtdHoras = abs(ceil($QtdHoras));
					//echo "Qtd horas $m = ".$QtdHoras."<br>";
					$TempoProducaoTotal[$m] = $TempoProducaoTotal[$m] + $QtdHoras;
					$SomaMaqHoraExtra[$i] = ceil($QtdHoras + $SomaMaqHoraExtra[$i]);
					for($p = 1; $p <= 4; $p++){
						$Correcao = intval(($TempoProducaoTotal[$m]/${"TempoNecessario".$m}[$i])*${"QtdProd".$p}[$i]);
						if(${"aux".$p}[$i] > $Correcao){
							${"aux".$p}[$i] = $Correcao;
						}
					}
				}

				for($k = 1; $k <= 7; $k++){
					for($p=1; $p <= 4; $p++){
						$select = "SELECT Maq".$k."Prod".$p." from constantes WHERE CodConst = 3";
						$pegau = mysqli_query($con, $select);
						$campo = mysqli_fetch_object($pegau);
						${"TempoMaq".$k} = $campo->{"Maq".$k."Prod".$p};
						${"TempoIdealP".$p."m".$k}[$i] = ${"aux".$p}[$i]*${"TempoMaq".$k};
						${"TempoRealPorProd".$p}[$i] = ${"TempoIdealP".$p."m".$k}[$i] + ${"TempoRealPorProd".$p}[$i];
						${"TempoReal".$k}[$i] = ${"TempoReal".$k}[$i] + ${"TempoIdealP".$p."m".$k}[$i];
					}
				}
				for($p=1; $p <= 4; $p++){
					$select = "SELECT MontProd".$p." from constantes WHERE CodConst = 3";
					$pegau = mysqli_query($con, $select);
					$campo = mysqli_fetch_object($pegau);
					${"TempoMaq".$m} = $campo->{"MontProd".$p};
					//echo "Quantidade possível prod 1 = ".${"aux".$p}[$i]."<br>";
					${"TempoIdealP".$p."m".$m}[$i] = ${"aux".$p}[$i]*${"TempoMaq".$m};
					${"TempoRealPorProd".$p}[$i] = ${"TempoIdealP".$p."m".$m}[$i] + ${"TempoRealPorProd".$p}[$i];
					$TempoTotal[$i] = $TempoTotal[$i] + ${"TempoRealPorProd".$p}[$i];
					${"TempoReal".$m}[$i] = ${"TempoReal".$m}[$i] + ${"TempoIdealP".$p."m".$m}[$i];
				}
			}

		}	
	}
	//FIM DA ROTINA PARA QUANTIDADE DE TEMPO DE PROCESSAMENTO


	//CÁLCULO DO TAMANHO DO MERCADO
	for ($p=1; $p <= 4 ; $p++) { 
		$jogadaant = $jogada - 1;
		$select = "SELECT InterP".$p.", MercadoP".$p." from jogos WHERE CodJogo = '".$jogo."'";
		$pegau = mysqli_query($con, $select);
		$campo = mysqli_fetch_object($pegau);
		
		$InterP = $campo->{"InterP".$p};
		$TamanhoP = $campo->{"MercadoP".$p};
		$DI = substr($InterP, 0, 2);
		$DF = substr($InterP, 2, 2);
		$random = rand($DI, $DF);
		$TamanhoMercado[$p] = $TamanhoP + (pow(-1,$random)*$random);
		$TamanhoMercadoTotal[$p] = $TamanhoMercado[$p]*$num;	
	}	
	//FIM DO CÁLCULO DO TAMANHO DO MERCADO
	$QVendasTotal = 0;
	for ($i=0; $i <= $num-1; $i++) {	
		$Caixa = 0;
		$SalBrutoOper = 0;
		echo "<h1>EMPRESA $i </h1><br>";
		// FOR PRODUTO 1 ATÉ PRODUTO 4
		for ($p=1; $p <= 4 ; $p++) { 
			$CustoEnergiaProd[$p] = 0;
			// QUANTIDADE POSSÍVEL DE SER VENDIDA NA REGIÃO
			${"Indicep".$p}[$i] = intval(round((($TamanhoMercadoTotal[$p]*${"q".$p}[$i])/${"QiT".$p}),2)); // $q1[$i] GEROU A QUANTIDADE QUE PODERIA SER VENDIDA A SER VENDIDO POR PROU

			// SELECIONA A QUANTIDADE DE MÁQUINA DISPOSTA PELO JOGADOR
			$select = "SELECT * from decisao WHERE Jogo = '".$jogo."' AND Equipe='".$rows[$i][0]."' AND Jogada=".$jogada."";
			$pegau = mysqli_query($con, $select);
			$campo = mysqli_fetch_object($pegau);
			${"QtdMaq".$m} = $campo->{"Maq".$m};
			$Aplicacao = $campo->Aplicacao;
			$Amortizacao = $campo->Amortizacao;
			$ParcelaCompra = $campo->numParcelaCompra;
			$ParcelaVenda = $campo->numParcelaVenda;
			$PorcentVenda = $campo->porcentagemVendaPrazo;
			$Emprestimo = $campo->Emprestimo;
			$SalaMont = $campo->SalaMont;
			$Montagem = $campo->Montagem;
			$SalOperarios = $campo->SalOperarios;
			$SalMontagem = $campo->SalaMont;
			$Operarios = $campo->Operarios;
			$SalDemaisFunc = $campo->SalaDema;
			$DemaisFunc = $campo->DemaFunc;
			$SalAdm = $campo->SalAdm;
			$QtdAdm = $campo->Adm;
			
			//$ValorEst[$p] = ${"Estoque".$p}*$Precoant;

			//${"QtdProd".$p}[$i] = $campo->Qtde;

			$select = "SELECT Preco, Perdas from produto WHERE Jogo = '".$jogo."' AND Equipe='".$rows[$i][0]."' AND Jogada=".$jogada." AND produto=".$p."";
			$pegau = mysqli_query($con, $select);
			$campo = mysqli_fetch_object($pegau);
			${"PrecoAtual".$p} = $campo->Preco;
			$Qi = ${"Qi".$p}[$i];


			$SELECT = "SELECT ValEstoque, Preco, Perdas from produto WHERE Jogo = '".$jogo."' AND Equipe='".$rows[$i][0]."' AND Jogada=".($jogada-1)." AND produto=".$p."";
			$CONECTB = mysqli_query($con, $SELECT);
			$CAMPO = mysqli_fetch_object($CONECTB);
			$VlrEstAnt[$p] = $CAMPO->ValEstoque;
			$PerdasAnt[$p] = $CAMPO->Perdas;
			$PrecoAnt[$p] = $CAMPO->Preco;
			$jogadaant = $jogada - 1;

			

			//  PEGA VARIÁVEIS PARA CAIXA
			if ($jogada == 1){
				$Caixa=50000000;
				$Capital=50000000;
				$EquipAnterior=0;
				$ConstrAnterior=0;
				$DeprecEqAnterior=0;
				$DeprecConstAnterior=0;
				$DeprecAdmEqAnterior=0;
				$DeprecAdmConstAnt=0;
				$CreditoEmergencialAnt=0;
				$LucroAcumulado[$i]=0;
				$AplicacaoAnterior = 0;
				$EmprestimoAnterior = 0;
				$BackOrder = 0;

				$DuplicatasReceberAnt = 0;
				$FornecedoresAnt = 0;
				$CaixaEnergiaAnt = 0;
				$CaixaSalarioAnt = 0;
				$CaixaINSSAnt = 0;
				$CaixaMaterialAnt = 0;
				$CaixaFGTSAnt = 0;
				$ICMSAnt = 0;
				$PISAnt = 0;
				$COFINSAnt = 0;
				$IRPJAnt = 0;
				$JurosAnt = 0;
			}
			else{

				$select = "SELECT Perdas, Estoque, ValUnit from produto WHERE Jogo = '".$jogo."' AND Equipe='".$rows[$i][0]."' AND Jogada=".$jogadaant." AND produto=".$p."";
				$pegau = mysqli_query($con, $select);
				$campo = mysqli_fetch_object($pegau);
				$BackOrder = $campo->Perdas;
				${"Estoque".$p} = $campo->Estoque;

				$select = "SELECT * from decisao d, resultado r WHERE d.Jogo = '".$jogo."' AND d.Jogo = r.Jogo AND d.Equipe='".$rows[$i][0]."' AND r.Equipe='".$rows[$i][0]."' AND d.Jogada=".$jogadaant." AND d.Jogada=r.Jogada";
				$pegau = mysqli_query($con, $select);
				$campo = mysqli_fetch_object($pegau);
				$Caixa = $campo->Caixa;
				$Capital = $campo->Receita;
				$EquipAnterior = $campo->CaixaEquipamentos;
				$ConstrAnterior = $campo->CaixaConstrucoes;
				$DeprecConstAnterior = $campo->Depreciacao_Construcao;
				$DeprecEqAnterior = $campo->Depreciacao_Producao;
				$DeprecAdmEqAnterior = $campo->DepreciacaoAdm;
				$DeprecAdmConstAnt = $campo->DeprecAdmConstAnt;
				$DeprecAdmAnt = $campo->DepreciacaoAdm;
				$CreditoEmergencialAnt = $campo->CreditoEmergencial;
				$LucroAcumulado[$i] = $campo->LucroAcumulado;
				$EmprestimoAnterior = $campo->Emprestimo;
				$AplicacaoAnterior = $campo->Aplicacao;
				$CaixaConstruAnt = $campo->CaixaConstrucoes;
				$CaixaEqAnterior = $campo->CaixaEquipamentos;

				$select = "SELECT DuplicatasReceber, DesNaoOperacional, Fornecedores, CaixaEnergia, CaixaSalario, CaixaINSS, CaixaMaterial, CaixaFGTS, ICMS, PIS, COFINS, IRPJ from resultado WHERE Jogo = '".$jogo."' AND Equipe='".$rows[$i][0]."' AND Jogada=".$jogadaant."";
				$pegau = mysqli_query($con, $select);
				$campo = mysqli_fetch_object($pegau);
				$DuplicatasReceberAnt = $campo->DuplicatasReceber;
				$FornecedoresAnt = $campo->Fornecedores;
				$CaixaEnergiaAnt = $campo->CaixaEnergia;
				$CaixaSalarioAnt = $campo->CaixaSalario;
				$CaixaINSSAnt = $campo->CaixaINSS;
				$CaixaMaterialAnt = $campo->CaixaMaterial;
				$CaixaFGTSAnt = $campo->CaixaFGTS;
				$ICMSAnt = $campo->ICMS;
				$PISAnt = $campo->PIS;
				$COFINSAnt = $campo->COFINS;
				$IRPJAnt = $campo->IRPJ;
				$JurosAnt = $campo->DesNaoOperacional;
			}
			//  PEGA VARIÁVEIS PARA CAIXA
						




			$QDisponivel = (${"Estoque".$p} - $BackOrder + ${"aux".$p}[$i]);
			${"QtdProduzidaP".$p} = intval(${"Estoque".$p} + ${"aux".$p}[$i]);
			//echo "Aux $p = ".${"aux".$p}[$i]."<br>";
		
			if($p == 4){
				if(${"QtdProduzidaP".$p} == 0){
					$part_in[$i] = 0;
					$somatorio = $somatorio + 0;
				}
				else{
					$part_in[$i] = ($QualTotal[$i]+$PubliTotal[$i]+$MarkTotal[$i]+$PeDTotal[$i])/${"QtdProduzidaP".$p};
					
					/*
					echo "Qual ".$QualTotal[$i]."<br>";
					echo "PubliTotal ".$PubliTotal[$i]."<br>";
					echo "MarkTotal ".$MarkTotal[$i]."<br>";
					echo "PeDTotal ".$PeDTotal[$i]."<br>";
					echo "TotalProd ".${"QtdProduzidaP".$p}."<br>";
					*/
					$somatorio = $somatorio + $part_in[$i];
				}
			}

			$select = "SELECT Preco from produto WHERE Jogo = '".$jogo."' AND Equipe='".$rows[$i][0]."' AND Jogada=".($jogada - 1)." AND produto=".$p."";
			$pegau = mysqli_query($con, $select);
			$campo = mysqli_fetch_object($pegau);
			$Precoant = $campo->Preco;
			$Multa[$p] = 0;
			if ((${"QtdProduzidaP".$p} - $BackOrder) < 0){
				$EstoqueFinal[$p] = 0;
				${"VendP".$p}[$i] = ${"QtdProduzidaP".$p}*$Precoant;
				${"QVendas".$p}[$i] = ${"QVendas".$p}[$i] + ${"QtdProduzidaP".$p};
				$BackOrderAtual[$p] = $BackOrder - ${"QtdProduzidaP".$p};
				switch ($p) {
					case 1:	{
						$Multa[$p] = ($BackOrderAtual[$p]*50)*0.3 + 0.7*(1750*50);
						if($BackOrderAtual[$p] > 1750)
							$BackOrderAtual[$p] = 1750;
						BREAK;
					}
						
					case 2: {
						$Multa[$p] = ($BackOrderAtual[$p]*100)*0.3 + 0.7*(1175*100); 
						if($BackOrderAtual[$p] > 1175)
							$BackOrderAtual[$p] = 1175;
						BREAK;		
					}					
					case 3:	{
						$Multa[$p] = ($BackOrderAtual[$p]*200)*0.3 + 0.7*(390*200);	
						if($BackOrderAtual[$p] > 390)
							$BackOrderAtual[$p] = 390;
						BREAK;
					}						
					case 4:	{
						$Multa[$p] = ($BackOrderAtual[$p]*350)*0.3 + 0.7*(245*350);
						if($BackOrderAtual[$p] > 245)
							$BackOrderAtual[$p] = 245;
						BREAK;
					}	
				}

			}else{
				
				if((${"QtdProduzidaP".$p} - $BackOrder - ${"Indicep".$p}[$i]) < 0){
					${"VendP".$p}[$i] = ($BackOrder*$Precoant) + (${"QtdProduzidaP".$p} - $BackOrder)*${"PrecoAtual".$p};
					$Diferenca = ${"QtdProduzidaP".$p} - $BackOrder;
					$BackOrderAtual[$p] = (${"Indicep".$p}[$i] - $Diferenca);
					${"QVendas".$p}[$i] = ${"QVendas".$p}[$i] + (${"QtdProduzidaP".$p});
					$EstoqueFinal[$p] = 0;
					switch ($p) {
						case 1:	{
							$Multa[$p] = ($BackOrderAtual[$p]*50)*0.3 + 0.7*(1750*50);
							if($BackOrderAtual[$p] > 1750)
								$BackOrderAtual[$p] = 1750;
							BREAK;
						}
							
						case 2: {
							$Multa[$p] = ($BackOrderAtual[$p]*100)*0.3 + 0.7*(1175*100); 
							if($BackOrderAtual[$p] > 1175)
								$BackOrderAtual[$p] = 1175;
							BREAK;		
						}					
						case 3:	{
							$Multa[$p] = ($BackOrderAtual[$p]*200)*0.3 + 0.7*(390*200);	
							if($BackOrderAtual[$p] > 390)
								$BackOrderAtual[$p] = 390;
							BREAK;
						}						
						case 4:	{
							$Multa[$p] = ($BackOrderAtual[$p]*350)*0.3 + 0.7*(245*350);
							if($BackOrderAtual[$p] > 245)
								$BackOrderAtual[$p] = 245;
							BREAK;
						}	
					}

				}else{
					${"VendP".$p}[$i] = ($BackOrder*$Precoant) + (${"Indicep".$p}[$i])*${"PrecoAtual".$p};
					$EstoqueFinal[$p] = ${"QtdProduzidaP".$p} - $BackOrder - ${"Indicep".$p}[$i];
					${"QVendas".$p}[$i] = ${"QVendas".$p}[$i] + $BackOrder + ${"Indicep".$p}[$i];
					$BackOrderAtual[$p] = 0;
				}
			}
			

			
			/*echo "<br><br><br> -----------------------------------------------------------------------------<br>";
			echo "<h3> Empresa $i Produto $p  </h3> <br>";
			echo "ANÁLISE SOBRE VENDAS E TAMANHO MERCADO <br>";
			echo "Tamanho de Mercado = ".$TamanhoMercadoTotal[$p]."<br>";
			echo "Quantidade produzida = ".${"QtdProduzidaP".$p}."<br>";
			echo "Demanda = ".${"Indicep".$p}[$i]."<br>";
			echo "BackOrder Anterior = ".$BackOrder."<br>";
			echo "Venda produto $p empresa $i = R$".${"VendP".$p}[$i]."<br>";
			echo "Quantidade de venda do produto $p pela empresa $i = ".${"QVendas".$p}[$i]."<br>";
			echo "BackOrderAtual = ".$BackOrderAtual[$p]."<br>";
			echo "Estoque final = ".$EstoqueFinal[$p]."<br>";
			echo "Preço atual = ".${"PrecoAtual".$p}."<br>";
			echo "Multa = ".$Multa[$p]."<br>";
			echo "Estoque Inicial = ".${"Estoque".$p}."<br>";
			echo "<br><br><br> -----------------------------------------------------------------------------<br>";*/
			
			
			$TotalVendas[$i] = ${"VendP".$p}[$i] + $TotalVendas[$i] ;
			$CustoBackOrder[$i] = $Multa[$p] + $CustoBackOrder[$i];
			
			//CUSTOS ENERGIA
			if (${"aux".$p}[$i] > 0) {
				${"ContaEnergia".$p} = ${"ContaEnergia".$p} + (1.02*(${"aux".$p}[$i]*$FatorConversao*1.35*${"PotenciaMaq".$m}))/60;
				$TotalEnergia = round($TotalEnergia + ${"ContaEnergia".$p}, 2);
				$EnergiaAdm = 0.2*${"ContaEnergia".$p}+$EnergiaAdm;
				
			}	



			if ($p==4)
			{

				$TotalAreaMaq = 0; $TotalAreaAdm = 0; $DeprecAreaMaq = 0; $DeprecAreaAdm = 0; $DeprecAreaServicos = 0; $TotalDeprecEqAdm = 0; $DeprecMaqTotal = 0; $ValorTotalMontagem = 0; $ValorEqAuxMontagem = 0; $DepreciacaoMont = 0; $EqTotalADM = 0; $TotalDeprecAdm = 0; $TotalPotencia = 0; $TotalEnergiaAdm = 0; $TotalEnergiaProd = 0; $TotalEnergiaAux = 0; $CustoTotalAreaMaq = 0; $ValorTotalMaq = 0;
					$ValorTotalEP = 0; $SomatoriaTotalEnergia = 0; $CustoTotalAreaADM = 0; $CustoTotalAreaServicos = 0; $CustoEnergiaProdTotal = 0;
				//CALCULOS REFERENTES A MÁQUINA		
				//echo "<h1>Cálculo de Máquinas</h1>";		

				//CÁLCULOS SOBRE ENERGIA
				for($k = 1; $k <=7; $k++){
					$SELECT = "SELECT * from constantes WHERE CodConst = '3'";
					$CONECTABANCO = mysqli_query($con, $SELECT);
					$CAMPO = mysqli_fetch_object($CONECTABANCO);
					${"ValorMaq".$k} = $CAMPO->{"ValorMaq".$k};
					$CustoArea = $CAMPO->CustoArea;
					${"AreaOcupadaM".$k} = $CAMPO->{"AreaM".$k};
					${"PotenciaMaq".$k} = $CAMPO->{"HpMaq".$k};

					$SELECT = "SELECT * from decisao WHERE Jogo = '".$jogo."' AND Equipe='".$rows[$i][0]."' AND Jogada=".$jogada."";


					$CONECTABANCO = mysqli_query($con, $SELECT);
					$CAMPO = mysqli_fetch_object($CONECTABANCO);
					${"QtdMaq".$k} = $CAMPO->{"Maq".$k};
					if(${"TempoReal".$k}[$i] > 0){
						$ContaEnergiaInstalada[$k] = (0.2071388889*0.35*${"PotenciaMaq".$k}*${"TempoReal".$k}[$i])/60;
						$ContaEnergiaEqAux[$k] = 0.4*$ContaEnergiaInstalada[$k];
						$ContaEnergiaAdm = 0.1*$ContaEnergiaInstalada[$k];
						$TotalEnergiaProd = $ContaEnergiaInstalada[$k] + $TotalEnergiaProd;
						$TotalEnergiaAdm = $ContaEnergiaAdm + $TotalEnergiaAdm;
						$TotalEnergiaAux = $TotalEnergiaAux + $ContaEnergiaEqAux[$k];
						$SomatoriaEnergia[$k] = $ContaEnergiaInstalada[$k] + $ContaEnergiaEqAux[$k] + $ContaEnergiaAdm;
						if($k == 7){
							$ContaEnergiaMont = 0.1*$TotalEnergiaProd;
							$ContaEnergiaAuxMont = 0.4*$ContaEnergiaMont;
							$ContaEnergiaAdmMont = 0.1*$ContaEnergiaMont;
							$SomatoriaEnergia[8] = $ContaEnergiaMont + $ContaEnergiaAuxMont + $ContaEnergiaAdmMont;
							$TotalEnergiaAux = round($TotalEnergiaAux + $ContaEnergiaAuxMont,2);
							$TotalEnergiaProd = round($TotalEnergiaProd + $ContaEnergiaMont,2);
							$TotalEnergiaAdm = round($TotalEnergiaAdm + $ContaEnergiaAdmMont,2);
						}
					}
				}
				

				for($k = 1; $k <= 7; $k++){
					$TotalEnergiaporProduto[$k] = 0;
					//echo "<h3>Máquina e área $k</h3>";
					$QtdMaqAtual = ${"QtdMaq".$k};
					if($jogada > 1){
						$SELECT = "SELECT * from decisao WHERE Jogo = '".$jogo."' AND Equipe='".$rows[$i][0]."' AND Jogada=".($jogada-1)."";
						$CONECTABANCO = mysqli_query($con, $SELECT);
						$CAMPO = mysqli_fetch_object($CONECTABANCO);
						${"QtdMaqAnt".$k} = $CAMPO->{"Maq".$k};		
						if(${"QtdMaqAnt".$k} >= ${"QtdMaq".$k}){
							$QtdMaqAtual = 0;
						}
						else{
							$QtdMaqAtual = ${"QtdMaq".$k} - ${"QtdMaqAnt".$k};
						}
					}
									
					${"AreaOcupadaM".$k} = ${"AreaOcupadaM".$k}*$QtdMaqAtual;
					$AreaOcupadaAdm = 0.3*${"AreaOcupadaM".$k};
					$AreaOcupadaServico = 0.2*${"AreaOcupadaM".$k};
					
					$AreaTotalM = $AreaTotalM + ${"AreaOcupadaM".$k};
					$AreaTotalADM = $AreaTotalADM + $AreaOcupadaAdm;
					$AreaTotalServico = $AreaOcupadaServico + $AreaTotalServico;					
					$CustoAreaMaq[$k] = ${"AreaOcupadaM".$k}*($CustoArea);
					$CustoAreaAdm[$k] = 0.3*$CustoAreaMaq[$k];
					$CustoAreaServicos[$k] = 0.2*$CustoAreaMaq[$k];
					
					/*
					echo "Area Ocupada M $k = ".${"AreaOcupadaM".$k}."<br>";
					echo "Area Ocupada ADM $k = ".$AreaOcupadaAdm."<br>";
					echo "Area Ocupada Servico $k = ".$AreaOcupadaServico."<br>";
					echo "Custo Area $k = ".$CustoAreaMaq[$k]."<br>";
					echo "Custo Area ADM $k = ".$CustoAreaAdm[$k]."<br>";
					echo "Custo Area Serviços $k = ".$CustoAreaServicos[$k]."<br>";
					*/

					$CustoTotalAreaMaq = $CustoTotalAreaMaq + $CustoAreaMaq[$k];
					$CustoTotalAreaADM = $CustoTotalAreaADM + $CustoAreaAdm[$k];
					$CustoTotalAreaServicos = $CustoTotalAreaServicos + $CustoAreaServicos[$k];
					$CustoTotalArea = $CustoTotalArea + ($CustoTotalAreaADM + $CustoTotalAreaServicos + $CustoTotalAreaMaq);
					


					if($jogada > 1){
						$SELECT = "SELECT * from decisao WHERE Jogo = '".$jogo."' AND Equipe='".$rows[$i][0]."' AND Jogada=".($jogada-1)."";
						$CONECTABANCO = mysqli_query($con, $SELECT);
						$CAMPO = mysqli_fetch_object($CONECTABANCO);
						${"QtdMaqAnt".$k} = $CAMPO->{"Maq".$k};
						if(${"QtdMaqAnt".$k} >= ${"QtdMaq".$k})
							${"QtdMaq".$k} = ${"QtdMaqAnt".$k};
						$ValMaq[$k] = abs(${"QtdMaq".$k}-${"QtdMaqAnt".$k})*${"ValorMaq".$k};
						$AreaMaq[$k] = ${"AreaOcupadaM".$k}*${"QtdMaq".$k};
					}
					else{
						$ValMaq[$k] = ${"QtdMaq".$k}*${"ValorMaq".$k};
						$AreaMaq[$k] = ${"AreaOcupadaM".$k}*${"QtdMaq".$k};
					}
					
					$AreaAdm[$k] = 0.3*${"AreaOcupadaM".$k};
					$AreaServicos[$k] = 0.2*${"AreaOcupadaM".$k};
					$TotalAreaMaq = $AreaAdm[$k] + $TotalAreaMaq;
					$TotalAreaAdm = $TotalAreaAdm + $AreaAdm[$k];
					$DeprecAreaMaq = ($CustoAreaMaq[$k]/300) + $DeprecAreaMaq;
					$DeprecAreaAdm = ($CustoAreaAdm[$k]/300) + $DeprecAreaAdm;
					$DeprecAreaServicos = ($CustoAreaServicos[$k]/300) + $DeprecAreaServicos;
					$ValorEP[$k] = (0.15*$ValMaq[$k]);
					$ValorTotalEP = $ValorTotalEP + $ValorEP[$k];
					$DeprecMaq[$k] = (($ValMaq[$k]+$ValorEP[$k])/120);
					$EqAdm[$k] = (0.3*$ValMaq[$k]);
					$EqTotalADM = $EqTotalADM + $EqAdm[$k];
					$DeprecAdm[$k] = ($EqAdm[$k]/120);
					$TotalDeprecEqAdm = $TotalDeprecEqAdm + $DeprecAdm[$k];

					
					/*echo "Quantidade máquina $k = ".${"QtdMaq".$k}."<br>";
					echo "Valor máquina $k = ".${"ValorMaq".$k}."<br>";
					echo "Valor total máquina $k = ".$ValMaq[$k]."<br>";
					echo "Valor equipamento Auxiliar = ".$ValorEP[$k]."<br>";
					echo "Inventário equipamentos $k = ".($ValorEP[$k] + $ValMaq[$k])."<br>";
					echo "Depreciação Maq = ".$DeprecMaq[$k]."<br>";
					echo "Eq Adm = ".$EqAdm[$k]."<br>";
					echo "Valor Eq Total = ".$EqTotalADM."<br>";
					echo "Deprec Adm = ".$DeprecAdm[$k]."<br><br>";*/
					
								
					$ValorTotalMontagem = $ValorTotalMontagem + 0.1*($ValMaq[$k]);
					$ValorEqAuxMontagem = $ValorEqAuxMontage + 0.15*($ValorTotalMontagem);

					$ValorTotalMaq = $ValMaq[$k] + $ValorTotalMaq;
					//echo "Valor total máquina $k = ".$ValMaq[$k]."<br>";
					//echo "Valor total maq = ".$ValorTotalMaq."<br><br>";
					$DeprecMaqTotal = $DeprecMaqTotal + $DeprecMaq[$k];
					if($k == 7){
						$ValorTotalMaq = $ValorTotalMontagem + $ValorTotalMaq;
						$MontagemAdm = 0.3*$ValorTotalMontagem;
						$DeprecMontAdm = $MontagemAdm/120;
						$EqTotalADM = $EqTotalADM + $MontagemAdm;
						$TotalDeprecEqAdm = $TotalDeprecEqAdm + $DeprecMontAdm;
						$DepreciacaoMont = round((($ValorEqAuxMontagem + $ValorTotalMontagem)/120),2);
						$DeprecMaqTotal = $DeprecMaqTotal + $DepreciacaoMont;
						$CustoAreaMontagem = 0.18*($CustoTotalAreaMaq);
						$CustoTotalAreaMaq = $CustoAreaMontagem + $CustoTotalAreaMaq;
						$AreAdmMontagem = $CustoAreaMontagem*0.3;
						$DeprecAreaMaq = $DeprecAreaMaq + ($CustoAreaMontagem/300);
						$DeprecAreaAdm = $DeprecAreaAdm + ($AreAdmMontagem/300);
						$CustoTotalAreaADM = $CustoTotalAreaADM + $AreAdmMontagem;
						$AreaServicosMontagem = $CustoAreaMontagem*0.2;

						$DeprecAreaServicos = $DeprecAreaServicos + ($AreaServicosMontagem/300);

						$CustoTotalAreaServicos = $CustoTotalAreaServicos + $AreaServicosMontagem;

						$DeprecAreaProd = $DeprecAreaMaq + $DeprecAreaServicos;
						$areamont = 0.18*$AreaTotalM;
						$AreaTotalM = $AreaTotalM + $areamont;
						$areaadmmont = 0.3*$areamont;
						$areaservmont = 0.2*$areamont;
						$AreaTotalADM = $AreaTotalADM + $areaadmmont;
						$AreaTotalServico = $AreaTotalServico + $areaservmont;	

						$ValorTotalEP = $ValorEqAuxMontagem + $ValorTotalEP;
						
						/*echo "<h3>Montagem </h3>";
						echo "Area Mont = ".$areamont."<br>";
						echo "Area ADM Mont = ".$areaadmmont."<br>";
						echo "Area Servico Mont = ".$areaservmont."<br>";
						echo "ValorTotalMontagem = ".$ValorTotalMontagem."<br>";
						echo "Valor Mont Eq Aux = ".$ValorEqAuxMontagem."<br>";
						echo "Inventário Mont = ".($ValorEqAuxMontagem + $ValorTotalMontagem)."<br>";
						echo "Depreciação Mont = ".$DepreciacaoMont."<br>";
						echo "Montagem Adm = ".$MontagemAdm."<br>";
						echo "Deprec EqAuxAdmMont = ".$DeprecMontAdm."<br>";

						echo "<h3>Equipamento ADM</h3>";
						echo "Valor Eq Total = ".$EqTotalADM."<br>";
						echo "Depreciacao Total = ".$TotalDeprecAdm."<br>";

						echo "<h3>Área</h3>";
						echo "Area Total Maq = ".$AreaTotalM."<br>";
						echo "Area Total ADM = ".$AreaTotalADM."<br>";
						echo "Area Total servicos = ".$AreaTotalServico."<br>";
						echo "Total Custo Área Maq = ".$CustoTotalAreaMaq."<br>";
						echo "Custo Total Area Adm = ".$CustoTotalAreaADM."<br>";
						echo "Custo Total Area servicos = ".$CustoTotalAreaServicos."<br>";
						echo "<br><br>";
						echo "Valor total maq = ".$ValorTotalMaq."<br>";*/

						/*echo "<h3>Depreciações</h3>";
						echo "Depreciação total Maq = ".$DeprecMaqTotal."<br>";
						echo "Depreciacao Total Adm = ".$TotalDeprecEqAdm."<br>";
						echo "Depreciacao Constr = ".$DeprecAreaMaq."<br>";
						echo "Depreciação Constr Adm = ".$DeprecAreaAdm."<br>";*/

						
					}
					
					for($p = 1; $p <= 4; $p++){
						${"EnergiaProd".$p}[$k] = 0;
						$select = "SELECT Maq".$k."Prod".$p." from constantes WHERE CodConst = 3";
						$pegau = mysqli_query($con, $select);
						$campo = mysqli_fetch_object($pegau);
						${"TempoMaq".$k} = $campo->{"Maq".$k."Prod".$p};
						${"TempoIdealP".$p."m".$k}[$i] = ${"aux".$p}[$i]*${"TempoMaq".$k};
						${"EnergiaProd".$p}[$k] = (${"TempoIdealP".$p."m".$k}[$i]/${"TempoReal".$k}[$i])*($ContaEnergiaInstalada[$k]+$ContaEnergiaEqAux[$k]);
						$TotalEnergiaporProduto[$k] = ${"EnergiaProd".$p}[$k] + $TotalEnergiaporProduto[$k];

						${"CustoEnergiaProd".$p}[$k] = (${"TempoIdealP".$p."m".$k}[$i]*$SomatoriaEnergia[$k])/${"TempoReal".$k}[$i];
						//echo "valor Energia $p =".${"EnergiaProd".$p}[$k]."<br>";
						
						
						// echo "Tempo Ideal p $p maq $m = ".${"TempoIdealP".$p."m".$k}[$i]."<br>";
						// echo "Tempo Real maq $k = ".${"TempoReal".$k}[$i]."<br>";
						// echo "Conta Energia = ".$ContaEnergiaInstalada[$k]."<br>";
						// echo "Conta Energia aux = ".$ContaEnergiaEqAux[$k]."<br>";
						// echo "Energia Prod p $p maq $k = ".${"EnergiaProd".$p}[$k]."<br><br>";

						$SomaTotalTempo[$i] = $SomaTotalTempo[$i] + ${"TempoIdealP".$p."m".$k}[$i];
						
						$SomatoriaCustoEnergia[$p] = round(${"EnergiaProd".$p}[$k] + $SomatoriaCustoEnergia[$p],2);
						
						if($k == 7){
							$select = "SELECT MontProd".$p." from constantes WHERE CodConst = 3";
							$pegau = mysqli_query($con, $select);
							$campo = mysqli_fetch_object($pegau);
							$TempoMaq8 = $campo->{"MontProd".$p};
							${"TempoIdealP".$p."m8"}[$i] = ${"aux".$p}[$i]*$TempoMaq8;
							${"EnergiaProd".$p}[8] = (${"TempoIdealP".$p."m8"}[$i]/$TempoReal8[$i])*($ContaEnergiaMont+$ContaEnergiaAuxMont);
							$TotalEnergiaporProduto[8] = ${"EnergiaProd".$p}[8] + $TotalEnergiaporProduto[8];
							$SomatoriaCustoEnergia[$p] = round(${"EnergiaProd".$p}[8] + $SomatoriaCustoEnergia[$p],2);


							${"CustoEnergiaProd".$p}[8] = (${"TempoIdealP".$p."m8"}[$i]*$SomatoriaEnergia[8])/$TempoReal8[$i];
							$CustoEnergiaProdTotal = ${"CustoEnergiaProd".$p}[8] + $CustoEnergiaProdTotal;
							$SomaTotalTempo[$i] = $SomaTotalTempo[$i] + ${"TempoIdealP".$p."m8"}[$i];
							
						}

						$SomatoriaTotalEnergia = $SomatoriaCustoEnergia[$p] + $SomatoriaTotalEnergia;
						$CustoEnergiaProdTotal = ${"CustoEnergiaProd".$p}[$k] + $CustoEnergiaProdTotal;
						$CustoEnergiaProd[$p] = ${"CustoEnergiaProd".$p}[$k] + $CustoEnergiaProd[$p];

					}




					//CÁLCULOS SOBRE ENERGIA

					$PotencialInstalada[$k] = ${"QtdMaq".$k}*${"PotenciaMaq".$k};
					$PotencialEqAux[$k] = 0.4*$PotencialInstalada[$k];
					$PotencialAdm[$k] = 0.08*$PotencialInstalada[$k];
					$TotalPotencia = $PotencialInstalada[$k] + $TotalPotencia;
					$TotalPotenciaEqAux = $PotencialEqAux[$k] + $TotalPotenciaEqAux;
					$TotalPotenciaAdm = $PotencialAdm[$k] + $TotalPotenciaAdm;
					if($k == 7){
						$PotenciaMont = $TotalPotencia*0.3;
						$TotalPotencia = round($TotalPotencia + $PotenciaMont,2);
						$PotenciaAuxMont = 0.4*$PotenciaMont;
						$PotenciaAdmMont = 0.18*$PotenciaMont;
						$TotalPotenciaEqAux = round($TotalPotenciaEqAux + $PotenciaAuxMont,2);
						$TotalPotenciaAdm = round($TotalPotenciaAdm + $PotenciaAdmMont, 2);

						/*
						echo "Total Potencia = ".$TotalPotencia."<br>";
						echo "Total Eq Aux = ".$TotalPotenciaEqAux."<br>";
						echo "Total Adm = ".$TotalPotenciaAdm."<br>";
						*/
					}
				}
				//CALCULOS REFERENTES A MÁQUINA

				// CALCULOS DOS SALÁRIOS NA TABELA DECISÃO
				$TotalSalOp = $Operarios*$SalOperarios;
				$TotalSalMont = $Montagem*$SalMontagem;
				$TotalSalDemais = $DemaisFunc*$SalDemaisFunc;
				if($StatusHoraExtra[$i] == 1){
					$CustoHoraExtra = round((1.5*($SalOperarios/$HDisOperMaq)*$SomaMaqHoraExtra[$i])/0.8,2); 
				}else{
					$CustoHoraExtra = 0; 
				}
				$SalAdm = $SalAdm*1.05;
				$SalBrutoOper = round($TotalSalMont + $TotalSalOp + $CustoHoraExtra + $TotalSalDemais, 2); 
				$SalBrutoAdm = $SalAdm*$QtdAdm;
				
				$FGTSAdm = round(0.08*$SalBrutoAdm, 2);
				$INSSAdm = round(0.29*$SalBrutoAdm, 2);
				
				$SalFGTSDireto = round(0.08*$SalBrutoOper, 2);
				
				$INSSDireto = round(0.29*$SalBrutoOper, 2);

				$CaixaSalario[$i] = $SalBrutoOper + $SalBrutoAdm;

				$CaixaINSS = $INSSDireto + $INSSAdm;
				$CaixaFGTS = $FGTSAdm+$SalFGTSDireto;
				/*
				echo "Salarios a pagar = ".$CaixaSalario[$i]."<br>"; 
				echo "SalOperarios = ".$SalOperarios."<br>"; 
				echo "Qtd ope = ".$Operarios."<br>"; 
				echo "Total sal ope = ".$TotalSalOp."<br>"; 
				echo "CustoHoraExtra = ".$CustoHoraExtra."<br>";
				echo "Conta 1 = ".($TotalSalOp + $TotalSalMont + $TotalSalDemais)."<br>";
				echo "Montagem = ".$Montagem."<br>"; 
				echo "SalMontagem = ".$SalMontagem."<br>"; 
				echo "TotalSalMont = ".$TotalSalMont."<br>";
				echo "Demais = ".$DemaisFunc."<br>"; 
				echo "SalDemaisFunc = ".$SalDemaisFunc."<br>"; 
				echo "TotalSalDemais = ".$TotalSalDemais."<br>";
				echo "Sal bruto operários = ".$SalBrutoOper."<br>";
				echo "FGTS Oper =".$SalFGTSDireto."<br>";
				echo "Salário Adm depois = ".$SalBrutoAdm."<br>";
				echo "FGTSadm = ".$FGTSAdm."<br>";
				echo "INSSAdm = ".$INSSAdm."<br>";
				*/
				// CALCULOS DOS SALÁRIOS NA TABELA DECISÃO

				$CaixaEnergia = $CustoEnergiaProdTotal;
				$Receita = $TotalVendas[$i] ;
				
				if ($jogada == 1){
					$DeprecEqAnterior = 0;
					$DeprecConstAnterior = 0;
					$DeprecAdmEqAnterior = 0;
					$DeprecAdmConstAnt = 0;
				}
				
				$DeprecEq = round($DeprecMaqTotal, 2);
				$DeprecConst = round($DeprecAreaMaq, 2) + round($DeprecAreaServicos, 2);
				$DeprecAdm = round($TotalDeprecEqAdm, 2);
				$DeprecAdmConst = round($DeprecAreaAdm, 2);


				/*
					CÁLCULO DE CUSTO MATERIAL, VALOR UNITÁRIO E VALOR DE ESTOQUE
					echo "<br>-----------------------------------------------------------------------------<br>";
					echo "<h2> CÁLCULOS CMV, VLR UNITÁRIO E ESTOQUE DA EMPRESA [$i] </h2></br>";
				*/

				$CustoAdicionalTotal = ($CaixaSalario[$i]-$SalBrutoAdm)+($CaixaFGTS-$FGTSAdm)+($CaixaINSS-$INSSAdm)+($CaixaEnergia-$TotalEnergiaAdm)+($DeprecEqAnterior+$DeprecConstAnterior);
				
				/*echo "Custo adicional total = ".$CustoAdicionalTotal."<br>";
				echo "Caixa Salario = ".$CaixaSalario[$i]."<br>";
				echo "SalBrutoAdm = ".$SalBrutoAdm."<br>";
				echo "CaixaFGTS = ".$CaixaFGTS."<br>";
				echo "FGTSAdm = ".$FGTSAdm."<br>";
				echo "CaixaINSS = ".$CaixaINSS."<br>";
				echo "INSSAdm = ".$INSSAdm."<br>";
				echo "CaixaEnergia = ".$CaixaEnergia."<br>";
				echo "TotalEnergiaAdm = ".$TotalEnergiaAdm."<br>";*/

				$CustoMaterial = 0; $SomaEstoque = 0; $CustosAdicionais = 0; $CaixaMaterial = 0; $ValorFinalEstoque = 0; $CalculoCMV = 0;

				for($material = 1; $material <= 4; $material++){ 
					$select = "SELECT MatProd".$material." from constantes WHERE CodConst = 3";
					$pegau = mysqli_query($con, $select);
					$campo = mysqli_fetch_object($pegau);
					$Div = (${"QVendas".$material}[$i]/${"aux".$material}[$i]);
					${"MatProd".$material} = $campo->{"MatProd".$material};
					$CustoMaterialP[$material] = (1.02*${"MatProd".$material}*${"aux".$material}[$i]) + $VlrEstAnt[$material];
					$CustoMaterial = $CustoMaterialP[$material] + $CustoMaterial;

					$CaixaMaterial = (1.02*${"MatProd".$material}*${"aux".$material}[$i]) + $CaixaMaterial;

					$CustoAdicional[$material] = (($CustoAdicionalTotal*${"TempoRealPorProd".$material}[$i])/$SomaTotalTempo[$i]);
					$CustosAdicionais = $CustosAdicionais + $CustoAdicional[$material];

					$Div2 = (${"QVendas".$material}[$i]/(${"aux".$material}[$i]+${"EstoqueAnt".$material}[$i]));
					$CMV[$material] = round(($CustoMaterialP[$material] + $CustoAdicional[$material])*$Div2,2);

					$CalculoCMV = $CalculoCMV + $CMV[$material];
					$ValorUnitario[$material] = (($VlrEstAnt[$material] + $CMV[$material])/(${"aux".$material}[$i]+${"EstoqueAnt".$material}[$i]));
					 
					if($material != 4){
						$ValorEst[$material] = ($CustoMaterialP[$material] + $CustoAdicional[$material]) - $CMV[$material];
					}
					else{
						$ValorEst[$material] = ($CustoMaterial+$CustosAdicionais) - $CalculoCMV;
					}
					if(abs($ValorEst[$material]) < 0.01){
						$ValorEst[$material] = 0;
					}
					$ValorFinalEstoque = $ValorFinalEstoque + $ValorEst[$material];
					$SomaEstoque = $SomaEstoque + $EstoqueFinal[$material];


					/*echo "Produtos [$material]: ".${"aux".$material}[$i]." produzidos, ".${"QVendas".$material}[$i]." vendidos, ".$CustoAdicional[$material]." custo adicional </br>";
					echo "Custo Adicional $material = ".$CustoAdicional[$material]."<br>";
					echo "CMV[$material] = ".$CMV[$material]."<br>";
					echo "Valor Estoque [$material] = ".$ValorEst[$material]."<br>";
					echo "Custo Unitário [$material] = ".$CustoMaterial."<br>";*/
				}
				/*echo "Total de Produtos em estoque = ".$SomaEstoque."<br>";
				echo "Calculo CMV = ".$CalculoCMV."<br>"; 
				echo "Custo Material = ".$CustoMaterial."<br>"; 
				echo "Custos Adicionais = ".$CustosAdicionais."<br>"; 
				echo "Valor Final de Estoque = ".$ValorFinalEstoque.$quebralinha;*/
				

				$ValorEstoqueAnterior = $VlrEstAnt[1] + $VlrEstAnt[2] + $VlrEstAnt[3] + $VlrEstAnt[4];
				// $CalculoCMV = round($SalFGTSDireto + $INSSDireto + $DeprecEqAnterior + $DeprecConstAnterior - $DeprecAdmConstAnt -$DeprecAdmEqAnterior + $SalBrutoOper + $SomatoriaCustoEnergia[1] + $SomatoriaCustoEnergia[2] + $SomatoriaCustoEnergia[3] + $SomatoriaCustoEnergia[4] + $CustoMaterial,2) + $ValorEstoqueAnterior;
				


				//echo "CMV = ".$CalculoCMV."<br>";

				/*				
				echo "DeprecAnterior = ".$DeprecEqAnterior."<br>";
				echo "DeprecConstAnterior = ".$DeprecConstAnterior."<br>";
				echo "DeprecAdmConstAnt = ".$DeprecAdmConstAnt."<br>";
				echo "DeprecAdmEqAnterior = ".$DeprecAdmEqAnterior."<br>";
				echo "Total Sal = ".($SalBrutoOper + $INSSDireto + $SalFGTSDireto)."<br>";
				echo "SomatoriaCustoEnergia 1 = ".$SomatoriaCustoEnergia[1]."<br>";
				echo "SomatoriaCustoEnergia 2 = ".$SomatoriaCustoEnergia[2]."<br>";
				echo "SomatoriaCustoEnergia 3 = ".$SomatoriaCustoEnergia[3]."<br>";
				echo "SomatoriaCustoEnergia 4 = ".$SomatoriaCustoEnergia[4]."<br>";
				echo "Custo Material = ".$CustoMaterial."<br>"; 
				*/
				
				
				$TotalTempoRealPorProduto = $TempoRealPorProd1[$i] + $TempoRealPorProd2[$i] + $TempoRealPorProd3[$i] + $TempoRealPorProd4[$i];
								
				
				//ATENÇÃO - CÁLCULOS DAS PARCELAS
				// QUANTO VALE PARCELA VENDA? ELA TÁ ZERANDO O LAÇO

				// valor compra = Compra / quantidade da parcela
				// resíduo = compra a vista = compra - quantidade parcela * valor da parcela -> joga fora
				// valor da parcela venda prazo = venda a prazo * porcentagem de venda prazo / quantidade 
				
				$ValorParcelaCompra = 0;
				if ($ParcelaVenda>0) {
					$VrParcelaVenda = intval($Receita*$PorcentVenda/$ParcelaVenda);
					$VVendaPrazo = $VrParcelaVenda*$ParcelaVenda;
					$VVendaVista = $Receita - $VVendaPrazo;
					for ($a = 0; $a <= $ParcelaVenda; $a++) {
						$SELECT = "SELECT numParcelaVenda from decisao WHERE Jogo = '".$jogo."' AND Equipe='".$rows[$i][0]."' AND Jogada=".$jogada."";
						$CONECTABANCO = mysqli_query($con, $SELECT);
						$CAMPO = mysqli_fetch_object($CONECTABANCO);
						$numParcelaVenda = $CAMPO->numParcelaVenda;
						if($numParcelaVenda>0){
							$VParcelaMesVenda = $VrParcelaVenda;
						}
						else{
							$VParcelaMesVenda = 0;
						}
						if ($a == 0) {
							$VParcelaAtualVenda = 0 + $VParcelaMesVenda;
						}
						else{
							$VParcelasVenda[$a] = $VrParcelaVenda + $VParcelaMesVenda;
						}
					}
					$ParcelaVendaZero = False;
				}
				else{
					// if($jogada > 1){
					// 	$VlrParcelaRecuperadoVenda = $Caixa;
					// }else{
					// 	$VlrParcelaRecuperadoVenda = 0;
					// }
					$VlrParcelaRecuperadoVenda = 0;
					$ParcelaVendaZero = True;
					$DuplicatasReceber = 0;
					$VVendaPrazo = 0;
					$VVendaVista = $Receita;
					$VParcelaMesVenda = 0;
					$VParcelaAtualVenda = $VlrParcelaRecuperadoVenda;
					for ($a=1; $a <= 9; $a++) { 
						$VParcelaMesVenda[$a] = 0;
					}

				}

				if($ParcelaCompra > 0){
					for ($a=0; $a <= $ParcelaCompra; $a++) { 
						$VParcelaMesCompra = $ValorParcelaCompra;
						if($a == 0){
							$VParcelaAtualCompra = 0 + $VParcelaMesCompra;
						}
						elseif($a == 1){
							$VParcelasCompra[$a] = intval($CaixaMaterial/$ParcelaCompra) + $VParcelaMesCompra;
							$VrParcelaCompra = intval($CaixaMaterial/$ParcelaCompra);
							$CompraVista = $CaixaMaterial - intval($CaixaMaterial/$ParcelaCompra)*$ParcelaCompra;
						}
						else{
							$VParcelasCompra[$a] = intval($CaixaMaterial/$ParcelaCompra) + $VParcelaMesCompra;
						}
					}
					$Fornecedores = 0;
					$Fornecedores = intval($CaixaMaterial/$ParcelaCompra) + $ParcelaCompra;
					$ParcelaCompraZero = False;
				}
				else{
					$VlrParcelaRecuperadoCompra = $ValorParcelaCompra;
					$ParcelaCompraZero = True;
					$CompraVista = $CaixaMaterial;
					$VParcelaMesCompra = 0;
					$VParcelaAtualCompra = $VlrParcelaRecuperadoCompra;
					$Fornecedores = 0;
					for ($a=1; $a <= 9; $a++) 
					{ 
						$VParcelasCompra[$a] = 0;
					}
				}
				$DuplicatasReceber = $DuplicatasReceber + $DuplicatasReceberAnt + $VVendaPrazo - $VParcelaAtualVenda;
				
				if ($ParcelaCompra > 0) {
					$Fornecedores = intval($CaixaMaterial/$ParcelaCompra)*$ParcelaCompra + $FornecedoresAnt - $VParcelaAtualCompra;
				}
				else{
					$Fornecedores = $FornecedoresAnt - $VParcelaAtualCompra;
				}
			
				//CÁLCULOS DAS PARCELAS

				$SalBrutoOper = round($SalBrutoOper);
				$DepreciacaoAdm = $DeprecAdmEqAnterior + $DeprecAdmConstAnt;
				$SalAdm = $SalBrutoAdm;	
				$FGTS = $FGTSAdm; 
				$INSS = $INSSAdm; 
				$ICMS = round(0.04*$Receita,2);
				$PIS = round(0.035*$Receita,2);
				$COFINS = round(0.04*$Receita,2);
				if($SomaEstoque > 0){
					$CustoEstocagem = 30*$SomaEstoque;
				}else{
					$CustoEstocagem = 0;
				}
				
				$DespesasGerais = round(0.015*$Receita,2);
				
				
				//echo "Custo de Estoque = ".$CustoEstocagem."<br>";
				//echo "Total Energia = ".$CaixaEnergia."<br>";

				$DeprecAdmAntTotal = $DeprecAdmConstAnt + $DeprecAdmEqAnterior; 
				$Valor = $SalAdm + $FGTS + $INSS + $ICMS + $PIS + $COFINS
					+ $PeDTotal[$i] + $PubliTotal[$i] + $QualTotal[$i] + $MarkTotal[$i]
					+ $CustoEstocagem + $TotalEnergiaAdm + $Ociosidade + $DeprecAdmAntTotal + $DespesasGerais + $CustoBackOrder[$i];

				/*echo "Valor = ".$Valor."<br>";
				echo "INSS = ".$INSS."<br>";
				echo "SalAdm = ".$SalAdm."<br>";
				echo "ICMS = ".$ICMS."<br>";
				echo "PIS = ".$PIS."<br>";
				echo "COFINS = ".$COFINS."<br>";
				echo "PeDTotal = ".$PeDTotal[$i]."<br>";
				echo "PubliTotal = ".$PubliTotal[$i]."<br>";
				echo "QualTotal = ".$QualTotal[$i]."<br>";
				echo "MarkTotal = ".$MarkTotal[$i]."<br>";
				echo "CustoEstocagem = ".$CustoEstocagem."<br>";
				echo "TotalEnergiaAdm = ".$TotalEnergiaAdm."<br>";
				echo "Ociosidade = ".$Ociosidade."<br>";
				echo "DeprecAdmAnt = ".$DeprecAdmAntTotal."<br>";
				echo "CustoBackOrder = ".$CustoBackOrder[$i]."<br>";
				echo "DespesasGerais = ".$DespesasGerais."<br>";*/

				//CUSTOS DE CONSTRUÇÃO E EQUIPAMENTES
				$Construcoes = round($CustoTotalAreaMaq + $CustoTotalAreaADM + $CustoTotalAreaServicos,2);		
				$CaixaConstrucoes = ($CaixaConstruAnt + $Construcoes) - ($DeprecAdmConstAnt + $DeprecConstAnterior);
				$Equipamentos = round($ValorTotalMaq, 2) + round($EqTotalADM,2) + round($ValorTotalEP, 2);
				$CaixaEquipamentos = ($CaixaEqAnterior + $Equipamentos) - ($DeprecEqAnterior + $DeprecAdmEqAnterior);


				/*
				echo "Eq Adm = ".$EqTotalADM."<br>";
				echo "Eq Maq = ".$ValorTotalMaq."<br>";
				echo "Eq Aux = ".$ValorTotalEP."<br>";
				echo "Caixa Equipamentos = ".$Equipamentos."<br>";
				echo "Caixa Construções = ".$Construcoes."<br>";
				*/
				
				//CUSTOS DE CONSTRUÇÃO E EQUIPAMENTES
				/*
				echo "Caixa Construcoes = ".$CaixaConstrucoes.$quebralinha;
				echo "Caixa Equipamentos = ".$CaixaEquipamento.$quebralinha;
				echo "Caixa Antes = ".$Caixa."<br>";
				*/
				

				// $Caixa = $Caixa + $Capital + $VVendaVista + $Emprestimo + $AplicacaoAnterior + $VParcelaAtualVenda 
				// 	- $VParcelaAtualCompra - $Aplicacao - $Amortizacao - $CaixaConstrucoes - $CaixaEquipamento
				// 	- $CompraVista - $CaixaEnergiaAnt - $CaixaSalarioAnt - $CaixaINSSAnt - $CaixaFGTSAnt - $PISAnt - $COFINSAnt
				// 	- $ICMSAnt - $PeDTotal[$i] - $PubliTotal[$i] - $DespesasGerais - $CustoBackOrder[$i] - $CustoEstocagem - $QualTotal[$i]
				// 	- $MarkTotal[$i] - $JurosAnt - $IRPJAnt;
				
				//echo "CAIXA INICIAL = ".$Caixa."<br>";
				$Caixa = $Caixa + $VVendaVista + $Emprestimo + $AplicacaoAnterior + $VParcelaAtualVenda
					- $VParcelaAtualCompra - $Aplicacao - $Amortizacao - $Construcoes - $Equipamentos
					- $CompraVista - $CaixaEnergiaAnt - $CaixaSalarioAnt - $CaixaINSSAnt - $CaixaFGTSAnt - $PISAnt - $COFINSAnt
					- $ICMSAnt - $PeDTotal[$i] - $PubliTotal[$i] - $DespesasGerais - $CustoBackOrder[$i] - $CustoEstocagem - $QualTotal[$i]
					- $MarkTotal[$i] - $JurosAnt - $IRPJAnt;
				
				/*echo "VVendaVista AQUI = ".$VVendaVista."<br>";
				echo "Emprestimo AQUI = ".$Emprestimo."<br>";
				echo "AplicacaoAnterior AQUI = ".$AplicacaoAnterior."<br>";
				echo "VParcelaAtualVenda AQUI = ".$VParcelaAtualVenda."<br>";
				echo "VParcelaAtualCompra AQUI = ".$VParcelaAtualCompra."<br>";
				echo "Aplicacao AQUI = ".$Aplicacao."<br>";
				echo "Amortizacao AQUI = ".$Amortizacao."<br>";
				echo "CaixaConstrucoes AQUI = ".$Construcoes."<br>";
				echo "CaixaEquipamento AQUI = ".$Equipamentos."<br>";
				echo "Caixa Material AQUI = ".$CompraVista."<br>";
				echo "CaixaEnergiaAnt AQUI = ".$CaixaEnergiaAnt."<br>";
				echo "CaixaSalarioAnt AQUI = ".$CaixaSalarioAnt."<br>";
				echo "CaixaINSSAnt AQUI = ".$CaixaINSSAnt."<br>";
				echo "CaixaFGTSAnt AQUI = ".$CaixaFGTSAnt."<br>";
				echo "PISAnt AQUI = ".$PISAnt."<br>";
				echo "COFINSAnt AQUI = ".$COFINSAnt."<br>";
				echo "ICMSAnt AQUI = ".$ICMSAnt."<br>";
				echo "PeDTotal AQUI = ".$PeDTotal[$i]."<br>";
				echo "PubliTotal AQUI = ".$PubliTotal[$i]."<br>";
				echo "DespesasGerais AQUI = ".$DespesasGerais."<br>";
				echo "CustoEstocagem AQUI = ".$CustoEstocagem."<br>";
				echo "CustoBackOrder AQUI = ".$CustoBackOrder[$i]."<br>";
				echo "QualTotal AQUI = ".$QualTotal[$i]."<br>";
				echo "MarkTotal AQUI = ".$MarkTotal[$i]."<br>";
				echo "JurosAnt AQUI = ".$JurosAnt."<br>";
				echo "IRPJAnt AQUI = ".$IRPJAnt."<br>";
				echo "CAIXA RESULTADO = ".$Caixa."<br>";*/			

				if($equipamentos != 0)
					$Equipamentos = $Equipamentos - $DeprecEqAnterior;
				if($Construcoes != 0)
					$Construcoes = $Construcoes - $DeprecConstAnterior;

				$LucroBruto = $Receita - $CalculoCMV;
				$LucroOperacional = $LucroBruto - $Valor;
				$DesNaoOperacional = 0;
				$DesNaoOperacional = round(($CreditoEmergencialAnt+$EmprestimoAnterior+$Emprestimo-$Amortizacao)*0.015,2);
				$RecNaoOperacional = round($Aplicacao*0.01,2);
				//Credito Emergencial = Dar uma olhada nisso. Ver o que foi decidido, e o que foi no banco.
				$Caixa = $Caixa + $RecNaoOperacional;

				$CreditoEmergencial = 0;
				if ($Caixa < 0) {
					$CreditoEmergencial = round(100 + abs($Caixa),2);
					$DesNaoOperacional = $DesNaoOperacional + round((abs($CreditoEmergencial))*0.03,2);
					$Caixa = round($Caixa + $CreditoEmergencial,2);
					//echo "Caixa = ".$Caixa."<br>";
				}

				//echo "Juros a Pagar = ".$DesNaoOperacional."<br>";
				$LucrosemIR = $LucroOperacional + $RecNaoOperacional - $DesNaoOperacional;

				if ($LucrosemIR > 0) {
					$IRPJ = round(0.2*$LucrosemIR,2);
					$LucroLiquido[$i] = $LucrosemIR - $IRPJ;
				}
				else{
					$IRPJ = 0;
					$LucroLiquido[$i] = $LucrosemIR;
				}

				$Emprestimo = $Emprestimo + $EmprestimoAnterior + $CreditoEmergencialAnt - $Amortizacao;
				echo "Empréstimo = ".$Emprestimo.$quebralinha;
				echo "EmprestimoAnterior = ".$EmprestimoAnterior.$quebralinha;
				echo "CreditoEmergencialAnt = ".$CreditoEmergencialAnt.$quebralinha;
				echo "Amortizacao = ".$Amortizacao.$quebralinha;
				if($Emprestimo<0){
					$Caixa = $Caixa - $Emprestimo;
					$Emprestimo = 0;
				}
				if($DesNaoOperacional<0)
					$DesNaoOperacional = 0;

				$LucroAcumulado[$i] = $LucroAcumulado[$i] + $LucroLiquido[$i];

				
				/*echo "Lucro Bruto = ".$LucroBruto."<br>";
				echo "Lucro operacional = ".$LucroOperacional."<br>";
				echo "DesNaoOperacional = ".$DesNaoOperacional."<br>";
				echo "Lucro Liquido = ".$LucroLiquido[$i]."<br>";
				echo "Lucro LucroAcumulado = ".$LucroAcumulado[$i]."<br>";*/
				

				$ImpostosPagar = $PIS+$COFINS+$ICMS+$FGTS+$INSS;
				$ILLC[$i] = round(($Caixa+$Aplicacao+$Estoque+$DuplicatasReceber)-($CreditoEmergencial+$Emprestimo+$Fornecedores+$ImpostosPagar+$CaixaEnergia),6);
				$ILLS[$i] = round(($Caixa+$Aplicacao+$DuplicatasReceber)-($CreditoEmergencial+$Emprestimo+$Fornecedores+$ImpostosPagar+$CaixaEnergia),6);
				/*
				echo "ILLS antes = ".$ILLS[$i]."<br>";
				echo "ILLC antes= ".$ILLC[$i]."<br>";
				*/
				if ($num == 1) {
					$MinILLC = $ILLC[$i];
					$MaxILLC = $ILLC[$i];
					$MinILLS = $ILLS[$i];
					$MaxILLS = $ILLS[$i];
				}
				if($ILLC[$i]>$MaxILLC)
					$MaxILLC = $ILLC[$i];
				else
					$MinILLC = $ILLC[$i];
				if($ILLS[$i]>$MaxILLS)
					$MaxILLS = $ILLS[$i];
				else
					$MinILLS = $ILLS[$i];

				

				if ($i == 1) 
				{
					$Lucro1 = $LucroAcumulado[$i];
					$Lucro2 = $LucroLiquido[$i];
					$Min1 = $LucroAcumulado[$i];
					$Min2 = $LucroLiquido[$i];
				}
				else
				{
					if($LucroAcumulado[$i] > $Lucro1){
						$Lucro1 = $LucroAcumulado[$i];
					}
					if ($LucroLiquido > $Lucro2) 
					{
						$Lucro2 = $LucroLiquido[$i];
					}
					if ($Min1 > $LucroAcumulado[$i]) 
					{
						$Min1 = $LucroAcumulado[$i];
					}
					if($Min2 > $LucroLiquido)
					{
						$Min2 = $LucroLiquido[$i];
					}
				}
				for($t = 1; $t <= 4; $t++){
					$SomatoriaCustoEnergia[$t] = 0;
				}
				
			}
		}

		
		/*
		echo "<br><br><br> -----------------------------------<H2>RECEITA</H2>------------------------------------------ <br><br><br>";

				echo "Caixa = ".$Caixa."<br>";
				echo "Lucro Bruto =".$LucroBruto."<br>";

		echo "<br>CHEGOU AQUI<br>";*/
		include("rec_funcalcula.php");
		$QVenEquipe[$i] = $VendP1[$i] + $VendP2[$i] + $VendP3[$i] + $VendP4[$i];
		$QVendasTotal = $QVendasTotal + $QVenEquipe[$i];
	}
	
	for ($i=0; $i <= $num-1 ; $i++) { 
		$rank_investimento[$i] = round(1 + ($part_in[$i]/$somatorio),6);
		
		/*
		echo "Ret Investimento = ".$rank_investimento[$i]."<br>";
		echo "Part in = ".$part_in[$i]."<br>";
		echo "Somatorio = ".$somatorio."<br>";
		*/
		$QVenEquipe[$i] = $VendP1[$i] + $VendP2[$i] + $VendP3[$i] + $VendP4[$i];
		//echo "Q vendas = ".$QVendasTotal."<br>";
		$rank_quantidade[$i] = pow((1+($QVendas1[$i]/$VendP1[$i]))+(1+($QVendas2[$i]/$VendP2[$i]))+(1+($QVendas3[$i]/$VendP3[$i]))+(1+($QVendas4[$i]/$VendP4[$i])),1/4);
		if($QVendasTotal == 0)
			$rank_vendas[$i] = 1;
		else
			$rank_vendas[$i] = (1+($QVenEquipe[$i]/$QVendasTotal));

		if ($num == 1) {
			$MaxQ = $rank_quantidade[$i];
			$MinQ =	$rank_quantidade[$i];
			$MaxV = $rank_vendas[$i];
			$MinV = $rank_vendas[$i];
			$MaxRI = $rank_investimento[$i];
			$MinRI = $rank_investimento[$i];
		}
		else{
			if($MaxQ < $rank_quantidade[$i]) 
				$MaxQ = $rank_quantidade[$i];
			if($MinQ > $rank_quantidade[$i])
				$MinQ = $rank_quantidade[$i];
			if($MaxV < $rank_vendas[$i])
				$MaxV = $rank_vendas[$i];
			if($MinV > $rank_vendas[$i])
				$MinV = $rank_vendas[$i];
			if($MaxRI < $rank_investimento[$i])
				$MaxRI = $rank_investimento[$i];
			if($MaxRI > $rank_investimento[$i])
				$MinRI = $rank_investimento[$i];
		}
	}
	
	
	if($num != 1){
		for ($i=0; $i <= $num-1; $i++) {
			if($LucroAcumulado[$i]>0){
				$rank_lucro1 = round(4+(3*$LucroAcumulado[$i]/$Lucro1),6);
			}
			else{
				$rank_lucro1 = round(1-(3*($LucroAcumulado[$i]-$Min1)/$Min1),6);
			}
			if($LucroLiquido[$i]>0){
				$rank_lucro2 = round(4+(3*$LucroLiquido[$i]/$Lucro2),6);
			}
			else{
				$rank_lucro2 = round(1-(3*($LucroLiquido[$i]-$Min2)/$Min2),6);
			}
			if($rank_lucro2<0)
				$rank_lucro2=$rank_lucro2*-1;
			if($rank_lucro1<0)
				$rank_lucro1=$rank_lucro1*-1;
			$rank_lucro = round(pow($rank_lucro1*$rank_lucro2,0.5),6);
			$rank_lucratividade = round(pow($rank_lucro1*$rank_lucro2,1/2),6);

			/*
			echo "Max ILLC = ".$MaxILLC."<br>";
			echo "Min ILLC = ".$MinILLC."<br>";
			echo "MaxILLS = ".$MaxILLC."<br>";
			echo "Min ILLS = ".$MinILLS."<br>";
			*/

			if($ILLC[$i] < 0)
				$ILLC[$i] = round(1-(2*($ILLC[$i]-$MinILLC)/$MinILLC),6);
			else
				$ILLC[$i] = round(3+(2*($ILLC[$i]/$MaxILLC)),6);
			if($ILLS[$i] < 0)
				$ILLS[$i] = round(1-(2*($ILLS[$i]-$MinILLS)/$MinILLS),6);
			else
				$ILLS[$i] = round(3+(2*($ILLS[$i]/$MaxILLC)),6);
			$rank_endividamento = pow($ILLC[$i]*$ILLS[$i],1/2);
			$RKQ = round(1+(($rank_quantidade[$i]-$MinQ)/($MaxQ-$MinQ)),6);
			$RKV = round(1+(($rank_vendas[$i]-$MinV)/($MaxV-$MinV)),6);
			$RKR = round(1+(($rank_investimento[$i]-$MinRI)/($MaxRI-$MinRI)),6);
			$rank_geral = $rank_lucratividade + $RKQ + $RKV + $RKR + $rank_endividamento;
			include("rec_ranking.php");
		}
	}
	else{
		$rank_lucro = 1;
	}
	header("Location: areadeacesso.php");
	ob_end_flush();

?>

<html>
	
</html>