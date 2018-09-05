<?php
/**
* Sistema de segurança com acesso restrito
*
* Usado para restringir o acesso de certas páginas do seu site
*
* @author Thiago Belem <contato@thiagobelem.net>
* @link http://thiagobelem.net/
*
* @version 1.0
* @package SistemaSeguranca
*/
//  Configurações do Script
// ==============================
$_SG['conectaServidor'] = true;    // Abre uma conexão com o servidor MySQL?
$_SG['abreSessao'] = true;         // Inicia a sessão com um session_start()?
$_SG['caseSensitive'] = false;     // Usar case-sensitive? Onde 'thiago' é diferente de 'THIAGO'
$_SG['validaSempre'] = true;       // Deseja validar o usuário e a senha a cada carregamento de página?
// Evita que, ao mudar os dados do usuário no banco de dado o mesmo contiue logado.
$_SG['servidor'] = 'dbmy0005.whservidor.com';    // Servidor MySQL
$_SG['usuario'] = 'mercadovirt';          // Usuário MySQL
$_SG['senha'] = '36lcwRzg';                // Senha MySQL
$_SG['banco'] = 'mercadovirt';            // Banco de dados MySQL
$_SG['paginaLogin'] = '../login.php'; // Página de login
$_SG['tabela'] = 'usuarios';       // Nome da tabela onde os usuários são salvos
$erro=0;

// ==============================
// ======================================
//   ~ Não edite a partir deste ponto ~
// ======================================
// Verifica se precisa fazer a conexão com o MySQL
if ($_SG['conectaServidor'] == true) {
  $_SG['link'] = mysqli_connect($_SG['servidor'], $_SG['usuario'], $_SG['senha']) or die("MySQL: Não foi possível conectar-se ao servidor [".$_SG['servidor']."].");

  mysqli_select_db($_SG['link'], $_SG['banco']) or die("MySQL: Não foi possível conectar-se ao servidor [".$_SG['servidor']."].");
}
// Verifica se precisa iniciar a sessão
if ($_SG['abreSessao'] == true)
  session_start();
/**
* Função que valida um usuário e senha
*
* @param string $usuario - O usuário a ser validado
* @param string $senha - A senha a ser validada
*
* @return bool - Se o usuário foi validado ou não (true/false)
*/
function validaUsuario($usuario, $senha) {
  global $_SG;
  // Usa a função addslashes para escapar as aspas
  // Monta uma consulta SQL (query) para procurar um usuário
  $usuarionaoexiste = 0;
  $usuario=strtoupper($usuario);
  $servername = "dbmy0005.whservidor.com";
  $username = "mercadovirt";
  $password = "36lcwRzg";
  $con = mysqli_connect($servername, $username, $password, "mercadovirt");
  $sql_select = "SELECT NomeUsuario, CodJogador, Tipo, Senha FROM usuarios WHERE usuarios.NomeUsuario='$usuario' AND usuarios.Senha=old_password('$senha')";
  $resultado = mysqli_query($con, $sql_select);
  $rows = mysqli_num_rows($resultado);
  // Verifica se encontrou algum registro
  if ($rows == 0) {

    // Nenhum registro foi encontrado => o usuário é inválido
    $erro = 1;
  } else {
    $campo = mysqli_fetch_object($resultado);
    $_SESSION['usuarioNome'] = $campo->NomeUsuario;
    $_SESSION['usuarioLogin'] = $campo->NomeUsuario;
    $_Session['codjogo'] =  $_Session['codjogo'];
    //print $_SESSION['usuarioLogin'];
    //$_SESSION['usuarioSenha'] = $campo->Senha;
    $_SESSION['usuarioSenha'] = $senha;
    $_SESSION['usuarioTipo'] = $campo->Tipo;
    //print $_SESSION['usuarioTipo'];
    $_SESSION['usuarioID'] = $campo->CodJogador;
    return $_SESSION['usuarioTipo'];
   
    
  }
}
/**
* Função que protege uma página
*/
function protegePagina() 
{
  global $_SG;
  if (!isset($_SESSION['usuarioID']) OR !isset($_SESSION['usuarioNome'])) 
  {
    // Não há usuário logado, manda pra página de login
    //print "entrou primeiro";

    expulsaVisitante(1);
   
  } 
  else 
  {
    // Há usuário logado, verifica se precisa validar o login novamente
    if ($_SG['validaSempre'] == true) 
    {
      //print "valida sempre: ok \n";
      $_SESSION['usuarioLogin'] = strtolower($_SESSION['usuarioLogin']);
      //print $_SESSION['usuarioLogin'];
      // Verifica se os dados salvos na sessão batem com os dados do banco de dados
      if (!validaUsuario($_SESSION['usuarioLogin'], $_SESSION['usuarioSenha'])) 
      {
        //print "entrou no expulsa usuário";
        // Os dados não batem, manda pra tela de login
        expulsaVisitante(1);
        
      }
    }
  }
    // Há usuário logado, verifica se precisa validar o login novamente
}
/**
* Função para expulsar um visitante
*/
function expulsaVisitante($erro) {
  global $_SG;
  // Remove as variáveis da sessão (caso elas existam)
  unset($_SESSION['usuarioID'], $_SESSION['usuarioNome'], $_SESSION['usuarioLogin'], $_SESSION['usuarioSenha']);
  // Manda pra tela de login
  if($erro==1)
  {
    header("Location: ".$_SG['paginaLogin']."?erro=1");
  }
  elseif($erro==0)
  {
    header("Location: ".$_SG['paginaLogin']);
  }
  
}