@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table">
                        <tr>
                            <td>
                                ชื่อ
                            </td>
                            <td>
                                รายละเอียด
                            </td>
                            <td>
                                ราคา
                            </td>
                            <td>
                                Actions
                            </td>
                        </tr>
                        @foreach ($stores as $store)
                        <tr>
                            <td>
                                {{ $store->name }}
                            </td>
                            <td>
                                {{ $store->description }}
                            </td>
                            <td>
                                {{ $store->price }}
                            </td>
                            <td>
                                <a href="{{ route('form-delete',$store->id) }}" class="text-warning">ลบ</a>
                                <a href="{{ route('form-edit',$store->id) }}" class="text-danger">แก้ไข</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
