<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
//use Validator;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\JsonResponse;

use App\Models\Reading;

class WeatherController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): JsonResponse
    {
        $location = $request->input('location');
        $endpoint = $request->input('type');

        return $this->sendResponse(Reading::collection($location, $endpoint), 'Weather list');
    }
}