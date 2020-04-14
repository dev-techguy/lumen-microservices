<?php

namespace App\Services;

use App\Traits\ConsumeExternalService;

class AuthorService
{
    use ConsumeExternalService;

    private $baseUri;

    /**
     * create instance of
     * AuthorService
     */
    public function __construct()
    {
        $this->baseUri = config('services.authors.base_uri');
    }

    /**
     * obtainAuthors list
     * @return string
     */
    public function obtainAuthors()
    {
        return $this->performRequest('GET', '/authors');
    }

    /**
     * createAuthor
     * @param array $data
     * @return string
     */
    public function createAuthor(array $data)
    {
        return $this->performRequest('POST', '/authors', $data);
    }

    /**
     * showAuthor
     * @param $id
     * @return string
     */
    public function showAuthor($id)
    {
        return $this->performRequest('GET', '/authors/' . $id);
    }

    /**
     * editAuthor
     * @param array $data
     * @param $id
     * @return string
     */
    public function editAuthor(array $data, $id)
    {
        return $this->performRequest('PUT', '/authors/' . $id, $data);
    }

    /**
     * deleteAuthor
     * @param $id
     * @return string
     */
    public function deleteAuthor($id)
    {
        return $this->performRequest('DELETE', '/authors/' . $id);
    }
}
