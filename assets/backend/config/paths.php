<?php

	//echo $_GET['register'];

	/*define(PATH, "/portfolioSer");*/

	enum TOTAL : string {
		case JQR  = "/assets/backend/js/library/jquery/jquery-3.7.1.min.js";
		case FCN  = "/assets/frontend/icons/vega.ico";
        case CDB  = "/assets/backend/config/config_db.php";
        case WDBC = "/assets/backend/config/WrapperDataBaseConn.php";
	}

	enum INDEX : string {
		case JSX = "/assets/backend/js/index.js";
		case CSS = "/assets/frontend/styles/css/index.css";
		case PATH = "/index.php";
	}

	enum AUTH : string {
		case JSX  = "/assets/backend/js/authorization.js";
		case CSS  = "/assets/frontend/styles/css/authorization.css";
		case PATH = "/assets/frontend/pages/authorization.php";
	}

    enum REG : string {
        case JSX  = "./../../backend/js/registration.js";
		case CSS  = "./../../frontend/styles/css/registration.css";
		case PATH = "/assets/frontend/pages/registration.php";
    }

    enum PAGE : string {
        case PFL 	 	= "/assets/frontend/pages/profile.php";
        case ACT 	 	= "/assets/frontend/pages/action.php";
		case PROJECT 	= "/assets/frontend/pages/project.php";
		case VACANCY 	= "/assets/frontend/pages/vacancy.php";
		case INTERESTS 	= "/assets/frontend/pages/interests.php";
    }

	enum MAIN : string {
		case VACANCY = '/assets/frontend/mains/main_for_vacancy.php';
		case INTERESTS = "/assets/frontend/mains/main_for_interests.php";
	}

	enum NAV : string {
		case PRJ = "/assets/frontend/pages/projects.php";
		case TMS = "/assets/frontend/pages/teams.php";
		case VAC = "/assets/frontend/pages/vacancies.php";
	}

	enum STYLE : string {
		case MAIN 		= "/assets/frontend/styles/css/main.css";
		case INDEX 		= "/assets/frontend/styles/css/css/index.css";
		case PROFILE 	= "/assets/frontend/styles/css/css/profile.css";
		case TEAMS 		= "/assets/frontend/styles/css/css/teams.css";
		case VACANCIES 	= "/assets/frontend/styles/css/css/vacancies.css";
		case PROJECTS	= "/assets/frontend/styles/css/css/projects.css";
		case PROJECT	= "/assets/frontend/styles/css/css/project.css";
		case VACANCY    = "/assets/frontend/styles/css/css/vacancy.css";
	}

	enum ICON_DEFAULT : string {
		case VACANCY 	= "/assets/frontend/icons/default_avatar_vacancy.jpg";
		case PROFILE 	= "/assets/frontend/icons/default_avatar_profile.jpg";
		case PROJECT 	= "/assets/frontend/icons/default_avatar_profile.jpg";
	}

	enum PATH_DEFAULT : string {
		case PROFILE = "/assets/frontend/icons/avatars_profiles/";
		case PROJECT = "/assets/frontend/icons/avatars_projects/";
	}

	enum AOS : string {
		case CSS = "/assets/backend/library/aos/aos.css";
		case JSX = "/assets/backend/library/aos/aos.js";
	}

	/* */

	enum TABS_NAME : string {// case TAB_REGISTRATION_USER = "info_user";
		case PROFILES  		= "info_user";
		case PROJECTS  		= "projects";
		case VACANCIES 		= "vacancies"; // vacancies
		case LIKE_PROJECT 	= "like_project";
		case AWESOME 		= "awesome";// recognition
	} // case TAB_PROJECTS = "projects"; /*info_project */
	
	class_alias('TABS_NAME', 'TBN');
	
	enum TAB_REGISTRATION_USER { /* TAB_REGISTRATION_USER */
		case id;
		case firstname;
		case lastname;
		case patronymic;
		case login;
		case roles;
		case icon;
		case hash; /* 8 */ /* pswd_hash */
		case telephone;
		case email;
		case status; /* end */
	}
	
	class_alias('TAB_REGISTRATION_USER', 'TRU'); 
	
	enum SELECT_QUERY : int {
		case SELECT  = 0;
		case FROM    = 1;
		case WHERE   = 2;
		case ILIKE = 3;
		case LIMIT   = 4;
		case OFFSET  = 5;
		case HAVING  = 6;
		case GROUPBY = 7;
		case ORDERBY = 8;
		case ORDERBYTYPE = 9;

	}
	
	class_alias('SELECT_QUERY', 'SQ');
	
	enum ORDERBYTYPE {
		case ACS;
		case DESC;
	}
	
	class_alias('ORDERBYTYPE', 'OBT');
	
	enum INSERT_INTO_QUERY : int {
		case INSERT_INTO  = 0;
		case COLUMNS      = 1;
		case VALUES       = 2;
		case RETURNING	  = 3;
	}
	
	class_alias('INSERT_INTO_QUERY', 'IIQ');
	
	enum OPBIN : string {
		case AND    = "AND";
		case OR     = "OR";
	}
	
	enum ERRORCODE: int {
		case   BLOCK_PROFILE = 1;
		case UNBLOCK_PROFILE = 0;
		case        PASSWORD = 2;
	}
	
	class_alias('OPBIN', 'OB');

	enum UPDATE_QUERY : int {
		case UPDATE  = 0;
		case SET     = 1;
		case WHERE   = 2;
	}

	class SIZE_LOAD_PAGE {
		public static $PROJECTS = 10;
		public static $TEAMS = 3;
		public static $VACANCIES = 10;
	}

	/*enum SIZE_LOAD_PAGE : int {
		case PROJECT = 3;
		case TEAMS = 3;
		case VACANCIES = 3;
	}*/

	class_alias('UPDATE_QUERY', 'UQ');
?>