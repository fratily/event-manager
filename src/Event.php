<?php
/**
 * FratilyPHP Event Manager
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 *
 * @author      Kento Oka <kento.oka@kentoka.com>
 * @copyright   (c) Kento Oka
 * @license     MIT
 * @since       1.0.0
 */
namespace Fratily\EventManager;

/**
 *
 */
class Event implements EventInterface{

    /**
     * @var string
     */
    private $name;

    /**
     * @var mixed[]
     */
    private $params;

    /**
     * @var bool
     */
    private $propagation;

    /**
     * Cnstructor
     *
     * @param   string  $name
     * @param   mixed[] $params
     * @param   bool    $propagation
     *
     * @throws  \InvalidArgumentException
     */
    public function __construct(string $name, array $params = [], bool $propagation = true){
        if(!(bool)preg_match("`\A[0-9A-Za-z_.]+\z`", $name)){
            throw new \InvalidArgumentException();
        }

        $this->name         = $name;
        $this->params       = $params;
        $this->propagation  = $propagation;
    }

    /**
     * {@inheritdoc}
     */
    public function getName(){
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function withName(string $name){
        if($this->name === $name){
            return $this;
        }

        if(!(bool)preg_match("`\A[0-9A-Za-z_.]+\z`", $name)){
            throw new \InvalidArgumentException();
        }

        $clone          = clone $this;
        $clone->name    = $name;

        return $clone;
    }

    /**
     * {@inheritdoc}
     */
    public function getParams(){
        return $this->params;
    }

    /**
     * {@inheritdoc}
     */
    public function getParam(string $name, $default = null){
        return $this->params[$name] ?? $default;
    }

    /**
     * {@inheritdoc}
     */
    public function withParams(array $params){
        $clone          = clone $this;
        $clone->params  = $params;

        return $clone;

    }

    /**
     * {@inheritdoc}
     */
    public function isPropagation(){
        return $this->propagation;
    }

    /**
     * {@inheritdoc}
     */
    public function withPropagation(bool $propagation){
        if($this->propagation === $propagation){
            return $this;
        }

        $clone              = clone $this;
        $clone->propagation = $propagation;

        return $clone;
    }
}