<?php
	session_start(); // Продлеваем сессию, запущенную из `action.php`

    $root = $_SERVER['DOCUMENT_ROOT'];

	require_once($root.'/assets/backend/config/paths.php');
		require_once($root.'/assets/backend/config/config_smarty.php');

	if(isset($_POST['id'])) $_SESSION['project_id'] = $_POST['id'];

	if($_SESSION['id']){ // Если мы вошли в систему

		$status_query = $wdbc->query()
			->select('author')
			->from(TBN::PROJECTS->value)
			->where('id', $_SESSION['project_id'], OPBIN::AND, 'author', $_SESSION['id'])
		->exec();

		if($status_query && count($wdbc->query()->responce()) === 1){
			$smarty->assign('id_author', $_SESSION['id']); // Показываем текущему пользователю только его проекты.
			$smarty->assign('access', true);
		} //OPBIN::AND, 'author', $_SESSION['id']

		
		$smarty->assign('icon', 
		(isset($_SESSION[TRU::icon->name]) 
			? PATH_DEFAULT::PROFILE->value.$_SESSION[TRU::icon->name] // '/assets/frontend/icons/avatars_profiles/'
			: ICON_DEFAULT::PROFILE->value)); // '/assets/frontend/icons/default_avatar_profile.jpg'
	} 

	/* 14.01.25 - 7:40 */
	/* 
		Если: в $_SESSION есть `project_id`, то загрузить данные в из БД для существующего проекта.
	   	Иначе: Отобразить страницу на создание проекта.
	 */
	if(isset($_SESSION['project_id'])){
		// Ранее сохраненный проект
		$smarty->assign('project_id', $_SESSION['project_id']);

	} else {
		// Новый проект
		$smarty->assign('icon_default', '/assets/frontend/icons/default_avatar_project.jpg');
		$smarty->assign('name_default', "Новый проект");
		$smarty->assign('access', true);
	}

	/* */

// {query_properties_project for="properties"}
    /*
	$smarty->assign('firstname', 
	(isset($_SESSION[TRU::firstname->name]) ? $_SESSION[TRU::firstname->name] : 'firstname'));
    */
/*
	$smarty->assign('lastname', 
	(isset($_SESSION[TRU::lastname->name]) ? $_SESSION[TRU::lastname->name] : 'lastname'));
    */

	$smarty->assign('template_name_default_img', '/assets/frontend/icons/default_avatar_project.jpg');

	$smarty->assign('tab_vacancies', TBN::VACANCIES->value);

	$smarty->assign("CSS_MAIN", STYLE::PROFILE->value);
	$smarty->assign("MAIN", $root.'/assets/frontend/mains/main_for_project.php'); // Указываем, что добавляем. (Реализуем и добавляем только основную часть кода);
    
	
	$smarty->assign("PAGE_VACANCY", PAGE::VACANCY->value);

	/*$smarty->assign("CSS_TOTAL", STYLE::MAIN->value);*/
	$smarty->display($root.'/smarty_dirs/templates/main.tpl' );  // Указываем, куда добавляем и выводим обработанный шаблон.
?>