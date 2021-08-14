@extends('admin_template.layouts.v_template_admin')
@section('judul','Halaman Item Order')
@section('notifikasi')
    @if (session('status'))
        <div class="alert alert-success mx-3 text-center" style="width: 500px">
            {{session('status')}}
        </div>
    @endif
@endsection
@section('content-order')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="/dashboard/orderitems/{{$order_id}}" method="POST" id="form-order-items">
                        <!-- untuk keamanan -->
                            @csrf
                            <div class="d-flex">
                                <div class="form-group  col-md-6">
                                        <label for="product_id">Product  : </label>
                                        <select name="product_id" id="product_id"
                                             class=" @error('product_id') is-invalid @enderror form-control">
                                            <option selected="" disabled="">Pilih Product</option>
                                                @foreach ( $products as $product)
                                                    <option value="{{$product->id}}"> {{$product->product}} </option>
                                                @endforeach
                                        </select>
                                        @error('product_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group  col-md-6 ">
                                    <label for="quantity">Quantity : </label>
                                    <input type="number" id="quantity" name="quantity"
                                    class=" @error('quantity') is-invalid @enderror form-control">
                                    @error('quantity') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <input type="hidden" id="order_id"   name="order_id" value="{{$order_id}}"
                            class=" @error('quantity') is-invalid @enderror form-control">
                            @error('order_id') <div class="invalid-feedback">{{ $message }}</div> @enderror

                            <button type="submit" class="btn btn-primary mx-2">Tambah Item Order</button>

                        </form>
                </div>
            </div>
            <div class="card">
                    <div class="card-body text-center">
                        <table class="table table-hover">
                          <thead>
                              <tr>
                                <th>NO</th>
                                <th>Pembeli</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                @if (auth()->user()->level == 'ADMIN')
                                   <th>Aksi</th>
                                @elseif(auth()->user()->level == 'USER')
                                @endif
                              </tr>
                          </thead>

                          <tbody id="data-item">
                              <?php $i = 1; ?>
                              @foreach ($order_items as $orders)
                                  <tr>
                                      <td><?php echo $i++; ?></td>
                                      <td>{{$orders->nama}}</td>
                                      <td>{{$orders->product}}</td>
                                      <td>{{$orders->quantity}}</td>
                                      @if (auth()->user()->level == 'ADMIN')
                                          <td>
                                              <a href="/dashboard/orderitems/{{$orders->id}}/edit_orderitems" class="btn btn-primary btn-sm mx-2">
                                                <i class="fas fa-edit mx-1"></i>Update</a>
                                              <form action="/dashboard/orderitems/{{$orders->id}}" method="POST" class="d-inline" >
                                                  @method("delete")
                                                  @csrf
                                                  <button type="submit" class="btn btn-danger  btn-sm"><i class="fas fa-trash mx-1"></i>Delete</button>
                                              </form>
                                          </td>
                                      @elseif(auth()->user()->level == 'USER')
                                      @endif
                                  </tr>
                               @endforeach
                          </tbody>
                        </table>
                        <br>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
    <script>
        $(document).ready(function(e){
            $('#form-order-items').on('submit',function(e){
                e.preventDefault();
               const order_id = $('#order_id').val();
               const product_id = $('#product_id').val();
               const quantity = $('#quantity').val();

               $.ajax({
                   type : 'POST',
                   url  : '/api/orderitems/' + order_id,
                   data : {
                       'order_id'   : order_id,
                       'product_id' : product_id,
                       'quantity'   : quantity
                       },
                  success:function(result){
                    // console.log(result);
                    $('#data-item').html(updateTable(result.data));
                    $('#product_id').val('');
                    $('#quantity').val('');
                  }
               });
            });
        });



        $(document).on('click',function(e){
            if($(e.target).hasClass('btn-delete')){
                const order_id = $(e.target).data('order-id');
                const id = $(e.target).data('id');
                $.ajax({
                    type:'DELETE',
                    url: `/api/orderitems/${order_id}/delete/${id}`,
                    success: function(result){
                        // console.log(result);
                        $('#data-item').html(updateTable(result.data));
                        $('#quantity').val('');
                  }
                });
            }
        })


        function updateTable(data){
            let table = '';
            data.forEach((d,i) => {
                table +=`
                <tr>
                    <td>${i+1}</td>
                    <td>${d.nama}</td>
                    <td>${d.product}</td>
                    <td>${d.quantity}</td>
                     <td>
                        <a href="/dashboard/orderitems/${d.id}/edit_orderitems" class="btn btn-primary btn-sm mx-2">
                            <i class="fas fa-edit mx-1"></i>Update</a>

                            <button type="submit" class="btn btn-danger  btn-sm btn-delete"
                            data-order-id='${d.order_id}'
                            data-id='${d.id}'
                            onclick="return confirm('Apakah Anda Yakin Menghapus Data ini')">
                            <i class="fas fa-trash mx-1"></i>Delete</button>
                    </td>
                </tr>`;
            });
                return table
        }
    </script>
@endpush




