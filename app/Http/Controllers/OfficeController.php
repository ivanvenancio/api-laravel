<?php

namespace App\Http\Controllers;

use App\Model\Office;
use Illuminate\Http\Request;
use App\Http\Resources\OfficeResource;

class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $office = Office::paginate();
        return  OfficeResource::collection($office);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $data = $request->all();
            $office = Office::create($data);

            return response()->json(
                ['data' => [
                    'msg' => 'Escritório criado com sucesso'
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
                    'error' => 'Erro ao criar Escritório'
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
        $office = Office::find($id);
        
        if(!$office){
            return response()->json(
                ['data' => [
                    'error' => 'Escritório não encontrado'
                    ]
                ]
                , 404);            
        }
        
        return new OfficeResource($office);
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
            $office = Office::find($id);
            $office->update($data);

            return response()->json(
                ['data' => [
                    'msg' => 'Escritório atualizado com sucesso'
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
                    'error' => 'Erro ao atualizar Escritório'
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
            $office = Office::find($id);
            if(!$office){
                return response()->json(
                    ['data' => [
                        'error' => 'Escritório não encontrado'
                        ]
                    ]
                    , 404);            
            }
            $office->delete();
            return response()->json(
                ['data' => [
                    'msg' => 'Escritório removido com sucesso'
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
                    'error' => 'Erro ao remover Escritório'
                    ]
                ]
                , 500); 
        }
    }
}
