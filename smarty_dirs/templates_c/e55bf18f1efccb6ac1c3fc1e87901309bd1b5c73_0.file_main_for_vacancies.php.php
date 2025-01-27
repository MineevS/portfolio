<?php
/* Smarty version 5.4.2, created on 2025-01-26 14:34:44
  from 'file:C:/xampp/htdocs/portfolio/assets/frontend/mains/main_for_vacancies.php' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.2',
  'unifunc' => 'content_679639f4637fd6_78040632',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e55bf18f1efccb6ac1c3fc1e87901309bd1b5c73' => 
    array (
      0 => 'C:/xampp/htdocs/portfolio/assets/frontend/mains/main_for_vacancies.php',
      1 => 1737883032,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_679639f4637fd6_78040632 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\portfolio\\assets\\frontend\\mains';
?><section class="section_1" style="width: 100%;">
	<div style="width: 100%;  "> <!-- margin-top: 5%; height: fit-content; padding-bottom: 2%; padding-left: 25%; padding-right: 25%; -->
		<article style="display: grid; width: 60%; align-self: flex-start; padding-left: 15%;">
			<h1 class="HelveticaMain" style="justify-self: start;">Наши открытые</h1>
			<p class="VasekMain" style="justify-self: center;">вакансии в команды</p>
			<h1 class="HelveticaMain" style="justify-self: end;">лучших разработчиков</h1>
		</article>
		<div class="container search" style="">
            <div class="container-search">
                <span class="search">
                    <input class="search" type="search" placeholder="Поиск" />
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="none" viewBox="0 0 15 15">
                    <path stroke="#858585" stroke-linecap="round" d="M10.698 10.59 14 14m-1.91-7.274c0 3.163-2.483 5.727-5.545 5.727C3.482 12.453 1 9.889 1 6.726 1 3.564 3.482 1 6.545 1c3.062 0 5.544 2.564 5.544 5.726Z"/>
                    </svg>
                </span>
                <div style="position: relative;">
                    <button class="tags round">
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="11" fill="none" viewBox="0 0 15 11">
                            <path stroke="#858585" stroke-linecap="round" stroke-linejoin="round" d="M1 10h6M1 5.5h9M1 1h13"/>
                        </svg>
                    </button>
                    <button class="filter round" onclick="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="none" viewBox="0 0 17 17">
                            <path stroke="#858585" stroke-linecap="round" stroke-linejoin="round" d="M2.722 2h11.556c.399 0 .722.328.722.734v1.163a.74.74 0 0 1-.211.519l-4.633 4.706a.74.74 0 0 0-.212.518v4.626a.725.725 0 0 1-.897.712l-1.444-.367a.732.732 0 0 1-.548-.712V9.64a.74.74 0 0 0-.211-.518L2.212 4.416A.74.74 0 0 1 2 3.897V2.734C2 2.328 2.323 2 2.722 2Z"/>
                        </svg>
                    </button>
                    <!--<iframe id="filter" class="frame-filter" style="position: fixed; top: 25%; left: 25%; width: 50%; background: #fff; border: 1px solid #d9d9d9;">
                    </iframe>-->
                    <div id="filter" class="filter" style="">
                        <input type="checkbox" value="SQL"/> <label for="scales">SQL</label>
                        <input type="checkbox" value="C++"/> <label for="scales">C++</label>
                        <input type="checkbox" value="Python"/> <label for="scales">Python</label>
                    </div>
                </div>
            </div>
            <div style="display: flex; flex-direction: column; align-items: center;">
                <div id="tags" class="container">
                    <label class="labelTag" style="">SQL <!-- padding-right: 5px; -->
                        <button onclick="this.parentNode.remove();" class="buttonTag" style="display: auto;"> <!-- hidden visibility: hidden; stroke="#F6F6F6" -->
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="7 10 20 20">
                                <path stroke="#777" stroke-linecap="round" d="M10.903 14.904 15.5 19.5m0 0 4.597 4.596M15.499 19.5l4.597-4.596M15.499 19.5l-4.596 4.596"></path>
                            </svg>
                        </button>
                    </label>
                </div>
            </div>
        </div>
        <!--<hr class="hrProject">-->
        <div class="container vacancies-container" style="display: flex;"> <!-- repid in main_for_index-->
            <?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_vacancies')->handle(array('select'=>"*",'from'=>((string)$_smarty_tpl->getValue('tab_vacancies')),'orderby'=>"id",'limit'=>((string)$_smarty_tpl->getValue('limit_vacancies')),'offset'=>"0"), $_smarty_tpl);?>

        </div>
	</div>
	<!--<div style=" height: auto; display: flex; align-items: center; justify-content: end; flex-direction: row; width: 100%; height: 10%; background-color: #EA5657;">
		<p>Посмотрите все наши проекты</p> 
		<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
			<path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"></path>
		</svg>
	</div>-->
</section>
<?php }
}
