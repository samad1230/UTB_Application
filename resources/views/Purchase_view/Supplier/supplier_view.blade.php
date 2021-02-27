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
                                            <button class="btn btn-primary btn-md m-1" type="button" data-toggle="modal" data-target="#addsupplier"><i class="i-Add text-white mr-2"></i> Supplier Add</button>

                                        </div>
                                        <div class="table-responsive">
                                            <table class="table" id="ul-contact-list">
                                                <thead class="table-dark">
                                                <tr>
                                                    <th>SL</th>
                                                    <th>ID</th>
                                                    <th>Company</th>
                                                    <th>Person</th>
                                                    <th>Address</th>
                                                    <th>Mobile</th>
                                                    <th>Status</th>
                                                    <th>View</th>
                                                    <th>Edit</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $sl = 1; ?>
                                                    @foreach($supplier as $row)
                                                    <tr>
                                                        <td>{{$sl}}</td>
                                                        <td>{{$row->id}}</td>
                                                        <td>{{$row->company_name}}</td>
                                                        <td>{{$row->person_name}}</td>
                                                        <td>{{$row->address}}</td>
                                                        <td>{{$row->mobile}}</td>
                                                        <?php
                                                        if ($row->status=="1"){
                                                            $newstatus = "Active";
                                                        }else{
                                                            $newstatus = "Inactive";
                                                        }
                                                        ?>
                                                        <td>{{$newstatus}}</td>
                                                        <td><a href="#" class="btn btn-primary btn-sm" >view</a></td>
                                                        <td><button type="button" class="btn btn-success btn-sm supplier_edit" id="{{$row->id}}" >Edit</button></td>
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

    <div class="modal fade" id="addsupplier" tabindex="1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog model-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="">Add Supplier</h4>
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
                    <form action="{{ route('Supplier.store') }}" method="POST" enctype="multipart/form-data">
                        {{csrf_field()}}

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class=" " for="Showroom Name">Company Name</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="company_name" class="form-control" placeholder="Company Name" required="">
                                </div>
                            </div>
                        </div>

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class=" " for="Showroom Name">Contact Person</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="contact_person" class="form-control" placeholder="Contact Person" required="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class=" " for="Address">Address</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="address" class="form-control" id="" placeholder="Address" autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="Contact">Contact</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="mobile" class="form-control" id="mobile_add" placeholder="Contact" required="" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="Contact">Previous Ledger</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="previus_ledger" class="form-control"  placeholder="Previous Ledger">
                                </div>
                            </div>
                        </div>

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="Contact">Status</label>
                                </div>
                                <div class="col-md-8">
                                    <select name="status_id" class="form-control" id="" required>
                                        <option value="">Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
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


    <div class="modal fade" id="supplierupdate" tabindex="1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog model-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="">Update Supplier</h4>
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
                    <form action="" class="editsupplier_data" method="POST"  enctype="multipart/form-data">

                        @method('PUT')
                        @csrf

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class=" " for="Showroom Name">Company Name</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="companyname" class="form-control" placeholder="Company Name" id="company_name_edit">
                                </div>
                            </div>
                        </div>

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class=" " for="Showroom Name">Contact Person</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="contactperson" class="form-control" placeholder="Contact Person" id="contactperson_edit" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class=" " for="Address">Address</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="address_data" class="form-control" id="addressdata_edit" placeholder="Address" autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="Contact">Contact</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" name="mobileno" class="form-control" id="mobileno_edit" placeholder="Contact" required="" autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="Contact">Status</label>
                                </div>
                                <div class="col-md-8">
                                    <select name="status_id" class="form-control" id="newstatusid" required>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
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
            $('.supplier_edit').on('click', function(){
                var supplierid = $(this).attr("id");
                $.ajax({
                    type: 'GET',
                    url:'/Supplier/'+supplierid+'/edit',
                    success: function (data) {
                        $("#company_name_edit").val(data.company_name);
                        $("#contactperson_edit").val(data.person_name);
                        $("#addressdata_edit").val(data.address);
                        $("#mobileno_edit").val(data.mobile);
                        $("#newstatusid").val(data.status);

                        $('.editsupplier_data').attr('action', '/Supplier/'+supplierid);
                    }
                });

                $("#supplierupdate").modal('show');

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
