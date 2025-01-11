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

            for($i = 0; $i < 3; $i++){
                $html = $html.
                    '<div class="item" style="display: block; ">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 470" fill="currentColor" style="display:block; width:100%">
                            <path d="M112.608 466.549c-12.038 6.175-25.698-4.647-23.266-18.463l25.886-147.517L5.355 195.904c-10.26-9.793-4.928-27.694 8.826-29.628l152.756-21.706L235.05 9.622c6.144-12.163 22.767-12.163 28.91 0l68.114 134.948 152.756 21.706c13.754 1.934 19.087 19.835 8.795 29.628L383.783 300.57l25.885 147.517c2.433 13.816-11.227 24.638-23.265 18.463l-136.944-70.36-136.882 70.36h.031z"/>
                            <ellipse stroke="red" stroke-width="4" ry="120.22" rx="117" cy="262.22" cx="246"/>
                            <path fill="none" d="M262 380h10c1 0 2.027.23 3 0 2.176-.514 3-1 4-1s2-1 5-1c1 0 2-1 3-1s2.027.23 3 0c2.176-.514 3-1 5-1 1 0 2-1 3-1 2 0 4.293-.293 5-1a9.233 9.233 0 0 1 3-2c.924-.383 2.076.383 3 0 1.307-.541 2.186-.693 4-2 1.147-.827 2-1 3-1s2.076-.617 3-1c1.307-.541 1.824-2.486 4-3 1.946-.46 2.693-1.459 4-2 .924-.383 2.293-.293 3-1 .707-.707.293-1.293 1-2 .707-.707 2.15-.474 3-1 1.902-1.176 2.186-2.693 4-4 1.147-.827 1.293-1.293 2-2 .707-.707 1.076-.617 2-1 1.307-.541 1.293-1.293 2-2 .707-.707 1.459-.693 2-2 .383-.924 1.293-.293 2-1 .707-.707 1.293-2.293 2-3 .707-.707 1.293-.293 2-1 .707-.707.293-1.293 1-2 .707-.707 1.293-.293 2-1 .707-.707.459-1.693 1-3 .383-.924.293-1.293 1-2 .707-.707 1.293-.293 2-1 .707-.707.459-1.693 1-3 .383-.924 1.486-.824 2-3 .23-.973.293-1.293 1-2 .707-.707 1-1 1-2l2-2M140 207c0-1 1.77-3.027 2-4 .514-2.176-.072-5.611 2-8 1.465-1.69 2.293-2.293 3-3 .707-.707 1.419-.419 3-2s1.853-3.173 3-4c1.814-1.307 3.419-3.419 5-5s1-3 2-4c2-2 2.293-3.293 3-4l2-2c1-1 1.693-2.186 3-4 .827-1.147 1.186-1.693 3-3 1.147-.827 1.77-3.027 2-4 .514-2.176 1.693-3.186 3-5 .827-1.147 2.459-1.693 3-3 .383-.924.293-2.293 1-3 .707-.707 2.293-.293 3-1 .707-.707.853-2.173 2-3 1.814-1.307 2.853-2.173 4-3 1.814-1.307 3.293-2.293 4-3 .707-.707 2 0 3-1s3.293-1.293 4-2c.707-.707 2.293.707 3 0 .707-.707 1-1 2-1h2" stroke-width="4" stroke="red"/>
                            <path fill="none" d="M142 194c0 1-.293 1.293-1 2-.707.707-.459 1.693-1 3-.383.924-.459 3.693-1 5-.383.924-1 2-1 3s-1 2-1 3-.459 1.693-1 3c-.765 1.848-.459 2.693-1 4-.765 1.848-1 4-1 5s-.459 1.693-1 3c-.383.924 0 2 0 3s-.459 1.693-1 3c-.383.924 0 2-1 3s-1.486 2.824-2 5c-.23.973-1 2-1 3s-.173 1.853-1 3c-1.307 1.814-.235 3.152-1 5-.541 1.307-1 2-1 3v6c0 1-1 2-1 3v21c0 2 1 3 1 5 0 1 1.459 1.693 2 3 .765 1.848-.46 3.054 0 5 .514 2.176 1 3 1 5 0 1-.23 4.027 0 5 .514 2.176 1 4 1 5v7c0 1 .54 2.054 1 4 .514 2.176 1 3 1 4s1 2 1 4c0 1 .459 1.693 1 3 .383.924 2 3 2 5 0 1 .293 2.293 1 3 .707.707 1.918 1.387 3 4 .383.924.459 1.693 1 3 .383.924-.051 1.299 1 3 1.176 1.902 3 3 4 4 2 2 3.415 4.189 4 5 1.849 2.565 6.889 4.194 12 7 3.92 2.152 6.797 4.256 8 5 2.69 1.663 6.868 2.289 11 4 2.922 1.21 4.647 2.973 9 4 3.893.919 7 1 11 1h25c1 0 2 1 4 1 1 0 3.022-.367 6 0 4.092.504 5.693 1.459 7 2 1.848.765 6.938.498 13 1 3.986.33 6 0 7 0s3.039-.48 6 0c3.121.507 7 1 9 1h16c1 0 2.076.383 3 0 1.307-.541 3.15-.474 4-1 1.902-1.176 2.693-2.459 4-3 .924-.383.419-1.419 2-3s4-2 5-3l4-4c1-1 1.076-1.617 2-2 1.307-.541 3-4 5-5s4.076-2.617 5-3c1.307-.541 1.293-1.293 2-2 .707-.707 1.076-.617 2-1 1.307-.541 1.853-1.173 3-2 1.814-1.307 3.076-2.617 4-3a9.233 9.233 0 0 0 3-2c.707-.707.293-2.293 1-3 .707-.707 1-1 2-1s.293-1.293 1-2c.707-.707 1.459-.693 2-2 .383-.924 2-2 2-3v-1M364 322v-3c0-1 .293-1.293 1-2 .707-.707-.707-2.293 0-3 .707-.707 1.459-.693 2-2 1.148-2.772.235-4.152 1-6 .541-1.307 1-2 1-3 0-2 1.486-3.824 2-6 .46-1.946-.148-4.228 1-7 .541-1.307.235-2.152 1-4 .541-1.307 2-4 2-5s.459-1.693 1-3c.765-1.848 0-3 0-4v-35c0-1-.617-3.076-1-4-.541-1.307-1.493-2.879-2-6-.32-1.974-.42-5.086-1-7-1.045-3.45-2.52-5.039-3-8-.507-3.121-2.459-3.693-3-5-.383-.924 0-2-1-3l-3-3c-1-1-2-3-4-5-1-1-1-3-2-4s-.293-2.293-1-3l-2-2c-1-1-.419-2.419-2-4l-3-3c-1-1-3.853-4.173-5-5-1.814-1.307-2-2-3-3s-1-2-2-2-1.293-1.293-2-2c-.707-.707-3-1-5-2s-3-2-5-3-4.293-.293-5-1c-.707-.707-.293-1.293-1-2-.707-.707-1.054-.54-3-1-2.176-.514-6.31-3.337-9-5-1.203-.744-1-2-2-2h-3c-1 0-1.293-.293-2-1-.707-.707-1-1-2-1s-1-1-2-1h-1v-1h-1" stroke-width="4" stroke="red"/>
                        </svg>
                    </div>';
            }

            /*
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 465" fill="currentColor" class="bi bi-star-fill" style="display: block; width: 100%;"> <!-- height: 50vw; width="500.00000000000006" height="480"-->
            <g>
                <path d="m112.6083,466.54868c-12.03834,6.17511 -25.69843,-4.64693 -23.26581,-18.46295l25.88556,-147.51649l-109.87327,-104.66497c-10.26066,-9.79285 -4.92761,-27.69443 8.82604,-29.62805l152.75597,-21.70644l68.11332,-134.94796c6.14392,-12.16309 22.76682,-12.16309 28.91074,0l68.11332,134.94796l152.75597,21.70644c13.75365,1.93362 19.0867,19.8352 8.79485,29.62805l-109.84209,104.66497l25.88556,147.51649c2.43262,13.81603 -11.22747,24.63806 -23.26581,18.46295l-136.94395,-70.35881l-136.88158,70.35881l0.03119,0z" id="svg_1"></path>
                <ellipse stroke="#ff0000" stroke-width="4" ry="120.22019" rx="117" id="svg_7" cy="262.22019" cx="246"></ellipse>
                <path fill="none" d="m262,380c1,0 2,0 3,0c1,0 3,0 4,0c1,0 2,0 3,0c1,0 2.02676,0.22977 3,0c2.17624,-0.51373 3,-1 4,-1c1,0 2,-1 5,-1c1,0 2,-1 3,-1c1,0 2.02676,0.22977 3,0c2.17624,-0.51373 3,-1 5,-1c1,0 2,-1 3,-1c2,0 4.29291,-0.29291 5,-1c0.70709,-0.70709 1.69345,-1.4588 3,-2c0.92389,-0.38269 2.07611,0.38269 3,0c1.30655,-0.5412 2.186,-0.69254 4,-2c1.14728,-0.8269 2,-1 3,-1c1,0 2.07611,-0.61731 3,-1c1.30655,-0.5412 1.82376,-2.48627 4,-3c1.9465,-0.4595 2.69345,-1.4588 4,-2c0.92389,-0.38269 2.29291,-0.29291 3,-1c0.70709,-0.70709 0.29291,-1.29291 1,-2c0.70709,-0.70709 2.14935,-0.47427 3,-1c1.9021,-1.17557 2.186,-2.69254 4,-4c1.14728,-0.8269 1.29291,-1.29291 2,-2c0.70709,-0.70709 1.07611,-0.61731 2,-1c1.30655,-0.5412 1.29291,-1.29291 2,-2c0.70709,-0.70709 1.4588,-0.69345 2,-2c0.38269,-0.92389 1.29291,-0.29291 2,-1c0.70709,-0.70709 1.29291,-2.29291 2,-3c0.70709,-0.70709 1.29291,-0.29291 2,-1c0.70709,-0.70709 0.29291,-1.29291 1,-2c0.70709,-0.70709 1.29291,-0.29291 2,-1c0.70709,-0.70709 0.4588,-1.69345 1,-3c0.38269,-0.92389 0.29291,-1.29291 1,-2c0.70709,-0.70709 1.29291,-0.29291 2,-1c0.70709,-0.70709 0.4588,-1.69345 1,-3c0.38269,-0.92389 1.48627,-0.82376 2,-3c0.22977,-0.97324 0.29291,-1.29291 1,-2c0.70709,-0.70709 1,-1 1,-2l2,-2" id="svg_9" stroke-width="4" stroke="#ff0000"></path>
                <path fill="none" d="m140,207c0,-1 1.77025,-3.02675 2,-4c0.51375,-2.17625 -0.07193,-5.61104 2,-8c1.46507,-1.68924 2.29289,-2.29289 3,-3c0.70711,-0.70711 1.41885,-0.41885 3,-2c1.58115,-1.58115 1.85274,-3.1731 3,-4c1.814,-1.30745 3.41885,-3.41885 5,-5c1.58115,-1.58115 1,-3 2,-4c2,-2 2.29289,-3.29289 3,-4c0.70711,-0.70711 1,-1 2,-2c1,-1 1.69255,-2.186 3,-4c0.8269,-1.14726 1.186,-1.69255 3,-3c1.14726,-0.8269 1.77025,-3.02675 2,-4c0.51375,-2.17625 1.69255,-3.186 3,-5c0.8269,-1.14726 2.4588,-1.69344 3,-3c0.38269,-0.92387 0.29289,-2.29289 1,-3c0.70711,-0.70711 2.29289,-0.29289 3,-1c0.70711,-0.70711 0.85274,-2.1731 2,-3c1.814,-1.30745 2.85274,-2.1731 4,-3c1.814,-1.30745 3.29289,-2.29289 4,-3c0.70711,-0.70711 2,0 3,-1c1,-1 3.29289,-1.29289 4,-2c0.70711,-0.70711 2.29289,0.70711 3,0c0.70711,-0.70711 1,-1 2,-1l1,0l1,0" id="svg_10" stroke-width="4" stroke="#ff0000"></path>
                <path fill="none" d="m142,194c0,1 -0.29289,1.29289 -1,2c-0.70711,0.70711 -0.4588,1.69344 -1,3c-0.38269,0.92387 -0.4588,3.69344 -1,5c-0.38269,0.92387 -1,2 -1,3c0,1 -1,2 -1,3c0,1 -0.4588,1.69344 -1,3c-0.76537,1.84776 -0.4588,2.69344 -1,4c-0.76537,1.84776 -1,4 -1,5c0,1 -0.4588,1.69344 -1,3c-0.38269,0.92387 0,2 0,3c0,1 -0.4588,1.69344 -1,3c-0.38269,0.92387 0,2 -1,3c-1,1 -1.48625,2.82375 -2,5c-0.22975,0.97325 -1,2 -1,3c0,1 -0.1731,1.85274 -1,3c-1.30745,1.814 -0.23463,3.15224 -1,5c-0.5412,1.30656 -1,2 -1,3c0,1 0,2 0,3c0,1 0,2 0,3c0,1 -1,2 -1,3c0,1 0,2 0,3c0,2 0,3 0,5c0,1 0,3 0,5c0,2 0,4 0,5c0,1 0,2 0,3c0,2 1,3 1,5c0,1 1.4588,1.69345 2,3c0.76537,1.84775 -0.4595,3.0535 0,5c0.51374,2.17624 1,3 1,5c0,1 -0.22975,4.02676 0,5c0.51375,2.17624 1,4 1,5c0,2 0,3 0,4c0,1 0,2 0,3c0,1 0.5405,2.0535 1,4c0.51375,2.17624 1,3 1,4c0,1 1,2 1,4c0,1 0.4588,1.69345 1,3c0.38269,0.92389 2,3 2,5c0,1 0.29289,2.29291 1,3c0.70711,0.70709 1.9176,1.38687 3,4c0.38269,0.92389 0.4588,1.69345 1,3c0.38269,0.92389 -0.05147,1.29871 1,3c1.17557,1.9021 3,3 4,4c2,2 3.41528,4.18875 4,5c1.84901,2.56537 6.88855,4.19409 12,7c3.9203,2.15204 6.797,4.2565 8,5c2.68999,1.66251 6.86829,2.28857 11,4c2.92157,1.21014 4.64749,2.9725 9,4c3.89299,0.91901 7,1 11,1c5,0 10,0 14,0c3,0 5,0 7,0c1,0 2,0 4,0c1,0 2,1 4,1c1,0 3.02248,-0.36655 6,0c4.09221,0.50378 5.69344,1.4588 7,2c1.84776,0.76538 6.93796,0.49829 13,1c3.98636,0.32993 6,0 7,0c1,0 3.03873,-0.48056 6,0c3.12143,0.50653 7,1 9,1c2,0 3,0 6,0c2,0 5,0 7,0c1,0 2,0 3,0c1,0 2.07611,0.38269 3,0c1.30655,-0.5412 3.14935,-0.47427 4,-1c1.9021,-1.17557 2.69345,-2.4588 4,-3c0.92389,-0.38269 0.41885,-1.41885 2,-3c1.58115,-1.58115 4,-2 5,-3c1,-1 2,-2 4,-4c1,-1 1.07611,-1.61731 2,-2c1.30655,-0.5412 3,-4 5,-5c2,-1 4.07611,-2.61731 5,-3c1.30655,-0.5412 1.29291,-1.29291 2,-2c0.70709,-0.70709 1.07611,-0.61731 2,-1c1.30655,-0.5412 1.85272,-1.1731 3,-2c1.814,-1.30746 3.07611,-2.61731 4,-3c1.30655,-0.5412 2.29291,-1.29291 3,-2c0.70709,-0.70709 0.29291,-2.29291 1,-3c0.70709,-0.70709 1,-1 2,-1c1,0 0.29291,-1.29291 1,-2c0.70709,-0.70709 1.4588,-0.69345 2,-2c0.38269,-0.92389 2,-2 2,-3l0,-1" id="svg_12" stroke-width="4" stroke="#ff0000"></path>
                <path fill="none" d="m364,322c0,-1 0,-2 0,-3c0,-1 0.29291,-1.29291 1,-2c0.70709,-0.70709 -0.70709,-2.29291 0,-3c0.70709,-0.70709 1.4588,-0.69345 2,-2c1.14804,-2.77164 0.23462,-4.15225 1,-6c0.5412,-1.30655 1,-2 1,-3c0,-2 1.48627,-3.82376 2,-6c0.4595,-1.9465 -0.14804,-4.22836 1,-7c0.5412,-1.30655 0.23462,-2.15225 1,-4c0.5412,-1.30655 2,-4 2,-5c0,-1 0.4588,-1.69345 1,-3c0.76538,-1.84775 0,-3 0,-4c0,-1 0,-2 0,-3c0,-1 0,-2 0,-3c0,-2 0,-4 0,-6c0,-1 0,-2 0,-4c0,-2 0,-3 0,-4c0,-1 0,-2 0,-3c0,-2 0,-3 0,-4c0,-3 0,-5 0,-8c0,-1 -0.61731,-3.07613 -1,-4c-0.5412,-1.30656 -1.49347,-2.87856 -2,-6c-0.32037,-1.97418 -0.42044,-5.08582 -1,-7c-1.04483,-3.45085 -2.51944,-5.03874 -3,-8c-0.50653,-3.12144 -2.4588,-3.69344 -3,-5c-0.38269,-0.92387 0,-2 -1,-3c-1,-1 -2,-2 -3,-3c-1,-1 -2,-3 -4,-5c-1,-1 -1,-3 -2,-4c-1,-1 -0.29291,-2.29289 -1,-3c-0.70709,-0.70711 -1,-1 -2,-2c-1,-1 -0.41885,-2.41885 -2,-4c-1.58115,-1.58115 -2,-2 -3,-3c-1,-1 -3.85272,-4.1731 -5,-5c-1.814,-1.30745 -2,-2 -3,-3c-1,-1 -1,-2 -2,-2c-1,0 -1.29291,-1.29289 -2,-2c-0.70709,-0.70711 -3,-1 -5,-2c-2,-1 -3,-2 -5,-3c-2,-1 -4.29291,-0.29289 -5,-1c-0.70709,-0.70711 -0.29291,-1.29289 -1,-2c-0.70709,-0.70711 -1.0535,-0.5405 -3,-1c-2.17624,-0.51375 -6.31,-3.33749 -9,-5c-1.203,-0.7435 -1,-2 -2,-2c-1,0 -2,0 -3,0c-1,0 -1.29291,-0.29289 -2,-1c-0.70709,-0.70711 -1,-1 -2,-1c-1,0 -1,-1 -2,-1l-1,0l0,-1l-1,0" id="svg_13" stroke-width="4" stroke="#ff0000"></path>
            </g>
            </svg>
            
            */

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