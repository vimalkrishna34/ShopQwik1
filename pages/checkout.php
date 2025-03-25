<?php include '../includes/header.php'; ?>
<?php include '../includes/arrays.php'; ?>

<div class="max-w-6xl mx-auto p-6 bg-white rounded-lg shadow-lg" style="margin-top: 80px;">
    <h2 class="text-3xl font-semibold mb-6">Checkout</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Left: Contact, Delivery, Shipping, Payment -->
        <div class="space-y-6">
            <!-- Contact Information -->
            <div class="p-4 border rounded-lg">
                <h3 class="text-xl font-semibold mb-3">Contact Information</h3>
                <input type="text" placeholder="First Name" class="w-full border p-2 rounded-md mb-2">
                <input type="text" placeholder="Last Name" class="w-full border p-2 rounded-md mb-2">
                <input type="email" placeholder="Email Address" class="w-full border p-2 rounded-md mb-2">
                <input type="text" placeholder="Phone Number" class="w-full border p-2 rounded-md">
            </div>

            <!-- Delivery Method -->
            <div class="p-4 border rounded-lg">
                <h3 class="text-xl font-semibold mb-3">Delivery Method</h3>
                <label class="flex items-center space-x-2">
                    <input type="radio" name="delivery" value="standard" checked>
                    <span>Standard delivery (2-5 days) - FREE</span>
                </label>
                <label class="flex items-center space-x-2 mt-2">
                    <input type="radio" name="delivery" value="express">
                    <span>Express delivery (1-2 days) - ₹199</span>
                </label>
            </div>

            <!-- Shipping Information -->
            <div class="p-4 border rounded-lg">
                <h3 class="text-xl font-semibold mb-3">Shipping Information</h3>
                <input type="text" placeholder="Street Address" class="w-full border p-2 rounded-md mb-2">
                <input type="text" placeholder="City" class="w-full border p-2 rounded-md mb-2">
                <input type="text" placeholder="Postal Code" class="w-full border p-2 rounded-md">
            </div>

            <!-- Payment Method -->
            <div class="p-4 border rounded-lg">
                <h3 class="text-xl font-semibold mb-3">Payment Method</h3>
            
                <label class="flex items-center space-x-2 mt-3">
                    <input type="radio" name="payment" value="cod">
                    <span>Cash on Delivery</span>
                </label>
            </div>
        </div>

        <!-- Right: Order Summary -->
        <div class="p-4 border rounded-lg">
            <h3 class="text-xl font-semibold mb-4">Order Summary</h3>
            <div class="space-y-4">
                <div class="flex justify-between">
                    <span>Jacket</span>
                    <span>₹1500</span>
                </div>
            </div>
            <hr class="my-4">
            <div class="flex justify-between font-semibold">
                <span>Subtotal</span>
                <span>₹3098</span>
            </div>
            <div class="flex justify-between">
                <span>Delivery</span>
                <span>₹0 (Free)</span>
            </div>
            <hr class="my-4">
            <div class="flex justify-between text-lg font-bold">
                <span>Total</span>
                <span>₹3098</span>
            </div>
            <button type="submit" name="place_order" class="w-full bg-yellow-500 text-white py-2 rounded-lg mt-4 hover:bg-yellow-600 transition">
                Place Now
            </button>
        </div>
    </div>

    <?php
    if (isset($_POST['place_order'])) {
        echo "<p class='mt-4 text-green-600 font-semibold text-center'>✅ Order Placed Successfully!</p>";
    }
    ?>
</div>

<?php include '../includes/footer.php'; ?>