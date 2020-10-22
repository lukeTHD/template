<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

abstract class RepositoriesAbstract implements RepositoryInterface
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * EloquentRepository constructor.
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * {@inheritdoc}
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * {@inheritdoc}
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getTable()
    {
        return $this->model->getTable();
    }

    /**
     * Get All
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all()
    {

        return $this->model->all();
    }

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        $result = $this->model->find($id);

        return $result;
    }

    /**
     * Get one or fail
     * @param $id
     * @return mixed
     */
    public function findOrFail($id)
    {
        $result = $this->model->findOrFail($id);

        return $result;
    }

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        DB::beginTransaction();
        try {
            $instance = $this->model->create($attributes);
            DB::commit();
            return $instance;
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return bool|mixed
     */
    public function update($id, array $attributes)
    {
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }

        return false;
    }

    /**
     * Delete
     *
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $result = $this->find($id);
        if ($result) {
            $result->delete();

            return true;
        }

        return false;
    }

    public function query()
    {
        return $this->model->query();
    }
}
