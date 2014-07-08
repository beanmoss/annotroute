<?php

namespace Beanmoss\Annotroute\Annotation;

/**
 * Description of Route
 *
 * @author robel
 */

/**
 * @Annotation
 *
 * Some Annotation using a constructor
 */
class Route
{

    public $method;
    public $path;
    public $before;
    public $after;
    public $name;

    /** @var array */
    public $where = [];

    /** @var array */
    public $group = [];

    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            $method = 'set' . str_replace('_', '', $key);
            if (!method_exists($this, $method)) {
                throw new \BadMethodCallException(sprintf("Unknown property '%s' on annotation '%s'.", $key, get_class($this)));
            }
            $this->$method($value);
        }
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getBefore()
    {
        return $this->before;
    }

    public function getAfter()
    {
        return $this->after;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setMethod($method)
    {
        $this->method = $method;
    }

    public function setPath($path)
    {
        $this->path = $path;
    }

    public function setBefore($before)
    {
        $this->before = $before;
    }

    public function setAfter($after)
    {
        $this->after = $after;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getWhere()
    {
        return $this->where;
    }

    public function getGroup()
    {
        return $this->group;
    }

    public function setWhere($where)
    {
        $this->where = is_array($where) ? $where : (array) $where;
    }

    public function setGroup($group)
    {
        $this->group = is_array($group) ? $group : (array) $group;
    }

}
