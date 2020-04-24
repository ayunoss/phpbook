<?php
return [
//    MainController
    '' => [
        'name' => 'mainpage',
        'controller' => 'main',
        'action' => 'index',
    ],
    'directories-tree' => [
        'name' => 'tree',
        'controller' => 'main',
        'action' => 'getDirectoriesTree',
    ],
    'root' => [
        'name' => 'root',
        'controller' => 'main',
        'action' => 'root',
    ],
    'contact-us' => [
        'name' => 'feedback',
        'controller' => 'main',
        'action' => 'feedback',
    ],
//    UsersController
    'register' => [
        'name' => 'signup',
        'controller' => 'users',
        'action' => [
            'GET' => 'register',
            'POST' => 'executeRegister',
        ],
    ],
    'login' => [
        'name' => 'login',
        'controller' => 'users',
        'action' => [
            'GET' => 'login',
            'POST' => 'auth',
        ],
    ],
    'logout' => [
        'name' => 'logout',
        'controller' => 'users',
        'action' => 'logout'
    ],
    'personal-account' => [
        'name' => 'account',
        'controller' => 'users',
        'action' => 'account'
    ],
    'add-user-info/{id:.+}' => [
        'name' => 'userinfo',
        'controller' => 'users',
        'action' => [
            'GET' => 'userInfo',
            'POST' => 'addUserInfo',
        ],
    ],
    'upload-user-info/{id:.+}' => [
    'name' => 'uploadUserinfo',
    'controller' => 'users',
    'action' => [
        'GET' => 'uploadInfo',
        'POST' => 'uploadUserInfo',
        ],
    ],
    'delete-user/{id:.+}' => [
        'name' => 'deleteUser',
        'controller' => 'users',
        'action' => 'deleteUser'
    ],
//    ImageController
    'images' => [
        'name' => 'images',
        'controller' => 'images',
        'action' => 'show'
    ],
    'download-images' => [
        'name' => 'imgdownload',
        'controller' => 'images',
        'action' => [
            'GET' => 'downloadForm',
            'POST' => 'downloadImg',
        ],
    ],
//    RbacController
    'root/users' => [
        'name' => 'usersList',
        'controller' => 'rbac',
        'action' => 'getUsers',
    ],
    'root/rbac' => [
        'name' => 'setRole',
        'controller' => 'rbac',
        'action' => [
            'GET' => 'setRole',
            'POST' => 'asignRole',
        ],
    ],
//    RolesController
    'root/roles' => [
        'name' => 'roles',
        'controller' => 'roles',
        'action' => 'showRoles',
    ],
    'root/new-role' => [
        'name' => 'new-role',
        'controller' => 'roles',
        'action' => [
            'GET' => 'addRole',
            'POST' => 'executeAddingRole'
        ],
    ],
//    PermissionsController
    'root/permissions' => [
        'name' => 'permissions',
        'controller' => 'permissions',
        'action' => [
            'GET' => 'showPerms',
            'POST' => 'addPerms'
        ],
    ],
    'root/set-permissions-to-role' => [
        'name' => 'setPermissions',
        'controller' => 'permissions',
        'action' => [
            'GET' => 'setPermissions',
            'POST' => 'asignPermissions'
        ],
    ],
];