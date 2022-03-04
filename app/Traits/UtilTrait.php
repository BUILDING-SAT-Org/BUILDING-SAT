<?php

namespace App\Traits;

use App\Models\Country;
use Illuminate\Database\Eloquent\Collection;
use phpDocumentor\Reflection\Types\Integer;

trait UtilTrait
{
    public function filterCollectionBySubphase($collection, int $sub_phase_id)
    {
        return $collection->filter(function ($value, $key) use ($sub_phase_id) {
            return $value->sub_phase_id == $sub_phase_id;
        });
    }

    public function filterCollectionForReplacements($collection, int $sub_phase_id)
    {
        return $collection->filter(function ($value, $key) use ($sub_phase_id) {
            return $value->sub_phase_id == $sub_phase_id && $value->is_replaceable == 1;
        });
    }

    public function filterCollectionMainPhase($collection, string $main_phase_slug)
    {
        return $collection->filter(function ($value, $key) use ($main_phase_slug) {
            return $value->slug == $main_phase_slug;
        });
    }

    public function filterMaterialByCategory($collection, int $category_id)
    {
        return $collection->filter(function ($value, $key) use ($category_id) {
            return $value->category_id == $category_id;
        });
    }

    public static function getCountryIdByName(string $country)
    {
        if (Country::where('label', trim($country))->first() != null) {
            return Country::where('label', trim($country))->first()->id;
        } else {
            return null;
        }
    }

    public function slugify(string $str)
    {
        return str_replace("-", "_", strtolower($str));
    }
}
