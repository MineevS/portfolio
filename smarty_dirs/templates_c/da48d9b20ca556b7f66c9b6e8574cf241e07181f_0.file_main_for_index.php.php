<?php
/* Smarty version 5.4.2, created on 2025-01-13 09:33:09
  from 'file:C:\projects\portfolio_oleg\portfolioSer/assets/frontend/mains/main_for_index.php' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.2',
  'unifunc' => 'content_6784b3a5299995_93386253',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'da48d9b20ca556b7f66c9b6e8574cf241e07181f' => 
    array (
      0 => 'C:\\projects\\portfolio_oleg\\portfolioSer/assets/frontend/mains/main_for_index.php',
      1 => 1736749985,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6784b3a5299995_93386253 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\projects\\portfolio_oleg\\portfolioSer\\assets\\frontend\\mains';
?><section class="section_1">
	<!-- Сначало указываем элементы с абсолютным расположением, а потом с относительным-->
	<div class="corners">
		<p class="corner_top_left" id="1">∟</p>
		<p class="corner_top_right" id="2">∟</p>
		<p class="corner_bottom_left" id="3">∟</p>
		<p class="corner_bottom_right" id="4">∟</p>
	</div>
	<h2 class="logotype font-logo">ПОРТФОЛИО</h2>
	<p class="p_1">БК 536</p>
	<div class="an-1">
		<p class="p_2">Здесь представлены лучшие проекты наших талантливых студентов</p>
		<p class="p_3">↓</p>
	</div>
</section>
<section class="section_2" data-aos="fade-up">
	<div style="width: 100%; height: fit-content; padding-bottom: 2%; padding-left: 20%; padding-right: 20%; margin: 0%;">
		<!--<article style="display: grid; width: 80%; align-self: flex-start;">
			<h1 class="HelveticaMain" style="justify-self: start;">Представляем вам</h1>
			<p class="VasekMain" style="justify-self: center;">лучшие проекты</p>
			<h1 class="HelveticaMain" style="justify-self: end;">базовой кафедры</h1>
		</article>-->
		<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_article')->handle(array('head1'=>"Представляем вам",'head2'=>"лучшие проекты",'head3'=>"базовой кафедры"), $_smarty_tpl);?>

		<div class="container" style="display: flex; flex-direction: column; gap: 30px; margin-top: 3rem; width: 100%;">
			<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_projects')->handle(array('select'=>"*",'from'=>"info_project",'orderby'=>"id",'limit'=>"3",'offset'=>"0"), $_smarty_tpl);?>

		</div>
	</div>
	<div style="display: flex; align-items: center; justify-content: end; flex-direction: row; width: 100%; height: 10%; background-color: #EA5657; padding: 2rem 0 1rem 0;">
		<p class="VasekMainWhiteP">Посмотрите все наши проекты</p>
		<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16" style="color: #F6F6F6; margin: 0 1rem 0 1rem;">
			<path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"></path>
		</svg>
	</div>
</section>
<section class="section_3" style="background-color:rgb(40, 40, 40); border-radius: 10px 10px 0px 0px;" data-aos="fade-up">
	<!--<article style="display: grid; width: 50%; align-self: flex-start; margin-left: 4%; margin-top: 3rem;">
		<h1 class="HelveticaMainWhite" style="justify-self: start;">А это основные</h1>
		<p class="VasekMain" style="justify-self: center; margin-right: 20%;">направления</p>
		<h1 class="HelveticaMainWhite" style="justify-self: end;">исследований и разработки</h1>
	</article>-->
	<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_article')->handle(array('head1'=>"А это основные",'head2'=>"направления",'head3'=>"исследований и разработки"), $_smarty_tpl);?>

	<div class="container" style="display: flex; flex-direction: column; margin-top: 2rem; width: 100%;"> <!-- gap: 30px; -->
		<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_interests')->handle(array(), $_smarty_tpl);?>

	</div>
</section>
<section class="section_4" data-aos="fade-up">
	<div style="width: 100%; height: fit-content; padding-bottom: 2%; padding-top: 3rem; padding-left: 20%; padding-right: 20%; margin: 0%;">
		<!--<article style="display: grid; width: 100%; align-self: flex-start;">
			<h1 class="HelveticaMain" style="justify-self: start;">Наши звёзды с</h1>
			<p class="VasekMain" style="justify-self: center; margin-right: 30%;">Аллеи Славы</p>/* тут наверное надо придумать как в класс без марджина сделать */
			<h1 class="HelveticaMain" style="justify-self: end; margin-right: 10%;">сияют ярче, чем в Голливуде</h1>
		</article>-->
		<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_article')->handle(array('head1'=>"Наши звёзды с",'head2'=>"Аллеи Славы",'head3'=>"сияют ярче, чем в Голливуде"), $_smarty_tpl);?>

		<div class="container" style="display: flex; justify-content: space-between; flex-direction: row; gap: 30px; margin-top: 2rem; width: 100%;">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="%23fff" style="flex-basis: 10%;">
				<path d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
			</svg>
			<div class="carousel" style="width: 100%; "> <!-- display: flex; flex-direction: row; justify-content: center;-->
				<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_stars')->handle(array('select'=>"*",'from'=>"info_project",'orderby'=>"id",'limit'=>"1"), $_smarty_tpl);?>

			</div>
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="%23fff" style="flex-basis: 10%;">
				<path d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
			</svg>
		</div>
	</div>
</section>
<section class="section_5" data-aos="fade-up">
	<div style="width: 100%; height: fit-content; padding-bottom: 2%; padding-left: 20%; padding-right: 20%; margin: 0%;">
		<div class="container" style="display: flex;flex-direction: row;width: 100%;justify-content: space-between;align-items: flex-end;">
			<!--<article style="display: grid; width: 50%; align-self: flex-start;">
				<h1 class="HelveticaMain" style="justify-self: start;">Открытые</h1>
				<p class="VasekMain" style="justify-self: center;">вакансии</p>
				<h1 class="HelveticaMain" style="justify-self: end; ">в команды</h1>
			</article>-->
			<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_article')->handle(array('head1'=>"Открытые",'head2'=>"вакансии",'head3'=>"в команды"), $_smarty_tpl);?>

			<button class="buttonAddVacancy" style="width: auto; height: auto; justify-content: flex-end;">Добавить вакансию</button>
		</div>
		<div class="container" style="display: grid; grid-template-columns: 1fr 1fr; gap: 0px; margin-top: 2rem; width: 100%; justify-items: center; place-content: center; ">
			<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_vacancies')->handle(array(), $_smarty_tpl);?>

		</div>
	</div>
	<div style="display: flex; align-items: center; justify-content: end; flex-direction: row; width: 100%; height: 10%; background-color: #EA5657; padding: 2rem 0 1rem 0;">
		<p class="VasekMainWhiteP">Посмотрите все наши вакансии</p>
		<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-right" style="color: #F6F6F6; margin: 0 1rem 0 1rem;" viewBox="0 0 16 16">
			<path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"></path>
		</svg>
	</div>
</section>
<?php }
}
