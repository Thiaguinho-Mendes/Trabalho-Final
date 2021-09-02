<!DOCTYPE html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="estilo/styleLogin.css"/>
    <meta charset="UTF-8">
    <title>GEREESC - Gerenciamento de Estoque Escolar</title>
</head>
<body>
    <div class="container-fluid">
        <!--Cabeçalho titulo-->
        <header id="cabecalho">
            <h1 id="Titulo">GEREESC <br> Sistema de Gerenciamento de Estoque</h1>
        </header>
        <!--Bloco de Login-->
        <section>
            <div id="Login">
                <div id="avatar"><img src="estilo/icones/user.png"></div>

                <form method="post" class="px-3" action="login/verificacao.php">
                    <label class="textInput">Usuário</label>
                    <input type="text" class="form-control" required maxlength="64" name="login">

                    <label class="textInput">Senha</label>
                    <input type="password" class="form-control" required maxlength="64" name="senha">

                    <input type="submit" id="buttonLogin" class="btn btn-dark m-3" value="Logar">
                </form>
            </div>
        </section>
    </div>
</body>
</html>