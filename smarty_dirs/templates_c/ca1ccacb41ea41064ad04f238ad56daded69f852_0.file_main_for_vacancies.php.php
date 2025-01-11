<?php
/* Smarty version 5.4.2, created on 2025-01-09 17:38:39
  from 'file:C:\projects\site_portfolio/assets/frontend/mains/main_for_vacancies.php' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.2',
  'unifunc' => 'content_677fdf6fa47013_02023829',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ca1ccacb41ea41064ad04f238ad56daded69f852' => 
    array (
      0 => 'C:\\projects\\site_portfolio/assets/frontend/mains/main_for_vacancies.php',
      1 => 1736432417,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_677fdf6fa47013_02023829 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\projects\\site_portfolio\\assets\\frontend\\mains';
?><section class="section_1" style="width: 100%;">
	<div style="width: 100%; height: fit-content; padding-bottom: 2%; padding-left: 25%; padding-right: 25%; margin: 0%;">
		<article style="display: grid; width: 50%; align-self: flex-start;">
			<h1 style="justify-self: start;">Представляем вам</h1>
			<p  style="justify-self: center;">лучшие проекты</p>
			<h1 style="justify-self: end;">базовой кафедры</h1>
		</article>
		<div class="container" style="display: flex; flex-direction: column; gap: 30px; margin-top: 2rem; width: 100%;">
            <select name="pets" id="pet-select">
                <option value="">--Please choose an option--</option>
                <option value="dog">Dog</option>
                <option value="cat">Cat</option>
                <option value="hamster">Hamster</option>
                <option value="parrot">Parrot</option>
                <option value="spider">Spider</option>
                <option value="goldfish">Goldfish</option>
            </select>
            <input>
            </input>
            <button>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"></path>
                </svg>
            </button>
		</div>
        <div class="container" style="display: grid; grid-template-columns: 1fr 1fr; gap: 0px; margin-top: 2rem; width: 100%; justify-items: center; place-content: center;"> <!-- repid in main_for_index-->
            <?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_vacancies')->handle(array(), $_smarty_tpl);?>

        </div>
	</div>
	<div style=" height: auto; display: flex; align-items: center; justify-content: end; flex-direction: row; width: 100%; height: 10%; background-color: #EA5657;">
		<p>Посмотрите все наши проекты</p> <!-- position: fixed; -->
		<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
			<path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"></path>
		</svg>
	</div>
</section>
<section class="section_2" style="background-color: black; border-radius: 10px 10px 0px 0px; color: white;"> <!-- relative footer -->
    <a href="index.html" class="logo d-flex align-items-center">
        <span class="sitename" style="text-align: start; font-family: 'Lack', arial; font-size: 28px; color:rgb(255, 255, 255); margin: 0; font-weight: normal;">Контакты</span>
    </a>
    <p style="text-align: start; font-family: 'Helvetica', arial; font-size: 16px; color:rgb(240, 240, 240); margin: 0 0 3rem 1rem; font-weight: 100;">
        +7 (499) 215-65-65 доб. 2404  
    </p>
    <br>
    <p> vega@mirea.ru </p>
</section><?php }
}
