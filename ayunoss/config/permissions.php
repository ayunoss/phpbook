<?php return [
//  MainController
    'mainpage' => [
        'controller' => 'main',
        'action' => 'index',
    ],
    'tree' => [
        'controller' => 'main',
        'action' => 'getDirectoriesTree',
    ],
    'root' => [
        'controller' => 'main',
        'action' => 'root',
    ],
//    UsersController
    'signup' => [
        'controller' => 'users',
        'action' => 'register',
    ],
    'login' => [
        'controller' => 'users',
        'action' => 'login',
    ],
    'logout' => [
        'controller' => 'users',
        'action' => 'logout'
    ],
    'account' => [
        'controller' => 'users',
        'action' => 'account'
    ],
    'userinfo' => [
        'controller' => 'users',
        'action' => 'userInfo',
    ],
//    ImageController
    'images' => [
        'controller' => 'images',
        'action' => 'show'
    ],
    'imgdownload' => [
        'controller' => 'images',
        'action' => 'downloadForm',
    ],
//    RbacController
    'users' => [
        'controller' => 'rbac',
        'action' => 'getUsers',
    ],
    'rbac' => [
        'name' => 'setRole',
        'controller' => 'rbac',
        'action' => 'setRole',
    ],
//    RolesController
    'roles' => [
        'controller' => 'roles',
        'action' => 'showRoles',
    ],
    'new-role' => [
        'controller' => 'roles',
        'action' => 'addRole',
    ],
//    PermissionsController
    'permissions' => [
        'controller' => 'permissions',
        'action' => 'showPerms',
    ],
    'setPermissions' => [
        'controller' => 'permissions',
        'action' => 'asignPermissions',
    ],
];
// <i class="far fa-trash-alt"></i> delete icon