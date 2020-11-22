<?php
/**
 * Author: Dieudonne Takougang
 * Date: 22/11/2020
 * @Description:manage tasks storage in DB
 */

namespace App\Services;


use App\Repositories\Interfaces\TaskRepositoryInterface;
use App\Services\Interfaces\TaskServiceInterface;

class TaskService implements TaskServiceInterface
{
    private $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function saveTask(array $task)
    {
        return $this->taskRepository->create($task);
    }

    public function findTaskById($task)
    {
        return $this->taskRepository->findTaskById($task);
    }

    public function updateTask(array $task, $task_id)
    {
        return $this->taskRepository->update($task, $task_id);
    }

    public function deleteTask($task_id)
    {
        return $this->taskRepository->delete($task_id);
    }

    public function findTasksByProjectId($project_id)
    {
        return $this->taskRepository->findTasksByProjectIds($project_id);
    }
}