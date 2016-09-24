
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-7">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo empty($service->id) ? 'Toevoegen' : 'Beerken ' . $service->naam; ?></h5>
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
                            <label class="col-md-2 control-label" for="servicename">Naam:</label>
                            <div class="col-md-10">
                                <?php echo form_input('naam', set_value('naam', $service->naam)); ?>
                            </div>
                        </div> <!-- formrow -->

                        <div class="form-group ">
                            <label class="col-md-2 control-label" for="titel">Titel:</label>
                            <div class="col-md-10">
                                <?php echo form_input('titel', set_value('titel', $service->titel)); ?>
                            </div>
                        </div> <!-- formrow -->

                        <div class="form-group ">
                            <label class="col-md-2 control-label" for="inhoud">Inhoud:</label>
                            <div class="col-md-10">
                                <?php echo $this->ckeditor->editor("inhoud",$service->inhoud); ?>
                            </div>
                        </div> <!-- formrow -->


                    <hr>
                    <h2>Services</h2>
                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="titel_1">Titel 1:</label>
                        <div class="col-md-10">
                            <?php echo form_input('titel_1', set_value('titel_1', $service->titel_1)); ?>
                        </div>
                    </div> <!-- formrow -->
                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="link_1">Link 1:</label>
                        <div class="col-md-10">
                            <?php echo form_input('link_1', set_value('link_1', $service->link_1)); ?>
                        </div>
                    </div> <!-- formrow -->
                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="naam">Afbeelding:</label>
                        <div class="col-md-10">
                            <div class="input-group m-b">
                                <span class="input-group-btn"><button type="button" class="btn btn-primary" onclick="BrowseServer('Images:/','afbeelding_1');">Selecteer</button></span>
                                <?php echo form_input('afbeelding_1', set_value('afbeelding_1', $service->afbeelding_1)); ?>
                            </div>
                        </div>
                    </div> <!-- formrow -->
                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="inhoud_1">Inhoud 1:</label>
                        <div class="col-md-10">
                            <?php echo form_textarea('inhoud_1', set_value('inhoud_1', $service->inhoud_1)); ?>
                        </div>
                    </div> <!-- formrow -->
                    <hr>

                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="titel_2">Titel 2:</label>
                        <div class="col-md-10">
                            <?php echo form_input('titel_2', set_value('titel_2', $service->titel_2)); ?>
                        </div>
                    </div> <!-- formrow -->
                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="link_2">Link 2:</label>
                        <div class="col-md-10">
                            <?php echo form_input('link_2', set_value('link_2', $service->link_2)); ?>
                        </div>
                    </div> <!-- formrow -->
                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="naam">Afbeelding:</label>
                        <div class="col-md-10">
                            <div class="input-group m-b">
                                <span class="input-group-btn"><button type="button" class="btn btn-primary" onclick="BrowseServer('Images:/','afbeelding_2');">Selecteer</button></span>
                                <?php echo form_input('afbeelding_2', set_value('afbeelding_2', $service->afbeelding_2)); ?>
                            </div>
                        </div>
                    </div> <!-- formrow -->
                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="inhoud_2">Inhoud 2:</label>
                        <div class="col-md-10">
                            <?php echo form_textarea('inhoud_2', set_value('inhoud_2', $service->inhoud_2)); ?>
                        </div>
                    </div> <!-- formrow -->
                    <hr>


                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="titel_3">Titel 3:</label>
                        <div class="col-md-10">
                            <?php echo form_input('titel_3', set_value('titel_3', $service->titel_3)); ?>
                        </div>
                    </div> <!-- formrow -->
                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="link_3">Link 3:</label>
                        <div class="col-md-10">
                            <?php echo form_input('link_3', set_value('link_3', $service->link_3)); ?>
                        </div>
                    </div> <!-- formrow -->
                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="naam">Afbeelding:</label>
                        <div class="col-md-10">
                            <div class="input-group m-b">
                                <span class="input-group-btn"><button type="button" class="btn btn-primary" onclick="BrowseServer('Images:/','afbeelding_3');">Selecteer</button></span>
                                <?php echo form_input('afbeelding_3', set_value('afbeelding_3', $service->afbeelding_3)); ?>
                            </div>
                        </div>
                    </div> <!-- formrow -->
                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="inhoud_3">Inhoud 3:</label>
                        <div class="col-md-10">
                            <?php echo form_textarea('inhoud_3', set_value('inhoud_3', $service->inhoud_3)); ?>
                        </div>
                    </div> <!-- formrow -->
                    <hr>


                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="titel_4">Titel 4:</label>
                        <div class="col-md-10">
                            <?php echo form_input('titel_4', set_value('titel_4', $service->titel_4)); ?>
                        </div>
                    </div> <!-- formrow -->
                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="link_4">Link 4:</label>
                        <div class="col-md-10">
                            <?php echo form_input('link_4', set_value('link_4', $service->link_4)); ?>
                        </div>
                    </div> <!-- formrow -->
                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="naam">Afbeelding:</label>
                        <div class="col-md-10">
                            <div class="input-group m-b">
                                <span class="input-group-btn"><button type="button" class="btn btn-primary" onclick="BrowseServer('Images:/','afbeelding_4');">Selecteer</button></span>
                                <?php echo form_input('afbeelding_4', set_value('afbeelding_4', $service->afbeelding_4)); ?>
                            </div>
                        </div>
                    </div> <!-- formrow -->
                    <div class="form-group ">
                        <label class="col-md-2 control-label" for="inhoud_4">Inhoud 4:</label>
                        <div class="col-md-10">
                            <?php echo form_textarea('inhoud_4', set_value('inhoud_4', $service->inhoud_4)); ?>
                        </div>
                    </div> <!-- formrow -->
                    <hr>




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
