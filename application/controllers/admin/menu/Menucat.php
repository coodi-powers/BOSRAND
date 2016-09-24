<?php
/**
 * Created by PhpStorm.
 * page: bartbollen
 * Date: 4/05/15
 * Time: 19:52
 */

class Menucat extends Admin_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('menucat_m');
        $this->load->model('drank_m');
        $this->load->model('gerecht_m');
        $this->load->model('menucatlinks_m');
        $this->data['submenu'] = '';
        $this->data['title'] = 'Menukaart';
        $this->data['page_title'] = 'Menukaart';
    }

    public function index($cat_id = 0)
    {
        if($cat_id != NULL)
        {
            $this->data['cat_info'] = $this->menucat_m->get($cat_id);
        }
        else
        {
            $this->data['cat_info'] = $this->menucat_m->get_new();
        }


        //fetch all categories
        $this->data['categories'] = $this->menucat_m->get_with_parent();


        //extra js
        $this->data['extra_js'] = '
        <script src=\''.base_url('assets_admin/js/plugins/nestable/jquery.nestable.js') .'\'></script>
        
        <script>
            $(document).ready(function(){
        
                var updateOutput = function(e)
                {
                    var list   = e.length ? e : $(e.target),
                        output = list.data(\'output\');
                    if (window.JSON) {
                        $.post( \''.base_url('index.php/admin/menu/menucat/volgorde_items').'\', { testvalue: (window.JSON.stringify(list.nestable(\'serialize\'))) });
                    } else {
                        output.val(\'JSON browser support required for this demo.\');
                    }
                };
        
                // activate Nestable for list 
                $(\'#nestable\').nestable().on(\'change\', updateOutput);
        
                updateOutput($(\'#nestable\').data(\'output\', $(\'#nestable-output\')));
        
        
        
                var updateOutput2 = function(e)
                {
                    var list   = e.length ? e : $(e.target),
                        output = list.data(\'output\');
                    if (window.JSON) {
                        $.post( \''.base_url('index.php/admin/menu/menucat/volgorde_menu').'\', { testvalue: (window.JSON.stringify(list.nestable(\'serialize\'))) });
                    } else {
                        output.val(\'JSON browser support required for this demo.\');
                    }
                };
        
                // activate Nestable for list 2
                $(\'#nestable2\').nestable().on(\'change\', updateOutput2);
        
                updateOutput2($(\'#nestable2\').data(\'output\', $(\'#nestable2-output\')));
        
                });
        
        </script>
        ';
        $this->data['nested_structure'] = $this->getStructure(0);

        if($cat_id > 0)
        {
            $this->data['nested_structure_items'] = $this->items_getStructure($cat_id);
        }

        //load view
        $this->data['subview'] = 'admin/menu/menucat/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    
    public function getStructure($cat_id)
    {
        $arr_pages = $this->menucat_m->get_children($cat_id);
        $body = '';
        
        foreach ($arr_pages as $key=>$page_name)
        {
            $body .= '
                <li class="dd-item dd-nodrag" data-id="'.$key.'">
                    <div class="dd-handle dd-nodrag"  style="overflow: hidden;">
                        <div class="drag-button dd-handle"><i class="fa fa-arrows dd-handle padding-zero" ></i></div>
                        <div class="col-xs-5">'.$page_name.'</div>
                        <span class="pull-right">
                            <a href="'.anchor('admin/menu/menucat/delete/'.$key, '').'"><span class="label label-danger pull-right"><i class="fa fa-times"></i></span></a>
                            <a href="'.anchor('admin/menu/menucat/edit/'. $key, '').'"><span class="label label-warning pull-right"><i class="fa fa-pencil"></i></span></a>
                            <a href="'.anchor('admin/menu/menucat/index/'. $key, '').'"><span class="label label-default pull-right"><i class="fa fa-list"></i></span></a>
                        </span>
                    </div>';


            if($this->menucat_m->get_children($key) != 'no-children')
            {

                $body .= '<ol class=\'dd-list\'>';
                $body .= $this->getStructure($key);
                $body .= '</ol>';
            }

            $body .= '
                </li>
            ';
        }

        return $body;
    }
    

    public function order()
    {
        $this->data['sortable'] = TRUE;
        $this->data['subview'] = 'admin/page/order';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function volgorde_menu()
    {
        $json = $_POST['testvalue'];
        $json_decode = json_decode($json);

        $this->decode_menu($json_decode);
    }

    //volgorde paginas uitlezen
    public function decode_menu($items)
    {
        $volgorde_root = 1;
        foreach($items as $item)
        {
            $this->menucat_m->save_order($item->id, $volgorde_root);
            $volgorde_root ++;

            if($item->children != '')
            {
                $volgorde = 1;
                //alle kinderen nieuwe parent geven
                foreach($item->children as $child)
                {
                    $this->menucat_m->save_order($child->id, $volgorde);
                    $volgorde ++;

                    $this->menucat_m->save_parent($child->id, $item->id);
                }

                $this->decode_menu($item->children);
            }
        }
    }

    public function edit($id = NULL)
    {
        $this->load->library('ckeditor');
        $this->load->library('ckfinder');
        $this->ckeditor->basePath = base_url().'../../assets_admin/ckeditor/';
        $this->ckeditor->config['language'] = 'en';
        $this->ckeditor->config['width'] = '730px';
        $this->ckeditor->config['height'] = '300px';
        //Add Ckfinder to Ckeditor
        $this->ckfinder->SetupCKEditor($this->ckeditor,'../../../assets_admin/ckfinder/');

        // fetch a page or set a new one
        if ($id) {
            $this->data['category'] = $this->menucat_m->get($id);
            if(count($this->data['category']) == NULL)
            {
                $this->data['errors'] = 'category could not be found';
            }
        }
        else {
            $this->data['category'] = $this->menucat_m->get_new();
        }

        //pages for dropdown
        $this->data['categories_no_parent'] = $this->menucat_m->get_all();


        //$this->data['pages_no_parent'] = '';


        // set up the form
        //$rules = $this->menucat_m->_rules;
        //$this->form_validation->set_rules($rules);

        //process the form

        if($_POST)
        {
            $data = $this->menucat_m->array_from_post(array('parent_id', 'naam', 'titel_nl', 'afbeelding', 'type'));
            $data['intro_nl'] = $_POST['intro_nl'];
            $data['inhoud_nl'] = $_POST['inhoud_nl'];
            $this->menucat_m->save($data, $id);

            redirect('admin/menu/menucat');
        }

        /*
        if($this->form_validation->run() == TRUE)
        {
            $data = $this->menucat_m->array_from_post(array('title', 'slug', 'body', 'parent_id', 'template'));
            $this->menucat_m->save($data, $id);
            redirect('admin/page');
        }
        */

        $this->data['arr_types'] = $this->menucat_m->get_types();

        //load the form
        $this->data['subview'] = 'admin/menu/menucat/edit';
        $this->load->view('admin/_layout_main', $this->data);

    }

    public function delete($id)
    {
        $this->menucat_m->delete($id);
        redirect('admin/menu/menucat');
    }

    public function delete_box($id)
    {
        $plugin = $this->menucatlinks_m->get($id);
        $cat_id = $plugin->cat_id;

        $this->menucatlinks_m->delete($id);

        redirect('admin/menu/menucat/index/'.$cat_id);
    }

    public function _unique_slug($str)
    {
        // do not validate if slug already excists
        // unless it's the slug for the current page
        $id = $this->uri->segment(4);
        $this->db->where('slug', $this->input->post('slug'));
        !$id || $this->db->where('id !=', $id);
        $page = $this->menucat_m->get();

        if(count($page))
        {
            $this->form_validation->set_message('_unique_slug', '%s should be unique');
            return FALSE;
        }

        return TRUE;
    }

    public function items_getStructure($cat_id)
    {
        $arr_items = $this->menucatlinks_m->get_all_items($cat_id);
        $body = '';

        foreach ($arr_items as $item) {
            if ($item->link_id > 0) {

                if($item->type == '1')
                {
                    $item_info = $this->drank_m->get($item->item_id);
                }
                elseif($item->type == '2')
                {
                    $item_info = $this->gerecht_m->get($item->item_id);
                }
                $naam = $item_info->naam;
                $body .= '
                <li class="dd-item dd-nodrag" data-id="' . $item->link_id . '">
                    <div class="dd-handle dd-nodrag"  style="overflow: hidden;">
                        <div class="drag-button dd-handle"><i class="fa fa-arrows-v dd-handle padding-zero" ></i></div>
                        <div class="col-xs-5">' . $naam . '</div>
                        <span class="pull-right">
                            <a href="' . anchor('admin/menu/menucat/delete_box/' . $item->link_id, '') . '"><span class="label label-danger pull-right"><i class="fa fa-times"></i></span></a>
                        </span>
                    </div>
                </li>
            ';
            }
        }

        return $body;
    }

    public function volgorde_items()
    {
        $json = $_POST['testvalue'];
        $json_decode = json_decode($json);

        $this->decode_items($json_decode);
    }

    //volgorde uitlezen
    public function decode_items($items)
    {
        $volgorde_root = 1;
        foreach($items as $item)
        {
            $this->menucatlinks_m->save_order($item->id, $volgorde_root);
            $volgorde_root ++;
        }
    }

    public function edit_items($cat_id)
    {
        $arr_linked = array();
        $cat_info = $this->menucat_m->get($cat_id);

        if($cat_info->type == '1')
        {
            $all_items = $this->drank_m->get_all();
        }
        elseif($cat_info->type == '2')
        {
            $all_items = $this->gerecht_m->get_all();
        }

        $linked_plugins = $this->menucatlinks_m->get_all_items($cat_id);

        foreach ($linked_plugins as $link) {
            array_push($arr_linked, $link->type .'_'. $link->item_id);
        }


        if ($_POST) {
            foreach ($all_items as $key=>$items) {
                if (isset($_POST['checkeditem_'.$cat_info->type.'_'.$key]))
                {
                    if ($_POST['checkeditem_'.$cat_info->type.'_'.$key] == '1') {
                        if (!in_array($cat_info->type.'_'.$key, $arr_linked))
                        {
                            //toevoegen
                            $volgorde = $this->menucatlinks_m->get_max_volgorde($cat_id);
                            $volgorde = $volgorde + 1;
                            $data['cat_id'] = $cat_id;
                            $data['item_id'] = $key;
                            $data['type'] = $cat_info->type;
                            $data['volgorde'] = $volgorde;
                            $this->menucatlinks_m->save($data, NULL);

                        }
                    }
                }
                else
                {
                    if (in_array($cat_info->type.'_'.$key, $arr_linked)) {
                        //verwijderen
                        $this->menucatlinks_m->delete_link($cat_id, $key);
                    }
                }
            }

            redirect('admin/menu/menucat/index/' . $cat_id);
        }
        else
        {
            $this->data['linked'] = $arr_linked;
            $this->data['all_items'] = $all_items;
            $this->data['cat_info'] = $cat_info;

            $this->data['subview'] = 'admin/menu/menucat/items_edit';
            $this->load->view('admin/_layout_main', $this->data);
        }
    }
}