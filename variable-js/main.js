const buttonA = document.querySelector('#button_A');
const headingA = document.querySelector('#heading_A');

buttonA.onclick = function ()
{
    let name = prompt('¿Cuál es tu nombre?');
    alert('¡Hola, ' + name + ' un guste de verte!');
    headingA.textContent = 'Bienvenido, ' + name;
}