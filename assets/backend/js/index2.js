const name_id_iframe = "iframe-auth-reg";
window.delete = false;
window.delete_avatar_project = true;

window.page_load_projects = 0;
window.page_load_vacancies = 0;
window.page_load_teams = 0;

function create_iframe_authorization_registration() {
    var layout = document.getElementsByClassName('layout')[0];

    var pre_iframe = document.getElementById(name_id_iframe);
    if (!pre_iframe) {
        var iframe_auth = document.createElement("iframe");

        iframe_auth.id = name_id_iframe;
        iframe_auth.name = iframe_auth.id;

        layout.prepend(iframe_auth);
    }
}

function close_iframe() {
    window.parent.change_size_iframe(window.name, 0, 50);
    var iframe = document.getElementById(name_id_iframe);
    iframe.remove();
}

function change_size_iframe(name_iframe, width, height) {
    // Получение корневого элемента
    const root = document.querySelector(":root");

    // Изменение значения стиля для корневого элемента
    root.style.setProperty("--iframeHeight", `${height}vh`);
}

function logout(path) {
    $.ajax({
        type: "POST",
        url: path,
        data: {
            action: "logout"
        },
        success: function (result) {
            let json_data = JSON.parse(result);

            if (json_data.hasOwnProperty('url')) { // && json_data.hasOwnProperty('error_code')
                window.top.location.href = json_data['url'];
            }
        }
    });
}

function editProfile(code_peration, path) {
    var parent = document.getElementsByClassName('properties')[0];
    var inpts = document.getElementsByTagName('input');
    for (const inpt of inpts) inpt.readOnly = !code_peration;

    var edit_profile = document.getElementsByClassName('editProfileButton')[0];

    edit_profile.innerHTML = code_peration ? "Сохранить изменения" : "Редактировать профиль";
    edit_profile.setAttribute('onclick', code_peration ? "editProfile(false, '" + path + "');" : "editProfile(true, '" + path + "');");

    var group = document.getElementById('group').value;
    var course = document.getElementById('course').value;
    var cipher = document.getElementById('cipher').value;
    var skills = document.getElementById('skills').value;

    var institute = document.getElementById('institute').value;
    var year_start = document.getElementById('year_start').value;
    var specialization = document.getElementById('specialization').value;
    var educational_program = document.getElementById('educational_program').value;
    var about = document.getElementById('about').value;

    var data = {
        group: group,
        course: course,
        cipher: cipher,
        skills: skills,
        institute: institute,
        year_start: year_start,
        specialization: specialization,
        educational_program: educational_program,
        about: about,
        action: "save_data_profile"
    };

    //
    var change_avater = document.getElementById('change-avater').files;

    var formData = new FormData();
    formData.append('avatar', change_avater[0]);
    formData.append('action', "load_avatar");

    // (change_avater.lengeth() == 0 ? : ); 

    // сохранение данных в БД:

    if (!code_peration) {
        /*$.ajax({
            type: "POST",
            url: path,
            cache: false,
            data: formData,
            dataType: 'json',
            // отключаем обработку передаваемых данных, пусть передаются как есть
            processData : false,
            // отключаем установку заголовка типа запроса. Так jQuery скажет серверу что это строковой запрос
            contentType : false,
            success: function(result) {
                let json_data = result;

                if(json_data.hasOwnProperty('icon')){
                    var elements = document.getElementsByClassName('avatar-img');
                    
                    [...elements].forEach((element) => {
                        element.src = json_data['icon'];
                    });
                }
            }
        });*/

        ajax_img(formData, path, 'avatar-profile');

        var elems = document.getElementsByClassName('avatar-profile');
        var elem = elems[0];

        // data.append('avatar', elem.src); //  if(change_avater.length === 0)

        if (change_avater.length === 0 && window.delete) { data['avatar'] = elem.src.split('/').pop(); window.delete = false; }

        //ajax_data(data, path);

        ajax_data(data, function () {
            let json_data = JSON.parse(result);
        }, path);

        /*$.ajax({
            type: "POST",
            url: path,
            data: data,
            success: function(result) {
                let json_data = JSON.parse(result);
            }
        });*/
    }
}

function changeAvatar($code_operation, template_name_default_img) { // this - текушая кнопка с id='avatar';
    var currentPage = window.location.href.split('/').pop().split('.')[0];
    //var template_name_default_img = '';
    switch ($code_operation) {
        case 'change':
            console.log("loadAvatar( 1 1 1)");
            console.log(this.value);
            break;
        case 'delete':
            console.log("loadAvatar( 1 2 1)");
            var elements = document.getElementsByClassName('avatar');
            var icon_url = (elements.profile.src.split('/').pop() !== template_name_default_img.split('/').pop()
                ? "/assets/frontend/icons/avatars_profiles/" + template_name_default_img.split('/').pop()
                : template_name_default_img);
            if (icon_url !== "") {
                //this.value = {icon_url};
                this.src = icon_url;
                this.textContent = icon_url;

                [...elements].forEach((element) => {
                    element.src = icon_url;
                });
            }
            break;
    }
}


function createElementFromHTML(htmlString) {
    var div = document.createElement('div');
    div.innerHTML = htmlString.trim();
    // Change this to div.childNodes to support multiple top-level nodes.
    return div.children; //childNodes
}

function loadProjets(path) {
    // можно зphp определить кол.во макс страниц и заблокировать запрос при достижении последней страницы.

    window.page_load_projects++; // Инкремент на следующую страницу; // Размер (объём) одной страницы определен в ...

    query_projects(path);
}

function query_projects(path){
    $.ajax({
        type: "POST",
        url: path,
        data: {
            page_load_projects: window.page_load_projects,
            action: "load_projects"
        },
        success: function (result) {
            print_projects(result);
        }
    });
}

function removeAllChildren(parent) {
    while (parent.firstChild) {
      parent.removeChild(parent.firstChild);
    }
  }
  

function print_projects(result) {
    console.log(result);
    console.log(result['data']);
    let json_data = JSON.parse(result);

    if (json_data.hasOwnProperty('data')) {
        var container_projects = document.getElementById('projects');
        /*removeAllChildren(container_projects);*/
        var divs = createElementFromHTML(json_data['data']);
        if (divs.length > 0)
            [...divs].forEach((div_elem) => {

                console.log(div_elem.getElementsByClassName('projectTitle')[0].textContent);
                container_projects.insertBefore(div_elem, container_projects.childNodes[container_projects.childNodes.length - 2]);
            });
        else {                     // Закончились элементы;
            // load_project_button; // Можно сделать не onckick;
            var svg = document.getElementById('load_project_svg');
            svg.style.transform = "rotate(180deg)";
            var p = document.getElementById('load_project_p');
            p.style.display = "block";
        }
    }
}

function editPage(code_peration, path) {
    // this.innerHTML =  (code_peration ? "сохранить" : "редактировать");          // this -> "Это кнопка вызвавшая данное событие";
    this.onclick = function () { editPage.call(this, !code_peration, path); };  // "editPage.call(this, " + !code_peration + ", \"" + path + "\");"

    var contentProperties = document.getElementsByClassName('contentProperty');

    var formData = new FormData();
    var func_page = function (result) { };

    var currentPage = window.location.href.split('/').pop().split('.')[0];
    [...contentProperties].forEach((property) => {
        switch (property.id) {
            case 'tags': // ???
                if (currentPage === 'project')
                    property.readOnly = !code_peration;
                else {
                    property.style.justifyItems = (property.childNodes.length < 5 ? 'center' : 'end');// ?
                    property.childNodes.forEach((tag) => {
                        tag.style.paddingRight = (code_peration ? '0' : '5px');
                        tag.childNodes[1].style.display = (code_peration ? 'block' : 'none');
                    });
                }
                break;
            case 'duties':
                [...property.getElementsByClassName('cardDuty')].forEach((cardDuty) => {
                    cardDuty.parentNode.style.listStyleType = (code_peration ? 'none' : 'disc');
                    cardDuty.style.columnGap = (code_peration ? '10px' : '0');
                    [...cardDuty.getElementsByClassName('buttonDuty')][0].style.display = (code_peration ? 'block' : 'none');// ???
                });
                break;
            default:
                property.readOnly = !code_peration;
                break;
        }
    });
    var displays = document.getElementsByClassName('display');
    [...displays].forEach((elem) => {
        elem.style.display = (code_peration ? 'flex' : 'none');
        if(elem.classList.contains('buttonTag')) 
            elem.setAttribute('onclick', (code_peration ? 'this.parentNode.remove();' : '')) // onclick=""
    });
    var visibls = document.getElementsByClassName('visibility'); // edit
    [...visibls].forEach((vis) => {
        vis.style.visibility = (code_peration ? 'visible' : 'hidden');
        /*if(code_peration) { // visibility: visible;
            elem.removeAttribute('hidden');
        } else {
            elem.setAttribute('hidden', true);
        }*/
    });
    /*var showsHides = document.getElementsByClassName('showHide');
    [...showsHides].forEach((sh) => {
        if(code_peration) sh.removeAttribute('hidden');
        else sh.setAttribute('hidden', true);
    });*/
    var selects = document.getElementsByClassName('selProperty');
    [...selects].forEach((sl) => {
        var elem = sl.previousElementSibling;

        if(code_peration) sl.removeAttribute('hidden');
        else sl.setAttribute('hidden', true);

        elem.setAttribute('type', (!code_peration ? 'text' : 'hidden'));
        if (!code_peration) elem.value = sl.value;
    });

    var showers_hiders = document.getElementsByClassName('shower_hider');
    [...showers_hiders].forEach((input) => {
        var select = input.nextElementSibling;
        var svg = input.nextElementSibling.nextElementSibling.nextElementSibling;
        if (code_peration) { // Если редактировать
            svg.removeAttribute('hidden');
            select.removeAttribute('hidden');
            input.setAttribute('hidden', true);
        } else {
            svg.setAttribute('hidden', true);
            select.setAttribute('hidden', true);
            input.removeAttribute('hidden');
            input.setAttribute('value', select.value);
        }
    });
    switch (currentPage) {
        case 'profile':
            //this.innerHTML += " профиль";
            if (!code_peration) { // Сохранить
                /*var selects = document.getElementsByTagName('select');
                [...selects].forEach((select) => {
                    console.log(select.value);
                    select.previousElementSibling;
                });*/
                
                func_page = function (json_data) {
                    if (json_data.hasOwnProperty('error_code') && !json_data['error_code']) { // Очистка после успешной загрузки;
                        var avatar = document.getElementById('avatar');
                        avatar.value = null;
                        avatar.textContent = null;
                    }
                    if (json_data.hasOwnProperty('icon')) {
                        var elements = document.getElementsByClassName('avatar');
                        [...elements].forEach((element) => {
                            element.src = json_data['icon'];
                        });
                    }
                };
            }
            break;
        case 'project':
            //this.innerHTML += " проект";
            if (!code_peration) { // Сохранить
                func_page = function (json_data) {
                    console.log(json_data);
                    // TODO
                };
            }
            break;
        case 'vacancy':
            //this.innerHTML += " вакансию";
            if (!code_peration) { // Сохранить
                func_page = function (json_data) {
                    console.log(json_data);
                    // TODO
                };
            }
            break;
    }
    if (!code_peration) {
        formData.append('action', "save_data_" + currentPage);
        var emails = [];
        var phones = [];
        var sites = [];
        var contacts = {};

        var refs = new Map();
        [...contentProperties].forEach((property) => {
            switch (property.id) {
                case 'avatar':
                    if (property.value.trim() !== "") formData.append(property.id, property.files[0]); // property.value.trim() // Загрузка новой аватарки, отличной от аватарки по умолчанию;
                    if (property.textContent.trim() !== "") { formData.append(property.id, property.textContent.split('/').pop().trim()); property.textContent = null; }; // отправляем url на аватарку по умолчанию;
                    break;
                case 'references':
                    //var refs = accum.call(property.children);
                    [...property.getElementsByTagName('span')].forEach((span) => {
                        console.log(span); // span.children.getElementById('url').value, span.children.getElementById('name').value
                        var  nameref = span.firstElementChild; //getElementById('urlref')
                        var  urlref = span.firstElementChild.nextElementSibling.nextElementSibling;
                        
                        refs.set(nameref.value, urlref.value);
                    });
                    
                    if(refs.size > 0) formData.append(property.id, JSON.stringify(Object.fromEntries(refs)));
                    break;
                case 'tags': // ???
                case 'skills':
                case 'stack':
                    /*if (currentPage === 'project')
                        formData.append(property.id, property.value.trim());
                    else {
                        var tags = accum.call(property.children);
                        formData.append(property.id, JSON.stringify(tags));
                    }*/
                    var tags = accum.call(property.children);
                    if(tags.length > 0 ) formData.append(property.id, JSON.stringify(tags));
                    break;
                /*case 'skills':
                    var skills = accum.call(property.children); // childNodes // children;
                    formData.append('skills', JSON.stringify(skills));
                    break;*/
                case 'duties':
                case 'goals':
                    var duties = accum.call([...property.getElementsByClassName('cardDuty')]);
                    formData.append(property.id, JSON.stringify(duties));
                    break;
                case 'email':
                    if(!emails.includes(property.value.trim())){
                        emails.push(property.value.trim());
                    } else {
                        // TODO;
                    }
                    break;
                case 'phone':
                    if(!phones.includes(property.value.trim())){
                        phones.push(property.value.trim());
                    } else {
                        // TODO;
                    }
                    break;
                case 'site':
                    if(!sites.includes(property.value.trim())){
                        sites.push(property.value.trim());
                    } else {
                        // TODO;
                    }
                    break;
                    break;
                default:
                    try {
                        if(property.value) formData.append(property.id, property.value.trim());
                        else formData.append(property.id, property.textContent.trim());
                    } catch(error){
                        console.log(error);
                    }
                    break;
            }
        });

        if(emails.length > 0) contacts['emails'] = emails;
        if(phones.length > 0) contacts['phones'] = phones;
        if(sites.length  > 0) contacts['sites']  = sites;

        if (Object.keys(contacts).length > 0) formData.append('contacts', JSON.stringify(contacts));


        // contacts[property.value.trim()] = property.id; // Ключом является значение, а значением id.
        
        formData.entries().forEach((entry) => { // For Debug;
            console.log(entry);
        });

        // ajax_formData(formData, func_page, path);
    }
}


function selectTypeContact() {
    var value = '';
    var type = '';
    var name = '';
    var maxlength = '';
    var placeholder = '';
    var mask = function (params) {};
    switch (this.value) {
        case 'Телефон':
            value = "+7(___)___-__-__";
            placeholder = value;

            type = 'tel';
            name = 'phone';

            maxlength = '17';

            mask = mask_phone;
            break;
        case 'Почта':
            value = "___@___.__";
            placeholder = value;

            type = 'email';
            name = 'email';

            mask = mask_email;
            break;
        case 'Сайт':
            value = "http://...";
            placeholder = value;

            type = 'url';
            name = 'site';

            mask = mask_site;
            break;
    }

    //input.removeEventListener('input');

    //input.addEventListener("input", mask_phone, false);
    var input = this.nextElementSibling;
    input.name = name;
    input.id = name; // временно;
    input.type = type;
    input.value = value;
    input.maxlength = maxlength;
    input.placeholder = placeholder;

    input.setAttribute('oninput', mask_phone);
    
    input.setAttribute('value', value);
    input.setAttribute('maxlength', maxlength);
    input.setAttribute('placeholder', placeholder);
}

/*var formData = new FormData();
formData.append('avatar', change_avater[0]);
formData.append('action', "load_avatar");*/

// editPage('vacancy', true, '{$ACTION}')

function accum(array) { // contentProperties.tags.childNodes
    /*var elems = '[';
    for (var i = 0; i < this.length - 1; i++) elems += '"' + this[i].textContent.trim() + '", ';
    elems += '"' + this[this.length - 1].textContent.trim() + '"]';*/

    var elems = [];
    for (var i = 0; i < this.length; i++)
        elems.push(this[i].textContent.trim());

    /*elems += '"' + this[i].textContent.trim() + '", ';
elems += '"' + this[this.length - 1].textContent.trim() + '"]';*/

    return elems;
}

/*} else { // Сохранить

    data = {
        
        
    }

    
    
}*/

function addGoalDuty(container, log){
    //console.log(this.value, container);
    var li = document.createElement('li');
    var div = ' \
        <li> \
            <div class="cardDuty" style=""> \
                <button onclick="this.parentNode.remove();" class="buttonDuty display" style="display: flex;"> \
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="5.5 9 20 20"> \
                        <path stroke="#F6F6F6" stroke-linecap="round" d="M10.903 14.904 15.5 19.5m0 0 4.597 4.596M15.499 19.5l4.597-4.596M15.499 19.5l-4.596 4.596"></path> \
                    </svg> \
                </button> \
                <span style="margin: 0; padding-right: 3vw;" onclick="loadDuty.call(this);"> \
                    '+ this.value +' \
                </span> \
            </div> \
        </li>'; // wrapperHtmlLi()

    li.innerHTML = div;

    // console.log(li.textContent);

    duplicateСontrol.call(li, container,  log);
}


function addDuty() {
    var duty = document.getElementById('duty');
    var duties = document.getElementById('duties');

    var mode = document.getElementById('editPage').textContent;

    var cardDuty = duties.getElementsByClassName('cardDuty')[0];

    var display = 'none';
    switch (mode) {
        case 'сохранить':
            display = 'block';
            break;
        default:
            break;
    }

    console.log(display);

    var div = '<div class="cardDuty" style="display: grid; grid-template-columns: auto 1fr; column-gap: 10px; align-items: center;"> \
            <button onclick="this.parentNode.remove();" class="buttonDuty" style="display: '+ display + ';"> <!-- hidden visibility: hidden; none --> \
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="6 8 20 20"> \
                    <path stroke="#F6F6F6" stroke-linecap="round" d="M10.903 14.904 15.5 19.5m0 0 4.597 4.596M15.499 19.5l4.597-4.596M15.499 19.5l-4.596 4.596"></path> \
                </svg> \
            </button> \
            <span style="margin: 0; padding-right: 3vw;" onclick="loadDuty.call(this);"> \
                '+ duty.value + ' \
            </span> \
        </div>';
    elem = document.createElement('li');
    elem.innerHTML = div;
    elem.style.listStyleType = 'none'; //(code_peration ? 'none': 'disc')

    duties.appendChild(elem);
}

function loadDuty() {
    var duty = document.getElementById('duty');
    duty.value = this.textContent.trim();
}

function editProject(code_peration, path) {
    var parent = document.getElementsByClassName('properties')[0];
    var inpts = document.getElementsByTagName('input');
    for (const inpt of inpts) inpt.readOnly = !code_peration;
    var about_textarea = document.getElementById('about');
    about_textarea.readOnly = !code_peration;
    var name_input = document.getElementById('name');
    name_input.contentEditable = code_peration;

    var divs_article = document.getElementsByClassName('div-article');
    for (const div_article of divs_article) div_article.style.visibility = (!code_peration ? 'hidden' : 'visible');

    var menu_icon = document.getElementById('menu-icon');

    menu_icon.style.visibility = (!code_peration ? 'hidden' : 'visible');

    var edit_project = document.getElementsByClassName('editProjectButton')[0];

    edit_project.innerHTML = (code_peration ? "сохранить" : "редактировать") + " проект";
    edit_project.setAttribute('onclick', code_peration ? "editProject(false, '" + path + "');" : "editProject(true, '" + path + "');");

    var date_preview = document.getElementById('date-preview').value;

    var stack = document.getElementById('stack').value;
    var scores_communities = document.getElementById('scores_communities').value;
    var scores_experts = document.getElementById('scores_experts').value;
    var populars_tags = document.getElementById('populars_tags').value;

    var input_status = document.getElementById('input_status');
    var select_status = document.getElementById('select_status');

    input_status.setAttribute('hidden', true);

    if (code_peration) {
        input_status.setAttribute('hidden', true);
        select_status.removeAttribute('hidden');
    } else {
        input_status.removeAttribute('hidden');
        select_status.setAttribute('hidden', true);

        input_status.setAttribute('value', select_status.value); // Установка выбранного значения
    }

    var about = about_textarea.value;
    var status = input_status.value; // *
    var name = name_input.value;

    var data = {
        name: name,
        premier: date_preview,
        status: status,
        stack: stack,
        communities: scores_communities,
        experts: scores_experts,
        tags: populars_tags, // populars_
        about: about,
        action: "save_data_project"
    };

    //
    var change_avater = document.getElementById('change-avater').files;

    var formData = new FormData();
    formData.append('avatar', change_avater[0]);
    formData.append('action', "load_avatar_project");

    if (!code_peration) {
        var elems = document.getElementsByClassName('avatar-project');
        var elem = elems[0];

        if (change_avater.length === 0 && window.delete_avatar_project) { data['avatar'] = elem.src.split('/').pop(); window.delete_avatar_project = false; }         // (change_avater.lengeth() == 0 ? : );   // data.append('avatar', elem.src); //  if(change_avater.length === 0)

        if (window.hasOwnProperty('project_id')) data['project_id'] = window.project_id;

        ajax_data(data, function (result) {
            let json_data = JSON.parse(result);

            if (json_data.hasOwnProperty('save_data_project')) {
                //
            }

            if (json_data.hasOwnProperty('error_code')) {
                //
            }

            if (json_data.hasOwnProperty('project_id')) {
                window.project_id = json_data['project_id']; // Только после того, как проект будет сохранен в БД, ему присвоится идентификатор
            }

            //
        }, path);

        if (change_avater.length != 0)
            ajax_img(formData, path, 'avatar-project');
    }
}

function ajax_formData(data, func, path) {
    $.ajax({
        type: "POST",
        url: path,
        cache: false,
        data: data,
        dataType: 'json',
        // отключаем обработку передаваемых данных, пусть передаются как есть
        processData: false,
        // отключаем установку заголовка типа запроса. Так jQuery скажет серверу что это строковой запрос
        contentType: false,
        success: func
    });

    /*
    function(json_data) {                                  // let json_data = result;
            if(json_data.hasOwnProperty('icon'))                        // var elements = document.getElementsByClassName('avatar-img'); 
                [...document.getElementsByClassName(class_name)]
                    .forEach((element) => { element.src = json_data['icon']; });
        }
    */
}

function ajax_img(data, path, class_name) {
    $.ajax({
        type: "POST",
        url: path,
        cache: false,
        data: data,
        dataType: 'json',
        // отключаем обработку передаваемых данных, пусть передаются как есть
        processData: false,
        // отключаем установку заголовка типа запроса. Так jQuery скажет серверу что это строковой запрос
        contentType: false,
        success: function (json_data) {                                  /* let json_data = result;*/
            if (json_data.hasOwnProperty('icon'))                        /* var elements = document.getElementsByClassName('avatar-img'); */
                [...document.getElementsByClassName(class_name)]
                    .forEach((element) => { element.src = json_data['icon']; });
        }
    });
}

function ajax_data(data, func, path) { // function(result) { let json_data = JSON.parse(result); }
    $.ajax({
        type: "POST",
        url: path,
        data: data,
        success: func
    });
}

function addElement(tag, path) {
    switch (tag) {
        case 'vacancy':
            // TODO
            break;
    }
}

function editVacancy(code_peration, path) {
    var parent = document.getElementsByClassName('properties')[0];
    var inpts = document.getElementsByTagName('input');
    for (const inpt of inpts) inpt.readOnly = !code_peration;
    var about_textarea = document.getElementById('about');
    about_textarea.readOnly = !code_peration;
    var name_input = document.getElementById('name');
    name_input.contentEditable = code_peration;

    var edit_project = document.getElementsByClassName('editVacancyButton')[0];

    // edit_project.innerHTML =  (code_peration ? "сохранить" : "редактировать") + " вакансию";
    edit_project.setAttribute('onclick', code_peration ? "editProject(false, '" + path + "');" : "editProject(true, '" + path + "');");

    var date_preview = document.getElementById('date-preview').value;

    //var stack               = document.getElementById('stack').value;
    //var scores_communities  = document.getElementById('scores_communities').value;
    //var scores_experts      = document.getElementById('scores_experts').value;
    //var populars_tags       = document.getElementById('populars_tags').value;

    var input_status = document.getElementById('input_status');
    var select_status = document.getElementById('select_status');

    input_status.setAttribute('hidden', true);

    if (code_peration) {
        input_status.setAttribute('hidden', true);
        select_status.removeAttribute('hidden');
    } else {
        input_status.removeAttribute('hidden');
        select_status.setAttribute('hidden', true);

        input_status.setAttribute('value', select_status.value); // Установка выбранного значения
    }

    var about = about_textarea.value;
    var status = input_status.value; // *
    var name = name_input.value;

    var data = {
        name: name,
        premier: date_preview,
        status: status,
        stack: stack,
        communities: scores_communities,
        experts: scores_experts,
        tags: populars_tags, // populars_
        about: about,
        action: "save_data_vacancy"
    };

    //
    var change_avater = document.getElementById('change-avater').files;

    var formData = new FormData();
    formData.append('avatar', change_avater[0]);
    formData.append('action', "load_avatar_vacancy");

    if (!code_peration) {
        var elems = document.getElementsByClassName('avatar-vacancy');
        var elem = elems[0];

        if (change_avater.length === 0 && window.delete_avatar_project) { data['avatar'] = elem.src.split('/').pop(); window.delete_avatar_project = false; }         // (change_avater.lengeth() == 0 ? : );   // data.append('avatar', elem.src); //  if(change_avater.length === 0)

        if (window.hasOwnProperty('vacancy_id')) data['vacancy_id'] = window.vacancy_id;

        /*ajax_data(data, function (result) {
            let json_data = JSON.parse(result);

            if (json_data.hasOwnProperty('save_data_vacancy')) {
                //
            }

            if (json_data.hasOwnProperty('error_code')) {
                //
            }

            if (json_data.hasOwnProperty('vacancy_id')) {
                window.vacancy_id = json_data['vacancy_id']; // Только после того, как проект будет сохранен в БД, ему присвоится идентификатор
            }

            //
        }, path);*/

        //if (change_avater.length != 0)
            //ajax_img(formData, path, 'avatar-vacancy');
    }
}

function addTag(container, log) {
    console.log(this, this.value); // input;
    console.log(container); // container;

    var a = document.createElement('a');
    a.classList.add('tag');

    a.innerHTML = '#' + this.value + ' \
            <button class="remove display" style="display: flex;" onclick="this.parentNode.remove();"> \
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="6 9 20 20"> \
                    <path stroke="#F6F6F6" stroke-linecap="round" d="M10.903 14.904 15.5 19.5m0 0 4.597 4.596M15.499 19.5l4.597-4.596M15.499 19.5l-4.596 4.596"></path> \
                </svg> \
            </button>'; // clone in functions.php [wrapperHtmlTagsSkills() row:col];

    duplicateСontrol.call(a, container, log); // this.value,

}

function addSkill(container, log){
    console.log(this, this.value); // input;
    console.log(container); // container;

    var label = document.createElement('label');
    label.classList.add('labelTag');

    label.innerHTML = this.value + ' \
        <button class="buttonTag display" onclick="this.parentNode.remove();" style="display: flex;" > <!-- hidden visibility: hidden; style="display: none;" --> \
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="7 10 20 20"> \
                <path stroke="#F6F6F6" stroke-linecap="round" d="M10.903 14.904 15.5 19.5m0 0 4.597 4.596M15.499 19.5l4.597-4.596M15.499 19.5l-4.596 4.596"></path> \
            </svg> \
        </button>'; // clone in functions.php [wrapperHtmlTagsSkills() row:col];

    duplicateСontrol.call(label, container, log); // this.value, 

    /*var fsd = false; // fsd - flag_search_dublicap;
    for (const label of container.children){
        if(label.textContent.trim() === this.value.trim()){
            fsd = true; 
            break;
        }
    }

    if(!fsd) { 
        label.innerHTML = this.value + ' \
        <button class="buttonTag display" onclick="this.parentNode.remove();" style="display: block;" > <!-- hidden visibility: hidden; style="display: none;" --> \
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="7 10 20 20"> \
                <path stroke="#F6F6F6" stroke-linecap="round" d="M10.903 14.904 15.5 19.5m0 0 4.597 4.596M15.499 19.5l4.597-4.596M15.499 19.5l-4.596 4.596"></path> \
            </svg> \
        </button>'; // clone in functions.php [wrapperHtmlTagsSkills() row:col];
        container.append(label);
    } else log.textContent = 'Обнаружен дубликат навыка!'; // console.log('Обнаружен дубликат навыка!');

    var myTimer = setTimeout(function(){
        log.textContent = '';
        clearTimeout(myTimer);
    }, 1000);*/
}

function duplicateСontrol(container, log) {
    var fsd = false; // fsd - flag_search_dublicap;
    for (const elem of container.children){
        if(elem.textContent.trim() === this.textContent.trim()){
            fsd = true; 
            break;
        }
    }

    if(!fsd) container.append(this);
    else {
        log.textContent = 'Обнаружен дубликат!';

        var myTimer = setTimeout(function(){
            log.textContent = '';
            clearTimeout(myTimer);
        }, 1000);

        this.remove();
    }
}

function addTagSkill(){
    
}

function resultSearch(value) {

    var result_container = document.getElementById('result');

    console.log(result_container.childNodes.length);

    if (result_container.childNodes.length > 2) result_container.removeChild(result_container.lastChild);

    var elem = document.createElement('button');

    elem.textContent = value;
    elem.setAttribute('onclick', 'this.remove();');
    //elem.onclick='remove(this)';

    result_container.append(elem);

    var input = document.getElementById('myInput');
    input.value = '';

    var ul = document.getElementById("myUL");
    ul.setAttribute('hidden', true);

    //input.textContent = "";

    //result_container.appendChild(elem);

    console.log("resultSearch");
}

function resultSearchTags(value) {

    var result_container = document.getElementById('result');

    var labels = result_container.getElementsByClassName('labelTag');

    //console.log(labels, value);

    /*for (const label of labels) // ограничение на повторения
        if(label.textContent === value) 
            label.remove();*/

    /*labels.forEach(label => {
        if(label.textContent === value) 
            label.remove();
    });*/

    //if(result_container.childNodes.length > 2) result_container.removeChild(result_container.lastChild);

    var label = document.createElement('label');

    label.textContent = value;
    label.setAttribute('class', 'labelTag');

    var button = document.createElement('button');


    button.setAttribute('onclick', 'this.parentNode.remove();');
    button.setAttribute('class', 'buttonTag');

    button.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="7 10 20 20"><path stroke="#F6F6F6" stroke-linecap="round" d="M10.903 14.904 15.5 19.5m0 0 4.597 4.596M15.499 19.5l4.597-4.596M15.499 19.5l-4.596 4.596"/></svg>';

    //elem.onclick='remove(this)'; // width="31" height="39"

    label.append(button);

    result_container.append(label);

    var input = document.getElementById('myInput');
    input.value = '';

    var ul = document.getElementById("myUL");
    ul.setAttribute('hidden', true);

    //input.textContent = "";

    //result_container.appendChild(elem);

    //console.log("resultSearch");
}

//let currentIndex = 2;

function loadMetaStars(elem) {
    const carouselItems = document.getElementsByClassName('item-of-stars'); //querySelectorAll

    //var elem = carouselItems[2];
    var metaData = elem.title.split(',');

    var art = document.getElementById('article-item');
    var elem_center = art.getElementsByClassName('HelveticaMain2')[0];
    var elem_left = art.getElementsByClassName('VasekMain2')[0];
    var elem_right = art.getElementsByClassName('VasekMain2')[1];

    elem_left.textContent = metaData[0];
    elem_center.textContent = metaData[1];
    elem_right.textContent = metaData[2];

    // console.log(elem.title);
}

function setPattern() {
    var tels = document.getElementsByName('phone');

    tels.forEach((tel) => {
        //tel.pattern = "\\+7\\s?[\\(]{0,1}9[0-9]{2}[\\)]{0,1}\\s?\\d{3}[-]{0,1}\\d{2}[-]{0,1}\\d{2}";
        //console.log(tel);
    });
}

function setCursorPosition(pos, e) {
    e.focus();
    if (e.setSelectionRange) e.setSelectionRange(pos, pos);
    else if (e.createTextRange) {
        var range = e.createTextRange();
        range.collapse(true);
        range.moveEnd("character", pos);
        range.moveStart("character", pos);
        range.select()
    }
}

function mask_phone(e) {
    var matrix = this.placeholder,// .defaultValue
        i = 0,
        def = matrix.replace(/\D/g, ""),
        val = this.value.replace(/\D/g, "");
    def.length >= val.length && (val = def);
    matrix = matrix.replace(/[_\d]/g, function (a) {
        return val.charAt(i++) || "_"
    });
    this.value = matrix;
    i = matrix.lastIndexOf(val.substr(-1));
    i < matrix.length && matrix != this.placeholder ? i++ : i = matrix.indexOf("_");
    setCursorPosition(i, this);
}

function mask_email(e) {

}

function mask_site(e) {

}

document.addEventListener('DOMContentLoaded', function () {
    //loadMetaStars();
    //goToNextSlide();

    setPattern();

    //var input = document.querySelector("#phone");
    //if (input) input.addEventListener("input", mask_phone, false);

    var textareas = document.getElementsByTagName('textarea');
    [...textareas].forEach((elem) => { // Недостаток `textarea` исправляем таким образом. // div c contentEdit='true'.
        elem.style.height = (elem.scrollHeight > 0 ? elem.scrollHeight : 40) + 'px';
    });


    var list = document.getElementById("dragAndDrop");

    var sortableList = document.getElementsByClassName('dragAndDrop');

    [...sortableList].forEach((container) => {
        var dragTag = 'span';
        var remId = '';
        switch (container.id) {
            case 'contacts':
                remId = 'contact';
                break;
            case 'references':
                remId = 'reference';
                break;
            case 'urls':
                remId = 'url';
                break;
            default:
                break;
        }

        /*
        draggable: dragTag,
        */
        new Sortable(container, {
            draggable: dragTag,
            animation: 150,
            axis: "y",
            filter: 'input', // Исключаем из сортировки возможность брать за input и перетаскивать
            preventOnFilter: false, // Позволяем передовать внешнему обработчику собития на фокус.
            onEnd: function (event) {
                var elem = event.originalEvent.target;
                if (elem.classList.contains('remove') && elem.id === remId) event.item.remove();
            }// filter: 'input',
        });
    });


    //setInterval(goToNextSlide, 2000);
}, false);

/*window.addEventListener("DOMContentLoaded", function() {
    var input = document.querySelector("#online_phone");
    input.addEventListener("input", mask, false);
    input.focus();
    setCursorPosition(3, input);
});*/

function goToSlide2(index) {
    const carouselItems = document.getElementsByClassName('item-of-stars'); //querySelectorAll

    if (carouselItems.length > 0) {
        //console.log(carouselItems[currentIndex]);
        //carouselItems[currentIndex].style.visibility = 'hidden';
        //carouselItems[currentIndex].style.transform = `scale(0.5)`;

        /*if (index < 0) {
        index = carouselItems.length - 1;
        } else if (index >= carouselItems.length) {
        index = 0;
        }*/

        localIndex = index % carouselItems.length;
        currentIndex = index;


        ///carouselItems[currentIndex].style.visibility = 'visible';

        //document.querySelector('.carousel-inner').style.transform = `translateX(-${currentIndex * 25}%)`;

        var elem = carouselItems[localIndex];

        if (carouselItems.length > 5) {

            if (elem.previousElementSibling.previousElementSibling.previousElementSibling) {
                elem.remove();
            }

            var elem = carouselItems[localIndex];

            var l2 = elem.previousElementSibling.previousElementSibling;
            var l1 = elem.previousElementSibling;
            var c = elem;
            var r1 = elem.nextElementSibling;
            var r2 = elem.nextElementSibling.nextElementSibling;

            var buff = r2.style.transform;
            r2.style.transform = r1.style.transform;
            r1.style.transform = c.style.transform;
            c.style.transform = l1.style.transform;
            l1.style.transform = l2.style.transform;
            l2.style.transform = buff;

            elem.parentNode.style.transform = `translateX(-${currentIndex * 5}%)`;
            elem.parentNode.append(l2.cloneNode(true)); // Добавление скытого в конец;

        } else if (carouselItems.length == 5) {


            var l2 = elem.previousElementSibling.previousElementSibling;
            var l1 = elem.previousElementSibling;
            var c = elem;
            var r1 = elem.nextElementSibling;
            var r2 = elem.nextElementSibling.nextElementSibling;

            var buff = r2.style.transform;
            r2.style.transform = r1.style.transform;
            r1.style.transform = c.style.transform;
            c.style.transform = l1.style.transform;
            l1.style.transform = l2.style.transform;
            l2.style.transform = buff;

            elem.parentNode.style.transform = `translateX(-${currentIndex * 100} %)`;

            loadMetaStars(c);
            // elem.parentNode.append(l2.cloneNode(true)); // Добавление скытого в конец;

            //elem.parentNode.style.transform = `translateX(+${currentIndex * 0}%)`;
            //currentIndex--;
            //if(currentIndex > );



        } else {

        }



        elem.previousElementSibling.previousElementSibling;

        elem.previousElementSibling;

        elem;

        elem.nextElementSibling;

        elem.nextElementSibling.nextElementSibling;

        console.log(elem.previousElementSibling.id - 1, elem.previousElementSibling.style.transform);
        console.log(currentIndex, elem.style.transform); // scale // transform: scale(...);

        //elem.style.transform = `scale(1.5)`;
        // document.querySelector('.carousel-inner').style.transform = `translateX(-${currentIndex * 100}%)`;
        //carouselItems[prevIndex].parentNode.append(carouselItems[prevIndex]); // добавление в конец


        if (elem.nextElementSibling) console.log(elem.nextElementSibling.id);
    }
}

let currentIndex = 0;
const carouselItems = document.getElementsByClassName('item-of-stars');

var buff_transform = [];

function goToSlide(index) {
    if (index < 0) {
        index = carouselItems.length - 1;
    } else if (index >= carouselItems.length) {
        index = 0;
    }
    currentIndex = index;

    var elem = carouselItems[currentIndex];

    console.log(elem.id);

    if (currentIndex === 0) {
        var l2 = elem.previousElementSibling.previousElementSibling;
        var l1 = elem.previousElementSibling;
        var c = elem;

        buff_transform.push(l2.style.transform);
        buff_transform.push(l1.style.transform);
        buff_transform.push(c.style.transform);
    }

    var l2 = elem.previousElementSibling.previousElementSibling;
    var l1 = elem.previousElementSibling;
    var c = elem;
    var r1 = elem.nextElementSibling;
    var r2 = elem.nextElementSibling.nextElementSibling;

    var buff = r2.style.transform;
    r2.style.transform = r1.style.transform;
    r1.style.transform = c.style.transform;
    c.style.transform = l1.style.transform;
    l1.style.transform = l2.style.transform;
    l2.style.transform = buff;

    var inner = elem.parentNode;

    var width_inner = elem.parentNode.offsetWidth;

    document.querySelector('.carousel-inner').style.transform = `translateX(-${(currentIndex + 1) * width_inner / (carouselItems.length)}px)`;
}


function goToNextSlide() {
    //carouselItems[currentIndex].style.display = "none";
    goToSlide(currentIndex + 1);
    //loadMetaStars();
    //carouselItems[currentIndex].style.display = "block";
}

function goToPrevSlide() {
    goToSlide(currentIndex - 1);
}

//setInterval(goToNextSlide, 2000); // автоматическая прокрутка каждые 3 секунды

/*profile*/
function addContacts() {
    // console.log(this);
    var span = document.createElement('span');
    //span.draggable ="true";
    span.className = "contact ";
    span.id = this.children.length + 1;
    //span.setAttribute('ondragstart', 'drag(event)'); // readOnly // Добавление осуществляется  в режиме `редактирования`. Поэтому
    span.innerHTML = ' <input class="shower_hider" type="text" value="Телефон" readOnly hidden> \
						<select name="type" id="pet-select" onchange="selectTypeContact.call(this)">\
							<option value="Телефон">Телефон</option>\
							<option value="Почта">Почта</option>\
							<option value="Сайт">Сайт</option>\
						</select>\
						<input class="contentProperty" id="phone" name="phone" type="tel" oninput="mask_phone();" maxlength="17" value="+7(___)___-__-__" placeholder="+7(___)___-__-__" readOnly/> \
            			<svg class="drag display" width="32" height="32" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"> \
							<rect width="48" height="48" fill="white" fill-opacity="0.01"/> \
							<path fill-rule="evenodd" clip-rule="evenodd" d="M19 10.3075C19 12.6865 17.2091 14.615 15 14.615C12.7909 14.615 11 12.6865 11 10.3075C11 7.92854 12.7909 6 15 6C17.2091 6 19 7.92854 19 10.3075ZM15 28.615C17.2091 28.615 19 26.6865 19 24.3075C19 21.9285 17.2091 20 15 20C12.7909 20 11 21.9285 11 24.3075C11 26.6865 12.7909 28.615 15 28.615ZM15 42.615C17.2091 42.615 19 40.6865 19 38.3075C19 35.9285 17.2091 34 15 34C12.7909 34 11 35.9285 11 38.3075C11 40.6865 12.7909 42.615 15 42.615Z" fill="black"/> \
							<path fill-rule="evenodd" clip-rule="evenodd" d="M37 10.3075C37 12.6865 35.2091 14.615 33 14.615C30.7909 14.615 29 12.6865 29 10.3075C29 7.92854 30.7909 6 33 6C35.2091 6 37 7.92854 37 10.3075ZM33 28.615C35.2091 28.615 37 26.6865 37 24.3075C37 21.9285 35.2091 20 33 20C30.7909 20 29 21.9285 29 24.3075C29 26.6865 30.7909 28.615 33 28.615ZM33 42.615C35.2091 42.615 37 40.6865 37 38.3075C37 35.9285 35.2091 34 33 34C30.7909 34 29 35.9285 29 38.3075C29 40.6865 30.7909 42.615 33 42.615Z" fill="black"/> \
						</svg>';

    //this.append(span);
    this.insertBefore(span, this.children[this.children.length - 1]); // childNodes
}

function addRefs() {
    var span = document.createElement('span');
    span.classList.add('reference');
    span.id = this.children.length + 1;

    span.innerHTML = ' \
        <input  id="nameref" type="text" value="..."> \
        <string>:</string>\
        <input  id="urlref"  type="text" value="...">\
        <svg class="drag display" width="32" height="32" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg"> \
			<rect width="48" height="48" fill="white" fill-opacity="0.01"/> \
			<path fill-rule="evenodd" clip-rule="evenodd" d="M19 10.3075C19 12.6865 17.2091 14.615 15 14.615C12.7909 14.615 11 12.6865 11 10.3075C11 7.92854 12.7909 6 15 6C17.2091 6 19 7.92854 19 10.3075ZM15 28.615C17.2091 28.615 19 26.6865 19 24.3075C19 21.9285 17.2091 20 15 20C12.7909 20 11 21.9285 11 24.3075C11 26.6865 12.7909 28.615 15 28.615ZM15 42.615C17.2091 42.615 19 40.6865 19 38.3075C19 35.9285 17.2091 34 15 34C12.7909 34 11 35.9285 11 38.3075C11 40.6865 12.7909 42.615 15 42.615Z" fill="black"/> \
			<path fill-rule="evenodd" clip-rule="evenodd" d="M37 10.3075C37 12.6865 35.2091 14.615 33 14.615C30.7909 14.615 29 12.6865 29 10.3075C29 7.92854 30.7909 6 33 6C35.2091 6 37 7.92854 37 10.3075ZM33 28.615C35.2091 28.615 37 26.6865 37 24.3075C37 21.9285 35.2091 20 33 20C30.7909 20 29 21.9285 29 24.3075C29 26.6865 30.7909 28.615 33 28.615ZM33 42.615C35.2091 42.615 37 40.6865 37 38.3075C37 35.9285 35.2091 34 33 34C30.7909 34 29 35.9285 29 38.3075C29 40.6865 30.7909 42.615 33 42.615Z" fill="black"/> \
		</svg>';
     this.insertBefore(span, this.children[this.children.length - 1]);
}

function allowDrop(ev) {
    //console.log('allowDrop', ev);

    /*var block_to_insert;
    var container_block;

    block_to_insert = document.createElement('div');
    block_to_insert.innerHTML = 'This demo DIV block was inserted into the page using JavaScript.';
    
    
    //ev.target.appendChild(block_to_insert);
    
    console.log(ev.target.id);
    console.log(ev.currentTarget);*/
    ev.preventDefault();
}

function drag(ev) {
    //console.log('drag', ev);

    console.log(ev.target.id);

    /*
    ev.target.style.opacity = "10%";
    
    ev.dataTransfer.setData( "Text", ev.target.id );*/
}
function drop(ev) {
    //console.log(ev);
    console.log('drop', ev);

    //var data = ev.dataTransfer.getData( "Text" );

    //console.log(ev.currentTarget);

    //ev.target.style.opacity = "100%";
    console.log(ev.target);
    console.log(ev.target.id);

    /*var elem = document.getElementById(data);
    elem.style.opacity = "100%";
    
    ev.target.append( elem ); // target // appendChild*/
    ev.preventDefault();
}

function showContextMenu() {
    var contextMenus = document.getElementsByClassName('contextMenu');
    [...contextMenus].forEach((menu) => {
        switch (menu.id) {
            case "1":
                menu.style.display = (menu.style.display === 'flex' ? 'none' : 'flex');
                break;
        }
    });
}

function addContactsIcon() {
    console.log(this);

    var span = document.createElement('span');

    span.className = "icon";

    //var opt = document.createElement('option');

    //opt.className = "optionImage";

    //opt.style.background = 'url("data:image/svg+xml;utf8, ';

    //opt.width = "100px";
    //opt.height = "100px";
    /*select.innerHTML = ' \
      <option>Вконтакте</option> \
      <option>Телеграм</option>\
      <option>другое</option>';*/

    span.innerHTML = '\
						<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="50" height="50" viewBox="0 0 48 48"> \
							<path fill="#29b6f6" d="M24 4A20 20 0 1 0 24 44A20 20 0 1 0 24 4Z"></path> \
							<path fill="#fff" d="M33.95,15l-3.746,19.126c0,0-0.161,0.874-1.245,0.874c-0.576,0-0.873-0.274-0.873-0.274l-8.114-6.733 l-3.97-2.001l-5.095-1.355c0,0-0.907-0.262-0.907-1.012c0-0.625,0.933-0.923,0.933-0.923l21.316-8.468 c-0.001-0.001,0.651-0.235,1.126-0.234C33.667,14,34,14.125,34,14.5C34,14.75,33.95,15,33.95,15z"></path> \
							<path fill="#b0bec5" d="M23,30.505l-3.426,3.374c0,0-0.149,0.115-0.348,0.12c-0.069,0.002-0.143-0.009-0.219-0.043 l0.964-5.965L23,30.505z"></path> \
							<path fill="#cfd8dc" d="M29.897,18.196c-0.169-0.22-0.481-0.26-0.701-0.093L16,26c0,0,2.106,5.892,2.427,6.912 c0.322,1.021,0.58,1.045,0.58,1.045l0.964-5.965l9.832-9.096C30.023,18.729,30.064,18.416,29.897,18.196z"></path> \
						</svg> \
                        <div class="showHide">  \
							<select> \
								<option>Вконтакте</option> \
        < option > другое</option > \
							</select > \
    <input class="contentProperty" type="url" value="..." ></input> \
						</div > ';

    // xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="50" height="50" viewBox="0 0 48 48"

    //opt.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg"  width="50" height="50" viewBox="0 0 48 48"><path fill="#1976d2" d="M24 4A20 20 0 1 0 24 44A20 20 0 1 0 24 4Z"></path> <path fill="#fff" d="M35.937,18.041c0.046-0.151,0.068-0.291,0.062-0.416C35.984,17.263,35.735,17,35.149,17h-2.618 c-0.661,0-0.966,0.4-1.144,0.801c0,0-1.632,3.359-3.513,5.574c-0.61,0.641-0.92,0.625-1.25,0.625C26.447,24,26,23.786,26,23.199 v-5.185C26,17.32,25.827,17,25.268,17h-4.649C20.212,17,20,17.32,20,17.641c0,0.667,0.898,0.827,1,2.696v3.623 C21,24.84,20.847,25,20.517,25c-0.89,0-2.642-3-3.815-6.932C16.448,17.294,16.194,17,15.533,17h-2.643 C12.127,17,12,17.374,12,17.774c0,0.721,0.6,4.619,3.875,9.101C18.25,30.125,21.379,32,24.149,32c1.678,0,1.85-0.427,1.85-1.094 v-2.972C26,27.133,26.183,27,26.717,27c0.381,0,1.158,0.25,2.658,2c1.73,2.018,2.044,3,3.036,3h2.618 c0.608,0,0.957-0.255,0.971-0.75c0.003-0.126-0.015-0.267-0.056-0.424c-0.194-0.576-1.084-1.984-2.194-3.326 c-0.615-0.743-1.222-1.479-1.501-1.879C32.062,25.36,31.991,25.176,32,25c0.009-0.185,0.105-0.361,0.249-0.607 C32.223,24.393,35.607,19.642,35.937,18.041z"></path></svg>';

    //select.append(opt);



    this.insertBefore(span, this.childNodes[this.childNodes.length - 2]);
}

function inputSugToolTip(path) {

    let inputValue = document.getElementById("inputSearch").value;
    //document.getElementsByClassName('inputSug')[0].style.display = 'flex';

    $.ajax({
        type: "POST",
        url: path,
        data: {
            search: inputValue,
            action: "show_input_suggestion"
        },
        success: function (result) {
            //console.log(result);
            //print_projects(result);
            //document.getElementsByClassName('buttonRef')
            document.getElementById('projects').innerHTML = '';
           
            if (document.getElementById('inputLi'))
                document.getElementById('inputLi').remove();
            
            print_projects(result);
            let projectTitle = document.getElementById('projectTitle').innerHTML;
            $('#inputSugUi').append('<li id="inputLi"><button class="inputLiBtn">' + projectTitle + '</button></li>');
        }
    });

}

function hideInputSugToolTip() {

    document.getElementsByClassName('inputSug')[0].style.display = 'none';

    if (document.getElementById('inputLi'))
        document.getElementById('inputLi').remove();
}

function orderByNewest(path){
    $.ajax({
        type: "POST",
        url: path,
        data: {
            // search: inputValue,
            type: 'new', // 'old' // 'rel';
            action: "order_project"
        },
        success: function (result) {
            console.log(result);
            document.getElementById('projects').innerHTML = '';
            print_projects(result);
         
        }
    });
}

function order_sort(type, path){
    var currentPage = window.location.href.split('/').pop().split('.')[0];

    if(this.style.background === ''){
        this.style.background = 'red';

        $.ajax({
            type: "POST",
            url: path,
            data: {
                // search: inputValue,
                type: type, // 'old' // 'relevant';
                page: currentPage,
                action: "order_sort"
            },
            success: function (result) {
                console.log(result);
                
                document.getElementById('projects').innerHTML = '';
                
                print_projects(result);
             
            }
        });

    } else {
        this.style.background = '';

        query_projects(path);
    }
}

function resizeTextarea(){
    this.style.height = '1px';
    this.style.height = (this.scrollHeight + 6) + 'px'; 
}