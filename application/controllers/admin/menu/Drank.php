<?php
/**
 * Created by PhpStorm.
 * User: bartbollen
 * Date: 25/04/15
 * Time: 19:44
 */

class Drank extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->data['submenu'] = '';
        $this->data['title'] = 'Dranken';
        $this->load->model('drank_m');
        $this->data['page_title'] = 'Dranken';
    }

    public function index()
    {
        $this->data['dranken'] = $this->drank_m->get();
        $this->data['subview'] = 'admin/menu/drank/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function edit($id = NULL)
    {


        // fetch a nest or set a new one
        if ($id) {
            $this->data['drank'] = $this->drank_m->get($id);
            if (count($this->data['drank']) == NULL) {
                $this->data['errors'] = 'drank werd niet gevonden';
            }
        } else {
            $this->data['drank'] = $this->drank_m->get_new();
        }

        if ($_POST) {
            $data = $this->drank_m->array_from_post(array('naam', 'titel_nl', 'subtext_nl'));

            $data['prijs'] = str_replace(',', '.', $_POST['prijs']);
            $data['prijs_2'] = str_replace(',', '.', $_POST['prijs_2']);
            $data['prijs_3'] = str_replace(',', '.', $_POST['prijs_3']);


            $this->drank_m->save($data, $id);
            redirect('admin/menu/drank');
        }

        //load the form
        $this->data['subview'] = 'admin/menu/drank/edit';
        $this->load->view('admin/_layout_main', $this->data);

    }

    public function modal()
    {
        $this->load->view('admin/_layout_modal', $this->data);
    }

    public function delete($id)
    {
        $this->drank_m->delete($id);
        redirect('admin/menu/drank');
    }





}