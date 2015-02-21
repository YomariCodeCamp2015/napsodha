{{$question->question}}


{{'<br>'}}
{{'<br>'}}
{{'<br>'}}

@foreach($answers as $answer)

{{'<br>'}}
Answer::{{$answer->answer}}
{{'<br>'}}
Like::{{$answer->like}}
{{'<br>'}}

@endforeach