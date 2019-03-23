<?php

namespace Core\Controller;

use Psr\Container\ContainerInterface;

class Controller
{
    public const HTTP_200_OK = 200;
    public const HTTP_201_CREATED = 201;

    public const HTTP_400_BAD_REQUEST = 400;

    protected $container;
    protected $db;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->db = $container->db;
    }
}