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
  $sair = $_POST["limpar"];
  include("func_informacoesusuarios.php");
  
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

      <!-- DIV DE TEXTOUSUARIO -->
      <div class="textousuario" style="padding-bottom: 10rem;">
        <form method="post">
          <table>
            <tr>
              <td>
                <h3>Usuário</h3>
              </td>
            </tr>
            <tr>
              <td><p>Nome Usuário</p><input name="usuario" type="text" id="usuario" style="margin-right:17%;" value="<?php echo $usuario; ?>"></td>
            </tr>
            <tr>
              <td><p>Nova senha</p><input name="senha" type="password" id="senha" style="margin-right:17%;" value=""></td>
              <td><p>Confirmar nova senha</p><input name="confirmarsenha" type="password" id="confirmarsenha" placeholder=""></td>
            </tr>
            <tr>
              <td>
                <h3>Informações do Jogador</h3>
              </td>
            </tr>
            <tr>
              <td><p>Nome do Jogador</p><input name="nome" type="text" id="nome" style="margin-right:17%;" value="<?php echo $nome; ?>"></td>
              <td><p>Email</p><input name="email" type="email" id="email" value="<?php echo $email; ?>"></td>
            </tr>
            <tr>
              <td><p>CPF</p><input name="cpf" type="text" id="cpf" style="margin-right:17%;" value="<?php echo $cpf; ?>"></td>
              <td><p>Endereço</p><input name="endereco" type="text" id="endereco" value="<?php echo $endereco; ?>"></td>
            </tr>
            <tr>
              <td><p>Complemento</p><input name="complemento" type="text" id="complemento" style="margin-right:17%;" value="<?php echo $complemento; ?>"></td>
              <td><p>Bairro</p><input name="bairro" type="text" id="bairro" value="<?php echo $bairro; ?>"></td>
            </tr>
            <tr>
              <td><p>Cidade</p><input name="cidade" type="text" id="cidade" style="margin-right:17%;" value="<?php echo $cidade; ?>"></td>
              <td>
                <p>Estado</p>
                <select name="estado" class="select-wrapper">
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
              <td><p>RG</p><input name="rg" type="text" id="rg" style="margin-right:17%;" value="<?php echo $rg; ?>"></td>
              <td><p>Data Nascimento</p><input name="datanascimento" type="text" id="datanascimento" value="<?php echo $nascimento; ?>"></td>
            </tr>
            <tr>
              <td><p>Profissão</p><input name="profissao" type="text" id="profissao" style="margin-right:17%;" value="<?php echo $profissao; ?>"></td>
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