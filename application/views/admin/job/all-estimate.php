<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="content-wrapper">
    <section class="content-header">
        <?php echo $pagetitle; ?>
        <?php echo $breadcrumb; ?>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                    <b><span class="alert alert-success pull-left" id="lastProduct"></span></b>
                        <!-- <a href="../job/estimate_job" class="btn btn-flat btn-primary pull-right">Add New Estimate</a> -->
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="box" id="catDiv">
                    <div class="box-body table-responsive">
                        <table class="table table-bordered" id="producttbl">
                            <thead>
                                <tr>
                                    <td>Estimate No</td>
                                    <td>Estimate No</td>
                                    <td>Customer</td>
                                    <td>Date</td>
                                    <td>Customer Code</td>
                                    <td>###</td>
                                    <td>Status</td>
                                    <td>Edit</td>
                                    <td>View</td>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--add department modal-->
    <div id="productmodal" class="modal fade bs-add-category-modal-lg"  role="dialog" aria-hidden="false">
        <div class="modal-dialog modal-lg" style="width: 95%;">
            <div class="modal-content">
                <!-- load data -->
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
 
        var producttbl = $('#producttbl').dataTable({
            "processing": true,
            "serverSide": true,
            "order": [[1, "desc"]],
            "language": {
                "processing": "<div class='overlay'><i class='fa fa-refresh fa-spin'></i></div>"
            },
            "ajax": {
                "url": "allestimates",
                "type": "POST"
            },
            "columns":
                    [
                        {
                            <?php if (in_array("SM52", $blockView) || $blockView == null) { ?>
                            "data": null, orderable: false, searchable: false,
                            mRender: function (data, type, row) {
                                return '<a href="../job/view_estimate?type=est&id=' + Base64.encode(row.EstimateNo) + '&sup=' + row.Supplimentry + '"  >' + row.EstimateNo + '</a>';
                            }
                            <?PHP  } else {?>
                            "data": null, orderable: false, searchable: false,
                            mRender: function (data, type, row) {
                                return row.EstimateNo;
                            }
                            <?php }?>
                        },
                        {"data": "EstimateNo","visible": false,"searchable": true},
                        {
                            <?php if (in_array("SM21", $blockView) || $blockView == null) { ?>
                            "data": null, orderable: false, searchable: false,
                            mRender: function (data, type, row) {
                                return '<a href="<?php echo base_url() ?>admin/payment/view_customer/' + (row.EstCustomer) + '" >' + row.CusName + '</a>';
                            }
                            <?PHP  } else {?>
                            "data": null, orderable: false, searchable: false,
                            mRender: function (data, type, row) {
                                return row.CusName;
                            }
                            <?php }?>
                        },
                        {"data": "EstDate", searchable: false},
                        {"data": "EstCustomer", searchable: false},
                        {"data": "DisplayName","visible": false,"searchable": true},
                        {"data": null, orderable: false, searchable: false,
                            mRender: function (data, type, row) {
                                 if(row.IsCancel==1){
                                    return '<label class="label label-danger">Canceled</label>';
                                }else if(row.IsCancel==0){
                                    return '<label class="label label-success">Active</label>';
                                }
                            }
                        },
                        {
                            <?php if (in_array("SM52", $blockEdit) || $blockEdit == null) { ?>
                            "data": null, orderable: false, searchable: false,
                            mRender: function (data, type, row) {
                                return '<a href="../job/estimate_job?type=est&id=' + Base64.encode(row.EstimateNo) + '&sup=' + row.Supplimentry + '" class="btn btn-xs btn-info" >Edit</a>';
                            }
                            <?PHP  } else {?>
                            "data": null, orderable: false, searchable: false,
                            mRender: function (data, type, row) {
                                return '<a href="../job/estimate_job?type=est&id=' + Base64.encode(row.EstimateNo) + '&sup=' + row.Supplimentry + '" class="btn btn-xs btn-info" >Edit</a>';
                            }
                            <?php }?>
                        },
                        {
                            <?php if (in_array("SM52", $blockView) || $blockView == null) { ?>
                            "data": null, orderable: false, searchable: false,
                            mRender: function (data, type, row) {
                                return '<a href="../job/view_estimate?type=est&id='+ Base64.encode(row.EstimateNo) +'&sup='+row.Supplimentry+'" class="btn btn-xs btn-info" >View</a>';
                            }
                            <?PHP  } else {?>
                            "data": null, orderable: false, searchable: false,
                            mRender: function (data, type, row) {
                                return '<a href="../job/view_estimate?type=est&id='+ Base64.encode(row.EstimateNo) +'&sup='+row.Supplimentry+'" class="btn btn-xs btn-info" >View</a>';
                            }
                            <?php }?>
                        }

                        
                    ]
        });
    });
    function addp() {
        $('.modal-content').load('<?php echo base_url() ?>admin/product/loadmodal_addproduct/', function (result) {
            $('#productmodal').modal({show: true,backdrop: 'static', keyboard: false});
        });
    }
    function editp(id) {
        console.log(id);
        $('.modal-content').load('<?php echo base_url() ?>admin/product/loadmodal_editproduct/', {id: id}, function (result) {
            $('#productmodal').modal({show: true,backdrop: 'static', keyboard: false});
        });
    }

     var Base64 = {
                _keyStr: "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",
                encode: function(input) {
                    var output = "";
                    var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
                    var i = 0;

                    input = Base64._utf8_encode(input);

                    while (i < input.length) {

                        chr1 = input.charCodeAt(i++);
                        chr2 = input.charCodeAt(i++);
                        chr3 = input.charCodeAt(i++);

                        enc1 = chr1 >> 2;
                        enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
                        enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
                        enc4 = chr3 & 63;

                        if (isNaN(chr2)) {
                            enc3 = enc4 = 64;
                        } else if (isNaN(chr3)) {
                            enc4 = 64;
                        }

                        output = output +
                                this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) +
                                this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);

                    }

                    return output;
                },
               
                decode: function(input) {
                    var output = "";
                    var chr1, chr2, chr3;
                    var enc1, enc2, enc3, enc4;
                    var i = 0;

                    input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

                    while (i < input.length) {

                        enc1 = this._keyStr.indexOf(input.charAt(i++));
                        enc2 = this._keyStr.indexOf(input.charAt(i++));
                        enc3 = this._keyStr.indexOf(input.charAt(i++));
                        enc4 = this._keyStr.indexOf(input.charAt(i++));

                        chr1 = (enc1 << 2) | (enc2 >> 4);
                        chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
                        chr3 = ((enc3 & 3) << 6) | enc4;

                        output = output + String.fromCharCode(chr1);

                        if (enc3 != 64) {
                            output = output + String.fromCharCode(chr2);
                        }
                        if (enc4 != 64) {
                            output = output + String.fromCharCode(chr3);
                        }

                    }

                    output = Base64._utf8_decode(output);

                    return output;

                },

                _utf8_encode: function(string) {
                    string = string.replace(/\r\n/g, "\n");
                    var utftext = "";

                    for (var n = 0; n < string.length; n++) {

                        var c = string.charCodeAt(n);

                        if (c < 128) {
                            utftext += String.fromCharCode(c);
                        }
                        else if ((c > 127) && (c < 2048)) {
                            utftext += String.fromCharCode((c >> 6) | 192);
                            utftext += String.fromCharCode((c & 63) | 128);
                        }
                        else {
                            utftext += String.fromCharCode((c >> 12) | 224);
                            utftext += String.fromCharCode(((c >> 6) & 63) | 128);
                            utftext += String.fromCharCode((c & 63) | 128);
                        }

                    }

                    return utftext;
                },
    
                _utf8_decode: function(utftext) {
                    var string = "";
                    var i = 0;
                    var c = c1 = c2 = 0;

                    while (i < utftext.length) {

                        c = utftext.charCodeAt(i);

                        if (c < 128) {
                            string += String.fromCharCode(c);
                            i++;
                        }
                        else if ((c > 191) && (c < 224)) {
                            c2 = utftext.charCodeAt(i + 1);
                            string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
                            i += 2;
                        }
                        else {
                            c2 = utftext.charCodeAt(i + 1);
                            c3 = utftext.charCodeAt(i + 2);
                            string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
                            i += 3;
                        }

                    }

                    return string;
                }

            };
  
</script>
