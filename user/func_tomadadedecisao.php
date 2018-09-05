<?php
	
	settype($salariooperariosmaq,double);
	settype($salariooperariomon,double);
	settype($emprestimo,double);
	settype($amorempr,double);
	settype($aplicacao,double);
	settype($numParcelaCompra,double);
	settype($numParcelaVenda,double);
	settype($salamedio,double);
	for ($f=1; $f <= 7; $f++) { 
		settype(${"maquina".$f},double);
		if ($f <= 4) {
			settype(${"preco".$f},double);
			settype(${"marketing".$f},double);
			settype(${"qualidade".$f},double);
			settype(${"publicidade".$f},double);
			settype(${"ped".$f},double);
		}
	}

	Function Tirar_Ponto($string)
	{
		$ParteString=explode(".", $string);
		$array = array_reverse($ParteString);
		$string=($array[3].$array[2].$array[1].$array[0]);
		$string=str_replace(",", ".", $string);
		return $string;
	}

	$finalizada=0;
	$ep=0;$equan=0;$equal=0;$em=0;$epub=0;$eped=0;$emaq=0;$eop=0;$edemais=0;$eadm=0;$eop=0;$eopmo=0;$eem=0;$eamor=0;$eapl=0;$et=0;$confirmado=0;
	// Buscando no banco as características do jogo
	$select="SELECT jogos.Jogada,jogos.numaquina,jogos.maxmaquina from jogos INNER JOIN equipe ON jogos.CodJogo=equipe.CodJogo WHERE equipe.CodEquipe='$codequipe'";
	$resultado=mysqli_query($con, $select);
	$campo=mysqli_fetch_row($resultado);
	$jogada=$campo[0];
	$numaquina=$campo[1];
	$maxmaquina=$campo[2];


	// VERIFICANDO SE A JOGADA JÁ FOI FINALIZADA OU NÃO
	$SelectFase="SELECT FaseJogo, PrazoDecisao from jogos WHERE CodJogo='$codjogo'";
	$ResultFase=mysqli_query($con, $SelectFase);
	$CampoJogo=mysqli_fetch_row($ResultFase);
	$MaxTomada=$CampoJogo[1];
	$DataAtual=date("Y")."-".date("m")."-".date("d");
	if ($DataAtual>$MaxTomada)
	{
		$finalizada = 1;
	}

	//PREENCHENDO OS CAMPOS DA DECISÃO. PARA TANTO, VERIFICA-SE SE HOUVE ALGUMA JOGADA ANTERIOR. CASO TENHA ALGUMA JOGADA, PREENCHE COM VALORES DO BANCO. CASO NÃO, PREENCHE COM VALORES PRÉ-ESTABELECIDOS

	if($jogada == 1){
		$jogmos = $jogada;
	}else{
		$jogmos = $jogada - 1;
	}
	$select="SELECT * FROM decisao WHERE Jogada='$jogmos' AND Jogo='$codjogo' AND Equipe='$codequipe'";
	$decisao=mysqli_query($con, $select);
	$rows=mysqli_num_rows($decisao);
	if ($rows>0){
		$campo=mysqli_fetch_object($decisao);
		for ($i=1; $i <= 7 ; $i++) { 
			$maq = "Maq".$i;
			${"maquina".$i} = $campo->$maq;
			settype(${"maquina".$i},double);
		}
		$operariosmaq=$campo->Operarios;
		$salariooperariosmaq=$campo->SalOperarios;
		$totaloperariosmaq = $operariosmaq*$salariooperariosmaq;

		$operariosmon=$campo->Montagem;
	   	$salariooperariomon=$campo->SalaMont;
	   	$totalsalopemon=$operariosmon*$salariooperariomon;
	   
	   	$qtdadm=$campo->Adm;
	   	$saladm=$campo->SalAdm;
	   	$totalsaladm=$qtdadm*$saladm;

	   	$qtddemaisfunc=$campo->DemaFunc;
	   	$saldemaisfunc=$campo->SalaDema;
	   	$totalsalfunc=$qtddemaisfunc*$saldemaisfunc;
 		
 		$salamedio=($totalsalfunc+$totalsaladm+$totalsalope+$totaloperariosmaq)/($qtdadm+$operariosmaq+$operariosmont+$qtddemaisfunc);
	   	
	   	$emprestimo=$campo->Emprestimo;
	   	$amorempr=$campo->Amortizacao;
	   	$aplicacao=$campo->Aplicacao;

	   	$numParcelaCompra=$campo->numParcelaCompra;
	   	$numParcelaVenda=$campo->numParcelaVenda;
	   	$porcentagemVendaPrazo=$campo->porcentagemVendaPrazo;

	}
	else{
		for ($i=1; $i <= 7; $i++) 
		{ 
			settype(${"maquina".$i},double);
			${"maquina".$i} = 5;
		}
		$operariosmaq=0;
		$salariooperariosmaq=0;
		$operariosmon=0;
		$salariooperariomon=0;
		$qtdadm=0;
		$saladm=0;
		$qtddemaisfunc=0;
		$saldemaisfunc=0;
		$operarios2=900;
		$emprestimo=0;
		$amorempr=0;
		$aplicacao=0;
		$numParcelaCompra=0;
		$numParcelaVenda=0;
		$porcentagemVendaPrazo=0;
	}

	for ($c=1; $c <= 4; $c++) 
	{ 
		$select="SELECT * from produto WHERE Jogada='$jogmos' AND Jogo='$codjogo' AND Equipe='$codequipe' AND Produto=".$c."";
		$resultado=mysqli_query($con, $select);
		$campo=mysqli_fetch_object($resultado);
		if ($campo>0)
		{
			${"preco".$c}=$campo->Preco;
			${"quantidade".$c}=$campo->Qtde;
			${"marketing".$c}=$campo->Marketing;
			${"qualidade".$c}=$campo->Qualidade;
			${"publicidade".$c}=$campo->Publicidade;
			${"ped".$c}=$campo->PeD;
		}
		else
		{
			${"preco".$c}=1900;
			${"quantidade".$c}=500;
			${"marketing".$c}=10000;
			${"qualidade".$c}=10000;
			${"publicidade".$c}=10000;
			${"ped".$c}=10000;
		}
	}
	
	if ($action=="Avançar")
	{
		for ($q=1; $q <= 4 ; $q++) { 
			${"preco".$q} = $_POST["precoprod".$q];
			${"preco".$q}=Tirar_Ponto(${"preco".$q});
			
			${"quantidade".$q} = $_POST["quantprod".$q];
			${"quantidade".$q}=Tirar_Ponto(${"quantidade".$q});
			
			${"marketing".$q} = $_POST["markprod".$q];
			${"marketing".$q}=Tirar_Ponto(${"marketing".$q});
			
			${"qualidade".$q} = $_POST["qualiprod".$q];
			${"qualidade".$q}=Tirar_Ponto(${"qualidade".$q});
			
			${"publicidade".$q} = $_POST["publiprod".$q];
			${"publicidade".$q}=Tirar_Ponto(${"publicidade".$q});
			
			${"ped".$q} = $_POST["pedprod".$q];
			${"ped".$q}=Tirar_Ponto(${"publicidade".$q});
		}

		for ($r=1; $r <= 7; $r++) { 
			${"maquina".$r} = $_POST["maq".$r];
			${"maquina".$r}=Tirar_Ponto(${"maquina".$r});
		}
		for ($b=1; $b <= 4 ; $b++) 
		{ 
			if ((${"preco".$b}<=0)||(${"preco".$b}==""))
			{
				$ep=1;
				break;
			}
			if ((${"quantidade".$b}<=0)||(${"quantidade".$b}==""))
			{
				$equan=1;
				break;
			}
			if ((${"marketing".$b}<=0)||(${"marketing".$b}==""))
			{
				$em=1;
				break;
			}
			if ((${"qualidade".$b}<=0)||(${"qualidade".$b}==""))
			{
				$equal=1;
				break;
			}
			if ((${"publicidade".$b}<=0)||(${"publicidade".$b}==""))
			{
				$epub=1;
				break;
			}
			if ((${"ped".$b}<=0)||(${"ped".$b}==""))
			{
				$eped=1;
				break;
			}
		}
		for ($m=1; $m <= 7 ; $m++) { 
			if ((${"maquina".$m}<=0)||(${"maquina".$m}==""))
			{
				$emaq=1;
				break;
			}
		}

		$operariosmon = $_POST["qtdoperarios"];
		$salariooperariomon = $_POST["salariooperarios"];
		$salariooperariomon=Tirar_Ponto($salariooperariomon);
		if(($operariosmon<=0)||($salariooperariomon<=0)||($operariosmon=="")||($salariooperariomon=="")){$eopmo=1;}

		$operariosmaq = $maquina1 + $maquina2 + $maquina3 + $maquina4 + $maquina5 + $maquina6 + $maquina7;
		$salariooperariosmaq = $_POST["salariooperarios"];
		$salariooperariosmaq=Tirar_Ponto($salariooperariosmaq);
		if(($operariosmaq<=0)||($salariooperariosmaq<=0)||($operariosmaq=="")||($salariooperariosmaq=="")){$eop=1;}

		$qtdadm = round(0.8*($operariosmaq + $operariosmon));
		$saladm = 15*$salariooperariomon;
		$saladm=Tirar_Ponto($saladm);
		if(($qtdadm<=0)||($saladm<=0)||($qtdadm=="")||($saladm=="")){$eadm=1;}

		$qtddemaisfunc = round(0.3*($operariosmaq + $operariosmon + $qtdadm));
		$saldemaisfunc = $_POST["salariooperarios"];
		$saldemaisfunc=Tirar_Ponto($saldemaisfunc);
		if(($qtddemaisfunc<=0)||($saldemaisfunc<=0)||($qtddemaisfunc=="")||($saldemaisfunc=="")){$edemais=1;}		

		$SalTotalMon = $operariosmon*$salariooperariomon;
		$SalTotalOp = $operariosmaq*$salariooperariosmaq;
		$SalTotalDemais = $saldemaisfunc*$qtddemaisfunc;
		$SalTotalADM = $qtdadm*$saladm;

		$MedioSal = ($saldemaisfunc+$saladm+$salariooperariosmaq+$salariooperariomon)/4;

		$emprestimo = $_POST["emprestimo"];
		$emprestimo=Tirar_Ponto($emprestimo);
		if(($emprestimo<0)||($emprestimo=="")){$eem=1;}
		
		$amorempr = $_POST["amortizacaoempre"];
		$amorempr=Tirar_Ponto($amorempr);
		if(($amorempr<0)||($amorempr=="")){$eamor=1;}

		$aplicacao = $_POST["aplicacao"];
		$aplicacao=Tirar_Ponto($aplicacao);
		if(($aplicacao<0)||($aplicacao=="")){$eapl=1;}


		$numParcelaCompra = $_POST["parcelacompra"];
		$numParcelaCompra=Tirar_Ponto($numParcelaCompra);

		$porcentagemVendaPrazo = $_POST["porcentagemvendaaprazo"];
		$numParcelaVenda = $_POST["numeroparcelasvenda"];
		
		if(($numParcelaVenda<0)||($numParcelaCompra<0)||($numParcelaVenda=="")||($numParcelaCompra=="")){$et=1;}
		if ($porcentagemVendaPrazo==0) {
			$numParcelaVenda = 0;
		}

		if (($ep==0)&&($equan==0)&&($equal==0)&&($em==0)&&($eped==0)&&($emaq==0)&&($edemais==0)&&($eadm==0)&&($eadm==0)&&($eop==0)&&($eopmo==0)&&($eem==0)&&($eamor==0)&&($eapl==0)&&($et==0)) 
		{
			settype($salamedio,double);
			$select="SELECT Jogada FROM decisao WHERE Jogada='$jogada' AND Jogo='$codjogo' AND Equipe='$codequipe'";
			$resultado=mysqli_query($con, $select);
			$rows=mysqli_num_rows($resultado);

			// Insere ou atualiza na tabela: Jogo, Equipe, Jogada, Maq1, Maq2, Maq3, Maq4, Maq5, Maq6, Maq7, Emprestimo, Amortizacao, Aplicacao, Operarios, SalOperarios, MediOper,Montagem,SalaMont,MediMont, Adm, SalAdm, MediAdmi, DemaFunc, SalaDema, MediDema,SalMedio,Confirmacao,numParcelaCompra, numParcelaVenda, porcentagemVendaPrazo 
			if ($rows<1){
				$Inclui="INSERT INTO decisao(Jogo, Equipe, Jogada, Maq1, Maq2, Maq3, Maq4, Maq5, Maq6, Maq7, 
					Emprestimo, Amortizacao, Aplicacao, Operarios, SalOperarios, MediOper,Montagem,SalaMont,MediMont, 
					Adm, SalAdm, MediAdmi, DemaFunc, SalaDema, MediDema,SalMedio,Confirmacao,numParcelaCompra, numParcelaVenda, porcentagemVendaPrazo)
					 values ( '$codjogo','$codequipe','$jogada','$maquina1','$maquina2','$maquina3','$maquina4','$maquina5','$maquina6','$maquina7',
					 	'$emprestimo', '$amorempr', '$aplicacao', '$operariosmaq', '$salariooperariosmaq', '$SalTotalOp','$operariosmon','$salariooperariomon','$SalTotalMon',
					 	'$qtdadm', '$saladm', '$SalTotalADM', '$qtddemaisfunc', '$saldemaisfunc', '$SalTotalDemais','$MedioSal','1','$numParcelaCompra', 
					 	'$numParcelaVenda', '$porcentagemVendaPrazo')";
				mysqli_query($con, $Inclui) or die("erro1:".mysql_error());
				$confirmado=1;
			}
			else{
				$Inclui="Update decisao SET Maq1='$maquina1', Maq2='$maquina2', Maq3='$maquina3', Maq4='$maquina4', Maq5='$maquina5', Maq6='$maquina6', Maq7='$maquina7', 
				Emprestimo='$emprestimo', Amortizacao='$amorempr', Aplicacao='$aplicacao', Operarios='$operariosmaq', SalOperarios='$salariooperariosmaq', MediOper='$SalTotalOp',Montagem='$operariosmon',SalaMont='$salariooperariomon',MediMont='$SalTotalMon', 
				Adm='$qtdadm', SalAdm='$saladm', MediAdmi='$SalTotalADM', DemaFunc='$qtddemaisfunc', SalaDema='$saldemaisfunc', MediDema='$SalTotalDemais', SalMedio='$MedioSal', Confirmacao='1',numParcelaCompra='$numParcelaCompra', 
				numParcelaVenda='$numParcelaVenda', porcentagemVendaPrazo='$porcentagemVendaPrazo' WHERE Jogo='$codjogo' AND Equipe='$codequipe' AND Jogada='$jogada' ";
				mysqli_query($con, $Inclui) or die("erro1:".mysql_error());
				$confirmado=1;
			}

			for ($b=1; $b <= 4 ; $b++) 
			{ 
				$select="SELECT * from produto WHERE Jogada='$jogada' AND Jogo='$codjogo' AND Equipe='$codequipe' AND Produto=".$b;
				$resultado=mysqli_query($con, $select);
				$campo=mysqli_fetch_object($resultado);
				if ($campo==0)
				{
					$Inclui="INSERT into produto(Jogo, Equipe, Produto, Jogada, Preco, Qtde, Marketing, Qualidade, Publicidade, Ped) 
					values ('$codjogo','$codequipe','".$b."','$jogada','".${"preco".$b}."','".${"quantidade".$b}."','".${"marketing".$b}."','".${"qualidade".$b}."','".${"publicidade".$b}."','".${"ped".$b}."')";	
					mysqli_query($con, $Inclui) or die("erro2:".mysqli_error());
				}
				else
				{
					$Inclui="update produto SET Preco='".${"preco".$b}."', Qtde='".${"quantidade".$b}."', Marketing='".${"marketing".$b}."', Qualidade='".${"qualidade".$b}."',Publicidade='".${"publicidade".$b}."', Ped='".${"ped".$b}."'  
					WHERE Jogo='$codjogo' AND Equipe='$codequipe' AND Jogada='$jogada' AND Produto='".$b."'";
					mysqli_query($con, $Inclui) or die("erro3:".mysqli_error());
				}
			}
			//header("Location: index.php");
		}

	}

?>