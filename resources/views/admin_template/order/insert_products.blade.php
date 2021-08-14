@extends('admin_template.layouts.v_template_admin')
@section('judul','Halaman Tambah Data Product')
@section('content-insert')


<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <form action="{{url("/dashboard/product")}}" method="POST" >
            <!-- untuk keamanan -->
                @csrf
                <div class="d-flex justify-content-around">
                    <div class="form-group col-md-5 ">
                        <label for="category_id">Category  : </label>
                        <select name="category_id" id="category_id" class="form-control">
                            @foreach ( $categories as $row)
                                <option value="{{$row->id}}"> {{$row->nama}} </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-5 ">
                        <label for="code">Code : </label>
                        <input type="number" name="code" value="{{old('code')}}"
                        class=" @error('code') is-invalid @enderror form-control">
                        @error('code') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-around">

                    <div class="form-group col-md-5 ">
                        <label for="product">Product : </label>
                        <input type="text" name="product" value="{{old('product')}}"
                        class=" @error('product') is-invalid @enderror form-control">
                        @error('product') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group col-md-5 ">
                        <label for="stock">Stock : </label>
                        <input type="number" name="stock" value="{{old('stock')}}"
                        class=" @error('stock') is-invalid @enderror form-control">
                        @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-around">
                    <div class="form-group col-md-5 ">
                        <label for="varian">Varian : </label>
                        <input type="text" name="varian" value="{{old('varian')}}"
                        class=" @error('varian') is-invalid @enderror form-control">
                        @error('varian') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group col-md-5 ">
                        <label for="keterangan">Keterangan : </label>
                        <input type="text" class=" @error('keterangan') is-invalid @enderror form-control"
                        name="keterangan" value="{{old('keterangan')}}">
                        @error('keterangan') <div class="invalid-feedback">{{ $message}}</div> @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mx-5">Tambah Data Product</button>
         </form>
        </div>
    </div>
</div>
@endsection




