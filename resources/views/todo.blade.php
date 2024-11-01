<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="style.css">
    <title>To Do app</title>
</head>
<body>
<style>

    /* Basic Reset */
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: Arial, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color: #f5f5f5;
    }

    .task-list {
        width: 100%;
        max-width: 1000px;
    }

    .task-item {
        background-color: #f8f9fa;
        border: 1px solid #ddd;
        padding: 15px;
        margin-bottom: 10px;
        position: relative;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .task-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .task-header h5 {
        margin: 0;
        font-size: 1rem;
        color: #007bff;
    }

    .task-actions {
        display: flex;
        gap: 10px;
    }

    /* Button and link styling */
    .btn {
        padding: 5px 10px;
        font-size: 0.875rem;
        border: none;
        border-radius: 3px;
        cursor: pointer;
        color: #fff;
        text-decoration: none;
        display: inline-block;
    }

    .btn a {
        color: #fff; /* Ensures link text is white */
        text-decoration: none; /* Removes underline */
        display: block; /* Makes link fill the button */
    }

    .btn-primary {
        background-color: #28a745;
    }

    .btn-info {
        background-color: #17a2b8;
    }

    .btn-danger {
        background-color: #dc3545;
    }

    /* Description styling */
    .task-description {
        max-height: 0;
        overflow: hidden;
        color: #6c757d;
        transition: max-height 1s ease;
    }

    .task-item:hover .task-description {
        max-height: 100px;
    }

    /* Completed task styling */
    .done {
        background-color: #d4edda;
        border-color: #c3e6cb;
        color: #155724;
        text-decoration: line-through;
    }
</style>
<div class="container m-5 p-2 rounded mx-auto bg-light shadow">
    <!-- App title section -->
    <div class="row m-1 p-4">
        <div class="col">
            <div class="p-1 h1 text-primary text-center mx-auto display-inline-block">
                <i class="fa fa-check bg-primary text-white rounded p-2"></i>
                <u>My Todo</u>
            </div>
        </div>
        <div class="col-auto">
            <button class="btn btn-info" data-toggle="modal" data-target="#profileModal">
                <i class="fa fa-user"></i> Profile
            </button>
        </div>
    </div>

    <!-- Create todo section -->
    <div class="container mt-5">
        <!-- Add Task Button -->
        <div class="row mb-3">
            <div class="col text-center">
                <button id="toggleFormButton" class="btn btn-success">Add Task</button>
            </div>
        </div>

        <!-- Add Task Form -->
        <div class="row m-1 p-3">
            <div class="col col-11 mx-auto">
                <form action="{{ route('tasks.store') }}" method="POST" id="addTaskForm" class="row bg-white rounded shadow-sm p-3 add-todo-wrapper align-items-center justify-content-center">
                    @csrf
                    <!-- Title input -->
                    <div class="col-12 mb-2">
                        <input class="form-control form-control-lg border-2 add-todo-input bg-transparent rounded" type="text" name="title" placeholder="Title">
                    </div>

                    <!-- Description input -->
                    <div class="col-12 mb-2">
          <textarea class="form-control form-control-lg border-2 add-todo-description bg-transparent rounded"
                    name="description" rows="3" placeholder="Description"></textarea>
                    </div>
                    <div class="col-auto px-0 mx-0 mr-2">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="p-2 mx-4 border-black-25 border-bottom"></div>
    <!-- View options section -->
    <div class="row m-1 p-3 px-5 justify-content-end">
        <div class="col-auto d-flex align-items-center">
            <label class="text-secondary my-2 pr-2 view-opt-label">Filter</label>
            <select class="custom-select custom-select-sm btn my-2">
                <option value="all" selected>All</option>
                <option value="completed">Completed</option>
                <option value="active">Active</option>
                <option value="has-due-date">Has due date</option>
            </select>
        </div>
        <div class="col-auto d-flex align-items-center px-1 pr-3">
            <label class="text-secondary my-2 pr-2 view-opt-label">Sort</label>
            <select class="custom-select custom-select-sm btn my-2">
                <option value="added-date-asc" selected>Added date</option>
                <option value="due-date-desc">Due date</option>
            </select>
            <i class="fa fa fa-sort-amount-asc text-info btn mx-0 px-0 pl-1" data-toggle="tooltip" data-placement="bottom" title="Ascending"></i>
            <i class="fa fa fa-sort-amount-desc text-info btn mx-0 px-0 pl-1 d-none" data-toggle="tooltip" data-placement="bottom" title="Descending"></i>
        </div>
    </div>
    <!-- Todo list section -->
    <div class="row mx-1 px-5 pb-3 w-80">
        <div class="col mx-auto">
            <!-- Todo Item 1 -->
            <div class="task-list">
                @foreach($tasks as $task)
                <div class="task-item">
                    <div class="task-header">
                        <h5>{{$task->title}}</h5>
                        <div class="task-actions">
                            <button class="btn btn-primary"><a href="">Mark as done</a></button>
                            <button class="btn btn-info" data-toggle="modal" data-target="#editTaskModal-{{ $task->id }}">Edit</button>
                            <form action="" method="POST" onsubmit="return confirm('Are you sure you want to delete this restaurant?');" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger"><a href="">Delete</a></button>
                            </form>
                        </div>
                    </div>
                    <div class="task-description">
                        {{$task->description}}
                    </div>
                </div>
                @endforeach

            </div>

            <script>
                document.querySelectorAll('.task-item').forEach(task => {
                    // Mark as Done
                    task.querySelector('.btn-primary').addEventListener('click', () => {
                        task.classList.toggle('done');
                    });
                });
            </script>

        </div>
    </div>
</div>
<!-- Edit Task Modal -->
<div class="modal fade" id="editTaskModal-{{ $task->id }}" tabindex="-1" aria-labelledby="editTaskModalLabel-{{ $task->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="editTaskModalLabel-{{ $task->id }}">Edit Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Title Field -->
                    <div class="form-group">
                        <label for="title-{{ $task->id }}">Title</label>
                        <input type="text" class="form-control" id="title-{{ $task->id }}" name="title" value="{{ $task->title }}" required>
                    </div>

                    <!-- Description Field -->
                    <div class="form-group">
                        <label for="description-{{ $task->id }}">Description</label>
                        <textarea class="form-control" id="description-{{ $task->id }}" name="description" rows="3">{{ $task->description }}</textarea>
                    </div>

                    <!-- Due Date Field (Optional) -->
                    <div class="form-group">
                        <label for="due_date-{{ $task->id }}">Due Date</label>
                        <input type="date" class="form-control" id="due_date-{{ $task->id }}" name="due_date" value="{{ $task->due_date }}">
                    </div>

                    <!-- Modal Footer with Save and Close buttons -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Profile Modal -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileModalLabel">User Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>Full Name:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a class="btn btn-danger" id="logoutButton" href="{{'logout'}}">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Sign Out</span>
                </a>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();

        // Toggle the form visibility when the button is clicked
        $('#toggleFormButton').click(function () {
            $('#addTaskForm').toggle(300); // Toggle with a 300ms animation
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="script.js"></script>
</body>
</html>
