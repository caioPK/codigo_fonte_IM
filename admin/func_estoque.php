<?php

	$select="SELECT * FROM resultado WHERE Jogo='$codjogo' AND Jogada='$jogada' AND Equipe='$codequipe'" ;
	$resultado=mysqli_query($con, $select);
	$campo=mysqli_fetch_object($resultado);  
	if (mysqli_num_rows($resultado)>0)
	{
	  $FGTS=$campo->CaixaFGTS;
	  $INSS=$campo->CaixaINSS;
	  $ICMS=$campo->ICMS;
	  $PIS=$campo->PIS;  
	  $COFINS=$campo->COFINS;
	  $Energia=$campo->CaixaEnergia;
	  $IRPJ=$campo->IRPJ;
	  $DesNaoOperacional=$campo->DesNaoOperacional;
	}     
	$TotalContasPagar=$FGTS+$IRPJ+$INSS+$ICMS+$PIS+$COFINS;
	$FGTS=number_format($FGTS, 2, ",",".");
	$INSS=number_format($INSS, 2, ",",".");
	$ICMS=number_format($ICMS, 2, ",",".");
	$PIS=number_format($PIS, 2, ",",".");
	$COFINS=number_format($COFINS, 2, ",",".");
	$Energia=number_format($Energia, 2, ",",".");
	$IRPJ=number_format($IRPJ, 2, ",",".");
	$DesNaoOperacional=number_format($DesNaoOperacional, 2, ",",".");
	$TotalContasPagar=number_format($TotalContasPagar, 2, ",",".");

	if ($jogada==1)
	{
	  $Estoqueant[1]=0;
	  $Estoqueant[2]=0;
	  $Estoqueant[3]=0;
	  $Estoqueant[4]=0;
	}
	else
	{   
	  $select="SELECT * FROM produto WHERE Jogo='$codjogo' AND Jogada='".($jogada-1)."' AND Equipe='$codequipe' ORDER BY Produto"  ;
	  $resultado=mysqli_query($con, $select);
	  $rows=mysqli_num_rows($resultado);
	  for($cont=1; $cont<=$rows; $cont++)
	  {
	    $campo=mysqli_fetch_object($resultado);
	    $Estoqueant[$cont]=$campo->Estoque;
	    if ($Estoqueant[$cont] == null)
	    {
	      $Estoqueant[$cont] = 0;
	    }
	  }
	}

	$select="SELECT Vendas,Perdas,Estoque,ValEstoque,ValUnit,Qtde,Preco,Qtdereal FROM produto WHERE Jogo='$codjogo' AND Jogada='$jogada' AND Equipe='$codequipe' ORDER BY Produto"  ;
	$resultado=mysqli_query($con, $select);
	$rows=mysqli_num_rows($resultado);
	for($cont=1; $cont<=$rows; $cont++)
	{
	  $campo=mysqli_fetch_object($resultado);
	  $Vendas[$cont]=$campo->Vendas;
	  $Perdas[$cont]=$campo->Perdas;
	  $Estoque[$cont]=$campo->Estoque;          
	  $ValEstoque[$cont]=number_format($campo->ValEstoque, 2, ",",".");                
	  $ValUnit[$cont]=number_format($campo->ValUnit, 2, ",",".");                 
	  $Qtde[$cont]=$campo->Qtde;                 
	  $Preco1[$cont]=$campo->Preco;             
	  $ValUnit1[$cont]=$campo->ValUnit;        
	  $Preco[$cont]=number_format($campo->Preco, 2, ",",".");        
	  $Qtdereal[$cont]=$campo->Qtdereal;
	  if ($Vendas[$cont] == null)
	  { $Vendas[$cont] = 0;}
	  if ($Perdas[$cont] == null)
	  { $Perdas[$cont] = 0;}
	  if ($Estoque[$cont] == null)
	  { $Estoque[$cont] = 0;}
	  if ($ValEstoque[$cont] == null)
	  { $ValEstoque[$cont] = 0;}
	  if ($ValUnit[$cont] == null)
	  { $ValUnit[$cont] = 0;}
	  if ($Qtde[$cont] == null)
	  { $Qtde[$cont] = 0;}
	  if ($Preco1[$cont] == null)
	  { $Preco1[$cont] = 0;}
	  if ($ValUnit1[$cont] == null)
	  { $ValUnit1[$cont] = 0;}
	  if ($Preco[$cont] == null)
	  { $Preco[$cont] = 0;}
	  if ($Qtdereal[$cont] == null)
	  { $Qtdereal[$cont] = 0;}
	
	}

	$Producao[1]=$Qtdereal[1]-$Estoqueant[1];
	$Producao[2]=$Qtdereal[2]-$Estoqueant[2];
	$Producao[3]=$Qtdereal[3]-$Estoqueant[3];
	$Producao[4]=$Qtdereal[4]-$Estoqueant[4];

	if (($Perdas[1]+$perdas[2]+$Perdas[3]+$perdas[4])>2000)
	{
	  $RecomendaCapacidade="Avalie se a capacidade produtiva da empresa é adequada, se os preços não estão abaixo do custo ou dos praticados no mercado. Use a planilha MS Excel de dimensionamento da empresa. Lembre-se de verificar número de hora-extra (Célula:J47), os tempos (Células:A3:I6), número de máquinas folha de decisão(Células:B42:I42), valor das máquinas (Células:B27:I27) e valor da área construída (Célula:A83).";
	}
	else
	{ 
	  $RecomendaCapacidade="";
	}
	if ($Producao[1]<$Qtde[1])
	{
	  $RecomendaCapacidade1="As quantidades da folha de decisão superam a capacidade produtiva da empresa";
	}
	else
	{ $RecomendaCapacidade1="";}
	if (($Preco1[1]-$ValUnit1[1])<0)
	{
	  $RecomendaCapacidade2="Produto 1 tem preço inferior ao custo unitário ";
	}
	else
	{ $RecomendaCapacidade2="";}

	if (($Preco1[2])<($ValUnit1[2]))
	{
	  $RecomendaCapacidade3="Produto 2 tem preço inferior ao custo unitário";
	}
	if (($Preco1[3])<($ValUnit1[3]))
	{
	  $RecomendaCapacidade4="Produto 3 tem preço inferior ao custo unitário";
	}
	else
	{ $RecomendaCapacidade4="";}    
	if (($Preco1[4])<($ValUnit1[4]))
	{
	$RecomendaCapacidade5="Produto 4 tem preço inferior ao custo unitário";
	}
	else
	{ $RecomendaCapacidade5="";}

?>