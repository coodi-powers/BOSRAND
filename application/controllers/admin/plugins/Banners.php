<?php
/**
 * Created by PhpStorm.
 * User: bartbollen
 * Date: 25/04/15
 * Time: 19:44
 */

class Banners extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->data['submenu'] = '';
        $this->data['title'] = 'Banners';
        $this->load->model('banner_m');
        $this->data['page_title'] = 'Banners';
    }

    public function index($banner_id = NULL)
    {
        $this->data['banners'] = $this->banner_m->get();
        $this->data['subview'] = 'admin/plugins/banners/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function edit($id = NULL)
    {


        // fetch a nest or set a new one
        if ($id) {
            $this->data['banner'] = $this->banner_m->get($id);
            if (count($this->data['banner']) == NULL) {
                $this->data['errors'] = 'banner werd niet gevonden';
            }
        } else {
            $this->data['banner'] = $this->banner_m->get_new();
        }

        if ($_POST) {
            $data = $this->banner_m->array_from_post(array('naam', 'titel_nl', 'afbeelding'));

            $this->banner_m->save($data, $id);
            redirect('admin/plugins/banners');
        }

        //load the form
        $this->data['subview'] = 'admin/plugins/banners/edit';
        $this->load->view('admin/_layout_main', $this->data);

    }

    public function modal()
    {
        $this->load->view('admin/_layout_modal', $this->data);
    }


    
    public function delete($id)
    {
        $this->banner_m->delete($id);

        redirect('admin/plugins/banners/index/');
    }
}