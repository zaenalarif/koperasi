@extends('../menus/apps')

@section('content')

   <!-- general form elements -->
   <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Daftar Anggota</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form role="form" method="POST" action="/member/create">
      <div class="box-body">

        @foreach ($errors->all() as $err)
            <div class="small-box bg-red">
                <div class="inner">
                    {{ $err }}
                </div>
            </div>    
        @endforeach

        @if (session('msg'))
            <div class="small-box bg-success">
                <div class="inner">
                    {{ session('msg') }}
                </div>
            </div>    
        @endif

        @if (session('err'))
            <div class="small-box bg-success">
                <div class="inner">
                    {{ session('err') }}
                </div>
            </div>    
        @endif

        <div class="form-group">
          <label for="">KTP</label>
        <input type="text" class="form-control" name="ktp" placeholder="KTP" value="{{ old('ktp') }}">
        </div>
        <div class="form-group">
            <label for="">Nama</label>
        <input type="text" class="form-control" name="nama" placeholder="Nama" value="{{ old('nama') }}">
        </div>
        <div class="form-group">
            <label for="">Alamat</label>
        <input type="text" class="form-control" name="alamat" placeholder="Alamat" value="{{ old('alamat') }}">
        </div>
      </div>
      <!-- /.box-body -->
      {{ csrf_field() }}
      <div class="box-footer">
        <button type="submit" class="btn btn-block btn-primary">Tambah</button>
      </div>
    </form>
  </div>
  <!-- /.box -->

@endsection