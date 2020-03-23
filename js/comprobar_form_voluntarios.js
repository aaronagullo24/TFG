let comprobar = Array("F", "F", "F", "F", "F", "F", "F");

window.addEventListener("load", function () {
	let DNI = document.getElementById('DNI');
	let Nombre = document.getElementById('Nombre');
	let titulacion = document.getElementById('titulacion');
	let Nick = this.document.getElementById("Nick");


	Nombre.addEventListener("blur", comprobar_nombre);
	DNI.addEventListener("blur", comprobar_dni);
	Nick.addEventListener("blur", comprobar_nick);
	titulacion.addEventListener("blur",comprobar_titulacion);


	//	let boton1 = document.getElementById('boton_form');
	//	boton1.addEventListener("click", comprobar_boton_form);

});

//comprobar Nick
function comprobar_nick() {
	if (document.getElementById('Nick').value == '') {
		document.getElementById("nick").innerHTML = "RELLENA EL CAMPO";

	}else {
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
		p.innerHTML = "NICK REPETIDO";
		comprobar[2] = "F";
	} else {
		p.style.color = "green";
		p.innerHTML = "NICK CORRECTO";
		comprobar[2] = "V";

	}
}

//comprobar titulacion
function comprobar_titulacion() {
	if (document.getElementById('titulacion').value == '') {
		document.getElementById("Titulacion").innerHTML = "RELLENA EL CAMPO";
	
	} else {
		document.getElementById("Titulacion").innerHTML = "titulacion correca";
		llamarAjax('', gParNOMBRE(), '', 'F_Error', 'post', 0);
	}
}

function gParTitulacion(){
	return "titulacion=" + document.getElementById('titulacion').value;
}


function gParNOMBRE() {
	return "Nombre=" + document.getElementById('Nombre').value;
}

//comprobar nombre
function comprobar_nombre() {
	if (document.getElementById('Nombre').value == '') {
		document.getElementById("nombre").innerHTML = "RELLENA EL CAMPO";
	
	} else {
		document.getElementById("nombre").innerHTML = "Nombre correcto";

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
		comprobar[2] = "F";
	} else {
		p.style.color = "green";
		p.innerHTML = "DNI CORRECTO";
		comprobar[2] = "V";

	}
}

//comprobacion del nombre