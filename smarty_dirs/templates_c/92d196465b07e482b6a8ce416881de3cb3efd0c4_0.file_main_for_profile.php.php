<?php
/* Smarty version 5.4.2, created on 2025-01-29 20:53:37
  from 'file:C:\projects\portfolio_oleg\portfolioSer/assets/frontend/mains/main_for_profile.php' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.2',
  'unifunc' => 'content_679a6b2146c1e7_57794119',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '92d196465b07e482b6a8ce416881de3cb3efd0c4' => 
    array (
      0 => 'C:\\projects\\portfolio_oleg\\portfolioSer/assets/frontend/mains/main_for_profile.php',
      1 => 1738173037,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_679a6b2146c1e7_57794119 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\projects\\portfolio_oleg\\portfolioSer\\assets\\frontend\\mains';
?><section class="section_1">
	<div class="section_1">
		<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_header_page')->handle(array(), $_smarty_tpl);?>

	    <div class="container propertiesProfile" > <!-- height: 500px; style="display: grid; width: 50%; grid-template-columns: 2fr auto; gap: 20px;" -->
	        <div class="container" style="display: flex; flex-direction: column; width: 100%; background-color: #fff;"> <!-- Основная информация-->
	            <article> <!-- display: flex; gap: 2%;-->
	                <h1><span>//</span> Основная информация</h1>
	            </article>
	            <div class="container properties" style="display: flex; flex-direction: column; gap: 10px;">
					<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_properties_profile')->handle(array('for'=>"base_properties"), $_smarty_tpl);?>
              
	            </div>
	        </div>
	        <div class="container contacts"> <!-- ссылки - background-color: #7feb7f; -->
	            <article>
	                  <h1><span>//</span>Контакты </h1>
	            </article>
	            <div id="contacts" class="container remove dragAndDrop" style="display: flex; flex-direction: column; gap:  10px; align-items: flex-start;"  > <!--ondropstart="drop(event)" ondragover="allowDrop(event)"-->
					<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_properties_profile')->handle(array('for'=>"contacts"), $_smarty_tpl);?>

					<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_properties_add')->handle(array('for'=>"contacts"), $_smarty_tpl);?>

	            </div>
				<div id="urls" class="icons remove dragAndDrop">
					<span class="icon" style="display: flex; flex-direction: column; ">
						<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="50" height="50" viewBox="0 0 48 48">
							<path fill="#29b6f6" d="M24 4A20 20 0 1 0 24 44A20 20 0 1 0 24 4Z"></path>
							<path fill="#fff" d="M33.95,15l-3.746,19.126c0,0-0.161,0.874-1.245,0.874c-0.576,0-0.873-0.274-0.873-0.274l-8.114-6.733 l-3.97-2.001l-5.095-1.355c0,0-0.907-0.262-0.907-1.012c0-0.625,0.933-0.923,0.933-0.923l21.316-8.468 c-0.001-0.001,0.651-0.235,1.126-0.234C33.667,14,34,14.125,34,14.5C34,14.75,33.95,15,33.95,15z"></path>
							<path fill="#b0bec5" d="M23,30.505l-3.426,3.374c0,0-0.149,0.115-0.348,0.12c-0.069,0.002-0.143-0.009-0.219-0.043 l0.964-5.965L23,30.505z"></path>
							<path fill="#cfd8dc" d="M29.897,18.196c-0.169-0.22-0.481-0.26-0.701-0.093L16,26c0,0,2.106,5.892,2.427,6.912 c0.322,1.021,0.58,1.045,0.58,1.045l0.964-5.965l9.832-9.096C30.023,18.729,30.064,18.416,29.897,18.196z"></path>
						</svg>
						<div class="icon display">
							<select>
								<option>Вконтакте</option>
								<option>Телеграм</option>
								<option>другое</option>
							</select>
							<input class="contentProperty" type="url" value="..." ></input>
						</div>
					</span>
					<span class="icon">
						<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="50" height="50" viewBox="0 0 48 48">
							<path fill="#1976d2" d="M24 4A20 20 0 1 0 24 44A20 20 0 1 0 24 4Z"></path><path fill="#fff" d="M35.937,18.041c0.046-0.151,0.068-0.291,0.062-0.416C35.984,17.263,35.735,17,35.149,17h-2.618 c-0.661,0-0.966,0.4-1.144,0.801c0,0-1.632,3.359-3.513,5.574c-0.61,0.641-0.92,0.625-1.25,0.625C26.447,24,26,23.786,26,23.199 v-5.185C26,17.32,25.827,17,25.268,17h-4.649C20.212,17,20,17.32,20,17.641c0,0.667,0.898,0.827,1,2.696v3.623 C21,24.84,20.847,25,20.517,25c-0.89,0-2.642-3-3.815-6.932C16.448,17.294,16.194,17,15.533,17h-2.643 C12.127,17,12,17.374,12,17.774c0,0.721,0.6,4.619,3.875,9.101C18.25,30.125,21.379,32,24.149,32c1.678,0,1.85-0.427,1.85-1.094 v-2.972C26,27.133,26.183,27,26.717,27c0.381,0,1.158,0.25,2.658,2c1.73,2.018,2.044,3,3.036,3h2.618 c0.608,0,0.957-0.255,0.971-0.75c0.003-0.126-0.015-0.267-0.056-0.424c-0.194-0.576-1.084-1.984-2.194-3.326 c-0.615-0.743-1.222-1.479-1.501-1.879C32.062,25.36,31.991,25.176,32,25c0.009-0.185,0.105-0.361,0.249-0.607 C32.223,24.393,35.607,19.642,35.937,18.041z"></path>
						</svg>
						<div class="icon display">
							<select>
								<option>Вконтакте</option>
								<option>Телеграм</option>
								<option>другое</option>
							</select>
							<input class="contentProperty" type="url" value="..." ></input>
						</div>
					</span>
					<div class="display" style="display: flex; justify-content: space-between; display: none; width: 100%; align-items: center;">
						<button class="addImage display" onclick="addContactsIcon.call(this.parentNode.parentNode)" style="display: none;">
							<svg class="add" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="none" viewBox="0 0 34 33">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M1.444 17h31.111M17 1v31.111"/>
							</svg>
						</button>
						<svg id="url" class="add remove" xmlns="http://www.w3.org/2000/svg" width="34" height="33" fill="none" viewBox="0 0 100 100" > <!-- stroke="#F6F6F6" -->
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m25.582 43.93 5.542 33.334a8.334 8.334 0 0 0 8.334 6.958H60.79a8.334 8.334 0 0 0 8.333-6.958l5.542-33.334a8.334 8.334 0 0 0-8.334-9.708h-32.54a8.333 8.333 0 0 0-8.208 9.708Z"/>
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M39.999 38.389V27.555a10.042 10.042 0 0 1 10-10 10.042 10.042 0 0 1 10 10V38.39m-4.125 14.957-11.75 11.75m11.75 0-11.75-11.75"/>
						</svg>
					</div>
				</div>
	        </div>
	        <div class="container" style="grid-column: 1 / span 2; display: flex; flex-direction: column; width: 100%; "> <!-- о себе background-color: orange;-->
	            <article>
	                  <h1><span>//</span> О себе </h1>
	            </article>
	            <div class="container" style="display: grid;"> <!-- display: flex; flex-direction: column; gap:  10px; align-items: flex-start; -->
					<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_properties_profile')->handle(array('for'=>"about"), $_smarty_tpl);?>
 
	            </div>
			</div>
			<div class="container" style="grid-column: 1 / span 2; display: flex; flex-direction: column; width: 100%; "> <!-- о себе background-color: orange;-->
	            <article>
	                  <h1><span>//</span> Навыки </h1>
	            </article>
	            <div id="skills" class="contentProperty container skills ">
					<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_properties_profile')->handle(array('for'=>"skills"), $_smarty_tpl);?>

	            </div>
				<div class="display" style="display: flex; flex-direction: column; align-items: center; margin-top: 25px; row-gap: 15px; display: none;">
					<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_input')->handle(array('for'=>"add"), $_smarty_tpl);?>

				</div>
			</div>
			<div class="container" style="grid-column: 1 / span 2; display: flex; flex-direction: column; width: 100%; "> <!-- о себе background-color: orange;-->
	            <article>
	                  <h1><span>//</span> Цели </h1>
	            </article>
	            <div class="container" style="display: flex; flex-direction: column; gap:  10px; align-items: flex-start;">
					<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_properties_profile')->handle(array('for'=>"goals"), $_smarty_tpl);?>

	            </div>
				<div class="display" style="display: flex; flex-direction: column; align-items: center; margin-top: 25px; display: none;"> <!-- row-gap: 15px; -->
					<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_input')->handle(array('for'=>"add",'type'=>"textarea"), $_smarty_tpl);?>

				</div>
			</div>
			<div class="container" style="grid-column: 1 / span 2; display: flex; flex-direction: column; width: 100%; "> <!-- о себе background-color: orange;-->
	            <article>
	                  <h1><span>//</span> Материалы </h1>
	            </article>
	            <div class="container" style="display: flex; flex-direction: column; gap:  10px; align-items: flex-start;">
					<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_properties_profile')->handle(array('for'=>"materials"), $_smarty_tpl);?>

	            </div>
			</div>
	        <div class="container" style="grid-column: 1 / span 2; display: flex; flex-direction: column; width: 100%; "> <!-- Проекты  background-color: gray; -->
	            <article style="display: flex; gap: 2%; align-items: center; justify-content: space-between;">
	                  <h1><span>//</span> Проекты </h1>
					  <button class="create_project" onclick="">создать проект</button>
	            </article>
	            <div class="container" style="display: grid; grid-template-columns: auto auto; gap:  10px; align-items: flex-start; justify-content: center;">
					<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_projects')->handle(array('for'=>"profile",'select'=>"*",'from'=>((string)$_smarty_tpl->getValue('tab_projects')),'orderby'=>"id",'limit'=>"3",'offset'=>"0",'where'=>"author",'author'=>((string)$_smarty_tpl->getValue('id_author'))), $_smarty_tpl);?>

					<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_properties_add')->handle(array('for'=>"projects"), $_smarty_tpl);?>

	            </div>
			</div>
		</div>
	</div>
</section><?php }
}
