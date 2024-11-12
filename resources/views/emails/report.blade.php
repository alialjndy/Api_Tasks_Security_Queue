<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>تاسكات</title>
</head>
<body>
    <h1>مرحبا </h1>
    <h3>تقرير حول التاسكات التي {{$reportType}}</h3>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Type</th>
            <th>Status</th>
            <th>Description</th>
            <th>Title</th>
            <th>Priority</th>
            <th>Due Date</th>
            <th>Assigned To</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tasks as $task)
            <tr>
                <td>{{ $task->id }}</td>
                <td>{{ $task->type }}</td>
                <td>{{ $task->status }}</td>
                <td>{{ $task->description }}</td>
                <td>{{ $task->title }}</td>
                <td>{{ $task->priority }}</td>
                <td>{{ $task->due_date }}</td>
                <td>{{ $task->Assigned_to }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
</body>
</html>
