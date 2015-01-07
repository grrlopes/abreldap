<?php
require 'conexao.php';
$eu = filter_input(INPUT_POST,'aa');
if(is_numeric($eu)){exit;}
print 'GRUPO:'.'&nbsp'."$eu"."<br/>"."<br/>";
$resultado1 = ldap_search($ldapconexao,$arvore, "(cn=$eu)") or die 
        ("Erro ao pesquisar ".ldap_error($ldapconexao));
$dados1 = ldap_get_entries($ldapconexao, $resultado1);
@$conta=$dados1[0]['memberuid']["count"];
if($conta == null){
    print 'Vazio'."<br/>";
    exit;}
for ($i=0; $i<$conta; $i++){
      $nome=substr($dados1[0]['memberuid'][$i], 0, strpos($dados1[0]['memberuid'][$i], ',')); 
            if ($dados1[0]['memberuid'][$i] != null) {
                $laco[$i] = $dados1[0]['memberuid'][$i]."<br />";
        }
            }
   foreach ($laco as $n) {
        echo "$n";

    }