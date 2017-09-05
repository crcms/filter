<?php

namespace CrCms\Filter;

class Input
{
    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var bool
     */
    protected $emptyStringConvertNull = true;

    /**
     * Input constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @param bool $convert
     * @return Input
     */
    public function setConvertNull(bool $convert): self
    {
        $this->emptyStringConvertNull = $convert;

        return $this;
    }

    /**
     * 获取所有数据
     *
     * @return array
     */
    public function all()
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
    public function input(string $key, $default = null, bool $nullConvertDefault = true)
    {
        $result = array_get($this->data, $key, $default);

        if ($nullConvertDefault && is_null($result)) {
            return $default;
        }

        return $result;
    }

    /**
     * alias input
     *
     * @param string $key
     * @param null $default
     * @param bool $nullConvertDefault
     * @return mixed|null
     */
    public function get(string $key, $default = null, bool $nullConvertDefault = true)
    {
        return $this->input($key, $default, $nullConvertDefault);
    }

    /**
     * 获取除此key之后的数据
     *
     * @param $key
     * @return array
     */
    public function except($key)
    {
        $key = (array)$key;

        $key = array_combine($key, $key);

        return array_diff_key($this->data, $key);
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
     * instance
     * @param array $data
     * @return Input
     */
    public function instance(array $data): Input
    {
        return new self($data);
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
                $value = $this->emptyStringConvertNull($filter->filter(trim($value)));
            }
        }

        return $data;
    }

    /**
     * @param string $value
     * @return null|string
     */
    protected function emptyStringConvertNull(string $value)
    {
        if (!is_numeric($value) && empty($value) && $this->emptyStringConvertNull) {
            return null;
        }

        return $value;
    }

    /**
     * @param $name
     * @return mixed|null
     */
    public function __get($name)
    {
        return $this->input($name);
    }
}