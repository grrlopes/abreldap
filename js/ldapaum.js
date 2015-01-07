$(document).ready(function(){

    $("#cadastro1 .btn").click(function(){
        $("#myModal").modal('show');
    });

    $("#grupo5 .btn").click(function(){
        $("#myModal").modal('show');
    });

    $("#menu2 a[href$='#1']").click(function(){
        location.reload();
    });

    $("#menu2 a[href$='#5']").click(function(e){
        $.ajax({
        url: "php/sair.php",
        success: function(){
            location.reload();
        }
    });
    e.preventDefault();
    });

    $('#index2').click(function(){
    var nome = $('#login1').val(),
        pass = $('#login2').val();
        $.ajax({
            method: "POST",
            url: "php/login.php",
            data: {login: nome, senha: pass},
            beforeSend:"",
            error: "",
            success: function(r){
                if(r === 'falha'){
            $("#index3").empty().html('<p>Login ou senha inválido!!!</p>').fadeIn('slow');
                    window.setTimeout(function(){
                    $("#index3").fadeOut('slow');
                },2000);
                }else if(r === 'permissao'){
            $("#index3").empty().html('<p>Login sem permissão de acesso.</p>').fadeIn('slow');
                    window.setTimeout(function(){
                    $("#index3").fadeOut('slow');
                },2000);
                }else if(r === 'acessivel'){
            $("#index3").empty().html("<p>Efetuando autenticação...</p><img src='img/load-login.gif'>").fadeIn('slow');
                    window.setTimeout(function(){
                    $("#index3").fadeOut('slow');
                    $("#index3").css('display','none');
                    $(location).attr('href','usuarios.php');
                },2000);
                    } 
            }     
        });
        return false;
     });
    
    $("#cadastro1 form").submit(function(){
    var login = $('#clogin').val(),
        nome = $('#cnome').val(),
        sobrenome = $('#csobrenome').val(),
        email = $('#cemail').val(),
        senha = $('#csenha').val(); 
    $.post('php/cadastro.php',{login: login, nome: nome,
    sobrenome: sobrenome, email: email, senha: senha}, function(data){
            $('#feedback').html(data);
        });
    });
    
    $("#procura2 form").on('submit', function(e){
        alert('Ohh animal... Não pressione "Enter",\n\
        a consulta é dinâmica!!');
        e.preventDefault();
    });

    $('#procura2 select').change(function(){
        var coletor = $('#procura2 option:selected').val();
        if(coletor === "inativo"){
            $.post("php/pesquisa.php",{usr: coletor},function(r){
            $("#procura3").empty();
            $("#procura3").append(r);
                });
            }else{}
    });

    $("#procura2 form, #procura2 option:selected").keyup(function(e){
        var coletor = $('#procura2 option:selected').val();
        var achar = $("#ffiltro").val();
        if(coletor === "Procurar"){
            return false;
        }else if(coletor !== "inativo"){
        $.ajax({
            method: "POST",
            url: "php/pesquisa.php",
            data: { filtro : achar, usr : coletor },
            beforeSend: function(){
            $("#procura2 img").fadeIn('slow');
            },
            error: "",
            success: function(r){    
            $("#procura3").empty();
            $("#procura3").delay( 800 ).append(r);
            $("#procura2 img").fadeOut('fast');
            }     
        });
        }
        e.preventDefault();
    });
    
    $("#grupo3 td").mouseover(function(){
    var grupo = $(this).text();
        $.post('php/grupo.php',{aa:grupo},
            function(data){$("#grupo4 div").html(data);
                });
    });
    
    $("#grupo3 .checkbox").click(function(e){
        var box = $(this).val();
        $('#grupo6').modal('show');
            $("#grupo6 button").click(function(){
            var ball = $(this).val();
        if(ball === "2"){
        $.post('php/delgrupo.php',{grupo:box});
                location.reload();     
            }else if(ball === "1"){
                location.reload();
            }else{}
        });
    });
    
    $("#grupo5 form").submit(function(){
        var sub = $("#cgrupo").val();
        $.post('php/novogrupo.php',{grupo:sub});
            location.reload();
    });
    
    $("#grupo7 .submeter").click(function(e){
        var login = $("#grupo7 .login").val(),
            subgrp = $("#grupo7 .submeter").val()+'sub';
            if(login === ''){
                return false;
            }
            $.ajax({
            method: "POST",
            url: "php/switch.php",
            data: { login : login, etc : subgrp },
            beforeSend:"",
            error: "",        
            success: function(r){
                $("#grupo8 div").html(r);
            }
        });
        e.preventDefault();
    });
    
    $("#cadastro1 .chave").click(function(){
        $("#procura5").css('display','none');
        $("#procura4").css( 'display', 'block' );
        $("#procura1").css('margin','0px');
    });
    
    $("#grupo2 .chave").click(function(){
        $("#grupo3").css('margin-top','15px'); //15px
        $("#procura6").css( 'display', 'block' );
    });
    
    $("#procura4 button").click(function(){
        $("#procura4").css('display','none');
        $("#procura1").css({ 
            'margin-left': '0px',
             'margin-top': '77px'   
        });
    });
    
    $("#procura5 button").click(function(){
        $("#procura5").css('display','none');
        $("#procura1").css({ 
            'margin-left': '0px',
             'margin-top': '77px' 
        });
    });
    
    $("#procura6 .botao").click(function(){
        $("#procura6").css('display','none');
        $("#grupo3").css({ 
            'margin-top': '22px'  
        });
    });
    
    $("#procura4 select").click(function(){
        var pego = $("#procura4 option:selected").val();
        if(pego === 'login'){
            $("#procura4").css('display','none');
            $("#procura5").css('display','block');
        }else if( pego === 'selec'){
            return false;
        }else if(pego === 'excluir' || pego === 'bloq' || pego === 'dbloq'){
            $("#procura5").css('display','none');
            $("#procura4").css('display','block');
        }
    });
    
    $("#procura5 select").click(function(){
        var pego = $("#procura5 option:selected").val();
        if( pego === 'selec'){
            return false;
        }else if(pego === 'login'){
            return false;
        }else if(pego === 'excluir' || pego === 'bloq' || pego === 'dbloq'){
            $("#procura5").css('display','none');
            $("#procura4").css('display','block');
        }
    });
    
    $("#procura4 .submeter").click(function(e){
        var user = $("#procura4 .user").val();
        var pego = $("#procura4 option:selected").val();
        if(user === ''){
            return false;
        }else if(pego === 'bloq'){
            $.ajax({
            method: "POST",
            url: "php/switch.php",
            data: { login : user, etc : pego },
            beforeSend:"",
            error: "",
            success: function(r){
            $("#procura2 p").css('display','block');
            $("#procura2 p").html(r);
            $("#procura2 p").fadeIn('slow');
            $("#procura2 p").delay('3000');
            $("#procura2 p").fadeOut('slow');
        }
            });
        }else if(pego === 'dbloq'){
            $.ajax({
            method: "POST",
            url: "php/switch.php",
            data: { login : user, etc : pego },
            beforeSend:"",
            error: "",
            success: function(r){
            $("#procura2 p").css('display','block');
            $("#procura2 p").html(r);
            $("#procura2 p").fadeIn('slow');
            $("#procura2 p").delay('3000');
            $("#procura2 p").fadeOut('slow');
            }
        });
    }else if(pego === 'excluir'){
            $.ajax({
            method: "POST",
            url: "php/switch.php",
            data: { login : user, etc : pego },
            beforeSend:"",
            error: "",
            success: function(r){
            $("#procura2 p").css('display','block');
            $("#procura2 p").html(r);
            $("#procura2 p").fadeIn('slow');
            $("#procura2 p").delay('3000');
            $("#procura2 p").fadeOut('slow');
            }
        });
    }
        e.preventDefault();
    });
    
    $("#procura5 .submeter").click(function(e){
        var user = $("#procura5 .login").val();
        var senha = $("#procura5 .senha").val();
        var pego = $("#procura5 option:selected").val();
        if(user === '' && senha === ''){
            return false;
        }else if(pego === 'senha'){
            $.ajax({
            method: "POST",
            url: "php/switch.php",
            data: { login : user, novasenha : senha, etc : pego },
            beforeSend: "",
            error: "",
            success: function(r){
            $("#procura2 p").css('display','block');
            $("#procura2 p").html(r);
            $("#procura2 p").fadeIn('slow');
            $("#procura2 p").delay('3000');
            $("#procura2 p").fadeOut('slow');  
            }
        });
            }
        e.preventDefault();
        });
        
    $("#procura6 .submeter").click(function(e){
        var usuario = $("#procura6 .usuario").val();
        var grupo = $("#procura6 .grupo").val();
        var selecao = $("#procura6 option:selected").val();
        
        if(usuario === '' && grupo === ''){
            return false;
        }else if(selecao === 'selec'){
            return false;
        }else if(selecao === 'adiciona'){
           $.ajax({
            method: "POST",
            url: "php/switch.php",
            data: { login : usuario, grupo : grupo, etc : selecao },
            beforeSend: "",
            error: "",
            success: function(e){
            $("#procura6 p").html(e);
            $("#procura6 p").fadeIn('slow');
            $("#procura6 p").delay('2000');
            $("#procura6 p").fadeOut('slow');
            }
            });
        }else if(selecao === 'remove'){
           $.ajax({
            method: "POST",
            url: "php/switch.php",
            data: { login : usuario, grupo : grupo, etc : selecao },
            beforeSend: "",
            error: "",
            success: function(e){
            $("#procura6 p").html(e);
            $("#procura6 p").fadeIn('slow');
            $("#procura6 p").delay('2000');
            $("#procura6 p").fadeOut('slow');
            }
            });
        }
        e.preventDefault();
    });
});
