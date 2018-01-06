<?php 

namespace App\Http\Controllers;

use App\Candidato;
use Illuminate\Http\Request;
use Validator;

class CandidatoController extends Controller 
{
    public function __construct(Candidato $candidato) {
        $this->candidato = $candidato;  
    }

    public function index() 
    {
        $candidatos = $this->candidato->query()->get();
        
        return response()->json([
            'resultSet' => $candidatos,
            'success' => true,
            'errorMessage' => '',
            'id' => '',
        ]);
    }

    public function store(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'email' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json([                
                'resultSet' => '',
                'success' => true,
                'errorMessage' =>  $validator->errors()->all(),
                'id' => ''
            ], 422);
        }
        
        $candidato = new $this->candidato;
        $candidato->email = $request->input('email');
        $candidato->nome = $request->input('nome');
        $candidato->save();
        
        return response()->json([
            'resultSet' => $candidato,
            'success' => true,
            'errorMessage' =>  'Operação conculuída com sucesso.',
            'id' => $candidato->id,
            'http' => ''
        ], 201);
    }

    public function get($id) {
        $candidato = $this->candidato->query()->find($id);
        if ($candidato) {
            return response()->json([
                'resultSet' => $candidato,
                'success' => true,
                'errorMessage' => "",
                'id' => $id,
            ]);
        } else {
            return response()->json([
                'resultSet' => '',
                'success' => false,
                'errorMessage' => ($candidato ? "" : "Not found candidato for ID "),
                'id' => $id,
            ], 404);
        }
    }

    public function update(Request $request, $id) 
    {
        $candidato = $this->candidato->query()->find($id);
        
        if ($candidato) {
            $validator = Validator::make($request->all(), [
                'nome' => 'required',
                'email' => 'required',
            ]);
            
            if ($validator->fails()) {
                return response()->json([
                    'resultSet' => $candidato,
                    'success' => true,
                    'errorMessage' =>  $validator->errors()->all(),
                    'id' => $id,
                ], 422);
            } else {
                $candidato = $this->candidato->query()->find($id);
                $candidato->email = $request->input('email');
                $candidato->nome = $request->input('nome');
                $candidato->save();

                return response()->json([
                    'resultSet' => $candidato,
                    'success' => true,
                    'errorMessage' =>  'Operação conculuída com sucesso.',
                    'id' => $id,
                ]);
            }
        } else {
            return response()->json([
                'resultSet' => $candidato,
                'success' => true,
                'errorMessage' =>  "Id não encontrado ($id)",
                'id' => $id,
            ], 404);
        }
    }

    public function delete($id) 
    {
        $candidato = $this->candidato->query()->find($id);
        if ($candidato) {
            $this->candidato->query()->findOrFail($id)->delete();
            return response()->json([
                'resultSet' => $candidato,
                'success' => true,
                'errorMessage' =>  'Operação conculuída com sucesso.',
                'id' => $id,
               ]);;
        } else {
            return response()->json([
                'resultSet' => $candidato,
                'success' => true,
                'errorMessage' =>   "Id não encontrado ($id)",
                'id' => $id,
            ], 404);;
        }
    }
    
    public function next($id) {
        $candidato = $this->candidato->where('id', '>', $id)->select('id')->orderBy('id', 'ASC')->limit(1)->pluck('id');
       
        return response()->json([
            'resultSet' => (count($candidato) > 0 ?$candidato[0] : $id),
            'success' => true,
            'errorMessage' => '',
            'id' => (count($candidato) > 0 ?$candidato[0] : $id),
        ]);;
    }
    
    public function prev($id) {
        $candidato = $this->candidato->where('id', '<', $id)->select('id')->orderBy('id', 'DESC')->limit(1)->pluck('id');
        
        return response()->json([
            'resultSet' => (count($candidato) > 0 ?$candidato[0] : $id),
            'success' => true,
            'errorMessage' => '',
            'id' => (count($candidato) > 0 ?$candidato[0] : $id),
        ]);;
    }
    
  
}