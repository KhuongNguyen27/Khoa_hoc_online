@extends('admin.layouts.master')
@section('content')
<header class="page-title-bar">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active">
                <a href="{{ route('categories.index') }}"><i class='bx bx-chevrons-left mr-2'></i>Trang Chủ</a>
            </li>
        </ol>
    </nav>
    <!-- <button type="button" class="btn btn-success btn-floated"><span class="fa fa-plus"></span></button> -->
    <div class="d-md-flex align-items-md-start">
        <h1 class="page-title mr-sm-auto">Danh mục khóa học</h1>
        <div class="btn-toolbar">
            <a href="{{ route('categories.create') }}" class="btn btn-primary mr-2">
                <i class='bx bx-add-to-queue'></i>
                <span class="ml-1">Tạo mới</span>
            </a>
            <!-- <a href="#" class="btn btn-primary">
                <i class='bx bx-vertical-bottom'></i>
                <span class="ml-1">Export excel</span>
            </a> -->
        </div>
    </div>
</header>
@if (session('success'))
<div class="alert alert-success" role="alert">
    {{ session('success') }}
</div>
@endif
@if (session('error'))
<div class="alert alert-danger" role="alert">
    {{ session('error') }}
</div>
@endif
<div class="page-section">
    <div class="card card-fluid">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active " href="#">Tất cả</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="#">Trash</a>
                </li> -->
            </ul>
        </div>
        <div class="card-body">
            <div class="row mb-2">
                <div class="col">
                    <form action="" method="GET" id="form-search">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col">
                                    <input name="id" class="form-control" type="text" placeholder="Id..." value="" />
                                </div>
                                <div class="col">
                                    <input name="searchname" class="form-control" type="text"
                                        placeholder="Tên danh mục..." value="" />
                                </div>
                                <div class="col">
                                    <input name="searchdescription" class="form-control" type="text" placeholder="Mô tả"
                                        value="" />
                                </div>
                                <div class="col-lg-2">
                                    <button style='float:right' class="btn btn-secondary" data-toggle="modal"
                                        data-target="#modalSaveSearch" type="submit">Tìm Kiếm</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th>Danh mục</th>
                                    <th>Mô tả</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $category)
                                <tr>
                                    <td class="align-middle">{{ $category->id }}</td>
                                    <td>
                                        <a href="#" class="tile tile-img mr-1">
                                            <img class="img-fluid" src="{{ asset($category->image_url) }}" alt="">
                                        </a>
                                        {{ $category->name }}
                                    </td>
                                    <td class="align-middle">{{ $category->description }}</td>
                                    <td class='d-flex justify-content-center align-items-center'>
                                        <span class="sr-only">Edit</span>
                                        <a href="{{ route('categories.edit', $category->id) }}"
                                            class="btn btn-sm btn-icon btn-secondary">
                                            <i class='bx bx-edit-alt'></i>
                                            <span class="sr-only">Remove</span>
                                        </a>
                                        <form style="display:inline" method="post"
                                            action="{{ route('categories.destroy',$category->id) }}">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-sm btn-icon btn-secondary"
                                                onclick="return confirm('Are you sure?')">
                                                <i class='bx bx-trash'></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div style="float:right">
                            {{ $items->appends(request()->query())->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection