<?php

namespace App;

/**
 * App 共通利用定数クラス
 * Class AppConst
 */
class AppConst
{
    // 数量(最大値/最小値)
    const PRODUCT_MAX_QUANTITY_NUM = 9;
    const PRODUCT_MIN_QUANTITY_NUM = 1;
    
    // 価格(最大値/最小値)
    const PRODUCT_MAX_PRICE_NUM = 99999;
    const PRODUCT_MIN_PRICE_NUM = 0;

    // 商品名(最大値/最小値)
    const PRODUCT_MAX_TITLE_LEN = 255;
    const PRODUCT_MIN_TITLE_LEN = 1;
    
}