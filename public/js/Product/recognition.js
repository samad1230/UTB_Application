$(function(){

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
    });

    var product_info = []; // form submit
    var i="1";
    var sl= 1;

    $("#addbutton").click(function(event){
        var productid = $(this).val();
        if (productid){
            var quantity_valu = $("#quantity_valu").val();
            var product_name = $("#productname").val();

            var tr = '<tr id="item_row">';
            tr += (
                '<td>'+  sl +  '</td>'+
                '<td>' + product_name + '</td>' +
                '<td>' + quantity_valu + '</td>' +
                '<td>' + '<div class="btn btn-sm btn-danger remove_field"> X </div>' +'</td>'
            );

            tr += ('</td>');
            tr += '</tr>';

            $( "#item_list tbody" ).append(tr);

            i++;
            sl++;

            var serialval = i-1;
            var newsl = serialval.toString();

            obj = {product_name:product_name,serialid:newsl,product_id:productid, quntity_valu:quantity_valu};

            product_info.push(obj);

            $('#productname').val('');
            $('#quantity_valu').val('');
            $('#addbutton').val('');
            $('#select2-product_id-container').html("");

        }else{
            alert("Select Product");
            $('#product_id').focus();
        }

    }); // plus button


    $(document).on('click', '.remove_field', function() {
        var serial_r = $(this).closest('tr').find('td:eq(0)').text();
        var productname = $(this).closest('tr').find('td:eq(1)').text();
        var quantiry = $(this).closest('tr').find('td:eq(3)').text();
        $(this).parents('tr').remove();

        const index = product_info.findIndex(function (todo, index){
            return todo.serialid == serial_r
        })

        product_info.splice(index, 1);
    });


    $("#recognition_submit_btn").on('click',function(e){

        var sellingdate                 = $("#reco_date").val();
        var recognition_number          = $("#recognition_number").val();

        if (recognition_number !="") {
            $.ajax({
                url: '/Recognition',
                type: 'post',
                data: {
                    "requested_data": product_info,
                    "recognition_date": sellingdate,
                    "recognition_number": recognition_number
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',

                success: function (data) {
                    $('#recognition_submit_btn').attr('disabled','disabled');
                    //console.log(data);
                    if (data.status == "success") {
                        toastr["success"]("Recognition Added Success")
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
                    $('#recognition_submit_btn').attr('disabled','disabled');

                },
                error: function(data){
                    alert("Check Data !");
                }

            });
        }else{
            alert("Check Recognition  No!");
            $('#product_id').focus();
        }

    });

//=======================================
});// end function

