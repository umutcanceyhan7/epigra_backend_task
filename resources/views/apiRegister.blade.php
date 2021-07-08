<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Api</title>
</head>
<body>
    <form method="POST" action="/api/user/register">
        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="@error('name') is-invalid @enderror" required>
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror

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
    

</body>
</html>
