<?php

/*
    Перед включением данного файла в проект необходимо инизиализировать систему, включив файл `paths.php`.
*/
function print_current_date($params, $smarty)
{
    if (empty($params["format"])) {
        $format = "%b %e, %Y";
    } else {
        $format = $params["format"];
    }
    return time(); // strftime($format,time());
}

function psql_query_projects($params, $smarty)
{
    global $wdbc;
    $query = $wdbc->query()
        ->select($params['select'])
        ->from($params['from']);

    if (isset($params['where']) && isset($params[$params['where']]))
        $query->where($params['where'], $params[$params['where']]);
    elseif (isset($params['where'])) // && !isset($params[$params['where']])
        $query->where($params['where']);


    if (isset($params['ilike'])) $query->ilike($params['ilike']);

    if (isset($params['orderby'])) $query->orderby($params['orderby']);

    if (isset($params['orderbytype']))
        $query->orderByType($params['orderbytype']);

    if (isset($params['limit']))
        $query->limit($params['limit']);

    if (isset($params['offset']))
        $query->offset($params['offset']);

    $for = '';
    if (isset($params['for']))
        $for = $params['for'];

    $include_right = true;
    $display = 'flex';
    switch ($for) {
        case 'profile':
            $include_right = false;
            $display = 'grid';
            break;
    }

    $status = $query->exec();
    // ->orderby($params['orderby'])
    // ->limit($params['limit'])
    // ->offset($params['offset'])
    //->exec();

    $html = '';
    if ($status) {
        $array_data = $wdbc->query()->responce(); // $wdbc->query()->responce() // value="<?= $cur_idx

        foreach ($array_data as $data) {
            $svg = '';
            $bgcolor  = 'background-color: ';
            $color = ' color: ';
            switch ($data['status']) {
                case 'Завершен':
                    $svg .= '
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="none" viewBox="0 0 17 17">
                        <path stroke="#0E7B43" stroke-linecap="round" d="M5 8.5 7.5 11 12 6.5m3 2a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0Z"/>
                    </svg>';
                    $bgcolor .= 'rgb(73 176 73 / 0.5)';
                    $color .= "green";
                    break;
                case 'В архиве':
                    $svg .= '
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="none" viewBox="0 0 17 17">
                        <path stroke="#858585" stroke-linecap="round" stroke-linejoin="round" d="M16 13.556c0 .383-.158.75-.44 1.02A1.53 1.53 0 0 1 14.5 15h-12a1.53 1.53 0 0 1-1.06-.423A1.418 1.418 0 0 1 1 13.556V3.444c0-.383.158-.75.44-1.02A1.53 1.53 0 0 1 2.5 2h3.75l1.5 2.167h6.75c.398 0 .78.152 1.06.423.282.27.44.638.44 1.021v7.945Z"/>
                    </svg>';
                    $bgcolor .= 'rgba(246, 246, 246, 0.6)';
                    $color .= "rgba(133, 133, 133, 1)";
                    break;
                case 'Отменён':
                    $svg .= '
                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" fill="none" viewBox="0 0 11 11">
                        <path stroke="#B61010" stroke-linecap="round" d="M.904.903 5.5 5.5m0 0 4.596 4.596M5.5 5.5 10.096.903M5.5 5.5.904 10.096"/>
                    </svg>';
                    $bgcolor .= 'rgba(255, 219, 222, 0.8)';
                    $color .= "rgba(182, 16, 16, 1)";
                    break;
                case 'В разработке':
                    $svg .= '
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="none" viewBox="0 0 17 17">
                        <path stroke="#9747FF" stroke-linecap="round" stroke-linejoin="round" d="m13 11 3-2.5L13 6M4 6 1 8.5 4 11m3 1.729 3.078-8.458"/>
                    </svg>';
                    $bgcolor .= 'rgba(227, 211, 248, 0.8)';
                    $color .= "rgba(151, 71, 255, 1)";
                    break;
                case 'Идёт набор':
                    $svg .= '
                    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="none" viewBox="0 0 17 17">
                        <path stroke="#36F" stroke-linecap="round" d="M8.5 9.571c2.393 0 4.333-1.918 4.333-4.285S10.893 1 8.5 1C6.107 1 4.167 2.919 4.167 5.286c0 2.367 1.94 4.285 4.333 4.285Zm0 0C4.91 9.571 2 12.45 2 16m6.5-6.429c3.59 0 6.5 2.879 6.5 6.429"/>
                    </svg>';
                    $bgcolor .= 'rgba(217, 228, 252, 0.5)';
                    $color .= "rgba(51, 102, 255, 1)";
                    break;
            }

            $bgcolor .= ";";
            $color .= ";";

            $tags  = json_decode($data['tags']);
            $html_tags = '';
            foreach ($tags as $tag) $html_tags .= '<p>#' . $tag . '</p>';

            $status_query = $wdbc->query() // Получение кол.во лайков на проект от всех `phpsessid`.
                ->select('count(*)')
                ->from(TABS_NAME::LIKE_PROJECT->value)
                ->where('project_id', $data['id'])
                ->groupby('id')
                ->exec();

            $res = $wdbc->query()->responce()[0]['count'];

            $count_like = ($res ? $res : '0');

            $status_query = $wdbc->query() // Проверка на `like` по проекту  и текущему `phpsessid`
                ->select('id')
                ->from(TABS_NAME::LIKE_PROJECT->value)
                ->where('project_id', $data['id'], OPBIN::AND, 'phpsessid', session_id())
                ->groupby('id')
                ->exec();

            $svg_color = '#fff'; // Нет лайка `по умолчанию`;
            $svg_stroke = '#202020';
            $responce = $wdbc->query()->responce();
            if ($status_query && count($responce) > 0) {
                $svg_color = '#EA5657';
                $svg_stroke = '#fff';
            }

            $html .= '
            <form class="formProject" method="POST" action="/assets/frontend/pages/project.php" style="display: ' . $display . '">
                <div class="div-left" > <!-- background-color: red;-->
                    <img src="/assets/frontend/icons/avatars_projects/' . $data['icon'] . '" class="image-2" alt="image" />
                    <div class="statusProject" style="' . $bgcolor . '">
                        ' . $svg . '
                        <p class="projectStatus" style="' . $color . '">' . $data['status'] . '</p>
                    </div>
                </div>';

            if ($include_right)
                $html .=  '<div class="div-right" > <!-- background-color: green; -->
                    <h1 class="projectTitle" id="projectTitle">' . $data["name"] . '</h1> 
                    <p class="projectBody" >' . $data['description'] . '</p>
                    <div class="tags">
                    ' . $html_tags . '
                    </div>
                    <div class="projectLikeComms">
                        <div style="display: flex; flex-direction: row; align-items: center;">
                            <div style="margin-right: 1rem;">
                                <svg id="like-' . $data['id'] . '"  onclick="like(' . $data['id'] . ', \'' . $smarty->getTemplateVars('ACTION') . '\')" stroke="' . $svg_stroke . '" color="' . $svg_color . '" xmlns="http://www.w3.org/2000/svg" width="16" height="16" >
                                    <path stroke-linejoin="round" fill="currentColor" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314"></path>
                                </svg>
                                <small class="contentProperty" id="likee-' . $data['id'] . '">' . $count_like . '</small>
                            </div>
                            <div style="margin-right: 1rem;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-right-text" viewBox="0 0 16 16">
                                    <path d="M2 1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h9.586a2 2 0 0 1 1.414.586l2 2V2a1 1 0 0 0-1-1zm12-1a2 2 0 0 1 2 2v12.793a.5.5 0 0 1-.854.353l-2.853-2.853a1 1 0 0 0-.707-.293H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z"></path>
                                    <path d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6m0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5"></path>
                                </svg>
                                <small class="contentProperty" id="feedback">24</small>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24">
                                    <path stroke="#202020" stroke-linecap="round" d="M12 13.513c3.379 0 6.118-2.709 6.118-6.05 0-3.342-2.74-6.05-6.118-6.05-3.379 0-6.118 2.708-6.118 6.05 0 3.341 2.74 6.05 6.118 6.05Zm0 0c-5.068 0-9.176 4.063-9.176 9.076M12 13.513c5.068 0 9.177 4.063 9.177 9.076"/>
                                </svg>
                                <small class="contentProperty" id="participants">24</small>
                            </div>
                        </div>
                        <button class="buttonRef"><input type="hidden" name="id" id="id" value=' . $data['id'] . '>Подробнее →</button>
                    </div>
                </div>';

            $html .= '</form>';
        }
    }

    return $html;
}

function psql_query_interests($params, $smarty)
{
    $interests = array(
        'Frontend'      => array('PHP', 'JS', 'CSS'),
        'Backend'       => array('C/C++', 'C#', 'Java', 'Python'),
        'DevOps'        => array('Gitlab', 'Docker'),
        'Web-дизайн'    => array('Figma'),
        'Data Science'  => array('Spark'),
        'AI технологии' => array('OpenAI', 'Azure'),
        'Базы данных'   => array('PostgreSQL', 'MongoDB'),
        'Боты'          => array('Telegram Bot')
    );

    $html = "";
    while ($element = current($interests)) {
        $key = key($interests);
        $array_value = $interests[$key];

        $value_html = "";
        foreach ($array_value as $value) {
            $value_html = $value_html . '<p>' . $value . '</p>';
        }

        $html .=
            '<form class="interestsSubmitButton" method="POST" action="' . $smarty->getTemplateVars('PAGE_INTERESTS') . '" class=" interestsForm">
                <div class="buttonTitle">
                    <span style="display: inline-flex; width: 25px;">//</span>' . $key . '</h1>
                </div>
                <button type="submit" style="all: unset; cursor: pointer;" >
                    <div class="buttonTags">' . $value_html . '
                        <svg  xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"></path>
                        </svg>
                    </div>
                </button>
            </form>';

        next($interests);
    }

    $html .=
        '<form class="interestsSubmitButton" method="POST" action="' . $smarty->getTemplateVars('PAGE_INTERESTS') . '" style="background: #EA5657; border-radius: 0 0 25px 25px; width: 100%;" class=" interestsForm">
        <div class="buttonTitle">
            <span style="display: inline-flex; width: 25px;">//</span> И многие другие </h1>
        </div>
        <button type="submit" style="all: unset; cursor: pointer;" >
            <div class="buttonTags">Посмотреть все
                <svg  xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"></path>
                </svg>
            </div>
        </button>
    </form>'; // onclick="window.location.href={$INTERESTS}"

    return $html;
}

function psql_query_stars($params, $smarty)
{

    global $wdbc;

    /*require_once($_SERVER['DOCUMENT_ROOT'].TOTAL::CDB->value);             //-> [$dbname, $host, $port, $user, $passwd]; -> './config/config_db.php'
    require_once($_SERVER['DOCUMENT_ROOT'].TOTAL::WDBC->value);             // -> WrapperDataBase(); -> './config/WrapperDataBaseConn.php' 

    $wdbc = new WDBC($dbname, $host, $port, $user, $passwd);
    */
    $status = $wdbc->query()
        ->select($params['select'])
        ->from($params['from'])
        ->orderby($params['orderby'])
        ->exec(); // ->limit  (isset($params['limit']) ? $params['limit'] : '')

    //$status = true;

    $html = '';
    if ($status) {
        $array_data = $wdbc->query()->responce(); // $wdbc->query()->responce() // value="<?= $cur_idx

        $deb = array();
        foreach ($array_data as $data) {
            //$status_block = ( $data["id"] == 2 ? 'block' : 'none'); 
            $status_block = ($data["id"] == 2 ? 'visible' : 'hidden'); // // visibility // display: '.$status_block.';

            $status_query = $wdbc->query()
                ->select('icon')
                ->from('info_user')
                ->where('id', $data["user_id"])
                ->exec();

            $icon = "someone.svg";
            if ($status_query) $icon = $wdbc->query()->responce()[0]['icon']; // rishick.jpg

            $id = $data["id"];

            $style = '';
            $style_art = "visibility: hidden;";

            $coff = abs(2 - ($id - 1));

            if ($coff <= 2)
                switch ($coff) {
                    case 0: // C
                        $scale = 1;
                        $style_art = "visibility: visible; position: absolute;";
                        break;
                    case 1: // L1, R1
                        $scale = 0.7;
                        break;
                    case 2: // L2, R2
                        $scale = 0.3;
                        break;
                }

            array_push($deb, $coff);

            $style .= '
                
                '; // transform: scale('.$scale.');

            $style_svg = 'transform: scale(' . $scale . ');'; // 


            $html .=
                '<div id="' . $id . '" class="item-of-stars" style="' . $style . '' . $style_svg . '" title="лучший,' . $data["description"] . ',' . $data["time"] . '"> <!-- none / block pointer-events: none; --> 
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 470" fill="currentColor" style="display:block; width:100%; ">
                    <!-- pattern -->
                    <defs>
                        <pattern id="image-' . $id . '" x="0%" y="0%" height="100%" width="100%" viewBox="0 0 512 512">
                            <image x="0%" y="0%" width="512" height="512" xlink:href="/assets/frontend/icons/avatars_profiles/' . $icon . '"/>
                        </pattern>
                    </defs>
                    <path d="M112.608 466.549c-12.038 6.175-25.698-4.647-23.266-18.463l25.886-147.517L5.355 195.904c-10.26-9.793-4.928-27.694 8.826-29.628l152.756-21.706L235.05 9.622c6.144-12.163 22.767-12.163 28.91 0l68.114 134.948 152.756 21.706c13.754 1.934 19.087 19.835 8.795 29.628L383.783 300.57l25.885 147.517c2.433 13.816-11.227 24.638-23.265 18.463l-136.944-70.36-136.882 70.36h.031z"/>
                    <ellipse fill="url(#image-' . $id . ')" stroke="red" stroke-width="4" ry="120.22" rx="117" cy="262.22" cx="246" style="filter: grayscale(1);"/>
                    <path fill="none" d="M262 380h10c1 0 2.027.23 3 0 2.176-.514 3-1 4-1s2-1 5-1c1 0 2-1 3-1s2.027.23 3 0c2.176-.514 3-1 5-1 1 0 2-1 3-1 2 0 4.293-.293 5-1a9.233 9.233 0 0 1 3-2c.924-.383 2.076.383 3 0 1.307-.541 2.186-.693 4-2 1.147-.827 2-1 3-1s2.076-.617 3-1c1.307-.541 1.824-2.486 4-3 1.946-.46 2.693-1.459 4-2 .924-.383 2.293-.293 3-1 .707-.707.293-1.293 1-2 .707-.707 2.15-.474 3-1 1.902-1.176 2.186-2.693 4-4 1.147-.827 1.293-1.293 2-2 .707-.707 1.076-.617 2-1 1.307-.541 1.293-1.293 2-2 .707-.707 1.459-.693 2-2 .383-.924 1.293-.293 2-1 .707-.707 1.293-2.293 2-3 .707-.707 1.293-.293 2-1 .707-.707.293-1.293 1-2 .707-.707 1.293-.293 2-1 .707-.707.459-1.693 1-3 .383-.924.293-1.293 1-2 .707-.707 1.293-.293 2-1 .707-.707.459-1.693 1-3 .383-.924 1.486-.824 2-3 .23-.973.293-1.293 1-2 .707-.707 1-1 1-2l2-2M140 207c0-1 1.77-3.027 2-4 .514-2.176-.072-5.611 2-8 1.465-1.69 2.293-2.293 3-3 .707-.707 1.419-.419 3-2s1.853-3.173 3-4c1.814-1.307 3.419-3.419 5-5s1-3 2-4c2-2 2.293-3.293 3-4l2-2c1-1 1.693-2.186 3-4 .827-1.147 1.186-1.693 3-3 1.147-.827 1.77-3.027 2-4 .514-2.176 1.693-3.186 3-5 .827-1.147 2.459-1.693 3-3 .383-.924.293-2.293 1-3 .707-.707 2.293-.293 3-1 .707-.707.853-2.173 2-3 1.814-1.307 2.853-2.173 4-3 1.814-1.307 3.293-2.293 4-3 .707-.707 2 0 3-1s3.293-1.293 4-2c.707-.707 2.293.707 3 0 .707-.707 1-1 2-1h2" stroke-width="4" stroke="red"/>
                    <path fill="none" d="M142 194c0 1-.293 1.293-1 2-.707.707-.459 1.693-1 3-.383.924-.459 3.693-1 5-.383.924-1 2-1 3s-1 2-1 3-.459 1.693-1 3c-.765 1.848-.459 2.693-1 4-.765 1.848-1 4-1 5s-.459 1.693-1 3c-.383.924 0 2 0 3s-.459 1.693-1 3c-.383.924 0 2-1 3s-1.486 2.824-2 5c-.23.973-1 2-1 3s-.173 1.853-1 3c-1.307 1.814-.235 3.152-1 5-.541 1.307-1 2-1 3v6c0 1-1 2-1 3v21c0 2 1 3 1 5 0 1 1.459 1.693 2 3 .765 1.848-.46 3.054 0 5 .514 2.176 1 3 1 5 0 1-.23 4.027 0 5 .514 2.176 1 4 1 5v7c0 1 .54 2.054 1 4 .514 2.176 1 3 1 4s1 2 1 4c0 1 .459 1.693 1 3 .383.924 2 3 2 5 0 1 .293 2.293 1 3 .707.707 1.918 1.387 3 4 .383.924.459 1.693 1 3 .383.924-.051 1.299 1 3 1.176 1.902 3 3 4 4 2 2 3.415 4.189 4 5 1.849 2.565 6.889 4.194 12 7 3.92 2.152 6.797 4.256 8 5 2.69 1.663 6.868 2.289 11 4 2.922 1.21 4.647 2.973 9 4 3.893.919 7 1 11 1h25c1 0 2 1 4 1 1 0 3.022-.367 6 0 4.092.504 5.693 1.459 7 2 1.848.765 6.938.498 13 1 3.986.33 6 0 7 0s3.039-.48 6 0c3.121.507 7 1 9 1h16c1 0 2.076.383 3 0 1.307-.541 3.15-.474 4-1 1.902-1.176 2.693-2.459 4-3 .924-.383.419-1.419 2-3s4-2 5-3l4-4c1-1 1.076-1.617 2-2 1.307-.541 3-4 5-5s4.076-2.617 5-3c1.307-.541 1.293-1.293 2-2 .707-.707 1.076-.617 2-1 1.307-.541 1.853-1.173 3-2 1.814-1.307 3.076-2.617 4-3a9.233 9.233 0 0 0 3-2c.707-.707.293-2.293 1-3 .707-.707 1-1 2-1s.293-1.293 1-2c.707-.707 1.459-.693 2-2 .383-.924 2-2 2-3v-1M364 322v-3c0-1 .293-1.293 1-2 .707-.707-.707-2.293 0-3 .707-.707 1.459-.693 2-2 1.148-2.772.235-4.152 1-6 .541-1.307 1-2 1-3 0-2 1.486-3.824 2-6 .46-1.946-.148-4.228 1-7 .541-1.307.235-2.152 1-4 .541-1.307 2-4 2-5s.459-1.693 1-3c.765-1.848 0-3 0-4v-35c0-1-.617-3.076-1-4-.541-1.307-1.493-2.879-2-6-.32-1.974-.42-5.086-1-7-1.045-3.45-2.52-5.039-3-8-.507-3.121-2.459-3.693-3-5-.383-.924 0-2-1-3l-3-3c-1-1-2-3-4-5-1-1-1-3-2-4s-.293-2.293-1-3l-2-2c-1-1-.419-2.419-2-4l-3-3c-1-1-3.853-4.173-5-5-1.814-1.307-2-2-3-3s-1-2-2-2-1.293-1.293-2-2c-.707-.707-3-1-5-2s-3-2-5-3-4.293-.293-5-1c-.707-.707-.293-1.293-1-2-.707-.707-1.054-.54-3-1-2.176-.514-6.31-3.337-9-5-1.203-.744-1-2-2-2h-3c-1 0-1.293-.293-2-1-.707-.707-1-1-2-1s-1-1-2-1h-1v-1h-1" stroke-width="4" stroke="red"/>
                </svg>
            </div>';
        } // '.$data["icon"].'

        /*$art = array(
            'head1' => "Лучший",
            'head2' => $data["description"],
            'head3' => $data["time"],
            'style' => $style_art,
            'class' => 'VasekMain2',
            'class2'=> 'HelveticaMain2'
        );

        $html_art = psql_query_article($art, null);

        $html .= $html_art.'</div>';*/

        /*
                        // -webkit-filter: invert(10); 
                       //filter: blur(0px) hue-rotate(47deg); 
        */

        /*for ($i = 0; $i < $params['limit']; $i++) {
            $html .=
            '<div class="item-of-stars" style="display: block;"> <!-- none / block -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 470" fill="currentColor" style="display:block; width:100%">
                    <!-- pattern -->
                    <defs>
                        <pattern id="image" x="0%" y="0%" height="100%" width="100%" viewBox="0 0 512 512">
                            <image x="0%" y="0%" width="512" height="512" xlink:href="/assets/frontend/icons/avatars_profiles/default_avatar_profile.jpg"/>
                        </pattern>
                    </defs>
                    <path d="M112.608 466.549c-12.038 6.175-25.698-4.647-23.266-18.463l25.886-147.517L5.355 195.904c-10.26-9.793-4.928-27.694 8.826-29.628l152.756-21.706L235.05 9.622c6.144-12.163 22.767-12.163 28.91 0l68.114 134.948 152.756 21.706c13.754 1.934 19.087 19.835 8.795 29.628L383.783 300.57l25.885 147.517c2.433 13.816-11.227 24.638-23.265 18.463l-136.944-70.36-136.882 70.36h.031z"/>
                    <ellipse fill="url(#image)" stroke="red" stroke-width="4" ry="120.22" rx="117" cy="262.22" cx="246"/>
                    <path fill="none" d="M262 380h10c1 0 2.027.23 3 0 2.176-.514 3-1 4-1s2-1 5-1c1 0 2-1 3-1s2.027.23 3 0c2.176-.514 3-1 5-1 1 0 2-1 3-1 2 0 4.293-.293 5-1a9.233 9.233 0 0 1 3-2c.924-.383 2.076.383 3 0 1.307-.541 2.186-.693 4-2 1.147-.827 2-1 3-1s2.076-.617 3-1c1.307-.541 1.824-2.486 4-3 1.946-.46 2.693-1.459 4-2 .924-.383 2.293-.293 3-1 .707-.707.293-1.293 1-2 .707-.707 2.15-.474 3-1 1.902-1.176 2.186-2.693 4-4 1.147-.827 1.293-1.293 2-2 .707-.707 1.076-.617 2-1 1.307-.541 1.293-1.293 2-2 .707-.707 1.459-.693 2-2 .383-.924 1.293-.293 2-1 .707-.707 1.293-2.293 2-3 .707-.707 1.293-.293 2-1 .707-.707.293-1.293 1-2 .707-.707 1.293-.293 2-1 .707-.707.459-1.693 1-3 .383-.924.293-1.293 1-2 .707-.707 1.293-.293 2-1 .707-.707.459-1.693 1-3 .383-.924 1.486-.824 2-3 .23-.973.293-1.293 1-2 .707-.707 1-1 1-2l2-2M140 207c0-1 1.77-3.027 2-4 .514-2.176-.072-5.611 2-8 1.465-1.69 2.293-2.293 3-3 .707-.707 1.419-.419 3-2s1.853-3.173 3-4c1.814-1.307 3.419-3.419 5-5s1-3 2-4c2-2 2.293-3.293 3-4l2-2c1-1 1.693-2.186 3-4 .827-1.147 1.186-1.693 3-3 1.147-.827 1.77-3.027 2-4 .514-2.176 1.693-3.186 3-5 .827-1.147 2.459-1.693 3-3 .383-.924.293-2.293 1-3 .707-.707 2.293-.293 3-1 .707-.707.853-2.173 2-3 1.814-1.307 2.853-2.173 4-3 1.814-1.307 3.293-2.293 4-3 .707-.707 2 0 3-1s3.293-1.293 4-2c.707-.707 2.293.707 3 0 .707-.707 1-1 2-1h2" stroke-width="4" stroke="red"/>
                    <path fill="none" d="M142 194c0 1-.293 1.293-1 2-.707.707-.459 1.693-1 3-.383.924-.459 3.693-1 5-.383.924-1 2-1 3s-1 2-1 3-.459 1.693-1 3c-.765 1.848-.459 2.693-1 4-.765 1.848-1 4-1 5s-.459 1.693-1 3c-.383.924 0 2 0 3s-.459 1.693-1 3c-.383.924 0 2-1 3s-1.486 2.824-2 5c-.23.973-1 2-1 3s-.173 1.853-1 3c-1.307 1.814-.235 3.152-1 5-.541 1.307-1 2-1 3v6c0 1-1 2-1 3v21c0 2 1 3 1 5 0 1 1.459 1.693 2 3 .765 1.848-.46 3.054 0 5 .514 2.176 1 3 1 5 0 1-.23 4.027 0 5 .514 2.176 1 4 1 5v7c0 1 .54 2.054 1 4 .514 2.176 1 3 1 4s1 2 1 4c0 1 .459 1.693 1 3 .383.924 2 3 2 5 0 1 .293 2.293 1 3 .707.707 1.918 1.387 3 4 .383.924.459 1.693 1 3 .383.924-.051 1.299 1 3 1.176 1.902 3 3 4 4 2 2 3.415 4.189 4 5 1.849 2.565 6.889 4.194 12 7 3.92 2.152 6.797 4.256 8 5 2.69 1.663 6.868 2.289 11 4 2.922 1.21 4.647 2.973 9 4 3.893.919 7 1 11 1h25c1 0 2 1 4 1 1 0 3.022-.367 6 0 4.092.504 5.693 1.459 7 2 1.848.765 6.938.498 13 1 3.986.33 6 0 7 0s3.039-.48 6 0c3.121.507 7 1 9 1h16c1 0 2.076.383 3 0 1.307-.541 3.15-.474 4-1 1.902-1.176 2.693-2.459 4-3 .924-.383.419-1.419 2-3s4-2 5-3l4-4c1-1 1.076-1.617 2-2 1.307-.541 3-4 5-5s4.076-2.617 5-3c1.307-.541 1.293-1.293 2-2 .707-.707 1.076-.617 2-1 1.307-.541 1.853-1.173 3-2 1.814-1.307 3.076-2.617 4-3a9.233 9.233 0 0 0 3-2c.707-.707.293-2.293 1-3 .707-.707 1-1 2-1s.293-1.293 1-2c.707-.707 1.459-.693 2-2 .383-.924 2-2 2-3v-1M364 322v-3c0-1 .293-1.293 1-2 .707-.707-.707-2.293 0-3 .707-.707 1.459-.693 2-2 1.148-2.772.235-4.152 1-6 .541-1.307 1-2 1-3 0-2 1.486-3.824 2-6 .46-1.946-.148-4.228 1-7 .541-1.307.235-2.152 1-4 .541-1.307 2-4 2-5s.459-1.693 1-3c.765-1.848 0-3 0-4v-35c0-1-.617-3.076-1-4-.541-1.307-1.493-2.879-2-6-.32-1.974-.42-5.086-1-7-1.045-3.45-2.52-5.039-3-8-.507-3.121-2.459-3.693-3-5-.383-.924 0-2-1-3l-3-3c-1-1-2-3-4-5-1-1-1-3-2-4s-.293-2.293-1-3l-2-2c-1-1-.419-2.419-2-4l-3-3c-1-1-3.853-4.173-5-5-1.814-1.307-2-2-3-3s-1-2-2-2-1.293-1.293-2-2c-.707-.707-3-1-5-2s-3-2-5-3-4.293-.293-5-1c-.707-.707-.293-1.293-1-2-.707-.707-1.054-.54-3-1-2.176-.514-6.31-3.337-9-5-1.203-.744-1-2-2-2h-3c-1 0-1.293-.293-2-1-.707-.707-1-1-2-1s-1-1-2-1h-1v-1h-1" stroke-width="4" stroke="red"/>
                </svg>
            </div>';
        }*/

        // <image x="0%" y="0%" width="512" height="512" xlink:href="https://cdn3.iconfinder.com/data/icons/people-professions/512/Baby-512.png"></image> // width="90" height="90"

        // /assets/frontend/icons/avatars_profiles/default_avatar_profile.jpg
        return $html;
    }

    return $html;
}

enum Color: string
{
    case Red = '#FF0000';
    case Green = '#00FF00';
    case Blue = '#0000FF';
    public function hex(): string
    {
        return $this->value;
    }
    public function rgb(): array
    {
        return sscanf($this->value, '#%02x%02x%02x');
    }
    public static function random(): self
    {
        return self::cases()[array_rand(self::cases())];
    }
}

function make_query($params, $smarty)
{
    global $wdbc;
    $query = $wdbc->query()
        ->select($params['select'])
        ->from($params['from']);

    if (isset($params['where']) && isset($params[$params['where']])) {
        $query->where($params['where'], $params[$params['where']], 'status', 'show');
    } else {
        $query->where('status', 'show');
    }

    if (isset($params['orderby'])) $query->orderby($params['orderby']);
    if (isset($params['limit']))   $query->limit($params['limit']);
    if (isset($params['offset']))  $query->offset($params['offset']);

    return $query;
}

function psql_query_vacancies($params, $smarty)
{

    /*global $wdbc;
    $query = $wdbc->query()
        ->select($params['select'])
        ->from($params['from']);

    if(isset($params['where']) && isset($params[$params['where']]))
        $query->where($params['where'], $params[$params['where']]);

    $status = $query
        ->orderby($params['orderby'])
        ->limit($params['limit'])
        ->offset($params['offset'])
        ->exec();

    $html = '';
    for ($i = 0; $i < $max; $i++) {
        $style = '';

        // $style = 'background-color: '.Color::random()->hex().';';

        $style = $style . ($i % 2 == 0 && ($i == $max - 1)
            ? 'width:  50%;  grid-column: 1 / span 2; '
            : 'width: 100%; ');

        $html .= 
            '<div class="cardVacancy" style="' . $style . '">
                    <div style="display: flex; align-items: center; justify-content: space-between; width: 100%; height: 50px;">
                        <h1 class="cardTitle">ТЕСТИРОВЩИК</h1>
                        <button type="button" class="buttonCard" style="">Откликнуться</button>
                    </div>
                        <p class="projectStatus">Автоматизация проведения лабораторных работ по программированию</p>
                    <p class="cardDuties">Обязанности:</p>
                        <ul>
                            <li class="cardDuty">Участие в разработке архитектуры и функций системы автоматизации лабораторных работ.</li>
                            <li class="cardDuty">Проектирование и реализация компонентов системы, включая интерфейсы для студентов и преподавателей.</li>
                            <li class="cardDuty">Разработка алгоритмов автоматической проверки кода на различных языках программирования.</li>
                            <li class="cardDuty">Проектирование и реализация компонентов системы, включая интерфейсы для студентов и преподавателей.</li>
                            <li class="cardDuty">Разработка алгоритмов автоматической проверки кода на различных языках программирования.</li>
                            <li class="cardDuty">Интеграция системы с внешними сервисами.</li>
                            <li class="cardDuty">Написание документации и проведение тестирования разработанных функций.</li>
                            <li class="cardDuty">Участие в код-ревью и обмене знаниями с командой.</li>
                            <li class="cardDuty">Поддержка и улучшение существующих функций системы на основе отзывов пользователей.</li>
                        </ul>
            </div>';
    }*/

    /*global $wdbc;
    $query = $wdbc->query()
        ->select($params['select'])
        ->from($params['from']);

    if(isset($params['where']) && isset($params[$params['where']])){
        $query->where($params['where'], $params[$params['where']], 'status', 'show');
    } else {
        $query->where('status', 'show');
    }

    if(isset($params['orderby'])) $query->orderby($params['orderby']);
    if(isset($params['limit']))   $query->limit($params['limit']);
    if(isset($params['offset']))  $query->offset($params['offset']);*/

    $query = make_query($params, $smarty);

    $status = $query->exec();

    $isGrid = (isset($params['style']) && $params['style'] == 'grid' ? true : false);

    $html = '';
    if ($status) {
        $array_data = $query->responce(); // $wdbc->query()->responce() // value="<?= $cur_idx

        $count = count($array_data);
        for ($i = 0; $i < $count; $i++) {
            $data = $array_data[$i];

            $style = ($isGrid && $i % 2 == 0 && ($i == $count - 1) // Стиль для выравнивания по центру последнего item-vacancies при нечетном количестве.
                ? 'width:  50%; grid-column: 1 / span 2;'
                : 'width: 100%;');

            if (isset($data['speciality'])) $speciality = $data['speciality'];
            if (isset($data['description'])) $description = $data['description'];


            /*$html.=
                    '<div class="cardVacancy" style="' . $style . '">
                    <div style="display: flex; align-items: center; justify-content: space-between; width: 100%; height: 50px;">
                        <h1 class="cardTitle">ТЕСТИРОВЩИК</h1>
                        <button type="button" class="buttonCard" style="">Откликнуться</button>
                    </div>
                        <p class="projectStatus">Автоматизация проведения лабораторных работ по программированию</p>
                    <p class="cardDuties">Обязанности:</p>
                        <ul>
                            <li class="cardDuty">Участие в разработке архитектуры и функций системы автоматизации лабораторных работ.</li>
                            <li class="cardDuty">Проектирование и реализация компонентов системы, включая интерфейсы для студентов и преподавателей.</li>
                            <li class="cardDuty">Разработка алгоритмов автоматической проверки кода на различных языках программирования.</li>
                            <li class="cardDuty">Проектирование и реализация компонентов системы, включая интерфейсы для студентов и преподавателей.</li>
                            <li class="cardDuty">Разработка алгоритмов автоматической проверки кода на различных языках программирования.</li>
                            <li class="cardDuty">Интеграция системы с внешними сервисами.</li>
                            <li class="cardDuty">Написание документации и проведение тестирования разработанных функций.</li>
                            <li class="cardDuty">Участие в код-ревью и обмене знаниями с командой.</li>
                            <li class="cardDuty">Поддержка и улучшение существующих функций системы на основе отзывов пользователей.</li>
                        </ul>
                </div>';*/

            $coin_style = '';

            $coin_show = false;
            switch ($data['id']) {
                case 2:
                    $coin_style = 'background: #BBEFD4; color: #0E7B43;';
                    $coin_show = true;
                    break;
                case 3:
                    $coin_style = 'background: #FFF3CD; color: #866906;';
                    $coin_show = true;
                    break;
            }

            // coincidence;

            $html .=
                '<form class="formVacancy" method="POST"  action="/assets/frontend/pages/vacancy.php" style="' . $style . '">
                    <div class="divVacancy">
                        <div style=" display: grid; align-items: center; justify-content: space-between; grid-template-columns: 2fr 1fr; "> <!--  height: 50px;-->
                            <h1 class="cardTitle">' . $speciality . '</h1> <!-- style="text-align: center;">" -->
                ';

            if ($coin_show) $html .= '<input type="text" style=" ' . $coin_style . '" class="coincidenceVacancy" value="совпадение 95%">';

            $html .= '
                    </div>
                    <p class="vacancieDescription" style="font-size: 1.3vw; text-align: justify; font-family: \'Helvetica\';">' . $description . '</p>';

            $tags = json_decode($data['tags']);
            if (count($tags) == 0) $html .= '<p class="" style="font-size: 1.3vw;" >Теги отсутствуют</p>';
            else {
                $html .= '<div class="contentProperty" id="tags" class="resultTag" style="width: 100%; display: flex; column-gap: 2%;">'; // '.$style.'
                foreach ($tags as $tag) $html .= '<label class="labelTag" style="padding: 5px; ">' . $tag . '</label>'; // <label class="labelTag" style="padding-right: 5px;">'.$tag.
                $html .= '</div>';
            }

            $duties = json_decode($data['duties']);
            $html .= '<div>';
            if ($duties && count($duties) > 0) {
                $html .= '<p class="cardDuties" style="font-size: 1.3vw;" >Обязанности:</p>';

                $html .= '<ul>';
                foreach ($duties as $duty) $html .= '<li class="cardDuty">' . $duty . '</li>';
                $html .= '</ul>';
            } else
                $html .= ''; // <p class="" style="font-size: 1.3vw;" >Обязанности отсутствуют</p>

            //$html .= '</div>';

            $experience = json_decode($data['experience']);
            //$html .= '<div>';
            if ($experience && count($experience) > 0) {
                $html .= '<p class="cardExperience" style="font-size: 1.3vw;" >Опыт:</p>';

                $html .= '<ul>';
                foreach ($experience as $exper) $html .= '<li class="cardExper">' . $exper . '</li>';
                $html .= '</ul>';
            } else
                $html .= ''; // <p class="" style="font-size: 1.3vw;" >требуемый опыт отсутствуют</p>

            $html .= '</div></div>'; // </div>

            $html .= '<input  type="hidden" name="id" id="id" value="' . $data["id"] . '">';
            $html .= '<button  class="clickVacancy" type="submit" > Откликнуться </button>'; // Откликнуться / Вы откликнулись;
            $html .= '</form>';
        }

        /*
                <button  type="submit" style="all:unset; display: static; width: 100%; height: 100px;">
            <div class="" style=""> <!-- margin: 1vw; width: calc(100% - 2vw); height: calc(100% - 2vh);-->
                <div style=" display: grid; align-items: center; justify-content: space-between; grid-template-columns: 2fr 1fr; "> <!--  height: 50px;-->
                    <h1 class="cardTitle">'.$speciality.'</h1> <!-- style="text-align: center;">" -->
                    <input type="button" class="buttonCard" value="Откликнуться">
                </div>
                <p class="vacancieStatus" style="font-size: 1vw; text-align: justify;">'.$description.'</p>
                <p class="cardDuties" style="font-size: 1.3vw;" >Обязанности:</p>
                <ul>
                    <li class="cardDuty">Участие в разработке архитектуры и функций системы автоматизации лабораторных работ.</li>
                    <li class="cardDuty">Проектирование и реализация компонентов системы, включая интерфейсы для студентов и преподавателей.</li>
                    <li class="cardDuty">Разработка алгоритмов автоматической проверки кода на различных языках программирования.</li>
                    <li class="cardDuty">Проектирование и реализация компонентов системы, включая интерфейсы для студентов и преподавателей.</li>
                    <li class="cardDuty">Разработка алгоритмов автоматической проверки кода на различных языках программирования.</li>
                    <li class="cardDuty">Интеграция системы с внешними сервисами.</li>
                    <li class="cardDuty">Написание документации и проведение тестирования разработанных функций.</li>
                    <li class="cardDuty">Участие в код-ревью и обмене знаниями с командой.</li>
                    <li class="cardDuty">Поддержка и улучшение существующих функций системы на основе отзывов пользователей.</li>
                </ul>
            </div>
            <input hidden name="id" id="id" value="'.$data["id"].'">
                    </button>
        
        */

        /*

        class="cardVacancy"
        <input hidden name="id" id="id" value="'.$data["id"].'">
                                <div style="display: flex; align-items: center; justify-content: space-between; width: 100%; height: 50px;">
                            <h1 class="cardTitle">"'.$speciality.'"</h1>
                            <input type="button" class="buttonCard" value="Откликнуться">
                        </div>
                        <p class="vacancieStatus">'.$description.'</p>
                        <p class="cardDuties">Обязанности:</p>
                        <ul>
                            <li class="cardDuty">Участие в разработке архитектуры и функций системы автоматизации лабораторных работ.</li>
                            <li class="cardDuty">Проектирование и реализация компонентов системы, включая интерфейсы для студентов и преподавателей.</li>
                            <li class="cardDuty">Разработка алгоритмов автоматической проверки кода на различных языках программирования.</li>
                            <li class="cardDuty">Проектирование и реализация компонентов системы, включая интерфейсы для студентов и преподавателей.</li>
                            <li class="cardDuty">Разработка алгоритмов автоматической проверки кода на различных языках программирования.</li>
                            <li class="cardDuty">Интеграция системы с внешними сервисами.</li>
                            <li class="cardDuty">Написание документации и проведение тестирования разработанных функций.</li>
                            <li class="cardDuty">Участие в код-ревью и обмене знаниями с командой.</li>
                            <li class="cardDuty">Поддержка и улучшение существующих функций системы на основе отзывов пользователей.</li>
                        </ul>
        
        */

        /*
        <div class="cardVacancy" style="'.$style.'">
        </div>
        */

        /*foreach ($array_data as $data) {
            $style = ($i % 2 == 0 && ($i == $max - 1)
            ? 'width:  50%;  grid-column: 1 / span 2; '
            : 'width: 100%; ');

            $html.=
                    '<div class="cardVacancy" style="' . $style . '">
                    <div style="display: flex; align-items: center; justify-content: space-between; width: 100%; height: 50px;">
                        <h1 class="cardTitle">ТЕСТИРОВЩИК</h1>
                        <button type="button" class="buttonCard" style="">Откликнуться</button>
                    </div>
                        <p class="projectStatus">Автоматизация проведения лабораторных работ по программированию</p>
                    <p class="cardDuties">Обязанности:</p>
                        <ul>
                            <li class="cardDuty">Участие в разработке архитектуры и функций системы автоматизации лабораторных работ.</li>
                            <li class="cardDuty">Проектирование и реализация компонентов системы, включая интерфейсы для студентов и преподавателей.</li>
                            <li class="cardDuty">Разработка алгоритмов автоматической проверки кода на различных языках программирования.</li>
                            <li class="cardDuty">Проектирование и реализация компонентов системы, включая интерфейсы для студентов и преподавателей.</li>
                            <li class="cardDuty">Разработка алгоритмов автоматической проверки кода на различных языках программирования.</li>
                            <li class="cardDuty">Интеграция системы с внешними сервисами.</li>
                            <li class="cardDuty">Написание документации и проведение тестирования разработанных функций.</li>
                            <li class="cardDuty">Участие в код-ревью и обмене знаниями с командой.</li>
                            <li class="cardDuty">Поддержка и улучшение существующих функций системы на основе отзывов пользователей.</li>
                        </ul>
                </div>';
        } */
    }

    return $html;
}

function wrapperHtmlGroups()
{
    $groups_names = func_get_args();
    $content_html_groups = '<select class="showHide selProperty" name="education" id="education" hidden="true">';
    foreach ($groups_names as $group_name) {
        $name = $group_name["name"];
        if ($name) $content_html_groups .= '<option value="' . $name . '" >' . $name . '</option>';
    }

    $content_html_groups .= '</select>';
    return $content_html_groups;
}

function query_groups()
{
    global $wdbc;

    $sq = $wdbc->query()->select('name')->from('groups')->exec();
    $data = array();

    if ($sq) $data = $wdbc->query()->responce();

    return $data;
}

function wrapperHtmlOption()
{
    $values = func_get_args();
    $content_html_vaues = '';
    foreach ($values as $value)
        if ($value) $content_html_vaues .= '<option value="' . $value . '" >' . $value . '</option>';

    return $content_html_vaues;
}

function wrapperHtmlSelect()
{
    $values = func_get_args();
    $content_html_vaues = '<select class="selProperty" name="education" id="education" hidden="true">';

    foreach ($values as $value)
        if ($value) $content_html_vaues .= '<option value="' . $value . '" >' . $value . '</option>';

    $content_html_vaues .= '</select>';
    return $content_html_vaues;
}

function query_property_option()
{
    $property = func_get_arg(0);

    $array_values = array();
    switch ($property) {
        case 'education':
            $array_values = array("Бакалавриат", "Магистратура", "Специалитет", "Аспирантура");
            break;
        case 'course':
            $array_values = array("1", "2", "3", "4");
            break;
        case 'institute':
            $array_values = array("ИИ - Искусственного интеллекта", "ИТ - Информационных технологий", "КБ - комплексной безопасности", "РИ - радиотехнических и телекоммуникационных систем", "...");
            break;
        case 'division':
            $array_values = array("БК 536 РТУ МИРЭА", "...");
            break;
        case 'specialization':
            $array_values = array("Прикладная математика и информатика", "...");
            break;
        case 'year':
            $count = 0;

            $array_yers = array();
            while ($count < 10) { // Последние 10 лет показываем
                array_push($array_yers, date("Y", strtotime("-$count year")));
                $count++;
            }

            $array_values = $array_yers;
            break;
        case 'status';
            $array_values = array("Запуск", "В разработке", "Завершен", "В Архиве", "Идёт набор");
            break;
    }

    $html = wrapperHtmlSelect(...$array_values);

    return $html;
}


function psql_query_properties_profile($params, $smarty)
{
    if (empty($params["for"])) return '';

    global $wdbc;

    $sq = $wdbc->query()
        ->select('*')
        ->from('info_user')
        ->where('id', $_SESSION['id'])
        ->exec();

    if ($sq) {
        $array_data = $wdbc->query()->responce(); // $wdbc->query()->responce() // value="<?= $cur_idx

        $html = '';
        foreach ($array_data as $data) {
            switch ($params["for"]) {
                case 'base_properties':
                    $html_groups            = wrapperHtmlGroups(...query_groups());
                    $html_education         = query_property_option('education');
                    $html_course            = query_property_option('course');
                    $html_institute         = query_property_option('institute');
                    $html_division          = query_property_option('division');
                    $html_specialization    = query_property_option('specialization');
                    $html_year              = query_property_option('year');

                    $html .= '
                        <string>Образовательная программа:  
                            <input class="contentProperty" id="educational_program"  value="' . $data['educational_program'] . '"    readonly />
                            ' . $html_education . '
                        </string>
                        <string>Группа:
                            <input class="contentProperty" id="group"                value="' . $data['group'] . '"                  readonly />
                            ' . $html_groups . '
                        </string>                            
                        <string>Курс:                       
                            <input class="contentProperty" id="course"               value="' . $data['course'] . '"                 readonly />
                            ' . $html_course . '
                        </string>         
                        <string>Шифр:                       
                            <input class="contentProperty" id="cipher"               value="' . $data['cipher'] . '"                 readonly />
                        </string> 
                        <string>Институт:                   
                            <input class="contentProperty" id="institute"            value="' . $data['institute'] . '"              readonly />
                            ' . $html_institute . '
                        </string>
                        <string>Кафедра:                    
                            <input class="contentProperty" id="division"             value="' . $data['division'] . '"               readonly />
                            ' . $html_division . '
                        </string>
                        <string>Специальность:              
                            <input class="contentProperty" id="specialization"       value="' . $data['specialization'] . '"         readonly />
                             ' . $html_specialization . '
                        </string>
                        <string>Год приёма:                 
                            <input class="contentProperty" id="year_start"           value="' . $data['year_start'] . '"             readonly />
                            ' . $html_year . '
                        </string>';

                    /*$html =  $html . '
                        <string>Группа*:                    <input class="contentProperty" id="group"                value="' . $data['group'] . '"                  readonly /></string>                                       
                        <string>Курс*:                      <input class="contentProperty" id="course"               value="' . $data['course'] . '"                 readonly /></string>                         
                        <string>Шифр*:                      <input class="contentProperty" id="cipher"               value="' . $data['cipher'] . '"                 readonly /></string>
                        <string>Навыки:                     <input class="contentProperty" id="skills"               value="' . $data['skills'] . '"                 readonly /></string>  
                        <string>Институт*:                  <input class="contentProperty" id="institute"            value="' . $data['institute'] . '"              readonly /></string>
                        <string>Год приёма*:                <input class="contentProperty" id="year_start"           value="' . $data['year_start'] . '"             readonly /></string>   
                        <string>Специальность*:             <input class="contentProperty" id="specialization"       value="' . $data['specialization'] . '"         readonly /></string>                <!-- (Направление) -->
                        <string>Образовательная программа*: <input class="contentProperty" id="educational_program"  value="' . $data['educational_program'] . '"    readonly /></string>';*/
                    break;
                case 'about':
                    /*$html = $html . '<input id="about" value="' . $data['about'] . '" readonly />';*/
                    $html .= '<textarea id="about" onload="loadTextArea.call(this);" oninput="resizeTextarea.call(this);" class="contentProperty" readonly>' . $data['about'] . '</textarea>';
                    //$html .= '<div id="about" contenteditable="true" oninput="resizeTextarea.call(this);" class="contentProperty" readonly>'.$data['about'].'</div>';
                    break;
                case 'head':
                    $html .= '
                        <p class= "fontHead">' . $data['firstname'] . '</p><p class= "fontHead">' . $data['lastname'] . '</p>';
                    break;
                case 'skills':
                    if (isset($data['skills'])) {
                        $skills = json_decode($data['skills']);
                        $html .= wrapperHtmlLabel(...$skills);
                    }
                    break;
                case 'goals':
                    $html .= '<ul class="contentProperty" id="goals" style="width: 100%">';
                    if (isset($data['goals']))  $goals = json_decode($data['goals']);
                    $html .= wrapperHtmlLi(...$goals);
                    $html .= '</ul>';
                    break;
                case 'materials': // contacts
                    if (isset($data['materials'])) {
                        $materials = json_decode($data['materials']);
                        $html .= wrapperHtmlSpan(...$materials);
                    }
                    break;
                case 'contacts':
                    if (isset($data['contacts'])) {
                        $contacts = json_decode($data['contacts']);
                        $emails = $contacts->emails;
                        $phones = $contacts->phones;
                        $sites  = $contacts->sites;

                        if (isset($emails)) $html .= wrapperHtmlSpan(...$emails);
                        if (isset($phones)) $html .= wrapperHtmlSpan(...$phones);
                        if (isset($sites)) $html  .= wrapperHtmlSpan(...$sites);
                    }
                    break;
            }
        }
    }

    return $html;
}

function psql_query_properties_user($params, $smarty){

    if (empty($params["for"])) return ''; // fro="project"

    global $wdbc;

    if(isset($params['data_users'])) $data_users = $params['data_users'];

    $html = '';
    foreach($data_users as $key => $value){
        $sq = $wdbc->query()
        ->select('*')
        ->from('info_user')
        ->where('id', $key)->exec();

        if ($sq) {
            $array_data = $wdbc->query()->responce(); // $wdbc->query()->responce() // value="<?= $cur_idx
    
            foreach ($array_data as $data) {
                $firstname = '';
                $lastname = '';
                $from ='';
                $to ='';
                $role ='';
                $icon ='';
                $id_prefix = 'pro';

                switch($params["for"]){
                    case 'project':
                    case 'feedback':
                        if(isset($data["firstname"]))   $firstname  = $data["firstname"];
                        if(isset($data["lastname"]))    $lastname   = $data["lastname"];
                        if(isset($data["lastname"]))    $lastname   = $data["lastname"];
                        if(isset($data["icon"]))        $icon       = $data["icon"];

                        break;
                }

                switch($params["for"]){
                    case 'project':
                        if(isset($value[0]))            $from  = $value[0];
                        if(isset($value[1]))            $to    = $value[1];
                        if(isset($value[2]))            $role  = $value[2];
                        break;
                    case 'feedback':
                        $id_prefix = 'fb';

                        if(isset($value[0]))            $count_stars    = $value[0];
                        if(isset($value[0]))            $msg            = $value[1];

                        break;
                }

                $id = $id_prefix.'-'.$key;
                $html .= '
                <div style="display: flex; flex-direction: row; column-gap: 10px;">
                    <div class="div-left">
                            <svg class="avatar" xmlns="http://www.w3.org/2000/svg" width="128" height="105" fill="none" viewBox="0 0 214 211">
                            <defs>
                                <pattern id="'.$id.'" width="1" height="1" patternContentUnits="objectBoundingBox">
                                    <use href="#img'.'-'.$id.'" transform="translate(0 -.6) scale(.00174)"></use>
                                </pattern>
                                <image class="avatar" id="img'.'-'.$id.'" width="576" height="1280" data-name="image.png" href="/assets/frontend/icons/avatars_profiles/'.$icon.'"></image>
                            </defs>
                            <rect width="197.234" height="197.234" x="8.067" y="10.59" fill="url(#'.$id.')" stroke="#EA5657" stroke-width="3" rx="98.617"></rect>
                            <path stroke="#EA5657" stroke-linecap="round" stroke-width="3" d="M103.532 208.216C144.523 215.784 212 179.207 212 116.144c0-78.829-53.604-110.99-108.468-110.99C48.667 5.153 2 44.251 2 109.837s84.504 104.685 130.541 87.658"></path>
                            <path stroke="#EA5657" stroke-linecap="round" stroke-width="3" d="M2 109.838C7.045 49.298 33.532 16.505 72.63 2"></path>
                        </svg>
                    </div>
                    <div class="div-right" style="display: flex; flex-direction: column; column-gap: 7px; justify-content: center; ">
                        <input class="projectTitle name" value="'.$firstname .' '. $lastname.'" readOnly />';

                switch($params["for"]){
                    case 'project':
                        $html .= '
                            <div style="display: flex; column-gap: 10px; align-items: center; ">
                                <div style="display: flex; column-gap: 7px;">
                                    <string>c</string><input id="from" class="user_data" type="text"  value="'.$from.'" readOnly>
                                    <string>по</string><input id="to" class="user_data" type="text"  value="'.$to.'" readOnly>
                                </div>
                                <string styl="matgin-left: 1rem;">|</string><input  id="role" class="user_data" type="text"  value="'.$role.'" readOnly>
                            </div></div>';
                        break;
                    case 'feedback':

                        $count_stars;

                        $status = ($count_stars > 2 ? 'Рекомендую' : 'Не рекомендую');

                        $html_stars = '<div class="stars">';
                        $name = 'star-'.$id;
                        /*for($i = 0; $i < 5; $i++){
                            $sid = $name.'-'.$i;

                            $html_stars .= '
                            <input name="'.$sid.'" type="radio" class="star-ratio" name="rt">
                            <label class="star" for="'.$sid.'"></label>';
                        }*/

                        $html_stars .= '</div>';
                            

                            /*
                            <svg class="star" xmlns="http://www.w3.org/2000/svg" '.($i < $count_stars ? 'fill' : 'stroke').'="#202020" width="16" height="16" fill="none" viewBox="0 0 16 16">
                                <path d="M7.21 1.604c.3-.922 1.603-.922 1.903 0l1.106 3.403a1 1 0 0 0 .95.691h3.58c.968 0 1.37 1.24.587 1.81L12.44 9.61a1 1 0 0 0-.364 1.118l1.106 3.403c.3.921-.755 1.688-1.538 1.118l-2.896-2.103a1 1 0 0 0-1.175 0L4.679 15.25c-.784.57-1.839-.197-1.54-1.118l1.107-3.403a1 1 0 0 0-.364-1.118L.987 7.507c-.783-.57-.38-1.809.588-1.809h3.579a1 1 0 0 0 .95-.69L7.21 1.603Z"/>
                            </svg>
                            
                            */

                            

                        /*$html_stars .= '<div class="ratio">
                            <input name="'.$name.'" type="radio" class="star-ratio" name="rt">
                            <input name="'.$name.'" type="radio" class="star-ratio" name="rt">
                            <input name="'.$name.'" type="radio" class="star-ratio" name="rt">
                            <input name="'.$name.'" type="radio" class="star-ratio" name="rt">
                            <input name="'.$name.'" type="radio" class="star-ratio" name="rt">
                        </div>';*/

                        // <string>'.$status.$html_stars.'</string></div>

                        $html_stars = '
                            <fieldset class="rating">
                                <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
                                <input type="radio" id="star4half" name="rating" value="4 and a half" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                                <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                <input type="radio" id="star3half" name="rating" value="3 and a half" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                                <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                                <input type="radio" id="star2half" name="rating" value="2 and a half" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                                <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                <input type="radio" id="star1half" name="rating" value="1 and a half" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                                <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                                <input type="radio" id="starhalf" name="rating" value="half" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                            </fieldset>
                        ';


                        /*
                        
                                                    <fieldset class="rating">
                                
                                <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                                <input type="radio" id="star1half" name="rating" value="1 and a half" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                                <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                <input type="radio" id="star2half" name="rating" value="2 and a half" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                                <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
                                <input type="radio" id="star3half" name="rating" value="3 and a half" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                                <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                <input type="radio" id="star4half" name="rating" value="4 and a half" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                                <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>

                                <input type="radio" id="starhalf" name="rating" value="half" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                            </fieldset>
                        
                        
                        */

                        $html .= '
                            <string>'.$status.$html_stars.'</string>
                            <textarea>'.$msg.'</textarea></div>
                        ';


                        break;
                }

                $html .= '</div>';

                
    
                /*$html .= '
                    <div style="display: flex; flex-direction: row; column-gap: 10px;">
                        <div class="div-left">
                                <svg class="avatar" xmlns="http://www.w3.org/2000/svg" width="128" height="105" fill="none" viewBox="0 0 214 211">
                                <defs>
                                    <pattern id="'.$id.'" width="1" height="1" patternContentUnits="objectBoundingBox">
                                        <use href="#img'.'-'.$id.'" transform="translate(0 -.6) scale(.00174)"></use>
                                    </pattern>
                                    <image class="avatar" id="img'.'-'.$id.'" width="576" height="1280" data-name="image.png" href="/assets/frontend/icons/avatars_profiles/'.$icon.'"></image>
                                </defs>
                                <rect width="197.234" height="197.234" x="8.067" y="10.59" fill="url(#'.$id.')" stroke="#EA5657" stroke-width="3" rx="98.617"></rect>
                                <path stroke="#EA5657" stroke-linecap="round" stroke-width="3" d="M103.532 208.216C144.523 215.784 212 179.207 212 116.144c0-78.829-53.604-110.99-108.468-110.99C48.667 5.153 2 44.251 2 109.837s84.504 104.685 130.541 87.658"></path>
                                <path stroke="#EA5657" stroke-linecap="round" stroke-width="3" d="M2 109.838C7.045 49.298 33.532 16.505 72.63 2"></path>
                            </svg>
                        </div>
                        <div class="div-right" style="display: flex; flex-direction: column; column-gap: 7px; justify-content: center; ">
                            <input class="projectTitle name" value="'.$firstname .' '. $lastname.'" readOnly />
                            <div style="display: flex; column-gap: 10px; align-items: center; ">
                                <div style="display: flex; column-gap: 7px;">
                                    <string>c</string><input id="from" class="user_data" type="text"  value="'.$from.'" readOnly>
                                    <string>по</string><input id="to" class="user_data" type="text"  value="'.$to.'" readOnly>
                                </div>
                                <string styl="matgin-left: 1rem;">|</string><input  id="role" class="user_data" type="text"  value="'.$role.'" readOnly>
                            </div>
                        </div>
                    </div>
                ';*/
    
            }
        }
    }

    return $html;
}

function psql_query_intelligence($params, $smarty) {}

function query_editor_button($params, $smarty)
{ // $params['action'] // \'{$ACTION}\'
    $style = '';
    if (isset($params['style']))  $style = $params['style'];

    $action = $smarty->getTemplateVars('ACTION');

    return '<svg onclick="editPage.call(this, true, \'' . $action . '\');" style="' . $style . '" class="editor" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="none" viewBox="0 0 30 30"> 
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 26.47h12.353M21.176 4.356a2.948 2.948 0 0 1 2.057-.826 2.95 2.95 0 0 1 2.054.833 2.81 2.81 0 0 1 .853 2.006 2.81 2.81 0 0 1-.846 2.008L8.137 25.13l-5.49 1.34 1.373-5.36L21.176 4.354Z"/>
			</svg>';
}

function psql_query_header_page($params, $smarty)
{ // $params['action'] // \'{$ACTION}\'

    /*$style = '';
    if(isset($params['style']))  $style = $params['style'];*/

    $action = $smarty->getTemplateVars('ACTION');
    $url_templ_img = $smarty->getTemplateVars('template_name_default_img');
    // $url_img_profile = $smarty->getTemplateVars('icon');
    // $page = $params['page'];

    /*
        {query_properties 1_profile for="head"}
		{query_editor_button}
    */

    // $page = $smarty->template_resource;

    $page = explode('.', end(explode('_', end(explode('/', $smarty->template_resource)))))[0];

    $content_html = '';

    switch ($page) {
        case 'profile':
            $params['for'] = 'head';
            $url_img = $smarty->getTemplateVars('icon');
            $content_html = psql_query_properties_profile($params, $smarty);
            $content_html .= query_editor_button($params, $smarty);

            $svg_border = '
                <rect width="197.234" height="197.234" x="8.067" y="10.59" fill="url(#a)" stroke="#EA5657" stroke-width="3" rx="98.617"/>
                <path stroke="#EA5657" stroke-linecap="round" stroke-width="3" d="M103.532 208.216C144.523 215.784 212 179.207 212 116.144c0-78.829-53.604-110.99-108.468-110.99C48.667 5.153 2 44.251 2 109.837s84.504 104.685 130.541 87.658"/>
                <path stroke="#EA5657" stroke-linecap="round" stroke-width="3" d="M2 109.838C7.045 49.298 33.532 16.505 72.63 2"/>';

            $width = 214;
            $height = 211;
            break;
        case 'project':
            // {query_propertiesd 1_project for="icon" icon_default="$icon_default"}
            $params_list = array(
                'for' => "url_icon",
                'icon_default' => $smarty->getTemplateVars('icon_default')
            );

            //$url_img = $smarty->getTemplateVars('icon');

            $url_img = psql_query_properties_project($params_list, $smarty);

            //{query_properties 1_project for="name" name_default="$name_default"}
            $params_list = array(
                'for' => "name",
                'name_default' => $smarty->getTemplateVars('name_default')
            );
            $html_name = psql_query_properties_project($params_list, $smarty);

            $htm_editor_button = '';
            if($smarty->getTemplateVars('access')){
                // {query_editor_button action="$ACTION"}
                $params_list = array(
                    'action' => $smarty->getTemplateVars('ACTION')
                );
                $htm_editor_button = query_editor_button($params_list, $smarty);
            }

            $svg_border = '
                <rect width="210" height="210" x="5" y="6" fill="url(#a)" stroke="#EA5657" stroke-width="3" rx="10"/>
                <path stroke="#EA5657" stroke-linecap="round" stroke-width="3" d="M208 6s-45 13-106 1.5C61.992-.043 35.965 2.309 22.789 4.82c-6.537 1.246-11.113 6.559-12.323 13.102C7.064 36.318.713 75.31 1.999 104c1.88 41.926 7 103.999 7 103.999M20 218.5s66-16 106-6c38.463 9.616 65.84 6.023 79.215 2.83 5.967-1.425 10.208-6.292 11.468-12.297 3.749-17.87 10.32-57.642 2.817-89.533-9.612-40.852 0-94.5 0-94.5"/>
            ';

            $content_html .= $html_name . $htm_editor_button;
            $width = 225;
            $height = 221;

            break;
    }

    /*
    	<svg class="avatar" xmlns="http://www.w3.org/2000/svg" width="214" height="211" fill="none" viewBox="0 0 214 211">
					<defs>
						<pattern id="a" width="1" height="1" patternContentUnits="objectBoundingBox">
							<use href="'.$url_img_profile.'" transform="translate(0 -.227) scale(.00174)"/>
						</pattern>
					</defs>
					<rect width="197.234" height="197.234" x="8.067" y="10.59" fill="url(#a)" stroke="#EA5657" stroke-width="3" rx="98.617"/>
					<path stroke="#EA5657" stroke-linecap="round" stroke-width="3" d="M103.532 208.216C144.523 215.784 212 179.207 212 116.144c0-78.829-53.604-110.99-108.468-110.99C48.667 5.153 2 44.251 2 109.837s84.504 104.685 130.541 87.658"/>
					<path stroke="#EA5657" stroke-linecap="round" stroke-width="3" d="M2 109.838C7.045 49.298 33.532 16.505 72.63 2"/>
		</svg>
    */

    /*'
    <svg xmlns="http://www.w3.org/2000/svg" width="225" height="221" fill="none" viewBox="0 0 225 221">

  <defs>
    <pattern id="a" width="1" height="1" patternContentUnits="objectBoundingBox">
      <use href="#b" transform="translate(-.21 -.11) scale(.00088)"/>
    </pattern>
    <image id="b" width="1616" height="1264" data-name="image.png" href=""/>
  </defs>
</svg>
    ';*/

    return    '<article class="articleProfile"> <!-- style="display: flex;  width: fit-content; justify-content: center; space-between; gap: 5%; align-items: center;"-->
			<div class="avatar">
                <svg class="avatar" xmlns="http://www.w3.org/2000/svg" width="'.$width.'" height="'.$height.'" fill="none" viewBox="0 0 '.$width.' '.$height.'">
                    <defs>
                        <pattern id="a" width="1" height="1" patternContentUnits="objectBoundingBox">
                            <use href="#imgProfile" transform="translate(0 -.6) scale(.00174)"/>
                        </pattern>
                        <image class="avatar" id="imgProfile" width="576" height="1280" data-name="image.png" href="' . $url_img . '"/>
                    </defs>
                    '.$svg_border.'
                </svg>
				<button class="avatar display" onclick="showContextMenu()" style="display: none;">
					<svg xmlns="http://www.w3.org/2000/svg" width="100" height="101" fill="none" viewBox="0 0 100 101">
						<path stroke="#F6F6F6" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="m25.582 43.93 5.542 33.334a8.334 8.334 0 0 0 8.334 6.958H60.79a8.334 8.334 0 0 0 8.333-6.958l5.542-33.334a8.334 8.334 0 0 0-8.334-9.708h-32.54a8.333 8.333 0 0 0-8.208 9.708Z"/>
						<path stroke="#F6F6F6" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M39.999 38.389V27.555a10.042 10.042 0 0 1 10-10 10.042 10.042 0 0 1 10 10V38.39m-4.125 14.957-11.75 11.75m11.75 0-11.75-11.75"/>
					</svg>
				</button>
				<div id="1" class="contextMenu" style="position: absolute; display: none; flex-direction: column; justify-content: center; align-items: center; 
				background-color: #cfcbcb61; margin: 10px; row-gap: 10px;">
					<span>Изменить фотографию
						<input id="avatar" class="contentProperty" style="opacity: 10%; position: absolute; left: 0; top: 0;" type="file" accept="image/jpeg,image/png,image/gif" onchange="changeAvatar.call(this, \'change\', \'' . $url_templ_img . '\');"/>
					</span>
					<span>Удалить фотографию
						<input type="submit" id="delete-avatar" style="opacity: 10%; position: absolute; left: 0; top: 30px;  width: 100%;" onclick="changeAvatar.call(document.getElementById(\'avatar\'), \'delete\', \'' . $url_templ_img . '\');"/>
					</span>
				</div>
			</div>

			<div>
				<!--<img id="profile" class="avatar" src="{$icon}" alt="..." style="width: 150px; height: 150px; border-radius: 20px;">-->
				<!--<button type="submit" onclick="loadAvatar();"> Загрузить изображение</button>-->

			</div>
            ' . $content_html . '
			<!--<svg onclick="editPage.call(this, true, \'' . $action . '\');" class="editor" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="none" viewBox="0 0 30 30">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 26.47h12.353M21.176 4.356a2.948 2.948 0 0 1 2.057-.826 2.95 2.95 0 0 1 2.054.833 2.81 2.81 0 0 1 .853 2.006 2.81 2.81 0 0 1-.846 2.008L8.137 25.13l-5.49 1.34 1.373-5.36L21.176 4.354Z"/>-->
			</svg>
		</article>';
}

function query_input($params, $smarty)
{

    //<input class="search" type="search" placeholder="Поиск">
    if (isset($params['for'])) $for = $params['for'];

    $type_elem = 'span';
    if (isset($params['type'])) $type_elem = $params['type'];

    $placeholder = 'Поиск';
    $css = 'addSearch';
    $type = 'search';
    switch ($for) {
        case 'search':
            $onclick = 'addSkill';
            break;
        case 'add':
            $placeholder = 'дабавить';
            $type = 'text';
            break;
        case 'tags':
            $onclick = "addTag";
            break;
        case 'stack':
            $onclick = "addSkill";
            break;
    }

    $onclick .= '.call(this.previousElementSibling, this.parentNode.parentNode.previousElementSibling, this.parentNode.nextElementSibling);';

    switch ($type_elem) {
        case 'span':
            $html = '
            <span class="' . $css . '">
                <input class="' . $css . '" type="' . $type . '" placeholder="' . $placeholder . '" />
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 15 15" onclick="'.$onclick.'">
                    <path stroke="#858585" stroke-linecap="round" d="M10.698 10.59 14 14m-1.91-7.274c0 3.163-2.483 5.727-5.545 5.727C3.482 12.453 1 9.889 1 6.726 1 3.564 3.482 1 6.545 1c3.062 0 5.544 2.564 5.544 5.726Z"/>
                </svg>
            </span>';
            break;
        case 'textarea':
            $html = '
            <textarea id="duty" class="Add contentProperty" oninput="resizeTextarea.call(this);" class="contentProperty" readonly></textarea>
            <button             class="Add" onclick="addGoalDuty.call(this.previousElementSibling, this.parentNode.previousElementSibling.firstElementChild, this.nextElementSibling);">Добавить</button>';
            break;
    }

    return $html .= '<string></string>';
}

function query_properties_add($params, $smarty){
    if (isset($params['for'])) $for = $params['for'];

    $isDragAndDrop = false;
    $onclick = '';
    switch($for){
        case 'contacts':
            $isDragAndDrop = true;
            $onclick = 'addContacts.call(this.parentNode.parentNode)';
            break;
        case 'projects':
            $onclick = 'window.location.href=\''.$smarty->getTemplateVars('PAGE_PROJECT').'\'';
            break;
        case 'references':
            $isDragAndDrop = true;
            $onclick = 'addRefs.call(this.parentNode.parentNode)';
            break;
        case 3:
            break;
    }

    $svg_bascket =' 
        <svg id="contact" class="add remove" xmlns="http://www.w3.org/2000/svg" width="34" height="33" fill="none" viewBox="0 0 100 100">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m25.582 43.93 5.542 33.334a8.334 8.334 0 0 0 8.334 6.958H60.79a8.334 8.334 0 0 0 8.333-6.958l5.542-33.334a8.334 8.334 0 0 0-8.334-9.708h-32.54a8.333 8.333 0 0 0-8.208 9.708Z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M39.999 38.389V27.555a10.042 10.042 0 0 1 10-10 10.042 10.042 0 0 1 10 10V38.39m-4.125 14.957-11.75 11.75m11.75 0-11.75-11.75"/>
        </svg>';

    $html = '
        <div class="display" style="display: flex; justify-content: space-between; display: none; width: 100%; align-items: center;  height: 100%;">
            <button class="visibility add " onclick="'.$onclick.'"  >
                <svg class="add" xmlns="http://www.w3.org/2000/svg" width="34" height="33" fill="none" viewBox="0 0 34 33">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M1.444 17h31.111M17 1v31.111"/>
                </svg>
            </button>
            '.($isDragAndDrop ? $svg_bascket : '').'
        </div>
    ';

    return $html;
}

function psql_query_properties_project($params, $smarty)
{
    if (empty($params["for"])) return '';

    global $wdbc;

    $status_query = false;
    if (isset($_SESSION['project_id'])) { /* 'projects' */
        $status_query = $wdbc->query()
            ->select('*')
            ->from(TBN::PROJECTS->value)
            ->where('id', $_SESSION['project_id'])
            ->exec();
    }

    /* Инициализация по умолчанию */
    $premier        = '...';
    $status         = '...';
    $stack          = '...';
    $communities    = '...';
    $experts        = '...';
    $tags           = '...';
    $name           = (isset($params['name_default']) ? $params['name_default'] : '');
    $icon           = (isset($params['icon_default']) ? $params['icon_default'] : '');
    $description    = '...';

    //$page = (isset($params['page']) ? $params['page']: '');

    $html = '';
    if ($status_query) { // Сведения для проекта найдены
        $array_data = $wdbc->query()->responce(); // $wdbc->query()->responce() // value="<?= $cur_idx

        foreach ($array_data as $data) {
            switch ($params["for"]) {
                case 'properties':
                    if (isset($data['premier']))         $premier        = $data['premier'];
                    if (isset($data['status']))          $status         = $data['status'];
                    if (isset($data['stack']))           $stack          = $data['stack'];
                    if (isset($data['communities']))     $communities    = $data['communities'];
                    if (isset($data['experts']))         $experts        = $data['experts'];
                    
                    break;
                case 'icon':
                case 'url_icon':
                    if (isset($data['icon']))            $icon           = '/assets/frontend/icons/avatars_projects/' . $data['icon']; // avatar ?
                    break;
                case 'name':
                    if (isset($data['name']))            $name           = $data['name'];
                    break;
                case 'description':
                    if (isset($data['description']))     $description    = $data['description'];
                    break;
                case 'tags':
                    if (isset($data['tags']))            $tags           = json_decode($data['tags']);
                    break;
                case 'stack':
                    if (isset($data['stack']))           $stack          = json_decode($data['stack']);
                    break;
                case 'team':
                    if (isset($data['team']))            $team           = json_decode($data['team']);
                    break;

            }
        }
    } // сведения о проекте не найдены. Создаем новый с данными по умолчанию.

    switch ($params["for"]) {
        case 'properties':
            $html_select = query_property_option('status');
            $html .= '
            <string>Дата начала:                    <input class="contentProperty" id="premier"          value="' . $premier . '"        type="date"         readonly /></string>                                       
            <span>
                <string >Статус:                    
                <input class="contentProperty" id="status"           value="' . $status . '"         name="selectStatus"  readonly />
                    '.$html_select.'
                </string>
            </span>';

            /*
                <string>Стек:                           <input class="contentProperty" id="stack"            value="' . $stack . '"          type="text"         readonly /></string>
                <string>Оценка сообщества:              <input class="contentProperty" id="communities"      value="' . $communities . '"    type="text"         readonly /></string>  
                <string>Оценка знатаков:                <input class="contentProperty" id="experts"          value="' . $experts . '"        type="text"         readonly /></string>
            */

            /*  <string>Популярные теги проекта:        <input class="contentProperty" id="tags"           value="'.$tags.'"           type="text"         readonly /></string> */
            break;
        case 'icon':
            $html .= '<img id="project" class="avatar" src="' . $icon . '" alt="..." style="width: 150px; height: 150px; border-radius: 20px;">';
            break;
        case 'url_icon':
            $html .= $icon;
            break;
        case 'name':
            $html .= '<input class="contentProperty" id="' . $params["for"] . '"  value="' . $name . '" readonly/>';
            break;
        case 'description':
            $html .= '<textarea class="contentProperty" oninput="resizeTextarea.call(this);" id="' . $params["for"] . '" style="width: 100%;" readonly>' . $description . '</textarea>';
            break;
        case 'tags':
            if (isset($data[$params["for"]])) {
                $tags = json_decode($data[$params["for"]]);
                $html .= wrapperHtmlA(...$tags);
            }
            break;
        case 'stack':
            if (isset($data[$params["for"]])) {
                $stack = json_decode($data[$params["for"]]);
                $html .= wrapperHtmlLabel(...$stack);
            }
            break;
        case 'team':
            if (isset($data[$params["for"]])) {
                $team = json_decode($data[$params["for"]]);

                $params_list = array(
                    'for' => 'project',
                    'data_users' => $team
                );

                $html .= psql_query_properties_user($params_list, $smarty);

                // $html .= wrapperHtmlLabel(...$team);
            }
            break;
        case 'screenshots':
            if (isset($data[$params["for"]])) {
                $screenshots = json_decode($data[$params["for"]]);

                foreach($screenshots as $screenshot){
                    $html .= '
                        <image style="box-shadow: 0 0 4px 0 rgba(0, 0, 0, 0.08), 0 2px 4px 0 rgba(0, 0, 0, 0.12);" src="/assets/frontend/img/' .  $screenshot . '"/> <!-- class="avatar" id="imgProfile" width="576" height="1280" data-name="image.png"-->
                    ';
                }
            }

            break;
        case 'feedback':
            if (isset($data[$params["for"]])) {
                $feedbacks = json_decode($data[$params["for"]]);

                $params_list = array(
                    'for' => 'feedback',
                    'data_users' => $feedbacks
                );

                $html .= psql_query_properties_user($params_list, $smarty);

            }
            break;
    }

    return $html;
}

function psql_query_article($params, $smarty)
{
    $html = '';
    if (isset($params['head1']) || isset($params['head2']) || isset($params['head3']))
        $html .= '<article id="' . (isset($params['id']) ? $params['id'] : '') . '" style="' . (isset($params['style']) ? $params['style'] : '') . '" >'; //$html .= '<article'; // class="acticle"

    if (isset($params['head1']))
        $html .= '<h1 class="' . (isset($params['class']) ? $params['class'] : 'HelveticaMain') . '" style="justify-self: start;">' . $params['head1'] . '</h1>';

    if (isset($params['head2']))
        $html .= '<p class="' . (isset($params['class2']) ? $params['class2'] : 'VasekMain') . '" style="justify-self: center;">' . $params['head2'] . '</p>';

    if (isset($params['svg']))
        switch ($params['svg']) {
            case 1:
                $html .= '
                        <svg style="justify-self: center;" xmlns="http://www.w3.org/2000/svg" width="447" height="134" fill="none" viewBox="0 0 447 134">
                            <path fill="#EA5657" d="M16.125 63.25c.667-.833 1.417-1 2.25-.5.875.458 1.083 1.167.625 2.125A114.718 114.718 0 0 0 7.937 87.188c-.375.958-1.062 1.354-2.062 1.187-.917-.375-1.292-1.063-1.125-2.063A119.823 119.823 0 0 1 16.125 63.25Zm21.563.188c.583-.834 1.333-1.042 2.25-.626.791.626 1 1.396.624 2.313a174.07 174.07 0 0 0-9.624 23.688c-.459 1-1.146 1.374-2.063 1.124-.917-.291-1.292-.958-1.125-2a178.418 178.418 0 0 1 9.938-24.5ZM37.812 75c1.084.125 1.626.688 1.626 1.688 0 .374-.167.75-.5 1.124-.292.376-.667.542-1.126.5A91.586 91.586 0 0 0 6.75 79.626c-1.083.125-1.75-.27-2-1.188-.25-.958.125-1.624 1.125-2 10.542-2.291 21.188-2.77 31.938-1.437Zm28.438 3.438c-.708.833-1.542 1.02-2.5.562-.917-.5-1.146-1.25-.688-2.25a37.516 37.516 0 0 0 2-3c.667-1.083.834-2.23.5-3.438-.791-2.083-2.458-3.333-5-3.75-2.458-.291-4.833.146-7.124 1.313-2.292 1.167-4.126 2.604-5.5 4.313-1.292 1.541-2.25 3.312-2.876 5.312-.583 1.958-.312 3.813.813 5.563 1.333 1.541 3.125 2.229 5.375 2.062 2.25-.208 4.188-.98 5.813-2.313a30.945 30.945 0 0 0 4.437-4.624 29.524 29.524 0 0 1 4.563-4.563c1-.625 1.874-.604 2.624.063.792.666.792 1.416 0 2.25-.333.541-.541 1.291-.624 2.25a29.464 29.464 0 0 0-.563 3.25c-.25 2.083.583 3.75 2.5 5 .708.75.708 1.52 0 2.312-.875.625-1.77.625-2.688 0-2.541-1.917-3.729-4.354-3.562-7.313.167-1.458.417-2.916.75-4.374.083-1.334.604-2.48 1.563-3.438.874.75 1.75 1.52 2.624 2.313a46.331 46.331 0 0 0-5.937 6.187c-1.792 2.25-4.104 4-6.938 5.25-2.874 1.167-5.791 1.313-8.75.438-2.958-1.042-4.833-2.917-5.624-5.626-.626-2.624-.376-5.187.75-7.687a18.638 18.638 0 0 1 4.937-6.438c2.292-2 5.042-3.437 8.25-4.312 3.25-.917 6.375-.688 9.375.688 2.75 1.5 4.333 3.645 4.75 6.437a7.108 7.108 0 0 1-.938 4 47.184 47.184 0 0 1-2.312 3.563Zm15.375-15.313c.583-.833 1.27-1 2.063-.5.833.458 1.062 1.167.687 2.125-4 7.25-7.23 14.833-9.688 22.75-.458.917-1.124 1.27-2 1.063-.874-.25-1.229-.896-1.062-1.938a126.88 126.88 0 0 1 10-23.5Zm18.937.188c.542-.792 1.25-.98 2.126-.563.791.583.979 1.313.562 2.188a193.562 193.562 0 0 0-8.375 23.437c-.417.958-1.063 1.313-1.938 1.063-.874-.25-1.25-.876-1.124-1.876a191.206 191.206 0 0 1 8.749-24.25Zm3.938-.75c1.042.124 1.562.645 1.562 1.562 0 .417-.166.792-.5 1.125-.291.333-.645.5-1.062.5a75.412 75.412 0 0 0-27.125 2.563c-1 .124-1.625-.25-1.875-1.126-.25-.916.104-1.562 1.063-1.937C85.686 62.667 95 61.77 104.5 62.562Zm9.875 5.937c.75-.583 1.479-.583 2.187 0 .584.708.584 1.438 0 2.188a27.026 27.026 0 0 0-1.75 2.5c-1.041 1.541-1.791 3.291-2.25 5.25-.416 1.958.063 3.708 1.438 5.25 1.375 1.333 2.917 1.916 4.625 1.75 1.708-.167 3.313-.75 4.813-1.75 3.291-2.126 5.624-5.021 7-8.688 1.041-3.292.312-6.063-2.188-8.313-1.167-.833-2.5-1.208-4-1.124-1.667.166-3.208.77-4.625 1.812A15.495 15.495 0 0 0 116.062 71a27.808 27.808 0 0 0-2.562 4.438 125.33 125.33 0 0 0-4.625 10.874 231.18 231.18 0 0 0-5.063 14.25 279.97 279.97 0 0 0-7.562 29c-.333.876-.958 1.25-1.875 1.126-.875-.376-1.23-1.021-1.063-1.938.25-1.333.521-2.667.813-4a260.197 260.197 0 0 1 9-31.75 247.652 247.652 0 0 1 5.563-14.313 40.868 40.868 0 0 1 5.874-10.75A16.84 16.84 0 0 1 119.188 64c1.833-1.083 3.791-1.604 5.874-1.563 4.25.5 7.084 2.792 8.5 6.876.626 2.083.626 4.145 0 6.187-.624 2-1.604 3.854-2.937 5.563a21.941 21.941 0 0 1-4.813 4.812 14.336 14.336 0 0 1-6.25 2.625c-2.25.25-4.333-.23-6.25-1.438-1.916-1.208-3.166-2.958-3.75-5.25-.416-2.458-.104-4.812.938-7.062a28.086 28.086 0 0 1 3.875-6.25Zm45.125 9.938c-.708.833-1.542 1.02-2.5.562-.917-.5-1.146-1.25-.688-2.25a37.063 37.063 0 0 0 2-3c.667-1.083.834-2.23.5-3.438-.791-2.083-2.458-3.333-5-3.75-2.458-.291-4.833.146-7.124 1.313-2.292 1.167-4.126 2.604-5.5 4.313-1.292 1.541-2.25 3.312-2.876 5.312-.583 1.958-.312 3.813.813 5.563 1.333 1.541 3.125 2.229 5.375 2.062 2.25-.208 4.188-.98 5.812-2.313a30.95 30.95 0 0 0 4.438-4.624 29.521 29.521 0 0 1 4.562-4.563c1-.625 1.876-.604 2.626.063.791.666.791 1.416 0 2.25-.334.541-.542 1.291-.626 2.25a29.462 29.462 0 0 0-.562 3.25c-.25 2.083.583 3.75 2.5 5 .708.75.708 1.52 0 2.312-.875.625-1.771.625-2.688 0-2.541-1.917-3.729-4.354-3.562-7.313.167-1.458.417-2.916.75-4.374.083-1.334.604-2.48 1.562-3.438.876.75 1.75 1.52 2.626 2.313A46.335 46.335 0 0 0 156 82.124c-1.792 2.25-4.104 4-6.938 5.25-2.874 1.167-5.791 1.313-8.75.438-2.958-1.042-4.833-2.917-5.624-5.626-.626-2.624-.376-5.187.75-7.687a18.628 18.628 0 0 1 4.937-6.438c2.292-2 5.042-3.437 8.25-4.312 3.25-.917 6.375-.688 9.375.688 2.75 1.5 4.333 3.645 4.75 6.437a7.105 7.105 0 0 1-.938 4 47.177 47.177 0 0 1-2.312 3.563Zm18.125-12.5c1.083-.167 1.833.25 2.25 1.25.167 1.083-.25 1.833-1.25 2.25-4.25.958-6.833 3.541-7.75 7.75-.25 1.916.146 3.604 1.187 5.062 1.084 1.417 2.584 2.292 4.5 2.625 2.042.292 3.876-.104 5.5-1.188 1.667-1.083 2.938-2.5 3.813-4.25a10.78 10.78 0 0 0 1.187-5.687c-.25-1.708-1.187-2.896-2.812-3.563a10.097 10.097 0 0 0-2.5-.687 20.95 20.95 0 0 1-3.188-.25 5.819 5.819 0 0 1-2.687-1.438 53.9 53.9 0 0 1-2.187-2.187c-.459-.542-.626-1.125-.5-1.75.166-.667.604-1.104 1.312-1.313a74.322 74.322 0 0 0 10.688-3.062 46.97 46.97 0 0 0 9.5-4.438c4.791-3.083 7.895-7.374 9.312-12.874.375-1.334.542-2.688.5-4.063 0-1.292-.229-2.438-.688-3.438a1.227 1.227 0 0 0-.437-.374c-.25-.084-.5-.146-.75-.188a7.834 7.834 0 0 0-2.75.375c-4.917 1.458-9.125 4.083-12.625 7.875-2 2.042-3.729 4.396-5.188 7.063-1.458 2.666-2.062 5.5-1.812 8.5 0 .5-.188.937-.562 1.312-.376.333-.792.5-1.25.5-1.042 0-1.646-.604-1.813-1.813-.25-4.041.708-7.791 2.875-11.25a38.164 38.164 0 0 1 7-8.687 32.17 32.17 0 0 1 8.312-5.438 21.703 21.703 0 0 1 6.75-2c2.834-.25 4.792.938 5.876 3.563.958 3.167.937 6.354-.063 9.563-1.917 6.5-5.771 11.479-11.563 14.937A59.084 59.084 0 0 1 186 63.063a78.107 78.107 0 0 1-10.562 3c.25-1 .52-2 .812-3 .792 1 1.688 1.854 2.688 2.562a4.449 4.449 0 0 0 1.812.25c.667 0 1.333.063 2 .188 2.708.374 4.896 1.604 6.562 3.687a7.14 7.14 0 0 1 1.313 3.75 12.943 12.943 0 0 1-.25 4 15.104 15.104 0 0 1-3.313 6.688c-1.791 2.041-3.979 3.374-6.562 4-2.583.624-5.104.374-7.562-.75-2.376-1.209-4.021-2.98-4.938-5.313-.917-2.333-1-4.75-.25-7.25 1.667-4.792 4.958-7.77 9.875-8.938Zm18.687 23.624c-.958.459-1.75.25-2.374-.624-.459-.959-.25-1.75.624-2.376 9.876-7.666 19.167-16 27.876-25 .666-.583 1.354-.666 2.062-.25.75.417 1.021 1.063.812 1.938A193.403 193.403 0 0 0 219.688 88c-.376 1-1.084 1.396-2.126 1.188-.958-.376-1.354-1.084-1.187-2.126a186.346 186.346 0 0 1 5.563-24.75c1 .584 1.979 1.167 2.937 1.75a262.82 262.82 0 0 1-28.563 25.5Zm30.126-6.874c-.459.041-.855-.126-1.188-.5-.333-.376-.5-.771-.5-1.188 0-.958.562-1.5 1.688-1.625A91.328 91.328 0 0 0 235.75 78a35.444 35.444 0 0 0 8.938-3.063 18.983 18.983 0 0 0 6.437-4.874c.792-.876 1.167-1.855 1.125-2.938-.125-.5-.458-.833-1-1a4.9 4.9 0 0 0-1.438-.375c-2.916-.292-5.604.25-8.062 1.625-2.458 1.375-4.333 3.354-5.625 5.938-1.167 2.458-1.542 5.02-1.125 7.687.208 1.25.812 2.23 1.812 2.938a7.018 7.018 0 0 0 3 1.062A13.095 13.095 0 0 0 247 83.437a27.878 27.878 0 0 0 6.188-4.062c.791-.667 1.583-.667 2.374 0 .626.792.626 1.583 0 2.375-2.541 2.292-5.541 4.146-9 5.563-3.416 1.416-6.812 1.479-10.187.187-2.25-1.083-3.708-2.688-4.375-4.813-.625-2.124-.688-4.374-.188-6.75.5-2.374 1.334-4.458 2.5-6.25 2.042-3 4.771-5.124 8.188-6.374 1.583-.584 3.292-.917 5.125-1 1.875-.126 3.604.145 5.187.812 1.709.833 2.646 2.208 2.813 4.125-.042 1.792-.646 3.396-1.813 4.813A22.778 22.778 0 0 1 246 78a40.329 40.329 0 0 1-9.562 3.188 103.48 103.48 0 0 1-10 1.5ZM271 63.25c.667-.833 1.417-1 2.25-.5.875.458 1.083 1.167.625 2.125a114.777 114.777 0 0 0-11.063 22.313c-.374.958-1.062 1.354-2.062 1.187-.917-.375-1.292-1.063-1.125-2.063A119.803 119.803 0 0 1 271 63.25Zm21.562.188c.584-.834 1.334-1.042 2.25-.626.792.626 1 1.396.626 2.313a174.21 174.21 0 0 0-9.626 23.688c-.458 1-1.145 1.374-2.062 1.124-.917-.291-1.292-.958-1.125-2a178.466 178.466 0 0 1 9.937-24.5ZM292.688 75c1.083.125 1.624.688 1.624 1.688 0 .374-.166.75-.5 1.124-.291.376-.666.542-1.124.5a91.589 91.589 0 0 0-31.063 1.313c-1.083.125-1.75-.27-2-1.188-.25-.958.125-1.624 1.125-2 10.542-2.291 21.188-2.77 31.938-1.437Zm12.187-11.938c.667-.833 1.417-1 2.25-.5.833.459 1.042 1.188.625 2.188a120.333 120.333 0 0 0-10.188 22.375c-.5.958-1.208 1.313-2.124 1.063-.917-.25-1.271-.896-1.063-1.938a124.794 124.794 0 0 1 10.5-23.188Zm-7.687 24.75c-1 .376-1.75.146-2.25-.687-.459-.833-.271-1.563.562-2.188A268.873 268.873 0 0 0 327.188 64c.708-.375 1.374-.292 2 .25.5.583.583 1.25.25 2-3.5 7.5-6.459 15.188-8.876 23.063-.416 1-1.104 1.374-2.062 1.124-.917-.25-1.292-.916-1.125-2a194.768 194.768 0 0 1 9.187-23.874l2.25 2.25a266.794 266.794 0 0 1-31.624 21Zm29.25 3c-1.042.167-1.688-.187-1.938-1.062-.208-.917.146-1.604 1.062-2.063a22.401 22.401 0 0 0 5.376-2.437 103.522 103.522 0 0 0 5-3.25l11.124-7.5c.917-.458 1.605-.27 2.063.563.5.791.354 1.52-.437 2.187L337.312 85a40.235 40.235 0 0 1-10.874 5.813Zm20.5-28.25c.916.417 1.25 1.084 1 2-.209.917-.834 1.292-1.876 1.126-1.958-.5-3.833-.105-5.624 1.187-1.626 1.083-2.855 2.625-3.688 4.625-.833 1.958-.5 3.708 1 5.25.708.583 1.542.854 2.5.813a8.247 8.247 0 0 0 2.688-.688c2-.875 3.374-2.313 4.124-4.313.459-.958 1.126-1.312 2-1.062.917.25 1.292.896 1.126 1.938-1.25 3.374-3.584 5.645-7 6.812a8.97 8.97 0 0 1-4.313.438c-1.417-.209-2.667-.876-3.75-2-1.958-2.417-2.458-5.126-1.5-8.126.958-2.666 2.687-4.854 5.187-6.562 2.542-1.708 5.25-2.188 8.126-1.438Zm3.25 1.75c.458-.958 1.145-1.312 2.062-1.062.917.25 1.271.896 1.062 1.938-1.416 4-2.75 8.083-4 12.25A56.332 56.332 0 0 0 347.125 90c-.167 1.042-.729 1.563-1.687 1.563-.917 0-1.417-.521-1.5-1.563.208-4.417.937-8.75 2.187-13 1.25-4.292 2.604-8.52 4.063-12.688Z"/>
                            <path fill="#EA5657" d="M348.916 89.535a1.5 1.5 0 1 0-2.755 1.187l2.755-1.187Zm25.468 6.644-.344-1.46.344 1.46Zm23.032-33.522-.005 1.5.005-1.5Zm15.573 22.759-.617-1.367.617 1.367Zm28.911-32.31a1.5 1.5 0 0 0-1.846-1.044l-13.009 3.609a1.5 1.5 0 1 0 .802 2.89l11.563-3.207 3.208 11.563a1.5 1.5 0 1 0 2.891-.802L441.9 53.107Zm-95.739 37.616c1.179 2.736 3.739 5.598 8.35 7.187 4.576 1.578 11.091 1.878 20.216-.27l-.687-2.92c-8.79 2.069-14.688 1.686-18.551.354-3.828-1.32-5.734-3.592-6.573-5.538l-2.755 1.187Zm28.566 6.917c11.612-2.734 22.4-11.35 27.903-19.321 2.712-3.93 4.383-8.051 3.799-11.395-.307-1.76-1.237-3.262-2.842-4.287-1.557-.995-3.636-1.47-6.165-1.48l-.011 3c2.202.008 3.653.428 4.561 1.008.86.549 1.332 1.3 1.502 2.275.371 2.124-.701 5.39-3.313 9.174-5.147 7.456-15.34 15.568-26.121 18.106l.687 2.92Zm22.695-36.482c-13.932-.049-21.024 11.063-18.669 20.1 1.188 4.56 4.757 8.383 10.671 9.786 5.845 1.386 13.876.398 24.183-4.26l-1.235-2.734c-9.98 4.51-17.3 5.25-22.255 4.075-4.887-1.16-7.566-4.19-8.461-7.623-1.811-6.95 3.598-16.386 15.755-16.344l.011-3Zm16.185 25.626c11.706-5.29 19.645-17.495 28.153-32.537l-2.611-1.477c-8.582 15.172-16.097 26.453-26.777 31.28l1.235 2.734Z"/>
                        </svg>';
                break;
            case 2:
                $html .= '
                        <div style="display: flex; justify-self: center; align-items: center;">
                            <p class="VasekMain">Аллеи Славы</p>
                            <svg xmlns="http://www.w3.org/2000/svg" width="94" height="83" fill="none" viewBox="0 0 94 83">
                                <path stroke="#EA5657" stroke-linecap="round" stroke-width="3" d="M11.789 67.475C25.731 44.632 53.615-.423 53.615 2.102c0 2.338 1.526 46.36 2.459 72.907.067 1.921-2.352 2.808-3.558 1.31l-35.427-44c-.968-1.204-.266-3.004 1.261-3.233l71.687-10.76c2.119-.319 3.187 2.466 1.399 3.646L2 81"/>
                            </svg>
                        </div>';
                break;
        }

    if (isset($params['head3']))
        $html .= '<h1 class="' . (isset($params['class']) ? $params['class'] : 'HelveticaMain') . '" style="justify-self: end;">' . $params['head3'] . '</h1>';

    if (isset($params['head1']) || isset($params['head2']) || isset($params['head3']))
        $html .= '</article>';

    return $html;
}

function psql_query_authors($params, $smarty)
{
    $html = '';

    // TODO:

    return $html;
}

function psql_query_teams($params, $smarty)
{
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
    if ($status) {
        $array_data = $wdbc->query()->responce(); // $wdbc->query()->responce() // value="<?= $cur_idx


        /*foreach($array_data as $data){
                $html = $html.
                    '<div class="item" style="">
                    
                    </div>';
            }*/

        for ($i = 0; $i < 1; $i++) {
            $html = $html .
                '<div class="item-of-teams" style="display: block; "> <!-- none / block -->

                    </div>';
        }

        return $html;
    }

    return $html;
}

function psql_query_feedback($params, $smarty)
{
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
    if ($status) {
        $array_data = $wdbc->query()->responce(); // $wdbc->query()->responce() // value="<?= $cur_idx


        /*foreach($array_data as $data){
                $html = $html.
                    '<div class="item" style="">
                    
                    </div>';
            }*/

        for ($i = 0; $i < 1; $i++) {
            $html = $html .
                '<div class="item-of-feedback" style="display: block; "> <!-- none / block -->

                    </div>';
        }

        return $html;
    }

    return $html;
}

function psql_query_screenshots($params, $smarty)
{
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
    if ($status) {
        $array_data = $wdbc->query()->responce(); // $wdbc->query()->responce() // value="<?= $cur_idx


        /*foreach($array_data as $data){
                $html = $html.
                    '<div class="item" style="">
                    
                    </div>';
            }*/

        for ($i = 0; $i < 1; $i++) {
            $html = $html .
                '<div class="item-of-screenshots" style="display: block; "> <!-- none / block -->

                </div>';
        }

        return $html;
    }

    return $html;
}

function psql_query_vacancy($params, $smarty)
{
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
    if ($status) {
        $array_data = $wdbc->query()->responce(); // $wdbc->query()->responce() // value="<?= $cur_idx


        /*foreach($array_data as $data){
                $html = $html.
                    '<div class="item" style="">
                    
                    </div>';
            }*/

        for ($i = 0; $i < 1; $i++) {
            $html = $html .
                '<div class="item-of-screenshots" style="display: block; "> <!-- none / block -->

                </div>';
        }

        return $html;
    }

    return $html;
}

function psql_query_properties_vacancy($params, $smarty)
{
    if (empty($params["for"])) return '';

    global $wdbc;

    $status_query = false;
    if (isset($_SESSION['vacancy_id'])) { /* 'projects' */
        $status_query = $wdbc->query()
            ->select('*')
            ->from(TBN::VACANCIES->value)
            ->where('id', $_SESSION['vacancy_id'])
            ->exec();
    }

    /* Инициализация по умолчанию */
    $name        = '...';
    $about       = '...';
    $create      = '...'; // data;
    $duties      = '...';
    $tags        = '...';
    $condidats   = '...';
    $speciality  = '...';
    $project_id  = '...'; // !!! $_SESSION['project_id']
    $status      = '...';

    $del = 'false';
    if (empty($params["del"])) $del = $params["del"];

    /*$premier        = '...';
    $status         = '...';
    $stack          = '...';
    $communities    = '...';
    $experts        = '...';
    $tags           = '...';
    $name           = (isset($params['name_default']) ? $params['name_default']: '');
    $icon           = (isset($params['icon_default']) ? $params['icon_default']: '');
    $about          = '...';*/

    $html = '';
    if ($status_query) { // Сведения для проекта найдены
        $array_data = $wdbc->query()->responce(); // $wdbc->query()->responce() // value="<?= $cur_idx

        foreach ($array_data as $data) {
            switch ($params["for"]) {
                case 'properties':
                    if (isset($data['name']))            $name               = $data['name'];
                    if (isset($data['about']))     $about        = $data['about'];
                    if (isset($data['create']))          $create             = $data['create'];
                    if (isset($data['status']))          $status             = $data['status'];
                    if (isset($data['duties']))          $duties             = $data['duties'];
                    if (isset($data['tags']))            $tags               = $data['tags'];
                    if (isset($data['condidats']))       $condidats          = $data['condidats'];
                    if (isset($data['speciality']))      $speciality         = $data['speciality'];
                    if (isset($data['project_id']))      $project_id         = $data['project_id'];

                    /*if(isset($data['premier']))         $premier        = $data['premier'];
                    if(isset($data['status']))          $status         = $data['status'];
                    if(isset($data['stack']))           $stack          = $data['stack'];
                    if(isset($data['communities']))     $communities    = $data['communities'];
                    if(isset($data['experts']))         $experts        = $data['experts'];
                    if(isset($data['tags']))            $tags           = $data['tags'];*/
                    break;
                case 'icon':
                    if (isset($data['icon']))            $icon           = '/assets/frontend/icons/avatars_vacancies/' . $data['icon']; // avatar ?
                    break;
                case 'name':
                    if (isset($data['name']))            $name           = $data['name'];
                    break;
                case 'about':
                    if (isset($data['about']))            $about         = $data['about'];
                    if (isset($data['description']))      $description   = $data['description'];
                    $about = $description;
                    break;
                case 'speciality':
                    if (isset($data['speciality']))      $speciality     = $data['speciality'];
                    break;
                case 'tags':
                    if (isset($data['tags']))            $tags           = json_decode($data['tags']); // Преобразовать id -> name;
                    break;
                case 'duties':
                    if (isset($data['duties']))          $duties         = json_decode($data['duties']);
                    break;
            }
        }
    } // сведения о проекте не найдены. Создаем новый с данными по умолчанию.

    /*if(isset($data['name']))            $name               = $data['name'];
    if(isset($data['about']))           $about              = $data['about'];
    if(isset($data['create']))          $create             = $data['create'];
    if(isset($data['status']))          $status             = $data['status'];
    if(isset($data['duties']))          $duties             = $data['duties'];
    if(isset($data['tags']))            $tags               = $data['tags'];
    if(isset($data['condidats']))       $condidats          = $data['condidats'];
    if(isset($data['speciality']))      $speciality         = $data['speciality'];
    if(isset($data['project_id']))      $project_id         = $data['project_id'];*/

    switch ($params["for"]) {
        case 'properties':
            $html .= '
            <string>Дата создания:                    <input id="date-preview"          value="' . $create . '"        type="date"         readonly /></string>                                       
            <span>
                <label for="select_status">Статус:  <input id="input_status"            value="' . $status . '"         name="selectStatus" readonly /></label> <!-- hidden type="hidden" -->
                <select name="Status" id="select_status" hidden> 
                    <option value="Показать">Показать</option>
                    <option value="Скрыть"  >Скрыть</option>
                    <option value="Закрыть" >Закрыть</option>
                </select>
            </span>
            <string>Специальность:              <input id="speciality"      value="' . $speciality . '"    type="text"         readonly /></string>  
            <string>Теги:                           <input id="tags"                   value="' . $tags . '"          type="text"         readonly /></string>';
            break;
        case 'icon':
            $html .= '<img class="avatar-project" src="' . $icon . '" alt="..." style="width: 150px; height: 150px; border-radius: 20px;">';
            break;
        case 'name':
            $html .= '<input class="contentProperty" id="name" style="font-family: \'Vasek\', arial; font-size: 4vw; text-align: center; color: #EA5657; margin: 0; line-height: .8em; white-space:nowrap;" value="' . $name . '" readonly/>';
            break;
        case 'about':
            $html .= '<textarea class="contentProperty" id="description" style="width: 100%;" readonly>' . $about . '</textarea>';
            break;
        case 'duties':
            // $duties;
            $html .= '<ul class="contentProperty" id="duties" style="padding: 0; ">';
            // wrapperHtmlLi();
            foreach ($duties as $duty) {
                $html .= '<li>
                    <div class="cardDuty" style="display: grid; grid-template-columns: 1fr auto; column-gap: 0%; align-items: center; ">
                        <button onclick="this.parentNode.remove();" class="buttonDuty" style="display: none;"> <!-- hidden visibility: hidden; none -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="6 8 20 20">
                                <path stroke="#F6F6F6" stroke-linecap="round" d="M10.903 14.904 15.5 19.5m0 0 4.597 4.596M15.499 19.5l4.597-4.596M15.499 19.5l-4.596 4.596"></path>
                            </svg>
                        </button>
                        <span style="margin: 0; padding-right: 3vw;" onclick="loadDuty.call(this);">
                            ' . $duty . '
                        </span>
                    </div>
                </li>';
            }
            $html .= '</ul>';
            /*$html .= '<li>
                            <div class="cardDuty" style="display: grid; grid-template-columns: 1fr auto; column-gap: 0%; align-items: center; ">
                                <button onclick="this.parentNode.remove();" class="buttonDuty" style="display: none;"> <!-- hidden visibility: hidden; none -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="6 8 20 20">
                                        <path stroke="#F6F6F6" stroke-linecap="round" d="M10.903 14.904 15.5 19.5m0 0 4.597 4.596M15.499 19.5l4.597-4.596M15.499 19.5l-4.596 4.596"></path>
                                    </svg>
                                </button>
                                <span style="margin: 0; padding-right: 3vw;" onclick="loadDuty.call(this);">
                                    Участие в разработке архитектуры и функций системы автоматизации лабораторных работ.
                                    Участие в разработке архитектуры и функций системы автоматизации лабораторных работ.
                                    Участие в разработке архитектуры и функций системы автоматизации лабораторных работ.
                                    Участие в разработке архитектуры и функций системы автоматизации лабораторных работ.
                                    Участие в разработке архитектуры и функций системы автоматизации лабораторных работ.
                                </span>
                            </div>
                        </li>
                        <li>
                            <div class="cardDuty" style="display: grid; grid-template-columns: 1fr auto; column-gap: 0%; align-items: center;">
                                <button onclick="this.parentNode.remove();" class="buttonDuty" style="display: none;"> <!-- hidden visibility: hidden; none -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="6 8 20 20">
                                        <path stroke="#F6F6F6" stroke-linecap="round" d="M10.903 14.904 15.5 19.5m0 0 4.597 4.596M15.499 19.5l4.597-4.596M15.499 19.5l-4.596 4.596"></path>
                                    </svg>
                                </button>
                                <span style="margin: 0; padding-right: 3vw;" onclick="loadDuty.call(this);">
                                    Участие в разработке архитектуры и функций системы автоматизации лабораторных работ.
                                    Участие в разработке архитектуры и функций системы автоматизации лабораторных работ.
                                    Участие в разработке архитектуры и функций системы автоматизации лабораторных работ.
                                    Участие в разработке архитектуры и функций системы автоматизации лабораторных работ.
                                    Участие в разработке архитектуры и функций системы автоматизации лабораторных работ.
                                </span>
                            </div>
                        </li>
                    </ul>';*/

            /*
                        <li class="cardDuty">Проектирование и реализация компонентов системы, включая интерфейсы для студентов и преподавателей.</li>
                        <li class="cardDuty">Разработка алгоритмов автоматической проверки кода на различных языках программирования.</li>
                        <li class="cardDuty">Проектирование и реализация компонентов системы, включая интерфейсы для студентов и преподавателей.</li>
                        <li class="cardDuty">Разработка алгоритмов автоматической проверки кода на различных языках программирования.</li>
                        <li class="cardDuty">Интеграция системы с внешними сервисами.</li>
                        <li class="cardDuty">Написание документации и проведение тестирования разработанных функций.</li>
                        <li class="cardDuty">Участие в код-ревью и обмене знаниями с командой.</li>
                        <li class="cardDuty">Поддержка и улучшение существующих функций системы на основе отзывов пользователей.</li>
                     */
            break;
        case 'speciality':
            $html .= '<input class="contentProperty" id="speciality" value="' . $speciality . '"    type="text"   style="text-align: center;"    readonly />';
            break;
        case 'search':
            $html .= "
                <li onclick=\"resultSearchTags('Adele')\"><a href=\"#\">Adele</a></li>
				<li onclick=\"resultSearchTags('Agnes')\"><a href=\"#\">Agnes</a></li>
				<li onclick=\"resultSearchTags('Billy')\"><a href=\"#\">Billy</a></li>
				<li onclick=\"resultSearchTags('Bob')\"><a href=\"#\">Bob</a></li>
				<li onclick=\"resultSearchTags('Calvin')\"><a href=\"#\">Calvin</a></li>
				<li onclick=\"resultSearchTags('Christina')\"><a href=\"#\">Christina</a></li>
				<li onclick=\"resultSearchTags('Cindy')\"><a href=\"#\">Cindy</a></li>";
            break;
        case 'tags':
            if (count($tags) === 0) { // strlen($tags) === 0
                $html .= '<input id="tags"      value="отсутствуют"    type="text"   style="text-align: center;"    readonly />';
            } else {
                $style = 'justify-items: ';
                $array_tags = $tags; //explode(",", $tags);
                $style .= (count($array_tags) > 5 ? 'end' : 'center') . ';'; // ?
                $html .= '<div class="contentProperty" id="tags" class="resultTag" style="width: 100%; ' . $style . '">'; // result -> tags

                $html .= wrapperHtmlLabel(...$array_tags);

                /*foreach($array_tags as $tag){
                    $style ='';
                    //$style = ($del != 'true' ? 'padding-right: 5px;' : '');

                    $html .= '<label class="labelTag" style="padding-right: 5px;">'.$tag.'<button onclick="this.parentNode.remove();" class="buttonTag" style="display: none;"> <!-- hidden visibility: hidden; -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="7 10 20 20">
                                <path stroke="#F6F6F6" stroke-linecap="round" d="M10.903 14.904 15.5 19.5m0 0 4.597 4.596M15.499 19.5l4.597-4.596M15.499 19.5l-4.596 4.596"></path>
                            </svg>
                        </button>';

                    // if($del != 'false')
                        /*$html .= '<button onclick="this.parentNode.remove();" class="buttonTag" style="display: none;"> <!-- hidden visibility: hidden; -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="7 10 20 20">
                                <path stroke="#F6F6F6" stroke-linecap="round" d="M10.903 14.904 15.5 19.5m0 0 4.597 4.596M15.499 19.5l4.597-4.596M15.499 19.5l-4.596 4.596"></path>
                            </svg>
                        </button>';*/

                /*switch($del){
                        case 'false':
                            $html .= '<button onclick=\"this.parentNode.remove();\" class=\"buttonTag\">
                            <svg xmlns=\"http://www.w3.org/2000/svg\" fill=\"none\" viewBox=\"7 10 20 20\">
                                <path stroke=\"#F6F6F6\" stroke-linecap=\"round\" d=\"M10.903 14.904 15.5 19.5m0 0 4.597 4.596M15.499 19.5l4.597-4.596M15.499 19.5l-4.596 4.596\"></path>
                            </svg>
                        </button>';
                            break;
                        default:
                            break;
                    }//

                    $html .= '</label>';
                }*/
                $html .= '</div>';

                /*$html .= 
                "<label class=\"labelTag\">C++
                    <button onclick=\"this.parentNode.remove();\" class=\"buttonTag\">
                        <svg xmlns=\"http://www.w3.org/2000/svg\" fill=\"none\" viewBox=\"7 10 20 20\">
                            <path stroke=\"#F6F6F6\" stroke-linecap=\"round\" d=\"M10.903 14.904 15.5 19.5m0 0 4.597 4.596M15.499 19.5l4.597-4.596M15.499 19.5l-4.596 4.596\"></path>
                        </svg>
                    </button>
                </label>";*/
            }
            break;
    }

    return $html;
}

function sortByLength($a, $b)
{
    return strlen($a) - strlen($b);
}

function wrapperHtmlLabel()
{
    $list = func_get_args();
    usort($list, 'sortByLength');
    $content_html = '';
    foreach ($list as $elem)
        $content_html .= '
        <label class="labelTag" style="">' . $elem . '
            <button class="buttonTag display" style="display: none;" > <!-- hidden visibility: hidden; style="display: none;" --> 
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="7 10 20 20">
                    <path stroke="#F6F6F6" stroke-linecap="round" d="M10.903 14.904 15.5 19.5m0 0 4.597 4.596M15.499 19.5l4.597-4.596M15.499 19.5l-4.596 4.596"></path>
                </svg>
            </button>
        </label>'; // template in index.js [add];
    return $content_html;
}

function wrapperHtmlA()
{
    $list = func_get_args();
    usort($list, 'sortByLength');
    $content_html = '';
    foreach ($list as $elem)
        $content_html .= '
        <a class="tag" style="">#' . $elem . '
            <button class="remove display" style="display: none;" > <!-- hidden visibility: hidden; style="display: none;" --> 
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="6 9 20 20">
                    <path stroke="#F6F6F6" stroke-linecap="round" d="M10.903 14.904 15.5 19.5m0 0 4.597 4.596M15.499 19.5l4.597-4.596M15.499 19.5l-4.596 4.596"></path>
                </svg>
            </button>
        </a>'; // template in index.js [add];
    return $content_html;
}

function wrapperHtmlLi()
{
    $list = func_get_args();
    usort($list, 'sortByLength');
    $content_html = '';
    foreach ($list as $elem)
        $content_html .= '
        <li>
            <div class="cardDuty" style=""> <!-- display: grid; grid-template-columns: 1fr auto; column-gap: 0%; align-items: center;  -->
                <button onclick="this.parentNode.remove();" class="buttonDuty display" style="display: none;"> <!-- hidden visibility: hidden; none -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="5.5 9 20 20">
                        <path stroke="#F6F6F6" stroke-linecap="round" d="M10.903 14.904 15.5 19.5m0 0 4.597 4.596M15.499 19.5l4.597-4.596M15.499 19.5l-4.596 4.596"></path>
                    </svg>
                </button>
                <span style="margin: 0; padding-right: 3vw;" onclick="loadDuty.call(this);">
                    ' . $elem . '
                </span>
            </div>
        </li>'; // template in index.js [add];

    return $content_html;
}

function wrapperHtmlSpan()
{
    $list = func_get_args();
    // usort($list,'sortByLength');
    $content_html = '';
    foreach ($list as $elem) {
        $value      = 'Почта';
        $id_name    = 'email';
        $mask       = 'mask_email();';
        $type       = 'email';
        $placeholder = '';
        $sel_email  = '';
        $sel_phone = '';
        $sel_site = '';
        if (filter_var($elem, FILTER_VALIDATE_EMAIL)) {
            $var = 'email';
            $sel_email = 'selected';
        } else if (filter_var($elem, FILTER_VALIDATE_URL)) {
            $value = 'Сайт';
            $id_name = 'site';
            $mask       = 'mask_site();';
            $type       = 'site';
            $sel_site = 'selected';
        } else { // if(preg_match("", $elem))
            $value      = 'Телефон';
            $id_name    = 'phone';
            $mask       = 'mask_phone();';
            $type       = 'tel';
            $placeholder = '+7(___)___-__-__';
            $sel_phone = 'selected';
        }


        $content_html .= '
        <span class="contact">
            <input class="shower_hider" style="font-family: \'Helvetica\';" type="text" value="' . $value . '" readOnly>
            <select name="type" id="pet-select" value="' . $value . '" onchange="selectTypeContact.call(this)" hidden="true">
                <option value="Телефон" ' . $sel_phone . '>Телефон</option>
                <option value="Почта" ' . $sel_email . '>Почта</option>
                <option value="Сайт" ' . $sel_site . '>Сайт</option>
            </select>
            <input class="contentProperty" id="' . $id_name . '" name="' . $id_name . '" type="' . $type . '" oninput="' . $mask . '" maxlength="17" value="' . $elem . '" placeholder="' . $placeholder . '" readOnly/>
            <svg class="drag display" width="32" height="32" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" hidden="true" style="display: none;"> 
                <rect width="48" height="48" fill="white" fill-opacity="0.01"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M19 10.3075C19 12.6865 17.2091 14.615 15 14.615C12.7909 14.615 11 12.6865 11 10.3075C11 7.92854 12.7909 6 15 6C17.2091 6 19 7.92854 19 10.3075ZM15 28.615C17.2091 28.615 19 26.6865 19 24.3075C19 21.9285 17.2091 20 15 20C12.7909 20 11 21.9285 11 24.3075C11 26.6865 12.7909 28.615 15 28.615ZM15 42.615C17.2091 42.615 19 40.6865 19 38.3075C19 35.9285 17.2091 34 15 34C12.7909 34 11 35.9285 11 38.3075C11 40.6865 12.7909 42.615 15 42.615Z" fill="black"/>
                <path fill-rule="evenodd" clip-rule="evenodd" d="M37 10.3075C37 12.6865 35.2091 14.615 33 14.615C30.7909 14.615 29 12.6865 29 10.3075C29 7.92854 30.7909 6 33 6C35.2091 6 37 7.92854 37 10.3075ZM33 28.615C35.2091 28.615 37 26.6865 37 24.3075C37 21.9285 35.2091 20 33 20C30.7909 20 29 21.9285 29 24.3075C29 26.6865 30.7909 28.615 33 28.615ZM33 42.615C35.2091 42.615 37 40.6865 37 38.3075C37 35.9285 35.2091 34 33 34C30.7909 34 29 35.9285 29 38.3075C29 40.6865 30.7909 42.615 33 42.615Z" fill="black"/>
            </svg>
        </span>'; // template in index.js [add];
    }

    return $content_html;
}




/*
"
    <li onclick=\"resultSearchTags('Adele')\"><a href=\"#\">Adele</a></li>
    <li onclick=\"resultSearchTags('Agnes')\"><a href=\"#\">Agnes</a></li>
    <li onclick=\"resultSearchTags('Billy')\"><a href=\"#\">Billy</a></li>
    <li onclick=\"resultSearchTags('Bob')\"><a href=\"#\">Bob</a></li>
    <li onclick=\"resultSearchTags('Calvin')\"><a href=\"#\">Calvin</a></li>
    <li onclick=\"resultSearchTags('Christina')\"><a href=\"#\">Christina</a></li>
    <li onclick=\"resultSearchTags('Cindy')\"><a href=\"#\">Cindy</a></li>";

*/
