@extends('admin_template.layouts.v_template_admin')
@section('judul','Halaman Update Data User')
@section('content-insert')

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <form action="/dashboard/user/{{$user->id}}" method="POST" >
            <!-- untuk keamanan -->
            @method("patch")
            @csrf
                    <div class="form-group col-md-6 ">
                        <label for="nama">Nama : </label>
                        <input type="text" name="nama" value="{{old('nama',$user->nama)}}"
                        class=" @error('nama') is-invalid @enderror form-control">
                        @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group col-md-6 ">
                        <label for="email">Email : </label>
                        <input type="email" name="email" value="{{old('email',$user->email)}}"
                        class=" @error('email') is-invalid @enderror form-control">
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group col-md-6 ">
                        <label for="password">Password : </label>
                        <input type="password" name="password" value="{{old('password',$user->password)}}"
                        class=" @error('password') is-invalid @enderror form-control">
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
            <button type="submit" class="btn btn-primary mx-2">Edit Data User</button>
         </form>
        </div>
    </div>
</div>
@endsection




