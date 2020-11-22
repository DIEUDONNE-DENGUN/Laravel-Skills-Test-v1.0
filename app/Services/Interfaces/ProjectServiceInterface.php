<?php
/**
 * Author: Dieudonne Takougang
 * Date: 22/11/2020
 * Description: handle all business logic related to user tasks
 */

namespace App\Services\Interfaces;


interface ProjectServiceInterface
{
    public function saveProject(array $project);

    public function findProjectById($project);

    public function updateProject(array $project, $project_id);

    public function deleteProject($project_id);

    public function getProjectTasks($project_id);
}