<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" enctype="multipart/form-data" action="{{url('/uploade')}}" >
    @csrf
    <input type="file" name="image" >
    <button >uploade</button>
    </form>
</body>
</html>