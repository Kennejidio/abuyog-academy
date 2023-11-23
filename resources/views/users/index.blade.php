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
        <h3 class="fw-bolder text-center">USERS MANAGEMENT</h3>
        <hr>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-2">
            <a class="btn btn-success" href="{{ route('users.create') }}">
                <img src="{{ asset('svg/add-users.svg') }}" alt="Add">
            </a>
        </div>
        <div class="table-responsive-sm overflow-scroll">
            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th width="280px">Action</th>
                </tr>
                @foreach ($data as $key => $user)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if (!empty($user->getRoleNames()))
                                @foreach ($user->getRoleNames() as $v)
                                    <label class="text-dark">{{ $v }}</label>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-info" href="{{ route('users.show', $user->id) }}"><img
                                    src="{{ asset('svg/eye.svg') }}" alt="Show"></a>
                            <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}"><img
                                    src="{{ asset('svg/pen.svg') }}" alt="Edit"></a>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id], 'style' => 'display:inline']) !!}
                            {!! Form::button('<img src="' . asset('svg/trash.svg') . '" alt="Delete" />', [
                                'type' => 'submit',
                                'class' => 'btn btn-danger',
                                'value' => '',
                            ]) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
        {!! $data->render() !!}
    </div>
@endsection
