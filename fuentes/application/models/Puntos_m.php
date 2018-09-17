<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Puntos_m extends CI_Model {
    /**
     * Modelo para manejo de los puntos. 
     * @author josego
     */
    public function __construct(){
        parent::__construct();
    }	
    
    /**
     * Metodo publico que trae todos los puntos.
     * @return unknown
     */
    public function listar_puntos(){
    	$consulta = $this->db->get('puntos');
    	return $consulta;
    }
    
    /**
     * Metodo publico que recupera la cantidad de filas (reales si se uso sql_calc_found_rows)
     * de la ultima consulta que se haya ejecutado.
     * @return integer
     */
    public function get_cantidad_resultados(){
    	return $this->db->query('select FOUND_ROWS() as found_rows')->row()->found_rows;
    }
    
    /**
     * 
     * @param Array $p_datos
     * @return boolean
     */
    public function insertar_punto($p_datos){
    	if($this->db->insert('puntos', $p_datos)){
            return $this->db->insert_id();
    	}
    	return false;
    	
    }
}
/* End of Puntos_m.php */