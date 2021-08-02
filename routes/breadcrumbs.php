<?php

Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Dashboard', route('admin.index'));
});

Breadcrumbs::for('user', function ($trail) {
    $trail->push('User', route('admin.user.index'));
});

Breadcrumbs::for('user-edit', function ($trail, $user) {
    $trail->parent('user');
    $trail->push('Edit', route('admin.user.edit', ['user' => $user->id]));
});

Breadcrumbs::for('user-create', function ($trail) {
    $trail->parent('user');
    $trail->push('Create', route('admin.user.create'));
});

Breadcrumbs::for('role', function ($trail) {
    $trail->push('Role', route('admin.role.index'));
});

Breadcrumbs::for('role-edit', function ($trail, $role) {
    $trail->parent('role');
    $trail->push('Edit', route('admin.role.edit', ['role' => $role->id]));
});

Breadcrumbs::for('role-create', function ($trail) {
    $trail->parent('role');
    $trail->push('Create', route('admin.role.create'));
});

Breadcrumbs::for('permission', function ($trail) {
    $trail->push('Permission', route('admin.permission.index'));
});

Breadcrumbs::for('permission-edit', function ($trail, $permission) {
    $trail->parent('permission');
    $trail->push('Edit', route('admin.permission.edit', ['permission' => $permission->id]));
});

Breadcrumbs::for('permission-create', function ($trail) {
    $trail->parent('permission');
    $trail->push('Create', route('admin.permission.create'));
});