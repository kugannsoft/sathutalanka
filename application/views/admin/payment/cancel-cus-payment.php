<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="content-wrapper">
    <section class="content-header">
        <?php echo $pagetitle; ?>
        <?php echo $breadcrumb; ?>
    </section>

    <section class="content">
        <div class="box collapse cart-options" id="collapseExample">
            <div class="box-header">Filter Categories</div>
            <div class="box-body categories_dom_wrapper">
            </div>
            <div class="box-footer">
                <button class="btn btn-primary close-item-options pull-right">Hide options</button>
            </div>
        </div>   
        <div class="row">
            <div class="col-lg-12">
                <div class="box box-success">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-md-5">

                                <div class="form-group">
                                    <label for="additional" class="col-sm-5 control-label">Sales Person</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" required="required"  name="newsalesperson" id="newsalesperson" placeholder="sales person">
                                            <option value="">-Select a sales person-</option>
                                            <?php foreach ($salesperson as $trns) { ?>
                                                <option value="<?php echo $trns->RepID; ?>"
                                                    <?php echo ($trns->RepID == $selectedSalespersonID) ? 'selected' : ''; ?>>
                                                    <?php echo $trns->RepName; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="route" class="col-sm-5 control-label">Routes</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="route" id="route" required>
                                            <option value="">-Select a Route-</option>
                                            <?php if (!empty($routes)) {
                                                foreach ($routes as $route) { ?>
                                                    <option value="<?php echo $route->id; ?>"
                                                        <?php echo (isset($selectedRoute) && $route->id == $selectedRoute) ? 'selected' : ''; ?>>
                                                        <?php echo $route->name; ?>
                                                    </option>
                                                <?php }
                                            } ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="customer" class="col-sm-5 control-label">Customer <span class="required">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" autofocus required="required"  name="customer" id="customer" placeholder="Enter Customer">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="customer" class="col-sm-5 control-label">Payment No <span class="required">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" required="required"  name="invoice" id="invoice" placeholder="Enter Payment number">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="invDate" class="col-sm-5 control-label">Cancel Date <span class="required">*</span></label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" required="required"  name="invDate" id="invDate" value="<?php echo date('Y-m-d')?>" placeholder="">
                                        <input type="hidden" class="form-control" required="required"  name="invUser" id="invUser" value="<?php echo $_SESSION['user_id'] ?>">
                                        <input type="hidden" class="form-control" required="required"  name="location" id="location" value="<?php echo $_SESSION['location'] ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="invDate" class="col-sm-5 control-label">Remark <span class="required">*</span></label>
                                    <div class="col-sm-6">
                                        <textarea class="form-control" name="remark" id="remark"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <table>
                                    <tr>
                                        <td>Customer </td>
                                        <td> : </td>
                                        <td> <span id="cusCode"></span></td>
                                    </tr>
                                    <tr>
                                        <td>Mobile No</td>
                                        <td> : </td>
                                        <td> <span id="city"></span></td>
                                    </tr>
                                    <tr>
                                        <td>Credit Limit</td>
                                        <td> : </td>
                                        <td class="text-right"> <span id="creditLimit"></span></td>
                                    </tr>
                                    <tr>
                                        <td>Credit period</td>
                                        <td> : </td>
                                        <td> <span id="creditPeriod"></span> </td>
                                    </tr>
                                    <tr>
                                        <td>Outstanding</td>
                                        <td> : </td>
                                        <td class="text-right"><span id="cusOutstand"></span></td>
                                    </tr>
                                    <tr>
                                        <td>Available Limit</td>
                                        <td> : </td>
                                        <td class="text-right"><span id="availableCreditLimit"></span> </td>
                                    </tr>

                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td> </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-3">
                                
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b></b>
                                <br><button class="btn btn-info pull-right" id='pay'>Cancel Customer Payment</button>
                                <button class="btn btn-primary" disabled id='print'>Print Receipt</button>
                            </div>
                            <div class="col-lg-8">
                                <span id="errPayment"></span>
                            </div>
                        </div>



                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="tbl_payment" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Mode</th>
                                        <th>Cheque Date</th>
                                        <th>Cheque No</th>
                                        <th >Bank Name</th>
                                        <th  class="text-right">Total Net Amount</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>

                            </table>
                        </div>
                        <span id="lastTranaction">Last Cancel payment : </span>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>
    </section>
   <!--invoice print-->
    <div class="modal fade bs-payment-modal-lg" id="modelInvoice" tabindex="-1" role="dialog" aria-hidden="false">
        <div class="modal-dialog modal-lg">
            <form role="form" id="addDep" data-parsley-validate method="post" action="#">
                <div class="modal-content"><div class="modal-body" >
                <?php //receipt print 
                            $this->load->view('admin/payment/customer-card-receipt-print.php',true); ?> 
                            
                         
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button>
                        <button type="button" id="printInvoice" class="btn btn-primary btn-lg">Print</button>
                    </div>

                </div>
            </form>
        </div>
    </div>


</div>
<style>
    .shop-items:hover{
        background-color: #00ca6d;
        color: #fff;
    }
</style>
<script type="text/javascript">

    $('#customer').select2({
        placeholder: "Select a customer",
        allowClear: true,
        minimumInputLength:1,
        width: '100%'
    });



    $('#newsalesperson').on('change', function() {
        var salespersonID = $(this).val();
        if (salespersonID != "0") {

            $.ajax({
                url: "<?php echo base_url(); ?>" + "admin/customer/findemploeeroute",
                method: 'POST',
                data: { salespersonID: salespersonID },
                dataType: 'json',
                success: function(response) {

                    $('#route').empty();
                    $('#route').append('<option value="0">-Select-</option>');

                    $.each(response, function(index, routeID) {
                        console.log(routeID);
                        $('#route').append('<option value="'+ routeID.route_id +'">'+ routeID.route_name +'</option>');
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching routes:', error);
                }
            });
        } else {
            $('#route').empty();
            $('#route').append('<option value="0">-Select-</option>');
        }
    });

    //    $('#route').on('change', function() {
    //    var routeID = $(this).val();
    //    if (routeID != "0") {
    //
    //    $.ajax({
    //    url: "<?php //echo base_url(); ?>//" + "admin/sales/findroutecustomer",
    //    method: 'POST',
    //    data: { routeID: routeID },
    //    dataType: 'json',
    //    success: function(response) {
    //
    //    $('#customer').empty();
    //    $('#customer').append('<option value="0">-Select-</option>');
    //
    //    $.each(response, function(index, customers) {
    //    console.log(customers);
    //    $('#customer').append('<option value="'+ customers.CusCode +'">'+ customers.CusName +'</option>');
    //});
    //},
    //    error: function(xhr, status, error) {
    //    console.error('Error fetching customer:', error);
    //}
    //});
    //} else {
    //    $('#customer').empty();
    //    $('#customer').append('<option value="0">-Select-</option>');
    //}
    //});



</script>