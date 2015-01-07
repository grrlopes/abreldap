<?php
include_once 'config.php';
$ldapconexao = ldap_connect("$host","$porta")
    or die('Erro ao conecta na base LDAP.');
ldap_set_option($ldapconexao, LDAP_OPT_SIZELIMIT, 10000);


if ($ldapconexao){
    $queryauth = @ldap_bind($ldapconexao,$usuario,$senha);
    if ($queryauth){
    } else {
        echo 'Falha na conexao.<br />'.@ldap_error($ldapconn);
    }
}
$resultado = @ldap_search($ldapconexao,$arvore, "(cn=*)") or die 
        ("Erro ao pesquisar.<br />".ldap_error($ldapconexao));
$dados = ldap_get_entries($ldapconexao, $resultado);