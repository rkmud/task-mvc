<?php

namespace App\observer;

interface Subject
{
    public function attach(Observer $observer): void;
    public function detach(Observer $observer): void;
    public function notify(string $event, array $data): void;
}
