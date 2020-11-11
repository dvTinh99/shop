@extends('admin.master')
@section('content')
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">tên</th>
      <th scope="col">loại</th>
      <th scope="col">mô tả</th>
      <th scope="col">giá gốc</th>
      <th scope="col">giá khuyến mãi</th>
      <th scope="col">hình ảnh</th>
      <th scope="col">Tùy chọn</th>
    </tr>
  </thead>
  <tbody>
    <?php $stt =0;foreach($product as $pro): $stt++ ?>

    <tr>
      <th scope="row">{{$stt}}</th>
      <td>{{$pro->name}}</td>
      <td><?php echo \App\Models\ProductType::find($pro->id_type)->name ?></td>
      <td>{{$pro->description}}</td>
      <td>{{$pro->unit_price}}</td>
      <td>{{$pro->promotion_price}}</td>
      <td>{{$pro->image}}</td>
      <td>
          <a href="{{route('delete',$pro->id)}}"><button type="button" class="btn btn-danger">XÓA</button></a>
          <a href="{{route('edit',$pro->id)}}" type="button" class="btn btn-warning">SỬA</a>
    </td>
    </tr>
    <?php endforeach   ?>
  </tbody>
</table>
@endsection