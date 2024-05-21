<html>
    <head>
    <title>Chassis Shop Login</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">  
      <script src="js/jquery.min.js"></script>
      <script src="js/bootstrap.min.js" type="text/javascript"></script>
      <script src="js/jquery.mask.min.js" type="text/javascript"></script>
      <script src="js/bootstrap-notify.min.js" type="text/javascript"></script>
      <link rel="stylesheet" type="text/css" href="style.css">


      <script type="text/javascript">
    $(document).ready(function(){
      $('#cpf').mask('000.000.000-00');
    });
    </script>


  </head>

  <body>

  <?php
  session_start();?>
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="index.php"><h3>Chassis Shop</h3></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
          </li>
              <a class="nav-link" href="index.php">Home
              <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="loginSEMAJAX.php">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="carrinho.php">Carrinho</a>
            </li>
        
            
          </ul>
        </div>
      </div>
    </nav>

    <div class="container h-80">
    <div class="row align-items-center h-100">
        <div class="col-3 mx-auto">
            <div class="text-center">

                <img id="profile-img" class="rounded-circle profile-img-card" src="https://i.imgur.com/6b6psnA.png" />
                <p id="profile-name" class="profile-name-card"></p>
                <form action="realizarLoginSEMAJAX.php" method="post">
                <input type="login" name="cpf" id="cpf" class="form-control form-group" placeholder="cpf" required autofocus>
                <input type="password" name="senha" id="inputPassword" class="form-control form-group" placeholder="password" required autofocus>

                <?php
            

            if(isset($_POST["cpf"])){
              $acesso = array('cpf' => $_POST['cpf'],'senha'=> $_POST['senha']);
                if(isset($_SESSION["login"])){
                  
                  $login = $_SESSION["login"];
                  array_push($login, $acesso);
                }else{
                $login =  array($acesso);

              }
              $_SESSION["login"] = $login;

            }
            
          ?>

        <a class = "float-right text-light bg-dark"href="novocadastro.php">Criar conta</a>
          <button class="btn btn-lg btn-primary btn-block btn-signin " type="submit">Entrar</button>
            </form><!-- /form -->

                        
            <?php
              if(isset($_POST["msg"])){

               // $msg = $_SESSION['msg'];
                echo "<div class='alert alert-danger' role='alert'>CPF ou senha incorretos!</div>";
              }
            ?>

            </div>
        </div>
      </div>
    </div>

    

      



  <!--
      <div class="row kpx_row-sm-offset-3 kpx_loginOr">
        <div class="col-xs-12 col-sm-6">
          <hr class="kpx_hrOr">
          <span class="kpx_spanOr">or</span>
        </div>
      </div>

      <div class="row kpx_row-sm-offset-3">
        <div class="col-xs-12 col-sm-6">	
            <form class="kpx_loginForm" action="" autocomplete="off" method="POST">
            <div class="input-group">
              <span class="input-group-addon"><span class="fa fa-user"></span></span>
              <input type="text" class="form-control" name="username" placeholder="Username">
            </div>
                      <hr />
                      
            <div class="input-group">
              <span class="input-group-addon"><span class="fa fa-key"></span></span>
              <input  type="password" class="form-control" name="password" placeholder="Password">
            </div>
                      <span class="tag tag-danger">Password Error!</span> | <span class="tag tag-success">Login success!</span> | <span class="tag tag-warning">Some of password must not be empty!</span>
                      <hr />
            <button class="btn btn-lg btn-outline-primary btn-block" type="submit"><i class="fa fa-sign-in"></i> Login</button>
          </form>
        </div>
        </div>
      <div class="row kpx_row-sm-offset-3">
        <div class="col-xs-12 col-sm-3">
              <p></p>
          <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" value="remember-me">
                            <span class="custom-control-indicator"></span>
                            <span class="custom-control-description">Remember me!</span>
                          </label>
                          </p>

        </div>
        <div class="col-xs-12 col-sm-3">
          <p class="kpx_forgotPwd">
            <a href="#">Forgot password?</a>
          </p>
        </div>
  -->
  </body>
</html>