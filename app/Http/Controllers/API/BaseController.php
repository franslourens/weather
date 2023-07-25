<?php
    namespace App\Http\Controllers\API;
    
    use Illuminate\Http\Request;
    use Illuminate\Http\JsonResponse;
    use App\Http\Controllers\Controller as Controller;

    use App\Models\Reading;

    class BaseController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index(Request $request): JsonResponse
        {
            $location = $request->input('location');

            $readings = Reading::all()->transform(function($item) {
                return $item->only(['type', 'endpoint', 'description']);
            });

            return $this->sendResponse($readings, 'Weather list');
        }

        /**
        * success response method.
        *
        * @return \Illuminate\Http\Response
        */
        public function sendResponse($result, $message)
        {
            $response = [
                'success' => true,
                'data'    => $result,
                'message' => $message,
            ];

            return response()->json($response, 200);
        }

        /**
        * return error response.
        *
        * @return \Illuminate\Http\Response
        */
        public function sendError($error, $errorMessages = [], $code = 404)
        {
            $response = [
                'success' => false,
                'message' => $error,
            ];

            if(!empty($errorMessages)){
                $response['data'] = $errorMessages;
            }

            return response()->json($response, $code);
        }
    }