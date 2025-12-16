@extends('layouts.app')

@section('title', 'Contact Details')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="mb-4">
                    <h1 class="h3 mb-0">Contact Details</h1>
                </div>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <div class="row mb-3">
                            <div class="col-4 fw-bold text-muted">ID:</div>
                            <div class="col-8">{{ $contact->id }}</div>
                        </div>

                        <hr>

                        <div class="row mb-3">
                            <div class="col-4 fw-bold text-muted">Name:</div>
                            <div class="col-8">{{ $contact->name }}</div>
                        </div>

                        <hr>

                        <div class="row mb-3">
                            <div class="col-4 fw-bold text-muted">Contact:</div>
                            <div class="col-8">{{ $contact->contact }}</div>
                        </div>

                        <hr>

                        <div class="row mb-3">
                            <div class="col-4 fw-bold text-muted">Email:</div>
                            <div class="col-8">
                                <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                            </div>
                        </div>

                        <hr>

                        <div class="row mb-3">
                            <div class="col-4 fw-bold text-muted">Created At:</div>
                            <div class="col-8">{{ $contact->created_at->format('M d, Y H:i') }}</div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-4 fw-bold text-muted">Updated At:</div>
                            <div class="col-8">{{ $contact->updated_at->format('M d, Y H:i') }}</div>
                        </div>
                    </div>

                    <div class="card-footer bg-white">
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('contacts.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Back to List
                            </a>
                            <div>
                                <a href="{{ route('contacts.edit', $contact) }}" class="btn btn-primary me-2">
                                    <i class="bi bi-pencil"></i> Edit Contact
                                </a>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    <i class="bi bi-trash"></i> Delete Contact
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this contact?</p>
                    <p class="fw-bold mb-0">{{ $contact->name }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('contacts.destroy', $contact) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

