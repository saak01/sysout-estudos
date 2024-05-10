<?php

namespace App\Http\Controllers;

use App\Models\BrandModel;
use App\Models\Color;
use App\Models\Optional;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

/**
 * Vehicle Controller
 *
 * @author João Victor Costa <joaovictorcosta@sysout.com.br>
 * @since 09/05/2024
 * @version 1.0.0
 */
class VehicleController extends Controller
{
    /**
     * Listar Veículos
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    function index(Request $request){

        //Query do banco de dados com a função de escopo Search;
        $query = Vehicle::search($request);
        //Adiquiri o limite da consulta ou deixar o default de 10;
        $n = $request->get('limit',10);
        //Paginação da query feita;
        $list = $query->paginate($n);
        //Criação do array associativo
        $data = [
            'list' => $list
        ];
        //retorno para a view index com a query feita passada em parâmetro.
        return view('pages.vehicle.index',$data);
        // OBS: segundo parametro retorno uma array associativo, por isso se colocar o 'list' você consegue acessar essa propriedade no blade.
    }

    /**
     * Visualizar formulário cara cadastro de novos veículos
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    function create(Request $request){
        $vehicle = new Vehicle();
        return $this->form($vehicle);
    }

    /**
     * Inserir novo usuário no banco de dados
     *
     * @param Request $request
     * @return void
     */
    function insert(Request $request){
        return $this->store($request);
    }

    /**
     * Visualizar formulário de edição de usuários
     *
     * @param Request $request
     * @param integer $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    function edit(Request $request, int $id){
        $vehicle = Vehicle::find($id);
        if($vehicle){
            return $this->form($vehicle);
        }
        else{
            return back()->withErrors('Veículos não encontrado');
        }
    }

    /**
     * Update usuários
     *
     * @param Request $request
     * @return void
     */
    function update(Request $request){
        return $this->store($request);
    }

    /**
     * Exclusão de veículos
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    function delete(Request $request){
        $vehicle = Vehicle::find($request->id);
        if($request->id && $vehicle){
            $vehicle->delete();
            return back()->with('success','O veículo foi removido com sucesso!');
        }
    }

    /**
     * Formulário de veículos
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */

    function form(Vehicle $vehicle){

        $models = BrandModel::search()->get();

        $colors = Color::all();

        $optionals = Optional::all();

        $data = [
            'vehicle' => $vehicle,
            'models' => $models,
            'colors' => $colors,
             'optionals' => $optionals
        ];

        return view('pages.vehicle.form',$data);
    }
    /**
     * Obter validação dos inputs
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Validation\Validator $validator
     */
    private function validation(Request $request)
    {
        $uniquePlateRule = Rule::unique('vehicles','plate');
        if($request->id){
            $uniquePlateRule->ignore($request->id);
        }

        $rules = [
            'model_id' => ['required', 'integer', 'exists:models,id'],
            'model_year' => ['required', 'integer', 'min:1900'],
            'year' => ['required', 'integer', 'min:1900'],
            'color_id' => ['required', 'integer', 'exists:colors,id'],
            'plate' => ['required', 'string', 'size:7', $uniquePlateRule],
            'optional_id' => ['nullable','array',] ,
            'optional_id.*' => ['required','integer', 'exists:optionals,id']
        ];

        $method = $request->method();

        if ($method == 'PUT') {
            $rules['id'] = ['required', 'integer', 'exists:vehicles,id'];
        }

        $data = $request->all();

        $validator = Validator::make($data, $rules);

        return $validator;

    }

    private function store(Request $request){
        $validator = $this->validation($request);
        if($validator -> fails()){
            $error = $validator->errors()->all();
            return back()->withInput()->withErrors($error);
        }
        else{
            $vehicle = $request->id ? Vehicle::find($request->id) : new Vehicle();
            $request->session()->flash('success', 'Usuário foi salvo sucesso');
            $this->save($vehicle, $request);
            return redirect('/veiculos');
        }
    }

    /**
     * Salvar Usuário
     *
     * @param User $user
     * @param Request $request
     * @return void
     */
    private function save(Vehicle $vehicle, Request $request)
    {
        $vehicle->model_id = $request->model_id;
        $vehicle->model_year = $request->model_year;
        $vehicle->year = $request->year;
        $vehicle->color_id = $request->color_id;
        $vehicle->plate = $request->plate;
        $vehicle->save();
        $vehicle->optionals()->sync($request->optional_id);
    }



}
