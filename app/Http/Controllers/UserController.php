<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    /**
     * Lista de os usuários
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index(Request $request)
    {
        $query = User::search($request);

        $n = $request->get('limit', 10);

        if ($request->sort) {
            list($sortColumn,$sortDirection) = explode('.',$request->sort);
            $query->orderBy($sortColumn,$sortDirection);
        }

        $list = $query->paginate($n);

        $data = [
            'list' => $list
        ];

        return view('pages.user.index', $data);
    }


    /**
     * Formulário de usuários
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function create(Request $request)
    {
        return view('pages.user.form', ['user' => new User()]);
    }

    /**
     * Salvar usuários
     *
     * @param Request $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function insert(Request $request)
    {
        return $this->store($request);
    }

    /**
     *  Form edição de usuários
     *
     * @param Request $request
     * @param integer $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(Request $request, int $id)
    {
        $user = User::find($id);
        if ($user) {
            return view('pages.user.form', ['user' => $user]);

        } else {
            return back()->withErrors('Usuário não  encontrado');
        }
    }

    /**
     * Update Usuário
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function update(Request $request)
    {
        return $this->store($request);
    }

    /**
     * Deleta usuário
     *
     * @param Request $request
     * @return Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        $id = $request->id;
        if($id){
            $user = User::find($id);
            if($user){
                $user->delete();
                return back()->with('success','O usuário foi removido com sucesso');
            }
            else{
                //Todo
            }
        }
        else{
            //Todo
        }
    }
    /**
     * Formulário de usuários
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */

    private function form(User $user)
    {
        $data = [
            'user' => $user,
        ];
        return view('pages.user.form', $data);
    }

    /**
     * Salvar Usuário
     *
     * @param User $user
     * @param Request $request
     * @return void
     */
    private function save(User $user, Request $request)
    {
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = bcrypt($request->password);
        }
        $user->save();
    }


    private function validation(Request $request)
    {
        $uniqueEmailRule = Rule::unique('users', 'email');

        if ($request->id) {
            $uniqueEmailRule->ignore($request->id);
        }

        $rules = [
            'name' => ['required', 'string', 'max:30'],
            'email' => ['required', 'email', 'max:50', $uniqueEmailRule],
            'password' => ['string', 'min:8', 'max:16'],
        ];

        $method = $request->method();

        if ($method == 'PUT') {
            array_unshift($rules['password'], 'nullable');
            $rules['id'] = ['required', 'integer', 'exists:users,id'];
        } else {
            array_unshift($rules['password'], 'required');
        }

        $data = $request->all();

        $validator = Validator::make($data, $rules);

        return $validator;
    }

    /**
     * Salvar User no BD
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    private function store(Request $request)
    {
        $validator = $this->validation($request);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return back()->withInput()->withErrors($errors);
        } else {
            $user = $request->id ? User::find($request->id) : new User();
            Session::flash('success', 'Usuário foi salvo sucesso');
            $this->save($user, $request);
            return redirect('/usuarios');
        }
    }
}
