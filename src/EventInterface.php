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
interface EventInterface{

    /**
     * イベント名を取得する
     *
     * @return  string
     */
    public function getName();

    /**
     * イベント名を設定する
     *
     * @param   string  $name
     *
     * @return  static
     */
    public function withName(string $name);

    /**
     * パラメータを全て取得する
     *
     * return   mixed[]
     */
    public function getParams();

    /**
     * 指定されたパラメータ値を取得する
     *
     * @param   string  $name
     * @param   mixed   $default
     * 
     * @return  mixed
     */
    public function getParam(string $name, $default = null);

    /**
     * パラメータを設定する
     *
     * @param   mixed[]  $params
     *
     * @return  static
     */
    public function withParams(array $params);

    /**
     * リスナーが複数ある場合にすべて実行するか取得する
     *
     * @return  bool
     */
    public function isPropagation();

    /**
     * リスナーが複数ある場合にすべて実行するか設定する
     *
     * @param   bool    $propagation
     *
     * @return  static
     */
    public function withPropagation(bool $propagation);
}