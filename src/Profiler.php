<?php namespace Jlem\Profiler;

use Illuminate\View\Factory;
use Jlem\Profiler\Query\QueryLogPresenter;

class Profiler 
{
	/**
	 * View environment object
	 * 
	 * @var Factory
	 */
	
	protected $View;


	/**
	 * The QueryLogPresenter object used to assemble Laravel's query log
	 * 
	 * @var QueryLogPresenter
	 */
	
	protected $QueryLogPresenter;



	/**
	 * Create a new instance
	 * 		
	 * @param Illuminate\View\Factory 		$View
	 * @param Jlem\Profiler\Query\QueryLogPresenter 	$QueryLogPresenter
	 * @return  void
	 */
	
	public function __construct(Factory $View, QueryLogPresenter $QueryLogPresenter)
	{
		$this->View = $View;
		$this->QueryLogPresenter = $QueryLogPresenter;
	}



	/**
	 * Renders the formatted query log
	 * 
	 * @return Illuminate\View\View
	 */
	
	public function showQueryLog()
	{
		return $this->View->make('profiler::queries')
						  ->with('QueryLogPresenter', $this->QueryLogPresenter);
	}
}