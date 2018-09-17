<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Puntos extends CI_Controller {
    /**
     * 
     * @author josego
     */
    public function __construct(){
        parent::__construct();
        $this->load->model('puntos_m', 'puntos');
    }

    /**
     *
     */
    public function index(){
    }

    /**
     *
     */
    public function listarEventos(){
        $r = $this->eventos->listarEventos();
        $v_geojson = $this->listar_eventos($r);
        header("Content-Type:application/json", true);
        echo json_encode($v_geojson);
    }

    /**
     *
     */
    public function listarPuntos_jsonp(){
        $r = $this->puntos->listarPuntos();
        $v_geojson = $this->listar_puntos($r);
        if(isset($_GET['callback'])){
            header("Content-Type: application/json");
            echo $_GET['callback']."(".json_encode($v_geojson).")";
        }
    }


    /*
     * Metodos Privados.
    */
    private function listar_puntos($p_r){
        // Marcadores en formato GeoJSON.
        $v_geojson = array(
            'type' => 'FeatureCollection',
            'features' => array()
        );

        if($p_r->num_rows() > 0){
            $v_puntos = $p_r->result();

            foreach($v_puntos as $p_punto) {
                $v_punto = array(
                    'type' => 'Feature',
                    'geometry' => array(
                        'type' => 'Point',
                            'coordinates' => array($p_punto->punto_longitud, $p_punto->punto_latitud)
                    ),
                    'properties' => array(
                        'nombre' => $p_punto->punto_nombre,
                        'descripcion' => $p_punto->punto_descripcion
                    )
                );
                array_push($v_geojson['features'], $v_punto);
            };
        }
        return $v_geojson;
    }

    /**
     *
     */
    public function agregarEvento(){
        $p_evento_nombre = $this->input->post('evento_nombre', true);
        $p_evento_lugar = $this->input->post('evento_lugar', true);
        $p_evento_fecha_inicio = $this->input->post('evento_fecha_inicio', true);
        $p_evento_fecha_fin = $this->input->post('evento_fecha_fin', true);
        $p_evento_latitud = $this->input->post('evento_latitud', true);
        $p_evento_longitud = $this->input->post('evento_longitud', true);

        $v_datos = array(
            'evento_nombre' => $p_evento_nombre,
            'evento_lugar' => $p_evento_lugar,
            'evento_fecha_inicio' => $p_evento_fecha_inicio,
            'evento_fecha_fin' => $p_evento_fecha_fin,
            'evento_latitud' => $p_evento_latitud,
            'evento_longitud' => $p_evento_longitud
        );

        if($this->eventos->insertarEvento($v_datos)){
            echo "Inserto correctamente.";
        }else{
             echo "No inserto correctamente.";
        }
    }
}
/* End of file eventos.php */