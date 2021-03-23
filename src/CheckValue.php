<?php
namespace App;

/**
 * 商品情報に関わる値をチェックする時に使うメソッド群を記載するクラス
 */
class CheckValue
{
  /**
   * checkQuantityメソッド
   * 
   * @param int $quantity 商品点数
   * 
   * @return bool
   *         1 <= 数量 <= 9の場合  true
   *         それ以外の場合         false
   */
  public static function checkQuantity($quantity): bool
  {
    return $quantity >= 1 && $quantity <= 9;
  }

  /**
   * checkPriceメソッド
   * 
   * @param int $price 商品単価
   * 
   * @return bool
   *         0 <= 価格 <= 99999の場合  true
   *         それ以外の場合             false
   */
  public static function checkPrice($price): bool
  {
    return $price >= 0 && $price <= 99999;
  }

  /**
   * checkTitleメソッド
   * 
   * @param string $title 商品点数
   * 
   * @return bool
   *         1 <= 商品名の長さ <= 255の場合  true
   *         それ以外の場合                 false
   */
  public static function checkTitle($title): bool
  {
    // 商品名の長さを取得
    $title_len = mb_strlen($title);
    return $title_len >= 1 && $title_len <= 255;
  }
}