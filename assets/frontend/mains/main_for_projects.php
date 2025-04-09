<section id="sctn-1" style="display: grid;"> <!-- style="width: 100%;" -->
    <div class="container-projects" style="width: 75%; justify-self: center; display: grid;"> <!-- width: 65%; /*padding: 7%;*/ padding-bottom: 2%; height: fit-content;/* padding-bottom: 2%; *//* padding-left: 20%; *//* padding-right: 20%; */margin: 0%; -->
        <article style="display: grid; width: 75%; justify-self: center;">
            <h1 class="HelveticaProject" style="justify-self: start;">Представляем вам</h1>
            <p class="VasekProject" style="justify-self: center;">лучшие проекты</p>
            <h1 class="HelveticaProject" style="justify-self: end;">базовой кафедры</h1>
        </article>

        <div class="container" style="margin: 2rem 0 2rem 0;" style="display: flex; flex-direction: row; gap: 30px; margin-top: 2rem; width: 100%;">
            <div style="display: flex; flex-direction: row; width: 70%; height: 2rem;">
                <div class="inputDiv">
                    <!-- onblur="hideInputSugToolTip()" -->
                    <input class="inputSearch" id="inputSearch" oninput="inputSugToolTip('{$ACTION}')">
                    </input>
                    <!-- <div class="inputSug">
                        <ul class="inputSugUi" id="inputSugUi">
                        </ul>
                    </div> -->
                </div>
                <button class="buttonCard">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"></path>
                    </svg>
                </button>
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
                <div class="dropdown">
                    <button class="dropbtn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filter-left" viewBox="0 0 16 16">
                            <path d="M2 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5" />
                        </svg></button>
                    <div class="dropdown-content">
                        <a href="#" onclick="order_sort.call(this, 'new', '{$ACTION}')">Новые</a>
                        <a href="#" onclick="order_sort.call(this, ('old', '{$ACTION}')">Старые</a>
                        <a href="#" onclick="order_sort.call(this, ('rel', '{$ACTION}')">Релевантные</a>
                    </div>
                </div>
            </div>
        </div>

        <hr class="hrProject">
        <div id="projects" class="container container-for-projects">
            {query_projects select="*" from="$tab_projects" orderby="id" limit="$SIZE_PAGE_PROJECTS" offset="0"}
        </div>
        <div class="next-load-projects">
            <button class="loadProjectsBtn" id="load_project_button" type="submit" style="width: auto;height: auto;opacity: 100%; vertical-align: middle; border: none; border-radius: 20px;" onclick="loadProjets('{$ACTION}');">
                <!--<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="none" viewBox="0 0 30 30">
                        <rect width="29" height="29" x=".5" y=".5" stroke="#202020" rx="14.5"/>
                        <path fill="#202020" d="M14 24.896a1 1 0 0 0 2 0h-2Zm1.707-20.499a1 1 0 0 0-1.414 0l-6.364 6.364a1 1 0 0 0 1.414 1.414L15 6.518l5.657 5.657a1 1 0 0 0 1.414-1.414l-6.364-6.364ZM16 24.896V5.104h-2v19.792h2Z"/>
                    </svg>--> <!-- Если элементы закончились -->
                <svg id="load_project_svg" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="none" viewBox="0 0 30 30">
                    <!-- <rect width="29" height="29" x="29.499" y="29.5" stroke="white" rx="14.5" transform="rotate(-180 29.499 29.5)" /> -->
                    <path fill="white" d="M15.999 5.104a1 1 0 1 0-2 0h2Zm-1.707 20.498a1 1 0 0 0 1.414 0l6.364-6.363a1 1 0 0 0-1.414-1.415l-5.657 5.657-5.657-5.657a1 1 0 1 0-1.414 1.415l6.364 6.363Zm-.293-20.498v19.791h2V5.104h-2Z" />
                </svg> <!-- Если элементы ещё имеются -->
            </button>
            <p id="load_project_p" style="display: none; font-family: 'Helvetica'; font-size: 16px; font-weight: lighter;">Кажется вы всё посмотрели</p>
        </div>


    </div>
    <!--<div style=" height: auto; display: flex; align-items: center; justify-content: end; flex-direction: row; width: 100%; height: 10%; background-color: #EA5657;">
		<p>Посмотрите все наши проекты</p> 
		<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
			<path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"></path>
		</svg>
	</div>-->
</section>