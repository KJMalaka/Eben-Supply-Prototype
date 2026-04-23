@extends('layouts.app')
{{-- PRT362S — Eben Supply | Group KN3 --}}
@section('title', 'Order Confirmed')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

    {{-- Success header --}}
    <div class="text-center mb-10">
        <div class="w-20 h-20 bg-emerald-50 border-2 border-emerald-200 rounded-full flex items-center justify-center mx-auto mb-5">
            <svg class="w-10 h-10 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
        </div>
        <p class="section-label justify-center flex mb-2">Payment Confirmed</p>
        <h1 class="section-title text-center mb-2">Order Placed!</h1>
        <p class="text-stone-400 text-sm">We've received your order and will process it shortly.</p>
    </div>

    {{-- Order card --}}
    <div class="card p-6 mb-5">
        <div class="flex items-center justify-between mb-5 pb-5 border-b border-stone-100">
            <div>
                <p class="text-xs text-stone-400 font-heading uppercase tracking-wider mb-1">Reference</p>
                <p class="font-heading font-black text-[#333333] text-lg">{{ $order->payment_reference }}</p>
            </div>
            <span class="badge bg-amber-100 text-amber-800">Pending</span>
        </div>

        <div class="space-y-4 mb-5">
            @foreach($order->items as $item)
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 rounded-xl overflow-hidden bg-[#F5F5F5] flex-shrink-0">
                        <img src="{{ asset($item->product->image_path ?: 'images/products/placeholder.jpg') }}" alt="" class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-heading font-semibold text-sm text-[#333333] truncate">{{ $item->product->name }}</p>
                        @if($item->size)<p class="text-xs text-stone-400">Size: {{ $item->size }}</p>@endif
                        <p class="text-xs text-stone-400">Qty: {{ $item->quantity }}</p>
                    </div>
                    <p class="font-heading font-bold text-sm text-[#333333]">R{{ number_format($item->line_total, 2) }}</p>
                </div>
            @endforeach
        </div>

        @php $subtotal = $order->items->sum('line_total'); @endphp
        <div class="border-t border-stone-100 pt-4 space-y-2 text-sm">
            <div class="flex justify-between text-stone-500"><span>Subtotal</span><span>R{{ number_format($subtotal, 2) }}</span></div>
            <div class="flex justify-between text-stone-500"><span>Delivery</span><span>{{ $order->fulfillment === 'delivery' ? 'R60.00' : 'Free (Pickup)' }}</span></div>
            <div class="flex justify-between font-heading font-black text-base border-t border-stone-100 pt-2">
                <span>Total Paid</span><span>R{{ number_format($order->total_amount, 2) }}</span>
            </div>
        </div>
    </div>

    {{-- Fulfilment --}}
    <div class="card p-5 mb-8 bg-[#F5F5F5] border-0">
        <h3 class="font-heading font-bold text-sm text-[#A3A380] uppercase tracking-wider mb-3">
            {{ $order->fulfillment === 'pickup' ? 'Pickup Info' : 'Delivery Info' }}
        </h3>
        @if($order->fulfillment === 'pickup')
            <p class="text-sm text-stone-600">Ready for collection at our <strong class="text-[#333333]">Woodstock, Cape Town</strong> store. We'll notify you when ready.</p>
        @else
            <p class="text-sm text-stone-500 mb-1">Delivering to:</p>
            <p class="text-sm text-[#333333] font-medium">{{ $order->delivery_address }}</p>
            <p class="text-xs text-stone-400 mt-1">Est. 3–5 business days</p>
        @endif
        <div class="border-t border-stone-200 mt-4 pt-4 grid grid-cols-1 gap-1 text-xs text-stone-500">
            <span>{{ $order->contact_name }} · {{ $order->contact_phone }} · {{ $order->contact_email }}</span>
        </div>
    </div>

    <div class="flex flex-col sm:flex-row gap-3">
        <a href="{{ route('orders.show', $order) }}" class="btn-primary flex-1 py-3.5 justify-center text-sm">Track Order</a>
        <a href="{{ route('products.index') }}" class="btn-secondary flex-1 py-3.5 justify-center text-sm">Continue Shopping</a>
    </div>
</div>
@endsection
