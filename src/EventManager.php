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
class EventManager implements EventManagerInterface{

    /**
     * @var Listener[][]
     */
    private $listeners;

    public function __construct(){
        $this->listeners    = [];
    }

    /**
     * {@inheritdoc}
     */
    public function attach(string $event, callable $callback, int $priority = 0){
        if(!(bool)preg_match("`\A[0-9A-Za-z_.]+\z`", $event)){
            throw new \InvalidArgumentException();
        }

        if(!array_key_exists($event, $this->listeners)){
            $this->listeners[$event]    = [];
        }

        $this->listeners[$event][]  = new Listener($callback, $priority);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function detach(string $event, callable $callback){
        if(array_key_exists($event, $this->listeners)){
            $this->listeners[$event]    = array_filter(
                $this->listeners[$event],
                function($listener) use ($callback){
                    return !$listener->isSame($callback);
                }
            );
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function clear(string $event){
        if(array_key_exists($event, $this->listeners)){
            unset($this->listeners[$event]);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function trigger($event, array $args = []){
        if(!is_string($event) && !($event instanceof EventInterface)){
            throw new \InvalidArgumentException();
        }

        $name   = is_string($event) ? $event : $event->getName();
        $event  = is_string($event) ? (new Event())->withName($event)->withPropagation(true) : $event;

        $result = null;

        if(array_key_exists($name, $this->listeners)){
            $sort   = [];

            foreach($this->listeners[$name] as $key => $listener){
                $sort[$key] = $listener->getPriority();
            }

            array_multisort($sort, SORT_ASC, $this->listeners[$name]);

            foreach($this->listeners[$name] as $listener){
                $result = $listener->trriger($event, $args);

                if(!$event->isPropagation()){
                    break;
                }
            }
        }

        return $result;
    }
}