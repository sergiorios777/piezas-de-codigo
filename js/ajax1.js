(function() {
    var httpRequest;
    var uCaso;

    document.getElementById("formulario").onsubmit = function () {
        
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
                document.getElementById("cuadro").innerHTML = httpRequest.responseText;
                agregaEventoAFilas();
                //alert("httpRequest Pasó");
            } else {
                //alert("httpRequest <> 200");
                document.getElementById("cuadro").innerHTML = "<p>Resultado vacío.</p>";
            }
        }
    }

    function agregaEventoAFilas(nombreTabla)
    {
        console.log("f_agregaEventoAFilas");
        var filas = document.getElementById(nombreTabla).rows;
        for (i = 1; i < filas.length; i++)
        {
            filas[i].onclick = function () 
            {
                return function ()
                {
                    console.log("En la función 'onclick.function'");
                    var id = this.cells[1].innerHTML;
                    alert("id: " + id);
                }
            }
            (filas[i]);
        }
    }

})();