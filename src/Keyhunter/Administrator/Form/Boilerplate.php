<?php namespace Keyhunter\Administrator\Form;

trait Boilerplate {

    /**
     * Element name
     *
     * @var string
     */
    protected $name;

    /**
     * Element label
     * @var null|string
     */
    protected $label;

    /**
     * Description
     * @var null|string
     */
    protected $description;

    /**
     * Element Value
     *
     * @var null
     */
    protected $value = null;

    /**
     * HTML attributes
     *
     * @var array
     */
    protected $attributes = [
        'class' => 'form-control input-sm'
    ];

    /**
     * Options: used for Select element
     *
     * @var array
     */
    protected $options = [];

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this->name;
    }

    /**
     * @param string $label
     * @return $this
     */
    public function setLabel($label = null)
    {
        $this->label = ucwords(str_replace(['_', '-'], " ", $label));

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param null $value
     * @return $this
     */
    public function setValue($value = null)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set element description
     *
     * @param null $description
     * @return $this
     */
    public function setDescription($description = null)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    private function decoupleOptionsFromAttributes()
    {
        foreach($this->attributes as $key => $value)
        {
            if (property_exists($this, $key))
            {
                $method = "set" . ucfirst($key);

                if (method_exists($this, $method))
                {
                    $this->$method($value);
                }
                else
                {
                    $this->$key = $value;
                }
                unset($this->attributes[$key]);
            }
        }
    }

    /**
     * @return bool
     */
    protected function hasValue()
    {
        return null !== $this->value && ! is_callable($this->value);
    }

    public function getType()
    {
        $parts = explode("\\", get_class($this));
        return strtolower(array_pop($parts));
    }

    /**
     * @param array $attributes
     * @return $this
     */
    public function setAttributes(array $attributes = [])
    {
        $this->attributes = $attributes;

        return $this;
    }
}