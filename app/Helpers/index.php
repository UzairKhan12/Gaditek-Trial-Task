<?php

function sendErrorResponse($error, $errorMessages = [], $code = 400)
{
    $response = [
        'message' => $error,
    ];

    if (!empty($errorMessages)) {
        $response['data'] = $errorMessages;
    }

    return response()->json($response, $code);
}

function sendSuccessResponse($result, $message)
{
    $response = [
        'message' => $message,
        'data' => $result
    ];

    return response()->json($response, 200);
}

function sendPaginatedResponse($result, $message)
{
    $response['message'] = $message;

    $response['data'] = $result['data'];

    unset($result['data']);

    $response['page'] = $result;

    unset($response['page']['links']);

    $response['page']['totalDocs'] = $response['page']['total'];

    $response['page']['totalPages'] = $response['page']['last_page'];

    $response['page']['limit'] = $response['page']['per_page'];

    return response()->json($response, 200);
}
