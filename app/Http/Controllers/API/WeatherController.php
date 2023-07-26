<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\AuthController as AuthController;
//use Validator;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\JsonResponse;

use App\Models\Reading;
use Illuminate\Support\Facades\DB;

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

    /**
     * Show only the weather from one endpoint
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, string $type): JsonResponse
    {
        $reading = Reading::where('slug', $type)->first();

        if (is_null($reading)) {
            return $this->sendError('API not found');   
        }

        try {
            $location = $request->input('location');
            $data = $reading->cast($location)->getContents();

            return $this->sendResponse($data, 'Weather list');
        } catch(\Exception $e) {
            return $this->sendError($e->getMessage()); 
        }
    }
}