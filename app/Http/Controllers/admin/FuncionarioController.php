<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Funcionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class FuncionarioController extends Controller
{
  
    public function all()
    {
    $data = DB::table('funcionarios')
    ->join('empresas', 'funcionarios.empresa_id', '=', 'empresas.id')
    ->join('users', 'funcionarios.user_id', '=', 'users.id')
    ->select(
        'funcionarios.*',
        'empresas.nome as nome_empresa',
        'users.name as nome_funcionario',
        'users.email as email_funcionario'
    )
    ->get();
        return response()->json(['data' => $data]);
    }
    public function index()
    {
        $registros = Funcionario::orderBy('id', 'desc');
        $pageTitle = 'Funcionarios';
        return view('funcionarios.index', compact('registros','pageTitle'));
    }

    public function add(Request $request)
    {
        $validated = $request->validate([
            'user_id'       => 'required|integer|max:150',
            'empresa_id'    => 'nullable|integer|max:30',
            'in_estatus'    => 'in:ativo,inativo',
            'in_setor'      => 'in:ativo,inativo',
       
        ]);


        $validated['user_id_add'] = Auth::id(); // More efficient than Auth::user()->id
        $validated['user_id_upd'] = Auth::id(); // More efficient than Auth::user()->id
        $validated['user_id_del'] = Auth::id(); // More efficient than Auth::user()->id

        $Funcionario = Funcionario::create($validated);
        return response()->json([ 'data' => $Funcionario,'message' => 'Funcionario Cadastrado correctamente'], 201);
    }

    public function edt($id)
    {
        $data = Funcionario::findOrFail($id);
        return response()->json([
            'data' => $data
        ]);
    }

    public function upd(Request $request, $id)
    {

        $validated = $request->validate([
            'user_id'       => 'required|integer|max:150',
            'empresa_id'    => 'nullable|integer|max:30',
            'in_estatus'    => 'in:ativo,inativo',
            'in_setor'      => 'in:ativo,inativo',
       
        ]);

        $validated['user_id_upd'] = Auth::id(); // More efficient than Auth::user()->id
        
        $Funcionario = Funcionario::find($id);

        if (!$Funcionario) {
            return response()->json([
                'status' => false,
                'message' => 'O Funcionario não existe, recarregue a página.'
            ]);
        }

        $Funcionario->update($validated);
        return response()->json([$Funcionario,'status' => true,
            'message' => 'Atualizado com sucesso',]);
    }

    public function del($id)
    {
        $Funcionario = Funcionario::findOrFail($id);
        $Funcionario->delete();
        return response()->json(['message' => 'Funcionario eliminado correctamente']);
    }
}