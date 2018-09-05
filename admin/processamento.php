<?php
  include("../seguranca.php"); // Inclui o arquivo com o sistema de segurança
  protegePagina(); // VERIFICA SE O USUÁRIO ESTÁ LOGADO. SE NÃO, SERÁ ENVIADO PARA PÁGINA DE LOGIN.
  $exit = $_POST[sair]; // VARIÁVEL QUE RECEBE SE O USUÁRIO QUER SAIR OU NÃO
  $saibarra = $_GET[barrasai];
  if (($exit != "") || ($_SESSION['usuarioTipo'] == 1)||($saibarra!="")) // VERIFICA SE O USUÁRIO QUER SAIR OU SE O USUÁRIO NÃO É DO TIPO 1 = TIPO DIFERENTE DE ADM
  {
    expulsaVisitante(0); // TERMINA A SESSÃO E O USUÁRIO É ENVIADO PARA A PÁGINA DE LOGIN
  }
  include("../conecta.php");
  
  $select = "Select Descricao from jogos where CodJogo='".$_SESSION['codjogo']."'";
  $resultado = mysqli_query($con, $select);  
  $campojogo=mysqli_fetch_object($resultado);
  
?>

<!doctype HTML>
<html lang="en-gb">
  <!-- CABEÇALHO -->
  <head>

    <?php include 'includes/head.php'; ?>

    <script type="text/javascript">
      $().ready(function() {


          $('#cadastrar').click(function() {
              $('#seta').each(function() 
              {
                  if ($(this).attr('hidden')) {
                      $(this).removeAttr('hidden');
                      $('#resultado').removeAttr('hidden');
                  }
              });
          });

      });
    </script>

    <!-- LIGANDO AO CSS -->

  </head>
  <!-- CABEÇALHO -->

  <body>
    <!-- CORPO DA PÁGINA -->
    <div id="wrap">

      <?php include 'includes/header.php'; ?>

      <?php include 'includes/menulateral.php'; ?>

      <!-- DIV DE TEXTO USUÁRIO -->
      <div class="textousuario">
        <h1>Processamento</h1>

        <!-- DIV FORMCADASTRO -->
        <div class="formcadastro" style="margin-left: 0; margin-bottom: 1rem;">

          <form method="post" action="func_calcula.php">
            <table>
              <tr>
                <td>
                  <h3>Constante</h3>
                </td>
              </tr>
              <tr>
                <td>
                  <p>Selecione uma constante para o processamento:</p>
                </td>
              </tr>
              <tr>
                <td>
                   <select name="select" class="select-wrapper" style="width: 12rem; margin-left: 1rem;">
                     <?php 
                       $select = "Select CodConst, Nome from constantes";
                       $resultado = mysqli_query($con, $select);  
                       $rows = mysqli_num_rows($resultado);

                       for($cont=0;$cont<$rows;$cont++)
                       {
                         $campo=mysqli_fetch_object($resultado);
                         echo "<option value=$campo->CodConst> $campo->Nome </option>" ;
                       } 

                       // ele esta colocando as op&ccedil;&otilde;es no select (drop down)
                     ?>  
                   </select>
                </td>
              </tr>
              <tr>
                <td>
                  <input name="cadastrar" type="submit" id="cadastrar" value="Processar"></button>
                </td>
              </tr>
            </table>
          </form>
        </div>
        <!-- DIV FORMCADASTRO -->
      </div>
    </div>
    <!-- CORPO DA PÁGINA -->


  </body>


</html>