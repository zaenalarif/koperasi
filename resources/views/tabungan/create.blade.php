@extends('../menus/apps')

@section('content')

   <!-- general form elements -->
   <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Daftar Anggota</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form role="form" method="POST" action="/tabungan/create">
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

        <div class="form-group">
          <label for="">KTP</label>
        <input type="text" class="form-control" name="ktp" placeholder="KTP" value="{{ old('ktp') }}">
        </div>
        
        @if (session('noktp'))
        <div class="small-box bg-red">
            <div class="inner">
                {{ session('noktp') }}
            </div>
        </div>    
        @endif

        <div class="form-group">
            <label for="">No Rekening</label>
        <input type="text" class="form-control" name="norekening" placeholder="norekening" value="{{ old('norekening') }}">
        </div>
        <div class="form-group">
            <label for="">Saldo</label>
        <input type="text" id="rupiah" class="form-control" name="saldo" placeholder="saldo" value="{{ old('saldo') }}">
        </div>
      </div>
      <!-- /.box-body -->
      {{ csrf_field() }}
      <div class="box-footer">
        <button type="submit" class="btn btn-block btn-primary">Tambah Rekening</button>
      </div>
    </form>
  </div>
  <!-- /.box -->

@endsection

