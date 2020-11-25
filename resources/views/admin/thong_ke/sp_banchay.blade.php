@extends('admin.master')
@section('content')
<style>
  table, th, td {
    text-align: center;
}
.main-menu>ul.l-inline> li> a {
    color: #4a1e1e;
    padding: 10px 35px;
}
</style>
<div>
@include('admin.thong_ke.menu');
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">name</th>
      <th scope="col">so luong da ban ra</th>

    </tr>
  </thead>
  <tbody>
    <?php $stt =0;foreach($bill as $pro): $stt++ ?>
    <tr>
      <th scope="row">{{$stt}}</th>
      <td><?php echo \App\Models\Product::find($pro->id_product)->name ?></td>
      <td>{{$pro->count}}</td>
    </tr>

    <?php endforeach  ?>
  </tbody>
</table>
</div>
@endsection