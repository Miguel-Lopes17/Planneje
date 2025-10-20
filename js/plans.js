// const deposito = document.querySelector(".btn-depositar")
// const caixa = document.querySelector(".view-deposito")
// const limite = document.querySelector(".definir-limite")
// const openLimite = document.getElementById('limit')
// const closeX = document.querySelector(".close-deposito")
// const closeDeposito = document.querySelector("#close-deposito")

// const closeLimite = document.querySelector(".close-limite")
// const fecharLimite = document.querySelector("#close-limite")


// //deposito
// deposito.addEventListener("click", () => {
//     caixa.style.display = "block"
// })
// closeX.addEventListener("click" , () => {
//     caixa.style.display = "none"
// })
// closeDeposito.addEventListener("click" , () => {
//     caixa.style.display = "none"

// })

// //limite diário
// openLimite.addEventListener("click" , () => {
//     limite.style.display = "block"
// })

// closeLimite.addEventListener("click" , () => {
//     limite.style.display = "none"
// })

// fecharLimite.addEventListener("click" , () => {
//     limite.style.display = "none"
// })


// Gerenciamento de upload de documentos - VERSÃO CORRIGIDA
// Gerenciamento de upload de documentos - VERSÃO COMPLETA
document.getElementById('documentUpload').addEventListener('change', function(e) {
    const files = e.target.files;
    const preview = document.getElementById('documentsPreview');
    
    for (let i = 0; i < files.length; i++) {
        const file = files[i];
        const documentItem = document.createElement('div');
        documentItem.className = 'document-item';
        documentItem.setAttribute('data-filename', file.name);
        
        // Container para o conteúdo do documento
        const docContent = document.createElement('div');
        docContent.className = 'doc-content';
        
        // Botão de remover
        const removeBtn = document.createElement('button');
        removeBtn.className = 'remove-doc';
        removeBtn.innerHTML = '&times;';
        removeBtn.onclick = function() {
            documentItem.remove();
        };
        
        // Verificar se é imagem ou PDF
        if (file.type.startsWith('image/')) {
            // Para imagens, criar elemento img
            const img = document.createElement('img');
            img.className = 'document-preview';
            img.alt = file.name;
            
            // Ler a imagem e criar preview
            const reader = new FileReader();
            reader.onload = function(e) {
                img.src = e.target.result;
                
                // Adicionar evento de clique para ampliar
                img.addEventListener('click', function() {
                    openImageModal(e.target.result, file.name);
                });
            };
            reader.readAsDataURL(file);
            
            docContent.appendChild(img);
        } else {
            // Para PDFs e outros arquivos, mostrar ícone
            const icon = document.createElement('i');
            icon.className = file.type === 'application/pdf' ? 'bi bi-file-pdf' : 'bi bi-file-earmark';
            icon.style.fontSize = '3rem';
            icon.style.color = 'var(--roxo)';
            
            docContent.appendChild(icon);
        }
        
        // Nome do arquivo (truncado se for muito longo)
        const name = document.createElement('span');
        name.className = 'doc-name';
        name.textContent = file.name.length > 15 ? file.name.substring(0, 12) + '...' : file.name;
        name.title = file.name;
        
        docContent.appendChild(name);
        documentItem.appendChild(docContent);
        documentItem.appendChild(removeBtn);
        preview.appendChild(documentItem);
    }
    
    // Limpar o input para permitir selecionar os mesmos arquivos novamente
    this.value = '';
});

// Função para abrir modal com imagem ampliada
function openImageModal(imageSrc, fileName) {
    // Criar modal se não existir
    let modal = document.getElementById('imageModal');
    if (!modal) {
        modal = document.createElement('div');
        modal.id = 'imageModal';
        modal.className = 'image-modal';
        modal.innerHTML = `
            <div class="image-modal-content">
                <button class="close-image-modal">&times;</button>
                <img src="${imageSrc}" alt="${fileName}" class="enlarged-image">
                <div class="image-modal-footer">
                    <span class="image-filename">${fileName}</span>
                    <button class="download-image-btn">Download</button>
                </div>
            </div>
        `;
        document.body.appendChild(modal);
        
        // Evento para fechar modal
        modal.querySelector('.close-image-modal').addEventListener('click', closeImageModal);
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeImageModal();
            }
        });
        
        // Evento para download
        modal.querySelector('.download-image-btn').addEventListener('click', function() {
            downloadImage(imageSrc, fileName);
        });
    } else {
        // Atualizar modal existente
        modal.querySelector('.enlarged-image').src = imageSrc;
        modal.querySelector('.enlarged-image').alt = fileName;
        modal.querySelector('.image-filename').textContent = fileName;
        
        // Atualizar evento de download
        const downloadBtn = modal.querySelector('.download-image-btn');
        downloadBtn.replaceWith(downloadBtn.cloneNode(true));
        modal.querySelector('.download-image-btn').addEventListener('click', function() {
            downloadImage(imageSrc, fileName);
        });
    }
    
    modal.style.display = 'flex';
}

// Função para fechar modal de imagem
function closeImageModal() {
    const modal = document.getElementById('imageModal');
    if (modal) {
        modal.style.display = 'none';
    }
}

// Função para download da imagem
function downloadImage(imageSrc, fileName) {
    const link = document.createElement('a');
    link.href = imageSrc;
    link.download = fileName;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}




  let budget = { current: 0, target: 0 };
        let daily = { limit: 0, spent: 0 };

        // Função única para modais
        function toggleModal(modalId, show = true) {
            document.getElementById(modalId).style.display = show ? 'flex' : 'none';
        }

        // Função única para confirmar ações
        function confirmAction(type) {
            const inputs = {
                budget: 'budgetTarget',
                deposit: 'depositAmount', 
                limit: 'dailyLimit'
            };
            
            const value = parseFloat(document.getElementById(inputs[type]).value);
            
            if (!value || value <= 0) {
                alert('Por favor, insira um valor válido.');
                return;
            }
            
            switch(type) {
                case 'budget':
                    budget.target = value;
                    break;
                case 'deposit':
                    if (budget.current + value > budget.target) {
                        alert(`Depósito excede o orçamento! Máximo: R$ ${budget.target}`);
                        return;
                    }
                    budget.current += value;
                    break;
                case 'limit':
                    daily.limit = value;
                    daily.spent = 0;
                    break;
            }
            
            updateDisplays();
            toggleModal(type === 'budget' ? 'budgetModal' : type === 'deposit' ? 'depositModal' : 'limitModal', false);
            document.getElementById(inputs[type]).value = '';
        }

        // Atualizar todas as exibições
        function updateDisplays() {
            // Orçamento
            const progress = budget.target > 0 ? (budget.current / budget.target) * 100 : 0;
            document.getElementById('budgetProgress').style.width = `${Math.min(progress, 100)}%`;
            
            document.querySelector('.orcamento .valorTotal').textContent = 
                budget.target > 0 ? `R$ ${budget.current} / R$ ${budget.target}` : 'Defina seu orçamento';
            
            document.querySelector('.orcamento .valorRestante').textContent = 
                `Valor Restante: R$ ${Math.max(budget.target - budget.current, 0)}`;
            
            // Limite diário
            const dailyProgress = daily.limit > 0 ? (daily.spent / daily.limit) * 100 : 0;
            document.getElementById('dailyLimitProgress').style.width = `${Math.min(dailyProgress, 100)}%`;
            
            document.querySelector('.limite-diario .valorTotal').textContent = 
                `R$ ${daily.spent} / R$ ${daily.limit}`;
            
            document.querySelector('.limite-diario .valorRestante').textContent = 
                `Valor Gasto: R$ ${daily.spent}`;
        }

        // Funções para salvar informações
        function saveTravelInfo() {
            const destination = document.getElementById('destination').value;
            const departureDate = document.getElementById('departureDate').value;
            const returnDate = document.getElementById('returnDate').value;
            const accommodation = document.getElementById('accommodation').value;
            
            console.log('Informações de viagem salvas:', {
                destination,
                departureDate,
                returnDate,
                accommodation
            });
            
            alert('Informações de viagem salvas com sucesso!');
        }

        function saveMedicalInfo() {
            const bloodType = document.getElementById('bloodType').value;
            const allergies = document.getElementById('allergies').value;
            const medications = document.getElementById('medications').value;
            const emergencyContact = document.getElementById('emergencyContact').value;
            
            console.log('Informações médicas salvas:', {
                bloodType,
                allergies,
                medications,
                emergencyContact
            });
            
            alert('Informações médicas salvas com sucesso!');
        }

        // Gerenciamento de upload de documentos
        document.getElementById('documentUpload').addEventListener('change', function(e) {
            const files = e.target.files;
            const preview = document.getElementById('documentsPreview');
            
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const documentItem = document.createElement('div');
                documentItem.className = 'document-item';
                
                const icon = document.createElement('i');
                icon.className = file.type === 'application/pdf' ? 'bi bi-file-pdf' : 'bi bi-file-image';
                
                const name = document.createElement('span');
                name.textContent = file.name;
                
                documentItem.appendChild(icon);
                documentItem.appendChild(name);
                preview.appendChild(documentItem);
            }
        });

        // Inicialização
        document.addEventListener('DOMContentLoaded', updateDisplays);

        // Funções para salvar informações
        function saveTravelInfo() {
            const destination = document.getElementById('destination').value;
            const departureDate = document.getElementById('departureDate').value;
            const returnDate = document.getElementById('returnDate').value;
            const accommodation = document.getElementById('accommodation').value;
            
            // Aqui você normalmente enviaria os dados para um servidor
            console.log('Informações de viagem salvas:', {
                destination,
                departureDate,
                returnDate,
                accommodation
            });
            
            alert('Informações de viagem salvas com sucesso!');
        }

        function saveMedicalInfo() {
            const bloodType = document.getElementById('bloodType').value;
            const allergies = document.getElementById('allergies').value;
            const medications = document.getElementById('medications').value;
            const emergencyContact = document.getElementById('emergencyContact').value;
            
            // Aqui você normalmente enviaria os dados para um servidor
            console.log('Informações médicas salvas:', {
                bloodType,
                allergies,
                medications,
                emergencyContact
            });
            
            alert('Informações médicas salvas com sucesso!');
        }

        // Gerenciamento de upload de documentos
        document.getElementById('documentUpload').addEventListener('change', function(e) {
            const files = e.target.files;
            const preview = document.getElementById('documentsPreview');
            
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const documentItem = document.createElement('div');
                documentItem.className = 'document-item';
                
                const icon = document.createElement('i');
                icon.className = file.type === 'application/pdf' ? 'bi bi-file-pdf' : 'bi bi-file-image';
                
                const name = document.createElement('span');
                name.textContent = file.name;
                
                documentItem.appendChild(icon);
                documentItem.appendChild(name);
                preview.appendChild(documentItem);
            }
        });

        // Inicialização
        document.addEventListener('DOMContentLoaded', function() {
            atualizarOrcamento();
            atualizarLimiteDiario();
        });



