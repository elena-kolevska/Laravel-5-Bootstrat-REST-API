<?php
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Auth\Guard;
use App\User;

class ApiController extends  Controller{

    public $response;
    public $request;
    public $auth;

    public function __construct(ResponseFactory $response, Request $request, Guard $auth, User $user)
    {
        $this->response = $response;
        $this->request = $request;
        $this->auth = $auth;
        $this->currentUser = $this->auth->user();
    }

    /**
     * @param array $data
     * @param string $response_message
     * @param int $status_code
     * @return Response
     */
    public function respond($data, $response_message, $status_code = 200) {
        //If this is an internal request we only return the data
        if ($this->request->input('no-json'))
            return $data;

        $message['status'] = true;

        if (isset($data))
            $message['data'] = $data;

        if (isset($message))
            $message['message'] = $response_message;

        if (isset($error_code))
            $message['error_code'] = $error_code;

        return $this->response->json($message, $status_code);
    }

    /**
     * @param mixed $errors This method can receive a string error message or an array of multiple messages
     * @param int $error_code
     * @param int $status_code
     * @return Response
     */
    public function respondWithError($errors, $error_code, $status_code = 400) {
        if (is_string($errors))
            $errors = [$errors];

        $message = [
            'status' => false,
            'errors' => $errors,
            'error_code' => $error_code
        ];

        return $this->response->json($message, $status_code);
    }
    /**
     * @param array $errors
     * @param int $status_code
     * @return Response
     */
    public function respondWithValidationErrors($errors, $status_code = 400) {
        $message = [
            'status' => false,
            'message' => "Please double check your form",
            'validation_errors' => [$errors]
        ];

        return $this->response->json($message, $status_code);
    }


    /*
     * Custom responses
     */

    /**
     * @param string $message
     * @return Response
     */
    public function respondCreated( $message = 'Resource created') {
        return $this->respond($message, 201);
    }

    /**
     * @param int $error_code
     * @param string $message
     * @return Response
     */
    public function respondUnauthorized( $error_code, $message = 'You are not authorized for this') {
        return $this->respondWithError($message, $error_code, 401);
    }

    /**
     * @param int $error_code
     * @param string $message
     * @return Response
     */
    public function respondNotFound( $error_code, $message = 'Resource not found') {
        return $this->respondWithError($message, $error_code, 404);
    }

    /**
     * @param int $error_code
     * @param string $message
     * @return Response
     */
    public function respondInternalError( $error_code, $message = 'Internal error') {
        return $this->respondWithError($message, $error_code, 500);
    }

    /**
     * @param string $message
     * @return Response
     */
    public function respondOk( $message = 'Done') {
        return $this->respond(null, $message, 200);
    }
}