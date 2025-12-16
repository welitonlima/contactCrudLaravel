@extends('layouts.app')

@section('title', 'Contacts')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h3 mb-0">Contacts</h1>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($contacts->count() > 0)
                    <div class="card shadow-sm">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col" class="ps-3">ID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Contact</th>
                                            <th scope="col">Email</th>
                                            <th scope="col" class="text-end pe-3">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($contacts as $contact)
                                            <tr>
                                                <td class="ps-3">{{ $contact->id }}</td>
                                                <td>{{ $contact->name }}</td>
                                                <td>{{ $contact->contact }}</td>
                                                <td>{{ $contact->email }}</td>
                                                <td class="text-end pe-3">
                                                    <div class="btn-group btn-group-sm" role="group">
                                                        <a href="{{ route('contacts.show', $contact) }}" class="btn btn-outline-info" title="View">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        <a href="{{ route('contacts.edit', $contact) }}" class="btn btn-outline-primary" title="Edit">
                                                            <i class="bi bi-pencil"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-outline-danger" title="Delete" data-bs-toggle="modal" data-bs-target="#deleteModal" data-contact-id="{{ $contact->id }}" data-contact-name="{{ $contact->name }}">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="card shadow-sm">
                        <div class="card-body text-center py-5">
                            <i class="bi bi-inbox display-1 text-muted"></i>
                            <p class="text-muted mt-3 mb-0">No contacts found. Start by adding your first contact.</p>
                        </div>
                    </div>
                @endif
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
                       <p class="fw-bold mb-0" id="contactName"></p>
                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                       <form id="deleteForm" method="POST" style="display: inline;">
                           @csrf
                           @method('DELETE')
                           <button type="submit" class="btn btn-danger">Delete</button>
                       </form>
                   </div>
               </div>
           </div>
       </div>
   @endsection

   @push('scripts')
       <script>
           document.addEventListener('DOMContentLoaded', function() {
               const deleteModal = document.getElementById('deleteModal');
               deleteModal.addEventListener('show.bs.modal', function(event) {
                   const button = event.relatedTarget;
                   const contactId = button.getAttribute('data-contact-id');
                   const contactName = button.getAttribute('data-contact-name');
                   
                   const form = document.getElementById('deleteForm');
                   form.action = '/contacts/' + contactId;
                   
                   document.getElementById('contactName').textContent = contactName;
               });
           });
       </script>
   @endpush

