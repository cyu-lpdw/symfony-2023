<?php

namespace App\Service;

use App\Repository\OrderRepository;
use App\Entity\Order;

class OrderService {
    private $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function generateNumber(Order $order) {
        $lastOrder = $this->orderRepository->findByLastCreatedAt();

            if ($lastOrder) {
                $digits = [];
                $chars = [];
                preg_match('/[0-9]+$/', $lastOrder->getNumber(), $digits);
                preg_match('/^[A-Z]+/', $lastOrder->getNumber(), $chars);
                $digitPart = $digits[0];
                $charPart = $chars[0];
                
                if ($digitPart == 99) {
                    $charPart++;
                    $digitPart = 1;
                } else {
                    $digitPart++;
                }
            } else {
                $digitPart = 1;
                $charPart = 'A';
            }
            
            $order->setNumber($charPart . $digitPart);
    }
}