<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

/**
 * Undocumented FileController
 *
 * @author João Victor Costa <joaovictorcosta@sysout.com.br>
 * @since 12/05/2024
 * @version 1.0.0
 */
class FileController extends Controller
{
    public function create(Request $request){

        $data = $request->all();

        $rule = [
            'file' => ['required', 'file', 'min:1000', 'max:5000'],
        ];

        $validators = Validator::make($data, $rule);

        if($validators->fails){
            return Response($validators->errors(),Response::HTTP_BAD_REQUEST);
        }

        else{
            $file = new File();
            $file->created_at = now();
            $file->save();
        }




    }
}
