<?php
/* Smarty version 5.4.2, created on 2025-01-26 14:48:25
  from 'file:C:\xampp\htdocs\portfolio/assets/frontend/mains/main_for_project.php' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.2',
  'unifunc' => 'content_67963d292a57c6_92735498',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0d330ee3712b666d52bb6ac72ceffa7782e031f4' => 
    array (
      0 => 'C:\\xampp\\htdocs\\portfolio/assets/frontend/mains/main_for_project.php',
      1 => 1737898954,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_67963d292a57c6_92735498 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\portfolio\\assets\\frontend\\mains';
?><section class="section_1" style="width: 100%; display: flex; flex-direction: column; gap: 100px;">
	<div style="display: flex; flex-direction: column; width: 100%; align-items: center;"> <!-- padding-top: 10%; -->
		<article style="display: flex;  width: fit-content; justify-content: center; space-between; gap: 5%; align-items: center;">
			<div>
				<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_properties_project')->handle(array('for'=>"icon",'icon_default'=>((string)$_smarty_tpl->getValue('icon_default'))), $_smarty_tpl);?>

				<!--<button type="submit" onclick="loadAvatar();"> Загрузить изображение</button>-->
				<?php if ((($tmp = (null !== ($_smarty_tpl->getValue('access') ?? null)) ?? null)===null||$tmp==='' ? '' ?? null : $tmp)) {?>
					<div id="menu-icon" style="position: absolute; display: flex; flex-direction: column; justify-content: center; align-items: center; 
					background-color: #cfcbcb61; margin: 10px; row-gap: 10px; visibility: hidden;">
						<span>Изменить фотографию
							<input id="change-avatar" class="avatar" style="opacity: 10%; position: absolute; left: 0; top: 0;" type="file" accept="image/jpeg,image/png,image/gif" onchange="changeAvatar.call(this, 'change', '<?php echo $_smarty_tpl->getValue('template_name_default_img');?>
');"/>
						</span>
						<span>Удалить фотографию
							<input type="submit" id="delete-avatar" class="avatar" style="opacity: 10%; position: absolute; left: 0; top: 30px;  width: 100%;" onclick="changeAvatar.call(document.getElementById('avatar'), 'delete', '<?php echo $_smarty_tpl->getValue('template_name_default_img');?>
');"/>
						</span>
					</div>
				<?php }?>
			</div>
			<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_properties_project')->handle(array('for'=>"name",'name_default'=>((string)$_smarty_tpl->getValue('name_default'))), $_smarty_tpl);?>

		</article>
	    <div class="container" style="display: grid; width: 50%; grid-template-columns: 2fr auto; gap: 20px; padding-bottom: 1rem;"> <!-- height: 500px; -->
	        <div class="container" style="display: flex; flex-direction: column; width: 100%; background-color: #fff;"> <!-- Основная информация-->
	            <article> <!-- display: flex; gap: 2%;-->
	                <h1><span style="display: inline-flex; width: 25px;">//</span> Основная информация </h1>
	            </article>
	            <div class="container properties" style="display: flex; flex-direction: column; gap: 10px;"> <!--for="properties" -->
					<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_properties_project')->handle(array('for'=>"properties"), $_smarty_tpl);?>
                 
	            </div>
	        </div>
	        <div class="container" style="display: flex; flex-direction: column; width: 100%; gap: 7%;"> <!-- ссылки - background-color: #7feb7f; -->
	            <article style="display: flex; gap: 2%;">
	                  <h1><span style="display: inline-flex; width: 25px;">//</span> Ссылки</h1>
	            </article>
	            <div class="container" style="display: flex; flex-direction: column; gap:  10px; align-items: flex-start;">
	                <a href="token@email.ru">token@email.ru</a> <!-- style="text-decoration: auto;"-->
					<a href="token@email.ru">token@email.ru</a>
	            </div>
				<?php if ((($tmp = (null !== ($_smarty_tpl->getValue('access') ?? null)) ?? null)===null||$tmp==='' ? '' ?? null : $tmp)) {?>
                	<button class="editProjectButton" onclick="editPage.call(this, true, '<?php echo $_smarty_tpl->getValue('ACTION');?>
');">редактировать</button> <!-- editProject(true, '<?php echo $_smarty_tpl->getValue('ACTION');?>
'); -->
				<?php }?>
				<!--<button class="saveProject" onclick="saveProject();">сохранить проект</button>-->
	        </div>
	        <div class="container" style="grid-column: 1 / span 2; display: flex; flex-direction: column; width: 100%; "> <!-- о себе background-color: orange;-->
	            <article style="display: flex; gap: 2%;">
	                  <h1><span style="display: inline-flex; width: 25px;">//</span> О проекте </h1>
	            </article>
	            <div class="container" style="display: flex; flex-direction: column; gap:  10px; align-items: flex-start;">
					<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_properties_project')->handle(array('for'=>"description"), $_smarty_tpl);?>

	            </div>
			</div>
	        <div class="container" style="grid-column: 1 / span 2; display: flex; flex-direction: column; width: 100%;"> <!-- Проекты  background-color: gray; -->
	            <article style="display: flex; gap: 2%; align-items: center; justify-content: space-between;">
	                <h1><span style="display: inline-flex; width: 25px;">//</span> Авторы </h1>
					<?php if ((($tmp = $_smarty_tpl->getValue('access') ?? null)===null||$tmp==='' ? '' ?? null : $tmp)) {?>
						<div class="div-article">
							<!--<button class="del-author" onclick="">удалить автора</button>-->
							<button class="add-author" onclick="">добавить автора</button>
						<div>
					<?php }?>
	            </article>
	            <div class="container" style="display: flex; flex-direction: column; gap:  10px; align-items: flex-start;"> <!-- select="*" from="info_user" orderby="id" limit="3" offset="0"-->
					<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_authors')->handle(array(), $_smarty_tpl);?>

	            </div>
			</div>
            <div class="container" style="grid-column: 1 / span 2; display: flex; flex-direction: column; width: 100%;"> <!-- Проекты  background-color: gray; -->
	            <article style="display: flex; gap: 2%; align-items: center; justify-content: space-between;">
	                <h1><span style="display: inline-flex; width: 25px;">//</span> Скриншоты </h1>
					<?php if ((($tmp = $_smarty_tpl->getValue('access') ?? null)===null||$tmp==='' ? '' ?? null : $tmp)) {?>
						<div class="div-article">
							<!--<button class="del-author" onclick="">удалить скриншот</button>-->
							<button class="add-author" onclick="">добавить скриншот</button>
						<div>
					<?php }?>
	            </article>
	            <div class="container" style="display: flex; flex-direction: column; gap:  10px; align-items: flex-start;"> <!-- select="*" from="info_user" orderby="id" limit="3" offset="0"-->
					<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_screenshots')->handle(array(), $_smarty_tpl);?>

	            </div>
			</div>
            <div class="container" style="grid-column: 1 / span 2; display: flex; flex-direction: column; width: 100%;"> <!-- Проекты  background-color: gray; -->
	            <article style="display: flex; gap: 2%; align-items: center; justify-content: space-between;">
	                <h1><span style="display: inline-flex; width: 25px;">//</span> Отзывы </h1>
					<?php if ((($tmp = $_smarty_tpl->getValue('access') ?? null)===null||$tmp==='' ? '' ?? null : $tmp)) {?>
						<div class="div-article">
							<!--<button class="del-feedback" onclick="">удалить отзыв</button>-->
							<button class="add-feedback" onclick="">добавить отзыв</button>
						<div>
					<?php }?>
	            </article>
	            <div class="container" style="display: flex; flex-direction: column; gap:  10px; align-items: flex-start;"> <!-- select="*" from="info_user" orderby="id" limit="3" offset="0"-->
					<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_feedback')->handle(array(), $_smarty_tpl);?>

	            </div>
			</div>
			<div class="container" style="grid-column: 1 / span 2; display: flex; flex-direction: column; width: 100%;"> <!-- Проекты  background-color: gray; -->
	            <article style="display: flex; gap: 2%; align-items: center; justify-content: space-between;">
	                <h1><span style="display: inline-flex; width: 25px;">//</span> Вакансии </h1>
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
		<!--<h1 style="justify-self: start;">А это основные</h1>
		<p  style="justify-self: center;">направления</p>
		<h1 style="justify-self: end;">исследований и разработки</h1>-->
        <p style="font-family: 'Vasek', arial; font-size: 96px; color: #EA5657; margin: 0; line-height: .8em;">Артефакты</p>
	</article>
	<div class="container" style="display: flex; flex-direction: column; margin-top: 2rem; width: 100%;"> <!-- gap: 30px; -->
			<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_interests')->handle(array(), $_smarty_tpl);?>

	</div>
    <div style=" height: auto; display: flex; align-items: center; justify-content: end; flex-direction: row; width: 100%; height: 10%; background-color: #EA5657;">
		<p>Проекты по схожим тегам</p> 
		<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
			<path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"></path>
		</svg>
	</div>
</section>
<!--
<section class="section_2" style="width: 100%;"> /*Артефакты */
	<div style="width: 100%; height: fit-content; padding-bottom: 2%; padding-left: 25%; padding-right: 25%; margin: 0%;">
		<article style="display: grid; width: 50%; align-items: center;">
            <p style="font-family: 'Vasek', arial; font-size: 96px; color: #EA5657; margin: 0; line-height: .8em;">Артефакты</p>
		</article>
		<div class="container" style="display: flex; flex-direction: column; gap: 30px; margin-top: 2rem; width: 100%;">
		</div>
	</div>
	<div style=" height: auto; display: flex; align-items: center; justify-content: end; flex-direction: row; width: 100%; height: 10%; background-color: #EA5657;">
		<p>Посмотрите все наши проекты</p> 
		<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
			<path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"></path>
		</svg>
	</div>
</section>--><?php }
}
