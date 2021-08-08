@extends('main.app')

@section('page-breadcrumb')
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Ticket</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item text-muted active" aria-current="page">Edit Data Ticket</li>
                        <li class="breadcrumb-item text-muted" aria-current="page">Edit Ticket</li>
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
        <div class="card-header bg-primary">
            <h4 class="mb-0 text-white">Edit Data Ticket No {{ $data->id }}</h4>
        </div>
        <div class="card-body">

            <form action="{{ url('admin/ticket/' . $data->id . '/edit') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="d-flex">
                    <h3 class="text-dark mr-2"><strong> Judul Keluhan : </strong></h3>
                    <h3 class="text-dark">{{ $data->ticket_title }}</h3>
                </div>
                <h3 class="text-dark mr-1"> <strong> Message Ticket : </strong></h3>
                <h3 class="text-dark">{{ $data->ticket_detail }}</h3>

                <h4 class="text-dark">Status Ticket : </h4>

                <div class="mt-1">
                    @if ($data->status == 3)
                        <button id="{{ $data->id }}" type="button" class="btn btn-warning">Pending</button>
                    @endif
                    @if ($data->status == 1)
                        <button id="{{ $data->id }}" type="button" class="btn btn-warning">Completed</button>
                    @endif
                    @if ($data->status == 2)
                        <button id="{{ $data->id }}" type="button" class="btn btn-warning">Progress</button>
                    @endif
                </div>

                <h3 class="text-dark mr-1 mt-2"> <strong> Pengirim : </strong></h3>
                <h3 class="text-dark">{{ $user->name }}</h3>
                <h3 class="text-dark mr-1"> <strong> Tanggal Dibuat : </strong></h3>
                <h3 class="text-dark">{{ $data->created_at }}</h3>
            </form>

            <hr>

        </div>
    </div>

    <div class="card border-success">
        <div class="card-header bg-dark">
            <h4 class="mb-0 text-white">Tambahkan Tanggapan</h4>
        </div>
        <div class="card-body">
            <div class="chat-box scrollable position-relative ps-container ps-theme-default"
                style="height: calc(100vh - 300px);" data-ps-id="1456ff32-4cc1-fff2-5065-9da0363bf007">
                <ul class="chat-list list-style-none px-3 pt-3">

                    @forelse ($discussions as $item)
                        @if ($item->user_detail->role == 2 || $item->user_detail->role == 1)
                            <!--chat Row admin -->
                            <li class="chat-item list-style-none mt-3">
                                <div class="chat-content d-inline-block pl-3">
                                    <h6 class="font-weight-medium">Admin Helpdesk</h6>
                                    <div class="msg p-2 d-inline-block mb-1  chat-text">
                                        <h4> {{ $item->message }} </h4>
                                    </div>
                                    <h6 class="">{{ $item->created_at }}</h6>
                            </li>
                        @endif

                        @if ($item->user_detail->role == 3)
                            <li class="chat-item odd list-style-none mt-3">
                                <div class="chat-content d-inline-block pl-3">
                                    <h6 class="font-weight-medium"> {{ $item->user_detail->name }}</h6>
                                    <div class="msg p-2 d-inline-block mb-1 chat-text">
                                        {{ $item->message }}
                                    </div>
                                    <h6 class="">{{ $item->created_at }}</h6>
                                </div>
                            </li>
                        @endif

                    @empty

                    <div class="alert alert-primary" role="alert">
                        <strong>Belum Ada Diskusi/Tanggapan, Silakan Menambahkan Pesan Melalui Kolom Dibawah</strong>
                    </div>
                    @endforelse



                </ul>
                <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;">
                    <div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                </div>
                <div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px;">
                    <div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                </div>
            </div>

            <form id="chat-submit" action="{{ url('ticket/discussion' . '/' . $data->id . '/post') }}" method="post">
                @csrf
                <input type="hidden" name="topic" value="{{ $data->id }}">
                <div class="card-body border-top">
                    <div class="row">
                        <div class="col-9">
                            <div class="input-field mt-0 mb-0">
                                <input id="textarea1" name="message" placeholder="Type and enter"
                                    class="form-control border-0" type="text">
                            </div>
                        </div>
                        <div class="col-3">

                            <a class="btn-circle btn-lg btn-cyan float-right text-white" href="#"
                                onclick="document.getElementById('chat-submit').submit();;return false;">
                                <i class="fas fa-paper-plane"></i></a>

                        </div>
                    </div>
                </div>
            </form>
            <hr>

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
