<?php
require_once 'conexao.php';
$resultado1 = ldap_search($ldapconexao,$arvore1,"(cn=*)");
$dados1 = ldap_get_entries($ldapconexao, $resultado1);
foreach($dados1 as $n){}
$grupo = filter_input(INPUT_POST,'grupo');
if(empty($grupo)){
    exit;
} 
$info['objectClass'][0] = "top";
$info['objectClass'][1] = "posixGroup";
$info['cn'] = "$grupo";
$info['gidnumber'] = $n['gidnumber'][0]+1;
    $dn="cn=$grupo,ou=Groups,dc=portalsigres,dc=com";
    $inserir = ldap_add($ldapconexao,$dn,$info);
    if($inserir){
    print 'Grupo:'.' '."$grupo".' '.'cadastrado com sucesso!!!';}
elseif($inserir==false){
    print 'Erro ao cadastrar!!!';
}
        ldap_close($ldapconexao);
