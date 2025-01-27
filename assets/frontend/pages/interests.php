<?php
	session_start(); // Продлеваем сессию, запущенную из `action.php`

    $root = $_SERVER['DOCUMENT_ROOT'];

	require_once($root.'/assets/backend/config/paths.php');
	require_once($root.'/assets/backend/config/config_smarty.php');

	if(isset($_SESSION[TRU::icon->name]))
		$smarty->assign(TRU::icon->name, PATH_DEFAULT::PROFILE->value.$_SESSION[TRU::icon->name]); // $root. // '/assets/frontend/icons/avatars_profiles/'

	/*$smarty->assign('icon', 
	(isset($_SESSION[TRU::icon->name]) 
		? PATH_DEFAULT::PROFILE->value.$_SESSION[TRU::icon->name]
		: ICON_DEFAULT::PROFILE->value)); */

	if(isset($_SESSION['project_id'])) unset($_SESSION['project_id']); // Если установлен `project_id`, то `убираем` его.

	$smarty->assign('tab_projects', TBN::PROJECTS->value);
	
	$smarty->assign("CSS_MAIN", STYLE::PROJECTS->value);
	$smarty->assign("MAIN", $root.'/assets/frontend/mains/main_for_interests.php'); // Указываем, что добавляем. (Реализуем и добавляем только основную часть кода);

    $smarty->display($root.'/smarty_dirs/templates/main.tpl' );  // Указываем, куда добавляем и выводим обработанный шаблон.
?>