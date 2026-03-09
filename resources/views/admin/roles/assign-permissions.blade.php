@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>Assign Permissions to Role: {{ $role->name }}</h2>

        <form action="{{ route('roles.updatePermissions', $role->id) }}" method="POST">
            @csrf
            @method('PUT')

            @foreach ($permissions as $permission)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->name }}" id="permission-{{ $permission->id }}"
                        {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                    <label class="form-check-label" for="permission-{{ $permission->id }}">
                        {{ ucfirst($permission->name) }}
                    </label>
                </div>
            @endforeach

            <button type="submit" class="btn btn-primary">Update Permissions</button>
        </form>
    </div>
@endsection
