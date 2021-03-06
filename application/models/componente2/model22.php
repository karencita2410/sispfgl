<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

Class model22 extends CI_Model {

    function changeDate($date) {
        $t = explode('/', $date);
        return date('Y-m-d', mktime(0, 0, 0, $t[1], $t[0], $t[2]));
    }

    public function select_data($tabla, $where = null, $out = 'json') {

        return $data = $this->db->get_where($tabla, $where);
        //return json_encode($data->result());
    }

    public function count_sexo($tabla, $campo_sexo, $campo_index, $index) {
        $male = $this->db->query('SELECT count(*) FROM ' . $tabla . ' WHERE ' . $campo_sexo . " = 'M' AND " . $campo_index . ' = ' . $index . ';')->row()->count;
        $female = $this->db->query('SELECT count(*) FROM ' . $tabla . ' WHERE ' . $campo_sexo . " = 'F' AND " . $campo_index . ' = ' . $index . ';')->row()->count;
        return array('male' => $male, 'female' => $female, 'total' => $male + $female);
    }

    /**
     * Guarda los datos de 2.4-0-A
     */
    public function insert_solicitud_ayuda($municipio, $fecha_emision, $fecha_recepcion) {
        $data_new = array(
            'mun_id' => $municipio,
            'sol_ayu_fecha_emision' => $this->changeDate($fecha_emision),
            'sol_ayu_fecha_recepcion' => $this->changeDate($fecha_recepcion)
        );
        return $this->db->insert('solicitud_ayuda', $data_new);
    }

    /**
     * Funciones 2.4-F0-B
     */
    public function insert_acuerdo_municipal($municipio, $f_acuerdo, $f_recepcion, $f_conformacion, $archivo, $observaciones) {
        $data_new = array(
            'mun_id' => $municipio,
            'acu_mun_fecha_acuerdo' => $this->changeDate($f_acuerdo),
            'acu_mun_fecha_recepcion' => $this->changeDate($f_recepcion),
            'acu_mun_fecha_conformacion' => $this->changeDate($f_conformacion),
            'acu_mun_archivo' => $archivo,
            'acu_mun_observaciones' => $observaciones
        );

        return $this->db->insert('acuerdo_municipal2', $data_new);
    }

    public function getDepto($mun_id) {
        $sql = 'SELECT departamento.dep_nombre FROM
departamento , municipio
WHERE
departamento.dep_id = (SELECT municipio.dep_id FROM municipio WHERE municipio.mun_id = ' . $mun_id . ')
GROUP BY dep_nombre';
        return $this->db->query($sql)->row();
    }

    public function get_by_Id($table, $index, $id, $limit = true) {
        $this->db->where($index, $id);
        $this->db->order_by($index, 'asc');
        $query = $this->db->get($table);
        if (!$limit)
            return $query;
        if ($query->num_rows() == 1)
            return $query->row();
        else
            return false;
    }

    public function insert_row($tabla, $data) {
        return $this->db->insert($tabla, $data);
    }

    public function update_row($tabla, $campo, $index, $data) {
        return $this->db->update($tabla, $data, array($campo => $index));
    }

    public function db_row_delete($tabla, $campo, $index) {
        return $this->db->delete($tabla, array($campo => $index));
    }

    public function getParticipantes($capacitacion) {
        $query = 'Select p.par_id,p.par_nombres,p.par_apellidos,p.par_sexo,p.par_nivel,p.par_ins_municipio,p.par_ins_cargo,p.par_telefono 
            FROM c22_participantes as p WHERE p.par_id IN 
            (Select par_id From c22_cxp_solicitud Where c22_cxp_solicitud.par_id NOT IN  
                (SELECT cxp_par_id FROM c22_cxp_inscritos WHERE cxp_cap_id = ' . $capacitacion . ' ) AND c22_cxp_solicitud.cap_id = ' . $capacitacion . ')';
        return $this->db->query($query);
    }

    public function getInscritos($capacitacion) {
        $this->db->select('cxp_id, par_nombres, par_apellidos, par_sexo, par_nivel, 
            par_ins_municipio, par_ins_cargo, par_telefono');
        $this->db->from('c22_cxp_inscritos');
        $this->db->join('c22_participantes', 'cxp_par_id = par_id', 'inner');
        $this->db->where('cxp_cap_id', $capacitacion);
        return $this->db->get();
    }

    public function getResultados($capacitacion) {
        $this->db->select('cxp_id,par_nombres,par_apellidos,par_ins_municipio,cxp_estado,cxp_promedio,cxp_constancia,cxp_observaciones')
                ->from('c22_participantes')->join('c22_cxp_inscritos', 'cxp_par_id=par_id', 'inner')
                ->where('cxp_cap_id', $capacitacion);
        return $this->db->get();
    }

    public function obtenerProcesoFormacion() {
        $consulta = "
            SELECT C.cap_proceso nombre,C.cap_id,
                   count(D.cxp_cap_id) resultado,
                   (SELECT COUNT(cxp_cap_id)  
                    FROM c22_cxp_inscritos A,c22_participantes B
                   WHERE A.cxp_par_id=B.par_id AND A.cxp_cap_id=C.cap_id
		         AND B.par_sexo='M') hombres,
		   (SELECT COUNT(cxp_cap_id)  
                   FROM c22_cxp_inscritos A,c22_participantes B
                   WHERE A.cxp_par_id=B.par_id AND A.cxp_cap_id=C.cap_id
                         AND B.par_sexo='F') mujeres
            FROM c22_capacitaciones C left join c22_cxp_inscritos D
            ON D.cxp_cap_id=C.cap_id
            GROUP BY C.cap_proceso,C.cap_id ";
        $resultado = $this->db->query($consulta, array());
        return $resultado->result();
    }

    public function obtenerProcesoFormacionSolicitud() {
        $consulta = "SELECT C.cap_proceso nombre,C.cap_id,
                   count(D.cap_id) resultado,
                   (SELECT COUNT(cap_id)  
                    FROM c22_cxp_solicitud A,c22_participantes B
                   WHERE A.par_id=B.par_id AND A.cap_id=C.cap_id
		         AND B.par_sexo='M') hombres,
		   (SELECT COUNT(cap_id)  
                   FROM c22_cxp_solicitud A,c22_participantes B
                   WHERE A.par_id=B.par_id AND A.cap_id=C.cap_id
                         AND B.par_sexo='F') mujeres
            FROM c22_capacitaciones C left join c22_cxp_solicitud D
            ON D.cap_id=C.cap_id
            GROUP BY C.cap_proceso,C.cap_id";
        $resultado = $this->db->query($consulta, array());
        return $resultado->result();
    }

    public function obtenerHombresFormacion($mun_id) {
        $consulta = " SELECT C.cap_proceso nombre,C.cap_id,
                   (SELECT COUNT(cxp_cap_id)  
                    FROM c22_cxp_inscritos A,c22_participantes B
                   WHERE A.cxp_par_id=B.par_id AND A.cxp_cap_id=C.cap_id
		         AND B.par_sexo='M' AND B.mun_id=?) hombres,
		   (SELECT COUNT(cxp_cap_id)  
                   FROM c22_cxp_inscritos A,c22_participantes B
                   WHERE A.cxp_par_id=B.par_id AND A.cxp_cap_id=C.cap_id
                         AND B.par_sexo='F' AND B.mun_id=?) mujeres
            FROM c22_capacitaciones C left join c22_cxp_inscritos D
            ON D.cxp_cap_id=C.cap_id
            GROUP BY C.cap_proceso,C.cap_id";
        $resultado = $this->db->query($consulta, array($mun_id,$mun_id));
        return $resultado->result();
    }
    

}

?>
