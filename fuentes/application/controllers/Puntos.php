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
        $r = $this->puntos->listar_puntos();
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
     * Metodo publico que agrega un punto.
     */
    public function agregarPunto(){
        $p_punto_nombre = $this->input->post('punto_nombre', true);
        $p_punto_descripcion = $this->input->post('punto_descripcion', true);
        $p_punto_latitud = $this->input->post('punto_latitud', true);
        $p_punto_longitud = $this->input->post('punto_longitud', true);

        $v_datos = array(
            'punto_nombre' => $p_punto_nombre,
            'punto_descripcion' => $p_punto_descripcion,
            'punto_latitud' => $p_punto_latitud,
            'punto_longitud' => $p_punto_longitud
        );

        if($this->puntos->insertar_punto($v_datos)){
            echo "Inserto correctamente.";
        }else{
             echo "No inserto correctamente.";
        }
    }
}
/* End of file Puntos.php */