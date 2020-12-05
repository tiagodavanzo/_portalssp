<?php

namespace App\Http\Controllers;
use App\Models\Chamado;
use App\Models\Usuario;
use App\Http\Controllers\stdClass;
use Illuminate\Http\Request;

class ChamadoController extends Controller
{
    public function index()
    {
        $chamados = Chamado::all();
        return response()->json($chamados);
    }

    public function show($id)
    {
        $chamado = Chamado::findOrFail($id);
        
        return response()->json($chamado);
    }

    public function create(Request $request)
    {
        if($this->verifica() == 'Autorizado')
        {
            $chamado = new Chamado();

            $chamado->titulo = $request->titulo;
            $chamado->descricao = $request->descricao;
            $chamado->status = $request->status;
            $chamado->cliente_id = $request->cliente_id;

            $chamado->save();
        }
        else
            return 'Não foi autorizado criar o chamado!';

        return 'Chamado criado com sucesso!';
    }

    public function update(Request $request, $id)
    {
        if($this->verifica() == 'Autorizado')
        {
            $chamado = Chamado::find($id);

            $chamado->titulo = (isset($request->titulo)) ? $request->titulo : $chamado->titulo;
            $chamado->descricao = (isset($request->descricao)) ? $request->descricao : $chamado->descricao;
            $chamado->status = (isset($request->status)) ? $request->status : $chamado->status;
            $chamado->cliente_id = (isset($request->cliente_id)) ? $request->cliente_id : $chamado->cliente_id;
            $chamado->fornecedor_id = (isset($request->fornecedor_id)) ? $request->fornecedor_id : $chamado->fornecedor_id;

            $chamado->save();
        }
        else
            return 'Não foi autorizado atualizar o chamado!';

        return 'Chamado atualizado com sucesso!';
    }

    public function delete($id)
    {
        $chamado = Chamado::find($id);
        $chamado->delete();

        return response()->json('Chamado excluído com sucesso!');
    }

    public function verifica()
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, 'https://run.mocky.io/v3/b6d946aa-e84e-45c4-af4e-a56f46465576');
        $result = curl_exec($ch);
        curl_close($ch);
        $obj = json_decode($result);

        return $obj->response;
    }

    public function chamadosCliente()
    {
        $chamados = Chamado::all();
        $chamadosCliente = array();

        foreach($chamados as $chamado)
        {
            $cliente = ($chamado->cliente_id != '') ? Usuario::find($chamado->cliente_id) : new Usuario();
            $fornecedor = ($chamado->fornecedor_id != '') ? Usuario::find($chamado->fornecedor_id) : new Usuario();
            
            array_push($chamadosCliente, 
                       array('id' => $chamado->id,
                             'titulo' => $chamado->titulo, 
                             'descricao' => $chamado->descricao, 
                             'status' => $chamado->status, 
                             'cliente_id' => $chamado->cliente_id, 
                             'cliente_nome' => $cliente->nome,
                             'fornecedor_id' => $chamado->fornecedor_id,
                             'fornecedor_nome' => $fornecedor->nome));
        }

        return $chamadosCliente;
    }
}