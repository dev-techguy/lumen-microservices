<?php

namespace App\Http\Controllers;

use App\Author;
use App\Traits\APIResponser;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class AuthorController extends Controller
{
    use APIResponser;

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return $this->successResponse(Author::query()->latest()->get());
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
        $this->validate($request, [
            'name' => ['required', 'max:255'],
            'gender' => ['required', 'max:255', 'in:male,female'],
            'country' => ['required', 'max:255'],
        ]);

        return $this->successResponse(Author::query()->create($request->all()), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id)
    {
        return $this->successResponse(Author::query()->findOrFail($id));
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
        $this->validate($request, [
            'name' => ['max:255'],
            'gender' => ['max:255', 'in:male,female'],
            'country' => ['max:255'],
        ]);

        $author = Author::query()->findOrFail($id);
        $author->fill($request->all());
        if ($author->isClean()) {
            return $this->errorResponse('At least one value value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $author->save();

        return $this->successResponse($author);
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
        $author = Author::query()->findOrFail($id);
        $author->delete();
        return $this->successResponse($author);
    }
}
