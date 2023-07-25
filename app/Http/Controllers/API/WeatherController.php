<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\AuthController as AuthController;
//use Validator;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\JsonResponse;

use App\Models\Reading;

class WeatherController extends AuthController
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