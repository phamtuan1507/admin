@extends('layouts.app', ['title' => 'Danh mục'])

@section('content')

@if($errors->first('message'))
<div class="col-12">
    <div class="border-left-primary alert alert-danger" role="alert">
        {{ $errors->first('message') }}
    </div>
</div>
@endif
@if(Session::has('message'))
<div class="col-8">
    <div class="border-left-primary alert alert-info" role="alert">
        {{ Session::get('message') }}
    </div>
</div>
@endif
<!-- Begin Page Content -->
<div class="container-fluid mb-5">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-folder"></i> Danh mục</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('category.index') }}" method="GET">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <a href="{{ route('category.create') }}" class="btn btn-primary btn-sm"
                                        style="padding-top: 10px;"><i class="fa fa-plus-circle"></i>
                                        @lang('web.add')</a>
                                </div>
                                <input type="text" class="form-control" name="q"
                                    placeholder="Vui lòng nhập thông tin">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                                        @lang('web.search')
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" style="text-align: center;width: 6%">STT</th>
                                    <th scope="col">Ảnh</th>
                                    <th scope="col">Tên danh mục</th>
                                    <th scope="col" style="width: 15%;text-align: center">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($datas as $no => $category)
                                <tr>
                                    <th scope="row" style="text-align: center">
                                        {{ ++$no + ($datas->currentPage()-1) * $datas->perPage() }}
                                    </th>
                                    <td class="text-center">
                                        <img src="{{ $category->image }}" style="width:50px">
                                    </td>
                                    <td>{{ $category->name }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('category.edit', $category->id) }}"
                                            class="btn btn-sm btn-primary">
                                            <i class="fa fa-pencil-alt"></i>
                                        </a>

                                        <button onClick="Delete(this.id)" class="btn btn-sm btn-danger"
                                            id="{{ $category->id }}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <div class="alert alert-danger">
                                    Dữ liệu không tồn tại!
                                </div>

                                @endforelse
                            </tbody>
                        </table>
                        <div style="text-align: center">
                            {{ $datas->links("vendor.pagination.bootstrap-5") }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<script>
//ajax delete
function Delete(id) {
    var id = id;
    var token = $("meta[name='csrf-token']").attr("content");
    swal({
        title: "Bạn chắc chắn muốn xoá?",
        text: "MUỐN XÓA DỮ LIỆU NÀY!",
        icon: "warning",
        buttons: [
            'Không',
            'Có'
        ],
        dangerMode: true,
    }).then(function(isConfirm) {
        if (isConfirm) {
            //ajax delete
            jQuery.ajax({
                url: "/category/" + id,
                data: {
                    "id": id,
                    "_token": token
                },
                type: 'DELETE',
                success: function(response) {
                    if (response.status == "success") {
                        swal({
                            title: 'BERHASIL!',
                            text: 'DATA BERHASIL DIHAPUS!',
                            icon: 'success',
                            timer: 1000,
                            showConfirmButton: false,
                            showCancelButton: false,
                            buttons: false,
                        }).then(function() {
                            location.reload();
                        });
                    } else {
                        swal({
                            title: 'GAGAL!',
                            text: 'DATA GAGAL DIHAPUS!',
                            icon: 'error',
                            timer: 1000,
                            showConfirmButton: false,
                            showCancelButton: false,
                            buttons: false,
                        }).then(function() {
                            location.reload();
                        });
                    }
                }
            });

        } else {
            return true;
        }
    })
}
</script>
@endsection
