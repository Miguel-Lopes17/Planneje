console.log("Enviando para PHP:", { funcao: "excluirPlano", idPlano: planId });

$(document).ready(function() {

    $('.plan-card').on('click', function() {
        window.location.href = 'plans.php';
    });

    $('.plan-options').on('click', function(e) {
        e.stopPropagation();
        const planId = $(this).closest('.plan-card').data('plan-id');
        const menu = $('#contextMenu');
        menu.data('plan-id', planId);
        menu.css({
            top: e.pageY + 'px',
            left: e.pageX + 'px'
        }).addClass('show');
        $('.dropdown-menu').not(menu).removeClass('show');
    });

    $(document).on('click', function(e) {
        if (!$(e.target).closest('#contextMenu, .plan-options').length) {
            $('#contextMenu').removeClass('show');
        }
    });

    $(window).on('scroll', function() {
        $('#contextMenu').removeClass('show');
    });

    $('#planForm').on('submit', function(e) {
        e.preventDefault();
        const formData = {
            funcao: 'adicionarPlano',
            destination: $('#destination').val(),
            date: $('#date').val(),
            description: $('#description').val()
        };
        $.ajax({
            url: '../backend/includes/plans.php',
            method: 'POST',
            data: formData,
            success: function(response) {
                console.log(response);
                try {
                    const res = JSON.parse(response);
                    if (res.status === 'erro') {
                        alert(res.mensagem);
                    } else {
                        $('#planModal').hide();
                        location.reload();
                    }
                } catch {
                    $('#planModal').hide();
                    location.reload();
                }
            },
            error: function() {
                alert('Erro ao adicionar plano.');
            }
        });
    });

    $('#planFormEdit').on('submit', function(e) {
        e.preventDefault();
        const formData = {
            funcao: 'editarPlano',
            destination: $('#destination').val(),
            date: $('#date').val(),
            description: $('#description').val()
        };
        $.ajax({
            url: '../backend/includes/plans.php',
            method: 'POST',
            data: formData,
            success: function(response) {
                console.log(response);
                try {
                    const res = JSON.parse(response);
                    if (res.status === 'erro') {
                        alert(res.mensagem);
                    } else {
                        $('#planModal').hide();
                        location.reload();
                    }
                } catch {
                    $('#planModal').hide();
                    location.reload();
                }
            },
            error: function() {
                alert('Erro ao editar plano.');
            }
        });
    });

    $(document).on('click', '.btnExcluir', function() {
        const planId = $('#contextMenu').data('plan-id');
        console.log('Clicou para excluir o plano ID:', planId);
        if (!planId) {
            alert('ID do plano não encontrado!');
            return;
        }
        if (confirm('Tem certeza que deseja excluir este plano?')) {
            $.ajax({
                url: '../backend/includes/plans.php',
                method: 'POST',
                data: { funcao: 'excluirPlano', idPlano: planId },
                success: function(response) {
                    console.log('Retorno bruto:', response);
                    try {
                        const res = typeof response === 'object' ? response : JSON.parse(response);
                        alert(res.mensagem);
                        if (res.status === 'sucesso') {
                            $(`.plan-card[data-plan-id="${planId}"]`).fadeOut(300, function() {
                                $(this).remove();
                            });
                            $('#contextMenu').removeClass('show');
                        }
                    } catch (e) {
                        console.error('Erro ao parsear JSON:', e);
                        alert('Erroao excluir o plano.');
                    }
                },
                error: function(xhr, status, err) {
                    console.error('Erro AJAX:', status, err, xhr.responseText);
                    alert('Erro no servidor.');
                }
            });
        }
    });

});
