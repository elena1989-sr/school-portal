<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Test Result</title>
    <style>
        body { font-family: DejaVu Sans; }
        h1 { color: #333; }
        .box { margin-bottom: 10px; }
    </style>
</head>
<body>

    <h1>Test Result</h1>

    <div class="box">
        <strong>Student:</strong> {{ $student->name }}
    </div>

    <div class="box">
        <strong>Test:</strong> {{ $test->title }}
    </div>

    <div class="box">
        <strong>Correct Answers:</strong> {{ $correct }} / {{ $total }}
    </div>

    <div class="box">
        <strong>Percentage:</strong> {{ $percentage }} %
    </div>

    <div class="box">
        <strong>Date:</strong> {{ now()->format('d.m.Y') }}
    </div>

</body>
</html>