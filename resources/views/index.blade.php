@extends('layouts.app')

@section('title', 'The list of tasks')

@section('content')
<div>
    <div>
        <a href="{{ route('tasks.create') }}">Add Task!</a>
    </div>
    @forelse ($tasks as $task)
        <div>
            <a href="{{ route('tasks.show', ['task' => $task]) }}">{{ $task->title }}</a>
        </div>
    @empty
        <div>There are no tasks!</div>
    @endforelse
</div>
    @if ($tasks->count())
        <nav>
            {{ $tasks->links() }}
        </nav>
    @endif
@endsection
