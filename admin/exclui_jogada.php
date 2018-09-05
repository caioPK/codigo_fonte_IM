<?php


	$select="select Jogada from jogos WHERE CodJogo='".$_SESSION['codjogo']."'";
	$resultado=mysqli_query($con, $select);  
	$campojogo=mysqli_fetch_object($resultado);
	$jog_decisa = $campojogo->Jogada;

	if($jog_decisa > 1){
		$Deleta = "DELETE FROM decisao WHERE Jogo = '".$_SESSION['codjogo']."' AND Jogada = '".$jog_decisa."'";
			mysqli_query($con, $Deleta) or die("erro2:".mysqli_error());
		
		$Deleta = "DELETE FROM produto WHERE Jogo = '".$_SESSION['codjogo']."' AND Jogada = '".$jog_decisa."'";
			mysqli_query($con, $Deleta) or die("erro3:".mysqli_error());

		$velhajogada = $jog_decisa - 1;

		$Deleta = "DELETE FROM ranking WHERE Jogo = '".$_SESSION['codjogo']."' AND Jogada = '".$velhajogada."'";
		mysqli_query($con, $Deleta) or die("erro4:".mysqli_error());

		$Deleta = "DELETE FROM resultado WHERE Jogo = '".$_SESSION['codjogo']."'AND Jogada = '".$velhajogada."'";
		mysqli_query($con, $Deleta) or die("erro5:".mysqli_error());
		
		$Atualiza="Update jogos SET Jogada = $velhajogada WHERE CodJogo='".$_SESSION['codjogo']."'";
		mysqli_query($con, $Atualiza) or die("erro1:".mysqli_error());
	}

	
?>