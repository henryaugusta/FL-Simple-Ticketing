@extends('main.app')

@section('page-breadcrumb')
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Supplier</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item text-muted active" aria-current="page">Supplier</li>
                        <li class="breadcrumb-item text-muted" aria-current="page">Edit Supplier</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-5 align-self-center">
            <div class="customize-input float-right">

            </div>
        </div>
    </div>
@endsection

@section('page-wrapper')


    @include('main.components.message')


    <div class="card border-success">
        <div class="card-header bg-success">
            <h4 class="mb-0 text-white">Edit Supplier Supplier</h4>
        </div>
        <div class="card-body">
            <h3 class="card-title">Edit Data Supplier</h3>

            <hr>

            <form action="{{ url('supplier/'.$data->id.'/edit') }}" method="post" enctype="multipart/form-data">
                @csrf


                <div class="form-group">
                    <label for="">Nama Supplier</label>
                    <input type="text" class="form-control" required name="nama" value="{{$data->nama_toko}}" placeholder="Nama Supplier">
                    <small class="form-text text-muted">Nama Supplier</small>
                </div>


                <div class="form-group">
                    <label for="">Kontak Supplier</label>
                    <input type="text" class="form-control" required name="kontak" value="{{$data->kontak}}" placeholder="Kontak Supplier">
                    <small class="form-text text-muted">Kontak Supplier</small>
                </div>

                <div class="form-group">
                    <label for="">Alamat Supplier</label>
                    <textarea class="form-control" name="alamat" id="" rows="3" placeholder="Alamat Supplier">{{$data->alamat}}</textarea>
                </div>

                <button type="submit" class="btn btn-block btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>





@endsection


@section('app-script')
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4-4.1.1/jszip-2.5.0/dt-1.10.23/b-1.6.5/b-colvis-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/cr-1.5.3/r-2.2.7/sb-1.0.1/sp-1.2.2/datatables.min.js">
    </script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js">
    </script>




    <script type="text/javascript">
        $(function() {
            var table = $('#table_santri').DataTable({
                processing: true,
                serverSide: true,
                columnDefs: [{
                    orderable: true,
                    targets: 0
                }],
                dom: 'T<"clear">lfrtip<"bottom"B>',
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
    
            });


            $('body').on("click", ".btn-add-new", function() {
                var id = $(this).attr("id")
                $(".btn-destroy").attr("id", id)
                $("#insert-modal").modal("show")
            });


            // Edit & Update
            $('body').on("click", ".btn-edit", function() {
                var id = $(this).attr("id")
                $.ajax({
                    url: "{{ URL::to('/') }}/mutabaah/" + id + "/fetch",
                    method: "GET",
                    success: function(response) {
                        $("#edit-modal").modal("show")
                        console.log(response)
                        $("#id").val(response.id)
                        $("#name").val(response.judul)
                        $("#edit_date").val(response.tanggal)
                        $("#role").val(response.role)
                    }
                })
            });

            // Reset Password
            $('body').on("click", ".btn-res-pass", function() {
                var id = $(this).attr("id")
                $(".btn-reset").attr("id", id)
                $("#reset-password-modal").modal("show")
            });

        });
    </script>




@endsection
