<?php
namespace App\DataTransformers;

class UserTransformer extends DataTransformer{

    public function transform($user)
    {
        return [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'courses' => (isset($user['courses']) && count($user['courses']))
                ? array_map([$this,'transformCourses'], $user['courses'])
                : [],
        ];
    }

    public function transformCourses($course){
        return [
          'id' =>  $course['id'],
          'name' =>  $course['name']
        ];
    }
}