<?php

declare (strict_types = 1);

namespace App\observer;

use App\dataProviders\ArrayProductsDataProvider;
use App\exceptions\InvalidValueException;

class Cart implements Subject
{
    private array $items = [];
    private array $observers = [];
    private ArrayProductsDataProvider $productProvider;

    public function __construct(ArrayProductsDataProvider $productProvider)
    {
        $this->productProvider = $productProvider;
    }

    public function attach(Observer $observer): void
    {
        $this->observers[] = $observer;
    }

    public function detach(Observer $observer): void
    {
        $this->observers = array_filter($this->observers, fn($obs) => $obs !== $observer);
    }

    public function notify(string $event, array $data): void
    {
        foreach ($this->observers as $observer) {
            $observer->update($event, $data);
        }
    }

    public function addItem(int $productId): void
    {
        $products = $this->productProvider->getProducts();

        if (!isset($products[$productId])) {
            throw new InvalidValueException("Product with ID $productId not found.\n");
        }

        $this->items[$productId] = $products[$productId];
        $this->notify('item_added', ['item' => $products[$productId], 'items' => $this->items]);
    }

    public function removeItem(int $productId): void
    {
        if ( !isset($this->items[$productId]) ) {
            throw new InvalidValueException("Product with ID $productId not found.\n");
        }

        $removedItem = $this->items[$productId];
        unset($this->items[$productId]);
        $this->notify('item_removed', ['item' => $removedItem, 'items' => $this->items]);
    }

    public function getItems(): array
    {
        return $this->items;
    }
}
