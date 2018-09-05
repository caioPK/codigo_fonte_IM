<!doctype HTML>
<html lang="en-gb">

  <head>

    <?php include 'includes/head.php'; ?>

  </head>

  <body style="height: 450px;">
    <!-- CORPO DA PÁGINA -->
    <div id="wrap" style="height: 400px;">

      <?php include 'includes/header.php' ?>

      <!-- BLOCO1 -->
      <div style="height: 430px; margin-bottom: 20%">
        <div class="formcadastro" style="margin-left: 37%;">
          <form method="post" action="cadastrousuario.php">
            <table>
              <tr>
                <td>
                  <h3>Entre no jogo</h3>
                </td>
              </tr>
              <tr>
                <td>
                  <p>Para efetuar o cadastro de um jogador, o nome da empresa deve estar previamente definido. Informações necessárias: CPF, RG, endereço, telefone, nome de usuário, senha, entre outros. Não é permitido o cadastro de um mesmo usuário em dois jogos simultaneamente ou em duas equipes de um mesmo jogo.</p>
                </td>
              </tr>
              <tr>
                <td>
                  <button name="cadastrar" type="submit" id="cadastrar" style="width: 90%;" value="novousuario">Cadastrar</button>
                </td>
              </tr>
            </table>
          </form>
        </div>
      </div>

      

     <?php include 'includes/footer.php' ?>

    </div>
    <!-- FIM DO CORPO PÁGINA -->
  </body>

</html>