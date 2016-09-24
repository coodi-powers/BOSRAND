<!-- Footer Section -->
<footer id="footer">
    <div class="container inner">
        <div class="row">


            <div class="col-md-4 col-sm-6 inner">
                <h3 class="section-subheading">Wie zijn we? <span>M</span></h3>
                <p>De plaats bij uitstek voor een pauze tijdens uw wandeling of fietstocht! Geniet van een drankje, hapje of ijsje. Voor wie wat meer wil, is er onze uitgebreide menukaart. U bent van harte welkom!</p>
            </div><!-- /.col -->

            <div class="col-md-4 col-sm-6 inner">
                <h3 class="section-subheading">Openingsuren <span>X</span></h3>
                <p><em>Maandag &ndash; Woensdag</em>&nbsp;&nbsp;<strong>10 u &ndash; ...</strong></p>
                <p><em>Vrijdag</em>&nbsp;&nbsp;<strong>11 u &ndash; ...</strong></p>
                <p><em>Zaterdag &ndash; Zondag</em>&nbsp;&nbsp;<strong>10 u &ndash; ...</strong></p><br>
                <p><em>Donderdag is onze sluitingsdag!<br>De keuken is dagelijks open tot 21u!</em></p>
            </div><!-- /.col -->

            <div class="col-md-4 col-sm-6 inner">
                <h3 class="section-subheading">Contacteer! <span>V</span></h3>
                <p>Zavelberg 12A <br>
                    3980 Tessenderlo <br>
                    Tel: 013 551 339 <br>
                    Gsm: 0476 922 137 <br>
                    <a href="mailto:info@debosrand.be">info@debosrand.be</a> <br>
                    BTW BE0 808 725 424</p>
            </div><!-- /.col -->



        </div><!-- /.row -->
    </div><!-- .container -->

    <div class="footer-bottom">
        <div class="container inner">
            <p class="pull-center">Copyright &copy; 2016 Designed by <a href="http://coodi.be/" target="_blank">COODI</a></p>
        </div><!-- .container -->
    </div><!-- .footer-bottom -->
</footer><!-- footer -->
<!-- End Footer Section -->


<div class="scroll-up">
    <a class="page-scroll" href="index.html#header"><i class="fa fa-angle-double-up"></i></a>
</div>

<!-- jQuery Version 1.12.4 -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script>

<!-- jQuery Easing -->
<script src="<?php echo base_url('assets/js/plugins/jquery.easing.1.3.min.js'); ?>"></script>

<!-- WOW plugin (used for animated sections) -->
<script src="<?php echo base_url('assets/js/plugins/wow.min.js'); ?>"></script>

<!-- jQuery Bootstrap Validation for Booking Form -->
<script src="<?php echo base_url('assets/js/plugins/jqBootstrapValidation.js'); ?>"></script>

<!-- Google Maps -->
<script src="http://maps.google.com/maps/api/js?sensor=true"></script>

<!-- Your Custom JavaScript -->
<script src="<?php echo base_url('assets/js/custom.js'); ?>"></script>

<script type="text/javascript" src="<?php echo base_url('assets/fancybox/jquery.fancybox.pack.js'); ?>"></script>

<!-- Only run this JS on this page -->
<script>
    $(document).scroll( function() {
        "use strict";
        // Add and remove the navbar-shrink class for fixed navigation on page scroll
        if ( $(this).scrollTop()>=$('header').position().top ) {
            $('nav').addClass('navbar-shrink');
        }

        if ( $(window).scrollTop() < $('header').height() + 1 ) {
            $('nav').removeClass('navbar-shrink');
        }
        if ( $('nav').hasClass('navbar-shrink') ) {
            $('body').addClass('navbar-shrink-margin');
        }
        else {
            $('body').removeClass('navbar-shrink-margin');
        }
    });
</script>

<?php echo $extra_js; ?>

</body>
</html>