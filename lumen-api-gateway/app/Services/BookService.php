<?php

namespace App\Services;

use App\Traits\ConsumeExternalService;

class BookService
{
    use ConsumeExternalService;

    private $baseUri;

    /**
     * create instance of
     * BookService
     */
    public function __construct()
    {
        $this->baseUri = config('services.books.base_uri');
    }

    /**
     * obtainBooks list
     * @return string
     */
    public function obtainBooks()
    {
        return $this->performRequest('GET', '/books');
    }

    /**
     * createBook
     * @param array $data
     * @return string
     */
    public function createBook(array $data)
    {
        return $this->performRequest('POST', '/books', $data);
    }

    /**
     * showBook
     * @param $id
     * @return string
     */
    public function showBook($id)
    {
        return $this->performRequest('GET', '/books/' . $id);
    }

    /**
     * editBook
     * @param array $data
     * @param $id
     * @return string
     */
    public function editBook(array $data, $id)
    {
        return $this->performRequest('PUT', '/books/' . $id, $data);
    }

    /**
     * deleteBook
     * @param $id
     * @return string
     */
    public function deleteBook($id)
    {
        return $this->performRequest('DELETE', '/books/' . $id);
    }
}
