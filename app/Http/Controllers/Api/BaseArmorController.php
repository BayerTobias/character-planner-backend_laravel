<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BaseArmorResource;
use App\Models\Items\BaseArmor;
use Illuminate\Http\Request;

class BaseArmorController extends Controller
{
    public function getBaseArmorList()
    {
        $armors = BaseArmor::all();

        return BaseArmorResource::collection($armors);
    }
}
