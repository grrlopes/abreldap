<html>
<?php
    include_once 'menu.php';
    require_once 'php/conexao.php';
?>
<body>
<div id="procura1" class="container-fluid">
    <div class="row-fluid">      
        <div class="span4">
           
        <div id="menu4">
        <div id="procura4">
    <form class="form-signin">
    <input type="text" name="login" class="user form-control" required autofocus>
    <input type="submit" name="sub" class="submeter">
        <label>
    <select name="etc">
    <option value="selec" selected>Selecione</option>    
    <option value="login">Senha</option>
    <option value="excluir">Excluir</option>
    <option value="bloq">Bloqueio</option>
    <option value="dbloq">Desbloq</option>
    </select>
        </label>
    </form>
    <button class="botao" type="button" title="fechar">X</button>
        </div>
    
        <div id="procura5">
    <form class="form-signin">
    <input type="text" name="alteracao" class="senha form-control">
    <input type="text" name="alter" class="login form-control" placeholder="Login" required autofocus>
    <input type="submit" name="sub" class="submeter" value="Enviar">
        <label>
    <select name="etc">
    <option value="selec">Selecione</option>    
    <option value="senha" selected>Senha</option>
    <option value="excluir">Excluir</option>    
    <option value="bloq">Bloqueio</option>
    <option value="dbloq">Desbloq</option>
    </select>
        </label>
    </form>
            <button class="botao" type="button" title="fechar">X</button>
        </div>
    </div>        

            
<div id="cadastro1">
    <a href="#" class="btn btn-lg btn-primary"> Novo Usuário <span class="glyphicon glyphicon-user"></span></a>
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Cadastro de novo usuário</h4>
                </div>
                <div class="modal-body">

                <form class="form-signin">
               <input id="clogin" type="text" name="login" class="form-control" placeholder="Login" required autofocus>
               <input id="cnome" type="text" name="nome" class="form-control" placeholder="Nome" required autofocus>
               <input id="csobrenome" type="text" name="sobrenome" class="form-control" placeholder="Sobrenome" required autofocus>
               <input id="cemail" type="text" name="email" class="form-control" placeholder="Email" required autofocus>
               <input id="csenha" type="password" name="senha" class="form-control" placeholder="Senha" required><br>
               
                <!--/div-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <img class="chave" src='img/chave.png' title="Alteração de conta">
</div>
            
        <div id="procura2">
    <p></p>
    <img src="img/load.gif">
    <form class="form-signin">
    <input id="ffiltro" type="text" name="filtro" class="form-control" placeholder="Pesquisa" required autofocus>   
        <label>
    <select name="usr">
    <option value="Procurar">Selecione</option>    
    <option value="login">Login</option>
    <option value="nome">Nome</option>
    <option value="sobrenome">Sobrenome</option>
    <option value="inativo">Bloqueados</option>
    </select>
        </label>
    </form>
        </div>
        </div>  
            
        </div>
        
        <div class="span8">
            <div id="procura3">
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
    $resultado1 = ldap_search($ldapconexao,$arvore, "(uid=*)") or 
                die ("Erro ao pesquisar ".ldap_error($ldapconexao));
    $dados1 = ldap_get_entries($ldapconexao, $resultado1);
            for ($i=0; $i<$dados1["count"]; $i++){
            if(!empty($dados1[$i]["uid"][0])){

print '<tr>';
print "<td id='login'>";
    print $User.$nb.$dados1[$i]["uid"][0]."<br />";
print '</td>';
         }
    if(empty($dados1[$i]["givenname"][0])){
print '<td id="nome1">';    
     print $vazio.' '."<br />";
print '</td>';
        } else{
print '<td id="nome2">';    
     print $dados1[$i]["givenname"][0]."<br />";
print '</td>';
         }
    if(empty($dados1[$i]["sn"][0])){
print '<td id="sobrenome1">';
    print $vazio.' '."<br />";
print '</td>';
        }else{
print '<td id="sobrenome2">';
    print $dados1[$i]["sn"][0] ."<br />";
print '</td>';
        }
    if(empty($dados1[$i]["mail"][0])){
print '<td id="mail1">';
     print $vazio.' '."<br />";
print '</td>';
        }else{
print '<td id="mail2">';
     print $mail.$nb.$dados1[$i]["mail"][0] ."<br />";
print '</td>';
        }
    if(empty($dados1[$i]["sambaacctflags"][0][1])){
print '<td >';
     print $vazio.' '."<br />";
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
?>
    </tr> 
  </tbody>
</table>
    </div>
        </div>
  </div>
</body>
