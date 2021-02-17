<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test-Laravel8</title>
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" />
</head>
<body>

@yield('content')
<script>
        function previewFile(input){
            var file=$("input[type=file]").get(0).files[0];
            console.log('file='+file);
            if(file){
                var reader = new FileReader();
                reader.onload = function(){
                    $('#previewImg').attr("src", reader.result);
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
<script src="{{asset('js/jquery-2.2.4.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/bootstrap.bundle.min.js')}}" type="text/javascript"></script>
</body>
</html>