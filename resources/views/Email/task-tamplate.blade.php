<!DOCTYPE html>
<html>
<head>
    <title>Task Completed Notification</title>
</head>
<body>
    <h2>Hello, {{ $user->name }}</h2>
    <p>We are pleased to inform you that your task "<strong>{{ $task->title }}</strong>" has been successfully completed.</p>
    
    <p>Details of the task:</p>
    <ul>
        <li><strong>Title:</strong> {{ $task->title }}</li>
        <li><strong>Description:</strong> {{ $task->description }}</li>
        <li><strong>Completed On:</strong> {{ $task->updated_at->format('d M, Y H:i A') }}</li>
    </ul>

    <p>Thank you for using our application.</p>
    <p>Best Regards,<br> {{ config('app.name') }}</p>
</body>
</html>
