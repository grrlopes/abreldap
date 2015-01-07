<?php
require_once'php/conexao.php';
/*
$filter ="(cn=*)";
$result=ldap_search($ldapconexao,$arvore1,$filter);
$info = ldap_get_entries($ldapconexao,$result);
$nome11 = "marcos.relvas";
foreach ($info as $n){
    $eu = $n["cn"][0];
$resultado1 = ldap_search($ldapconexao,$arvore,"(cn=$eu)") or die
        ("Erro ao pesquisar ".ldap_error($ldapconexao));
$dados1 = ldap_get_entries($ldapconexao, $resultado1);
@$conta = $dados1[0]['memberuid']["count"];
if(!empty($conta)){
for ($i=0; $i<$conta; $i++){
            if (!empty($dados1[0]['memberuid'][$i])){
               $laco[$i] = $dados1[0]['memberuid'][$i]."<br />";
       $x = strpos($laco[$i], $nome11);
       if( $x == $nome11 ){
            echo "$nome11".' - '."$eu"."<br />";
      }
       }
        }
  }
}
 * 
 */
print "<hr>";

$eu = "Infraestrutura";
$resultado1 = ldap_search($ldapconexao,$arvore, "(cn=$eu)") or die 
        ("Erro ao pesquisar ".ldap_error($ldapconexao));
$dados1 = ldap_get_entries($ldapconexao, $resultado1);
$conta=$dados1[0]['memberuid']["count"];
for ($i=0; $i<$conta; $i++){
            if ($dados1[0]['memberuid'][$i] != null) {
                $laco[$i] = $dados1[0]['memberuid'][$i]."<br />";
        }
            }
   foreach ($laco as $n) {
        echo "$n";

    }