// --- SIDEBAR ---
const sidebar = document.querySelector(".sidebar");
const closeBtn = document.querySelector(".close-btn");
const menuToggle = document.querySelector(".menu-toggle");

closeBtn.addEventListener("click", () => {
    sidebar.classList.add("collapsed");
    menuToggle.style.display = "block";
});

menuToggle.addEventListener("click", () => {
    sidebar.classList.remove("collapsed");
    menuToggle.style.display = "none";
});

// --- PLANOS ---
document.addEventListener('DOMContentLoaded', function () {
    // Elementos do DOM
    const addPlanButton = document.getElementById('addPlanButton');
    const btnEditar = document.querySelector('.btnEditar');
    const planModal = document.getElementById('planModal');
    const planModalEdit = document.getElementById('planModalEdit');
    const closeModal = document.getElementById('closeModal');
    const cancelButton = document.getElementById('cancelButton');
    const planForm = document.getElementById('planForm');
    const modalTitle = document.getElementById('modalTitle');
    const planIdInput = document.getElementById('planId');
    const destinationInput = document.getElementById('destination');
    const dateInput = document.getElementById('date');
    const descriptionInput = document.getElementById('description');
    const contextMenu = document.getElementById('contextMenu');
    const planosContainer = document.querySelector('.planos');

    let currentPlanElement = null;

    // --- Abrir modal de novo plano ---
    addPlanButton.addEventListener('click', () => {
        planIdInput.value = '';
        destinationInput.value = '';
        dateInput.value = '';
        descriptionInput.value = '';
        planModal.style.display = 'flex';
    });

    // --- Fechar modal ---
    const closeModalHandler = () => {
        planModal.style.display = 'none';
    };
    
    closeModal.addEventListener('click', closeModalHandler);
    cancelButton.addEventListener('click', closeModalHandler);

    // --- Fechar modal ao clicar fora ---
    window.addEventListener('click', (e) => {
        if (e.target === planModal) {
            closeModalHandler();
        }
    });

    // --- Menu de contexto para planos ---
    document.addEventListener('click', (e) => {
        // Abrir menu de contexto ao clicar nos três pontos
        if (e.target.closest('.plan-options')) {
            e.preventDefault();
            const planCard = e.target.closest('.plan-card');
            showContextMenu(e.target, planCard);
        }
        
        // Fechar menu de contexto ao clicar fora
        if (!e.target.closest('.dropdown-menu') && !e.target.closest('.plan-options')) {
            contextMenu.classList.remove('show');
        }
    });

    function showContextMenu(button, planCard) {
        const rect = button.getBoundingClientRect();
        contextMenu.style.top = `${rect.bottom + window.scrollY}px`;
        contextMenu.style.left = `${rect.left + window.scrollX - 130}px`;
        currentPlanElement = planCard;
        contextMenu.classList.add('show');

        // Atualizar eventos dos itens do menu
        const menuItems = contextMenu.querySelectorAll('.dropdown-item');
        menuItems.forEach(item => {
            item.onclick = function () {
                const action = this.dataset.action;
                handleContextMenuAction(action, planCard);
            };
        });
    }

    // --- Ações do menu (editar, excluir etc.) ---
    function handleContextMenuAction(action, planCard) {
        contextMenu.classList.remove('show');
        const planId = planCard.dataset.planId;
        const destination = planCard.querySelector('.plan-destination').textContent;
        const date = planCard.querySelector('.plan-date').textContent.replace(' ', '').split('/').reverse().join('-');
        const description = planCard.querySelector('.plan-description') ? planCard.querySelector('.plan-description').textContent : '';

        switch (action) {
            case 'view':
                viewPlan(planId);
                break;
            case 'edit':
                openEditModal(planId, destination, date, description);
                break;
            case 'delete':
                deletePlan(planId, destination, planCard);
                break;
        }
    }

    // --- Visualizar plano ---
    function viewPlan(planId) {
        window.location.href = `view_plan.php?id=${planId}`;
    }

    // --- Abrir modal de edição ---
    function openEditModal(planId, destination, date, description) {
        planIdInput.value = planId;
        destinationInput.value = destination;
        dateInput.value = date;
        descriptionInput.value = description;
        planModal.style.display = 'flex';
    }


    // --- Enviar formulário ---
    planForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validação básica
        if (!destinationInput.value || !dateInput.value) {
            alert('Por favor, preencha todos os campos obrigatórios.');
            return;
        }

        // Envia o formulário (o PHP tratará o insert/update)
        this.submit();
    });
});


// --- LOGOUT ---
document.querySelector('.logout-btn').addEventListener('click', function() {
    if (confirm('Deseja realmente sair?')) {
        window.location.href = '../index.php';
    }
});

// --- ABAS --- ajustar!!
document.addEventListener("DOMContentLoaded", () => {
    let tabIdCounter = 2; // começa a partir de 2 pois a aba principal será 1
    const tabsContainer = document.querySelector('.tabs-container');
    const contentContainer = document.querySelector('.tabs-content');
    const addTabButton = tabsContainer.querySelector('.add-tab');

    // Define a aba principal como fixa (não removível)
    const mainTab = tabsContainer.querySelector('.tab[data-id="1"]');
    if (mainTab) {
        const closeBtn = mainTab.querySelector('.close-tab');
        if (closeBtn) closeBtn.remove(); // remove botão de fechar da aba principal
    }

    // Troca aba ativa
    tabsContainer.addEventListener('click', (e) => {
        const tab = e.target.closest('.tab');
        if (tab && !e.target.classList.contains('close-tab')) {
            const id = tab.dataset.id;
            setActiveTab(id);
        }
    });

    // Fecha aba (exceto principal)
    tabsContainer.addEventListener('click', (e) => {
        if (e.target.classList.contains('close-tab')) {
            const tab = e.target.parentElement;
            const id = tab.dataset.id;

            // Impede remover aba principal
            if (id === "1") return;

            const isActive = tab.classList.contains('active');
            tab.remove();

            const content = contentContainer.querySelector(`.tab-content[data-id="${id}"]`);
            if (content) content.remove();

            if (isActive) {
                const nextTab = tabsContainer.querySelector('.tab');
                if (nextTab) setActiveTab(nextTab.dataset.id);
            }
        }
    });

    // Adiciona nova aba
    addTabButton.addEventListener('click', () => {
        const newId = tabIdCounter++;
        const tabName = prompt("Digite o nome da nova aba:");

        if (!tabName || tabName.trim() === "") return alert("O nome da aba não pode estar vazio!");

        const newTab = document.createElement('div');
        newTab.className = 'tab';
        newTab.dataset.id = newId;
        newTab.innerHTML = `
            <span class="tab-title">${tabName}</span>
            <button class="close-tab">&times;</button>
        `;
        tabsContainer.insertBefore(newTab, addTabButton);

        // Clona apenas as seções #sectio1 e #sectio4
        const sectio1 = document.querySelector('#sectio1').cloneNode(true);
        const sectio4 = document.querySelector('#sectio4').cloneNode(true);

        const newContent = document.createElement('div');
        newContent.className = 'tab-content';
        newContent.dataset.id = newId;
        newContent.appendChild(sectio1);
        newContent.appendChild(sectio4);

        contentContainer.appendChild(newContent);

        setActiveTab(newId);
    });

    // Define aba ativa
    function setActiveTab(id) {
        document.querySelectorAll('.tab').forEach(tab => {
            tab.classList.toggle('active', tab.dataset.id === id);
        });
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.toggle('active', content.dataset.id === id);
        });
    }
});


const animation = document.querySelector(".animation");

const configs = {
    plans: ["2%", "27%"],
    ajuda: ["33.5%", "27%"],
    dica: ["66%", "24%"]
};

Object.keys(configs).forEach(key => {
    document.querySelector(`.${key}`).addEventListener("mousemove", () => {
        const [margin, width] = configs[key];
        animation.style.marginLeft = margin;
        animation.style.width = width;
    });
}); 