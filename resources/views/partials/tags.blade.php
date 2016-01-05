<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Ostatnio używane tagi:</h3>
  </div>
    
  <div class="panel-body">
    @foreach (\App\Tag::latest()->get() as $tag)
    <span style="font-size: larger"><a href='{{url('/tags', $tag->name)}}'>{{ $tag->name .' '}}</a></span>
                                                @endforeach</div>
  </div>
</div>