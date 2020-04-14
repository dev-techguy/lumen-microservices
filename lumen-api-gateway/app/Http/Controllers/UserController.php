<?php

namespace App\Http\Controllers;

use App\Traits\APIResponser;
use App\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Http\ResponseFactory;

class UserController extends Controller
{
    use APIResponser;

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return $this->validResponse(User::query()->latest()->get());
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
            'email' => ['required', 'max:255', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6', 'max:255', 'confirmed'],
        ]);

        $fields = $request->all();
        $fields['password'] = Hash::make($request->password);

        return $this->validResponse(User::query()->create($fields), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id)
    {
        return $this->validResponse(User::query()->findOrFail($id));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse|Response|ResponseFactory
     * @throws ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => ['max:255'],
            'email' => ['max:255', 'email', 'unique:users,email,' . $id],
            'password' => ['min:6', 'max:255', 'confirmed'],
        ]);

        $user = User::query()->findOrFail($id);
        $user->fill($request->all());

        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($user->isClean()) {
            return $this->errorResponse('At least one value value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user->save();

        return $this->validResponse($user);
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
        $user = User::query()->findOrFail($id);
        $user->delete();
        return $this->validResponse($user);
    }
}
