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
  
  include("func_tomadadedecisao.php");
  
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
        <?php
          if($finalizada==1)
          {
            echo "<h3>Jogada Finalizada!</h1>
              <p>Para tomar novas decisões, espere a próxima jogada</p>";
          }
        ?>
        <form method="post">
        <div class="tabs">
            <ul class="tab-links">
              <li class="active"><a href="#tab1">Produtos</a></li>
              <li><a href="#tab2">Máquinas</a></li>
              <li><a href="#tab3">Funcionário</a></li>
              <li><a href="#tab4">Outras Informações</a></li>
            </ul>
            <div class="tab-content">
              <div id="tab1" class="tab active">
                <div align=center>

                  <h1>Tome Decisões</h1>
                  <h3>Produtos</h3>
                  <table class="tabusuario">
                    <tr>
                      <th></th>
                      <th>Preço (R$)</th>
                      <th>Quantidade</th>
                      <th>Marketing (R$)</th>
                      <th>Qualidade (R$)</th>
                      <th>Publicidade (R$)</th>
                      <th>P&D (R$)</th>
                    </tr>
                    <tr>
                      <td>Produto 1</td>
                      <td><input id="precoprod1" type="text" name="precoprod1" style="width: 7rem; margin: 0.3rem;" value="<?php echo $preco1; ?>"></td>
                      <td><input name="quantprod1" id="quantprod1" style="width: 4rem; margin: 0.3rem;" value="<?php echo $quantidade1; ?>"></td>
                      <td><input name="markprod1" type="text" id="markprod1" style="width: 7rem; margin: 0.3rem;" value="<?php echo number_format($marketing1,2,',','.'); ?>"></td>
                      <td><input name="qualiprod1" type="text" id="qualiprod1" style="width: 7rem; margin: 0.3rem;" value="<?php echo number_format($qualidade1,2,',','.'); ?>"></td>
                      <td><input name="publiprod1" type="text" id="publiprod1" style="width: 7rem; margin: 0.3rem;" value="<?php echo number_format($publicidade1,2,',','.'); ?>"></td>
                      <td><input name="pedprod1" type="text" id="pedprod1" style="width: 7rem; margin: 0.3rem;" value="<?php echo number_format($ped1,2,',','.'); ?>"></td>
                    </tr>
                    <tr>
                      <td>Produto 2</td>
                      <td><input name="precoprod2" type="text" id="precoprod2" name="precoprod2" style="width: 7rem; margin: 0.3rem;" value="<?php echo number_format($preco2,2,',','.'); ?>"></td>
                      <td><input name="quantprod2" id="quantprod2" style="width: 4rem; margin: 0.3rem;" value="<?php echo $quantidade2; ?>"></td>
                      <td><input name="markprod2" type="text" id="markprod2" style="width: 7rem; margin: 0.3rem;" value="<?php echo number_format($marketing2,2,',','.'); ?>"></td>
                      <td><input name="qualiprod2" type="text" id="qualiprod2" style="width: 7rem; margin: 0.3rem;" value="<?php echo number_format($qualidade2,2,',','.'); ?>"></td>
                      <td><input name="publiprod2" type="text" id="publiprod2" style="width: 7rem; margin: 0.3rem;" value="<?php echo number_format($publicidade2,2,',','.'); ?>"></td>
                      <td><input name="pedprod2" type="text" id="pedprod2" style="width: 7rem; margin: 0.3rem;" value="<?php echo number_format($ped2,2,',','.'); ?>"></td>
                    </tr>
                    <tr>
                      <td>Produto 3</td>
                      <td><input name="precoprod3" type="text" id="precoprod3"style="width: 7rem; margin: 0.3rem;" value="<?php echo number_format($preco3,2,',','.'); ?>"></td>
                      <td><input name="quantprod3" id="quantprod3" style="width: 4rem; margin: 0.3rem;" value="<?php echo $quantidade3; ?>"></td>
                      <td><input name="markprod3" type="text" id="markprod3" style="width: 7rem; margin: 0.3rem;" value="<?php echo number_format($marketing3,2,',','.'); ?>"></td>
                      <td><input name="qualiprod3" type="text" id="qualiprod3" style="width: 7rem; margin: 0.3rem;" value="<?php echo number_format($qualidade3,2,',','.'); ?>"></td>
                      <td><input name="publiprod3" type="text" id="publiprod3" style="width: 7rem; margin: 0.3rem;" value="<?php echo number_format($publicidade3,2,',','.'); ?>"></td>
                      <td><input name="pedprod3" type="text" id="pedprod3" style="width: 7rem; margin: 0.3rem;" value="<?php echo number_format($ped3,2,',','.'); ?>"></td>
                    </tr>
                    <tr>
                      <td>Produto 4</td>
                      <td><input name="precoprod4" type="text" id="precoprod4"style="width: 7rem; margin: 0.3rem;" value="<?php echo number_format($preco4,2,',','.'); ?>"></td>
                      <td><input name="quantprod4" id="quantprod4" style="width: 4rem; margin: 0.3rem;" value="<?php echo $quantidade4; ?>"></td>
                      <td><input name="markprod4" type="text" id="markprod4" style="width: 7rem; margin: 0.3rem;" value="<?php echo number_format($marketing4,2,',','.'); ?>"></td>
                      <td><input name="qualiprod4" type="text" id="qualiprod4" style="width: 7rem; margin: 0.3rem;" value="<?php echo number_format($qualidade4,2,',','.'); ?>"></td>
                      <td><input name="publiprod4" type="text" id="publiprod4" style="width: 7rem; margin: 0.3rem;" value="<?php echo number_format($publicidade4,2,',','.'); ?>"></td>
                      <td><input name="pedprod4" type="text" id="pedprod4" style="width: 7rem; margin: 0.3rem;" value="<?php echo number_format($ped4,2,',','.'); ?>"></td>
                    </tr>
                    
                  </table>
                </div>
              </div>


              <div id="tab2" class="tab">
                <div align=center>
                  <h3>Número de máquinas</h3> <!-- DELIMITAR O NÚMERO DE MÁQUINAS CONFORME AS INFORMAÇÕES DO JOGO -->
                  <table class="tabusuario" style="width: 20%; margin-bottom: 1rem;">
                    <tr>
                      <td>Máquina 1</td>
                      <td><input name="maq1" id="maq1" style="width: 4rem; margin: 0.3rem;" value="<?php echo $maquina1; ?>"></td>
                    </tr>
                    <tr>
                      <td>Máquina 2</td>
                      <td><input name="maq2" id="maq2" style="width: 4rem; margin: 0.3rem;" value="<?php echo $maquina3; ?>"></td>
                    </tr>
                    <tr>
                      <td>Máquina 3</td>
                      <td><input name="maq3" id="maq3" style="width: 4rem; margin: 0.3rem;" value="<?php echo $maquina3; ?>"></td>
                    </tr>
                    <tr>
                      <td>Máquina 4</td>
                      <td><input name="maq4" id="maq4" style="width: 4rem; margin: 0.3rem;" value="<?php echo $maquina4; ?>"></td>
                    </tr>
                    <tr>
                      <td>Máquina 5</td>
                      <td><input name="maq5" id="maq5" style="width: 4rem; margin: 0.3rem;" value="<?php echo $maquina5; ?>"></td>
                    </tr>
                    <tr>
                      <td>Máquina 6</td>
                      <td><input name="maq6" id="maq6" style="width: 4rem; margin: 0.3rem;" value="<?php echo $maquina6; ?>"></td>
                    </tr>
                    <tr>
                      <td>Máquina 7</td>
                      <td><input name="maq7" id="maq7" style="width: 4rem; margin: 0.3rem;" value="<?php echo $maquina7; ?>"></td>
                    </tr>
                  </table>
                </div>
              </div>
        
              <div id="tab3" class="tab">
                <div align=center>
                  <h3>Funcionários</h3>
                  <table class="tabusuario">
                    <tr>
                      <th></th>
                      <th>Número</th>
                      <th>Salário (R$)</th>
                      <th>Salário Total (R$)</th>
                    </tr>
                    <tr>
                      <td>Operários na montagem</td>
                      <td><input id="qtdoperarios" name="qtdoperarios" style="width: 14rem; margin: 0.3rem;" value="<?php echo $operariosmon; ?>"></td>
                      <td><input type="text" id="salariooperarios" name="salariooperarios" style="width: 14rem; margin: 0.3rem;" value="<?php echo number_format($salariooperariomon,2,',','.'); ?>"></td>
                      <td><input disabled type="text" id="totalsalariosoperarios" name="totalsalariosoperarios" style="width: 14rem; margin: 0.3rem;" value="<?php echo number_format($totalsalopemon,2,',','.'); ?>"></td>
                    </tr>
                    <tr>
                      <td>Operários de máquina</td>
                      <td><input disabled name="qtdoperariosmaq" id="qtdoperariosmaq" style="width: 14rem; margin: 0.3rem;" value="<?php echo $operariosmaq; ?>"></td>
                      <td><input disabled type="text" id="salariooperariosmaq" name="salariooperariosmaq" style="width: 14rem; margin: 0.3rem;" value="<?php echo number_format($salariooperariosmaq,2,',','.'); ?>"></td>
                      <td><input disabled type="text" id="totalsalariosoperariosmaq" name="totalsalariosoperariosmaq" style="width: 14rem; margin: 0.3rem;" value="<?php echo number_format($totaloperariosmaq,2,',','.'); ?>"></td>
                    </tr>
                    <tr>
                      <td>Demais funcionários</td>
                      <td><input disabled name="qtddemaisfunc" id="qtddemaisfunc" style="width: 14rem; margin: 0.3rem;" value="<?php echo $qtddemaisfunc; ?>"></td>
                      <td><input disabled type="text" id="salariofunc" name="salariofunc" style="width: 14rem; margin: 0.3rem;" value="<?php echo number_format($saldemaisfunc,2,',','.'); ?>"></td>
                      <td><input disabled type="text" id="totalsalariosfunci" name="totalsalariosfunci" style="width: 14rem; margin: 0.3rem;" value="<?php echo number_format($totalsalfunc,2,',','.'); ?>"></td>
                    </tr>
                    <tr>
                      <td>Administrativo</td>
                      <td><input disabled name="qtdadmin" id="qtdadmin" style="width: 14rem; margin: 0.3rem;" value="<?php echo $qtdadm; ?>"></td>
                      <td><input disabled type="text" name="salarioadm" id="salarioadm" style="width: 14rem; margin: 0.3rem;" value="<?php echo number_format($saladm,2,',','.'); ?>"></td>
                      <td><input disabled type="text" name="totalsalariosadm" id="totalsalariosadm" style="width: 14rem; margin: 0.3rem;" value="<?php echo number_format($totalsaladm,2,',','.'); ?>"></td>
                    </tr>
                    <tr>
                      <td>Salário Médio</td>
                      <td><input disabled type="text" name="salariomedio" id="salariomedio" style="width: 14rem; margin: 0.3rem;" value="<?php echo number_format($salamedio,2,',','.'); ?>"></td></td>
                      <td></td>
                      <td></td>
                    </tr>
                  </table>
                </div>
              </div>

              <div id="tab4" class="tab">
                <div align=center>
                  <h3>Outras informações</h3>
                  <table class="tabusuario">
                    <tr>
                      <td>Empréstimo (R$)</td>
                      <td><input type="text" id="emprestimo" name="emprestimo" style="width: 14rem; margin: 0.3rem;" value="<?php echo number_format($emprestimo,2,',','.'); ?>"></td>
                    </tr>
                    <tr>
                      <td>Amortização de Empréstimo (R$)</td>
                      <td><input type="text" id="amortizacaoempre" name="amortizacaoempre" style="width: 14rem; margin: 0.3rem;" value="<?php echo number_format($amorempr,2,',','.'); ?>"></td>
                    </tr>
                    <tr>
                      <td>Aplicação (R$)</td>
                      <td><input type="text" id="aplicacao" name="aplicacao" style="width: 14rem; margin: 0.3rem;" value="<?php echo number_format($aplicacao,2,',','.'); ?>"></td>
                    </tr>
                  </table>
                  <table class="tabusuario" style="margin-top:1rem;">
                    <tr>
                      <td>Número Parcelas Compra</td>
                      <td><input type="text" id="parcelacompra" name="parcelacompra" style="width: 14rem; margin: 0.3rem;" value="<?php echo number_format($aplicacao,2,',','.'); ?>"></td>
                    </tr>
                    <tr>
                      <td>Porcentagem de Venda à Prazo (%)</td>
                      <td>

                        <select name="porcentagemvendaaprazo">  
                          
                          <option value="0" <?php if($porcentagemVendaPrazo == 0){echo "selected";} ?> >0</option>
                          <option value="10" <?php if($porcentagemVendaPrazo == 10){echo "selected";} ?> >10</option>
                          <option value="20" <?php if($porcentagemVendaPrazo == 20){echo "selected";} ?> >20</option>
                          <option value="30" <?php if($porcentagemVendaPrazo == 30){echo "selected";} ?> >30</option>
                          <option value="40" <?php if($porcentagemVendaPrazo == 40){echo "selected";} ?> >40</option>
                          <option value="50" <?php if($porcentagemVendaPrazo == 50){echo "selected";} ?> >50</option>
                          <option value="60" <?php if($porcentagemVendaPrazo == 60){echo "selected";} ?> >60</option>
                          <option value="70" <?php if($porcentagemVendaPrazo == 70){echo "selected";} ?> >70</option>
                          <option value="80" <?php if($porcentagemVendaPrazo == 80){echo "selected";} ?> >80</option>
                          <option value="90" <?php if($porcentagemVendaPrazo == 90){echo "selected";} ?> >90</option>
                          
                        </select>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        Número Parcelas Venda [0 + X]
                      </td>
                      <td>
                        <input type="text" id="numeroparcelasvenda" name="numeroparcelasvenda" style="width: 14rem; margin: 0.3rem;" value="<?php echo $numParcelaVenda; ?>">
                      </td>      
                    </tr>
                  </table>
                </div>
              </div>
            </div> 
            <!-- FIM DA CLASSE TABcontent -->
        </div>
        <!-- FIM DA CLASSE TABS -->
        <?php
          if ($finalizada == 1){
            echo '<br>
              <a href="">
                <img class="logo" src="/imgs/pdf.png" style="width: 2rem; height: 1.8rem; padding-right: 0.5rem;">Clique aqui para imprimir este relatório em PDF</br>
              </a>
              <a href="">
                <img class="logo" src="/imgs/pdf.png" style="width: 2rem; height: 1.8rem; padding-right: 0.5rem; padding-top: 0.5rem;">Clique aqui para imprimir todos os relatórios em PDF
              </a>
            ';
          }
          else
          {
            echo "<button name='enviar' type='submit' style='width: 15rem; height: 3rem;' value='Avançar'>Enviar informações</button>";
            echo "<button name='limpar' formaction='tomardecisao.php' type='sumbit' style='width: 15rem; height: 3rem; margin-left: 2rem;'>Limpar</button>";
            echo '
              <br>
              <a href="">
                <img class="logo" src="/imgs/pdf.png" style="width: 2rem; height: 1.8rem; padding-right: 0.5rem;">Clique aqui para imprimir este relatório em PDF</br>
              </a>
              <a href="">
                <img class="logo" src="/imgs/pdf.png" style="width: 2rem; height: 1.8rem; padding-right: 0.5rem; padding-top: 0.5rem;">Clique aqui para imprimir todos os relatórios em PDF
              </a>
            ';
          }

        ?>
      </form>
      </div>
      <!-- FIM DA DIV TEXTO USUÁRIO -->


      <?php
        if ($ep==1)
        {
         echo '<script language="javascript">';
         echo 'alert("Por favor, redigite preço do Produto '.$b.'!")';
         echo '</script>';
        }
        if ($equal==1)
        {
         echo '<script language="javascript">';
         echo 'alert("Por favor, redigite qualidade do Produto '.$b.'!")';
         echo '</script>';
        }
        if ($equan==1)
        {
         echo '<script language="javascript">';
         echo 'alert("Por favor, redigite quantidade do Produto '.$b.'!")';
         echo '</script>';
        }
        if ($em==1)
        {
         echo '<script language="javascript">';
         echo 'alert("Por favor, redigite marketing do Produto '.$b.'!")';
         echo '</script>';
        }
        if ($epub==1)
        {
         echo '<script language="javascript">';
         echo 'alert("Por favor, redigite publicidade do Produto '.$b.'!")';
         echo '</script>';
        }
        if ($eped==1)
        {
         echo '<script language="javascript">';
         echo 'alert("Por favor, redigite PeD do Produto '.$b.'!")';
         echo '</script>';
        }
        if ($emaq==1)
        {
         echo '<script language="javascript">';
         echo 'alert("Por favor, redigite o número de máquinas na Máquina '.$m.'!")';
         echo '</script>';
        }
        if ($eop==1)
        {
         echo '<script language="javascript">';
         echo 'alert("Por favor, veja se as informações dos funcionários de montagem foram preenchidas adequadamente.")';
         echo '</script>';
        }

        if ($eopmo==1)
        {
         echo '<script language="javascript">';
         echo 'alert("Por favor, veja se as informações dos funcionários de máquina foram preenchidas adequadamente.")';
         echo '</script>';
        }

        if ($edemais==1)
        {
         echo '<script language="javascript">';
         echo 'alert("Por favor, veja se as informações dos demais funcionários foram preenchidas adequadamente.")';
         echo '</script>';
        }

        if ($eem==1)
        {
         echo '<script language="javascript">';
         echo 'alert("Por favor, veja se as informações de empréstimo estão corretas.")';
         echo '</script>';
        }

        if ($eamor==1)
        {
         echo '<script language="javascript">';
         echo 'alert("Por favor, veja se as informações de amortização estão corretas.")';
         echo '</script>';
        }

        if ($eapl==1)
        {
         echo '<script language="javascript">';
         echo 'alert("Por favor, veja se as informações de aplicação estão corretas.")';
         echo '</script>';
        }

        if ($et==1)
        {
         echo '<script language="javascript">';
         echo 'alert("Por favor, verifique se as informações de compra e venda estão corretas.")';
         echo '</script>';
        }

        if($confirmado==1)
        {
          echo '<script language="javascript">';
          echo 'alert("Dados salvos com sucesso!")';
          echo '</script>';

        }
      ?>
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