<?php
/**
 * User: Dieudonne Takougang
 * Date: 22/11/2020
 * @Description: handle all user project related database operations
 */

namespace App\Repositories\Interfaces;


interface ProjectRepositoryInterface
{
    public function create(array $project);

    public function findProjectById($project_id);

    public function update(array $project, $project_id);

    public function delete($project_id);

    public function getProjectTasks($project_id);
}