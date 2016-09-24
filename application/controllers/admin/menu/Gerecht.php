<?php
/**
 * Created by PhpStorm.
 * User: bartbollen
 * Date: 25/04/15
 * Time: 19:44
 */

class Gerecht extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->data['submenu'] = '';
        $this->data['title'] = 'Gerechten';
        $this->load->model('gerecht_m');
        $this->data['page_title'] = 'Gerechten';
    }

    public function index()
    {
        $this->data['gerechten'] = $this->gerecht_m->get();
        $this->data['subview'] = 'admin/menu/gerecht/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function edit($id = NULL)
    {


        // fetch a nest or set a new one
        if ($id) {
            $this->data['gerecht'] = $this->gerecht_m->get($id);
            if (count($this->data['gerecht']) == NULL) {
                $this->data['errors'] = 'gerecht werd niet gevonden';
            }
        } else {
            $this->data['gerecht'] = $this->gerecht_m->get_new();
        }

        if ($_POST) {
            $data = $this->gerecht_m->array_from_post(array('naam', 'titel_nl', 'subtext_nl'));
            
            $data['prijs'] = str_replace(',', '.', $_POST['prijs']);


            $this->gerecht_m->save($data, $id);
            redirect('admin/menu/gerecht');
        }

        //load the form
        $this->data['subview'] = 'admin/menu/gerecht/edit';
        $this->load->view('admin/_layout_main', $this->data);

    }

    public function modal()
    {
        $this->load->view('admin/_layout_modal', $this->data);
    }

    public function delete($id)
    {
        $this->gerecht_m->delete($id);
        redirect('admin/menu/gerecht');
    }





}