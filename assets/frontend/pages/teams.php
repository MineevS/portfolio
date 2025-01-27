<?php
	session_start(); // Продлеваем сессию, запущенную из `action.php`

    $root = $_SERVER['DOCUMENT_ROOT'];

	require_once($root.'/assets/backend/config/paths.php');
	require_once($root.'/assets/backend/config/config_smarty.php');

	/*if(isset($_SESSION[TRU::icon->name])){
		$smarty->assign(TRU::icon->name, '/assets/frontend/icons/'.$_SESSION[TRU::icon->name]); // $root.
	}*/
	if(isset($_SESSION[TRU::icon->name]))
		$smarty->assign(TRU::icon->name, PATH_DEFAULT::PROFILE->value.$_SESSION[TRU::icon->name]);

	if(isset($_SESSION['project_id'])) unset($_SESSION['project_id']); // Если установлен `project_id`, то `убираем` его.

	$smarty->assign("CSS_MAIN", STYLE::TEAMS->value);
	$smarty->assign("MAIN", $root.'/assets/frontend/mains/main_for_teams.php'); // Указываем, что добавляем. (Реализуем и добавляем только основную часть кода);
	
	/*$smarty->assign("CSS_TOTAL", STYLE::MAIN->value);*/
    $smarty->display($root.'/smarty_dirs/templates/main.tpl' );  // Указываем, куда добавляем и выводим обработанный шаблон.
?>