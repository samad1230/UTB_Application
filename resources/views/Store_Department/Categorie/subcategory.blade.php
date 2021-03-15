@extends('Department_layouts.Store_master_layout')
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
                                            <button class="btn btn-primary btn-md m-1" type="button" data-toggle="modal" data-target="#addsubcategory"><i class="i-Add text-white mr-2"></i> Add Subcategories</button>

                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-hover" id="ul-contact-list">

                                                <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col">SL</th>
                                                    <th scope="col">Categories Name</th>
                                                    <th scope="col">Subcategory Name</th>
                                                    <th scope="col">Image</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $sl = 1; ?>
                                                @foreach ($subcategory as $row)
                                                    <tr>
                                                        <td>{{$sl}}</td>
                                                        <td>{{ $row->name }}</td>
                                                        <td>{{ $row->catname }}</td>
                                                        <td><img src="{{ asset($row->subcat_image != null? 'Media/subcategory/'. $row->subcat_image:'') }}" height="40px;" width="50px;"></td>

                                                        <td><a class="badge badge-primary m-2 p-2" href="#"><?php $statusnew = $row->status; if ($statusnew==1) {echo "Active";}else{echo "Inactive";} ?></a></td>
                                                        <td width="305px">
                                                            <button type="button" class="btn btn-primary btn-sm subcategory_edit" id="{{$row->id}}" >Edit</button>
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

    <div class="modal fade" id="addsubcategory" tabindex="1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog model-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="">Add Subcategory</h4>
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
                    <form action="{{route('subcategory.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <label class="" for="">Sub Category:</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" name="subcategory_name" class="form-control" id="" placeholder="Subcategory Name" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <label class="" for="">Category name :</label>
                                </div>
                                <div class="col-md-7">
                                    <select class="form-control" name="cate_id" id="">
                                        <option value="">Select Category</option>
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
                                    <label class="" for="">Subcategory Image :</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="file" name="subcatimage" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary savebtn_valid">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="Editsubcategory" tabindex="1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog model-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id=""> Subcategory Edit</h4>
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
                    <form action="" class="subcategoryeditdata" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="oldimage" id="old_image">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <label class="" for="">Sub Category:</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" name="subcategory_name" class="form-control" id="subcategory_edit" placeholder="Subcategory Name" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <label class="" for="">Category name :</label>
                                </div>
                                <div class="col-md-7">
                                    <select class="form-control" name="cate_id" id="categoryid">
                                        <option value="">Select Category</option>
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
                                    <label class="" for="">Subcategory Image :</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="file" name="subcatimage" class="form-control">
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
        $(function(){
            $('.subcategory_edit').on('click', function(){
                var subcatid = $(this).attr("id");
                $.ajax({
                    type: 'GET',
                    url:'/subcategory_edit/'+subcatid,
                    success: function (data) {
                        $("#subcategory_edit").val(data.name);
                        $("#old_image").val(data.subcat_image);
                        $("#categoryid").val(data.categorie_id);
                        $('.subcategoryeditdata').attr('action', '/subcategory/'+subcatid);
                    }
                });

                $("#Editsubcategory").modal('show');

            });

            var count = 0;
            $(".savebtn_valid").click(function (event){
                count++;
                //alert(count);
                if (count >1){
                    $('.savebtn_valid').attr('disabled','disabled');
                    $(this).prop("disabled",true);
                    $(this).attr("disabled","disabled");
                }
            });

        });
    </script>
@endsection
