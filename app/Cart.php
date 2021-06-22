<?php

namespace App;

class Cart
{
  /**
   * @var mixed
   */
  public $items = null;
  /**
   * @var int
   */
  public $total_qty = 0;
  /**
   * @var int
   */
  public $total_price = 0;

  /**
   * @param $old_cart
   */
  public function __construct($old_cart)
  {
    if ($old_cart)
    {
      $this->items       = $old_cart->items;
      $this->total_qty   = $old_cart->total_qty;
      $this->total_price = $old_cart->total_price;
    }
  }

  /**
   * @param $item
   * @param $product_id
   */
  public function add($item, $product_id)
  {
    $store_item = [
      'qty'           => 0,
      'product_id'    => 0,
      'product_name'  => $item->product_name,
      'product_price' => $item->product_price,
      'product_image' => $item->product_image,
      'item'          => $item
    ];

    if ($this->items)
    {
      if (array_key_exists($product_id, $this->items))
      {
        $store_item = $this->items[$product_id];
      }
    }

    $store_item['qty']++;
    $store_item['product_id']    = $product_id;
    $store_item['product_name']  = $item->product_name;
    $store_item['product_price'] = $item->product_price;
    $store_item['product_image'] = $item->product_image;

    $this->total_qty++;
    $this->total_price += $item->product_price;
    $this->items[$product_id] = $store_item;
  }

  /**
   * @param $id
   * @param $qty
   */
  public function update_qty($id, $qty)
  {
    $this->total_qty -= $this->items[$id]['qty'];
    $this->total_price -= $this->items[$id]['product_price'] * $this->items[$id]['qty'];
    $this->items[$id]['qty'] = $qty;
    $this->total_qty += $qty;
    $this->total_price += $this->items[$id]['product_price'] * $qty;
  }

  /**
   * @param $id
   */
  public function remove_item($id)
  {
    $this->total_qty -= $this->items[$id]['qty'];
    $this->total_price -= $this->items[$id]['product_price'] * $this->items[$id]['qty'];
    unset($this->items[$id]);
  }
}
