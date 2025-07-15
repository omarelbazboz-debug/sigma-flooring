@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2>Edit Feature</h2>
            <form action="{{ route('features.update', $feature->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name_en" class="form-label">Name (EN)</label>
                    <input type="text" class="form-control" id="name_en" name="name_en" value="{{ $feature->name_en }}" required>
                </div>
                <div class="mb-3">
                    <label for="name_ar" class="form-label">Name (AR)</label>
                    <input type="text" class="form-control" id="name_ar" name="name_ar" value="{{ $feature->name_ar }}" required>
                </div>
                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('features.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
