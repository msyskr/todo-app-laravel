<!DOCTYPE html>

<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todoリスト</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    <div class="container mx-auto p-4 md:w-6/12">
        <nav class="flex justify-between items-center">
            <h1 class="text-2xl font-bold mb-4">Todoリスト</h1>
            <a href="{{route('tasks.trash') }}" class="bg-gray-300 p-2 mb-2 rounded">ゴミ箱</a>
        </nav>

        <form action="{{route('tasks.store')}}" method="POST" class="mb-4">
            @csrf
            <div class="mb-2">
                <div>
                    <div>
                        <label for="task_name" class="text-xs">タスク</label>
                    </div>
                    <input type="text" name="task_name" id="task_name" class="border border-gray-300 p-2 mt-2 w-full">
                </div>

                <div>
                    <div>
                        <label for="due_date" class="text-xs">期限</label>
                    </div>
                    <input type="datetime-local" name="due_date" value="{{now()->format('Y-m-d\TH:i')}}" class="border border-gray-300 p-2 w-full">
                </div>
                <button type="submit" class="bg-blue-500 text-white p-2 mt-2 rounded">追加</button>
            </div>
        </form>
    </div>

    <ul class="list-disc pl-5 text-sm">
        @foreach ($tasks as $task)
            <li class="flex justify-between mb-2">
                <div>{{ $task->task_name }}:
                    <span class="mx-2">{{date('Y-m-d\TH:i',
                    strtotime($task->due_date))}}</span></div>

                <form action="{{route('tasks.markAsDeleted', $task->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded">Done!</button>
                </form>
            </li>
        @endforeach

    </ul>
</body>
</html>
