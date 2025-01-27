<?php
	session_start(); // Продлеваем сессию, запущенную из `action.php`

	$root = $_SERVER['DOCUMENT_ROOT'];

	require_once($root.'/assets/backend/config/config_smarty.php');

	

	if(isset($_SESSION[TRU::icon->name])){
		$smarty->assign(TRU::icon->name, PATH_DEFAULT::PROFILE->value.$_SESSION[TRU::icon->name]); // '/assets/frontend/icons/avatars_profiles/'
	} 

	if(isset($_SESSION['project_id'])) unset($_SESSION['project_id']); // Если установлен `project_id`, то `убираем` его.

/*
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

	<script>
		AOS.init();
	</script>

	$smarty->assign("CSS_AOS",  AOS::CSS->value); //
	$smarty->assign("AOS", 		AOS::JSX->value); */

	$smarty->assign('tab_projects', TBN::PROJECTS->value); //TABS_NAME
	$smarty->assign('tag_awesome',  TBN::AWESOME->value); 
	$smarty->assign('tab_vacancies', TBN::VACANCIES->value);
	$smarty->assign('limit_vacancies', SIZE_LOAD_PAGE::$VACANCIES);

	$smarty->assign('PAGE_INTERESTS', PAGE::INTERESTS->value);

	$smarty->assign("CSS_MAIN",  STYLE::INDEX->value); // 
	$smarty->assign("MAIN", 	 $root.'/assets/frontend/mains/main_for_index.php'); // Указываем, что добавляем. (Реализуем и добавляем только основную часть кода);
	
	/*$smarty->assign("CSS_TOTAL", STYLE::MAIN->value);*/

	$smarty->display($root.'/smarty_dirs/templates/main.tpl' );  // Указываем, куда добавляем и выводим обработанный шаблон.
?>

