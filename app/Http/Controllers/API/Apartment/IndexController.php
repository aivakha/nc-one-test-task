<?php

namespace App\Http\Controllers\API\Apartment;

use App\Http\Controllers\Controller;
use App\Http\Filters\ApartmentFilter;
use App\Http\Requests\API\Apartment\IndexRequest;
use App\Http\Resources\Apartment\ApartmentResource;
use App\Models\Apartment;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke(IndexRequest $request) {
        $data = $request->validated();
        $filter = app()->make(ApartmentFilter::class, ['queryParams' => array_filter($data)]);
        $rooms = Apartment::filter($filter)->get();

        return ApartmentResource::collection($rooms);
    }
}
