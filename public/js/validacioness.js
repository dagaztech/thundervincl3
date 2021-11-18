/*const { mean } = require("lodash");*/

var mensajeRutIngresado = 'El valor ingresado no parece ser un RUT. Por favor verifica e intenta de nuevo.';
var mensajeVinIngresado = 'Por favor verifica que el VIN que estás ingresando corresponde a esta marca de vehículos';
var mensajeVin17Caracter = 'Debes digitar un VIN con 17 caracteres. Por verificación de seguridad de datos, no debes copiar/pegar tu número de VIN en este espacio, solo escribirlo. Si se presenta algún error, por favor verifica e intenta digitar de nuevo.';
var campanasNoAsociadaVin = 'Tu vehículo actualmente no presenta campañas pendientes por realizar';
var rutValido = 1;

function validaRutGet() {
    if (!checkRut()) {
        $('#error-rut').html(mensajeRutIngresado);
        $('#error-rut').show();
        $(".uncheket").css('display', 'inline');
        $(".conta").css('display', 'none');
        rutValido = 0;
    } else {
        $('#error-rut').html('');
        $('#error-rut').hide();
        $(".conta").css('display', 'inline');
        $(".uncheket").css('display', 'none');
        rutValido = 1;
    }
}

function checkRut() {

    // Despejar Puntos
    var valor = $('#rut').val().replace('.', '');
    // Despejar Guión
    valor = valor.replace('-', '');

    // Aislar Cuerpo y Dígito Verificador
    cuerpo = valor.slice(0, -1);
    dv = valor.slice(-1).toUpperCase();

    // Formatear RUN
    $('#rut').val(cuerpo + '-' + dv);

    // Si no cumple con el mínimo ej. (n.nnn.nnn)
    if (cuerpo.length < 7) {
        //rut.setCustomValidity("RUT Incompleto");
        return false;
    }

    // Calcular Dígito Verificador
    suma = 0;
    multiplo = 2;

    // Para cada dígito del Cuerpo
    for (i = 1; i <= cuerpo.length; i++) {

        // Obtener su Producto con el Múltiplo Correspondiente
        index = multiplo * valor.charAt(cuerpo.length - i);

        // Sumar al Contador General
        suma = suma + index;

        // Consolidar Múltiplo dentro del rango [2,7]
        if (multiplo < 7) {
            multiplo = multiplo + 1;
        } else {
            multiplo = 2;
        }
    }

    // Calcular Dígito Verificador en base al Módulo 11
    dvEsperado = 11 - (suma % 11);

    // Casos Especiales (0 y K)
    dv = (dv == 'K') ? 10 : dv;
    dv = (dv == 0) ? 11 : dv;

    // Validar que el Cuerpo coincide con su Dígito Verificador
    if (dvEsperado != dv) {
        //rut.setCustomValidity("RUT Inválido");
        return false;
    }

    // Si todo sale bien, eliminar errores (decretar que es válido)
    //rut.setCustomValidity('');
    return true;
}

function validaVin(marca) {

    var vines = $('#vines').val();
    var vinesObj = $('#vines');

    if (rutValido === 0) {
        $('#error-rut').html(mensajeRutIngresado);
        $('#error-rut').show();
        vinesObj.val('');
        return false;
    } else {
        $('#error-rut').html('');
        $('#error-rut').hide();
    }

    var scoda = 6,
        audi = 1,
        seat = 5,
        volkswagenLcv = 3,
        volkswagenPkw = 2,
        volkswagenTyb = 4;
        man = 7;
    var equivalenciaVinScoda = ['TMB', 'tmb'],
        equivalenciaVinSeat = ['VSS', 'vss'],
        equivalenciaVinAudi = ['TRU', 'WAU', 'WUA', 'WA1', 'tru', 'wau', 'wua', 'wa1'],
        equivalenciaVinvolkswagenLcv = ['8AW', 'WV1', 'WV2', 'WV3', '8aw', 'wv1', 'wv2', 'wv3'],
        equivalenciaVinvolkswagenPkw = ['LCV', 'PKW', '3VW', '3VV', '9BW', 'WVG', 'WVW', '1V2',
            'pkw', 'lcv', '3vw', '3vv', '9bw', 'wvg', 'wvw', '1v2',
            '8AW', 'WV1', 'WV2', 'WV3', '8aw', 'wv1', 'wv2', 'wv3'
        ],
        equivalenciaVinvolkswagenTb = ['9BW', '953', '9bw'];
        equivalenciaVinMan = ['WMA', 'wma'];
    try {

        if (scoda === marca) {
            if (vines.length == 4) {
                if (!equivalenciaVinScoda.includes(removeLastCharacter(vines))) {
                    $('#error-data').html(mensajeVinIngresado);
                    $('#error-data').show();
                    vinesObj.val(removeLastCharacter(vines));
                    return false;
                }
            }
        }

        if (audi === marca) {
            if (vines.length == 4) {
                if (!equivalenciaVinAudi.includes(removeLastCharacter(vines))) {
                    $('#error-data').html(mensajeVinIngresado);
                    $('#error-data').show();
                    vinesObj.val(removeLastCharacter(vines));
                    return false;
                }
            }
        }

        if (seat === marca) {
            if (vines.length == 4) {
                if (!equivalenciaVinSeat.includes(removeLastCharacter(vines))) {
                    $('#error-data').html(mensajeVinIngresado);
                    $('#error-data').show();
                    vinesObj.val(removeLastCharacter(vines));
                    return false;
                }
            }
        }

        if (volkswagenLcv === marca) {
            if (vines.length == 4) {
                if (!equivalenciaVinvolkswagenLcv.includes(removeLastCharacter(vines))) {
                    $('#error-data').html(mensajeVinIngresado);
                    $('#error-data').show();
                    vinesObj.val(removeLastCharacter(vines));
                    return false;
                }
            }
        }

        if (volkswagenPkw === marca) {
            if (vines.length == 4) {
                if (!equivalenciaVinvolkswagenPkw.includes(removeLastCharacter(vines))) {
                    $('#error-data').html(mensajeVinIngresado);
                    $('#error-data').show();
                    vinesObj.val(removeLastCharacter(vines));
                    return false;
                }
            }
        }

        if (volkswagenTyb === marca) {
            if (vines.length == 4) {
                if (!equivalenciaVinvolkswagenTb.includes(removeLastCharacter(vines))) {
                    $('#error-data').html(mensajeVinIngresado);
                    $('#error-data').show();
                    vinesObj.val(removeLastCharacter(vines));
                    return false;
                }
            }
        }
        if (man === marca) {
           if (vines.length == 4) {
                if (!equivalenciaVinMan.includes(removeLastCharacter(vines))) {
                    $('#error-data').html(mensajeVinIngresado);
                    $('#error-data').show();
                    vinesObj.val(removeLastCharacter(vines));
                    return false;
                }
            }
        }

        if ($('#vines').val().trim().length < 17) {
            $('#error-data').html(mensajeVin17Caracter);
            $('#error-data').show();
            hidenButton();
            return false;
        } else {
            $('#error-data').hide();
        }


        if (audi === marca || volkswagenLcv === marca || volkswagenPkw === marca || volkswagenTyb === marca || seat === marca || scoda === marca || man === marca) {
            if($('input[name=prog]').is(':checked')){
                showButton();
            }
        }
        else{
            showButton();            
        }

        return true;

    } catch (e) {
        return false;
    }
}

/*
function validaVinVolks(marca) {

    var vines = $('#vines').val();
    var vinesObj = $('#vines');

    if (rutValido === 0) {
        $('#error-rut').html(mensajeRutIngresado);
        $('#error-rut').show();
        vinesObj.val('');
        return false;
    } else {
        $('#error-rut').html('');
        $('#error-rut').hide();
    }

    var scoda = 6,
        audi = 1,
        seat = 5,
        volkswagenLcv = 3,
        volkswagenPkw = 2,
        volkswagenTyb = 4;
        man = 7;
    var equivalenciaVinScoda = ['TMB', 'tmb'],
        equivalenciaVinSeat = ['VSS', 'vss'],
        equivalenciaVinAudi = ['TRU', 'WAU', 'WUA', 'WA1', 'tru', 'wau', 'wua', 'wa1'],
        equivalenciaVinvolkswagenLcv = ['8AW', 'WV1', 'WV2', 'WV3', '8aw', 'wv1', 'wv2', 'wv3'],
        
        equivalenciaVinvolkswagenPkw = ['LCV', 'PKW', '3VW', '3VV', '9BW', 'WVG', 'WVW', '1V2',
            'pkw', 'lcv', '3vw', '3vv', '9bw', 'wvg', 'wvw', '1v2',
            '8AW', 'WV1', 'WV2', 'WV3', '8aw', 'wv1', 'wv2', 'wv3'
        ],
            
        equivalenciaVinvolkswagenTb = ['95'];
        equivalenciaVinMan = ['WMA', 'wma'];
    try {

        if (scoda === marca) {
            if (vines.length == 4) {
                if (!equivalenciaVinScoda.includes(removeLastCharacter(vines))) {
                    $('#error-data').html(mensajeVinIngresado);
                    $('#error-data').show();
                    vinesObj.val(removeLastCharacter(vines));
                    return false;
                }
            }
        }

        if (audi === marca) {
            if (vines.length == 4) {
                if (!equivalenciaVinAudi.includes(removeLastCharacter(vines))) {
                    $('#error-data').html(mensajeVinIngresado);
                    $('#error-data').show();
                    vinesObj.val(removeLastCharacter(vines));
                    return false;
                }
            }
        }

        if (seat === marca) {
            if (vines.length == 4) {
                if (!equivalenciaVinSeat.includes(removeLastCharacter(vines))) {
                    $('#error-data').html(mensajeVinIngresado);
                    $('#error-data').show();
                    vinesObj.val(removeLastCharacter(vines));
                    return false;
                }
            }
        }

        if (volkswagenLcv === marca) {
            if (vines.length == 4) {
                if (!equivalenciaVinvolkswagenLcv.includes(removeLastCharacter(vines))) {
                    $('#error-data').html(mensajeVinIngresado);
                    $('#error-data').show();
                    vinesObj.val(removeLastCharacter(vines));
                    return false;
                }
            }
        }

        if (volkswagenPkw === marca) {
            if (vines.length == 4) {
                if (!equivalenciaVinvolkswagenPkw.includes(removeLastCharacter(vines))) {
                    $('#error-data').html(mensajeVinIngresado);
                    $('#error-data').show();
                    vinesObj.val(removeLastCharacter(vines));
                    return false;
                }
            }
        }

        if (volkswagenTyb === marca) {
            if (vines.length == 4) {
                if (!equivalenciaVinvolkswagenTb.includes(removeLastCharacter(vines))) {
                    $('#error-data').html(mensajeVinIngresado);
                    $('#error-data').show();
                    vinesObj.val(removeLastCharacter(vines));
                    return false;
                }
            }
        }
        if (man === marca) {
            if (vines.length == 4) {
                if (!equivalenciaVinMan.includes(removeLastCharacter(vines))) {
                    $('#error-data').html(mensajeVinIngresado);
                    $('#error-data').show();
                    vinesObj.val(removeLastCharacter(vines));
                    return false;
                }
            }
        }


        if ($('#vines').val().trim().length > 17) {
            $('#error-data').html(mensajeVin17Caracter);
            $('#error-data').show();
            hidenButton();
            return false;
        } else {
            $('#error-data').hide();
        }
        
        if (audi === marca || volkswagenLcv === marca || volkswagenPkw === marca || volkswagenTyb === marca || seat === marca || scoda === marca || man === marca) {
            if($('input[name=prog]').is(':checked')){
                showButton();
            }
        }
        else{
            showButton();            
        }

        return true;

    } catch (e) {
        return false;
    }
}*/



function removeLastCharacter(str) {
    return str.substring(0, str.length - 1);
}

function hidenButton() {
    $('.searchbtn2').css('display', 'none');
}

function showButton() {
    $('.searchbtn2').css('display', 'inline');
}
