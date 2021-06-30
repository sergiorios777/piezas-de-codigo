(function() {
    var httpRequest;

    document.getElementById("formulario_busqueda").onsubmit = function () {
        
        var sProyecto = document.getElementById("Proyecto").value;
        var sUnidadDeMedida = document.getElementById("UnidadDeMedida").value;
        var dMetaFisica = document.getElementById("MetaFisica").value;
        var uData = "Proyecto="+encodeURIComponent(sProyecto)+"&UnidadDeMedida="+encodeURIComponent(sUnidadDeMedida)+
                    "&MetaFisica="+encodeURIComponent(dMetaFisica);
        makeRequest('insertarPy.php', uData);
        
        document.getElementById("Proyecto").value = '';
        document.getElementById("UnidadDeMedida").value = '';
        document.getElementById("MetaFisica").value = '';
        
        return false;
    }

    document.getElementById("cadenaBuscada").onkeyup = function ()
    {
        var uTexto = document.getElementById("cadenaBuscada").value;
        if (uTexto.length > 2)
        {
            var uCadena = "cadenaBuscada="+encodeURIComponent(uTexto);
            makeRequest('procesarpedido.php', uCadena)
        }
    }
/*
    document.querySelector("p_resultado").onclick = function ()
    {
        console.log("Hola, soy un p_resultado");
        var up_resultado = this;
        cargaTextoDeResultado(up_resultado);
    }
*/
    function enviarFormulario(idFormulario)
    {
        // vacío.
    }

    function makeRequest(url, uData) {
        httpRequest = new XMLHttpRequest();

        if (!httpRequest) {
            alert('Giving up :( Cannot create an XMLHTTP instance');
            return false;
        }
        httpRequest.onreadystatechange = alertContents;
        httpRequest.open('POST', url, true);
        httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        httpRequest.send(uData);
    }

    function alertContents() {
        //alert("readyState: " + httpRequest.readyState + " | status: " + httpRequest.status);
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
            if (httpRequest.status === 200) {
                var resultadoBusqueda = JSON.parse(httpRequest.responseText);
                agregaFilasBuscadas(resultadoBusqueda);
                //agregaEventoAParrafos();
            } else {
                document.getElementById("cuadro").innerHTML = "<p>Resultado vacío.</p>";
            }
        }
    }

    function agregaFilasBuscadas(resultadosBusqueda)
    {
        var html = '<div>';
        if (resultadosBusqueda.length > 0)
        {
            for (let i = 0; i < resultadosBusqueda.length; i++)
            {
                html += '<p onclick="cargaTextoDeResultado(this)">'+resultadosBusqueda[i].Tarea+'</p>';
            }
        }
        else
        {
            html += '<p>Sin resultados</p>';
        }
        html += '</div>';
        document.getElementById("resultados").innerHTML = html;
    }
        
    function cargaTextoDeResultado(event)
    {
        var uCadena = event.textContent;
        document.getElementsByName("cadenaBuscada")[0].value = uCadena;
        document.getElementsById("resultados").innerHTML = '';
    }
    
    function agregaEventoAParrafos()
    {
        console.log("1-En agregaEventoAParrafos");
        var parrafos = document.querySelectorAll('p');
        for (i = 0; i < parrafos.length; i++)
        {
            parrafos[i].onclick = cargaTextoDeResultado(this);
            /*
            parrafos[i].onclick = function () 
            {
                return function ()
                {
                    console.log("2-En la función 'onclick.function'");
                    var uCadena = this.textContent;
                    console.log("uCadena: "+uCadena);
                    document.getElementsByName("cadenaBuscada")[0].value = uCadena;
                }
            }
            */
            (parrafos[i]);
        }
        
    }

})();