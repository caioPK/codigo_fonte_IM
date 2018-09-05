<?php
  include("../seguranca.php"); // Inclui o arquivo com o sistema de segurança
  protegePagina(); // VERIFICA SE O USUÁRIO ESTÁ LOGADO. SE NÃO, SERÁ ENVIADO PARA PÁGINA DE LOGIN.
  $exit = $_POST[sair]; // VARIÁVEL QUE RECEBE SE O USUÁRIO QUER SAIR OU NÃO
  if (($exit != "") || ($_SESSION['usuarioTipo'] == 2)) // VERIFICA SE O USUÁRIO QUER SAIR OU SE O USUÁRIO NÃO É DO TIPO 1 = TIPO DIFERENTE DE ADM
  {
    expulsaVisitante(0); // TERMINA A SESSÃO E O USUÁRIO É ENVIADO PARA A PÁGINA DE LOGIN
  }

  $servername = "dbmy0005.whservidor.com";
  $username = "mercadovirt";
  $password = "36lcwRzg";
  $con = mysqli_connect($servername, $username, $password, "mercadovirt"); // REALIZA A CONEXÃO COM O BANCO
  $select = "SELECT e.CodJogo, j.Jogada, e.CodEquipe from requipejogador r, equipe e, jogos j WHERE r.CodJogador = '".$_SESSION['usuarioID']."' AND r.CodEquipe = e.CodEquipe AND e.CodJogo = j.CodJogo";
  $pegajogo = mysqli_query($con, $select);
  $campo = mysqli_fetch_object($pegajogo);
  $CodEquipe = $campo->CodEquipe;
  $CodJogo = $campo->CodJogo;
  $Jogada = $campo->Jogada;
  //print $CodEquipe;
  //print $CodJogo;

  // Selecionando o Produto 1
  $select="SELECT * from produto WHERE Jogo='$CodJogo' AND Equipe=$CodEquipe AND Jogada='$Jogada' AND Produto='1'";
  $resultado=mysqli_query($con, $select);
  $P1=mysqli_fetch_object($resultado);
  
  // Selecionando o Produto 2
  $select="SELECT * from produto WHERE Jogo='$CodJogo' AND Equipe=$CodEquipe AND Jogada='$Jogada' AND Produto='2'";
  $resultado=mysqli_query($con, $select);
  $P2=mysqli_fetch_object($resultado);
  
  // Selecionando o Produto 3
  $select="SELECT * from produto WHERE Jogo='$CodJogo' AND Equipe=$CodEquipe AND Jogada='$Jogada' AND Produto='3'";
  $resultado=mysqli_query($con, $select);
  $P3=mysqli_fetch_object($resultado);
  
  // Selecionando o Produto 4
  $select="SELECT * from produto WHERE Jogo='$CodJogo' AND Equipe=$CodEquipe AND Jogada='$Jogada' AND Produto='4'";
  $resultado=mysqli_query($con, $select);
  $P4=mysqli_fetch_object($resultado);


  // ********** iQualidade *********//
  // Selecionando o melhor iQualidade do Produto 1
  $select="SELECT Equipe, iQualidade from produto WHERE Jogo='$CodJogo' AND Jogada='$Jogada' AND Produto='1' order by iQualidade DESC";
  $resultado=mysqli_query($con, $select);
  $campo=mysqli_fetch_array($resultado);
  $select="SELECT NomeEquipe from equipe WHERE CodJogo='$CodJogo' AND CodEquipe='$campo[0]'";
  $resultado=mysqli_query($con, $select);
  $campoNome = mysqli_fetch_array($resultado);
  $iQualidade[1]=$campo[1];
  $EquipeQualidade[1]=$campoNome[0];
  
  // Selecionando o melhor iQualidade do Produto 2
  $select="SELECT Equipe, iQualidade from produto WHERE Jogo='$CodJogo' AND Jogada='$Jogada' AND Produto='2' order by iQualidade DESC";
  $resultado=mysqli_query($con, $select);
  $campo=mysqli_fetch_array($resultado);
  $select="SELECT NomeEquipe from equipe WHERE CodJogo='$CodJogo' AND CodEquipe='$campo[0]'";
  $resultado=mysqli_query($con, $select);
  $campoNome = mysqli_fetch_array($resultado);
  $iQualidade[2]=$campo[1];
  $EquipeQualidade[2]=$campoNome[0];
  
  // Selecionando o melhor iQualidade do Produto 3
  $select="SELECT Equipe, iQualidade from produto WHERE Jogo='$CodJogo' AND Jogada='$Jogada' AND Produto='3' order by iQualidade DESC";
  $resultado=mysqli_query($con, $select);
  $campo=mysqli_fetch_array($resultado);
  $select="SELECT NomeEquipe from equipe WHERE CodJogo='$CodJogo' AND CodEquipe='$campo[0]'";
  $resultado=mysqli_query($con, $select);
  $campoNome = mysqli_fetch_array($resultado);
  $iQualidade[3]=$campo[1];
  $EquipeQualidade[3]=$campoNome[0];
  
  // Selecionando o melhor iQualidade do Produto 4
  $select="SELECT Equipe, iQualidade from produto WHERE Jogo='$CodJogo' AND Jogada='$Jogada' AND Produto='4' order by iQualidade DESC";
  $resultado=mysqli_query($con, $select);
  $campo=mysqli_fetch_array($resultado);
  $select="SELECT NomeEquipe from equipe WHERE CodJogo='$CodJogo' AND CodEquipe='$campo[0]'";
  $resultado=mysqli_query($con, $select);
  $campoNome = mysqli_fetch_array($resultado);
  $iQualidade[4]=$campo[1];
  $EquipeQualidade[4]=$campoNome[0];
  
  // ********** iProduto *********//
  // Selecionando o melhor iPublicidade do Produto 1
  $select="SELECT Equipe, iPublicidade from produto WHERE Jogo='$CodJogo' AND Jogada='$Jogada' AND Produto='1' order by iPublicidade DESC";
  $resultado=mysqli_query($con, $select);
  $campo=mysqli_fetch_array($resultado);
  $select="SELECT NomeEquipe from equipe WHERE CodJogo='$CodJogo' AND CodEquipe='$campo[0]'";
  $resultado=mysqli_query($con, $select);
  $campoNome = mysqli_fetch_array($resultado);
  $iPublicidade[1]=$campo[1];
  $EquipePublicidade[1]=$campoNome[0];
    
  // Selecionando o melhor iPublicidade do Produto 2
  $select="SELECT Equipe, iPublicidade from produto WHERE Jogo='$CodJogo' AND Jogada='$Jogada' AND Produto='2' order by iPublicidade DESC";
  $resultado=mysqli_query($con, $select);
  $campo=mysqli_fetch_array($resultado);
  $select="SELECT NomeEquipe from equipe WHERE CodJogo='$CodJogo' AND CodEquipe='$campo[0]'";
  $resultado=mysqli_query($con, $select);
  $campoNome = mysqli_fetch_array($resultado);
  $iPublicidade[2]=$campo[1];
  $EquipePublicidade[2]=$campoNome[0];
    
  // Selecionando o melhor iPublicidade do Produto 3
  $select="SELECT Equipe, iPublicidade from produto WHERE Jogo='$CodJogo' AND Jogada='$Jogada' AND Produto='3' order by iPublicidade DESC";
  $resultado=mysqli_query($con, $select);
  $campo=mysqli_fetch_array($resultado);
  $select="SELECT NomeEquipe from equipe WHERE CodJogo='$CodJogo' AND CodEquipe='$campo[0]'";
  $resultado=mysqli_query($con, $select);
  $campoNome = mysqli_fetch_array($resultado);
  $iPublicidade[3]=$campo[1];
  $EquipePublicidade[3]=$campoNome[0];
    
  // Selecionando o melhor iPublicidade do Produto 4
  $select="SELECT Equipe, iPublicidade from produto WHERE Jogo='$CodJogo' AND Jogada='$Jogada' AND Produto='4' order by iPublicidade DESC";
  $resultado=mysqli_query($con, $select);
  $campo=mysqli_fetch_array($resultado);
  $select="SELECT NomeEquipe from equipe WHERE CodJogo='$CodJogo' AND CodEquipe='$campo[0]'";
  $resultado=mysqli_query($con, $select);
  $campoNome = mysqli_fetch_array($resultado);
  $iPublicidade[4]=$campo[1];
  $EquipePublicidade[4]=$campoNome[0];
    
    
  // ********** iMarketing *********//
  // Selecionando o melhor iMarketing do Produto 1
  $select="SELECT Equipe, iMarketing from produto WHERE Jogo='$CodJogo' AND Jogada='$Jogada' AND Produto='1' order by iMarketing DESC";
  $resultado=mysqli_query($con, $select);
  $campo=mysqli_fetch_array($resultado);
  $select="SELECT NomeEquipe from equipe WHERE CodJogo='$CodJogo' AND CodEquipe='$campo[0]'";
  $resultado=mysqli_query($con, $select);
  $campoNome = mysqli_fetch_array($resultado);
  $iMarketing[1]=$campo[1];
  $EquipeMarketing[1]=$campoNome[0];
  
  // Selecionando o melhor iMarketing do Produto 2
  $select="SELECT Equipe, iMarketing from produto WHERE Jogo='$CodJogo' AND Jogada='$Jogada' AND Produto='2' order by iMarketing DESC";
  $resultado=mysqli_query($con, $select);
  $campo=mysqli_fetch_array($resultado);
  $select="SELECT NomeEquipe from equipe WHERE CodJogo='$CodJogo' AND CodEquipe='$campo[0]'";
  $resultado=mysqli_query($con, $select);
  $campoNome = mysqli_fetch_array($resultado);
  $iMarketing[2]=$campo[1];
  $EquipeMarketing[2]=$campoNome[0];
    
  // Selecionando o melhor iMarketing do Produto 3
  $select="SELECT Equipe, iMarketing from produto WHERE Jogo='$CodJogo' AND Jogada='$Jogada' AND Produto='3' order by iMarketing DESC";
  $resultado=mysqli_query($con, $select);
  $campo=mysqli_fetch_array($resultado);
  $select="SELECT NomeEquipe from equipe WHERE CodJogo='$CodJogo' AND CodEquipe='$campo[0]'";
  $resultado=mysqli_query($con, $select);
  $campoNome = mysqli_fetch_array($resultado);
  $iMarketing[3]=$campo[1];
  $EquipeMarketing[3]=$campoNome[0];
  
  // Selecionando o melhor iMarketing do Produto 4
  $select="SELECT Equipe, iMarketing from produto WHERE Jogo='$CodJogo' AND Jogada='$Jogada' AND Produto='4' order by iMarketing DESC";
  $resultado=mysqli_query($con, $select);
  $campo=mysqli_fetch_array($resultado);
  $select="SELECT NomeEquipe from equipe WHERE CodJogo='$CodJogo' AND CodEquipe='$campo[0]'";
  $resultado=mysqli_query($con, $select);
  $campoNome = mysqli_fetch_array($resultado);
  $iMarketing[4]=$campo[1];
  $EquipeMarketing[4]=$campoNome[0];
  
  // ********** iPeD *********//
  // Selecionando o melhor iPeD do Produto 1
  $select="SELECT Equipe, iPeD from produto WHERE Jogo='$CodJogo' AND Jogada='$Jogada' AND Produto='1' order by iPeD DESC";
  $resultado=mysqli_query($con, $select);
  $campo=mysqli_fetch_array($resultado);
  $select="SELECT NomeEquipe from equipe WHERE CodJogo='$CodJogo' AND CodEquipe='$campo[0]'";
  $resultado=mysqli_query($con, $select);
  $campoNome = mysqli_fetch_array($resultado);
  $iPeD[1]=$campo[1];
  $EquipePeD[1]=$campoNome[0];
  
  // Selecionando o melhor iPeD do Produto 2
  $select="SELECT Equipe, iPeD from produto WHERE Jogo='$CodJogo' AND Jogada='$Jogada' AND Produto='2' order by iPeD DESC";
  $resultado=mysqli_query($con, $select);
  $campo=mysqli_fetch_array($resultado);
  $select="SELECT NomeEquipe from equipe WHERE CodJogo='$CodJogo' AND CodEquipe='$campo[0]'";
  $resultado=mysqli_query($con, $select);
  $campoNome = mysqli_fetch_array($resultado);
  $iPeD[2]=$campo[1];
  $EquipePeD[2]=$campoNome[0];
    
  // Selecionando o melhor iPeD do Produto 3
  $select="SELECT Equipe, iPeD from produto WHERE Jogo='$CodJogo' AND Jogada='$Jogada' AND Produto='3' order by iPeD DESC";
  $resultado=mysqli_query($con, $select);
  $campo=mysqli_fetch_array($resultado);
  $select="SELECT NomeEquipe from equipe WHERE CodJogo='$CodJogo' AND CodEquipe='$campo[0]'";
  $resultado=mysqli_query($con, $select);
  $campoNome = mysqli_fetch_array($resultado);
  $iPeD[3]=$campo[1];
  $EquipePeD[3]=$campoNome[0];
    
  // Selecionando o melhor iPeD do Produto 4
  $select="SELECT Equipe, iPeD from produto WHERE Jogo='$CodJogo' AND Jogada='$Jogada' AND Produto='4' order by iPeD DESC";
  $resultado=mysqli_query($con, $select);
  $campo=mysqli_fetch_array($resultado);
  $select="SELECT NomeEquipe from equipe WHERE CodJogo='$CodJogo' AND CodEquipe='$campo[0]'";
  $resultado=mysqli_query($con, $select);
  $campoNome = mysqli_fetch_array($resultado);
  $iPeD[4]=$campo[1];
  $EquipePeD[4]=$campoNome[0];
?>

<html>

  <head>

    <?php include 'includes/head.php'; ?>

  </head>

  <body>
    <!-- CORPO DA PÁGINA -->
    <div id="wrap">

      <?php include 'includes/header.php'; ?>

      <?php include 'includes/menulateral.php'; ?>

      <div class="textousuario" style="padding-bottom: 10rem;">
        <div align=center>
          <h3>
            <?php
              echo "Índices da equipe ".$_SESSION['usuarioNome'];
            ?>
          </h3>
          <table class="tabusuario">
            <?php     
              echo '
              <tr>
                <th><p>Índice</p></th>
                <th><p>Produto 1</p></th>
                <th><p>Produto 2</p></th>
                <th><p>Produto 3</p></th>
                <th><p>Produto 4</p></th>
              </tr>
              <tr> 
                <td><p>Qualidade</p></td>
                <td><p>'.number_format($P1->iQualidade,6,',','.').'</p></td>
                <td><p>'.number_format($P2->iQualidade,6,',','.').'</p></td>
                <td><p>'.number_format($P3->iQualidade,6,',','.').'</p></td>
                <td><p>'.number_format($P4->iQualidade,6,',','.').'</p></td>
              </tr>
              <tr>
                <td><p>Publicidade</p></td>
                <td><p>'.number_format($P1->iPublicidade,6,',','.').'</p></td>
                <td><p>'.number_format($P2->iPublicidade,6,',','.').'</p></td>
                <td><p>'.number_format($P3->iPublicidade,6,',','.').'</p></td>
                <td><p>'.number_format($P4->iPublicidade,6,',','.').'</p></td>
              </tr>
              <tr>
                <td><p>Marketing</p></td>
                <td><p>'.number_format($P1->iMarketing,6,',','.').'</p></td>
                <td><p>'.number_format($P2->iMarketing,6,',','.').'</p></td>
                <td><p>'.number_format($P3->iMarketing,6,',','.').'</p></td>
                <td><p>'.number_format($P4->iMarketing,6,',','.').'</p></td>
              </tr>
              <tr>
                <td><p>PeD</p></td>
                <td><p>'.number_format($P1->iPeD,6,',','.').'</p></td>
                <td><p>'.number_format($P2->iPeD,6,',','.').'</p></td>
                <td><p>'.number_format($P3->iPeD,6,',','.').'</p></td>
                <td><p>'.number_format($P4->iPeD,6,',','.').'</p></td>
              </tr>
          </table>
        </div>
        <div align=center>
          <h3>Os melhores índices do período: </h3>
          <table class="tabusuario">     
            <tr>
              <th><p>Índice</p></th>
              <th><p>Produto 1</p></th>
              <th><p>Produto 2</p></th>
              <th><p>Produto 3</p></th>
              <th><p>Produto 4</p></th>
            </tr>
            <tr> 
              <td><p>Qualidade</p></td>
              <td><p>'.number_format($iQualidade[1],6,',','.').'</p><p>'.$EquipeQualidade[1].'</p></td>
              <td><p>'.number_format($iQualidade[2],6,',','.').'</p><p>'.$EquipeQualidade[2].'</p></td>
              <td><p>'.number_format($iQualidade[3],6,',','.').'</p><p>'.$EquipeQualidade[3].'</p></td>
              <td><p>'.number_format($iQualidade[4],6,',','.').'</p><p>'.$EquipeQualidade[4].'</p></td>
            </tr>
            <tr>
              <td><p>Publicidade</p></td>
              <td><p>'.number_format($iPublicidade[1],6,',','.').'</p><p>'.$EquipePublicidade[1].'</p></td>
              <td><p>'.number_format($iPublicidade[2],6,',','.').'</p><p>'.$EquipePublicidade[2].'</p></td>
              <td><p>'.number_format($iPublicidade[3],6,',','.').'</p><p>'.$EquipePublicidade[3].'</p></td>
              <td><p>'.number_format($iPublicidade[4],6,',','.').'</p><p>'.$EquipePublicidade[4].'</p></td>
            </tr>
            <tr>
              <td><p>Marketing</p></td>
              <td><p>'.number_format($iMarketing[1],6,',','.').'</p><p>'.$EquipeMarketing[1].'</p></td>
              <td><p>'.number_format($iMarketing[2],6,',','.').'</p><p>'.$EquipeMarketing[2].'</p></td>
              <td><p>'.number_format($iMarketing[3],6,',','.').'</p><p>'.$EquipeMarketing[3].'</p></td>
              <td><p>'.number_format($iMarketing[4],6,',','.').'</p><p>'.$EquipeMarketing[4].'</p></td>
            </tr>
            <tr>
              <td><p>PeD</p></td>
              <td><p>'.number_format($iPeD[1],6,',','.').'</p><p>'.$EquipePeD[1].'</p></td>
              <td><p>'.number_format($iPeD[2],6,',','.').'</p><p>'.$EquipePeD[2].'</p></td>
              <td><p>'.number_format($iPeD[3],6,',','.').'</p><p>'.$EquipePeD[3].'</p></td>
              <td><p>'.number_format($iPeD[4],6,',','.').'</p><p>'.$EquipePeD[4].'</p></td>
            </tr>
          </table>
          ';
          ?>
        </div>
        <div style="margin-top: 1rem;">
          <a href="">
            <img class="logo" src="/imgs/pdf.png" style="width: 2rem; height: 1.8rem; padding-right: 0.5rem;">Clique aqui para imprimir o índice da equipe
          </a>
        </div>
        <div style="margin-top: 1rem;">
          <a href="">
            <img class="logo" src="/imgs/pdf.png" style="width: 2rem; height: 1.8rem; padding-right: 0.5rem;">Clique aqui para imprimir os melhores índices do período
          </a>
        </div>
        <div style="margin-top: 1rem;">
          <a href="">
            <img class="logo" src="/imgs/pdf.png" style="width: 2rem; height: 1.8rem; padding-right: 0.5rem;">Clique aqui para imprimir todos os índices
          </a>
        </div>
      </div>

    </div>
    <!-- FIM DO CORPO -->


  </body>


</html>