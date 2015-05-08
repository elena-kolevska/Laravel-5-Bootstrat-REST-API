<?php

namespace App\Http;


class InternalDispatcher {

    public function release( $url, $method = 'GET', $input, $no_json) {
        // Store the original input of the request
        $originalInput = \Request::input();

        // Create request to the API, adding the no-json parameter, since it's an internal request
        $request = \Request::create($url, $method);
        // Replace the input with the request instance input
        \Request::replace($input);

        // Fetch the response
        if ($no_json){
            $content = \Route::dispatch($request)->getContent();
            $result = json_decode($content, 1);
        }else{
            $result = \Route::dispatch($request)->getContent();
        }

        // Replace the input again with the original request input.
        \Request::replace($originalInput);

        return $result;
    }

    public function withInput($url, $input, $method = 'GET', $no_json = true){
        $input = array_merge($input, ['no-json'=>$no_json]);
        return $this->release($url, $method, $input, $no_json = true);
    }

    //This hasn't been tested
    public function withOriginalInput($url, $method = 'GET', $no_json = true){
        $input = array_merge(\Request::input(), ['no-json'=>$no_json]);
        return $this->release($url, $method = 'GET', $input, $no_json = true);
    }

    public function withNoInput($url, $method = 'GET', $no_json = true){
        $input = ['no-json'=>$no_json];
        return $this->release($url, $method = 'GET', $input, $no_json = true);
    }
}