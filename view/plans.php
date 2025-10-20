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

.tab-container {
    display: flex;
    flex-wrap: wrap;
    gap: 30px;
}

.tab-content {
    display: flex;
    flex-direction: column;
    margin-top:3%;
    margin-left: 4%;
    padding: 15px;
    width: 55%;
    border-radius: 8px;
    box-shadow: 0px 2px 2px 4px #0000003f;
    gap: 50px;
}

.section {
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 20px;
    background: #f5f5f5;
    border-radius: 10px;
}

#sectio1 {
    border-left: 6px solid  #2cd212;
}
#sectio3 {
    border-left: 6px solid  #fffb18;
}
#sectio4 {
    border-left: 6px solid  #ff9615;
}

.upload-btn {
    display: inline-block;
    padding: 10px 20px;
    background: var(--roxo);
    color: white;
    border-radius: 6px;
    cursor: pointer;
    transition: background 0.3s;
}

.upload-btn:hover {
    background: var(--lilas);
}

#documentUpload {
    display: none;
}


.document-item {
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 10px;
    background: var(--cinza-claro);
    border-radius: 8px;
    text-align: center;
    width: 120px;
    margin: 5px;
}

.doc-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 5px;
}

.document-preview {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 6px;
    border: 2px solid var(--roxo);
}

.doc-name {
    font-size: 0.8rem;
    color: var(--cinza-escuro);
    word-break: break-word;
    max-width: 100px;
}

.remove-doc {
    position: absolute;
    top: -5px;
    right: -5px;
    background: var(--vermelho);
    color: white;
    border: none;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    font-size: 12px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0;
}

.remove-doc:hover {
    background: #c82333;
}

.documents-preview {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    margin-top: 1rem;
}

/* Modal para imagem ampliada */
.image-modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.9);
    z-index: 2000;
    justify-content: center;
    align-items: center;
    padding: 20px;
}

.image-modal-content {
    position: relative;
    background: white;
    border-radius: 10px;
    max-width: 90%;
    max-height: 90%;
    display: flex;
    flex-direction: column;
}

.enlarged-image {
    max-width: 100%;
    max-height: 80vh;
    object-fit: contain;
    border-radius: 8px 8px 0 0;
}

.close-image-modal {
    position: absolute;
    top: 10px;
    right: 10px;
    background: var(--vermelho);
    color: white;
    border: none;
    border-radius: 50%;
    width: 30px;
    height: 30px;
    font-size: 18px;
    cursor: pointer;
    z-index: 2001;
}

.image-modal-footer {
    padding: 15px;
    background: var(--cinza-claro);
    border-radius: 0 0 8px 8px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.image-filename {
    font-weight: 600;
    color: var(--cinza-escuro);
}

.download-image-btn {
    background: var(--roxo);
    color: white;
    border: none;
    padding: 8px 15px;
    border-radius: 4px;
    cursor: pointer;
    font-weight: 600;
}

.download-image-btn:hover {
    background: var(--roxo-escuro);
}

/* Adicionar cursor pointer nas imagens do preview */
.document-preview {
    cursor: pointer;
    transition: transform 0.2s;
}

.document-preview:hover {
    transform: scale(1.05);
}

/* Formulários */
.budget-form,
.travel-info,
.medical-info {
    display: grid;
    gap: 1rem;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group label {
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: var(--dark-text);
}

.budget-input,
.form-group input,
.form-group select,
.form-group textarea {
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 6px;
    font-size: 1rem;
    transition: border 0.3s;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: var(--roxo);
}

.form-group textarea {
    resize: vertical;
    min-height: 80px;
}

.btn-save {
    padding: 10px 20px;
    background: var(--roxo);
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 600;
    transition: background 0.3s;
    justify-self: start;
    margin-bottom: 2%;
}

.btn-save:hover {
    background: var(--lilas);
}

/* Responsividade */
@media (max-width: 768px) {
    .section {
        padding: 1rem;
    }
    
    .budget-form,
    .travel-info,
    .medical-info {
        grid-template-columns: 1fr;
    }
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
                    <span class="tab-title"><?php echo $nome ?></span>
                    <button class="close-tab">&times;</button>
                </div>
                <button class="add-tab">+</button>
            </div>
        </div>

        <div class="tab-container">
            <div class="tab-content">
                <h3>Minhas informações</h3>

                <div class="section" id="sectio1">
                    <h4 style="margin-left:  2%;"><i class="bi bi-file-earmark"></i> Documentos</h4>
                    <div class="document-upload" style="margin-left:  2%;"">
                    <input type="file" id="documentUpload" accept="image/*,.pdf" multiple>
                        <label for="documentUpload" class="upload-btn">
                            <i class="bi bi-cloud-upload"></i> Adicionar Documentos
                        </label>
                        <div class="documents-preview" id="documentsPreview"></div>
                    </div>
                </div>

                <!-- Seção de Informações da Viagem -->
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

                <!-- Seção de Saúde -->
                <div class="section" id="sectio4">
                    <h4 style="margin-left:  2%;"><i class="bi bi-heart-pulse"></i> Informações Médicas</h4>
                    <div class="medical-info" style="margin-left:  2%;">
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
                            <textarea id="allergies" placeholder="Liste suas alergias..."></textarea>
                        </div>
                        <div class="form-group">
                            <label>Medicações:</label>
                            <textarea id="medications" placeholder="Liste medicações em uso..."></textarea>
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