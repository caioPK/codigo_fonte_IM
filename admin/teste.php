<?php
	include("../conecta.php");
	$select = "SELECT DuplicatasReceber, Fornecedores, CaixaEnergia, CaixaSalario, CaixaINSS, CaixaMaterial, CaixaFGTS, ICMS, PIS, COFINS, IRPJ from resultado WHERE Jogo = '1055' AND Equipe='1805' AND Jogada='12'";
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
				echo "CaixaINSSAnt = ".$CaixaINSSAnt."\n";
				echo "CaixaMaterialAnt = ".$CaixaMaterialAnt."\n";
				echo "CaixaFGTSAnt = ".$CaixaFGTSAnt."\n";
				echo "ICMSAnt = ".$ICMSAnt."\n";
				echo "IRPJAnt = ".$IRPJAnt."\n";
	echo "CaixaSalarioAnt = ".$CaixaSalarioAnt."\n";	
?>