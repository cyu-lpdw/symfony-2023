<?php

namespace App\Service;

use App\Entity\Item;

class ItemService {
    public function generateAmount(Item $item) {
        $item->setAmount($item->getProduct()->getPrice() * $item->getQuantity());
        $this->generateTaxAmount($item);
    }

    public function generateTaxAmount(Item $item) {
        $item->setTaxAmount($item->getAmount() - $item->getAmount()/(1 + $item->getProduct()->getTax() / 10000));
    }
}