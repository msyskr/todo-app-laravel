<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Todoリストーゴミ箱</title>
</head>
<body class="bg-gray-300">
<div class="container mx-auto p-4">
    <nav class="flex justify-between">
        <h1 class="text-2xl font-bold mb-4">ゴミ箱</h1>
        <a href="{{route('tasks.index') }}" class="border border-blue-500 hover:bg-blue-700 hover:text-white p-2 mb-2 rounded">Topへ戻る</a>
    </nav>
    <ul class="list-disc pl-5">
        @foreach($tasks as $task)
            <li class="flex justify-between mb-2">
                <span>{{$task->task_name}}</span>
                <form action="{{route('tasks.recover', $task->id)}}" method="POST" class="inline">
                @csrf
                @method('PUT')
                    <button type="button" onclick="recoverTask(event)" class="bg-blue-500 text-white px-3 py-1 rounded">復元</button>
                </form>
            </li>
        @endforeach
        @if(count($tasks) > 0)
                <form action="{{route('tasks.deleteTrash')}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="permanentDelete(event)" class="bg-red-500 text-white p-2 rounded">ゴミ箱を空にする</button>
                </form>
        @endif
    </ul>
    @if($tasks->isEmpty())
        <p class="text-center">ゴミ箱は空です</p>
    @endif
</div>
</body>
<script>
    function recoverTask(event){
        if (confirm('このタスクを復元しますか？')){
            event.target.form.submit();
        }
    }
    function permanentDelete(event){
        if (confirm('ゴミ箱を空にしますか？')){
            event.target.form.submit();
        }
    }
</script>
</html>
