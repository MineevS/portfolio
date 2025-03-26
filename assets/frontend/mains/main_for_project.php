<section class="section_1" style="">
	<div style="">
		{query_header_page}
		<div class="container" style="">
			<div class="container" style="display: grid; grid-template-columns: 30vw auto; width: 100%; background-color: #fff; grid-template-rows: 10vw"> <!-- Основная информация-->

				<div class="container properties" style="display: flex; flex-direction: column; gap: 10px;"> <!--for="properties" -->
					<article> <!-- display: flex; gap: 2%;-->
						<h2 class="projectH2"><span>//</span> Основная информация </h2>
					</article>
					{query_properties_project for="properties"}
				</div>
				<div class="container" style="display: flex; flex-direction: column; width: 100%; gap: 7%;"> <!-- ссылки - background-color: #7feb7f; -->
					<article>
						<h2 class="projectH2"><span>//</span> Ссылки</h2>
					</article>
					<div class="contentProperty container dragAndDrop" id="references" style="display: flex; flex-direction: column; gap:  10px; align-items: flex-start; resize: none;">
						<!--query_properties_profile  	for="contacts"-->
						{query_properties_add for="references"}
					</div>
				</div>
				<div class="container_about"> <!-- о себе background-color: orange;-->
					<article>
						<h2 class="projectH2"><span>//</span> О проекте </h2>
					</article>
					<div class="container about">
						{query_properties_project for="description"}
					</div>
				</div>
				<div class="container" style="grid-column: 1 / span 2; display: flex; flex-direction: column; width: 100%; "> <!-- о себе background-color: orange;-->
					<article>
						<h2 class="projectH2"><span>//</span> Теги </h2>
					</article>
					<div id="tags" class="contentProperty container tags ">
						{query_properties_project for="tags"}
					</div>
					<div class="display" style="display: flex; flex-direction: column; align-items: center; margin-top: 25px; row-gap: 15px; display: none;">
						{query_input for="tags" type="span"}
					</div>
				</div>
				<div class="container" style="grid-column: 1 / span 2; display: flex; flex-direction: column; width: 100%; "> <!-- о себе background-color: orange;-->
					<article>
						<h2 class="projectH2"><span>//</span> Стек технологий </h2>
					</article>
					<div id="stack" style="display: flex; flex-direction: row; align-items: center;  flex-wrap: wrap; width: 30vw;" class="contentProperty container stack ">
						{query_properties_project for="stack"}
					</div>
					<div class="display" style="display: flex; flex-direction: row; align-items: center; margin-top: 25px; row-gap: 15px; display: none;">
						{query_input for="stack"}
					</div>
				</div>
				<div class="container" style="grid-column: 1 / span 2; display: flex; flex-direction: column; width: 100%;"> <!-- Проекты  background-color: gray; -->
					<article>
						<h2 class="projectH2"><span>//</span> Команда проекта </h2>
					</article>
					<div class="container team" style="display: flex; flex-direction: column; gap: 2rem; align-items: flex-start;"> <!-- select="*" from="info_user" orderby="id" limit="3" offset="0"-->
						{query_properties_project for="team"}
						<!--query_properties_add 	  for="team"-->
					</div>
					<div class="display" style="display: flex; flex-direction: column; align-items: center; margin-top: 25px; row-gap: 15px; display: none;">
						{query_input for="team"}
					</div>
				</div>
				<div class="container" style=""> <!-- Проекты  background-color: gray; -->
					<article>
						<h2 class="projectH2"><span>//</span> Скриншоты </h2>
					</article>
					<div class="container" style="display: grid; grid-template-columns: auto auto; gap:  10px;"> <!-- select="*" from="info_user" orderby="id" limit="3" offset="0"-->
						{query_properties_project for="screenshots"}
					</div>
					<div class="display" style="display: flex; flex-direction: column; align-items: center; margin-top: 25px; row-gap: 15px; display: none;">
						{query_input for="screenshots"}
					</div>
				</div>
				<div class="container" style="grid-column: 1 / span 1; display: flex; flex-direction: column; width: 87%;"> <!-- Проекты  background-color: gray; -->
					<article>
						<h2 class="projectH2"><span>//</span> Отзывы </h2>
					</article>
					<div class="container container-feedbacks"> <!-- select="*" from="info_user" orderby="id" limit="3" offset="0"-->
						{query_properties_project for="feedback"}
					</div>
					<div class="display" style="display: flex; flex-direction: column; align-items: center; margin-top: 25px; row-gap: 15px; display: none;">
						{query_input for="feedbacks"}
					</div>
				</div>
				<div class="container" style="grid-column:1; display: grid; width: 100%; justify-items: center;"> <!-- Проекты  background-color: gray; -->
					<article style="justify-self: start;">
						<h2 class="projectH2"><span>//</span> Вакансии </h2>
						{if $access|default}
						<div class="div-article">
							<!--<button class="del-vacancy"  onclick="delElem('vacancy', '{$ACTION}');">удалить вакансию</button>-->
							<button class="add-vacancy showHide" onclick="window.location.href='{$PAGE_VACANCY}'">добавить вакансию</button> <!-- onclick="addElem('vacancy', '{$ACTION}');-->
							<div>
								{/if}
					</article>
					<div class="container vacancies-container" style=""> <!-- ТУТ grid в отличие от остальных --><!-- select="*" from="info_user" orderby="id" limit="3" offset="0"-->
						<form class="formVacancy" method="POST" action="/assets/frontend/pages/vacancy.php" style="width: 100%;">
							<div class="divVacancy">
								<div style=" display: grid; align-items: center; justify-content: space-between; grid-template-columns: 2fr 1fr; "> <!--  height: 50px;-->
									<h1 class="cardTitle">Разработчик Telegram-ботов c интеграцией в канал кафедры</h1> <!-- style="text-align: center;">" -->
									<input type="text" style=" background: #FFF3CD; color: #866906;" class="coincidenceVacancy" value="совпадение 95%">
								</div>
								<p class="vacancieDescription" style="">Автоматизация быстрых ответов на часто задаваемые вопросы от студентов кафедры</p>
								<div class="contentProperty" id="tags" style="width: 100%; display: flex; column-gap: 2%;"><label class="labelTag" style="padding: 5px; ">Python</label><label class="labelTag" style="padding: 5px; ">SQL</label><label class="labelTag" style="padding: 5px; ">Telegram Bot</label></div>
								<div>
									<p class="cardDuties" style="font-size: 1.3vw;">Обязанности:</p>
									<ul>
										<li class="cardDuty">Разработка и внедрение Telegram-бота для автоматизации ответов на часто задаваемые вопросы.</li>
										<li class="cardDuty">Создание структуры базы данных для хранения вопросов и ответов, а также интеграция с существующими системами (если необходимо).</li>
										<li class="cardDuty">Реализация функций обработки запросов пользователей и предоставления им актуальной информации.</li>
										<li class="cardDuty">Проведение тестирования бота и исправление ошибок на основе полученной обратной связи.</li>
									</ul>
								</div>
							</div><input type="hidden" name="id" id="id" value="3"><button class="clickVacancy" type="submit"> Откликнуться </button>
						</form>
						{if $project_id|default}
						{query_vacancies select="*" from="$tab_vacancies" orderby="id" where="project_id" project_id="$project_id"}
						{/if}
					</div> <!-- limit="3" offset="0" -->
				</div>

			</div>
		</div>
	</div>
</section>
<section class="section_3" style="background-color:rgb(40, 40, 40); border-radius: 10px 10px 0px 0px; width: 100%;">
	<article style="display: grid; width: 50%; align-self: flex-start;">
		<!--<h2 style="justify-self: start;">А это основные</h2>
		<p  style="justify-self: center;">направления</p>
		<h2 style="justify-self: end;">исследований и разработки</h2>-->
		<p style="font-family: 'Vasek', arial; font-size: 96px; color: #EA5657; margin: 0; line-height: .8em;">Артефакты</p>
	</article>
	<div class="container" style="display: flex; flex-direction: column; margin-top: 2rem; width: 100%;"> <!-- gap: 30px; -->
		{query_interests}
	</div>
	<div style=" height: auto; display: flex; align-items: center; justify-content: end; flex-direction: row; width: 100%; height: 10%; background-color: #EA5657;">
		<p>Проекты по схожим тегам</p>
		<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
			<path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h21.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5h2.5A.5.5 0 0 1 1 8"></path>
		</svg>
	</div>
</section>
<script>
	$(document).ready(function() {
		let name = document.getElementById('name');
		name.size = name.value.length * 0.47;
		// if (name.value.length - 10 > 0) {
		// 	console.log(name.value.length - 12);

		// 	name.size = name.value.length - 10;
		// } 

		let status = document.getElementById('status');
		if (status.value.length >= 0) {
			status.size = status.value.length;
		}

		let user_data = document.querySelectorAll('input.user_data');
		user_data.forEach(element => {
			// console.log(element);
			element.size = element.value.length - 1;
		});

		// let projectTitle = document.querySelectorAll('input.projectTitle ');
		// projectTitle.forEach(element => {
		// 	element.size = element.value.length;
		// });
	})
</script>