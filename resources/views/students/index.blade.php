<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<div class="container">
    @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    <h1>Students List Management</h1>
    <a href="{{ route('students.create') }}">+Add Student</a>

    <!-- Header row -->
    <div class="student-header">
        <span>Id Number</span>
        <span>Name</span>
        <span>Email</span>
        <span>Contact</span>
        <span>Actions</span>
    </div>

    <ul>
        @foreach($students as $student)
            <li>
                <div class="student-info">
                    <span>{{ $student->studentNumber }}</span>
                    <span>{{ $student->lname }}, {{ $student->fname }} {{ $student->mi }}</span>
                    <span>{{ $student->email }}</span>
                    <span>{{ $student->contactNumber }}</span>
                </div>
                <div class="student-actions">
                    <a href="{{ route('students.show', $student->id) }}">View</a>
                    <a href="{{ route('students.edit', $student->id) }}">Edit</a>
                    <form action="{{ route('students.destroy', $student->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
</div> <script>
    // Auto-hide success alert after 3 seconds
    document.addEventListener("DOMContentLoaded", function() {
        let alertBox = document.querySelector('.alert');
        if (alertBox) {
            setTimeout(() => {
                alertBox.classList.add('hide');
            }, 2000); 
        }
    });
</script>

