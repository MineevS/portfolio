<?php

session_start(); // Продлеваем сессию, запущенную из `action.php`

$root = $_SERVER['DOCUMENT_ROOT'];

require_once($root . '/assets/backend/config/paths.php');
require_once($root . '/assets/backend/config/config_smarty.php');

if (!isset($_POST['id'])) unset($_SESSION['project_id']);

$smarty->assign(
	'icon',
	(isset($_SESSION[TRU::icon->name])
		? '/assets/frontend/icons/avatars_profiles/' . $_SESSION[TRU::icon->name]
		: '/assets/frontend/icons/default_avatar_profile.jpg')
); //  icon_default_profile

// if(isset($_SESSION['project_id'])) unset($_SESSION['project_id']); // Если установлен `project_id`, то `убираем` его.

$smarty->assign('id_author', $_SESSION['id']); // Показываем текущему пользователю только его проекты.

$smarty->assign('tab_projects', TBN::PROJECTS->value);

$smarty->assign('template_name_default_img', '/assets/frontend/icons/default_avatar_profile.jpg');

/*$smarty->assign('firstname', 
	(isset($_SESSION[TRU::firstname->name]) ? $_SESSION[TRU::firstname->name] : 'firstname'));

	$smarty->assign('lastname', 
	(isset($_SESSION[TRU::lastname->name]) ? $_SESSION[TRU::lastname->name] : 'lastname'));*/

/*             
	<p class= "fontHead">{$firstname}</p>
	<p class= "fontHead">{$lastname}</p> */

$smarty->assign("CSS_MAIN", STYLE::PROFILE->value);
$smarty->assign("MAIN", $root . '/assets/frontend/mains/main_for_profile.php'); // Указываем, что добавляем. (Реализуем и добавляем только основную часть кода);

$smarty->assign("PAGE_PROJECT", PAGE::PROJECT->value);

$smarty->assign("CSS_TOTAL", STYLE::MAIN->value);
$smarty->display($root . '/smarty_dirs/templates/main.tpl');  // Указываем, куда добавляем и выводим обработанный шаблон.
