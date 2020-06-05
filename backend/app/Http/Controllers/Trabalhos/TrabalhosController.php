<?php

namespace App\Http\Controllers\Trabalhos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Trabalho;
use Illuminate\Support\Facades\Validator;

class TrabalhosController extends Controller
{

    protected $trabalho;

    public function __construct(Trabalho $trabalho)
    {
        $this->trabalho = $trabalho;
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
        $data = $request->all();

        return response()->json($data, 200);
    }
}
