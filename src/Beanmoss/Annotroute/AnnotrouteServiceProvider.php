<?php namespace Beanmoss\Annotroute;

use Illuminate\Support\ServiceProvider;

class AnnotrouteServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bindShared('annot.route', function() { return new AnnotRoute(); });
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('annot.route');
	}

}
