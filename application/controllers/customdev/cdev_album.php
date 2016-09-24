<?php

$plugin_body .= '
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center">Bekijk onze fotogallerij</h2>
        </div>';





        $dir = './assets_admin/ckfinder/userfiles/images/ALBUMS/';
        $arr_albums = array();

        if ($handle = opendir($dir)) {

            while (false !== ($entry = readdir($handle))) {

                if ($entry != "." && $entry != "..") {

                    array_push($arr_albums, $entry);
                }
            }

            closedir($handle);
        }

        asort($arr_albums);

        foreach ($arr_albums as $album)
        {
            $dir = './assets_admin/ckfinder/userfiles/images/ALBUMS/'.$album.'/';
            $arr_album[$album] = array();

            if ($handle = opendir($dir)) {

                while (false !== ($entry = readdir($handle))) {

                    if ($entry != "." && $entry != "..") {
                        array_push($arr_album[$album], $entry);
                    }
                }

                closedir($handle);
            }

            asort($arr_album[$album]);

        }


        foreach ($arr_album as $naam=>$album)
        {
            $teller = 0;
            foreach ($album as $item)
            {
                $link = '/public_html/assets_admin/ckfinder/userfiles/images/ALBUMS/'.$naam.'/'.$item;
                if($teller == 0)
                {
                    $plugin_body .= '
                    <div class="col-md-3">
                        <div class="thumbnail">
                            <a rel="'.$naam.'" href="'.$link.'"><img src="'.$link.'" alt=""/></a>
                        </div>
                    </div>
                    ';
                }
                else
                {
                    $plugin_body .= '
                    <a class="hidden" rel="'.$naam.'" href="'.$link.'"><img src="'.$link.'" alt=""/></a>';
                }
                $teller++;
            }

            $this->data['extra_js'] .= '
            <script>
            $(document).ready(function() {
            
                $("a[rel='.$naam.']").fancybox({
                    \'transitionIn\'		: \'none\',
                    \'transitionOut\'		: \'none\',
                    \'titlePosition\' 	: \'over\',
                    \'titleFormat\'		: function(title, currentArray, currentIndex, currentOpts) {
                        return \'<span id="fancybox-title-over">Image \' + (currentIndex + 1) + \' / \' + currentArray.length + (title.length ? \' &nbsp; \' + title : \'\') + \'</span>\';
                    }
                });
            
            });
            
            </script>
            ';
        }
    



$plugin_body .= '
    </div>
</div>';



