<!DOCTYPE html>
<html>
<head>
    <title>Courses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="d-flex justify-content-between mb-3">
        <h2>Courses</h2>
        @if(auth()->user()->role == 'admin')
            <a href="{{ route('courses.create') }}" class="btn btn-primary">Create Course</a>
        @else
            <a href="{{ route('courses.mycourse') }}" class="btn btn-primary">My Course</a>
        @endif
        <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>
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
                @if(auth()->user()->role == 'admin')
                <th>Status</th>
                @endif
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($courses as $course)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $course->title }}</td>
                    <td>${{ number_format($course->price, 2) }}</td>
                    @if(auth()->user()->role == 'admin')
                    <td>
                        @if($course->status)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-secondary">Inactive</span>
                        @endif
                    </td>
                    @endif
                    <td>
                        @if(auth()->user()->role == 'admin')
                        <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        @else
                        <a href="{{ route('courses.enroll', $course->id) }}" class="btn btn-sm btn-success">{{$course->subscribe->status??false?'Subscribed':'Enroll'}}</a>
                        @endif
                    </td>
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
