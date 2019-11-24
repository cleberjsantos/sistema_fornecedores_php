/*jslint browser */
/*global window */
/*global jQuery */
/*global alert */

function startTimer(duration, display) {
    'use strict';
    var timer = duration, minutes, seconds;
    var counter = setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        //display.textContent = minutes + ":" + seconds;
        display.innerHTML = seconds;

        if (--timer < 0) {
            //location.reload();
            clearInterval(counter);
            display.innerHTML = "";
        }
    }, 1000);
}

window.onload = function () {
    'use strict';
    if (!(typeof contador === 'undefined' || typeof contador === null)) {
        var count = parseInt(contador), display = document.querySelector('#contador');
        startTimer(count, display);
    }
};

// BUSCA CEP
jQuery(function ($) {
    'use strict';
    var canonical = $("link[rel='canonical']").attr("href");

    $("input[name='cep']").change(function () {
        var cep_code = $(this).val();
        if (cep_code.length <= 0) {
            return;
        }
        $.get("http://apps.widenet.com.br/busca-cep/api/cep.json", {code: cep_code}, function (result) {
            if (result.status !== 1) {
                alert(result.message || "Houve um erro desconhecido  ao tentar buscar o CEP");
                return;
            }

            //$("input[name='endereco']").val(result.address + ', ' + result.district + ' - ' + result.city + ' / ' + result.state);
            $("textarea[name='endereco']").val(result.address + ', ' + result.district + ' - ' + result.city + ' / ' + result.state);
        });
    });

    // TABELAS
    $('[data-toggle="tooltip"]').tooltip();

    $('#table').DataTable( {
        paging: true,
        scrollY: 300,
        info: false,
        ordering:  false,
        language: {
            processing:     "Processando...",
            search:         "Buscar&nbsp;:",
            lengthMenu:     "Mostrar _MENU_ itens",
            info:           "Mostrando _START_ de _END_ Total _TOTAL_",
            paginate: {
                first:      "Primeiro",
                previous:   "Anterior",
                next:       "Pr&oacute;ximo",
                last:       "&Uacute;ltimo"
            },
            aria: {
                sortAscending:  ": ativar para classificar a coluna em ordem crescente",
                sortDescending: ": ativar para classificar a coluna em ordem decrescente"
            }
        }
    } );


    // Envio para adicionar fornecedores
    $("#fornecedorForm").submit(function () {
        $.ajax({
            type: "POST",
            url: "fornecedores.php",
            cache: false,
            data: $('form#fornecedorForm').serialize(),
            success: function (response) {
                $("#addFornecedoresModal").modal('hide');
                window.location.replace(canonical + '/fornecedores.php');
            },
            error: function (e) {
                alert(e);
            }
        });
        return false;
    });

    // Envio para Editar fornecedores
    $(".editarfornecedorForm").submit(function () {
        $.ajax({
            type: "POST",
            url: "fornecedores.php",
            cache: false,
            data: $(this).serialize(),
            success: function (response) {
                $('div[id^=editFornecedoresModal] .editarfornecedorForm').modal('hide');
                window.location.replace(canonical + '/fornecedores.php');
            },
            error: function (e) {
                alert(e);
            }
        });
        return false;
    });

    // Envio para Remover fornecedores
    $(".deletarfornecedorForm").submit(function () {
        $.ajax({
            type: "POST",
            url: "fornecedores.php",
            cache: false,
            data: $(this).serialize(),
            success: function (response) {
                $('div[id^=deleteFornecedoresModal] .editarfornecedorForm').modal('hide');
                window.location.replace(canonical + '/fornecedores.php');
            },
            error: function (e) {
                alert(e);
            }
        });
        return false;
    });

    // Envio para adicionar usuários 
    $("#usuarioForm").submit(function () {
        $.ajax({
            type: "POST",
            url: "usuarios.php",
            cache: false,
            data: $('form#usuarioForm').serialize(),
            success: function (response) {
                $("#addUsuariosModal").modal('hide');
                window.location.replace(canonical + '/usuarios.php');
            },
            error: function (e) {
                alert(e);
            }
        });
        return false;
    });

    // Envio para Editar usuarios 
    $(".editarusuarioForm").submit(function () {
        $.ajax({
            type: "POST",
            url: "usuarios.php",
            cache: false,
            data: $(this).serialize(),
            success: function (response) {
                $('div[id^=editUsuariosModal] .editarusuarioForm').modal('hide');
                window.location.replace(canonical + '/usuarios.php');
            },
            error: function (e) {
                alert(e);
            }
        });
        return false;
    });

    // Envio para Remover fornecedores
    $(".deletarusuarioForm").submit(function () {
        $.ajax({
            type: "POST",
            url: "usuarios.php",
            cache: false,
            data: $(this).serialize(),
            success: function (response) {
                $('div[id^=deleteUsuariossModal] .editarusuarioForm').modal('hide');
                window.location.replace(canonical + '/usuarios.php');
            },
            error: function (e) {
                alert(e);
            }
        });
        return false;
    });
});
