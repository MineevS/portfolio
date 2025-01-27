--
-- PostgreSQL database dump
--

-- Dumped from database version 17.0
-- Dumped by pg_dump version 17.0

-- Started on 2025-01-14 13:24:52

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
-- TOC entry 4930 (class 0 OID 0)
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
    specialization text,
    educational_program text,
    about text
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
-- TOC entry 4931 (class 0 OID 0)
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
    tags text,
    icon text,
    duration bigint,
    goal text,
    appointment text,
    refs text,
    artefacts text,
    achievements text,
    vacancies text,
    participants text,
    author bigint,
    about text
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
-- TOC entry 4932 (class 0 OID 0)
-- Dependencies: 229
-- Name: projects_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.projects_id_seq OWNED BY public.projects.id;


--
-- TOC entry 4741 (class 2604 OID 41616)
-- Name: info_interests id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.info_interests ALTER COLUMN id SET DEFAULT nextval('public.info_interests_id_seq'::regclass);


--
-- TOC entry 4738 (class 2604 OID 33439)
-- Name: info_user id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.info_user ALTER COLUMN id SET DEFAULT nextval('public.info_user_id_seq'::regclass);


--
-- TOC entry 4742 (class 2604 OID 41635)
-- Name: projects id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.projects ALTER COLUMN id SET DEFAULT nextval('public.projects_id_seq'::regclass);


--
-- TOC entry 4911 (class 0 OID 33363)
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
-- TOC entry 4912 (class 0 OID 33368)
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
-- TOC entry 4921 (class 0 OID 41612)
-- Dependencies: 227
-- Data for Name: info_interests; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.info_interests (id, description, title) FROM stdin;
1	\N	frontend
\.


--
-- TOC entry 4913 (class 0 OID 33373)
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
-- TOC entry 4914 (class 0 OID 33379)
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
-- TOC entry 4915 (class 0 OID 33384)
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
-- TOC entry 4916 (class 0 OID 33389)
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
-- TOC entry 4920 (class 0 OID 33436)
-- Dependencies: 226
-- Data for Name: info_user; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.info_user (id, firstname, lastname, patronymic, login, roles, icon, hash, telephone, email, status, skills, "group", course, cipher, institute, year_start, specialization, educational_program, about) FROM stdin;
1	root	toor	-	root@vega.su	["superuser"]	default_avatar.jpg	$2y$10$JcwoQ1t8Ae2xxEvc5u4k5.1MyqhZFkNWU43ANPuI82SOAU81exD/i	-	root@vega.su	unblock	С++, JS, CSS	КММО-01-23	3	25K0012	искусственного интеллекта	2026	ПМИ	Магистр	Люблю мир!
4	root	toor	\N	root2@vega.su	\N	default_avatar_profile.jpg	$2y$10$bBSiZdIZnmjyzeMYYq5XpeUdoq4vaMu8lmSk1g8i7YB/oBXS1AIne	+7(495)-777-11-22	root@vega.su	block	\N	\N	\N	\N	\N	\N	\N	\N	\N
5	root	toor	\N	root3@vega.su	\N	default_avatar_profile.jpg	$2y$10$OLX/zu1L.n4gf/4nYiO7/.giQFJ0dE2z8F9n3AqXQK4D.pSrvEoBu	+7(495)-777-11-22	root@vega.su	block	\N	\N	\N	\N	\N	\N	\N	\N	\N
6	Сергей	МСА	\N	root12	\N	default_avatar_profile.jpg	$2y$10$8GTX2fm/OZuQcc8R/m8Ss.zXY3FAw9XkzvL0uXelRdpIIAXVU9egq	+7(495)-777-11-22	ya.ru	unblock	\N	\N	\N	\N	\N	\N	\N	\N	\N
\.


--
-- TOC entry 4917 (class 0 OID 33394)
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
-- TOC entry 4918 (class 0 OID 33399)
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
-- TOC entry 4924 (class 0 OID 41632)
-- Dependencies: 230
-- Data for Name: projects; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.projects (id, name, premier, status, stack, communities, experts, tags, icon, duration, goal, appointment, refs, artefacts, achievements, vacancies, participants, author, about) FROM stdin;
7	Новый проект 1	2025-01-14	Запуск	1	2	3	4	delete.jpg	\N	\N	\N	\N	\N	\N	\N	\N	1	\N
8	Новый проект 2	2025-01-20	Запуск	1	2	3	4	default_avatar_project.jpg	\N	\N	\N	\N	\N	\N	\N	\N	1	\N
\.


--
-- TOC entry 4933 (class 0 OID 0)
-- Dependencies: 228
-- Name: info_interests_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.info_interests_id_seq', 1, true);


--
-- TOC entry 4934 (class 0 OID 0)
-- Dependencies: 225
-- Name: info_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.info_user_id_seq', 6, true);


--
-- TOC entry 4935 (class 0 OID 0)
-- Dependencies: 229
-- Name: projects_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.projects_id_seq', 8, true);


--
-- TOC entry 4744 (class 2606 OID 33405)
-- Name: info_achievements info_achievements_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.info_achievements
    ADD CONSTRAINT info_achievements_pkey PRIMARY KEY (id);


--
-- TOC entry 4746 (class 2606 OID 33407)
-- Name: info_artefacts info_artefacts_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.info_artefacts
    ADD CONSTRAINT info_artefacts_pkey PRIMARY KEY (id);


--
-- TOC entry 4762 (class 2606 OID 41623)
-- Name: info_interests info_interests_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.info_interests
    ADD CONSTRAINT info_interests_pkey PRIMARY KEY (id);


--
-- TOC entry 4748 (class 2606 OID 33409)
-- Name: info_project info_project_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.info_project
    ADD CONSTRAINT info_project_pkey PRIMARY KEY (id);


--
-- TOC entry 4750 (class 2606 OID 33411)
-- Name: info_roles info_roles_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.info_roles
    ADD CONSTRAINT info_roles_pkey PRIMARY KEY (id);


--
-- TOC entry 4752 (class 2606 OID 33413)
-- Name: info_tags info_tags_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.info_tags
    ADD CONSTRAINT info_tags_pkey PRIMARY KEY (id);


--
-- TOC entry 4754 (class 2606 OID 33415)
-- Name: info_unit_time info_unit_time_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.info_unit_time
    ADD CONSTRAINT info_unit_time_pkey PRIMARY KEY (id);


--
-- TOC entry 4756 (class 2606 OID 33417)
-- Name: info_user1 info_user_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.info_user1
    ADD CONSTRAINT info_user_pkey PRIMARY KEY (id);


--
-- TOC entry 4760 (class 2606 OID 33443)
-- Name: info_user info_user_pkey1; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.info_user
    ADD CONSTRAINT info_user_pkey1 PRIMARY KEY (id);


--
-- TOC entry 4758 (class 2606 OID 33419)
-- Name: info_vacancys info_vacancys_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.info_vacancys
    ADD CONSTRAINT info_vacancys_pkey PRIMARY KEY (id);


--
-- TOC entry 4764 (class 2606 OID 41639)
-- Name: projects projects_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.projects
    ADD CONSTRAINT projects_pkey PRIMARY KEY (id);


--
-- TOC entry 4910 (class 0 OID 33399)
-- Dependencies: 224
-- Name: info_vacancys; Type: ROW SECURITY; Schema: public; Owner: postgres
--

ALTER TABLE public.info_vacancys ENABLE ROW LEVEL SECURITY;

-- Completed on 2025-01-14 13:24:52

--
-- PostgreSQL database dump complete
--

