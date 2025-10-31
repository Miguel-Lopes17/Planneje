<?php
include '../backend/includes/usrdados.php';
include '../backend/includes/usrplans.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Open+Sans:wght@400;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="../css/plans.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <title>Planeje - Meus Planos</title>

    <style>
        /* ESTILOS ESPECÍFICOS DA PÁGINA */
        .plans1,
        .ajuda1 {
            display: none;
        }

        /* Modal específico */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            align-items: center;
            justify-content: center;
        }

        .modal.show {
            display: flex;
        }

        .modal-content {
            background: white;
            border-radius: 12px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .modal-header {
            padding: 20px;
            border-bottom: 1px solid #e0e0e0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-title {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 600;
            color: #6A0DAD;
        }

        .close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #666;
        }

        .close:hover {
            color: #333;
        }

        .form-group {
            padding: 15px 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: #333;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 1rem;
            box-sizing: border-box;
        }

        .form-control:focus {
            outline: none;
            border-color: #007bff;
        }

        .modal-footer {
            padding: 20px;
            border-top: 1px solid #e0e0e0;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.2s;
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background: #5a6268;
        }

        .btn-primary {
            background-color: #6A0DAD;
            color: white;
        }

        .btn-primary:hover {
            background-color: #5a0b95;
        }

        /* Menu de contexto */
        .dropdown-menu {
            display: none;
            position: absolute;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
            z-index: 1001;
            min-width: 150px;
            border: 1px solid #e0e0e0;
        }

        .dropdown-menu.show {
            display: block;
        }

        .dropdown-item {
            padding: 12px 15px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: background-color 0.2s;
        }

        .dropdown-item:hover {
            background: #f8f9fa;
        }

        .dropdown-item i {
            width: 16px;
            text-align: center;
        }
    </style>
</head>

<body>
    <!-- BOTÃO HAMBURGUER PARA ABRIR -->
    <button class="menu-toggle"><i class="fas fa-bars"></i></button>

    <!-- MENU LATERAL -->
    <aside class="sidebar collapsed">
        <div class="sidebar-header">
            <h3>Menu</h3>
            <button class="close-btn"><i class="fas fa-times"></i></button>
        </div>
        <ul class="sidebar-links">
            <li><a href="#">Configuração</a></li>
            <li><a href="ajuda.php">Ajuda</a></li>
            <li><a href="#">Sobre</a></li>
            <li><a href="#">Compartilhar</a></li>
            <li><a href="#" class="plans1">Meus Planos</a></li>
            <li><a href="ajuda.php" class="ajuda1">Ajuda</a></li>
        </ul>
        <div class="sidebar-footer">
            <div class="user-info">
                <div class="avatar"></div>
                <div>
                    <p class="email"><?php echo $email; ?></p>
                    <p class="cpf"><?php echo $cpf; ?></p>
                </div>
            </div>
            <button class="logout-btn">Sair</button>
        </div>
    </aside>

    <header class="main-header">
        <div class="container">
            <nav class="navbar">
                <ul class="ul-list">
                    <a href="#" class="plans">Meus Planos</a>
                    <a href="ajuda.php" class="ajuda">Ajuda</a>
                </ul>
                <div class="animation start-home"></div>
            </nav>

            <div class="logo">
                <a href="/index.php">
                    <h1>Planeje</h1>
                </a>
            </div>
        </div>

        <div class="container-user">
            <div class="user-img"></div>
            <div class="user-data">
                <p class="name">Nome: <?php echo $nome; ?></p>
                <p class="CPF">CPF: <?php echo $cpf; ?></p>
                <p class="telefone">Telefone: <?php echo $telefone; ?></p>
                <p class="EMAIL">Email: <?php echo $email; ?></p>
            </div>
        </div>
    </header>

    <main class="main">
        <div class="seen">
            <h4>Visto Recentemente <i class="bi bi-clock"></i></h4>
        </div>

        <h4>Meus Planos <i class="bi bi-card-list"></i></h4>

        <div class="planos">
            <!-- Botão de novo plano -->
            <div class="new-plan" id="addPlanButton">
                <button class="addPlan" aria-label="Adicionar novo plano">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-plus-circle plus" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                    </svg>
                </button>
                <div class="title-container">
                    <p class="title-plan">Novo Plano</p>
                </div>
            </div>

            <!-- Planos existentes -->
            <?php foreach ($planos as $plano): ?>
                <div class="plan-card" data-plan-id="<?php echo $plano['idPlano']; ?>">
                    <div class="plan-header">
                        <h3 class="plan-destination"><?php echo htmlspecialchars($plano['plaDestino']); ?></h3>
                        <button class="plan-options">
                            <i class="bi bi-three-dots-vertical"></i>
                        </button>
                    </div>
                    <div class="plan-date">
                        <i class="bi bi-calendar"></i>
                        <?php echo date('d/m/Y', strtotime($plano['plaData'])); ?>
                    </div>
                    <?php if (!empty($plano['plaDescricao'])): ?>
                        <div class="plan-description">
                            <?php echo htmlspecialchars($plano['plaDescricao']); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <!-- Modal para Adicionar/Editar Plano -->
    <div class="modal" id="planModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modalTitle">Adicionar Novo Plano</h3>
                <button class="close" id="closeModal">&times;</button>
            </div>
            <form action="../backend/includes/plans.php" method="POST" id="planForm">
                <input type="hidden" id="planId" name="planId">
                <div class="form-group">
                    <label for="destination">Destino</label>
                    <input type="text" id="destination" name="destination" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="date">Data</label>
                    <input type="date" id="date" name="date" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="description">Descrição (opcional)</label>
                    <textarea id="description" name="description" class="form-control" rows="3"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="cancelButton">Cancelar</button>
                    <button type="submit" class="btn btn-primary btnSalvar">Salvar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Menu de contexto para os três pontos -->
    <div class="dropdown-menu btnVisualizar" id="contextMenu">
        <div class="dropdown-item" data-action="view">
            <i class="bi bi-eye"></i> Visualizar
        </div>
        <div class="dropdown-item btnEditar" data-action="edit">
            <i class="bi bi-pencil"></i> Editar
        </div>
        <div class="dropdown-item btnExcluir" >
            <i class="bi bi-trash"></i> Excluir
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/ajax.js"></script>
    <script src="../js/inicio.js"></script>
</body>

</html>