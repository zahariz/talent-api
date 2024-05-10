<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactCreateRequest;
use App\Http\Requests\ContactUpdateRequest;
use App\Http\Resources\ContactCollection;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function validationMessage(int $statusCode, $message)
    {
        throw new HttpResponseException(response()->json([
            'errors' => [
                "message" => [
                    $message
                ]
            ]
        ])->setStatusCode($statusCode));
    }

    public function show()
    {
        $contacts = Contact::all();

        return new ContactCollection($contacts);
    }

    public function store(ContactCreateRequest $request): JsonResponse
    {
        $data = $request->validated();

        $contact = new Contact($data);
        $contact->save();

        return (new ContactResource($contact))->response()->setStatusCode(201);
    }

    public function get(int $id): ContactResource
    {
        $contact = Contact::where('id', $id)->first();
        if (!$contact) {
            $this->validationMessage(404, "Not Found");
        }

        return new ContactResource($contact);
    }

    public function update(int $id, ContactUpdateRequest $request): ContactResource
    {
        $contact = Contact::where('id', $id)->first();

        if (!$contact) {
            $this->validationMessage(404, "Not Found");
        }

        $data = $request->validated();
        $contact->fill($data);
        $contact->save();

        return new ContactResource($contact);
    }

    public function delete(int $id): JsonResponse
    {
        $contact = Contact::where('id', $id)->first();
        if (!$contact) {
            $this->validationMessage(404, "Not Found");
        }
        $contact->delete();
        return response()->json([
            'data' => true
        ])->setStatusCode(200);
    }

}
