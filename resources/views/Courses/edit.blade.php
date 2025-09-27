<!DOCTYPE html>
<html>
<head>
    <title>Edit Course</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Course</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>There were some problems:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('courses.update', $course->id) }}" method="POST">
        @csrf
        @method('PUT') {{-- Important for PUT request --}}

        <div class="mb-3">
            <label for="title" class="form-label">Title<span class="text-danger">*</span></label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $course->title) }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" rows="4" class="form-control">{{ old('description', $course->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price ($)<span class="text-danger">*</span></label>
            <input type="number" step="0.01" name="price" id="price" class="form-control" value="{{ old('price', $course->price) }}" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status<span class="text-danger">*</span></label>
            <select name="status" id="status" class="form-select" required>
                <option value="1" {{ old('status', $course->status) == '1' ? 'selected' : '' }}>Active</option>
                <option value="0" {{ old('status', $course->status) == '0' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('courses.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
</body>
</html>
