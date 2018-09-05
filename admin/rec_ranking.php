<?php

	$Faturamento = 0;
	$resultado = "INSERT INTO ranking (Jogo,Jogada,Equipe,QtdeVendidaP1,
		QtdeVendidaP2,QtdeVendidaP3,QtdeVendidaP4,LucroLiquido,
		Faturamento,RetInvestimento,Geral,Vendas,
		Quantidade,Endividamento,Lucratividade)
			VALUES ('".$jogo."','".$jogada."','".$rows[$i][0]."','".${"QVendas1"}[$i]."',
				'".${"QVendas2"}[$i]."','".${"QVendas3"}[$i]."','".${"QVendas4"}[$i]."','".$rank_lucro2."',
				'".$Faturamento."','".$rank_investimento[$i]."','".$rank_geral."','".$rank_vendas[$i]."',
				'".$rank_quantidade[$i]."','".$rank_endividamento."','".$rank_lucratividade."')";

	/*
	echo "Q vendas 1 = ".${"QVendas1"}[$i]."<br>";
	echo "Q vendas 2 = ".${"QVendas2"}[$i]."<br>";
	echo "Q vendas 3 = ".${"QVendas3"}[$i]."<br>";
	echo "Q vendas 4 = ".${"QVendas4"}[$i]."<br>";
	echo "rank lucro = ".$rank_lucro2."<br>";
	echo "rank investimento = ".$rank_investimento[$i]."<br>";
	echo "rank geral = ".$rank_geral."<br>";
	echo "rank vendas = ".$rank_vendas[$i]."<br>";
	echo "rank_quantidade = ".$rank_quantidade[$i]."<br>";
	echo "rank_endividamento = ".$rank_endividamento."<br>";
	echo "rank_lucratividade = ".$rank_lucratividade."<br>";
	*/

	mysqli_query($con, $resultado) or die("erro3:".mysqli_error($con));
?>