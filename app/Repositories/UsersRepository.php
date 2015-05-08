<?php
/**
 * Created by PhpStorm.
 * Author: Elena Kolevska
 * Date: 4/15/15
 * Time: 13:34
 */

namespace App\Repositories;


class UsersRepository extends BaseRepository{

    public function grabLatest($results){
        return $this->model->with('courses')->orderBy('id', 'desc')->limit($results)->get();
    }
}