--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: actividad; Type: TABLE; Schema: public; Owner: smpfgl; Tablespace: 
--

CREATE TABLE actividad (
    act_id integer NOT NULL,
    com_id integer NOT NULL,
    act_act_id integer,
    act_codigo character varying(10) NOT NULL,
    act_descripcion text NOT NULL
);


ALTER TABLE public.actividad OWNER TO smpfgl;

--
-- Name: actividad_act_id_seq; Type: SEQUENCE; Schema: public; Owner: smpfgl
--

CREATE SEQUENCE actividad_act_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.actividad_act_id_seq OWNER TO smpfgl;

--
-- Name: actividad_act_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: smpfgl
--

ALTER SEQUENCE actividad_act_id_seq OWNED BY actividad.act_id;


--
-- Name: actividad_act_id_seq; Type: SEQUENCE SET; Schema: public; Owner: smpfgl
--

SELECT pg_catalog.setval('actividad_act_id_seq', 1, false);


--
-- Name: acuerdo_municipal; Type: TABLE; Schema: public; Owner: smpfgl; Tablespace: 
--

CREATE TABLE acuerdo_municipal (
    acu_mun_id integer NOT NULL,
    acu_mun_fecha date,
    acu_mun_p1 boolean,
    acu_mun_p2 boolean,
    acu_mun_observacion text,
    pro_pep_id integer NOT NULL,
    acu_mun_ruta_archivo character varying(200)
);


ALTER TABLE public.acuerdo_municipal OWNER TO smpfgl;

--
-- Name: acuerdo_municipal_acu_mun_id_seq; Type: SEQUENCE; Schema: public; Owner: smpfgl
--

CREATE SEQUENCE acuerdo_municipal_acu_mun_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.acuerdo_municipal_acu_mun_id_seq OWNER TO smpfgl;

--
-- Name: acuerdo_municipal_acu_mun_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: smpfgl
--

ALTER SEQUENCE acuerdo_municipal_acu_mun_id_seq OWNED BY acuerdo_municipal.acu_mun_id;


--
-- Name: acuerdo_municipal_acu_mun_id_seq; Type: SEQUENCE SET; Schema: public; Owner: smpfgl
--

SELECT pg_catalog.setval('acuerdo_municipal_acu_mun_id_seq', 13, true);


--
-- Name: asesor_municipal; Type: TABLE; Schema: public; Owner: smpfgl; Tablespace: 
--

CREATE TABLE asesor_municipal (
    ase_mun_id integer NOT NULL,
    reg_id integer NOT NULL,
    ase_mun_nombre character varying(50) NOT NULL,
    ase_mun_apellido character varying(50) NOT NULL,
    ase_mun_cargo character varying(25) NOT NULL
);


ALTER TABLE public.asesor_municipal OWNER TO smpfgl;

--
-- Name: capacitacion; Type: TABLE; Schema: public; Owner: smpfgl; Tablespace: 
--

CREATE TABLE capacitacion (
    cap_id integer NOT NULL,
    cap_fecha date NOT NULL,
    cap_tema character varying(100) NOT NULL,
    cap_lugar character varying(50) NOT NULL,
    cap_facilitador character varying(100) NOT NULL,
    cap_observacion text
);


ALTER TABLE public.capacitacion OWNER TO smpfgl;

--
-- Name: capacitacion_cap_id_seq; Type: SEQUENCE; Schema: public; Owner: smpfgl
--

CREATE SEQUENCE capacitacion_cap_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.capacitacion_cap_id_seq OWNER TO smpfgl;

--
-- Name: capacitacion_cap_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: smpfgl
--

ALTER SEQUENCE capacitacion_cap_id_seq OWNED BY capacitacion.cap_id;


--
-- Name: capacitacion_cap_id_seq; Type: SEQUENCE SET; Schema: public; Owner: smpfgl
--

SELECT pg_catalog.setval('capacitacion_cap_id_seq', 1, false);


--
-- Name: ci_sessions; Type: TABLE; Schema: public; Owner: smpfgl; Tablespace: 
--

CREATE TABLE ci_sessions (
    session_id character varying(40) DEFAULT '0'::character varying NOT NULL,
    ip_address character varying(16) DEFAULT '0'::character varying NOT NULL,
    user_agent character varying(150) NOT NULL,
    last_activity integer DEFAULT 0 NOT NULL,
    user_data text NOT NULL
);


ALTER TABLE public.ci_sessions OWNER TO smpfgl;

--
-- Name: componente; Type: TABLE; Schema: public; Owner: smpfgl; Tablespace: 
--

CREATE TABLE componente (
    com_id integer NOT NULL,
    com_com_id integer,
    pro_id integer,
    com_codigo character varying(10),
    com_nombre character varying(100) NOT NULL,
    com_objetivo text,
    com_resultado text
);


ALTER TABLE public.componente OWNER TO smpfgl;

--
-- Name: componente_com_id_seq; Type: SEQUENCE; Schema: public; Owner: smpfgl
--

CREATE SEQUENCE componente_com_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.componente_com_id_seq OWNER TO smpfgl;

--
-- Name: componente_com_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: smpfgl
--

ALTER SEQUENCE componente_com_id_seq OWNED BY componente.com_id;


--
-- Name: componente_com_id_seq; Type: SEQUENCE SET; Schema: public; Owner: smpfgl
--

SELECT pg_catalog.setval('componente_com_id_seq', 1, false);


--
-- Name: consultora; Type: TABLE; Schema: public; Owner: smpfgl; Tablespace: 
--

CREATE TABLE consultora (
    cons_id integer NOT NULL,
    cons_nombre character varying(200),
    cons_direccion text NOT NULL,
    cons_telefono character(9) NOT NULL,
    cons_telefono2 character(9),
    cons_fax character(9),
    cons_email character varying(200) NOT NULL,
    cons_repres_legal character varying(100),
    cons_observaciones text
);


ALTER TABLE public.consultora OWNER TO smpfgl;

--
-- Name: consulta_cons_id_seq; Type: SEQUENCE; Schema: public; Owner: smpfgl
--

CREATE SEQUENCE consulta_cons_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.consulta_cons_id_seq OWNER TO smpfgl;

--
-- Name: consulta_cons_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: smpfgl
--

ALTER SEQUENCE consulta_cons_id_seq OWNED BY consultora.cons_id;


--
-- Name: consulta_cons_id_seq; Type: SEQUENCE SET; Schema: public; Owner: smpfgl
--

SELECT pg_catalog.setval('consulta_cons_id_seq', 2, true);


--
-- Name: consultor; Type: TABLE; Schema: public; Owner: smpfgl; Tablespace: 
--

CREATE TABLE consultor (
    con_id integer NOT NULL,
    con_nombre character varying(75) NOT NULL,
    con_apellido character varying(75) NOT NULL,
    con_telefono character varying(9) NOT NULL,
    con_email character varying(100) NOT NULL,
    pro_pep_id integer NOT NULL,
    cons_id integer,
    "user" text
);


ALTER TABLE public.consultor OWNER TO smpfgl;

--
-- Name: consultor_con_id_seq; Type: SEQUENCE; Schema: public; Owner: smpfgl
--

CREATE SEQUENCE consultor_con_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.consultor_con_id_seq OWNER TO smpfgl;

--
-- Name: consultor_con_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: smpfgl
--

ALTER SEQUENCE consultor_con_id_seq OWNED BY consultor.con_id;


--
-- Name: consultor_con_id_seq; Type: SEQUENCE SET; Schema: public; Owner: smpfgl
--

SELECT pg_catalog.setval('consultor_con_id_seq', 7, true);


--
-- Name: contrapartida; Type: TABLE; Schema: public; Owner: smpfgl; Tablespace: 
--

CREATE TABLE contrapartida (
    con_id integer NOT NULL,
    con_nombre character varying(25) NOT NULL
);


ALTER TABLE public.contrapartida OWNER TO smpfgl;

--
-- Name: contrapartida_acuerdo; Type: TABLE; Schema: public; Owner: smpfgl; Tablespace: 
--

CREATE TABLE contrapartida_acuerdo (
    acu_mun_id integer NOT NULL,
    con_id integer NOT NULL,
    con_acu_valor boolean
);


ALTER TABLE public.contrapartida_acuerdo OWNER TO smpfgl;

--
-- Name: contrapartida_con_id_seq; Type: SEQUENCE; Schema: public; Owner: smpfgl
--

CREATE SEQUENCE contrapartida_con_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.contrapartida_con_id_seq OWNER TO smpfgl;

--
-- Name: contrapartida_con_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: smpfgl
--

ALTER SEQUENCE contrapartida_con_id_seq OWNED BY contrapartida.con_id;


--
-- Name: contrapartida_con_id_seq; Type: SEQUENCE SET; Schema: public; Owner: smpfgl
--

SELECT pg_catalog.setval('contrapartida_con_id_seq', 5, true);


--
-- Name: criterio; Type: TABLE; Schema: public; Owner: smpfgl; Tablespace: 
--

CREATE TABLE criterio (
    cri_id integer NOT NULL,
    cri_nombre character varying(25) NOT NULL
);


ALTER TABLE public.criterio OWNER TO smpfgl;

--
-- Name: criterio_acuerdo; Type: TABLE; Schema: public; Owner: smpfgl; Tablespace: 
--

CREATE TABLE criterio_acuerdo (
    cri_id integer NOT NULL,
    acu_mun_id integer NOT NULL,
    cri_acu_valor boolean
);


ALTER TABLE public.criterio_acuerdo OWNER TO smpfgl;

--
-- Name: criterio_cri_id_seq; Type: SEQUENCE; Schema: public; Owner: smpfgl
--

CREATE SEQUENCE criterio_cri_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.criterio_cri_id_seq OWNER TO smpfgl;

--
-- Name: criterio_cri_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: smpfgl
--

ALTER SEQUENCE criterio_cri_id_seq OWNED BY criterio.cri_id;


--
-- Name: criterio_cri_id_seq; Type: SEQUENCE SET; Schema: public; Owner: smpfgl
--

SELECT pg_catalog.setval('criterio_cri_id_seq', 4, true);


--
-- Name: cumplimiento_informe; Type: TABLE; Schema: public; Owner: smpfgl; Tablespace: 
--

CREATE TABLE cumplimiento_informe (
    inf_pre_id integer NOT NULL,
    cum_min_id integer NOT NULL,
    cum_inf_valor boolean NOT NULL,
    cum_inf_id integer NOT NULL
);


ALTER TABLE public.cumplimiento_informe OWNER TO smpfgl;

--
-- Name: cumplimiento_informe_cum_inf_id_seq; Type: SEQUENCE; Schema: public; Owner: smpfgl
--

CREATE SEQUENCE cumplimiento_informe_cum_inf_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cumplimiento_informe_cum_inf_id_seq OWNER TO smpfgl;

--
-- Name: cumplimiento_informe_cum_inf_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: smpfgl
--

ALTER SEQUENCE cumplimiento_informe_cum_inf_id_seq OWNED BY cumplimiento_informe.cum_inf_id;


--
-- Name: cumplimiento_informe_cum_inf_id_seq; Type: SEQUENCE SET; Schema: public; Owner: smpfgl
--

SELECT pg_catalog.setval('cumplimiento_informe_cum_inf_id_seq', 1, false);


--
-- Name: cumplimiento_minimo; Type: TABLE; Schema: public; Owner: smpfgl; Tablespace: 
--

CREATE TABLE cumplimiento_minimo (
    cum_min_id integer NOT NULL,
    cum_min_nombre character varying(100) NOT NULL
);


ALTER TABLE public.cumplimiento_minimo OWNER TO smpfgl;

--
-- Name: cumplimiento_minimo_cum_min_id_seq; Type: SEQUENCE; Schema: public; Owner: smpfgl
--

CREATE SEQUENCE cumplimiento_minimo_cum_min_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.cumplimiento_minimo_cum_min_id_seq OWNER TO smpfgl;

--
-- Name: cumplimiento_minimo_cum_min_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: smpfgl
--

ALTER SEQUENCE cumplimiento_minimo_cum_min_id_seq OWNED BY cumplimiento_minimo.cum_min_id;


--
-- Name: cumplimiento_minimo_cum_min_id_seq; Type: SEQUENCE SET; Schema: public; Owner: smpfgl
--

SELECT pg_catalog.setval('cumplimiento_minimo_cum_min_id_seq', 12, true);


--
-- Name: declaracion_interes; Type: TABLE; Schema: public; Owner: smpfgl; Tablespace: 
--

CREATE TABLE declaracion_interes (
    dec_int_id integer NOT NULL,
    dec_int_fecha date,
    dec_int_lugar character varying(100),
    dec_int_comentario text,
    dec_int_ruta_archivo character varying(200),
    pro_pep_id integer
);


ALTER TABLE public.declaracion_interes OWNER TO smpfgl;

--
-- Name: declaracion_interes_dec_int_id_seq; Type: SEQUENCE; Schema: public; Owner: smpfgl
--

CREATE SEQUENCE declaracion_interes_dec_int_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.declaracion_interes_dec_int_id_seq OWNER TO smpfgl;

--
-- Name: declaracion_interes_dec_int_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: smpfgl
--

ALTER SEQUENCE declaracion_interes_dec_int_id_seq OWNED BY declaracion_interes.dec_int_id;


--
-- Name: declaracion_interes_dec_int_id_seq; Type: SEQUENCE SET; Schema: public; Owner: smpfgl
--

SELECT pg_catalog.setval('declaracion_interes_dec_int_id_seq', 2, true);


--
-- Name: departamento; Type: TABLE; Schema: public; Owner: smpfgl; Tablespace: 
--

CREATE TABLE departamento (
    dep_id integer NOT NULL,
    reg_id integer NOT NULL,
    dep_nombre character varying(50) NOT NULL
);


ALTER TABLE public.departamento OWNER TO smpfgl;

--
-- Name: departamento_dep_id_seq; Type: SEQUENCE; Schema: public; Owner: smpfgl
--

CREATE SEQUENCE departamento_dep_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.departamento_dep_id_seq OWNER TO smpfgl;

--
-- Name: departamento_dep_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: smpfgl
--

ALTER SEQUENCE departamento_dep_id_seq OWNED BY departamento.dep_id;


--
-- Name: departamento_dep_id_seq; Type: SEQUENCE SET; Schema: public; Owner: smpfgl
--

SELECT pg_catalog.setval('departamento_dep_id_seq', 1, false);


--
-- Name: email; Type: TABLE; Schema: public; Owner: smpfgl; Tablespace: 
--

CREATE TABLE email (
    reg_id integer,
    ase_mun_id integer,
    ema_cuenta character varying(100),
    ema_id integer NOT NULL
);


ALTER TABLE public.email OWNER TO smpfgl;

--
-- Name: email_ema_id_seq; Type: SEQUENCE; Schema: public; Owner: smpfgl
--

CREATE SEQUENCE email_ema_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.email_ema_id_seq OWNER TO smpfgl;

--
-- Name: email_ema_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: smpfgl
--

ALTER SEQUENCE email_ema_id_seq OWNED BY email.ema_id;


--
-- Name: email_ema_id_seq; Type: SEQUENCE SET; Schema: public; Owner: smpfgl
--

SELECT pg_catalog.setval('email_ema_id_seq', 1, false);


--
-- Name: etapa; Type: TABLE; Schema: public; Owner: smpfgl; Tablespace: 
--

CREATE TABLE etapa (
    eta_id integer NOT NULL,
    eta_nombre character varying(30) NOT NULL
);


ALTER TABLE public.etapa OWNER TO smpfgl;

--
-- Name: fecha_recepcion_observacion_din; Type: TABLE; Schema: public; Owner: smpfgl; Tablespace: 
--

CREATE TABLE fecha_recepcion_observacion_din (
    fec_correlativo integer NOT NULL,
    pro_id integer,
    fec_rec_din date,
    fec_obs_din date
);


ALTER TABLE public.fecha_recepcion_observacion_din OWNER TO smpfgl;

--
-- Name: fuente_primaria; Type: TABLE; Schema: public; Owner: smpfgl; Tablespace: 
--

CREATE TABLE fuente_primaria (
    fue_pri_id integer NOT NULL,
    inv_inf_id integer NOT NULL,
    fue_pri_nombre character varying(50) NOT NULL,
    fue_pri_institucion character varying(100) NOT NULL,
    fue_pri_cargo character varying(30) NOT NULL,
    fue_pri_telefono character(9) NOT NULL,
    fue_pri_nombre_doc character varying(100) NOT NULL
);


ALTER TABLE public.fuente_primaria OWNER TO smpfgl;

--
-- Name: fuente_primaria_fue_pri_id_seq; Type: SEQUENCE; Schema: public; Owner: smpfgl
--

CREATE SEQUENCE fuente_primaria_fue_pri_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.fuente_primaria_fue_pri_id_seq OWNER TO smpfgl;

--
-- Name: fuente_primaria_fue_pri_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: smpfgl
--

ALTER SEQUENCE fuente_primaria_fue_pri_id_seq OWNED BY fuente_primaria.fue_pri_id;


--
-- Name: fuente_primaria_fue_pri_id_seq; Type: SEQUENCE SET; Schema: public; Owner: smpfgl
--

SELECT pg_catalog.setval('fuente_primaria_fue_pri_id_seq', 1, false);


--
-- Name: fuente_secundaria; Type: TABLE; Schema: public; Owner: smpfgl; Tablespace: 
--

CREATE TABLE fuente_secundaria (
    fue_sec_id integer NOT NULL,
    inv_inf_id integer NOT NULL,
    fue_sec_nombre character varying(100) NOT NULL,
    fue_sec_fuente character varying(100) NOT NULL,
    fue_sec_disponible_en character varying(15) NOT NULL,
    fue_sec_anio integer NOT NULL
);


ALTER TABLE public.fuente_secundaria OWNER TO smpfgl;

--
-- Name: fuente_secundaria_fue_sec_id_seq; Type: SEQUENCE; Schema: public; Owner: smpfgl
--

CREATE SEQUENCE fuente_secundaria_fue_sec_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.fuente_secundaria_fue_sec_id_seq OWNER TO smpfgl;

--
-- Name: fuente_secundaria_fue_sec_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: smpfgl
--

ALTER SEQUENCE fuente_secundaria_fue_sec_id_seq OWNED BY fuente_secundaria.fue_sec_id;


--
-- Name: fuente_secundaria_fue_sec_id_seq; Type: SEQUENCE SET; Schema: public; Owner: smpfgl
--

SELECT pg_catalog.setval('fuente_secundaria_fue_sec_id_seq', 1, false);


--
-- Name: grupo_apoyo; Type: TABLE; Schema: public; Owner: smpfgl; Tablespace: 
--

CREATE TABLE grupo_apoyo (
    gru_apo_id integer NOT NULL,
    gru_apo_fecha date,
    gru_apo_c3 boolean,
    gru_apo_c4 boolean,
    gru_apo_observacion text,
    pro_pep_id integer NOT NULL,
    gru_apo_lugar text
);


ALTER TABLE public.grupo_apoyo OWNER TO smpfgl;

--
-- Name: grupo_apoyo_gru_apo_id_seq; Type: SEQUENCE; Schema: public; Owner: smpfgl
--

CREATE SEQUENCE grupo_apoyo_gru_apo_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.grupo_apoyo_gru_apo_id_seq OWNER TO smpfgl;

--
-- Name: grupo_apoyo_gru_apo_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: smpfgl
--

ALTER SEQUENCE grupo_apoyo_gru_apo_id_seq OWNED BY grupo_apoyo.gru_apo_id;


--
-- Name: grupo_apoyo_gru_apo_id_seq; Type: SEQUENCE SET; Schema: public; Owner: smpfgl
--

SELECT pg_catalog.setval('grupo_apoyo_gru_apo_id_seq', 1, true);


--
-- Name: indicador; Type: TABLE; Schema: public; Owner: smpfgl; Tablespace: 
--

CREATE TABLE indicador (
    ind_id integer NOT NULL,
    com_id integer NOT NULL,
    ind_nombre text NOT NULL,
    ind_tipo integer NOT NULL
);


ALTER TABLE public.indicador OWNER TO smpfgl;

--
-- Name: indicador_ind_id_seq; Type: SEQUENCE; Schema: public; Owner: smpfgl
--

CREATE SEQUENCE indicador_ind_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.indicador_ind_id_seq OWNER TO smpfgl;

--
-- Name: indicador_ind_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: smpfgl
--

ALTER SEQUENCE indicador_ind_id_seq OWNED BY indicador.ind_id;


--
-- Name: indicador_ind_id_seq; Type: SEQUENCE SET; Schema: public; Owner: smpfgl
--

SELECT pg_catalog.setval('indicador_ind_id_seq', 1, false);


--
-- Name: informe_preliminar; Type: TABLE; Schema: public; Owner: smpfgl; Tablespace: 
--

CREATE TABLE informe_preliminar (
    inf_pre_id integer NOT NULL,
    inf_pre_fecha_borrador date,
    inf_pre_fecha_observacion date,
    inf_pre_aceptacion date,
    inf_pre_aceptada boolean,
    inf_pre_firmam boolean,
    inf_pre_firmai boolean,
    inf_pre_firmau boolean,
    inf_pre_archivo oid,
    inf_pre_observacion text,
    pro_pep_id integer NOT NULL
);


ALTER TABLE public.informe_preliminar OWNER TO smpfgl;

--
-- Name: informe_preliminar_inf_pre_id_seq; Type: SEQUENCE; Schema: public; Owner: smpfgl
--

CREATE SEQUENCE informe_preliminar_inf_pre_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.informe_preliminar_inf_pre_id_seq OWNER TO smpfgl;

--
-- Name: informe_preliminar_inf_pre_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: smpfgl
--

ALTER SEQUENCE informe_preliminar_inf_pre_id_seq OWNED BY informe_preliminar.inf_pre_id;


--
-- Name: informe_preliminar_inf_pre_id_seq; Type: SEQUENCE SET; Schema: public; Owner: smpfgl
--

SELECT pg_catalog.setval('informe_preliminar_inf_pre_id_seq', 1, false);


--
-- Name: institucion; Type: TABLE; Schema: public; Owner: smpfgl; Tablespace: 
--

CREATE TABLE institucion (
    ins_id integer NOT NULL,
    ins_nombre character varying(50) NOT NULL
);


ALTER TABLE public.institucion OWNER TO smpfgl;

--
-- Name: institucion_ins_id_seq; Type: SEQUENCE; Schema: public; Owner: smpfgl
--

CREATE SEQUENCE institucion_ins_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.institucion_ins_id_seq OWNER TO smpfgl;

--
-- Name: institucion_ins_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: smpfgl
--

ALTER SEQUENCE institucion_ins_id_seq OWNED BY institucion.ins_id;


--
-- Name: institucion_ins_id_seq; Type: SEQUENCE SET; Schema: public; Owner: smpfgl
--

SELECT pg_catalog.setval('institucion_ins_id_seq', 6, true);


--
-- Name: inventario_informacion; Type: TABLE; Schema: public; Owner: smpfgl; Tablespace: 
--

CREATE TABLE inventario_informacion (
    inv_inf_id integer NOT NULL,
    inv_inf_observacion text,
    pro_pep_id integer NOT NULL
);


ALTER TABLE public.inventario_informacion OWNER TO smpfgl;

--
-- Name: inventario_informacion_inv_inf_id_seq; Type: SEQUENCE; Schema: public; Owner: smpfgl
--

CREATE SEQUENCE inventario_informacion_inv_inf_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.inventario_informacion_inv_inf_id_seq OWNER TO smpfgl;

--
-- Name: inventario_informacion_inv_inf_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: smpfgl
--

ALTER SEQUENCE inventario_informacion_inv_inf_id_seq OWNED BY inventario_informacion.inv_inf_id;


--
-- Name: inventario_informacion_inv_inf_id_seq; Type: SEQUENCE SET; Schema: public; Owner: smpfgl
--

SELECT pg_catalog.setval('inventario_informacion_inv_inf_id_seq', 1, false);


--
-- Name: login_attempts; Type: TABLE; Schema: public; Owner: smpfgl; Tablespace: 
--

CREATE TABLE login_attempts (
    id integer NOT NULL,
    ip_address character varying(40) NOT NULL,
    login character varying(50) NOT NULL,
    "time" timestamp without time zone
);


ALTER TABLE public.login_attempts OWNER TO smpfgl;

--
-- Name: login_attempts_id_seq; Type: SEQUENCE; Schema: public; Owner: smpfgl
--

CREATE SEQUENCE login_attempts_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.login_attempts_id_seq OWNER TO smpfgl;

--
-- Name: login_attempts_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: smpfgl
--

ALTER SEQUENCE login_attempts_id_seq OWNED BY login_attempts.id;


--
-- Name: login_attempts_id_seq; Type: SEQUENCE SET; Schema: public; Owner: smpfgl
--

SELECT pg_catalog.setval('login_attempts_id_seq', 1, true);


--
-- Name: mensaje_correo; Type: TABLE; Schema: public; Owner: smpfgl; Tablespace: 
--

CREATE TABLE mensaje_correo (
    men_cor_id integer NOT NULL,
    men_cor_asunto character varying(25) NOT NULL,
    men_cor_cuerpo text NOT NULL
);


ALTER TABLE public.mensaje_correo OWNER TO smpfgl;

--
-- Name: mensaje_correo_men_cor_id_seq; Type: SEQUENCE; Schema: public; Owner: smpfgl
--

CREATE SEQUENCE mensaje_correo_men_cor_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.mensaje_correo_men_cor_id_seq OWNER TO smpfgl;

--
-- Name: mensaje_correo_men_cor_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: smpfgl
--

ALTER SEQUENCE mensaje_correo_men_cor_id_seq OWNED BY mensaje_correo.men_cor_id;


--
-- Name: mensaje_correo_men_cor_id_seq; Type: SEQUENCE SET; Schema: public; Owner: smpfgl
--

SELECT pg_catalog.setval('mensaje_correo_men_cor_id_seq', 1, false);


--
-- Name: municipio; Type: TABLE; Schema: public; Owner: smpfgl; Tablespace: 
--

CREATE TABLE municipio (
    mun_id integer NOT NULL,
    dep_id integer NOT NULL,
    mun_nombre character varying(50) NOT NULL,
    mun_presupuesto numeric(6,2)
);


ALTER TABLE public.municipio OWNER TO smpfgl;

--
-- Name: municipio_componente; Type: TABLE; Schema: public; Owner: smpfgl; Tablespace: 
--

CREATE TABLE municipio_componente (
    com_id integer NOT NULL,
    mun_id integer NOT NULL,
    mun_com_asignacion numeric(6,2)
);


ALTER TABLE public.municipio_componente OWNER TO smpfgl;

--
-- Name: municipio_mun_id_seq; Type: SEQUENCE; Schema: public; Owner: smpfgl
--

CREATE SEQUENCE municipio_mun_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.municipio_mun_id_seq OWNER TO smpfgl;

--
-- Name: municipio_mun_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: smpfgl
--

ALTER SEQUENCE municipio_mun_id_seq OWNED BY municipio.mun_id;


--
-- Name: municipio_mun_id_seq; Type: SEQUENCE SET; Schema: public; Owner: smpfgl
--

SELECT pg_catalog.setval('municipio_mun_id_seq', 1, false);


--
-- Name: opcion_sistema; Type: TABLE; Schema: public; Owner: smpfgl; Tablespace: 
--

CREATE TABLE opcion_sistema (
    opc_sis_id integer NOT NULL,
    opc_sis_nombre character varying(40) NOT NULL,
    opc_sis_url character varying(100) NOT NULL,
    opc_opc_sis_id integer,
    opc_sis_orden integer
);


ALTER TABLE public.opcion_sistema OWNER TO smpfgl;

--
-- Name: opcion_sistema_opc_sis_id_seq; Type: SEQUENCE; Schema: public; Owner: smpfgl
--

CREATE SEQUENCE opcion_sistema_opc_sis_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.opcion_sistema_opc_sis_id_seq OWNER TO smpfgl;

--
-- Name: opcion_sistema_opc_sis_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: smpfgl
--

ALTER SEQUENCE opcion_sistema_opc_sis_id_seq OWNED BY opcion_sistema.opc_sis_id;


--
-- Name: opcion_sistema_opc_sis_id_seq; Type: SEQUENCE SET; Schema: public; Owner: smpfgl
--

SELECT pg_catalog.setval('opcion_sistema_opc_sis_id_seq', 15, true);


--
-- Name: participante; Type: TABLE; Schema: public; Owner: smpfgl; Tablespace: 
--

CREATE TABLE participante (
    par_id integer NOT NULL,
    gru_apo_id integer,
    reu_id integer,
    ins_id integer,
    dec_int_id integer,
    inf_pre_id integer,
    par_nombre character varying(50) NOT NULL,
    par_apellido character varying(50) NOT NULL,
    par_sexo character(1) NOT NULL,
    par_cargo character varying(30),
    par_edad integer,
    par_nivel_esco character varying(25),
    par_tel character(9),
    par_dui character(10),
    par_proviene character(1),
    acu_mun_id integer
);


ALTER TABLE public.participante OWNER TO smpfgl;

--
-- Name: participante_capacitacion; Type: TABLE; Schema: public; Owner: smpfgl; Tablespace: 
--

CREATE TABLE participante_capacitacion (
    par_id integer NOT NULL,
    cap_id integer NOT NULL,
    par_cap_participa boolean
);


ALTER TABLE public.participante_capacitacion OWNER TO smpfgl;

--
-- Name: participante_par_id_seq; Type: SEQUENCE; Schema: public; Owner: smpfgl
--

CREATE SEQUENCE participante_par_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.participante_par_id_seq OWNER TO smpfgl;

--
-- Name: participante_par_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: smpfgl
--

ALTER SEQUENCE participante_par_id_seq OWNED BY participante.par_id;


--
-- Name: participante_par_id_seq; Type: SEQUENCE SET; Schema: public; Owner: smpfgl
--

SELECT pg_catalog.setval('participante_par_id_seq', 25, true);


--
-- Name: participante_taller; Type: TABLE; Schema: public; Owner: smpfgl; Tablespace: 
--

CREATE TABLE participante_taller (
    par_id integer NOT NULL,
    tal_id integer NOT NULL,
    par_tal_participa boolean
);


ALTER TABLE public.participante_taller OWNER TO smpfgl;

--
-- Name: personal_enlace; Type: TABLE; Schema: public; Owner: smpfgl; Tablespace: 
--

CREATE TABLE personal_enlace (
    per_enl_id integer NOT NULL,
    acu_mun_id integer NOT NULL,
    per_enl_nombre character varying(50) NOT NULL,
    per_enl_apellido character varying(50) NOT NULL,
    per_enl_sexo character(1) NOT NULL,
    per_enl_cargo character varying(30) NOT NULL
);


ALTER TABLE public.personal_enlace OWNER TO smpfgl;

--
-- Name: personal_enlace_per_enl_id_seq; Type: SEQUENCE; Schema: public; Owner: smpfgl
--

CREATE SEQUENCE personal_enlace_per_enl_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.personal_enlace_per_enl_id_seq OWNER TO smpfgl;

--
-- Name: personal_enlace_per_enl_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: smpfgl
--

ALTER SEQUENCE personal_enlace_per_enl_id_seq OWNED BY personal_enlace.per_enl_id;


--
-- Name: personal_enlace_per_enl_id_seq; Type: SEQUENCE SET; Schema: public; Owner: smpfgl
--

SELECT pg_catalog.setval('personal_enlace_per_enl_id_seq', 1, false);


--
-- Name: presupuesto; Type: TABLE; Schema: public; Owner: smpfgl; Tablespace: 
--

CREATE TABLE presupuesto (
    pre_id integer NOT NULL,
    com_id integer NOT NULL,
    pre_tipo integer NOT NULL,
    pre_cantidad numeric(10,2) NOT NULL
);


ALTER TABLE public.presupuesto OWNER TO smpfgl;

--
-- Name: presupuesto_pre_id_seq; Type: SEQUENCE; Schema: public; Owner: smpfgl
--

CREATE SEQUENCE presupuesto_pre_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.presupuesto_pre_id_seq OWNER TO smpfgl;

--
-- Name: presupuesto_pre_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: smpfgl
--

ALTER SEQUENCE presupuesto_pre_id_seq OWNED BY presupuesto.pre_id;


--
-- Name: presupuesto_pre_id_seq; Type: SEQUENCE SET; Schema: public; Owner: smpfgl
--

SELECT pg_catalog.setval('presupuesto_pre_id_seq', 1, false);


--
-- Name: proyecto; Type: TABLE; Schema: public; Owner: smpfgl; Tablespace: 
--

CREATE TABLE proyecto (
    pro_id integer NOT NULL,
    mun_id integer NOT NULL,
    com_id integer NOT NULL,
    pro_codigo integer,
    pro_nombre character varying(150),
    pro_num_ord_llegada integer,
    pro_zona_fisdl character varying(15),
    pro_nom_formulador character varying(50),
    pro_nom_ref_tec_municipal character varying(50),
    pro_email_ref_tec_municipal character varying(50),
    pro_tel_ref_tec_municipal character varying(9),
    pro_nom_ase_fisdl character varying(50),
    pro_email_ase_fisdl character varying(50),
    pro_tel_ase_fisdl character varying(9),
    pro_fec_ent_gl_fisdl date,
    pro_fec_ent_gop_gpr date,
    pro_rec_gpr date,
    pro_fec_ent_gpr_din date,
    pro_estatus integer,
    pro_mon_ejecucion numeric(6,2),
    pro_fec_visita date,
    pro_num_rev integer,
    pro_fec_visado date,
    pro_mon_visado numeric(6,2),
    pro_obs_din character varying(500),
    pro_tipologia character varying(15),
    pro_sal_par_ciudadana character varying(100),
    pro_sal_pue_indigenas character varying(100),
    pro_sal_rea_involuntario character varying(100)
);


ALTER TABLE public.proyecto OWNER TO smpfgl;

--
-- Name: proyecto_pep; Type: TABLE; Schema: public; Owner: smpfgl; Tablespace: 
--

CREATE TABLE proyecto_pep (
    pro_pep_id integer NOT NULL,
    pro_pep_nombre text NOT NULL,
    pro_pep_descripcion text,
    mun_id integer NOT NULL,
    acu_mun_id integer,
    inf_pre_id integer,
    inv_inf_id integer,
    gru_apo_id integer,
    con_id integer,
    pro_pep_fec_fin date,
    pro_pep_fec_contrato date
);


ALTER TABLE public.proyecto_pep OWNER TO smpfgl;

--
-- Name: proyecto_Pep_pro_pep_id_seq; Type: SEQUENCE; Schema: public; Owner: smpfgl
--

CREATE SEQUENCE "proyecto_Pep_pro_pep_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public."proyecto_Pep_pro_pep_id_seq" OWNER TO smpfgl;

--
-- Name: proyecto_Pep_pro_pep_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: smpfgl
--

ALTER SEQUENCE "proyecto_Pep_pro_pep_id_seq" OWNED BY proyecto_pep.pro_pep_id;


--
-- Name: proyecto_Pep_pro_pep_id_seq; Type: SEQUENCE SET; Schema: public; Owner: smpfgl
--

SELECT pg_catalog.setval('"proyecto_Pep_pro_pep_id_seq"', 7, true);


--
-- Name: region; Type: TABLE; Schema: public; Owner: smpfgl; Tablespace: 
--

CREATE TABLE region (
    reg_id integer NOT NULL,
    reg_nombre character varying(50) NOT NULL,
    reg_direccion character varying(100)
);


ALTER TABLE public.region OWNER TO smpfgl;

--
-- Name: region_reg_id_seq; Type: SEQUENCE; Schema: public; Owner: smpfgl
--

CREATE SEQUENCE region_reg_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.region_reg_id_seq OWNER TO smpfgl;

--
-- Name: region_reg_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: smpfgl
--

ALTER SEQUENCE region_reg_id_seq OWNED BY region.reg_id;


--
-- Name: region_reg_id_seq; Type: SEQUENCE SET; Schema: public; Owner: smpfgl
--

SELECT pg_catalog.setval('region_reg_id_seq', 1, false);


--
-- Name: reunion; Type: TABLE; Schema: public; Owner: smpfgl; Tablespace: 
--

CREATE TABLE reunion (
    reu_id integer NOT NULL,
    eta_id integer NOT NULL,
    reu_numero integer,
    reu_fecha date,
    reu_duracion_horas integer,
    reu_tema character varying(200),
    reu_resultado text,
    reu_observacion text,
    pro_pep_id integer NOT NULL
);


ALTER TABLE public.reunion OWNER TO smpfgl;

--
-- Name: reunion_reu_id_seq; Type: SEQUENCE; Schema: public; Owner: smpfgl
--

CREATE SEQUENCE reunion_reu_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.reunion_reu_id_seq OWNER TO smpfgl;

--
-- Name: reunion_reu_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: smpfgl
--

ALTER SEQUENCE reunion_reu_id_seq OWNED BY reunion.reu_id;


--
-- Name: reunion_reu_id_seq; Type: SEQUENCE SET; Schema: public; Owner: smpfgl
--

SELECT pg_catalog.setval('reunion_reu_id_seq', 81, true);


--
-- Name: rol; Type: TABLE; Schema: public; Owner: smpfgl; Tablespace: 
--

CREATE TABLE rol (
    rol_id integer NOT NULL,
    rol_nombre character varying(25) NOT NULL
);


ALTER TABLE public.rol OWNER TO smpfgl;

--
-- Name: rol_opcion_sistema; Type: TABLE; Schema: public; Owner: smpfgl; Tablespace: 
--

CREATE TABLE rol_opcion_sistema (
    rol_id integer NOT NULL,
    opc_sis_id integer NOT NULL
);


ALTER TABLE public.rol_opcion_sistema OWNER TO smpfgl;

--
-- Name: rol_rol_id_seq; Type: SEQUENCE; Schema: public; Owner: smpfgl
--

CREATE SEQUENCE rol_rol_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.rol_rol_id_seq OWNER TO smpfgl;

--
-- Name: rol_rol_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: smpfgl
--

ALTER SEQUENCE rol_rol_id_seq OWNED BY rol.rol_id;


--
-- Name: rol_rol_id_seq; Type: SEQUENCE SET; Schema: public; Owner: smpfgl
--

SELECT pg_catalog.setval('rol_rol_id_seq', 3, true);


--
-- Name: taller; Type: TABLE; Schema: public; Owner: smpfgl; Tablespace: 
--

CREATE TABLE taller (
    tal_id integer NOT NULL,
    tal_fecha date NOT NULL,
    tal_facilitador character varying(100) NOT NULL,
    tal_observacion text
);


ALTER TABLE public.taller OWNER TO smpfgl;

--
-- Name: taller_tal_id_seq; Type: SEQUENCE; Schema: public; Owner: smpfgl
--

CREATE SEQUENCE taller_tal_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.taller_tal_id_seq OWNER TO smpfgl;

--
-- Name: taller_tal_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: smpfgl
--

ALTER SEQUENCE taller_tal_id_seq OWNED BY taller.tal_id;


--
-- Name: taller_tal_id_seq; Type: SEQUENCE SET; Schema: public; Owner: smpfgl
--

SELECT pg_catalog.setval('taller_tal_id_seq', 1, false);


--
-- Name: telefono; Type: TABLE; Schema: public; Owner: smpfgl; Tablespace: 
--

CREATE TABLE telefono (
    reg_id integer,
    ase_mun_id integer,
    tel_numero character varying(9) NOT NULL,
    tel_id integer NOT NULL
);


ALTER TABLE public.telefono OWNER TO smpfgl;

--
-- Name: telefono_tel_id_seq; Type: SEQUENCE; Schema: public; Owner: smpfgl
--

CREATE SEQUENCE telefono_tel_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.telefono_tel_id_seq OWNER TO smpfgl;

--
-- Name: telefono_tel_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: smpfgl
--

ALTER SEQUENCE telefono_tel_id_seq OWNED BY telefono.tel_id;


--
-- Name: telefono_tel_id_seq; Type: SEQUENCE SET; Schema: public; Owner: smpfgl
--

SELECT pg_catalog.setval('telefono_tel_id_seq', 1, false);


--
-- Name: user_autologin; Type: TABLE; Schema: public; Owner: smpfgl; Tablespace: 
--

CREATE TABLE user_autologin (
    key_id character(32) NOT NULL,
    user_id integer DEFAULT 0 NOT NULL,
    user_agent character varying(150) NOT NULL,
    last_ip character varying(40) NOT NULL,
    last_login timestamp without time zone NOT NULL
);


ALTER TABLE public.user_autologin OWNER TO smpfgl;

--
-- Name: user_profiles; Type: TABLE; Schema: public; Owner: smpfgl; Tablespace: 
--

CREATE TABLE user_profiles (
    id integer NOT NULL,
    user_id integer NOT NULL,
    country character varying(20) DEFAULT NULL::character varying,
    website character varying(255) DEFAULT NULL::character varying
);


ALTER TABLE public.user_profiles OWNER TO smpfgl;

--
-- Name: user_profiles_id_seq; Type: SEQUENCE; Schema: public; Owner: smpfgl
--

CREATE SEQUENCE user_profiles_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.user_profiles_id_seq OWNER TO smpfgl;

--
-- Name: user_profiles_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: smpfgl
--

ALTER SEQUENCE user_profiles_id_seq OWNED BY user_profiles.id;


--
-- Name: user_profiles_id_seq; Type: SEQUENCE SET; Schema: public; Owner: smpfgl
--

SELECT pg_catalog.setval('user_profiles_id_seq', 5, true);


--
-- Name: users; Type: TABLE; Schema: public; Owner: smpfgl; Tablespace: 
--

CREATE TABLE users (
    id integer NOT NULL,
    username character varying(50) NOT NULL,
    password character varying(255) NOT NULL,
    email character varying(100) NOT NULL,
    activated integer DEFAULT 1 NOT NULL,
    banned integer DEFAULT 0 NOT NULL,
    ban_reason character varying(255) DEFAULT NULL::character varying,
    new_password_key character varying(50) DEFAULT NULL::character varying,
    new_password_requested date,
    new_email character varying(100) DEFAULT NULL::character varying,
    new_email_key character varying(50) DEFAULT NULL::character varying,
    last_ip character varying(40) NOT NULL,
    last_login date,
    created date,
    modified date,
    rol_id integer NOT NULL
);


ALTER TABLE public.users OWNER TO smpfgl;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: smpfgl
--

CREATE SEQUENCE users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_id_seq OWNER TO smpfgl;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: smpfgl
--

ALTER SEQUENCE users_id_seq OWNED BY users.id;


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: smpfgl
--

SELECT pg_catalog.setval('users_id_seq', 9, true);


--
-- Name: act_id; Type: DEFAULT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY actividad ALTER COLUMN act_id SET DEFAULT nextval('actividad_act_id_seq'::regclass);


--
-- Name: acu_mun_id; Type: DEFAULT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY acuerdo_municipal ALTER COLUMN acu_mun_id SET DEFAULT nextval('acuerdo_municipal_acu_mun_id_seq'::regclass);


--
-- Name: cap_id; Type: DEFAULT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY capacitacion ALTER COLUMN cap_id SET DEFAULT nextval('capacitacion_cap_id_seq'::regclass);


--
-- Name: com_id; Type: DEFAULT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY componente ALTER COLUMN com_id SET DEFAULT nextval('componente_com_id_seq'::regclass);


--
-- Name: con_id; Type: DEFAULT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY consultor ALTER COLUMN con_id SET DEFAULT nextval('consultor_con_id_seq'::regclass);


--
-- Name: cons_id; Type: DEFAULT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY consultora ALTER COLUMN cons_id SET DEFAULT nextval('consulta_cons_id_seq'::regclass);


--
-- Name: con_id; Type: DEFAULT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY contrapartida ALTER COLUMN con_id SET DEFAULT nextval('contrapartida_con_id_seq'::regclass);


--
-- Name: cri_id; Type: DEFAULT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY criterio ALTER COLUMN cri_id SET DEFAULT nextval('criterio_cri_id_seq'::regclass);


--
-- Name: cum_inf_id; Type: DEFAULT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY cumplimiento_informe ALTER COLUMN cum_inf_id SET DEFAULT nextval('cumplimiento_informe_cum_inf_id_seq'::regclass);


--
-- Name: cum_min_id; Type: DEFAULT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY cumplimiento_minimo ALTER COLUMN cum_min_id SET DEFAULT nextval('cumplimiento_minimo_cum_min_id_seq'::regclass);


--
-- Name: dec_int_id; Type: DEFAULT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY declaracion_interes ALTER COLUMN dec_int_id SET DEFAULT nextval('declaracion_interes_dec_int_id_seq'::regclass);


--
-- Name: dep_id; Type: DEFAULT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY departamento ALTER COLUMN dep_id SET DEFAULT nextval('departamento_dep_id_seq'::regclass);


--
-- Name: ema_id; Type: DEFAULT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY email ALTER COLUMN ema_id SET DEFAULT nextval('email_ema_id_seq'::regclass);


--
-- Name: fue_pri_id; Type: DEFAULT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY fuente_primaria ALTER COLUMN fue_pri_id SET DEFAULT nextval('fuente_primaria_fue_pri_id_seq'::regclass);


--
-- Name: fue_sec_id; Type: DEFAULT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY fuente_secundaria ALTER COLUMN fue_sec_id SET DEFAULT nextval('fuente_secundaria_fue_sec_id_seq'::regclass);


--
-- Name: gru_apo_id; Type: DEFAULT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY grupo_apoyo ALTER COLUMN gru_apo_id SET DEFAULT nextval('grupo_apoyo_gru_apo_id_seq'::regclass);


--
-- Name: ind_id; Type: DEFAULT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY indicador ALTER COLUMN ind_id SET DEFAULT nextval('indicador_ind_id_seq'::regclass);


--
-- Name: inf_pre_id; Type: DEFAULT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY informe_preliminar ALTER COLUMN inf_pre_id SET DEFAULT nextval('informe_preliminar_inf_pre_id_seq'::regclass);


--
-- Name: ins_id; Type: DEFAULT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY institucion ALTER COLUMN ins_id SET DEFAULT nextval('institucion_ins_id_seq'::regclass);


--
-- Name: inv_inf_id; Type: DEFAULT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY inventario_informacion ALTER COLUMN inv_inf_id SET DEFAULT nextval('inventario_informacion_inv_inf_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY login_attempts ALTER COLUMN id SET DEFAULT nextval('login_attempts_id_seq'::regclass);


--
-- Name: men_cor_id; Type: DEFAULT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY mensaje_correo ALTER COLUMN men_cor_id SET DEFAULT nextval('mensaje_correo_men_cor_id_seq'::regclass);


--
-- Name: mun_id; Type: DEFAULT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY municipio ALTER COLUMN mun_id SET DEFAULT nextval('municipio_mun_id_seq'::regclass);


--
-- Name: opc_sis_id; Type: DEFAULT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY opcion_sistema ALTER COLUMN opc_sis_id SET DEFAULT nextval('opcion_sistema_opc_sis_id_seq'::regclass);


--
-- Name: par_id; Type: DEFAULT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY participante ALTER COLUMN par_id SET DEFAULT nextval('participante_par_id_seq'::regclass);


--
-- Name: per_enl_id; Type: DEFAULT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY personal_enlace ALTER COLUMN per_enl_id SET DEFAULT nextval('personal_enlace_per_enl_id_seq'::regclass);


--
-- Name: pre_id; Type: DEFAULT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY presupuesto ALTER COLUMN pre_id SET DEFAULT nextval('presupuesto_pre_id_seq'::regclass);


--
-- Name: pro_pep_id; Type: DEFAULT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY proyecto_pep ALTER COLUMN pro_pep_id SET DEFAULT nextval('"proyecto_Pep_pro_pep_id_seq"'::regclass);


--
-- Name: reg_id; Type: DEFAULT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY region ALTER COLUMN reg_id SET DEFAULT nextval('region_reg_id_seq'::regclass);


--
-- Name: reu_id; Type: DEFAULT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY reunion ALTER COLUMN reu_id SET DEFAULT nextval('reunion_reu_id_seq'::regclass);


--
-- Name: rol_id; Type: DEFAULT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY rol ALTER COLUMN rol_id SET DEFAULT nextval('rol_rol_id_seq'::regclass);


--
-- Name: tal_id; Type: DEFAULT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY taller ALTER COLUMN tal_id SET DEFAULT nextval('taller_tal_id_seq'::regclass);


--
-- Name: tel_id; Type: DEFAULT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY telefono ALTER COLUMN tel_id SET DEFAULT nextval('telefono_tel_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY user_profiles ALTER COLUMN id SET DEFAULT nextval('user_profiles_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY users ALTER COLUMN id SET DEFAULT nextval('users_id_seq'::regclass);


--
-- Data for Name: actividad; Type: TABLE DATA; Schema: public; Owner: smpfgl
--

COPY actividad (act_id, com_id, act_act_id, act_codigo, act_descripcion) FROM stdin;
\.


--
-- Data for Name: acuerdo_municipal; Type: TABLE DATA; Schema: public; Owner: smpfgl
--

COPY acuerdo_municipal (acu_mun_id, acu_mun_fecha, acu_mun_p1, acu_mun_p2, acu_mun_observacion, pro_pep_id, acu_mun_ruta_archivo) FROM stdin;
13	\N	\N	\N	Todo con normalidad	7	documentos/acuerdo_municipal/acuerdo_municipal13.doc
\.


--
-- Data for Name: asesor_municipal; Type: TABLE DATA; Schema: public; Owner: smpfgl
--

COPY asesor_municipal (ase_mun_id, reg_id, ase_mun_nombre, ase_mun_apellido, ase_mun_cargo) FROM stdin;
\.


--
-- Data for Name: capacitacion; Type: TABLE DATA; Schema: public; Owner: smpfgl
--

COPY capacitacion (cap_id, cap_fecha, cap_tema, cap_lugar, cap_facilitador, cap_observacion) FROM stdin;
\.


--
-- Data for Name: ci_sessions; Type: TABLE DATA; Schema: public; Owner: smpfgl
--

COPY ci_sessions (session_id, ip_address, user_agent, last_activity, user_data) FROM stdin;
86435c18126665784a9faa0fd0396193	127.0.0.1	Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.4 (KHTML, like Gecko) Chrome/22.0.1229.94 Safari/537.4	1350450990	a:4:{s:9:"user_data";s:0:"";s:7:"user_id";s:1:"9";s:8:"username";s:11:"cfuentes_86";s:6:"status";s:1:"1";}
f7ea8fac4a1a4fc3f628d570c5dc9284	127.0.0.1	Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.4 (KHTML, like Gecko) Chrome/22.0.1229.94 Safari/537.4	1350519519	a:4:{s:9:"user_data";s:0:"";s:7:"user_id";s:1:"9";s:8:"username";s:11:"cfuentes_86";s:6:"status";s:1:"1";}
\.


--
-- Data for Name: componente; Type: TABLE DATA; Schema: public; Owner: smpfgl
--

COPY componente (com_id, com_com_id, pro_id, com_codigo, com_nombre, com_objetivo, com_resultado) FROM stdin;
\.


--
-- Data for Name: consultor; Type: TABLE DATA; Schema: public; Owner: smpfgl
--

COPY consultor (con_id, con_nombre, con_apellido, con_telefono, con_email, pro_pep_id, cons_id, "user") FROM stdin;
1	Carlos Mario	Morán	7845-9636	cfuentes_86@hotmail.com	1	\N	\N
7	Cristian Oswaldo	Fuentes	7458-9632	cfuentes_86@hotmail.com	7	\N	cfuentes_86
\.


--
-- Data for Name: consultora; Type: TABLE DATA; Schema: public; Owner: smpfgl
--

COPY consultora (cons_id, cons_nombre, cons_direccion, cons_telefono, cons_telefono2, cons_fax, cons_email, cons_repres_legal, cons_observaciones) FROM stdin;
2	Consultora 2	Colonia Atlacatl	2278-9632	         	2298-9565	consultora2@gmail.com	Mauricio Cantarero	
1	Consultora1	Colonia nose 	2276-1821	         	2276-9632	consultora1@gmail.com	Lic. Marroquin	
\.


--
-- Data for Name: contrapartida; Type: TABLE DATA; Schema: public; Owner: smpfgl
--

COPY contrapartida (con_id, con_nombre) FROM stdin;
1	Locales para reuniones
3	Alimentación
4	Materiales y Equipo
5	Personal
2	Transporte
\.


--
-- Data for Name: contrapartida_acuerdo; Type: TABLE DATA; Schema: public; Owner: smpfgl
--

COPY contrapartida_acuerdo (acu_mun_id, con_id, con_acu_valor) FROM stdin;
13	1	t
13	3	f
13	4	f
13	5	f
13	2	t
\.


--
-- Data for Name: criterio; Type: TABLE DATA; Schema: public; Owner: smpfgl
--

COPY criterio (cri_id, cri_nombre) FROM stdin;
1	Representatividad
2	Proporcionalidad
3	Pluralidad
4	Equidad
\.


--
-- Data for Name: criterio_acuerdo; Type: TABLE DATA; Schema: public; Owner: smpfgl
--

COPY criterio_acuerdo (cri_id, acu_mun_id, cri_acu_valor) FROM stdin;
1	13	t
2	13	t
3	13	\N
4	13	\N
\.


--
-- Data for Name: cumplimiento_informe; Type: TABLE DATA; Schema: public; Owner: smpfgl
--

COPY cumplimiento_informe (inf_pre_id, cum_min_id, cum_inf_valor, cum_inf_id) FROM stdin;
\.


--
-- Data for Name: cumplimiento_minimo; Type: TABLE DATA; Schema: public; Owner: smpfgl
--

COPY cumplimiento_minimo (cum_min_id, cum_min_nombre) FROM stdin;
1	Caracterización general del municipio
2	Descripcion del Tejido Social y productivo existente
3	Descripción de oferta de servicio empresarial
4	Inventario de actores locales e instituciones
5	Cartografía base del municipio
6	Referencia de informacion secundaria disponible
7	Acuerdo municipal y politicas municipales
8	Declaración de compromisos
9	Integrantes del equipo local de apoyo
10	Plan de trabajo del Proceso
11	Valoración de la voluntad politica de trabajar
12	Recomendaciones y sugerencias
\.


--
-- Data for Name: declaracion_interes; Type: TABLE DATA; Schema: public; Owner: smpfgl
--

COPY declaracion_interes (dec_int_id, dec_int_fecha, dec_int_lugar, dec_int_comentario, dec_int_ruta_archivo, pro_pep_id) FROM stdin;
1	2012-10-11		hola	documentos/declaracion_interes/declaracion_interes1.doc	7
2	\N	\N	\N	\N	7
\.


--
-- Data for Name: departamento; Type: TABLE DATA; Schema: public; Owner: smpfgl
--

COPY departamento (dep_id, reg_id, dep_nombre) FROM stdin;
1	4	Ahuachapan
2	2	Cabañas
5	1	La Libertad
7	3	La Union
8	3	Morazan
9	3	San Miguel
10	1	San Salvador
12	4	Santa Ana
13	4	Sonsonate
14	3	Usulutan
3	1	Chalatenango
4	1	Cuscatlan
11	2	San Vicente
6	2	La Paz
\.


--
-- Data for Name: email; Type: TABLE DATA; Schema: public; Owner: smpfgl
--

COPY email (reg_id, ase_mun_id, ema_cuenta, ema_id) FROM stdin;
\.


--
-- Data for Name: etapa; Type: TABLE DATA; Schema: public; Owner: smpfgl
--

COPY etapa (eta_id, eta_nombre) FROM stdin;
1	Etapa 1
2	Etapa 2
3	Etapa 3
\.


--
-- Data for Name: fecha_recepcion_observacion_din; Type: TABLE DATA; Schema: public; Owner: smpfgl
--

COPY fecha_recepcion_observacion_din (fec_correlativo, pro_id, fec_rec_din, fec_obs_din) FROM stdin;
\.


--
-- Data for Name: fuente_primaria; Type: TABLE DATA; Schema: public; Owner: smpfgl
--

COPY fuente_primaria (fue_pri_id, inv_inf_id, fue_pri_nombre, fue_pri_institucion, fue_pri_cargo, fue_pri_telefono, fue_pri_nombre_doc) FROM stdin;
\.


--
-- Data for Name: fuente_secundaria; Type: TABLE DATA; Schema: public; Owner: smpfgl
--

COPY fuente_secundaria (fue_sec_id, inv_inf_id, fue_sec_nombre, fue_sec_fuente, fue_sec_disponible_en, fue_sec_anio) FROM stdin;
\.


--
-- Data for Name: grupo_apoyo; Type: TABLE DATA; Schema: public; Owner: smpfgl
--

COPY grupo_apoyo (gru_apo_id, gru_apo_fecha, gru_apo_c3, gru_apo_c4, gru_apo_observacion, pro_pep_id, gru_apo_lugar) FROM stdin;
1	2012-10-17	f	f	Hola	7	Centro Estudiantil Casa Blanca
\.


--
-- Data for Name: indicador; Type: TABLE DATA; Schema: public; Owner: smpfgl
--

COPY indicador (ind_id, com_id, ind_nombre, ind_tipo) FROM stdin;
\.


--
-- Data for Name: informe_preliminar; Type: TABLE DATA; Schema: public; Owner: smpfgl
--

COPY informe_preliminar (inf_pre_id, inf_pre_fecha_borrador, inf_pre_fecha_observacion, inf_pre_aceptacion, inf_pre_aceptada, inf_pre_firmam, inf_pre_firmai, inf_pre_firmau, inf_pre_archivo, inf_pre_observacion, pro_pep_id) FROM stdin;
\.


--
-- Data for Name: institucion; Type: TABLE DATA; Schema: public; Owner: smpfgl
--

COPY institucion (ins_id, ins_nombre) FROM stdin;
1	Consejo Municipal
2	Empresa Consultora
3	ISDEM
4	FISDL
5	UEP
6	Otro
\.


--
-- Data for Name: inventario_informacion; Type: TABLE DATA; Schema: public; Owner: smpfgl
--

COPY inventario_informacion (inv_inf_id, inv_inf_observacion, pro_pep_id) FROM stdin;
\.


--
-- Data for Name: login_attempts; Type: TABLE DATA; Schema: public; Owner: smpfgl
--

COPY login_attempts (id, ip_address, login, "time") FROM stdin;
8	127.0.0.1	ffff	\N
9	127.0.0.1	fff	\N
10	127.0.0.1	ffff	\N
11	127.0.0.1	yyyyyyyy	\N
12	127.0.0.1	yyyyyyyy	\N
\.


--
-- Data for Name: mensaje_correo; Type: TABLE DATA; Schema: public; Owner: smpfgl
--

COPY mensaje_correo (men_cor_id, men_cor_asunto, men_cor_cuerpo) FROM stdin;
\.


--
-- Data for Name: municipio; Type: TABLE DATA; Schema: public; Owner: smpfgl
--

COPY municipio (mun_id, dep_id, mun_nombre, mun_presupuesto) FROM stdin;
1	1	Ahuachapan	\N
2	1	Jujutla	\N
3	1	Atiquizaya	\N
4	1	Concepcion de Ataco	\N
5	1	El Refugio	\N
6	1	Guaymango	\N
7	1	Apaneca	\N
8	1	San Francisco Menendez	\N
9	1	San Lorenzo	\N
10	1	San Pedro Puxtla	\N
11	1	Tacuba	\N
12	1	Turin	\N
13	2	Cinquera	\N
14	2	Villa Dolores	\N
15	2	Guacotecti	\N
16	2	Ilobasco	\N
17	2	Jutiapa	\N
18	2	San Isidro	\N
19	2	Sensuntepeque	\N
20	2	Ciudad de Tejutepeque	\N
21	2	Victoria	\N
22	3	Agua Caliente	\N
23	3	Arcatao	\N
24	3	Azacualpa	\N
25	3	Chalatenango	\N
26	3	Citala	\N
27	3	Comalapa	\N
28	3	Concepcion Quezaltepeque	\N
29	3	Dulce Nombre de Maria	\N
30	3	El Carrizal	\N
31	3	El Paraiso	\N
32	3	La Laguna	\N
33	3	La Palma	\N
34	3	La Reina	\N
35	3	Las Vueltas	\N
36	3	Nombre de Jesus	\N
37	3	Nueva Concepcion	\N
38	3	Nueva Trinidad	\N
39	3	Ojos de Agua	\N
40	3	Potonico	\N
41	3	San Antonio de la Cruz	\N
42	3	San Antonio Los Ranchos	\N
43	3	San Fernando	\N
44	3	San Francisco Lempa	\N
45	3	San Francisco Morazan	\N
46	3	San Ignacio	\N
47	3	San Isidro Labrador	\N
48	3	San Jose Cancasque	\N
49	3	San Jose Las Flores	\N
50	3	San Luis del Carmen	\N
51	3	San Miguel de Mercedes	\N
52	3	San Rafael	\N
53	3	Santa Rita	\N
54	3	Tejutla	\N
55	4	Candelaria	\N
56	4	Cojutepeque	\N
57	4	El Carmen	\N
58	4	El Rosario	\N
59	4	Monte San Juan	\N
60	4	Oratorio de Concepcion	\N
61	4	San Bartolome Perulapia	\N
62	4	San Cristobal	\N
63	4	San Jose Guayabal	\N
64	4	San Pedro Perulapan	\N
65	4	San Rafael Cedros	\N
66	4	San Ramon	\N
67	4	Santa Cruz Analquito	\N
68	4	Santa Cruz Michapa	\N
69	4	Suchitoto	\N
70	4	Tenancingo	\N
71	5	Antiguo Cuscatlan	\N
72	5	Chiltiupan	\N
73	5	Ciudad Arce	\N
74	5	Colon	\N
75	5	Comasagua	\N
76	5	Huizucar	\N
77	5	Jayaque	\N
78	5	Jicalapa	\N
79	5	La Libertad	\N
80	5	Nueva San Salvador	\N
81	5	Nuevo Cuscatlan	\N
82	5	Opico	\N
83	5	Quezaltepeque	\N
84	5	Sacacoyo	\N
85	5	San Jose Villanueva	\N
86	5	San Matias	\N
87	5	San Pablo Tacachico	\N
88	5	Talnique	\N
89	5	Tamanique	\N
90	5	Teotepeque	\N
91	5	Tepecoyo	\N
92	5	Zaragoza	\N
93	6	Cuyultitan	\N
94	6	El Rosario	\N
95	6	Jerusalen	\N
96	6	Mercedes La Ceiba	\N
97	6	Olocuilta	\N
98	6	Paraiso de Osorio	\N
99	6	San Antonio Masahuat	\N
100	6	San Emigdio	\N
101	6	San Francisco Chinameca	\N
102	6	San Juan Nonualco	\N
103	6	San Juan Talpa	\N
104	6	San Juan Tepezontes	\N
105	6	San Luis La Herradura	\N
106	6	San Luis Talpa	\N
107	6	San Miguel Tepezontes	\N
108	6	San Pedro Masahuat	\N
109	6	San Pedro Nonualco	\N
110	6	San Rafael Obrajuelo	\N
111	6	Santa Maria Ostuma	\N
112	6	Santiago Nonualco	\N
113	6	Tapalhuaca	\N
114	6	Zacatecoluca	\N
115	7	Anamoros	\N
116	7	Bolivar	\N
117	7	Concepcion de Oriente	\N
118	7	Conchagua	\N
119	7	El Carmen	\N
120	7	El Sauce	\N
121	7	Intipuca	\N
122	7	La Union	\N
123	7	Lislique	\N
124	7	Meanguera del Golfo	\N
125	7	Nueva Esparta	\N
126	7	Pasaquina	\N
127	7	Poloros	\N
128	7	San Alejo	\N
129	7	San Jose	\N
130	7	Santa Rosa de Lima	\N
131	7	Yayantique	\N
132	7	Yucuayquin	\N
133	8	Arambala	\N
134	8	Cacaopera	\N
135	8	Chilanga	\N
136	8	Corinto	\N
137	8	Delicias de Concepcion	\N
138	8	El Divisadero	\N
139	8	El Rosario	\N
140	8	Gualococti	\N
141	8	Guatajiagua	\N
142	8	Joateca	\N
143	8	Jocoaitique	\N
144	8	Jocoro	\N
145	8	Lolotiquillo	\N
146	8	Meanguera	\N
147	8	Osicala	\N
148	8	Perquin	\N
149	8	San Carlos	\N
150	8	San Fernando	\N
151	8	San Francisco Gotera	\N
152	8	San Isidro	\N
153	8	San Simon	\N
154	8	Sensembra	\N
155	8	Sociedad	\N
156	8	Torola	\N
157	8	Yamabal	\N
158	8	Yoloaiquin	\N
159	9	Carolina	\N
160	9	Chapeltique	\N
161	9	Chinameca	\N
162	9	Chirilagua	\N
163	9	Ciudad Barrios	\N
164	9	Comacaran	\N
165	9	El Transito	\N
166	9	Lolotique	\N
167	9	Moncagua	\N
168	9	Nueva Guadalupe	\N
169	9	Nuevo Eden de San Juan	\N
170	9	Quelepa	\N
171	9	San Antonio	\N
172	9	San Gerardo	\N
173	9	San Jorge	\N
174	9	San Luis de la Reina	\N
175	9	San Miguel	\N
176	9	San Rafael	\N
177	9	Sesori	\N
178	9	Uluazapa	\N
179	10	Aguilares	\N
180	10	Apopa	\N
181	10	Ayutuxtepeque	\N
182	10	Cuscatancingo	\N
183	10	Delgado	\N
184	10	El Paisnal	\N
185	10	Guazapa	\N
186	10	Ilopango	\N
187	10	Mejicanos	\N
188	10	Nejapa	\N
189	10	Panchimalco	\N
190	10	Rosario de Mora	\N
191	10	San Marcos	\N
192	10	San Martin	\N
193	10	San Salvador	\N
194	10	Santiago Texacuangos	\N
195	10	Santo Tomas	\N
196	10	Soyapango	\N
197	10	Tonacatepeque	\N
198	11	Apastepeque	\N
199	11	Guadalupe	\N
200	11	San Cayetano Istepeque	\N
201	11	San Esteban Catarina	\N
202	11	San Ildefonso	\N
203	11	San Lorenzo	\N
204	11	San Sebastian	\N
205	11	Santa Clara	\N
206	11	Santo Domingo	\N
207	11	San Vicente	\N
208	11	Tecoluca	\N
209	11	Tepetitan	\N
210	11	Verapaz	\N
211	12	Candelaria de la Frontera	\N
212	12	Chalchuapa	\N
213	12	Coatepeque	\N
214	12	El Congo	\N
215	12	El Porvenir	\N
216	12	Masahuat	\N
217	12	Metapan	\N
218	12	San Antonio Pajonal	\N
219	12	San Sebastian Salitrillo	\N
220	12	Santa Ana	\N
221	12	Santa Rosa Guachipilin	\N
222	12	Santiago de la Frontera	\N
223	12	Texistepeque	\N
224	13	Acajutla	\N
225	13	Armenia	\N
226	13	Caluco	\N
227	13	Cuisnahuat	\N
228	13	Izalco	\N
229	13	Juayua	\N
230	13	Nahuizalco	\N
231	13	Nahulingo	\N
232	13	Salcoatitan	\N
233	13	San Antonio del Monte	\N
234	13	San Julian	\N
235	13	Santa Catarina Masahuat	\N
236	13	Santa Isabel Ishuatan	\N
237	13	Santo Domingo	\N
238	13	Sonsonate	\N
239	13	Sonzacate	\N
240	14	Alegria	\N
241	14	Berlin	\N
242	14	California	\N
243	14	Concepcion Batres	\N
244	14	El Triunfo	\N
245	14	Ereguayquin	\N
246	14	Estanzuelas	\N
247	14	Jiquilisco	\N
248	14	Jucuapa	\N
249	14	Jucuaran	\N
250	14	Mercedes Umaña	\N
251	14	Nueva Granada	\N
252	14	Ozatlan	\N
253	14	Puerto El Triunfo	\N
254	14	San Agustin	\N
255	14	San Buenaventura	\N
256	14	San Dionisio	\N
257	14	San Francisco Javier	\N
258	14	Santa Elena	\N
259	14	Santa Maria	\N
260	14	Santiago de Maria	\N
261	14	Tecapan	\N
262	14	Usulutan	\N
\.


--
-- Data for Name: municipio_componente; Type: TABLE DATA; Schema: public; Owner: smpfgl
--

COPY municipio_componente (com_id, mun_id, mun_com_asignacion) FROM stdin;
\.


--
-- Data for Name: opcion_sistema; Type: TABLE DATA; Schema: public; Owner: smpfgl
--

COPY opcion_sistema (opc_sis_id, opc_sis_nombre, opc_sis_url, opc_opc_sis_id, opc_sis_orden) FROM stdin;
10	Registro de Usuarios	auth/register	\N	\N
1	Componente 1	componente1/componente1	\N	1
2	Componente 2	componente2/componente2	\N	2
6	Etapa 1	componente2/comp23_E1/	5	1
7	Reuniones	componente2/comp23_E1/muestraReuniones	6	1
8	Acuerdo Municipal	componente2/comp23_E1/acuerdoMunicipal	6	2
11	Declaración de Interés	componente2/comp23_E1/declaracionInteres	6	3
12	Equipo Local de Apoyo	componente2/comp23_E1/equipoApoyo	6	4
13	Capacitación Equipo Local	componente2/comp23_E1/capacitacionEquipoApoyo	6	5
9	Componente 2.2.	componente2/comp22/	\N	3
5	Componente 2.3.	componente2/comp23/	\N	4
3	Componente 3	componente3/componente3	\N	5
4	Componente 4	componente4/componente4	\N	6
\.


--
-- Data for Name: participante; Type: TABLE DATA; Schema: public; Owner: smpfgl
--

COPY participante (par_id, gru_apo_id, reu_id, ins_id, dec_int_id, inf_pre_id, par_nombre, par_apellido, par_sexo, par_cargo, par_edad, par_nivel_esco, par_tel, par_dui, par_proviene, acu_mun_id) FROM stdin;
19	\N	68	2	\N	\N	sdddf	fadfad	M	dfadf	\N	\N	\N	\N	\N	\N
18	\N	68	2	\N	\N	fdfad	fdafd	M	fdafd	\N	\N	\N	\N	\N	\N
20	\N	68	2	\N	\N	ariana	Fuentes	F	Gerente	\N	\N	\N	\N	\N	\N
21	\N	\N	2	1	\N	Mina 	de Peñate	F	Jefe	\N	\N	0        	\N	\N	\N
1	1	\N	\N	\N	\N	Stephanie 	Peñate	F	Jefa	25	Bachillerato	2278-9635	03417447-9	\N	\N
2	1	\N	\N	\N	\N	Ariana 	Fuentes	F	Super Jefa	15	prepa	2276-1824	\N	\N	\N
\.


--
-- Data for Name: participante_capacitacion; Type: TABLE DATA; Schema: public; Owner: smpfgl
--

COPY participante_capacitacion (par_id, cap_id, par_cap_participa) FROM stdin;
\.


--
-- Data for Name: participante_taller; Type: TABLE DATA; Schema: public; Owner: smpfgl
--

COPY participante_taller (par_id, tal_id, par_tal_participa) FROM stdin;
\.


--
-- Data for Name: personal_enlace; Type: TABLE DATA; Schema: public; Owner: smpfgl
--

COPY personal_enlace (per_enl_id, acu_mun_id, per_enl_nombre, per_enl_apellido, per_enl_sexo, per_enl_cargo) FROM stdin;
\.


--
-- Data for Name: presupuesto; Type: TABLE DATA; Schema: public; Owner: smpfgl
--

COPY presupuesto (pre_id, com_id, pre_tipo, pre_cantidad) FROM stdin;
\.


--
-- Data for Name: proyecto; Type: TABLE DATA; Schema: public; Owner: smpfgl
--

COPY proyecto (pro_id, mun_id, com_id, pro_codigo, pro_nombre, pro_num_ord_llegada, pro_zona_fisdl, pro_nom_formulador, pro_nom_ref_tec_municipal, pro_email_ref_tec_municipal, pro_tel_ref_tec_municipal, pro_nom_ase_fisdl, pro_email_ase_fisdl, pro_tel_ase_fisdl, pro_fec_ent_gl_fisdl, pro_fec_ent_gop_gpr, pro_rec_gpr, pro_fec_ent_gpr_din, pro_estatus, pro_mon_ejecucion, pro_fec_visita, pro_num_rev, pro_fec_visado, pro_mon_visado, pro_obs_din, pro_tipologia, pro_sal_par_ciudadana, pro_sal_pue_indigenas, pro_sal_rea_involuntario) FROM stdin;
\.


--
-- Data for Name: proyecto_pep; Type: TABLE DATA; Schema: public; Owner: smpfgl
--

COPY proyecto_pep (pro_pep_id, pro_pep_nombre, pro_pep_descripcion, mun_id, acu_mun_id, inf_pre_id, inv_inf_id, gru_apo_id, con_id, pro_pep_fec_fin, pro_pep_fec_contrato) FROM stdin;
1	Proyecto de Arreglo de Acera en la colonia Atlacatl	\N	193	\N	\N	\N	\N	\N	\N	\N
6	Proyecto de Construccion de un Edificio 	\N	193	\N	\N	\N	\N	\N	\N	\N
7	Proyecto de arreglo de una calle empedrada	\N	192	\N	\N	\N	1	\N	\N	\N
\.


--
-- Data for Name: region; Type: TABLE DATA; Schema: public; Owner: smpfgl
--

COPY region (reg_id, reg_nombre, reg_direccion) FROM stdin;
1	Central	\N
3	Oriental	\N
4	Occidental	\N
2	Paracentral	\N
\.


--
-- Data for Name: reunion; Type: TABLE DATA; Schema: public; Owner: smpfgl
--

COPY reunion (reu_id, eta_id, reu_numero, reu_fecha, reu_duracion_horas, reu_tema, reu_resultado, reu_observacion, pro_pep_id) FROM stdin;
68	1	1	2012-09-04	7	Determinar la situación actual del problema a desarrollar	Datos de la situación Actual	Todo con normalidad                                                                                                                                                                	7
\.


--
-- Data for Name: rol; Type: TABLE DATA; Schema: public; Owner: smpfgl
--

COPY rol (rol_id, rol_nombre) FROM stdin;
1	administrador
2	karen
3	consultor
\.


--
-- Data for Name: rol_opcion_sistema; Type: TABLE DATA; Schema: public; Owner: smpfgl
--

COPY rol_opcion_sistema (rol_id, opc_sis_id) FROM stdin;
1	2
1	5
1	6
1	7
3	5
3	2
3	6
3	7
3	8
3	11
3	12
3	13
\.


--
-- Data for Name: taller; Type: TABLE DATA; Schema: public; Owner: smpfgl
--

COPY taller (tal_id, tal_fecha, tal_facilitador, tal_observacion) FROM stdin;
\.


--
-- Data for Name: telefono; Type: TABLE DATA; Schema: public; Owner: smpfgl
--

COPY telefono (reg_id, ase_mun_id, tel_numero, tel_id) FROM stdin;
\.


--
-- Data for Name: user_autologin; Type: TABLE DATA; Schema: public; Owner: smpfgl
--

COPY user_autologin (key_id, user_id, user_agent, last_ip, last_login) FROM stdin;
\.


--
-- Data for Name: user_profiles; Type: TABLE DATA; Schema: public; Owner: smpfgl
--

COPY user_profiles (id, user_id, country, website) FROM stdin;
1	2	\N	\N
4	8	\N	\N
5	9	\N	\N
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: smpfgl
--

COPY users (id, username, password, email, activated, banned, ban_reason, new_password_key, new_password_requested, new_email, new_email_key, last_ip, last_login, created, modified, rol_id) FROM stdin;
1	admin	$2a$08$orzZRVsYd7hePXoZ7s61De5ecu2TD9OIZMqYpA6jvHv44eH8qp31W	karensita_2410@hotmail.com	1	0	\N	\N	\N	\N	\N	127.0.0.1	2012-10-08	2012-08-19	\N	1
9	cfuentes_86	$2a$08$pudspa1zuN8eIzqi8Z4QJeRTkcHWCN4WP2DuosxSqxUIBHTorGnWO	cfuentes_86@hotmail.com	1	0	\N	\N	\N	\N	\N	127.0.0.1	2012-10-17	2012-09-12	\N	3
\.


--
-- Name: ci_sessions_pkey; Type: CONSTRAINT; Schema: public; Owner: smpfgl; Tablespace: 
--

ALTER TABLE ONLY ci_sessions
    ADD CONSTRAINT ci_sessions_pkey PRIMARY KEY (session_id);


--
-- Name: login_attempts_pkey; Type: CONSTRAINT; Schema: public; Owner: smpfgl; Tablespace: 
--

ALTER TABLE ONLY login_attempts
    ADD CONSTRAINT login_attempts_pkey PRIMARY KEY (id);


--
-- Name: pk_actividad; Type: CONSTRAINT; Schema: public; Owner: smpfgl; Tablespace: 
--

ALTER TABLE ONLY actividad
    ADD CONSTRAINT pk_actividad PRIMARY KEY (act_id);


--
-- Name: pk_acuerdo_municipal; Type: CONSTRAINT; Schema: public; Owner: smpfgl; Tablespace: 
--

ALTER TABLE ONLY acuerdo_municipal
    ADD CONSTRAINT pk_acuerdo_municipal PRIMARY KEY (acu_mun_id);


--
-- Name: pk_asesor_municipal; Type: CONSTRAINT; Schema: public; Owner: smpfgl; Tablespace: 
--

ALTER TABLE ONLY asesor_municipal
    ADD CONSTRAINT pk_asesor_municipal PRIMARY KEY (ase_mun_id);


--
-- Name: pk_capacitacion; Type: CONSTRAINT; Schema: public; Owner: smpfgl; Tablespace: 
--

ALTER TABLE ONLY capacitacion
    ADD CONSTRAINT pk_capacitacion PRIMARY KEY (cap_id);


--
-- Name: pk_componente; Type: CONSTRAINT; Schema: public; Owner: smpfgl; Tablespace: 
--

ALTER TABLE ONLY componente
    ADD CONSTRAINT pk_componente PRIMARY KEY (com_id);


--
-- Name: pk_con_id; Type: CONSTRAINT; Schema: public; Owner: smpfgl; Tablespace: 
--

ALTER TABLE ONLY consultor
    ADD CONSTRAINT pk_con_id PRIMARY KEY (con_id);


--
-- Name: pk_con_id_acu_mun_id; Type: CONSTRAINT; Schema: public; Owner: smpfgl; Tablespace: 
--

ALTER TABLE ONLY contrapartida_acuerdo
    ADD CONSTRAINT pk_con_id_acu_mun_id PRIMARY KEY (acu_mun_id, con_id);


--
-- Name: pk_cons_id; Type: CONSTRAINT; Schema: public; Owner: smpfgl; Tablespace: 
--

ALTER TABLE ONLY consultora
    ADD CONSTRAINT pk_cons_id PRIMARY KEY (cons_id);


--
-- Name: pk_contrapartida; Type: CONSTRAINT; Schema: public; Owner: smpfgl; Tablespace: 
--

ALTER TABLE ONLY contrapartida
    ADD CONSTRAINT pk_contrapartida PRIMARY KEY (con_id);


--
-- Name: pk_cri_id_acu_mun_id; Type: CONSTRAINT; Schema: public; Owner: smpfgl; Tablespace: 
--

ALTER TABLE ONLY criterio_acuerdo
    ADD CONSTRAINT pk_cri_id_acu_mun_id PRIMARY KEY (cri_id, acu_mun_id);


--
-- Name: pk_criterio; Type: CONSTRAINT; Schema: public; Owner: smpfgl; Tablespace: 
--

ALTER TABLE ONLY criterio
    ADD CONSTRAINT pk_criterio PRIMARY KEY (cri_id);


--
-- Name: pk_cum_inf_id; Type: CONSTRAINT; Schema: public; Owner: smpfgl; Tablespace: 
--

ALTER TABLE ONLY cumplimiento_informe
    ADD CONSTRAINT pk_cum_inf_id PRIMARY KEY (cum_inf_id);


--
-- Name: pk_cumplimiento_minimo; Type: CONSTRAINT; Schema: public; Owner: smpfgl; Tablespace: 
--

ALTER TABLE ONLY cumplimiento_minimo
    ADD CONSTRAINT pk_cumplimiento_minimo PRIMARY KEY (cum_min_id);


--
-- Name: pk_declaracion_interes; Type: CONSTRAINT; Schema: public; Owner: smpfgl; Tablespace: 
--

ALTER TABLE ONLY declaracion_interes
    ADD CONSTRAINT pk_declaracion_interes PRIMARY KEY (dec_int_id);


--
-- Name: pk_departamento; Type: CONSTRAINT; Schema: public; Owner: smpfgl; Tablespace: 
--

ALTER TABLE ONLY departamento
    ADD CONSTRAINT pk_departamento PRIMARY KEY (dep_id);


--
-- Name: pk_ema_id; Type: CONSTRAINT; Schema: public; Owner: smpfgl; Tablespace: 
--

ALTER TABLE ONLY email
    ADD CONSTRAINT pk_ema_id PRIMARY KEY (ema_id);


--
-- Name: pk_etapa; Type: CONSTRAINT; Schema: public; Owner: smpfgl; Tablespace: 
--

ALTER TABLE ONLY etapa
    ADD CONSTRAINT pk_etapa PRIMARY KEY (eta_id);


--
-- Name: pk_fecha_recepcion_observacion; Type: CONSTRAINT; Schema: public; Owner: smpfgl; Tablespace: 
--

ALTER TABLE ONLY fecha_recepcion_observacion_din
    ADD CONSTRAINT pk_fecha_recepcion_observacion PRIMARY KEY (fec_correlativo);


--
-- Name: pk_fuente_primaria; Type: CONSTRAINT; Schema: public; Owner: smpfgl; Tablespace: 
--

ALTER TABLE ONLY fuente_primaria
    ADD CONSTRAINT pk_fuente_primaria PRIMARY KEY (fue_pri_id);


--
-- Name: pk_fuente_secundaria; Type: CONSTRAINT; Schema: public; Owner: smpfgl; Tablespace: 
--

ALTER TABLE ONLY fuente_secundaria
    ADD CONSTRAINT pk_fuente_secundaria PRIMARY KEY (fue_sec_id);


--
-- Name: pk_gru_apo_id; Type: CONSTRAINT; Schema: public; Owner: smpfgl; Tablespace: 
--

ALTER TABLE ONLY grupo_apoyo
    ADD CONSTRAINT pk_gru_apo_id PRIMARY KEY (gru_apo_id);


--
-- Name: pk_indicador; Type: CONSTRAINT; Schema: public; Owner: smpfgl; Tablespace: 
--

ALTER TABLE ONLY indicador
    ADD CONSTRAINT pk_indicador PRIMARY KEY (ind_id);


--
-- Name: pk_informe_preliminar; Type: CONSTRAINT; Schema: public; Owner: smpfgl; Tablespace: 
--

ALTER TABLE ONLY informe_preliminar
    ADD CONSTRAINT pk_informe_preliminar PRIMARY KEY (inf_pre_id);


--
-- Name: pk_institucion; Type: CONSTRAINT; Schema: public; Owner: smpfgl; Tablespace: 
--

ALTER TABLE ONLY institucion
    ADD CONSTRAINT pk_institucion PRIMARY KEY (ins_id);


--
-- Name: pk_inventario_informacion; Type: CONSTRAINT; Schema: public; Owner: smpfgl; Tablespace: 
--

ALTER TABLE ONLY inventario_informacion
    ADD CONSTRAINT pk_inventario_informacion PRIMARY KEY (inv_inf_id);


--
-- Name: pk_mensaje_correo; Type: CONSTRAINT; Schema: public; Owner: smpfgl; Tablespace: 
--

ALTER TABLE ONLY mensaje_correo
    ADD CONSTRAINT pk_mensaje_correo PRIMARY KEY (men_cor_id);


--
-- Name: pk_municipio; Type: CONSTRAINT; Schema: public; Owner: smpfgl; Tablespace: 
--

ALTER TABLE ONLY municipio
    ADD CONSTRAINT pk_municipio PRIMARY KEY (mun_id);


--
-- Name: pk_opc_sis_id; Type: CONSTRAINT; Schema: public; Owner: smpfgl; Tablespace: 
--

ALTER TABLE ONLY opcion_sistema
    ADD CONSTRAINT pk_opc_sis_id PRIMARY KEY (opc_sis_id);


--
-- Name: pk_opc_sis_id_rol_id; Type: CONSTRAINT; Schema: public; Owner: smpfgl; Tablespace: 
--

ALTER TABLE ONLY rol_opcion_sistema
    ADD CONSTRAINT pk_opc_sis_id_rol_id PRIMARY KEY (rol_id, opc_sis_id);


--
-- Name: pk_participante; Type: CONSTRAINT; Schema: public; Owner: smpfgl; Tablespace: 
--

ALTER TABLE ONLY participante
    ADD CONSTRAINT pk_participante PRIMARY KEY (par_id);


--
-- Name: pk_participante_capacitacion; Type: CONSTRAINT; Schema: public; Owner: smpfgl; Tablespace: 
--

ALTER TABLE ONLY participante_capacitacion
    ADD CONSTRAINT pk_participante_capacitacion PRIMARY KEY (par_id, cap_id);


--
-- Name: pk_personal_enlace; Type: CONSTRAINT; Schema: public; Owner: smpfgl; Tablespace: 
--

ALTER TABLE ONLY personal_enlace
    ADD CONSTRAINT pk_personal_enlace PRIMARY KEY (per_enl_id);


--
-- Name: pk_presupuesto; Type: CONSTRAINT; Schema: public; Owner: smpfgl; Tablespace: 
--

ALTER TABLE ONLY presupuesto
    ADD CONSTRAINT pk_presupuesto PRIMARY KEY (pre_id);


--
-- Name: pk_pro_pep_id; Type: CONSTRAINT; Schema: public; Owner: smpfgl; Tablespace: 
--

ALTER TABLE ONLY proyecto_pep
    ADD CONSTRAINT pk_pro_pep_id PRIMARY KEY (pro_pep_id);


--
-- Name: pk_proyecto; Type: CONSTRAINT; Schema: public; Owner: smpfgl; Tablespace: 
--

ALTER TABLE ONLY proyecto
    ADD CONSTRAINT pk_proyecto PRIMARY KEY (pro_id);


--
-- Name: pk_region; Type: CONSTRAINT; Schema: public; Owner: smpfgl; Tablespace: 
--

ALTER TABLE ONLY region
    ADD CONSTRAINT pk_region PRIMARY KEY (reg_id);


--
-- Name: pk_reunion; Type: CONSTRAINT; Schema: public; Owner: smpfgl; Tablespace: 
--

ALTER TABLE ONLY reunion
    ADD CONSTRAINT pk_reunion PRIMARY KEY (reu_id);


--
-- Name: pk_rol_id; Type: CONSTRAINT; Schema: public; Owner: smpfgl; Tablespace: 
--

ALTER TABLE ONLY rol
    ADD CONSTRAINT pk_rol_id PRIMARY KEY (rol_id);


--
-- Name: pk_taller; Type: CONSTRAINT; Schema: public; Owner: smpfgl; Tablespace: 
--

ALTER TABLE ONLY taller
    ADD CONSTRAINT pk_taller PRIMARY KEY (tal_id);


--
-- Name: pk_tel_id; Type: CONSTRAINT; Schema: public; Owner: smpfgl; Tablespace: 
--

ALTER TABLE ONLY telefono
    ADD CONSTRAINT pk_tel_id PRIMARY KEY (tel_id);


--
-- Name: user_autologin_pkey; Type: CONSTRAINT; Schema: public; Owner: smpfgl; Tablespace: 
--

ALTER TABLE ONLY user_autologin
    ADD CONSTRAINT user_autologin_pkey PRIMARY KEY (key_id, user_id);


--
-- Name: user_profiles_pkey; Type: CONSTRAINT; Schema: public; Owner: smpfgl; Tablespace: 
--

ALTER TABLE ONLY user_profiles
    ADD CONSTRAINT user_profiles_pkey PRIMARY KEY (id);


--
-- Name: users_pkey; Type: CONSTRAINT; Schema: public; Owner: smpfgl; Tablespace: 
--

ALTER TABLE ONLY users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: fki_pk_proyecto_pep_acuerdo_municipal; Type: INDEX; Schema: public; Owner: smpfgl; Tablespace: 
--

CREATE INDEX fki_pk_proyecto_pep_acuerdo_municipal ON acuerdo_municipal USING btree (pro_pep_id);


--
-- Name: fk_activida_conformad_activida; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY actividad
    ADD CONSTRAINT fk_activida_conformad_activida FOREIGN KEY (act_act_id) REFERENCES actividad(act_id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_activida_posee_una_componen; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY actividad
    ADD CONSTRAINT fk_activida_posee_una_componen FOREIGN KEY (com_id) REFERENCES componente(com_id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_acuerdo_municipal_participante; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY participante
    ADD CONSTRAINT fk_acuerdo_municipal_participante FOREIGN KEY (acu_mun_id) REFERENCES acuerdo_municipal(acu_mun_id);


--
-- Name: fk_acuerdo_municipal_proyecto_pep; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY proyecto_pep
    ADD CONSTRAINT fk_acuerdo_municipal_proyecto_pep FOREIGN KEY (acu_mun_id) REFERENCES acuerdo_municipal(acu_mun_id);


--
-- Name: fk_asesor_m_se_asigna_region; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY asesor_municipal
    ADD CONSTRAINT fk_asesor_m_se_asigna_region FOREIGN KEY (reg_id) REFERENCES region(reg_id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_componen_programa2_proyecto; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY componente
    ADD CONSTRAINT fk_componen_programa2_proyecto FOREIGN KEY (pro_id) REFERENCES proyecto(pro_id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_componen_se_divide_componen; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY componente
    ADD CONSTRAINT fk_componen_se_divide_componen FOREIGN KEY (com_com_id) REFERENCES componente(com_id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_consultor_proyecto_pep; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY proyecto_pep
    ADD CONSTRAINT fk_consultor_proyecto_pep FOREIGN KEY (con_id) REFERENCES consultor(con_id);


--
-- Name: fk_consultora_consultor; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY consultor
    ADD CONSTRAINT fk_consultora_consultor FOREIGN KEY (cons_id) REFERENCES consultora(cons_id);


--
-- Name: fk_contrapa_aporta_acuerdo_; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY contrapartida_acuerdo
    ADD CONSTRAINT fk_contrapa_aporta_acuerdo_ FOREIGN KEY (acu_mun_id) REFERENCES acuerdo_municipal(acu_mun_id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_contrapa_conformad_contrapa; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY contrapartida_acuerdo
    ADD CONSTRAINT fk_contrapa_conformad_contrapa FOREIGN KEY (con_id) REFERENCES contrapartida(con_id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_criterio_conformad_criterio; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY criterio_acuerdo
    ADD CONSTRAINT fk_criterio_conformad_criterio FOREIGN KEY (cri_id) REFERENCES criterio(cri_id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_criterio_cumple_acuerdo_; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY criterio_acuerdo
    ADD CONSTRAINT fk_criterio_cumple_acuerdo_ FOREIGN KEY (acu_mun_id) REFERENCES acuerdo_municipal(acu_mun_id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_cumplimi_cumplen_a_cumplimi; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY cumplimiento_informe
    ADD CONSTRAINT fk_cumplimi_cumplen_a_cumplimi FOREIGN KEY (cum_min_id) REFERENCES cumplimiento_minimo(cum_min_id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_cumplimi_posee_alg_informe_; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY cumplimiento_informe
    ADD CONSTRAINT fk_cumplimi_posee_alg_informe_ FOREIGN KEY (inf_pre_id) REFERENCES informe_preliminar(inf_pre_id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_departam_compuesto_region; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY departamento
    ADD CONSTRAINT fk_departam_compuesto_region FOREIGN KEY (reg_id) REFERENCES region(reg_id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_email_se_comuni_asesor_m; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY email
    ADD CONSTRAINT fk_email_se_comuni_asesor_m FOREIGN KEY (ase_mun_id) REFERENCES asesor_municipal(ase_mun_id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_email_se_contac_region; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY email
    ADD CONSTRAINT fk_email_se_contac_region FOREIGN KEY (reg_id) REFERENCES region(reg_id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_etapa_reunion; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY reunion
    ADD CONSTRAINT fk_etapa_reunion FOREIGN KEY (eta_id) REFERENCES etapa(eta_id);


--
-- Name: fk_fecha_re_din_tiene_proyecto; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY fecha_recepcion_observacion_din
    ADD CONSTRAINT fk_fecha_re_din_tiene_proyecto FOREIGN KEY (pro_id) REFERENCES proyecto(pro_id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_fuente_p_formado_inventar; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY fuente_primaria
    ADD CONSTRAINT fk_fuente_p_formado_inventar FOREIGN KEY (inv_inf_id) REFERENCES inventario_informacion(inv_inf_id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_fuente_s_formado_p_inventar; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY fuente_secundaria
    ADD CONSTRAINT fk_fuente_s_formado_p_inventar FOREIGN KEY (inv_inf_id) REFERENCES inventario_informacion(inv_inf_id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_grupo_apoyo_participantes; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY participante
    ADD CONSTRAINT fk_grupo_apoyo_participantes FOREIGN KEY (gru_apo_id) REFERENCES grupo_apoyo(gru_apo_id);


--
-- Name: fk_indicado_posee_componen; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY indicador
    ADD CONSTRAINT fk_indicado_posee_componen FOREIGN KEY (com_id) REFERENCES componente(com_id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_informe_preliminar_proyecto_pep; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY proyecto_pep
    ADD CONSTRAINT fk_informe_preliminar_proyecto_pep FOREIGN KEY (inf_pre_id) REFERENCES informe_preliminar(inf_pre_id);


--
-- Name: fk_inventario_informacion_proyecto_pep; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY proyecto_pep
    ADD CONSTRAINT fk_inventario_informacion_proyecto_pep FOREIGN KEY (inv_inf_id) REFERENCES inventario_informacion(inv_inf_id);


--
-- Name: fk_municipi_comp_cuni_componen; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY municipio_componente
    ADD CONSTRAINT fk_municipi_comp_cuni_componen FOREIGN KEY (com_id) REFERENCES componente(com_id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_municipi_comp_muni_municipi; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY municipio_componente
    ADD CONSTRAINT fk_municipi_comp_muni_municipi FOREIGN KEY (mun_id) REFERENCES municipio(mun_id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_municipi_conformad_departam; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY municipio
    ADD CONSTRAINT fk_municipi_conformad_departam FOREIGN KEY (dep_id) REFERENCES departamento(dep_id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_municipio_proyecto_pep; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY proyecto_pep
    ADD CONSTRAINT fk_municipio_proyecto_pep FOREIGN KEY (mun_id) REFERENCES municipio(mun_id);


--
-- Name: fk_opcion_sistema_rol_opcion_sistema; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY rol_opcion_sistema
    ADD CONSTRAINT fk_opcion_sistema_rol_opcion_sistema FOREIGN KEY (opc_sis_id) REFERENCES opcion_sistema(opc_sis_id);


--
-- Name: fk_particip_asisten_a_taller; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY participante_taller
    ADD CONSTRAINT fk_particip_asisten_a_taller FOREIGN KEY (tal_id) REFERENCES taller(tal_id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_particip_asisten_particip; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY participante_taller
    ADD CONSTRAINT fk_particip_asisten_particip FOREIGN KEY (par_id) REFERENCES participante(par_id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_particip_asistente_reunion; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY participante
    ADD CONSTRAINT fk_particip_asistente_reunion FOREIGN KEY (reu_id) REFERENCES reunion(reu_id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: fk_particip_necesita__informe_; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY participante
    ADD CONSTRAINT fk_particip_necesita__informe_ FOREIGN KEY (inf_pre_id) REFERENCES informe_preliminar(inf_pre_id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_particip_necesita_declarac; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY participante
    ADD CONSTRAINT fk_particip_necesita_declarac FOREIGN KEY (dec_int_id) REFERENCES declaracion_interes(dec_int_id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_particip_pueden_te_instituc; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY participante
    ADD CONSTRAINT fk_particip_pueden_te_instituc FOREIGN KEY (ins_id) REFERENCES institucion(ins_id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_particip_reciben_particip; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY participante_capacitacion
    ADD CONSTRAINT fk_particip_reciben_particip FOREIGN KEY (par_id) REFERENCES participante(par_id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_particip_reciben_u_capacita; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY participante_capacitacion
    ADD CONSTRAINT fk_particip_reciben_u_capacita FOREIGN KEY (cap_id) REFERENCES capacitacion(cap_id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_personal_necesita__acuerdo_; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY personal_enlace
    ADD CONSTRAINT fk_personal_necesita__acuerdo_ FOREIGN KEY (acu_mun_id) REFERENCES acuerdo_municipal(acu_mun_id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_presupue_se_asigna_componen; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY presupuesto
    ADD CONSTRAINT fk_presupue_se_asigna_componen FOREIGN KEY (com_id) REFERENCES componente(com_id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_proyecto_pep; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY inventario_informacion
    ADD CONSTRAINT fk_proyecto_pep FOREIGN KEY (pro_pep_id) REFERENCES proyecto_pep(pro_pep_id);


--
-- Name: fk_proyecto_pep_acuerdo_municipal; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY acuerdo_municipal
    ADD CONSTRAINT fk_proyecto_pep_acuerdo_municipal FOREIGN KEY (pro_pep_id) REFERENCES proyecto_pep(pro_pep_id);


--
-- Name: fk_proyecto_pep_consultor; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY consultor
    ADD CONSTRAINT fk_proyecto_pep_consultor FOREIGN KEY (pro_pep_id) REFERENCES proyecto_pep(pro_pep_id);


--
-- Name: fk_proyecto_pep_declaracion_interes; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY declaracion_interes
    ADD CONSTRAINT fk_proyecto_pep_declaracion_interes FOREIGN KEY (pro_pep_id) REFERENCES proyecto_pep(pro_pep_id);


--
-- Name: fk_proyecto_pep_grupo_apoyo; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY grupo_apoyo
    ADD CONSTRAINT fk_proyecto_pep_grupo_apoyo FOREIGN KEY (pro_pep_id) REFERENCES proyecto_pep(pro_pep_id);


--
-- Name: fk_proyecto_pep_grupo_apoyo; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY proyecto_pep
    ADD CONSTRAINT fk_proyecto_pep_grupo_apoyo FOREIGN KEY (gru_apo_id) REFERENCES grupo_apoyo(gru_apo_id);


--
-- Name: fk_proyecto_pep_informe_preliminar; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY informe_preliminar
    ADD CONSTRAINT fk_proyecto_pep_informe_preliminar FOREIGN KEY (pro_pep_id) REFERENCES proyecto_pep(pro_pep_id);


--
-- Name: fk_proyecto_pep_reunion; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY reunion
    ADD CONSTRAINT fk_proyecto_pep_reunion FOREIGN KEY (pro_pep_id) REFERENCES proyecto_pep(pro_pep_id);


--
-- Name: fk_proyecto_programa_componen; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY proyecto
    ADD CONSTRAINT fk_proyecto_programa_componen FOREIGN KEY (com_id) REFERENCES componente(com_id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_proyecto_se_realiz_municipi; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY proyecto
    ADD CONSTRAINT fk_proyecto_se_realiz_municipi FOREIGN KEY (mun_id) REFERENCES municipio(mun_id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_rol_rol_sistema; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY rol_opcion_sistema
    ADD CONSTRAINT fk_rol_rol_sistema FOREIGN KEY (rol_id) REFERENCES rol(rol_id);


--
-- Name: fk_rol_user; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY users
    ADD CONSTRAINT fk_rol_user FOREIGN KEY (rol_id) REFERENCES rol(rol_id);


--
-- Name: fk_telefono_informaci_region; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY telefono
    ADD CONSTRAINT fk_telefono_informaci_region FOREIGN KEY (reg_id) REFERENCES region(reg_id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: fk_telefono_tiene_asesor_m; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY telefono
    ADD CONSTRAINT fk_telefono_tiene_asesor_m FOREIGN KEY (ase_mun_id) REFERENCES asesor_municipal(ase_mun_id) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- Name: pk_opcion_sistema_opcion_sistema; Type: FK CONSTRAINT; Schema: public; Owner: smpfgl
--

ALTER TABLE ONLY opcion_sistema
    ADD CONSTRAINT pk_opcion_sistema_opcion_sistema FOREIGN KEY (opc_opc_sis_id) REFERENCES opcion_sistema(opc_sis_id);


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

