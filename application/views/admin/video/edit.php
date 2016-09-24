
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-7">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo empty($video->id) ? 'Toevoegen' : 'Beerken ' . $video->naam; ?></h5>
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
                            <label class="col-md-2 control-label" for="videoname">Naam:</label>
                            <div class="col-md-10">
                                <?php echo form_input('naam', set_value('naam', $video->naam)); ?>
                            </div>
                        </div> <!-- formrow -->

                        <div class="form-group ">
                            <label class="col-md-2 control-label" for="titel">Titel:</label>
                            <div class="col-md-10">
                                <?php echo form_input('titel_nl', set_value('titel_nl', $video->titel_nl)); ?>
                            </div>
                        </div> <!-- formrow -->

                        <div class="form-group ">
                            <label class="col-md-2 control-label" for="titel">Link:</label>
                            <div class="col-md-10">
                                <?php echo form_input('link', set_value('link', $video->link)); ?>
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
