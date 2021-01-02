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
                                            <button class="btn btn-primary btn-md m-1" type="button" data-toggle="modal" data-target="#addcategories"><i class="i-Add text-white mr-2"></i> Add Categories</button>

                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-hover" id="ul-contact-list">
                                                <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col">SL</th>
                                                    <th scope="col">Categories Name</th>
                                                    <th scope="col">Image</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $sl = 1; ?>
                                                @foreach ($category as $row)
                                                    <tr>
                                                        <td>{{$sl}}</td>
                                                        <td>{{ $row->name }}</td>
                                                        <td><img src="{{ asset($row->categorie_image != null? 'Media/category/'. $row->categorie_image:'') }}" height="40px;" width="50px;"></td>

                                                        <td><a class="badge badge-primary m-2 p-2" href="#"><?php $statusnew = $row->status; if ($statusnew==1) {echo "Active";}else{echo "Insctive";} ?></a></td>
                                                        <td width="305px">
                                                            <button type="button" class="btn btn-primary btn-sm category_edit" id="{{$row->id}}" >Edit</button>
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

    <div class="modal fade" id="addcategories" tabindex="1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog model-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="">Add Category</h4>
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
                    <form action="{{route('categories.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="">Category name :</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="category_name" class="form-control" id="" placeholder="Category Name" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="">Category Image :</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="file" name="catimage" class="form-control">
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



    <div class="modal fade" id="categories_edit" tabindex="1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog model-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="">Add Category</h4>
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
                    <form action="" class="editupdate_category" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="oldimage" id="old_image">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="">Category name :</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="category_name" class="form-control" id="categore_editdata" placeholder="Category Name" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="">Category Image :</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="file" name="catimage" class="form-control">
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
            $('.category_edit').on('click', function(){
                var catid = $(this).attr("id");
                $.ajax({
                    type: 'GET',
                    url:'/categores_edit/'+catid,
                    success: function (data) {
                        //console.log(data);
                        $("#categore_editdata").val(data.name);
                        $("#old_image").val(data.categorie_image);
                        $('.editupdate_category').attr('action', '/categories/'+catid);
                    }
                });

                $("#categories_edit").modal('show');

            });

        });
    </script>
@endsection
