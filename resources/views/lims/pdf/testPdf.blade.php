<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test PDF</title>
    <style>
        table,
        th,
        td {
            border: 1px solid white;
            border-collapse: collapse;
            font-size: 18px;
        }

        th,
        td {
            background-color: #96D4D4;
        }

        td.bold {
            font-weight: bold;
        }

        footer {
            width: 100%;
            position: absolute;
            margin-left: auto;
            margin-right: auto;
            bottom: 0;
            display: flex;
            flex-direction: column;
        }
    </style>
</head>

<body>
    <h1 style="margin-bottom: 50px; text-align: center">User Information</h1>
    <table style="width:100%; margin-left: auto; margin-right: auto;">
        <tr>
            <td colspan="2"></td>
            <td colspan="2">{{ $avatar }}</td>
        </tr>
        <tr>
            <td class="bold">ID</td>
            <td>{{ $id }}</td>
            <td class="bold">Name</td>
            <td>{{ $name }}</td>
        </tr>
        <tr>
            <td class="bold">Email</td>
            <td>{{ $email }}</td>
            <td class="bold">Date of Birtd</td>
            <td>{{ $dob }}</td>
        </tr>
        <tr>
            <td class="bold">User Role</td>
            <td>{{ $role_name }}</td>
            <td class="bold">Status</td>
            <td>{{ $status }}</td>
        </tr>
    </table>
    <footer>
        <p>2023 &copy; Leotech</p>
        <p>Design & Develop by Riajul Islam</p>
    </footer>
</body>

</html>