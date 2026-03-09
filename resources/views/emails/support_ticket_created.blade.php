<!DOCTYPE html>
<html>
<head>
    <title>New Support Ticket Created</title>
</head>
<body>
    <p>A new support ticket has been created.</p>
    <p><strong>Topic:</strong> {{ $topic }}</p>
    <p><strong>Description:</strong> {!!  $description  !!}</p>
    <p><a href="{{ $url }}">View Ticket</a></p>
    <p>Thank you for using our application!</p>
</body>
</html>
