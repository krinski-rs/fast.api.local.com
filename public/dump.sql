--
-- PostgreSQL database dump
--

-- Dumped from database version 10.9 (Ubuntu 10.9-1.pgdg18.04+1)
-- Dumped by pg_dump version 11.4 (Ubuntu 11.4-1.pgdg18.04+1)

-- Started on 2019-06-28 16:27:44 -03

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 13 (class 2615 OID 16385)
-- Name: redes; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA redes;


ALTER SCHEMA redes OWNER TO postgres;

--
-- TOC entry 723 (class 1247 OID 65923)
-- Name: marca_switch; Type: TYPE; Schema: redes; Owner: postgres
--

CREATE TYPE redes.marca_switch AS ENUM (
    'Linksys',
    'Extreme',
    'Datacom',
    'Cisco'
);


ALTER TYPE redes.marca_switch OWNER TO postgres;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 247 (class 1259 OID 57728)
-- Name: service; Type: TABLE; Schema: redes; Owner: postgres
--

CREATE TABLE redes.service (
    id integer NOT NULL,
    name character varying(100) NOT NULL,
    active boolean DEFAULT true NOT NULL,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    removed_at timestamp without time zone
);


ALTER TABLE redes.service OWNER TO postgres;

--
-- TOC entry 246 (class 1259 OID 57726)
-- Name: service_id_seq; Type: SEQUENCE; Schema: redes; Owner: postgres
--

CREATE SEQUENCE redes.service_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE redes.service_id_seq OWNER TO postgres;

--
-- TOC entry 3083 (class 0 OID 0)
-- Dependencies: 246
-- Name: service_id_seq; Type: SEQUENCE OWNED BY; Schema: redes; Owner: postgres
--

ALTER SEQUENCE redes.service_id_seq OWNED BY redes.service.id;


--
-- TOC entry 251 (class 1259 OID 57746)
-- Name: switch_model; Type: TABLE; Schema: redes; Owner: postgres
--

CREATE TABLE redes.switch_model (
    id integer NOT NULL,
    name character varying(100) NOT NULL,
    active boolean DEFAULT true NOT NULL,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    removed_at timestamp without time zone,
    brand redes.marca_switch NOT NULL
);


ALTER TABLE redes.switch_model OWNER TO postgres;

--
-- TOC entry 250 (class 1259 OID 57744)
-- Name: switch_model_id_seq; Type: SEQUENCE; Schema: redes; Owner: postgres
--

CREATE SEQUENCE redes.switch_model_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE redes.switch_model_id_seq OWNER TO postgres;

--
-- TOC entry 3084 (class 0 OID 0)
-- Dependencies: 250
-- Name: switch_model_id_seq; Type: SEQUENCE OWNED BY; Schema: redes; Owner: postgres
--

ALTER SEQUENCE redes.switch_model_id_seq OWNED BY redes.switch_model.id;


--
-- TOC entry 249 (class 1259 OID 57738)
-- Name: switchs; Type: TABLE; Schema: redes; Owner: postgres
--

CREATE TABLE redes.switchs (
    id integer NOT NULL,
    service_id integer NOT NULL,
    switch_model_id integer NOT NULL,
    name character varying(100) NOT NULL,
    active boolean DEFAULT true NOT NULL,
    created_at timestamp(0) without time zone DEFAULT now() NOT NULL,
    removed_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone
);


ALTER TABLE redes.switchs OWNER TO postgres;

--
-- TOC entry 248 (class 1259 OID 57736)
-- Name: switchs_id_seq; Type: SEQUENCE; Schema: redes; Owner: postgres
--

CREATE SEQUENCE redes.switchs_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE redes.switchs_id_seq OWNER TO postgres;

--
-- TOC entry 3085 (class 0 OID 0)
-- Dependencies: 248
-- Name: switchs_id_seq; Type: SEQUENCE OWNED BY; Schema: redes; Owner: postgres
--

ALTER SEQUENCE redes.switchs_id_seq OWNED BY redes.switchs.id;


--
-- TOC entry 2933 (class 2604 OID 57731)
-- Name: service id; Type: DEFAULT; Schema: redes; Owner: postgres
--

ALTER TABLE ONLY redes.service ALTER COLUMN id SET DEFAULT nextval('redes.service_id_seq'::regclass);


--
-- TOC entry 2940 (class 2604 OID 57749)
-- Name: switch_model id; Type: DEFAULT; Schema: redes; Owner: postgres
--

ALTER TABLE ONLY redes.switch_model ALTER COLUMN id SET DEFAULT nextval('redes.switch_model_id_seq'::regclass);


--
-- TOC entry 2936 (class 2604 OID 57741)
-- Name: switchs id; Type: DEFAULT; Schema: redes; Owner: postgres
--

ALTER TABLE ONLY redes.switchs ALTER COLUMN id SET DEFAULT nextval('redes.switchs_id_seq'::regclass);


--
-- TOC entry 3073 (class 0 OID 57728)
-- Dependencies: 247
-- Data for Name: service; Type: TABLE DATA; Schema: redes; Owner: postgres
--

COPY redes.service (id, name, active, created_at, removed_at) FROM stdin;
1	IP ISP	t	2019-06-24 16:22:00.345396	\N
2	VPN L3	t	2019-06-24 16:58:16.687302	\N
\.


--
-- TOC entry 3077 (class 0 OID 57746)
-- Dependencies: 251
-- Data for Name: switch_model; Type: TABLE DATA; Schema: redes; Owner: postgres
--

COPY redes.switch_model (id, name, active, created_at, removed_at, brand) FROM stdin;
\.


--
-- TOC entry 3075 (class 0 OID 57738)
-- Dependencies: 249
-- Data for Name: switchs; Type: TABLE DATA; Schema: redes; Owner: postgres
--

COPY redes.switchs (id, service_id, switch_model_id, name, active, created_at, removed_at) FROM stdin;
\.


--
-- TOC entry 3086 (class 0 OID 0)
-- Dependencies: 246
-- Name: service_id_seq; Type: SEQUENCE SET; Schema: redes; Owner: postgres
--

SELECT pg_catalog.setval('redes.service_id_seq', 2, true);


--
-- TOC entry 3087 (class 0 OID 0)
-- Dependencies: 250
-- Name: switch_model_id_seq; Type: SEQUENCE SET; Schema: redes; Owner: postgres
--

SELECT pg_catalog.setval('redes.switch_model_id_seq', 1, false);


--
-- TOC entry 3088 (class 0 OID 0)
-- Dependencies: 248
-- Name: switchs_id_seq; Type: SEQUENCE SET; Schema: redes; Owner: postgres
--

SELECT pg_catalog.setval('redes.switchs_id_seq', 1, false);


--
-- TOC entry 2944 (class 2606 OID 57735)
-- Name: service service_pkey; Type: CONSTRAINT; Schema: redes; Owner: postgres
--

ALTER TABLE ONLY redes.service
    ADD CONSTRAINT service_pkey PRIMARY KEY (id);


--
-- TOC entry 2948 (class 2606 OID 57752)
-- Name: switch_model switch_model_pkey; Type: CONSTRAINT; Schema: redes; Owner: postgres
--

ALTER TABLE ONLY redes.switch_model
    ADD CONSTRAINT switch_model_pkey PRIMARY KEY (id);


--
-- TOC entry 2946 (class 2606 OID 57743)
-- Name: switchs switchs_pkey; Type: CONSTRAINT; Schema: redes; Owner: postgres
--

ALTER TABLE ONLY redes.switchs
    ADD CONSTRAINT switchs_pkey PRIMARY KEY (id);


--
-- TOC entry 2949 (class 2606 OID 57769)
-- Name: switchs switchs_service_fkey; Type: FK CONSTRAINT; Schema: redes; Owner: postgres
--

ALTER TABLE ONLY redes.switchs
    ADD CONSTRAINT switchs_service_fkey FOREIGN KEY (service_id) REFERENCES redes.service(id);


--
-- TOC entry 2950 (class 2606 OID 57774)
-- Name: switchs switchs_switch_model_fkey; Type: FK CONSTRAINT; Schema: redes; Owner: postgres
--

ALTER TABLE ONLY redes.switchs
    ADD CONSTRAINT switchs_switch_model_fkey FOREIGN KEY (switch_model_id) REFERENCES redes.switch_model(id);


-- Completed on 2019-06-28 16:27:44 -03

--
-- PostgreSQL database dump complete
--

