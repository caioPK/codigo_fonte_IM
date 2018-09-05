<?php
  include("../seguranca.php"); // Inclui o arquivo com o sistema de segurança
  protegePagina(); // VERIFICA SE O USUÁRIO ESTÁ LOGADO. SE NÃO, SERÁ ENVIADO PARA PÁGINA DE LOGIN.

  $exit = $_POST[sair]; // VARIÁVEL QUE RECEBE SE O USUÁRIO QUER SAIR OU NÃO
  if (($exit != "") || ($_SESSION['usuarioTipo'] == 2)) // VERIFICA SE O USUÁRIO QUER SAIR OU SE O USUÁRIO NÃO É DO TIPO 1 = TIPO DIFERENTE DE ADM
  {
    expulsaVisitante(0); // TERMINA A SESSÃO E O USUÁRIO É ENVIADO PARA A PÁGINA DE LOGIN
  }
  include("../conecta.php");
  $codjogo = $_POST["jogo"];
  $submitequipe = $_POST["salvarequipe"];
  if ($submitequipe != "") 
  {
    $okequipe = 1;
    include("func_cadastroequipes.php");
  }
  $filiae = $_POST["filiaequipe"];
  if ($filiae != "") 
  {
    $okfilia = 1;
    include("func_cadastroequipes.php");
  }
?>


<!doctype HTML>
<html lang="en-gb">
  
  <head>

    <?php include 'includes/head.php'; ?>

    <script type="text/javascript">
      var main = function() {
        $('#bttncriarequipe').click(function() {
          $('#criarequipe').toggle();
          $('#filiarequipe').toggle(false);
          
        });

        $('#bttnfiliar').click(function() {
          $('#filiarequipe').toggle();
          $('#criarequipe').toggle(false);
        });
      }

      $(document).ready(main);
    </script>
    <!-- LIGANDO AO CSS -->

  </head>

  <body>
    <!-- CORPO DA PÁGINA -->
    <div id="wrap">

      <?php include 'includes/header.php'; ?>

      <!-- DIV DE CADASTRO DE JOGADOR -->
      <div class="textousuario" style="margin-left: 10rem; padding-bottom: 2rem;">
        <div class="formcadastro" style="height: 12rem;">
          <form>
            <table>
              <tr>
                <td>
                  <h3>Criar Equipe</h3>
                </td>
              </tr>
              <tr>
                <td>
                  <p>Clique para criar uma nova equipe no jogo:</p>
                </td>
              </tr>
              <tr>
                <td>
                  <input type="button" id="bttncriarequipe" name="bttncriarequipe" value="Selecionar">
                </td>
              </tr>
            </table>
          </form>
        </div>

        <div class="formcadastro" style="height: 12rem;">
          <form method="post" action="">
            <table>
              <tr>
                <td>
                  <h3>Filiar à equipe</h3>
                </td>
              </tr>
              <tr>
                <td>
                  <p>Clique para se cadastrar em uma nova equipe:</p>
                </td>
              </tr>
              <tr>
                <td>
                  <input type="button" id="bttnfiliar" name="bttnfiliar" value="Selecionar">
                </td>
              </tr>
            </table>
          </form>
        </div>

        <form method="post" id="criarequipe" hidden>
          <table>
            <tr>
              <td>
                <h3>Equipe</h3>
              </td>
            </tr>
            <tr>
              <td><p>Nome Equipe</p><input name="nomeequipe" type="text" id="nomeequipe" style="margin-right:17%;" placeholder=""></td>
              <td>
                <p>Selecione o jogo</p>
                <?php 
                  $hoje = date("Y-m-d");
                  echo '<select name="jogo" class="select-wrapper">';
                  

                    $select = "SELECT CodJogo, Descricao, PrazoCada FROM jogos WHERE PrazoCada >= '$hoje'";
                    $resultado = mysqli_query($con, $select);  
                    $rows = mysqli_num_rows($resultado);

                    for($cont=0;$cont<$rows;$cont++)
                    {
                      $campo=mysqli_fetch_object($resultado);
                      echo "<option value=$campo->CodJogo> $campo->Descricao </option>" ;
                    } 
                  echo '</select>';
                  // ele esta colocando as op&ccedil;&otilde;es no select (drop down)
                ?>  


              </td>
            </tr>
            <tr>
              <td><p>Senha para equipe</p><input name="senhaequipe" type="password" id="senhaequipe" style="margin-right:17%;" placeholder=""></td>
              <td><p>Confirmar senha</p><input name="confirmarsenhaequipe" type="password" id="confirmarsenhaequipe" placeholder=""></td>
            </tr>
            <tr>
              <td>
                <button name="salvarequipe" type="submit" id="salvarequipe" value="salvar" style="width: 10rem;">Salvar</button>
                <button name="limpar" type="submit" id="limpar" value="limpar" style="width: 10rem;">Limpar</button>
              </td>
            </tr>
          </table>
        </form>

        <form method="post" id="filiarequipe" hidden>
          <table>
            <tr>
              <td>
                <h3>Equipe</h3>
              </td>
            </tr>
            <tr>
              <td><p>Nome Equipe</p><input name="nomeequipe" type="text" id="nomeequipe" style="margin-right:17%;" placeholder=""></td>
              <td>
                <p>Selecione o jogo</p>
                <?php 
                  $hoje = date("Y-m-d");
                  echo '<select name="jogo" class="select-wrapper">';
                  

                    $select = "SELECT CodJogo, Descricao, PrazoCada FROM jogos WHERE PrazoCada > '$hoje'";
                    $resultado = mysqli_query($con, $select);  
                    $rows = mysqli_num_rows($resultado);

                    for($cont=0;$cont<$rows;$cont++)
                    {
                      $campo=mysqli_fetch_object($resultado);
                      echo "<option value=$campo->CodJogo> $campo->Descricao </option>" ;
                    } 
                  echo '</select>';
                  // ele esta colocando as op&ccedil;&otilde;es no select (drop down)
                ?>  


              </td>
            </tr>
            <tr>
              <td>
                <button name="filiaequipe" type="submit" id="filiaequipe" value="salvar" style="width: 10rem;">Salvar</button>
                <button name="limpar" type="submit" id="limpar" value="limpar" style="width: 10rem;">Limpar</button>
              </td>
            </tr>
          </table>
        </form>

      </div>
      <!-- DIV DE CADASTRO DE JOGADOR -->
      <?php
        if($mensagem != "")
        {
          echo '<script type="text/javascript">';
          echo 'alert("Por favor,'.$mensagem.'.")';
          echo '</script>';
        }
        if ($ok == 1) {
          echo "<script language='javascript'>
          if(!alert('Informações salvas com sucesso. Aguarde a aceitação do administrador!')){window.location.href='/login.php';}
          </script>";
        }
        
      ?>


    </div>
    <!-- CORPO DA PÁGINA -->
  </body>
</html>