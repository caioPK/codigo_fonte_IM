<?php
	
	if($jogada == 1){
		$select="SELECT CapInicial FROM jogos WHERE CodJogo='$codjogo' LIMIT 1"  ;
		$resultado=mysqli_query($con, $select);     
		$campo=mysqli_fetch_object($resultado);
		$CapInicial = $campo->CapInicial;
	}else{
		$select="SELECT Caixa FROM resultado WHERE Jogo='$codjogo' AND Jogada='".($jogada-1)."' AND Equipe='$codequipe' ";	
		$resultado=mysqli_query($con, $select);  
		$campo=mysqli_fetch_object($resultado);
		$CapInicial = $campo->Caixa;
	}
	
	$select="SELECT Emprestimo, Amortizacao, Aplicacao FROM decisao WHERE Jogo='$codjogo' AND Jogada='$jogada' AND Equipe='$codequipe'" ;
	$resultado=mysqli_query($con, $select);
	$campo=mysqli_fetch_array($resultado);  
	$Emprestimo=$campo[0];  
	$Amortizacao=$campo[1]; 
	$AplicacaoAtual=$campo[2];

	$jogadaant = $jogada - 1;
	$select="SELECT Aplicacao FROM decisao WHERE Jogo='$codjogo' AND Jogada='$jogadaant' AND Equipe='$codequipe' "  ;
	$resultado=mysqli_query($con, $select);
	$campo=mysqli_fetch_array($resultado);
	$AplicacaoAnterior=$campo[0];


	$select="SELECT * from resultado WHERE Jogo='$codjogo' AND Jogada='$jogada' AND Equipe='$codequipe' ";	
	$resultado=mysqli_query($con, $select);  
	if (mysqli_num_rows($resultado)>0)
	{                    
	  $campo=mysqli_fetch_object($resultado);
	  $CreditoEmergencial = $campo->CreditoEmergencial;
	  $Receita=$campo->Receita;
	  $CMV=$campo->CMV;
	  $LucroBruto=$campo->LucroBruto;
	  $DepreciacaoAdm=$campo->DepreciacaoAdm;
	  $SalAdm=$campo->SalAdm; 
	  $FGTS=$campo->FGTS;
	  $INSS=$campo->INSS;
	  $ICMS=$campo->ICMS;
	  $PIS=$campo->PIS;
	  $COFINS=$campo->COFINS;
	  $Ociosidade=$campo->Ociosidade;
	  $PeD=$campo->PeD;
	  $Publicidade=$campo->Publicidade;
	  $DespesasGerais=$campo->DespesasGerais; 
	  $CustoEstocagem=$campo->CustoEstocagem;
	  $Qualidade=$campo->Qualidade;
	  $Marketing=$campo->Marketing; 
	  $EnergiaAdm=$campo->EnergiaAdm;
	  $LucroOperacional=$campo->LucroOperacional;
	  $RecNaoOperacional=$campo->RecNaoOperacional;
	  $CaixaConstrucoes = $campo->Construcoes;
	  $CaixaEquipamentos = $campo->Equipamentos;
	  $CaixaMaterial = $campo->CaixaMaterial;
	  $CaixaEnergia = $campo->CaixaEnergia;
	  $CaixaSalario = $campo->CaixaSalario;
	  $LucroLiquido=$campo->LucroLiquido;   
	  $DeprecAdmConstAnt=$campo->DeprecAdmConstAnt;
	  $LucroSemIR=$LucroOperacional+$RecNaoOperacional-$DesNaoOperacional;        
	  $Depreciacao=$DepreciacaoAdm;
	  $RecebimentoDuplicata = $campo->RecebimentoDuplicata;
	  $PagamentoFornecedor = $campo->PagamentoFornecedor;
	  $CaixaMaterial = $campo->CaixaMaterial;
	  $CaixaINSS = $campo->CaixaINSS;
	  $CaixaFGTS = $campo->CaixaFGTS;
	  $ICMS = $campo->ICMS;
	  $PIS = $campo->PIS;
	  $COFINS = $campo->COFINS;
	  $PeD = $campo->PeD;
	  $Publicidade = $campo->Publicidade;
	  $DespesasGerais = $campo->DespesasGerais;
	  $CustoEstocagem = $campo->CustoEstocagem;
	  $CustoBackOrder = $campo->CustoBackOrder;
	  $Qualidade = $campo->Qualidade;
	  $Marketing = $campo->Marketing;
	  $DesNaoOperacional = $campo->DesNaoOperacional;
	  if($jogada == 1){
	  	$CaixaEnergia = 0;
	  	$CaixaSalario = 0;
	  	$DesNaoOperacional = 0;
	  	$CaixaINSS = 0;
	  	$CaixaFGTS = 0;
	  	$ICMS = 0;
	  	$PIS = 0;
	  	$COFINS = 0;
	  	$IRPJ = 0;
	  }
	  else {
	  	$select="SELECT * FROM resultado WHERE Jogo='$codjogo' AND Jogada='$jogadaant' AND Equipe='$codequipe' "  ;
	  	$resultado=mysqli_query($con, $select);
	  	$campo=mysqli_fetch_object($resultado);
	  	$IRPJ = $campo->IRPJ;
	  	$CaixaEnergia = $campo->CaixaEnergia;
	  	$CaixaSalario = $campo->CaixaSalario;
	  	$CaixaINSS = $campo->CaixaINSS;
	  	$CaixaFGTS = $campo->CaixaFGTS;
	  	$ICMS = $campo->ICMS;
	  	$PIS = $campo->PIS;
	  	$COFINS = $campo->COFINS;
	  	$DesNaoOperacional = $campo->DesNaoOperacional;
	  }
	  $saldo[0] = $CapInicial;
	  $saldo[1] = (float)$saldo[0] + $Receita;
	  $saldo[2] = (float)$saldo[1] + $Emprestimo;
	  $saldo[3] = (float)$saldo[2] + $CreditoEmergencial;
	  $saldo[4] = (float)$saldo[3] + $RecNaoOperacional;
	  $saldo[5] = (float)$saldo[4] + $AplicacaoAnterior;
	  $saldo[6] = (float)$saldo[5] + $RecebimentoDuplicata;
	  $saldo[7] = (float)$saldo[6] - $PagamentoFornecedor; 
	  $saldo[8] = (float)$saldo[7] - $AplicacaoAtual;
	  $saldo[9] = (float)$saldo[8] - $Amortizacao;
	  $saldo[10] = (float)$saldo[9] - $CaixaConstrucoes;
	  $saldo[11] = (float)$saldo[10] - $CaixaEquipamentos;
	  $saldo[12] = (float)$saldo[11] - $CaixaMaterial;
	  $saldo[13] = (float)$saldo[12] - $CaixaEnergia;
	  $saldo[14] = (float)$saldo[13] - $CaixaSalario;
	  $saldo[15] = (float)$saldo[14] - $CaixaINSS;
	  $saldo[16] = (float)$saldo[15] - $CaixaFGTS;
	  $saldo[17] = (float)$saldo[16] - $ICMS;
	  $saldo[18] = (float)$saldo[17] - $PIS;
	  $saldo[19] = (float)$saldo[18] - $COFINS;
	  $saldo[20] = (float)$saldo[19] - $PeD;
	  $saldo[21] = (float)$saldo[20] - $Publicidade;
	  $saldo[22] = (float)$saldo[21] - $DespesasGerais;
	  $saldo[23] = (float)$saldo[22] - $CustoEstocagem;
	  $saldo[24] = (float)$saldo[23] - $CustoBackOrder;
	  $saldo[25] = (float)$saldo[24] - $Qualidade;
	  $saldo[26] = (float)$saldo[25] - $Marketing;
	  $saldo[27] = (float)$saldo[26] - $DesNaoOperacional;
	  $saldo[28] = (float)$saldo[27] - $IRPJ;
	}

	
	if ($saldo[28]>1000000)
	{
	    $Ganho=0.01*($saldo[31]-1000000);
	    $RecomendaCaixa='Há saldo de caixa sem aplicação, deixou de ganhar=>';
	}
	   
	   
	$CapInicial=number_format($CapInicial, 2, ",",".");
	$Receita=number_format($Receita, 2, ",",".");
	$Emprestimo=number_format($Emprestimo, 2, ",",".");    
	$CreditoEmergencial=number_format($CreditoEmergencial, 2, ",",".");
	$RecNaoOperacionalAT=number_format($RecNaoOperacionalAT, 2, ",",".");
	$RecNaoOperacional=number_format($RecNaoOperacional, 2, ",",".");
	$AplicacaoAnterior=number_format($AplicacaoAnterior, 2, ",",".");
	$AplicacaoAtual=number_format($AplicacaoAtual, 2, ",",".");
	$Amortizacao=number_format($Amortizacao, 2, ",",".");
	$CaixaConstrucoes=number_format($CaixaConstrucoes, 2, ",",".");
	$CaixaEquipamentos=number_format($CaixaEquipamentos, 2, ",",".");
	$CaixaMaterial=number_format($CaixaMaterial, 2, ",",".");
	$CaixaEnergia=number_format($CaixaEnergia, 2, ",",".");
	$CaixaSalario=number_format($CaixaSalario, 2, ",",".");
	$CaixaINSS=number_format($CaixaINSS, 2, ",",".");
	$CaixaFGTS=number_format($CaixaFGTS, 2, ",",".");
	$ICMS=number_format($ICMS, 2, ",",".");
	$PIS=number_format($PIS, 2, ",",".");
	$COFINS=number_format($COFINS, 2, ",",".");
	$CustoBackOrder=number_format($CustoBackOrder, 2, ",",".");
	$Ociosidade=number_format($Ociosidade, 2, ",",".");
	$PeD=number_format($PeD, 2, ",",".");
	$Publicidade=number_format($Publicidade, 2, ",",".");
	$DespesasGerais=number_format($DespesasGerais, 2, ",",".");
	$CustoEstocagem=number_format($CustoEstocagem, 2, ",",".");
	$Qualidade=number_format($Qualidade, 2, ",",".");
	$Marketing=number_format($Marketing, 2, ",",".");
	$DesNaoOperacional=number_format($DesNaoOperacional, 2, ",",".");
	$IRPJ=number_format($IRPJ, 2, ",",".");
	$SalAdm=number_format($SalAdm, 2, ",",".");
	$INSS=number_format($INSSAT, 2, ",",".");
	$CaixaInfraestrutura=number_format($CaixaInfraestrutura, 2, ",",".");
	$PagamentoFornecedor=number_format($PagamentoFornecedor, 2, ",",".");
	$RecebimentoDuplicata=number_format($RecebimentoDuplicata, 2, ",",".");
	$Ganho=number_format($Ganho, 2, ",",".");
	for ($cont=0;$cont<=28;$cont++)
	{
	    $saldo[$cont]=number_format($saldo[$cont], 2,",",".");
	}
?>