--
-- PostgreSQL database dump
--

-- Dumped from database version 13.2
-- Dumped by pg_dump version 13.2

-- Started on 2021-06-14 22:07:00

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
-- TOC entry 221 (class 1255 OID 25143)
-- Name: atualiza_reserva_equipamento(integer, character varying); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.atualiza_reserva_equipamento(npatri integer, cod character varying) RETURNS void
    LANGUAGE plpgsql
    AS $$
begin
update usa_equip set fk_usuaro_cod = cod and fk_equipamentos_npatrimonio = npatri and data_emprestimo = current_date;
end;
$$;


ALTER FUNCTION public.atualiza_reserva_equipamento(npatri integer, cod character varying) OWNER TO postgres;

--
-- TOC entry 222 (class 1255 OID 25144)
-- Name: atualiza_reserva_laboratorio(character varying, integer); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.atualiza_reserva_laboratorio(ucod character varying, lcod integer) RETURNS void
    LANGUAGE plpgsql
    AS $$
begin
 update Reserva set fk_usuaro_cod = UCod and fk_Laboratorio_Cod = LCod and data_emprestimo =
current_date;
end;
$$;


ALTER FUNCTION public.atualiza_reserva_laboratorio(ucod character varying, lcod integer) OWNER TO postgres;

--
-- TOC entry 220 (class 1255 OID 25134)
-- Name: equipamento_atrasado(); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION public.equipamento_atrasado() RETURNS SETOF record
    LANGUAGE plpgsql
    AS $$
BEGIN
 RETURN query select usuario.nome, cod, npatrimonio,equipamentos.nome, data_recebimento
 FROM usuario, equipamentos, usa_equip
 WHERE current_date >= data_recebimento;
 RETURN;
END;
$$;


ALTER FUNCTION public.equipamento_atrasado() OWNER TO postgres;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 201 (class 1259 OID 24846)
-- Name: equipamentos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.equipamentos (
    item integer,
    npatrimonio integer NOT NULL,
    nome character varying(30),
    descricao character varying(30),
    processo character varying(30),
    empenho character varying(30),
    empenho_siafi character varying(30),
    local character varying(30),
    observacao character varying(40),
    reservado character varying DEFAULT 0
);


ALTER TABLE public.equipamentos OWNER TO postgres;

--
-- TOC entry 204 (class 1259 OID 24861)
-- Name: laboratorio; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.laboratorio (
    cod integer NOT NULL,
    reservado character varying DEFAULT 0
);


ALTER TABLE public.laboratorio OWNER TO postgres;

--
-- TOC entry 202 (class 1259 OID 24851)
-- Name: material; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.material (
    item integer,
    cod integer NOT NULL,
    nome character varying(30),
    descricao character varying(30),
    quant_recebida integer,
    unidade character varying(30),
    danificado_descartado integer,
    total integer,
    local character varying(30),
    tipo character varying(30),
    empenho character varying(30),
    empenho_siafi character varying(30),
    observacao character varying(40),
    reservado character varying(30)
);


ALTER TABLE public.material OWNER TO postgres;

--
-- TOC entry 200 (class 1259 OID 24841)
-- Name: reagentes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.reagentes (
    cod integer NOT NULL,
    nome character varying(30),
    grupo character varying(30),
    quant_estoque integer,
    quant_recipiente integer,
    quant_usada integer,
    total integer,
    unidade character(1),
    tipo character varying(30),
    obs character varying(40)
);


ALTER TABLE public.reagentes OWNER TO postgres;

--
-- TOC entry 207 (class 1259 OID 25164)
-- Name: reserva; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.reserva (
    fk_usuario_cod integer,
    fk_laboratorio_cod integer,
    data_emprestimo character varying(30),
    data_recebimento character varying(30)
);


ALTER TABLE public.reserva OWNER TO postgres;

--
-- TOC entry 206 (class 1259 OID 25161)
-- Name: usa_equip; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.usa_equip (
    fk_usuario_cod integer,
    fk_equipamentos_npatrimonio integer,
    data_emprestimo character varying(30),
    data_recebimento character varying(30)
);


ALTER TABLE public.usa_equip OWNER TO postgres;

--
-- TOC entry 208 (class 1259 OID 25167)
-- Name: usa_mat; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.usa_mat (
    fk_material_cod integer,
    fk_usuario_cod integer,
    data_emprestimo character varying(30),
    data_recebimento character varying(30)
);


ALTER TABLE public.usa_mat OWNER TO postgres;

--
-- TOC entry 205 (class 1259 OID 25158)
-- Name: usa_reag; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.usa_reag (
    fk_usuario_cod integer,
    fk_reagentes_cod integer,
    data_emprestimo character varying(30),
    data_recebimento character varying(30)
);


ALTER TABLE public.usa_reag OWNER TO postgres;

--
-- TOC entry 203 (class 1259 OID 24856)
-- Name: usuario; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.usuario (
    nome character varying(30),
    tipo_usuario character varying(30),
    email character varying(30),
    cod integer NOT NULL,
    senha character varying(30)
);


ALTER TABLE public.usuario OWNER TO postgres;

--
-- TOC entry 3036 (class 0 OID 24846)
-- Dependencies: 201
-- Data for Name: equipamentos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.equipamentos (item, npatrimonio, nome, descricao, processo, empenho, empenho_siafi, local, observacao, reservado) FROM stdin;
1	735355	aerografo	CONTENDO\nCOMPRESSOR...	23117.070059/18-91	005886/18	2018NE804392	Não está em posse	ok	0
49	731986	AR-CONDICIONADO	CONDICIONADOR DE\nAR...	MI SEI 177/18-DIPCO	BR-043/18	MI SEI 177/18-DIPCO	Corpo do laboratório	ok	0
48	732016	AR-CONDICIONADO	CONDICIONADOR DE\nAR...	MI SEI 177/18-DIPCO	BR-043/18	MI SEI 177/18-DIPCO	Escritório - LAFIT	ok	
43	706215	AGITADOR DE SOLUÇÕES	AGITADOR DE\nTUBOS...	x	x	x	x	ok	
\.


--
-- TOC entry 3039 (class 0 OID 24861)
-- Dependencies: 204
-- Data for Name: laboratorio; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.laboratorio (cod, reservado) FROM stdin;
2	0
3	0
4	0
5	
1	0
526	0
\.


--
-- TOC entry 3037 (class 0 OID 24851)
-- Dependencies: 202
-- Data for Name: material; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.material (item, cod, nome, descricao, quant_recebida, unidade, danificado_descartado, total, local, tipo, empenho, empenho_siafi, observacao, reservado) FROM stdin;
4	408266	Becker	Becker...	20	Unidade	0	20	Depósito	Chegada	000763/2020	2019NE800568\n	x	0
2	408288	Becker	Becker...	20	Unidade	0	20	Depósito	Chegada	000760/2019	2019NE800568\n	x	0
1	107204	Bandeja	Bandeja...	20	Unidade	0	20	Corpo do\nlaboratório	Chegada	005611/2018	2018NE804214	x	0
3	409084	Micropipeta	Micropipeta...	2	Unidade	0	2	Armário\nembutido	Chegada	000763/2019	2019NE800567	x	0
\.


--
-- TOC entry 3035 (class 0 OID 24841)
-- Dependencies: 200
-- Data for Name: reagentes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.reagentes (cod, nome, grupo, quant_estoque, quant_recipiente, quant_usada, total, unidade, tipo, obs) FROM stdin;
347320	ÁCIDO CLORÍDRICO (ALPHATEC)	acido\nforte	1000	7	2000	5000	m	Chegada	2 LITROS FORAM...
2	ÁCIDO CLORÍDRICO (VETEC)	acido forte	1000	2	0	2000	m	Ja\nexistia	x
3	ÁCIDO ACÉTICO GLACIAL	acido forte	1000	12	0	12000	m	Ja\nexistia	x
4	ÓLEO MINERAL	oleo mineral	500	1	0	500	m	Ja existia	x
42525	teste	teste	15	2	0	30	m	teste	teste
\.


--
-- TOC entry 3042 (class 0 OID 25164)
-- Dependencies: 207
-- Data for Name: reserva; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.reserva (fk_usuario_cod, fk_laboratorio_cod, data_emprestimo, data_recebimento) FROM stdin;
\.


--
-- TOC entry 3041 (class 0 OID 25161)
-- Dependencies: 206
-- Data for Name: usa_equip; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.usa_equip (fk_usuario_cod, fk_equipamentos_npatrimonio, data_emprestimo, data_recebimento) FROM stdin;
\.


--
-- TOC entry 3043 (class 0 OID 25167)
-- Dependencies: 208
-- Data for Name: usa_mat; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.usa_mat (fk_material_cod, fk_usuario_cod, data_emprestimo, data_recebimento) FROM stdin;
\.


--
-- TOC entry 3040 (class 0 OID 25158)
-- Dependencies: 205
-- Data for Name: usa_reag; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.usa_reag (fk_usuario_cod, fk_reagentes_cod, data_emprestimo, data_recebimento) FROM stdin;
\.


--
-- TOC entry 3038 (class 0 OID 24856)
-- Dependencies: 203
-- Data for Name: usuario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.usuario (nome, tipo_usuario, email, cod, senha) FROM stdin;
joao	Professor	joao.email	1	lab123
maria	Professor	maria.email	2	lab123
jose	Professor	jose.email	3	lab123
ana	Aaluno	ana.email	4	lab123
teste	professor	teste@ufu.br	6	1234
\.


--
-- TOC entry 2890 (class 2606 OID 24850)
-- Name: equipamentos equipamentos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.equipamentos
    ADD CONSTRAINT equipamentos_pkey PRIMARY KEY (npatrimonio);


--
-- TOC entry 2896 (class 2606 OID 24865)
-- Name: laboratorio laboratorio_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.laboratorio
    ADD CONSTRAINT laboratorio_pkey PRIMARY KEY (cod);


--
-- TOC entry 2892 (class 2606 OID 24855)
-- Name: material material_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.material
    ADD CONSTRAINT material_pkey PRIMARY KEY (cod);


--
-- TOC entry 2888 (class 2606 OID 24845)
-- Name: reagentes reagentes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.reagentes
    ADD CONSTRAINT reagentes_pkey PRIMARY KEY (cod);


--
-- TOC entry 2894 (class 2606 OID 25148)
-- Name: usuario usuario_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT usuario_pkey PRIMARY KEY (cod);


--
-- TOC entry 2901 (class 2606 OID 25190)
-- Name: reserva fk_reserva_1; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.reserva
    ADD CONSTRAINT fk_reserva_1 FOREIGN KEY (fk_usuario_cod) REFERENCES public.usuario(cod) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- TOC entry 2902 (class 2606 OID 25195)
-- Name: reserva fk_reserva_2; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.reserva
    ADD CONSTRAINT fk_reserva_2 FOREIGN KEY (fk_laboratorio_cod) REFERENCES public.laboratorio(cod) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- TOC entry 2899 (class 2606 OID 25180)
-- Name: usa_equip fk_usa_equip_1; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usa_equip
    ADD CONSTRAINT fk_usa_equip_1 FOREIGN KEY (fk_usuario_cod) REFERENCES public.usuario(cod) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- TOC entry 2900 (class 2606 OID 25185)
-- Name: usa_equip fk_usa_equip_2; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usa_equip
    ADD CONSTRAINT fk_usa_equip_2 FOREIGN KEY (fk_equipamentos_npatrimonio) REFERENCES public.equipamentos(npatrimonio) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- TOC entry 2903 (class 2606 OID 25200)
-- Name: usa_mat fk_usa_mat_1; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usa_mat
    ADD CONSTRAINT fk_usa_mat_1 FOREIGN KEY (fk_material_cod) REFERENCES public.material(cod) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- TOC entry 2904 (class 2606 OID 25205)
-- Name: usa_mat fk_usa_mat_2; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usa_mat
    ADD CONSTRAINT fk_usa_mat_2 FOREIGN KEY (fk_usuario_cod) REFERENCES public.usuario(cod) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- TOC entry 2897 (class 2606 OID 25170)
-- Name: usa_reag fk_usa_reag_1; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usa_reag
    ADD CONSTRAINT fk_usa_reag_1 FOREIGN KEY (fk_usuario_cod) REFERENCES public.usuario(cod) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- TOC entry 2898 (class 2606 OID 25175)
-- Name: usa_reag fk_usa_reag_2; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usa_reag
    ADD CONSTRAINT fk_usa_reag_2 FOREIGN KEY (fk_reagentes_cod) REFERENCES public.reagentes(cod) ON UPDATE CASCADE ON DELETE SET NULL;


--
-- TOC entry 3049 (class 0 OID 0)
-- Dependencies: 201
-- Name: TABLE equipamentos; Type: ACL; Schema: public; Owner: postgres
--

GRANT SELECT,INSERT,DELETE,UPDATE ON TABLE public.equipamentos TO alunos;


--
-- TOC entry 3050 (class 0 OID 0)
-- Dependencies: 204
-- Name: TABLE laboratorio; Type: ACL; Schema: public; Owner: postgres
--

GRANT SELECT,INSERT,DELETE,UPDATE ON TABLE public.laboratorio TO professores;


--
-- TOC entry 3051 (class 0 OID 0)
-- Dependencies: 202
-- Name: TABLE material; Type: ACL; Schema: public; Owner: postgres
--

GRANT SELECT,INSERT,DELETE,UPDATE ON TABLE public.material TO alunos;


--
-- TOC entry 3052 (class 0 OID 0)
-- Dependencies: 200
-- Name: TABLE reagentes; Type: ACL; Schema: public; Owner: postgres
--

GRANT SELECT,INSERT,DELETE,UPDATE ON TABLE public.reagentes TO alunos;


-- Completed on 2021-06-14 22:07:00

--
-- PostgreSQL database dump complete
--

