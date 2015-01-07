<html>
<?php
include_once'menu.php';
require_once'php/conexao.php';

$filter ="(cn=*)";
$result=ldap_search($ldapconexao,$arvore1,$filter);
$info = ldap_get_entries($ldapconexao,$result);
$Bloqueado = "<img src=img/Lock.png title='Desbloquear'>";
?>
<div id="grupo1" class="container-fluid">
<div id="grupo2" class="row-fluid">
    
        <div id="procura6">
    <form class="form-signin">
    <input type="text" name="usuario" class="usuario form-control" placeholder="Usuário" required autofocus>
    <input type="text" name="grupo" class="grupo form-control" placeholder="Grupo" required>
    <input type="submit" name="sub" class="submeter" value="Enviar">
        <label>
    <select name="etc">
    <option value="selec" selected="selec">Selecione</option>    
    <option value="adiciona">Adicionar usuário no grupo</option>
    <option value="remove">Remover usuário do grupo</option>    
    </select>
        </label>
    </form>
            <button class="botao" type="button" title="fechar">X</button>
            <p></p>
        </div>
    
    <div id="grupo4" class="span6">
       <table class="table table-hover table-bordered">
    <div></div>
    </table>
       </div>
    
    <div id="grupo8" class="span6">
       <table class="table table-hover table-bordered">
    <div></div>
    </table>
       </div> 

        <div id="grupo3" class="span6">
                       
    <div id="grupo7">
        <form class="form-signin">
        <input type="text" name="login" class="login form-control" placeholder="Usuários" required autofocus>
        <input type="submit" name="subgrp" class="submeter" value="Enviar">
        </form>
    </div>
        
<div id="grupo5">
    <a href="#" class="btn btn-lg btn-primary">Novo Grupo <span class="glyphicon glyphicon-user"></span></a>
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Cadastro de grupo</h4>
                </div>
                <div class="modal-body">

                <form class="form-signin">
               <input id="cgrupo" type="text" name="grupo" class="form-control" placeholder="Grupo" required autofocus>
               
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>

 <div id="grupo6" class="modal">
         <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Excluir grupo</h4>
                </div>
  <div class="modal-body">
    <p><h4>Tem certeza que deseja excluir ?</h4></p>
  </div>
  <div class="modal-footer">
    <form>
        <button type="button" class="btn btn-default" data-dismiss="modal"value="1">Não</button>
        <button id="hh" type="button" name="grupo" class="btn btn-primary" data-dismiss="modal" value="2">Sim</button>
    </form>
  </div>
</div>
  </div>
</div>
<img class="chave" src="img/chave.png" title="Alteração de grupo">
        <table class="table table-hover table-bordered">
<?php
foreach ($info as $n) {
print '<tr>';
    if(!empty($n["cn"][0])){
print '<td>';
        print $n["gidnumber"][0];
print '</td>';
    }
    if(!empty($n["cn"][0])){
print '<td>';
        print $n["cn"][0];       
print '</td>';        
    }
    if(!empty($n["cn"][0])){
print '<th>';
    $eu=$n["cn"][0];
print '<form>';
print "<input class='checkbox' type='checkbox' name='grupo' value='$eu' alt='Excluir' title='Excluir'>";
print '</form>';     
print '</th>';
    }
print '</tr>';
}

?>
</table>
</div>       
</div>
     
</div>
</html>
