<section class="section_1" style="width: 100%; display: flex; flex-direction: column; gap: 100px;">
	<div style="display: flex; flex-direction: column; width: 100%; align-items: center;"> <!-- padding-top: 10%; -->
		<article style="display: flex;  width: fit-content; justify-content: center; space-between; gap: 5%; align-items: center;">
            <p style="font-family: 'Vasek', arial; font-size: 96px; color: #EA5657; margin: 0; line-height: .8em;">{$nameproject}</p>
		</article>
	    <div class="container" style="display: grid; width: 50%; grid-template-columns: 2fr auto; gap: 20px;"> <!-- height: 500px; -->
	        <div class="container" style="display: flex; flex-direction: column; width: 100%; background-color: #fff;"> <!-- Основная информация-->
	            <article> <!-- display: flex; gap: 2%;-->
	                <h1><span style="display: inline-flex; width: 25px;">//</span> Основная информация </h1>
	            </article>
	            <div class="container properties" style="display: flex; flex-direction: column; gap: 10px;"> <!--for="properties" -->
					{query_properties_project}                 
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
                <button class="edit_project" onclick="editProject();">редактировать проект</button>
	        </div>
	        <div class="container" style="grid-column: 1 / span 2; display: flex; flex-direction: column; width: 100%; "> <!-- о себе background-color: orange;-->
	            <article style="display: flex; gap: 2%;">
	                  <h1><span style="display: inline-flex; width: 25px;">//</span> О проекте </h1>
	            </article>
	            <div class="container" style="display: flex; flex-direction: column; gap:  10px; align-items: flex-start;">
					{query_intelligence for="about"}
	            </div>
			</div>
	        <div class="container" style="grid-column: 1 / span 2; display: flex; flex-direction: column; width: 100%;"> <!-- Проекты  background-color: gray; -->
	            <article style="display: flex; gap: 2%; align-items: center; justify-content: space-between;">
	                  <h1><span style="display: inline-flex; width: 25px;">//</span> Авторы </h1>
                      <div>
                        <button class="add-author" onclick="">удалить автора</button>
                        <button class="del-author" onclick="">добавить автора</button>
                      <div>
	            </article>
	            <div class="container" style="display: flex; flex-direction: column; gap:  10px; align-items: flex-start;"> <!-- select="*" from="info_user" orderby="id" limit="3" offset="0"-->
					{query_authors}
	            </div>
			</div>
            <div class="container" style="grid-column: 1 / span 2; display: flex; flex-direction: column; width: 100%;"> <!-- Проекты  background-color: gray; -->
	            <article style="display: flex; gap: 2%; align-items: center; justify-content: space-between;">
	                  <h1><span style="display: inline-flex; width: 25px;">//</span> Скриншоты </h1>
                      <div>
                        <button class="add-author" onclick="">удалить скриншот</button>
                        <button class="del-author" onclick="">добавить скриншот</button>
                      <div>
	            </article>
	            <div class="container" style="display: flex; flex-direction: column; gap:  10px; align-items: flex-start;"> <!-- select="*" from="info_user" orderby="id" limit="3" offset="0"-->
					{query_screenshots}
	            </div>
			</div>
            <div class="container" style="grid-column: 1 / span 2; display: flex; flex-direction: column; width: 100%;"> <!-- Проекты  background-color: gray; -->
	            <article style="display: flex; gap: 2%; align-items: center; justify-content: space-between;">
	                  <h1><span style="display: inline-flex; width: 25px;">//</span> Отзывы </h1>
                      <div>
                        <button class="add-feedback" onclick="">удалить отзыв</button>
                        <button class="del-feedback" onclick="">добавить отзыв</button>
                      <div>
	            </article>
	            <div class="container" style="display: flex; flex-direction: column; gap:  10px; align-items: flex-start;"> <!-- select="*" from="info_user" orderby="id" limit="3" offset="0"-->
					{query_feedback}
	            </div>
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
			{query_interests}
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
</section>-->