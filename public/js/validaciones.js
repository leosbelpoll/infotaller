var exp_reg_es_solo_espacios = /^ +$/;
var exp_reg_comienza_con_espacios = /^ /;

function esSoloEspacios(valor){
    return exp_reg_es_solo_espacios.test(valor);
}

function esMuyLargo(valor){
    return valor.length > 50;
}

function comienzaConEspacio(valor){
    return exp_reg_comienza_con_espacios.test(valor);
}

function estaVacio(valor){
    return valor.length == 0;
}