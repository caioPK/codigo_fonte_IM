<?php


  	if($jogada > 1){
  		$select="select DepreciacaoAdm from resultado WHERE Jogo='$codjogo' AND Jogada='".($jogada-1)."' AND Equipe='$codequipe'";	
		$resultado=mysqli_query($con, $select);  
		$campo=mysqli_fetch_object($resultado);
		$DepreciacaoAdm = $campo->DepreciacaoAdm;

  	}else{
  		$DepreciacaoAdm=0;
  	}


	$select="select * from resultado WHERE Jogo='$codjogo' AND Jogada='$jogada' AND Equipe='$codequipe' ";	
	$resultado=mysqli_query($con, $select);  
	if (mysqli_num_rows($resultado)>0)
	{                    
	  $campo=mysqli_fetch_object($resultado);
	  $Receita=$campo->Receita;
	  $CMV=$campo->CMV;
	  $LucroBruto=$campo->LucroBruto;

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
	  $CustoBackOrder = $campo->CustoBackOrder;
	  $LucroOperacional=$campo->LucroOperacional;
	  $RecNaoOperacional=$campo->RecNaoOperacional;
	  $DesNaoOperacional=$campo->DesNaoOperacional;
	  $IRPJ=$campo->IRPJ;
	  $LucroLiquido=$campo->LucroLiquido;   
	  $DeprecAdmConstAnt=$campo->DeprecAdmConstAnt;
	  $LucroSemIR=$LucroOperacional+$RecNaoOperacional-$DesNaoOperacional;        
	  $Depreciacao=$DepreciacaoAdm;
	  if ($LucroBruto<0)
	  {
	    $LucroBruto=$LucroBruto*(-1);
	    $LucroBruto=number_format($LucroBruto, 2, ",",".");
	    $LucroBruto="(".$LucroBruto.")";
	    $ResultadoBruto='Prejuízo Bruto (= Receita - CMV)';
	    $Sugere_DRE='Provavelmente os preços de seus produtos não cobrem os custos de produção, pois o Custo dos Produtos são maiores do que a receita. Olhe o relatório estoquepara averigar os cutos de transformação e, depois, acrescente os custos de operação da empresa';
	  }
	  else
	  {
	    $LucroBruto=number_format($LucroBruto, 2, ",",".");
	    $ResultadoBruto='Lucro Bruto (= Receita - CMV)';
	  }

	  if ($LucroOperacional<0)
	  {
	    $LucroOperacional=$LucroOperacional*(-1);
	    $LucroOperacional=number_format($LucroOperacional, 2, ",",".");
	    $LucroOperacional="(".$LucroOperacional.")";
	    $ResultadoOperacional='Prejuízo Operacional';
	    if ($LucroBruto>0)
	    {
	      $Sugere_DRE='Apesar dos preços de seus produtos cobrirem os custos de produção, não cobrem os custos de operação. Olhe o relatório estoque para averigar os cutos de transformação e, depois, acrescente os custos de operação da empresa.';
	    }
	  }
	  else
	  {
	    $LucroOperacional=number_format($LucroOperacional, 2, ",",".");
	    $ResultadoOperacional='Lucro Operacional';
	  }
	      
	  if ($LucroSemIR<0)
	  {
	    $LucroSemIR=$LucroSemIR*(-1);
	    $LucroSemIR=number_format($LucroSemIR, 2, ",",".");
	    $LucroSemIR="(".$LucroSemIR.")";
	    $ResultadoSemIR='Prejuízo antes do IR';
	    if ($LucroOperacional>0)
	    {
	      $Sugere_DRE='Seus custos não operacionais (pagamento juros) estão elevados a ponto de compromenter o Lucro antes do IR, tente reduzir seu endividamento';
	    }
	  }
	  else
	  {
	    $LucroSemIR=number_format($LucroSemIR, 2, ",",".");
	    $ResultadoSemIR='Lucro antes do IR';
	  }
	      
	  if ($LucroLiquido<0)
	  {
	    $LucroLiquido=$LucroLiquido*(-1);
	    $LucroLiquido=number_format($LucroLiquido, 2, ",",".");
	    $LucroLiquido="(".$LucroLiquido.")";
	    $ResultadoLiquido='Prejuízo Líquido do Exercício';
	  }
	  else
	  {
	    $LucroLiquido=number_format($LucroLiquido, 2, ",",".");
	    $ResultadoLiquido='Lucro Líquido do Exercício';
	  }
	  $Receita=number_format($Receita, 2, ",",".");
	  $CMV=number_format($CMV, 2, ",",".");
	  $DepreciacaoAdm=number_format($DepreciacaoAdm, 2, ",",".");
	  $SalAdm=number_format($SalAdm, 2, ",",".");
	  $FGTS=number_format($FGTS, 2, ",",".");
	  $INSS=number_format($INSS, 2, ",",".");
	  $ICMS=number_format($ICMS, 2, ",",".");
	  $PIS=number_format($PIS, 2, ",",".");
	  $COFINS=number_format($COFINS, 2, ",",".");
	  $Ociosidade=number_format($Ociosidade, 2, ",",".");
	  $PeD=number_format($PeD, 2, ",",".");
	  $Publicidade=number_format($Publicidade, 2, ",",".");
	  $DespesasGerais=number_format($DespesasGerais, 2, ",",".");
	  $CustoEstocagem=number_format($CustoEstocagem, 2, ",",".");
	  $CustoBackOrder=number_format($CustoBackOrder, 2, ",",".");
	  $Qualidade=number_format($Qualidade, 2, ",",".");
	  $Marketing=number_format($Marketing, 2, ",",".");
	  $EnergiaAdm=number_format($EnergiaAdm, 2, ",",".");
	  $RecNaoOperacional=number_format($RecNaoOperacional, 2, ",",".");
	  $IRPJ=number_format($IRPJ, 2, ",",".");
	  $DesNaoOperacional=number_format($DesNaoOperacional, 2, ",",".");
	}
	else // Se nao possui registros na tabela Resultado
	{
	  //echo '<font size="2" face="Verdana, Arial, Helvetica, sans-serif"> <blockquote>Ainda n&atilde;o foram efetuados os c&aacute;lculos para o relat&oacute;rio da Demostra&ccedil;&atilde;o de Resultados. Aguarde o t&eacute;rmino do Prazo de Decis&atilde;o da jogada. </blockquote></font>';
	}
?>