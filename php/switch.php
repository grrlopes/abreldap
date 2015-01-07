<?php
require_once 'conexao.php';
include_once 'lmntlm.php';
$troca = filter_input(INPUT_POST,'etc');
$login = filter_input(INPUT_POST,'login');
$novasenha = filter_input(INPUT_POST,'novasenha');
$grupo = filter_input(INPUT_POST,'grupo');
$dn = "cn=$grupo,$arvore1";
$mulata['memberuid'] = "$login";

switch ("$troca"){
    case 'bloq':
$resultado1 = ldap_search($ldapconexao,$arvore,"(uid=*)");
$dados1 = ldap_get_entries($ldapconexao, $resultado1);
if(empty($login)){
    exit;}
if($ldapconexao){
    $info["uid"] = "$login";
    $info["sambaAcctFlags"]='[DU]';
    $dn="uid={$login},ou=Users,dc=portalsigres,dc=com";
    $inserir = @ldap_modify($ldapconexao,$dn,$info);
    if($inserir){
    print 'Bloqueado com sucesso';}
elseif ($inserir==false) {
    print 'Usuário não encontrado';
}
            ldap_close($ldapconexao);
    }else {
    print "Nao pode se conecta!!!";
}
        break;
        
    case 'senha':

$vcrypto = pack("CCCC", mt_rand(), mt_rand(), mt_rand(), mt_rand());
$hash = "{SSHA}" . base64_encode(pack("H*", sha1($novasenha . $vcrypto)) . $vcrypto);
$info["userPassword"] = "$hash";
$info["sambaLMPassword"] = lmhash($novasenha);
$info["sambaNTPassword"] = ntlmhash($novasenha);
$info["sambaAcctFlags"] = '[U]';
if(empty($login)){
    exit;}
if ($ldapconexao) {
        $kk = "uid=$login,ou=Users,dc=portalsigres,dc=com";
        $tribo = "uid";
        $r = @ldap_compare($ldapconexao,$kk,$tribo,$login);
        if ($r === true){
            @ldap_mod_replace($ldapconexao,$kk,$info);
            print 'Senha alterada com sucesso';
        }else{
            print 'Usuário não encontrado';
        }
    ldap_close($ldapconexao);
    }
    break;
    
    case'dbloq':
        
$resultado1 = ldap_search($ldapconexao,$arvore,"(uid=*)");
$dados1 = ldap_get_entries($ldapconexao, $resultado1);
if(empty($login)){
    exit;}
if($ldapconexao){
    $info["uid"] = "$login";
    $info["sambaAcctFlags"]= '[U]';
    $dn="uid={$login},ou=Users,dc=portalsigres,dc=com";
    $inserir = @ldap_modify($ldapconexao,$dn,$info);
    if($inserir){
    print 'Usuário desbloqueado.';}
elseif ($inserir==false) {
    print 'Usuário não encontrado';
}
            ldap_close($ldapconexao);
    }else {
    print "Nao pode se conecta!!!";
}
    break;
    
    case 'excluir':

if ($ldapconexao){
    $r = ldap_bind($ldapconexao,"$usuario","$senha");
    $sr = ldap_search($ldapconexao,"$arvore","uid=".filter_input(INPUT_POST,'login'));
    $info = ldap_get_entries($ldapconexao,$sr);
    @$dn = $info[0]["dn"];
    if($info["count"] === 0){
        print "$login não foi encontrado!!!";
    }else{ 
        ldap_delete($ldapconexao,$dn);
        print "$login excluido com sucesso!!!";
        }
    }ldap_close($ldapconexao);
    
    break;
    
    case 'adiciona':
        
    if(@ldap_mod_add($ldapconexao,$dn,$mulata)){
    print "$login adicionado no grupo: $grupo";
    }else{
    print "Login ou grupo não encontrado.";
    }       
        break;
        
    case 'remove':
        
    if(@ldap_mod_del($ldapconexao,$dn,$mulata)){
    print "$login removido do grupo: $grupo";
    }else{
    print "Login ou grupo não encontrado.";
    }
        break;
        
    case 'Enviarsub':
    echo "Usuário: "."$login"."<br />";
    echo " "."<br />";
    $filter ="(cn=*)";
    $result=ldap_search($ldapconexao,$arvore1,$filter);
    $info = ldap_get_entries($ldapconexao,$result);
    foreach ($info as $n){
        $vgrupos = $n["cn"][0];
    $resultado1 = ldap_search($ldapconexao,$arvore,"(cn=$vgrupos)") or die
            ("Erro ao pesquisar ".ldap_error($ldapconexao));
    $dados1 = ldap_get_entries($ldapconexao, $resultado1);
    @$conta = $dados1[0]['memberuid']["count"];
    if(!empty($conta)){
    for ($i=0; $i<$conta; $i++){
                if(!empty($dados1[0]['memberuid'][$i])){
                   $laco = $dados1[0]['memberuid'][$i];
           $x = strpos($laco, $login); 
           if( $x == $login ){
               if(strlen($laco) == strlen($login)){
               echo "$vgrupos"."<br />";
               }
          }
           }
            }
      }
    }
      break;  
}
