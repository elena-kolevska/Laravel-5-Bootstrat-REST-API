<?php namespace App\Http\Controllers;

class ExamplesController extends ApiController {

	public function __call($name, $arguments)
	{
		// Note: value of $name is case sensitive.
		echo "Calling object method '$name' "
			. implode(', ', $arguments). "\n";
	}

	/**
	 * Send back response with data
	 *
	 * @return Response
	 */
	public function example1()
	{
		$sample_data_array = ['k1'=>'value1', 'k2'=>'value2'];
		return $this->respond($sample_data_array, 'Message');
	}

	/**
	 * Send back response without data
	 *
	 * @return Response
	 */
	public function example2()
	{
		return $this->respondOk('I should try an online message generator');
	}

	/**
	 * Generic error message
	 *
	 * @return Response
	 */
	public function example3()
	{
		$error = "Can't be done";
//		$error=['e1'=>"Can't be done", 'e2'=>'Stop trying'];

		return $this->respondWithError($error, 123, 500);
	}

	/**
	 *  500 "Internal server error" response
	 *
	 * @return Response
	 */
	public function example4()
	{
		return $this->respondInternalError(332, 'We messed up. Now go back to the slides.');
	}

	/**
	 *  Response with data
	 *
	 * @return Response
	 */
	public function example5()
	{
		$data = \App::make('\App\Repositories\Contracts\UsersInterface')->getById(3,null,['courses']);
		return $this->respond($data,"User with the id of 3");
	}

	/**
	 *  Response with data
	 *
	 * @return Response
	 */
	public function example6()
	{
		$data = \App::make('\App\Repositories\Contracts\UsersInterface')->grabLatest(5);
		return $this->respond($data,"latest 5 users");
	}

	/**
	 *  Response with data
	 *
	 * @return Response
	 */
	public function example7()
	{
		$users = \App::make('\App\Repositories\Contracts\UsersInterface')->grabLatest(3);

		$data =\App::make('App\DataTransformers\UserTransformer')->transformCollection( $users->toArray() );
		return $this->respond($data,"Latest 3 users");
	}


	/**
	 *  Response with data
	 *
	 * @return Response
	 */
	public function example8()
	{
		$users = \App::make('\App\Repositories\Contracts\UsersInterface')->getById(3,null,['courses']);
		$data =\App::make('App\DataTransformers\UserTransformer')->transform( $users->toArray() );
		return $this->respond($data,"Good data");
	}

	/**
	 *  Response with data
	 *
	 * @return Response
	 */
	public function example9()
	{
		$internalDispatcher = \App::make('\App\Http\InternalDispatcher');
		$data['latest_users'] = $internalDispatcher->withNoInput('/api/v1/examples/latest_users');
		$data['youngest_user'] = $internalDispatcher->withNoInput('/api/v1/examples/youngest_user');  //Not really querying by age in this example, for simplicity's sake, but it is returning only one object

		return $this->respond($data,"Good data");
	}



}
