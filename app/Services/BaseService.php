<?php

namespace App\Services;

abstract class BaseService
{
    protected $entity;
    protected $rules = [];
    protected $rulesUpdate = null;



    public function getRulesCreate()
    {
        return $this->rules;
    }

    public function getRulesUpdate($id = null)
    {
        return is_null($this->rulesUpdate) ? $this->rules : $this->rulesUpdate;
    }

    public function getEntity()
    {
        return $this->entity;
    }

    public function find($id, $with = [])
    {
        $entity = $this->entity;

        if ($with) {
            return $entity::with($with)->find(intval($id));
        } else {
            return $entity::find(intval($id));
        }
    }

    public function findBy($key, $id, $with = [])
    {
        $entity = $this->entity;

        if ($with) {
            return $entity::with($with)->get(intval($id));
        } else {
            return $entity::where($key, intval($id))->get();
        }
    }

    public function where($column, $value)
    {
        $entity = $this->entity;
        return $entity::where($column, $value)->get();
    }

    public function getByIds($ids)
    {
        $entity = $this->entity;
        return $entity::whereIn((new $entity)->getKeyName(), $ids)->get();
    }


    public function all()
    {
        $entity = $this->entity;
        return $entity::all();
    }

    public function listItems($with = [])
    {
        $entity = $this->entity;

        if ($with) {
            return $entity::with($with)->get();
        }

        return $entity::all();
    }

    public function first()
    {
        $entity = $this->entity;
        return $entity::first();
    }

    public function delete($id)
    {
        $entity = $this->entity;
        return $entity::destroy($id);
    }

    public function storeData($data)
    {
        $entity = $this->entity;
        $obj    = new $entity;

        $obj->fill($data);
        $result = $obj->save();

        if ($result) {
            return $obj;
        }

        return null;
    }

    public function updateData($key, $id, $data, $validate = false) {
        $entity = $this->entity;

        if($validate) {
            // TODO: Criar validator
        }

        $result = $entity::where($key, $id)->update($data);

        if ($result) {
            return $result;
        }
        return false;
    }

    public function getAll()
    {
        return $this->entity::all();
    }
}
