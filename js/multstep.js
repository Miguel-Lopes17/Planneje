
const btnNext = document.querySelector('.next');
const btnPrev = document.querySelector('.prev');
const indicadorLine = document.querySelector('.indicador .line span');
const indicadorItems = document.querySelectorAll('.indicador p');
const tabs = document.querySelectorAll('.tab');

let currentTab = 0;

// Mostrar a primeira aba
showTab(currentTab);

function showTab(index) {
    // Ocultar todas as abas
    tabs.forEach(tab => tab.classList.remove('show'));

    // Mostrar a aba atual
    tabs[index].classList.add('show');

    // Atualizar indicador visual
    indicadorItems.forEach((item, i) => {
        item.classList.toggle('active', i <= index);
    });

    // Atualizar barra de progresso (line)
    const progress = (index) / (tabs.length - 1) * 100;
    indicadorLine.style.width = progress + '%';

    // Mostrar ou esconder botão "Anterior"
    btnPrev.style.display = index === 0 ? 'none' : 'inline-block';

    if (index === tabs.length - 1) {
        btnNext.style.display = 'none';
        document.querySelector('.finish').style.display = 'inline-block';
    } else {
        btnNext.style.display = 'inline-block';
        document.querySelector('.finish').style.display = 'none';
    }
}

btnNext.addEventListener('click', () => {
    if (currentTab < tabs.length - 1) {
        currentTab++;
        showTab(currentTab);
    } else {
        //alert('Formulário enviado!');
        // Aqui você pode chamar form.submit() ou tratar o envio via JS
        Swal.fire({
            title: "Drag me!",
            icon: "success",
            draggable: true
        });
    }
});

btnPrev.addEventListener('click', () => {
    if (currentTab > 0) {
        currentTab--;
        showTab(currentTab);
    }
});