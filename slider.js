const sliders = [...document.querySelectorAll('.slider__body')]; //le pongo [...] para transformarlo en en array
var btnAbrirPopUp = document.getElementById('btn-abrir-popup');

let value = 0;

function changePosition() {     
    
    if(btnAbrirPopUp.classList.contains('active')){
      sliders.style.transicion="none";

    } else {
        if( value >= 0 && value <= sliders.length-2) {
        sliders[value].classList.toggle('slider__body--show'); //borro la clase SHOW del VALUE que ingresa
        value++;
        sliders[value].classList.toggle('slider__body--show');
        } else {
            sliders[value].classList.toggle('slider__body--show');
            value = 0;
            sliders[value].classList.toggle('slider__body--show');
        }
    }
}

setInterval(changePosition, 3000);