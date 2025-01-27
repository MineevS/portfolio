<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> <!--Обязательно указываем размеры, иначе не будет смены @media -->
		
		<!--{0} Название сайта -->
		<title>Портфолио - ВЕГА</title>
		
		<!--{1} Иконка сайта -->
		<link  href="{$FCN}" 		type="image/x-icon" 	rel="icon">


		
		<!--{2} Стили-->
		<link href="{$CSS_MAIN}" 	type="text/css" 	rel="stylesheet"> <!-- Стиль для `<main>`-->
		<link href="{$CSS_TOTAL}" 	type="text/css" 	rel="stylesheet"> <!-- Общий стиль для всех страниц --> 
		<link href="{$CSS_AOS}"		type="text/css"		rel="stylesheet">

		<!--{3} Скрипты -->
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.6/Sortable.min.js"></script>
		
		<script src="{$JSX}" 		type="text/javascript"></script> 
		<script src="{$JQR}" 		type="text/javascript"></script>
		<script src="{$AOS}" 		type="text/javascript"></script>

		<link href="/assets/backend/library/select2/select2.min.css" rel="stylesheet" />
		<script src="/assets/backend/library/select2/select2.min.js"></script>
	</head>
	<body>
		<div class="layout">
			<header>
				<a class="logo" href="{$INDEX}">
					<h1 class="font-logo">ПОРТФОЛИО</h1>
				</a>
				<div class="menu">
					<nav class="nav">
						<ul>
							<li>
								<a href="{$PROJECTS}">Проекты</a>
							</li>
							<li>
								<a href="{$TEAMS}">Команды</a>
							</li>
							<li>
								<a href="{$VACANCIES}">Вакансии</a>
							</li>
						</ul>
					</nav>
					<div>
						{if isset($icon)|default}
							<a href="">
								<img id="profile" class="avatar" src="{$icon}" />
							</a>
							<section style="display: flex; flex-direction: column; position: absolute; z-index: 5; width: fit-content; heigh: 100px; border: 3px solid black; border-radius: 5px; ">
								<button onclick="location.href='{$PROFILE}'">Мой профиль</button>
								<button onclick="logout('{$ACTION}');">Выход</button>
							</section>
						{else}
							<div>
								<a target="iframe-auth-reg" onclick="create_iframe_authorization_registration();" href="{$HFR}" >Вход</a> <!-- <?php echo AUTH::PATH->value; ?> href="./frames/authorization.html" -->
							</div>
						{/if}
					</div> 						<!--{date_now}-->
				</div>
			</header>
			<main>
				{include file="$MAIN"}
			</main>
			<footer>
				<a href="index.html" class="logo d-flex align-items-center">
					<span class="sitename" style="text-align: start; font-family: 'Lack', arial; font-size: 28px; color:rgb(255, 255, 255); margin: 0; font-weight: normal;">Контакты</span>
				</a>
				<p style="text-align: start;font-family: 'Helvetica', arial;font-size: 16px;color:rgb(240, 240, 240);/* margin: 0 0 3rem 1rem; */font-weight: 100;">
					+7 (499) 215-65-65 доб. 2404  
				</p>
				<a style="color: white;"> vega@mirea.ru </a>
			</footer>
		</div>
		<!-- script's code -->
		<script>
			AOS.init();
		</script>
	</body>
</html>