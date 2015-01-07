<html>
<?php
    session_start();
    $log = $_SESSION['login'];
    if(!isset($_SESSION['login']) and !isset($_SESSION['senha'])){
        header("Location:index.php");
exit; }
?>
<head>
<meta charset="utf-8" />
<link rel="stylesheet" href="css/bootstrap.css" media="screen" />
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<link rel="stylesheet" type="text/css" href="css/ldapaum.css" /> 
<script src="js/ldapaum.js"></script>
</head>
<body>    
<div id="menu1" class="container">
<nav class="navbar navbar-fixed-top">
    <div id="menu2">
        <ul>
            <li><img src="img/home.png"> <a href="#1">Home</a></li>
        <!--li><a href="#">Alterar</a>
            <ul>
                <li><a href="#">Grupo</a></li>
                <li><a href="#">Senha</a></li>
                <li><a href="#">Acesso</a></li>
            </ul>
        </li-->
        <li><a href="#">Pesquisa</a> <img src="img/pesquisa.png">
            <ul>
                <li><a href="grupo.php">Grupo</a></li>
                <li><a href="usuarios.php">Usuários</a></li>
            </ul>
        </li>
        <li><a href="#5">Sair</a> <img src="img/logout.png"></li>
        <li><a href="#6">Logado: <?php print "$log" ?></a></li>
      </ul>
    </div>
    
    <form id="menu3" class="form-search">    
    <div class="input-append">
    <input type="text" class="span2 search-query">
    </form>
    <select>
  <option>Tudo</option>
  <option>Login</option>
  <option>Nome</option>
  <option>Email</option>
    </select>
    </div>      
</nav>

</div>
</body>
</html>
