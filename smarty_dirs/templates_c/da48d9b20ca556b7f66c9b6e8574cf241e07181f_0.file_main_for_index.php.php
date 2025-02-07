<?php
/* Smarty version 5.4.2, created on 2025-02-06 15:03:16
  from 'file:C:\projects\portfolio_oleg\portfolioSer/assets/frontend/mains/main_for_index.php' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.2',
  'unifunc' => 'content_67a4a504eefec2_15188618',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'da48d9b20ca556b7f66c9b6e8574cf241e07181f' => 
    array (
      0 => 'C:\\projects\\portfolio_oleg\\portfolioSer/assets/frontend/mains/main_for_index.php',
      1 => 1738843368,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_67a4a504eefec2_15188618 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\projects\\portfolio_oleg\\portfolioSer\\assets\\frontend\\mains';
?><section id="sctn-1">
	<div class="corners">
		<p class="corner" id="crnr-1">∟</p>
		<p class="corner" id="crnr-2">∟</p>
		<p class="corner" id="crnr-3">∟</p>
		<p class="corner" id="crnr-4">∟</p>
	</div>
	<p class="background">БК 536</p>
	<h2 class="logotype">ПОРТФОЛИО</h2>
	<div id="info-1">
		<p>Здесь представлены лучшие проекты наших талантливых студентов</p>
		<p>↓</p>
	</div>
</section>
<section id="sctn-2" data-aos="fade-up">
	<div class="container-projects">
		<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_article')->handle(array('head1'=>"Представляем вам",'head2'=>"лучшие проекты",'head3'=>"базовой кафедры № 536"), $_smarty_tpl);?>

		<div class="pallet-projects">
			<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_projects')->handle(array('select'=>"*",'from'=>((string)$_smarty_tpl->getValue('tab_projects')),'orderby'=>"id",'limit'=>((string)$_smarty_tpl->getValue('SIZE_PAGE_PROJECTS')),'offset'=>"0"), $_smarty_tpl);?>

		</div>
	</div>
	<div class="footer-section">
		<p class="ref">Посмотрите все наши проекты</p>
		<svg class="bi bi-arrow-right" style="color: #F6F6F6; margin: 0 1rem 0 1rem;" onclick="window.location.href='<?php echo $_smarty_tpl->getValue('PROJECTS');?>
'" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"  viewBox="0 0 16 16" >
			<path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"></path>
		</svg>
	</div>
</section>
<section id="sctn-3" data-aos="fade-up">
	<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_article')->handle(array('head1'=>"А это основные",'svg'=>"1",'head3'=>"исследований и разработки",'class'=>"HelveticaMainWhite",'style'=>"width: 85%; padding: 3%;"), $_smarty_tpl);?>

	<div class="interestDiv">
		<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_interests')->handle(array(), $_smarty_tpl);?>

	</div>
</section>
<section id="sctn-4" data-aos="fade-up">
	<div style="width: 100%;height: fit-content;/* justify-content: flex-end; */display: flex;flex-direction: column;align-items: center;"> 
		<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_article')->handle(array('head1'=>"Наши звёзды с",'svg'=>"2",'head3'=>"сияют ярче, чем в Голливуде",'class'=>"HelveticaMain"), $_smarty_tpl);?>

		<div class="container stars" >
			<svg onclick="prevStar.call(this.nextSibling.nextSibling);" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="%23fff" style="flex-basis: 10%; box-shadow: 20px 0px 10px 0px #ffffff; z-index: 1;">
				<path d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
			</svg>
			<div class="carousel" style="width: 100%; ">
				<div class="carousel-inner"> 
					<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_stars')->handle(array('select'=>"*",'from'=>((string)$_smarty_tpl->getValue('tag_awesome')),'orderby'=>"id"), $_smarty_tpl);?>

				</div>
			</div> 
			<svg onclick="nextStar.call(this.previousSibling.previousSibling);" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="%23fff" style="flex-basis: 10%; box-shadow: -20px 0px 8px 0px #ffffff; z-index: 1;">
				<path d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
			</svg>
		</div>
		<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_article')->handle(array('head1'=>"Лучший",'head2'=>"дизайнер",'head3'=>"месяца",'id'=>"article-item",'class'=>"VasekMain2",'class2'=>"HelveticaMain2",'style'=>"width: 25%;"), $_smarty_tpl);?>

	</div>
</section>
<section id="sctn-5" data-aos="fade-up">
	<div class="headVacancy2">
		<div class="container headVacancy">
			<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_article')->handle(array('head1'=>"Наши открытые",'head2'=>"вакансии в команды",'head3'=>"лучших разработчиков",'class'=>"HelveticaMain",'style'=>"width: 50%;"), $_smarty_tpl);?>

		</div>
		<div class="container vacancies-container" style="display: grid;">
			<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_vacancies')->handle(array('style'=>"grid",'select'=>"*",'from'=>((string)$_smarty_tpl->getValue('tab_vacancies')),'orderby'=>"id",'limit'=>((string)$_smarty_tpl->getValue('limit_vacancies')),'offset'=>"0"), $_smarty_tpl);?>

		</div>
	</div>
	<div style="background: #202020; width: 100%;">
		<div class="footerSection">
			<p class="VasekMainWhiteP">Больше вакансий тут</p>
			<svg onclick="window.location.href='<?php echo $_smarty_tpl->getValue('VACANCIES');?>
'" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-right" style="color: #F6F6F6; margin: 0 1rem 0 1rem;" viewBox="0 0 16 16">
				<path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"></path>
			</svg>
		</div>
	</div>
</section>
<?php }
}
