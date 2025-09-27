<!DOCTYPE html>
<html>
<head>
    <title>My Courses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="d-flex justify-content-between mb-3">
        <h2>My Courses</h2>
    </div>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Price</th>
                {{-- <th>Actions</th> --}}
            </tr>
        </thead>
        <tbody>
            @forelse($courses as $course)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $course->title }}</td>
                    <td>${{ number_format($course->price, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No courses found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

</body>
</html>
