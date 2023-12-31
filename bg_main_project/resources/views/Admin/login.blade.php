<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body style="height: 100vh;">
    <div class="container-fluid" style="height: 100%;background: rgba(175, 180, 136, 0.44);display: flex;justify-content: center;align-items: center;">
        <div class="login-card" style="width: 500px;display: flex;flex-direction: column;">
            <form action="{{ route('userLogin') }}" method="POST">
                @csrf
                <div class="form-group mb-2">
                    <input name="email" type="text" class="form-control" placeholder="Email">
                </div>
                <div class="form-group mb-2">
                    <input name="password" type="password" class="form-control" placeholder="Password">
                </div>
                <div class="form-group mb-2">
                    <button class="btn btn-success" type="submit">Login</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>