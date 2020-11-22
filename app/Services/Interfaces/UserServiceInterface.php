<?php
/**
 * Author: Dieudonne Takougang
 * Date: 22/12/2020
 * @Description: Handle all user business logic exposed as an interface
 */

namespace App\Services\Interfaces;


interface UserServiceInterface
{
    public function saveUserAccount(array $user);

    public function findUserByID($user_id);

    public function emailExist($email);

    public function getUserProjects($user_id);

    public function getUserTasks($user_id);

    public function isValidUsernamePassword($username, $password);

    public function updateUserAccount(array $user, $user_id);

}