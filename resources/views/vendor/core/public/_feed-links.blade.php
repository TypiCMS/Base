@foreach (feeds() as $feed)
    <link rel="alternate" type="application/atom+xml" href="{{ $feed['url'] }}" title="{{ $feed['title'] }}"/>
@endforeach
