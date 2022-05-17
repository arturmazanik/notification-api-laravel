<?php


namespace App\Http\Middleware;

use App\Rules\E164;
use App\Rules\onlyLatin;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;

trait ApiHelpers
{
    protected function isAdmin($user): bool
    {
        if (!empty($user)) {
            return $user->tokenCan('admin');
        }
        return false;
    }
    protected function onSuccess($data, string $message = '', int $code = 200): JsonResponse
    {
        return response()->json([
            'status' => $code,
            'message' => $message,
            'data' => $data,
        ], $code);
    }
    protected function onError(int $code, string $message = ''): JsonResponse
    {
        return response()->json([
            'status' => $code,
            'message' => $message,
        ], $code);
    }

    protected function clientValidationRules(): array
    {
        return [
            'firstName' => ['required', 'string', 'min:2', 'max:32', new onlyLatin()],
            'lastName' => ['required', 'string', 'min:2', 'max:32', new onlyLatin()],
            'email' => ['required', 'string', 'email'],
            'phoneNumber' => ['string', new E164()],
        ];
    }

    protected function userValidatedRules(): array
    {
        return [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    protected function notificationValidatedRules(): array
    {
        return [
            'clientId'  =>  ['required', 'integer'],
            'channel'  =>  [
                'required',
                Rule::in(['sms', 'email']),
            ],
            'content'  =>  ['required', 'string', ],
        ];
    }

    protected function oneNotificationValidatedRules(): array
    {
        return [
            'id'  =>  ['required', 'integer'],
        ];
    }

    protected function notificationFiltredValidatedRules(): array
    {
        return [
            'clientId'  =>  ['integer'],
        ];
    }
}
