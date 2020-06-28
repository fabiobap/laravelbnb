<?php

namespace App\Http\Controllers\Api;

use App\Bookable;
use App\Http\Controllers\Controller;
use App\Http\Requests\AvailabilityStore;
use Illuminate\Http\Request;

class BookableAvailabilityController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id, AvailabilityStore $request)
    {
        $validatedData = $request->validated();
        $bookable = Bookable::findOrFail($id);

        return $bookable->availableFor($validatedData['from'], $validatedData['to'])
            ? response()->json([])
            : response()->json([], 404);
    }
}
