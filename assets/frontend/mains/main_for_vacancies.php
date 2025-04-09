<section class="section_1" style="width: 100%;">
    <div class="container-vacancies"> <!-- margin-top: 5%; height: fit-content; padding-bottom: 2%; padding-left: 25%; padding-right: 25%; -->
        <article style="display: grid; width: 75%; align-self: flex-start;">
            <h1 class="HelveticaProject" style="justify-self: start;">Наши открытые</h1>
            <p class="VasekProject" style="justify-self: center;">вакансии в команды</p>
            <h1 class="HelveticaProject" style="justify-self: end;">лучших разработчиков</h1>
        </article>
        <div class="container" style="display: flex; flex-direction: row; gap: 30px; margin-top: 2rem; margin-left: 10%; margin-bottom: 2rem; width: 100%;">
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
        <!-- <div class="container search" style="">
            <div class="container-search"> -->
        <!--<span class="search">
                    <input class="search" type="search" placeholder="Поиск" />
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="none" viewBox="0 0 15 15">
                        <path stroke="#858585" stroke-linecap="round" d="M10.698 10.59 14 14m-1.91-7.274c0 3.163-2.483 5.727-5.545 5.727C3.482 12.453 1 9.889 1 6.726 1 3.564 3.482 1 6.545 1c3.062 0 5.544 2.564 5.544 5.726Z"/>
                    </svg>
                </span>-->
        <!-- {query_input for="search"}
                <div style="position: relative;">
                    <button class="tags round">
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="11" fill="none" viewBox="0 0 15 11">
                            <path stroke="#858585" stroke-linecap="round" stroke-linejoin="round" d="M1 10h6M1 5.5h9M1 1h13" />
                        </svg>
                    </button>
                    <button class="filter round" onclick="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="17" height="17" fill="none" viewBox="0 0 17 17">
                            <path stroke="#858585" stroke-linecap="round" stroke-linejoin="round" d="M2.722 2h11.556c.399 0 .722.328.722.734v1.163a.74.74 0 0 1-.211.519l-4.633 4.706a.74.74 0 0 0-.212.518v4.626a.725.725 0 0 1-.897.712l-1.444-.367a.732.732 0 0 1-.548-.712V9.64a.74.74 0 0 0-.211-.518L2.212 4.416A.74.74 0 0 1 2 3.897V2.734C2 2.328 2.323 2 2.722 2Z" />
                        </svg>
                    </button> -->
        <!--<iframe id="filter" class="frame-filter" style="position: fixed; top: 25%; left: 25%; width: 50%; background: #fff; border: 1px solid #d9d9d9;">
                    </iframe>-->
        <!-- <div id="filter" class="filter" style="">
                        <input type="checkbox" value="SQL" /> <label for="scales">SQL</label>
                        <input type="checkbox" value="C++" /> <label for="scales">C++</label>
                        <input type="checkbox" value="Python" /> <label for="scales">Python</label>
                    </div>
                </div>
            </div>
            <div style="display: flex; flex-direction: column; align-items: center;">
                <div id="tags" class="container"> -->
        <!--<label class="labelTag" style="">SQL--> <!-- padding-right: 5px; -->
        <!--<<button onclick="this.parentNode.remove();" class="buttonTag" style="display: auto;">--> <!-- hidden visibility: hidden; stroke="#F6F6F6" -->
        <!-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="7 10 20 20">
                                <path stroke="#777" stroke-linecap="round" d="M10.903 14.904 15.5 19.5m0 0 4.597 4.596M15.499 19.5l4.597-4.596M15.499 19.5l-4.596 4.596"></path>
                            </svg>
                        </button>
                    </label>
                </div>
            </div>
        </div> -->
        <!--<hr class="hrProject">-->
        <div class="container vacancies-container" style="display: flex;"> <!-- repid in main_for_index-->
            {query_vacancies select="*" from="$tab_vacancies" orderby="id" limit="$limit_vacancies" offset="0"}
        </div>
    </div>
    <!--<div style=" height: auto; display: flex; align-items: center; justify-content: end; flex-direction: row; width: 100%; height: 10%; background-color: #EA5657;">
		<p>Посмотрите все наши проекты</p> 
		<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
			<path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"></path>
		</svg>
	</div>-->
</section>