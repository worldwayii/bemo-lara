<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\CreateColumnRequest;
use App\Http\Resources\ColumnResource;
use App\Models\Column;
use Illuminate\Http\Request;

class ColumnController extends Controller
{
    public function index()
    {
        return ['data' => ColumnResource::collection(Column::all()->load('cards'))];
    }
    public function store(CreateColumnRequest $request)
    {
        $column = Column::create($request->all());

        return response()->json(
            ['data' => new ColumnResource($column)],
            201
        );
    }
    public function destroy(Column $column)
    {
        $column->delete();

        return response()->json(null, 204);
    }
}
