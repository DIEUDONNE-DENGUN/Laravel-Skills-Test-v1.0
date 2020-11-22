<?php
/**
 * Author: Dieudonne Takougang
 * Date: 22/11/2020
 * Description: handle all business logic related to user tasks
 */

namespace App\Services\Interfaces;


interface TaskServiceInterface
{
    public function saveTask(array $task);

    public function findTaskById($task);

    public function updateTask(array $task, $task_id);

    public function deleteTask($task_id);

    public function findTasksByProjectId($project_id);

}