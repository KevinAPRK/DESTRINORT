<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Configuracion;
use Illuminate\Auth\Access\HandlesAuthorization;

class ConfiguracionPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Configuracion');
    }

    public function view(AuthUser $authUser, Configuracion $configuracion): bool
    {
        return $authUser->can('View:Configuracion');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Configuracion');
    }

    public function update(AuthUser $authUser, Configuracion $configuracion): bool
    {
        return $authUser->can('Update:Configuracion');
    }

    public function delete(AuthUser $authUser, Configuracion $configuracion): bool
    {
        return $authUser->can('Delete:Configuracion');
    }

    public function restore(AuthUser $authUser, Configuracion $configuracion): bool
    {
        return $authUser->can('Restore:Configuracion');
    }

    public function forceDelete(AuthUser $authUser, Configuracion $configuracion): bool
    {
        return $authUser->can('ForceDelete:Configuracion');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Configuracion');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Configuracion');
    }

    public function replicate(AuthUser $authUser, Configuracion $configuracion): bool
    {
        return $authUser->can('Replicate:Configuracion');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Configuracion');
    }

}