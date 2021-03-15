@extends('Department_layouts.Store_master_layout')
@section('content')

    <div class="app-admin-wrap layout-sidebar-large">
        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <div class="main-content">
                @include('Common_header_footer.pagetitle')

                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="card-title mb-3">Add New Product</div>
                            <form action="{{route('Product.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf


                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn-info" style="float: right; margin-top: -49px;">Submit</button>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-12 form-group mb-3">
                                                <label for="firstName2">Product name</label>
                                                <input class="form-control form-control-rounded" id="product_name" name="productname" type="text" placeholder="Product name" required/>
                                            </div>
                                            <div class="col-md-12 form-group mb-3">
                                                <label for="lastName2">Product Details</label>

                                                <textarea class="form-control"  name="productdetails"  placeholder="Product Details" rows="4" required></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="col-md-12 form-group mb-3">
                                                    <label for="picker1">Category</label>
                                                    <select class="form-control form-control-rounded js-example-basic-multiple" name="category_ids[]" multiple="multiple" required>
                                                        <option value="">Select Category</option>
                                                        @foreach($category as $data)
                                                            <option value="{{$data->id}}">{{$data->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-12 form-group mb-3">
                                                    <label for="picker1">Sub Category</label>
                                                    <select class="form-control form-control-rounded js-example-basic-multiple" name="subcategory_ids[]" multiple="multiple" required>
                                                        @foreach($subcategory as $data)
                                                            <option value="{{$data->id}}">{{$data->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-12 form-group mb-3">
                                                    <label for="picker1">Pro Category</label>

                                                    <select class="form-control form-control-rounded js-example-basic-multiple" name="procategory_ids[]" multiple="multiple">
                                                        @foreach($procategory as $data)
                                                            <option value="{{$data->id}}">{{$data->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-12 form-group mb-3">
                                                    <label for="firstName2">Reference</label>
                                                    <input class="form-control form-control-rounded" name="skvalue" id="skvalue" type="text" placeholder="Sk Values" />
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
                                                    <div class="input-field">
                                                        <label for="credit2">Product Image</label>
                                                        <div class="input-images" name="productimage[]" type="file" style="padding-top: .5rem;"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 form-group mb-3">
                                                    <label for="phone1">Warranty</label>
                                                    <input type="number" class="form-control form-control-rounded" name="warranty" id="warranty" placeholder="12 Month" required/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-md-4 form-group mb-3">
                                                <label for="credit2">Country Of Origin</label>
                                                <input type="text" class="form-control form-control-rounded" name="cuntryorigin" id="" placeholder="Country Of Origin" />
                                            </div>
                                            <div class="col-md-4 form-group mb-3">
                                                <label for="credit2">Made in Assemble</label>
                                                <input type="text" class="form-control form-control-rounded" name="madeassemble" id="" placeholder="Made in Assemble" />
                                            </div>
                                            <div class="col-md-4 form-group mb-3">
                                                <label for="credit2">Stoke Status</label>
                                                <input type="text" class="form-control form-control-rounded" name="stokestatus" id="" placeholder="Stoke Status" required/>
                                            </div>
                                            <div class="col-md-4 form-group mb-3">
                                                <label for="credit2">Product Document</label>
                                                <input type="file" class="form-control form-control-rounded" name="docfile_products[]" id="" />
                                            </div>
                                            <div class="col-md-4 form-group mb-3">
                                                <label for="credit2">Product PDF</label>
                                                <input type="file" class="form-control form-control-rounded" name="pdf_products[]" id="" />
                                            </div>
                                            <div class="col-md-4 form-group mb-3">
                                                <label for="credit2">Product Auto Cat File</label>
                                                <input type="file" class="form-control form-control-rounded" name="autocat_products[]" id="" />
                                            </div>
                                            <div class="col-md-6 form-group mb-3">
                                                <label for="credit2">Product Videos</label>
                                                <input type="text" class="form-control form-control-rounded" name="product_videos[]" id="" placeholder="Product Videos Link"/>
                                            </div>

                                            <div class="col-md-3 form-group mb-3" style="margin-top: 27px">
                                                <label class="switch pr-5 switch-warning mr-3"><span> Popular Product</span>
                                                    <input type="checkbox" id="popular_product" /><span class="slider"></span>
                                                    <input type="hidden" name="popularproduct" id="checkpopular" value="0">
                                                </label>
                                            </div>

                                            <div class="col-md-3 form-group mb-3" style="margin-top: 27px">
                                                <label class="switch pr-5 switch-warning mr-3"><span> Feature Product</span>
                                                    <input type="checkbox" id="feature_product"  /><span class="slider"></span>
                                                    <input type="hidden" name="featureproduct" id="checkfeature" value="0">
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


{{--                                    <div class="col-md-5">--}}

{{--                                    </div>--}}
{{--                                    <div class="col-md-7">--}}
{{--                                        <button class="btn btn-primary">Submit</button>--}}
{{--                                    </div>--}}

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

    <script>
        $(function(){

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


        });
    </script>



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

{{--    <script type="text/javascript">--}}
{{--        $(document).ready(function(){--}}
{{--            var maxField = 10; //Input fields increment limitation--}}
{{--            var addgroup = $('.add_group'); //Add button selector--}}
{{--            var wrapper_group = $('.field_wrappergroup'); //Input field wrapper--}}
{{--            var fieldHTMLg = '<div class="appendbody"><input type="text" class="form-control form-control-rounded appendform" name="products_group[]" value="" placeholder="Group Name"/><a href="javascript:void(0);" class="remove_group"><img src="{{asset('Media/image/remove-icon.png')}}" /></a></div>'; //New input field html--}}
{{--            var x = 1;--}}

{{--            //Once add button is clicked--}}
{{--            $(addgroup).click(function(){--}}
{{--                if(x < maxField){--}}
{{--                    x++;--}}
{{--                    $(wrapper_group).append(fieldHTMLg); //Add field html--}}
{{--                }--}}
{{--            });--}}

{{--            //Once remove button is clicked--}}
{{--            $(wrapper_group).on('click', '.remove_group', function(e){--}}
{{--                e.preventDefault();--}}
{{--                $(this).parent('div').remove(); //Remove field html--}}
{{--                x--; //Decrement field counter--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
    <script type="text/javascript" src="{{ asset('js/product_feture.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('.input-images').imageUploader({
                imagesInputName: 'company_logo',
                maxFiles: 100
            });
        })
    </script>

@endsection

