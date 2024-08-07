<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\KanyeWest;
use App\Http\Requests\QuotesRequest;

class QuotesController extends Controller
{
    /**
     * Return the response for using the Kanye West service class.
     * 
     * @param Request $request
     * @return Response
     */
    public function index(QuotesRequest $request): JsonResponse
    {
        $quotes = KanyeWest::quotes(
            $request->get('limit', 5)
        );

        return response()->json(['quotes' => $quotes], 200);
    }
}