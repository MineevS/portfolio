<section class="section_1">
	<div class="section_1">
		{query_header_page}
	    <div class=" propertiesProfile" >
	        <div class="base_info">
	            <article>
	                <h1><span>//</span> Основная информация</h1>
	            </article>
	            <div class="properties">
					{query_properties_profile for="base_properties"}              
	            </div>
	        </div>
	        <div class="contacts"> 
	            <article>
	                  <h1><span>//</span>Контакты </h1>
	            </article>
	            <div id="contacts" class=" remove dragAndDrop">
					{query_properties_profile  	for="contacts"}
					{query_properties_add 		for="contacts"}
	            </div>
				<div id="urls" class="icons remove dragAndDrop">
					<span class="icon">
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
					<div class="addUrls display" style="display: none;">
						<button class="addImage display" onclick="addContactsIcon.call(this.parentNode.parentNode)" style="display: none;">
							<svg class="add" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="none" viewBox="0 0 34 33">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M1.444 17h31.111M17 1v31.111"/>
							</svg>
						</button>
						<svg id="url" class="add remove" xmlns="http://www.w3.org/2000/svg" width="34" height="33" fill="none" viewBox="0 0 100 100">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m25.582 43.93 5.542 33.334a8.334 8.334 0 0 0 8.334 6.958H60.79a8.334 8.334 0 0 0 8.333-6.958l5.542-33.334a8.334 8.334 0 0 0-8.334-9.708h-32.54a8.333 8.333 0 0 0-8.208 9.708Z"/>
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M39.999 38.389V27.555a10.042 10.042 0 0 1 10-10 10.042 10.042 0 0 1 10 10V38.39m-4.125 14.957-11.75 11.75m11.75 0-11.75-11.75"/>
						</svg>
					</div>
				</div>
	        </div>
	        <div class="con1 " > 
	            <article>
	                  <h1><span>//</span> О себе </h1>
	            </article>
	            <div class="about ">
					{query_properties_profile  for="about"} 
	            </div>
			</div>
			<div class="con2 ">
	            <article>
	                  <h1><span>//</span> Навыки </h1>
	            </article>
	            <div id="skills" class="contentProperty  skills">
					{query_properties_profile  for="skills"}
	            </div>
				<div class="inp1 display">
					{query_input for="add"}
				</div>
			</div>
			<div class="con1 "> 
	            <article>
	                  <h1><span>//</span> Цели </h1>
	            </article>
	            <div class="con4 ">
					{query_properties_profile  for="goals"}
	            </div>
				<div class="display">
					{query_input for="add" type="textarea"}
				</div>
			</div>
			<div class="con1 "> 
	            <article>
	                  <h1><span>//</span> Материалы </h1>
	            </article>
	            <div class="mats " >
					{query_properties_profile  for="materials"}
	            </div>
			</div>
	        <div class="con1 ">
	            <article class="projects">
	                  <h1><span>//</span> Проекты </h1>
					  <button class="create_project" onclick="">создать проект</button>
	            </article>
	            <div class="projects ">
					{query_projects for="profile" select="*" from="$tab_projects" orderby="id" limit="3" offset="0" where="author" author="$id_author"}
					{query_properties_add 		for="projects"}
	            </div>
			</div>
		</div>
	</div>
</section>