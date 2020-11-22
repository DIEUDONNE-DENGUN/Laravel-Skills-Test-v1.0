<?php
/**
 * Author:Dieudonne Takougang
 * Date: 22/11/2020
 * Description: User service implementation
 */

namespace App\Services;


use App\Repositories\Interfaces\TaskRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Support\Facades\Auth;

class UserService implements UserServiceInterface
{
    private $userRepository;
    private $taskRepository;

    public function __construct(UserRepositoryInterface $repository, TaskRepositoryInterface $taskRepository)
    {
        $this->userRepository = $repository;
        $this->taskRepository = $taskRepository;
    }

    public function saveUserAccount(array $user)
    {
        return $this->userRepository->create($user);
    }

    public function findUserByID($user_id)
    {
        return $this->userRepository->findUserById($user_id);
    }

    public function emailExist($email)
    {
        $emailExist = $this->userRepository->findUserByEmail($email);
        return $emailExist->isEmpty() ? false : true;
    }

    public function getUserProjects($user_id)
    {
        return collect($this->userRepository->getUserProjects($user_id));
    }

    public function isValidUsernamePassword($username, $password)
    {
        $credentials = ["email" => $username, "password" => $password];
        return Auth::attempt($credentials) ? true : false;
    }

    public function updateUserAccount(array $user, $user_id)
    {
        return $this->userRepository->update($user, $user_id);
    }

    public function getUserTasks($user_id)
    {
        $user_project_ids = collect($this->userRepository->getUserProjects($user_id))->pluck('id')->toArray();
        return $this->taskRepository->findTasksByProjectIds($user_project_ids);
    }
}