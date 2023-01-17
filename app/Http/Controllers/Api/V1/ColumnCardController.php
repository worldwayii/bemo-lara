<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Models\Column;
use App\Http\Resources\CardResource;
use App\Http\Requests\CreateCardRequest;

class ColumnCardController extends Controller
{
    public function index(Column $column)
    {
        return ['data' => CardResource::collection($column->cards)];
    }
    public function store(Column $column, CreateCardRequest $request)
    {
        $card = $column->cards()->create(
            $request->validated()
        );

        return response()->json(
            ['data' => new CardResource($card)],
            201
        );
    }
}
