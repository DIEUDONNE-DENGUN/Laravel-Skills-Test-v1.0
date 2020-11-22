
##Project Title

    Laravel Skills Test v1.0

##Introduction

    Create a very simple Laravel web application for task management: -Create task (info to save: task name, priority, timestamps) 
    -Edit task -Delete task -Reorder tasks with drag and drop in the browser. Priority should automatically be updated based on this. 
    #1 priority goes at top, #2 next down and so on. -Tasks should be saved to a mysql table.


##Getting Started


       This application highly makes use of the power of dependency injection of components at three level layers (service, repository and form request) into the service container
       
       These instructions will get you a copy of the project up and running on your local machine 
       for development and testing purposes. 
       See deployment for notes on how to deploy the project on an apache  system.
 ##Deployments
 
     1) git clone https://github.com/DIEUDONNE-DENGUN/Laravel-Skills-Test-v1.0
     2) move the cloned project into an apache web server or any web server of choice 
     3) Create an empty MYSQL database with name bridge_africa_ventures as indicated on the .env file (please take look of .env to set up database configuration on your server)
     4) Kindly open a terminal or command line tool and cd into the project directory
     4) run the following this command to run this database table migrations (products and users) : php artisan migrate
     5) Launched web run and access application from browser computer like : http://hostname:port/project_dir/public
   
 ##Built With
 
     Laravel framework
     User Interface based on bootstrap 4.5.2 (NB: used the cdn version, requires internet to load application views properly)
     Jquery jquery-3.5.1 (NB: used the cdn version, requires internet to load application views properly)
             
## Last Thought

Thank you for taking the time in testing the project. Would appreciate feedback

## License

The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Author

     Dieudonne Takougang
