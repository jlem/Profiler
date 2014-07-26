<div id="jlem-profiler" style="margin-top: 50px; border-top: 1px solid #e2e2e2; background: #f4f4f4; padding: 50px;">
	<p>Total Queries: {{ $QueryLogPresenter->getQueryCount() }}</p>
	@foreach($QueryLogPresenter->getQueries() as $query)
		<p>{{ $query['time'] }} : {{ $query['query'] }}</p>
	@endforeach
</div>