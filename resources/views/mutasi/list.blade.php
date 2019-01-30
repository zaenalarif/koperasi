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
        <div class="box-header">
          <h3 class="box-title">Daftar Transaksi</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example2" class="table table-bordered table-hover">
            <thead>
            <tr>
              <th>Nama</th>
              <th>Withdraw</th>
              <th>Setoran</th>
              <th>Waktu</th>
              <th>Saldo</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($transactions as $transaction)
            <tr>
                <td>{{ $transaction->member->nama }}</td>
                <td>{{ $transaction->withdraw > 0 ? 'Rp '.$transaction->withdraw : '-' }}</td>
                <td>{{ $transaction->menyetor > 0 ? 'Rp '.$transaction->menyetor : '-'}}</td>
                <td>{{ $transaction->created_at }} </td>                
                <td>{{ 'Rp '.$transaction->tabungan->saldo }} </td>                
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