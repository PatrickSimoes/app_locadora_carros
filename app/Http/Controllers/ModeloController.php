<?php

namespace App\Http\Controllers;

use App\Models\Modelo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ModeloController extends Controller
{
    protected $modelo;

    public function __construct(Modelo $modelo) {
        $this->modelo = $modelo;
    }

    public function index(Request $request)
    {
        $modelos = array();

        if($request->has('atributos_marca')) {
            $atributos_marca = $request->atributos_marca;
            $modelos = $this->modelo->with('marca:id,'.$atributos_marca);
        } else {
            $modelos = $this->modelo->with('marca');
        }

        if($request->has('atributos')) {
            $atributos = $request->atributos;
            $modelos = $modelos->selectRaw($atributos)->get();
        } else {
            $modelos = $modelos->get();
        }

        return response()->json($modelos, 200);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate($this->modelo->rules());

        $imagem = $request->file('imagem');
        $imagem_urn = $imagem->store('imagens/modelos', 'public');

        $modelo = $this->modelo->create([
            'marca_id' => $request->marca_id,
            'nome' => $request->nome,
            'imagem' => $request->imagem,
            'numero_portas' => $request->numero_portas,
            'lugares' => $request->lugares,
            'air_bag' => $request->air_bag,
            'abs' => $request->abs,
        ]);

        return response()->json($modelo, 201);
    }

    public function show($id)
    {
        $modelo = $this->modelo->with('marca')->find($id);
        if($modelo === null) {
            return response()->json(['erro' => 'Recurso pesquisado não existe'], 404) ;
        } 

        return response()->json($modelo, 200);
    }

    public function edit(Modelo $modelo)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $modelo = $this->modelo->find($id);

        if($modelo === null) {
            return response()->json(['erro' => 'Impossível realizar a atualização. O recurso solicitado não existe'], 404);
        }

        if($request->method() === 'PATCH') {

            $regrasDinamicas = array();

            //percorrendo todas as regras definidas no Model
            foreach($modelo->rules() as $input => $regra) {
                
                //coletar apenas as regras aplicáveis aos parâmetros parciais da requisição PATCH
                if(array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regra;
                }
            }
            
            $request->validate($regrasDinamicas);

        } else {
            $request->validate($modelo->rules());
        }

        if($request->file('imagem')) {
            Storage::disk('public')->delete($modelo->imagem);
        }

        $imagem = $request->file('imagem');
        
        $imagem_urn = $imagem->store('imagens/modelos', 'public');

        $modelo->fill($request->all());

        $modelo->imagem = $imagem_urn;

        $modelo->save();

        return response()->json($modelo, 200);
    }

    public function destroy($id, Request $request)
    {
        $modelo = $this->modelo->find($id);

        if($modelo === null) {
            return response()->json(['erro' => 'Impossível realizar a exclusão. O recurso solicitado não existe'], 404);
        }

        Storage::disk('public')->delete($modelo->imagem);

        $modelo->delete();
        
        return response()->json(['msg' => 'A modelo foi removida com sucesso!'], 200);
        
    }
}
