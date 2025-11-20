<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Credencial;
use Illuminate\Auth\Access\HandlesAuthorization;

class CredencialPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Credencial');
    }

    public function view(AuthUser $authUser, Credencial $credencial): bool
    {
        return $authUser->can('View:Credencial');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Credencial');
    }

    public function update(AuthUser $authUser, Credencial $credencial): bool
    {
        return $authUser->can('Update:Credencial');
    }

    public function delete(AuthUser $authUser, Credencial $credencial): bool
    {
        return $authUser->can('Delete:Credencial');
    }

    public function restore(AuthUser $authUser, Credencial $credencial): bool
    {
        return $authUser->can('Restore:Credencial');
    }

    public function forceDelete(AuthUser $authUser, Credencial $credencial): bool
    {
        return $authUser->can('ForceDelete:Credencial');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Credencial');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Credencial');
    }

    public function replicate(AuthUser $authUser, Credencial $credencial): bool
    {
        return $authUser->can('Replicate:Credencial');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Credencial');
    }

}