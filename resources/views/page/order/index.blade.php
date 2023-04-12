@extends('layouts.app', ['title' => 'Đơn hàng'])
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-shopping-cart"></i> Đơn hàng</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('order.index') }}" method="GET">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="q"
                                    placeholder="Tìm kiếm đơn hàng">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Tìm kiếm
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" style="text-align:center;width: 6%">STT.</th>
                                    <th scope="col">STT. Hoá đơn</th>
                                    <th scope="col">Họ và tên</th>
                                    <th scope="col">Tổng</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col" style="width:15%;text-align: center">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($datas as $no => $invoice)
                                <tr>
                                    <th scope="row" style="text-align:center">
                                        {{ ++$no + ($datas->currentPage()-1) * $datas->perPage() }}
                                    </th>
                                    <td>{{ $invoice->invoice }}</td>
                                    <td>{{ $invoice->name }}</td>
                                    <td class="text-center">{{ $invoice->status }}</td>
                                    <td>{{ moneyFormat($invoice->grand_total) }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('order.show', $invoice->id) }}"
                                            class="btn btn-sm btn-primary">
                                            <i class="fa fa-list-ul"></i>
                                        </a>
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
                            {{$datas->links("vendor.pagination.bootstrap-5") }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection
