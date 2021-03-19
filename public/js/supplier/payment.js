$(function() {
    $('#payment_type').on('change', function(){
        var type = $("#payment_type").val();
        if (type=="cash"){
            $('.account_form').empty().append('<div class="account_form">\n' +
'                                                        <div class="row">\n' +
'                                                            <div class="col-md-12">\n' +
'                                                                <label class="form-control-label">Cash Blanch <span class="tx-danger"> *</span></label>\n' +
'                                                                <input type="text" class="form-control form-control-rounded" name="cashblanch" id="cash_blanch" value="" placeholder="Cash Blanch" readonly/>\n' +
'                                                            </div>\n' +
'                                                        </div>\n' +
'                                                    </div>');
            $.ajax({
                type: 'GET',
                url:'/account_blanch',
                success: function (data) {
                    $("#cash_blanch").val(data.blanch).css("color",'blue');
                    $("#cashblanch_store").val(data.blanch);
                }
            });
            $('.paymentform').empty().append(' <div class="paymentform">\n' +
'                                                        <div class="col-md-12 rowpad">\n' +
'                                                            <label class="form-control-label">Payment Note<span class="tx-danger"> *</span></label>\n' +
'                                                            <input type="text" class="form-control form-control-rounded" name="payment_note" id="" value="" placeholder="Payment Note"/>\n' +
'                                                        </div>\n' +
'                                                    </div>');


        }else if(type=="bank"){
            $('.account_form').empty().append('<div class="account_form">\n' +
'                                                        <div class="row">\n' +
'                                                            <div class="col-md-6">\n' +
'                                                                <label class="form-control-label">Payment To Bank <span class="tx-danger"> *</span></label>\n' +
'                                                                <select class="form-control form-control-rounded" name="bank_id" id="bankdata_id">\n' +

'                                                                </select>\n' +
'                                                            </div>\n' +
'                                                            <div class="col-md-6">\n' +
'                                                                <label class="form-control-label">Bank Ac Blanch <span class="tx-danger"> *</span></label>\n' +
'                                                                <input type="text" class="form-control form-control-rounded" name="bankacblanch" id="bankac_blanch" value="" placeholder="Bank Ac Blanch" readonly/>\n' +
'                                                            </div>\n' +
'                                                        </div>\n' +
'                                                    </div>');
            $('.paymentform').empty().append('<div class="paymentform">\n' +
                '                                                        <div class="col-md-12 rowpad">\n' +
                '                                                            <label class="form-control-label">Check No<span class="tx-danger"> *</span></label>\n' +
                '                                                            <input type="text" class="form-control form-control-rounded" name="checkno" id="" value="" placeholder="Check No"/>\n' +
                '                                                        </div>\n' +
                '                                                        <div class="col-md-12 rowpad">\n' +
                '                                                            <label class="form-control-label">Cheque Date<span class="tx-danger"> *</span></label>\n' +
                '                                                            <input type="date" class="form-control form-control-rounded" name="checkdate" id="checkdate" value="" placeholder="Check Date" required/>\n' +
                '                                                        </div>\n' +
                '                                                    </div>');
            $.ajax({
                type: 'GET',
                url:'/Bank_accountlist',
                success: function (data) {
                    var select = '';
                    select += '<option value="">Select Bank</option>';
                    $.each(data, function (index, obj) {
                        select += ('<option value="'+ obj.id+'">' + obj.account_name+ "-"+ obj.bank_name+'</option>');
                    });
                    $('#bankdata_id').html(select);
                }
            });

            $('#bankdata_id').on('change', function() {
                var bankid = $("#bankdata_id").val();
                $.ajax({
                    type: 'GET',
                    url:'/Bank_account_blanch/'+bankid,
                    success: function (data) {
                        $("#bankac_blanch").val(data.blanch);
                        $("#bankblanch_store").val(data.blanch);
                    }
                });
            });

        }

    });

    var d = new Date();
    var year = d.getFullYear();
    var month = d.getMonth()+1;
    var day = d.getDate();

    if (month < 10){
        var newmonth = '0' + month;
    }else{
        var newmonth = month;
    }

    if (day < 10){
        var newday = '0' + day;
    }else{
        var newday = day;
    }
    var choicedata = year+"-"+newmonth+"-"+newday;

    $('#payment_amount').on('change', function() {
        var amount = $("#payment_amount").val();
        var bankac_blanch = $("#bankblanch_store").val();
        var cash_blanch = $("#cashblanch_store").val();
        var payment_type = $("#payment_type").val();

        var  payamount = parseInt(amount);
        var  cashblanch = parseInt(cash_blanch);
        var  bankacblanch = parseInt(bankac_blanch);

        if (payment_type=="cash"){

            if (cashblanch > payamount){
                $("#submitbtn").attr("hidden",false);
            }else if(cashblanch < payamount){
                alert("Check Payment Amount");
                $("#submitbtn").attr("hidden",true);
            }else{
                $("#submitbtn").attr("hidden",false);
            }

        }else if(payment_type=="bank"){

            if (bankacblanch > payamount){
                $("#submitbtn").attr("hidden",false);

            }else if(bankacblanch < payamount){
                alert("Check Payment Amount And Cheque Date Update Please ");
                $("#submitbtn").attr("hidden",true);
            }else{
                $("#submitbtn").attr("hidden",false);
            }

            $('#checkdate').on('change', function() {
                var checkdate = $("#checkdate").val();
                if (checkdate == choicedata ){
                    if (bankacblanch > payamount){
                        $("#submitbtn").attr("hidden",false);
                    }else if(bankacblanch < payamount){
                        alert("Check Payment Amount And Cheque Date Update Please ");
                        $("#submitbtn").attr("hidden",true);
                    }
                }else{
                    $("#submitbtn").attr("hidden",false);
                }

            });

        }



    });



});
