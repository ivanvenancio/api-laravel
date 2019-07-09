<?php

namespace App\Http\Controllers;

use App\Model\Specifier;
use Illuminate\Http\Request;
use App\Http\Resources\SpecifierResource;
use App\Http\Requests\SpecifierRequest;

class SpecifierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $specifier = Specifier::paginate();
        return SpecifierResource::collection($specifier);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SpecifierRequest $request)
    {
        $data = $request->all();
        $validated = $request->validated();
        
        try{            
            $specifier = Specifier::create($data);

            return response()->json(
                ['data' => [
                    'msg' => 'Especificador criado com sucesso'
                    ]
                ], 201);
        }catch(\Exception $e){
            if(config('app.debug')){
                return response()->json(
                    ['data' => [
                        'error' => $e->getMessage()
                        ]
                    ], 500);
            }
            return response()->json(
                ['data' => [
                    'error' => 'Erro ao criar especificador'
                    ]
                ]
                , 500); 
        }        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $specifier = Specifier::find($id);
        
        if(!$specifier){            
            return response()->json(
                ['data' => [
                    'error' => 'Especificador não encontrado'
                    ]
                ]
                , 404); 
        }
        return new SpecifierResource($specifier);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $data = $request->all();
            $office = Specifier::find($id);
            $office->update($data);

            return response()->json(
                ['data' => [
                    'msg' => 'Especificador atualizado com sucesso'
                    ]
                ], 201);
        }catch(\Exception $e){
            if(config('app.debug')){
                return response()->json(
                    ['data' => [
                        'error' => $e->getMessage()
                        ]
                    ], 500);
            }
            return response()->json(
                ['data' => [
                    'error' => 'Erro ao atualizar especificador'
                    ]
                ]
                , 500); 
        }        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $specifier = Specifier::find($id);
            if(!$specifier){
                return response()->json(
                    ['data' => [
                        'error' => 'Especificador não encontrado'
                        ]
                    ]
                    , 404);            
            }
            $specifier->delete();
            return response()->json(
                ['data' => [
                    'msg' => 'Especificador removido com sucesso'
                    ]
                ], 200);
        }catch(\Exception $e){
            if(config('app.debug')){
                return response()->json(
                    ['data' => [
                        'error' => $e->getMessage()
                        ]
                    ], 500);
            }
            return response()->json(
                ['data' => [
                    'error' => 'Erro ao remover especificador'
                    ]
                ]
                , 500); 
        }
    }
}
