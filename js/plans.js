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


 let travelBudget = {
            current: 0,
            target: 3000
        };
        
        let dailyLimit = {
            limit: 0,
            spent: 0
        };

        // Funções para os modais
        function abrirCaixa() {
            document.getElementById('depositModal').style.display = 'flex';
        }

        function definirLimite() {
            document.getElementById('limitModal').style.display = 'flex';
        }

        function fecharModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        function confirmarDeposito() {
            const amount = parseFloat(document.getElementById('depositAmount').value);
            if (amount && amount > 0) {
                travelBudget.current += amount;
                atualizarOrcamento();
                fecharModal('depositModal');
                document.getElementById('depositAmount').value = '';
            } else {
                alert('Por favor, insira um valor válido.');
            }
        }

        function confirmarLimite() {
            const limit = parseFloat(document.getElementById('dailyLimit').value);
            if (limit && limit > 0) {
                dailyLimit.limit = limit;
                dailyLimit.spent = 0;
                atualizarLimiteDiario();
                fecharModal('limitModal');
                document.getElementById('dailyLimit').value = '';
            } else {
                alert('Por favor, insira um valor válido.');
            }
        }

        // Atualizar exibição do orçamento
        function atualizarOrcamento() {
            const progress = (travelBudget.current / travelBudget.target) * 100;
            document.getElementById('budgetProgress').style.width = `${Math.min(progress, 100)}%`;
            
            document.querySelector('.orcamento .valorTotal').textContent = 
                `R$ ${travelBudget.current.toFixed(2)} / R$ ${travelBudget.target.toFixed(2)}`;
            
            const remaining = travelBudget.target - travelBudget.current;
            document.querySelector('.orcamento .valorRestante').textContent = 
                `Valor Restante: R$ ${remaining > 0 ? remaining.toFixed(2) : '0.00'}`;
        }

        // Atualizar exibição do limite diário
        function atualizarLimiteDiario() {
            const progress = dailyLimit.limit > 0 ? (dailyLimit.spent / dailyLimit.limit) * 100 : 0;
            document.getElementById('dailyLimitProgress').style.width = `${Math.min(progress, 100)}%`;
            
            document.querySelector('.limite-diario .valorTotal').textContent = 
                `R$ ${dailyLimit.spent.toFixed(2)} / R$ ${dailyLimit.limit.toFixed(2)}`;
            
            document.querySelector('.limite-diario .valorRestante').textContent = 
                `Valor Gasto: R$ ${dailyLimit.spent.toFixed(2)}`;
        }

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



