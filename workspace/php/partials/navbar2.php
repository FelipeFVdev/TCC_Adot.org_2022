<div class="header">            
    <nav class="navbar navbar-light mb-3" style="background-color: #1a6f3a;">                
        <div class="container-fluid" id="header_conteainer">
            <a href="#"><img src="img/" id="logo" /></a>
            <div class="headerTitle"><h2>Adot.org</h2></div>

                <!-- Barra de Consultas -->
                <div class="menu">
                    <nav class="navbar navbar-expand-lg navbar-dark m-3" style="background-color: #98112e;">
                        <div class="container-fluid text-xs-center">
                            <!-- <a class="navbar-brand" href="#">Menu</a> -->
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                                data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" 
                                aria-expanded="false" aria-label="Toggle navigation">

                                <span class="navbar-toggler-icon"></span>
                                </button>

                            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                                <div class="navbar-nav" id="itensMenu">
                                    <a class="nav-link active" aria-current="page" href="pag_inicial.php">Página Inicial</a>

                                    <a class="nav-link active" aria-current="page" href="pag_instituicao.php" name="#">Página Instituições</a>

                                    <a class="nav-link active" aria-current="page" href="#">Página Animais</a>

                                </div>
                            </div>
                        </div>
                    </nav>
                </div>

                <?php
                    if(isset($_SESSION["nome_usuario"])==false){
                        echo "<button type='button' class='btn' id='btnFazerLogin' style='background-color: #fecc68; color: white;' onclick='redirecionaLogin();'>Logar</button>";
                    }else{                        
                        $nome_usuario = explode(" ", $_SESSION["nome_usuario"])[0];
                        echo "<div class='dropdown'>";
                        echo "<button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton1' data-bs-toggle='dropdown' aria-expanded='false' style='background-color: #fecc68;'>Olá, $nome_usuario</button>";
                        echo  "<ul class='dropdown-menu' aria-labelledby='dropdownMenuButton1'>";
                        echo "<li><a class='dropdown-item' href='pag_usuario.php'>Meus dados</a></li>";
                        echo "<li><a class='dropdown-item' href='sair.php'>Sair</a></li>";
                        echo "</ul></div>";
                    }
                ?>
        </div>                
    </nav>          
</div>

<script lang='javascript'>
    function redirecionaLogin(){
        window.location.href='pag_login.php';
    }
</script>