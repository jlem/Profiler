<p>Total Queries: {{ $QueryLogPresenter->getQueryCount() }}</p>
@foreach($QueryLogPresenter->getQueries() as $query)
	<p>{{ $query['time'] }} : {{ $query['query'] }}</p>
@endforeach