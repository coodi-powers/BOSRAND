<?php
/**
 * Created by PhpStorm.
 * User: bartbollen
 * Date: 2/08/16
 * Time: 21:59
 */


foreach ($arr_items as $child_key=>$child_name)
{
    $item = $this->menucat_m->get($child_key);
    $anchor = strtolower($child_name);
    $anchor = str_replace(' ', '-', $anchor);

    echo  '
    <section id="'.$anchor.'" class="callout wow fadeIn" style="background-image: url(\''.$item->afbeelding.'\');">
    <div class="container">

      <div class="row">
        <div class="col-sm-10 col-sm-offset-1">
          <h2 class="section-heading wow fadeInDown">'.$item->titel_nl.'</h2>
        </div>
      </div><!-- .row -->

    </div><!-- .container -->
  </section>
    ';

    echo '
    <!-- Menu start -->

  <section class="module">
    <div class="container">

      <div class="row wow fadeIn">';

    if($item->intro_nl != '')
    {
        echo '<h4 class="menu-text text-center">'.$item->intro_nl.'</h4>';
    }

    echo '

        <div class="col-sm-6">
    ';

    $aantal = count($arr_gerechten[$child_key]);
    $aantal_kolom_1 = $aantal / 2;
    $counter = 0;

    foreach ($arr_gerechten[$child_key] as $gerecht)
    {
        if($counter >= $aantal_kolom_1)
        {
            echo '</div><div class="col-sm-6">';
            $counter = 0;
        }

        echo '
        <div class="menu">
            <div class="row">
              <div class="col-sm-8">
                <h4 class="menu-title">'.$gerecht->titel_nl.'</h4>';

        if($gerecht->subtext_nl != '')
        {
            echo '
            <div class="menu-detail">'.$gerecht->subtext_nl.' </div>
            ';
        }

        echo '
              </div>
              <div class="col-sm-4 menu-price-detail">';

        $prijs = '€ '.number_format($gerecht->prijs, 2, ',', ' ');
        if($gerecht->prijs == 0)
        {
            $prijs = 'Dagprijs';
        }

        echo '
                <h4 class="menu-price">'.$prijs.'</h4>
              </div>
            </div>
          </div>
        ';

        $counter++;
    }

    echo '
            </div>';

    if($item->inhoud_nl != '')
    {
        echo '<div class="col-md-12"><h4 class="menu-text text-center">'.$item->inhoud_nl.'</h4></div> ';
    }

    echo '
        </div><!-- .row -->

      <div class="row text-center">
        <div class="col-sm-6 col-sm-offset-3">
          <span class="section-divider">M</span>
        </div>
      </div><!-- .row -->

    </div><!-- .container -->
  </section>
    ';
}