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
interface EventManagerInterface{

    /**
     * リスナーを登録する
     *
     * @param   string  $event
     * @param   callable    $callback
     * @param   int $priority
     *
     * @return  $this
     */
    public function attach(string $event, callable $callback, int $priority = 0);

    /**
     * リスナーの登録を解除する
     *
     * @param   string  $event
     * @param   callable    $callback
     *
     * @return  $this
     */
    public function detach(string $event, callable $callback);

    /**
     * 全てのリスナーの登録を解除する
     *
     * @param   string  $event  対象のイベント名
     * @return void
     */
    public function clear(string $event);

    /**
     * イベントを発動する
     *
     * @param   string|EventInterface   $event
     * @param   mixed[] $args
     *
     * @return  bool
     */
    public function trigger($event, $args = array());
}