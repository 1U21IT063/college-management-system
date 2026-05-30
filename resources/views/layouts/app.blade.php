<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suriyan College</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#f4f6f9;
        }

        .sidebar{
            min-height:100vh;
            background:#212529;
        }

        .sidebar a{
            color:white;
            text-decoration:none;
            display:block;
            padding:12px;
            margin-bottom:5px;
            border-radius:8px;
        }

        .sidebar a:hover{
            background:#0d6efd;
        }

        .content{
            padding:20px;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">

        <div class="col-md-2 sidebar p-3">

            <h3 class="text-white mb-4">Suriyan College</h3>

            <a href="/dashboard">📊 Dashboard</a>
            <a href="/students">👨‍🎓 Students</a>
            <a href="/staff">👨‍🏫 Staff</a>
            <a href="/courses">📚 Courses</a>
            <a href="/departments">🏢 Departments</a>
            <a href="/fees">💰 Fees</a>
            <a href="/attendance">📅 Attendance</a>
            <a href="/marks">📝 Marks</a>

            <hr class="text-white">

            @auth
                <p class="text-white">{{ Auth::user()->name }}</p>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button class="btn btn-danger btn-sm w-100">
                        Logout
                    </button>
                </form>
            @endauth

        </div>

        <div class="col-md-10 content">

            @yield('content')

        </div>

    </div>
</div>

</body>
</html>