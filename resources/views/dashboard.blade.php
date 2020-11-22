@extends('layout.master')

@section('content')
    <div class="card" style="margin-top:5px;padding-top:10px;margin-left: 2%;margin-right: 2%">
        <div class="card-body">

            <h5 class="card-title" style="text-align: center;font-weight: bold">
                Hi {{$user->name }}, <br/><br/>
                <span>Your are currently logged into your Coalition account</span>
            </h5>
            <hr style="border-width: 6px"/>
            <div class="row">
                <div class="col-md-10"></div>

                <div class="col-md-2">
                    <a href="{{url('logout')}}"
                       style="font-size: 14px; font-weight: bold;" class="card-link">
                        <button type="button" class="btn btn-danger btn" style="color:white">Logout
                        </button>
                    </a>
                </div>

            </div>
            <br/> <br/>
            <div class="card-text">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(session('message'))
                    <div class="alert alert-success">{!! session('message') !!}</div>
                @endif
                <div class="row">
                    <div class="col-md-6">
                        <div class="list-group">
                            <a class="list-group-item list-group-item-action active">
                                <h4>{{$user->name}}'s Account</h4>
                            </a>
                            <a href="{{url('add_project')}}" class="list-group-item list-group-item-action">Add
                                Project</a>
                            <a href="{{route('projects')}}" class="list-group-item list-group-item-action">View
                                Projects</a>

                            <a href="{{route('add_task')}}" class="list-group-item list-group-item-action">
                                Add Task</a>
                            <a href="{{route('tasks')}}" class="list-group-item list-group-item-action">View
                                Tasks</a>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item">Name: {{$user->name}}</li>
                                    <li class="list-group-item">Email: {{$user->email}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <br>
            </div>
        </div>
@stop