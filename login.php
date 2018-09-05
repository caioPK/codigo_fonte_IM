<!doctype HTML>
<html lang="en-gb">

  <head>
    <?php include 'includes/head.php'; ?>
  </head>

  <body style="height: 400px;">
    <!-- CORPO DA PÁGINA -->
    <div id="wrap">

      <?php include 'includes/header.php' ?>

      <!-- BLOCO1 -->
      <div style="margin-top: 20%; height: 414px;">
        
        <!-- FORM LOGIN -->
        <div id="login-form" style="width: 20rem;">

          <form name="form1" method="post" action="valida.php">
            <table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td>
                    <h1>Acesse</h1>
                    
                      <input name="usuario" type="text" id="usuario" placeholder="Usuário">
                      <input name="senha" type="password" id="senha" placeholder="Senha">
                      <button name="Entrar" id="Entrar" type="submit" value="Entrar">Entrar</button>
                      <p id="err" 
                        <?php 
                          $erro = $_GET['erro'];
                          if($erro  == 1)
                          {                          
                            echo '';
                          }
                          else
                          {
                            echo ' hidden ';
                          }
                        ?>

                        style="color: red; margin-top: 1rem;">* Por favor, digite os dados corretamente. </p>
                </td>
              </tr>
            </table>
          </form>
          
        </div>
        <!-- FORM LOGIN -->


        <h3 style="color: red; text-align: center; margin: 0; padding: 0;">
          
        </h3>

      </div>
      <!-- BLOCO1 -->

      <?php include 'includes/footer.php'; ?>
      

    </div>
    <!-- CORPO DA PÁGINA -->


  </body>

  
</html>
