<form id="addproductform">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-power-off myclose"></i></button>
        <h4>Edit Store Rack</h4>
    </div>
    <div class="modal-body">
        <?php // print_r($alldepartment); ?>
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label for="productCode" class="control-label">Location<span class="required">*</span></label>
                    <select class="form-control"  required="required" name="location" id="location">
                        <option value="0">-Select a location-</option>
                        <?php foreach ($location AS $sup) { ?>
                            <option value="<?php echo $sup->location_id ?>" <?php if($sup->location_id==$trans->rack_loc){echo 'selected';} ?>><?php echo $sup->location ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="productCode" class="control-label">Rack No <span class="required">*</span></label>
                    <input type="text" class="form-control" required="required" value="<?php echo $trans->rack_no?>"  name="name" id="name">
                </div>
                <div class="form-group">
                    <input type="hidden" value="<?php echo $trans->rack_id?>" name="id" id="id">
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <span id="errProduct1" class="pull-left"></span>
        <button class="btn btn-success btn-flat" id="savepro" type="submit">Save</button>
    </div>
</form>
<script>
    $('.prd_icheck').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '50%'
    });
    
    $('#addproductform').submit(function(e) {
        $('#savepro').attr('disabled', true);
        e.preventDefault();
        $.ajax({
            url: "<?php echo base_url('admin/master/editRack/') ?>",
            type: "POST",
            data: $(this).serializeArray(),
            success: function(data) {
                var newdata = JSON.parse(data);
                var fb = newdata.fb;
                var lastproduct_code = newdata.JobDescNo;

                if (fb) {
                    $('#productmodal').modal('hide');
                    $("#lastProduct").html('');
                    $("#lastProduct").html(lastproduct_code);
                    $('#savepro').attr('disabled', false);
                } else {
                    $("#lastProduct").html('');
                    $('#savepro').attr('disabled', false);
                }
                location.reload();
            }
        });
    });
    
</script>