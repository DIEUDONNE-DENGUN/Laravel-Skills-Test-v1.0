<?php
/**
 * User: Dieudonne Takougang
 * Date: 22/11/202
 * Time: Implementation for project repository interface
 */

namespace App\Repositories;


use App\Project;
use App\Repositories\Interfaces\ProjectRepositoryInterface;


class ProjectRepository extends BaseRepository implements ProjectRepositoryInterface
{
    protected $projectModel;

    public function __construct(Project $model)
    {
        $this->projectModel = $model;
    }

    public function create(array $project)
    {
        return $this->projectModel->create($project);
    }

    public function findProjectById($project_id)
    {
        return $this->projectModel->find($project_id);
    }


    public function update(array $project, $project_id)
    {
        return $this->projectModel->find($project_id)->update($project);
    }

    public function delete($project_id)
    {
        return $this->projectModel->find($project_id)->delete();
    }

    public function getProjectTasks($project_id)
    {
        return $this->projectModel->find($project_id)->tasks;
    }
}