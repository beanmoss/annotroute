<?php

namespace Beanmoss\Annotroute;

use Doctrine\Common\Annotations\FileCacheReader;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;

/**
 * Description of AnnotRoute
 *
 * @author robel
 */
class AnnotRoute
{

    protected $reflectionClass;
    protected $reflectionMethods;
    protected $classAnnotation;
    protected $routeAnnotationClass = 'Beanmoss\Annotroute\Annotation\Route';
    protected $reader;

    public function __construct()
    {
        AnnotationRegistry::registerFile(__DIR__ . '/Annotation/Route.php');
        $this->reader = new FileCacheReader(
                new AnnotationReader(), storage_path() . "/cache", $debug = true
        );
    }

    public function generateRoute($controller)
    {
        $this->reflectionClass = new \ReflectionClass($controller);
        $this->reflectionMethods = $this->reflectionClass->getMethods(\ReflectionMethod::IS_PUBLIC);
        $this->classAnnotation = $this->reader->getClassAnnotation($this->reflectionClass, $this->routeAnnotationClass);
        foreach ($this->reflectionMethods as $refMethod) {
            $methodAnnots = $this->reader->getMethodAnnotations($refMethod);
            foreach ($methodAnnots as $methodAnnot) {
                if ($methodAnnot instanceof \Beanmoss\Annotroute\Annotation\Route) {
                    $this->createRoute($methodAnnot, $refMethod);
                }
            }
        }
    }

    protected function createRoute($methodAnnot, $refMethod)
    {
        $group = (!is_null($this->classAnnotation)) ? $this->classAnnotation->group : [];
        \Route::group($group, function() use ($methodAnnot, $refMethod) {

            $method = $methodAnnot->method;

            $action = [
                'uses' => $refMethod->class . '@' . $refMethod->name,
                'before' => $methodAnnot->before,
                'after' => $methodAnnot->after,
                'as' => $methodAnnot->name
            ];

            \Route::$method($methodAnnot->path, $action)->where($methodAnnot->where);
        });
    }

}
