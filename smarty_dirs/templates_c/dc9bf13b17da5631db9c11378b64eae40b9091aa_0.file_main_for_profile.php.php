<?php
/* Smarty version 5.4.2, created on 2025-01-13 13:22:42
  from 'file:C:/xampp/htdocs/portfolioSer/assets/frontend/mains/main_for_profile.php' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.4.2',
  'unifunc' => 'content_678505922c0dd2_05308245',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dc9bf13b17da5631db9c11378b64eae40b9091aa' => 
    array (
      0 => 'C:/xampp/htdocs/portfolioSer/assets/frontend/mains/main_for_profile.php',
      1 => 1736770961,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_678505922c0dd2_05308245 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp\\htdocs\\portfolioSer\\assets\\frontend\\mains';
?><section class="section_1" style="width: 100%; display: flex; flex-direction: column; gap: 100px;">
	<div style="display: flex; flex-direction: column; width: 100%; padding-top: 5%; align-items: center;">
		<article style="display: flex;  width: fit-content; justify-content: center; space-between; gap: 5%; align-items: center; margin: 0 0 1rem 0;">
			<div>
				<img class="avatar-img" src="<?php echo $_smarty_tpl->getValue('icon');?>
" alt="..." style="width: 150px; height: 150px; border-radius: 20px;">
				<!--<button type="submit" onclick="loadAvatar();"> Загрузить изображение</button>-->
				<div class="" style="position: absolute; display: flex;flex-direction: column; justify-content: center; align-items: center; 
				background-color: #cfcbcb61; margin: 10px; row-gap: 10px;">
					<span>Изменить фотографию
						<input id="change-avater" class="avatar" style="opacity: 10%; position: absolute; left: 0; top: 0;" type="file" accept="image/jpeg,image/png,image/gif" onchange="changeAvatar('change');" />
					</span>
					<span>Удалить фотографию
						<input type="submit" id="delete-avatar" class="avatar" style="opacity: 10%; position: absolute; left: 0; top: 30px;  width: 100%;" onclick="changeAvatar('delete');" />
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
				<article class="arcticleProfile"> <!-- display: flex; gap: 2%;-->
					<h1 class="profileHLack"><span style="display: inline-flex; width: 25px;">//</span> Основная информация</h1>
				</article>
				<div class="containerProfile properties" style="display: flex; flex-direction: column; gap: 10px;">
					<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_intelligence')->handle(array('for'=>"properties"), $_smarty_tpl);?>

				</div>
			</div>
			<div class="container" style="display: flex; flex-direction: column; width: 100%; "> <!-- ссылки - background-color: #7feb7f; -->
				<article style="display: flex; gap: 2%;">
					<h1 class="profileHLack"><span style="display: inline-flex; width: 25px;">//</span> Ссылки</h1>
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
					<h1 class="profileHLack"><span style="display: inline-flex; width: 25px; margin:0 0 1rem 0;">//</span> О себе </h1>
				</article>
				<div class="container" style="display: flex; flex-direction: column; gap:  10px; align-items: flex-start;">
					<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_intelligence')->handle(array('for'=>"about"), $_smarty_tpl);?>

				</div>
			</div>
			<div class="container" style="grid-column: 1 / span 2; display: flex; flex-direction: column; width: 100%;"> <!-- Проекты  background-color: gray; -->
				<article style="display: flex; gap: 2%; align-items: center; justify-content: space-between; margin:0 0 1rem 0;">
					<h1 class="profileHLack"><span style="display: inline-flex; width: 25px;">//</span> Проекты </h1>
					<button class="create_project" onclick="window.location.href='<?php echo $_smarty_tpl->getValue('PAGE_PROJECT');?>
'">создать проект</button>
				</article>
				<div class="container" style="display: flex; flex-direction: column; gap:  10px; align-items: flex-start;">
					<?php echo $_smarty_tpl->getSmarty()->getFunctionHandler('query_projects')->handle(array('select'=>"*",'from'=>"info_project",'orderby'=>"id",'limit'=>"3",'offset'=>"0"), $_smarty_tpl);?>

				</div>
			</div>
		</div>
	</div>
	<div style="display: flex; align-items: center; justify-content: end; flex-direction: row; width: 100%; height: 10%; background-color: #EA5657; padding: 2rem 0 1rem 0;">
		<p class="VasekMainWhiteP">Посмотрите все наши проекты</p>
		<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16" style="color: #F6F6F6; margin: 0 1rem 0 1rem;">
			<path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"></path>
		</svg>
	</div>
</section>
<section class="section_3 aos-init aos-animate" style="background-color:rgb(40, 40, 40); border-radius: 10px 10px 0px 0px;" data-aos="fade-up">
	<article style="display: grid; width: 50%; align-self: flex-start; margin-left: 4%; padding-top: 3rem;">
		<h1 class="HelveticaMainWhite" style="justify-self: start;">А это основные</h1>
		<p class="VasekMain" style="justify-self: center; margin-right: 20%;">направления</p>
		<h1 class="HelveticaMainWhite" style="justify-self: end;">исследований и разработки</h1>
	</article>
	<!-- <article style="display: grid; width: 80%; align-self: flex-start;">
            <h1 class="HelveticaMain" style="justify-self: start;">А это основные</h1>
            <p class="VasekMain" style="justify-self: center;">направления</p>
            <h1 class="HelveticaMain" style="justify-self: end;">исследований и разработки</h1>
        </article> -->
	<div class="container" style="display: flex; flex-direction: column; margin-top: 2rem; width: 100%;"> <!-- gap: 30px; -->
		<form method="POST" action="/assets/frontend/pages/project.php" style=" width: 100%; height: fit-content;" class=" interestsForm">
			<button type="submit" style=" appearance: none;" class="interestsSubmitButton">
				<div class="buttonTitle">
					<span style="display: inline-flex; width: 25px;">//</span>frontend
				</div>
				<div class="buttonTags">
					<p>PHP</p>
					<p>JS</p>
					<p>CSS</p>
					<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
						<path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"></path>
					</svg>
				</div>
			</button>
		</form>
		<form method="POST" action="/assets/frontend/pages/project.php" style=" width: 100%; height: fit-content;" class=" interestsForm">
			<button type="submit" style=" appearance: none;" class="interestsSubmitButton">
				<div class="buttonTitle">
					<span style="display: inline-flex; width: 25px;">//</span>backend
				</div>
				<div class="buttonTags">
					<p>C/C++</p>
					<p>C#</p>
					<p>Java</p>
					<p>Python</p>
					<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
						<path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"></path>
					</svg>
				</div>
			</button>
		</form>
	</div>
</section><?php }
}
