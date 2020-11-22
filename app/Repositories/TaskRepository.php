<?php
/**
 * User: Dieudonne Takougang
 * Date: 22/11/202
 * Time: Implementation for tasks repository interface
 */

namespace App\Repositories;


use App\Repositories\Interfaces\TaskRepositoryInterface;
use App\Task;


class TaskRepository extends BaseRepository implements TaskRepositoryInterface
{
    protected $taskModel;

    public function __construct(Task $model)
    {
        $this->taskModel = $model;
    }

    public function create(array $task)
    {
        return $this->taskModel->create($task);
    }

    public function findTaskById($task_id)
    {
        return $this->taskModel->find($task_id);
    }


    public function update(array $task, $task_id)
    {
        return $this->taskModel->find($task_id)->update($task);
    }

    public function delete($task_id)
    {
        return $this->taskModel->find($task_id)->delete();
    }

    public function findTasksByProjectIds(array $project_ids)
    {
        return $this->taskModel->whereIn('project_id', $project_ids)->get();
    }
}