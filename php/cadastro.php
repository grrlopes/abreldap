<?php
require_once 'conexao.php';
include_once'lmntlm.php';

$resultado1 = ldap_search($ldapconexao,$arvore,"(uid=*)");
$dados1 = ldap_get_entries($ldapconexao, $resultado1);
foreach($dados1 as $n){}
$login = filter_input(INPUT_POST,'login');
$nome = filter_input(INPUT_POST,'nome');
$sobrenome = filter_input(INPUT_POST,'sobrenome');
$email = filter_input(INPUT_POST,'email');
$senha = filter_input(INPUT_POST,'senha');
$data = time();
$rita = pack("CCCC", mt_rand(), mt_rand(), mt_rand(), mt_rand());
$hash = "{SSHA}" . base64_encode(pack("H*", sha1($senha . $rita)) . $rita);
if(empty($login)){
    exit;
}
if($ldapconexao){
$info["objectClass"][0] = "top";
$info["objectClass"][1] = "person";
$info["objectClass"][2] = "organizationalPerson";
$info["objectClass"][3] = "posixAccount";
$info["objectClass"][4] = "shadowAccount";
$info["objectClass"][5] = "inetOrgPerson";
$info["objectClass"][6] = "sambaSamAccount";
$info["cn"] = "$nome".'.'."$sobrenome";
$info["sn"] = "$sobrenome"; 
$info["uid"] = "$login";
$info["mail"]="$email";
$info["uidNumber"] = $n['uidnumber'][0]+1;
$info["gidNumber"] = '513';
$info["homeDirectory"] = "/home";
$info["loginShell"] = "/bin/false";
$info["gecos"] = "Samba User";
$info["userPassword"] = "$hash";
$info["givenName"] = "$nome";
$info["sambaPwdLastSet"] = "$data";
$info["sambaLogonTime"] = '0';
$info["sambaLogoffTime"] = '2147483647';
$info["sambaKickoffTime"] = '2147483647';
$info["sambaPwdCanChange"] = '0';
$info["sambaPwdMustChange"] = ($data+90*24*60*60);
$info["displayName"] = "$nome".'.'."$sobrenome";
$info["sambaAcctFlags"] = '[U]';
$info["sambaSID"] = 'S-1-5-21-3168374933-1162097369-3857181538-'.($n['uidnumber'][0]+1);
$info["sambaLMPassword"] = lmhash($senha);
$info["sambaPrimaryGroupSID"] = 'S-1-5-21-3168374933-1162097369-3857181538-513';
$info["sambaNTPassword"] = ntlmhash($senha);
$info["shadowMax"] = '9999999';
    $dn="uid={$login},ou=Users,dc=portalsigres,dc=com";
    $inserir = ldap_add($ldapconexao,$dn,$info);
    if($inserir==true){
    print 'Usuario:'.'&nbsp'."$login".'&nbsp'."<br />".'cadastrado com sucesso!!!';}
elseif ($inserir==false) {
    print 'Erro ao cadastrar!!!';
}
            ldap_close($ldapconexao);
    }else {
    print "Nao pode se conecta!!!";
}