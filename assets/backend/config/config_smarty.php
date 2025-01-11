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
                                <img style="margin-left: 50px; background-color: gray; width: 200px; height: 200px; border-radius: 10px; "/>
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
                            <input hidden name="id" id="id" type="number" value='.$data['id'].'>
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

            for($i = 0; $i < 3; $i++){
                $html = $html.
                    '<div class="item" style="">
                    
                    </div>';
            }

            return $html;
        }

        return $html;
    }


    // {query_our_vacancies}

    $smarty->registerPlugin("function", "query_vacancies", "psql_query_vacancies");
    function psql_query_vacancies($params, $smarty){
        enum Color: string {
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
        
        if(empty($params["for"])) {
            return '';
        }

        global $wdbc;

        $status = $wdbc ->query()
            ->select ('*')
            ->from   ('info_user')
            ->where('id', $_SESSION['id'])
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

    $smarty->assign("ACTION",   PAGE::ACT->value);      // Страница сервера для выхода;
    $smarty->assign("INDEX",    INDEX::PATH->value);    // Страница `index.php`;
    $smarty->assign("PROFILE",  PAGE::PFL->value);      // Страница `profile.php`;

    // $smarty->display("main.tpl");  // выводим обработанный шаблон
?>