# abreldap
============

Objetivo
-------

Gerenciador de base Openldap

Requisitos
----------

1. Servidor Apache2.x
2. PHP 5.2+
        - LDAP
        
Instalação
----------

Descompactar o arquivo stable, dentro da pasta htdocs do servidor HTTP

1. Download http://xxxxx
2. tar -xzvf xxxx.tar.gz

Configuração
------------

Efetuar alterações no arquivo de configuração, **config.php**. que está dentro da pasta **php/**
```
$host = '10.****';
$porta = '389';
$usuario ='cn=Manager,dc=exemplo,dc=com';
$senha = 'senha';
$arvore = 'dc=exemplo,dc=com';
$arvore1 = "ou=Groups,dc=exemplo,dc=com";
```

**cadastro.php**. Alterar a linha 51, conforme as
o dominio do servidor.
```
$dn="uid={$login},ou=Users,dc=portalsigres,dc=com";
```

Solicitação
-----------

**PROJETO EFETUADO EM PHP ESTRUTURADO. SOLICITO AJUDA PARA REESCREVER O CóDIGO, PARA ORIENTAÇÃO A OBJETO.**
