@extends('Layouts.sidebar')

@section('content')
    <div class="container mt-5">
        <h1>Categories</h1>
        <p>Welcome to the categories page. Here you can manage your restaurant's categories.</p>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>is Active</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Category rows will be populated here -->
            </tbody>
        </table>
    </div>
@endsection