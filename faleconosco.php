<?php

?>

<!doctype HTML>
<html lang="en-gb">
	<head>
    <?php include 'includes/head.php'; ?>
	</head>
	<body style="height: 450px;">
    <!-- CORPO DA PÁGINA -->
		<div id="wrap">

      <?php include 'includes/header.php'; ?>

      <div class="faleconosco">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7380.281759779109!2d-49.03326999112455!3d-22.348308799999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94bf67968bf3ba79%3A0x9c23cf8b2f7c7ea7!2sUnesp+Universidade+Estadual+Paulista+J%C3%BAlio+de+Mesquita+Filho!5e0!3m2!1spt-BR!2sbr!4v1458745469986" width="500" height="530" frameborder="0" style="border:0" allowfullscreen></iframe>
        <div class="formularios" style="width: 30rem; margin-left: 3rem; display: inline-block; margin-top: 3rem;">
          <form name="form1" method="post" action="" enctype="text/plain">
            <table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td>
                    <p>Envie dúvidas, sugestões ou críticas ao administrador do sistema preenchendo os campos abaixo:</p>
                    <input name="nome" type="text" id="nome" placeholder="Nome" style="margin-bottom: 1%;">
                    <input name="email" type="email " id="email" placeholder="Email">
                    <textarea name="mensagem" id="mensagem" rows="10" cols="50" placeholder="Digite a sua mensagem aqui."></textarea>
                    <button name="send" type="submit" id="send" value="Send">Entrar</button>
                    <button name="reset" type="reset" value="Reset">Limpar</button>
                </td>
              </tr>
            </table>
          </form>
        </div>
        <!-- FORM PARA CONTATO -->
      </div>

      <?php include 'includes/footer.php'; ?>
		</div>
    <!-- FIM DO CORPO DA PÁGINA -->

	</body>
</html>