<?php
$root = $_SERVER['DOCUMENT_ROOT'];

require_once($root . '/assets/backend/config/paths.php');

define("SMARTY_DIR", $root . '/smarty-5.4.2/libs/');

require_once(SMARTY_DIR . 'Smarty.class.php');    // подключаем файл с описанием класса Smarty

$smarty = new Smarty\Smarty; // создаем экземпляр класса Smarty

//$smarty->setEscapeHtml(true);

// указываем, где находятся Smarty-директории
$smarty->setConfigDir($root . '/smarty_dirs/configs/');
$smarty->setCacheDir($root . '/smarty_dirs/cache/');
$smarty->setCompileDir($root . '/smarty_dirs/templates_c/');
$smarty->setTemplateDir($root . '/smarty_dirs/templates/');
// $smarty->addPluginsDir ($root.'/portfolioSer/smarty_dirs/plugins/'); // old

//$smarty->caching = Smarty\Smarty::CACHING_LIFETIME_CURRENT;

require_once($root.'/assets/backend/config/functions.php');

$smarty->registerPlugin("function", "date_now", "print_current_date");

require_once($_SERVER['DOCUMENT_ROOT'] . TOTAL::CDB->value);             // -> [$dbname, $host, $port, $user, $passwd]; -> './config/config_db.php'
require_once($_SERVER['DOCUMENT_ROOT'] . TOTAL::WDBC->value);             // -> WrapperDataBase(); -> './config/WrapperDataBaseConn.php' 

$wdbc = new WDBC($dbname, $host, $port, $user, $passwd);
$smarty->registerPlugin("function", "query_projects",           "psql_query_projects");
$smarty->registerPlugin("function", "query_interests",          "psql_query_interests");
$smarty->registerPlugin("function", "query_stars",              "psql_query_stars");
$smarty->registerPlugin("function", "query_vacancies",          "psql_query_vacancies");
//$smarty->registerPlugin("function", "query_intelligence",       "psql_query_intelligence");
$smarty->registerPlugin("function", "query_properties_profile", "psql_query_properties_profile");
$smarty->registerPlugin("function", "query_properties_project", "psql_query_properties_project");
$smarty->registerPlugin("function", "query_article",            "psql_query_article");
$smarty->registerPlugin("function", "query_authors",            "psql_query_authors");
$smarty->registerPlugin("function", "query_teams",              "psql_query_teams");
$smarty->registerPlugin("function", "query_feedback",           "psql_query_feedback");
$smarty->registerPlugin("function", "query_screenshots",        "psql_query_screenshots");
$smarty->registerPlugin("function", "query_vacancy",            "psql_query_vacancy");
$smarty->registerPlugin("function", "query_properties_vacancy", "psql_query_properties_vacancy");

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

$smarty->assign("CSS_AOS",  AOS::CSS->value); //
$smarty->assign("AOS", 		AOS::JSX->value); 

$smarty->assign("CSS_TOTAL", STYLE::MAIN->value);

$smarty->assign('SIZE_PAGE_PROJECTS', SIZE_LOAD_PAGE::$PROJECTS);
$smarty->assign('SIZE_PAGE_VACANCIES', SIZE_LOAD_PAGE::$VACANCIES);
$smarty->assign('SIZE_PAGE_TEAMS', SIZE_LOAD_PAGE::$TEAMS);

// $smarty->display("main.tpl");  // выводим обработанный шаблон
?>