<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Models\Card;
use App\Http\Resources\CardResource;

class CardController extends Controller
{
    public function index()
    {
        return response()->json(
            ['data' => CardResource::collection(Card::all())]
        );
    }
}
