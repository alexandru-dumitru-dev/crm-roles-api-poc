<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum PermissionsEnum: string
{
    use EnumToArray;

    case LIST_USERS = 'list_users';
    case CREATE_USER = 'create_user';
    case EDIT_USER = 'edit_user';
    case DELETE_USER = 'delete_user';
    case VIEW_USER = 'view_user';
}
