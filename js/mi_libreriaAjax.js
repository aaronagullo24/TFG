// Crear peticion
function creaPeticion() {
    try {
        peticion = new XMLHttpRequest(); /* e.j. Firefox */
    } catch (err1) {
        try {
            peticion = new ActiveXObject("Msxml2.XMLHTTP");
            /*  some versions IE */
        } catch (err2) {
            try {
                peticion = new ActiveXObject("Microsoft.XMLHTTP");
                /* some versions IE */
            } catch (err3) {
                peticion = false;
            }
        }
    }
    return peticion;
}

//Si uso el GET esta es la función
function requestGET(url, parametros, peticion) {
    myRand = parseInt(Math.random() * 9999999999);
    peticion.open("GET", url + '?' + parametros + '&rand=' + myRand, true);
    peticion.send(null);
}

//Si uso el POST esta es la función
function requestPOST(url, parametros, peticion) {
    peticion.open("POST", url, true);
    peticion.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    peticion.send(parametros);
}


// La respuesta la debo dar en div, para que sea estandard para todas las páginas
// la acción local la debo realizar mediante una función de javascript local a la página que invoca
// para ello a do Ajax le paso el nombre y los parametros de dicha función
// y llamarfuncion_resultado la función que ejecuta finalmente la función de la página que usará esta libreria 
function llamarfuncion_resultado(funcion_resultado, resultado) {
    eval(funcion_resultado + '(resultado)');
}

function llamarfuncion_error(funcion_error, texto_error) {
    eval(funcion_error + '(texto_error)');
}

//Esta función es la que llama a Ajax
function llamarAjax(url, parametros, funcion_resultado, funcion_error,
    metodo, usarxml) {
    var mipeticion = creaPeticion();
    mipeticion.onload = function () {
        console.log(mipeticion.status);
        if (mipeticion.status == 200) {
            var resultado = mipeticion.responseText;
            if (usarxml == true) {
                resultado = mipeticion.responseXML;
            }
            llamarfuncion_resultado(funcion_resultado, resultado);
        }
        else {
            llamarfuncion_error(funcion_error, mipeticion.status + " " + mipeticion.statusText);
        }
    };

    if (trim(metodo.toUpperCase()) == 'POST') {
        requestPOST(url, parametros, mipeticion);
    } else {
        requestGET(url, parametros, mipeticion);
    }
}

function trim(myString) {
    return myString.replace(/^\s+/g, '').replace(/\s+$/g, '')
}