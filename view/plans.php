<?php include '../backend/includes/usrdados.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Open+Sans:wght@400;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="../css/file.css">
    <title>Planneje - Meus Planos</title>

    <style>

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

            .logo {
                margin-left: 35%;
            }
        }
    </style>

</head>

<body>

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
                    <p class="email">
                        <?php echo $email ?>
                    </p>
                    <p class="cpf">
                        <?php echo $cpf ?>
                    </p>
                </div>
            </div>
            <button class="logout-btn">Sair</button>
        </div>
    </aside>
    <header class="main-header">
        <div class="container">

            <div class="logo">
                <a href="/index.php">
                    <h1><a style="text-decoration: none; color: #6A0DAD;" href="./inicio.php">Planeje</a></h1>
                </a>
            </div>
        </div>

    </header>

    <main class="main">
        <div class="container-user">
            <div class="tabs-container">
                <div class="tab active" data-id="1">
                    <span class="tab-title">
                        <?php echo $nome ?>
                    </span>
                    <button class="close-tab">&times;</button>
                </div>
                <button class="add-tab">+</button>
            </div>
        </div>

        <div class="tab-container">
            <div class="tab-content">
                <div>
                    <h3>Minhas informações</h3>
                    <p>Gerencie suas informações pessoais e documentos importantes para a viagem.</p>
                </div>


                <div class="section" id="sectio1">
                    <h4 style="margin-left: 2%;"><i class="bi bi-file-earmark"></i> Documentos</h4>
                    <div class="document-upload" style="margin-left: 2%;">
                        <input type="file" id="documentUpload1" accept="image/*,.pdf" multiple>
                        <label for="documentUpload1" class="upload-btn">
                            <i class="bi bi-cloud-upload"></i> Adicionar Documentos
                        </label>
                        <div class="documents-preview" id="documentsPreview1"></div>
                    </div>
                </div>

                
                <div class="section" id="sectio3">
                    <h4 style="margin-left:  2%;"><i class="bi bi-geo-alt"></i> Informações da Viagem</h4>
                    <div class="travel-info" style="margin-left:  2%;">
                        <div class="form-group">
                            <label>Destino:</label>
                            <input type="text" id="destination" placeholder="Para onde vamos?">
                        </div>
                        <div class="form-group">
                            <label>Data de Ida:</label>
                            <input type="date" id="departureDate">
                        </div>
                        <div class="form-group">
                            <label>Data de Volta:</label>
                            <input type="date" id="returnDate">
                        </div>
                        <div class="form-group">
                            <label>Hotel/Hospedagem:</label>
                            <input type="text" id="accommodation" placeholder="Onde vamos ficar?">
                        </div>
                        <button class="btn-save" onclick="saveTravelInfo()">Salvar Informações</button>
                    </div>
                </div>

                
                <div class="section" id="sectio4">
                    <h4 style="margin-left: 2%;"><i class="bi bi-heart-pulse"></i> Informações Médicas</h4>
                    <div class="document-upload" style="margin-left: 2%;">
                        <input type="file" id="documentUpload4" accept="image/*,.pdf" multiple>
                        <label for="documentUpload4" class="upload-btn">
                            <i class="bi bi-cloud-upload"></i> Adicionar Documentos
                        </label>
                        <div class="documents-preview" id="documentsPreview4"></div>
                    </div>
                </div>
            </div>

            <div class="gastos">
                <div class="orcamento">
                    <h3>Orçamento da Viagem</h3>
                    <div class="deposito">
                        <p class="valorTotal">R$ 0 / R$ 0</p>
                        <div class="progress-bar">
                            <div class="progress" id="budgetProgress" style="width: 0%"></div>
                        </div>
                        <p class="valorRestante">Valor Restante: R$ 0</p>
                    </div>
                    <button class="btn-depositar" onclick="toggleModal('budgetModal')">Definir Orçamento</button>
                    <button class="btn-depositar" onclick="toggleModal('depositModal')">Depositar</button>
                </div>

                <div class="limite-diario">
                    <h3>Limite Diário</h3>
                    <div class="deposito">
                        <p class="valorTotal">R$ 0 / R$ 0</p>
                        <div class="progress-bar">
                            <div class="progress" id="dailyLimitProgress" style="width: 0%"></div>
                        </div>
                        <p class="valorRestante">Valor Gasto: R$ 0</p>
                    </div>
                    <button class="btn-depositar" onclick="toggleModal('limitModal')">Definir Limite</button>
                </div>
            </div>
        </div>

        <!-- Modal para definir orçamento -->
        <div class="modal" id="budgetModal">
            <div class="modal-content">
                <h3>Definir Orçamento</h3>
                <div class="form-group">
                    <label>Valor total do orçamento (R$):</label>
                    <input type="number" id="budgetTarget" min="1" placeholder="Digite o valor total">
                </div>
                <div class="modal-buttons">
                    <button class="btn-cancel" onclick="toggleModal('budgetModal', false)">Cancelar</button>
                    <button class="btn-confirm" onclick="confirmAction('budget')">Confirmar</button>
                </div>
            </div>
        </div>

        <!-- Modal para depósito -->
        <div class="modal" id="depositModal">
            <div class="modal-content">
                <h3>Depositar para Viagem</h3>
                <div class="form-group">
                    <label>Valor a depositar (R$):</label>
                    <input type="number" id="depositAmount" min="1" placeholder="Digite o valor">
                </div>
                <div class="modal-buttons">
                    <button class="btn-cancel" onclick="toggleModal('depositModal', false)">Cancelar</button>
                    <button class="btn-confirm" onclick="confirmAction('deposit')">Confirmar</button>
                </div>
            </div>
        </div>

        <!-- Modal para definir limite diário -->
        <div class="modal" id="limitModal">
            <div class="modal-content">
                <h3>Definir Limite Diário</h3>
                <div class="form-group">
                    <label>Limite diário (R$):</label>
                    <input type="number" id="dailyLimit" min="1" placeholder="Digite o valor">
                </div>
                <div class="modal-buttons">
                    <button class="btn-cancel" onclick="toggleModal('limitModal', false)">Cancelar</button>
                    <button class="btn-confirm" onclick="confirmAction('limit')">Confirmar</button>
                </div>
            </div>
        </div>
    </main>


    <script src="../js/inicio.js"></script>
    <script src="../js/plans.js"></script>
</body>

</html>