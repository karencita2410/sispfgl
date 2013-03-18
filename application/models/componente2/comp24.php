<?php


/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
Class comp24 extends CI_Model{
    
    function changeDate($date){
        $t = explode('/',$date);
        return date('Y-m-d',mktime(0,0,0,$t[1],$t[0],$t[2]));
    }
    
    public function select_data($tabla, $where='', $out='json'){
        
        return $data = $this->db->get_where($tabla,$where);
        //return json_encode($data->result());
    }
    
    public function count_sexo($tabla,$campo_sexo,$campo_index,$index){
        $male = $this->db->query('SELECT count(*) FROM ' . $tabla . ' WHERE ' . $campo_sexo . " = 'M' AND " . $campo_index . ' = ' . $index . ';' )->row()->count;
        $female = $this->db->query('SELECT count(*) FROM ' . $tabla . ' WHERE ' . $campo_sexo . " = 'F' AND " . $campo_index . ' = ' . $index . ';' )->row()->count;
        return array('male'=>$male,'female'=>$female,'total'=>$male+$female);
    }
    
    /**
     * Guarda los datos de 2.4-0-A
     */
    public function insert_solicitud_ayuda($municipio, $fecha_emision, $fecha_recepcion){
        $data_new = array(
            'mun_id'                    =>  $municipio,
            'sol_ayu_fecha_emision'     =>  $this->changeDate($fecha_emision),
            'sol_ayu_fecha_recepcion'   =>  $this->changeDate($fecha_recepcion)
        );
        return $this->db->insert('solicitud_ayuda', $data_new);
    }
    
    /**
     * Funciones 2.4-F0-B
     */
    
    public function insert_acuerdo_municipal($municipio, $f_acuerdo, $f_recepcion, $f_conformacion, $archivo, 
            $observaciones){
        $data_new = array(
            'mun_id'                    =>  $municipio,
            'acu_mun_fecha_acuerdo'     =>  $this->changeDate($f_acuerdo),
            'acu_mun_fecha_recepcion'   =>  $this->changeDate($f_recepcion),
            'acu_mun_fecha_conformacion'=>  $this->changeDate($f_conformacion),
            'acu_mun_archivo'           =>  $archivo,
            'acu_mun_observaciones'     =>  $observaciones 
        );
        
        return $this->db->insert('acuerdo_municipal2', $data_new);
    }
    
    public function getDepto($mun_id){
        $sql = 'SELECT departamento.dep_nombre FROM
departamento , municipio
WHERE
departamento.dep_id = (SELECT municipio.dep_id FROM municipio WHERE municipio.mun_id = ' . $mun_id . ')
GROUP BY dep_nombre';
        return $this->db->query($sql)->row();
    }
    
    public function get_by_Id($table,$index,$id){
        $this->db->where($index, $id);

        $query = $this->db->get($table);
        if ($query->num_rows() == 1)
            return $query->row();
        return null;
    }
    
    public function insert_row($tabla, $data){
        return $this->db->insert($tabla, $data);
    }
    
    public function update_row($tabla,$campo,$index,$data){
        return $this->db->update($tabla,$data,array($campo=>$index));
    }
    
    public function db_row_delete($tabla,$campo,$index){
        return $this->db->delete($tabla,array($campo=>$index));
    }
    
    public function insert_indicadores1($data){
        
        return $this->db->insert('indicadores_desempeno1',$data);
    }

	
}    
    
?>
