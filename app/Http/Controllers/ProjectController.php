<?php

namespace App\Http\Controllers;

/*
 * @Author:Dieudonne Takougang
 * @Date:22/11/2020
 */

use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Services\Interfaces\ProjectServiceInterface;
use App\Services\Interfaces\UtilityServiceInterface;
use App\Services\Interfaces\UserServiceInterface;

class ProjectController extends Controller
{
    private $projectService;
    private $utilityService;

    public function __construct(ProjectServiceInterface $projectService, UtilityServiceInterface $utilityService)
    {
        $this->projectService = $projectService;
        $this->utilityService = $utilityService;
    }

    public function showAddProjectPage()
    {
        if (!$this->utilityService->hasSessionValue('isLoggedIn')) {
            return redirect('login');
        }
        $data['user'] = $this->utilityService->getCurrentLoggedUser();
        return view('add_project_form')->with($data);
    }

    public function addProject(CreateProjectRequest $request)
    {
        if (!$this->utilityService->hasSessionValue('isLoggedIn')) {
            return redirect('login');
        }
        $add_project_dto = $request->getProjectDto();
        $add_project_dto["user_id"] = $this->utilityService->getCurrentLoggedUser()->id;
        //save project
        $project = $this->projectService->saveProject($add_project_dto);
        if ($project) {
            $request->session()->flash('message', 'Project added successfully!');
            return redirect()->route('projects');;
        } else {
            return redirect()->back()->withErrors(['Unable to save project details.']);
        }
    }

    public function showEditProjectPage($project_id)
    {
        if (!$this->utilityService->hasSessionValue('isLoggedIn')) {
            return redirect('login');
        }
        $project = $this->projectService->findProjectById($project_id);
        if (!$project) {
            return redirect()->back()->withErrors(['Whoops!, project with this id does not exist']);
        }
        $data['project'] = $project;
        $data['user'] = $this->utilityService->getCurrentLoggedUser();
        return view('edit_project_form')->with($data);
    }

    public function updateProject(UpdateProjectRequest $request, $project_id)
    {
        $update_project_dto = $request->getProjectDto();
        //update project
        $task = $this->projectService->updateProject($update_project_dto, $project_id);
        if ($task) {
            $request->session()->flash('message', 'Project updated successfully!');
            return redirect()->route('projects');
        }
    }

    public function showUserProjects(UserServiceInterface $userService)
    {
        if (!$this->utilityService->hasSessionValue('isLoggedIn')) {
            return redirect('login');
        }
        $projects = $userService->getUserProjects($this->utilityService->getCurrentLoggedUser()->id);
        $data['projects'] = $projects;
        $data['user'] = $this->utilityService->getCurrentLoggedUser();
        return view("projects")->with($data);
    }

    public function deleteProject($project_id)
    {
        if (!$this->utilityService->hasSessionValue('isLoggedIn')) {
            return redirect('login');
        }
        $product = $this->projectService->findProjectById($project_id);
        if (!$product) {
            return redirect()->back()->withErrors(['Whoops!, Project with this id does not exist']);
        }

        //check if user has any products
        $project_has_tasks = $this->projectService->getProjectTasks($project_id);
        if (!$project_has_tasks->isEmpty()) {
            return redirect()->back()->withErrors(['Sorry! cannot drop project. Please consider deleting your tasks to delete project']);
        }
        //delete project
        $this->projectService->deleteProject($project_id);
        session()->flash('message', 'Project deleted successfully');
        return redirect()->route('projects');
    }
}
