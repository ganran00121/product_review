<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleManagement extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_module',
        'product',
    ];

    public function hasPermission($module, $permission)
    {   
        $permissions = explode(',', $this->$module);
        return in_array($permission, $permissions);
    }

    //belongs to relationship
    public function users()
    {
        return $this->hasMany(User::class,'role_id','id');
    }   
}
