<?php
	if ($jogada==1) //se for 1&ordm; jogada o caixa &eacute; igual ao capital (50.000.000)
	{ 
        $select="SELECT CapInicial FROM jogos WHERE CodJogo='$codjogo' LIMIT 1"  ;
        $resultado=mysqli_query($con, $select);
        $campo=mysqli_fetch_array($resultado);
        $Caixa=$campo[0]; 
        if($Caixa==0)
        {
	        $Caixa='50000000.00';
	        $AplicacaoAnterior=0;
	     }
	}
	else
	{
		$jogadaant = $jogada - 1;
	    $select="SELECT Caixa FROM resultado WHERE Jogo='$codjogo' AND Jogada='$jogadaant' AND Equipe='$codequipe'"  ;
	    $resultado=mysqli_query($con, $select);
	    $campo=mysqli_fetch_array($resultado);
	    $Caixa=$campo[0]; 
	    
	    // Pega a Aplicacao da jogada anterior
	    $select="SELECT Aplicacao FROM decisao WHERE Jogo='$codjogo' AND Jogada='$jogadaant' AND Equipe='$codequipe' "  ;
	    $resultado=mysqli_query($con, $select);
	    $campo=mysqli_fetch_array($resultado);
	    $AplicacaoAnterior=$campo[0];
	    $select="SELECT * FROM resultado WHERE Jogo='$codjogo' AND Jogada='$jogadaant' AND Equipe='$codequipe'" ;
	    $resultado=mysqli_query($con, $select);
	    $campo=mysqli_fetch_array($resultado);
	    $CaixaEnergia=$campo[32];
	    $CaixaSalario=$campo[34];
	    $CaixaINSS=$campo[33];
	    $CaixaFGTS=$campo[41];  
	    $INSSAT=$campo[9];
	    $ICMSAT=$campo[10];
	    $PISAT=$campo[11];
	    $COFINSAT=$campo[12];
	    $IRPJAT=$campo[25];
	    $DesNaoOperacionalAT=$campo[24];
	}


	$select="SELECT Emprestimo, Amortizacao, Aplicacao FROM decisao WHERE Jogo='$codjogo' AND Jogada='$jogada' AND Equipe='$codequipe'" ;
	$resultado=mysqli_query($con, $select);
	$campo=mysqli_fetch_array($resultado);  
	$Emprestimo=$campo[0];  
	$Amortizacao=$campo[1]; 
	$AplicacaoAtual=$campo[2];
	
	$select="SELECT * FROM resultado WHERE Jogo='$codjogo' AND Jogada='$jogada' AND Equipe='$codequipe'" ;
	$res=mysqli_query($con, $select);
	

	if (mysqli_num_rows($res)>0)
	{
		$campo=mysqli_fetch_array($res);
		$Receita=$campo[3];
		$PagamentoFornecedor=$campo[51];
		$RecebimentoDuplicata =$campo[52];
		$CreditoEmergencial=$campo[39];
		//$RecNaoOperacional=$campo->RecNaoOperacional; //Juros Recebidos
		$CaixaConstrucoes=$campo[42];
		$CaixaEquipamentos=$campo[43];
		$CaixaMaterial=$campo[31];  
	    $Ociosidade=$campo[14]; 
	    $PeD=$campo[15];
	    $Publicidade=$campo[16]; 
	    $DespesasGerais=$campo[17]; 
	    $CustoEstocagem=$campo[18]; 
	    $Qualidade=$campo[19]; 
	    $Marketing=$campo[20];
	    $CaixaInfraestrutura=$campo[30];
	    $SalAdm=$campo[8];
	}
			
	$saldo[4]=$Caixa;
	$saldo[5]=(float)$saldo[4]+$Receita;
	$saldo[6]=(float)$saldo[5]+$Emprestimo;
	$saldo[7]=(float)$saldo[6]+$CreditoEmergencial;
	$saldo[8]=(float)$saldo[7]+$RecNaoOperacional;
	$saldo[9]=(float)$saldo[8]+$AplicacaoAnterior;
	$saldo[10]=(float)$saldo[9]+$RecebimentoDuplicata;
	$saldo[11]=$saldo[10]-$PagamentoFornecedor;     
	$saldo[12]=$saldo[11]-$AplicacaoAtual;
	$saldo[13]=$saldo[12]-$Amortizacao;
	$saldo[14]=$saldo[13]-$CaixaConstrucoes;
	$saldo[15]=$saldo[14]-$CaixaEquipamentos;
	$saldo[16]=$saldo[15]-$CaixaMaterial;
	$saldo[17]=$saldo[16]-$CaixaEnergia;
	$saldo[18]=$saldo[17]-$CaixaSalario;
	$saldo[19]=$saldo[18]-$CaixaINSS;
	$saldo[20]=$saldo[19]-$CaixaFGTS;
	$saldo[21]=$saldo[20]-$ICMSAT;
	$saldo[22]=$saldo[21]-$PISAT;
	$saldo[23]=$saldo[22]-$COFINSAT;
	$saldo[24]=$saldo[23]-$PeD;
	$saldo[25]=$saldo[24]-$Publicidade;
	$saldo[26]=$saldo[25]-$DespesasGerais;
	$saldo[27]=$saldo[26]-$CustoEstocagem;
	$saldo[28]=$saldo[27]-$Qualidade;
	$saldo[29]=$saldo[28]-$Marketing;
	$saldo[30]=$saldo[29]-$DesNaoOperacionalAT;
	$saldo[31]=$saldo[30]-$IRPJAT;

	if ($saldo[31]>1000000)
	{
	    $Ganho=0.01*($saldo[31]-1000000);
	    $RecomendaCaixa='Há saldo de caixa sem aplicação, deixou de ganhar=>';
	}
	   
	   
	$Caixa=number_format($Caixa, 2, ",","."); 
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
	$ICMSAT=number_format($ICMSAT, 2, ",",".");
	$PISAT=number_format($PISAT, 2, ",",".");
	$COFINSAT=number_format($COFINSAT, 2, ",",".");
	$Ociosidade=number_format($Ociosidade, 2, ",",".");
	$PeD=number_format($PeD, 2, ",",".");
	$Publicidade=number_format($Publicidade, 2, ",",".");
	$DespesasGerais=number_format($DespesasGerais, 2, ",",".");
	$CustoEstocagem=number_format($CustoEstocagem, 2, ",",".");
	$Qualidade=number_format($Qualidade, 2, ",",".");
	$Marketing=number_format($Marketing, 2, ",",".");
	$DesNaoOperacional=number_format($DesNaoOperacional, 2, ",",".");
	$DesNaoOperacionalAT=number_format($DesNaoOperacionalAT, 2, ",",".");
	$IRPJAT=number_format($IRPJAT, 2, ",",".");
	$SalAdm=number_format($SalAdm, 2, ",",".");
	$INSSAT=number_format($INSSAT, 2, ",",".");
	$CaixaInfraestrutura=number_format($CaixaInfraestrutura, 2, ",",".");
	$PagamentoFornecedor=number_format($PagamentoFornecedor, 2, ",",".");
	$RecebimentoDuplicata=number_format($RecebimentoDuplicata, 2, ",",".");
	$Ganho=number_format($Ganho, 2, ",",".");
	for ($cont=4;$cont<=31;$cont++)
	{
	    $saldo[$cont]=number_format($saldo[$cont], 2,",",".");
	}
?>