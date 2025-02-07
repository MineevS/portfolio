<section id="sctn-1">
	<div class="corners">
		<p class="corner" id="crnr-1">∟</p>
		<p class="corner" id="crnr-2">∟</p>
		<p class="corner" id="crnr-3">∟</p>
		<p class="corner" id="crnr-4">∟</p>
	</div>
	<p class="background">БК 536</p>
	<h2 class="logotype">ПОРТФОЛИО</h2>
	<div id="info-1">
		<p>Здесь представлены лучшие проекты наших талантливых студентов</p>
		<p>↓</p>
	</div>
</section>
<section id="sctn-2" data-aos="fade-up">
	<div class="container-projects">
		{query_article head1="Представляем вам" head2="лучшие проекты" head3="базовой кафедры № 536"}
		<div class="pallet-projects">
			{query_projects select="*" from="$tab_projects" orderby="id" limit="$SIZE_PAGE_PROJECTS" offset="0"}
		</div>
	</div>
	<div class="footer-section">
		<p class="ref">Посмотрите все наши проекты</p>
		<svg class="bi bi-arrow-right" style="color: #F6F6F6; margin: 0 1rem 0 1rem;" onclick="window.location.href='{$PROJECTS}'" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"  viewBox="0 0 16 16" >
			<path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"></path>
		</svg>
	</div>
</section>
<section id="sctn-3" data-aos="fade-up">
	{query_article head1="А это основные" svg="1" head3="исследований и разработки" class="HelveticaMainWhite" style="width: 85%; padding: 3%;"}
	<div class="interestDiv">
		{query_interests}
	</div>
</section>
<section id="sctn-4" data-aos="fade-up">
	<div style="width: 100%;height: fit-content;/* justify-content: flex-end; */display: flex;flex-direction: column;align-items: center;"> 
		{query_article head1="Наши звёзды с" svg="2" head3="сияют ярче, чем в Голливуде" class="HelveticaMain"}
		<div class="container stars" >
			<svg onclick="prevStar.call(this.nextSibling.nextSibling);" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="%23fff" style="flex-basis: 10%; box-shadow: 20px 0px 10px 0px #ffffff; z-index: 1;">
				<path d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
			</svg>
			<div class="carousel" style="width: 100%; ">
				<div class="carousel-inner"> 
					{query_stars select="*" from="$tag_awesome" orderby="id"}
				</div>
			</div> 
			<svg onclick="nextStar.call(this.previousSibling.previousSibling);" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="%23fff" style="flex-basis: 10%; box-shadow: -20px 0px 8px 0px #ffffff; z-index: 1;">
				<path d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
			</svg>
		</div>
		{query_article head1="Лучший" head2="дизайнер" head3="месяца" id="article-item" class="VasekMain2" class2="HelveticaMain2" style="width: 25%;"}
	</div>
</section>
<section id="sctn-5" data-aos="fade-up">
	<div class="headVacancy2">
		<div class="container headVacancy">
			{query_article head1="Наши открытые" head2="вакансии в команды" head3="лучших разработчиков" class="HelveticaMain" style="width: 50%;"}
		</div>
		<div class="container vacancies-container" style="display: grid;">
			{query_vacancies style="grid" select="*" from="$tab_vacancies" orderby="id" limit="$limit_vacancies" offset="0"}
		</div>
	</div>
	<div style="background: #202020; width: 100%;">
		<div class="footerSection">
			<p class="VasekMainWhiteP">Больше вакансий тут</p>
			<svg onclick="window.location.href='{$VACANCIES}'" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-arrow-right" style="color: #F6F6F6; margin: 0 1rem 0 1rem;" viewBox="0 0 16 16">
				<path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"></path>
			</svg>
		</div>
	</div>
</section>
