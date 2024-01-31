<?php


namespace App\Managers;

use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class RoleManager
{
    public function create(array $data)
    {
        $role = Role::create([
            'label' => $data['label'],
            'created_at' => Carbon::now(),
            'updated_at' => NULL
        ]);
        $role->save();
        return $role;
    }
}
