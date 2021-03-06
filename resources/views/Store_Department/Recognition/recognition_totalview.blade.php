@extends('Department_layouts.Store_master_layout')
@section('content')

    <div class="app-admin-wrap layout-sidebar-large">
        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <div class="main-content">
                @include('Common_header_footer.pagetitle')

                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive m-b-40">
                                <table class="table table-hover" id="ul-contact-list">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th>SL</th>
                                        <th>Recognition</th>
                                        <th>Date</th>
                                        <th>Total Item</th>
                                        <th>Status</th>
                                        <th>View</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php $sl = 1; ?>
                                    @foreach ($Recognition as $row)
                                        @php
                                            $item = \App\Recognition_model\Recognition_item::where('recognition_id',$row->id)->get();

                                        @endphp
                                        <tr>
                                            <td>{{ $sl}}</td>
                                            <td>{{ $row->recognition_no}}</td>
                                            <td>{{ $row->date}}</td>
                                            <td>{{ count($item)}}</td>
                                            <?php
                                            if ($row->status==0){
                                            ?>
                                            <td><a  class="btn-warning btn-sm"> Pending</a></td>
                                            <?php
                                            }else if($row->status==1){
                                            ?>
                                            <td><a  class="btn-success btn-sm"> Purchase Approve</a></td>
                                            <?php
                                            }else if($row->status==2){
                                            ?>
                                            <td><a  class="btn-danger btn-sm"> Dis-Approved</a></td>
                                            <?php
                                            }else{
                                            ?>
                                            <td><a  class="btn-success btn-sm"> All Approved</a></td>
                                            <?php
                                            }
                                            ?>
                                            <td><a href="{{route('Recognition.show',$row->id)}}" class="btn-primary btn-sm"> View</a></td>
                                        </tr>
                                        <?php $sl++; ?>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="text-center">
                                    {{ $Recognition->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="recognition_edit" tabindex="1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog model-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="">Recognition Update</h4>
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
                    <form action="" class="recognition_update" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf

                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="">Product name :</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="product_name" class="form-control" id="productname" placeholder="Product Name" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="">Recognition NO :</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="recognitionID" class="form-control" id="recognition_ID" placeholder="Recognition ID" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="" for="">Quantity :</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="Quantity" class="form-control" id="Quantity_edit" placeholder="Quantity" >
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
            $('.recogition_edit').on('click', function(){
                var editid = $(this).attr("id");
                $.ajax({
                    type: 'GET',
                    url:'/recognition_edit/'+editid,
                    success: function (data) {
                        $("#productname").val(data.product);
                        $("#recognition_ID").val(data.recognition_no);
                        $("#Quantity_edit").val(data.quantity);
                         $('.recognition_update').attr('action', '/Recognition/'+editid);
                    }
                });

                $("#recognition_edit").modal('show');

            });

        });
    </script>
@endsection

