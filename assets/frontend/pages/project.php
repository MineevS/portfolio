<?php
	session_start(); // Продлеваем сессию, запущенную из `action.php`

    $root = $_SERVER['DOCUMENT_ROOT'];

	require_once($root.'/assets/backend/config/paths.php');
		require_once($root.'/assets/backend/config/config_smarty.php');

	$smarty->assign('icon', 
	(isset($_SESSION[TRU::icon->name]) 
		? '/assets/frontend/icons/'.$_SESSION[TRU::icon->name] 
		: '/assets/frontend/icons/icon_default_profile.jpg')); 

    $smarty->assign('nameproject', "Новый проект");
    /*
	$smarty->assign('firstname', 
	(isset($_SESSION[TRU::firstname->name]) ? $_SESSION[TRU::firstname->name] : 'firstname'));
    */
/*
	$smarty->assign('lastname', 
	(isset($_SESSION[TRU::lastname->name]) ? $_SESSION[TRU::lastname->name] : 'lastname'));
    */

	$smarty->assign("CSS_MAIN", STYLE::PROFILE->value);
	$smarty->assign("MAIN", $root.'/assets/frontend/mains/main_for_project.php'); // Указываем, что добавляем. (Реализуем и добавляем только основную часть кода);
    
	/*$smarty->assign("CSS_TOTAL", STYLE::MAIN->value);*/
	$smarty->display($root.'/smarty_dirs/templates/main.tpl' );  // Указываем, куда добавляем и выводим обработанный шаблон.
?>