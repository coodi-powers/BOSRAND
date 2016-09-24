

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo empty($gerecht->id) ? 'Toevoegen' : 'Wijzigen ' . $gerecht->naam; ?></h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <?php
                    $attributes = array('class' => 'form-horizontal');
                    echo form_open('', $attributes); ?>

                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="naam_vader">Naam:</label>
                        <div class="col-md-10">
                            <?php echo form_input('naam', set_value('naam', $gerecht->naam, '', FALSE)); ?>
                        </div>
                    </div> <!-- formrow -->

                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="naam_vader">Titel:</label>
                        <div class="col-md-10">
                            <?php echo form_input('titel_nl', set_value('titel_nl', $gerecht->titel_nl, '', FALSE)); ?>
                        </div>
                    </div> <!-- formrow -->

                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="tekst">Subtext:</label>
                        <div class="col-md-10">
                            <?php echo form_textarea('subtext_nl', set_value('subtext_nl', $gerecht->subtext_nl, '', FALSE)); ?>
                        </div>
                    </div> <!-- formrow -->


                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="naam_moeder">Prijs:</label>
                        <div class="col-md-10">
                            <?php echo form_input('prijs', set_value('prijs', $gerecht->prijs)); ?>
                        </div>
                    </div> <!-- formrow -->



                    <div class="form-group">
                        <div class=" col-lg-12">
                            <button class="btn btn-success  dim" type="submit" name="submit_form" id="submit_form">
                                <i class="fa fa-check"></i>&nbsp;Bewaren
                            </button>
                        </div>
                    </div>

                    <!-- submitknop -->
                    <?php echo form_close();?>
                </div>
            </div>
        </div><!-- end col -->
    </div><!-- end row -->
</div><!-- end wrapper -->
