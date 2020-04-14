<?php

namespace App\Http\Controllers;

use App\Traits\APIResponser;
use Illuminate\Http\Request;

class BookController extends Controller
{
    use APIResponser;

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id)
    {
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy($id)
    {

    }
}
