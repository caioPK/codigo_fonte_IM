<?php
  include("../seguranca.php"); // Inclui o arquivo com o sistema de segurança
  protegePagina(); // VERIFICA SE O USUÁRIO ESTÁ LOGADO. SE NÃO, SERÁ ENVIADO PARA PÁGINA DE LOGIN.

  $exit = $_POST[sair]; // VARIÁVEL QUE RECEBE SE O USUÁRIO QUER SAIR OU NÃO
  if (($exit != "") || ($_SESSION['usuarioTipo'] == 1)) // VERIFICA SE O USUÁRIO QUER SAIR OU SE O USUÁRIO NÃO É DO TIPO 1 = TIPO DIFERENTE DE ADM
  {
    expulsaVisitante(0); // TERMINA A SESSÃO E O USUÁRIO É ENVIADO PARA A PÁGINA DE LOGIN
  }
  include("../conecta.php");
  mysqli_set_charset($con,'utf8');
  $buscar = $_POST[btnbuscarnome];
  $nome = $_POST[txtnome];

  $codjogo=$_POST[gerencjogo];
  if ($_POST[gerencjogo] != "")
  {
    header("Location: gerenciarjogo.php");
    //inicializa a mesma sessão utilizada para login, apaga a variavel de sessão codjogo
    //e depois registra uma nova que foi recebida pelo drop down.
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


      <div class="blocos">
        <div class="texto">
          <h3>Bem-Vindo, Adm!</h3>
          <p>Tomar decisões sempre foi uma dificuldade natural do ser humano. Defrontado a uma série de escolhas, vislumbrando um leque de opções, geralmente nos sentimos pequenos em relação ao mundo. O fato é que tomar decisões é algo que devemos aprender para que sejamos bem sucedidos.</p>
        </div>
      </div>

      <div class="formcadastro">
        <form method="post" action="">
          <table>
            <tr>
              <td>
                <h3>Jogo</h3>
              </td>
            </tr>
            <tr>
              <td>
                <p>Selecione um jogo na lista abaixo e clique em Entrar:</p>
              </td>
            </tr>
            <tr>
              <td>
                <select name="select" class="select-wrapper" style="margin-left: 1rem; width: 12rem;">
                  <?php 
                    $select = "Select CodJogo, Descricao from jogos";
                    $resultado = mysqli_query($con, $select);  
                    $rows = mysqli_num_rows($resultado);

                    for($cont=0;$cont<$rows;$cont++)
                    {
                      $campo=mysqli_fetch_object($resultado);
                      echo "<option value=$campo->CodJogo> $campo->Descricao </option>" ;
                    } 

                    // ele esta colocando as op&ccedil;&otilde;es no select (drop down)
                  ?>  
                </select>
              </td>
            </tr>
            <tr>
              <td>
                <button name="escolherjogo" type="submit" id="escolherjogo" value="escjogo">Selecionar</button>
              </td>
            </tr>
          </table>
        </form>
      </div>

      <div class="formcadastro" style="margin-left: 1rem;">
        <form method="post" action="">
          <table>
            <tr>
              <td>
                <h3>Jogador</h3>
              </td>
            </tr>
            <tr>
              <td>
                <p>Selecione um jogador no sistema:</p>
              </td>
            </tr>
            <tr>
              <td>
                <input name="txtnome" type="text" id="txtnome">
              </td>
            </tr>
            <tr>
              <td>
                <button name="btnbuscarnome" type="submit" id="btnbuscarnome">Procurar</button>
              </td>
            </tr>
          </table>
        </form>
      </div>

      <div class="formcadastro" style="margin-left: 1rem;">
        <form method="post" action="criarjogo.php">
          <table>
            <tr>
              <td>
                <h3>Novo Jogo</h3>
              </td>
            </tr>
            <tr>
              <td>
                <p>Clique no botão abaixo para poder criar um novo jogo. Ao criar um jogo, será necessário que se inclua novos jogadores:</p>
              </td>
            </tr>
            <tr>
              <td>
              </td>
            </tr>
            <tr>
              <td>
                <button name="novojogo" type="submit" id="novojogo" value="novo">Novo</button>
              </td>
            </tr>
          </table>
        </form>
      </div>

      <div class="formcadastro" style="margin-left: 1rem;">
        <form method="post" action="criarconstante.php">
          <table>
            <tr>
              <td>
                <h3>Nova Constante</h3>
              </td>
            </tr>
            <tr>
              <td>
                <p>Clique no botão abaixo para poder criar uma nova constante. Ao criar a constante, será necessário que se inclua jogadores:</p>
              </td>
            </tr>
            <tr>
              <td>
              </td>
            </tr>
            <tr>
              <td>
                <button name="novojogo" type="submit" id="novojogo" value="novo">Constantes</button>
              </td>
            </tr>
          </table>
        </form>
      </div>
      
      

      <?php
        if ($_POST[select] == "") 
        {
          
        }
        else
        {
          $_SESSION["codjogo"]=  $_POST[select];

          include("func_jogo.php");
          echo '
          <form method="post" action="gerenciarjogo.php">
            <div class="caixasresultados">
              <h3>Informações sobre o jogo</h3>
              <table style="width: 30rem;box-shadow: none;text-align: left;">
                <tr style="border:none;">
                  <th style="width: 6rem;border:none;">Nome</th>
                  <td style="width: 10rem;border:none;">'.$campojogo->Descricao.'</td>
                </tr>
                <tr>
                  <th style="width: 6rem;border:none;">Rodada Atual</th>
                  <td style="width: 10rem;border:none;">'.$campojogo->Jogada.'</td>
                </tr>
                <tr>
                  <th style="width: 6rem;border:none;">Total de rodadas</th>
                  <td style="width: 10rem;border:none;">'.$campojogo->Rodadas.'</td>
                </tr>
                <tr>
                  <th style="width: 6rem;border:none;">Número de jogadores</th>
                  <td style="width: 10rem;border:none;">'.$rowsjogo.'</td>
                </tr>
                <tr>
                  <th style="width: 6rem;border:none;">Situação do jogo</th>
                  <td style="width: 10rem;border:none;">'.$StatusJogo.'</td>
                </tr>
              </table>
              <button name="gerencjogo" type="submit" id="gerencjogo" value="'.$idjogo.'">Gerenciar jogo</button>
            </div>
          </form>
          ';
        }



        echo '
        <div class="blocos" style="margin-bottom:0;">
        <div class="texto">
        ';
        if($nome=="")
        {

        }
        else
        {
          echo '<h3>Selecione um jogador</h3>';
          $sql="SELECT * FROM jogadores WHERE NomeJogador LIKE '".$nome."%' ";
          $resultado = mysqli_query($con, $sql);  
          $rows = mysqli_num_rows($resultado);

          for($cont=0;$cont<$rows;$cont++)
          {
            $campo=mysqli_fetch_object($resultado);
            echo '
            <table class="tabusuario" style="width: 30rem; margin-top:1rem; margin-bottom: 1rem;">
              <form method="post" action="cadastros.php">
              <tr>
                <th style="width: 10rem;"><p>Nome jogador: </p></th>
                <td style="width: 10rem;"><p><button name="procjog" id="procjog" value="'.$campo->CodJogador.'" type="input" style="margin: 0; padding: 0; width: 100%; height: 100%; background: transparent; color: black; border: none;">'.$campo->NomeJogador.'</button></p></td>
              </tr>
              </form>
            </table>
            ';
          }
        }
        echo '
        </div>
        </div>
        '
        
      ?>

      </table>
      
    </div>
    <!-- FIM CORPO DA PÁGINA -->

  </body>
</html>