<?php 

namespace App\Http\Controllers;

use App\Candidato;
use Illuminate\Http\Request;
use Validator;

class CandidatoController extends Controller 
{
    public function __construct(Candidato $candidato) 
    {
        $this->candidato = $candidato;  
    }

    public function index() 
    {
        $candidatos = $this->candidato->query()->get();
        
        return response()->json([
            'resultSet' => $candidatos,
            'errorMessage' => '',
            'id' => '',
        ]);
    }

    public function store(Request $request) 
    {
        $validator = Validator::make($request->all(), $this->candidato->rules);
        
        if ($validator->fails()) {
            return response()->json([                
                'resultSet' => '',
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
            'errorMessage' =>  'Operação conculuída com sucesso.',
            'id' => $candidato->id,
        ], 201);
    }

    public function get($id) 
    {
        $candidato = $this->candidato->query()->find($id);
        
        if ($candidato) {
            return response()->json([
                'resultSet' => $candidato,
                'errorMessage' => "",
                'id' => $id,
            ]);
        } else {
            return response()->json([
                'resultSet' => '',
                'errorMessage' => ($candidato ? "" : "Not found candidato for ID "),
                'id' => $id,
            ], 404);
        }
    }

    public function update(Request $request, $id) 
    {
        $candidato = $this->candidato->query()->find($id);
        
        if ($candidato) {
            $validator = Validator::make($request->all(), $this->candidato->rules);
            
            if ($validator->fails()) {
                return response()->json([
                    'resultSet' => $candidato,
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
                    'errorMessage' =>  'Operação conculuída com sucesso.',
                    'id' => $id,
                ]);
            }
        } else {
            return response()->json([
                'resultSet' => $candidato,
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
                'errorMessage' =>  'Operação conculuída com sucesso.',
                'id' => $id,
               ]);;
        } else {
            return response()->json([
                'resultSet' => $candidato,
                'errorMessage' =>   "Id não encontrado ($id)",
                'id' => $id,
            ], 404);;
        }
    }
    
    public function next($id) 
    {
        $candidato = $this->candidato->where('id', '>', $id)->select('id')->orderBy('id', 'ASC')->limit(1)->pluck('id');
       
        return response()->json([
            'resultSet' => (count($candidato) > 0 ? $candidato[0] : $id),
            'errorMessage' => '',
            'id' => (count($candidato) > 0 ?$candidato[0] : $id),
        ]);;
    }
    
    public function prev($id) 
    {
        $candidato = $this->candidato->where('id', '<', $id)->select('id')->orderBy('id', 'DESC')->limit(1)->pluck('id');
        
        return response()->json([
            'resultSet' => (count($candidato) > 0 ? $candidato[0] : $id),
            'errorMessage' => '',
            'id' => (count($candidato) > 0 ? $candidato[0] : $id),
        ]);;
    }
}