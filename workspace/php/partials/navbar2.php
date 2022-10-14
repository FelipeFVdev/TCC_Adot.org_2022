<?php
    $has_session = false;
    $user = null;
    if(isset($_SESSION["id"]) == true){
        $has_session = true;
        $user = getUserLogged($_SESSION["id"]);
    }
    
    
?>

<<<<<<< HEAD
<div class="header">  
    <nav class="navbar navbar-light mb-3" style="background-color: #4C79D5;">                
        <div class="container-fluid" id="header_conteainer">
            <a href="pag_inicial.php"><img src="../img/Novo_Projeto.png" id="logo" style="width: 100px;"/></a>
            <div class="headerTitle"></div>
=======
<div class="header">            
    <nav class="navbar navbar-light mb-3" style="background-color: #4C79D5;">                
        <div class="container-fluid" id="header_conteainer">
            <a href="#"><img src="" id="logo" /></a>
            <div class="headerTitle"><h2>Adot.org</h2></div>
>>>>>>> d0c92b6b452468fcc630a1a6c5ff66a84bd36b57

                <!-- Barra de Consultas -->
                <form action="pag_exibicao_animais.php" method="GET">
                                <input id="search" type="text" placeholder="Pesquise um animal" name="filtro" style="height:30px; width:100%">
                                <input id="submit" type="submit" value="Search" style="display: none; width: 0%;">
                </form>

                <div class="menu">
                    <nav class="navbar navbar-expand-lg navbar-dark m-3" style="background-color: #4C79D5;">
                        <div class="container-fluid text-xs-center">
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                                data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" 
                                aria-expanded="false" aria-label="Toggle navigation">

                                <span class="navbar-toggler-icon"></span>
                                </button>

                            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                                <div class="navbar-nav" id="itensMenu">
                                    <a class="nav-link active" aria-current="page" href="pag_inicial.php">Início</a>

                                    <a class="nav-link active" aria-current="page" href="pag_instituicoes.php" name="#">Instituições</a>

                                    <a class="nav-link active" aria-current="page" href="pag_exibicao_animais.php">Animais</a>

                                </div>
                            </div>

                            
                            
                        </div>
                    </nav>
                </div>

                <?php
                    if($has_session === false){
                        echo "<button type='button' class='btn' id='btnFazerLogin' style='background-color: #66C4A9; color: white;' onclick='redirecionaLogin();'>Logar</button>";
                    }else{                       
                        $nome = explode(" ", $user["nome"])[0];
                        echo "<div class='dropdown'>";
                        echo "<button class='btn text-white dropdown-toggle' type='button' id='dropdownMenuButton1' data-bs-toggle='dropdown' aria-expanded='false' style='background-color:  #66C4A9;'>Olá, $nome</button>";
                        echo  "<ul class='dropdown-menu' aria-labelledby='dropdownMenuButton1'>";
                        if($user["tipo"] == 'USUARIO'){
                            echo "<li><a class='dropdown-item' href='pag_usuario.php'>Meus dados</a></li>";
                            echo "<li><a class='dropdown-item' href='sair.php'>Sair</a></li>";
                        }else{
                            echo "<li><a class='dropdown-item' href='pag_instituicao.php'>Meus dados</a></li>";
                            echo "<li><a class='dropdown-item' href='sair.php'>Sair</a></li>";
                        }
                        
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