<?php
  include("../seguranca.php"); // Inclui o arquivo com o sistema de segurança
  protegePagina(); // VERIFICA SE O USUÁRIO ESTÁ LOGADO. SE NÃO, SERÁ ENVIADO PARA PÁGINA DE LOGIN.
  $exit = $_POST[sair]; // VARIÁVEL QUE RECEBE SE O USUÁRIO QUER SAIR OU NÃO
  if (($exit != "") || ($_SESSION['usuarioTipo'] == 2)) // VERIFICA SE O USUÁRIO QUER SAIR OU SE O USUÁRIO NÃO É DO TIPO 1 = TIPO DIFERENTE DE ADM
  {
    expulsaVisitante(0); // TERMINA A SESSÃO E O USUÁRIO É ENVIADO PARA A PÁGINA DE LOGIN
  }
  include("../conecta.php"); // CONECTA AO BANCO
  

  $select = "SELECT e.CodJogo, j.Jogada, e.CodEquipe, j.Rodadas from requipejogador r, equipe e, jogos j WHERE r.CodJogador = '".$_SESSION['usuarioID']."' AND r.CodEquipe = e.CodEquipe AND e.CodJogo = j.CodJogo";
  $pegajogo = mysqli_query($con, $select);
  $campo = mysqli_fetch_object($pegajogo);
  $codjogo = $campo->CodJogo;
  $jogada = $campo->Jogada;
  $rodadas = $campop->Rodadas;
  $codequipe = $campo->CodEquipe;
  $jogada = $jogada;
  $action=$_POST["enviar"];
  
  $selecionou = $_POST[selecionar];
  if ($selecionou != "") {
    $select = "SELECT CodEquipe from equipe WHERE NomeEquipe = '".$_POST[time]."'";
    $pegajogo = mysqli_query($con, $select);
    $campo = mysqli_fetch_object($pegajogo);

    $codequipe=$campo->CodEquipe;
    
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
        
          <tr>
            <td>
              <h3>Equipe</h3>
            </td>
          </tr>
          <form method="post">
          <p>Selecione a equipe que você quer consultar:</p>
            <select name="time" class="select-wrapper">
                
                  <?php
                      // SERÃO ELENCADOS, NO SELECT E OPTION, OS JOGOS QUE O JOGADOR ESTÁ CADASTRADO
                      
                      $SelectEquipes = mysqli_query($con, "SELECT r.CodEquipe, e.NomeEquipe, e.CodJogo, j.Descricao FROM requipejogador r INNER JOIN equipe e ON r.CodEquipe = e.CodEquipe INNER JOIN jogos j ON e.CodJogo = j.CodJogo WHERE r.CodJogador= '".$_SESSION['usuarioID']."' AND e.ConfEquipe != 0 ORDER BY j.PrazoDecisao"); 
                      // SELECT DE TODOS O JOGOS QUE O JOGADOR ESTÁ CADASTRADO
                      $rows = mysqli_num_rows($SelectEquipes);
                      // SEPARA EM LINHAS/FILEIRAS TODAS ESSAS INFORMAÇÕES
                      while ($row = mysqli_fetch_array($SelectEquipes)) //ESSE WHILE INCREMENTA NO SELECT AS INFORMAÇÕES
                      {
                        echo "<option value = '$row[0]' selected><p> $row[1] </p></option>";    
                      }
                  ?>
            </select>
            <button type="submit" name="selecionar" value="selecionar" style="margin-top:-0.1px;;margin-left: 1rem; width: 9rem; height: 1.7rem;">Selecionar</button>
            <br><br>
          </form>

          <?php
            $select = mysqli_query($con, "select r.CodEquipe, e.ConfEquipe, e.NomeEquipe, j.DataInicio, j.PrazoDecisao, j.Jogada, j.Rodadas, j.Descricao, t.Confirmacao from jogadores t, requipejogador r, equipe e, jogos j where r.CodJogador = '".$_SESSION['usuarioID']."' and r.CodEquipe = e.CodEquipe and j.CodJogo = e.Codjogo and t.CodJogador = '".$_SESSION['usuarioID']."'");
            // ESSE SELECT RECEBE AS INFORMAÇÕES NECESSÁRIAS DA PÁGINA. 
            $campo = mysqli_fetch_object($select);
          ?>

          <h3>Informações sobre o jogo <?php /*MOSTRA NO PARÁGRAFO UM DOS RESULTADOS DO SELECT */ echo $campo->Descricao; ?>:</h3>
          <p>Status: Equipe <?php /*MOSTRA NO PARÁGRAFO SE A EQUIPE ESTÁ ATIVA OU NÃO*/ if($campo->ConfEquipe == 1){ echo "Ativa";}else{ echo "ainda em fase de inscrição"; } ?> <button type="submit" name="selecionar" value="selecionar" style="margin-top:-0.1px; width: 10rem; height: 1.7rem;">Finalizar cadastro</button> </p>


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
      <!-- FIM DA DIV TEXTO USUÁRIO -->


      
    </div>

    <script type="text/javascript">
      function id(el) {
        return document.getElementById( el );
      }
      function total( un, qnt ) {
        return parseFloat(un.replace('.', ''), 10) * parseFloat(qnt.replace('.', ''), 10);
      }
      window.onload = function() {
        id('salariooperarios').addEventListener('keyup', function() {
         var result = total( this.value , id('qtdoperarios').value );
          id('totalsalariosoperarios').value = String(result.toFixed(2)).formatMoney();
        });

        id('qtdoperarios').addEventListener('keyup', function(){
          var result = total( id('salariooperarios').value , this.value );
          id('totalsalariosoperarios').value = String(result.toFixed(2)).formatMoney();
        });
      }

      String.prototype.formatMoney = function() 
      {
        var v = this;

        if(v.indexOf('.') === -1) {
          v = v.replace(/([\d]+)/, "$1,00");
        }

        v = v.replace(/([\d]+)\.([\d]{1})$/, "$1,$20");
        v = v.replace(/([\d]+)\.([\d]{2})$/, "$1,$2");
        v = v.replace(/([\d]+)([\d]{3}),([\d]{2})$/, "$1.$2,$3");
        v = v.replace(/([\d]+)([\d]{3}),([\d]{2})$/, "$1.$2,$30");
        v = v.replace(/([\d]+)([\d]{4}),([\d]{3}),([\d]{2})$/, "$1.$2.$3,$4");
        return v;
      };
    </script>



    <!-- FIM CORPO DA PÁGINA -->

  </body>


</html>