--
-- PostgreSQL database dump
--

-- Dumped from database version 17.0
-- Dumped by pg_dump version 17.0

-- Started on 2025-01-27 14:47:01

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 238 (class 1259 OID 41734)
-- Name: awesome; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.awesome (
    id bigint NOT NULL,
    user_id text,
    description text,
    "time" text
);


ALTER TABLE public.awesome OWNER TO postgres;

--
-- TOC entry 237 (class 1259 OID 41733)
-- Name: awesome_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.awesome_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.awesome_id_seq OWNER TO postgres;

--
-- TOC entry 4982 (class 0 OID 0)
-- Dependencies: 237
-- Name: awesome_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.awesome_id_seq OWNED BY public.awesome.id;


--
-- TOC entry 240 (class 1259 OID 41753)
-- Name: groups; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.groups (
    id bigint NOT NULL,
    name text,
    count bigint,
    education text
);


ALTER TABLE public.groups OWNER TO postgres;

--
-- TOC entry 239 (class 1259 OID 41752)
-- Name: groups_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.groups_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.groups_id_seq OWNER TO postgres;

--
-- TOC entry 4983 (class 0 OID 0)
-- Dependencies: 239
-- Name: groups_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.groups_id_seq OWNED BY public.groups.id;


--
-- TOC entry 217 (class 1259 OID 33363)
-- Name: info_achievements; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.info_achievements (
    id bigint NOT NULL,
    url text,
    description text
);


ALTER TABLE public.info_achievements OWNER TO postgres;

--
-- TOC entry 218 (class 1259 OID 33368)
-- Name: info_artefacts; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.info_artefacts (
    id bigint NOT NULL,
    url text,
    description text,
    project_id text
);


ALTER TABLE public.info_artefacts OWNER TO postgres;

--
-- TOC entry 227 (class 1259 OID 41612)
-- Name: info_interests; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.info_interests (
    id integer NOT NULL,
    description text,
    title text
);


ALTER TABLE public.info_interests OWNER TO postgres;

--
-- TOC entry 228 (class 1259 OID 41615)
-- Name: info_interests_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.info_interests_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.info_interests_id_seq OWNER TO postgres;

--
-- TOC entry 4984 (class 0 OID 0)
-- Dependencies: 228
-- Name: info_interests_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.info_interests_id_seq OWNED BY public.info_interests.id;


--
-- TOC entry 219 (class 1259 OID 33373)
-- Name: info_project; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.info_project (
    id bigint DEFAULT 0 NOT NULL,
    name text,
    status text,
    start date,
    duration bigint,
    goal text,
    appointment text,
    stack integer[],
    tags text,
    refs integer[],
    artefacts integer[],
    achievements integer[],
    roles integer[],
    vacancys integer[],
    participants integer[]
);


ALTER TABLE public.info_project OWNER TO postgres;

--
-- TOC entry 220 (class 1259 OID 33379)
-- Name: info_roles; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.info_roles (
    id bigint NOT NULL,
    role text
);


ALTER TABLE public.info_roles OWNER TO postgres;

--
-- TOC entry 221 (class 1259 OID 33384)
-- Name: info_tags; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.info_tags (
    id bigint NOT NULL,
    name text
);


ALTER TABLE public.info_tags OWNER TO postgres;

--
-- TOC entry 222 (class 1259 OID 33389)
-- Name: info_unit_time; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.info_unit_time (
    id bigint NOT NULL,
    unit_time text
);


ALTER TABLE public.info_unit_time OWNER TO postgres;

--
-- TOC entry 226 (class 1259 OID 33436)
-- Name: info_user; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.info_user (
    id bigint NOT NULL,
    firstname text NOT NULL,
    lastname text NOT NULL,
    patronymic text,
    login text NOT NULL,
    roles json,
    icon text DEFAULT 'icon_default_profile.jpg'::text,
    hash text NOT NULL,
    telephone text,
    email text,
    status text DEFAULT 'block'::text,
    skills text,
    "group" text,
    course text,
    cipher text,
    institute text,
    year_start text,
    specialization text DEFAULT 'Прикладная математика и информатика'::text NOT NULL,
    educational_program text,
    about text,
    division text DEFAULT 'БК 536 РТУ МИРЭА'::text NOT NULL
);


ALTER TABLE public.info_user OWNER TO postgres;

--
-- TOC entry 223 (class 1259 OID 33394)
-- Name: info_user1; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.info_user1 (
    id bigint NOT NULL,
    firstname text,
    lastname text,
    patronymic text,
    login text,
    password text,
    roles json,
    icons text,
    hash text,
    telephone text,
    email text
);


ALTER TABLE public.info_user1 OWNER TO postgres;

--
-- TOC entry 225 (class 1259 OID 33435)
-- Name: info_user_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.info_user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.info_user_id_seq OWNER TO postgres;

--
-- TOC entry 4985 (class 0 OID 0)
-- Dependencies: 225
-- Name: info_user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.info_user_id_seq OWNED BY public.info_user.id;


--
-- TOC entry 224 (class 1259 OID 33399)
-- Name: info_vacancys; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.info_vacancys (
    id bigint NOT NULL,
    description text,
    rule text,
    xperience text
);

ALTER TABLE ONLY public.info_vacancys FORCE ROW LEVEL SECURITY;


ALTER TABLE public.info_vacancys OWNER TO postgres;

--
-- TOC entry 236 (class 1259 OID 41715)
-- Name: like_project; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.like_project (
    id bigint NOT NULL,
    project_id text,
    phpsessid text
);


ALTER TABLE public.like_project OWNER TO postgres;

--
-- TOC entry 235 (class 1259 OID 41714)
-- Name: like_project_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.like_project_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.like_project_id_seq OWNER TO postgres;

--
-- TOC entry 4986 (class 0 OID 0)
-- Dependencies: 235
-- Name: like_project_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.like_project_id_seq OWNED BY public.like_project.id;


--
-- TOC entry 230 (class 1259 OID 41632)
-- Name: projects; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.projects (
    id bigint NOT NULL,
    name text,
    premier text,
    status text,
    stack text,
    communities text,
    experts text,
    tags json,
    icon text,
    duration bigint,
    goal text,
    appointment text,
    refs text,
    artefacts text,
    achievements text,
    participants text,
    author bigint,
    description text
);


ALTER TABLE public.projects OWNER TO postgres;

--
-- TOC entry 229 (class 1259 OID 41631)
-- Name: projects_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.projects_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.projects_id_seq OWNER TO postgres;

--
-- TOC entry 4987 (class 0 OID 0)
-- Dependencies: 229
-- Name: projects_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.projects_id_seq OWNED BY public.projects.id;


--
-- TOC entry 234 (class 1259 OID 41678)
-- Name: tags; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.tags (
    id bigint NOT NULL,
    title text
);


ALTER TABLE public.tags OWNER TO postgres;

--
-- TOC entry 233 (class 1259 OID 41677)
-- Name: tags_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.tags_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.tags_id_seq OWNER TO postgres;

--
-- TOC entry 4988 (class 0 OID 0)
-- Dependencies: 233
-- Name: tags_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.tags_id_seq OWNED BY public.tags.id;


--
-- TOC entry 232 (class 1259 OID 41668)
-- Name: vacancies; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.vacancies (
    id bigint NOT NULL,
    name text,
    description text,
    duties json,
    tags json,
    "create" text,
    condidats text,
    speciality text,
    project_id text,
    status text,
    experience json
);


ALTER TABLE public.vacancies OWNER TO postgres;

--
-- TOC entry 231 (class 1259 OID 41667)
-- Name: vacancies_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.vacancies_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.vacancies_id_seq OWNER TO postgres;

--
-- TOC entry 4989 (class 0 OID 0)
-- Dependencies: 231
-- Name: vacancies_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.vacancies_id_seq OWNED BY public.vacancies.id;


--
-- TOC entry 4773 (class 2604 OID 41737)
-- Name: awesome id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.awesome ALTER COLUMN id SET DEFAULT nextval('public.awesome_id_seq'::regclass);


--
-- TOC entry 4774 (class 2604 OID 41756)
-- Name: groups id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.groups ALTER COLUMN id SET DEFAULT nextval('public.groups_id_seq'::regclass);


--
-- TOC entry 4768 (class 2604 OID 41616)
-- Name: info_interests id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.info_interests ALTER COLUMN id SET DEFAULT nextval('public.info_interests_id_seq'::regclass);


--
-- TOC entry 4763 (class 2604 OID 33439)
-- Name: info_user id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.info_user ALTER COLUMN id SET DEFAULT nextval('public.info_user_id_seq'::regclass);


--
-- TOC entry 4772 (class 2604 OID 41718)
-- Name: like_project id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.like_project ALTER COLUMN id SET DEFAULT nextval('public.like_project_id_seq'::regclass);


--
-- TOC entry 4769 (class 2604 OID 41635)
-- Name: projects id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.projects ALTER COLUMN id SET DEFAULT nextval('public.projects_id_seq'::regclass);


--
-- TOC entry 4771 (class 2604 OID 41681)
-- Name: tags id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tags ALTER COLUMN id SET DEFAULT nextval('public.tags_id_seq'::regclass);


--
-- TOC entry 4770 (class 2604 OID 41671)
-- Name: vacancies id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.vacancies ALTER COLUMN id SET DEFAULT nextval('public.vacancies_id_seq'::regclass);


--
-- TOC entry 4974 (class 0 OID 41734)
-- Dependencies: 238
-- Data for Name: awesome; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.awesome (id, user_id, description, "time") FROM stdin;
1	1	программист	года
2	5	дизайнер	месяца
3	2	backend-разработчик	месяца
4	4	системный аналитик	месяца
5	6	студент	месяца
6	1	инженер	месяца
7	5	проектировщик	месяца
8	2	исследователь	месяца
9	4	менеджер проекта	месяца
10	6	тестировщик	месяца
\.


--
-- TOC entry 4976 (class 0 OID 41753)
-- Dependencies: 240
-- Data for Name: groups; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.groups (id, name, count, education) FROM stdin;
4	\N	\N	\N
5	\N	\N	\N
6	\N	\N	\N
1	КММО-01-23	\N	\N
2	КМБО-02-24	\N	\N
7	\N	\N	\N
3	КМБО-01-24	\N	\N
\.


--
-- TOC entry 4953 (class 0 OID 33363)
-- Dependencies: 217
-- Data for Name: info_achievements; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.info_achievements (id, url, description) FROM stdin;
1	https://content133563.vega.mirea.ru	творчество
2	https://content133563.vega.mirea.ru	участие в конкурсах
3	https://content133563.vega.mirea.ru	победа на между народных конкурсах
4	https://content133563.vega.mirea.ru	вклад в науку
5	https://content133563.vega.mirea.ru	креатив
0	https://content133563.vega.mirea.ru	качество
\.


--
-- TOC entry 4954 (class 0 OID 33368)
-- Dependencies: 218
-- Data for Name: info_artefacts; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.info_artefacts (id, url, description, project_id) FROM stdin;
1	https://content132242.vega.mirea.ru	\N	\N
2	https://content133563.vega.mirea.ru	\N	\N
3	https://content138555.vega.mirea.ru	\N	\N
4	https://content253748.vega.mirea.ru	\N	\N
5	https://content709032.vega.mirea.ru	\N	\N
6	https://content158585.vega.mirea.ru	\N	\N
7	https://content145652.vega.mirea.ru	\N	\N
8	https://content103257.vega.mirea.ru	\N	\N
9	https://content196023.vega.mirea.ru	\N	\N
10	https://content107977.vega.mirea.ru	\N	\N
11	https://content107977.vega.mirea.ru	Код веб-краулера	12
12	https://content107977.vega.mirea.ru	база данных с собранными текстами	12
13	https://content107977.vega.mirea.ru	отчет о релевантности	12
14	https://content107977.vega.mirea.ru	Модуль проверки текста	13
15	https://content107977.vega.mirea.ru	база данных с результатами проверок	13
16	https://content107977.vega.mirea.ru	пользовательский интерфейс	13
17	https://content107977.vega.mirea.ru	Модуль анализа кода	14
18	https://content107977.vega.mirea.ru	отчет о схожести кода	14
19	https://content107977.vega.mirea.ru	Конфигурационные файлы	15
20	https://content107977.vega.mirea.ru	тестовые сценарии	15
21	https://content107977.vega.mirea.ru	отчеты об ошибках	15
22	https://content107977.vega.mirea.ru	Программа мониторинга	16
23	https://content107977.vega.mirea.ru	графический интерфейс	16
24	https://content107977.vega.mirea.ru	документация	16
25	https://content107977.vega.mirea.ru	Конфигурационные файлы сетевой среды	17
26	https://content107977.vega.mirea.ru	отчеты о тестах	17
27	https://content107977.vega.mirea.ru	Симуляция воздушного пространства	18
28	https://content107977.vega.mirea.ru	визуализация данных	18
29	https://content107977.vega.mirea.ru	сценарии тестирования	18
30	https://content107977.vega.mirea.ru	Локатор	19
31	https://content107977.vega.mirea.ru	интерфейс для отображения данных	19
32	https://content107977.vega.mirea.ru	отчеты о движении объектов	19
33	https://content107977.vega.mirea.ru	Программа сравнения трасс	20
34	https://content107977.vega.mirea.ru	отчеты о расхождениях	20
35	https://content107977.vega.mirea.ru	документация	21
36	https://content107977.vega.mirea.ru	Программа редактирования расписания	22
37	https://content107977.vega.mirea.ru	интерфейс	22
38	https://content107977.vega.mirea.ru	документация	22
39	https://content107977.vega.mirea.ru	База требований	23
40	https://content107977.vega.mirea.ru	интерфейс управления	23
41	https://content107977.vega.mirea.ru	отчеты	23
42	https://content107977.vega.mirea.ru	Отчеты об эргономике	24
43	https://content107977.vega.mirea.ru	результаты тестов	24
44	https://content107977.vega.mirea.ru	рекомендации по улучшению	24
0	https://vega.mirea.ru/new/main/	сайт кафедры	\N
\.


--
-- TOC entry 4963 (class 0 OID 41612)
-- Dependencies: 227
-- Data for Name: info_interests; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.info_interests (id, description, title) FROM stdin;
1	\N	frontend
\.


--
-- TOC entry 4955 (class 0 OID 33373)
-- Dependencies: 219
-- Data for Name: info_project; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.info_project (id, name, status, start, duration, goal, appointment, stack, tags, refs, artefacts, achievements, roles, vacancys, participants) FROM stdin;
13	Антиплагиат	Запуск	2024-09-15	3	Обеспечение честности в образовательном процессе через проверку текстов на оригинальность.	Антиплагиат — программа для проверки оригинальности текста. Этот инструмент создан для выявления плагиата в текстах. Алгоритмы анализа позволяют быстро и точно находить заимствования, обеспечивая честность в учебном процессе.	{10,17,11,12}	антиплагиат, уникальность текста, проверка оригинальности.	\N	{14,15,16}	{0,1,2}	\N	\N	\N
19	Forpost 2.0	В процессе	2015-03-03	108	Обеспечение мониторинга движущихся объектов на земле.	Forpost 2.0 — система наблюдения предназначена для анализа и отслеживания движущихся объектов. Компактный и надежный, Forpost 2.0 подходит для работы в различных условиях.	{1,8,9}	локатор, мониторинг.	\N	{30,31,32}	{1,2,3,4,5}	\N	\N	\N
16	Ртри	В процессе	2021-09-20	36	Мониторинг и управление системными объектами RTLib3; ускорение отладки ПО.	Ртри — система мониторинга и управления объектами RTLib3. Она автоматически регистрирует системные объекты, собирает данные об их состоянии и предоставляет разработчикам удобный интерфейс для анализа и управления. Этот инструмент помогает разработчикам отслеживать состояние системных объектов, моделировать различные сценарии работы программы и быстрее находить ошибки.	{1,8}	системный мониторинг, RTLib3, отладка, разработка.	\N	{22,23,24}	{1,2}	\N	\N	\N
17	 Simenv	В процессе	2024-02-10	9	Тестирования сложных программных систем.	Simenv — симулятор сетевой среды, который создает виртуальное окружение для отладки и тестирования сетевых соединений. Simenv используется для проверки взаимодействия программных компонентов и аппаратных средств в безопасных и контролируемых условиях.	{1,14}	симулятор, TCP/IP, сети, моделирование.	\N	{25,26}	{3,4}	\N	\N	\N
23	Система управления требованиями	Запуск	2024-11-28	1	Организация и управление требованиями на всех этапах проекта.	Инструмент, который собирает, фиксирует и структурирует все требования проекта. Он помогает командам следить за выполнением задач и сохранять контроль на каждом этапе разработки. Эта система позволяет вести учет требований, отслеживать их изменения и управлять выполнением. Она обеспечивает прозрачность процессов и упрощает коммуникацию в команде.	{10,12,5,13}	управление требованиями, проекты, аналитика.	\N	{39,40,41}	{1,2,3}	\N	{7,8}	\N
24	Система оценки эргономичности ГПИ	Запуск	2024-11-28	1	Анализ эргономичности графических интерфейсов; выявление слабых мест в UX/UI.	Инструмент для оценки эргономичности интерфейсов, который помогает создавать удобные и интуитивно понятные решения. Он анализирует интерфейсы и предлагает рекомендации по их улучшению.	{10,15,16,17,13,5}	UX/UI, эргономика, интерфейсы, дизайн	\N	{42,43,44}	{1,3,5}	\N	\N	\N
10	Анализ Кано	Запуск	2023-09-01	12	Составление диаграмм Кано	Построение с анализом диаграмм Канна на основе описаний	{2,3,4,19,20}	диаграммы Кано'	\N	{9}	{2,3}	\N	\N	\N
8	 Генератор УМД (рпд, фосы)	Запуск	2023-09-01	12	Обеспечить преподавателей сервисом для генерации образовательного контента и контрольных документов 	Сервис, который позволяет генерировать УМД.	{2,5,18}	ФГОС генератор', 'тестирование'	{3,5}	\N	{1,3,5}	{2,5,18}	\N	\N
11	Система автоматизации тестирования	В процессе	2023-09-01	24	Реализовать систему для автоматического тестирования работ студентов.	инстремент в виде страницы сайта с соответствующей логикой на стороне сервера и клиента, который позволяет загружать код,варианты ответов к тестам и осуществляет проверку на корректность введеных данных с соответствующей индикацией результатов проверки работ.	{2,3,4,19,20}	автоматическое тестирование', 'проверка работ'	{5}	\N	{1,2,3}	\N	{7,8}	\N
12	Паук	В процессе	2019-09-20	60	Автоматизация сбора текстовой информации с веб-ресурсов; оценка релевантности данных для образовательных дисциплин.	Паук — это веб-краулер, который упрощает поиск полезной информации в интернете. Задайте список ссылок и параметры, и программа автоматически соберет текст с указанных сайтов, анализируя его на предмет релевантности для учебных дисциплин. Система помогает экономить время и находить нужные материалы без долгого ручного поиска.	{10,5,17,2,21}	веб-краулер, автоматизация, NLP.	{2}	{11,12,13}	{0,1}	\N	{7,8}	\N
14	Антиплагиат / Код	Запуск	2024-09-15	3	Автоматизация проверки программного кода на уникальность; предотвращение списывания.	Антиплагиат/Код — специализированная версия программы Антиплагиат, которая проверяет уникальность программного кода. Система анализирует схожие структуры, алгоритмы и участки кода, помогая выявить случаи списывания	{10,17,13,22}	анализ кода, плагиат, программирование.	{13}	{17,18}	{2,3}	\N	{7,8}	\N
18	Pivo	В процессе	2012-01-15	144	Отображение воздушной обстановки.	Pivo — это программный имитатор воздушной обстановки. Он моделирует движение истребителей и других объектов в воздушном пространстве на основе файлов регистрации, помогая тестировать системы управления и анализа.	{1,8}	воздушное пространство.	{20}	{27,28,29}	{1,2,4}	\N	\N	\N
9	Сервисы офиса	Запуск	2023-09-01	36	Ввести замену Microsoft ofice web 	введение документов различного формата: pdf, doc, docx, pptx, excel. Открытие, редактирование и созранение через веб сервер.	{2,5,18}	Word офис'	{5}	{8}	{1,2}	{2,5,18}	{9,1}	\N
20	TrackCompare	В процессе	2014-01-10	120	Проверка точности отображения трасс самолетов.	TrackCompare — программа, которая проверяет точность отображения маршрутов самолетов. Она сравнивает данные, полученные от локаторов, с реальными трассами, помогая выявить расхождения.	{1,8}	трассы, тестирование.	{18}	{33,34}	{1,3,5}	\N	\N	\N
22	Редактор расписания	В процессе	2024-10-02	1	Автоматизация процесса создания и изменения расписания.	Программа для создания и редактирования расписания. Она помогает исключить ошибки и ускоряет процесс внесения изменений.	{10,11,12,5,6,7,13}	расписание, автоматизация, удобство, учебный процесс.	{4}	{36,37,38}	{2,3}	\N	\N	\N
15	ПС АОТ	В процессе	2014-09-20	120	Повышение эффективности тестирования взаимодействия компонентов в сложных системах.	Программное средство автоматизации отладки и тестирования (ПС АОТ) разработано для проверки сложных многокомпонентных систем. Оно моделирует взаимодействие программных узлов в реальных рабочих условиях, анализируя поведение системы при различных конфигурациях и нагрузках.	{1,8,23,24}	отладка, тестирование, сложные системы, сетевые взаимодействия.	\N	{19,20,21}	{1}	\N	\N	\N
1	Инкубатор идей / Портфолио	В процессе 	2024-10-10	12	учет личных достижений.	позволить участникам образовательного процесса: 1) определяться с научным направлением развития. 2) учет участия в проектах и личных достижений. 3) оповещение и вовлечение в проектную деятельность.	{6,7}	Достижения', 'Резюме'	{5}	{3}	{0,1,2}	{6,7}	{2}	\N
2	Интеллектуальный поиск	Запуск	2023-09-01	18	Инструмент в виде сервиса для осуществления поиска с помощью AI.	Ввести в качестве инструмента систему интеллектуального поиска для наилучшего способа предоставления актуальной, полной и верной информации	{2,5}	AI search', 'Chat-GPT search'	{5}	{2}	{2,3}	{2,5}	{3,4}	\N
3	Страницы дисциплин	Завершен	2023-09-01	2	Информирование пользователей сайта о дисциплинах, планах работ по конкретной дисциплине, какие компетенции развивают.	вывод достоверной информации по дисциплинам 	{2,3,4}	дисциплины', 'материал по дисциплине'	{5}	{1}	{1}	{3,4,5}	{5,6}	\N
4	Сайт кафедры	В процесс	2023-09-14	36	Предоставить сведения о том, чем занимаются стеденты вместе с преподавателями на конкретной кафедре. информировать о значемых собитиях.	Сбор, систематизация, актуализация и контроль сведений кафедры	{2,3,4,5}	кафедра', 'Вега', 'БК-536'	{1,2,3,4,6,7,8,9,10}	{0}	{1,2}	{3,4,5}	{7,8}	\N
5	Awesome List	Завершен	2022-11-05	24	демонстрация лучших работ по версии кафедры	сервис, позволяющий модераторам сайта загружать лучшие работы студентов. Отображать в браузере у посетителей соответствующей страницы сервиса данные сведения о лучших проектах.	{2,3,4,5}	лучшие работы', 'достижения'	{5}	{5}	{3,4}	{3,4,5}	{9,1}	\N
6	Whiteboard	Запуск	2023-09-01	12	Предоставить инструмент для творческого отображения действительности в виде рисунков, набросков, чертежей.	Отрисовка данных на цифровом холсте через браузер для демонстрации,  детального и содержательного обмена информацией.	{2,5,18}	доска', 'рисовать'	{5}	{6}	{1,2,4}	{2,5,18}	{5,6}	\N
7	Расписание 2.0	В процессе	2024-10-10	36	Информировать студентов и преподователей о планах работы на конкретный день (вести расписание)	Формирование расписаний на семестр, зачетную и экзаменационную сессии через веб интерфейс на сервере кафедры. Поддержание в актуальном состоянии и информирование об изменениях на кафедре в соответствующей области сервиса	{2,3,4,5}	расписание'	{5}	{7}	{1,2,3,4,5}	{2,3,4,5}	{9,1}	\N
21	RLIView	В процессе	2019-09-20	60	Визуализация данных для анализа радиолокационных изображений.	Программа для визуализации данных, которая превращает числовую информацию в графические изображения. RLIView предоставляет множество настроек для глубокого анализа изображений.	{1,8}	RLI, визуализация, изображения.	\N	{35}	{1,2}	\N	{7,8}	\N
0	Акселератор	Запуск	2025-02-01	1	Предоставить студентам платформу для идей и  стартап-проектов	Формирование и отслеживания потенциальных идей для проектов,  открытие стартапов и помощь в продвижении.	{2,3,4}	Генератор идей', 'Поиск идей'	{5}	{4}	{0,1}	{3,4,5}	{1}	{{1,2},{3,4}}
\.


--
-- TOC entry 4956 (class 0 OID 33379)
-- Dependencies: 220
-- Data for Name: info_roles; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.info_roles (id, role) FROM stdin;
1	Дизайнер
2	Frontend-разработчик
3	Backend-разработчик
4	Тестировщик
5	Менеджер проекта
6	Менеджер продукта
7	проектировщик
8	консультант
9	заказчик
10	заинтересованное лицо
0	Архитектор
\.


--
-- TOC entry 4957 (class 0 OID 33384)
-- Dependencies: 221
-- Data for Name: info_tags; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.info_tags (id, name) FROM stdin;
1	c++
0	c
2	php
3	html
4	css
5	javascript
6	React.js
7	Angular
8	Qt
9	ipp
10	Python
11	Flask
12	Django
13	PostgreSQL
14	TCP/IP
15	Tkinter
16	PyQt
17	Базы данных
18	asm
19	Vue.js
20	jsRect
21	Natural Language Processing
22	API-интеграции
23	Docker
24	Брокеры сообщений
\.


--
-- TOC entry 4958 (class 0 OID 33389)
-- Dependencies: 222
-- Data for Name: info_unit_time; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.info_unit_time (id, unit_time) FROM stdin;
1	дней
2	месяц
3	месяцев
4	год
5	лет
0	день
\.


--
-- TOC entry 4962 (class 0 OID 33436)
-- Dependencies: 226
-- Data for Name: info_user; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.info_user (id, firstname, lastname, patronymic, login, roles, icon, hash, telephone, email, status, skills, "group", course, cipher, institute, year_start, specialization, educational_program, about, division) FROM stdin;
2	Кружков	Олег	Игоревич	krushkov	["superuser"]	oleg.svg	$2y$10$bBSiZdIZnmjyzeMYYq5XpeUdoq4vaMu8lmSk1g8i7YB/oBXS1AIne	+7(495)-777-11-22	root@vega.su	unblock	\N	КММО-01-23	\N	\N	\N	\N	Прикладная математика и информатика	Магистратура	\N	БК 536 РТУ МИРЭА
3	Сергей	Минеев	Алексеевич	mineev	["superuser"]	default_avatar_profile.jpg	$2y$10$OLX/zu1L.n4gf/4nYiO7/.giQFJ0dE2z8F9n3AqXQK4D.pSrvEoBu	+7(495)-777-11-22	root@vega.su	unblock	\N	КММО-01-23	\N	\N	\N	\N	Прикладная математика и информатика	Магистратура	\N	БК 536 РТУ МИРЭА
4	Даша	Рыжик	Алексеевна	rizhick	["superuser"]	rishick.jpg	$2y$10$8GTX2fm/OZuQcc8R/m8Ss.zXY3FAw9XkzvL0uXelRdpIIAXVU9egq	+7(495)-777-11-22	ya.ru	unblock	\N	КММО-01-23	\N	\N	\N	\N	Прикладная математика и информатика	Магистратура	\N	БК 536 РТУ МИРЭА
5	Ангелина	Ахтямова	Максимовна	gealya	["superuser"]	gealya.svg	$2y$10$JcwoQ1t8Ae2xxEvc5u4k5.1MyqhZFkNWU43ANPuI82SOAU81exD/i	-	\N	unblock	\N	\N	\N	\N	\N	\N	Прикладная математика и информатика	\N	\N	БК 536 РТУ МИРЭА
6	Борисов	Николай	Константинович	boris	["student"]	borisov.png	$2y$10$JcwoQ1t8Ae2xxEvc5u4k5.1MyqhZFkNWU43ANPuI82SOAU81exD/i	-	\N	unblock	\N	\N	\N	\N	\N	\N	Прикладная математика и информатика	\N	\N	БК 536 РТУ МИРЭА
1	Программик	Айтишникович	-	root@vega.su	["superuser"]	someone.svg	$2y$10$JcwoQ1t8Ae2xxEvc5u4k5.1MyqhZFkNWU43ANPuI82SOAU81exD/i	-	root@vega.su	unblock	С++, JS, CSS	КММО-01-23	3	25K0012	искусственного интеллекта	2026	Прикладная математика и информатика	Магистратура	Я люблю работать над проектами, которые позволяют мне применять теорию на практике. В своей учебе я сосредоточен на разработке веб-приложений и изучении алгоритмов. Участвовал в нескольких хакатонах, где смог не только улучшить свои технические навыки, но и научиться работать в команде.\n\nКроме программирования, меня интересуют новые технологии, такие как искусственный интеллект и машинное обучение. Я всегда открыт для новых идей и возможностей сотрудничества, поэтому не стесняйтесь обращаться ко мне!\n\nВ свободное время я люблю читать книги по саморазвитию и смотреть научно-популярные фильмы. Я верю, что постоянное обучение и обмен опытом — ключ к успеху в этой быстро меняющейся области.	БК 536 РТУ МИРЭА
\.


--
-- TOC entry 4959 (class 0 OID 33394)
-- Dependencies: 223
-- Data for Name: info_user1; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.info_user1 (id, firstname, lastname, patronymic, login, password, roles, icons, hash, telephone, email) FROM stdin;
1	Рыжик	Дарья	Алексеевна	\N	\N	\N	\N	\N	\N	\N
2	Дугин	Иван	Андреевич	\N	\N	\N	\N	\N	\N	\N
3	Завьялов	Антон	Владимирович	\N	\N	\N	\N	\N	\N	\N
8	Салия	Лука	Мерабович	\N	\N	\N	\N	\N	\N	\N
10	Минеев	Сергей	Алексеевич	\N	\N	\N	\N	\N	\N	\N
4	Качалов	Сергей	Константинович	\N	\N	\N	\N	\N	\N	\N
5	Кодзасова	Дзерасса	Артуровна	\N	\N	\N	\N	\N	\N	\N
6	Волков	Артем	Владиславович	\N	\N	\N	\N	\N	\N	\N
7	Дрейфельд	Денис	Эрихович	\N	\N	\N	\N	\N	\N	\N
9	Ахтямова	Ангелина	Максимовна	\N	\N	\N	\N	\N	\N	\N
11	Кружков	Олег	Игорьевич	\N	\N	\N	\N	\N	\N	\N
0	root	toor	\N	user	1234	["admin", "teacher"]	\N	$2y$10$4OmM3VWuJbcyp0Zr.evSBuRCemWbxZkkfUPHpeZiTQXiVBNu37DdW	\N	\N
\.


--
-- TOC entry 4960 (class 0 OID 33399)
-- Dependencies: 224
-- Data for Name: info_vacancys; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.info_vacancys (id, description, rule, xperience) FROM stdin;
1	Требуется 	тестировщик	3
2	Требуется консультант по web	 консультант	1
3	Требуется	frontend-разработчик	2
4	Требуется 	дизайнер	1
5	Требуется 	тестировщик	1
6	Требуется консультант по web	 консультант	2
7	Требуется	frontend-разработчик	1
8	Требуется 	дизайнер	3
9	Требуется 	тестировщик	1
10	Требуется консультант по web	 консультант	1
0	Требуется 	дизайнер	1
\.


--
-- TOC entry 4972 (class 0 OID 41715)
-- Dependencies: 236
-- Data for Name: like_project; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.like_project (id, project_id, phpsessid) FROM stdin;
1	1	77e91dv2r7b53ir139sm1a5ku1
\.


--
-- TOC entry 4966 (class 0 OID 41632)
-- Dependencies: 230
-- Data for Name: projects; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.projects (id, name, premier, status, stack, communities, experts, tags, icon, duration, goal, appointment, refs, artefacts, achievements, participants, author, description) FROM stdin;
2	Сайт кафедры	\N	В архиве	\N	\N	\N	["Web-дизайн", "Backend", "Frontend", "Telegram_Bot", "Базы данных", "Тестирование_ПО", "Анализ_ПО"]	image-8.png	\N	\N	\N	\N	\N	\N	\N	1	"Русская Рулетка: Судьба на Кончиках Пальцев" — это захватывающая онлайн-игра, которая переносит классическую игру в русскую рулетку в виртуальный мир. Игроки могут испытать адреналин и напряжение, не выходя из дома, в безопасной и контролируемой среде. Игра сочетает в себе элементы стратегии, удачи и взаимодействия с другими игроками, создавая уникальный опыт.
3	Игра в русскую рулетку	\N	Отменён	\N	\N	\N	["Frontend", "Telegram Bot"]	image-6.png	\N	\N	\N	\N	\N	\N	\N	2	"Русская Рулетка: Судьба на Кончиках Пальцев" — это захватывающая онлайн-игра, которая переносит классическую игру в русскую рулетку в виртуальный мир. Игроки могут испытать адреналин и напряжение, не выходя из дома, в безопасной и контролируемой среде. Игра сочетает в себе элементы стратегии, удачи и взаимодействия с другими игроками, создавая уникальный опыт.
1	Интеллектуальный поиск	\N	Завершен	\N	\N	\N	["Frontend", "Backend", "Базы данных"]	image-5.png	\N	\N	\N	\N	\N	\N	\N	1	Интеллектуальный поиск — это инновационная система, позволяющая быстро и удобно находить документы из коллекции кафедры. С помощью продвинутых алгоритмов обработки естественного языка, система анализирует запросы пользователей и предоставляет наиболее релевантные результаты. Интуитивно понятный интерфейс и фильтры по категориям делают поиск простым и эффективным, а возможность сохранения и организации найденных материалов помогает в работе над проектами и исследованиями. Откройте для себя новые знания с "Интеллектуальным поиском"!
4	MindMosaic for Vega MIREA Mobile App	\N	В разработке	\N	\N	\N	"AI технологии"	image-3.png	\N	\N	\N	\N	\N	\N	\N	2	MindMosaic — это инновационная платформа на основе искусственного интеллекта, предназначенная для создания и управления персонализированными образовательными маршрутами. Проект ориентирован на студентов, профессионалов и всех желающих углубить свои знания в различных областях.
5	Дата-Шар	\N	Идёт набор	\N	\N	\N	["Data science", "Базы данных"]	image-7.png	\N	\N	\N	\N	\N	\N	\N	3	Мощная и интуитивно понятная платформа для управления и анализа данных, предназначенная для бизнеса, исследователей и разработчиков. Проект предоставляет инструменты для эффективной работы с большими объемами информации, обеспечивая легкий доступ к данным и их анализ.
\.


--
-- TOC entry 4970 (class 0 OID 41678)
-- Dependencies: 234
-- Data for Name: tags; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.tags (id, title) FROM stdin;
\.


--
-- TOC entry 4968 (class 0 OID 41668)
-- Dependencies: 232
-- Data for Name: vacancies; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.vacancies (id, name, description, duties, tags, "create", condidats, speciality, project_id, status, experience) FROM stdin;
2	\N	Создание дизайн-системы для коллекции проектов базовой кафедры	["Разработка и внедрение дизайн-системы, включая создание компонентов интерфейса, стилей и руководств по использованию.",\n"Проведение исследований пользователей и анализ их потребностей для создания удобного пользовательского опыта.",\n"Создание прототипов и макетов интерфейсов.",\n"Сотрудничество с разработчиками для обеспечения правильной реализации дизайн-системы.",\n"Проведение тестирования интерфейсов и сбор обратной связи.",\n"Участие в создании документации по использованию дизайн-системы."]	["UI/UX design", "Figma", "Photoshop", "Illustrator", "HTML", "CSS", "JS", "MS Office", "UX research"]	\N	\N	Web-дизайнер	\N	show	["Уверенное владение Figma", \n "Творческий взгляд на жизнь и креативность"]
1	\N	Автоматизация проведения лабораторных работ по программированию	["Участие в разработке архитектуры и функций системы автоматизации лабораторных работ.", \n"Проектирование и реализация компонентов системы, включая интерфейсы для студентов и преподавателей.",\n"Разработка алгоритмов автоматической проверки кода на различных языках программирования.",\n"Интеграция системы с внешними сервисами.",\n"Написание документации и проведение тестирования разработанных функций.",\n"Участие в код-ревью и обмене знаниями с командой.",\n"Поддержка и улучшение существующих функций системы на основе отзывов пользователей."]	["C++", "HTML", "CSS", "JS"]	\N	\N	Программист С++	\N	show	\N
5	\N	Создание интеллектуальной системы рекомендаций на основе методов машинного обучения	["Сбор данных о пользователях и их взаимодействиях с продуктами.Очистка и предобработка данных.",\n"Выбор и создание признаков, которые могут повлиять на рекомендации. Применение методов отбора признаков для улучшения качества модели.",\n"Исследование различных алгоритмов для построения системы рекомендаций.",\n"Разделение данных на обучающую и тестовую выборки.Обучение выбранных моделей на обучающей выборке и настройка гиперпараметров.",\n"Проведение кросс-валидации для более надежной оценки производительности модели.",\n"Создание прототипа пользовательского интерфейса для отображения рекомендаций. Интеграция модели в веб-приложение."]	["OpenAI", "JS"]	\N	\N	AI разработчик	\N	show	\N
3	\N	Автоматизация быстрых ответов на часто задаваемые вопросы от студентов кафедры	["Разработка и внедрение Telegram-бота для автоматизации ответов на часто задаваемые вопросы.","Создание структуры базы данных для хранения вопросов и ответов, а также интеграция с существующими системами (если необходимо).","Реализация функций обработки запросов пользователей и предоставления им актуальной информации.","Проведение тестирования бота и исправление ошибок на основе полученной обратной связи."]	["Python","SQL","Telegram Bot"]	\N	\N	Разработчик Telegram-ботов c интеграцией в канал кафедры	1	show	\N
4	\N	Разработка модели предсказания оттока клиентов с использованием машинного обучения	["Сбор и очистка данных о клиентах.Проведение первичного анализа данных (EDA) для выявления закономерностей и аномалий.",\n"Выбор и создание значимых признаков для модели.Применение методов отбора признаков для уменьшения размерности и повышения качества модели.",\n"Разделение данных на обучающую и тестовую выборки.Обучение выбранных моделей на обучающей выборке и их настройка.",\n"Оценка качества модели на тестовой выборке с использованием выбранных метрик.Проведение кросс-валидации для более надежной оценки производительности модели.",\n"Подготовка визуализаций для представления результатов (графики важности признаков, ROC-кривые и т.д.).На основе полученных результатов разработать рекомендации по улучшению клиентского опыта и снижению оттока клиентов."]	["Spark"]	\N	\N	Data Scientist	\N	show	\N
6	\N	Разработка RESTful API для управления задачами с использованием микросервисной архитектуры	["Разработка архитектурной схемы приложения с учетом микросервисного подхода.",\n"Реализация CRUD-операций для основных сущностей через RESTful API. Обеспечение аутентификации и авторизации пользователей. Проектирование схемы базы данных.",\n"Написание юнит-тестов и интеграционных тестов для проверки функциональности API.",\n"Создание документации для API с использованием Swagger или Postman.",\n"Создание простого фронтенд-приложения для взаимодействия с API.Интеграция фронтенда с бэкендом через API.",\n"Настройка CI/CD процессов для автоматизации развертывания и тестирования."]	["Docker", "JWT", "PostgreSQL", "Postman"]	\N	\N	Backend Dev	\N	show	\N
\.


--
-- TOC entry 4990 (class 0 OID 0)
-- Dependencies: 237
-- Name: awesome_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.awesome_id_seq', 10, true);


--
-- TOC entry 4991 (class 0 OID 0)
-- Dependencies: 239
-- Name: groups_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.groups_id_seq', 7, true);


--
-- TOC entry 4992 (class 0 OID 0)
-- Dependencies: 228
-- Name: info_interests_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.info_interests_id_seq', 1, true);


--
-- TOC entry 4993 (class 0 OID 0)
-- Dependencies: 225
-- Name: info_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.info_user_id_seq', 11, true);


--
-- TOC entry 4994 (class 0 OID 0)
-- Dependencies: 235
-- Name: like_project_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.like_project_id_seq', 1, true);


--
-- TOC entry 4995 (class 0 OID 0)
-- Dependencies: 229
-- Name: projects_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.projects_id_seq', 5, true);


--
-- TOC entry 4996 (class 0 OID 0)
-- Dependencies: 233
-- Name: tags_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.tags_id_seq', 1, false);


--
-- TOC entry 4997 (class 0 OID 0)
-- Dependencies: 231
-- Name: vacancies_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.vacancies_id_seq', 6, true);


--
-- TOC entry 4804 (class 2606 OID 41741)
-- Name: awesome awesome_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.awesome
    ADD CONSTRAINT awesome_pkey PRIMARY KEY (id);


--
-- TOC entry 4806 (class 2606 OID 41760)
-- Name: groups groups_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.groups
    ADD CONSTRAINT groups_pkey PRIMARY KEY (id);


--
-- TOC entry 4776 (class 2606 OID 33405)
-- Name: info_achievements info_achievements_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.info_achievements
    ADD CONSTRAINT info_achievements_pkey PRIMARY KEY (id);


--
-- TOC entry 4778 (class 2606 OID 33407)
-- Name: info_artefacts info_artefacts_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.info_artefacts
    ADD CONSTRAINT info_artefacts_pkey PRIMARY KEY (id);


--
-- TOC entry 4794 (class 2606 OID 41623)
-- Name: info_interests info_interests_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.info_interests
    ADD CONSTRAINT info_interests_pkey PRIMARY KEY (id);


--
-- TOC entry 4780 (class 2606 OID 33409)
-- Name: info_project info_project_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.info_project
    ADD CONSTRAINT info_project_pkey PRIMARY KEY (id);


--
-- TOC entry 4782 (class 2606 OID 33411)
-- Name: info_roles info_roles_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.info_roles
    ADD CONSTRAINT info_roles_pkey PRIMARY KEY (id);


--
-- TOC entry 4784 (class 2606 OID 33413)
-- Name: info_tags info_tags_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.info_tags
    ADD CONSTRAINT info_tags_pkey PRIMARY KEY (id);


--
-- TOC entry 4786 (class 2606 OID 33415)
-- Name: info_unit_time info_unit_time_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.info_unit_time
    ADD CONSTRAINT info_unit_time_pkey PRIMARY KEY (id);


--
-- TOC entry 4788 (class 2606 OID 33417)
-- Name: info_user1 info_user_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.info_user1
    ADD CONSTRAINT info_user_pkey PRIMARY KEY (id);


--
-- TOC entry 4792 (class 2606 OID 33443)
-- Name: info_user info_user_pkey1; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.info_user
    ADD CONSTRAINT info_user_pkey1 PRIMARY KEY (id);


--
-- TOC entry 4790 (class 2606 OID 33419)
-- Name: info_vacancys info_vacancys_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.info_vacancys
    ADD CONSTRAINT info_vacancys_pkey PRIMARY KEY (id);


--
-- TOC entry 4802 (class 2606 OID 41722)
-- Name: like_project like_project_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.like_project
    ADD CONSTRAINT like_project_pkey PRIMARY KEY (id);


--
-- TOC entry 4796 (class 2606 OID 41639)
-- Name: projects projects_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.projects
    ADD CONSTRAINT projects_pkey PRIMARY KEY (id);


--
-- TOC entry 4800 (class 2606 OID 41685)
-- Name: tags tags_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.tags
    ADD CONSTRAINT tags_pkey PRIMARY KEY (id);


--
-- TOC entry 4798 (class 2606 OID 41675)
-- Name: vacancies vacancies_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.vacancies
    ADD CONSTRAINT vacancies_pkey PRIMARY KEY (id);


--
-- TOC entry 4952 (class 0 OID 33399)
-- Dependencies: 224
-- Name: info_vacancys; Type: ROW SECURITY; Schema: public; Owner: postgres
--

ALTER TABLE public.info_vacancys ENABLE ROW LEVEL SECURITY;

-- Completed on 2025-01-27 14:47:02

--
-- PostgreSQL database dump complete
--

