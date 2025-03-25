<?php

class App {

   protected $controller = 'home';
   
   protected $method = 'index';

   protected $params = [];

    public function __construct(){
        // $this -> parseUrl();
        $url=$this -> parseUrl();
        $url = array_values($url);
        // print_r($url);
        // echo 'ok';

        // $controllerPath = __DIR__ . '/../controllers/' . $url[0] . '.php';
        // echo "Kiểm tra đường dẫn: " . $controllerPath . "<br>";
        // echo "Tồn tại file? " . (file_exists($controllerPath) ? 'Có' : 'Không');

        if(file_exists(__DIR__ .'/../controllers/'.$url[0].'.php')){
            $this->controller = $url[0];
            unset($url[0]);
        }


        require_once __DIR__ . '/../controllers/' . $this->controller . '.php';
        //echo $this->controller; // không đúng tên trong controllers thì mặc định là home
        
        $this->controller = new $this->controller;
        // var_dump($this->controller);

        // xác định method cần gọi trong controller dựa vào url
        // url[1] chưa tên method, nếu ko có hoặc sai thì dùng mặc định
        if(isset($url[1])) {
            if(method_exists($this->controller, $url[1])) { //ktra method có trong class của controller ko
                $this->method = $url[1];
                unset($url[1]);
            }
        }
        // print_r($url);
        $this->param = $url ? array_values($url) : [];
        //hoặc $this->param = array_values($url);
        // print_r($this->param);
        // gọi phương thức tron controller
        call_user_func_array([$this->controller,$this->method] ,$this->param);
    }

    public function parseUrl(){
        if(isset($_SERVER['REQUEST_URI'])){
            // echo $_GET['url'];
            // tách chuỗi để lấy controller, method, params từ URL
            // dùng trim thay cho rtrim vì khi explode sẽ không bị phần tử rỗng đầu mảng
            return $url = explode('/',filter_var(trim($_SERVER['REQUEST_URI'],'/'), FILTER_SANITIZE_URL));
        }
        return [];
        //php built in server không hỗ trợ htaccess nên $_GET['url'] ko hoạt động
        // echo $_SERVER['REQUEST_URI'];
    }
}