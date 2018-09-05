<?php
  // Inclui o arquivo com o sistema de segurança
  require_once("seguranca.php");
  // Verifica se um formulário foi enviado
  if ($_SERVER['REQUEST_METHOD'] == 'POST') 
  {

    // Salva duas variáveis com o que foi digitado no formulário
    // Detalhe: faz uma verificação com isset() pra saber se o campo foi preenchido
    $usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
    $senha = (isset($_POST['senha'])) ? $_POST['senha'] : '';
    // Utiliza uma função criada no seguranca.php pra validar os dados digitados
    if (validaUsuario($usuario, $senha) == 1) {
      // O usuário e a senha digitados foram validados, manda pra página interna
      header("Location: user/index.php");
    } 
    elseif (validaUsuario($usuario, $senha) == 2)
    {
      header("Location: admin/admin.php");
      // O usuário e/ou a senha são inválidos, manda de volta pro form de login
      // Para alterar o endereço da página de login, verifique o arquivo seguranca.php
      
    }
    else
    {
      expulsaVisitante(1);
      return false;
    }
  }