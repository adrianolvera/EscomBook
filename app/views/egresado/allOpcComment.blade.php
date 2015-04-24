@foreach($comments as $comment)
    @if($comment->idUsuario == $post->idUsuario)
        <div class="dropdown pull-right">
            <button class="btn btn-default btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                <li role="presentation"><a data-toggle="modal" data-idpublicacion="{{ $post->id }}" data-mensaje="{{ $post->mensaje }}" class="open-Modal" href="#editar">Editar...</a></li>
                <li role="presentation"><a data-toggle="modal" data-idpost="{{ $post->id }}" data-mensaje="{{ $post->mensaje }}" class="open-Modal" href="#eliminar">Eliminar...</a></li>
            </ul>
        </div>
    @else
        <button href="{{ route('gestionPosts') }}" class="btn btn-default btn-xs"><span class="glyphicon glyphicon-remove"></span></button>       
    @endif
@endforeach

{{ Form::open(array('action' => 'ComentarioController@crear', 'files' => true)) }} 
    {{ Form::hidden('created_by', Auth::user()->id) }}
    <div class="input-group">
      <input type="text" class="form-control" id="comment"placeholder="Escribe un comentario...">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button" href="#">
            <span class="glyphicon glyphicon-camera"></span>
        </button>
      </span>
    </div><!-- /input-group -->
{{ Form::close() }}