<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


/**
 * User Model
 *
 * @author João Victor Costa <joaovictorcosta@sysout.com.br>
 * @since 08/05/2024
 * @version 1.0.0
 */
class User extends Model
{
    use HasFactory;
    /**
     * Query de users
     *
     * @param [type] $query
     * @param Request $request
     * @return void
     */
    public function scopeSearch($query,Request $request){
        if($request->name){
            $query->where("name","ilike",'%'.$request->name.'%');
        }

        if($request->email){
            $query->where("email","ilike",'%'.$request->email.'%');
        }
    }
}
