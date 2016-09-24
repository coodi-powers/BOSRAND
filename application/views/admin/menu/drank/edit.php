

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo empty($drank->id) ? 'Toevoegen' : 'Wijzigen ' . $drank->naam; ?></h5>
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
                            <?php echo form_input('naam', set_value('naam', $drank->naam, '', FALSE)); ?>
                        </div>
                    </div> <!-- formrow -->

                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="naam_vader">Titel:</label>
                        <div class="col-md-10">
                            <?php echo form_input('titel_nl', set_value('titel_nl', $drank->titel_nl, '', FALSE)); ?>
                        </div>
                    </div> <!-- formrow -->

                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="tekst">Subtext:</label>
                        <div class="col-md-10">
                            <?php echo form_textarea('subtext_nl', set_value('subtext_nl', $drank->subtext_nl, '', FALSE)); ?>
                        </div>
                    </div> <!-- formrow -->


                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="naam_moeder">Prijs:</label>
                        <div class="col-md-10">
                            <?php echo form_input('prijs', set_value('prijs', $drank->prijs)); ?>
                        </div>
                    </div> <!-- formrow -->

                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="naam_moeder">Prijs 2:</label>
                        <div class="col-md-10">
                            <?php echo form_input('prijs_2', set_value('prijs_2', $drank->prijs_2)); ?>
                        </div>
                    </div> <!-- formrow -->

                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="naam_moeder">Prijs 3:</label>
                        <div class="col-md-10">
                            <?php echo form_input('prijs_3', set_value('prijs_3', $drank->prijs_3)); ?>
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

<script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace( 'beschrijving' );
</script>
