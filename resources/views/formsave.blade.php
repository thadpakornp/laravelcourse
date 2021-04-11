@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('admin.form-save-store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="storename" class="form-control" placeholder="ชื่อร้านค้า">
        <input type="text" name="description" class="form-control" placeholder="รายละเอียดร้านค้า">
        <input type="text" name="price" class="form-control" placeholder="ราคา">
        <input type="file" name="img" class="form-control">
        <button type="submit" class="btn btn-primary">บันทึก</button>
    </form>
</div>
@endsection
