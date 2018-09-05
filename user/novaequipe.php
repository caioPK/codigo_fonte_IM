<?php
  include("../seguranca.php"); // Inclui o arquivo com o sistema de segurança
  protegePagina(); // VERIFICA SE O USUÁRIO ESTÁ LOGADO. SE NÃO, SERÁ ENVIADO PARA PÁGINA DE LOGIN.

  $exit = $_POST[sair]; // VARIÁVEL QUE RECEBE SE O USUÁRIO QUER SAIR OU NÃO
  if (($exit != "") || ($_SESSION['usuarioTipo'] == 2)) // VERIFICA SE O USUÁRIO QUER SAIR OU SE O USUÁRIO NÃO É DO TIPO 1 = TIPO DIFERENTE DE ADM
  {
    expulsaVisitante(0); // TERMINA A SESSÃO E O USUÁRIO É ENVIADO PARA A PÁGINA DE LOGIN
  }
  include("../conecta.php");
  $rec = $_POST["salvar"];
  

?>


<html>

  <head>

    <?php include 'includes/head.php'; ?>

    <script src="/js/jquery.min.js"></script>
    <script src="/js/ExpandSelect.js"></script>
    <script type="text/javascript">
      var main = function() 
      {
        $('#jogo').change(function() 
        {
          $('#equipe').removeAttr( 'style' );
          $('#tituloequipe').removeAttr('hidden');
          $('#textoequipe').removeAttr('hidden');
        });

        
      };
      $(document).ready(main);
    </script>
    <!-- LIGANDO AO CSS -->

  </head>

  <body>
    <!-- CORPO DA PÁGINA -->
    <div id="wrap">
      
    <?php include 'includes/header.php'; ?>

    <?php include 'includes/menulateral.php'; ?>

      <!-- DIV DE TEXTOUSUARIO -->
      <div class="textousuario" style="padding-bottom: 10rem;">
        <form method="post">
          <table>
            <tr>
              <td>
                <h3>Escolha uma nova equipe</h3>
              </td>
            </tr>
            <tr>
              <td><p>Jogos abertos</p>
              <?php 
                  $hoje = date("Y-m-d");
                  echo '<select name="jogo" id="jogo" class="select-wrapper">';
                  
                    //$select = "SELECT CodJogo, Descricao, PrazoCada FROM jogos WHERE PrazoCada > '$hoje'";
                    $select = "SELECT CodJogo, Descricao, PrazoCada FROM jogos";
                    $resultado = mysqli_query($con, $select);  
                    $rows = mysqli_num_rows($resultado);
                    echo "<option value='0'> Selecione uma equipe </option>" ;

                    for($cont=0;$cont<$rows;$cont++)
                    {
                        $campo=mysqli_fetch_object($resultado);
                        echo "<option value=$campo->CodJogo> $campo->Descricao </option>" ;
                      
                    }
                    if ($rows<=0) 
                    {
                      echo "<option value='0'> Nenhum jogo aberto </option>";
                    }
                  echo '</select>';
                  // ele esta colocando as op&ccedil;&otilde;es no select (drop down)
                ?>
                </td>
            </tr>
            
            <tr>
              <td>
                <h3 id="tituloequipe" hidden>Equipes</h3>
              </td>
            </tr>
            <tr>
              <td>
                <p id="textoequipe" hidden>Equipes disponíveis</p>
                
                  <select id="equipe" name="equipe" class="select-wrapper" style="display: none;">
                  <?php 
                  $hoje = date("Y-m-d");

                    $select = "SELECT CodJogo, Descricao, PrazoCada FROM jogos WHERE PrazoCada > '$hoje'";
                    $resultado = mysqli_query($con, $select);  
                    $rows = mysqli_num_rows($resultado);
                    echo "<option value='0'> Selecione uma equipe </option>" ;
                    for($cont=0;$cont<$rows;$cont++)
                    {                  
                        $campo=mysqli_fetch_object($resultado);
                        echo "<option value=$campo->CodJogo + 1> $campo->Descricao </option>" ;
                    } 
                  ?>
                  </select>               
              </td>
            </tr>
            
            
          
            <tr>
              <td><button name="salvar" type="submit" id="salvar" value="salvar">Salvar</button></td>
              <td><button name="limpar" type="submit" id="limpar" value="limpar">Limpar</button></td>
            </tr>
          </table>
        </form>
      </div>
      <!-- DIV DE TEXTOUSUARIO -->

      <?php
        if ($errocampo==1)
        {
         echo '<script language="javascript">';
         echo 'alert("Por favor, veja se as informações estão preenchidas corretamente.")';
         echo '</script>';
        }
        if ($mantersenha==1)
        {
         echo '<script language="javascript">';
         echo 'alert("Informações salvas com sucesso! A senha será mantida a mesma.")';
         echo '</script>';
        }
      ?>



    </div>


  </body>
</html>