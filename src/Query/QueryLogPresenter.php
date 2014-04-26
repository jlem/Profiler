<?php namespace Jlem\Profiler\Query;

class QueryLogPresenter
{
	/**
	 * Array of queries
	 * 
	 * @var Array
	 */
	
	protected $queryLog;


	/**
	 * Create new instance
	 * 
	 * @param Array $queryLog
	 * @return void
	 */
	
	public function __construct($queryLog)
	{
		$this->queryLog = $queryLog;
	}


	/**
	 * Returns the query log array with formatted bindings
	 * 
	 * @return Array
	 */
	
	public function getQueries()
	{
		foreach ($this->queryLog as $key => $query) {
			$this->queryLog[$key]['query'] = $this->formatQueryWithBindings($query);
		}

		return $this->queryLog;
	}


	/**
	 * Returns the total number of queries for the given request
	 *
	 * @return integer
	 */

	public function getQueryCount()
	{
		return count($this->queryLog);
	}


	/**
	 * Replaces all '?' placeholders with their appropriate bindings for the given query
	 *
	 * @return string
	 */

	protected function formatQueryWithBindings($query)
	{
		return vsprintf(str_replace('?', '%s', $query['query']), $query['bindings']);
	}
}