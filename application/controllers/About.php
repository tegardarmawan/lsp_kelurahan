<?php
defined('BASEPATH') or exit('No direct script access allowed');

class About extends CI_Controller
{
    var $module_js = [];
    var $app_data = [];

    public function __construct()
    {
        parent::__construct();
        $this->_init();
    }


    private function _init()
    {
        $this->app_data['module_js'] = $this->module_js;
    }

    public function index()
    {
        $this->load->view('header');
        $this->load->view('view_about');
        $this->load->view('footer');
        $this->load->view('js-custom', $this->app_data);
    }
}