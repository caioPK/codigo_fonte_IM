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
  $select = "SELECT e.CodJogo, j.Jogada, j.FaseJogo from requipejogador r, equipe e, jogos j WHERE r.CodJogador = '".$_SESSION['usuarioID']."' AND r.CodEquipe = e.CodEquipe AND e.CodJogo = j.CodJogo";
  $pegajogo = mysqli_query($con, $select);
  $campo = mysqli_fetch_object($pegajogo);
  $codjogo = $campo->CodJogo;
  $jogada = $campo->Jogada;
  if($campo->FaseJogo != 2)
  {
    $jogada = $jogada - 1;
  }



  $selecionou = $_POST[selecionar];
  if ($selecionou != "") 
  {
    $jog=$_POST[jogada];
    $jogada = $jog;
  }
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
          <h3>Ranking Geral</h3>
          <h2>Jogada <?php echo $jogada; ?></h2>
          <h5 style="position: relative;display: inline-block; margin-right: 1rem; font-size: 1rem;"> Vizualize o ranking na jogada:</h5>
          <form method="post" action="" style="display: inline-block; position: relative; position: relative;">
            
            <select name="jogada" class="select-wrapper">
              <?php
                $select="SELECT Jogada FROM jogos WHERE CodJogo='$codjogo'";
                $resultado=mysqli_query($con, $select);
                $campo=mysqli_fetch_array($resultado);
                $rows=0;
                for($cont=1; $cont<=$campo[0]; $cont++)
                {  
                  $SelectResultados=mysqli_query( $con,"SELECT * FROM resultado WHERE Jogo='$codjogo' AND Jogada='$cont'");
                  $Resultados=mysqli_fetch_object($resultado);
                  if (mysqli_num_rows($SelectResultados)!=0)
                  {
                    echo '<option value="'.$cont.'"> Jogada '.$cont.'</option>'; 
                    $rows=$cont;
                  }
                }
                if($rows==0)
                {
                  echo '<option value="'.$cont.'"> Nenhuma Jogada </option>'; 
                }
              ?>
            </select>
            <button type="submit" name="selecionar" value="selecionar" style="width: 9rem; height: 1.7rem; margin-top:-0.1px;;margin-left: 1rem;">Selecionar</button>
          </form>
          <table class="tabusuario">     
            <tr>
              <th>Coloca&ccedil;&atilde;o</th>
              <th>Nome da equipe</th>
              <th>Pontuação</th>
            </tr>
             
            <?php
              // SERÃO ELENCADOS, NO SELECT E OPTION, OS JOGOS QUE O JOGADOR ESTÁ CADASTRADO      
              $select="SELECT ranking.Equipe, ranking.Geral, equipe.NomeEquipe from ranking, equipe WHERE equipe.CodJogo= ".$codjogo." AND equipe.CodEquipe=ranking.Equipe AND equipe.CodJogo = ranking.Jogo AND Jogada = ".$jogada." order by Geral DESC";

              $resultado=mysqli_query($con, $select);
              // SELECT DE TODOS O JOGOS QUE O JOGADOR ESTÁ CADASTRADO
              $rows=mysqli_num_rows($resultado);
              
              for($cont=1; $cont<=$rows; $cont++)
              {
                $campo = mysqli_fetch_object($resultado);
                echo '<tr>
                      <td><p>'.$cont.'</p></td>
                      <td><p>'.$campo->NomeEquipe.'</p></td>
                      <td><p>'.$campo->Geral.'</p></td>
                      </tr>';
              }
            ?>
            </tr>
          </table>


            <a href="" style="float:left; position: relative; margin-top: 1rem;">
              <img class="logo" src="/imgs/pdf.png" style="width: 2rem; height: 1.8rem; padding-right: 0.5rem;">Clique aqui para o ranking em pdf
            </a>
            
            
          

        </div>
        

        
      </div>

    </div>
    <!-- FIM DO CORPO -->


  </body>


</html>