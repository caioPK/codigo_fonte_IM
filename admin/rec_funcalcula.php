<?php
	for ($p=1; $p <= 4 ; $p++) { 
		// GRAVA NO BANCO
		$e = $rows[$i][0];
		$altindices = " UPDATE produto SET Preco='".${"PrecoAtual".$p}."', Qtde='".${"QtdProd".$p}[$i]."', Marketing='".${"Marketing".$p}[$i]."',
		 Qualidade='".${"Qualidade".$p}[$i]."', Publicidade='".${"Publicidade".$p}[$i]."', PeD='".${"PeD".$p}[$i]."', iQualidade='".${"iQualidade".$p}[$i]."', iPublicidade='".${"iPublicidade".$p}[$i]."', iMarketing='".${"iMarketing".$p}[$i]."', iPeD='".${"iPeD".$p}[$i]."', 
		 iSalario='".$iSalario[$i]."', iPrecoQtde='".${"iPrecoQtde".$p}[$i]."', Qi='".${"Qi".$p}[$i]."', Vendas='".${"QVendas".$p}[$i]."', Perdas='".$BackOrderAtual[$p]."', Estoque='".$EstoqueFinal[$p]."', 
		 ValEstoque=".$ValorEst[$p].", ValUnit='".$ValorUnitario[$p]."', tamercado='".$TamanhoMercado[$p]."', 
		 Qtdereal='".${"QtdProduzidaP".$p}."', QntdeVender1=0, QntdeVender2=0, QntdeVender3=0, Desconto=0
		 WHERE jogo='$jogo' AND Equipe = '$e' AND Jogada='$jogada' AND Produto='$p'";
		 
		mysqli_query($con, $altindices) or die("erroproduto1:".mysqli_error($con));

		if($jogada + 1 < $rodadas){
			$novosindices = "INSERT INTO produto (Jogo, Equipe, Produto, Jogada, Preco, Qtde, Marketing,
			 Qualidade, Publicidade, PeD, iQualidade, iPublicidade, iMarketing, iPeD, 
			 iSalario, iPrecoQtde, Qi, Vendas, Perdas, Estoque, 
			 ValEstoque, ValUnit, tamercado, 
			 Qtdereal, QntdeVender1, QntdeVender2, QntdeVender3, Desconto) 
				VALUES ('".$jogo."','".$rows[$i][0]."','".$p."','".($jogada+1)."','".${"PrecoAtual".$p}."','".${"QtdProd".$p}[$i]."','".${"Marketing".$p}[$i]."',
					'".${"Qualidade".$p}[$i]."','".${"Publicidade".$p}[$i]."','".${"PeD".$p}[$i]."','0','0','0','0',
					'0','0', '0', '0', '".$BackOrderAtual[$p]."', '0', 
					'".$ValorEst[$p]."', '0', '".$TamanhoMercado[$p]."',
					'".${"QtdProduzidaP".$p}."', '0', '0', '0', '0')";
			mysqli_query($con, $novosindices) or die("erroinsereproduto2:".mysqli_error($con));

			
		}


	}

	$novadecisao = "INSERT INTO decisao (Jogo, Equipe, Jogada, Maq1, Maq2, Maq3, Maq4, Maq5, Maq6, Maq7, Emprestimo,
		Amortizacao, Aplicacao, Operarios, SalOperarios, MediOper, Montagem, SalaMont, MediMont, Adm, SalAdm, MediAdmi, DemaFunc,
		SalaDema, MediDema, SalMedio, 
		Confirmacao, numParcelaCompra, numParcelaVenda, 
		porcentagemVendaPrazo) 
		
		SELECT Jogo, Equipe, ".($jogada+1).", Maq1, Maq2, Maq3, Maq4, Maq5, Maq6, Maq7, Emprestimo,
		Amortizacao, Aplicacao, Operarios, SalOperarios, MediOper, Montagem, SalaMont, MediMont, Adm, SalAdm, MediAdmi, DemaFunc,
		SalaDema, MediDema, SalMedio, 
		Confirmacao, numParcelaCompra, numParcelaVenda, 
		porcentagemVendaPrazo 

		FROM decisao WHERE Jogada = ".$jogada." AND Equipe = ".$rows[$i][0]." AND Jogo = '".$jogo."'";

	mysqli_query($con, $novadecisao) or die("erroinsereproduto3:".mysqli_error($con));

	$novajogada = $jogada + 1;
	if($i == 0){
		$atualizajogo = "UPDATE jogos SET jogada='$novajogada' WHERE CodJogo='$jogo'";
		mysqli_query($con, $atualizajogo) or die("erroatualiza:".mysqli_error($con));
	}


	// GRAVA NO BANCO
	$resultado = "INSERT INTO resultado (Jogo, Equipe, Jogada, Receita, SalImpDireto, LucroBruto, DepreciacaoAdm, SalAdm, 
		FGTS, INSS, ICMS, PIS, COFINS, Ociosidade, PeD, Publicidade, 
		DespesasGerais, CustoEstocagem, CustoBackOrder, Qualidade, Marketing, EnergiaAdm, LucroOperacional, RecNaoOperacional, 
		DesNaoOperacional, LucroSemIR,
	 	IRPJ, LucroLiquido, CMV, Caixa, CaixaInfraestrutura, 
	 	CaixaMaterial, CaixaEnergia, CaixaINSS, CaixaSalario,
	 	Construcoes, Equipamentos, Saldo, RetInvestimento, CreditoEmergencial,
	 	Estoque, CaixaFGTS, CaixaConstrucoes, CaixaEquipamentos,
	 	DeprecAdmConstAnt, Emprestimo, LucroAcumulado, ValorVendaVista,
	 	Fornecedores, CompraVista, PagamentoFornecedor, RecebimentoDuplicata, Depreciacao_Producao, Depreciacao_Construcao, CustoHoraExtra) 
		VALUES ('".$jogo."','$e','".$jogada."', '".$Receita."', '0','".$LucroBruto."','".$TotalDeprecEqAdm."','".$SalAdm."',
			'".$FGTS."','".$INSS."','".$ICMS."','".$PIS."','".$COFINS."','".$Ociosidade."','".$PeDTotal[$i]."', '".$PubliTotal[$i]."',
			'".$DespesasGerais."', '".$CustoEstocagem."', '".$CustoBackOrder[$i]."' , '".$QualTotal[$i]."', '".$MarkTotal[$i]."', '".$TotalEnergiaAdm."','".$LucroOperacional."','".$RecNaoOperacional."', 
			'".$DesNaoOperacional."', '".$LucrosemIR."',
			'".$IRPJ."', '".$LucroLiquido[$i]."', '".$CalculoCMV."', '".$Caixa."', '0',
			'".$CaixaMaterial."', '".$CaixaEnergia."', '".$CaixaINSS."', '".$CaixaSalario[$i]."', 
			'".$Construcoes."','".$Equipamentos."', '0', '".$RetInvestimento."', '".$CreditoEmergencial."',
			'".$ValorFinalEstoque."','".$CaixaFGTS."', '".$CaixaConstrucoes."', '".$CaixaEquipamentos."', 
			'".$DeprecAreaAdm."','".$Emprestimo."','".$LucroAcumulado[$i]."', '0',
			'0', '0', '0', '0', '".$DeprecMaqTotal."', '".$DeprecAreaProd."', '".$CustoHoraExtra."')";
			//echo $resultado;

	mysqli_query($con, $resultado) or die("erro2:".mysqli_error($con));
?>