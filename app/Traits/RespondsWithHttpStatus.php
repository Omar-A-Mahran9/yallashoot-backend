<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait RespondsWithHttpStatus
{
    protected function success($message='The operation has been completed successfully', $data = [], $status = Response::HTTP_OK)
    {
        return response([
            'success' => true,
            'data' => $data,
            'message' => $message,
        ], $status);
    }

    protected function successWithPagination($message, $data = [], $status = Response::HTTP_OK)
    {
         
        $meta = [
            'total' => $data->total(),
            'per_page' => $data->perPage(),
            'current_page' => $data->currentPage(),
            'last_page' => $data->lastPage(),
            'numeber_of_new_data_on_page'=>$data->count(),
            'current_data_on_this_page' => min($data->total(), $data->perPage() * $data->currentPage()),

             // Add any additional meta information you need
        ];
        
        $links = [
            'prev' => $data->previousPageUrl(),
            'next' => $data->nextPageUrl(),
            // Add any additional links you need
        ];
        return response([
            'success' => true,
            'data' => $data->items(),
            'links' => $links,
            'meta' => $meta,
            'message' => $message,
        ], $status);
    }

    protected function successWithPaginationResource($message, $data = [], $status = Response::HTTP_OK)
    {
        // Access the paginator instance from the resource collection
        $paginator = $data->resource;

        // Retrieve meta and links information
        $meta = [
            'total' => $paginator->total(),
            'per_page' => $paginator->perPage(),
            'current_page' => $paginator->currentPage(),
            'last_page' => $paginator->lastPage(),
            // Add any additional meta information you need
        ];

        $links = [
            'prev' => $paginator->previousPageUrl(),
            'next' => $paginator->nextPageUrl(),
            // Add any additional links you need
        ];

        return response([
            'success' => true,
            'data' => $data,
            'links' => $links,
            'meta' => $meta,
            'message' => $message,
        ], $status);
    }

    protected function failure($message, $status = Response::HTTP_BAD_REQUEST)
    {
        return response([
            'success' => false,
            'message' => $message,
        ], $status);
    }

    protected function validationFailure($errors, $status = Response::HTTP_UNPROCESSABLE_ENTITY)
    {
        return response([
            'message' => "The given data was invalid.",
            "errors" => $errors
        ], $status);
    }
}
