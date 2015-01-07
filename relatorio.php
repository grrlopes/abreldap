<?php

require_once 'php/conexao.php';

    $resultado1 = ldap_search($ldapconexao,$arvore, "(uid=*)") or 
                die ("Erro ao pesquisar ".ldap_error($ldapconexao));
    $dados1 = ldap_get_entries($ldapconexao, $resultado1);
    echo "login:nome:sobrenome:email"."<br>";
    echo "<br>";
            for ($i=0; $i<$dados1["count"]; $i++){
            if(!empty($dados1[$i]["uid"][0])){

     echo $dados1[$i]["uid"][0].":";
            }
    if(empty($dados1[$i]["givenname"][0])){
        echo "vazio".":";
        } else{ 
     echo $dados1[$i]["givenname"][0].":";
         }
         
    if(empty($dados1[$i]["sn"][0])){
        echo "vazio".":";
        } else{ 
     echo $dados1[$i]["sn"][0].":";
         }
         

    if(empty($dados1[$i]["mail"][0])){
        echo "vazio"."<br />";
        } else{ 
     echo $dados1[$i]["mail"][0]."<br />";
         }
         

         
    }