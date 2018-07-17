<?php

namespace CrCms\Filter;

use Illuminate\Support\Arr;

/**
 * Class Input
 * @package CrCms\Filter
 */
class Input
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var array
     */
    protected $original = [];

    /**
     * @var array
     */
    protected $handlers = [];

    /**
     * @return array
     */
    public function getOriginal(): array
    {
        return $this->original;
    }

    /**
     * 获取所有数据
     *
     * @return array
     */
    public function all(): array
    {
        return $this->data;
    }

    /**
     * 获取指定数据
     *
     * @param string $key
     * @param null $default
     * @return mixed|null
     */
    public function input(string $key, $default = null)
    {
        $result = Arr::get($this->data, $key, $default);

        return $result;
    }

    /**
     * alias input
     *
     * @param string $key
     * @param null $default
     * @return mixed|null
     */
    public function get(string $key, $default = null)
    {
        return $this->input($key, $default);
    }

    /**
     * 获取除此key之后的数据
     *
     * @param string|array $key
     * @return array
     */
    public function except($key): array
    {
        return Arr::except($this->data, (array)$key);
    }

    /**
     * @param string|array $key
     * @return array
     */
    public function only($key): array
    {
        return Arr::only($this->data, (array)$key);
    }

    /**
     * @param array $data
     * @return Input
     */
    public function filter(array $data): Input
    {
        $this->data = $this->original = $data;

        array_map(function($handler){
            $this->data = $this->filterKernel($this->data, $handler);
        },$this->handlers);

        return $this;
    }

    /**
     * @param FilterInterface $handler
     * @return $this
     */
    public function addHandler(FilterInterface $handler)
    {
        if (!in_array($handler, $this->handlers, true)) {
            $this->handlers[] = $handler;
        }

        return $this;
    }

    /**
     * @param array $handlers
     * @return $this
     */
    public function setHandlers(array $handlers)
    {
        $this->handlers = $handlers;

        return $this;
    }

    /**
     * 过滤核心处理
     *
     * @param array $data
     * @param FilterInterface $handler
     * @return array
     */
    protected function filterKernel(array $data, FilterInterface $handler): array
    {
        foreach ($data as &$value) {
            if (is_array($value)) {
                $value = $this->filterKernel($value, $handler);
            } else {
                $value = $handler->filter(trim($value));
            }
        }

        return $data;
    }

    /**
     * @param $name
     * @return mixed|null
     */
    public function __get(string $name)
    {
        return $this->input($name);
    }
}