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

<nav class="main-menu">
					<ul class="l-inline ov">
						<li><a href="{{route('spbanchay')}}">Sản phẩm bán chạy</a></li>
						<li><a href="{{route('spbancham')}}">Sản phẩm bán chậm</a></li>
						<li><a href="{{route('thang')}}">Doanh thu theo tháng</a></li>
						<li><a href="{{route('tuan')}}">Doanh thu theo tuần</a></li>
					</ul>
					<div class="clearfix"></div>
</nav>
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
  <?php $sum = 0?>
    <?php $stt =0;foreach($bill as $pro): $stt++ ?>
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
    <td colspan="3"> Tổng </td>
    <td> <?php echo number_format($sum)?> </td>
    <td></td>
    </tr>
  </tbody>
</table>
</div>
@endsection