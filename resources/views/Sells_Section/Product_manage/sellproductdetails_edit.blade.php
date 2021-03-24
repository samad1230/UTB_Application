@extends('Department_layouts.Sales_master_layout')
@section('content')

<!--    --><?php //dd($producteditdata);?>
    <input type="hidden" id="product_slag" value="{{$producteditdata->slag}}">

    <div class="app-admin-wrap layout-sidebar-large">
        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <div class="main-content">
                @include('Common_header_footer.pagetitle')

                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="card-title mb-3">Update Product</div>
                            <form action="{{route('Product.update',$producteditdata->slag)}}" method="POST" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn-info" style="float: right; margin-top: -49px;">Update</button>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-12 form-group mb-3">
                                                <label for="firstName2">Product name</label>
                                                <input class="form-control form-control-rounded" id="product_name" name="productname" type="text" placeholder="Product name" value="{{$producteditdata->name}}" required/>
                                            </div>
                                            <div class="col-md-12 form-group mb-3">
                                                <label for="lastName2">Product Details</label>

                                                <textarea class="form-control" name="productdetails"  placeholder="Product Details" rows="4" required>{{$producteditdata->product_details}}</textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="col-md-12 form-group mb-3">
                                                    <label for="picker1">Category</label>
                                                    <select class="form-control" style="width: 100%;" name="category_ids[]" id="categorydata_byproduct" multiple="multiple">
                                                        @foreach($category as $data)
                                                            <option value="{{$data->id}}">{{$data->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-12 form-group mb-3">
                                                    <label for="picker1">Sub Category</label>
                                                    <select class="form-control form-control-rounded js-example-basic-multiple" name="subcategory_ids[]" id="product_subcategry" multiple="multiple" required>
                                                        @foreach($subcategory as $data)
                                                            <option value="{{$data->id}}">{{$data->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-12 form-group mb-3">
                                                    <label for="picker1">Pro Category</label>

                                                    <select class="form-control form-control-rounded js-example-basic-multiple" name="procategory_ids[]" id="product_procategry" multiple="multiple">
                                                        @foreach($procategory as $data)
                                                            <option value="{{$data->id}}">{{$data->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-12 form-group mb-3">
                                                    <label for="firstName2">Reference</label>
                                                    <input class="form-control form-control-rounded" name="skvalue" id="skvalue" type="text" placeholder="Sk Values" value="{{$producteditdata->skvalue}}" />
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="col-md-12 form-group mb-3">
                                                    <label for="picker1">Brand</label>
                                                    <select class="form-control form-control-rounded" name="brandid" id="brand_id" required>
                                                        <option value="">Select Brand</option>
                                                        @foreach($brand as $brands)
                                                            <option value="{{$brands->id}}">{{$brands->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                <div id="imagefireld">
                                                    @foreach($producteditdata->product_images as $productimage)
                                                        <a href="javascript:void(0);" class="imageiddata" id="{{$productimage->id}}"> <img src="{{ asset('Media/product/'.$productimage->product_image) }}" alt="Product Image" class="img-fluid border"  style="width: 35px"><i class="iui-close" style=" margin-left: -17px; margin-right: 5px; border: 1px solid red; border-radius: 11px;  background-color: azure;"></i></a>
                                                    @endforeach
                                                </div>
                                                    <div class="input-field">
                                                        <label for="credit2">Product Image</label>
                                                        <div class="input-images" name="productimage[]" type="file" style="padding-top: .5rem;"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-group mb-3">
                                                    <label for="phone1">Warranty</label>
                                                    <input type="number" class="form-control form-control-rounded" name="warranty" id="warranty" placeholder="12 Month" required value="{{$producteditdata->warranty}}"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-md-4 form-group mb-3">
                                                <label for="credit2">Country Of Origin</label>
                                                <input type="text" class="form-control form-control-rounded" name="cuntryorigin" id="" placeholder="Country Of Origin" value="{{$producteditdata->Country_Of_Origin}}"/>
                                            </div>
                                            <div class="col-md-4 form-group mb-3">
                                                <label for="credit2">Made in Assemble</label>
                                                <input type="text" class="form-control form-control-rounded" name="madeassemble" id="" placeholder="Made in Assemble" value="{{$producteditdata->Made_in_Assemble}}" />
                                            </div>
                                            <div class="col-md-4 form-group mb-3">
                                                <label for="credit2">Stoke Status</label>
                                                <input type="text" class="form-control form-control-rounded" name="stokestatus" id="" placeholder="Stoke Status" required value="{{$producteditdata->stoke_status}}"/>
                                            </div>

                                            <div class="col-md-6 form-group mb-3">
                                                <label for="credit2">Product Videos</label>
                                                @foreach($producteditdata->product_videos as $videolink)
                                                @endforeach
                                                <input type="text" class="form-control form-control-rounded" name="product_videos" value="{{@$videolink->video_name}}" placeholder="Product Videos Link"/>

                                            </div>

                                            <div class="col-md-3 form-group mb-3" style="margin-top: 27px">
                                                <label class="switch pr-5 switch-warning mr-3"><span> Popular Product</span>                                    <?php
                                                    if ($producteditdata->popular_product==1){
                                                    ?>
                                                    <input type="checkbox" checked="checked" id="popular_product"  /><span class="slider"></span>
                                                    <?php
                                                    }else{
                                                    ?>
                                                    <input type="checkbox"  id="popular_product"/><span class="slider"></span>
                                                    <?php
                                                    }
                                                    ?>
                                                    <input type="hidden" name="popularproduct" id="checkpopular" value="{{$producteditdata->popular_product}}">

                                                </label>
                                            </div>

                                            <div class="col-md-3 form-group mb-3" style="margin-top: 27px">
                                                <label class="switch pr-5 switch-warning mr-3"><span> Feature Product</span>
                                                    <?php
                                                        if ($producteditdata->feature_product==1){
                                                           ?>
                                                    <input type="checkbox" checked="checked" id="feature_product"  /><span class="slider"></span>
                                                    <?php
                                                        }else{
                                                            ?>
                                                    <input type="checkbox"  id="feature_product"/><span class="slider"></span>
                                                        <?php
                                                    }
                                                    ?>

                                                    <input type="hidden" name="featureproduct" id="checkfeature" value="{{$producteditdata->feature_product}}">
                                                </label>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <div class="row">
                                            <div class="col-md-12 form-group mb-3 field_wrappergroup" style="max-height: 700px; overflow-y: scroll;">
                                                <button type="button" class="btn btn-primary w-100 addFeatureGroupBtn">Add Feature Group</button>
                                                <div class="productFeatureContent">

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>


            </div> {{--main content--}}
        </div>
    </div>

@endsection


@section('pagescript')


    <script type="text/javascript">
        $(document).ready(function(){
            var maxField = 10; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper
            var fieldHTML = '<div class="appendbody"><input type="text" class="form-control form-control-rounded appendform" name="feature_products[]" value="" placeholder="Material Details"/><a href="javascript:void(0);" class="remove_button"><img src="{{asset('Media/image/remove-icon.png')}}" /></a></div>'; //New input field html
            var x = 1;

            //Once add button is clicked
            $(addButton).click(function(){
                if(x < maxField){
                    x++;
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });

            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e){
                e.preventDefault();
                $(this).parent('div').remove(); //Remove field html
                x--; //Decrement field counter
            });
        });
    </script>


    <script type="text/javascript" src="{{ asset('js/product_feture_edit.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('.input-images').imageUploader({
                imagesInputName: 'company_logo',
                maxFiles: 100
            });
        })
    </script>


    <script>
        var  slag = $('#product_slag').val();
        $.ajax({
            type: 'GET',
            url: '/product_categoriesdata/'+slag,
            success:function (data){
                var mydata = $.parseJSON(data);
                var category = (mydata.category);
                var subcategory = (mydata.subcategory);
                var procategory = (mydata.procategory);
                var brand = (mydata.brand);
                var pd_image = (mydata.image);


                $('#categorydata_byproduct').select2().val(category).trigger('change');
                $('#product_subcategry').select2().val(subcategory).trigger('change');
                $('#product_procategry').select2().val(procategory).trigger('change');
                $('#brand_id').val(brand).trigger('change');

                $("#popular_product").click(function(){
                    var check = $(this).prop('checked');
                    if(check == true) {
                        var stat = "1";
                        $('#checkpopular').val(stat);
                    } else {
                        var stat = "0";
                        $('#checkpopular').val(stat);
                    }
                });

                $("#feature_product").click(function(){
                    var check = $(this).prop('checked');
                    if(check == true) {
                        var statu = "1";
                        $('#checkfeature').val(statu);
                    } else {
                        var statu = "0";
                        $('#checkfeature').val(statu);
                    }
                });
            }

        });
        $('#categorydata_byproduct').select2({
            placeholder: 'Choose Category',
        });
        $('#product_subcategry').select2({
            placeholder: 'Choose SubCategory',
        });
        $('#product_procategry').select2({
            placeholder: 'Choose ProCategory',
        });

    </script>

    <script>
        var imageData = document.getElementsByClassName('imageiddata');
        for(var id = 0; id  < imageData.length; id++){
            var btn = imageData[id];
            btn.addEventListener('click', deleteImageFunction)
        }

        function deleteImageFunction(event){
            var seletedBtn = event.target;
            var conteiner = seletedBtn.parentElement;
            var seletedItem = conteiner.id;
            $.ajax({
                url: '/product_image_remove',
                type: 'post',
                data: {
                    "imageid":seletedItem
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                success: function(data){
                    //console.log(data);
                    conteiner.remove();
                },

            });
        }


    </script>

@endsection

