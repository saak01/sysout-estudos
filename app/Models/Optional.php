<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Optional Model
 *
 * @author João Victor Costa <joaovictorcosta@sysout.com.br>
 * @since 08/05/2024
 * @version 1.0.0
 */
class Optional extends Model
{
    public $timestamp = false;
    use HasFactory;
}
