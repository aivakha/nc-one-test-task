<?php

namespace App\Http\Filters;

use App\Models\Booking;
use App\Models\City;
use App\Models\Room;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class ApartmentFilter extends AbstractFilter
{
    const TITLES = 'titles';
    const PRICES = 'prices';
    const BEDROOMS = 'bedrooms';
    const BATHROOMS = 'bathrooms';
    const STOREYS = 'storeys';
    const GARAGES = 'garages';

    protected function getCallbacks(): array
    {
        return [
            self::TITLES => [$this, 'titles'],
            self::PRICES => [$this, 'prices'],
            self::BEDROOMS => [$this, 'bedrooms'],
            self::BATHROOMS => [$this, 'bathrooms'],
            self::STOREYS => [$this, 'storeys'],
            self::GARAGES => [$this, 'garages'],
        ];
    }

    protected function bathrooms(Builder $builder, $value)
    {
        $builder->whereIn('bathrooms', $value);
    }

    protected function bedrooms(Builder $builder, $value)
    {
        $builder->whereIn('bedrooms', $value);
    }

    protected function storeys(Builder $builder, $value)
    {
        $builder->whereIn('storeys', $value);
    }

    protected function garages(Builder $builder, $value)
    {
        $builder->whereIn('garages', $value);
    }

    protected function titles(Builder $builder, $value)
    {
        $builder->where('title', 'LIKE', '%'.$value.'%');
    }

    protected function prices(Builder $builder, $value)
    {
        $builder->whereBetween('price', $value);
    }

}
