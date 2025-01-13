<?php
/* Smarty version 5.4.2, created on 2025-01-13 10:05:16
  from 'file:C:\projects\portfolio_oleg\portfolioSer/assets/frontend/mains/main_for_profile.php' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.2',
  'unifunc' => 'content_6784bb2c13e007_97565284',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '92d196465b07e482b6a8ce416881de3cb3efd0c4' => 
    array (
      0 => 'C:\\projects\\portfolio_oleg\\portfolioSer/assets/frontend/mains/main_for_profile.php',
      1 => 1736750642,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_6784bb2c13e007_97565284 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\projects\\portfolio_oleg\\portfolioSer\\assets\\frontend\\mains';
?><section class="section_1" style="width: 100%; display: flex; flex-direction: column; gap: 100px;">
	<div style="display: flex; flex-direction: column; width: 100%; padding-top: 10%; align-items: center;">
		<article style="display: flex;  width: fit-content; justify-content: center; space-between; gap: 5%; align-items: center;">
			<div>
				<img class="avatar-img" src="<?php echo $_smarty_tpl->getValue('icon');?>
" alt="..." style="width: 150px; height: 150px; border-radius: 20px;">
				<!--<button type="submit" onclick="loadAvatar();"> Загрузить изображение</button>-->
				<div class="" style="position: absolute; display: flex;flex-direction: column; justify-content: center; align-items: center; 
				background-color: #cfcbcb61; margin: 10px; row-gap: 10px;">
					<span>Изменить фотографию
						<input id="change-avater" class="avatar" style="opacity: 10%; position: absolute; left: 0; top: 0;" type="file" accept="image/jpeg,image/png,image/gif" onchange="changeAvatar('change');"/>
					</span>
					<span>Удалить фотографию
						<input type="submit" id="delete-avatar" class="avatar" style="opacity: 10%; position: absolute; left: 0; top: 30px;  width: 100%;" onclick="changeAvatar('delete');"/>
					</span>
				</div>
			</div>
            <p style="font-family: 'Vasek', arial; font-size: 96px; color: #EA5657; margin: 0; line-height: .8em;"><?php echo $_smarty_tpl->getValue('firstname');?>
</p>
            <p style="font-family: 'Vasek', arial; font-size: 96px; color: #EA5657; margin: 0; line-height: .8em;"><?php echo $_smarty_tpl->getValue('lastname');?>
</p>
		</article>
	    <div class="container" style="display: grid; width: 50%; grid-template-columns: 2fr auto; gap: 20px;"> <!-- height: 500px; -->
	        <div class="container" style="display: flex; flex-direction: column; width: 100%; background-color: #fff;"> <!-- Основная информация-->
	            <article> <!-- display: flex; gap: 2%;-->
	                <h1><span style="display: inline-flex; width: 25px;">//</span> Основная информация</h1>
	            </article>
	            <div class="container properties" style="display: flex; flex-direction: column; gap: 10px;">
					<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_intelligence')->handle(array('for'=>"properties"), $_smarty_tpl);?>
                 
	            </div>
	        </div>
	        <div class="container" style="display: flex; flex-direction: column; width: 100%; "> <!-- ссылки - background-color: #7feb7f; -->
	            <article style="display: flex; gap: 2%;">
	                  <h1><span style="display: inline-flex; width: 25px;">//</span> Ссылки</h1>
	            </article>
	            <div class="container" style="display: flex; flex-direction: column; gap:  10px; align-items: flex-start;">
	                <a href="token@email.ru">token@email.ru</a> <!-- style="text-decoration: auto;"-->
					<a href="token@email.ru">token@email.ru</a>
	            </div>
				<div>
					<button class="editProfileButton" onclick="editProfile(true, '<?php echo $_smarty_tpl->getValue('ACTION');?>
');">Редактировать профиль</button>
				</div>
	        </div>
	        <div class="container" style="grid-column: 1 / span 2; display: flex; flex-direction: column; width: 100%; "> <!-- о себе background-color: orange;-->
	            <article style="display: flex; gap: 2%;">
	                  <h1><span style="display: inline-flex; width: 25px;">//</span> О себе </h1>
	            </article>
	            <div class="container" style="display: flex; flex-direction: column; gap:  10px; align-items: flex-start;">
					<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_intelligence')->handle(array('for'=>"about"), $_smarty_tpl);?>

	            </div>
			</div>
	        <div class="container" style="grid-column: 1 / span 2; display: flex; flex-direction: column; width: 100%;"> <!-- Проекты  background-color: gray; -->
	            <article style="display: flex; gap: 2%; align-items: center; justify-content: space-between;">
	                  <h1><span style="display: inline-flex; width: 25px;">//</span> Проекты </h1>
					  <button class="create_project" onclick="window.location.href='<?php echo $_smarty_tpl->getValue('PAGE_PROJECT');?>
'">создать проект</button>
	            </article>
	            <div class="container" style="display: flex; flex-direction: column; gap:  10px; align-items: flex-start;">
					<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_projects')->handle(array('select'=>"*",'from'=>"info_project",'orderby'=>"id",'limit'=>"3",'offset'=>"0"), $_smarty_tpl);?>

	            </div>
			</div>
		</div>
	</div>
	<div style="display: flex; align-items: center; justify-content: end; flex-direction: row; width: 100%; height: 10%; background-color: #EA5657;"> <!-- background-color: #EA5657; -->
		<p>Посмотрите все наши проекты</p> <!-- position: fixed; -->
		<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
			<path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"></path>
		</svg>
	</div>
</section>
<section class="section_1" style="width: 100%;"> <!-- Артефакты -->
	<div style="width: 100%; height: fit-content; padding-bottom: 2%; padding-left: 25%; padding-right: 25%; margin: 0%;">
		<article style="display: grid; width: 50%; align-items: center;">
            <p style="font-family: 'Vasek', arial; font-size: 96px; color: #EA5657; margin: 0; line-height: .8em;">Артефакты</p>
		</article>
		<div class="container" style="display: flex; flex-direction: column; gap: 30px; margin-top: 2rem; width: 100%;">
		</div>
	</div>
	<div style=" height: auto; display: flex; align-items: center; justify-content: end; flex-direction: row; width: 100%; height: 10%; background-color: #EA5657;"> <!-- background-color: #EA5657; -->
		<p>Посмотрите все наши проекты</p> 
		<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
			<path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"></path>
		</svg>
	</div>
</section>
<?php }
}
