<?php
	session_start(); // Продлеваем сессию, запущенную из `action.php`

    $root = $_SERVER['DOCUMENT_ROOT'];

	require_once($root.'/assets/backend/config/paths.php');
		require_once($root.'/assets/backend/config/config_smarty.php');

	if(isset($_POST['id'])) $_SESSION['vacancy_id'] = $_POST['id'];

	$query = $wdbc->query()
	->select('*')
	->from(TBN::VACANCIES->value);
	if(!isset($_SESSION['project_id'])){ // Если нет project_id(т. е. попали на страницу вакансии из вкладки `вакансии`)
		$status_query = $query->where('id', $_SESSION['vacancy_id'])->exec();
		$responce 	  = $query->responce();
		if($status_query && count($responce) === 1) $_SESSION['project_id'] = $responce[0]['project_id'];
	} else {
		// Проверка на наличие вакакнсии и заявленными `id(vacancy_id)` и `project_id`.
		$status_query = $query->where('id', $_SESSION['vacancy_id'], OPBIN::AND, 'project_id', $_SESSION['project_id'])->exec();
		$responce 	  = $query->responce();
	}

	if($_SESSION['id']){ // Если мы вошли в систему


		// Проверка на авторство:
		$status_query = $query->select('author')->from(TBN::PROJECTS->value)->where('id', $_SESSION['project_id'], OPBIN::AND,'author', $_SESSION['id'])->exec();
		$responce 	  = $query->responce();
		if($status_query && count($responce) === 1) $smarty->assign('access', true);

		$smarty->assign('project_id', $_SESSION['project_id']); // Показываем ...
		/*
		if($status_query && count($responce) === 1){
			$smarty->assign('access', true);
		} //OPBIN::AND, 'author', $_SESSION['id']
		*/

		/*$smarty->assign('icon', 
		(isset($_SESSION[TRU::icon->name]) 
			? '/assets/frontend/icons/'.$_SESSION[TRU::icon->name] 
			: '/assets/frontend/icons/default_avatar_profile.jpg'));*/

		$smarty->assign('icon', 
		(isset($_SESSION[TRU::icon->name]) 
			? PATH_DEFAULT::PROFILE->value.$_SESSION[TRU::icon->name] 
			: ICON_DEFAULT::PROFILE->value)); 
	} 




	/* 14.01.25 - 7:40 */
	/* 
		Если: в $_SESSION есть `vacancie_id`, то загрузить данные в из БД для существующей вакансии.
	   	Иначе: Отобразить страницу на создание проекта.
	 */
	if(isset($_SESSION['vacancy_id'])){ // name_default
		// Ранее сохраненная вакансия
		$smarty->assign('vacancy_id', $_SESSION['vacancy_id']);

	} else {
		// Новая вакансия
		$smarty->assign('access', true);
		$smarty->assign('icon_default', ICON_DEFAULT::VACANCY->value);
		$smarty->assign('name_default', "Новая вакансия");
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

	$smarty->assign("CSS_MAIN", 	STYLE::VACANCY->value);
	$smarty->assign("MAIN", 		$root.MAIN::VACANCY->value); // $root.'/assets/frontend/mains/main_for_vacancy.php' // Указываем, что добавляем. (Реализуем и добавляем только основную часть кода);
	
	$smarty->assign("PAGE_VACANCY", PAGE::VACANCY->value);
	$smarty->assign("PAGE_PROJECT", PAGE::PROJECT->value);
	
	/*$smarty->assign("CSS_TOTAL", STYLE::MAIN->value);*/
	$smarty->display($root.'/smarty_dirs/templates/main.tpl' );  // Указываем, куда добавляем и выводим обработанный шаблон.
?>