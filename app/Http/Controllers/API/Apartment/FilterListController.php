<?php

namespace App\Http\Controllers\API\Apartment;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;

class FilterListController extends Controller
{
    public function __invoke(Apartment $apartment) {
        $bedrooms = Apartment::distinct()->get('bedrooms');
        $bathrooms = Apartment::distinct()->get('bathrooms');
        $storeys = Apartment::distinct()->get('storeys');
        $garages = Apartment::distinct()->get('garages');
        // prices
        $maxPrice = Apartment::orderBy('price', 'DESC')->first()->price;
        $minPrice = Apartment::orderBy('price', 'ASC')->first()->price;

        $result = [
            'bedrooms' => $bedrooms,
            'bathrooms' => $bathrooms,
            'storeys' => $storeys,
            'garages' => $garages,
            'price' => [
                'max' => $maxPrice,
                'min' => $minPrice,
            ],
        ];

        return response()->json($result);
    }
}
