<?php

namespace App\Http\Controllers;

use App\Model\Office;
use App\Model\Specifier;
use Illuminate\Http\Request;
use App\Model\OfficeSpecifier;
use App\Http\Requests\SpecifierRequest;
use App\Http\Resources\SpecifierResource;

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
                    'msg' => 'Especificador criado com sucesso',
                    'specifier' => $specifier
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
    public function update(SpecifierRequest $request, $id)
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
        try{
            $data = $request->except('cpf');
            $validated = $request->validated();
            
            $specifier->update($data);

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
                    'msg' => 'Especificador removido com sucesso',
                    'specifier' => $specifier
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
    /**
     * Método que associa um novo Especificador a um Escritório,
     * inativando se já houver alguma associação existente 
     */
    public function unlinkOffice(Request $request){

        $specifier_id = $request->specifier_id;
        $office_id = $request->office_id;
        
        $specifier = Specifier::find($specifier_id);
        
        if(!$specifier){            
            return response()->json(
                ['data' => [
                    'error' => 'Especificador não encontrado'
                    ]
                ]
                , 404); 
        }

        $office = Office::find($office_id);
        
        if(!$office){            
            return response()->json(
                ['data' => [
                    'error' => 'Escritório não encontrado'
                    ]
                ]
                , 404); 
        }

        /**
         * Inativa todos os possiveís vinculos do Especificador,
         * garantindo 1 escritório ativo
         */
        OfficeSpecifier::where('specifier_id',$specifier_id)
            ->update(['status' => 'no']);

        /**
         * Associa novo Escritório, atualizando um existente ou criando um novo
         */
        try{
            $officeSpecifier = OfficeSpecifier::updateOrCreate(
                ['office_id' => $office_id, 'specifier_id' => $specifier_id],
                ['status' => 'yes']
            );

            return response()->json(
                ['data' => [
                    'msg' => 'Escritório associado com sucesso',
                    'Offices' => $officeSpecifier
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
}
