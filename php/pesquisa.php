<html>
<?php
require_once 'conexao.php';
?>
   <link rel="stylesheet" type="text/css" href="css/ldapaum.css" />
   <table class="table table-condensed table-hover table-bordered">
    <thead>
    <tr>
    <th>Login</th>
    <th>Nome</th>
    <th>Sobrenome</th>
    <th>Email</th>
    <th>Status</th>
    </tr>
    </thead>
  <tbody>
    <tr>      
<?php
    $Ativo = "<img src=img/unlock.png alt='Bloquear' title='Bloquear'>";
    $Bloqueado = "<img src=img/Lock.png title='Desbloquear'>";
    $User = "<img src=img/user.png>";
    $mail = "<img src=img/mail.png>";
    $vazio = "<img src=img/vazio.png title='Vazio'>";
    $nb = str_repeat('&nbsp', 3);
$pesquisa = filter_input(INPUT_POST,'filtro');
$eu = filter_input(INPUT_POST,'usr');
switch ("$eu"){
    
    case 'login':
        
    $resultado1 = ldap_search($ldapconexao,$arvore, "(uid=$pesquisa*)") or 
                die ("Erro ao pesquisar ".ldap_error($ldapconexao));
    $dados1 = ldap_get_entries($ldapconexao, $resultado1);
            for ($i=0; $i<$dados1["count"]; $i++){
            if(!empty($dados1[$i]["uid"][0])){

print '<tr id="procura1">';
print "<td id='login'>";
    print $User.$nb.$dados1[$i]["uid"][0]."<br />";
print '</td>';
         }
    if(empty($dados1[$i]["givenname"][0])){
print '<td id="nome1">';    
     print $vazio.$nb."<br />";
print '</td>';
        } else{
print '<td id="nome2">';    
     print $dados1[$i]["givenname"][0]."<br />";
print '</td>';
         }
    if(empty($dados1[$i]["sn"][0])){
print '<td id="sobrenome1">';
    print $vazio.$nb."<br />";
print '</td>';
        }else{
print '<td id="sobrenome2">';
    print $dados1[$i]["sn"][0] ."<br />";
print '</td>';
        }
    if(empty($dados1[$i]["mail"][0])){
print '<td id="mail1">';
     print $vazio.$nb."<br />";
print '</td>';
        }else{
print '<td id="mail2">';
     print $mail.$nb.$dados1[$i]["mail"][0] ."<br />";
print '</td>';
        }
    if(empty($dados1[$i]["sambaacctflags"][0][1])){
print '<td >';
     print $vazio.$nb."<br />";
print '</td>';
        }else{
     $jj = $dados1[$i]["sambaacctflags"][0][1];
         $x = strpos($jj,'D');
         $xx = strpos($jj,'U');
         $xxx = strpos($jj,'N');
            if($x == 'D'){
print '<td>';
            print "$Bloqueado";
print '</td>';                 
            }
            elseif($xx == 'U'){
print '<td>';                
            print "$Ativo";
print '</td>';
            }
            elseif($xxx == 'N'){
print '<td>';
            print "Sem senha";
print '</td>';               
                 }
                else{
print '<td>';                    
            print "$jj";
print '</td>';                     
                }
        }
    }
    break;
    
case 'nome':
        
    $resultado1 = ldap_search($ldapconexao,$arvore, "(givenname=$pesquisa*)") or 
                die ("Erro ao pesquisar ".ldap_error($ldapconexao));
    $dados1 = ldap_get_entries($ldapconexao, $resultado1);
            for ($i=0; $i<$dados1["count"]; $i++){
            if(!empty($dados1[$i]["uid"][0])){

print '<tr id="procura1">';
print "<td id='login'>"; 
    print $User.$nb.$dados1[$i]["uid"][0]."<br />";
print '</td>';
         }
    if(empty($dados1[$i]["givenname"][0])){
print '<td id="nome1">';    
     print $vazio.$nb."<br />";
print '</td>';
        } else{
print '<td id="nome2">';    
     print $dados1[$i]["givenname"][0]."<br />";
print '</td>';
         }
    if(empty($dados1[$i]["sn"][0])){
print '<td id="sobrenome1">';
    print $vazio.$nb."<br />";
print '</td>';
        }else{
print '<td id="sobrenome2">';
    print $dados1[$i]["sn"][0] ."<br />";
print '</td>';
        }
    if(empty($dados1[$i]["mail"][0])){
print '<td id="mail1">';
     print $vazio.$nb."<br />";
print '</td>';
        }else{
print '<td id="mail2">';
     print $mail.$nb.$dados1[$i]["mail"][0] ."<br />";
print '</td>';
        }
    if(empty($dados1[$i]["sambaacctflags"][0][1])){
print '<td >';
     print $vazio.$nb."<br />";
print '</td>';
        }else{
     $jj = $dados1[$i]["sambaacctflags"][0][1];
         $x = strpos($jj,'D');
         $xx = strpos($jj,'U');
         $xxx = strpos($jj,'N');
            if($x == 'D'){
print '<td>';
                 print "$Bloqueado";
print '</td>';                 
            }
            elseif($xx == 'U'){
print '<td>';                
               print "$Ativo";
print '</td>';
            }
            elseif($xxx == 'N'){
print '<td>';
               print "Sem senha";
print '</td>';               
                 }
                else{
print '<td>';                    
                     print "$jj";
print '</td>';                     
                }
        }
    }
    break;
    
case 'inativo':
        
    $resultado1 = ldap_search($ldapconexao,$arvore, "(sambaacctflags=[DU])") or 
                die ("Erro ao pesquisar ".ldap_error($ldapconexao));
    $dados1 = ldap_get_entries($ldapconexao, $resultado1);
            for ($i=0; $i<$dados1["count"]; $i++){
            if(!empty($dados1[$i]["uid"][0])){

print '<tr id="procura1">';
print "<td id='login'>"; 
    print $User.$nb.$dados1[$i]["uid"][0]."<br />";
print '</td>';
         }
    if(empty($dados1[$i]["givenname"][0])){
print '<td id="nome1">';    
     print $vazio.$nb."<br />";
print '</td>';
        } else{
print '<td id="nome2">';    
     print $dados1[$i]["givenname"][0]."<br />";
print '</td>';
         }
    if(empty($dados1[$i]["sn"][0])){
print '<td id="sobrenome1">';
    print $vazio.$nb."<br />";
print '</td>';
        }else{
print '<td id="sobrenome2">';
    print $dados1[$i]["sn"][0] ."<br />";
print '</td>';
        }
    if(empty($dados1[$i]["mail"][0])){
print '<td id="mail1">';
     print $vazio.$nb."<br />";
print '</td>';
        }else{
print '<td id="mail2">';
     print $mail.$nb.$dados1[$i]["mail"][0] ."<br />";
print '</td>';
        }
    if(empty($dados1[$i]["sambaacctflags"][0][1])){
print '<td >';
     print $vazio.$nb."<br />";
print '</td>';
        }else{
     $jj = $dados1[$i]["sambaacctflags"][0][1];
         $x = strpos($jj,'D');
         $xx = strpos($jj,'U');
         $xxx = strpos($jj,'N');
            if($x == 'D'){
print '<td>';
                 print "$Bloqueado"."<br />";
print '</td>';                 
            }
            elseif($xx == 'U'){
print '<td>';                
               print "$Ativo"."<br />";
print '</td>';
            }
            elseif($xxx == 'N'){
print '<td>';
               print "Sem senha"."<br />";
print '</td>';               
                 }
                else{
print '<td>';                    
                     print "$jj"."<br />";
print '</td>';                     
                }
        }
    }
    break;
        
}
?>
    </tr> 
  </tbody>
</table>


