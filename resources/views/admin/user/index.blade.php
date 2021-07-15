@extends ('admin.layouts.app')

@section('breadcrumb')
    {{ Breadcrumbs::render('user') }}
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ trans('labels.admin.users.view') }}</h3>
            <div class="card-tools">
                <a href="{{ route('admin.user.create') }}"><i class="fas fa-plus"></i></a>
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
                    <th style="width: 10px">#</th>
                    <th>{{ trans('labels.admin.users.tabs.content.overview.name') }}</th>
                    <th>{{ trans('labels.admin.users.tabs.content.overview.email') }}</th>
                    <th>{{ trans('labels.admin.users.tabs.content.overview.status') }}</th>
                    <th>{{ trans('labels.admin.users.tabs.content.overview.created_at') }}</th>
                    <th>{{ trans('labels.admin.users.tabs.content.overview.updated_at') }}</th>
                    <th style="width: 40px">{{ trans('labels.general.actions') }}</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->profile->fullName }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <div class="form-group">
                                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                        <input type="checkbox" class="custom-control-input" disabled id="active" name="status" value="{{ config('model.user.status.active') }}" {{ isset($user) && $user->status === config('model.user.status.active') ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="active"></label>
                                    </div>
                                </div>
                            </td>
                            <td>{{ format_date($user->created_at) }}</td>
                            <td>{{ format_date($user->updated_at) }}</td>
                            <td>
                                <div class="text-center" style="display: flex">
                                    <a href="{{ route('admin.user.edit', [ 'user' => $user->id ]) }}" class="btn btn-sm"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.user.destroy', ['user' => $user->id])  }}" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-sm" onclick="return confirm(`{{ __('labels.general.confirmed_delete') }}`);"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
            {{ $users->links() }}
        </div>
    </div>
@endsection
