<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planeje</title>
    <link rel="stylesheet" href="css/style.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Open+Sans:wght@400;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=arrow_forward" />

        <style>
            :root {
    --primary-color: #6A0DAD;
    --secondary-color: #9B51E0;
    --light-purple: #E8D5FF;
    --white: #FFFFFF;
    --light-gray: #F5F5F5;
    --dark-text: #333333;
    --accent: #FFD700;
    --roxo-escuro: #4f0782;
}
            .main-nav {
                display: flex;
                justify-content: center;
                /* border: 2px solid red; */
                gap: 30px;
            }

            .main-sing {
                display: flex;
                gap: 40px;
            }

            @media screen and (max-width: 1000px) {
                .sing-up {
                    background: none;
                    color: var(--primary-color);
                    border-bottom: 3px solid var(--primary-color);
                    border-radius: 0px;
                    padding: 7px;
                }

                .sing-in {
                    border-bottom: 3px solid var(--primary-color);
                    border-radius: 0px;
                    padding: 7px;
                    width: 200px;
                }

                .logo {
                    margin-left: 0%;
                }
            }
        </style>
</head>

<body>
    <header class="main-header">
        <div class="container">
            <div class="logo">
                <h1>Planeje</h1>
            </div>
            <nav class="main-nav">
                <ul class="main-sing">
                    <li><a class="sing-in" href="./view/login.php">Entrar</a></li>
                    <li><a class="sing-up" href="./view/cadastrar.php">Criar conta</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="hero">
        <div class="hero-overlay"></div>
        <div class="container">
            <div class="hero-content">
                <h2>Organize sua viagem dos sonhos em um só lugar</h2>
                <p>Tudo o que você precisa para planejar a viagem perfeita</p>
                <button class="btn-primary"><a href="./view/cadastrar.php">Comece a Planejar</a> <span class="material-symbols-outlined">arrow_forward</span> </button>
            </div>
        </div>
        <a href="#scroll-down" class="down">
            <i class="fa-solid fa-chevron-down"></i>
        </a>
    </section>
            
    <section class="features" id="scroll-down">
        <div class="container" >
            <h2 class="section-title" data-aos="fade-down" data-aos-duration="1000">Como o Planeje ajuda você</h2>
            <p class="section-paragraph" data-aos="fade-down" data-aos-duration="1000">Ferramentas inteligentes para
                organizar cada aspecto da sua viagem</p>
            <div class="features-grid" >
                <div class="feature-card"  data-aos="fade-up" data-aos-duration="1500">
                    <div class="feature-icon">
                        <i class="fas fa-passport"></i>
                    </div>
                    <h3>Documentos</h3>
                    <p>Centralize todos os documentos necessários para sua viagem com alertas de validade.</p>
                </div>
                <div class="feature-card"  data-aos="fade-up" data-aos-duration="1500">
                    <div class="feature-icon" >
                        <i class="fas fa-map-marked-alt"></i>
                    </div>
                    <h3>Roteiros</h3>
                    <p>Planeje seu itinerário diário com pontos de interesse e horários.</p>
                </div>
                <div class="feature-card"  data-aos="fade-up" data-aos-duration="1500">
                    <div class="feature-icon">
                        <i class="fas fa-heartbeat"></i>
                    </div>
                    <h3>Saúde</h3>
                    <p>Mantenha suas informações médicas e lembretes de vacinação sempre à mão.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="create-accont">
        <h1>Pronto para começar sua próxima aventura?</h1>
        <h3>Junte-se a milhares de viajantes que já organizam suas viagens com o Planeje</h3>
        <button><a href="./view/cadastrar.php">Criar Conta</a></button>
    </section>



    <footer class="main-footer">
        <div class="container">
            <div class="footer-logo">
                <h2>Planeje</h2>
            </div>
            <div class="footer-links">
                <div class="link-group">
                    <h3>Recursos</h3>
                    <ul>
                        <li><a href="#">Documentos</a></li>
                        <li><a href="#">Roteiros</a></li>
                        <li><a href="#">Checklists</a></li>
                    </ul>
                </div>
                <div class="link-group">
                    <h3>Suporte</h3>
                    <ul>
                        <li><a href="#">Ajuda</a></li>
                        <li><a href="#">Contato</a></li>
                    </ul>
                </div>
                <div class="link-group">
                    <h3>Legal</h3>
                    <ul>
                        <li><a href="#">Termos</a></li>
                        <li><a href="#">Privacidade</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-social">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 Planeje. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init();
</script>

</html>