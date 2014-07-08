<?php

namespace Beanmoss\Annotroute\Facade;

use Illuminate\Support\Facades\Facade;

/**
 * Description of AnnotRoute
 *
 * @author robel
 */
class AnnotRoute extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'annot.route';
    }

}
