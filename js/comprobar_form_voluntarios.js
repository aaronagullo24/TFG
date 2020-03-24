let comprobar = Array("F", "F", "F", "F", "F", "F");
// DNI Nombre titulacion Nick edad correo
console.log(comprobar);
window.addEventListener("load", function () {
	let DNI = document.getElementById('DNI');
	let Nombre = document.getElementById('Nombre');
	let titulacion = document.getElementById('titulacion');
	let Nick = document.getElementById("Nick");
	let edad = document.getElementById("edad");
	let correo = document.getElementById("correo");


	Nombre.addEventListener("blur", comprobar_nombre);
	DNI.addEventListener("blur", comprobar_dni);
	Nick.addEventListener("blur", comprobar_nick);
	titulacion.addEventListener("blur", comprobar_titulacion);
	edad.addEventListener("blur", comprobar_edad);
	correo.addEventListener("blur", comprobar_correo);


	let boton = document.getElementById('boton');
	boton.addEventListener("click", boton);

});

//alta
function comprobar_boton_form() {
	let correcto = true;
	for (i = 0; i < comprobar.length; i++) {
		if (comprobar[i] == "F") correcto = false;
	}
	if (correcto) llamarAjax('alta_voluntarios.php', gParAlta(), 'cBAlta', 'F_Error', 'post', 0);
	else alert("comprueba los datos");
}

function gParAlta() {
	return "DNI=" + document.getElementById('DNI').value +
		"&Nombre=" + document.getElementById('Nombre').value +
		"&titulacion=" + document.getElementById('titulacion').value +
		"&Nick=" + document.getElementById('Nick').value +
		"&edad=" + document.getElementById('edad').value +
		"&correo=" + document.getElementById('correo').value +
		"&provinciaList=" + document.getElementById('provinciaList').value +
		"&localidadList=" + document.getElementById('localidadList').value +
		"&direccion=" + document.getElementById('direccion').value +
		"&password=" + document.getElementById('password').value;
}

function cBAlta(resultado) {
	let datos = JSON.parse(resultado);

	let p = document.getElementById("pepin");
	if (datos.alta == true) {
		p.style.color = "green";
		p.innerHTML = "DADO DE ALTA";
		comprobar[1] = "F";
		for (let i = 0; i < comprobar.length; i++) {
			comprobar[i] = "F";
		}
	} else {
		p.style.color = "red";
		p.innerHTML = "ERRORE";

	}
}

//comprobar correo
function comprobar_correo() {
	if (document.getElementById('correo').value == '') {
		document.getElementById("Correo").innerHTML = "RELLENA EL CAMPO";

	} else if (validarEmail(document.getElementById('correo').value) == false) {
		document.getElementById("Correo").innerHTML = "correo incorrecto";

	} else {
		llamarAjax('comprobar_correo.php', gParCorreo(), 'cBCorreo', 'F_Error', 'post', 0);
	}
}

function validarEmail(correo) {
	var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	return regex.test(correo) ? true : false;

}


function gParCorreo() {
	return "correo=" + document.getElementById('correo').value;
}

function cBCorreo(resultado) {
	let datos = JSON.parse(resultado);

	let p = document.getElementById("Correo");
	p.innerHTML = datos.encontrado;

	if (datos.encontrado == true) {
		p.style.color = "red";
		p.innerHTML = "CORREO REPETIDO";
		comprobar[5] = "F";
	} else {
		p.style.color = "green";
		p.innerHTML = "CORREO CORRECTO";
		comprobar[5] = "V";

	}
}

//comprobar edad
function comprobar_edad() {
	if (document.getElementById('edad').value == '') {
		document.getElementById("Edad").innerHTML = "RELLENA EL CAMPO";
	} else if (document.getElementById("edad").value >= 99) {
		document.getElementById("Edad").innerHTML = "La edad debe ser un numero entre el 1 y el 99";
	} else {
		document.getElementById("Edad").innerHTML = "";
		llamarAjax('', gParEdad(), '', 'F_Error', 'post', 0);
	}
}
function gParEdad() {
	return "edad=" + document.getElementById('edad').value;
}

//comprobar Nick
function comprobar_nick() {
	if (document.getElementById('Nick').value == '') {
		document.getElementById("nick").innerHTML = "RELLENA EL CAMPO";

	} else {
		llamarAjax('comprobar_nick.php', gParNick(), 'cBNICK', 'F_Error', 'post', 0);
	}
}

function gParNick() {
	return "Nick=" + document.getElementById('Nick').value;
}

function cBNICK(resultado) {
	let datos = JSON.parse(resultado);

	let p = document.getElementById("nick");
	p.innerHTML = datos.encontrado;

	if (datos.encontrado == true) {
		p.style.color = "red";
		p.innerHTML = "EL NICK YA EXISTE";
		comprobar[4] = "F";
	} else {
		p.style.color = "green";
		p.innerHTML = "NICK CORRECTO";
		comprobar[4] = "V";

	}
}

//comprobar titulacion
function comprobar_titulacion() {
	if (document.getElementById('titulacion').value == '') {
		document.getElementById("Titulacion").innerHTML = "RELLENA EL CAMPO";
		comprobar[2] = "F";

	} else {
		document.getElementById("Titulacion").innerHTML = "titulacion correca";
		comprobar[2] = "V";
		llamarAjax('', gParNOMBRE(), '', 'F_Error', 'post', 0);
	}
}

function gParTitulacion() {
	return "titulacion=" + document.getElementById('titulacion').value;
}

//comprobar nombre
function comprobar_nombre() {
	if (document.getElementById('Nombre').value == '') {
		document.getElementById("nombre").innerHTML = "RELLENA EL CAMPO";
		comprobar[1] = "F";
	} else if (!isNaN(document.getElementById('Nombre').value)) {
		document.getElementById("nombre").innerHTML = "Solo letras y espacios";
		comprobar[1] = "F";
	} else {
		document.getElementById("nombre").innerHTML = "Nombre correcto";
		comprobar[1] = "V";
		llamarAjax('', gParNOMBRE(), '', 'F_Error', 'post', 0);
	}
}


function gParNOMBRE() {
	return "Nombre=" + document.getElementById('Nombre').value;
}



//comprobacion del DNI
function comprobar_dni() {
	if (document.getElementById('DNI').value == '') {
		document.getElementById("dni").innerHTML = "RELLENA EL CAMPO";

	} else if (validarDNI(document.getElementById('DNI').value) == false) {
		document.getElementById("dni").innerHTML = "DNI INCORRECTO";

	} else {
		llamarAjax('comprobar_dni.php', gParDNI(), 'cBDNI', 'F_Error', 'post', 0);
	}
}


function validarDNI(dni) {
	var letraDNI = dni.substring(8, 9).toUpperCase();
	var numDNI = parseInt(dni.substring(0, 8));

	//Se calcula la letra correspondiente al número
	var letras = ['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E', 'T'];
	var letraCorrecta = letras[numDNI % 23];

	if (letraDNI != letraCorrecta) {
		return false;
	} else {
		return true;

	}
}

function gParDNI() {
	return "DNI=" + document.getElementById('DNI').value;
}

function F_Error(textoError) {
	let contenedor = document.getElementById('pepin');
	contenedor.innerHTML = "Se a producido un error: " + textoError + " ";
	alert("Error en la pagina");
}

function cBDNI(resultado) {
	let datos = JSON.parse(resultado);

	let p = document.getElementById("dni");
	p.innerHTML = datos.encontrado;

	if (datos.encontrado == true) {
		p.style.color = "red";
		p.innerHTML = "DNI REPETIDO";
		comprobar[0] = "F";
	} else {
		p.style.color = "green";
		p.innerHTML = "DNI CORRECTO";
		comprobar[0] = "V";

	}
}

