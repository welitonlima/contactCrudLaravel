@extends('layouts.app')

@section('title', 'Create Contact')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="mb-4">
                    <h1 class="h3 mb-0">Create New Contact</h1>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <form action="{{ route('contacts.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                <input 
                                    type="text" 
                                    class="form-control @error('name') is-invalid @enderror" 
                                    id="name" 
                                    name="name" 
                                    value="{{ old('name') }}" 
                                    required
                                    minlength="5"
                                >
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Minimum 5 characters required.</small>
                            </div>

                            <div class="mb-3">
                                <label for="contact" class="form-label">Contact <span class="text-danger">*</span></label>
                                <input 
                                    type="text" 
                                    class="form-control @error('contact') is-invalid @enderror" 
                                    id="contact" 
                                    name="contact" 
                                    value="{{ old('contact') }}" 
                                    required
                                    maxlength="9"
                                    pattern="[0-9]{9}"
                                    placeholder="123456789"
                                >
                                @error('contact')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Exactly 9 digits required.</small>
                            </div>

                            <div class="mb-4">
                                <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                                <input 
                                    type="email" 
                                    class="form-control @error('email') is-invalid @enderror" 
                                    id="email" 
                                    name="email" 
                                    value="{{ old('email') }}" 
                                    required
                                >
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex gap-2 justify-content-end">
                                <a href="{{ route('contacts.index') }}" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-check-circle"></i> Create Contact
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById('contact').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    </script>
@endpush

