<?php

namespace App\Traits;

use App\Services\IdempotencyService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

trait HasIdempotency
{

    public $idempotencyKey;
    //Livewire has a special naming convention for trait initialization
    // Livewire looks for methods named initialize{TraitName} and calls them automatically when the component boots.

    public function initializeHasIdempotency()
    {
        $this->idempotencyKey = Str::uuid()->toString();
    }

    protected function withIdempotency($action, $callback)
    {
        return app(IdempotencyService::class)->process($this->idempotencyKey, $action, $callback);
    }

    protected function resetIdempotencyKey()
    {
        $this->idempotencyKey = Str::uuid()->toString();
    }
}
