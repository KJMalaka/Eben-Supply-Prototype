<?php

namespace Tests\Feature;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderFlowTest extends TestCase
{
    use RefreshDatabase;

    private function makeProduct(): Product
    {
        return Product::create([
            'name' => 'Relaxed Fit Tee',
            'description' => 'Test tee',
            'category' => 'tshirt',
            'price' => 349.00,
            'stock_quantity' => 10,
            'is_featured' => false,
        ]);
    }

    public function test_guest_cannot_access_checkout(): void
    {
        $response = $this->get('/checkout');

        $response->assertRedirect(route('login'));
    }

    public function test_admin_can_update_order_status(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $customer = User::factory()->create();

        $order = Order::create([
            'user_id' => $customer->id,
            'status' => 'pending',
            'fulfillment' => 'pickup',
            'total_amount' => 349.00,
            'contact_name' => 'Test Customer',
            'contact_phone' => '0761234567',
            'contact_email' => 'test@example.com',
        ]);

        $response = $this->actingAs($admin)
            ->put("/admin/orders/{$order->id}/status", ['status' => 'confirmed']);

        $response->assertRedirect();
        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'status' => 'confirmed',
        ]);
    }

    public function test_placed_order_creates_order_items(): void
    {
        $user = User::factory()->create();
        $product = $this->makeProduct();

        CartItem::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'size' => 'S',
            'quantity' => 2,
        ]);

        // Step 1: checkout details are staged in the session, not yet an order.
        $this->actingAs($user)->post('/checkout', [
            'contact_name' => 'Test Customer',
            'contact_phone' => '0761234567',
            'contact_email' => 'test@example.com',
            'fulfillment' => 'pickup',
        ])->assertRedirect(route('checkout.payment'));

        // Step 2: confirming payment is what actually creates the order.
        $response = $this->actingAs($user)->post('/checkout/payment');

        $response->assertRedirect(route('order.confirmation'));

        $order = Order::where('user_id', $user->id)->first();

        $this->assertNotNull($order);
        $this->assertSame('pickup', $order->fulfillment);
        $this->assertEquals(698.00, $order->total_amount);

        $this->assertDatabaseHas('order_items', [
            'order_id' => $order->id,
            'product_id' => $product->id,
            'size' => 'S',
            'quantity' => 2,
            'unit_price' => 349.00,
        ]);

        $this->assertDatabaseCount('cart_items', 0);
    }
}
