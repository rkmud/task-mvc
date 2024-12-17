<?php

namespace App\observer;

class Logger implements Observer {
    public function update(string $event, array $data): void
    {
        echo ("Logger: событие '$event', данные: " . json_encode($data) . "<br>");
    }
}
