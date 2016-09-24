<?php
/**
 * Created by PhpStorm.
 * User: bartbollen
 * Date: 2/08/16
 * Time: 21:59
 */


foreach ($arr_items as $key=>$child_name)
{
    $item = $this->menucat_m->get($key);
    $anchor = strtolower($child_name);
    $anchor = str_replace(' ', '-', $anchor);


    //MEERDERE PRIJZEN VOOR WIJNEN
    $multi_price = 0;
    if($key == '18')
    {
        $multi_price = 1;
    }

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
  <section class="module wijn-module">
    <div class="container">

      <div class="row wow fadeIn">

        <div class="col-sm-6">
    ';

    $aantal = count($arr_dranken[$key]);
    $aantal_kolom_1 = $aantal / 2;
    $counter = 0;

    foreach ($arr_dranken[$key] as $drank)
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
                <h4 class="menu-title">'.$drank->titel_nl.'</h4>';

        if($drank->subtext_nl != '')
        {
            echo '
            <div class="menu-detail">'.$drank->subtext_nl.' </div>
            ';
        }

        echo '
              </div>
              <div class="col-sm-4 menu-price-detail">';

        $prijs = '€ '.number_format($drank->prijs, 2, ',', ' ');
        if($drank->prijs == 0)
        {
            $prijs = '-';
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
            </div>
        </div><!-- .row -->
        
        <div class="row wow fadeIn">';


    if($arr_child_items[$key] != 'no-children')
    {
        foreach ($arr_child_items[$key] as $child_key=>$child_item)
        {
            echo '<div class="col-sm-12">';
            echo '<h3>'.$child_item.'</h3><hr>';
            echo '</div>';

            $aantal = count($arr_dranken[$child_key]);
            $aantal_kolom_1 = $aantal / 2;
            $counter = 0;

            if($multi_price != 1)
            {
                echo '<div class="col-sm-6">';

                foreach ($arr_dranken[$child_key] as $drank)
                {
                    if(($counter >= $aantal_kolom_1))
                    {
                        echo '</div><div class="col-sm-6">';
                        $counter = 0;
                    }

                    echo '
                    <div class="menu">
                        <div class="row">
                          <div class="col-sm-8">
                            <h4 class="menu-title">'.$drank->titel_nl.'</h4>';

                    if($drank->subtext_nl != '')
                    {
                        echo '
                                <div class="menu-detail">'.$drank->subtext_nl.' </div>
                                ';
                    }

                    echo '
                          </div>
                          <div class="col-sm-4 menu-price-detail">';

                    $prijs = '€ '.number_format($drank->prijs, 2, ',', ' ');
                    if($drank->prijs == 0)
                    {
                        $prijs = '-';
                    }
                    echo '
                            <h4 class="menu-price">'.$prijs.'</h4>
                          </div>
                        </div>
                      </div>
                    ';

                    $counter++;
                }
            }
            else
            {
                echo '
                <div class="wijn-large-heading">
                    <div class="col-md-2 col-md-offset-6">
                      Glas
                    </div>
                    <div class="col-md-2">
                      0,5 liter
                    </div>
                    <div class="col-md-2">
                      Fles
                    </div>
                </div>
        
                <div class="col-sm-12">';

                foreach ($arr_dranken[$child_key] as $drank)
                {
                    echo '
                    <div class="menu">
                        <div class="row">
                          <div class="col-sm-6">
                            <h4 class="menu-title">'.$drank->titel_nl.'</h4>';

                    if($drank->subtext_nl != '')
                    {
                        echo '
                                <div class="menu-detail">'.$drank->subtext_nl.' </div>
                                ';
                    }

                    echo '
                          </div>
                          <div class="col-md-2">';

                    $prijs = '€ '.number_format($drank->prijs, 2, ',', ' ');
                    if($drank->prijs == 0)
                    {
                        $prijs = '-';
                    }

                    echo '
                            <h4 class="menu-price"><div class="wijn-small-heading">Glas: </div>'.$prijs.'</h4>
                          </div>
                          <div class="col-md-2">';
                    $prijs2 = '€ '.number_format($drank->prijs_2, 2, ',', ' ');
                    if($drank->prijs_2 == 0)
                    {
                        $prijs2 = '-';
                    }

                    echo '
                            <h4 class="menu-price"><div class="wijn-small-heading">0,5 Liter: </div>'.$prijs2.'</h4>
                          </div>
                          <div class="col-md-2">';
                    $prijs3 = '€ '.number_format($drank->prijs_3, 2, ',', ' ');
                    if($drank->prijs_3 == 0)
                    {
                        $prijs3 = '-';
                    }

                    echo '
                            <h4 class="menu-price"><div class="wijn-small-heading">Fles: </div>'.$prijs3.'</h4>
                          </div>
                        </div>
                      </div>
                    ';

                    $counter++;
                }
            }
            echo '</div>';
        }
    }

    echo '
            </div>
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