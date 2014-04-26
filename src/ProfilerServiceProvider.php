<?php namespace Jlem\Profiler;

use Illuminate\Support\ServiceProvider;
use Jlem\Profiler\Query\QueryLogPresenter;
use Jlem\Profiler\Profiler;

class ProfilerServiceProvider extends ServiceProvider {



	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;



	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	
	public function boot()
	{
		$this->package('atom/profiler', null, __DIR__);

		if (\Config::get('app.debug')) {
			$app = $this->app;
			$this->app->finish(function() use ($app) {
				echo $app['profiler']->showQueryLog();
			});
		}
	}



	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	
	public function register()
	{
		$this->registerQueryLogPresenter();
		$this->registerProfiler();
	}



	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	
	public function provides()
	{
		return array();
	}



	/**
	 * Registers the main profiler class with the IoC
	 *
	 * @return void
	 */

	protected function registerProfiler()
	{
		$this->app['profiler'] = $this->app->share(function($app) {
			return new Profiler($app['view'], $app['query_logger']);
		});
	}



	/**
	 * Registers the query logger with the IoC
	 *
	 * @return void
	 */

	protected function registerQueryLogPresenter()
	{
		$this->app['query_logger'] = $this->app->share(function($app) {
			return new QueryLogPresenter($app['db']->getQueryLog());
		});
	}
}
