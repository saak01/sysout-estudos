<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * BrandModel Model
 *
 * @author João Victor Costa <joaovictorcosta@sysout.com.br>
 * @since 08/05/2024
 * @version 1.0.0
 */

class BrandModel extends Model
{
    use HasFactory;

    protected $table = 'models';
    public $timestamps = false;

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    /**
     * Pesquisar dentro os modelos
     *
     * @param [type] $query
     * @return void
     */
    public function scopeSearch($query){

        $query->join('brands', 'brands.id', 'models.brand_id');

         $query->select(
            'models.*',
            'brands.name as brand_name');
    }
}
