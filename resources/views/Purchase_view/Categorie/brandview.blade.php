@extends('Department_layouts.Purchese_master_layout')
@section('content')

    <div class="app-admin-wrap layout-sidebar-large">
        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <div class="main-content">
                @include('Common_header_footer.pagetitle')

                <div class="inbox-main-sidebar-container" data-sidebar-container="main">
                    <div class="inbox-main-content" data-sidebar-content="main">
                        <div class="inbox-secondary-sidebar-container box-shadow-1" data-sidebar-container="secondary">
                            <div data-sidebar-content="secondary">
                                <div class="inbox-secondary-sidebar-content position-relative" style="min-height: 500px">
                                    <div class="inbox-details perfect-scrollbar rtl-ps-none" data-suppress-scroll-x="true">
                                        <div class="addbtnplus">
                                            <button class="btn btn-primary btn-md m-1" type="button" data-toggle="modal" data-target="#addbrand"><i class="i-Add text-white mr-2"></i> Add Brand</button>

                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-hover" id="ul-contact-list">

                                                <thead class="table-dark">
                                                <tr>
                                                    <th scope="col">SL</th>
                                                    <th scope="col">Brand Name</th>
                                                    <th scope="col">Brand Image</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $sl = 1; ?>
                                                @foreach ($brand as $row)
                                                    <tr>
                                                        <td>{{$sl}}</td>
                                                        <td>{{ $row->name }}</td>
                                                        <td><img src="{{ asset($row->brand_image != null? 'Media/brand/'. $row->brand_image:'') }}" height="40px;" width="50px;"></td>

                                                        <td><a class="badge badge-primary m-2 p-2" href="#"><?php $statusnew = $row->status; if ($statusnew==1) {echo "Active";}else{echo "Inactive";} ?></a></td>
                                                        <td width="305px">
                                                            <button type="button" class="btn btn-primary btn-sm brand_edit" id="{{$row->id}}" >Edit</button>
                                                            <a class="btn btn-danger btn-sm" href="{{$row->id}}" id="delete" role="button">Delete</a>
                                                        </td>
                                                    </tr>
                                                    <?php $sl++; ?>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addbrand" tabindex="1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog model-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="">Add Brand</h4>
                </div>
                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{route('brand.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <label class="" for="">Brand Name:</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" name="brand_name" class="form-control" id="" placeholder="Brand Name" autocomplete="off">
                                </div>
                            </div>
                        </div>


                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <label class="" for="">Category name :</label>
                                </div>
                                <div class="col-md-7">

                                    <select class="form-control js-example-basic-multiple" name="category_ids[]" multiple="multiple" style="width: 240px">
                                        @foreach($category as $data)
                                            <option value="{{$data->id}}">{{$data->name}}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <label class="" for="">Sub Category:</label>
                                </div>
                                <div class="col-md-7">
                                    <select class="form-control js-example-basic-multiple" name="subcategory_ids[]" multiple="multiple" style="width: 240px">
                                        @foreach($subcategory as $data)
                                            <option value="{{$data->id}}">{{$data->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <label class="" for="">Pro Category:</label>
                                </div>
                                <div class="col-md-7">
                                    <select class="form-control js-example-basic-multiple" name="procategory_ids[]" multiple="multiple" style="width: 240px">
                                        @foreach($procategory as $data)
                                            <option value="{{$data->id}}">{{$data->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <label class="" for="">Brand Image :</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="file" name="brandimage" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="EditBrandModel" tabindex="1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog model-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id=""> Brand Update</h4>
                </div>
                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="" class="editbrand_form" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="oldimage" id="old_image">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <label class="" for="">Brand Name:</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" name="brand_name" class="form-control" id="Brand_name_edit" placeholder="Brand Name" autocomplete="off">
                                </div>
                            </div>
                        </div>


                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <label class="" for="">Category name :</label>
                                </div>
                                <div class="col-md-7">

                                    <select class="form-control js-example-basic-multiple" name="category_ids[]" multiple="multiple" style="width: 240px" id="category_idedit">
                                        @foreach($category as $data)
                                            <option value="{{$data->id}}">{{$data->name}}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <label class="" for="">Sub Category:</label>
                                </div>
                                <div class="col-md-7">
                                    <select class="form-control js-example-basic-multiple" name="subcategory_ids[]" multiple="multiple" style="width: 240px" id="subcategory_edit">
                                        @foreach($subcategory as $data)
                                            <option value="{{$data->id}}">{{$data->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <label class="" for="">Pro Category:</label>
                                </div>
                                <div class="col-md-7">
                                    <select class="form-control js-example-basic-multiple" name="procategory_ids[]" multiple="multiple" style="width: 240px" id="procategory_edit">
                                        @foreach($procategory as $data)
                                            <option value="{{$data->id}}">{{$data->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <label class="" for="">Brand Image :</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="file" name="brandimage" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('pagescript')

        <script>
            $(document).ready(function() {
                $('.js-example-basic-multiple').select2();
            });
        </script>

    <script>
        $(function(){
            $('.brand_edit').on('click', function(){
                var brandid = $(this).attr("id");
                $.ajax({
                    type: 'GET',
                    url:'/branddata_edit/'+brandid,
                    success: function (data) {
                         console.log(data);

                        $("#old_image").val(data.brand_image);
                        $("#Brand_name_edit").val(data.name);
                        // $("#category_idedit").val(data.subcategorie_id);
                        // $("#subcategory_edit").val(data.subcategorie_id);
                        // $("#procategory_edit").val(data.subcategorie_id);
                        $('.editbrand_form').attr('action', '/brand/'+brandid);
                    }
                });

                $("#EditBrandModel").modal('show');

            });

        });
    </script>

@endsection
