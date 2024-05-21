<?php

require_once(__DIR__ . "/../model/Usuario.php");
require_once(__DIR__ . "/../dao/UsuarioDAO.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

  if (array_key_exists("deslogar", $_GET)) {
    session_start();
    session_destroy();

    echo '<script>
			window.location.href="../index.html";
		</script>';
  }

  if (array_key_exists("destroySession", $_GET)) {
    session_start();
    session_destroy();
  }

  if (array_key_exists("getUserId", $_GET)) {
    session_start();

    echo $_SESSION["user_id"] ?? False;
  }

  if (array_key_exists("getUserName", $_GET)) {
    session_start();

    echo $_SESSION["user_name"] ?? False;
  }

  //verificar permissão do usuário
  if (array_key_exists("verifyPermission", $_GET)) {
    $param_user = $_GET["usuario"];
    $param_permissao = $_GET["permissao"];

    $indice_da_permissao = Usuario::converterPermissaoParaIndice($param_permissao);
    
    session_start();

    $user = $param_user == "session" ? UsuarioDAO::read(array("user_id", $_SESSION["user_id"])) : UsuarioDAO::read(array("user_id", $param_user));

    if ($user) {
      $res["retorno"] = $user->verificarPermissao($indice_da_permissao);
    } else {
      //usuário não encontrado
      $res["retorno"] = false;
      $res["error"] = "Usuário não encontrado!";
    }
    echo json_encode($res);
  }

  if (array_key_exists("pesquisadores", $_GET)) {
    require_once(__DIR__ . "../../dao/UsuarioDAO.php");
    require_once(__DIR__ . "../../assets/php/Perfis.php");
    require_once(__DIR__ . "../../data-contract/UsuarioDC.php");

    $pesquisadores = UsuarioDAO::read(array("findByProfile", Perfis::Pesquisador));

    $usuariosDC = array();

    if ($pesquisadores)
      foreach ($pesquisadores as $user)
        array_push($usuariosDC, new UsuarioDC($user));

    echo json_encode($usuariosDC);
  }

  if (array_key_exists("avaliadores", $_GET)) {
    require_once(__DIR__ . "../../dao/UsuarioDAO.php");
    require_once(__DIR__ . "../../assets/php/Perfis.php");
    require_once(__DIR__ . "../../data-contract/UsuarioDC.php");

    $avaliadores = UsuarioDAO::read(array("findByProfile", Perfis::Avaliador));
    $usuariosDC = array();

    if ($avaliadores)
      foreach ($avaliadores as $user)
        array_push($usuariosDC, new UsuarioDC($user));

    echo json_encode($usuariosDC);
  }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  if (array_key_exists("login", $_POST)) {
    $email = filter_input(INPUT_POST, "user_email", FILTER_SANITIZE_STRING);
    $senha = filter_input(INPUT_POST, "user_password", FILTER_SANITIZE_STRING);

    if ($email && $senha) {
      $user = (new UsuarioDAO())->read(array("login", $email, $senha));

      if ($user == NULL) {
        //usuário não encontrado
        $res["res"] = FALSE;
        $res["msg"] = "Usuário não encontrado!";
        echo json_encode($res);
      } else {
        //usuário encontrado
        session_start();

        $_SESSION["user_id"] = $user->getId();
        $_SESSION["user_name"] = $user->getNome();

        $res["res"] = "loginOk";
        $res["msg"] = "Usuário encontrado!";
        echo json_encode($res);
      }
    } else {
      $res["res"] = FALSE;
      $res["msg"] = "Campos com valores incorretos!";
      echo json_encode($res);
    }
  }
}
