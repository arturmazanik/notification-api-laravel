<?php


namespace App\Http\Controllers;


use App\Http\Controllers\API\Swagger;
use App\Http\Middleware\ApiHelpers;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class ClientController extends Controller
{
    use ApiHelpers;
    use Swagger;

    public function clients(Request $request): JsonResponse
    {
        $clients = Client::paginate(10);
        return $this->onSuccess($clients, 'Clients Retrieved');
    }

    public function getClient(Request $request, $id): JsonResponse
    {
        $validator = Validator::make($request->all(), $this->oneNotificationValidatedRules());
        if ($validator->passes()) {
            $client = Client::Find($id);
            if (!$client) {
                return $this->onError(404, 'Notification not found by id.');
            }
            return $this->onSuccess($client);
        }
        return $this->onError(400, $validator->errors());
    }

    /**
     * @OA\Get(
     *     path="/addClient",
     *     operationId="addClient",
     *     tags={"Add client"},
     *     summary="Display a listing of the resource",
     *     security={
     *       {"api_key": {}},
     *     },
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Array request params",
     *         required=false,
     *         @OA\Schema(
     *             type="json",
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="add client",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="json",
     *             )
     *         )
     *     ),
     * )
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function addClient(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), $this->clientValidationRules());
        if ($validator->passes()) {
            $client = Client::create([
                'firstName' => $request->input('firstName'),
                'lastName' => $request->input('lastName'),
                'email' => $request->input('email'),
                'phoneNumber' => $request->input('phoneNumber'),
            ]);
            return $this->onSuccess($client, 'Client Created');
        }
        return $this->onError(400, $validator->errors());
    }

    public function updateClient(Request $request, $id): JsonResponse
    {
        $validator = Validator::make($request->all(), $this->clientValidationRules());
        if ($validator->passes()) {
            $client = Client::FindOrFail($id);
            $client->fill([
                'firstName' => $request->get('firstName'),
                'lastName' => $request->get('lastName'),
                'email' => $request->get('email'),
                'phoneNumber' => $request->get('phoneNumber'),
            ])->save();
            return $this->onSuccess($client, 'Client Updated');
        }
        return $this->onError(400, $validator->errors());
    }

    public function deleteClient(Request $request, $id): JsonResponse
    {
        $client = Client::find($id);
        $client->delete();
        if (!empty($client)) {
            return $this->onSuccess($client, 'Client Deleted');
        }
        return $this->onError(404, 'Client Not Found');
    }
}
