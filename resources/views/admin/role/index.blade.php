@extends ('admin.layouts.app')

@section('breadcrumb')
    {{ Breadcrumbs::render('role') }}
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ trans('labels.roles.management') }}</h3>
            <div class="card-tools">
                <a href="{{ route('admin.role.create') }}"><i class="fas fa-plus"></i></a>
                {{-- <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                </div> --}}
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                <tr>
                    <th>{{ trans('labels.general.id') }}</th>
                    <th>{{ trans('labels.general.name') }}</th>
                    <th>{{ trans('labels.general.guard_name') }}</th>
                    <th>{{ trans('labels.general.created_at') }}</th>
                    <th>{{ trans('labels.general.last_updated') }}</th>
                    <th style="width: 40px">{{ trans('labels.general.actions') }}</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->guard_name }}</td>
                            <td>{{ format_date($role->created_at) }}</td>
                            <td>{{ format_date($role->updated_at) }}</td>
                            <td>
                                <div class="text-center d-flex">
                                    <a href="{{ route('admin.role.edit', [ 'role' => $role->id ]) }}" class="btn btn-sm"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.role.destroy', ['role' => $role->id])  }}" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-sm" onclick="return confirm(`{{ __('labels.general.confirm_delete') }}`);"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
@endsection
