<?php

/**
 * Contendrá todos los metodos utilizados para definir las pantallas de la Etapa 1
 * Del PEP por los consultores asignados.
 *
 * @author Alexis Beltran
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Comp22 extends CI_Controller {

    private $ruta = "componente2/subcomp22/";
    private $rol = 0;
    private $dbPrefix = "c22_";

    public function __construct() {
        parent::__construct();
        $this->load->model('pais/departamento');
        $this->load->model('componente2/comp24');
        $this->load->model('componente2/model22');
        $this->load->library('librerias');
        $this->form_validation->set_error_delimiters('<span class="error">', '</span>');
        $this->form_validation->set_message('is_natural_no_zero', '* Obligatorio');
    }

    function getDataDropbox($tabla, $campo, $valor, $add_id = false) {
        $data = $this->db->get($this->dbPrefix . $tabla);
        $salida = array('0' => 'Seleccione');
        foreach ($data->result() as $row) {
            if ($add_id)
                $salida[$row->$campo] = $row->$campo . '| ' . $row->$valor;
            else
                $salida[$row->$campo] = $row->$valor;
        }
        return $salida;
    }

    /**
     * Index
     */
    public function index() {
        if (!$this->tank_auth->is_logged_in())
            redirect('/auth');                // logged in
        $this->load->view($this->ruta . 'comp22index', array('titulo' => 'Componente 2.2: Capacitaciones',
            'user_uid' => $this->tank_auth->get_user_id(),
            'username' => $this->tank_auth->get_username(),
            'menu' => $this->librerias->creaMenu($this->tank_auth->get_username()),
            'departamentos' => $this->departamento->obtenerDepartamentos()
        ));
    }

    /**
     * 
     */
    public function loadParticipantes() {
        if (!$this->tank_auth->is_logged_in())
            redirect('/auth');                // logged in
        $data = $this->comp24->select_data($this->dbPrefix . 'participantes');
        echo $this->librerias->json_out($data, 'par_id');
    }

    public function loadParticipantesSolicitud($id) {
        if (!$this->tank_auth->is_logged_in())
            redirect('/auth');                // logged in
        $data = $this->model22->getParticipantes($id);
        echo $this->librerias->json_out($data, 'par_id');
    }

    public function loadParticipantesInscritos($id) {
        if (!$this->tank_auth->is_logged_in())
            redirect('/auth');                // logged in
        $data = $this->model22->getInscritos($id);
        echo $this->librerias->json_out($data, 'cxp_id');
    }

    /**
     * B. 
     */
    public function registroCapacitaciones($id = false) {
        if (!$this->tank_auth->is_logged_in())
            redirect('/auth');                // logged in
        $tabla = $this->dbPrefix . 'capacitaciones';
        $campo = 'cap_id';
        $prefix = 'cap_';

        $informacion['titulo'] = 'Componente 2.2: Capacitaciones';
        $informacion['user_id'] = $this->tank_auth->get_user_id();
        $informacion['username'] = $this->tank_auth->get_username();
        $informacion['menu'] = $this->librerias->creaMenu($this->tank_auth->get_username());
        $this->load->view('plantilla/header', $informacion);
        $this->load->view('plantilla/menu', $informacion);
        $this->load->view($this->ruta . 'gestion_capacitacion_view');
        $this->load->view('plantilla/footer', $informacion);
    }

    public function solicitudesRecibidas() {
        $informacion['titulo'] = 'Componente 2.2: Capacitaciones';
        $informacion['user_id'] = $this->tank_auth->get_user_id();
        $informacion['username'] = $this->tank_auth->get_username();
        $informacion['menu'] = $this->librerias->creaMenu($this->tank_auth->get_username());
        $this->load->model('pais/departamento');
        $informacion['departamentos'] = $this->departamento->obtenerDepartamentos();
        $this->load->view('plantilla/header', $informacion);
        $this->load->view('plantilla/menu', $informacion);
        $this->load->view($this->ruta . 'solicitudes_recibidas_view', $informacion);
        $this->load->view('plantilla/footer', $informacion);
    }

    /*
     * AGREGADOR POR KAREN PEÑATE
     */

    public function crearCapacitacion() {
        if (!$this->tank_auth->is_logged_in())
            redirect('/auth');                // logged in
        $tabla = $this->dbPrefix . 'capacitaciones';
        $campo = 'cap_id';
        $prefix = 'cap_';
        $informacion['titulo'] = 'Componente 2.2: Capacitaciones';
        $informacion['user_id'] = $this->tank_auth->get_user_id();
        $informacion['username'] = $this->tank_auth->get_username();
        $informacion['menu'] = $this->librerias->creaMenu($this->tank_auth->get_username());
        $informacion['modalidades'] = $this->comp24->select_table($this->dbPrefix . 'modalidades', 'mod_id');
        $this->comp24->insert_row($tabla, array($prefix . 'add' => date('Y-m-d')));
        $id = $this->comp24->last_id($tabla, $campo);
        $informacion['cap_id'] = $id;
        $this->load->view('plantilla/header', $informacion);
        $this->load->view('plantilla/menu', $informacion);
        $this->load->view($this->ruta . 'crear_capacitacion_view', $informacion);
        $this->load->view('plantilla/footer', $informacion);
    }

    public function editarCapacitacion($cap_id) {
        if (!$this->tank_auth->is_logged_in())
            redirect('/auth');                // logged in
        $tabla = $this->dbPrefix . 'capacitaciones';
        $campo = 'cap_id';
        $prefix = 'cap_';
        $informacion['titulo'] = 'Componente 2.2: Capacitaciones';
        $informacion['user_id'] = $this->tank_auth->get_user_id();
        $informacion['username'] = $this->tank_auth->get_username();
        $informacion['menu'] = $this->librerias->creaMenu($this->tank_auth->get_username());
        $informacion['modalidades'] = $this->comp24->select_table($this->dbPrefix . 'modalidades', 'mod_id');
        $informacion['cap_id'] = $cap_id;
        $capacitacion = $this->comp24->obtener_por_id($tabla, $campo, $cap_id);
        $informacion[$prefix . 'sede'] = $capacitacion[0]->cap_sede;
        $informacion[$prefix . 'proceso'] = $capacitacion[0]->cap_proceso;
        $informacion[$prefix . 'area'] = $capacitacion[0]->cap_area;
        $informacion[$prefix . 'nombre'] = $capacitacion[0]->cap_nombre;
        $informacion[$prefix . 'entidad'] = $capacitacion[0]->cap_entidad;
        $informacion[$prefix . 'nivel'] = $capacitacion[0]->cap_nivel;
        $informacion[$prefix . 'facilitador'] = $capacitacion[0]->cap_facilitador;
        $informacion[$prefix . 'fecha_ini'] = $capacitacion[0]->cap_fecha_ini;
        $informacion[$prefix . 'duracion'] = $capacitacion[0]->cap_duracion;
        $informacion[$prefix . 'duracion_tipo'] = $capacitacion[0]->cap_duracion_tipo;
        $informacion[$prefix . 'descripcion'] = $capacitacion[0]->cap_descripcion;
        $informacion[$prefix . 'observaciones'] = $capacitacion[0]->cap_observaciones;
        $informacion[$prefix . 'ruta_archivo'] = $capacitacion[0]->cap_ruta_archivo;
        $informacion['mod_id'] = $capacitacion[0]->mod_id;

        $this->load->view('plantilla/header', $informacion);
        $this->load->view('plantilla/menu', $informacion);
        $this->load->view($this->ruta . 'editar_capacitacion_view', $informacion);
        $this->load->view('plantilla/footer', $informacion);
    }

    public function borrarCapacitacion($cap_id) {
        $tabla = $this->dbPrefix . 'capacitaciones';
        $campo = 'cap_id';
        $this->comp24->db_row_delete($tabla, $campo, $cap_id);
        redirect(base_url('componente2/comp22/registroCapacitaciones'));
    }

    public function guardarCapacitacion() {
        $tabla = $this->dbPrefix . 'capacitaciones';
        $campo = 'cap_id';
        $prefix = 'cap_';
        if ($this->input->post('mod_id') == 0)
            $mod_id = null;
        else
            $mod_id = $this->input->post('mod_id');
        if ($this->input->post($prefix . 'nivel') == '0')
            $nivel = null;
        else
            $nivel = $this->input->post($prefix . 'nivel');

        if ($this->input->post($prefix . 'duracion_tipo ') == '0')
            $duracion_tipo = null;
        else
            $duracion_tipo = $this->input->post($prefix . 'duracion_tipo');
        $datos = array(
            $prefix . 'sede' => $this->input->post($prefix . 'sede'),
            $prefix . 'proceso' => $this->input->post($prefix . 'proceso'),
            $prefix . 'area' => $this->input->post($prefix . 'area'),
            $prefix . 'nombre' => $this->input->post($prefix . 'nombre'),
            $prefix . 'entidad' => $this->input->post($prefix . 'entidad'),
            $prefix . 'nivel' => $nivel,
            $prefix . 'facilitador' => $this->input->post($prefix . 'facilitador'),
            $prefix . 'fecha_ini' => $this->input->post($prefix . 'fecha_ini'),
            $prefix . 'duracion' => $this->input->post($prefix . 'duracion'),
            $prefix . 'duracion_tipo' => $duracion_tipo,
            $prefix . 'descripcion' => $this->input->post($prefix . 'descripcion'),
            'mod_id' => $mod_id
        );
        $this->comp24->update_row($tabla, $campo, $this->input->post($prefix . 'id'), $datos);
    }

    public function loadSolicitudesMunicipio($mun_id) {
        if (!$this->tank_auth->is_logged_in())
            redirect('/auth');                // logged in
        $d = $this->comp24->obtenerSolicitudesPorMunicipio($mun_id);
        $rows = array();
        $numfilas = count($d);
        $i = 0;
        if ($numfilas != 0) {
            foreach ($d as $aux) {
                $rows[$i]['id'] = $i;
                $rows[$i]['cell'] = array($i,
                    $aux->cap_nombres,
                    $aux->cap_proceso,
                    $aux->cxp_justificacion,
                    $aux->inscrito
                );
                $i++;
            }
            array_multisort($rows, SORT_ASC);
        }

        $datos = json_encode($rows);
        $pages = floor($numfilas / 10) + 1;

        $jsonresponse = '{
               "page":"1",
               "total":"' . $pages . '",
               "records":"' . $numfilas . '", 
               "rows":' . $datos . '}';

        echo $jsonresponse;
    }

    public function eliminarCapacitacion($cap_id) {
        $tabla = $this->dbPrefix . 'capacitaciones';
        $campo = 'cap_id';
        $resultado = $this->comp24->contarInscritos($cap_id);
        if ($resultado[0]->inscripciones == 0) {
            $this->comp24->db_row_delete($tabla, $campo, $cap_id);
            $valor = 0;
        }
        else
            $valor = 1;


        $rows[0]['id'] = 1;
        $rows[0]['cell'] = array(1, $valor);
        $numfilas = 1;
        $datos = json_encode($rows);
        $pages = floor(1 / 10) + 1;

        $jsonresponse = '{
               "page":"1",
               "total":"' . $pages . '",
               "records":"' . $numfilas . '", 
               "rows":' . $datos . '}';

        echo $jsonresponse;
    }

    public function eliminarParticipante($par_id) {
        $tabla = $this->dbPrefix . 'participantes';
        $campo = 'par_id';
        $resultado = $this->comp24->contarParticipantesInscritos($par_id);
        if ($resultado->inscripciones == 0) {
            $this->comp24->db_row_delete($tabla, $campo, $par_id);
            $valor = 0;
        }
        else
            $valor = 1;


        $rows[0]['id'] = 1;
        $rows[0]['cell'] = array(1, $valor);
        $numfilas = 1;
        $datos = json_encode($rows);
        $pages = floor(1 / 10) + 1;

        $jsonresponse = '{
               "page":"1",
               "total":"' . $pages . '",
               "records":"' . $numfilas . '", 
               "rows":' . $datos . '}';

        echo $jsonresponse;
    }

    public function obtenerParticipantesPorMunicipio($mun_id) {
        if (!$this->tank_auth->is_logged_in())
            redirect('/auth');                // logged in
        $d = $this->comp24->obtenerParticipantesPorMunicipio($mun_id);
        $rows = array();
        $numfilas = count($d);
        $i = 0;
        if ($numfilas != 0) {
            foreach ($d as $aux) {
                $rows[$i]['id'] = $aux->par_id;
                $rows[$i]['cell'] = array($aux->par_id,
                    $aux->cap_nombres
                );
                $i++;
            }
            array_multisort($rows, SORT_ASC);
        }

        $datos = json_encode($rows);
        $pages = floor($numfilas / 10) + 1;

        $jsonresponse = '{
               "page":"1",
               "total":"' . $pages . '",
               "records":"' . $numfilas . '", 
               "rows":' . $datos . '}';

        echo $jsonresponse;
    }

    /**
     * A. 
     */
    public function solicitudInscripcion($id = false, $mun_id = false) {
        if (!$this->tank_auth->is_logged_in())
            redirect('/auth');                // logged in

        $informacion['titulo'] = 'Componente 2.2: Capacitaciones';
        $informacion['user_id'] = $this->tank_auth->get_user_id();
        $informacion['username'] = $this->tank_auth->get_username();
        $informacion['menu'] = $this->librerias->creaMenu($this->tank_auth->get_username());
        $this->load->model('pais/departamento');
        $informacion['departamentos'] = $this->departamento->obtenerDepartamentos();
        $this->load->view('plantilla/header', $informacion);
        $this->load->view('plantilla/menu', $informacion);
        $this->load->view($this->ruta . 'solicitud_inscripcion_view');
        $this->load->view('plantilla/footer', $informacion);
    }

    public function gestionSolicitudes() {
        if (!$this->tank_auth->is_logged_in())
            redirect('/auth');                // logged in

        $informacion['titulo'] = 'Componente 2.2: Capacitaciones';
        $informacion['user_id'] = $this->tank_auth->get_user_id();
        $informacion['username'] = $this->tank_auth->get_username();
        $informacion['menu'] = $this->librerias->creaMenu($this->tank_auth->get_username());
        $this->load->model('pais/departamento');
        $informacion['departamentos'] = $this->departamento->obtenerDepartamentos();
        $this->load->view('plantilla/header', $informacion);
        $this->load->view('plantilla/menu', $informacion);
        $this->load->view($this->ruta . 'gestion_solicitud_view');
        $this->load->view('plantilla/footer', $informacion);
    }

    public function editarSolicitudInscripcion($par_id) {
        if (!$this->tank_auth->is_logged_in())
            redirect('/auth');                // logged in

        $informacion['titulo'] = 'Componente 2.2: Capacitaciones';
        $informacion['user_id'] = $this->tank_auth->get_user_id();
        $informacion['username'] = $this->tank_auth->get_username();
        $informacion['menu'] = $this->librerias->creaMenu($this->tank_auth->get_username());
        $this->load->model('pais/municipio');
        $resultado = $this->municipio->obtenerMunicipioPorParticipante($par_id);
        $informacion['departamento'] = $resultado->dep_nombre;
        $informacion['municipio'] = $resultado->mun_nombre;
        $informacion['par_id'] = $par_id;
        $participante = $this->comp24->obtener_por_id("c22_participantes", "par_id", $par_id);
        $informacion['par_nombres'] = $participante[0]->par_nombres;
        $informacion['par_apellidos'] = $participante[0]->par_apellidos;
        $informacion['par_birthplace'] = $participante[0]->par_birthplace;
        $informacion['par_birthday'] = $participante[0]->par_birthday;
        $informacion['par_sexo'] = $participante[0]->par_sexo;
        $informacion['par_dui'] = $participante[0]->par_dui;
        $informacion['par_dir_tipo'] = $participante[0]->par_dir_tipo;
        $informacion['par_dir_nombre'] = $participante[0]->par_dir_nombre;
        $informacion['par_dir_calle'] = $participante[0]->par_dir_calle;
        $informacion['par_dir_casa'] = $participante[0]->par_dir_casa;
        $informacion['par_dir_municipio'] = $participante[0]->par_dir_municipio;
        $informacion['par_telefono'] = $participante[0]->par_telefono;
        $informacion['par_movil'] = $participante[0]->par_movil;
        $informacion['par_nivel'] = $participante[0]->par_nivel;
        $informacion['par_titulos'] = $participante[0]->par_titulos;
        $informacion['mun_id'] = $resultado->mun_id;
        $informacion['par_ins_cargo'] = $participante[0]->par_ins_cargo;
        $informacion['par_ins_categoria'] = $participante[0]->par_ins_categoria;
        $informacion['par_ins_nivel'] = $participante[0]->par_ins_nivel;
        $informacion['par_ins_tiempo'] = $participante[0]->par_ins_tiempo;
        $informacion['par_ins_tiempo2'] = $participante[0]->par_ins_tiempo2;
        $informacion['par_ins_servicio'] = $participante[0]->par_ins_servicio;
        $informacion['par_ins_servicio2'] = $participante[0]->par_ins_servicio2;
        $informacion['par_ins_telefono'] = $participante[0]->par_ins_telefono;
        $informacion['par_ins_movil'] = $participante[0]->par_ins_movil;

        $this->load->view('plantilla/header', $informacion);
        $this->load->view('plantilla/menu', $informacion);
        $this->load->view($this->ruta . 'editar_solicitud_inscripcion_view', $informacion);
        $this->load->view('plantilla/footer', $informacion);
    }

    /**
     * C. 
     */
    public function asignacionParticipantes($id = false) {
        if (!$this->tank_auth->is_logged_in())
            redirect('/auth');                // logged in
        $tabla = $this->dbPrefix . 'capacitaciones';
        $campo = 'cap_id';
        $prefix = 'cap_';
        $view = array(
            'titulo' => 'Componente 2.2: Capacitaciones',
            'user_uid' => $this->tank_auth->get_user_id(),
            'username' => $this->tank_auth->get_username(),
            'menu' => $this->librerias->creaMenu($this->tank_auth->get_username()),
            'departamentos' => $this->comp24->getDepartamentos(),
            'tabla_id' => $id,
            'prefix' => $prefix
        );

        if ($id && !isset($_POST['mod'])) {
            if (!($tmp = $this->comp24->get_by_id($tabla, $campo, $id))) {
                $id = $this->comp24->insert_row($tabla, array('cap_add' => date('Y-m-d')));
                $tmp = $this->comp24->get_by_id($tabla, $campo, $id);
            }
            $_POST = get_object_vars($tmp);
            //print_r($_POST);die();    //test
            $_POST[$prefix . 'fecha_ini'] = $this->librerias->parse_output('date', $_POST[$prefix . 'fecha_ini']);
        }

        $this->form_validation->set_message('required', '*');
        $this->form_validation->set_message('numeric', '*');

        $config = array(
            array('field' => 'mod', 'label' => 'Mod', 'rules' => 'required|xss_clean'),
            array('field' => $prefix . 'id', 'label' => '', 'rules' => 'trim|xss_clean'),
            array('field' => 'sed_id', 'label' => '', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'mod_id', 'label' => '', 'rules' => 'trim|required|xss_clean'),
            array('field' => $prefix . 'proceso', 'label' => '', 'rules' => 'trim|xss_clean'),
            array('field' => $prefix . 'area', 'label' => '', 'rules' => 'trim|xss_clean'),
            array('field' => $prefix . 'nombre', 'label' => '', 'rules' => 'trim|xss_clean'),
            array('field' => $prefix . 'entidad', 'label' => '', 'rules' => 'trim|xss_clean'),
            array('field' => $prefix . 'nivel', 'label' => '', 'rules' => 'trim|xss_clean'),
            array('field' => $prefix . 'facilitador', 'label' => '', 'rules' => 'trim|xss_clean'),
            array('field' => $prefix . 'fecha_ini', 'label' => '', 'rules' => 'trim|xss_clean'),
            array('field' => $prefix . 'duracion', 'label' => '', 'rules' => 'trim|xss_clean|numeric'),
            array('field' => $prefix . 'duracion_tipo', 'label' => '', 'rules' => 'trim|xss_clean'),
            array('field' => $prefix . 'descripcion', 'label' => '', 'rules' => 'trim|xss_clean'),
            array('field' => $prefix . 'observaciones', 'label' => '', 'rules' => 'trim|xss_clean')
        );

        $this->form_validation->set_rules($config);
        $this->form_validation->run();
        //Cargar Sedes
        $view['cap_sede'] = $this->getDataDropbox('sedes', 'sed_id', 'sed_nombre', true);

        //Cargar Modalidades
        $view['cap_modalidad'] = $this->getDataDropbox('modalidades', 'mod_id', 'mod_nombre');

        $this->load->view($this->ruta . 'asignacionParticipantes', $view);
    }

    public function loadCapacitaciones() {
        if (!$this->tank_auth->is_logged_in())
            redirect('/auth');                // logged in
        $d = $this->comp24->select_table($this->dbPrefix . 'capacitaciones', 'cap_id');
        $rows = array();
        $numfilas = count($d);
        $i = 0;
        if ($numfilas != 0) {
            foreach ($d as $aux) {
                if ($aux->cap_ruta_archivo == '')
                    $ruta = "#";
                else
                    $ruta = base_url($aux->cap_ruta_archivo);
                $rows[$i]['id'] = $aux->cap_id;
                $rows[$i]['cell'] = array($aux->cap_id,
                    $aux->cap_proceso,
                    $aux->cap_nombre,
                    date('d-m-Y', strtotime($aux->cap_fecha_ini)),
                    $ruta
                );
                $i++;
            }
            array_multisort($rows, SORT_ASC);
        }

        $datos = json_encode($rows);
        $pages = floor($numfilas / 10) + 1;

        $jsonresponse = '{
               "page":"1",
               "total":"' . $pages . '",
               "records":"' . $numfilas . '", 
               "rows":' . $datos . '}';

        echo $jsonresponse;
    }

    public function inscribirParticipante($cap_id, $par_id) {
        if (!$this->tank_auth->is_logged_in())
            redirect('/auth');                // logged in
        if ($cap_id + $par_id > 0) {
            $data = array(
                'cxp_cap_id' => $cap_id,
                'cxp_par_id' => $par_id
            );
            echo $this->model22->insert_row($this->dbPrefix . 'cxp_inscritos', $data);
        } else {
            return 'error';
        }
    }

    public function desinscribirParticipante($cxp_id) {
        if (!$this->tank_auth->is_logged_in())
            redirect('/auth');                // logged in
        if ($cxp_id > 0) {
            echo $this->model22->db_row_delete($this->dbPrefix . 'cxp_inscritos', 'cxp_id', $cxp_id);
            //echo $this->model22->insert_row($this->dbPrefix.'cxp_inscritos',$data);
        } else {
            return 'error';
        }
    }

    /**
     * D.
     */
    public function resultadosParticipantes($id = false) {
        if (!$this->tank_auth->is_logged_in())
            redirect('/auth');                // logged in
        $tabla = $this->dbPrefix . 'capacitaciones';
        $campo = 'cap_id';
        $prefix = 'cap_';
        $view = array(
            'titulo' => 'Componente 2.2: Capacitaciones',
            'user_uid' => $this->tank_auth->get_user_id(),
            'username' => $this->tank_auth->get_username(),
            'menu' => $this->librerias->creaMenu($this->tank_auth->get_username()),
            'departamentos' => $this->comp24->getDepartamentos(),
            'tabla_id' => $id,
            'prefix' => $prefix
        );

        if ($id && !isset($_POST['mod'])) {
            if (!($tmp = $this->comp24->get_by_id($tabla, $campo, $id))) {
                $id = $this->comp24->insert_row($tabla, array('cap_add' => date('Y-m-d')));
                $tmp = $this->comp24->get_by_id($tabla, $campo, $id);
            }
            $_POST = get_object_vars($tmp);
            //print_r($_POST);die();    //test
            $_POST[$prefix . 'fecha_ini'] = $this->librerias->parse_output('date', $_POST[$prefix . 'fecha_ini']);
        }

        $this->form_validation->set_message('required', '*');
        $this->form_validation->set_message('numeric', '*');

        $config = array(
            array('field' => 'mod', 'label' => 'Mod', 'rules' => 'required|xss_clean'),
            array('field' => $prefix . 'id', 'label' => '', 'rules' => 'trim|xss_clean'),
            array('field' => 'sed_id', 'label' => '', 'rules' => 'trim|required|xss_clean'),
            array('field' => 'mod_id', 'label' => '', 'rules' => 'trim|required|xss_clean'),
            array('field' => $prefix . 'proceso', 'label' => '', 'rules' => 'trim|xss_clean'),
            array('field' => $prefix . 'area', 'label' => '', 'rules' => 'trim|xss_clean'),
            array('field' => $prefix . 'nombre', 'label' => '', 'rules' => 'trim|xss_clean'),
            array('field' => $prefix . 'entidad', 'label' => '', 'rules' => 'trim|xss_clean'),
            array('field' => $prefix . 'nivel', 'label' => '', 'rules' => 'trim|xss_clean'),
            array('field' => $prefix . 'facilitador', 'label' => '', 'rules' => 'trim|xss_clean'),
            array('field' => $prefix . 'fecha_ini', 'label' => '', 'rules' => 'trim|xss_clean'),
            array('field' => $prefix . 'duracion', 'label' => '', 'rules' => 'trim|xss_clean|numeric'),
            array('field' => $prefix . 'duracion_tipo', 'label' => '', 'rules' => 'trim|xss_clean'),
            array('field' => $prefix . 'descripcion', 'label' => '', 'rules' => 'trim|xss_clean'),
            array('field' => $prefix . 'observaciones', 'label' => '', 'rules' => 'trim|xss_clean')
        );

        $this->form_validation->set_rules($config);
        $this->form_validation->run();
        //Cargar Sedes
        $view['cap_sede'] = $this->getDataDropbox('sedes', 'sed_id', 'sed_nombre', true);

        //Cargar Modalidades
        $view['cap_modalidad'] = $this->getDataDropbox('modalidades', 'mod_id', 'mod_nombre');
        $this->load->view($this->ruta . 'resultadosParticipantes', $view);
    }

    public function loadResultados($cap_id) {
        if (!$this->tank_auth->is_logged_in())
            redirect('/auth');                // logged in
        $d = $this->model22->getResultados($cap_id);
        echo $this->librerias->json_out($d, 'cxp_id');
    }

    public function gestionResultados() {
        if (!$this->tank_auth->is_logged_in())
            redirect('/auth');                // logged in
        $tabla = $this->dbPrefix . 'cxp_inscritos';
        $campo = 'cxp_id';
        $index = $this->input->post('id');

        $data = array(
            'cxp_estado' => $this->input->post('cxp_estado'),
            'cxp_promedio' => $this->input->post('cxp_promedio'),
            'cxp_constancia' => $this->input->post('cxp_constancia'),
            'cxp_observaciones' => $this->input->post('cxp_observaciones')
        );

        switch ($this->input->post('oper')) {
            //case 'add':  $this->comp24->insert_row($tabla, $data); break;
            case 'edit': $this->comp24->update_row($tabla, $campo, $index, $data);
                break;
            //case 'del':  $this->comp24->db_row_delete($tabla, $campo, $index); break;
        }
    }

    public function agregarEmpleado($mun_id) {
        $tabla = $this->dbPrefix . 'participantes';
        $campo = 'par_id';
        $this->comp24->insert_row($tabla, array('par_ins_municipio' => $mun_id, 'mun_id' => $mun_id));
        $id = $this->comp24->last_id($tabla, $campo);
        $rows[0]['id'] = $id;
        $rows[0]['cell'] = array($id);
        $numfilas = 1;
        $datos = json_encode($rows);
        $pages = floor(1 / 10) + 1;

        $jsonresponse = '{
               "page":"1",
               "total":"' . $pages . '",
               "records":"' . $numfilas . '", 
               "rows":' . $datos . '}';

        echo $jsonresponse;
    }

    public function guardarSolicitud($mun_id) {
        $tabla = $this->dbPrefix . 'participantes';
        $campo = 'par_id';
        $prefix = 'par_';
        if ($this->input->post($prefix . 'birthday') == '')
            $fecha = null;
        else
            $fecha = $this->input->post($prefix . 'birthday');
        $datos = array(
            $prefix . 'nombres' => $this->input->post($prefix . 'nombres'),
            $prefix . 'apellidos' => $this->input->post($prefix . 'apellidos'),
            $prefix . 'birthplace' => $this->input->post($prefix . 'birthplace'),
            $prefix . 'birthday' => $fecha,
            $prefix . 'sexo' => $this->input->post($prefix . 'sexo'),
            $prefix . 'dui' => $this->input->post($prefix . 'dui'),
            $prefix . 'dir_tipo' => $this->input->post($prefix . 'dir_tipo'),
            $prefix . 'dir_nombre' => $this->input->post($prefix . 'dir_nombre'),
            $prefix . 'dir_calle' => $this->input->post($prefix . 'dir_calle'),
            $prefix . 'dir_casa' => $this->input->post($prefix . 'dir_casa'),
            $prefix . 'dir_municipio' => $this->input->post($prefix . 'dir_municipio'),
            $prefix . 'telefono' => $this->input->post($prefix . 'telefono'),
            $prefix . 'movil' => $this->input->post($prefix . 'movil'),
            $prefix . 'nivel' => $this->input->post($prefix . 'nivel'),
            $prefix . 'titulos' => $this->input->post($prefix . 'titulos'),
            $prefix . 'ins_municipio' => $mun_id,
            $prefix . 'ins_cargo' => $this->input->post($prefix . 'ins_cargo'),
            $prefix . 'ins_categoria' => $this->input->post($prefix . 'ins_categoria'),
            $prefix . 'ins_nivel' => $this->input->post($prefix . 'ins_nivel'),
            $prefix . 'ins_tiempo' => $this->input->post($prefix . 'ins_tiempo'),
            $prefix . 'ins_tiempo2' => $this->input->post($prefix . 'ins_tiempo2'),
            $prefix . 'ins_servicio' => $this->input->post($prefix . 'ins_servicio'),
            $prefix . 'ins_servicio2' => $this->input->post($prefix . 'ins_servicio2'),
            $prefix . 'ins_telefono' => $this->input->post($prefix . 'ins_telefono'),
            $prefix . 'ins_movil' => $this->input->post($prefix . 'ins_movil'),
            $prefix . 'acepta' => 1
        );
        $this->comp24->update_row($tabla, $campo, $this->input->post($prefix . 'id'), $datos);
    }

    public function borrarSolicitud($par_id) {
        $tabla = $this->dbPrefix . 'participantes';
        $campo = 'par_id';
        $this->comp24->db_row_delete($tabla, $campo, $par_id);
        redirect(base_url());
    }

    public function cargarCapacitaciones($par_id) {
        $consultoras = $this->comp24->obtenerCapacitaciones($par_id);
        $combo = "<select name='cap_id'>";
        $combo.= " <option value='0'> -- Seleccione --</option>";
        foreach ($consultoras as $aux)
            $combo.= " <option value='" . $aux->cap_id . "'>" . $aux->cap_proceso . "</option>";
        $combo.="</select>";

        echo $combo;
    }

    public function cargarCapacitacionesPar($par_id) {
        $this->load->model('procesoAdministrativo/consultores_interes', 'conInt');
        $consultoresInt = $this->comp24->obtenerSolicitudesParticipantes($par_id);
        $numfilas = count($consultoresInt);

        $i = 0;
        $rows = array();

        foreach ($consultoresInt as $aux) {
            $rows[$i]['id'] = $aux->cap_id;
            $rows[$i]['cell'] = array($aux->cap_id,
                $aux->cap_proceso,
                $aux->cxp_justificacion
            );
            $i++;
        }
        array_multisort($rows, SORT_ASC);


        $datos = json_encode($rows);
        $pages = floor($numfilas / 10) + 1;

        $jsonresponse = '{
               "page":"1",
               "total":"' . $pages . '",
               "records":"' . $numfilas . '", 
               "rows":' . $datos . '}';

        echo $jsonresponse;
    }

    public function guardarCapacitaciones($par_id) {
        /* VARIABLES POST */
        /* LOS COMUNES */
        $id = $this->input->post("id");
        $cap_id = $this->input->post("cap_id");
        $cxp_justificacion = $this->input->post("cxp_justificacion");

        $tabla = $this->dbPrefix . 'cxp_solicitud';

        switch ($this->input->post('oper')) {
            case 'add':
                $this->comp24->insert_row($tabla, array('cap_id' => $cap_id, 'par_id' => $par_id, 'cxp_justificacion' => $cxp_justificacion));
                break;
            case 'del':
                $this->comp24->db_row_delete_two($tabla, 'par_id', $par_id, 'cap_id', $id);
                break;
        }
    }

    public function addSolicitud($par_id) {
        if (!$this->tank_auth->is_logged_in())
            redirect('/auth');                // logged in
        $tabla = $this->dbPrefix . 'cxp_solicitud';

        $datos = array(
            'par_id' => $par_id,
            'cap_id' => $this->input->post('cap_id'),
            'cxp_justificacion' => $this->input->post('cxp_justificacion')
        );

        if (!is_null($data = $this->comp24->insert_row($tabla, $datos))) {
            $this->session->set_flashdata('message', 'Ok');
            redirect(base_url('componente2/comp22/solicitudInscripcion/' . $par_id));
        } else {
            $errors = $this->tank_auth->get_error_message();
            foreach ($errors as $k => $v)
                $data['errors'][$k] = $this->lang->line($v);
        }
    }

    public function rpt_por_modalidad() {
        if (!$this->tank_auth->is_logged_in())
            redirect('/auth');                // logged in

        $modalidades = array(
            '1' => 'Inscritos',
            '2' => 'No Inscritos'
        );

        $sql = "
Select
  c22_capacitaciones.cap_proceso As proceso,
  c22_capacitaciones.cap_descripcion As \"desc\",
  (Select Count(*) From c22_cxp_inscritos 
  Inner Join c22_participantes On c22_cxp_inscritos.cxp_par_id = c22_participantes.par_id
  Where c22_participantes.par_sexo = 'F' And c22_cxp_inscritos.cxp_cap_id = c22_capacitaciones.cap_id ) As mujeres,
  (Select Count(*) From c22_cxp_inscritos
  Inner Join c22_participantes On c22_cxp_inscritos.cxp_par_id = c22_participantes.par_id
  Where c22_participantes.par_sexo = 'M' And c22_cxp_inscritos.cxp_cap_id = c22_capacitaciones.cap_id ) As hombres,
  (Select Count(*) From c22_cxp_inscritos
  Inner Join c22_participantes On c22_cxp_inscritos.cxp_par_id = c22_participantes.par_id
  Where c22_cxp_inscritos.cxp_cap_id = c22_capacitaciones.cap_id ) as total
From c22_capacitaciones;
        ";
        $dat = $this->db->query($sql);
        $data = ( $dat->num_rows() > 0 ) ? $dat->result() : array();

        $sql2 = "
Select
  c22_capacitaciones.cap_proceso as proceso,
  c22_capacitaciones.cap_descripcion as \"desc\",
  (Select
  Count(*)
From
  c22_cxp_solicitud Inner Join
  c22_participantes On c22_cxp_solicitud.par_id = c22_participantes.par_id
Where
  c22_participantes.par_sexo = 'M' And
  c22_participantes.par_id Not In (Select
    c22_cxp_inscritos.cxp_par_id
  From
    c22_cxp_inscritos
  Where
    c22_cxp_inscritos.cxp_cap_id = c22_cxp_solicitud.cap_id)
    AND c22_cxp_solicitud.cap_id = c22_capacitaciones.cap_id ) As hombres,
    (Select
  Count(*)
From
  c22_cxp_solicitud Inner Join
  c22_participantes On c22_cxp_solicitud.par_id = c22_participantes.par_id
Where
  c22_participantes.par_sexo = 'F' And
  c22_participantes.par_id Not In (Select
    c22_cxp_inscritos.cxp_par_id
  From
    c22_cxp_inscritos
  Where
    c22_cxp_inscritos.cxp_cap_id = c22_cxp_solicitud.cap_id)
    AND c22_cxp_solicitud.cap_id = c22_capacitaciones.cap_id ) As mujeres,
    (Select
  Count(*)
From
  c22_cxp_solicitud Inner Join
  c22_participantes On c22_cxp_solicitud.par_id = c22_participantes.par_id
Where
  c22_participantes.par_id Not In (Select
    c22_cxp_inscritos.cxp_par_id
  From
    c22_cxp_inscritos
  Where
    c22_cxp_inscritos.cxp_cap_id = c22_cxp_solicitud.cap_id)
    AND c22_cxp_solicitud.cap_id = c22_capacitaciones.cap_id ) As total
From
  c22_capacitaciones;
        ";
        $dat = $this->db->query($sql2);
        $data2 = ( $dat->num_rows() > 0 ) ? $dat->result() : array();

        $view = array(
            'titulo' => 'Componente 2.2: Reportes',
            'user_uid' => $this->tank_auth->get_user_id(),
            'username' => $this->tank_auth->get_username(),
            'menu' => $this->librerias->creaMenu($this->tank_auth->get_username()),
            'modalidades' => $modalidades,
            'data' => $data,
            'data2' => $data2
        );

        $this->load->view($this->ruta . 'rpt_por_modalidad', $view);
    }

    public function rpt_por_municipio($mun = 0) {
        if (!$this->tank_auth->is_logged_in())
            redirect('/auth');                // logged in

        $modalidades = array(
            '1' => 'Inscritos',
            '2' => 'No Inscritos'
        );

        $sql = "
Select
  c22_capacitaciones.cap_proceso As proceso,
  c22_capacitaciones.cap_descripcion As \"desc\",
  (Select Count(*) From c22_cxp_inscritos 
  Inner Join c22_participantes On c22_cxp_inscritos.cxp_par_id = c22_participantes.par_id
  Where c22_participantes.mun_id = " . $mun . " And c22_participantes.par_sexo = 'F' And c22_cxp_inscritos.cxp_cap_id = c22_capacitaciones.cap_id ) As mujeres,
  (Select Count(*) From c22_cxp_inscritos
  Inner Join c22_participantes On c22_cxp_inscritos.cxp_par_id = c22_participantes.par_id
  Where c22_participantes.mun_id = " . $mun . " And c22_participantes.par_sexo = 'M' And c22_cxp_inscritos.cxp_cap_id = c22_capacitaciones.cap_id ) As hombres,
  (Select Count(*) From c22_cxp_inscritos
  Inner Join c22_participantes On c22_cxp_inscritos.cxp_par_id = c22_participantes.par_id
  Where c22_participantes.mun_id = " . $mun . " And c22_cxp_inscritos.cxp_cap_id = c22_capacitaciones.cap_id ) as total
From c22_capacitaciones;
        ";
        $dat = $this->db->query($sql);
        $data = ( $dat->num_rows() > 0 ) ? $dat->result() : array();


        $view = array(
            'titulo' => 'Componente 2.2: Reportes',
            'user_uid' => $this->tank_auth->get_user_id(),
            'username' => $this->tank_auth->get_username(),
            'menu' => $this->librerias->creaMenu($this->tank_auth->get_username()),
            'modalidades' => $modalidades,
            'departamentos' => $this->comp24->getDepartamentos(),
            'data' => $data
        );

        $this->load->view($this->ruta . 'rpt_por_municipio', $view);
    }

}

?>
