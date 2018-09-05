<!-- MENU -->
<ul id="menuusuario">
  <a href="#" style="float: left; padding: 0; margin: 0; margin-left: 5%; margin-top: 0.3rem;"><img class="logo" src="/imgs/chart.png" style="width: 2.5rem; height: 2.5rem;"></a>
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

  <p class="nome">
    <?php  
      echo $_SESSION['usuarioNome']; // NOME DO USUÁRIO É MOSTRADO NA BARRA PRINCIPAL (AO LADO DA FOTO)
    ?>
  </p>
</ul>
<!-- MENU -->