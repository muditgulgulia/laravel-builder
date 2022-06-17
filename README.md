# Laravel Builder
Below are the feature of laravel new project with user role and permissions system.

### General
<pre>
1.Login
2.Register
3.Forgot-password
4.Reset
5.Change user password from admin
</pre>
### Users
<pre>
1.Show all user list
2.Delete user
3.Edit user
4.Add user
5.Search user
6.Add multiple role to user
7.Operations for user grid (dynamic): copy / csv / excel / pdf / print
</pre>
### Roles
<pre>
1.Show all roles
2.Edit role
3.Search role
4.Add role
5.Add multiple competence to role
6.Disabled role delete
</pre>

### Permissions
<pre>
1.Show all permission
2.Edit permission
3.Search permission
4.Add permission
5.Delete permission
</pre>
------------------------------------------------------------------------------------------

### Coding
<pre>
Create different layouts for each section (admin / frontend / default)
Create different sections for helpers (admin / frontend / default)
Dynamic coding for delete / datatable / operations on grid / blads/
Reuse blads for create / edit for each module
Use cascades for tables permission / role / role_user / permission_role
Dynamic project name from .env settings
Use resources for router file.
Each action of each module check via role and permissions
There is some seeder for PermissionRoles, Permissions, Roles, RoleUsers, Users.
There is a blank folder in admin view for new module.
</pre>

Note : Create pages from admin side and show in frontend.

##### Pending work will take at-least one day
<pre>
Feature for next phase
1. Create left menu from admin
2. Create front-end pages from admin
3. Create complete module from admin (controller / routers / migrations / models etc)
4. Manage front-end menu from admin

------------------------------------------------------------------------------------------

Getting Started

1. git clone this repository and cd inside the project root, then enter the following commands

2. On the command prompt run the following commands
    cd directory
    composer install --prefer-dist -vvv (might take a while to complete)
    cp .env.example .env
	set database connection in .env file
    php artisan key:generate
	php artisan migrate:refresh --seed
    php artisan serve
    Open the browser and go to http://localhost:8000

------------------------------------------------------------------------------------------

Create new module.

1. Create Migration and Model you should use command :- php artisan make:model Model/ModelName -m (Here -m is for create migration for model with same name and proper extention).
2. Create Controller you should use command :- php artisan make:controller Admin/ControllerName --resource (Here Admin mean controller create for admin else you set Frontend and --resource mean create all functions schema by default).
3. Now its time to create routes in web.php file instead of create separate route for each model you should use resourse like :- Route::resource('route/name', 'ControllerName');
4. Now you should can copy blank view folder with your module folder and set all data as per your requirements.
5. Create permission for all routes.
</pre>
