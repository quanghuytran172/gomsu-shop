<?php
require_once('controllers/BaseController.php');

class NotFoundController extends BaseController
{
    function __construct()
    {
        $this->folder = '';
    }

    public function index()
    {
        $this->render('404');
    }
}