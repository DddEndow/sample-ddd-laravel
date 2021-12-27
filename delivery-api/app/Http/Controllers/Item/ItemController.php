<?php

declare(strict_types=1);

namespace App\Http\Controllers\Item;

use App\Http\Controllers\Controller;
use App\Http\Views\Item\ItemListView;
use App\UseCases\Item\ListItemsUseCase;

class ItemController extends Controller
{
    public function index(ListItemsUseCase $useCase): ItemListView
    {
        $items = $useCase->invoke();
        return ItemListView::of($items);
    }
}
