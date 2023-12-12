<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;

use App\Http\Requests\AddPreferenceRequest;
use App\Http\Resources\SourceCollection;
use App\Http\Resources\UserPreferenceCollection;
use App\Interfaces\UserServiceInterface;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function __construct(private UserServiceInterface $userServiceInterface)
    {
    }

    public function preferences()
    {
        $data =$this->userServiceInterface->preferences();
        $data = UserPreferenceCollection::collection($data);
        return response()->json(['message' => 'user preferences list', 'data' => $data],Response::HTTP_OK);
    }

    public function sources()
    {
        $data =$this->userServiceInterface->sources();
        return response()->json(['message' => 'user preferences list', 'data' => $data],Response::HTTP_OK);
    }

    public function addPreferences(AddPreferenceRequest $request)
    {
        $this->userServiceInterface->addPreferences($request->type,$request->preference);
        return response()->json(['message' => 'user preferences added successfully', 'data' => ''],
            Response::HTTP_CREATED);
    }

    public function deletePreferences($id)
    {
        $this->userServiceInterface->deletePreferences($id);
        return response()->json(['message' => 'user preferences deleted successfully', 'data' => ''],
            Response::HTTP_OK);
    }

    public function news(Request $request)
    {
        $data = $this->userServiceInterface->news($request->all());
        return response()->json([
            'message' => 'user preferences',
            'data' => SourceCollection::collection($data)->response()->getData(true)],
            Response::HTTP_OK);

    }
}
