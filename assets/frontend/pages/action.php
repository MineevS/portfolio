<?php
    session_start();

    enum ACTION {
        case registr;
        case login;
        case logout;
        case save_data_profile;
        case load_avatar;
        case load_projects;
    }
/*
    require_once($_SERVER['DOCUMENT_ROOT'].'/assets/backend/config/paths.php');

    require_once($_SERVER['DOCUMENT_ROOT'].TOTAL::CDB->value);              //-> [$dbname, $host, $port, $user, $passwd]; -> './config/config_db.php'
    require_once($_SERVER['DOCUMENT_ROOT'].TOTAL::WDBC->value);             // -> WrapperDataBase(); -> './config/WrapperDataBaseConn.php' 

    $wdbc = new WDBC($dbname, $host, $port, $user, $passwd);
*/
    $root = $_SERVER['DOCUMENT_ROOT'];

    require_once($root.'/assets/backend/config/config_smarty.php');

    $URL = "";
    $last_error_wdbc = 0;
    if(!isset($_POST['action'])) exit();

    switch($_POST['action']){
        case ACTION::registr->name:
            $result = $wdbc->register();

            $last_error_wdbc = $wdbc->last_error();
            /*$URL = ($result 
                ? "index.php?register=success" 
                : "index.php?register=$last_error_wdbc"
            );*/

            echo json_encode(array('register' => ($result ? "success" : "failed"), 
                                    'error_code' => $last_error_wdbc )); // ( $result ?  "0" :  )
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

            echo json_encode(array(
                'save_data_profile' => "success", 
                'error_code' => 0
            ));

            break;
        case ACTION::load_avatar->name;
            if(isset($_FILES['avatar'])){
                $uploaddir = './../icons/avatars'; // . - текущая папка где находится submit.php

                // cоздадим папку если её нет
                if( ! is_dir( $uploaddir ) ) mkdir( $uploaddir, 0777, true);

                $files      = $_FILES; // полученные файлы
                $done_files = array();

                // переместим файлы из временной директории в указанную
                foreach( $files as $file ){
                    $file_name = $file['name'];

                    if( move_uploaded_file( $file['tmp_name'], "$uploaddir/$file_name" ) ){
                        $done_files[] = realpath( "$uploaddir/$file_name" );

                        $_POST['icon'] = "avatars/$file_name";

                        $result = $wdbc->query()->update('info_user')->set('icon')->where('id', $_SESSION['id'])->exec();

                        if($result){
                            $last_error_wdbc = $wdbc->last_error();

                            $icon_path = $_POST['icon'];
                            $_SESSION['icon'] = $icon_path;
                
                            echo json_encode(array(
                                'load_avatar'  => ($result ? "success" : "failed"), 
                                'error_code' => ($last_error_wdbc == null ? 0 : $last_error_wdbc),
                                'icon' => "/assets/frontend/icons/".$icon_path
                            ));
                        }
                    }
                }

                /*$data = $done_files ? array('files' => $done_files ) : array('error' => 'Ошибка загрузки файлов.');
                die( json_encode( $data ) );*/
            }
            break;

            case ACTION::load_projects->name: 

                //$result = $wdbc->load_projects($page_load_projects);

                //$last_error_wdbc = $wdbc->last_error();

                $count = SIZE_LOAD_PAGE::$PROJECT;

                $offset = $_POST['page_load_projects'] * $count;

                $params = array(
                    'select' => '*',
                    'from' => 'info_project',
                    'orderby'=> 'id',
                    'limit'=> "$count",
                    'offset'=> "$offset",
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
    }

   // if($last_error_wdbc != 0) echo "./../".$URL ; else echo $last_error_wdbc; // "Location: ./$URL"; header("Location: ./$URL");

    exit();
?>