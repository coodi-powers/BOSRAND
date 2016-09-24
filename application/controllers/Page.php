<?php

class Page extends Frontend_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('page_m');
        $this->load->model('pageplugin_m');
        $this->load->model('menucat_m');
        $this->load->model('menucatlinks_m');
        $this->load->model('customdev_m');
    }

    public function index() {

        // Fetch the page template
        //$this->data['page'] = $this->page_m->get_by_original(array('slug' => (string) $this->uri->segment(1)), TRUE);
        //count($this->data['page']) || show_404(current_url());

        $this->data['error_messages'] = '';
        $this->data['succes_messages'] = '';

        if($this->uri->segment(1) == '')
        {
            $this->data['page'] = $this->page_m->get(1);
        }
        else
        {
            $this->data['page'] = $this->page_m->get_by_original(array('slug' => (string) $this->uri->segment(1)), TRUE);
        }
        count($this->data['page']) || show_404(current_url());

        // Fetch the page data
        $method = '_' . $this->data['page']->template;

        if($method == '_')
        {
            $method = '_page';
        }


        $this->data['homepage'] = $this->page_m->get(1);
        $this->$method($this->data['page']->id);
        $this->data['menu_items_left'] = $this->page_m->get_nested(1, 1);
        $this->data['menu_items_right'] = $this->page_m->get_nested(1, 2);


        $this->data["extra_js"] = '';
        $this->data['plugins'] = $this->getPlugins($this->data['page']->id);

        $this->data["menukaart"] = $this->getMenukaart();


        // Load the view
        $template = $this->data['page']->template;
        if($template == '')
        {
            $template = 'page';
        }
        $this->data['subview'] = $template;
        $this->load->view('_main_layout', $this->data);
    }

    private function _content_right(){
        $title = $this->data['page']->title;
        if($this->data['page']->title2 != '')
        {
            $title = $this->data['page']->title2;
        }
        $content = $this->data['page']->body;
        $afbeelding = $this->data['page']->afbeelding;

        $body = '
        <div class="divide60"></div>
        <div class="container">
            <div class="row">
                <div class="row vertical-align-child">
                    <div class="col-sm-5 hidden-xs center-heading wow animated fadeInUp" data-wow-delay="0.3s">
                        <img src="'.$afbeelding.'" alt="" class="img-responsive">
                    </div>
                    <div class="col-sm-6 col-sm-offset-1 center-heading wow animated fadeInUp" data-wow-delay="0.6s">
                        <h2>'.$title.'</h2>
                        <span class="center-line"></span>
                        <p class="sub-text margin40">
                            '.$content.'
                        <hr>
                    </div>
                </div>
            </div><!--center heading end-->
        </div><!--services container-->
        ';

        $this->data['default_content'] = $body;
    }

    private function getMenukaart($cat_id = 1)
    {
        //Dranken-pagina
        $dranken_pagina = $this->page_m->get(27);
        //Gerechten-pagina
        $gerechten_pagina = $this->page_m->get(28);

        $arr_pages = $this->menucat_m->get_children($cat_id);

        $active = '';
        if($this->data['page']->parent_id == 26)
        {
            $active = 'active';
        }

        $body .= '
        <li class="dropdown '.$active.'">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Menukaart <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
        ';

        foreach ($arr_pages as $key=>$page_name)
        {
            $body .= '
            <li class="dropdown-header">'.$page_name.'</li>';

            if($this->menucat_m->get_children($key) != 'no-children')
            {
                $arr_children = $this->menucat_m->get_children($key);
                foreach ($arr_children as $child_key=>$child_name)
                {
                    $item = $this->menucat_m->get($child_key);

                    $anchor = strtolower($item->naam);
                    $anchor = str_replace(' ', '-', $anchor);

                    if($item->type == '1')
                    {
                        $link = base_url('index.php/'.$dranken_pagina->slug).'#'.$anchor;
                    }
                    elseif($item->type == '2')
                    {
                        $link = base_url('index.php/'.$gerechten_pagina->slug).'#'.$anchor;
                    }
                    $body .= '<li><a class="page-scroll" href="'.$link.'">'.$child_name.'</a></li>';
                }
            }

            $body .= '
                </li>
            ';
        }

        $body .= '</ul></li>';

        return $body;
    }

    private function _dranken()
    {
        $this->load->model('drank_m');
        $key = 4;

        $this->data['arr_items'] = $this->menucat_m->get_children($key);

        foreach ($this->data['arr_items'] as $key=>$item)
        {
            $arr_links = $this->menucatlinks_m->get_all_items($key);
            $this->data['arr_dranken'][$key] = array();
            foreach ($arr_links as $link)
            {
                $drank = $this->drank_m->get($link->item_id);
                array_push($this->data['arr_dranken'][$key], $drank);
            }




            $this->data['arr_child_items'][$key] = $this->menucat_m->get_children($key);
            if($this->data['arr_child_items'][$key] != 'no-children')
            {
                foreach ($this->data['arr_child_items'][$key] as $child_key=>$child_item)
                {
                    $arr_links = $this->menucatlinks_m->get_all_items($child_key);
                    $this->data['arr_dranken'][$child_key] = array();
                    foreach ($arr_links as $link) {
                        $drank = $this->drank_m->get($link->item_id);
                        array_push($this->data['arr_dranken'][$child_key], $drank);
                    }
                }
            }
        }
    }

    private function _gerechten()
    {
        $this->load->model('gerecht_m');
        $key = 5;

        $this->data['arr_items'] = $this->menucat_m->get_children($key);

        foreach ($this->data['arr_items'] as $key=>$item)
        {
            $arr_links = $this->menucatlinks_m->get_all_items($key);
            $this->data['arr_gerechten'][$key] = array();
            foreach ($arr_links as $link)
            {
                $drank = $this->gerecht_m->get($link->item_id);
                array_push($this->data['arr_gerechten'][$key], $drank);
            }
        }
    }

    private function _page(){
        $this->data['left_menu_items'] = $this->page_m->get_pages($this->data['page']->id);

    }

    private function _contact()
    {
        $this->data['page'] = $this->page_m->get_by_original(array('slug' => (string) $this->uri->segment(1)), TRUE);

        if($_POST)
        {

            if(($_POST['middelnaam'] == '') && ($_POST['naam'] != '') && ($_POST['email'] != '') && ($_POST['onderwerp'] != '') && ($_POST['bericht'] != ''))
            {
                $to      = 'info@debosrand.be';
                $subject = 'Bericht via website';
                $message = '
                                    Naam: '.$_POST['naam'].'<br>
                                    E-mail: '.$_POST['email'].'<br>
                                    Onderwerp : '.$_POST['onderwerp'].'<br>
                                    Bericht: '.htmlspecialchars($_POST['bericht']).'<br>';
                $headers = 'From:'. $_POST['naam'] ."\r\n" .
                    'Reply-To:'.$_POST['email'] . "\r\n" .
                    'Content-Type: text/html; charset=ISO-8859-1\r\n' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

                mail($to, $subject, $message, $headers);

                $this->data['succes_messages'] = 'Uw bericht werd succesvol verzonden.';
            }
            else
            {
                $this->data['error_messages'] = 'Uw bericht werd niet verzonden omdat niet alle velden zijn ingevuld.';
            }
        }
    }

    private function _homepage()
    {



    }

    public function sortFunction( $a, $b ) {
        return strtotime($a["datum"]) - strtotime($b["datum"]);
    }

    private function getPlugins()
    {
        $this->load->model('pageplugin_m');
        $this->load->model('sliderbox_m');
        $this->load->model('slideritem_m');

        $plugin_body = '';


        $arr_plugins = $this->pageplugin_m->get_all_page($this->data['page']->id);

        foreach ($arr_plugins as $plugin)
        {
            if($plugin->type_id == '1')
            {
                $plugin_body .= '[[DEFAULT_CONTENT]]';
            }
            //SLIDERS
            if($plugin->type_id == '2')
            {
                $slideritems = $this->sliderbox_m->get_box($plugin->plugin_id);

                $plugin_body .= '
                <!-- begin:slider -->
                <div class="divide80"></div>
                <div class="container">
                <div class="col-md-12">
                    <div class="center-heading wow animated fadeInUp">
                        <h2>Wat <strong>doen we</strong>?</h2>
                        <span class="center-line"></span>
                    </div>
                </div>


                <div class="owl-carousel owl-theme service-slider wow animated fadeInUp">
                
                ';

                foreach ($slideritems as $item)
                {
                    $slideritem = $this->slideritem_m->get($item->item_id);

                    $plugin_body .= '
                         <div class="item">
                        <div class="service-box">
                            <div class="service-thumb">
                                <img src="'.$slideritem->foto.'" alt="" class="img-responsive img-slider">
                            </div>
                            <div class="service-desc">
                                <h4 class="text-uppercase">'.$slideritem->naam.'</h4>
                                <div class="border-width"></div>
                                <p>'.$slideritem->tekst.'</p>
                                <div class="text-right">
                                    <a href="'.$slideritem->link.'" class="btn btn-link">Meer info</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    ';
                }

                $plugin_body .= '
                        </div>
                    </div>
                <!-- end:slider -->';
            }
            if($plugin->type_id == '3')
            {
                $this->load->model('tekst_m');

                $tekst_info = $this->tekst_m->get($plugin->plugin_id);
                $plugin_body .= '
                 <!-- Introduction Section -->
                        <div class="container">
                            <div class="row index_header plugin-tekst-header">
                                <div class="col-lg-12 text-center">
                                    <h1>'.$tekst_info->titel.'</h1>
                                    '.$tekst_info->inhoud.'
                                </div>
                            </div><!-- /.row -->
                        </div><!-- /.container -->';


            }
            if($plugin->type_id == '4')
            {
                $this->load->model('service_m');

                $service_info = $this->service_m->get($plugin->plugin_id);

                $plugin_body .= '
                <!-- Menus Section -->
                <section id="menu">
                    <div id="our-products" class="parallax-section">
                        <div class="overlay-bg"></div>
                        <div class="padding text-center">
                            <div class="container">
                                <div class="row section-title">
                                    <div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                                        <h1>'.$service_info->titel.'</h1>
                                        '.$service_info->inhoud.'
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-sm-6 col-md-3 col-xs-8 col-xs-offset-2 col-sm-offset-0">
                                        <div class="our-product">
                                            <a class="page-scroll" href="'.$service_info->link_1.'"><img class="img-responsive" src="'.$service_info->afbeelding_1.'" alt="" /></a>
                                            <h2>'.$service_info->titel_1.'</h2>
                                            <p>'.$service_info->inhoud_1.'</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3 col-xs-8 col-xs-offset-2 col-sm-offset-0">
                                        <div class="our-product">
                                            <a class="page-scroll" href="'.$service_info->link_2.'"><img class="img-responsive" src="'.$service_info->afbeelding_2.'" alt="" /></a>
                                            <h2>'.$service_info->titel_2.'</h2>
                                            <p>'.$service_info->inhoud_2.'</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3 col-xs-8 col-xs-offset-2 col-sm-offset-0">
                                        <div class="our-product">
                                            <a class="page-scroll" href="'.$service_info->link_3.'"><img class="img-responsive" src="'.$service_info->afbeelding_3.'" alt="" /></a>
                                            <h2>'.$service_info->titel_3.'</h2>
                                            <p>'.$service_info->inhoud_3.'</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3 col-xs-8 col-xs-offset-2 col-sm-offset-0">
                                        <div class="our-product">
                                            <a class="page-scroll" href="'.$service_info->link_4.'"><img class="img-responsive" src="'.$service_info->afbeelding_4.'" alt="" /></a>
                                            <h2>'.$service_info->titel_4.'</h2>
                                            <p>'.$service_info->inhoud_4.'</p>
                                        </div>
                                    </div>
                                </div>
                                <span class="section-divider">M</span>
                            </div>
                        </div>
                    </div><!--/#our-products-->
                </section>
    <!-- End Menus Section -->';
            }
            if($plugin->type_id == '5')
            {
                $customdev = $this->customdev_m->get($plugin->plugin_id);

                //RESERVATIEFORMULIER
                if($customdev->custom_id == '1')
                {
                    include ('customdev/cdev_reservatie.php');
                }

                //VESPA VERHUUR
                if($customdev->custom_id == '2')
                {
                    include ('customdev/cdev_vespa.php');
                }

                //VIDEOS
                if($customdev->custom_id == '3')
                {
                    $this->load->model('video_m');
                    include ('customdev/cdev_videos.php');
                }

                //FOTO ALBUM
                if($customdev->custom_id == '4')
                {
                    include ('customdev/cdev_album.php');
                }
            }

            //BANNERS
            if($plugin->type_id == '6')
            {
                $this->load->model('banner_m');
                
                $banner = $this->banner_m->get($plugin->plugin_id);
                
                $plugin_body .= '
                <!-- Callout section start -->
                  <section id="menu-one" class="callout wow fadeIn"  style="background-image: url(\''.$banner->afbeelding.'\');">
                    <div class="container">
                
                      <div class="row">
                        <div class="col-sm-10 col-sm-offset-1">
                          <h2 class="section-heading wow fadeInDown">'.$banner->titel_nl.'</h2>
                        </div>
                      </div><!-- .row -->
                
                    </div><!-- .container -->
                  </section>
                
                  <!-- Callout section end -->
                ';
            }



        }

        return $plugin_body;
    }
}