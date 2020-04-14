<?php

namespace App\Http\Controllers;

use App\Services\AuthorService;
use App\Traits\APIResponser;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laravel\Lumen\Http\ResponseFactory;

class AuthorController extends Controller
{
    use APIResponser;
    /**
     * @var AuthorService
     */
    public $authorService;

    /**
     * create controller instance
     * @param AuthorService $authorService
     */
    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response|ResponseFactory
     */
    public function index()
    {
        return $this->sucessResponse($this->authorService->obtainAuthors());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response|ResponseFactory
     */
    public function store(Request $request)
    {
        return $this->sucessResponse($this->authorService->createAuthor($request->all()), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response|ResponseFactory
     */
    public function show($id)
    {
        return $this->sucessResponse($this->authorService->showAuthor($id));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response|ResponseFactory
     */
    public function update(Request $request, $id)
    {
        return $this->sucessResponse($this->authorService->editAuthor($request->all(), $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response|ResponseFactory
     * @throws Exception
     */
    public function destroy($id)
    {
        return $this->sucessResponse($this->authorService->deleteAuthor($id));
    }
}
