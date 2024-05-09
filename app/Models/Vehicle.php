<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * Vehicle Model
 *
 * @author João Victor Costa <joaovictorcosta@sysout.com.br>
 * @since 08/05/2024
 * @version 1.0.0
 */
class Vehicle extends Model
{
    public $timestamp = false;

    use HasFactory;

    public function scopeSearch($query){

        $query->from('vehicles as v');

        $query->join('models as m','m.id','v.model_id');

        $query->join('brands as b', 'b.id','m.brand_id');

        $query->join('colors as c', 'c.id','v.color_id');

        $query->select(
            'v.*',
            'm.name as model_name',
            'b.name as brand_name',
            'c.name as color_name'
        );
    }


    public function model(){
        return $this->hasMany(BrandModel::class);
    }

    public function color(){
        return $this->belongsTo(Color::class);
    }

    public function optionals(){
        return $this->belongsToMany(Optional::class, 'vehicle_optional');
    }
}
