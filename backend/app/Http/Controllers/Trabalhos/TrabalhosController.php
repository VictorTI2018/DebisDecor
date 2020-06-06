<?php

namespace App\Http\Controllers\Trabalhos;

use App\Http\Controllers\Controller;
use App\Repository\TrabalhoFoto\TrabalhoFotoRepository;
use Illuminate\Http\Request;
use App\Trabalho;
use Illuminate\Support\Facades\Validator;
use Prophecy\Exception\Doubler\MethodNotFoundException;

class TrabalhosController extends Controller
{

    protected $trabalho;

    /** @var  \App\Repository\TrabalhoFoto\TrabalhoFotoRepository */
    protected $trabalhoFotoRep;

    public function __construct(Trabalho $trabalho, TrabalhoFotoRepository $trabalhoFotoRep)
    {
        $this->trabalho = $trabalho;
        $this->trabalhoFotoRep = $trabalhoFotoRep;
    }

    /**
     * Buscar todos os trabalhos
     *
     * @param integer $user_id
     * @return void
     */
    public function index(int $user_id)
    {
        $trabalhos = $this->trabalho
            ->query()
            ->where('user_id', $user_id)
            ->paginate('5');
        return response()->json($trabalhos, 200);
    }

    public function create(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'nome' => 'required',
                'descricao' => 'required',
                'user_id' => 'required|integer'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    "validator" => true,
                    "message" => $validator->errors()
                ], 404);
            }

            $data = $request->all();


            return response()->json($this->trabalhoFotoRep->insert($data['trabalhos_fotos'], 1));
        } catch (MethodNotFoundException $e) {
            return response()->json(["message" => $e->getMessage()], 404);
        }
    }
}
