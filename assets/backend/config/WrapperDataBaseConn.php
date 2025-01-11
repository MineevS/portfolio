<?php

class Query {
    private $dbconn;

    private $request;
    private $responce;

    private $result_last_request;

    function __construct($dbconn){
        $this->dbconn = $dbconn;
    }

    function accomulate(){
        $count_args = func_num_args();
        $result = "";
        for($index_arg = 0; $index_arg < $count_args; $index_arg++){
            $arg = func_get_arg($index_arg);
            $result = $result."$arg";

            if($index_arg != $count_args - 1)
                $result = $result.", ";
        }

        return $result;
    }

    function selector_query_select($op_code, $data){
        $op_code_val = $op_code->value;
        switch($op_code_val){
            case SELECT_QUERY::SELECT->value:
                $this->request = "SELECT $data";
                break;
            case SELECT_QUERY::FROM->value:
                $this->request = $this->request." FROM ".$data;
                break;
            case SELECT_QUERY::WHERE->value:
                $this->request = $this->request." WHERE ".$data;
                break;
            case SELECT_QUERY::LIMIT->value:
                $this->request = $this->request." LIMIT ".$data;
                break;
            case SELECT_QUERY::OFFSET->value:
                $this->request = $this->request." OFFSET ".$data;
                break;
            case SELECT_QUERY::HAVING->value:
                $this->request = $this->request." HAVING ".$data;
                break;
            case SELECT_QUERY::GROUPBY->value:
                $this->request = $this->request." GROUP BY ".$data;
                break;
            case SELECT_QUERY::ORDERBY->value:
                $this->request = $this->request." ORDER BY ".$data;
                break;
        }
    }

    // [SELECT QUERY START] ------------------------------------------------------- //
    function select(){
        $this->clear_query();

        $res_sels = $this->accomulate(...func_get_args());          /* ... (Spread) - распаковывает массив аргументов; */
        
        $this->selector_query_select(SELECT_QUERY::SELECT, $res_sels);

        return $this;
    }

    function from(){
        $res_froms = $this->accomulate(...func_get_args()); 
        
        $this->selector_query_select(SELECT_QUERY::FROM, $res_froms);

        return $this;
    }

    function where(){
        $count_args = func_num_args();
        $cond = "";
        for($index_arg = 0; $index_arg < $count_args - 1; $index_arg=$index_arg+3){
            $arg1 = func_get_arg($index_arg + 0);
            $arg2 = func_get_arg($index_arg + 1);
            $cond = $cond."$arg1='$arg2'";

            if($index_arg != $count_args - 2){
                $op = func_get_arg($index_arg + 2)->value;
                $cond = $cond." $op ";
            }
        }

        $this->selector_query_select(SELECT_QUERY::WHERE, $cond);

        return $this;
    }

    function limit($lim){
        $this->selector_query_select(SELECT_QUERY::LIMIT, $lim);

        return $this;
    }

    function offset($offst){
        $this->selector_query_select(SELECT_QUERY::OFFSET, $offst);

        return $this;
    }

    function having(){
        $res_having = $this->accomulate(...func_get_args());          
        
        $this->selector_query_select(SELECT_QUERY::HAVING, $res_having);

        return $this;
    }

    function orderBy(){
        $res_ordby = $this->accomulate(...func_get_args());          /* ... (Spread) - распаковывает массив аргументов; */
        
        $this->selector_query_select(SELECT_QUERY::ORDERBY, $res_ordby);

        return $this;
    }

    function orderByType($type){
        $this->selector_query_select(SELECT_QUERY::ORDERBYTYPE, $type);

        return $this;
    }

    function groupBy(){
        $res_groupby = $this->accomulate(...func_get_args());          
        
        $this->selector_query_select(SELECT_QUERY::GROUPBY, $res_groupby);

        return $this;
    }

    // [SELECT QUERY END] ------------------------------------------------------- //

    function exec_query($dbconn){
        if($dbconn)
            $this->result_last_request = pg_query($dbconn, $this->request) || die('Ошибка запроса: ' . pg_last_error($dbconn));
        else
            $this->result_last_request = pg_query($this->dbconn, $this->request); // "UPDATE PUBLIC.info_user SET \"group\"='КМБО-01-23' WHERE id='1';"

        if($this->result_last_request)
            $this->responce = pg_fetch_all($this->result_last_request);

        return $this->get_query_status();
    }

    function exec(){
        $count_args = func_get_args();

        if($count_args){
            $dbconn = func_get_arg(0);
        } else {
            $dbconn = NULL;
        }

        return $this->exec_query($dbconn);
    }

    function get_query_status(){
        if($this->result_last_request)
            return true;
        else
            return false;
    }

    function clear_query(){
        $this->clear_query_request();
        $this->clear_query_responce();

        return ($this->responce == $this->request) && ($this->request == "");
    }

    function clear_query_request(){
        $this->request = "";

        return $this->request == "";
    }

    function clear_query_responce(){
        $this->responce = "";

        return $this->responce == "";
    }

    function get_query_responce(){
        return $this->responce;
    }

    function responce(){
        return $this->get_query_responce();
    }

    function get_query_request(){
        return $this->request;
    }

    function request(){
        return $this->get_query_request();
    }

    // [INSERT INTO QUERY START] --------------------------------- //

    function selector_query_insert_into($op_code, $data){
        $op_code_val = $op_code->value;
        switch($op_code_val){
            case INSERT_INTO_QUERY::INSERT_INTO->value:
                $this->request = "INSERT INTO PUBLIC.".$data;
                break;
            case INSERT_INTO_QUERY::COLUMNS->value:
                $this->request = $this->request." (".$data.")";
                break;
            case INSERT_INTO_QUERY::VALUES->value:
                $this->request = $this->request." VALUES(".$data.")";
                break;
        }
    }

    function insert_into(){
        $this->clear_query();

        $res_insert_into = $this->accomulate(...func_get_args());
        
        $this->selector_query_insert_into(INSERT_INTO_QUERY::INSERT_INTO, $res_insert_into);

        return $this;
    }



    function columns(){
        $res_columns = $this->accomulate(...func_get_args());

        $this->selector_query_insert_into(INSERT_INTO_QUERY::COLUMNS, $res_columns);

        return $this;
    }

    function decorator_value($arg){
        $result = $_POST[$arg];

        switch($arg){
            case "password": /* "passwd" */
                $result = password_hash($_POST[$arg], PASSWORD_DEFAULT);
                break;
        }

        return "'".$result."'";
    }

    function decorator_column($arg){
        $result = $arg;

        switch($arg){
            case "password":
                $result = "hash";
                break;
        }

        return $result;
    }

    function values_from_columns(){
        $res_columns = "";
        $res_values = "";

        $count_args = func_num_args();

        //implode(",", $args);
        for($index_arg = 0; $index_arg < $count_args - 1; $index_arg++){
            $arg = func_get_arg($index_arg);

            $res_columns = $res_columns.$this->decorator_column($arg).", ";
            $res_values = $res_values.$this->decorator_value($arg).", ";
        }

        $res_columns = $res_columns.$this->decorator_column(func_get_arg($count_args - 1));
        $res_values = $res_values.$this->decorator_value(func_get_arg($count_args - 1));

        $this->selector_query_insert_into(INSERT_INTO_QUERY::COLUMNS, $res_columns);
        $this->selector_query_insert_into(INSERT_INTO_QUERY::VALUES, $res_values);

        return $this;
    }

    function values(){
        $res_values = $this->accomulate(...func_get_args()); 

        $this->selector_query_insert_into(INSERT_INTO_QUERY::VALUES, $res_values);

        return $this;
    }

    // [INSERT INTO QUERY END] --------------------------------- //

    // [UPDATE QUERY START] --------------------------------- //

    function selector_query_update($op_code, $data){
        $op_code_val = $op_code->value;
        switch($op_code_val){
            case UPDATE_QUERY::UPDATE->value:
                $this->request = "UPDATE PUBLIC.".$data;
                break;
            case UPDATE_QUERY::SET->value:
                $this->request = $this->request." SET ".$data;
                break;
            case UPDATE_QUERY::WHERE->value: // Уже сделано!
                $this->request = $this->request." WHERE ".$data." ";
                break;
        }
    }

    function update(){
        $this->clear_query();

        $res_update = $this->accomulate(...func_get_args());
        
        $this->selector_query_update(UPDATE_QUERY::UPDATE, $res_update);

        return $this;
    }

    function set(){
        $res_update = "";

        $count_args = func_num_args();

        //implode(",", $args);
        for($index_arg = 0; $index_arg < $count_args - 1; $index_arg++){
            $arg = func_get_arg($index_arg);

            $res_update = $res_update."\"".$this->decorator_column($arg)."\"=".$this->decorator_value($arg).", ";
        }

        $arg = func_get_arg($count_args - 1);

        $res_update = $res_update."\"".$this->decorator_column($arg)."\"=".$this->decorator_value($arg);

        $this->selector_query_update(UPDATE_QUERY::SET, $res_update);

        return $this;
    }

    /*function where(){ // Уже реализован!
        $this->clear_query();

        $res_update = $this->accomulate(...func_get_args());
        
        $this->selector_query_update(UPDATE_QUERY::UPDATE, $res_update);

        return $this;
    }*/

    // [UPDATE QUERY END] --------------------------------- //
}

class WrapperDataBaseConn {
    public $name;
    public $host;
    public $port;
    public $user;
    public $passwd;
    public $dbconn;

    public $query;
    public $result;
    private $last_error;

    function __construct($name, $host, $port, $user, $passwd){
        $this->name = $name;

        $this->host = $host;
        $this->port = $port;

        $this->user = $user;
        $this->passwd = $passwd;

        $this->query = new Query($this->connect());
    }

    function connect(){
        $this->dbconn = pg_connect("host=$this->host port=$this->port user=$this->user dbname=$this->name password=$this->passwd")
        or die('Not connect db: ' . pg_last_error($this->dbconn));

        return $this->dbconn;
    }

    function login($login, $password){
        $status_query = $this->query
            ->select('*')
            ->from(TBN::TAB_REGISTRATION_USER->value)
            ->where("login", $login)
        ->exec();

        if($status_query){
            $responce = $this->query->responce();

            foreach ($responce as $row_data){
                $hash_from_db = $row_data[TRU::hash->name]; 

                // Проверка на блокировку профиля:
                $stprofile = $row_data[TRU::status->name];

                if($stprofile == "block") {$this->last_error = ERRORCODE::BLOCK_PROFILE->value; return false; }

                $result = password_verify($password, $hash_from_db);
                if($result){
                    /*$_SESSION['isLogin'] = true;
                    $_SESSION['id']      = $row[0];
                    $_SESSION['nik']     = $row[1];
                    $_SESSION['nama']    = $row[2];
                    $_SESSION['email']   = $row[3];
                    $_SESSION['telp']    = $row[4];
                    $_SESSION['alamat']  = $row[5];*/

                    $_SESSION[TRU::id->name]         = $row_data[TRU::id->name];
                    $_SESSION[TRU::firstname->name]  = $row_data[TRU::firstname->name];
                    $_SESSION[TRU::lastname->name]   = $row_data[TRU::lastname->name];
                    $_SESSION[TRU::patronymic->name] = $row_data[TRU::patronymic->name];
                    $_SESSION[TRU::login->name]      = $row_data[TRU::login->name];
                    $_SESSION[TRU::roles->name]      = $row_data[TRU::roles->name];
                    $_SESSION[TRU::icon->name]       = $row_data[TRU::icon->name];
                    $_SESSION[TRU::hash->name]       = $row_data[TRU::hash->name];
                    $_SESSION[TRU::email->name]      = $row_data[TRU::email->name];
                    $_SESSION[TRU::telephone->name]  = $row_data[TRU::telephone->name];
                    $_SESSION[TRU::status->name]     = $row_data[TRU::status->name];

                    $this->last_error = ERRORCODE::UNBLOCK_PROFILE->value;
                } else {
                    $_SESSION['message'] = "Password error!";

                    $this->last_error = ERRORCODE::PASSWORD->value;
                }
                return $result;
            }
        } else {
            $_SESSION['message'] = "Not find account!";
            return 'account';
        }
    }

    function validate_post_args(){
        $count_args = func_num_args();
        $_SESSION['message'] = "";
        for($index_arg = 0; $index_arg < $count_args; $index_arg++){
            $arg = func_get_arg($index_arg);
            if(!isset($_POST[$arg])){
                $_SESSION['message'] = $arg;
                return $arg;
                exit;
            }
        }
    }

    function save_data_profile(){
        $this->validate_post_args('avatar','group', 'course', 'cipher', 
                            'skills', 'institute', 'year_start', 
                            'specialization', 'educational_program', 'about');

        // "UPDATE users SET email='john_new@example.com' WHERE id=1"

        // Загрузка файла на сервер:

        $this->query->update('info_user');

        if(isset($_POST['avatar'])) $this->query->set('avatar');

        $status_query = $this->query
            ->set('group', 'course', 'cipher', 
            'skills', 'institute', 'year_start', 
            'specialization', 'educational_program', 'about')
            ->where('id', $_SESSION['id'])
        ->exec();

        // $avatar_image = $_POST['avatar'];
        
        // --------------------

        return $status_query;
    }

    function register(){
        $this->validate_post_args('firstname', 'lastname', 'telephone', 'email', 'login', 'password');
        
        $status_query = $this->query                    // Проверка, существует под данным логином  учетная запись ?
            ->select('*')
            ->from(TBN::TAB_REGISTRATION_USER->value)
            ->where("login", $_POST['login'])
        ->exec();

        // $status_query = false; // For Debug;

        $error_code = 1;
        if($status_query){ // $status_query
            if(count($this->query->responce()) == 0){

                // variance: one;
                /*  
                    $hash_pswd = password_hash($this->clean_escape($_POST['password']), PASSWORD_DEFAULT);
                    $status_query = $this->query
                        ->insert_into(TABS_NAME::TAB_REGISTRATION_USER->value)
                        ->columns("id", "firstname", "lastname", "telephone", "email", "password")                                                      // , "firstname", "lastname", "login", "passwd", "roles","icons"
                        ->values($_POST['id'], $_POST['firstname'], $_POST['lastname'], $_POST['telephone'], $_POST['email'], $_POST['password'])       // ,"root", "toor", "root@toor.com", "1234", 
                    ->exec();
                */

                // variance: two;
                $status_query = $this->query
                    ->insert_into(TBN::TAB_REGISTRATION_USER->value)
                    ->values_from_columns("firstname", "lastname", "telephone", "email", "login", "password")
                ->exec();

                $error_code = ($status_query ? 0 : 3);
            } else {
                $error_code = 2;
            }
        }

        /*switch($error_code){
            case 0:
                break;
            case 1:
                break;
            case 2:
                break;
            case 3;
                break;
        }*/

        $this->last_error = $error_code;

        $_SESSION['message'] = ($status_query ? "success_register" : "failed_register");

        return $status_query;
    }

    function last_error(){
        return $this->last_error;
    }

    function clean_escape($val){
        return pg_escape_string($val);
    }

    function get_query(){
        return $this->query;
    }

    function query(){
        return $this->get_query();
    }

    function exec(){
        return $this->query->exec_query($this->dbconn);
    }

    function setName($name){
        $this->name = $name;
        return $this->name == $name;
    }

    function getName(){
        return $this->name;
    }
}

class_alias('WrapperDataBaseConn', 'WDBC');

?>

