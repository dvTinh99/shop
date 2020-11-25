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
      <th scope="col">date</th>
      <th scope="col">total</th>
      <th scope="col">create</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($bill as $bi => $pr): ?>
    <?php $sum = $stt =0;foreach($pr as $pro):$stt++ ?>
    <?php $sum+= $pro->total ?>
    <tr>
      <th scope="row">{{$stt}}</th>
      <td><?php echo \App\Models\Customer::find($pro->id_customer)->name ?></td>
      <td>{{$pro->date_order}}</td>
      <td>{{number_format($pro->total)}}</td>
      </form>
      <td>{{$pro->created_at}}</td>
    </tr>
    <?php endforeach   ?>
    <tr>
    <td colspan="3"> Tổng doanh thu trong tuần </td>
    <td> <?php echo number_format($sum)?> </td>
    <td></td>
    </tr>
    <tr>
    <td colspan="5"> ######################## </td>
    </tr>
    <?php endforeach   ?>
    
  </tbody>
</table>
</div>
@endsection