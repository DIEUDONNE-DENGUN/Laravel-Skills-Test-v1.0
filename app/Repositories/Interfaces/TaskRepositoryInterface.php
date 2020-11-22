<?php
/**
 * User: Dieudonne Takougang
 * Date: 22/11/2020
 * @Description: handle all user tasks related database operations
 */

namespace App\Repositories\Interfaces;


interface TaskRepositoryInterface
{
    public function create(array $task);

    public function findTaskById($task_id);

    public function update(array $task, $task_id);

    public function delete($task_id);

    public function findTasksByProjectIds(array $project_ids);

}