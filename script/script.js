function accion(){
    var ancla = document.getElementsByClassName('ancla-nav');
    for(var i=0 ; i < ancla.length; i++){
        ancla[i].classList.toggle('desaparece')
    }
}

function loginUsuario(){
    var administrador = document.getElementsByClassName('administrador');
    for(var i=0 ; i < administrador.length; i++){
        administrador[i].classList.toggle('desaparece')
    }
}