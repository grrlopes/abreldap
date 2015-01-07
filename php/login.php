<?php
session_start();
require'conexao.php';
$login = filter_input(INPUT_POST,'login');
$senha1 = filter_input(INPUT_POST,'senha');
$usuario1 ="uid=$login,ou=Users,dc=portalsigres,dc=com";
$resultado = ldap_search($ldapconexao,$arvore,"(cn=Infraestrutura)") or die 
        ("Erro ao pesquisar ".ldap_error($ldapconexao));
$dados1 = ldap_get_entries($ldapconexao, $resultado);
$conta=$dados1[0]['memberuid']["count"];
for ($i=0; $i<$conta; $i++){ 
      $nome=substr($dados1[0]['memberuid'][$i], 0, strpos($dados1[0]['memberuid'][$i], ','));
        if ($dados1[0]['memberuid'][$i] != null){
        $laco[$i] = $dados1[0]['memberuid'][$i]."<br />";
}
   }
   $rottweiler = implode('',$laco);
   $hh = strpos($rottweiler,$login);
   if(@ldap_bind($ldapconexao,$usuario1,$senha1)){
   if($hh === false){
       print 'permissao';
   }else{
       print 'acessivel';
       $_SESSION['login'] = $login;
       $_SESSION['senha'] = $senha1;
       //header("location: ../usuarios.php");
   }
}else{
    print 'falha';
}