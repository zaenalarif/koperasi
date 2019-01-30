@extends('menus.apps')

@section('content')
<div class="row">
    <div class="container">

      @if (session('msg'))
        <div class="alert-success text-center">{{ session('msg') }}</div><br>
      @endif

      @if (session('err'))
        <div class="alert-danger text-center">{{ session('err') }}</div><br>
      @endif
        

        <div class="small-box bg-aqua">
            <div class="inner">
                    <p class="text-center">Jumlah Bunga Yang Akan Di kirim</p>
            <h3 class="text-center" id="rupiah" >Rp {{ $bunga }}</h3>
            </div>
        </div>
        <div class="small-box bg-aqua">
          <form action="/mutasi/bunga" method="POST">
            <button class="btn btn-block btn-primary" type="submit">Kirim Bunga</button>
            {{ csrf_field() }}
          </form>
        </div>
    </div>
</div>

<div class="box">
            <div class="box-header">
              <h3 class="box-title ">Daftar bunga</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>No</th>
                  <th>jumlah</th>
                  <th>created_at</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($bungas as $bunga)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>Rp {{ $bunga->jumlah}}</td>
                    <td>{{ $bunga->created_at}}</td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                <tr>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->


@endsection
