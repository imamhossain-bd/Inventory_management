<?php

namespace App\Console\Commands;

use App\Models\ExpireProduct;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Console\Command;

class MoveExpiredProducts extends Command
{

    protected $signature = 'products:move-expired';


    protected $description = 'Move expired products to expire_products table automatically';


    public function handle()
    {
        $today = Carbon::today();

        $expiredProducts = Product::whereDate('expire_date', '<', $today)->get();

        foreach($expiredProducts as $product){
            ExpireProduct::create([
                'prduct_id' => $product->id,
                'name'              => $product->name,
                'sku'               => $product->sku,
                'manufacturer_date' => $product->manufacturer_date,
                'expire_date'       => $product->expire_date,
                'images'            => $product->images,
                'selling_price'     => $product->selling_price,
                'stock'             => $product->stock,
                'remarks'           => 'Auto moved because of expiration date.',
            ]);

            $product->delete();
        }

        $this->info('✅ Expired products moved successfully.');
    }
}
