<?php

declare(strict_types=1);

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Views\Order\OrderListView;
use Delivery\App\UseCases\Order\ListOrdersUseCase;

class OrderController extends Controller
{
    public function index(ListOrdersUseCase $useCase): OrderListView
    {
        $orders = $useCase->invoke();
        return OrderListView::of($orders);
    }
}
