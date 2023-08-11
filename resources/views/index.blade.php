@extends('layouts.base')

@section('content')
    <div class="row">
        <div class="col-12">
            <div>
                <h2 class="text-white">My tasks</h2>
            </div>
            <div>
                <a href="{{ route('task.create') }}" class="btn btn-primary">Create a new task</a>
            </div>
        </div>

        @if (Session::has('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const successMessage = '{{ Session::get('success') }}';

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'bottom-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });

                    Toast.fire({
                        icon: 'success',
                        title: successMessage,
                    });
                });
            </script>
        @endif



        <div class="col-12 mt-4">
            <table class="table table-bordered text-white">
                <tr class="text-secondary">
                    <th>Task</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                @foreach ($tasks as $task)
                    <tr>
                        <td class="fw-bold">{{ $task->title }}</td>
                        <td>{{ $task->description }}</td>
                        <td>
                            {{ $task->due_date }}
                        </td>
                        <td>
                            <span
                                class="badge fs-6 
                                @if ($task->status === 'Pending') bg-danger
                                @elseif ($task->status === 'In progress')
                                    bg-warning
                                @elseif ($task->status === 'Completed')
                                    bg-success @endif">
                                {{ $task->status }}
                            </span>

                        </td>
                        <td>
                            <a href="{{ route('task.edit', ['task' => $task]) }}" class="btn btn-warning">Editar</a>

                            <form action="{{ route('task.destroy', ['task' => $task]) }}" method="POST" class="d-inline"
                                id="delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="display: none;">Eliminar</button>
                            </form>
                            <a href="#" class="btn btn-danger" onclick="showDeleteConfirmation()">Eliminar</a>

                            <script>
                                function showDeleteConfirmation() {
                                    Swal.fire({
                                        title: 'Are you sure you want to delete this task?',
                                        showCancelButton: true,
                                        confirmButtonText: 'Delete',
                                        cancelButtonText: 'Cancel',
                                        dangerMode: true,
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            document.getElementById('delete-form').submit();
                                        }
                                    });
                                }
                            </script>

                        </td>
                    </tr>
                @endforeach
            </table>
            {{ $tasks->links() }}


        </div>
    </div>
@endsection
