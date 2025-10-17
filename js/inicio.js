const sidebar = document.querySelector(".sidebar");
const closeBtn = document.querySelector(".close-btn");
const menuToggle = document.querySelector(".menu-toggle");

closeBtn.addEventListener("click", () => {
    sidebar.classList.add("collapsed");
    menuToggle.style.display = "block"; // reaparece
});

menuToggle.addEventListener("click", () => {
    sidebar.classList.remove("collapsed");
    menuToggle.style.display = "none"; // some quando abrir
});





document.addEventListener('DOMContentLoaded', function () {
    // Elementos do DOM
    const addPlanButton = document.getElementById('addPlanButton');
    const planModal = document.getElementById('planModal');
    const closeModal = document.getElementById('closeModal');
    const cancelButton = document.getElementById('cancelButton');
    const planForm = document.getElementById('planForm');
    const modalTitle = document.getElementById('modalTitle');
    const planIdInput = document.getElementById('planId');
    const destinationInput = document.getElementById('destination');
    const descriptionInput = document.getElementById('description');
    const contextMenu = document.getElementById('contextMenu');
    const planosContainer = document.querySelector('.planos');

    // Variáveis de estado
    let currentPlanElement = null;
    let plans = JSON.parse(localStorage.getItem('travelPlans')) || [];

    // Carregar planos salvos
    loadPlans();

    // Event Listeners
    addPlanButton.addEventListener('click', openAddModal);
    closeModal.addEventListener('click', closeModalHandler);
    cancelButton.addEventListener('click', closeModalHandler);
    planForm.addEventListener('submit', savePlan);
    document.addEventListener('click', closeContextMenu);

    // Função para abrir o modal de adicionar plano
    function openAddModal() {
        modalTitle.textContent = 'Adicionar Novo Plano';
        planIdInput.value = '';
        destinationInput.value = '';
        descriptionInput.value = '';
        planModal.classList.add('show');
    }

    // Função para abrir o modal de edição
    function openEditModal(plan) {
        modalTitle.textContent = 'Editar Plano';
        planIdInput.value = plan.id;
        destinationInput.value = plan.destination;
        descriptionInput.value = plan.description || '';
        planModal.classList.add('show');
    }

    // Fechar o modal
    function closeModalHandler() {
        planModal.classList.remove('show');
    }

    // Salvar plano (adicionar ou editar)
    function savePlan(e) {
        e.preventDefault();

        const planId = planIdInput.value;
        const destination = destinationInput.value;
        const description = descriptionInput.value;

        if (planId) {
            // Editar plano existente
            const index = plans.findIndex(plan => plan.id === planId);
            if (index !== -1) {
                plans[index].destination = destination;
                plans[index].description = description;
            }
        } else {
            // Adicionar novo plano
            const newPlan = {
                id: Date.now().toString(),
                destination,
                description,
                createdAt: new Date().toISOString()
            };
            plans.push(newPlan);
        }

        // Salvar no localStorage
        localStorage.setItem('travelPlans', JSON.stringify(plans));

        // Recarregar a lista de planos
        loadPlans();

        // Fechar o modal
        closeModalHandler();
    }

    // Carregar planos na interface
    function loadPlans() {
        // Limpar planos existentes (exceto o botão de adicionar)
        const planElements = document.querySelectorAll('.plan-file');
        planElements.forEach(element => element.remove());

        // Adicionar cada plano à interface
        plans.forEach(plan => {
            const planElement = document.createElement('div');
            planElement.className = 'plan-file';
            planElement.dataset.id = plan.id;

            planElement.innerHTML = `
                        <div class="file-content">
                            <i class="bi bi-folder-fill"></i>
                            <p>${plan.destination}</p>
                        </div>
                        <div class="title-container">
                            <p class="title-file">${plan.destination}</p>
                        </div>
                        <div class="file-actions">
                            <button class="edit" aria-label="Ações do plano">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                        </div>
                    `;

            // Inserir antes do botão de adicionar
            planosContainer.insertBefore(planElement, addPlanButton);

            // Adicionar evento de clique ao botão de três pontos
            const editButton = planElement.querySelector('.edit');
            editButton.addEventListener('click', function (e) {
                e.stopPropagation();
                showContextMenu(this, plan);
            });

            // Adicionar evento de clique para abrir o plano
            planElement.addEventListener('click', function () {
                viewPlan(plan);
            });
        });
    }

    // Mostrar menu de contexto
    function showContextMenu(button, plan) {
        // Posicionar o menu de contexto
        const rect = button.getBoundingClientRect();
        contextMenu.style.top = `${rect.bottom + window.scrollY}px`;
        contextMenu.style.left = `${rect.left + window.scrollX - 130}px`;

        // Armazenar o plano atual
        currentPlanElement = plan;

        // Mostrar o menu
        contextMenu.classList.add('show');

        // Adicionar eventos às opções do menu
        const menuItems = contextMenu.querySelectorAll('.dropdown-item');
        menuItems.forEach(item => {
            item.onclick = function () {
                const action = this.dataset.action;
                handleContextMenuAction(action, plan);
            };
        });
    }

    // Fechar menu de contexto ao clicar em qualquer lugar
    function closeContextMenu(e) {
        if (!contextMenu.contains(e.target) && !e.target.classList.contains('edit')) {
            contextMenu.classList.remove('show');
        }
    }

    // Manipular ações do menu de contexto
    function handleContextMenuAction(action, plan) {
        contextMenu.classList.remove('show');

        switch (action) {
            case 'view':
                viewPlan(plan);
                break;
            case 'edit':
                openEditModal(plan);
                break;
            case 'delete':
                deletePlan(plan);
                break;
        }
    }

    // Visualizar plano
    function viewPlan(plan) {
        window.location.href = `plans.php?`
        // Aqui você implementaria a navegação para a página de detalhes do plano
    }

    // Excluir plano
    function deletePlan(plan) {
        if (confirm(`Tem certeza que deseja excluir o plano "${plan.destination}"?`)) {
            // Remover do array
            plans = plans.filter(p => p.id !== plan.id);

            // Atualizar localStorage
            localStorage.setItem('travelPlans', JSON.stringify(plans));

            // Recarregar a interface
            loadPlans();
        }
    }
});







document.addEventListener("DOMContentLoaded", () => {
    let tabIdCounter = 3;

    const tabsContainer = document.querySelector('.tabs-container');
    const contentContainer = document.querySelector('.tabs-content');
    const addTabButton = tabsContainer.querySelector('.add-tab');

    // Troca aba ativa
    tabsContainer.addEventListener('click', (e) => {
        const tab = e.target.closest('.tab');
        if (tab && !e.target.classList.contains('close-tab')) {
            const id = tab.dataset.id;
            setActiveTab(id);
        }
    });

    // Fecha aba
    tabsContainer.addEventListener('click', (e) => {
        if (e.target.classList.contains('close-tab')) {
            const tab = e.target.parentElement;
            const id = tab.dataset.id;
            const isActive = tab.classList.contains('active');

            // Remove aba e conteúdo
            tab.remove();
            const content = contentContainer.querySelector(`.tab-content[data-id="${id}"]`);
            if (content) content.remove();

            // Ativar próxima aba, se a ativa for removida
            if (isActive) {
                const nextTab = tabsContainer.querySelector('.tab');
                if (nextTab) setActiveTab(nextTab.dataset.id);
            }
        }
    });

    // Adiciona nova aba
    addTabButton.addEventListener('click', () => {
        const newId = tabIdCounter++;
        const newTab = document.createElement('div');
        newTab.className = 'tab';
        newTab.dataset.id = newId;
        newTab.innerHTML = `
            <span class="tab-title">Nova Aba</span>
            <button class="close-tab">&times;</button>
        `;
        tabsContainer.insertBefore(newTab, addTabButton);

        const newContent = document.createElement('div');
        newContent.className = 'tab-content';
        newContent.dataset.id = newId;
        newContent.innerHTML = `<p>Conteúdo da Nova Aba ${newId}</p>`;
        contentContainer.appendChild(newContent);

        setActiveTab(newId);
    });

    // Ativa a aba e conteúdo correspondente
    function setActiveTab(id) {
        document.querySelectorAll('.tab').forEach(tab => {
            tab.classList.toggle('active', tab.dataset.id === id);
        });
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.toggle('active', content.dataset.id === id);
        });
    }
});








