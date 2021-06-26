<?php

class Pagination
{
    private $config = [
        'total' => 0,
        'limit' => 0,
        'full' => true,
        'querystring' => 'page',
        'path' => 'adminproduct/index'
    ];
    public $url;
    public $queryString;
    public $currentPage;
    public function __construct($config = [])
    {
        $params = $this->getParams();
        if (isset($params[2])) {
            $config['querystring'] = $params[2];
        }
        if (isset($params[3])) {
            $this->currentPage = $params[3];
        }

        $url = 'http://' . $_SERVER['HTTP_HOST'] . '/gomsu_shop/';
        $url .= $config['path'];
        $this->url = $url;

        // kiểm tra xem trong config có limit, total đủ điều kiện không
        if (isset($config['limit']) && $config['limit'] < 0 || isset($config['total']) && $config['total'] < 0) {
            // nếu không thì dừng chương trình và hiển thị thông báo.
            die('limit và total không được nhỏ hơn 0');
        }
        // Kiểm tra xem config có querystring không
        if (!isset($config['querystring'])) {
            $config['querystring'] = 'page';
        }
        $this->config = $config;
    }

    public function getParams()
    {
        $urlCurrent = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        unset($urlCurrent[0]);
        unset($urlCurrent[1]);
        return $urlCurrent;
    }
    private function gettotalPage()
    {
        return ceil($this->config['total'] / $this->config['limit']);
    }


    private function getCurrentPage()
    {
        // kiểm tra tồn tại GET querystring và có >=1 không
        if (isset($this->currentPage) && (int)$this->currentPage >= 1) {
            // Nếu có kiểm tra tiếp xem nó có lớn hơn tổn số trang không.
            if ((int)$this->currentPage > $this->gettotalPage()) {
                // nếu lớn hơn thì trả về tổng số page
                return (int)$this->gettotalPage();
            } else {
                // còn không thì trả về số trang
                return (int)$this->currentPage;
            }
        } else {
            // nếu không có querystring thì nhận mặc định là 1
            return 1;
        }
    }

    private function getPrePage()
    {
        // nếu trang hiện tại bằng 1 thì trả về null
        if ($this->getCurrentPage() === 1) {
            return;
        } else {
            // còn không thì trả về html code
            // return '<li><a href="' . $this->url . '/' . $this->config['querystring'] . '/' . ($this->getCurrentPage() - 1) . '" >Pre</a></li>';
            return '<li class="page-item">
                                        <a class="page-link" href="' . $this->url . '/' . $this->config['querystring'] . '/' . ($this->getCurrentPage() - 1) . ' " aria-label="Previous">
                                            <span aria-hidden="true" class="mdi mdi-chevron-left"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                    </li>';
        }
    }

    private function getNextPage()
    {
        // nếu trang hiện tại lơn hơn = totalpage thì trả về rỗng
        if ($this->getCurrentPage() >= $this->gettotalPage()) {
            return;
        } else {
            return '<li class="page-item">
                                        <a class="page-link" href="' . $this->url . '/' . $this->config['querystring'] . '/' . ($this->getCurrentPage() + 1) . ' " aria-label="Previous">
                                            <span aria-hidden="true" class="mdi mdi-chevron-right"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </li>';
        }
    }
    public function getPagination()
    {
        $path = 'adminproduct/index';
        $url = 'http://' . $_SERVER['HTTP_HOST'] . '/gomsu_shop/';
        $url .= $path;
        $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $CurPageURL = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        // tạo biến data rỗng
        $data = '';
        // kiểm tra xem người dùng có cần full page không.
        if (isset($this->config['full']) && $this->config['full'] === false) {
            // nếu không thì
            $data .= ($this->getCurrentPage() - 3) > 1 ? '<li class="page-item ">
            <a class="page-link" >...</a>
        </li>' : '';

            for ($i = ($this->getCurrentPage() - 3) > 0 ? ($this->getCurrentPage() - 3) : 1; $i <= (($this->getCurrentPage() + 3) > $this->gettotalPage() ? $this->gettotalPage() : ($this->getCurrentPage() + 3)); $i++) {
                if ($i === $this->getCurrentPage()) {
                    // $data .= '<li class="active" ><a href="#" >' . $i . '</a></li>';
                    $data .= '<li class="page-item active">
                    <a class="page-link" href="' . $CurPageURL . '">' . $i . '</a>
                </li>';
                } else {
                    // $data .= '<li><a href="' . $this->url . '/' . $this->config['querystring'] . '/' . $i . '" >' . $i . '</a></li>';
                    $data .= '<li class="page-item ">
                    <a class="page-link" href="' . $this->url . '/' . $this->config['querystring'] . '/' . $i . '">' . $i . '</a>
                </li>';
                }
            }

            $data .= ($this->getCurrentPage() + 3) < $this->gettotalPage() ? '<li class="page-item ">
            <a class="page-link" >...</a>
        </li>' : '';
        } else {
            // nếu có thì
            for ($i = 1; $i <= $this->gettotalPage(); $i++) {
                if ($i === $this->getCurrentPage()) {
                    $data .= '<li class="active" ><a href="' . $CurPageURL . '" >' . $i . '</a></li>';
                } else {
                    $data .= '<li><a href="' . $this->url . '/' . $this->config['querystring'] . '/' . $i . '" >' . $i . '</a></li>';
                }
            }
        }

        return '<ul class = "pagination pagination-flat ">' . $this->getPrePage() . $data . $this->getNextPage() . '</ul>';
    }
}