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
    
?>
<html>

  <head>

    <!-- Título -->
    <title>Mercado Virtual</title>
    <!-- Título -->

    <!-- LIGANDO AO CSS -->
    <link rel="stylesheet" href="/css/usua.css">
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="/js/base.js"></script>
    <script type="text/javascript" src="/js/jquery.maskMoney.js" ></script>
    
    <!-- LIGANDO AO CSS -->
    

  </head>

  <body>
    <!-- CORPO DA PÁGINA -->
    <div id="wrap">

      <!-- MENU -->
      <ul id="menuusuario">
        
        <a href="index.php" style="float: left; padding: 0; margin: 0; margin-left: 5%; margin-top: 0.3rem;"><img class="logo" src="/imgs/logo.png" style="width: 2.5rem; height: 2.5rem;"></a>
        <input name="busca" type="text" id="busca" placeholder="Busque Mercado Virtual">
        <div tabindex="0" class="submenu" >
            <img class="logo" src="/imgs/user.png" style="width: 2.2rem; height: 2.3rem;">
            <form method="post" action=""> <!-- // FORM PARA VER SE O USUÁRIO QUER SAIR -->
              <ul class="submenu-content">
                <li><a href="editar.php">Editar usuário</a></li>
                <li><a href="informacoes.php">Informações</a></li>
                <li><a href="novaequipe.php">Novo equipe</a></li> 
                <li><a><button style="" name="sair" value="sair">Sair</button></a></li>
              </ul>
            </form>
        </div>
        <!-- DIV -->

        <p class="nome">
          <?php  
            echo $_SESSION['usuarioNome']; // NOME DO USUÁRIO É MOSTRADO NA BARRA PRINCIPAL (AO LADO DA FOTO)
          ?>
        </p>
      </ul>
      <!-- MENU -->

      <!-- DIV DE MENU LATERAL -->
      <div id="menulateral">
        <!-- BARRA -->
          <!--<hr width="1" align="left" style="margin-left: 100%; height: 100%!important; margin-top: -0.1px; position: absolute;">-->
        <!-- BARRA -->
        <ul>
          <li><a href="tomardecisao.php">Tomar Decisão</a></li>
          <li><a href="equipe.php">Equipe</a></li>
          <li><a href="ranking.php">Ranking</a></li>
          <li><a href="indices.php">Índices</a></li>
          <li><a href="relatorios.php">Relatórios</a></li>
          <li><a href="/downloads.html">Downloads</a></li>
          <li><a href="/saladeestudo.html">Sala de Estudos</a></li>
        </ul>
        
      </div>
      <!-- DIV DE MENU LATERAL -->

      <div class="textousuario" style="padding-bottom: 10rem;">
        <form method="post">
          
        
        </form>
      </div>
      <!-- FIM DA DIV TEXTO USUÁRIO -->


      
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