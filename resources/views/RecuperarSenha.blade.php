<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delicias da Cheiloca</title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .imagem-logo {
            width: 100px;
            border-radius: 100%;
            padding: 10px;
        }

        .header {
            width: 100%;
            background-color: rgb(25, 135, 84);
            display: flex;
            justify-content: center;
        }

        .content {
            padding-left: 8svw;
            padding-right: 8svw;
            margin-top: 5svh;
            text-align: center;
        }

        .fonte-sm {
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="https://deliciasdacheiloca.com.br/assets/logo1.jpeg" alt="" class="imagem-logo">
    </div>

    <div class="content">
        <h2>
            Recuperar Senha
        </h2>
        <p>
            Utilize esse token em nossa plataforma para alterar sua senha: <?php echo $data['token']; ?>
        </p>
        <p>
            Não compartilhe este token.
        </p>
        <p class="fonte-sm">
            Caso não tenha solicitado a recuperação de senha, por favor, ignore este e-mail.
        </p>
    </div>
</body>

</html>