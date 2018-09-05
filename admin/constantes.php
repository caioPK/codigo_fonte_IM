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
  $exit = $_POST[sair];
  $rec = $_POST[salvar];
  if ($rec == "salvar") {
    $s = 1;
  }
  $cons = $_POST[selecionaconst];
  if ($cons != "") {
    $_SESSION['codconst'] = $cons;
    header("Location: editar_constantes.php");
  }

  $ncons = $_POST[novaconst];
  if ($ncons == "novaconst") {
    header("Location: criarconstante.php");
  }

?>

<!doctype HTML>
<html lang="en-gb">
  <!-- CABEÇALHO -->
  <head>

    <?php include 'includes/head.php'; ?>

  </head>
  <!-- CABEÇALHO -->

  <body>
    <!-- CORPO DA PÁGINA -->
    <div id="wrap">

      <?php include 'includes/header.php'; ?>

      <?php include 'includes/menulateral.php'; ?>

      <div class="textousuario" style="padding-bottom: 3%;">
        <h1>Constantes</h1>
        <form method="post" action="">
          <table>
            <tr>
              <td>
                <p>Selecione um jogo na lista abaixo e clique em Entrar:</p>
              </td>
            </tr>
            <tr>
              <td>
                <select name="select" class="select-wrapper" style="width: 12rem;">
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
            

          
          <?php
            if ($_POST[select] == "") 
            {
              echo '
                <tr>
                  <td>
                    <button name="procconstante" type="submit" id="procconstante" value="escconst" style="width: 12rem;">Selecionar</button>
                  </td>
                </tr>
                </table>
              ';
            }
            else
            {
              $select = "Select * from constantes";
              $resultado = mysqli_query($con, $select); 
              $campo=mysqli_fetch_object($resultado);
              echo '

              </table>
              <form method="post" action="">
                <div class="caixasresultados" style="margin: 0; margin-top: 2rem;">
                  <h4>Informações sobre a constante</h4>
                  <table style="width: 30rem;box-shadow: none;text-align: left;">
                    <tr style="border:none;">
                      <th style="width: 6rem;border:none;">Nome</th>
                      <td style="width: 8rem;border:none;">'.$campo->Nome.'</td>
                    </tr>
                    <tr>
                      <th style="width: 6rem;border:none;">Custo Área Construída</th>
                      <td style="width: 8rem;border:none;">'.$campo->CustoArea.'</td>
                    </tr>
                    <tr>
                      <th style="width: 6rem;border:none;">Fator de conversão</th>
                      <td style="width: 8rem;border:none;">'.$campo->FatorCon.'</td>
                    </tr>
                  </table>
                </div>
                <td>
                  <button name="selecionaconst" type="submit" id="selecionaconst" value="'.$campo->CodConst.'" style="width: 11rem;">Editar</button>
                  <button name="novaconst" type="submit" id="novaconst" value="novaconst" style="width: 11rem;">Nova constante</button>
                </td>
              </form>
              
              ';
            }
          ?>
        </form>
      </div>

      

    </div>
  </body>

</html>