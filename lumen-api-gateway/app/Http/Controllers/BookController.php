<?php

namespace App\Http\Controllers;

use App\Services\AuthorService;
use App\Services\BookService;
use App\Traits\APIResponser;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laravel\Lumen\Http\ResponseFactory;

class BookController extends Controller
{
    use APIResponser;
    /**
     * @var BookService
     */
    public $bookService;
    /**
     * @var AuthorService
     */
    private $authorService;

    /**
     * controller instance
     * @param BookService $bookService
     * @param AuthorService $authorService
     */
    public function __construct(BookService $bookService, AuthorService $authorService)
    {
        $this->bookService = $bookService;
        $this->authorService = $authorService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response|ResponseFactory
     */
    public function index()
    {
        return $this->successResponse($this->bookService->obtainBooks());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response|ResponseFactory
     */
    public function store(Request $request)
    {
        $this->authorService->showAuthor($request->author_id);
        return $this->successResponse($this->bookService->createBook($request->all()), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response|ResponseFactory
     */
    public function show($id)
    {
        return $this->successResponse($this->bookService->showBook($id));
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
        $this->authorService->showAuthor($request->author_id);
        return $this->successResponse($this->bookService->editBook($request->all(), $id));
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
        return $this->successResponse($this->bookService->deleteBook($id));
    }
}
