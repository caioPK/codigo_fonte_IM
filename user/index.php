<?php
  include("../seguranca.php"); // Inclui o arquivo com o sistema de segurança
  protegePagina(); // VERIFICA SE O USUÁRIO ESTÁ LOGADO. SE NÃO, SERÁ ENVIADO PARA PÁGINA DE LOGIN.

  $exit = $_POST[sair]; // VARIÁVEL QUE RECEBE SE O USUÁRIO QUER SAIR OU NÃO
  if (($exit != "") || ($_SESSION['usuarioTipo'] == 2)) // VERIFICA SE O USUÁRIO QUER SAIR OU SE O USUÁRIO NÃO É DO TIPO 1 = TIPO DIFERENTE DE ADM
  {
    expulsaVisitante(0); // TERMINA A SESSÃO E O USUÁRIO É ENVIADO PARA A PÁGINA DE LOGIN
  }
  $edit = $_POST[editar];
  if (($editar != "")) // VERIFICA SE O USUÁRIO QUER SAIR OU SE O USUÁRIO NÃO É DO TIPO 1 = TIPO DIFERENTE DE ADM
  {
    header("Location: editar.php"); // TERMINA A SESSÃO E O USUÁRIO É ENVIADO PARA A PÁGINA DE LOGIN
  }
  include("../conecta.php");

  $select = mysqli_query($con, "select r.CodEquipe, e.ConfEquipe, e.NomeEquipe, j.DataInicio, j.PrazoDecisao, j.Jogada, j.Rodadas, j.Descricao, t.Confirmacao from jogadores t, requipejogador r, equipe e, jogos j where r.CodJogador = '".$_SESSION['usuarioID']."' and r.CodEquipe = e.CodEquipe and j.CodJogo = e.Codjogo and t.CodJogador = '".$_SESSION['usuarioID']."'");
  // ESSE SELECT RECEBE AS INFORMAÇÕES NECESSÁRIAS DA PÁGINA. 
  $campo = mysqli_fetch_object($select);
  // INCREMENTA EM VARIÁVEIS O RESULTADOS DOS SELECTS
  $datainicio = $campo->DataInicio;
  $datainicio=substr($campo->DataInicio,8,2)."/".substr($campo->DataInicio,5,2)."/".substr($campo->DataInicio,0,4);
  $prazodecisao = $campo->PrazoDecisao;
  $prazodecisao=substr($campo->PrazoDecisao,8,2)."/".substr($campo->PrazoDecisao,5,2)."/".substr($campo->PrazoDecisao,0,4);
  $codequipe = $campo->CodEquipe;
  $nomeequipe = $campo->NomeEquipe; 


  $SelectVeri = mysqli_query($con, "SELECT Confirmacao FROM jogadores WHERE Codjogador = '".$_SESSION['usuarioID']."'");
  // ESSE SELECT RECEBE AS INFORMAÇÕES NECESSÁRIAS DA PÁGINA. 
  $CampoConf = mysqli_fetch_object($SelectVeri);

  $conf_jog = $CampoConf->Confirmacao;

  if ($codequipe == '') {
    header("Location: cadastroequipe.php");
  }else{
    if($conf_jog == 2){
      expulsaVisitante();
    }
  }
  $aceita = $_POST["btnconfirma"];
  if ($aceita != "") 
  {
    $SelectEquipes = mysqli_query($con, "SELECT j.CodJogador, j.NomeJogador, j.Cpf from jogadores j, requipejogador r, equipe e WHERE e.CodEquipe = '".$codequipe."' and e.CodEquipe = r.CodEquipe and j.Confirmacao = 2 and j.CodJogador = r.CodJogador"); 
    // SELECT DE TODOS O JOGOS QUE O JOGADOR ESTÁ CADASTRADO
    $rows = mysqli_num_rows($SelectEquipes);
    while ($row = mysqli_fetch_array($SelectEquipes))
    {
      if (isset($_POST[$row[0]]) == $row[0]) 
      {
        $Inclui="update jogadores SET Confirmacao='1'  
          WHERE CodJogador='".$row[0]."'";
          mysqli_query($con, $Inclui) or die("erro2:".mysql_error());
      }
    }
  }
?>


<!doctype HTML>
<html lang="en-gb">

  <head>

    <?php include 'includes/head.php'; ?>

  </head>

  <body>
    <!-- CORPO DA PÁGINA -->
    <div id="wrap">
      
      <?php include 'includes/header.php'; ?>

      <?php include 'includes/menulateral.php'; ?>

      <div class="textousuario" style="padding-bottom: 10rem;">
        <h1> 
          <?php  
            echo "Bem-vindo, " . $_SESSION['usuarioNome']. "!"; // MOSTRA O NOME DO USUÁRIO NO TÍTULO DA PÁGINA
          ?>
        </h1>
        <p>Você está cadastrado na equipe  
          <?php  
            echo $codequipe; // MOSTRA NOME DA EQUIPE
          ?>
        </p>
        <p>As equipes das quais você participa ou participou estão listadas abaixo, bem como os respectivos jogos. Caso queira trocar de equipe, selecione o nome da equipe da desejada:</p>
          <select name="time" class="select-wrapper">
              
                <?php
                    // SERÃO ELENCADOS, NO SELECT E OPTION, OS JOGOS QUE O JOGADOR ESTÁ CADASTRADO
                    
                    $SelectEquipes = mysqli_query($con, "SELECT r.CodEquipe, e.NomeEquipe, e.CodJogo, j.Descricao FROM requipejogador r INNER JOIN equipe e ON r.CodEquipe = e.CodEquipe INNER JOIN jogos j ON e.CodJogo = j.CodJogo WHERE r.CodJogador= '".$_SESSION['usuarioID']."' AND e.ConfEquipe != 0 ORDER BY j.PrazoDecisao"); 
                    // SELECT DE TODOS O JOGOS QUE O JOGADOR ESTÁ CADASTRADO
                    $rows = mysqli_num_rows($SelectEquipes);
                    // SEPARA EM LINHAS/FILEIRAS TODAS ESSAS INFORMAÇÕES
                    while ($row = mysqli_fetch_array($SelectEquipes)) //ESSE WHILE INCREMENTA NO SELECT AS INFORMAÇÕES
                    {
                      echo "<option value = '$row[0]' selected><p> $row[1]  de:  $row[3] </p></option>";    
                    }
                ?>
          </select>
        </br></br>
        <h3>Informações sobre
          <?php  
            echo $_SESSION['usuarioNome']; // MOSTRA NOME DO USUÁRIO
          ?>
        </h3>
        <p>
        </p>
        <p>Nº de jogadores confirmados: 
          <?php /*MOSTRA NO PARÁGRAFO UM DOS RESULTADOS DO SELECT */ 
        $SelectEquipes = mysqli_query($con, "SELECT CodJogador FROM requipejogador where CodEquipe =".$codequipe.""); 
        // SELECT DE TODOS O JOGOS QUE O JOGADOR ESTÁ CADASTRADO
        $rows = mysqli_num_rows($SelectEquipes);
        echo $rows; 

        ?>

        </p>
        <p>Status: Equipe <?php /*MOSTRA NO PARÁGRAFO SE A EQUIPE ESTÁ ATIVA OU NÃO*/ if($campo->ConfEquipe == 1){ echo "Ativa";}else{ echo "Inativa"; } ?></p>
        <h3>Informações sobre o jogo <?php /*MOSTRA NO PARÁGRAFO UM DOS RESULTADOS DO SELECT */ echo $campo->Descricao; ?>:</h3>
        <p>Data início: <?php /*MOSTRA NO PARÁGRAFO UM DOS RESULTADOS DO SELECT */ echo $datainicio; ?></p>
        <p>Prazo de Decisão:  <?php /*MOSTRA NO PARÁGRAFO UM DOS RESULTADOS DO SELECT */ echo $prazodecisao; ?></p>
        <p>Rodada atual: <?php /*MOSTRA NO PARÁGRAFO UM DOS RESULTADOS DO SELECT */ echo $campo->Jogada; ?></p>
        <p>Total de Rodadas: <?php /*MOSTRA NO PARÁGRAFO UM DOS RESULTADOS DO SELECT */ echo $campo->Rodadas; ?></p>


        <?php
          $SelectEquipes = mysqli_query($con, "SELECT j.CodJogador, j.NomeJogador, j.Cpf from jogadores j, requipejogador r, equipe e WHERE e.CodEquipe = '".$codequipe."' and e.CodEquipe = r.CodEquipe and j.Confirmacao = 2 and j.CodJogador = r.CodJogador"); 
          // SELECT DE TODOS O JOGOS QUE O JOGADOR ESTÁ CADASTRADO
          $rows = mysqli_num_rows($SelectEquipes);
          if ($rows != 0) 
          {
            echo '
            <h3>Jogadores aguardando aceitação para jogar </h3>
            <div class="formcadastro" style="margin-left: 0rem; width: 25rem;">
              <form method="post" action="">
                <table>
                  <tr>
                    <td>
                      <h3>Jogador</h3>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <p>
                  ';
                    $SelectEquipes = mysqli_query($con, "SELECT j.CodJogador, j.NomeJogador, j.Cpf from jogadores j, requipejogador r, equipe e WHERE e.CodEquipe = '".$codequipe."' and e.CodEquipe = r.CodEquipe and j.Confirmacao = 2 and j.CodJogador = r.CodJogador"); 
                    // SELECT DE TODOS O JOGOS QUE O JOGADOR ESTÁ CADASTRADO
                    $rows = mysqli_num_rows($SelectEquipes);
                    // SEPARA EM LINHAS/FILEIRAS TODAS ESSAS INFORMAÇÕES

                    while ($row = mysqli_fetch_array($SelectEquipes))
                    {
                      echo "<label><input type='checkbox' style='width: 1rem; padding: 0; top:0.4rem; position: relative; vertical-align: middle;' name='$row[0]' value='$row[0]'> Nome: $row[1] e Cpf: $row[2]</label>";
                    }
                  echo '
                  </p>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <button name="btnconfirma" type="submit" id="btnconfirma" value="conf">Aceitar</button>
                    </td>
                  </tr>
                </table>
              </form>
            </div>
            ';
          }
          else
          {

          }
          

        ?>
        

      </div>



    </div>


  </body>
</html>