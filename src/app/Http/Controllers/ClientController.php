<?php


namespace App\Http\Controllers;


use App\Http\Middleware\ApiHelpers;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class ClientController extends Controller
{
    use ApiHelpers;

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
