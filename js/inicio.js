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

    let currentPlanElement = null;

    // --- Abrir modal de novo plano ---
    addPlanButton.addEventListener('click', () => {
        modalTitle.textContent = 'Adicionar Novo Plano';
        planIdInput.value = '';
        destinationInput.value = '';
        descriptionInput.value = '';
        planModal.classList.add('show');
    });

    // --- Fechar modal ---
    const closeModalHandler = () => planModal.classList.remove('show');
    closeModal.addEventListener('click', closeModalHandler);
    cancelButton.addEventListener('click', closeModalHandler);

    // --- Enviar formulário (envia pro PHP de verdade) ---
    planForm.addEventListener('submit', () => {
        // Fecha o modal ao enviar (o PHP tratará o insert)
        planModal.classList.remove('show');
    });

    // --- Mostrar menu de contexto ---
    document.addEventListener('click', (e) => {
        if (!contextMenu.contains(e.target) && !e.target.classList.contains('edit')) {
            contextMenu.classList.remove('show');
        }
    });

    function showContextMenu(button, plan) {
        const rect = button.getBoundingClientRect();
        contextMenu.style.top = `${rect.bottom + window.scrollY}px`;
        contextMenu.style.left = `${rect.left + window.scrollX - 130}px`;
        currentPlanElement = plan;
        contextMenu.classList.add('show');

        const menuItems = contextMenu.querySelectorAll('.dropdown-item');
        menuItems.forEach(item => {
            item.onclick = function () {
                const action = this.dataset.action;
                handleContextMenuAction(action, plan);
            };
        });
    }

    // --- Ações do menu (editar, excluir etc.) ---
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

    // --- Exemplo de visualização ---
    function viewPlan(plan) {
        window.location.href = `../view/plans.php?id=${plan.id}`;
    }

    // --- Exemplo de exclusão (frontend) ---
    function deletePlan(plan) {
        if (confirm(`Tem certeza que deseja excluir o plano "${plan.destination}"?`)) {
            plan.remove();
        }
    }
});

// --- ABAS ---
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