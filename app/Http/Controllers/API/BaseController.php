<?php


namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class BaseController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message)
    {
    	$response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];


        return response()->json($response, 200);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
    	$response = [
            'success' => false,
            'message' => $error,
        ];


        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }


        return response()->json($response, $code);
    }


    /* Check if foreign key exist before */
    public function hasKeyExits(Model $model, $keyName, $keyValue): bool
    {
    // return $project->users()
    //     ->where('user_id', $user->getKey())
    //     ->exists();
     // Vérifie si la clé étrangère existe
        $foreignKeyModel = $model->{$keyName}()->getRelated();
        return $foreignKeyModel->where($keyName, $keyValue)->first();
    }
}