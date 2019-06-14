<?php

namespace FluffyFactory\Bundle\GdprBundle\Model;


class Cookie
{

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $detail;

    /**
     * @var bool
     */
    private $required;

    public function __construct(string $name, string $description, bool $required)
    {
        $this->name = $name;
        $this->description = $description;
        $this->required = $required;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getDetail(): ?string
    {
        return $this->detail;
    }

    public function isRequired(): ?bool
    {
        return $this->required;
    }

    public function setDetail(?string $detail): void
    {
        $this->detail = $detail;
    }


}