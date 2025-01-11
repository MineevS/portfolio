<?php
    $root = $_SERVER['DOCUMENT_ROOT'];

    require_once($root.'/assets/backend/config/paths.php');

    define("SMARTY_DIR", $root.'/smarty-5.4.2/libs/');
        
    require_once(SMARTY_DIR.'Smarty.class.php');    // подключаем файл с описанием класса Smarty

    $smarty = new Smarty\Smarty; // создаем экземпляр класса Smarty

    //$smarty->setEscapeHtml(true);

    // указываем, где находятся Smarty-директории
    $smarty->setConfigDir  ($root.'/smarty_dirs/configs/');
    $smarty->setCacheDir   ($root.'/smarty_dirs/cache/');
    $smarty->setCompileDir ($root.'/smarty_dirs/templates_c/');
    $smarty->setTemplateDir($root.'/smarty_dirs/templates/');
    // $smarty->addPluginsDir ($root.'/smarty_dirs/plugins/'); // old

    //$smarty->caching = Smarty\Smarty::CACHING_LIFETIME_CURRENT;

    $smarty->registerPlugin("function", "date_now", "print_current_date");

    function print_current_date($params, $smarty){
        if(empty($params["format"])) {
            $format = "%b %e, %Y";
        } else {
            $format = $params["format"];
        }
        return time(); // strftime($format,time());
    }

    require_once($_SERVER['DOCUMENT_ROOT'].TOTAL::CDB->value);             // -> [$dbname, $host, $port, $user, $passwd]; -> './config/config_db.php'
    require_once($_SERVER['DOCUMENT_ROOT'].TOTAL::WDBC->value);             // -> WrapperDataBase(); -> './config/WrapperDataBaseConn.php' 

    $wdbc = new WDBC($dbname, $host, $port, $user, $passwd);

    $smarty->registerPlugin("function", "query_projects", "psql_query_projects");
    function psql_query_projects($params, $smarty){
        global $wdbc;

        $status = $wdbc ->query()
            ->select ($params['select'])
            ->from   ($params['from'])
            ->orderby($params['orderby'])
            ->limit  ($params['limit'])
            ->offset ($params['offset'])
        ->exec();

        if($status){
            $array_data = $wdbc->query()->responce(); // $wdbc->query()->responce() // value="<?= $cur_idx

            $html = '';
            foreach($array_data as $data){
                $html = $html.
                    '<form method="POST" action="/assets/frontend/pages/project.php" style=" width: 100%; height: fit-content;">
                        <button type="submit" style="display: flex; border: none; background-color: #F6F6F6; width: 100%; height: 100%;">
                            <div class="div-left" style="display: flex; justify-content: center; width: 10%; height: 100%; " > <!-- background-color: red;-->
                                <p style="align-self: start;">01<p>
                            </div>
                            <div class="div-right" style="width: 100%; padding: 10px; display:  flex; flex-direction: column; text-align: left; height: 100%;  border-left: 2px solid; border-color: black;"> <!-- background-color: green; -->
                                <h1>Название проекта</h1>
                                <img style="margin-left: 50px; background-color: gray; width: 10vw; height: 20vh; border-radius: 10px; "/>
                                <p style="align-self: flex-end;">Описание проекта</p>
                                <p>Запуск</p>
                                <div style="display: flex; align-items: center; gap: 10px; height: fit-content;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" color="#EA5657" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"></path>
                                    </svg>
                                    <p>12</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-right-text" viewBox="0 0 16 16">
                                        <path d="M2 1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h9.586a2 2 0 0 1 1.414.586l2 2V2a1 1 0 0 0-1-1zm12-1a2 2 0 0 1 2 2v12.793a.5.5 0 0 1-.854.353l-2.853-2.853a1 1 0 0 0-.707-.293H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z"></path>
                                        <path d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6m0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5"></path>
                                    </svg>
                                    <p>24</p>
                                </div>
                            </div>
                            <input hidden name="id" id="id" value='.$data['id'].'> <!-- type="submit"-->
                        </button>
                    </form>';
            }

            return $html;
        }
    }

    $smarty->registerPlugin("function", "query_interests", "psql_query_interests");
    function psql_query_interests($params, $smarty){
        $interests = array(
            'frontend' => array('PHP', 'JS', 'CSS'), 
            'backend' => array('C/C++', 'C#', 'Java', 'Python'));

            $html = "";
            while($element = current($interests)) {
                $key = key($interests);
                $array_value = $interests[$key];

                
                $value_html ="";
                foreach($array_value as $value){
                    $value_html = $value_html.'<p>'.$value.'</p>';
                }

                $html = $html.
                '<form method="POST" action="/assets/frontend/pages/project.php" style=" width: 100%; height: fit-content;" class=" interestsForm">
                <button type="submit" style=" appearance: none;" class="interestsSubmitButton">
                    <div class="buttonTitle">
                       <span style="display: inline-flex; width: 25px;">//</span>'.$key.'</h1>
                    </div>
                    <div class="buttonTags">'.$value_html.'
                        <svg  xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"></path>
                        </svg>
                    </div>
                </button>
                </form>';


                /*$html = $html.
                '<form method="POST" action="/assets/frontend/pages/project.php" style=" width: 100%; height: fit-content;">
                    <button type="submit" style=" appearance: none; border: none; width: 100%; height: 100%;">
                        <div style="display: flex; align-items: center; text-align: center; justify-content: space-between; width: 100%; height: 100%; " > <!-- background-color: red;-->
                            <div style="width: 100%; justify-self: flex-start; display: flex; gap: 1%;">
                                <p >//</p>
                                <p>'.$key.'</p>
                            </div>
                            <div style=" width: 100%;  align-items: center; display: flex; justify-content: flex-end; margin-left: auto; gap: 5%;" >
                                '.$value_html.'
                                <svg  xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"></path>
                                </svg>
                            </div>
                        </div>
                        <input hidden name="id" id="id" type="number" value="1">
                    </button>
                </form>';*/

                next($interests);
            }

        return $html;
    }

    $smarty->registerPlugin("function", "query_stars", "psql_query_stars");
    function psql_query_stars($params, $smarty){

        global $wdbc;

    /*require_once($_SERVER['DOCUMENT_ROOT'].TOTAL::CDB->value);             //-> [$dbname, $host, $port, $user, $passwd]; -> './config/config_db.php'
    require_once($_SERVER['DOCUMENT_ROOT'].TOTAL::WDBC->value);             // -> WrapperDataBase(); -> './config/WrapperDataBaseConn.php' 

    $wdbc = new WDBC($dbname, $host, $port, $user, $passwd);
    */
        /*$status = $wdbc ->query()
            ->select ($params['select'])
            ->from   ($params['from'])
            ->orderby($params['orderby'])
            ->limit  ($params['limit'])
        ->exec();*/

        $status = true;

        $html = '';
        if($status){
            $array_data = $wdbc->query()->responce(); // $wdbc->query()->responce() // value="<?= $cur_idx

            
            /*foreach($array_data as $data){
                $html = $html.
                    '<div class="item" style="">
                    
                    </div>';
            }*/

            for($i = 0; $i < $params['limit']; $i++){
                $html = $html.
                    '<div class="item-of-stars" style="display: block;"> <!-- none / block -->
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 470" fill="currentColor" style="display:block; width:100%">
                            <path d="M112.608 466.549c-12.038 6.175-25.698-4.647-23.266-18.463l25.886-147.517L5.355 195.904c-10.26-9.793-4.928-27.694 8.826-29.628l152.756-21.706L235.05 9.622c6.144-12.163 22.767-12.163 28.91 0l68.114 134.948 152.756 21.706c13.754 1.934 19.087 19.835 8.795 29.628L383.783 300.57l25.885 147.517c2.433 13.816-11.227 24.638-23.265 18.463l-136.944-70.36-136.882 70.36h.031z"/>
                            <ellipse stroke="red" stroke-width="4" ry="120.22" rx="117" cy="262.22" cx="246"/>
                            <path fill="none" d="M262 380h10c1 0 2.027.23 3 0 2.176-.514 3-1 4-1s2-1 5-1c1 0 2-1 3-1s2.027.23 3 0c2.176-.514 3-1 5-1 1 0 2-1 3-1 2 0 4.293-.293 5-1a9.233 9.233 0 0 1 3-2c.924-.383 2.076.383 3 0 1.307-.541 2.186-.693 4-2 1.147-.827 2-1 3-1s2.076-.617 3-1c1.307-.541 1.824-2.486 4-3 1.946-.46 2.693-1.459 4-2 .924-.383 2.293-.293 3-1 .707-.707.293-1.293 1-2 .707-.707 2.15-.474 3-1 1.902-1.176 2.186-2.693 4-4 1.147-.827 1.293-1.293 2-2 .707-.707 1.076-.617 2-1 1.307-.541 1.293-1.293 2-2 .707-.707 1.459-.693 2-2 .383-.924 1.293-.293 2-1 .707-.707 1.293-2.293 2-3 .707-.707 1.293-.293 2-1 .707-.707.293-1.293 1-2 .707-.707 1.293-.293 2-1 .707-.707.459-1.693 1-3 .383-.924.293-1.293 1-2 .707-.707 1.293-.293 2-1 .707-.707.459-1.693 1-3 .383-.924 1.486-.824 2-3 .23-.973.293-1.293 1-2 .707-.707 1-1 1-2l2-2M140 207c0-1 1.77-3.027 2-4 .514-2.176-.072-5.611 2-8 1.465-1.69 2.293-2.293 3-3 .707-.707 1.419-.419 3-2s1.853-3.173 3-4c1.814-1.307 3.419-3.419 5-5s1-3 2-4c2-2 2.293-3.293 3-4l2-2c1-1 1.693-2.186 3-4 .827-1.147 1.186-1.693 3-3 1.147-.827 1.77-3.027 2-4 .514-2.176 1.693-3.186 3-5 .827-1.147 2.459-1.693 3-3 .383-.924.293-2.293 1-3 .707-.707 2.293-.293 3-1 .707-.707.853-2.173 2-3 1.814-1.307 2.853-2.173 4-3 1.814-1.307 3.293-2.293 4-3 .707-.707 2 0 3-1s3.293-1.293 4-2c.707-.707 2.293.707 3 0 .707-.707 1-1 2-1h2" stroke-width="4" stroke="red"/>
                            <path fill="none" d="M142 194c0 1-.293 1.293-1 2-.707.707-.459 1.693-1 3-.383.924-.459 3.693-1 5-.383.924-1 2-1 3s-1 2-1 3-.459 1.693-1 3c-.765 1.848-.459 2.693-1 4-.765 1.848-1 4-1 5s-.459 1.693-1 3c-.383.924 0 2 0 3s-.459 1.693-1 3c-.383.924 0 2-1 3s-1.486 2.824-2 5c-.23.973-1 2-1 3s-.173 1.853-1 3c-1.307 1.814-.235 3.152-1 5-.541 1.307-1 2-1 3v6c0 1-1 2-1 3v21c0 2 1 3 1 5 0 1 1.459 1.693 2 3 .765 1.848-.46 3.054 0 5 .514 2.176 1 3 1 5 0 1-.23 4.027 0 5 .514 2.176 1 4 1 5v7c0 1 .54 2.054 1 4 .514 2.176 1 3 1 4s1 2 1 4c0 1 .459 1.693 1 3 .383.924 2 3 2 5 0 1 .293 2.293 1 3 .707.707 1.918 1.387 3 4 .383.924.459 1.693 1 3 .383.924-.051 1.299 1 3 1.176 1.902 3 3 4 4 2 2 3.415 4.189 4 5 1.849 2.565 6.889 4.194 12 7 3.92 2.152 6.797 4.256 8 5 2.69 1.663 6.868 2.289 11 4 2.922 1.21 4.647 2.973 9 4 3.893.919 7 1 11 1h25c1 0 2 1 4 1 1 0 3.022-.367 6 0 4.092.504 5.693 1.459 7 2 1.848.765 6.938.498 13 1 3.986.33 6 0 7 0s3.039-.48 6 0c3.121.507 7 1 9 1h16c1 0 2.076.383 3 0 1.307-.541 3.15-.474 4-1 1.902-1.176 2.693-2.459 4-3 .924-.383.419-1.419 2-3s4-2 5-3l4-4c1-1 1.076-1.617 2-2 1.307-.541 3-4 5-5s4.076-2.617 5-3c1.307-.541 1.293-1.293 2-2 .707-.707 1.076-.617 2-1 1.307-.541 1.853-1.173 3-2 1.814-1.307 3.076-2.617 4-3a9.233 9.233 0 0 0 3-2c.707-.707.293-2.293 1-3 .707-.707 1-1 2-1s.293-1.293 1-2c.707-.707 1.459-.693 2-2 .383-.924 2-2 2-3v-1M364 322v-3c0-1 .293-1.293 1-2 .707-.707-.707-2.293 0-3 .707-.707 1.459-.693 2-2 1.148-2.772.235-4.152 1-6 .541-1.307 1-2 1-3 0-2 1.486-3.824 2-6 .46-1.946-.148-4.228 1-7 .541-1.307.235-2.152 1-4 .541-1.307 2-4 2-5s.459-1.693 1-3c.765-1.848 0-3 0-4v-35c0-1-.617-3.076-1-4-.541-1.307-1.493-2.879-2-6-.32-1.974-.42-5.086-1-7-1.045-3.45-2.52-5.039-3-8-.507-3.121-2.459-3.693-3-5-.383-.924 0-2-1-3l-3-3c-1-1-2-3-4-5-1-1-1-3-2-4s-.293-2.293-1-3l-2-2c-1-1-.419-2.419-2-4l-3-3c-1-1-3.853-4.173-5-5-1.814-1.307-2-2-3-3s-1-2-2-2-1.293-1.293-2-2c-.707-.707-3-1-5-2s-3-2-5-3-4.293-.293-5-1c-.707-.707-.293-1.293-1-2-.707-.707-1.054-.54-3-1-2.176-.514-6.31-3.337-9-5-1.203-.744-1-2-2-2h-3c-1 0-1.293-.293-2-1-.707-.707-1-1-2-1s-1-1-2-1h-1v-1h-1" stroke-width="4" stroke="red"/>
                        </svg>
                    </div>';
            }

            return $html;
        }

        return $html;
    }


    // {query_our_vacancies}

    enum Color : string {
        case Red = '#FF0000';
        case Green = '#00FF00';
        case Blue = '#0000FF';
        public function hex(): string {
            return $this->value;
        }
        public function rgb(): array {
            return sscanf($this->value, '#%02x%02x%02x');
        }
        public static function random(): self {
            return self::cases()[array_rand(self::cases())];
        }
    }

    $smarty->registerPlugin("function", "query_vacancies", "psql_query_vacancies");
    function psql_query_vacancies($params, $smarty){

        $html = "";

            /*$html = "";
            while($element = current($interests)) {
                $key = key($interests);
                $array_value = $interests[$key];

                $value_html = "";
                foreach($array_value as $value){
                    $value_html = $value_html.'<p>'.$value.'</p>';
                }

                

                $html = $html.
                '<div class="card" style="background-color: red; width: 100%; height: 250px;">
                
                </div>';

                next($interests);
            }*/

            $max = 4;
            for($i = 0; $i < $max; $i++){
                $style = '';

                // $style = 'background-color: '.Color::random()->hex().';';

                $style = $style.($i % 2 == 0 && ($i == $max - 1) 
                    ? 'width:  50%;  grid-column: 1 / span 2; '
                    : 'width: 100%; ');

                $html = $html.
                '<div class="card" style="'.$style.' height: fit-content; padding: 10px; border: 1px solid gray;">
                    <div style="display: flex; align-items: center; justify-content: space-between; width: 100%; height: 50px;">
                        <p>ТЕСТИРОВЩИК</p>
                        <button type="button" style="">Откликнуться</button>
                    </div>
                        <p>Автоматизация проведения лабораторных работ по программированию</p>
                    <p>Обязанности:</p>
                        <ul>
                            <li>Участие в разработке архитектуры и функций системы автоматизации лабораторных работ.</li>
                            <li>Проектирование и реализация компонентов системы, включая интерфейсы для студентов и преподавателей.</li>
                            <li>Разработка алгоритмов автоматической проверки кода на различных языках программирования.</li>
                            <li>Проектирование и реализация компонентов системы, включая интерфейсы для студентов и преподавателей.</li>
                            <li>Разработка алгоритмов автоматической проверки кода на различных языках программирования.</li>
                            <li>Интеграция системы с внешними сервисами.</li>
                            <li>Написание документации и проведение тестирования разработанных функций.</li>
                            <li>Участие в код-ревью и обмене знаниями с командой.</li>
                            <li>Поддержка и улучшение существующих функций системы на основе отзывов пользователей.</li>
                        </ul>
                </div>';
            }


        return $html;
    }

    $smarty->registerPlugin("function", "query_intelligence", "psql_query_intelligence");
    function psql_query_intelligence($params, $smarty){
        
        if(empty($params["for"])) return '';

        global $wdbc;

        $status = $wdbc ->query()
            ->select ('*')
            ->from   ('info_user')
            ->where  ('id', $_SESSION['id'])
        ->exec();

        if($status){
            $array_data = $wdbc->query()->responce(); // $wdbc->query()->responce() // value="<?= $cur_idx

            $html = '';
            foreach($array_data as $data){
                switch($params["for"]){
                    case 'properties':
                        $html =  $html.'
                        <string>Группа:                    <input id="group"                value="'.$data['group'].'"                  readonly /></string>                                       
                        <string>Курс:                      <input id="course"               value="'.$data['course'].'"                 readonly /></string>                         
                        <string>Шифр:                      <input id="cipher"               value="'.$data['cipher'].'"                 readonly /></string>
                        <string>Навыки:                    <input id="skills"               value="'.$data['skills'].'"                 readonly /></string>  
                        <string>Институт:                  <input id="institute"            value="'.$data['institute'].'"              readonly /></string>
                        <string>Год приёма:                <input id="year_start"           value="'.$data['year_start'].'"             readonly /></string>   
                        <string>Специальность:             <input id="specialization"       value="'.$data['specialization'].'"         readonly /></string>                <!-- (Направление) -->
                        <string>Образовательная программа: <input id="educational_program"  value="'.$data['educational_program'].'"    readonly /></string>';
                        break;
                    case 'about':
                        $html = $html.'<input id="about" value="'.$data['about'].'" readonly />';
                        break;
                }
            }
        }

        return $html;
    }

    

    $smarty->registerPlugin("function", "query_properties_project", "psql_query_properties_project");
    function psql_query_properties_project($params, $smarty){
        
        /*if(empty($params["for"])) return '';

        global $wdbc;

        $status = $wdbc ->query()
            ->select ('*')
            ->from   ('info_user')
            ->where  ('id', $_SESSION['id'])
        ->exec();*/
        $html = '';

        $html =  $html.'
            <string>Дата выхода:                    <input id="date-preview"            value=""    readonly /></string>                                       
            <string>Статус:                         <input id="status"                  value=""    readonly /></string>                         
            <string>Стек:                           <input id="stack"                   value=""    readonly /></string>
            <string>Оценка сообщества:              <input id="scores_communities"      value=""    readonly /></string>  
            <string>Оценка знатаков:                <input id="scores_experts"          value=""    readonly /></string>
            <string>Популярные теги проекта:        <input id="populars_tags"           value=""    readonly /></string>';

        /*if($status){
            $array_data = $wdbc->query()->responce(); // $wdbc->query()->responce() // value="<?= $cur_idx

            $html = '';
            foreach($array_data as $data){
                switch($params["for"]){
                    case 'properties':
                        $html =  $html.'
                        <string>Группа:                    <input id="group"                value="'.$data['group'].'"                  readonly /></string>                                       
                        <string>Курс:                      <input id="course"               value="'.$data['course'].'"                 readonly /></string>                         
                        <string>Шифр:                      <input id="cipher"               value="'.$data['cipher'].'"                 readonly /></string>
                        <string>Навыки:                    <input id="skills"               value="'.$data['skills'].'"                 readonly /></string>  
                        <string>Институт:                  <input id="institute"            value="'.$data['institute'].'"              readonly /></string>
                        <string>Год приёма:                <input id="year_start"           value="'.$data['year_start'].'"             readonly /></string>   
                        <string>Специальность:             <input id="specialization"       value="'.$data['specialization'].'"         readonly /></string>                <!-- (Направление) -->
                        <string>Образовательная программа: <input id="educational_program"  value="'.$data['educational_program'].'"    readonly /></string>';
                        break;
                    case 'about':
                        $html = $html.'<input id="about" value="'.$data['about'].'" readonly />';
                        break;
                }
            }
        }*/

        return $html;
    }

    
    $smarty->registerPlugin("function", "query_authors", "psql_query_authors");
    function psql_query_authors($params, $smarty){
        $html = '';

        // TODO:

        return $html;
    }

    $smarty->registerPlugin("function", "query_teams", "psql_query_teams");
    function psql_query_teams($params, $smarty){
        
        global $wdbc;

    /*require_once($_SERVER['DOCUMENT_ROOT'].TOTAL::CDB->value);             //-> [$dbname, $host, $port, $user, $passwd]; -> './config/config_db.php'
    require_once($_SERVER['DOCUMENT_ROOT'].TOTAL::WDBC->value);             // -> WrapperDataBase(); -> './config/WrapperDataBaseConn.php' 

    $wdbc = new WDBC($dbname, $host, $port, $user, $passwd);
    */
        /*$status = $wdbc ->query()
            ->select ($params['select'])
            ->from   ($params['from'])
            ->orderby($params['orderby'])
            ->limit  ($params['limit'])
        ->exec();*/

        $status = true;

        $html = '';
        if($status){
            $array_data = $wdbc->query()->responce(); // $wdbc->query()->responce() // value="<?= $cur_idx

            
            /*foreach($array_data as $data){
                $html = $html.
                    '<div class="item" style="">
                    
                    </div>';
            }*/

            for($i = 0; $i < 1; $i++){
                $html = $html.
                    '<div class="item-of-teams" style="display: block; "> <!-- none / block -->

                    </div>';
            }

            return $html;
        }

        return $html;
    }

    $smarty->registerPlugin("function", "query_feedback", "psql_query_feedback");
    function psql_query_feedback($params, $smarty){
        
        global $wdbc;

    /*require_once($_SERVER['DOCUMENT_ROOT'].TOTAL::CDB->value);             //-> [$dbname, $host, $port, $user, $passwd]; -> './config/config_db.php'
    require_once($_SERVER['DOCUMENT_ROOT'].TOTAL::WDBC->value);             // -> WrapperDataBase(); -> './config/WrapperDataBaseConn.php' 

    $wdbc = new WDBC($dbname, $host, $port, $user, $passwd);
    */
        /*$status = $wdbc ->query()
            ->select ($params['select'])
            ->from   ($params['from'])
            ->orderby($params['orderby'])
            ->limit  ($params['limit'])
        ->exec();*/

        $status = true;

        $html = '';
        if($status){
            $array_data = $wdbc->query()->responce(); // $wdbc->query()->responce() // value="<?= $cur_idx

            
            /*foreach($array_data as $data){
                $html = $html.
                    '<div class="item" style="">
                    
                    </div>';
            }*/

            for($i = 0; $i < 1; $i++){
                $html = $html.
                    '<div class="item-of-feedback" style="display: block; "> <!-- none / block -->

                    </div>';
            }

            return $html;
        }

        return $html;
    }

    
    
    $smarty->registerPlugin("function", "query_screenshots", "psql_query_screenshots");
    function psql_query_screenshots($params, $smarty){
        
        global $wdbc;

    /*require_once($_SERVER['DOCUMENT_ROOT'].TOTAL::CDB->value);             //-> [$dbname, $host, $port, $user, $passwd]; -> './config/config_db.php'
    require_once($_SERVER['DOCUMENT_ROOT'].TOTAL::WDBC->value);             // -> WrapperDataBase(); -> './config/WrapperDataBaseConn.php' 

    $wdbc = new WDBC($dbname, $host, $port, $user, $passwd);
    */
        /*$status = $wdbc ->query()
            ->select ($params['select'])
            ->from   ($params['from'])
            ->orderby($params['orderby'])
            ->limit  ($params['limit'])
        ->exec();*/

        $status = true;

        $html = '';
        if($status){
            $array_data = $wdbc->query()->responce(); // $wdbc->query()->responce() // value="<?= $cur_idx

            
            /*foreach($array_data as $data){
                $html = $html.
                    '<div class="item" style="">
                    
                    </div>';
            }*/

            for($i = 0; $i < 1; $i++){
                $html = $html.
                    '<div class="item-of-screenshots" style="display: block; "> <!-- none / block -->

                    </div>';
            }

            return $html;
        }

        return $html;
    }

    // $smarty->testInstall(); 

    $smarty->assign("FCN", TOTAL::FCN->value); 
    $smarty->assign("CSS", INDEX::CSS->value);
    $smarty->assign("JSX", INDEX::JSX->value);
    $smarty->assign("JQR", TOTAL::JQR->value);
    $smarty->assign("HFR", AUTH::PATH->value);

    // $smarty->assign("name", 'Alex');
    
    $smarty->assign("PROJECTS",  NAV::PRJ->value);
    $smarty->assign("TEAMS",     NAV::TMS->value);
    $smarty->assign("VACANCIES", NAV::VAC->value);

    $smarty->assign("ACTION",   PAGE::ACT->value);      // Страница сервера для выхода; // Общение с сервером осуществляется по одной странице!
    $smarty->assign("INDEX",    INDEX::PATH->value);    // Страница `index.php`;
    $smarty->assign("PROFILE",  PAGE::PFL->value);      // Страница `profile.php`;

    // $smarty->display("main.tpl");  // выводим обработанный шаблон
?>