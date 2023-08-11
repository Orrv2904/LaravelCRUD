@extends('layouts.base')

@section('content')
    <div class="row">
        <div class="col-12">
            <div>
                <h2>Create a new task</h2>
            </div>
            <div>
                <a href="{{ route('task.index') }}" class="btn btn-primary">Back to</a>
            </div>
        </div>

        @if ($errors->any())
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'bottom-end',
                        showConfirmButton: false,
                        timer: 8000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });

                    const errorMessage = `
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                `;

                    Toast.fire({
                        icon: 'error',
                        title: 'Error!',
                        html: errorMessage,
                    });
                });
            </script>
        @endif


        <form action="{{ route('task.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                    <div class="form-group">
                        <strong>Task:</strong>
                        <input type="text" name="title" class="form-control" placeholder="Write a new task">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                    <div class="form-group">
                        <strong>Description:</strong>
                        <textarea class="form-control" style="height:150px" name="description" placeholder="Description..."></textarea>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
                    <div class="form-group">
                        <strong>Deadline:</strong>
                        <input type="date" name="due_date" class="form-control" id="">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 mt-2">
                    <div class="form-group">
                        <strong>Status (initial):</strong>
                        <select name="status" class="form-select" id="">
                            <option value="">-- Choose state --</option>
                            <option value="Pending">Pending</option>
                            <option value="In progress">In progress</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-2">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </div>
        </form>
    </div>
@endsection
