@if (count($errors) > 0)
<div class="alert alert-danger">
        <strong>Ups!</strong> Coś poszło nie tak: <br><br>
        <ul>
                @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                @endforeach
        </ul>
</div>
@endif