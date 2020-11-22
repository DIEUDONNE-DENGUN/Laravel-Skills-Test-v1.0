@extends('layout.master')

@section('content')
    <div class="card" style="margin-top:5px;padding-top:10px;margin-left: 2%;margin-right: 2%">
        <div class="card-body">

            <h5 class="card-title" style="text-align: center;font-weight: bold">
                Hi {{$user->name }}, <br/><br/>
                <span>Your are currently logged into Coalition account</span>
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
                    <div class="col-md-3">
                        <div class="list-group">
                            <a class="list-group-item list-group-item-action">
                                <h4>{{$user->name}}'s Account</h4>
                            </a>
                            <a href="{{url('add_project')}}" class="list-group-item list-group-item-action">Add
                                Project</a>
                            <a href="{{route('projects')}}" class="list-group-item list-group-item-action">View
                                Projects</a>

                            <a href="{{route('add_task')}}" class="list-group-item list-group-item-action">
                                Add Task</a>
                            <a href="{{route('tasks')}}" class="list-group-item list-group-item-action active">View
                                Tasks</a>

                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-9">
                                <form class=" text-center" method="GET"
                                      action="{{route('sort_task_project')}}"
                                      style="text-align: center; margin-left: 5%; margin-right:5%">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="project"> View tasks by projects</label>
                                        <select class="form-control" name="project" id="project">
                                            @foreach($projects as $project)
                                                <option value="{{$project->id}}">{{$project->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                            </div>
                            <div class="col-md-3">
                                <br/>
                                <button type="submit" class="btn btn-primary">View Tasks
                                </button>
                            </div>
                            </form>
                        </div>
                        <br/>
                        @foreach ($tasks->chunk(3) as $chunk)
                            <div class="row">
                                @foreach ($chunk as $task)
                                    <div class="col-xs-4 col-md-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Name: {{ $task->name }}</h5>
                                                <p class="card-text">Priority: {{ $task->priority}}</p>
                                                <p class="card-text">Project: {{ $task->project->name}}</p>
                                                <a href="{{url('edit_task/'.$task->id)}}" class="btn btn-info">Edit</a>
                                                <a href="{{url('delete_task/'.$task->id)}}"
                                                   class="btn btn-danger">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach

                    </div>
                </div>
                <br>
                <br>
            </div>
        </div>
@stop