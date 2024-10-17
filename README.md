# Api_Tasks_Security

### Api_Tasks_Security is a task management system that allows administrators to manage tasks, assign users to specific tasks, add dependencies between tasks, and manage file attachments. The system provides role-based access control, enabling administrators to create and manage users and assign tasks to them. Users can view and update the status of their assigned tasks.

### Features

#### Admin Features:

1. CRUD User: Administrators can Create, Read, Update, and Delete users in the system.
2. CRUD Task: Administrators can Create, Read, Update, and Delete tasks.
3. Assign Task to User: Administrators can assign specific tasks to users.
4. Task Dependencies: Administrators can link tasks, making one task a subtask (child) of another (parent).
5. Task Attachment: Administrators can attach files to tasks.
6. Task Filtering: Administrators can filter tasks based on various criteria (status, user...).

#### User Features:

1. View Assigned Tasks: Users can view all tasks assigned to them.
2. Update Task Status: Users can update the status of their assigned tasks.

## Requirments

-   PHP Version 8.3 or earlier
-   Laravel Version 11 or earlier
-   composer
-   XAMPP: Local development environment (or a similar solution)

## API Endpoints

1. ### Authentication

    - POST /api/login: Log in with email and password
    - POST /api/logout: Log out the current user
    - GET /api/me: display info currently user

2. ### CrudUser

    - POST /api/CrudUser : Create user by (Admin only)
    - PUT /api/CrudUser/{user_id} : Update user by id (Admin only)
    - GET /api/CrudUser : Get All User (Admin only)
    - GET /api/CrudUser/{user_id} : GET user by ID (Admin only)
    - DELETE /api/CrudUser{user_id} : soft DELETE user by id (Admin only)
    - POST /api/AssignRoleToUser/{user_id} : Assign Role To User
    - POST /api/DeleteRoleFromUser/{user_id} : Delete Role From User

3. ### CrudTask

    - POST /api/CrudTask : Create task by (Admin only) and filter all tasks
    - PUT /api/CrudTask/{task_id} : Update task by id (Admin only)
    - GET /api/CrudTask : Get All task (Admin only)
    - GET /api/CrudTask/{task_id} : GET task by ID (Admin only)
    - DELETE /api/CrudTask{task_id} : soft DELETE task by id (Admin only)
    - POST /api/Task/AddDependency/{task_id} : Add Sub Task To Parent Task
    - POST /api/Task/{id}/Restore : Restore Soft Deleted Task
    - POST /api/Task/{id}/assign : Assign Task To User
    - POST /api/Task/{id}/attachments : Add Attachment to Task
    - PUT /api/Task/{id}/reassign : change user Assigned to task
    - GET /api/Task/All_Soft_deleted_Tasks : Get All Soft Deleted Task

4. ### Comment
    - GET /api/comment : get all comment
    - POST /api/Task/{id}/Comments : add comment to task
5.  - PUT /api/Task/{task_id}/status : change status task to new status
6.  - GET /api/reports/daily-tasks : generate daily Reports

## Postman Collection:

You can access the Postman collection for this project by following this [link](https://documenter.getpostman.com/view/37833857/2sAXxV7WTm). The collection includes all the necessary API requests for testing the application.
