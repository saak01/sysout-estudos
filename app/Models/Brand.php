<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Brand Model
 *
 * @author Joao Victor Costa <joaovictor@sysout.com.br>
 * @since 06/01/2023
 * @version 1.0.0
 */

class Brand extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function models(){
        return $this->hasMany(BrandModel::class);
    }
}
