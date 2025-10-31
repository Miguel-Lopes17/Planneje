<?php include '../backend/includes/usrdados.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Planeje - Ajuda </title>

<!-- Fonte e ícones -->
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Open+Sans:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link rel="stylesheet" href="../css/plans.css">

<style>
:root {
    --roxo: #6A0DAD;
    --lilas: #9B51E0;
    --light-purple: #E8D5FF;
    --white: #FFFFFF;
    --light-gray: #F5F5F5;
    --dark-text: #333333;
    --accent: #FFD700;
}

body {
    font-family: 'Open Sans', sans-serif;
    color: var(--dark-text);
    background-color: var(--light-gray);
    line-height: 1.6;
    margin: 0;
}

/* ===== CONTEÚDO PRINCIPAL ===== */
main {
    max-width: 1200px;
    margin: 2rem auto;
    padding: 2rem;
    background: var(--white);
    border-radius: 12px;
    box-shadow: 0px 4px 10px rgba(0,0,0,0.08);
}

/* Cabeçalho */
.help-header {
    text-align: center;
    margin-bottom: 2rem;
}

.help-header h1 {
    color: var(--roxo);
    font-size: 2rem;
    margin-bottom: 0.5rem;
}

.help-header p {
    color: #555;
    font-size: 1rem;
}

/* Seções */
.help-section {
    margin-bottom: 2rem;
    border-left: 5px solid var(--lilas);
    padding: 1rem;
    background-color: var(--light-purple);
    border-radius: 8px;
    transition: 0.3s ease;
}

.help-section h2 {
    color: var(--roxo);
    font-size: 1.3rem;
    margin-bottom: 0.5rem;
}

.help-section ul {
    list-style: none;
    padding-left: 0;
    margin: 0;
}

.help-section li {
    margin-bottom: 0.5rem;
    color: #444;
    font-size: 0.95rem;
}

.highlight {
    background: var(--accent);
    color: var(--dark-text);
    padding: 2px 6px;
    border-radius: 4px;
    font-weight: 600;
}

/* Rodapé de suporte */
.support {
    text-align: center;
    background-color: var(--lilas);
    color: var(--white);
    padding: 1rem;
    border-radius: 8px;
    margin-top: 2rem;
}

.support a {
    color: var(--accent);
    font-weight: 600;
    text-decoration: none;
}

.support a:hover {
    text-decoration: underline;
}

.plans1 , .ajuda1 {
            display: none;
        }

        @media screen and (max-width:1000px) {
            .navbar {
                display: none;
            }
            .plans1, .ajuda1 {
                display: flex;
            }

            .ul-lis {
                display: none;
            }

            .container-user {
                display: none;
            }

            .logo {
                margin-left: 35%;
            }
        }

</style>
</head>

<body>
<!-- BOTÃO HAMBURGUER PARA ABRIR -->
    <button class="menu-toggle"><i class="fas fa-bars"></i></button>

    <!-- MENU LATERAL (já fechado por padrão com "collapsed") -->
    <aside class="sidebar collapsed">
        <div class="sidebar-header">
            <h3>Menu</h3>
            <button class="close-btn"><i class="fas fa-times"></i></button>
        </div>

        <ul class="sidebar-links">
            <li><a href="#">Configuração</a></li>
            <li><a href="ajuda.php">Ajuda</a></li>
            <li><a href="#">Sobre</a></li>
            <!-- <li><a href="#">Planos arquivados</a></li> -->
            <li><a href="#">Compartilhar</a></li>
            <li><a href="inicio.php" class="plans1">Meus Planos</a></li>
            <li"><a href="ajuda.php" class="ajuda1">Ajuda</a></li>
            <!-- <li><a href="#">Autenticador</a></li> -->
            <!-- <li><a href="#">Documentos</a></li> -->
        </ul>

        <div class="sidebar-footer">
            <div class="user-info">
                <div class="avatar"></div>
                <div>

                    <p class="email"> <?php echo $email; ?></p>
                    <p class="cpf"> <?php echo $cpf; ?></p>

                </div>
            </div>
            <button class="logout-btn">Sair</button>
        </div>
    </aside>

    <header class="main-header">
        <div class="container">
            <nav class="navbar">
                <ul class="ul-list">
                    <a href="inicio.php" class="plans">Meus Planos</a>
                    <a href="ajuda.php" class="ajuda">Ajuda</a>
                </ul>

                <div class="animation start-home"></div>
            </nav>

            <div class="logo">
                <a href="inicio.php">
                    <h1>Planeje</h1>
                </a>
            </div>
        </div>
    </header>

<!-- CONTEÚDO PRINCIPAL -->
<main>
    <div class="help-header">
        <h1>Central de Ajuda</h1>
        <p>Guia completo para utilizar o Planeje — seu organizador de viagens.</p>
    </div>

    <section class="help-section">
        <h2>1. Criando sua conta</h2>
        <ul>
            <li>Acesse a opção <span class="highlight">Cadastrar</span> no menu inicial.</li>
            <li>Informe seu nome, e-mail e crie uma senha segura.</li>
            <li>Após o cadastro, faça login para acessar suas pastas de viagem.</li>
        </ul>
    </section>

    <section class="help-section">
        <h2>2. Criando uma pasta de viagem</h2>
        <ul>
            <li>Clique em <span class="highlight">Nova Viagem</span> no painel principal.</li>
            <li>Defina um nome (ex: "Chile 2025") e adicione datas e destinos.</li>
            <li>Dentro da pasta, você poderá gerenciar documentos, orçamento e dependentes.</li>
        </ul>
    </section>

    <section class="help-section">
        <h2>3. Armazenando documentos</h2>
        <ul>
            <li>Na aba <span class="highlight">Documentos</span>, envie passaporte, fichas médicas e reservas.</li>
            <li>Todos os arquivos ficam organizados e disponíveis para consulta.</li>
        </ul>
    </section>

    <section class="help-section">
        <h2>4. Criando e controlando o orçamento</h2>
        <ul>
            <li>Em <span class="highlight">Orçamento</span>, adicione o valor total e os custos estimados.</li>
            <li>Registre despesas reais e acompanhe o saldo disponível em tempo real.</li>
            <li>O sistema pode alertar quando seus gastos ultrapassarem o previsto.</li>
        </ul>
    </section>

    <section class="help-section">
        <h2>5. Controle de gastos</h2>
        <ul>
            <li>Adicione novas despesas com valor, categoria e data.</li>
            <li>Visualize seus gastos em listas e gráficos para melhor controle.</li>
        </ul>
    </section>

    <section class="help-section">
        <h2>6. Gerenciando dependentes</h2>
        <ul>
            <li>Vá em <span class="highlight">Dependentes</span> e crie uma aba para cada pessoa.</li>
            <li>Adicione documentos pessoais e informações médicas de forma individual.</li>
        </ul>
    </section>

    <section class="help-section">
        <h2>7. Dicas e segurança</h2>
        <ul>
            <li>Mantenha seus dados atualizados e senhas seguras.</li>
            <li>Use pastas separadas para cada viagem.</li>
            <li>Faça backup dos documentos mais importantes.</li>
        </ul>
    </section>

    <div class="support">
        <p>Precisa de ajuda? Entre em contato com o suporte pelo e-mail
        <a href="mailto:suporte@planejeviagens.com">suporte@planejeviagens.com</a></p>
    </div>
</main>

<script src="../js/inicio.js"></script>
<script src="../js/plans.js"></script>
</body>
</html>
