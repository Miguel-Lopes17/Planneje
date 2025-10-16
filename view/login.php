<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planeje - Login</title>
    <link rel="stylesheet" href="../css/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>

    .login-container {
        display: flex;
        background-color: #fff;
        min-height: 100vh;
    }

    .login-left {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 2rem;
        color: var(--white);
        text-align: center;
        background-image: url("../assets/imagemPrincipal.jpg");
        background-size: cover;
        background-repeat: no-repeat;
    }

    .login-left-overlay {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 2rem;
        color: var(--white);
        text-align: center;
        position: absolute;
        top: 0;
        left: 0;
        width: 50%;
        height: 100%;
        background-color: rgba(102, 8, 139, 0.32);
    }

    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-left">
            <div class="login-left-overlay">
                <div class="logo">
                    <h1>Planeje</h1>
                </div>
                <h2>Bem-vindo de volta!</h2>
                <p>Organize suas viagens de forma simples e eficiente. Tenha tudo o que você precisa em um só lugar.</p>
                <div class="features-list">
                    <div class="feature">
                        <i class="fas fa-check-circle"></i> Documentos organizados
                    </div>
                    <div class="feature">
                        <i class="fas fa-check-circle"></i> Roteiros personalizados
                    </div>
                    <div class="feature">
                        <i class="fas fa-check-circle"></i> Informações de saúde
                    </div>
                </div>
            </div>
        </div>
        
        <div class="login-right">
            <div class="login-form">

                <div class="container">
                    <h1 class="title">Login</h1>

                <form action="../backend/includes/login.php" method="POST" >
                    <div class="tab show">
                        <div class="form">
                            <input type="email" name="email" placeholder="Email">
                        </div>
                        <div class="form">
                            <input type="password" name="senha" placeholder="Senha">
                        </div>
                    </div>

                    <div class="btn">
                        <button type="submit" class="finish" name="entrar">Entrar</button>
                    </div>
            
                </form>
            
                </div>
                
                <div class="signup-link">
                    Não tem uma conta? <a href="cadastrar.php">Cadastre-se</a>
                </div>
            </div>
        </div>
    </div>

    <script src="sweetalert2.all.min.js"></script>
</body>
</html>