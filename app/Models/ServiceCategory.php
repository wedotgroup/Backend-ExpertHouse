<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    protected $primaryKey = "id";
    protected $table = "service_categories";
    protected $fillable = ['name','slug'];

    public function service(){
        return $this->hasMany(Service::class,'serviceCat_id');
    }
}
