var btnAbrirPopUp = document.getElementById('btn-abrir-popup'),
    overlay = document.getElementById('overlay'),
    popup = document.getElementById('popup'),
    btnCerrarPopUP = document.getElementById('btn-cerrar-popup');

    

btnAbrirPopUp.addEventListener('click', function(){
    btnAbrirPopUp.classList.add('active');
    overlay.classList.add('active');
    popup.classList.add('active')       
});

btnCerrarPopUP.addEventListener('click', function(){
    btnAbrirPopUp.classList.remove('active');
    overlay.classList.remove('active');
    popup.classList.remove('active');      
});



