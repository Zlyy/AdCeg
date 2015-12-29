<html>
    <html lang="pl">
        <head>
            <meta charset="UTF-8">
            <title>AdCeg - studencki portal ogłoszeniowy.</title>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
            <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/css/select2.min.css" rel="stylesheet" />
            <link rel="stylesheet" href="{{ URL::asset('css/main.css') }}" />
        </head>
        <body>
      @include('partials.nav')
            
            <div class="container">
                
                @if (Session::has('flash_message'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ Session::get('flash_message') }}
                    </div>
                @endif
                @yield('content')
            </div>
            
            <script src="http://code.jquery.com/jquery.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.1/js/select2.min.js"></script>
            @yield('footer')
        </body>
</html>