@extends('admin_template.layouts.v_template_admin')
@section('judul','Halaman Tambah Order')
@section('content-order')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="/dashboard/order/{{$order->id}}/edit_order" method="POST" >
                        <!-- untuk keamanan -->
                            @method('patch')
                            @csrf

                            <div class="d-flex ">
                                <div class="form-group col-md-6">
                                        <label for="pembeli">Pembeli  : </label>
                                        <select name="pembeli" id="pembeli"
                                        class=" @error('pembeli') is-invalid @enderror form-control">
                                            <option selected="" disabled="">Pilih Pembeli</option>
                                            @foreach ($user as $users)
                                                <option value="{{$users->id}}"
                                                    {{ old('id', $order->user_id) == $users->id ? 'selected' : '' }}>
                                                    {{$users->nama}}
                                                </option>
                                            @endforeach
                                        </select>
                                    @error('pembeli') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div  class="form-group col-md-6">
                                    <label for="tanggal_order">Tanggal_Order : </label>
                                    <input type="date" name="tanggal_order" value="{{old('tanggal_order',$order->tanggal_order)}}"
                                    class=" @error('tanggal_order') is-invalid @enderror form-control">
                                    @error('tanggal_order') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary  mx-2">Edit Data Order</button>
                     </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection




