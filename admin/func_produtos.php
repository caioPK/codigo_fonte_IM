<?php
	$select="select adm_par,func_par from jogos WHERE CodJogo='$codjogo' LIMIT 1 ";
	$resultado=mysqli_query($con, $select);	
	if (mysqli_num_rows($resultado)>0)
	{
	$campo=mysqli_fetch_object($resultado);
	$adm_par = $campo->adm_par;
	$func_par = $campo->func_par;
	}
	$total_par = $adm_par+$func_par+1;

	
	$select="SELECT * FROM decisao WHERE Jogada='$jogada' AND Jogo='$codjogo' AND Equipe='$codequipe'";
	$resultado=mysqli_query($con, $select);
	
	$rows=mysqli_num_rows($resultado);
	if ($rows>0)
	{
	   $campo=mysqli_fetch_object($resultado);

	   $maquina1=$campo->Maq1;
	   $maquina2=$campo->Maq2;
	   $maquina3=$campo->Maq3;
	   $maquina4=$campo->Maq4;
	   $maquina5=$campo->Maq5;
	   $maquina6=$campo->Maq6;
	   $maquina7=$campo->Maq7;
	   
	   $select="SELECT CustoHoraExtra FROM resultado WHERE Jogo='$codjogo' AND Jogada='$jogada' AND Equipe='$codequipe'" ;
	   $resultado=mysqli_query($con, $select);	
	   $campo2=mysqli_fetch_object($resultado);
	   $CustoHoraExtra = $campo2->CustoHoraExtra;
	   $operariosmont=$campo->Operarios;
	   $operarios2=$campo->SalOperarios;
	   $operarios3=$campo->MediOper;
	   
	   $montagem1=$campo->Montagem;
	   $montagem2=$campo->SalaMont;
	   $montagem3=$campo->MediMont;
	   
	   $administrativo1=$campo->Adm;
	   $administrativo2=($campo->SalAdm)*1.05;   
	   $administrativo3=$administrativo1*$administrativo2;
	   
	   $demaisfunc1=$campo->DemaFunc;
	   $demaisfunc2=$campo->SalaDema;
	   $demaisfunc3=$campo->MediDema;
	   
	   $salmedio=($operarios3+$montagem3+$administrativo3+$demaisfunc3)/($demaisfunc1+$administrativo1+$montagem1+$operariosmont);   
	   $opermaq=$maquina1+$maquina2+$maquina3+$maquina4+$maquina5+$maquina6+$maquina7+$operariosmont;	  
	   $total1=round($operariosmont+$montagem1+$administrativo1+$demaisfunc1);// somatorio do numero de funcionarios
	   $total2=$operarios3+$administrativo3+$demaisfunc3+$montagem3+$CustoHoraExtra;
  
 	   $emprestimo=$campo->Emprestimo;
	   $amorempr=$campo->Amortizacao;
	   $aplicacao=$campo->Aplicacao;
	   
	   $numParcelaCompra=$campo->numParcelaCompra;
	   $numParcelaVenda=$campo->numParcelaVenda;
	   $porcentagemVendaPrazo=$campo->porcentagemVendaPrazo*100;
	
	   $select="SELECT * FROM produto WHERE Jogada='$jogada' AND Jogo='$codjogo' AND Equipe='$codequipe' AND Produto=1";
	   $resultado=mysqli_query($con, $select);
	   $campo=mysqli_fetch_object($resultado);
	   $preco1=$campo->Preco;
	   $quantidade1=$campo->Qtde;
	   $marketing1=$campo->Marketing;

	   $qualidade1=$campo->Qualidade;
	   $publicidade1=$campo->Publicidade;
	   $ped1=$campo->PeD;
	   
	   $select="SELECT * FROM produto WHERE Jogada='$jogada' AND Jogo='$codjogo' AND Equipe='$codequipe' AND Produto=2";
	   $resultado=mysqli_query($con, $select);
	   $campo=mysqli_fetch_object($resultado);
	   $preco2=$campo->Preco;
	   $quantidade2=$campo->Qtde;
	   $marketing2=$campo->Marketing;
	   $qualidade2=$campo->Qualidade;
	   $publicidade2=$campo->Publicidade;
	   $ped2=$campo->PeD;
		  
	   $select="SELECT * FROM produto WHERE Jogada='$jogada' AND Jogo='$codjogo' AND Equipe='$codequipe' AND Produto=3";
	   $resultado=mysqli_query($con, $select);    
	   $campo=mysqli_fetch_object($resultado);
	   $preco3=$campo->Preco;
	   $quantidade3=$campo->Qtde;
	   $marketing3=$campo->Marketing;
	   $qualidade3=$campo->Qualidade;
	   $publicidade3=$campo->Publicidade;
	   $ped3=$campo->PeD;
	
	   $select="SELECT * FROM produto WHERE Jogada='$jogada' AND Jogo='$codjogo' AND Equipe='$codequipe' AND Produto=4";
	   $resultado=mysqli_query($con, $select);  
	   $campo=mysqli_fetch_object($resultado);
	   $preco4=$campo->Preco;
	   $quantidade4=$campo->Qtde;
	   $marketing4=$campo->Marketing;
	   $qualidade4=$campo->Qualidade;
	   $publicidade4=$campo->Publicidade;
	   $ped4=$campo->PeD;

	   $preco1 = number_format($preco1,2,',','.');
	   $marketing1 = number_format($marketing1,2,',','.');
	   $qualidade1 = number_format($qualidade1,2,',','.');
	   $publicidade1 = number_format($publicidade1,2,',','.');
	   $ped1 = number_format($ped1,2,',','.');
	   $preco2 = number_format($preco2,2,',','.');
	   $marketing2 = number_format($marketing2,2,',','.');
	   $qualidade2 = number_format($qualidade2,2,',','.');
	   $publicidade2 = number_format($publicidade2,2,',','.');
	   $ped2 = number_format($ped2,2,',','.');
	   $preco3 = number_format($preco3,2,',','.');
	   $marketing3 = number_format($marketing3,2,',','.');
	   $qualidade3 = number_format($qualidade3,2,',','.');
	   $publicidade3 = number_format($publicidade3,2,',','.');
	   $ped3 = number_format($ped3,2,',','.');
	   $preco4 = number_format($preco4,2,',','.');
	   $marketing4 = number_format($marketing4,2,',','.');
	   $qualidade4 = number_format($qualidade4,2,',','.');
	   $publicidade4 = number_format($publicidade4,2,',','.');
	   $ped4 = number_format($ped4,2,',','.');
	   $operarios2 = number_format($operarios2,2,',','.');
	   $operarios3 = number_format($operarios3,2,',','.');
	   $montagem2 = number_format($montagem2,2,',','.');
	   $CustoHoraExtra = number_format($CustoHoraExtra,2,',','.');
	   $montagem3 = number_format($montagem3,2,',','.');
	   $demaisfunc2 = number_format($demaisfunc2,2,',','.');
	   $demaisfunc3 = number_format($demaisfunc3,2,',','.');
	   $administrativo2 = number_format($administrativo2,2,',','.');
	   $administrativo3 = number_format($administrativo3,2,',','.');
	   $total2 = number_format($total2,2,',','.');
	   $salmedio = number_format($salmedio,2,',','.');
	   $emprestimo = number_format($emprestimo,2,',','.');
	   $amorempr = number_format($amorempr,2,',','.');
	   $aplicacao = number_format($aplicacao,2,',','.');
	   $numParcelaCompra = number_format($numParcelaCompra,2,',','.');
	   $numParcelaVenda = number_format($numParcelaVenda,2,',','.');
	   $porcentagemVendaPrazo = number_format($porcentagemVendaPrazo,2,',','.');
	}
?>