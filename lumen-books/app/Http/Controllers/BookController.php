<?php

namespace App\Http\Controllers;

use App\Book;
use App\Traits\APIResponser;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

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
        return $this->successResponse(Book::query()->latest()->get());
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
            'title' => ['required', 'max:255'],
            'description' => ['required', 'max:255'],
            'price' => ['required', 'min:1'],
            'author_id' => ['required', 'min:1'],
        ]);

        return $this->successResponse(Book::query()->create($request->all()), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id)
    {
        return $this->successResponse(Book::query()->findOrFail($id));
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
            'title' => ['max:255'],
            'description' => ['max:255'],
            'price' => ['min:1'],
            'author_id' => ['min:1'],
        ]);

        $author = Book::query()->findOrFail($id);
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
        $author = Book::query()->findOrFail($id);
        $author->delete();
        return $this->successResponse($author);
    }
}
