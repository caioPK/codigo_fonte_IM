<?php
  $_SESSION['codjogo'] = $codjogo;
  include("../seguranca.php"); // Inclui o arquivo com o sistema de segurança
  protegePagina(); // VERIFICA SE O USUÁRIO ESTÁ LOGADO. SE NÃO, SERÁ ENVIADO PARA PÁGINA DE LOGIN.

  $exit = $_POST[sair]; // VARIÁVEL QUE RECEBE SE O USUÁRIO QUER SAIR OU NÃO
  if (($exit != "") || ($_SESSION['usuarioTipo'] == 1)) // VERIFICA SE O USUÁRIO QUER SAIR OU SE O USUÁRIO NÃO É DO TIPO 1 = TIPO DIFERENTE DE ADM
  {
    expulsaVisitante(0); // TERMINA A SESSÃO E O USUÁRIO É ENVIADO PARA A PÁGINA DE LOGIN
  }
  include("../conecta.php");
  mysqli_set_charset($con,'utf8');

  if ($_POST[alterar] != "")
  { $editar=1;}

  if ($_POST[exc] != ""){  
    include("exclui_jogada.php");
  }

  $codjogo = $_POST["gerencjogo"];

  
  include("func_jogo.php");
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
   
      <!-- DIV DE TEXTO USUÁRIO -->
      <?php
        echo '
        <div class="textousuario">
        <h1>Informações sobre o Jogo</h1>
        <form method="post" action="">
          <table>
            <tr>
              <td><p>Nome do Jogo</p><input name="nomejogo" type="text" id="nomejogo" style="margin-right:17%;" value="'.$campojogo->Descricao.'"></td>
              <td><p>Prazo de cadastro</p><input name="prazodecadastro" type="text" id="prazodecadastro" value="'.$prazocada.'"></td>
            </tr>
            <tr>
              <td><p>Início do jogo</p><input type="texto" name="datainicio" id="datainicio" value="'.$datainicio.'" size="10" maxlength="10"></td>
              <td><p>Data de Decisão</p><input type="text" name="datadecisao" id="datadecisao" size="10" maxlength="10" value="'.$prazodecisao.'"></td>
            </tr>
            <tr>
              <td><p>Total de rodadas</p><input name="totalrodadas" type="text" id="totalrodadas" onkeypress="return validateQty(event);" value="'.$campojogo->Rodadas.'"></td>
              <td><p>Jogada Atual</p><input disabled name="jogadaatual" type="text " id="jogadaatual" value="'.$campojogo->Jogada.'"></td>
            </tr>
            <tr>
              <td><p>Capital Inicial (R$)</p><input name="capitalinicial" type="text" id="capitalinicial" value="'.$campojogo->CapInicial.'"></td>
              <td><p>Máximo Empréstimo</p><input name="maximoemprestimo" type="text" id="maximoemprestimo" value="'.$campojogo->MaxEmprestimo.'"></td>
            </tr>
            <tr>
              <td><p>Tamanho Inicial da demanda</p><input name="tamanhoinicial" type="text " id="tamanhoinicial" value="'.$campojogo->TamanhoInicial.'"></td>
              <td><p>Tamanho Final da demanda</p><input name="tamanhofinal" type="text" id="tamanhofinal" value="'.$campojogo->TamanhoFinal.'"></td>
            </tr>
            <tr>
              <td><p title="Aqui é o máximo de máquinas que se pode adquirir em uma jogada">Aquisição de máquina</p><input name="multiplosmaquinas" onkeypress="return validateQty(event);" type="text " id="multiplosmaquinas" value="'.$campojogo->maxmaquina.'"></td>
              <td><p>Nº de Máquinas</p><input name="numeromaquinas" type="text" id="numeromaquinas" onkeypress="return validateQty(event);" value="'.$campojogo->numaquina.'"></td>
            </tr>
            <tr>
              <td><p>Integrantes por equipe</p><input name="integrantesequipe" type="text" id="integrantesequipe" onkeypress="return validateQty(event);" value="'.$campojogo->Equipe.'""></td>
              <td><p>Parâmetro Funcionários</p><input name="paramefunc" type="text" id="paramefunc" value="'.$campojogo->func_par.'"></td>
            </tr>
            <tr>
              <td><p>Parâmetro Administradores</p><input name="parameadm" type="text" onkeypress="return isNumberKey(event)" id="parameadm" value="'.$campojogo->adm_par.'"></td>
              <td><button name="alterar" value="editar" style="width: 100%; margin: 0;"> Alterar </button></td>
            </tr>
            <tr>
              <td><button name="exc" value="exc_jog" style="width: 83%; margin: 0;"> Excluir última jogada </button></td>
            </tr>          
          <table>
        </form>
      </div>
      <!-- DIV DE TEXTO USUÁRIO -->
    
          ';

        ?>
    </div>
    <!-- FIM CORPO DA PÁGINA -->
    
  </body>
  <?php

    if(($pi==1)||($pc==1)||($pd==1)||($j==1)||($c==1)||($d==1)||($m==1)||($f==1)||($n==1))
    {
     echo '<script language="javascript">';
     echo 'alert("'.$mensagem.'")';
     echo '</script>';
    }
    if ($ok==1)
    {
      echo "<script language='javascript'>
        if(!alert('Informações salvas com sucesso!')){window.location.href='admin.php';}
      </script>";
    }
  ?>
  <script>
    jQuery(function($){
      $("#datainicio").mask("99/99/9999");
      $("#datadecisao").mask("99/99/9999");
      $("#prazodecadastro").mask("99/99/9999");
    });
  </script>
  <script>
    function validateQty(event) {
        var key = window.event ? event.keyCode : event.which;
    if (event.keyCode == 8 || event.keyCode == 46
     || event.keyCode == 37 || event.keyCode == 39) {
        return true;
    }
    else if ( key < 48 || key > 57 ) {
        return false;
    }
    else return true;
    };
  </script>
  <SCRIPT language=Javascript>
         <!--
         function isNumberKey(evt)
         {
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode != 46 && charCode > 31 
              && (charCode < 48 || charCode > 57))
               return false;

            return true;
         }
         //-->
  </SCRIPT>
</html>