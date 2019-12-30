/*================================================================================
	Item Name: Materialize - Material Design Admin Template
	Version: 5.0
	Author: PIXINVENT
	Author URL: https://themeforest.net/user/pixinvent/portfolio
================================================================================

NOTE:
------
PLACE HERE YOUR OWN JS CODES AND IF NEEDED.
WE WILL RELEASE FUTURE UPDATES SO IN ORDER TO NOT OVERWRITE YOUR CUSTOM SCRIPT IT'S BETTER LIKE THIS. */
var Scripts = [];

Scripts.copyDiv = function () {
    $('.copybutton').each(function(i, el){
        $(el).unbind('click');
        $(el).on('click', function(){
            var target = $(el).data('target');
            console.log(target)
            var to = $(el).data('to');
            if(!to)
                to = $(target).parent();
            var callback = $(el).data('callback');

            $(target).clone()
                .find('input, select').val('').end()
                .appendTo(to).removeClass('hide').removeClass('toCopy');

            Scripts.removeParents();
            Scripts.copyDiv();
            if(callback)
                eval(callback);
        })
    });
};

Scripts.showDivAndHideAnother = function () {
    $('.showHide').each(function(i, el){
        $(el).unbind('click');
        $(el).on('click', function(){
            var hide = $(el).data('hide');
            var show = $(el).data('show');
            var setText = $(el).data('text');
            if(setText){
                setText = setText.split('|');
                $(el).html(setText[0]);
                setText.reverse();
                $(el).data('text', setText.join('|'));
            }

            $(hide).addClass('hide');
            $(show).removeClass('hide');

            $(el).data('hide', show ? show : '');
            $(el).data('show', hide ? hide : '');

            Scripts.showDivAndHideAnother();
            // Scripts.ajaxModal();
            // Scripts.ajaxModal2();
            return false;
        });
    });

};

Scripts.removeParents = function(){
    $('.remove-parents').each(function(i, el){
        $(el).on('click', function () {
            var target = $(this).data('remove-parents-target');
            $(this).parents(target).remove();
        });
    });
};

Scripts.confirm = function (url,message,method, callback) {
    event.preventDefault();
    swal({
        title: "Você tem certeza?",
        text: message[0],
        icon: 'warning',
        dangerMode: true,
        buttons: {
            cancel: 'Cancelar',
            delete: 'Sim'
        }
    }).then(function (willDelete) {
        if (willDelete) {
            $.ajax({
                method: method,
                url: url,
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                }
            }).done(function (msg) {
                if(msg.replace(' ', '') == 'ok'){
                    swal({
                        title: message[1],
                        text: message[2],
                        type: "success"
                    }).then(function () {
                        if(callback){
                            var x = eval(callback)
                            if (typeof x == 'function') {
                                x();
                            }
                        }
                        else
                            location.reload();
                    });
                }else{
                    swal("Erro", "Ocorreu um erro, tente novamente :(", "error");
                }
            });
        } else {
            swal("A ação foi cancelada com sucesso :)", {
                title: 'Cancelado',
                icon: "error",
            });
        }
    });

};

Scripts.InitMasks = function () {
    // $.getScript(baseUrl + '/vendor/homer-assets/vendor/maskedinput/jquery.maskedinput.js', function() {
    $(".cep").mask("99999-999");
    $(".cpf").mask("999.999.999-99");
    $(".cnpj").mask("99.999.999/9999-99");
    $("input.hora").mask("99:99:99");
    $("input.hora-min").mask("99:99");
    $("input.data").mask("99/99/9999");
    $("input.datahora").mask("99/99/9999 99:99");
    $('.datetime').mask('99/99/9999 99:99');
    $('.date').mask('99/99/9999');
    // });

    $(".telefone").keyup(function () {
        Scripts.mascara(document.getElementById($(this).attr('id')), Scripts.mtel);
    });
    $(".telefone").prop('maxlength', 15);

    $(".celular").keyup(function () {
        Scripts.mascara(document.getElementById($(this).attr('id')), Scripts.mtel);
    });
    $(".celular").prop('maxlength', 15);
};

Scripts.soNums = function (e) {
    //teclas adicionais permitidas (tab,delete,backspace,setas direita e esquerda, . / -)
    keyCodesPermitidos = new Array(8, 9, 37, 39, 46, 109, 110, 111, 173, 188, 190, 191);
    //numeros e 0 a 9 do teclado alfanumerico
    for (x = 48; x <= 57; x++) {
        keyCodesPermitidos.push(x);
    }
    //numeros e 0 a 9 do teclado numerico
    for (x = 96; x <= 106; x++) {
        keyCodesPermitidos.push(x);
    }
    //Pega a tecla digitada
    keyCode = e.which;
    //Verifica se a tecla digitada é permitida
    if ($.inArray(keyCode, keyCodesPermitidos) != -1) {
        return true;
    }
    return false;
};

Scripts.soChars = function (e) {
    //teclas adicionais permitidas (tab,delete,backspace,setas direita e esquerda, . / -)
    keyCodesBloqueados = new Array();
    //numeros e 0 a 9 do teclado alfanumerico
    for (x = 48; x <= 57; x++) {
        keyCodesBloqueados.push(x);
    }
    //numeros e 0 a 9 do teclado numerico
    for (x = 96; x <= 106; x++) {
        keyCodesBloqueados.push(x);
    }
    //Pega a tecla digitada
    keyCode = e.which;
    //Verifica se a tecla digitada é permitida
    if ($.inArray(keyCode, keyCodesBloqueados) != -1) {
        return false;
    }
    return true;
};

Scripts.mascara = function (o, f) {
    v_obj = o;
    v_fun = f;
    setTimeout(Scripts.execmascara(), 1);
};

Scripts.execmascara = function () {
    v_obj.value = v_fun(v_obj.value);
};

Scripts.mtel = function (v) {
    v = v.replace(/\D/g, ""); //Remove tudo o que não é dígito
    v = v.replace(/^(\d{2})(\d)/g, "($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
    v = v.replace(/(\d)(\d{4})$/, "$1-$2"); //Coloca hífen entre o quarto e o quinto dígitos
    return v;
};

Scripts.BuscaCep = function (cep) {
    Scripts.CepInputsReset();
    // Scripts.showLoading();
    cep = cep.replace('.', '').replace('-', '');
    $.ajax({
        data: null,
        type: "GET",
        url: 'https://buscacepapi.mauricioschmitz.com.br/busca-cep/' + cep + '?token=5cacc2c8a13f9d5321433567',
        cache: false,
        contentType: false,
        processData: false,
        xhr: function () {
            var myXhr = $.ajaxSettings.xhr();
            // if (myXhr.upload)
            //     myXhr.upload.addEventListener('progress', Scripts.progressHandling, false);
            return myXhr;
        },
        success: function (data) {
            Scripts.ReadJsonCep(data);
            $('#zip_code').attr('required', 'required');
            $('#state').attr('required', 'required');
            $('#city').attr('required', 'required');
            $('#address').attr('required', 'required');
            // Scripts.addRequireIcon();
            // Scripts.hideLoading();
        },
        done: function () {

        },
        error: function (jqXHR, textStatus, errorThrown) {
            Scripts.CepInputsReset();
            // Scripts.hideLoading();
        }
    });
};


Scripts.startScripts = function () {

    Scripts.copyDiv();
    Scripts.showDivAndHideAnother();
    Scripts.InitMasks();

}


$(document).ready(function () {
    Scripts.startScripts();
});
