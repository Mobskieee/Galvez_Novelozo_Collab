<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<div class="container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <h1>Sections List Management</h1>
    <a href="{{ route('sections.create') }}">+Add Section</a>

    <!-- Header row -->
    <div class="student-header">
        <span>Section Code</span>
        <span>Section Name</span>
        <span>Description</span>
        <span>Room</span>
        <span>Capacity</span>
        <span>Actions</span>
    </div>

    <ul>
        @foreach($sections as $section)
            <li>
                <div class="student-info">
                    <span>{{ $section->sectionCode }}</span>
                    <span>{{ $section->sectionName }}</span>
                    <span>{{ $section->description ?? 'N/A' }}</span>
                    <span>{{ $section->room ?? 'N/A' }}</span>
                    <span>{{ $section->capacity }}</span>
                </div>
                <div class="student-actions">
                    <a href="{{ route('sections.show', $section->id) }}">View</a>
                    <a href="{{ route('sections.edit', $section->id) }}">Edit</a>
                    <form action="{{ route('sections.destroy', $section->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
</div>

<script>
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