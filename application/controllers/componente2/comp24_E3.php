<?php

/**
 * Contendrá todos los metodos utilizados para definir las pantallas de la Etapa 3
 * Del Componente 2.4
 *
 * Rodrigo Vasquez
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Comp24_E3 extends CI_Controller {
    
    private $ruta = "componente2/subcomp24/etapa3/";

    public function __construct() {
        parent::__construct();
        $this->load->model('pais/departamento');
        $this->load->model('componente2/comp24');
        $this->load->library('librerias');
        $this->form_validation->set_error_delimiters('<span class="error">', '</span>');
        $this->form_validation->set_message('is_natural_no_zero', '* Obligatorio');
    }
    
    public function aprobacionImplementacion($id = false){
        if (!$this->tank_auth->is_logged_in()) redirect('/auth');                // logged in
        $tabla = 'seguimiento_aprimp';
        $campo = 'seg_id';
        $prefix = 'seg_';
        
        if($id && !isset($_POST['mod'])){
            if(!$tmp = $this->comp24->get_by_id($tabla, $campo, $id)){
                $this->comp24->insert_row($tabla,array($campo=>$id,'mun_id'=>$id));
                $tmp = $this->comp24->get_by_id($tabla, $campo, $id);
            }
            $_POST = get_object_vars($tmp);
            $_POST[$prefix.'fecha_emision'] = $this->librerias->parse_output('date',$_POST[$prefix.'fecha_emision']);
            $_POST[$prefix.'fecha_recepcion'] = $this->librerias->parse_output('date',$_POST[$prefix.'fecha_recepcion']);
            $_POST['depto']                   = $this->comp24->getDepto($_POST['mun_id'])->dep_nombre;
            $_POST['muni']                   = $this->comp24->get_by_Id('municipio','mun_id',$_POST['mun_id'])->mun_nombre;
        }
        
        $this->form_validation->set_message('required', '*');
        $this->form_validation->set_message('numeric', '*');
        
        $config = array(
            array('field' => 'depto', 'label' => 'Municipio', 'rules' => 'trim|xss_clean'),
            array('field' => 'muni', 'label' => 'Municipio', 'rules' => 'trim|xss_clean'),
            array('field' => 'mod', 'label' => 'Mod', 'rules' => 'required|xss_clean' ),
            array('field' => 'mun_id', 'label' => 'Municipio', 'rules' => 'trim|xss_clean'),
            array('field' => $prefix.'fecha_emision'             , 'label' => 'Fecha', 'rules' => 'trim|required|xss_clean'),
            array('field' => $prefix.'fecha_recepcion'             , 'label' => 'Fecha', 'rules' => 'trim|required|xss_clean'),
            array('field' => $prefix.'is_ok'    , 'label' => 'Periodo', 'rules' => 'trim|required|xss_clean'),
            array('field' => $prefix.'archivo_acuerdo'       , 'label' => 'Periodo', 'rules' => 'trim|xss_clean'),
            array('field' => $prefix.'observaciones'     , 'label' => 'Fecha', 'rules' => 'trim|xss_clean')
        );
             
        $this->form_validation->set_rules($config);
        
        $data['errors'] = array();
        $mensaje = false;
        
        if ($this->form_validation->run())
        {
            $datos = array(
                $prefix.'fecha_emision'    =>  $this->comp24->changeDate($this->form_validation->set_value($prefix.'fecha_emision')),
                $prefix.'fecha_recepcion'  =>  $this->comp24->changeDate($this->form_validation->set_value($prefix.'fecha_recepcion')),
                $prefix.'is_ok'            =>  $this->form_validation->set_value($prefix.'is_ok'),
                $prefix.'observaciones'    =>  $this->form_validation->set_value($prefix.'observaciones')
            );
            
            if(!is_null($data = $this->comp24->update_row($tabla,$campo,$id,$datos)))
                {
                    $this->session->set_flashdata('message', 'Ok');
                    $t = explode('/' . $id,current_url());
                    redirect($t[0]);
                }
                else
                {
                    $errors = $this->tank_auth->get_error_message();
                    foreach ($errors as $k => $v)    $data['errors'][$k] = $this->lang->line($v);
                }          
        }
       $this->load->view($this->ruta.'aprobacionImplementacion',
            array('titulo' => 'Solicitud de Ayuda',
                    'user_uid' => $this->tank_auth->get_user_id(),
                    'username' => $this->tank_auth->get_username(),
                    'menu' => $this->librerias->creaMenu($this->tank_auth->get_username()),
                    'departamentos' => $this->comp24->getDepartamentos(),
                    $campo=>$id
                    ));
    }
	
	/**
     * Alias para llamar a la funcion B
     */
    public function elaboracionPerfilyTDR($id = false){
	   if (!$this->tank_auth->is_logged_in()) redirect('/auth');                // logged in
        $tabla = 'seguimiento_3b';
        $campo = 'seg_id';
        $prefix = 'seg_';
        
        if($id && !isset($_POST['mod'])){
            if(!$tmp = $this->comp24->get_by_id($tabla, $campo, $id)){
                $this->comp24->insert_row($tabla,array($campo=>$id,'mun_id'=>$id));
                $tmp = $this->comp24->get_by_id($tabla, $campo, $id);
            }
            $_POST = get_object_vars($tmp);
            $_POST[$prefix.'fecha_emision'] = $this->librerias->parse_output('date',$_POST[$prefix.'fecha_emision']);
            $_POST[$prefix.'fecha_recepcion'] = $this->librerias->parse_output('date',$_POST[$prefix.'fecha_recepcion']);
            $_POST[$prefix.'fecha_envio'] = $this->librerias->parse_output('date',$_POST[$prefix.'fecha_envio']);
            $_POST['depto']                   = $this->comp24->getDepto($_POST['mun_id'])->dep_nombre;
            $_POST['muni']                   = $this->comp24->get_by_Id('municipio','mun_id',$_POST['mun_id'])->mun_nombre;
        }
        
        $this->form_validation->set_message('required', '*');
        $this->form_validation->set_message('numeric', '*');
        
        $config = array(
            array('field' => 'depto', 'label' => 'Municipio', 'rules' => 'trim|xss_clean'),
            array('field' => 'muni', 'label' => 'Municipio', 'rules' => 'trim|xss_clean'),
            array('field' => 'mod', 'label' => 'Mod', 'rules' => 'required|xss_clean' ),
            array('field' => 'mun_id', 'label' => 'Municipio', 'rules' => 'trim|xss_clean'),
            array('field' => $prefix.'fecha_emision'             , 'label' => 'Fecha', 'rules' => 'trim|required|xss_clean'),
            array('field' => $prefix.'fecha_recepcion'             , 'label' => 'Fecha', 'rules' => 'trim|required|xss_clean'),
            array('field' => $prefix.'fecha_envio'             , 'label' => 'Fecha', 'rules' => 'trim|required|xss_clean'),
            array('field' => $prefix.'rubros'    , 'label' => 'Periodo', 'rules' => 'trim|required|xss_clean'),
            array('field' => $prefix.'descripcion'     , 'label' => 'Fecha', 'rules' => 'trim|xss_clean'),
            array('field' => $prefix.'archivo_perfil'       , 'label' => 'Periodo', 'rules' => 'trim|xss_clean'),
            array('field' => $prefix.'archivo_tdr'       , 'label' => 'Periodo', 'rules' => 'trim|xss_clean'),
            array('field' => $prefix.'archivo_acuerdo'       , 'label' => 'Periodo', 'rules' => 'trim|xss_clean'),
            array('field' => $prefix.'observaciones'     , 'label' => 'Fecha', 'rules' => 'trim|xss_clean')
        );
             
        $this->form_validation->set_rules($config);
        
        $data['errors'] = array();
        $mensaje = false;
        
        if ($this->form_validation->run())
        {
            $datos = array(
                $prefix.'fecha_emision'   =>  $this->comp24->changeDate($this->form_validation->set_value($prefix.'fecha_emision')),
                $prefix.'fecha_recepcion' =>  $this->comp24->changeDate($this->form_validation->set_value($prefix.'fecha_recepcion')),
                $prefix.'fecha_envio'     =>  $this->comp24->changeDate($this->form_validation->set_value($prefix.'fecha_envio')),
                $prefix.'rubros'          =>  $this->form_validation->set_value($prefix.'rubros'),
                $prefix.'descripcion'      =>  $this->form_validation->set_value($prefix.'descripcion'),
                $prefix.'observaciones'    =>  $this->form_validation->set_value($prefix.'observaciones')
            );
            
            if(!is_null($data = $this->comp24->update_row($tabla,$campo,$id,$datos)))
                {
                    $this->session->set_flashdata('message', 'Ok');
                    $t = explode('/' . $id,current_url());
                    redirect($t[0]);
                }
                else
                {
                    $errors = $this->tank_auth->get_error_message();
                    foreach ($errors as $k => $v)    $data['errors'][$k] = $this->lang->line($v);
                }          
        }
       
       $this->load->view($this->ruta.'elaboracionPerfilyTDR',
            array('titulo' => 'Solicitud de Ayuda',
                    'user_uid' => $this->tank_auth->get_user_id(),
                    'username' => $this->tank_auth->get_username(),
                    'menu' => $this->librerias->creaMenu($this->tank_auth->get_username()),
                    'departamentos' => $this->comp24->getDepartamentos(),
                    $campo=>$id
                    ));
    }
    
    
    /**
     * Alias para llamar a la funcion C
     */
   public function recepcionProductosPlan($id = false){
	   if (!$this->tank_auth->is_logged_in()) redirect('/auth');                // logged in
        $tabla = 'recepcion_productos';
        $campo = 'acu_mun_id';
        $prefix = 'rec_pro_';
        
        if($id && !isset($_POST['mod'])){
            if(!$tmp = $this->comp24->get_by_id($tabla, $campo, $id)){
                $this->comp24->insert_row($tabla,array($campo=>$id,'mun_id'=>$id));
                $tmp = $this->comp24->get_by_id($tabla, $campo, $id);
            }
            $_POST = get_object_vars($tmp);
            /*$_POST[$prefix.'fecha_recepcion'] = $this->librerias->parse_output('date',$_POST[$prefix.'fecha_recepcion']);
            $_POST[$prefix.'fecha_vistobueno'] = $this->librerias->parse_output('date',$_POST[$prefix.'fecha_vistobueno']);
            $_POST[$prefix.'fecha_aprobacion'] = $this->librerias->parse_output('date',$_POST[$prefix.'fecha_aprobacion']);*/
            $_POST['depto']                   = $this->comp24->getDepto($_POST['mun_id'])->dep_nombre;
            $_POST['muni']                   = $this->comp24->get_by_Id('municipio','mun_id',$_POST['mun_id'])->mun_nombre;
        }
        
        $this->form_validation->set_message('required', '*');
        $this->form_validation->set_message('numeric', '*');
        
        $config = array(
            array('field' => 'depto', 'label' => 'Municipio', 'rules' => 'trim|xss_clean'),
            array('field' => 'muni', 'label' => 'Municipio', 'rules' => 'trim|xss_clean'),
          /*  array('field' => 'acu_mun_id', 'label' => 'Recepcion', 'rules' => 'trim|xss_clean'),*/
            array('field' => 'mun_id', 'label' => 'Municipio', 'rules' => 'trim|xss_clean'),
            array('field' => 'rec_pro1_observaciones'             , 'label' => 'Fecha', 'rules' => 'trim|xss_clean'),
            array('field' => 'mod', 'label' => 'Mod', 'rules' => 'required|xss_clean' )
            
        );
             
        $this->form_validation->set_rules($config);
        
        $data['errors'] = array();
        $mensaje = false;
        
        if ($this->form_validation->run())
        {
            $datos = array(
              /*  $prefix.'id'   =>  $this->form_validation->set_value($prefix.'id'),*/
               /* 'acu_mun_id'   =>  $this->form_validation->set_value('acu_mun_id'),*/
            /*    'mun_id'   =>  $this->form_validation->set_value('acu_mun_id'),*/
         /*       'mun_id'   =>  $this->form_validation->set_value('mun_id'),*/
                'rec_pro1_observaciones'     =>  $this->form_validation->set_value('rec_pro1_observaciones'),
                
            );
            if ($id > '0') {
                if (!is_null($data = $this->comp24->update_row($tabla, $campo, (int) $id, $datos))) {
                    $this->session->set_flashdata('message', 'Ok');
                    $t = explode('/' . $id, current_url());
                    redirect($t[0]);
                }
            } else {
                if (!is_null($data = $this->comp24->insert_recepcionProductosPlan(
                             /*   $this->form_validation->set_value('acu_mun_id'), */
                                $this->form_validation->set_value('mun_id'),   
                                $this->form_validation->set_value('rec_pro1_observaciones')
                        ))) {
                    $this->session->set_flashdata('message', 'Ok');
                    $t = explode('/0', current_url());
                    redirect($t[0]);
                } else {
                    $errors = $this->tank_auth->get_error_message();
                    foreach ($errors as $k => $v)
                        $data['errors'][$k] = $this->lang->line($v);
                }
            }
        } else if (($mun = $this->input->post('mun_id')) != '0' && $id == false) {
            //
            redirect(current_url() . '/' . $this->setNewId($tabla, $campo, array('mun_id' => $mun)));
        }

        $this->load->view($this->ruta . 'recepcionProductosPlan', array('titulo' => 'recepcionProductos',
            'user_uid' => $this->tank_auth->get_user_id(),
            'username' => $this->tank_auth->get_username(),
            'menu' => $this->librerias->creaMenu($this->tank_auth->get_username()),
            'departamentos' => $this->comp24->getDepartamentos(),
            $campo => $id
        ));
    } 
            
            
            
            /*if(!is_null($data = $this->comp24->update_row($tabla,$campo,$id,$datos)))
                {
                    $this->session->set_flashdata('message', 'Ok');
                    $t = explode('/' . $id,current_url());
                    redirect($t[0]);
                }
                else
                {
                    $errors = $this->tank_auth->get_error_message();
                    foreach ($errors as $k => $v)    $data['errors'][$k] = $this->lang->line($v);
                }          
        }
       
       $this->load->view($this->ruta.'recepcionProductosPlan',
            array('titulo' => 'Productos',
                    'user_uid' => $this->tank_auth->get_user_id(),
                    'username' => $this->tank_auth->get_username(),
                    'menu' => $this->librerias->creaMenu($this->tank_auth->get_username()),
                    'departamentos' => $this->comp24->getDepartamentos(),
                    $campo=>$id
                    ));
    }*/
            
       
            
    public function getRecepcionProductos($mun_id){
        if (!$this->tank_auth->is_logged_in()) redirect('/auth');                // logged in
        
        $d = $this->comp24->select_data('recepcion_productos',array('acu_mun_id'=>$mun_id));
        echo $this->librerias->json_out($d, 'acu_mun_id', array('acu_mun_id','mun_id','rec_pro1_observaciones'));
  
        
    }
      public function recepcion_loadProductos($id) {
        if (!$this->tank_auth->is_logged_in())
            redirect('/auth');                // logged in

        $d = $this->comp24->select_data('recepcion_productos2', array('mun_id' => $id));

        echo $this->librerias->json_out($d, 'rec_pro_id');
    }
    
     public function gestionRecepcionProductos($id){
        if (!$this->tank_auth->is_logged_in()) redirect('/auth');                // logged in
        
        $tabla = 'recepcion_productos2';
        $campo = 'rec_pro_id';
        $index = $this->input->post('id');
        
        $data = array(
            'mun_id' => $id,
            'rec_pro_nombre_producto'    => $this->input->post('rec_pro_nombre_producto'),
            'rec_pro_descripcion_producto' => $this->input->post('rec_pro_descripcion_producto'),
            'rec_pro_observaciones'      => $this->input->post('rec_pro_observaciones'));
        
        switch ($this->input->post('oper')){ 
        	case 'add':$this->comp24->insert_row($tabla, $data);
        	break;
        
        	case 'edit':$this->comp24->update_row($tabla, $campo, $index, $data);
        	break;
        
        	case 'del':$this->comp24->db_row_delete($tabla, $campo, $index);
        	break;
        }
    }
        /**
     * Alias para llamar a la funcion 
     */
    public function informeResultados($id = false){
        if (!$this->tank_auth->is_logged_in()) redirect('/auth');                // logged in
        $tabla = 'seguimiento_evaluacion';
        $campo = 'seg_eva_id';
        $prefix = 'seg_eva_';
        
        if($id && !isset($_POST['mod'])){
            if(!$tmp = $this->comp24->get_by_id($tabla, $campo, $id)){
                $this->comp24->insert_row($tabla,array($campo=>$id,'mun_id'=>$id));
                $tmp = $this->comp24->get_by_id($tabla, $campo, $id);
            }
            $_POST = get_object_vars($tmp);
            $_POST[$prefix.'fecha_presentacion'] = $this->librerias->parse_output('date',$_POST[$prefix.'fecha_presentacion']);
            $_POST['depto']                   = $this->comp24->getDepto($_POST['mun_id'])->dep_nombre;
            $_POST['muni']                   = $this->comp24->get_by_Id('municipio','mun_id',$_POST['mun_id'])->mun_nombre;
        }
        
        $this->form_validation->set_message('required', '*');
        $this->form_validation->set_message('numeric', '*');
        
        $config = array(
            array('field' => 'depto', 'label' => 'Municipio', 'rules' => 'trim|xss_clean'),
            array('field' => 'muni', 'label' => 'Municipio', 'rules' => 'trim|xss_clean'),
            array('field' => 'mod', 'label' => 'Mod', 'rules' => 'required|xss_clean' ),
            array('field' => 'mun_id', 'label' => 'Municipio', 'rules' => 'trim|xss_clean'),
            array('field' => $prefix.'fecha_presentacion'             , 'label' => 'Fecha', 'rules' => 'trim|required|xss_clean'),
            array('field' => $prefix.'lugar'     , 'label' => 'Fecha', 'rules' => 'trim|xss_clean|required'),
            array('field' => $prefix.'is_informe'     , 'label' => 'Fecha', 'rules' => 'trim|xss_clean|required'),
            array('field' => $prefix.'is_divulgado'     , 'label' => 'Fecha', 'rules' => 'trim|xss_clean|required'),
            array('field' => $prefix.'porque'     , 'label' => 'Fecha', 'rules' => 'trim|xss_clean|required'),
            array('field' => $prefix.'archivo_informe'       , 'label' => 'Periodo', 'rules' => 'trim|xss_clean'),
            array('field' => $prefix.'observaciones'     , 'label' => 'Fecha', 'rules' => 'trim|xss_clean')
        );
             
        $this->form_validation->set_rules($config);
        
        $data['errors'] = array();
        $mensaje = false;
        
        if ($this->form_validation->run())
        {
            $datos = array(
                $prefix.'fecha_presentacion' =>  $this->comp24->changeDate($this->form_validation->set_value($prefix.'fecha_presentacion')),
                $prefix.'lugar'              =>  $this->form_validation->set_value($prefix.'lugar'),
                $prefix.'is_informe'         =>  $this->form_validation->set_value($prefix.'is_informe'),
                $prefix.'is_divulgado'       =>  $this->form_validation->set_value($prefix.'is_divulgado'),
                $prefix.'porque'             =>  $this->form_validation->set_value($prefix.'porque'),
                $prefix.'observaciones'      =>  $this->form_validation->set_value($prefix.'observaciones')
            );
            
            if(!is_null($data = $this->comp24->update_row($tabla,$campo,$id,$datos)))
                {
                    $this->session->set_flashdata('message', 'Ok');
                    $t = explode('/' . $id,current_url());
                    redirect($t[0]);
                }
                else
                {
                    $errors = $this->tank_auth->get_error_message();
                    foreach ($errors as $k => $v)    $data['errors'][$k] = $this->lang->line($v);
                }          
        }
       
       $this->load->view($this->ruta.'informeResultados',
            array('titulo' => 'Solicitud de Ayuda',
                    'user_uid' => $this->tank_auth->get_user_id(),
                    'username' => $this->tank_auth->get_username(),
                    'menu' => $this->librerias->creaMenu($this->tank_auth->get_username()),
                    'departamentos' => $this->comp24->getDepartamentos(),
                    $campo=>$id
                    ));
    }
    
    public function getSegEvaluaciones($id){
        if (!$this->tank_auth->is_logged_in()) redirect('/auth');                // logged in
        
        $d = $this->comp24->select_data('seguimiento_evaluacion',array('mun_id'=>$id));
        
        echo $this->librerias->json_out($d,'seg_eva_id',array('seg_eva_id','seg_eva_fecha_presentacion'));
    }
    
    public function loadEmpleados($id){
        if (!$this->tank_auth->is_logged_in()) redirect('/auth');                // logged in
        
        $d = $this->comp24->select_data('empleados',array('emp_mun_id'=>$id));
        
        echo $this->librerias->json_out($d,'emp_id',array('emp_id','emp_mun_id','emp_nombre','emp_apellidos','emp_edad','emp_cargo','emp_telefono','emp_sexo'));
    }
    
    public function gestionEmpleados($id){
        if (!$this->tank_auth->is_logged_in()) redirect('/auth');                // logged in
        
        $tabla = 'empleados';
        $campo = 'emp_mun_id';
        $index = $this->input->post('id');
        
        $data = array(
            $campo          => $id,
            'emp_nombre'    => $this->input->post('emp_nombre'),
            'emp_apellidos' => $this->input->post('emp_apellidos'),
            'emp_sexo'      => $this->input->post('emp_sexo'),
            'emp_cargo'     => $this->input->post('emp_cargo'),
            'emp_edad'      => $this->input->post('emp_edad'),
            'emp_nivel'     => $this->input->post('emp_nivel'),
            'emp_titulo'    => $this->input->post('emp_titulo'),
            'emp_experiencia'   => $this->input->post('emp_experiencia'),
            'emp_telefono'  => $this->input->post('emp_telefono')
        );
        
        switch ($this->input->post('oper')){ 
        	case 'add':
                $this->comp24->insert_row($tabla, $data);
        	break;
        
        	case 'edit':
                $this->comp24->update_row($tabla, $campo, $index, $data);
        	break;
        
        	case 'del':
                $r = $this->comp24->db_row_delete($tabla, $campo, $index);
        	break;
        }
    }
    
    public function loadOtros($id){
        if (!$this->tank_auth->is_logged_in()) redirect('/auth');                // logged in
        
        $d = $this->comp24->select_data('presentes_participante',array('seg_eva_id'=>$id));
        
        echo $this->librerias->json_out($d,'par_id');
    }
    
    public function gestionOtros($id){
        if (!$this->tank_auth->is_logged_in()) redirect('/auth');                // logged in
        
        $tabla = 'presentes_participante';
        $campo = 'seg_eva_id';
        $index = $this->input->post('id');
        
        $data = array(
            $campo          => $id,
            'par_nombre'    => $this->input->post('par_nombre'),
            'par_apellidos' => $this->input->post('par_apellidos'),
            'par_sexo'      => $this->input->post('par_sexo'),
            'par_edad'      => $this->input->post('par_edad'),
            'par_cargo'     => $this->input->post('par_cargo'),            
            'par_telefono'  => $this->input->post('par_telefono')
        );
        
        switch ($this->input->post('oper')){ 
        	case 'add':
                $this->comp24->insert_row($tabla, $data);
        	break;
        
        	case 'edit':
                $this->comp24->update_row($tabla, $campo, $index, $data);
        	break;
        
        	case 'del':
                $r = $this->comp24->db_row_delete($tabla, $campo, $index);
        	break;
        }
    }

}

?>
