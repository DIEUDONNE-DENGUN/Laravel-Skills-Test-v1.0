<?php
/*
   @Author:Dieudonne Takougang
   @Date: 22/11/2020
   @Description: handle all user related actions
   *
   */

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Services\Interfaces\UtilityServiceInterface;
use App\Services\Interfaces\UserServiceInterface;


class UserController extends Controller
{
    private $userService;
    private $utilityService;

    public function __construct(UserServiceInterface $userService, UtilityServiceInterface $utilityService)
    {
        $this->userService = $userService;
        $this->utilityService = $utilityService;
    }

    public function showLoginPage()
    {
        //method level authentication
        if ($this->utilityService->hasSessionValue('isLoggedIn')) {
            return redirect('user/account');
        }
        return view('login');
    }

    //login user if username and password match
    public function login(LoginUserRequest $request)
    {
        $login_dto = $request->getLoginDto();
        //authenticate user
        if (!$this->userService->isValidUsernamePassword($login_dto->email, $login_dto->password)) {
            return redirect()->back()->withErrors(['Invalid username/password combination']);
        }
        //login user into the system
        $this->utilityService->addSessionData("isLoggedIn", true);
        return redirect("user/account");
    }

    public function showSignUpPage()
    {
        //method level authentication
        if ($this->utilityService->hasSessionValue('isLoggedIn')) {
            return redirect('user/account');
        }
        return view('sign_up');
    }

    //create a new user account
    public function signUp(CreateUserRequest $request)
    {
        $create_account_dto = $request->getUserDTO();
        //check email exist
        if ($this->userService->emailExist($create_account_dto['email'])) {
            return redirect()->back()->withErrors(['Sorry!, a user with this email already exist. Try again']);
        }
        //save user account details
        $user_account = $this->userService->saveUserAccount($create_account_dto);
        if ($user_account) {
            $request->session()->flash('message', 'User account created successfully!');
            return redirect("/login");
        } else {
            return redirect()->back()->withErrors(['Whoops!, an error was encountered!. Please refresh and try again']);
        }
    }

    public function showUserAccount()
    {
        //method level authentication
        if (!$this->utilityService->hasSessionValue('isLoggedIn')) {
            return redirect('login');
        }
        $data['user'] = $this->utilityService->getCurrentLoggedUser();;
        return view("dashboard")->with($data);
    }

    public function logout()
    {
        if (!$this->utilityService->hasSessionValue('isLoggedIn')) {
            return redirect('login');
        }
        //clear all session data
        $this->utilityService->clearSession();
        session()->flash('message', 'logout of account successfully!');
        return redirect('login');
    }
}
