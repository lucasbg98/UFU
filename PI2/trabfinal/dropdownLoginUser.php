<div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav ml-auto">
        <li class="nav-item active"></li>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo "Bem vindo, ".$_SESSION['nome'];?>
                    </a>

                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item " href="logado.php">Home</a>
                        <a class="dropdown-item" href="#">Histórico de Compras</a>
                        <a class="dropdown-item" href="carrinho.php">Carrinho</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php">Sair</a>    
                    </div>
                </li> 
            </ul>
        </div>

