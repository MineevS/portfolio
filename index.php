<?php
	session_start(); // Продлеваем сессию, запущенную из `action.php`

	$root = $_SERVER['DOCUMENT_ROOT'];

	require_once($root.'/assets/backend/config/config_smarty.php');

	if(isset($_SESSION[TRU::icon->name])){
		$smarty->assign(TRU::icon->name, '/assets/frontend/icons/'.$_SESSION[TRU::icon->name]);
	}

/*
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

	<script>
		AOS.init();
	</script>

	$smarty->assign("CSS_AOS",  AOS::CSS->value); //
	$smarty->assign("AOS", 		AOS::JSX->value); */

	$smarty->assign("CSS_MAIN",  STYLE::INDEX->value); // 
	$smarty->assign("MAIN", 	 $root.'/assets/frontend/mains/main_for_index.php'); // Указываем, что добавляем. (Реализуем и добавляем только основную часть кода);
	
	/*$smarty->assign("CSS_TOTAL", STYLE::MAIN->value);*/

	$smarty->display($root.'/smarty_dirs/templates/main.tpl' );  // Указываем, куда добавляем и выводим обработанный шаблон.
?>

