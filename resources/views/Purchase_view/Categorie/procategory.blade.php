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
                                            <button class="btn btn-primary btn-md m-1" type="button" data-toggle="modal" data-target="#addprocategory"><i class="i-Add text-white mr-2"></i> Add Procategories</button>

                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-hover" id="ul-contact-list">

                                                <thead>
                                                <tr>
                                                    <th scope="col">SL</th>
                                                    <th scope="col">Subcategory Name</th>
                                                    <th scope="col">Pro Category Name</th>
                                                    <th scope="col">Image</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $sl = 1; ?>
                                                @foreach ($procategory as $row)
                                                    <tr>
                                                        <td>{{$sl}}</td>
                                                        <td>{{ $row->subcatname }}</td>
                                                        <td>{{ $row->name }}</td>
                                                        <td><img src="{{ asset($row->procat_image != null? 'Media/procategory/'. $row->procat_image:'') }}" height="40px;" width="50px;"></td>

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

    <div class="modal fade" id="addprocategory" tabindex="1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog model-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="">Add Procategory</h4>
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
                    <form action="{{route('procategory.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <label class="" for="">Pro Category:</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="text" name="procategory_name" class="form-control" id="" placeholder="Procategory Name" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <label class="" for="">Sub Category:</label>
                                </div>
                                <div class="col-md-7">
                                    <select class="form-control" name="subcat_id" id="">
                                        <option value="">Select Category</option>
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
                                    <label class="" for="">Procategory Image :</label>
                                </div>
                                <div class="col-md-7">
                                    <input type="file" name="procatimage" class="form-control">
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
