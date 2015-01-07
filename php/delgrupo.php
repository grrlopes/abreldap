<?php
    require_once'conexao.php';    
$grupo = filter_input(INPUT_POST,'grupo');
$resultado1 = ldap_search($ldapconexao,$arvore1,"(cn=*)");
$dados1 = ldap_get_entries($ldapconexao, $resultado1);
    $dn="cn=$grupo,ou=Groups,dc=portalsigres,dc=com";
    $excluir = ldap_delete($ldapconexao,$dn);
    if($excluir){
    print 'Grupo:'.' '."$grupo".' '.'Excluído com sucesso!!!';}
elseif($excluir==false){
    print 'Erro ao excluir!!!';
}
        ldap_close($ldapconexao);