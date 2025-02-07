<?php
/* Smarty version 5.4.2, created on 2025-01-31 10:18:56
  from 'file:C:\projects\portfolio_oleg\portfolioSer/assets/frontend/mains/main_for_project.php' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.2',
  'unifunc' => 'content_679c7960f0b2b7_24205083',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ae5015eed18fe8bc8cf4ca554055fe8e3955f6f4' => 
    array (
      0 => 'C:\\projects\\portfolio_oleg\\portfolioSer/assets/frontend/mains/main_for_project.php',
      1 => 1738307934,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_679c7960f0b2b7_24205083 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\projects\\portfolio_oleg\\portfolioSer\\assets\\frontend\\mains';
?><section class="section_1" style="width: 100%; display: flex; flex-direction: column; gap: 100px;">
	<div style="display: flex; flex-direction: column; width: 100%; align-items: center;"> <!-- padding-top: 10%; -->
		<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_header_page')->handle(array(), $_smarty_tpl);?>

	    <div class="container" style="display: grid; width: 50%; grid-template-columns: 2fr auto; gap: 20px; padding-bottom: 1rem;"> <!-- height: 500px; -->
	        <div class="container" style="display: flex; flex-direction: column; width: 100%; background-color: #fff;"> <!-- Основная информация-->
	            <article> <!-- display: flex; gap: 2%;-->
	                <h2><span >//</span> Основная информация </h2>
	            </article>
	            <div class="container properties" style="display: flex; flex-direction: column; gap: 10px;"> <!--for="properties" -->
					<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_properties_project')->handle(array('for'=>"properties"), $_smarty_tpl);?>
                 
	            </div>
	        </div>
	        <div class="container" style="display: flex; flex-direction: column; width: 100%; gap: 7%;"> <!-- ссылки - background-color: #7feb7f; -->
	            <article>
	                  <h2><span>//</span> Ссылки</h2>
	            </article>
	            <div class="contentProperty container dragAndDrop" id="references" style="display: flex; flex-direction: column; gap:  10px; align-items: flex-start;">
					<!--query_properties_profile  	for="contacts"-->
					<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_properties_add')->handle(array('for'=>"references"), $_smarty_tpl);?>

	            </div>
	        </div>
	        <div class="container_about"> <!-- о себе background-color: orange;-->
	            <article>
	                  <h2><span >//</span> О проекте </h2>
	            </article>
	            <div class="container about">
					<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_properties_project')->handle(array('for'=>"description"), $_smarty_tpl);?>

	            </div>
			</div>
			<div class="container" style="grid-column: 1 / span 2; display: flex; flex-direction: column; width: 100%; "> <!-- о себе background-color: orange;-->
	            <article>
	                  <h2><span >//</span> Теги </h2>
	            </article>
	            <div id="tags" class="contentProperty container tags ">
					<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_properties_project')->handle(array('for'=>"tags"), $_smarty_tpl);?>

	            </div>
				<div class="display" style="display: flex; flex-direction: column; align-items: center; margin-top: 25px; row-gap: 15px; display: none;">
					<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_input')->handle(array('for'=>"tags",'type'=>"span"), $_smarty_tpl);?>

				</div>
			</div>
			<div class="container" style="grid-column: 1 / span 2; display: flex; flex-direction: column; width: 100%; "> <!-- о себе background-color: orange;-->
	            <article>
	                  <h2><span >//</span> Стек технологий </h2>
	            </article>
	            <div id="stack" class="contentProperty container stack ">
					<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_properties_project')->handle(array('for'=>"stack"), $_smarty_tpl);?>

	            </div>
				<div class="display" style="display: flex; flex-direction: column; align-items: center; margin-top: 25px; row-gap: 15px; display: none;">
					<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_input')->handle(array('for'=>"stack"), $_smarty_tpl);?>

				</div>
			</div> 
	        <div class="container" style="grid-column: 1 / span 2; display: flex; flex-direction: column; width: 100%;"> <!-- Проекты  background-color: gray; -->
	            <article>
	                <h2><span >//</span> Команда проекта </h2>
	            </article>
	            <div class="container team" style="display: flex; flex-direction: column; gap: 2rem; align-items: flex-start;"> <!-- select="*" from="info_user" orderby="id" limit="3" offset="0"-->
					<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_properties_project')->handle(array('for'=>"team"), $_smarty_tpl);?>

					<!--query_properties_add 	  for="team"-->
	            </div>
				<div class="display" style="display: flex; flex-direction: column; align-items: center; margin-top: 25px; row-gap: 15px; display: none;">
					<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_input')->handle(array('for'=>"team"), $_smarty_tpl);?>

				</div>
			</div>
            <div class="container" style="grid-column: 1 / span 2; display: flex; flex-direction: column; width: 100%;"> <!-- Проекты  background-color: gray; -->
	            <article>
	                <h2><span >//</span> Скриншоты </h2>
	            </article>
	            <div class="container" style="display: grid; grid-template-columns: auto auto; gap:  10px; align-items: flex-start; justify-content: center;"> <!-- select="*" from="info_user" orderby="id" limit="3" offset="0"-->
					<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_properties_project')->handle(array('for'=>"screenshots"), $_smarty_tpl);?>

	            </div>
				<div class="display" style="display: flex; flex-direction: column; align-items: center; margin-top: 25px; row-gap: 15px; display: none;">
					<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_input')->handle(array('for'=>"screenshots"), $_smarty_tpl);?>

				</div>
			</div>
            <div class="container" style="grid-column: 1 / span 1; display: flex; flex-direction: column; width: 87%;"> <!-- Проекты  background-color: gray; -->
	            <article>
	                <h2><span >//</span> Отзывы </h2>
	            </article>
	            <div class="container container-feedbacks"> <!-- select="*" from="info_user" orderby="id" limit="3" offset="0"-->
					<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_properties_project')->handle(array('for'=>"feedback"), $_smarty_tpl);?>

	            </div>
				<div class="display" style="display: flex; flex-direction: column; align-items: center; margin-top: 25px; row-gap: 15px; display: none;">
					<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_input')->handle(array('for'=>"feedbacks"), $_smarty_tpl);?>

				</div>
			</div>
			<div class="container" style="grid-column: 1 / span 2; display: flex; flex-direction: column; width: 100%;"> <!-- Проекты  background-color: gray; -->
	            <article>
	                <h2><span >//</span> Вакансии </h2>
					<?php if ((($tmp = $_smarty_tpl->getValue('access') ?? null)===null||$tmp==='' ? '' ?? null : $tmp)) {?>
						<div class="div-article">
							<!--<button class="del-vacancy"  onclick="delElem('vacancy', '<?php echo $_smarty_tpl->getValue('ACTION');?>
');">удалить вакансию</button>-->
							<button class="add-vacancy showHide" onclick="window.location.href='<?php echo $_smarty_tpl->getValue('PAGE_VACANCY');?>
'">добавить вакансию</button> <!-- onclick="addElem('vacancy', '<?php echo $_smarty_tpl->getValue('ACTION');?>
');-->
						<div>
					<?php }?>
	            </article>
	            <div class="container vacancies-container" style=""> <!-- ТУТ grid в отличие от остальных --><!-- select="*" from="info_user" orderby="id" limit="3" offset="0"-->
					<?php if ((($tmp = $_smarty_tpl->getValue('project_id') ?? null)===null||$tmp==='' ? '' ?? null : $tmp)) {?>
						<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_vacancies')->handle(array('select'=>"*",'from'=>((string)$_smarty_tpl->getValue('tab_vacancies')),'orderby'=>"id",'where'=>"project_id",'project_id'=>((string)$_smarty_tpl->getValue('project_id'))), $_smarty_tpl);?>
 
					<?php }?>
	            </div> <!-- limit="3" offset="0" -->
			</div>
		</div>
	</div>
</section>
<section class="section_3" style="background-color:rgb(40, 40, 40); border-radius: 10px 10px 0px 0px;">
	<article style="display: grid; width: 50%; align-self: flex-start;">
		<!--<h2 style="justify-self: start;">А это основные</h2>
		<p  style="justify-self: center;">направления</p>
		<h2 style="justify-self: end;">исследований и разработки</h2>-->
        <p style="font-family: 'Vasek', arial; font-size: 96px; color: #EA5657; margin: 0; line-height: .8em;">Артефакты</p>
	</article>
	<div class="container" style="display: flex; flex-direction: column; margin-top: 2rem; width: 100%;"> <!-- gap: 30px; -->
			<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_interests')->handle(array(), $_smarty_tpl);?>

	</div>
    <div style=" height: auto; display: flex; align-items: center; justify-content: end; flex-direction: row; width: 100%; height: 10%; background-color: #EA5657;">
		<p>Проекты по схожим тегам</p> 
		<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
			<path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h21.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5h2.5A.5.5 0 0 1 1 8"></path>
		</svg>
	</div>
</section><?php }
}
