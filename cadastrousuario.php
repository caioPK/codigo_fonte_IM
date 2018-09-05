<?php
  include("conecta.php");
  $okusuario = 0;
  $submitusuario= $_POST["salvarequipe"];
  $criarequipe= $_POST["sim"];
  if ($submitusuario != "") 
  {
    $okusuario = 1;
    include("func_cadusuario.php");
  }


?>

<!doctype HTML>
<html lang="en-gb">

  <head>

    <?php
      include 'includes/head.php';
    ?>

    <script type="text/javascript">
      $().ready(function() {


          $('#nao').click(function() {
              $('#codequipe').each(function() 
              {
                  if ($(this).attr('hidden')) {
                      $(this).removeAttr('hidden');
                      $('#frase').removeAttr('hidden');
                  }
              });
          });

          $('#sim').click(function() {
              $('#codequipe').each(function() 
              {
                  $(this).attr({

                          'hidden': 'hidden'
                      });

              });

              $('#frase').each(function() 
              {
                  $(this).attr({

                          'hidden': 'hidden'
                      });
                  
              });
          });

      });
    </script>
    <!-- LIGANDO AO CSS -->

  </head>

  <body>
    <!-- CORPO DA PÁGINA -->
    <div id="wrap">

      <?php include 'includes/header.php'; ?>


      <!-- DIV DE CADASTRO DE JOGADOR -->
      <div class="divcadastros">
      
        <form method="post">
          <table>
            <tr>
              <td>
                <h3>Usuário</h3>
              </td>
            </tr>
            <tr>
              <td><p>Nome Usuário*</p><input name="usuario" type="text" id="usuario" style="margin-right:17%;" placeholder=""></td>
            </tr>
            <tr>
              <td><p>Senha*</p><input name="senha" type="password" id="senha" style="margin-right:17%;" placeholder=""></td>
              <td><p>Confirmar senha*</p><input name="confirmarsenha" type="password" id="confirmarsenha" placeholder=""></td>
            </tr>

            <tr>
              <td>
                <h3>Informações do Jogador</h3>
              </td>
            </tr>
            <tr>
              <td><p>Nome do Jogador*</p><input name="nome" type="text" id="nome" style="margin-right:17%;" placeholder=""></td>
              <td><p>Email*</p><input name="email" type="email" id="email" placeholder=""></td>
            </tr>
            <tr>
              <td><p>CPF*</p><input name="cpf" type="text" id="cpf" style="margin-right:17%;" placeholder=""></td>
              <td><p>Endereço*</p><input name="endereco" type="text" id="endereco" placeholder=""></td>
            </tr>
            <tr>
              <td><p>Complemento</p><input name="complemento" type="text" id="complemento" style="margin-right:17%;" placeholder=""></td>
              <td><p>Bairro*</p><input name="bairro" type="text" id="bairro" placeholder=""></td>
            </tr>
            <tr>
              <td><p>Cidade*</p><input name="cidade" type="text" id="cidade" style="margin-right:17%;" placeholder=""></td>
              <td>
                <p>Estado*</p>
                <select name="estado" class="select-wrapper" style="margin-left: 4.5%; margin-top: 3%;">
                  <option value="AC" <?php if($estado == "AC"){echo "selected";} ?> ><p>AC</p></option>
                  <option value="AL" <?php if($estado == "AL"){echo "selected";} ?> >AL</option>
                  <option value="AM" <?php if($estado == "AM"){echo "selected";} ?> >AM</option>
                  <option value="AP" <?php if($estado == "AP"){echo "selected";} ?> >AP</option>
                  <option value="BA" <?php if($estado == "BA"){echo "selected";} ?> >BA</option>
                  <option value="CE" <?php if($estado == "CE"){echo "selected";} ?> >CE</option>
                  <option value="DF" <?php if($estado == "DF"){echo "selected";} ?> >DF</option>
                  <option value="ES" <?php if($estado == "ES"){echo "selected";} ?> >ES</option>
                  <option value="GO" <?php if($estado == "GO"){echo "selected";} ?> >GO</option>
                  <option value="MA" <?php if($estado == "MA"){echo "selected";} ?> >MA</option>
                  <option value="MG" <?php if($estado == "MA"){echo "selected";} ?> >MG</option>
                  <option value="MS" <?php if($estado == "MS"){echo "selected";} ?> >MS</option>
                  <option value="MT" <?php if($estado == "MT"){echo "selected";} ?> >MT</option>
                  <option value="PA" <?php if($estado == "PA"){echo "selected";} ?> >PA</option>
                  <option value="PB" <?php if($estado == "PB"){echo "selected";} ?> >PB</option>
                  <option value="PE" <?php if($estado == "PE"){echo "selected";} ?> >PE</option>
                  <option value="PI" <?php if($estado == "PI"){echo "selected";} ?> >PI</option>
                  <option value="PR" <?php if($estado == "PR"){echo "selected";} ?> >PR</option>
                  <option value="RJ" <?php if($estado == "RJ"){echo "selected";} ?> >RJ</option>
                  <option value="RN" <?php if($estado == "RN"){echo "selected";} ?> >RN</option>
                  <option value="RS" <?php if($estado == "RS"){echo "selected";} ?> >RS</option>
                  <option value="RO" <?php if($estado == "RO"){echo "selected";} ?> >RO</option>
                  <option value="RR" <?php if($estado == "RR"){echo "selected";} ?> >RR</option>
                  <option value="SC" <?php if($estado == "SC"){echo "selected";} ?> >SC</option>
                  <option value="SE" <?php if($estado == "SE"){echo "selected";} ?> >SE</option>
                  <option value="SP" <?php if($estado == "SP"){echo "selected";} ?> >SP</option>
                  <option value="TO" <?php if($estado == "TO"){echo "selected";} ?> >TO</option>
                 </select>
              </td>
            </tr>
            <tr>
              <td><p>RG*</p><input name="rg" type="text" id="rg" style="margin-right:17%;" placeholder=""></td>
              <td><p>Data Nascimento*</p><input name="datanascimento" type="text" id="datanascimento" placeholder=""></td>
            </tr>
            <tr>
              <td><p>Profissão*</p><input name="profissao" type="text" id="profissao" style="margin-right:17%;" placeholder=""></td>
            </tr>
            
            <tr>
              <td><button name="salvarequipe" type="submit" id="salvarequipe" value="salvarequipe">Salvar</button></td>
              <td><button name="limpar" type="submit" id="limpar" value="limpar">Limpar</button></td>
            </tr>
          </table>
        </form>
        
      </div>

      <!-- DIV DE CADASTRO DE JOGADOR -->


    </div>
    
    <?php include 'includes/footer.php'; ?>

    <!-- CORPO DA PÁGINA -->
  </body>
  <?php
    if ($erro==1)
    {
      
     echo '<script language="javascript">';
     echo 'alert("Por favor, '.$mensagem.'")';
     echo '</script>';
    }
    elseif($salvo==1)
    {
      if ($criarequipe != "") 
      {
        echo "<script language='javascript'>
        if(!alert('Informações salvas com sucesso. Vamos criar a equipe?')){window.location.href='cadastroequipe.php';}
        </script>";
      }
      else
      {
        
        echo "<script language='javascript'>
        if(!alert('Informações salvas com sucesso. Aguarde a aceitação do administrador!')){window.location.href='login.php';}
        </script>";
      }
      
    }

  ?>
  <script>
    jQuery(function($){
           $("#datanascimento").mask("99/99/9999");
           
    });
  </script>
</html>