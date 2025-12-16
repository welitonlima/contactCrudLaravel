<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        $contacts = Contact::orderBy('name')->get();
        
        return view('contacts.index', compact('contacts'));
    }

    public function create(): View
    {
        return view('contacts.create');
    }

    public function store(StoreContactRequest $request): RedirectResponse
    {
        Contact::create($request->validated());

        return redirect()->route('contacts.index')
            ->with('success', 'Contact created successfully.');
    }

    public function show(Contact $contact): View
    {
        return view('contacts.show', compact('contact'));
    }
}
