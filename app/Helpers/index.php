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
