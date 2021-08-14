@extends('admin_template.layouts.v_template_admin')
@section('judul','Halaman Product')
@section('notifikasi')

    @if (session('status'))
        <div class="alert alert-success mx-3 text-center" style="width: 500px">
            {{session('status')}}
        </div>
    @endif
@endsection
@section('content-product')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
              @if (auth()->user()->level == 'ADMIN')
                  <div class="d-flex justify-content-start mt-3 mx-4">
                      <a href="product/insert" class="btn btn-primary">Tambah Product</a>
                  </div>
              @elseif(auth()->user()->level == 'USER')
              @endif
            <div class="card-body text-center">
                <table class="table  table-hover">
                  <thead>
                      <tr>
                        <th>No</th>
                        <th>Code</th>
                        <th>Category</th>
                        <th>Product</th>
                        <th>Stock</th>
                        <th>Varian</th>
                        <th>Keterangan</th>
                          @if (auth()->user()->level == 'ADMIN')
                              <th>Aksi</th>
                          @elseif(auth()->user()->level == 'USER')
                          @endif
                      </tr>
                  </thead>

                  <tbody class="search-result">
                      <?php $i = 1; ?>
                      @foreach ($products as $product)
                          <tr>
                              <td><?php echo $i++; ?></td>
                              <td>{{$product->code}}</td>
                              <td>{{$product->category->nama}}</td>
                              <td>{{$product->product}}</td>
                              <td>{{$product->stock}}</td>
                              <td>{{$product->varian}}</td>
                              <td>{{$product->keterangan}}</td>
                              @if (auth()->user()->level == 'ADMIN')
                              <td>
                                  <a href="/dashboard/product/{{$product->id}}/edit" class="btn btn-primary btn-sm mb-1">Update</a>
                                  <form action="/dashboard/product/{{$product->id}}" method="POST" class="d-inline" >
                                      @method("delete")
                                      @csrf
                                      <button type="submit" class="btn btn-danger btn-sm">Delete </button>
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
                  {{$products->links()}}
                 </span>
            </div>
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

@push('script-search')
  <script>
    $(document).ready(function(){
        $('#search').on('keyup',function(){
            const search = $(this).val();
            if(search != ''){
                $.ajax({
                   type:'get',
                   url:"{{url('/dashboard/product/search')}}",
                   data:{
                       search:search
                    },
                    dataType:'json',
                    success:function(data){
                        $output = "";
                        $(".search-result").html('');
                        let i = 1;
                        $.each(data,function(index,value){
                            $output +=
                                `<tr>
                                    <td>` + (i++)         + `</td>
                                    <td>` + value.code          + `</td>
                                    <td>` + value.category_id   + `</td>
                                    <td>` + value.product       + `</td>
                                    <td>` + value.stock         + `</td>
                                    <td>` + value.varian        + `</td>
                                    <td>` + value.keterangan    + `</td>
                                    <td>
                                        <a href="/dashboard/product/{{$product->id}}/edit" class="btn btn-primary btn-sm mb-1">Update</a>
                                        <form action="/dashboard/product/{{$product->id}}" method="POST" class="d-inline" >
                                            @method("delete")
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">Delete </button>
                                        </form>
                                    </td>
                                </tr>`;
                        $(".search-result").html($output);
                    });
                 }
             });
            }
          });
        });
  </script>
@endpush
