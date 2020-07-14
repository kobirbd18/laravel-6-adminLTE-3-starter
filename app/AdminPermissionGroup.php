<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminPermissionGroup extends Model {
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'admin_id', 'name', 'status',
    ];

    public function permissions() {
        return $this->belongsToMany(Permission::class, 'admin_permission_group_permission', 'admin_permission_group_id', 'permission_id');
    }
}
