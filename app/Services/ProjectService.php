<?php
/**
 * Author: Dieudonne Takougang
 * Date: 22/11/2020
 * @Description:manage
 */

namespace App\Services;


use App\Repositories\Interfaces\ProjectRepositoryInterface;
use App\Services\Interfaces\ProjectServiceInterface;

class ProjectService implements ProjectServiceInterface
{
    private $projectRepository;

    public function __construct(ProjectRepositoryInterface $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }

    public function saveProject(array $project)
    {
        return $this->projectRepository->create($project);
    }

    public function findProjectById($project)
    {
        return $this->projectRepository->findProjectById($project);
    }

    public function updateProject(array $project, $project_id)
    {
        return $this->projectRepository->update($project, $project_id);
    }

    public function deleteProject($project_id)
    {
        return $this->projectRepository->delete($project_id);
    }

    public function getProjectTasks($project_id)
    {
        return collect($this->projectRepository->getProjectTasks($project_id));
    }
}