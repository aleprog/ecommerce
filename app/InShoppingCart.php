<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InShoppingCart extends Model
{
  protected $fillable = ['producto_id', 'shopping_cart_id'];

  public static function productoCount($shopping_cart_id)
  {
      return InShoppingCart::where('shopping_cart_id', $shopping_cart_id)->count();
  }
}
