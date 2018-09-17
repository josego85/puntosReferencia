var v_mapa = null;
var v_accion = null;

/**
 * @method localizame
 * GeoLocalizacion por html5.
 * @returns void
 */
function localizame(p_accion){
	v_accion = p_accion;
	
	/**
	 * OBS:
	 * - Iceweasel 27.0.1 en Debian Wheezy NO funciona la GeoLocalizacion del html5.
	 * - Mozilla Firefox en Windows si funciona la GeoLocaclizacion del html5.
	 */
	if(navigator.geolocation){
   	 	navigator.geolocation.getCurrentPosition(obtenerCoordenadas, errores, {
   	 		enableHighAccuracy: true, 
   	 		maximumAge: 30000, 
   	 		timeout: 27000
   	 	});
    }else{
    	 // La latitud y longitud usa los valores por defecto que se definieron en las
    	 // variables globales.
    	 // Se carga el mapa.
    	 posicionPorDefecto();
    }
}

/**
 * @method obtenerCoordenadas
 * Metodo que obtiene las coordenadas actuales por medio de la geolocalizacion.
 * @param p_position
 * @returns void
 */
function obtenerCoordenadas(p_position){
	// Se crea un array con latitud y longitud.
	var v_coordenadas = new Array();
	v_coordenadas['latitud'] = p_position.coords.latitude;
	v_coordenadas['longitud']  = p_position.coords.longitude;
	
	iniciar_mapa(v_coordenadas);
}

/**
 * Metodo errores, sea el codigo de error que salga, va a cargar por defecto coordenadas (latitud y longitud) de USA.
 * @method errores
 * @param error
 * @returns void
 */
function errores(error){
	/*
	switch(error.code){
    	case error.PERMISSION_DENIED:
    		alert("User denied the request for Geolocation.");
    		break;
    	case error.POSITION_UNAVAILABLE:
    		alert("Location information is unavailable.");
    		break;
    	case error.TIMEOUT:
    		alert("The request to get user location timed out.");
    		break;
    	case error.UNKNOWN_ERROR:
    		alert("An unknown error occurred.");
    		break;
    }
    */
	posicionPorDefecto();
}	

/**
 * @method posicionPorDefecto
 * Metodo que posiciona por defecto Asuncion - Paraguay.
 * @returns void
 */ 
function posicionPorDefecto(){
	//Asuncion - Paraguay.
	var v_latitud = -25.2961407;
	var v_longitud = -57.6309129;
	
	// Se crea un array con latitud y longitud.
	var v_coordenadas = new Array();
	v_coordenadas['latitud'] = v_latitud;
	v_coordenadas['longitud']  = v_longitud;
	
	iniciar_mapa(v_coordenadas);
}

//
function iniciar_mapa(p_coordenadas){
	switch(v_accion){
	    case 'listar':
	    	// Crear Mapa.
	    	v_mapa = new Mapa('', p_coordenadas, 10);
	    	
	        v_mapa.obtener_eventos();
	    	break;
	    case 'marcar':
	    	// Crear Mapa.
	    	v_mapa = new Mapa('', p_coordenadas, 10);
	    	break;
	}
}

//
function direccion_buscador() {
    var v_entrada = document.getElementById("direccion");

    $.getJSON('http://nominatim.openstreetmap.org/search?format=json&limit=5&q=' + v_entrada.value, function(p_data) {
        var v_array_items = [];

        $.each(p_data, function(key, val) {
            bb = val.boundingbox;
            console.log('val: ', val);
            
            v_array_items.push("<li><a href='#' onclick='elegirDireccion(" + bb[0] + ", " + bb[2] + ", " + bb[1] + ", " + bb[3] + ", \"" + val.osm_type + "\");return false;'>" + val.display_name + '</a></li>');
        });

        $('#resultado').empty();
        if (v_array_items.length != 0) {
            $('<p>', { html: "Resultados de la b&uacute;queda:" }).appendTo('#resultado');
            $('<ul/>', {
                'class': 'my-new-list',
                html: v_array_items.join('')
            }).appendTo('#resultado');
        }else{
             $('<p>', { html: "Ningun resultado encontrado." }).appendTo('#resultado');
        }
    });
}

//
function elegirDireccion(p_lat1, p_lng1, p_lat2, p_lng2, p_tipo_osm) {
    v_mapa.marcar(p_lat1, p_lng1, p_lat2, p_lng2, p_tipo_osm);
}