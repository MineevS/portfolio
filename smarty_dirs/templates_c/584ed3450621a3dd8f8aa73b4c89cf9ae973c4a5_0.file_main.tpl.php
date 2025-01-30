<?php
/* Smarty version 5.4.2, created on 2025-01-30 08:47:17
  from 'file:C:\projects\portfolio_oleg\portfolioSer/smarty_dirs/templates/main.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.2',
  'unifunc' => 'content_679b1265c4bfc5_17163281',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '584ed3450621a3dd8f8aa73b4c89cf9ae973c4a5' => 
    array (
      0 => 'C:\\projects\\portfolio_oleg\\portfolioSer/smarty_dirs/templates/main.tpl',
      1 => 1738215802,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_679b1265c4bfc5_17163281 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\projects\\portfolio_oleg\\portfolioSer\\smarty_dirs\\templates';
?><!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> <!--Обязательно указываем размеры, иначе не будет смены @media -->
		
		<!--<?php echo 0;?>
 Название сайта -->
		<title>Портфолио - ВЕГА</title>
		
		<!--<?php echo 1;?>
 Иконка сайта -->
		<link  href="<?php echo $_smarty_tpl->getValue('FCN');?>
" 		type="image/x-icon" 	rel="icon">


		
		<!--<?php echo 2;?>
 Стили-->
		<link href="<?php echo $_smarty_tpl->getValue('CSS_MAIN');?>
" 	type="text/css" 	rel="stylesheet"> <!-- Стиль для `<main>`-->
		<link href="<?php echo $_smarty_tpl->getValue('CSS_TOTAL');?>
" 	type="text/css" 	rel="stylesheet"> <!-- Общий стиль для всех страниц --> 
		<link href="<?php echo $_smarty_tpl->getValue('CSS_AOS');?>
"		type="text/css"		rel="stylesheet">

		<!--<?php echo 3;?>
 Скрипты -->
		
		<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->getValue('SJS');?>
">								<?php echo '</script'; ?>
>
		
		<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->getValue('JSX');?>
" 		type="text/javascript"><?php echo '</script'; ?>
> 
		<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->getValue('JQR');?>
" 		type="text/javascript"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->getValue('AOS');?>
" 		type="text/javascript"><?php echo '</script'; ?>
>

		<link href="/assets/backend/library/select2/select2.min.css" rel="stylesheet" />
		<?php echo '<script'; ?>
 src="/assets/backend/library/select2/select2.min.js"><?php echo '</script'; ?>
>
	</head>
	<body>
		<div class="layout">
			<header>
				<a class="logo" href="<?php echo $_smarty_tpl->getValue('INDEX');?>
">
					<h1 class="font-logo">ПОРТФОЛИО</h1>
				</a>
				<div class="menu">
					<nav class="nav">
						<ul>
							<li>
								<a href="<?php echo $_smarty_tpl->getValue('PROJECTS');?>
">Проекты</a>
							</li>
							<li>
								<a href="<?php echo $_smarty_tpl->getValue('TEAMS');?>
">Команды</a>
							</li>
							<li>
								<a href="<?php echo $_smarty_tpl->getValue('VACANCIES');?>
">Вакансии</a>
							</li>
						</ul>
					</nav>
					<div>
						<?php if ((($tmp = (null !== ($_smarty_tpl->getValue('icon') ?? null)) ?? null)===null||$tmp==='' ? '' ?? null : $tmp)) {?>
							
							<!--<section style="display: flex; flex-direction: column; position: absolute; z-index: 5; width: fit-content; heigh: 100px; border: 3px solid black; border-radius: 5px; ">
								<button onclick="location.href='<?php echo $_smarty_tpl->getValue('PROFILE');?>
'">Мой профиль</button>
								<button onclick="logout('<?php echo $_smarty_tpl->getValue('ACTION');?>
');">Выход</button>
							</section>-->
							<div class="dropdown">
							<a href="" class="lass="dropbtn"">
								<img id="profile" class="avatar" src="<?php echo $_smarty_tpl->getValue('icon');?>
" />
							</a>
								<div class="dropdown-content">
									<a href="#" onclick="location.href='<?php echo $_smarty_tpl->getValue('PROFILE');?>
'">Мой профиль</a>
									<a href="#" onclick="logout('<?php echo $_smarty_tpl->getValue('ACTION');?>
');">Выход</a>
								</div>
							</div>
						<?php } else { ?>
							<div>
								<a target="iframe-auth-reg" onclick="create_iframe_authorization_registration();" href="<?php echo $_smarty_tpl->getValue('HFR');?>
" >Вход</a> <!-- <?php echo '<?php'; ?>
 echo AUTH::PATH->value; <?php echo '?>'; ?>
 href="./frames/authorization.html" -->
							</div>
						<?php }?>
					</div> 						<!--<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('date_now')->handle(array(), $_smarty_tpl);?>
-->
				</div>
			</header>
			<main>
				<?php $_smarty_tpl->renderSubTemplate(((string)$_smarty_tpl->getValue('MAIN')), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), (int) 0, $_smarty_current_dir);
?>
			</main>
			<footer>
				<a href="index.html" class="logo d-flex align-items-center">
					<span class="sitename" style="text-align: start; font-family: 'Lack', arial; font-size: 28px; color:rgb(255, 255, 255); margin: 0; font-weight: normal;">Контакты</span>
				</a>
				<p style="text-align: start;font-family: 'Helvetica', arial;font-size: 16px;color:rgb(240, 240, 240);/* margin: 0 0 3rem 1rem; */font-weight: 100;">
					+7 (499) 215-65-65 доб. 2404  
				</p>
				<a style="color: white;"> vega@mirea.ru </a>
			</footer>
		</div>
		<!-- script's code -->
		<?php echo '<script'; ?>
>
			AOS.init();
		<?php echo '</script'; ?>
>
	</body>
</html><?php }
}
