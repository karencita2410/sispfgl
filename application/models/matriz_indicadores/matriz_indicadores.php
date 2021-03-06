<?php


Class matriz_indicadores extends CI_Model{

	public function insertar_poa_gr($new_poa_gr,$new_arch) {
		
		$data_dd = array(
          'id_mun' => $new_poa_gr['mun_id'],
          'anio_poa_gr' => $new_poa_gr['anio_gr'],
		  'doc_poa_gr' => $new_arch,
		  'estado_poa_gr' => $new_poa_gr['estado_gr']
        );
        
		
		$this->db->insert('segui_poa_gr', $data_dd); 
		//return $data_sec;
		//$this->db->where('id', $id);
		//$this->db->update('gestionperiodos', $data);
	}
	
	public function get_indicadores() {
			$query = $this->db->get('matriz_indicadores');
			return $query->result();
		}
	
	public function get_mun_nombre($id_mun){
			$this->db->where('mun_id', $id_mun);
			$query = $this->db->get('municipio');
			$row = $query->row();
			return $row->mun_nombre;
		}

}

?>
