<?php namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler {

	/**
	 * A list of the exception types that should not be reported.
	 *
	 * @var array
	 */
	protected $dontReport = [
		'Symfony\Component\HttpKernel\Exception\HttpException'
	];

	/**
	 * Report or log an exception.
	 *
	 * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
	 *
	 * @param  \Exception  $e
	 * @return void
	 */
	public function report(Exception $e)
	{
		return parent::report($e);
	}

	/**
	 * Render an exception into an HTTP response.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Exception  $e
	 * @return \Illuminate\Http\Response
	 */
	public function render($request, Exception $e)
	{
		if ($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException){
			$message = [
				'status' => false,
				'error_code' => 2234,
				'errors' => ["That resource doesn't exist"]
			];
			return response($message, 404);
		}

		if ($e instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException){
			$message = [
				'status' => false,
				'error_code' => 1235,
				'errors' => ["We don't have that kind of resources"]
			];
			return response($message, 404);
		}

		if ($e instanceof \Exception){
			$message = [
				'status' => false,
				'message' => $e->getMessage()
			];
			return response($message, 500);
		}

		return parent::render($request, $e);
	}

}
