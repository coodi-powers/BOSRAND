

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-6">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5><?php echo 'Wijzig: ' . $cat_info->naam ; ?></h5>
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
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                            <tr>
                                <th style="width: 1%;">&nbsp;</th>
                                <th>Naam</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php

                            if(count($all_items)): foreach($all_items as $key=>$items): ?>
                                <tr>
                                    <td>
                                        <?php
                                        $checked = FALSE;
                                        if(in_array($cat_info->type.'_'.$key, $linked))
                                        {
                                            $checked = TRUE;
                                        }

                                        echo form_checkbox('checkeditem_'.$cat_info->type.'_'.$key, '1', $checked);

                                        ?>
                                    </td>
                                    <td><?php echo $items; ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="2">Er werden geen items gevonden</td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <div class=" col-lg-12">
                                <button class="btn btn-success  dim" type="submit" name="submit_form" id="submit_form">
                                    <i class="fa fa-check"></i>&nbsp;Bewaren
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close();?>
                </div><!-- END CONTENT -->
            </div>
        </div><!-- end col -->
    </div><!-- end row -->
</div><!-- end wrapper -->

<script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace( 'body' );
</script>
