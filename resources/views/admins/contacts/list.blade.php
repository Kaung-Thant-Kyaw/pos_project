@extends('admins.layouts.master')

@section('content')
    <div class="container">
        <h1 class="text-primary mb-4 text-center">Contact Messages</h1>

        <table class="table-hover table">
            <thead class="bg-primary text-white">
                <tr>
                    <th>User Name</th>
                    <th>Title</th>
                    <th>Message</th>
                    <th>Submitted At</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($contacts as $contact)
                    <tr>
                        <td>{{ $contact->user_name }}</td>
                        <td>{{ $contact->title }}</td>
                        <td>{{ $contact->message }}</td>
                        <td>{{ $contact->created_at->format('j-F-Y h:i A') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No contact messages found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
