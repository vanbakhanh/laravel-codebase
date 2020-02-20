<?php

Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Dashboard', route('admin.index'));
});

Breadcrumbs::for('user', function ($trail) {
    $trail->push('User', route('admin.user'));
});

Breadcrumbs::for('user-edit', function ($trail, $user) {
    $trail->parent('user');
    $trail->push('Edit', route('admin.user.edit', ['id' => $user->id]));
});

Breadcrumbs::for('user-create', function ($trail) {
    $trail->parent('user');
    $trail->push('Create', route('admin.user.create'));
});
