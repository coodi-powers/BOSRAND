<?php


$videos = $this->video_m->get();

$plugin_body .= '

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center">Vind hier onze video\'s van de uitstapjes!</h2>
        </div>';

foreach ($videos as $video)
{
    $plugin_body .= '
    <div class="col-md-12">
            <h2 class="video_titel">'.$video->titel_nl.'</h2>
            <iframe width="560" height="315" src="'.$video->link.'" frameborder="0" allowfullscreen></iframe>
        </div>
    ';
}

$plugin_body .= '
    </div>
</div>
';