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
            margin: 10px;
        }

        .fonte-sm {
            font-size: 12px;
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
        }

        footer {
            position: fixed;
            bottom: 0;
            padding: 2svw;
            background-color: rgb(25, 135, 84);
            width: 100%;
        }

        .texto-center {
            text-align: center;
        }

        .texto-white {
            color: white;
        }

        .botao {
            background-color: rgb(25, 135, 84);
            width: 100%;
            margin-top: 1;
            border: none;
            padding: 1svw;
            border-radius: 1svw;
            cursor: pointer;
            color: white;
        }

        .botao:hover {
            opacity: 1;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="https://deliciasdacheiloca.com.br/assets/logo1.jpeg" alt="" class="imagem-logo">
    </div>

    <div class="content">
        <h2>Olá!</h2>
        <p>
            Agradecemos por se cadastrar na Delícias da Cheiloca! Estamos muito felizes em tê-lo conosco. Para confirmar sua conta, clique no botão abaixo.
        </p>

        <p>
            Agradecemos sua confiança e esperamos vê-lo em breve!
        </p>

        <p>
            Atenciosamente, <br>
            Equipe Delícias da Cheiloca.
        </p>

        <a href="<?php echo $data['url'] . '/' . $data['id'] . '/' .  $data['email'] . '/' . $data['token'] ?>">
            <button class="botao">
                Confirmar Cadastro
            </button>
        </a>


        <p class="fonte-sm mt-3">
            Se você não criou uma conta em nossa plataforma, não se preocupe, basta ignorar este e-mail.
        </p>
    </div>
</body>

</html>