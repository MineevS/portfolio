<?php
/* Smarty version 5.4.2, created on 2025-01-29 21:11:12
  from 'file:C:\projects\portfolio_oleg\portfolioSer/assets/frontend/mains/main_for_vacancy.php' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.2',
  'unifunc' => 'content_679a6f40175fc1_73986287',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4cd4be77d0128315649f4a1214f01a280e7730ff' => 
    array (
      0 => 'C:\\projects\\portfolio_oleg\\portfolioSer/assets/frontend/mains/main_for_vacancy.php',
      1 => 1738125470,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_679a6f40175fc1_73986287 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\projects\\portfolio_oleg\\portfolioSer\\assets\\frontend\\mains';
?><section class="section_1" style="width: 100%; display: flex; flex-direction: column; gap: 100px;">
	<div style="display: flex; flex-direction: column; width: 100%; align-items: center; "> <!-- padding-top: 10%; -->
		<!--<article style="display: flex;  width: fit-content; justify-content: center; space-between; gap: 5%; align-items: center;"></article>--> <!-- head1="Создайте" -->
		
	    <div class="container" style="display: grid; width: 50%; grid-template-columns: 2fr auto; margin-bottom: 2vh;"> <!-- gap: 20px; height: 500px; -->
	        <div class="container" style="margin-top: 5vh; display: flex; flex-direction: column; width: 100%; background-color: #fff;"> <!-- Основная информация-->
				<!--query_article head1="" head2="Вакансия" head3="в команду" class="article"-->
				<article>
					<p class="VasekMain" style="justify-self: start;"> Вакансия </p>
					<h1 class="HelveticaMain" style="justify-self: center;"> в команду </h1>
					<?php if ((($tmp = (null !== ($_smarty_tpl->getValue('access') ?? null)) ?? null)===null||$tmp==='' ? '' ?? null : $tmp)) {?>
						<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_editor_button')->handle(array('action'=>((string)$_smarty_tpl->getValue('ACTION')),'style'=>"justify-self: end;"), $_smarty_tpl);?>

                		<!-- <button id="editPage" style="justify-self: end;" onclick="editPage.call(this, true, '<?php echo $_smarty_tpl->getValue('ACTION');?>
');">редактировать</button>-->
					<?php }?>
				</article>

				<article> <!-- display: flex; gap: 2%;-->
					
	                <h1><span style="display: inline-flex; width: 25px;">//</span> Проект </h1>
	            </article>
	            <div class="container properties" style="display: flex;flex-direction: column;width: 100%;align-items: center;"> <!--gap: 30px; margin-top: 2rem; for="properties" justify-content: flex-start; height: 20vh;-->
					<a href="<?php echo $_smarty_tpl->getValue('PAGE_PROJECT');?>
" style="width: fit-content;"> <!-- page="$PAGE_PROJECT"-->
						<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_properties_project')->handle(array('for'=>"name"), $_smarty_tpl);?>

					</a>
					<!-- page="$PAGE_PROJECT" <label for="select_status">Статус:  <input id="input_status"  width: 49%;          value="'.$status.'"         name="selectStatus" readonly /></label>--> <!-- hidden type="hidden" -->
					<!--<div class="container" style="width: 100%;">
						<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Введите название проекта...">
						<ul id="myUL" style="position: absolute; z-index: 5; width: 50%;" hidden="true">
							<li onclick="resultSearch('Adele')"><a href="#">Adele</a></li>
							<li onclick="resultSearch('Agnes')"><a href="#">Agnes</a></li>

							<li onclick="resultSearch('Billy')"><a href="#">Billy</a></li>
							<li onclick="resultSearch('Bob')"><a href="#">Bob</a></li>

							<li onclick="resultSearch('Calvin')"><a href="#">Calvin</a></li>
							<li onclick="resultSearch('Christina')"><a href="#">Christina</a></li>
							<li onclick="resultSearch('Cindy')"><a href="#">Cindy</a></li>
						</ul>
					</div>
					<div id="result" class="container" style="display: flex; gap: 1%; align-items: center; justify-self: bottom;">
						<label>Выбранный проект:</label>
					</div>-->
	        	</div>
			</div>
			<div class="container" style="grid-column: 1 / span 2; display: flex; flex-direction: column; width: 100%; "> <!-- о себе background-color: orange;-->
	            <article style="display: flex; gap: 2%;">
	                  <h1><span style="display: inline-flex; width: 25px;">//</span> Специальность </h1>
	            </article>
	            <div class="container" style="display: flex;flex-direction: column;width: 100%;align-items: center;">
					<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_properties_vacancy')->handle(array('for'=>"speciality"), $_smarty_tpl);?>

	            </div>
			</div>
	        <div class="container" style="grid-column: 1 / span 2; display: flex; flex-direction: column; width: 100%; "> <!-- о себе background-color: orange;-->
	            <article style="display: flex; gap: 2%;">
	                  <h1><span style="display: inline-flex; width: 25px;">//</span> Описание </h1>
	            </article>
	            <div class="container" style="display: flex; flex-direction: column; gap:  10px; align-items: flex-start;">
					<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_properties_vacancy')->handle(array('for'=>"about"), $_smarty_tpl);?>

	            </div>
			</div>
	        <div class="container" style="grid-column: 1 / span 2; display: flex; flex-direction: column; width: 100%;"> <!-- Проекты  background-color: gray; -->
	            <article style="display: flex; gap: 2%; align-items: center; justify-content: space-between;">
	                  <h1><span style="display: inline-flex; width: 25px;">//</span> Теги </h1>
                      <!--<div>
                        <button class="del-author" onclick="">удалить тег</button>
                        <button class="add-author" onclick="">добавить тег</button>
                      <div>-->
	            </article>
				 <?php if ((($tmp = $_smarty_tpl->getValue('access') ?? null)===null||$tmp==='' ? '' ?? null : $tmp)) {?>
				 <div class="input_content container" style="display: none; flex-direction: column; gap:  10px; align-items: center;"> <!-- select="*" from="info_user" orderby="id" limit="3" offset="0"-->
						<!--query_authors-->
						<!--<div class="container" style="width: 100%;">-->
						<textarea id="tag"> </textarea>
						<button class="addTag" onkeyup="myFunction()" onclick="addTag();">Добавить</button>
					</div>
				 <?php }?>
				<div id="result" class="container"> <!-- justify-self: bottom; -->
					<!--<label></label>-->
					<?php if ((($tmp = $_smarty_tpl->getValue('vacancy_id') ?? null)===null||$tmp==='' ? '' ?? null : $tmp)) {?>
						<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_properties_vacancy')->handle(array('for'=>"tags",'del'=>"false"), $_smarty_tpl);?>

					<?php }?>
				</div>
			</div>
	        <div class="container" style="grid-column: 1 / span 2; display: flex; flex-direction: column; width: 100%;"> <!-- Проекты  background-color: gray; -->
	            <article style="display: flex; gap: 2%; align-items: center; justify-content: space-between;">
	                  <h1><span style="display: inline-flex; width: 25px;">//</span> Обязанности </h1>
                      <!--<div>
                        <button class="del-author" onclick="">удалить тег</button>
                        <button class="add-author" onclick="">добавить тег</button>
                      <div>-->
	            </article>
				 <?php if ((($tmp = $_smarty_tpl->getValue('access') ?? null)===null||$tmp==='' ? '' ?? null : $tmp)) {?>
					<div class="input_content container" style="display: none; flex-direction: column; gap:  10px; align-items: center;"> <!-- select="*" from="info_user" orderby="id" limit="3" offset="0"-->
						<!--query_authors-->
						<!--<div class="container" style="width: 100%;">-->
						<textarea id="duty"> </textarea>
						<button class="addDuty" onclick="addDuty();">Добавить</button>
					</div>
				 <?php }?>
				<div id="result" class="container resultTag"> <!-- justify-self: bottom; -->
					<!--<label></label>-->
					<?php if ((($tmp = $_smarty_tpl->getValue('vacancy_id') ?? null)===null||$tmp==='' ? '' ?? null : $tmp)) {?>
						<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_properties_vacancy')->handle(array('for'=>"duties"), $_smarty_tpl);?>

					<?php }?>
				</div>
			</div>
		</div>
	</div>
</section><?php }
}
