<section class="section_1" style="width: 100%; display: flex; flex-direction: column; gap: 100px;">
	<div style="display: flex; flex-direction: column; width: 100%; align-items: center; "> <!-- padding-top: 10%; -->
		<!--<article style="display: flex;  width: fit-content; justify-content: center; space-between; gap: 5%; align-items: center;"></article>--> <!-- head1="Создайте" -->
		
	    <div class="container" style="display: grid; width: 50%; grid-template-columns: 2fr auto; margin-bottom: 2vh;"> <!-- gap: 20px; height: 500px; -->
	        <div class="container" style="margin-top: 5vh; display: flex; flex-direction: column; width: 100%; background-color: #fff;"> <!-- Основная информация-->
				<!--query_article head1="" head2="Вакансия" head3="в команду" class="article"-->
				<article>
					<p class="VasekMain" style="justify-self: start;"> Вакансия </p>
					<h1 class="HelveticaMain" style="justify-self: center;"> в команду </h1>
					{if isset($access)|default}
						{query_editor_button action="$ACTION" style="justify-self: end;"}
                		<!-- <button id="editPage" style="justify-self: end;" onclick="editPage.call(this, true, '{$ACTION}');">редактировать</button>-->
					{/if}
				</article>

				<article> <!-- display: flex; gap: 2%;-->
					
	                <h1><span style="display: inline-flex; width: 25px;">//</span> Проект </h1>
	            </article>
	            <div class="container properties" style="display: flex;flex-direction: column;width: 100%;align-items: center;"> <!--gap: 30px; margin-top: 2rem; for="properties" justify-content: flex-start; height: 20vh;-->
					<a href="{$PAGE_PROJECT}" style="width: fit-content;"> <!-- page="$PAGE_PROJECT"-->
						{query_properties_project for="name"}
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
					{query_properties_vacancy for="speciality"}
	            </div>
			</div>
	        <div class="container" style="grid-column: 1 / span 2; display: flex; flex-direction: column; width: 100%; "> <!-- о себе background-color: orange;-->
	            <article style="display: flex; gap: 2%;">
	                  <h1><span style="display: inline-flex; width: 25px;">//</span> Описание </h1>
	            </article>
	            <div class="container" style="display: flex; flex-direction: column; gap:  10px; align-items: flex-start;">
					{query_properties_vacancy for="about"}
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
				 {if $access|default}
				 <div class="input_content container" style="display: none; flex-direction: column; gap:  10px; align-items: center;"> <!-- select="*" from="info_user" orderby="id" limit="3" offset="0"-->
						<!--query_authors-->
						<!--<div class="container" style="width: 100%;">-->
						<textarea id="tag"> </textarea>
						<button class="addTag" onkeyup="myFunction()" onclick="addTag();">Добавить</button>
					</div>
				 {/if}
				<div id="result" class="container"> <!-- justify-self: bottom; -->
					<!--<label></label>-->
					{if $vacancy_id|default}
						{query_properties_vacancy for="tags" del="false"}
					{/if}
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
				 {if $access|default}
					<div class="input_content container" style="display: none; flex-direction: column; gap:  10px; align-items: center;"> <!-- select="*" from="info_user" orderby="id" limit="3" offset="0"-->
						<!--query_authors-->
						<!--<div class="container" style="width: 100%;">-->
						<textarea id="duty"> </textarea>
						<button class="addDuty" onclick="addDuty();">Добавить</button>
					</div>
				 {/if}
				<div id="result" class="container resultTag"> <!-- justify-self: bottom; -->
					<!--<label></label>-->
					{if $vacancy_id|default}
						{query_properties_vacancy for="duties"}
					{/if}
				</div>
			</div>
		</div>
	</div>
</section>