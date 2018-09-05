<?php
  $P = array();
  $iQualidade = array();
  $EquipeQualidadeM = array();

  $o = 0;
  $i = 0;
  for ($i=0; $i <= 3; $i++) 
  { 
    $o = $i + 1;
    $select="SELECT * from produto WHERE Jogo='$codjogo' AND Equipe=$codequipe AND Jogada='$jogada' AND Produto='".$o."'";
    $resultado=mysqli_query($con, $select);
    $P[$i] =mysqli_fetch_object($resultado);
  }

  $nomes = array('Qualidade', 'Publicidade', 'Marketing', 'PeD', 'Perdas', 'Estoque', 'Vendas');
  for ($i=0; $i <= 6; $i++) 
  { 
    $o = 0;
    for ($i2=0; $i2 <= 3; $i2++) 
    { 
      $o =  $i2 + 1;
      $select="SELECT Equipe, ".$nomes[$i]." from produto WHERE Jogo='$codjogo' AND Jogada='$jogada' AND Produto='".$o."' order by ".$nomes[$i]." DESC";
      $resultado=mysqli_query($con, $select);
      $campo=mysqli_fetch_array($resultado);
      $select="SELECT NomeEquipe from equipe WHERE CodJogo='$codjogo' AND CodEquipe='$campo[0]'";
      $resultado=mysqli_query($con, $select);
      $campoNome = mysqli_fetch_array($resultado);
      $l1 = "i".$nomes[$i]."MA";
      $l2 = "i".$nomes[$i]."M";
      ${$l1}[$i2]=$campo[1];
      ${"Equipe".$l1}[$i2]=$campoNome[0];
      $select="SELECT Equipe, ".$nomes[$i]." from produto WHERE Jogo='$codjogo' AND Jogada='$jogada' AND Produto='".$o."' order by ".$nomes[$i]." ASC";
      $resultado=mysqli_query($con, $select);
      $campo=mysqli_fetch_array($resultado);
      $select="SELECT NomeEquipe from equipe WHERE CodJogo='$codjogo' AND CodEquipe='$campo[0]'";
      $resultado=mysqli_query($con, $select);
      $campoNome = mysqli_fetch_array($resultado);
      ${$l2}[$i2]=$campo[1];
      ${"Equipe".$l2}[$i2]=$campoNome[0];
    }
  }

  // Selecionando indice da equipe
  $select="SELECT Vendas, Quantidade, Endividamento, Lucratividade from ranking WHERE Jogo='$codjogo' AND Jogada='$jogada' AND Equipe='$codequipe' ";
  $resultado=mysqli_query($con, $select);
  while ($row = mysqli_fetch_assoc($resultado)) {
    $equipe_receita = $row["Vendas"];
    $equipe_quantidade = $row["Quantidade"];
    $equipe_endividamento = $row["Endividamento"];
    $equipe_lucratividade = $row["Lucratividade"];
  } 
  // Selecionando melhor indice do jogo
  $select="SELECT r.Vendas,e.NomeEquipe from ranking r INNER JOIN equipe e ON e.CodEquipe = r.Equipe WHERE r.Jogo='$codjogo' AND r.Jogada='$jogada' ORDER BY r.Vendas DESC LIMIT 1";
  $resultado=mysqli_query($con, $select);
  while ($row = mysqli_fetch_assoc($resultado)) {
    $m_receita = $row["Vendas"];
    $m_receita_equipe = $row["NomeEquipe"];   
  }
  // Selecionando melhor indice do jogo
  $select="SELECT r.Quantidade, e.NomeEquipe from ranking r INNER JOIN equipe e ON e.CodEquipe = r.Equipe WHERE r.Jogo='$codjogo' AND r.Jogada='$jogada' ORDER BY r.Quantidade DESC LIMIT 1";
  $resultado=mysqli_query($con, $select);
  while ($row = mysqli_fetch_assoc($resultado)) {
    $m_quantidade = $row["Quantidade"];
    $m_quantidade_equipe = $row["NomeEquipe"];    
  }
  // Selecionando melhor indice do jogo
  $select="SELECT r.Endividamento, e.NomeEquipe from ranking r INNER JOIN equipe e ON e.CodEquipe = r.Equipe WHERE r.Jogo='$codjogo' AND r.Jogada='$jogada' ORDER BY r.Endividamento DESC LIMIT 1";
  $resultado=mysqli_query($con, $select);
  while ($row = mysqli_fetch_assoc($resultado)) {
    $m_endividamento = $row["Endividamento"];
    $m_endividamento_equipe = $row["NomeEquipe"];   
  }
  // Selecionando melhor indice do jogo
  $select="SELECT r.Lucratividade, e.NomeEquipe from ranking r INNER JOIN equipe e ON e.CodEquipe = r.Equipe WHERE r.Jogo='$codjogo' AND r.Jogada='$jogada' ORDER BY r.Lucratividade DESC LIMIT 1";
  $resultado=mysqli_query($con, $select);
  while ($row = mysqli_fetch_assoc($resultado)) {
    $m_lucratividade = $row["Lucratividade"];
    $m_lucratividade_equipe = $row["NomeEquipe"];   
  }
  
  $select="SELECT * from produto WHERE Jogo='$codjogo' AND Jogada='$jogada' AND Equipe='$codequipe' ";
  $resultado=mysqli_query($con, $select);
  while ($row = mysqli_fetch_assoc($resultado)) 
  {
    $produto=$row["Produto"];
    if($produto=='1')
    {
      $tamercado1 = $row["tamercado"];
    }
    if($produto=='2')
    {
      $tamercado2 = $row["tamercado"];
    }
    if($produto=='3')
    {
      $tamercado3 = $row["tamercado"];
    }
    if($produto=='4')
    {
      $tamercado4 = $row["tamercado"];
    }    
  } 
  $somaestoque1=$somaestoque2=$somaestoque3=$somaestoque4=0;
  $select="SELECT * from produto WHERE Jogo='$codjogo' AND Jogada='$jogada'  ";
  $resultado=mysqli_query($con, $select);
  while ($row = mysqli_fetch_assoc($resultado)) 
  {
    $produto=$row["Produto"];
    if($produto=='1')
    {
      $somaestoque1=$somaestoque1+$row["Estoque"];
    }
    if($produto=='2')
    {
      $somaestoque2=$somaestoque2+$row["Estoque"];
    }
    if($produto=='3')
    {
      $somaestoque3=$somaestoque3+$row["Estoque"];
    }
    if($produto=='4')
    {
      $somaestoque4=$somaestoque4+$row["Estoque"];
    }
    
  } 

  for ($c=1; $c <= 4 ; $c++) 
  { 
    $select="SELECT * FROM produto WHERE Jogo='$codjogo' and Jogada='$jogada' and Produto=".$c." order by Preco";
    $resultado=mysqli_query($con, $select);
    $row = mysqli_fetch_assoc($resultado);
    for ($c2=0; $c2 <= 3; $c2++) 
    { 
      if($c2==0)
      {
        ${"menor".$c} = $row["Preco"];
      }
      else 
      {
        ${"maior".$c} = $row["Preco"];
      }
    }
  }
?>