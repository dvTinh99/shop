@extends('admin.master')
@section('content')
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">id_cus</th>
      <th scope="col">date</th>
      <th scope="col">total</th>
      <th scope="col">paymen</th>
      <th scope="col">note</th>
      <th scope="col">trang thai</th>
      <th scope="col">create</th>
    </tr>
  </thead>
  <tbody>
    <?php $stt =0;foreach($bill as $pro): $stt++ ?>

    <tr>
      <th scope="row">{{$stt}}</th>
      <!-- <td>{{$pro->id}}</td> -->
      <td><?php echo \App\Models\Customer::find($pro->id_customer)->name ?></td>
      <td>{{$pro->date_order}}</td>
      <td>{{$pro->total}}</td>
      <td>{{$pro->payment}}</td>
      <td>{{$pro->note}}</td>
      <form action="{{route('trangthai')}}" method='post'>
      {{csrf_field()}}
      @if($pro->trang_thai == 0)
      <td>
      <button type="submit" class="btn btn-warning">Đang giao</button>
      <input name ="id" type="hidden" value ="{{$pro->id}}">
      </td>
      @else
      <td>
      <button type="submit" class="btn btn-success">đã giao</button>
      <input name ="id" type="hidden" value ="{{$pro->id}}">
      </td>
      @endif
      </form>
      <td>{{$pro->created_at}}</td>
    </tr>
    <?php endforeach   ?>
  </tbody>
</table>
@endsection