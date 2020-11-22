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
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header text-center"> Add a new task.</div>
                            <div class="card-body">
                                <form class="form-inline text-center" method="POST"
                                      action="{{url('add_task')}}"
                                      style="text-align: center; margin-left: 5%; margin-right:5%">
                                    {{ csrf_field() }}
                                    <div>

                                        <div class="alert alert-info" style="font-size:16px;font-weight: bold">
                                            Enter task details to save
                                        </div>
                                        <hr>
                                        <div class="row alert">
                                            <div class="col-md-4" style="font-weight:bolder;font-size:16px">
                                                Select Project to assign task to
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group mb-2 mr-sm-2 form-group">
                                                    <select class="form-control"  name="project_id">
                                                        @foreach($projects as $project)
                                                            <option value="{{$project->id}}">{{$project->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2"></div>
                                        </div>

                                        <div class="row alert">
                                            <div class="col-md-4" style="font-weight:bolder;font-size:16px">
                                                Task
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group mb-2 mr-sm-2">
                                                    <input type="text" class="form-control" name="name"
                                                           id="name"
                                                           placeholder="Name of task">
                                                </div>
                                            </div>
                                            <div class="col-md-2"></div>
                                        </div>
                                        <div class="row alert">
                                            <div class="col-md-4" style="font-weight:bolder;font-size:16px">
                                                Task Priority
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group mb-2 mr-sm-2">
                                                    <input type="number" class="form-control" name="priority"
                                                           id="priority"
                                                           placeholder="Priority of Task in Number">
                                                </div>
                                            </div>
                                            <div class="col-md-2"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3"></div>
                                            <div class="col-md-6">
                                                <button type="submit" class="btn btn-primary btn-sm">Save Task
                                                </button>
                                            </div>
                                            <div class="col-md-3"></div>
                                        </div>
                                    </div>
                                </form>
                                <br/>
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-7">
                                        <a href="{{route('dashboard')}}"
                                           style="font-size: 14px; font-weight: bold;" class="card-link">
                                            <button type="button" class="btn btn-sm"
                                                    style="background:#2196f3;color:white">Return
                                            </button>
                                        </a>
                                    </div>
                                    <div class="col-md-3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                <br>
                <br>
            </div>
        </div>
@stop