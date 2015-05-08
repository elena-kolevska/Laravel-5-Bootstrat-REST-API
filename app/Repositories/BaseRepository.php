<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository {
    public function __construct(Model $model) {
        $this->model = $model;
    }

    /**
     * @param $data
     * @return static
     */
    public function create($data)
    {
        return $this->model->create($data);
    }

    /**
     * @param $record
     * @param $data
     * @return mixed
     */
    public function update($record, $data)
    {
        if (is_int($record)){
            $this->model->find($record);
            $id = $record;
        } else {
            $this->model = $record;
            $id = $record->id;
        }
        return $this->model->where('id',$id)->update($data);
    }

    /**
     * @param $id
     * @return boolean
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * @param $id
     * @return \Illuminate\Support\Collection
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }


    /**
     * We can receive a single id, or an array of ids
     * Based on the input we return a collection or an object
     *
     *
     * @param int $id
     * @param int $user_id
     * @param int $with
     * @return mixed
     */
    public function getById($id, $user_id = null, $with = null)
    {
        if (is_array($id)){
            $result = $this->model->whereIn('id', $id);
        }else{
            $result = $this->model->where('id', $id);
        }

        if ($user_id)
            $result->where('user_id',$user_id);

        if ($with)
            $result->with($with);

        if (is_array($id)){
            return $result->get();
        }else{
            return $result->firstOrFail();
        }
    }

}