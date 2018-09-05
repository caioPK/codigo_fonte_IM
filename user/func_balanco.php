<?php
	
 	$select="SELECT * from decisao WHERE Jogo='$codjogo' AND Jogada='$jogada' AND Equipe='$codequipe'" ;
	$resultado1=mysqli_query($con, $select);
	$campo1=mysqli_fetch_object($resultado1);
	if (mysqli_num_rows($resultado1)>0)
    {
 	   $AplicacaoAtual=$campo1->Aplicacao;
    }
	      
  	//Pega campos da tabela Resultado
	$select="SELECT * FROM resultado WHERE Jogo='$codjogo' AND Jogada='$jogada' AND Equipe='$codequipe'" ;
		$resultado=mysqli_query($con, $select);
		$campo=mysqli_fetch_object($resultado);  
		if (mysqli_num_rows($resultado)>0)
		{
		   	$Caixa=$campo->Caixa; 

			$Estoque=$campo->Estoque;	 
			$Construcoes=$campo->Construcoes;
			$Equipamentos=$campo->Equipamentos;
			$Emprestimo=$campo->Emprestimo;
			$CreditoEmergencial=$campo->CreditoEmergencial;
			$LucroAcumulado=$campo->LucroAcumulado; 
			$salariosapagar = $campo->CaixaSalario;
			$contasapagar = $campo->CaixaEnergia;
			$impostosapagar = $campo->CaixaINSS+$campo->ICMS+$campo->CaixaFGTS+$campo->COFINS +$campo->PIS+$campo->IRPJ;
			$DuplicatasReceber = $campo->DuplicatasReceber;
			$Fornecedores = $campo->Fornecedores;
			$DesNaoOperacional = $campo->DesNaoOperacional;
			$TotalReal=$Estoque+$DuplicatasReceber;
			$TotalEx=$impostosapagar+$DesNaoOperacional+$Fornecedores+ $salariosapagar+ $Emprestimo+ $CreditoEmergencial+$contasapagar;
			$AtivoCirculante=$Caixa+$Estoque+$DuplicatasReceber+$AplicacaoAtual;
			$PassivoCirculante=$salariosapagar+$Emprestimo+$contasapagar+$DesNaoOperacional+$impostosapagar+$Fornecedores+ $CreditoEmergencial;
	        if ($PassivoCirculante>0)
	        {
	            $LiquidezCorrente=$AtivoCirculante/$PassivoCirculante;
	            $LiquidezSeca=($AtivoCirculante-$Estoque)/$PassivoCirculante;
	        }
	        $SomaEmpr=$Emprestimo+$CreditoEmergencial;
	        if ($Caixa>1000000)
	        {
	            if ($SomaEmpr<1)
                {
                  $RecomendaAplicacao="Há dinheiro a aplicar. Avalie esta opção";
                }
                else
                {
                	$RecomendaCaixa="Avalie a possibilidade de pagar empréstimo, pois há dinheiro parado em caixa";
                }
            }
            if (($Emprestimo+$CreditoEmergencial)>1000000)
            {
                $CapitalGiro="Falta de capital de giro. Avalie a possibilidade de comprar a prazo. Se estiver vendendo a prazo, pare! Faça uma projeção futura do fluxo de caixa para reduzir necessidade de capital de giro";
            }
            if ((($Emprestimo+$CreditoEmergencial)>1000000) and ($AplicacaoAtual>0))
            {
               $RecomendaAplicacao="Como os rendimentos de aplicação são menores do que juros de empréstimos, recomenda-se que retire o dinheiro da aplicação e pague os empréstimos";
           	}
		}

		$select="SELECT CapInicial FROM jogos WHERE CodJogo='$codjogo' LIMIT 1"  ;
		$resultado=mysqli_query($con, $select);
		$campo=mysqli_fetch_array($resultado);
		$Capital=$campo[0]; 
		if($Capital==0)
		{
			$Capital='50000000.00'; 
		}

		//Calcula aplicacao
		$select="SELECT Aplicacao FROM decisao WHERE Jogo='$codjogo' AND Jogada='$jogada' AND Equipe='$codequipe'" ;
		$resultado=mysqli_query($con, $select);
		$campo=mysqli_fetch_array($resultado);  
		
		$Aplicacao=$campo[0];

		$Soma1=$Caixa+$Aplicacao+$Estoque+$Construcoes+$Equipamentos+$DuplicatasReceber;
		$Soma2=$Construcoes+$Equipamentos;
		
		$Soma3=$Emprestimo+$Capital+$CreditoEmergencial+$LucroAcumulado+$Fornecedores+$impostosapagar+$contasapagar+$salariosapagar+$DesNaoOperacional;
		
		$Caixa=number_format($Caixa, 2 ,",",".");
		$Aplicacao=number_format($Aplicacao, 2 ,",",".");
		$Estoque=number_format($Estoque, 2 ,",",".");
		$Construcoes=number_format($Construcoes, 2 ,",",".");
		$Equipamentos=number_format($Equipamentos, 2 ,",",".");
		$Emprestimo=number_format($Emprestimo, 2 ,",",".");
	   	$Capital=number_format($Capital, 2 ,",",".");
	    $CreditoEmergencial=number_format($CreditoEmergencial, 2 ,",",".");
	    $Soma1=number_format($Soma1, 2 ,",",".");
  	    $Soma2=number_format($Soma2, 2 ,",",".");
		$Soma3=number_format($Soma3, 2 ,",",".");
		$salariosapagar = number_format($salariosapagar, 2 ,",",".");
		$contasapagar = number_format($contasapagar, 2 ,",",".");
		$impostosapagar = number_format($impostosapagar, 2 ,",",".");
		$DuplicatasReceber = number_format($DuplicatasReceber, 2 ,",",".");
		$Fornecedores = number_format($Fornecedores, 2 ,",",".");
		$DesNaoOperacional = number_format($DesNaoOperacional, 2 ,",",".");
		$TotalReal = number_format($TotalReal, 2 ,",",".");
		$TotalEx = number_format($TotalEx, 2 ,",",".");
		$LiquidezSeca = number_format($LiquidezSeca, 2 ,",",".");
		$LiquidezCorrente = number_format($LiquidezCorrente, 2 ,",",".");
	    if ($LiquidezSeca<1)
	    {
	       $RecomendaLiquidezS='Estude o tema "capital de giro" e veja como reduzir o endividamento de sua empresa';
	    }

	    if (($LiquidezCorrente>1) and ($LiquidezSeca<1))
	    {
	    	$RecomendaLiquidezC='Estude o tema "capital de giro" e procure reduzir estoques.';
	   	}
	    if ($LiquidezCorrente<1)
	    {
	    	$RecomendaLiquidezC='Estude os temas "fluxo de caixa" e "capital de giro" e procure melhorar a relação entre "ativos para pagar dívidas"/"total de dívidas".';
	    }

	    if($LucroAcumulado<0)
		{
		   	$LucroAcumulado=$LucroAcumulado*(-1);
			$LucroAcumulado=number_format($LucroAcumulado, 2 ,",",".");
		   	$LucroAcumulado="(".$LucroAcumulado.")";
			$ResultadoAcumulados='Prejuízos Acumulados';
	        if ($Jogada>1)
	        {
	            $RecomendaLucro='Estude como melhorar a formação de lucro da empresa para tentar revertar a situação de Lucro Acumulado negativo';
	        }
	    }
		else
		{
			$LucroAcumulado=number_format($LucroAcumulado, 2 ,",",".");			
			$ResultadoAcumulados='Lucros Acumulados';
		}

?>