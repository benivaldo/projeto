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
        
        //return response()->json(['name' => 'Abigail', 'state' => 'CA']);
        
        $candidatos = $this->candidato->query()->get();
        return response()->json(array(
            'resultSet' => $candidatos,
            'success' => true,
            'errorMessage' => '',
            'id' => '',
        ));;
    }

    public function store(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required',
            'email' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(array(
                'resultSet' => '',
                'success' => true,
                'errorMessage' =>  $validator->errors()->all(),
                'id' => '',
                'http' => 422
            ));
        }
        $candidato = new $this->candidato;
        $candidato->email = $request->input('email');
        $candidato->nome = $request->input('nome');
        $candidato->save();
        
        return response()->json(array(
            'resultSet' => $candidato,
            'success' => true,
            'errorMessage' =>  'Operação conculuída com sucesso.',
            'id' => $candidato->id,
            'http' => ''
        ));;
    }

    public function get($id) {
        $candidato = $this->candidato->query()->find($id);
        
        return response()->json(array(
            'resultSet' => $candidato,
            'success' => true,
            'errorMessage' => ($candidato ? "" : "Not found candidato for ID "),
            'id' => '',
        ));;
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
                return response()->json(array(
                    'resultSet' => $candidato,
                    'success' => true,
                    'errorMessage' =>  $validator->errors()->all(),
                    'id' => '',
                    'http' => 422
                ));
            } else {
                $candidato = $this->candidato->query()->find($id);
                $candidato->email = $request->input('email');
                $candidato->nome = $request->input('nome');
                $candidato->save();

                return response()->json(array(
                    'resultSet' => $candidato,
                    'success' => true,
                    'errorMessage' =>  'Operação conculuída com sucesso.',
                    'id' => $id,
                    'http' => ''
                ));;
            }
        }
        else {
            return response(['error' => 'Not found candidato for ID '. $id], 404);
        }
    }

    public function delete($id) 
    {
        $candidato = $this->candidato->query()->find($id);
        if ($candidato) {
            $this->candidato->query()->findOrFail($id)->delete();
            return response()->json(array(
                'resultSet' => $candidato,
                'success' => true,
                'errorMessage' =>  'Operação conculuída com sucesso.',
                'id' => $id,
                'http' => ''
            ));;
        } else {
            return response()->json(array(
                'resultSet' => $candidato,
                'success' => true,
                'errorMessage' =>  'Id não encontrado',
                'id' => $id,
                'http' => 404
            ));;
        }
    }
    
    public function next($id) {
        $candidato = $this->candidato->where('id', '>', $id)->select('id')->orderBy('id', 'ASC')->limit(1)->pluck('id');
       
        return response()->json(array(
            'resultSet' => $candidato[0],
            'success' => true,
            'errorMessage' => '',
            'id' => $candidato[0],
        ));;
    }
    
    public function prev($id) {
        $candidato = $this->candidato->where('id', '<', $id)->select('id')->orderBy('id', 'DESC')->limit(1)->pluck('id');
        
        return response()->json(array(
            'resultSet' => $candidato[0],
            'success' => true,
            'errorMessage' => '',
            'id' => $candidato[0],
        ));;
    }

}