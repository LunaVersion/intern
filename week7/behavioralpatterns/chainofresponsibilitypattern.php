<?php
//mục đích: cho phép 1 chuỗi đối tượng xử lý 1 yêu cầu mà ko cần biết đối tượng nào sẽ xử lý nó
// VD Hệ thống xử lý yêu cầu bảo hành, xác thực request API.

abstract class Handler {
    protected $next; //đối tượng tiếp theo trong chuỗi xử lý

    public function setNext(Handler $next) {
        $this->next = $next;
        return $next;
    }

    public function handle($request) {
        if ($this->next) { //nếu có handle tiếp theo thì chuyển yêu cầu cho handle đó
            return $this->next->handle($request);
        }
        return null;
    }
}

//các handles xử lý
// có thể thêm các handle khác
class AuthHandler extends Handler {
    public function handle($request) {
        if ($request === "Auth") {
            return "Xác thực thành công\n";
        }
        return parent::handle($request);
    }
}

class LogHandler extends Handler {
    public function handle($request) {
        if($request === "Log"){
            echo "Ghi log: $request\n"; 
        }
        return parent::handle($request);
    }
}

//vd thêm handle test
class TestHandler extends Handler {
    public function handle($request) {
        if ($request === "Test") {
            return "Đang test\n";
        }
        return parent::handle($request);
    }
}

// Sử dụng
$auth = new AuthHandler();
$log = new LogHandler();
$test = new TestHandler();

//auth => log => test
$auth->setNext($log);
$log->setNext($test);

echo $auth->handle("Log"); 
