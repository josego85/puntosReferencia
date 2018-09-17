var v_feature = null;
var v_marcador_evento = null;

// Clase Mapa.

// Constructor del mapa.
function Mapa(p_tipo, p_coordenadas, p_zoom) {
    // Atributos.
    this.tipo = p_tipo;
    this.coordenadas = p_coordenadas;
    this.zoom = p_zoom;
    
    mapa =  L.map('mapa').setView([p_coordenadas['latitud'], p_coordenadas['longitud']], p_zoom);
    
    // Humanitarian Style.
    L.tileLayer('https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
        maxZoom: 18,
        attribution: 'Data \u00a9 <a href="https://www.openstreetmap.org/copyright"> OpenStreetMap Contributors </a> Tiles \u00a9 HOT'
    }).addTo(mapa); 
    this.mapa = mapa;
}

/////////////////////////
// Metodos
/////////////////////////

//
Mapa.prototype.obtener_eventos = function() {
    // Obtener atributos de la clase.
    var mapa = this.mapa;

    this.geojsonLayer = new L.GeoJSON();
    v_geojsonLayer = this.geojsonLayer;

    // Link de donde se sacan los puntos.
    // Devuelve una estructura json.
    var v_geo_json_url = HOSTNAME + "puntos/listarPuntos_jsonp?";

    this.cluster_marcadores = L.markerClusterGroup();
    v_cluster_marcadores = this.cluster_marcadores;
	
    function getJson(p_data) {
    	v_geojsonLayer = L.geoJson(p_data, {
            onEachFeature: onEachFeature
    	});
    	v_cluster_marcadores.addLayer(v_geojsonLayer); 			// Agrega al Cluster group.
    }

    mapa.addLayer(v_cluster_marcadores);						// Agrega al mapa.

    $.ajax({
        url: v_geo_json_url,
        dataType: 'jsonp',
        jsonpCallback: 'getJson',
        success: getJson
    });
};

Mapa.prototype.marcar = function(p_lat1, p_lng1, p_lat2, p_lng2, p_tipo_osm){
    // Obtener atributos de la clase.
    var mapa = this.mapa;
	
    var v_loc1 = new L.LatLng(p_lat1, p_lng1);
    var v_loc2 = new L.LatLng(p_lat2, p_lng2);
    var v_bounds = new L.LatLngBounds(v_loc1, v_loc2);
    
    if(v_feature){
    	mapa.removeLayer(v_feature);
    }
    if(p_tipo_osm == "node") {
        //feature = L.circle( loc1, 25, {color: 'green', fill: false}).addTo(mapa);
        mapa.fitBounds(v_bounds);
        mapa.setZoom(18);
    }else{
         var v_loc3 = new L.LatLng(p_lat1, p_lng2);
         var v_loc4 = new L.LatLng(p_lat2, p_lng1);

         v_feature = L.polyline( [v_loc1, v_loc4, v_loc2, v_loc3, v_loc1], {
             color: 'red'
         }).addTo(mapa);	
         mapa.fitBounds(v_bounds);
    }
    v_marcador_evento = new L.marker(v_loc1, {
        id: 'evento', 
        draggable:'true'
    });
    mapa.addLayer(v_marcador_evento);
}


/////////////////////////
// Funciones internas.
/////////////////////////

//
function onEachFeature(p_feature, p_layer) {
    if(p_feature.properties){
        var popupString = '<div class="popup">';

        for(var k in p_feature.properties) {
            var v = p_feature.properties[k];

            // Como viene de la base de datos el campo todo en minuscula,
            // queremos tener la primera letra en mayuscula.
            var etiqueta = k.charAt(0).toUpperCase() + k.slice(1)

            popupString += '<b>' + etiqueta + '</b>: ' + v + '<br />';
        }
        popupString += '</div>';
        p_layer.bindPopup(popupString);
    }
}