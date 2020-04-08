let comprobar = Array("V", "V", "V", "V","V");
//Nombre correo password provincia localidad
window.addEventListener("load", function () {
	let Nombre = document.getElementById('Nombre');
	let correo = document.getElementById("correo");
	let password = document.getElementById("password");
	let provinciaList = document.getElementById("provinciaList");
	let localidadList = document.getElementById("localidadList");

	password.addEventListener("blur", comprobar_password);
	Nombre.addEventListener("blur", comprobar_nombre);
	provinciaList.addEventListener("blur", comprobar_provincia);
	localidadList.addEventListener("blur", comprobar_localidad);


	let boton = document.getElementById('boton');
	boton.addEventListener("click", comprobar_boton_form);

});

//provincia
function comprobar_provincia() {
	if (document.getElementById('provinciaList').value == 'Seleccione su provincia...') {
		document.getElementById("provincia").innerHTML = "RELLENA EL CAMPO";
		comprobar[3] = "F";
	} else {
		document.getElementById("provincia").innerHTML = "&#10004";
		comprobar[3] = "V";
		llamarAjax('', gParProvincia(), '', 'F_Error', 'post', 0);
	}
}

function gParProvincia() {
	return "provinciaList=" + document.getElementById('provinciaList').value;
}

//Localidad
function comprobar_localidad() {
	if (document.getElementById('localidadList').value == 'Seleccione antes una provincia') {
		document.getElementById("localidad").innerHTML = "RELLENA EL CAMPO";
		comprobar[4] = "F";
	} else {
		document.getElementById("localidad").innerHTML = "&#10004";
		comprobar[4] = "V";
		llamarAjax('', gParLocalidad(), '', 'F_Error', 'post', 0);
	}
}

function gParLocalidad() {
	return "localidadList=" + document.getElementById('localidadList').value;
}
//password
function comprobar_password() {
	if (document.getElementById('password').value == '') {
		document.getElementById("Password").innerHTML = "RELLENA EL CAMPO";
		comprobar[2] = "F";
	} else {
		document.getElementById("Password").innerHTML = "&#10004";
		comprobar[2] = "V";
		llamarAjax('', gParPassword(), '', 'F_Error', 'post', 0);
	}
}
function gParPassword() {
	return "password=" + document.getElementById('password').value;
}
//alta
function comprobar_boton_form() {
	let correcto = true;
	for (i = 0; i < comprobar.length; i++) {
		if (comprobar[i] == "F") correcto = false;
	}
	if (correcto) llamarAjax('editar_dependientes.php', gParAlta(), 'cBAlta', 'F_Error', 'post', 0);
	else alert("comprueba los datos");
}

function gParAlta() {
	return "Nombre=" + document.getElementById('Nombre').value +
		"&correo=" + document.getElementById('correo').value +
		"&provinciaList=" + document.getElementById('provinciaList').value +
		"&localidadList=" + document.getElementById('localidadList').value +
		"&fecha_nacimiento=" + document.getElementById('fecha_nacimiento').value +
		"&necesidad=" + document.getElementById('dependencia').value +
		"&password=" + document.getElementById('password').value;
}

function cBAlta(resultado) {
	let datos = JSON.parse(resultado);
	if (datos.alta == true) {
	
		for (let i = 0; i < comprobar.length; i++) {
			comprobar[i] = "F";
		}
		window.location.replace("usuario_correcto.html");
		
	} else {
		p.style.color = "red";
		p.innerHTML = "ERRORE";

	}
}


//comprobar nombre
function comprobar_nombre() {
	if (document.getElementById('Nombre').value == '') {
		document.getElementById("nombre").innerHTML = "RELLENA EL CAMPO";
		comprobar[0] = "F";
	} else if (!isNaN(document.getElementById('Nombre').value)) {
		document.getElementById("nombre").innerHTML = "Solo letras y espacios";
		comprobar[0] = "F";
	} else {
		document.getElementById("nombre").innerHTML = "  &#10004";
		comprobar[0] = "V";
		llamarAjax('', gParNOMBRE(), '', 'F_Error', 'post', 0);
	}
}

function gParNOMBRE() {
	return "Nombre=" + document.getElementById('Nombre').value;
}


function F_Error(textoError) {
	let contenedor = document.getElementById('alta');
	contenedor.innerHTML = "Se a producido un error: " + textoError + " ";
	alert("Error en la pagina");
}




