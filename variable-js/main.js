const buttonA = document.querySelector('#button_A');
const headingA = document.querySelector('#heading_A');

const buttonB = document.querySelector('#button_B');
const section = document.querySelector('#heading_B');

buttonA.onclick = function ()
{
    let name = prompt('¿Cuál es tu nombre?');
    alert('¡Hola, ' + name + ', que agradable de verte!');
    headingA.textContent = 'Bienvenido, ' + name;
}

buttonB.onclick = function ()
{
    let myName;
    myName = 'Pepito';

    let myAge = 42;

    section.innerHTML = ' ';
    let para1 = document.createElement('p');
    para1.textContent = myName;
    let para2 = document.createElement('p');
    para2.textContent = myAge;
    section.appendChild(para1);
    section.appendChild(para2);
}