@extends('admin_template.layouts.v_template_admin')
@section('judul','Halaman Tambah Data User')
@section('content-insert')

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <form action="{{url("/dashboard/user")}}" method="POST" >
            <!-- untuk keamanan -->
                @csrf
                    <div class="form-group col-md-6 ">
                        <label for="nama">Nama : </label>
                        <input type="text" name="nama" value="{{old('nama')}}"
                        class=" @error('nama') is-invalid @enderror form-control">
                        @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group col-md-6 ">
                        <label for="email">Email : </label>
                        <input type="email" name="email" value="{{old('email')}}"
                        class=" @error('email') is-invalid @enderror form-control">
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group col-md-6 ">
                        <label for="password">Password : </label>
                        <input type="password" name="password" value="{{old('password')}}"
                        class=" @error('password') is-invalid @enderror form-control">
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

            <button type="submit" class="btn btn-primary mx-2">Tambah Data User</button>
         </form>
        </div>
    </div>
</div>
@endsection




