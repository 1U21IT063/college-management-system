<!-- Form Errors Component -->
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <div class="d-flex">
            <i class="bi bi-exclamation-circle me-2"></i>
            <div>
                <strong>Please fix the following errors:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Field-specific errors -->
@foreach ($errors->all() as $field => $messages)
    @foreach ($messages as $message)
        @if ($loop->first)
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const field = document.querySelector('[name="{{ $field }}"]');
                    if (field) {
                        field.classList.add('is-invalid');
                    }
                });
            </script>
        @endif
    @endforeach
@endforeach
