<?php

namespace App\Observers;

use App\Models\ProductSubscription;

class ProductSubscriptionObserver
{
    public function creating(ProductSubscription $subscription)
    {
        $subscription->booking_trx_id = $subscription->booking_trx - id ?? $this->generateUniqueTrxId();
    }

    public function generateUniqueTrxId(): string
    {
        $prefix = 'NSTORE';
        do {
            $randomString = $prefix . mt_rand(1000, 9999);
        } while (ProductSubscription::where('booking_trx_id', $randomString)->exists());

        return $randomString;
    }



    /**
     * Handle the ProductSubscription "created" event.
     */
    public function created(ProductSubscription $productSubscription): void
    {
        //
    }

    /**
     * Handle the ProductSubscription "updated" event.
     */
    public function updated(ProductSubscription $productSubscription): void
    {
        //
    }

    /**
     * Handle the ProductSubscription "deleted" event.
     */
    public function deleted(ProductSubscription $productSubscription): void
    {
        //
    }

    /**
     * Handle the ProductSubscription "restored" event.
     */
    public function restored(ProductSubscription $productSubscription): void
    {
        //
    }

    /**
     * Handle the ProductSubscription "force deleted" event.
     */
    public function forceDeleted(ProductSubscription $productSubscription): void
    {
        //
    }
}
