<?php
/* Smarty version 5.4.2, created on 2025-01-26 14:34:51
  from 'file:C:/xampp/htdocs/portfolio/assets/frontend/mains/main_for_teams.php' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.2',
  'unifunc' => 'content_679639fbc729d7_47162306',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '583e2c0915632d3b2c58fc5cd7412268ce150eeb' => 
    array (
      0 => 'C:/xampp/htdocs/portfolio/assets/frontend/mains/main_for_teams.php',
      1 => 1737883032,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_679639fbc729d7_47162306 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\portfolio\\assets\\frontend\\mains';
?><section class="section_1" style="width: 100%;">
    <div style="width: 65%; /*padding: 5% 7% 7% 7%;*/ padding-bottom: 2%; height: fit-content;/* padding-bottom: 2%; *//* padding-left: 25%; *//* padding-right: 25%; */margin: 0%;">
        <article style="display: grid; width: 50%; align-self: flex-start;">
            <h1 class="HelveticaMain" style="justify-self: start;">Представляем вам</h1>
            <p class="VasekMain" style="justify-self: center;">лучшие проекты</p>
            <h1 class="HelveticaMain" style="justify-self: end;">базовой кафедры</h1>
        </article>
        <div class="container" style="display: flex; flex-direction: row; gap: 30px; margin-top: 2rem; width: 100%; justify-content: flex-start;">
            <div class="dropdown">
                <button class="dropbtn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-funnel" viewBox="0 0 16 16">
                        <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5zm1 .5v1.308l4.372 4.858A.5.5 0 0 1 7 8.5v5.306l2-.666V8.5a.5.5 0 0 1 .128-.334L13.5 3.308V2z" />
                    </svg></button>
                <div class="dropdown-content">
                    <a href="#">Link 1</a>
                    <a href="#">Link 2</a>
                    <a href="#">Link 3</a>
                </div>
            </div>
            <input class="inputSearch">
            </input>
            <button class="buttonCard">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"></path>
                </svg>
            </button>
        </div>
        <hr class="hrProject">
        <div class="container" style="display: flex; flex-direction: column; gap: 30px; margin-top: 2rem; width: 100%; "> <!-- min-height: 200px; -->
            <?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_teams')->handle(array('select'=>"*",'from'=>"info_teams",'orderby'=>"id",'limit'=>"3"), $_smarty_tpl);?>

        </div>
    </div>
</section><?php }
}
