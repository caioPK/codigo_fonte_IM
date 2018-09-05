<?php
	$erro = 0;
	$mensagem = "Por favor, verifique ";
	if ($s == 1) 
	{
		for ($i=1; $i <= 7; $i++) 
		{ 
			for ($f=1; $f <= 4 ; $f++) 
			{ 
				${"Maq".$i."Prod".$f}  = $_POST["Maq".$i."Prod".$f.""];
				if (${"Maq".$i."Prod".$f} < 0) 
				{
					$mensagem = $mensagem." Produto ".$f." da máquina ".$i.", ";
					$erro = 1;
				}
			}
			${"HpMaq".$i} = $_POST["HpMaq".$i];
			if (${"HpMaq".$i}<=0) 
			{
				$mensagem = $mensagem." Potência da máquina ".$i.", ";
				$erro = 1;
			}
			${"ValorMaq".$i} =  $_POST["ValorMaq".$i];
			if (${"ValorMaq".$i}<=0) 
			{
				$mensagem = $mensagem." Valor das máquinas ".$i.", ";
				$erro = 1;
			}
			${"AreaM".$i} =  $_POST["AreaM".$i];
			if (${"AreaM".$i}<=0) 
			{
				$mensagem = $mensagem." Área das máquinas ".$i.", ";
				$erro = 1;
			}
		}
		for ($r=1; $r <= 4 ; $r++) 
		{ 
			${"MatProd".$r} =  $_POST["MatProd".$r];
		}
		$CustoArea = $_POST["CustoArea"];
		$HorasOp = $_POST["HorasOp"];
		$HorasExOp = $_POST["HorasExOp"];
		$AjusteDem = $_POST["AjusteDem"];
		$FatorCon = $_POST["FatorCon"];
		$Nome = $_POST["Nome"];
		/*if (($CustoArea == "")||($Nome == "")||($HorasOp <= 0)||($AjusteDem <= 0)||($FatorCon <= 0)||($HorasExOp <= 0))
		{
			$erro = 1;
		}*/

		if (($erro == 0)&&())
		{
			$novoconst = "INSERT INTO constantes (Nome, AjusteDem, FatorCon, HorasExOp, HorasOp, CustoArea, ";
			for ($r=1; $r <= 4 ; $r++) { 
				$novoconst = $novoconst."MatProd".$r.", ";
			}
			for ($i=1; $i <= 7; $i++) { 
				for ($f=1; $f <= 4 ; $f++) 
				{ 
					$novoconst = $novoconst."Maq".$i."Prod".$f.", ";
				}
				$novoconst = $novoconst."HpMaq".$i.", ";
				$novoconst = $novoconst."ValorMaq".$i.", ";
				if ($i == 7) {
					$novoconst = $novoconst."AreaM".$i.") ";
				}
				else{
					$novoconst = $novoconst."AreaM".$i.", ";
				}			
			}

			$novoconst = $novoconst."VALUES ('".$Nome."','".$AjusteDem."','".$FatorCon."','".$HorasExOp."','".$HorasOp."','".$CustoArea."', ";
			for ($r=1; $r <= 4 ; $r++) {
				$novoconst = $novoconst."'".${"MatProd".$r}."', ";
			}
			for ($i=1; $i <= 7; $i++) { 
				for ($f=1; $f <= 4 ; $f++) { 
					$novoconst = $novoconst."'".${"Maq".$i."Prod".$f}."', ";
				}
				$novoconst = $novoconst."'".${"HpMaq".$i}."', ";
				$novoconst = $novoconst."'".${"ValorMaq".$i}."', ";
				if ($i == 7) {
					$novoconst = $novoconst."'".${"AreaM".$i}."')";
				}
				else{
					$novoconst = $novoconst."'".${"AreaM".$i}."', ";
				}			
			}
			mysqli_query($con, $novoconst);
			echo "Errormessage:"+mysqli_error($con);
			$ok = 1;
		}

	}
?>