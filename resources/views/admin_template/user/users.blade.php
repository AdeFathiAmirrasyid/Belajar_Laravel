@extends('admin_template.layouts.v_template_admin')
@section('judul','Halaman Users')
@section('notifikasi')
    @if (session('status'))
        <div class="alert alert-success mx-3 text-center" style="width: 500px">
            {{session('status')}}
        </div>
    @endif
@endsection

@section('content-user')
<div class="container-fluid">
    <div class="card">
          @if (auth()->user()->level == 'ADMIN')
              <div class="d-flex justify-content-start mt-3 mx-4">
                  <a href="user/user" class="btn btn-primary" style="width: auto">Tambah User</a>
              </div>
          @elseif(auth()->user()->level == 'USER')
          @endif

        <div class="card-body text-center">
            <table class="table table-hover">
              <thead>
                  <tr>
                    <th>NO</th>
                    <th>Nama</th>
                    <th>Email</th>
                    @if (auth()->user()->level == 'ADMIN')
                      <th>Aksi</th>
                    @elseif(auth()->user()->level == 'USER')
                    @endif
                  </tr>
              </thead>

              <tbody>
                  <?php $i = 1; ?>
                  @foreach ($users as $user)
                      <tr>
                          <td><?php echo $i++; ?></td>
                          <td>{{$user->nama}}</td>
                          <td>{{$user->email}}</td>
                          @if (auth()->user()->level == 'ADMIN')
                              <td>
                                  <a href="/dashboard/user/{{$user->id}}/edit" class="btn btn-primary btn-sm mx-2">
                                    <i class="fas fa-edit mx-1"></i>Update</a>
                                  <form action="/dashboard/user/{{$user->id}}" method="POST" class="d-inline" >
                                      @method("delete")
                                      @csrf
                                      <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash mx-1"></i>Delete</button>
                                  </form>
                              </td>
                        @elseif(auth()->user()->level == 'USER')
                        @endif
                      </tr>
                   @endforeach
              </tbody>
            </table>
            <br>
             <span>
              {{$users->links()}}
             </span>
        </div>
    </div>
</div>

  <style>
      .text-sm{
          margin-top: 35px;
      }
    .w-5{
      height: 50px;
    }
  </style>
@endsection
