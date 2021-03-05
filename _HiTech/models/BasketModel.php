<?php

class BasketModel extends ModelManager
{
    public function __construct()
    {
      if(!isset($_SESSION['basket']))
      {
        $_SESSION['basket'] = [];
      }
    }
    
    public function addProduct( $product , $quantity )
    {
      $addedProduct = [ 'product' => $product , 'quantity' => $quantity ];
      $productId = $product['ProductID'];
        
        $found = false;
        foreach( $_SESSION['basket'] as $i => $item )
        {
            if( $item['product']['ProductID'] == $productId )
            {
                $_SESSION['basket'][$i]['quantity'] += $quantity;
                $found = true;
            }
        }
        if( $found == false )
        {
            array_push($_SESSION['basket'] , $addedProduct );
        }
    }
    
    public function removeProduct( $product )
    {
        
    }
    
    public function getTotalPrice()
    {
        
    }
}

?>