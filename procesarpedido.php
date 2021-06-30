<?php

if (isset($_POST['cadenaBuscada']))
{
    require_once('clasesphp/clase_tareas.php');

    $condicion = preg_replace('/[^A-Za-z0-9\- ]/','', $_POST['cadenaBuscada']);

    $objTareas = new Tareas;

    $data = $objTareas->listaBuscada($condicion);
    echo $data;
}