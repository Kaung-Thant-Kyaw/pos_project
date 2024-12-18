@extends('admins.layouts.master')

@section('content')
    <div class="container">
        <div class="row p-3">
            <div class="col-4">
                <a href="{{ route('user.list') }}" class="btn btn-secondary">
                    <i class="fa-solid fa-users"></i>
                    User List
                </a>
            </div>
            <div class="col-8">
                <!-- Search Form -->
                <form action="{{ route('admin.list') }}" method="GET" class="d-flex justify-content-center mb-4">
                    <input type="text" name="searchKey" class="form-control w-75 me-2" placeholder="Search"
                        value="{{ request('searchKey') }}">
                    <a href="{{ route('admin.list') }}" class="btn btn-secondary mx-2">
                        <i class="fa-solid fa-times-circle"></i>
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table class="table">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Role</th>
                            <th>Login Platform</th>
                            <th>Created Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($admins as $admin)
                            <tr>
                                <td>{{ $admin->id }}</td>
                                <td>{{ $admin->name }}</td>
                                <td>{{ $admin->email }}</td>
                                <td>{{ $admin->phone }}</td>
                                <td>{{ $admin->address }}</td>
                                <td><span class="btn bg-danger text-white shadow-sm">{{ $admin->role }}</span></td>
                                <td>
                                    @if ($admin->provider == 'google')
                                        <i class="fa-brands fa-google"></i>
                                    @elseif ($admin->provider == 'github')
                                        <i class="fa-brands fa-github"></i>
                                    @else
                                        <i class="fas fa-sign-in-alt"></i>
                                    @endif
                                </td>
                                <td>
                                    {{ $admin->created_at->format('j-F-Y') }}
                                </td>
                                <td>
                                    @if ($admin->role != 'superadmin')
                                        <a href="{{ route('admin.destroy', $admin->id) }}" class="btn btn-danger btn-sm">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No admins found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="d-flex justify-content-end">
                    {{ $admins->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
