<?php
/**
 * FratilyPHP Event Manager
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE
 * Redistributions of files must retain the above copyright notice.
 *
 * @author      Kento Oka <kento-oka@kentoka.com>
 * @copyright   (c) Kento Oka
 * @license     MIT
 * @since       1.0.0
 */
namespace Fratily\EventManager;

/**
 *
 */
class Listener{

    /**
     * @var callback
     */
    private $callback;

    /**
     * @var int
     */
    private $priority;

    /**
     * Constructor
     *
     * @param   EventManager    $manager
     * @param   callable    $callback
     * @param   int $priority
     */
    public function __construct(callable $callback, int $priority){
        $this->callback = $callback;
        $this->priority = $priority;
    }

    /**
     * コールバックを取得する
     *
     * @return  callable
     */
    public function getCallback(){
        return $this->callback;
    }

    /**
     * 優先度を取得する
     *
     * @return  int
     */
    public function getPriority(){
        return $this->priority;
    }

    /**
     * 指定されたコールバックがこのリスナーと等しいか確認する
     *
     * @param   callable    $callback
     *
     * @return  bool
     */
    public function isSame(callable $callback){
        return $callback === $this->callback;
    }

    /**
     * このリスナーを実行する
     *
     * @param   EventInterface  $event
     * @param   mixed[] $args
     *
     * @return  mixed
     */
    public function trigger(EventInterface $event, array $args = []){
        return call_user_func_array($this->callback, array_merge([$event], $args));
    }
}