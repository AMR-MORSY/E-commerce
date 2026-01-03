<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\IdempotencyKey;
use Illuminate\Support\Facades\DB;

class IdempotencyService
{
    public function process(string $key,string $action, callable $callback )
    {
        $this->cleanExpiredKeys();

          // Check if this idempotency key already exists
          return DB::transaction(function () use ($key, $action, $callback) {
            
            // ✅ Use lockForUpdate to prevent race conditions
            $existingKey = IdempotencyKey::where('key', $key)
                ->where('action', $action)
                ->lockForUpdate() // CRITICAL: Lock the row
                ->first();

            if ($existingKey) {
                // Return cached response
                return $existingKey->response;
            }

            // Execute the callback
            $response = $callback();

            // Store the result
            IdempotencyKey::create([
                'key' => $key,
                'action' => $action,
                'response' => $response,
                'expires_at' => Carbon::now()->addHours(24),
            ]);

            return $response;
        });

    }

    protected function cleanExpiredKeys()
    {
        $expiredKeys=IdempotencyKey::where('expires_at','<',Carbon::now())->delete();
    }
}