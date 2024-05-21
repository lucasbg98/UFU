<html>
<head>
</head>
<body>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Bem vindo, <?php echo $_SESSION['nome'];?>
                </a>
                <div class="dropdown-menu active" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="logado.php">Home login</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="login.php?sair=ok">Sair</a>
                </div>
            </li>
        </ul>
    </div>
</body>