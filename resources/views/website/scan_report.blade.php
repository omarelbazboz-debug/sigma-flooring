<!-- filepath: resources/views/scan_report.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Security Scan Report</title>
    <style>
        body{font-family:sans-serif}
        table{border-collapse:collapse;width:100%}
        td,th{border:1px solid #ccc;padding:8px}
        th{background:#eee}
    </style>
</head>
<body>
    <h1>PHP Security Scan Report</h1>
    <table>
        <thead>
            <tr>
                <th>File</th>
                <th>Line</th>
                <th>Function</th>
                <th>Code</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($results as $r)
                <tr>
                    <td>{{ $r['file'] }}</td>
                    <td>{{ $r['line'] }}</td>
                    <td><strong>{{ $r['function'] }}</strong></td>
                    <td><code>{{ htmlentities($r['code']) }}</code></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>