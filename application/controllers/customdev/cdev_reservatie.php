<?php

$succes_messages = '';
$error_messages = '';

if($_POST)
{

    if(($_POST['middelnaam'] == '') && ($_POST['voornaam'] != '') && ($_POST['achternaam'] != '') && ($_POST['email'] != '') && ($_POST['telefoon'] != '') && ($_POST['datum'] != '')
        && ($_POST['tijd'] != '')&& ($_POST['datum_alt'] != '')&& ($_POST['gasten'] != ''))
    {
        $reply = $_POST['email'];
        if($reply == '')
        {
            $reply = 'bartbollen@telent.be';
        }
        $to      = 'info@debosrand.be';
        $subject = 'Reservatie via website';
        $message = '
                                    Naam: '.htmlspecialchars($_POST['voornaam']).' '.htmlspecialchars($_POST['achternaam']).'<br>
                                    E-mail: '.htmlspecialchars($_POST['email']).'<br>
                                    Telefoon : '.htmlspecialchars($_POST['telefoon']).'<br>
                                    Datum: '.htmlspecialchars($_POST['datum']).'<br>
                                    Uur: '.htmlspecialchars($_POST['tijd']).'<br>
                                    Datum alternatief: '.htmlspecialchars($_POST['datum_alt']).'<br>
                                    Aantal gasten: '.htmlspecialchars($_POST['gasten']).'<br>';
        $headers = 'From:'.htmlspecialchars($_POST['email']) ."\r\n" .
            'Reply-To: info@debosrand.be'. "\r\n" .
            'Content-Type: text/html; charset=ISO-8859-1' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message, $headers);

        $succes_messages = 'Uw bericht werd succesvol verzonden.';
    }
    else
    {
        $error_messages = 'Uw bericht werd niet verzonden omdat niet alle velden zijn ingevuld.';
    }
}


$plugin_body .= '
                    <!-- Book Section -->
                    <section id="book">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <h2 class="section-heading wow fadeInDown">Reserveer een tafel</h2>
                                    <h3 class="section-subheading wow fadeInDown">
                                        Vertel ons uw naam, ter gelegenheid van uw bezoek, en hoeveel er aanwezig zullen zijn...</h3>
                                </div>
                            </div><!-- /.row -->
                            <div class="row">
                                <div class="col-md-6 col-md-offset-3 wow fadeInUp signup_form">';

                if($succes_messages != '')
                {
                    $plugin_body .= '<div class="alert alert-success" role="alert">'.$succes_messages.'</div>';
                }
                if($error_messages != '')
                {
                    $plugin_body .= '<div class="alert alert-danger" role="alert">'.$error_messages.'</div>';
                }

                $attributes = array('class' => 'form form-table text-center', 'id'=>'bookform');
                $plugin_body .= form_open('', $attributes);
                $plugin_body .= '
                                        <h4>Alle velden zijn verplicht.</h4>
                                        <div class="row">
                                          <div class="col-lg-6 col-md-6 form-group">
                                            <label class="sr-only" for="first_name1">Voornaam</label>
                                            <input class="form-control hint" type="text" id="voornaam" name="voornaam" placeholder="Voornaam" required data-validation-required-message="Please enter your first name.">
                                            <input type="hidden" name="middelnaam" name="middelnaam">
                                            <p class="help-block text-danger"></p>
                                          </div>
                                          <div class="col-lg-6 col-md-6 form-group">
                                            <label class="sr-only" for="last_name1">Naam</label>
                                            <input class="form-control hint" type="text" id="achternaam" name="achternaam" placeholder="Naam" required data-validation-required-message="Please enter your last name.">
                                            <p class="help-block text-danger"></p>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-lg-6 col-md-6 form-group">
                                            <label class="sr-only" for="email1">E-mail</label>
                                            <input class="form-control hint" type="email" id="email1" name="email" placeholder="E-mail" required data-validation-required-message="Please enter your email address.">
                                            <p class="help-block text-danger"></p>
                                          </div>
                                          <div class="col-lg-6 col-md-6 form-group">
                                            <label class="sr-only" for="phone1">Telefoon</label>
                                            <input class="form-control hint" type="text" id="telefoon" name="telefoon" placeholder="Telefoonnummer" required data-validation-required-message="Please enter your phone number.">
                                            <p class="help-block text-danger"></p>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-lg-6 col-md-6 form-group">
                                            <label class="sr-only" for="reserv_date1">Reservatie datum</label>
                                            <input class="form-control datepicker hasDatepicker hint" type="text" id="datum" name="datum" placeholder="Reservatie datum" required data-validation-required-message="Please enter your reservation date.">
                                            <p class="help-block text-danger"></p>
                                          </div>
                                          <div class="col-lg-6 col-md-6 form-group">
                                            <label class="sr-only" for="numb_guests1">Aantal gasten</label>
                                            <input class="form-control hint" type="text" id="gasten" name="gasten" placeholder="Aantal gasten" required data-validation-required-message="Please enter number of guests.">
                                            <p class="help-block text-danger"></p>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-lg-6 col-md-6 form-group">
                                            <label class="sr-only" for="alt_reserv_date1">Alternatieve datum</label>
                                            <input class="form-control datepicker hasDatepicker hint" type="text" id="datum_alt" name="datum_alt" placeholder="Alternatieve datum" required data-validation-required-message="Please enter your alternate reservation date.">
                                            <p class="help-block text-danger"></p>
                                          </div>
                                          <div class="col-lg-6 col-md-6 form-group">
                                            <label class="sr-only" for="time1">Uur</label>
                                            <input class="form-control timepicker ui-timepicker-input hint" type="text" id="tijd" name="tijd" placeholder="Uur" required="" autocomplete="off" data-validation-required-message="Please enter your arrival time.">
                                            <p class="help-block text-danger"></p>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-lg-12 col-md-12">
                                            <p><strong>Vanaf 10 personen beperkte keuzen tussen 4 verschillende gerechten! <br>
                                            Voor feestjes neem persoonlijk contact op!</strong></p>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-lg-12 col-md-12">
                                            <div id="success"></div>
                                            <button type="submit" class="btn btn-lg btn-primary">Verzenden</button>
                                          </div>
                                        </div>
                                      </form>
                                </div>
                            </div><!-- /.row -->
                        </div><!-- /.container -->
                    </section>
                    <!-- End Book Section -->
                    ';