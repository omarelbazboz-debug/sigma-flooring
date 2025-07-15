@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2>Features</h2>
            <a href="{{ route('features.create') }}" class="btn btn-primary mb-3">Add Feature</a>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name (EN)</th>
                        <th>Name (AR)</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($features as $feature)
                        <tr>
                            <td>{{ $feature->id }}</td>
                            <td>{{ $feature->name_en }}</td>
                            <td>{{ $feature->name_ar }}</td>
                            <td>
                                <a href="{{ route('features.edit', $feature->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('features.destroy', $feature->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
