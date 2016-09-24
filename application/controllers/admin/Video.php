<?php
/**
 * Created by PhpStorm.
 * User: bartbollen
 * Date: 25/04/15
 * Time: 19:44
 */

class Video extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->data['submenu'] = '';
        $this->data['title'] = 'Videos';
        $this->load->model('video_m');
        $this->data['page_title'] = 'videos';
    }

    public function index()
    {

        //extra js
        $this->data['extra_js'] .= '
        <script src=\''.base_url('assets_admin/js/plugins/nestable/jquery.nestable.js') .'\'></script>
        <script>
            $(document).ready(function(){
        
                var updateOutput = function(e)
                {
                    var list   = e.length ? e : $(e.target),
                        output = list.data(\'output\');
                    if (window.JSON) {
                        $.post( \''.base_url('index.php/admin/video/volgorde_videos').'\', { testvalue: (window.JSON.stringify(list.nestable(\'serialize\'))) });
                    } else {
                        output.val(\'JSON browser support required for this demo.\');
                    }
                };
        
                // activate Nestable for list 
                $(\'#nestable\').nestable().on(\'change\', updateOutput);
        
                updateOutput($(\'#nestable\').data(\'output\', $(\'#nestable-output\')));
        
                });
        
        </script>
        ';
        $this->data['structure'] = $this->getStructure();
        $this->data['subview'] = 'admin/video/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function edit($id = NULL)
    {
        // fetch a video or set a new one
        if ($id) {
            $this->data['video'] = $this->video_m->get($id);
            if(count($this->data['video']) == NULL)
            {
                $this->data['errors'] = 'video werd niet gevonden';
            }
        }
        else {
            $this->data['video'] = $this->video_m->get_new();
        }



        if($_POST)
        {
            $data = $this->video_m->array_from_post(array('naam', 'titel_nl', 'link'));

            $this->video_m->save($data, $id);
            redirect('admin/video');
        }

        //load the form
        $this->data['subview'] = 'admin/video/edit';
        $this->load->view('admin/_layout_main', $this->data);


    }

    public function getStructure()
    {
        $arr_videos = $this->video_m->get_all();
        $body = '';

        foreach ($arr_videos as $id=>$video)
        {
            if($id > 0)
            {
                $body .= '
                <li class="dd-item dd-nodrag" data-id="'.$id.'">
                    <div class="dd-handle dd-nodrag"  style="overflow: hidden;">
                        <div class="drag-button dd-handle"><i class="fa fa-arrows-v dd-handle padding-zero" ></i></div>
                        <div class="col-xs-5">'.$video.'</div>
                        <span class="pull-right">
                            <a href="'.anchor('admin/video/delete/'.$id, '').'"><span class="label label-danger pull-right"><i class="fa fa-times"></i></span></a>
                            <a href="'.anchor('admin/video/edit/'. $id, '').'"><span class="label label-warning pull-right"><i class="fa fa-pencil"></i></span></a>
                        </span>
                    </div>
                </li>
            ';
            }
        }

        return $body;
    }

    public function modal()
    {
        $this->load->view('admin/_layout_modal', $this->data);
    }

    public function volgorde_videos()
    {
        $json = $_POST['testvalue'];
        $json_decode = json_decode($json);

        $this->decode($json_decode);
    }

    //volgorde uitlezen
    public function decode($items)
    {
        $volgorde_root = 1;
        foreach($items as $item)
        {
            $this->video_m->save_order($item->id, $volgorde_root);
            $volgorde_root ++;
        }
    }

    public function delete($id)
    {
        $this->video_m->delete($id);
        redirect('admin/video');
    }
}