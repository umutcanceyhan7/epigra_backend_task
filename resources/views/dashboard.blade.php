<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
</head>
<body>
    <h2>
        {{ __('Dashboard') }}
    </h2>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
            </div>
        </div>
    </div>

    <div>
        <h1>To create your token please enter credentials</h1>
        <form action="/api/user/login" method="post">
            @csrf
        
        <label for="email">Email</label>   
        <input type="email" name="email" id="email" class="@error('email') is-invalid @enderror" required> 
        @error('email')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="@error('password') is-invalid @enderror" required>
        @error('password')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        
        <input type="submit" value="submit">
        </form>
    </div>
</body>
</html>