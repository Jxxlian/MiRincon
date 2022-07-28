var btn = document.querySelector('.btn_entrada'),
    formulario = document.querySelector('#form_entrada');

btn.addEventListener('click', function(){
    var confirmacion = confirm('¿Estas seguro de subir esta nueva entrada?');

    if(confirmacion == true) {    
        formulario.setAttribute('action', 'guardar_entrada.php');    
    } 
})
