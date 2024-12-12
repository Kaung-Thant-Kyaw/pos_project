@extends('admins.layouts.master')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Category List</h1>
        </div>

        {{-- list --}}
        <div class="">
            <div class="row">
                <div class="col-4">
                    <div class="card">
                        <div class="card-body shadow-sm">
                            <form action="" method="post">
                                <div class="form-group">
                                    <input type="text" name="name" placeholder="Enter Category Name"
                                        class="form-control">
                                </div>

                                <button type="submit" class="btn btn-outline-primary">Create</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <p>Testing Category Name</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <p>Testing Category Name</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <p>Testing Category Name</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
