@extends('../menus/apps')

@section('content')

@if (session('msg'))
    <div class="small-box bg-success">
        <div class="inner">
            {{ session('msg') }}
        </div>
    </div>    
@endif

<div class="box">
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example2" class="table table-bordered table-hover">
            <thead>
            <tr>
              <th>No Rekening</th>
              <th>ktp</th>
              <th>Nama</th>
              <th>Alamat</th>
              <th>Saldo</th>
              <th>Option</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($members as $member)
            <tr>
                <td>{{ $member->tabungan->norekening }}</td>
                <td>{{ $member->ktp }}</td>
                <td>{{ $member->nama}}</td>
                <td>{{ $member->alamat}}</td>
                <td>{{ $member->tabungan->saldo }}</td>
                <td>
                    <a href="/member/{{ $member->id }}/edit" class="btn btn-primary btn-sm">edit</a>
                    <form action="/member/{{$member->id}}" style="display: inline" method="POST">
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        @method('DELETE')
                        {{ csrf_field() }}
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
            <tfoot>
           
            </tfoot>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
@endsection