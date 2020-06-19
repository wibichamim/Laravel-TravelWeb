@extends('layouts.admin')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Gallery</h1>
    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors ->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('gallery.update',$item->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="travel_packages_id">Paket Travel</label>
                    <select name="travel_packages_id" class="form-control">
                        <option value="{{ $item->travel_packages_id }}">Jangan Diubah</option>
                        @foreach($travel_packages as $travel_package)
                            <option value="{{ $travel_package->id }}">
                                {{ $travel_package->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" placeholder="Image" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary btn-block">Simpan</button>

            </form>
        </div>
    </div>



</div>
<!-- /.container-fluid -->
@endsection
