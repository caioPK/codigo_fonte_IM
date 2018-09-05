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
  $go = $_POST[criar];
  if($go != "")
  {
    $okjogo = 1;
  }
  include("func_novojogo.php");
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
        <h1>Criar jogo</h1>
        <form method="post">
          <table>
            <tr>
              <td><p>Nome do Jogo</p><input name="nome" type="text" id="nome" style="margin-right:17%;"></td>
              <td><p>Nº de integrantes por equipe</p><input name="numeroequipe" type="text " id="numeroequipe"></td>
            </tr>
            <tr>
              <td><p>Total de jogadas:</p><input name="totalrodadas" type="text" id="ttrodadas" style="margin-right:17%;" ></td>
              <td><p>Prazo de cadastro: (dd/mm/aaaa)</p><input name="prazocada" type="text " id="prazocada"></td>
            </tr>
            <tr>
              <td><p>Data de Início: (dd/mm/aaaa)</p><input name="datainicio" type="text" id="datainicio" style="margin-right:17%;" ></td>
              <td><p>Prazo de Decisão: (dd/mm/aaaa)</p><input name="prazodecisa" type="text " id="prazodecisa"></td>
            </tr>
            <tr>
              <td><p>Tamanho Inicial da demanda:</p><input name="inicialdemanda" type="text" id="inicialdemanda" style="margin-right:17%;"></td>
              <td><p>Tamanho Final da demanda:</p><input name="finaldemanda" type="text " id="finaldemanda"></td>
            </tr>
            <tr>
              <td><p>Capital Inicial (R$):</p><input name="capitalinicial" type="text" id="capitalinicial" style="margin-right:17%;"></td>
              <td><p>Máximo Empréstimo (R$):</p><input name="maximoemprestimo" type="text " id="maximoemprestimo"></td>
            </tr>
            <tr>
              <td><p>Multiplos Máquinas:</p><input name="multiplomaquinas" type="text" id="multiplomaquinas" style="margin-right:17%;"></td>
              <td><p>Nº de Máquinas:</p><input name="numeromaquina" type="text " id="numeromaquina" ></td>
            </tr>
            <tr>
              <td><p>Parâmetro Administradores:</p><input name="parameadm" type="text" id="parameadm" style="margin-right:17%;"></td>
              <td><p>Parâmetro Funcionarios:</p><input name="paramefunc" type="text " id="paramefunc"></td>
            </tr>

            <tr>
              <td>
                <p>Tamanho do mercado 1:</p><input name="tmp1" type="text" id="tmp1" style="width: 11rem; margin-right:17%;">
                <p>Tamanho do mercado 2:</p><input name="tmp2" type="text" id="tmp2" style="width: 11rem;">
                <p>Tamanho do mercado 3:</p><input name="tmp3" type="text" id="tmp3" style="width: 11rem; margin-right:17%;">
                <p>Tamanho do mercado 4:</p><input name="tmp4" type="text" id="tm4" style="width: 11rem;">
              </td>
              <td>
                <p>Porcentagem de variação produto 1: (05% <= x <= 30%)</p><input name="pvp1" type="text" id="pvp1" style="width: 11rem; margin-right:17%;">
                <p>Porcentagem de variação produto 2: (20% <= x <= 45%)</p><input name="pvp2" type="text" id="pvp2" style="width: 11rem;">
                <p>Porcentagem de variação produto 3: (25% <= x <= 55%)</p><input name="pvp3" type="text" id="pvp3" style="width: 11rem; margin-right:17%;">
                <p>Porcentagem de variação produto 4: (30% <= x <= 60%)</p><input name="pvp4" type="text" id="pvp4" style="width: 11rem;">
              </td>
            </tr>

            <tr>
              <td>
                <button name="criar" type="submit" id="criar" value="criar" style="width: 10rem;">Criar jogo</button>
                <button name="limpar" type="submit" id="limpar" value="limpar" style="width: 10rem; margin-bottom: 1rem; margin-left: 1rem;">Limpar</button>
              </td>  
            </tr>
          </table>
        </form>
      </div>
      <!-- DIV DE TEXTO USUÁRIO -->
    </div>
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
           $("#prazodecisa").mask("99/99/9999");
           $("#prazocada").mask("99/99/9999");
           
    });
  </script>

</html>