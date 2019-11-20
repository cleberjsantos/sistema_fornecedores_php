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

    // Select/Deselect checkboxes
    var checkbox = $('table tbody input[type="checkbox"]');
    $("#selectAll").click(function () {
        if (this.checked) {
            checkbox.each(function () {
                this.checked = true;
            });
        } else {
            checkbox.each(function () {
                this.checked = false;
            });
        }
    });

    checkbox.click(function () {
        if (!this.checked) {
            $("#selectAll").prop("checked", false);
        }
    });

    // Envio para adicionar fornecedores
    $("#fornecedorForm").submit(function () {
        $.ajax({
            type: "POST",
            url: "fornecedores.php",
            cache: false,
            data: $('form#fornecedorForm').serialize(),
            success: function (response) {
                $("#addFornecedoresModal").modal('hide');
                location.reload();
            },
            error: function () {
                alert("Error");
            }
        });
        return false;
    });

    // Envio para Editar fornecedores
    $(".editfornecedorForm").submit(function () {
        $.ajax({
            type: "POST",
            url: "fornecedores.php",
            cache: false,
            data: $(this).serialize(),
            success: function (response) {
                $('div[id^=editFornecedoresModal] .editfornecedorForm').modal('hide');
                location.reload();
            },
            error: function (e) {
                console.log(e);
                alert(e);
            }
        });
        return false;
    });
});
