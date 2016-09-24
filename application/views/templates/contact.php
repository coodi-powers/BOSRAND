
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h3 class="section-contact">Contacteer ons! <span>V</span></h3>
            <p>Zavelberg 12A <br>
                3980 Tessenderlo <br>
                Tel: 013 551 339 <br>
                Gsm: 0476 922 137 <br>
                E-mail : <a href="mailto:info@debosrand.be">info@debosrand.be</a> <br>
                BTW BE0 808 725 424</p>
        </div>
        <div class="col-md-6">
            <div class="well bs-component">
                <?php
                $attributes = array('class' => 'form-horizontal');
                echo form_open('', $attributes); ?>

                    <?php

                    if($succes_messages != '')
                    {
                        echo '<div class="alert alert-success" role="alert">'.$succes_messages.'</div>';
                    }
                    if($error_messages != '')
                    {
                        echo '<div class="alert alert-danger" role="alert">'.$error_messages.'</div>';
                    }

                    ?>
                    <fieldset>
                        <legend><h3 class="lead text-center"> Stel uw vraag!</h3></legend>
                        <div class="form-group">
                            <label for="inputName" class="col-lg-2 control-label">Naam</label>
                            <div class="col-lg-10">
                                <input type="text" name="naam" class="form-control" required>
                                <input type="hidden" name="middelnaam" name="middelnaam">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail" class="col-lg-2 control-label">E-mail</label>
                            <div class="col-lg-10">
                                <input type="email" name="email" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="textArea" class="col-lg-2 control-label">Onderwerp</label>
                            <div class="col-lg-10">
                                <input type="text" name="onderwerp" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="InputMessage" class="col-lg-2 control-label">Bericht</label>
                            <div class="col-lg-10">
                                <textarea name="bericht" class="form-control" rows="7" required></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-10 col-lg-offset-2">
                                <button type="submit" class="btn btn-primary btn-lg">Verzenden</button>
                            </div>
                        </div>
                    </fieldset>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>