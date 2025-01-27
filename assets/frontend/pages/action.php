<?php
session_start();

enum ACTION
{
    case registr;
    case login;
    case logout;
    case save_data_profile;
    case load_projects;
    case save_data_project;
    case load_project;
    case load_avatar_project;
    case save_data_vacancy;
    case check_like_project;
    case show_input_suggestion;
    case order_project_newest;
} // /*case load_avatar;*/
 // /*case load_avatar;*/

function save_img($dir, $tab, $id, $session_icon)
{
    global $wdbc;

    $uploaddir = $dir; // . - текущая папка где находится submit.php // './../icons/avatars_projects' ; avatars/

    // cоздадим папку если её нет
    if (! is_dir($uploaddir)) {
        mkdir($uploaddir, 0777, true);
    } else {
        move_uploaded_file('/assets/frontend/icons/default_avatar_project.jpg', "$uploaddir/default_avatar_project.jpg"); // for project;
        move_uploaded_file('/assets/frontend/icons/default_avatarпше.jpg', "$uploaddir/default_avatar.jpg"); // for profile;
    }

    $files      = $_FILES; // полученные файлы
    $done_files = array();

    // переместим файлы из временной директории в указанную
    foreach ($files as $file) {
        $file_name = $file['name'];

        if (move_uploaded_file($file['tmp_name'], "$uploaddir/$file_name")) {
            $done_files[] = realpath("$uploaddir/$file_name");

            $_POST['icon'] = $file_name; // avatars/

            $result = $wdbc->query()->update($tab)->set('icon')->where('id', $id)->exec(); //  $_SESSION['project_id']

            if ($result) {
                $last_error_wdbc = $wdbc->last_error();

                $icon_path = $_POST['icon'];
                $_SESSION[$session_icon] = $icon_path; // 'icon'

                echo json_encode(array(
                    'load_avatar'  => ($result ? "success" : "failed"),
                    'error_code' => ($last_error_wdbc == null ? 0 : $last_error_wdbc),
                    'icon' => $dir . "/" . $icon_path
                ));
            }
        }
    }
}
/*
    require_once($_SERVER['DOCUMENT_ROOT'].'/assets/backend/config/paths.php');

    require_once($_SERVER['DOCUMENT_ROOT'].TOTAL::CDB->value);              //-> [$dbname, $host, $port, $user, $passwd]; -> './config/config_db.php'
    require_once($_SERVER['DOCUMENT_ROOT'].TOTAL::WDBC->value);             // -> WrapperDataBase(); -> './config/WrapperDataBaseConn.php' 

    $wdbc = new WDBC($dbname, $host, $port, $user, $passwd);
*/
$root = $_SERVER['DOCUMENT_ROOT'];

require_once($root . '/assets/backend/config/config_smarty.php');

$URL = "";
$last_error_wdbc = 0;
if (!isset($_POST['action'])) exit();

/*
    if(isset($_SESSION['project_id']))
        if(array_search($_POST['action'], array(ACTION::registr->name, )))
    */


switch ($_POST['action']) {
    case ACTION::registr->name:
        $result = $wdbc->register();

        $last_error_wdbc = $wdbc->last_error();
        /*$URL = ($result 
                ? "index.php?register=success" 
                : "index.php?register=$last_error_wdbc"
            );*/

        echo json_encode(array(
            'register' => ($result ? "success" : "failed"),
            'error_code' => $last_error_wdbc
        )); // ( $result ?  "0" :  )
        break;
    case ACTION::login->name:
        $result = $wdbc->login($_POST['login'], $_POST['password']);

        $last_error_wdbc = $wdbc->last_error();

        $URL = ($result
            ?  PAGE::PFL->value
            : "index.php?error=$result"
        );

        echo json_encode(array(
            'login'      => ($result ? "success" : "failed"),
            'error_code' => $last_error_wdbc,
            'url'        => $URL
        ));

        break;
    case ACTION::logout->name:
        session_destroy();
        $URL = "/index.php"; // ?logout=true

        echo json_encode(array(
            'logout'      => "success",
            'error_code' => 0,
            'url'        => $URL
        ));
        break;
    case ACTION::save_data_profile->name:
        $result = $wdbc->save_data_profile();

        $last_error_wdbc = $wdbc->last_error();

        // Написать обработчик ошибок;
        if (isset($_FILES['avatar'])) save_img('./../icons/avatars_profiles', TBN::PROFILES->value, $_SESSION['id'], 'icon');
        else echo json_encode(array(
            'save_data_profile' => "success",
            'error_code' => 0
        ));
        break;
    case ACTION::load_projects->name:
        $count = SIZE_LOAD_PAGE::$PROJECTS;
        $offset = $_POST['page_load_projects'] * $count;
        $tab = TBN::PROJECTS->value; //'info_project'
        /*'info_project'*/
        $params = array(
            'select' => '*',
            'from' => "$tab",
            'orderby' => 'id',
            'limit' => "$count",
            'offset' => "$offset",
        );

        $content_html = psql_query_projects($params, $smarty);

        //psql_query_projects($params, $smarty);

        //$content_html = '';
        //if($result) $data = $wdbc->responce();

        echo json_encode(array(
            'load_projects' => "success",
            'error_code' => 0,
            'data' => $content_html
        ));

        break;
    case ACTION::save_data_project->name:
        // Смотреть на наличие `id` проекта. 
        // Если `id` проекта `есть`, то просто `сохранить` данные.
        // Если `нет`, то `создать` проект и `сохранить` данные.

        if (isset($_SESSION['project_id'])) { // ! Не путать $_SESSION['id']- Идентификатор пользователя в системе с $_POST['id'] - Идентификатор существующего(-ей) проекта/вакансии/команды.
            $_POST['project_id'] = $_SESSION['project_id'];

            // Редактирование проекта
            $result = $wdbc->save_data_project();

            $last_error_wdbc = $wdbc->last_error();

            echo json_encode(array(
                'save_data_project' => ($result ? "success" : "failed"),
                'error_code' => $last_error_wdbc,
            ));
        } else {
            // Создание проекта
            $result = $wdbc->create_project();
            $last_error_wdbc = $wdbc->last_error();

            $project_id = '';

            if ($result) $project_id = $wdbc->query()->responce()[0]['id'];

            $_SESSION['project_id'] = $project_id; /* текущий проект */

            echo json_encode(array(
                'save_data_project' => ($result ? "success" : "failed"),
                'error_code' => $last_error_wdbc,
                'project_id' => $project_id /* Сообщаем `идентификатор созданого проекта` */
            ));
        }

        break;
    case ACTION::load_avatar_project->name:
        if (isset($_FILES['avatar'])) {
            save_img('./../icons/avatars_projects', TBN::PROJECTS->value, $_SESSION['project_id'], 'project-icon');
        }
        break;
    case ACTION::save_data_vacancy->name:
        $_POST['vacancy_id'] = $_SESSION['vacancy_id'];

        // Редактирование проекта
        $result = $wdbc->save_data_vacancy();
        $last_error_wdbc = $wdbc->last_error();

        echo json_encode(array(
            'save_data_vacancy' => ($result ? "success" : "failed"),
            'error_code' => $last_error_wdbc,
        ));
        break;
    case ACTION::check_like_project->name: // Установка/снятие лайков на проект;
        $result = $wdbc->check_like_project();
        $last_error_wdbc = $wdbc->last_error();

        $ckeck_like_project = null;
        if ($result) $ckeck_like_project = $wdbc->query()->responce(); // ??? // [0]['id']

        echo json_encode(array(
            'check_like_project' => ($result ? "success" : "failed"),
            'error_code' => $last_error_wdbc,
            'like' => $ckeck_like_project,
            'project_id' => $_POST['project_id']
        ));

        break;
    case ACTION::show_input_suggestion->name: // Подсказка для поиска проектов;
        
        $search = $_POST['search'];
        $tab = TBN::PROJECTS->value; //'info_project'
        $params = array(
            'select' => '*',
            'from' => "$tab",
            'orderby' => 'id',
            'where' => "name",
            'ilike' => "'$search%'",
        );

        $content_html = psql_query_projects($params, $smarty);

        //psql_query_projects($params, $smarty);

        //$content_html = '';
        //if($result) $data = $wdbc->responce();

        echo json_encode(array(
            'load_projects' => "success",
            'error_code' => 0,
            'data' => $content_html // $wdbc->query()->request()
        ));

        break;

        case ACTION::order_project_newest->name: // Подсказка для поиска проектов;
        
            $tab = TBN::PROJECTS->value; //'info_project'
            $params = array(
                'select' => '*',
                'from' => "$tab",
                'orderby' => 'start', // asc добавить
                
            );
    
            $content_html = psql_query_projects($params, $smarty);
    
            //psql_query_projects($params, $smarty);
    
            //$content_html = '';
            //if($result) $data = $wdbc->responce();
    
            echo json_encode(array(
                'load_projects' => "success",
                'error_code' => 0,
                'data' => $content_html // $wdbc->query()->request()
            ));
    
            break;
}

// if($last_error_wdbc != 0) echo "./../".$URL ; else echo $last_error_wdbc; // "Location: ./$URL"; header("Location: ./$URL");

exit();
