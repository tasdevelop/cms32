<?php

class Acos extends MY_Controller {

    public function __construct() {
        parent::__construct();
        session_start();
        $this->load->model('Macos');
    }

    /**
     * ambil controller dan method disimpan didatabase
     * @AclName Acos Fetch
     */
    public function fetch() {
        $this->listFolderFiles();
        redirect('login');
    }
    /**
     * Merupakan Grid dari Acos
     * @AclName Grid Acos
     */
    public function grid(){
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $rows = isset($_GET['rows']) ? intval($_GET['rows']) : 10;
        $sort = isset($_GET['sort']) ? strval($_GET['sort']) : 'acosid';
        $order = isset($_GET['order']) ? strval($_GET['order']) : 'asc';
        $filterRules = isset($_GET['filterRules']) ? ($_GET['filterRules']) : '';
        $cond = '';
        if (!empty($filterRules)){
            $cond = ' where 1=1 ';
            $filterRules = json_decode($filterRules);
            foreach($filterRules as $rule){
                $rule = get_object_vars($rule);
                $field = $rule['field'];
                $op = $rule['op'];
                $value = $rule['value'];
                if (!empty($value)){
                    if ($op == 'contains'){
                        $cond .= " and ($field like '%$value%')";
                    }
                }
            }
        }
        $sql = $this->Macos->count($cond);
        $total = $sql->num_rows();
        $offset = ($page - 1) * $rows;
        $data = $this->Macos->get($cond,$sort,$order,$rows,$offset)->result();

        $response = new stdClass;
        $response->total=$total;
        $response->rows = $data;
        $response->allData = $this->Macos->get($cond,$sort,$order,$total,$offset)->result();
        echo json_encode($response);
    }
    public function listFolderFiles($dir = null) {
        if ($dir === null){
            $dir = constant('APPPATH') . 'controllers/';
        }
        $ffs = scandir($dir);
        unset($ffs[0], $ffs[1]);
        // prevent empty ordered elements
        if (count($ffs) < 1)
            return;
        $i = 0;
        foreach ($ffs as $ff) {
            if (is_dir($dir . '/' . $ff))
                $this->listFolderFiles($dir . '/' . $ff);
            elseif (is_file($dir . '/' . $ff) && strpos($ff,'.php') !== false) {
                $classes = $this->get_php_classes(file_get_contents($dir . '/' . $ff));
                foreach($classes AS $class){
                    if(!class_exists($class)){
                        include_once($dir.$ff);
                    }
                    $methods = $this->get_class_methods($class, true);
                    foreach($methods as $method){
                        if(isset($method['docComment']['AclName'])){
                            $this->Macos->save(['class'=>$class, 'method'=>$method['name'], 'displayname'=>$method['docComment']['AclName'],'modifiedby'=>$_SESSION['username']]);
                        }
                    }
                }
            }
        }

    }
     public function get_php_classes($php_code, $methods = false) {
        $classes = array();
        $tokens = token_get_all($php_code);

        $count = count($tokens);
        for ($i = 2; $i < $count; $i++) {
            if ($tokens[$i - 2][0] == T_CLASS && $tokens[$i - 1][0] == T_WHITESPACE && $tokens[$i][0] == T_STRING) {
                $classes[] = $tokens[$i][1]; // assigning class name to classes array variable

            }
        }
        return $classes;
    }

    public function get_class_methods($class, $comment = false){
        $r = new ReflectionClass($class);
        $methods = array();

        foreach($r->getMethods() AS $m){
            if($m->class == $class){
                $arr = ['name'=>$m->name];
                if($comment === true){
                    $arr['docComment'] = $this->get_method_comment($r, $m->name);
                }
                $methods[] = $arr;
            }

        }

        return $methods;
    }
    public function get_method_comment($obj,$method){
        $comment = $obj->getMethod($method)->getDocComment();
        //define the regular expression pattern to use for string matching
        $pattern = "#(@[a-zA-Z]+\s*[a-zA-Z0-9, ()_].*)#";

        //perform the regular expression on the string provided
        preg_match_all($pattern, $comment, $matches, PREG_PATTERN_ORDER);
        $comments = [];
        foreach($matches[0] as $match){
            $comment = preg_split('/[\s]/',$match, 2);
            $comments[trim($comment[0],'@')] = $comment[1];
        }

        return $comments;
    }
}