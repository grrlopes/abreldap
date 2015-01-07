<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link href="css/bootstrap.css" rel="stylesheet" media="screen" />
<link rel="stylesheet" type="text/css" href="css/ldapaum.css" /> 
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script src="js/ldapaum.js"></script>
</head>
<div id="index1" class="container">
    <div class="row">
        <div class="col-md-3 col-md-offset-4">
	 <img src="img/ldap-admin.png">
            <div class="panel panel-default">
                <div class="panel-body">
                    <!--img src="img/ldap-admin.png"> <h5 class="text-center">LDAP-Admin</h5-->
                    <form class="form form-signup" method="post" action="php/login.php">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                            <input id="login1" type="text" name="login" class="form-control" placeholder="Login" required autofocus/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            <input id="login2" type="password" name="senha" class="form-control" placeholder="Senha" required/>
                        </div>
                    </div>
                
                        <button id="index2" class="btn btn-sm btn-primary btn-block">Entrar</button>
                    </form>
                </div>
            </div>
            <div id="index3" class="btn" >
                <h4></h4>
            </div>
        </div>
    </div>
</div>
</html>
