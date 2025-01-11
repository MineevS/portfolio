const name_id_iframe = "iframe-auth-reg";
window.delete = false;

window.page_load_projects = 1;
window.page_load_vacancies = 1;
window.page_load_teams = 1;

function create_iframe_authorization_registration() {
    var layout = document.getElementsByClassName('layout')[0];

    var pre_iframe = document.getElementById(name_id_iframe);
    if(!pre_iframe){
        var iframe_auth = document.createElement("iframe");

        iframe_auth.id = name_id_iframe;
        iframe_auth.name = iframe_auth.id;

        layout.prepend(iframe_auth);
    }
}

function close_iframe() {
    window.parent.change_size_iframe(window.name, 0, 50);
    var iframe =  document.getElementById(name_id_iframe);
    iframe.remove();
}

function change_size_iframe(name_iframe, width, height){
    // Получение корневого элемента
    const root = document.querySelector(":root");
    
    // Изменение значения стиля для корневого элемента
    root.style.setProperty("--iframeHeight", `${height}vh`);
}

function logout(path){
    $.ajax({
        type: "POST",
        url: path,
        data: {
            action: "logout"
        },
        success: function(result) {
            let json_data = JSON.parse(result);

            if(json_data.hasOwnProperty('url')){ // && json_data.hasOwnProperty('error_code')
                window.top.location.href = json_data['url'];
            }
        }
    });
}

function editProfile(code_peration, path){
    var parent = document.getElementsByClassName('properties')[0];
    var inpts = document.getElementsByTagName('input');
    for (const inpt of inpts) inpt.readOnly = !code_peration;

    var edit_profile = document.getElementsByClassName('editProfileButton')[0];

    edit_profile.innerHTML =  code_peration ? "Сохранить изменения" : "Редактировать профиль";
    edit_profile.setAttribute('onclick', code_peration ? "editProfile(false, '" + path + "');" : "editProfile(true, '" + path + "');");

    var group               = document.getElementById('group').value;
    var course              = document.getElementById('course').value;
    var cipher              = document.getElementById('cipher').value;
    var skills              = document.getElementById('skills').value;

    var institute           = document.getElementById('institute').value;
    var year_start          = document.getElementById('year_start').value;
    var specialization      = document.getElementById('specialization').value;
    var educational_program = document.getElementById('educational_program').value;
    var about               = document.getElementById('about').value;

    //
    var change_avater = document.getElementById('change-avater').files;

    var formData = new FormData();
	formData.append('avatar', change_avater[0]);
    formData.append('action', "load_avatar");

   // (change_avater.lengeth() == 0 ? : ); 
    
    // сохранение данных в БД:

    if(!code_peration){
        $.ajax({
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
        });

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
        }

        var elems = document.getElementsByClassName('avatar-img');
        var elem = elems[0];

        // data.append('avatar', elem.src); //  if(change_avater.length === 0)

        if(change_avater.length === 0 && window.delete) { data['avatar'] = elem.src.split('/').pop(); window.delete = false;}

        $.ajax({
            type: "POST",
            url: path,
            data: data,
            success: function(result) {
                let json_data = JSON.parse(result);
            }
        });
    }
}

function changeAvatar($code_operation){
    switch($code_operation){
        case 'change':
            console.log("loadAvatar( 1 1 1)");
            break;
        case 'delete':
            console.log("loadAvatar( 1 2 1)");
            var elements = document.getElementsByClassName('avatar-img');
                    
            [...elements].forEach((element) => {
                element.src = "/assets/frontend/icons/avatars/default_avatar.jpg";
            });
            window.delete = true;
            break;
    }
}


function createElementFromHTML(htmlString) {
  var div = document.createElement('div');
  div.innerHTML = htmlString.trim();
  // Change this to div.childNodes to support multiple top-level nodes.
  return div.childNodes;
}

function loadProjets(path){
    // можно зphp определить кол.во макс страниц и заблокировать запрос при достижении последней страницы.
    
    window.page_load_projects++; // Инкремент на следующую страницу; // Размер (объём) одной страницы определен в ...
    $.ajax({
        type: "POST",
        url: path,
        data: {
            page_load_projects: window.page_load_projects,
            action: "load_projects"
        },
        success: function(result) {
            let json_data = JSON.parse(result);

            if(json_data.hasOwnProperty('data')){
                var container_projects = document.getElementById('projects');
                var divs = createElementFromHTML(json_data['data']);
                if(divs.length > 0)
                    [...divs].forEach((div_elem) => {
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
    });
}

