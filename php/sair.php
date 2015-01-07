
<?php
session_start();
    if(!isset($_SESSION['login']) && !isset($_SESSION['senha'])){
        header("Location:../index.php");
exit;
    }else{
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        header("Location:../index.php");
} 
