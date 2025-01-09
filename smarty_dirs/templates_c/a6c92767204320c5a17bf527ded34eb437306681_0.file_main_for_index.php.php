<?php
/* Smarty version 5.4.2, created on 2025-01-09 17:10:02
  from 'file:C:\projects\site_portfolio/assets/frontend/mains/main_for_index.php' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.2',
  'unifunc' => 'content_677fd8ba8117e7_78741828',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a6c92767204320c5a17bf527ded34eb437306681' => 
    array (
      0 => 'C:\\projects\\site_portfolio/assets/frontend/mains/main_for_index.php',
      1 => 1736431778,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_677fd8ba8117e7_78741828 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\projects\\site_portfolio\\assets\\frontend\\mains';
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
		<p class="p_2" >Здесь представлены лучшие проекты наших талантливых студентов</p>
		<p class="p_3">↓</p>
	</div>
</section>
<section class="section_2">
	<div style="width: 100%; height: fit-content; padding-bottom: 2%; padding-left: 25%; padding-right: 25%; margin: 0%;">
		<article style="display: grid; width: 50%; align-self: flex-start;">
			<h1 style="justify-self: start;">Представляем вам</h1>
			<p  style="justify-self: center;">лучшие проекты</p>
			<h1 style="justify-self: end;">базовой кафедры</h1>
		</article>
		<div class="container" style="display: flex; flex-direction: column; gap: 30px; margin-top: 2rem; width: 100%;">
			<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_projects')->handle(array('select'=>"*",'from'=>"info_project",'orderby'=>"id",'limit'=>"3"), $_smarty_tpl);?>

		</div>
	</div>
	<div style="display: flex; align-items: center; justify-content: end; flex-direction: row; width: 100%; height: 10%; background-color: #EA5657;">
		<p>Посмотрите все наши проекты</p>
		<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
			<path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"></path>
		</svg>
	</div>
</section>
<section class="section_3" style="background-color:rgb(40, 40, 40); border-radius: 10px 10px 0px 0px;">
	<article style="display: grid; width: 50%; align-self: flex-start;">
		<h1 style="justify-self: start;">А это основные</h1>
		<p  style="justify-self: center;">направления</p>
		<h1 style="justify-self: end;">исследований и разработки</h1>
	</article>
	<div class="container" style="display: flex; flex-direction: column; gap: 30px; margin-top: 2rem; width: 100%;">
			<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_interests')->handle(array(), $_smarty_tpl);?>

	</div>
</section>
<section class="section_4">
	<div style="width: 100%; height: fit-content; padding-bottom: 2%; padding-left: 25%; padding-right: 25%; margin: 0%;">
		<article style="display: grid; width: 50%; align-self: flex-start;">
			<h1 style="justify-self: start;">Наши звёзды с</h1>
			<p  style="justify-self: center;">Аллеи Славы</p>
			<h1 style="justify-self: end;">сияют ярче, чем в Голливуде</h1>
		</article>
		<div class="container" style="display: flex; flex-direction: row; gap: 30px; margin-top: 2rem; width: 100%;">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="%23fff">
				<path d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
			</svg>
			<div class="carousel" style="width: 50%;">
				<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_stars')->handle(array('select'=>"*",'from'=>"info_project",'orderby'=>"id",'limit'=>"3"), $_smarty_tpl);?>

			</div>
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="%23fff">
				<path d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
			</svg>
		</div>
	</div>
</section>
<section class="section_5">
	<div style="width: 100%; height: fit-content; padding-bottom: 2%; padding-left: 25%; padding-right: 25%; margin: 0%;">
		<div class="container" style="display: flex;flex-direction: row;width: 100%;justify-content: space-between;align-items: flex-end;">
			<article style="display: grid; width: 50%; align-self: flex-start;">
				<h1 style="justify-self: start;">Открытые</h1>
				<p  style="justify-self: center;">вакансии</p>
				<h1 style="justify-self: end; ">в команды</h1>
			</article>
			<button style="width: 100px; height: 50px; justify-content: flex-end;">Добавить вакансию</button>
		</div>
		<div class="container" style="display: grid; grid-template-columns: 1fr 1fr; gap: 0px; margin-top: 2rem; width: 100%; justify-items: center; place-content: center; ">
			<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_vacancies')->handle(array(), $_smarty_tpl);?>

		</div>
	</div>
	<div style="display: flex; align-items: center; justify-content: end; flex-direction: row; width: 100%; height: 10%; background-color: #EA5657;">
		<p>Посмотрите все наши вакансии</p>
		<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
			<path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"></path>
		</svg>
	</div>
</section>
<section class="section_6">
	<div class="container" style="display: flex; flex-direction: column; gap: 30px; margin-top: 2rem; width: 100%;">
		<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_interests')->handle(array(), $_smarty_tpl);?>
 
	</div>
</section>
<?php }
}
