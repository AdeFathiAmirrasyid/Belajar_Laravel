@extends('admin_template.layouts.v_template_admin')
@section('judul','Halaman Order')
@section('notifikasi')
    @if (session('status'))
        <div class="alert alert-success mx-3 text-center" style="width: 500px">
            {{session('status')}}
        </div>
    @endif
@endsection
@section('content-order')
  <div class="card">
        @if (auth()->user()->level == 'ADMIN')
            <div class="d-flex justify-content-start mt-3 mx-4 ">
                <a href="order/insert_order" class="btn btn-primary" style="width: auto">Tambah Order</a>
            </div>
        @elseif(auth()->user()->level == 'USER')
        @endif

      <div class="card-body text-center">
          <table class="table table-hover">
            <thead>
                <tr>
                  <th>NO</th>
                  <th>Pembeli</th>
                  <th>Tanggal_Order</th>
                  <th>Aksi</th>
                </tr>
            </thead>

            <tbody class="data-item">
                <?php $i = 1; ?>
                @foreach ($data as $order)
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td>{{$order->nama}}</td>
                        <td>{{$order->tanggal_order}}</td>
                        <td>
                            @if (auth()->user()->level == 'ADMIN')
                                <a href="/dashboard/order/{{$order->id}}/edit_order" class="btn btn-primary btn-sm mx-2">
                                    <i class="fas fa-edit mx-1"></i>Update
                                </a>

                                <form action="/dashboard/order/{{$order->id}}" method="POST" class="d-inline" >
                                    @method("delete")
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash mx-1"></i>Delete</button>
                                </form>
                            @elseif(auth()->user()->level == 'USER')
                            @endif
                            <a href="/dashboard/orderitems/{{$order->id}}" class="btn btn-success btn-sm mx-2">Detail Product</a>
                        </td>
                    </tr>
                 @endforeach
            </tbody>
          </table>
          <br>

      </div>
  </div>
@endsection




