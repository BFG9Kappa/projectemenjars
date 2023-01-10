<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comanda;
use Validator;

class comandasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $comandas = Comanda::all(['id','nom']);
        $response = [
            'success' => true,
            'message' => "Llistat comandes recuperat",
            'data' => $comandas,
        ];
        //return $response;
        return response()->json($response,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //validar camps
        
        $input = $request->all();
        $validator = Validator::make($input,
            [
                'nom'=>'required|min:3|max:10',
            ]
    
            );
        if($validator->fails()) {
            $response = [
                'success' => false,
                'message' => "Errors de validació",
                'data' => $validator->errors(),
            ];
            //return $response;
            return response()->json($response,400);
        }


        $comanda = Comanda::create($input);

        $response = [
            'success' => true,
            'message' => "Comanda creada correctament",
            'data' => $comanda,
        ];
        //return $response;
        return response()->json($response,200);

        //return $input;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $comanda = Comanda::find($id);
        if($comanda==null){
            
            $response = [
                'success' => false,
                'message' => "Comanda no recuperada",
                'data' => [],
            ];
 
            return response()->json($response,404);
        }
     
            $response = [
                'success' => true,
                'message' => "Comanda recuperada",
                'data' => $comanda,
            ];
        
            return response()->json($response,200);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $comanda = Comanda::find($id);
        if($comanda==null){
            
            $response = [
                'success' => false,
                'message' => "Comanda no recuperada",
                'data' => [],
            ];
 
            return response()->json($response,404);
        }
        
        //
        $input = $request->all();
        $validator = Validator::make($input,
            [
                'nom'=>'required|min:3|max:10',
            ]
    
            );
        if($validator->fails()) {
            
            $response = [
                'success' => false,
                'message' => "Errors de validació",
                'data' => $validator->errors(),
            ];
            //return $response;
            return response()->json($response,400);
        }

        //versió 1- rapida pero perillosa
        $comanda->update($input);

        //versió 2 - segura
        //$comanda->name = $input->name;
        //$comanda->save();

        $response = [
            'success' => true,
            'message' => "Cmanda actualitzada correctament",
            'data' => $comanda,
        ];
        //return $response;
        return response()->json($response,200);

        //return $input;
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comanda = Comanda::find($id);
        if($comanda==null){
            
            $response = [
                'success' => false,
                'message' => "Comanda no recuperada",
                'data' => [],
            ];
 
            return response()->json($response,404);
        }
     
        try{
            $comanda->delete();

            $response = [
                'success' => true,
                'message' => "Comanda esborrada",
                'data' => $comanda,
            ];
        
            return response()->json($response,200);

        }

        catch(\Excepetion $e){

            $response = [
                'success' => false,
                'message' => "Error esborrant comanda",
                
            ];
        
            return response()->json($response,400);

        }
       

    
    }
}
