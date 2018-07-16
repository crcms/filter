<?php

namespace CrCms\Filter;

use Illuminate\Support\Arr;

class Input
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * Input constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
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
     * 过滤组件
     *
     * @param FilterInterface $filter
     * @return Input
     */
    public function filter(FilterInterface $filter): Input
    {
        $this->data = $this->filterKernel($this->data, $filter);

        return $this;
    }

    /**
     * 过滤核心处理
     *
     * @param array $data
     * @param FilterInterface $filter
     * @return array
     */
    protected function filterKernel(array $data, FilterInterface $filter): array
    {
        foreach ($data as &$value) {
            if (is_array($value)) {
                $value = $this->filterKernel($value, $filter);
            } else {
                $value = $filter->filter(trim($value));
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