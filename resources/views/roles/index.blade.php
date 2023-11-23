@extends('layouts.app')


@section('content')
    <div class="container border border-2 border-dark rounded my-3 pt-3">
        @if (session('success'))
            <script>
                window.onload = function() {
                    alert("{{ session('success') }}");
                }
            </script>
        @endif
        <h3 class="fw-bolder text-center">ROLE MANAGEMENT</h3>
        <hr>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-2">
            <a class="btn btn-success" href="{{ route('roles.create') }}">
                <img src="{{ asset('svg/add-users.svg') }}" alt="Add">
            </a>
        </div>
        <div class="table-responsive-sm overflow-scroll">
            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th width="280px">Action</th>
                </tr>
                @foreach ($roles as $key => $role)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $role->name }}</td>
                        <td>
                            <a class="btn btn-info" href="{{ route('roles.show', $role->id) }}">
                                <img src="{{ asset('svg/eye.svg') }}" alt="Show">
                            </a>
                            @can('role-edit')
                                <a class="btn btn-primary" href="{{ route('roles.edit', $role->id) }}">
                                    <img src="{{ asset('svg/pen.svg') }}" alt="Edit">
                                </a>
                            @endcan
                            @can('role-delete')
                                {!! Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id], 'style' => 'display:inline']) !!}
                                {!! Form::button('<img src="' . asset('svg/trash.svg') . '" alt="Delete" />', [
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger',
                                    'value' => '',
                                ]) !!}
                                {!! Form::close() !!}
                            @endcan
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        {!! $roles->render() !!}
    </div>
@endsection
