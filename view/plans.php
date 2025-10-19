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

        .container-user {
            display: flex;
            background: var(--roxo);
            align-items: center;
            gap: 2rem;
        }

        :root {
            --roxo: #6a0dad;
            --roxo-claro: #8a2be2;
            --roxo-escuro: #4b0082;
            --cinza-claro: #f5f5f5;
            --cinza-medio: #e0e0e0;
            --cinza-escuro: #333;
            --branco: #ffffff;
            --verde: #28a745;
            --vermelho: #dc3545;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--cinza-claro);
            color: var(--cinza-escuro);
            line-height: 1.6;
        }

        .tab-container {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .tabs-content {
            flex: 1;
            min-width: 300px;
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        .section {
            background-color: var(--branco);
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            transition: transform 0.3s ease;
        }

        .section:hover {
            transform: translateY(-5px);
        }

        .section h4 {
            color: var(--roxo);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section h4 i {
            font-size: 1.2rem;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: var(--cinza-escuro);
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--cinza-medio);
            border-radius: 4px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: var(--roxo);
            outline: none;
            box-shadow: 0 0 0 2px rgba(106, 13, 173, 0.2);
        }

        .btn-save {
            background-color: var(--roxo);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            transition: background-color 0.3s;
        }

        .btn-save:hover {
            background-color: var(--roxo-escuro);
        }

        .document-upload {
            margin-top: 10px;
        }

        .upload-btn {
            display: inline-block;
            background-color: var(--cinza-claro);
            color: var(--cinza-escuro);
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            border: 1px dashed var(--cinza-medio);
            transition: all 0.3s;
        }

        .upload-btn:hover {
            background-color: var(--cinza-medio);
        }

        .documents-preview {
            margin-top: 15px;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .document-item {
            background-color: var(--cinza-claro);
            padding: 8px 12px;
            border-radius: 4px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
        }

        .document-item i {
            color: var(--roxo);
        }

        .gastos {
            flex: 0 0 300px;
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        .orcamento, .limite-diario {
            background-color: var(--branco);
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .orcamento h3, .limite-diario h3 {
            color: var(--roxo);
            margin-bottom: 15px;
        }

        .deposito {
            margin-bottom: 15px;
        }

        .valorTotal {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--roxo);
        }

        .valorRestante {
            color: var(--cinza-escuro);
            margin-top: 5px;
        }

        .btn-depositar {
            background-color: var(--roxo);
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            width: 100%;
            transition: background-color 0.3s;
        }

        .btn-depositar:hover {
            background-color: var(--roxo-escuro);
        }

        .progress-bar {
            height: 10px;
            background-color: var(--cinza-medio);
            border-radius: 5px;
            margin: 10px 0;
            overflow: hidden;
        }

        .progress {
            height: 100%;
            background-color: var(--verde);
            border-radius: 5px;
            transition: width 0.5s ease;
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: var(--branco);
            padding: 25px;
            border-radius: 8px;
            width: 90%;
            max-width: 400px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .modal h3 {
            margin-bottom: 15px;
            color: var(--roxo);
        }

        .modal-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }

        .modal-buttons button {
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 600;
        }

        .btn-confirm {
            background-color: var(--roxo);
            color: white;
        }

        .btn-cancel {
            background-color: var(--cinza-medio);
            color: var(--cinza-escuro);
        }

        @media (max-width: 768px) {
            .tab-container {
                flex-direction: column;
            }
            
            .gastos {
                flex: 1;
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
            <li><a href="#">Planos arquivados</a></li>
            <li><a href="#">Compartilhar</a></li>
            <li><a href="#">Autenticador</a></li>
            <li><a href="#">Documentos</a></li>
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
                    <h1>Planeje</h1>
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
        <div class="tabs-content">
            <div class="section">
                <h3>Minhas informações</h3>
                <p>Gerencie suas informações pessoais e documentos importantes para a viagem.</p>
            </div>

            <div class="section" id="section1">
                <h4><i class="bi bi-file-earmark"></i> Documentos</h4>
                <div class="document-upload">
                    <input type="file" id="documentUpload" accept="image/*,.pdf" multiple style="display: none;">
                    <label for="documentUpload" class="upload-btn">
                        <i class="bi bi-cloud-upload"></i> Adicionar Documentos
                    </label>
                    <div class="documents-preview" id="documentsPreview"></div>
                </div>
            </div>

            <div class="section" id="section2">
                <h4><i class="bi bi-geo-alt"></i> Informações da Viagem</h4>
                <div class="travel-info">
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

            <div class="section" id="section3">
                <h4><i class="bi bi-heart-pulse"></i> Informações Médicas</h4>
                <div class="medical-info">
                    <div class="form-group">
                        <label>Tipo Sanguíneo:</label>
                        <select id="bloodType">
                            <option value="">Selecionar</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Alergias:</label>
                        <textarea id="allergies" placeholder="Liste suas alergias..." rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Medicações:</label>
                        <textarea id="medications" placeholder="Liste medicações em uso..." rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Contato de Emergência:</label>
                        <input type="text" id="emergencyContact" placeholder="Nome e telefone">
                    </div>
                    <button class="btn-save" onclick="saveMedicalInfo()">Salvar Informações</button>
                </div>
            </div>
        </div>

        <div class="gastos">
            <div class="orcamento">
                <h3>Orçamento da Viagem</h3>
                <div class="deposito">
                    <p class="valorTotal">R$ 1200 / R$ 3000</p>
                    <div class="progress-bar">
                        <div class="progress" id="budgetProgress" style="width: 40%"></div>
                    </div>
                    <p class="valorRestante">Valor Restante: R$ 1800</p>
                </div>
                <button class="btn-depositar" onclick="abrirCaixa()">Depositar</button>
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
                <button class="btn-depositar" onclick="definirLimite()">Definir Limite</button>
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
                <button class="btn-cancel" onclick="fecharModal('depositModal')">Cancelar</button>
                <button class="btn-confirm" onclick="confirmarDeposito()">Confirmar</button>
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
                <button class="btn-cancel" onclick="fecharModal('limitModal')">Cancelar</button>
                <button class="btn-confirm" onclick="confirmarLimite()">Confirmar</button>
            </div>
        </div>
    </div>


    </main>


    <script src="../js/inicio.js"></script>
    <script src="../js/plans.js"></script>
</body>

</html>