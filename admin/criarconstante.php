<?php
  include("../seguranca.php"); // Inclui o arquivo com o sistema de segurança
  protegePagina(); // VERIFICA SE O USUÁRIO ESTÁ LOGADO. SE NÃO, SERÁ ENVIADO PARA PÁGINA DE LOGIN.
  $exit = $_POST[sair]; // VARIÁVEL QUE RECEBE SE O USUÁRIO QUER SAIR OU NÃO
  $saibarra = $_GET[barrasai];
  if (($exit != "") || ($_SESSION['usuarioTipo'] == 1)) // VERIFICA SE O USUÁRIO QUER SAIR OU SE O USUÁRIO NÃO É DO TIPO 1 = TIPO DIFERENTE DE ADM
  {
    expulsaVisitante(0); // TERMINA A SESSÃO E O USUÁRIO É ENVIADO PARA A PÁGINA DE LOGIN
  }
  include("../conecta.php");
  $exit = $_POST[sair];
  $rec = $_POST[salvar];
  if ($rec == "salvar") {
    $s = 1;
  }
  include("func_gravaconst.php");
?>

<!doctype HTML>
<html lang="en-gb">
  <!-- CABEÇALHO -->
  <head>

    <?php include 'includes/head.php'; ?>

  </head>
  <!-- CABEÇALHO -->
  <body>
    <div id="wrap">

      <?php include 'includes/header.php'; ?>
  
      <!-- DIV DE TEXTO USUÁRIO -->
      <div class="textousuario" style="margin-left: 10%; margin-bottom: 2rem;">
        <h1>Constantes</h1>
        
        <form method="post" action="">
           <div class="tabs">
            <ul class="tab-links">
              <li class="active"><a href="#tab1">Produto</a></li>
              <li><a href="#tab2">Máquina</a></li>
              <li><a href="#tab3">Outras Informações</a></li>
            </ul>
      
            <div class="tab-content">
              <div id="tab1" class="tab active">
                <h3>Tempo de produto por máquina (minuto)</h3>   
                <table class="tabusuario">
                  <tr>
                    <th></th>
                    <th>Máquina 1</th>
                    <th>Máquina 2</th>
                    <th>Máquina 3</th>
                    <th>Máquina 4</th>
                    <th>Máquina 5</th>
                    <th>Máquina 6</th>
                    <th>Máquina 7</th>
                    <th>Montagem</th>
                  </tr>
                  <tr>
                    <td><p style="width: 5rem;">Produto 1</p></td>
                    <td><input name="Maq1Prod1" style="width: 4rem; margin: 0.3rem; font: 0.5rem;"></td>
                    <td><input name="Maq2Prod1" style="width: 4rem; margin: 0.3rem;"></td>
                    <td><input name="Maq3Prod1" style="width: 4rem; margin: 0.3rem;"></td>
                    <td><input name="Maq4Prod1" style="width: 4rem; margin: 0.3rem;"></td>
                    <td><input name="Maq5Prod1" style="width: 4rem; margin: 0.3rem;"></td>
                    <td><input name="Maq6Prod1" style="width: 4rem; margin: 0.3rem;"></td>
                    <td><input name="Maq7Prod1" style="width: 4rem; margin: 0.3rem;"></td>
                    <td><input name="MontProd1" style="width: 4rem; margin: 0.3rem;"></td>
                  </tr>
                  <tr>
                    <td><p style="width: 5rem;">Produto 2</p></td>
                    <td><input name="Maq1Prod2" style="width: 4rem; margin: 0.3rem; font: 0.5rem;"></td>
                    <td><input name="Maq2Prod2" style="width: 4rem; margin: 0.3rem;"></td>
                    <td><input name="Maq3Prod2" style="width: 4rem; margin: 0.3rem;"></td>
                    <td><input name="Maq4Prod2" style="width: 4rem; margin: 0.3rem;"></td>
                    <td><input name="Maq5Prod2" style="width: 4rem; margin: 0.3rem;"></td>
                    <td><input name="Maq6Prod2" style="width: 4rem; margin: 0.3rem;"></td>
                    <td><input name="Maq7Prod2" style="width: 4rem; margin: 0.3rem;"></td>
                    <td><input name="MontProd2" style="width: 4rem; margin: 0.3rem;"></td>
                  </tr>
                  <tr>
                    <td><p style="width: 5rem;">Produto 3</p></td>
                    <td><input name="Maq1Prod3" style="width: 4rem; margin: 0.3rem; font: 0.5rem;"></td>
                    <td><input name="Maq2Prod3" style="width: 4rem; margin: 0.3rem;"></td>
                    <td><input name="Maq3Prod3" style="width: 4rem; margin: 0.3rem;"></td>
                    <td><input name="Maq4Prod3" style="width: 4rem; margin: 0.3rem;"></td>
                    <td><input name="Maq5Prod3" style="width: 4rem; margin: 0.3rem;"></td>
                    <td><input name="Maq6Prod3" style="width: 4rem; margin: 0.3rem;"></td>
                    <td><input name="Maq7Prod3" style="width: 4rem; margin: 0.3rem;"></td>
                    <td><input name="MontProd3" style="width: 4rem; margin: 0.3rem;"></td>
                  </tr>
                  <tr>
                    <td><p style="width: 5rem;">Produto 4</p></td>
                    <td><input name="Maq1Prod4" style="width: 4rem; margin: 0.3rem; font: 0.5rem;"></td>
                    <td><input name="Maq2Prod4" style="width: 4rem; margin: 0.3rem;"></td>
                    <td><input name="Maq3Prod4" style="width: 4rem; margin: 0.3rem;"></td>
                    <td><input name="Maq4Prod4" style="width: 4rem; margin: 0.3rem;"></td>
                    <td><input name="Maq5Prod4" style="width: 4rem; margin: 0.3rem;"></td>
                    <td><input name="Maq6Prod4" style="width: 4rem; margin: 0.3rem;"></td>
                    <td><input name="Maq7Prod4" style="width: 4rem; margin: 0.3rem;"></td>
                    <td><input name="MontProd4" style="width: 4rem; margin: 0.3rem;"></td>
                  </tr>
                </table>
                <h3>Material do produtos (R$)</h3>
                <table class="tabusuario" style="width: 15rem;">
                  <tr>
                    <td><p style="width: 5rem;">P1</p></td>
                    <td><input name="MatProd1" style="width: 7rem; margin: 0.3rem; font: 0.5rem;"></td>
                  </tr>
                  <tr>
                    <td><p style="width: 5rem;">P2</p></td>
                    <td><input name="MatProd2" style="width: 7rem; margin: 0.3rem; font: 0.5rem;"></td>
                  </tr>
                  <tr>
                    <td><p style="width: 5rem;">P3</p></td>
                    <td><input name="MatProd3" style="width: 7rem; margin: 0.3rem; font: 0.5rem;"></td>
                  </tr>
                  <tr>
                    <td><p style="width: 5rem;">P4</p></td>
                    <td><input name="MatProd4" style="width: 7rem; margin: 0.3rem; font: 0.5rem;"></td>
                  </tr>
                </table>
              </div>

              <div id="tab2" class="tab">  
                <table>
                  <tr>
                    <td>
                      <h3>Potências das máquinas (Hp)</h3>
                      <table class="tabusuario">
                        <tr>
                          <td><p style="width: 5rem;">Máquina 1</p></td>
                          <td><input name="HpMaq1" style="width: 7rem; margin: 0.3rem; font: 0.5rem;"></td>
                        </tr>
                        <tr>
                          <td><p style="width: 5rem;">Máquina 2</p></td>
                          <td><input name="HpMaq2" style="width: 7rem; margin: 0.3rem; font: 0.5rem;"></td>
                        </tr>
                        <tr>
                          <td><p style="width: 5rem;">Máquina 3</p></td>
                          <td><input name="HpMaq3" style="width: 7rem; margin: 0.3rem; font: 0.5rem;"></td>
                        </tr>
                        <tr>
                          <td><p style="width: 5rem;">Máquina 4</p></td>
                          <td><input name="HpMaq4" style="width: 7rem; margin: 0.3rem; font: 0.5rem;"></td>
                        </tr>
                        <tr>
                          <td><p style="width: 5rem;">Máquina 5</p></td>
                          <td><input name="HpMaq5" style="width: 7rem; margin: 0.3rem; font: 0.5rem;"></td>
                        </tr>
                        <tr>
                          <td><p style="width: 5rem;">Máquina 6</p></td>
                          <td><input name="HpMaq6" style="width: 7rem; margin: 0.3rem; font: 0.5rem;"></td>
                        </tr>
                        <tr>
                          <td><p style="width: 5rem;">Máquina 7</p></td>
                          <td><input name="HpMaq7" style="width: 7rem; margin: 0.3rem; font: 0.5rem;"></td>
                        </tr>
                      </table>
                    </td>
                    <td>
                      <h3 style="margin-left: 3rem;">Valor das máquinas (R$)</h3>
                      <table class="tabusuario" style="margin-left: 3rem;">
                        <tr>
                          <td><p style="width: 5rem;">Máquina 1</p></td>
                          <td><input name="ValorMaq1" style="width: 7rem; margin: 0.3rem; font: 0.5rem;"></td>
                        </tr>
                        <tr>
                          <td><p style="width: 5rem;">Máquina 2</p></td>
                          <td><input name="ValorMaq2" style="width: 7rem; margin: 0.3rem; font: 0.5rem;"></td>
                        </tr>
                        <tr>
                          <td><p style="width: 5rem;">Máquina 3</p></td>
                          <td><input name="ValorMaq3" style="width: 7rem; margin: 0.3rem; font: 0.5rem;"></td>
                        </tr>
                        <tr>
                          <td><p style="width: 5rem;">Máquina 4</p></td>
                          <td><input name="ValorMaq4" style="width: 7rem; margin: 0.3rem; font: 0.5rem;"></td>
                        </tr>
                        <tr>
                          <td><p style="width: 5rem;">Máquina 5</p></td>
                          <td><input name="ValorMaq5" style="width: 7rem; margin: 0.3rem; font: 0.5rem;"></td>
                        </tr>
                        <tr>
                          <td><p style="width: 5rem;">Máquina 6</p></td>
                          <td><input name="ValorMaq6" style="width: 7rem; margin: 0.3rem; font: 0.5rem;"></td>
                        </tr>
                        <tr>
                          <td><p style="width: 5rem;">Máquina 7</p></td>
                          <td><input name="ValorMaq7" style="width: 7rem; margin: 0.3rem; font: 0.5rem;"></td>
                        </tr>
                        </table>
                      </td>
                      <td>
                        <h3 style="margin-left: 3rem;">Àrea por máquinas (M<sup>2</sup>)</h3>
                        <table class="tabusuario" style="margin-left: 3rem;">
                          <tr>
                            <td><p style="width: 5rem;">Máquina 1</p></td>
                            <td><input name="AreaM1" style="width: 7rem; margin: 0.3rem; font: 0.5rem;"></td>
                          </tr>
                          <tr>
                            <td><p style="width: 5rem;">Máquina 2</p></td>
                            <td><input name="AreaM2" style="width: 7rem; margin: 0.3rem; font: 0.5rem;"></td>
                          </tr>
                          <tr>
                            <td><p style="width: 5rem;">Máquina 3</p></td>
                            <td><input name="AreaM3" style="width: 7rem; margin: 0.3rem; font: 0.5rem;"></td>
                          </tr>
                          <tr>
                            <td><p style="width: 5rem;">Máquina 4</p></td>
                            <td><input name="AreaM4" style="width: 7rem; margin: 0.3rem; font: 0.5rem;"></td>
                          </tr>
                          <tr>
                            <td><p style="width: 5rem;">Máquina 5</p></td>
                            <td><input name="AreaM5" style="width: 7rem; margin: 0.3rem; font: 0.5rem;"></td>
                          </tr>
                          <tr>
                            <td><p style="width: 5rem;">Máquina 6</p></td>
                            <td><input name="AreaM6" style="width: 7rem; margin: 0.3rem; font: 0.5rem;"></td>
                          </tr>
                          <tr>
                            <td><p style="width: 5rem;">Máquina 7</p></td>
                            <td><input name="AreaM7" style="width: 7rem; margin: 0.3rem; font: 0.5rem;"></td>
                          </tr>
                        </table>
                      </td>
                    </tr>     
                  </table>  
                </div>

                <div id="tab3" class="tab">
                  <h3>Digite o nome da constante:</h3>
                  <p><input name="Nome" style="width: 25rem;"></p>
                  <h3>Adote valores para:</h3>
                  <table class="tabusuario">
                    <tr>
                      <td><p>Custo da àrea construída (M<sup>2</sup>)</p></td>
                      <td><input name="CustoArea" style="width: 15rem; margin: 0.3rem; font: 0.5rem;"></td>
                    </tr>
                    <tr>
                      <td><p>Horas trabalhadas de cada Operário por máquina no mês (minuto)</p></td>
                      <td><input name="HorasOp" style="width: 15rem; margin: 0.3rem; font: 0.5rem;"></td>
                    </tr>
                    <tr>
                      <td><p>Horas extras de cada operário por máquina no mês (minuto)</p></td>
                      <td><input name="HorasExOp" style="width: 15rem; margin: 0.3rem; font: 0.5rem;"></td>
                    </tr>
                    <tr>
                      <td><p>Ajuste de demandas (%) [0-100]</p></td>
                      <td><input name="AjusteDem" style="width: 15rem; margin: 0.3rem; font: 0.5rem;"></td>
                    </tr>
                    <tr>
                      <td><p>Fator de conversão (Energia elétrica)</p></td>
                      <td><input name="FatorCon" style="width: 15rem; margin: 0.3rem; font: 0.5rem;"></td>
                    </tr>
                  </table>
                  <button name="salvar" type="submit" id="salvar" value="salvar" style="width: 10rem;">Salvar</button>
                  <button name="cancel" type="submit" id="cancel" value="cancelar" style="width: 10rem;">Cancelar</button>
                </div>
              </div>
            </div>
        </form>        

      </div>
      <?php
        if ($erro==1)
        {
         echo '<script language="javascript">';
         echo 'alert("'.$mensagem.'")';
         echo '</script>';
        }
        if ($ok == 1) 
        {
         echo "<script language='javascript'>
           if(!alert('Informações salvas com sucesso!')){window.location.href='admin.php';}
         </script>";
        }
      ?>
      <!-- DIV DE TEXTO USUÁRIO -->
    </div>
  </body>

</html>