<?php

namespace App\Http\Controllers;

/*
 * @Author:Dieudonne Takougang
 * @Date:22/11/2020
 */

use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Services\Interfaces\TaskServiceInterface;
use App\Services\Interfaces\UtilityServiceInterface;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private $taskService;
    private $utilityService;

    public function __construct(TaskServiceInterface $taskService, UtilityServiceInterface $utilityService)
    {
        $this->taskService = $taskService;
        $this->utilityService = $utilityService;
    }

    public function showAddTaskPage(UserServiceInterface $userService)
    {
        if (!$this->utilityService->hasSessionValue('isLoggedIn')) {
            return redirect('login');
        }
        //check if user has created a project before
        $projects = $userService->getUserProjects($this->utilityService->getCurrentLoggedUser()->id);
        if ($projects->isEmpty()) {
            return redirect('add_project')->withErrors(['Currently no project created! Please create a project to continue']);
        }
        $data['user'] = $this->utilityService->getCurrentLoggedUser();
        $data['projects'] = $projects;
        return view('add_task_form')->with($data);
    }

    public function addTask(CreateTaskRequest $request)
    {
        if (!$this->utilityService->hasSessionValue('isLoggedIn')) {
            return redirect('login');
        }
        $add_task_dto = $request->getTaskDto();
        //save task
        $task = $this->taskService->saveTask($add_task_dto);
        if ($task) {
            $request->session()->flash('message', 'Task added successfully!');
            return redirect()->route('tasks');;
        } else {
            return redirect()->back()->withErrors(['Unable to save task details.']);
        }
    }

    public function showEditTaskPage($task_id, UserServiceInterface $userService)
    {
        if (!$this->utilityService->hasSessionValue('isLoggedIn')) {
            return redirect('login');
        }
        $task = $this->taskService->findTaskById($task_id);
        if (!$task) {
            return redirect()->back()->withErrors(['Whoops!, task with this id does not exist']);
        }
        $data['task'] = $task;
        $projects = $userService->getUserProjects($this->utilityService->getCurrentLoggedUser()->id);
        $data['user'] = $this->utilityService->getCurrentLoggedUser();
        $data['projects'] = $projects;
        return view('edit_task_form')->with($data);
    }

    public function updateTask(UpdateTaskRequest $request, $task_id)
    {
        $update_task_dto = $request->getTaskDto();
        //update task
        $task = $this->taskService->updateTask($update_task_dto, $task_id);
        if ($task) {
            $request->session()->flash('message', 'Task updated successfully!');
            return redirect()->route('tasks');
        }
    }


    public function showUserTasks(UserServiceInterface $userService)
    {
        if (!$this->utilityService->hasSessionValue('isLoggedIn')) {
            return redirect('login');
        }
        $tasks = collect($userService->getUserTasks($this->utilityService->getCurrentLoggedUser()->id))->sortByDesc('priority');
        $projects = $userService->getUserProjects($this->utilityService->getCurrentLoggedUser()->id);
        $data['projects'] = $projects;
        $data['tasks'] = $tasks;
        $data['user'] = $this->utilityService->getCurrentLoggedUser();
        return view("tasks")->with($data);
    }

    public function showProjectTask(Request $request, UserServiceInterface $userService)
    {
        if (!$this->utilityService->hasSessionValue('isLoggedIn')) {
            return redirect('login');
        }
        $project_id = $request->get('project');
        $tasks = collect($this->taskService->findTasksByProjectId([$project_id]))->sortByDesc('priority');
        $data['tasks'] = $tasks;
        $data['user'] = $this->utilityService->getCurrentLoggedUser();
        $projects = $userService->getUserProjects($this->utilityService->getCurrentLoggedUser()->id);
        $data['projects'] = $projects;
        return view("tasks")->with($data);
    }

    public function deleteTask($task_id)
    {
        if (!$this->utilityService->hasSessionValue('isLoggedIn')) {
            return redirect('login');
        }
        $task = $this->taskService->findTaskById($task_id);
        if (!$task) {
            return redirect()->back()->withErrors(['Whoops!, Task with this id does not exist']);
        }
        //delete task
        $this->taskService->deleteTask($task_id);
        session()->flash('message', 'Task deleted successfully');
        return redirect()->route('tasks');
    }
}
