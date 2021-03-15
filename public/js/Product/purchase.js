$(function(){

    $('#suplier_iddata').on('change', function(){
        var supplierid = $(this).val();
        $.ajax({
            type: 'GET',
            url:'/purchesh_suplier_data/'+supplierid,
            success: function (data) {

                $('#suplier_status').val(data.status);
                $('#suplier_accounts').val(data.accounts);
                var purchaseamount = $('#purchase_amount_total').val();
                if (purchaseamount==''){
                    var lastbuyamount = 0;
                }else{
                    var lastbuyamount = purchaseamount;
                }
                if(data.accounts > 0){
                    $('#previus_account').val(data.accounts).css({"color":"red"});
                    $('#last_balanch').val(parseFloat(lastbuyamount) + parseFloat(data.accounts));

                }else if(data.accounts < 0){
                    $('#previus_account').val(data.accounts).css({"color":"blue"});
                    var accounts = data.accounts.replace('-', '');
                    $('#last_balanch').val(lastbuyamount - accounts);
                }else{
                    $('#last_balanch').val(parseFloat(lastbuyamount) + parseFloat(data.accounts));
                    $('#previus_account').val(data.accounts).css({"color":"red"});
                }
                $('#purchase_cost').val('');
                $('#discount_flat').val('');
                $('#supplier_payment').val('');
                $('#payable_amount').val(lastbuyamount);
                $('#actual_purchase_amount').val(lastbuyamount);

            }

        });
    });


    $('#product_id').on('change', function(){
        var productid = $(this).val();
        $('#addbutton').val(productid);
        $.ajax({
            type: 'GET',
            url: '/purchesh_product_data/' + productid,
            success: function (data) {
                $('#productname').val(data.name);
            }
        });

    });

    $('#quantity_valu').on('change', function(){
        var quantityvalu = $("#quantity_valu").val();
        var buypriceval = $('#buypriceval').val();
        if (buypriceval==''){
            var lastbuypriceval = 0;
        }else{
            var lastbuypriceval = buypriceval;
            var totalbuypricevalu = quantityvalu * lastbuypriceval;
            $('#totalbuyamount').val(totalbuypricevalu);
        }

    });

    $('#buypriceval').on('change', function(){
        var buypriceval = $("#buypriceval").val();
        var quantity_valu = $("#quantity_valu").val();
        var totalbuypricevalu = quantity_valu * buypriceval;
        $('#totalbuyamount').val(totalbuypricevalu);
    });

    $('#sellpriceval').on('change', function(){
        var sellpriceval = $("#sellpriceval").val();
    });


    var product_info = []; // form submit
    var i="1";
    var sl= 1;

    $("#addbutton").click(function(event){
        var productid = $(this).val();
        var suplierid = $("#suplier_iddata").val();

        if (productid && suplierid){
            var buypriceval = $("#buypriceval").val();
            var sell_priceval = $("#sellpriceval").val();
            var totalbuyval = $("#totalbuyamount").val();
            var quantity_valu = $("#quantity_valu").val();
            var product_name = $("#productname").val();


            var tr = '<tr id="item_row">';
            tr += (
                '<td>'+  sl +  '</td>'+
                '<td>' + product_name + '</td>' +
                '<td>' + quantity_valu + '</td>' +
                '<td>' + buypriceval + '</td>' +
                '<td class="subtotalval">' + totalbuyval + '</td>'+
                '<td>' + sell_priceval + '</td>' +
                '<td>' + '<div class="btn btn-sm btn-danger remove_field"> X </div>' +'</td>'
            );

            tr += ('</td>');
            tr += '</tr>';

            $( "#item_list tbody" ).append(tr);

            i++;
            sl++;

            var serialval = i-1;
            var newsl = serialval.toString();

            var totalpurchase_amount = $('#purchase_amount_total').val();

            obj = {product_name:product_name,serialid:newsl,product_id:productid, singlebuyprice:buypriceval, quntity_valu:quantity_valu, singleprice:sell_priceval,singlesubtotal:totalbuyval};

            product_info.push(obj);

            $('#productname').val('');
            $('#quantity_valu').val('');
            $('#buypriceval').val('');
            $('#totalbuyamount').val('');
            $('#sellpriceval').val('');
            $('#addbutton').val('');
            $('#select2-product_id-container').html("");

        }else{
            alert("Select Supplier ID");
            $('#suplier_iddata').focus();
        }
        calculate();
    }); // plus button

    function calculate() {
        var totalField = document.getElementsByClassName('subtotalval');
        var subTotal = 0;
        for (var st = 0; st < totalField.length; st++){
            var getTotal = totalField[st].innerText;
            subTotal = subTotal + parseFloat(getTotal);
        }

        $('#purchase_amount_total').val(subTotal);
        $('#payable_amount').val(subTotal);
        $('#subtotal_cash').val(subTotal);

        var accountscas = $("#suplier_accounts").val();

        if(accountscas > 0){
            $('#previus_account').val(accountscas).css({"color":"red"});
            $('#last_balanch').val(parseFloat(subTotal) + parseFloat(accountscas));
        }else if(accountscas < 0){
            $('#previus_account').val(accountscas).css({"color":"blue"});
            var accounts = accountscas.replace('-', '');
            $('#last_balanch').val(subTotal - accounts);
        }else{
            $('#last_balanch').val(parseFloat(subTotal) + parseFloat(accountscas));
            $('#previus_account').val(accountscas).css({"color":"red"});
        }

    } //calculate and remove




    $('#purchase_cost').on('change', function(){
        var cost = $("#purchase_cost").val();
        var purchaseamount = $("#purchase_amount_total").val();

        var total_payable =  parseFloat(purchaseamount) + parseFloat(cost);

        var accountscas = $("#suplier_accounts").val();

        if(accountscas > 0){
            $('#previus_account').val(accountscas).css({"color":"red"});
            $('#last_balanch').val(parseFloat(total_payable) + parseFloat(accountscas));
        }else if(accountscas < 0){
            $('#previus_account').val(accountscas).css({"color":"blue"});
            var accounts = accountscas.replace('-', '');
            $('#last_balanch').val(total_payable - accounts);
        }else{
            $('#last_balanch').val(parseFloat(total_payable) + parseFloat(accountscas));
            $('#previus_account').val(accountscas).css({"color":"red"});
        }

        $('#payable_amount').val(total_payable);
        $('#actual_purchase_amount').val(total_payable);
        $('#discount_flat').val('');
        $('#supplier_payment').val('');
    });


    $('#discount_flat').on('change', function(){
        var discount = $("#discount_flat").val();
        var payable_amount = $("#payable_amount").val();

        var actual_purchase = payable_amount - discount;

        var accountscas = $("#suplier_accounts").val();

        if(accountscas > 0){
            $('#previus_account').val(accountscas).css({"color":"red"});
            $('#last_balanch').val(parseFloat(actual_purchase) + parseFloat(accountscas));
        }else if(accountscas < 0){
            $('#previus_account').val(accountscas).css({"color":"blue"});
            var accounts = accountscas.replace('-', '');
            $('#last_balanch').val(actual_purchase - accounts);
        }else{
            $('#last_balanch').val(parseFloat(actual_purchase) + parseFloat(accountscas));
            $('#previus_account').val(accountscas).css({"color":"red"});
        }

        $('#actual_purchase_amount').val(actual_purchase);
        $('#supplier_payment').val('');
    });



    $('#supplier_payment').on('change', function(){
        var suplierpayment = $("#supplier_payment").val();
        var purchase_amount_total = $("#purchase_amount_total").val();
        var disccount = $("#discount_flat").val();
        var purchase_cost = $("#purchase_cost").val();

        if (purchase_cost==""){
            var lcost = 0;
        }else{
            var lcost = purchase_cost;
        }
        if (disccount==""){
            var discost = 0;
        }else{
            var discost = disccount;
        }

        var totalbuyamountlast =  parseFloat(purchase_amount_total) + parseFloat(lcost);
        var lastbuyamount = totalbuyamountlast - discost ;

        var accountscas = $("#suplier_accounts").val();

        if (lastbuyamount > suplierpayment ){
            var lastbalanch =  lastbuyamount - suplierpayment; // due value
            if(accountscas > 0){
                var last_AccountValue = parseFloat(lastbalanch) + parseFloat(accountscas);
            }else{
                var accounts = accountscas.replace('-', '');
                var last_AccountValue = lastbalanch - accounts;
            }

        }else if (lastbuyamount < suplierpayment){
            var lastbalanch =  suplierpayment - lastbuyamount; // advance value
            if(accountscas < 0){
                var accounts = accountscas.replace('-', '');
                var last_AccountValue = parseFloat(lastbalanch) + parseFloat(accounts);
            }else{
                var accounts = accountscas.replace('-', '');
                var last_AccountValue = lastbalanch - accounts;
            }
        }
        $('#last_balanch').val(last_AccountValue);
    });


    $("#checkval").click(function(){
        var check = $(this).prop('checked');
        if(check == true) {
            var stat = "1";
            $('#checkvalchange').val(stat);
        } else {
            var stat = "0";
            $('#checkvalchange').val(stat);
        }
    });

    $(document).on('click', '.remove_field', function() {
        var serial_r = $(this).closest('tr').find('td:eq(0)').text();
        var productname = $(this).closest('tr').find('td:eq(1)').text();
        var singBuyprice = $(this).closest('tr').find('td:eq(2)').text();
        var quantiry = $(this).closest('tr').find('td:eq(3)').text();
        var subtotal_r = $(this).closest('tr').find('td:eq(5)').text();
        var sellpricesn = $(this).closest('tr').find('td:eq(6)').text();
        $(this).parents('tr').remove();

        const index = product_info.findIndex(function (todo, index){
            return todo.serialid == serial_r
        })

        product_info.splice(index, 1);

        var lastbuy_buy = $("#purchase_amount_total").val();
        var nitsellamount = lastbuy_buy - subtotal_r;

        $('#purchase_amount_total').val(nitsellamount);
        $('#payable_amount').val(nitsellamount);
        $('#subtotal_cash').val(nitsellamount);

        var accountscas = $("#suplier_accounts").val();

        if(accountscas > 0){
            $('#previus_account').val(accountscas).css({"color":"red"});
            $('#last_balanch').val(parseFloat(lastbuy_buy) + parseFloat(accountscas));
        }else if(accountscas < 0){
            $('#previus_account').val(accountscas).css({"color":"blue"});
            var accounts = accountscas.replace('-', '');
            $('#last_balanch').val(lastbuy_buy - accounts);
        }else{
            $('#last_balanch').val(parseFloat(lastbuy_buy) + parseFloat(accountscas));
            $('#previus_account').val(accountscas).css({"color":"red"});
        }

        if (nitsellamount === 0) {
            location.reload();
        }
        $('#purchase_cost').val('');
        $('#discount_flat').val('');
        $('#supplier_payment').val('');

        calculate();
    });


    $("#purchese_submit_btn").on('click',function(e){

        var suplier_id   		= $("#suplier_iddata").val();
        var purchase_cost 		= $("#purchase_cost").val();
        var discountflat 	    = $("#discount_flat").val();
        var supplier_payment     = $("#supplier_payment").val();
        var checkval 		    = $("#checkvalchange").val();
        var purchase_amount_total   = $("#purchase_amount_total").val();
        var last_balanch        = $("#last_balanch").val();
        var sellingdate         = $("#sellingdate").val();

        if (suplier_id !="" && purchase_amount_total !="") {
            $.ajax({
                url: '/Purchase',
                type: 'post',
                data: {
                    "requested_data": product_info,
                    "suplierid": suplier_id,
                    "purchase_cost": purchase_cost,
                    "supplier_payment": supplier_payment,
                    "checkval": checkval,
                    "purchase_amount_total": purchase_amount_total,
                    "discountflat": discountflat,
                    "last_balanch": last_balanch,
                    "sellingdate": sellingdate
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',

                success: function (data) {
                    $('#purchese_submit_btn').attr('disabled','disabled');
                   // console.log(data);
                    if (data.status == "success") {
                        toastr["success"]("Product Purchase Added Success")
                        toastr.options = {
                            "closeButton": false,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": false,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }

                    }

                    location.reload();
                    $('#product_id').focus();
                    $('#suplier_iddata').val('');
                    $('#purchase_amount_total').val('');
                    $('#purchese_submit_btn').attr('disabled','disabled');

                },
                error: function(data){
                    alert("Check Data !");
                }

            });
        }else{
            alert("Check Data !");
            $('#suplier_iddata').focus();
        }

     //   $(this).prop("disabled",true);
       // $(this).attr("disabled","disabled");

    });

//=======================================
});// end function


// function focusNext(e) {
//     var symboledatanew = $("#symboledatanew").val();
//
//     if (symboledatanew==""){
//         var idArray =["name_tags","pic_value","buypriceval","sellpriceval","addbtn","laber_cost","discount_flat","suplier_payment","order_submit_btn"];
//     }else{
//         var idArray =["name_tags","symbol_id","pic_value","buypriceval","sellpriceval","addbtn","laber_cost","discount_flat","suplier_payment","order_submit_btn"];
//     }
//
//     try {
//         for (var i = 0; i < idArray.length; i++) {
//             if (e.keyCode === 13 && e.target.id === idArray[i]) {
//                 document.querySelector(`#${idArray[i+1]}`).focus();
//                 if (idArray[i] == "addbtn"){
//                     alertify.set({ buttonReverse: true });
//                     alertify.confirm("Do you want to add more products ?", function (e) {
//                         if (e) {
//                             $('#name_tags').focus();
//                         } else {
//                             $('#laber_cost').focus();
//                             document.querySelector(`#${idArray[i+1]}`).focus();
//                         }
//                     });
//                 }
//             }
//         }
//     } catch(error){}
// }

