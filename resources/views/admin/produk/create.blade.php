@extends('admin.template.master')
@section('css')
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">{{ $title }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">{{ $title }}</a></li>
                            <li class="breadcrumb-item active">{{ $subtitle }}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ $title }}</h3>
                        <a href="{{ route('produk.index') }}" class="btn btn-sm btn-warning float-right">Kembali</a>
                    </div>
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger" role="alert">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif
                    <div id="error-container" style="display:none">
                        <div class="alert alert-danger">
                            <p id="error-message"></p>
                        </div>
                    </div>

                    <div class="card-body">
                        <form id="form-create-produk" method="post">
                            <label for="">Nama Produk</label>
                            <input type="text" name="NamaProduk" class="form-control">
                            <label for="">Harga</label>
                            <input type="number" name="Harga" class="form-control">
                            <label for="">Stok</label>
                            <input type="number" name="stok" class="form-control">
                            <button class="btn btn-primary mt-2" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#form-create-produk').submit(function(e) {
                e.preventDefault();
                var dataForm = $(this).serialize() + "&_token={{ csrf_token() }}";
                $.ajax({
                    type: "POST",
                    url: "{{ route('produk.store') }}",
                    data: dataForm,
                    dataType: "json",
                    success: function(data) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: data.message || 'Produk berhasil disimpan.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        })
                        $('input[name="NamaProduk"]').val('');
                        $('input[name="Harga"]').val('');
                        $('input[name="stok"]').val('');
                    },
                    error: function(data) {
                        console.log(data.message);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.message,
                            confirmButtonText: 'OK'
                        })
                        if (data.status == 500) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: data.responseJSON.message,
                                confirmButtonText: 'OK'
                            })
                        }
                    }
                });
            });
        });
    </script>
@endsection
