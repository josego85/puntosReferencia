var mapa = null;
var accion = null;

/**
 * @method localizame
 * GeoLocalizacion por html5.
 * @returns void
 */
function localizame(p_accion){
    accion = p_accion;

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
    var coordenadas = new Array();
    coordenadas['latitud'] = p_position.coords.latitude;
    coordenadas['longitud']  = p_position.coords.longitude;

    iniciar_mapa(coordenadas);
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
    var latitud = -25.2961407;
    var longitud = -57.6309129;

    // Se crea un array con latitud y longitud.
    var coordenadas = new Array();
    coordenadas['latitud'] = latitud;
    coordenadas['longitud']  = longitud;

    iniciar_mapa(coordenadas);
}

//
function iniciar_mapa(p_coordenadas){
    switch(accion){
        case 'listar':
            // Crear mapa.
            mapa = new Mapa('listar', p_coordenadas, 10);

            mapa.obtener_eventos();
            break;
        case 'agregar':
            // Crear mapa.
            mapa = new Mapa('agregar', p_coordenadas, 10);
            break;
    }
}

//
function elegirDireccion(p_lat1, p_lng1, p_lat2, p_lng2, p_tipo_osm) {
    mapa.marcar(p_lat1, p_lng1, p_lat2, p_lng2, p_tipo_osm);
}