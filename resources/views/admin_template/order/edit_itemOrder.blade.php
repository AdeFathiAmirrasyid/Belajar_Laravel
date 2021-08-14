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
                    <form action="/dashboard/orderitems/{{$order_items->id}}" method="POST" >
                        <!-- untuk keamanan -->
                            @method('patch')
                            @csrf

                            <div class="d-flex">
                                <div class="form-group col-md-6">
                                    <label for="product">Product  : </label>
                                    <select name="product" id="product"
                                    class=" @error('product') is-invalid @enderror form-control">
                                        @foreach ( $products as $product)
                                            <option value="{{$product->id}}"
                                                {{ old('id', $order_items->product_id) == $product->id ? 'selected' : '' }}>
                                                {{$product->product}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('product') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="quantity">Quantity : </label>
                                    <input type="text"  id="quantity" name="quantity" value="{{old('quantity',$order_items->quantity)}}"
                                    class=" @error('quantity') is-invalid @enderror form-control">
                                    @error('quantity') <div class="invalid-feedback">{{ $message }}</div> @enderror

                                    <input type="text" hidden id="order_id" name="order_id" value="{{$order_items->order_id}}">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mx-2">Edit Item Order</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection




