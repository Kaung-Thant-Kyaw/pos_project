@extends('users.layouts.master')

@section('content')
    <!-- Cart Page Start -->
    <div class="container-fluid mt-5 py-5">
        <div class="container py-5">
            <div class="table-responsive">
                <table class="table" id="productTable">
                    <thead>
                        <tr>
                            <th scope="col">Products</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <input type="hidden" id="userId" value="{{ Auth::user()->id }}">
                        @foreach ($cart as $item)
                            <tr>
                                <th scope="row">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('products/' . $item->image) }}"
                                            class="img-fluid rounded-circle me-5 object-cover"
                                            style="width: 80px; height: 80px;" alt="">
                                    </div>
                                </th>
                                <td>
                                    <p class="mb-0 mt-4">{{ $item->name }}</p>
                                </td>
                                <td>
                                    <p class="price mb-0 mt-4"> {{ $item->price }} mmk</p>
                                </td>
                                <td>
                                    <div class="input-group quantity mt-4" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-minus rounded-circle bg-light border">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm qty border-0 text-center"
                                            value="{{ $item->qty }}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="total mb-0 mt-4">{{ $item->price * $item->qty }} mmk</p>
                                </td>
                                <td>
                                    <input type="hidden" class="cartId" value="{{ $item->cart_id }}">
                                    <input type="hidden" class="productId" value="{{ $item->product_id }}">
                                    <button class="btn btn-md btn-remove rounded-circle bg-light mt-4 border">
                                        <i class="fa fa-times text-danger"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row g-4 justify-content-end">
                <div class="col-8"></div>
                <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                    <div class="bg-light rounded">
                        <div class="p-4">
                            <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                            <div class="d-flex justify-content-between mb-4">
                                <h5 class="mb-0 me-4">Subtotal:</h5>
                                <p class="mb-0" id="subtotal">{{ $total }} mmk</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5 class="mb-0 me-4">Delivery Fees</h5>
                                <div class="">
                                    <p class="mb-0">5000 mmk</p>
                                </div>
                            </div>
                        </div>
                        <div class="border-top border-bottom d-flex justify-content-between mb-4 py-4">
                            <h5 class="mb-0 me-4 ps-4">Total</h5>
                            <p class="mb-0 pe-4" id="finalTotal">{{ $total + 5000 }} mmk</p>
                        </div>
                        <button class="btn border-secondary rounded-pill text-primary text-uppercase mb-4 ms-4 px-4 py-3"
                            id="btn-checkout" type="button" {{ count($cart) == 0 ? 'disabled' : '' }}>Proceed
                            Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart Page End -->

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white-50 footer mt-5 pt-5">
        <div class="container py-5">
            <div class="mb-4 pb-4" style="border-bottom: 1px solid rgba(226, 175, 24, 0.5) ;">
                <div class="row g-4">
                    <div class="col-lg-3">
                        <a href="#">
                            <h1 class="text-primary mb-0">Fruitables</h1>
                            <p class="text-secondary mb-0">Fresh products</p>
                        </a>
                    </div>
                    <div class="col-lg-6">
                        <div class="position-relative mx-auto">
                            <input class="form-control w-100 rounded-pill border-0 px-4 py-3" type="number"
                                placeholder="Your Email">
                            <button type="submit"
                                class="btn btn-primary border-secondary position-absolute rounded-pill border-0 px-4 py-3 text-white"
                                style="top: 0; right: 0;">Subscribe Now</button>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="d-flex justify-content-end pt-3">
                            <a class="btn btn-outline-secondary btn-md-square rounded-circle me-2" href=""><i
                                    class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-secondary btn-md-square rounded-circle me-2" href=""><i
                                    class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-secondary btn-md-square rounded-circle me-2" href=""><i
                                    class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-secondary btn-md-square rounded-circle" href=""><i
                                    class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item">
                        <h4 class="text-light mb-3">Why People Like us!</h4>
                        <p class="mb-4">typesetting, remaining essentially unchanged. It was
                            popularised in the 1960s with the like Aldus PageMaker including of Lorem Ipsum.</p>
                        <a href="" class="btn border-secondary rounded-pill text-primary px-4 py-2">Read More</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex flex-column footer-item text-start">
                        <h4 class="text-light mb-3">Shop Info</h4>
                        <a class="btn-link" href="">About Us</a>
                        <a class="btn-link" href="">Contact Us</a>
                        <a class="btn-link" href="">Privacy Policy</a>
                        <a class="btn-link" href="">Terms & Condition</a>
                        <a class="btn-link" href="">Return Policy</a>
                        <a class="btn-link" href="">FAQs & Help</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex flex-column footer-item text-start">
                        <h4 class="text-light mb-3">Account</h4>
                        <a class="btn-link" href="">My Account</a>
                        <a class="btn-link" href="">Shop details</a>
                        <a class="btn-link" href="">Shopping Cart</a>
                        <a class="btn-link" href="">Wishlist</a>
                        <a class="btn-link" href="">Order History</a>
                        <a class="btn-link" href="">International Orders</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-item">
                        <h4 class="text-light mb-3">Contact</h4>
                        <p>Address: 1429 Netus Rd, NY 48247</p>
                        <p>Email: Example@gmail.com</p>
                        <p>Phone: +0123 4567 8910</p>
                        <p>Payment Accepted</p>
                        <img src="img/payment.png" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Copyright Start -->
    <div class="container-fluid copyright bg-dark py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-md-start mb-md-0 mb-3 text-center">
                    <span class="text-light"><a href="#"><i class="fas fa-copyright text-light me-2"></i>Your Site
                            Name</a>, All right reserved.</span>
                </div>
                <div class="col-md-6 text-md-end my-auto text-center text-white">
                    <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                    <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                    <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                    Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a> Distributed By <a
                        class="border-bottom" href="https://themewagon.com">ThemeWagon</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i
            class="fa fa-arrow-up"></i></a>
@endsection

@section('js-section')
    <script>
        $(document).ready(function() {
            // plus button
            $('.btn-plus').click(function() {
                $parentNode = $(this).parents("tr");
                $price = $parentNode.find(".price").text().replace("mmk", "");
                $qty = $parentNode.find(".qty").val();
                $totalAmt = $price * $qty;
                $parentNode.find('.total').text($totalAmt + "mmk");
                finalCalculation();
            });

            // minus button
            $('.btn-minus').click(function() {
                $parentNode = $(this).parents("tr");
                $price = $parentNode.find(".price").text().replace("mmk", "");
                $qty = $parentNode.find(".qty").val();
                $totalAmt = $price * $qty;
                $parentNode.find('.total').text($totalAmt + "mmk");
                finalCalculation();
            });

            function finalCalculation() {
                $total = 0;
                $("#productTable tbody tr").each(function(index, item) {
                    $total += parseInt($(item).find(".total").text().replace("mmk", ""), 10);
                })
                $('#subtotal').html(`${$total} mmk`);
                $('#finalTotal').html(`${$total+5000} mmk`);
            }

            // When click remove button
            $(".btn-remove").click(function() {
                $parentNode = $(this).parents("tr");
                $cartId = $parentNode.find('.cartId').val();
                $data = {
                    cartId: $cartId
                }

                // send an Ajax request to remove the cart item
                $.ajax({
                    type: 'get',
                    url: "/user/product/cart/delete",
                    data: $data,
                    dataType: 'json',
                    success: function(response) {
                        response.status == 'success' ? location.reload() : '';
                    }
                })
            })

            // Proceed checkout with Ajax
            $("#btn-checkout").click(function() {
                let orderList = [];
                let orderCode = "CL-POS-" + Math.floor(Math.random() * 1000000000);
                let userId = $("#userId").val();
                let totalAmount = parseInt($("#finalTotal").text().replace("mmk", ""), 10);



                $("#productTable tbody tr").each(function() {
                    let productId = $(this).find(".productId").val();
                    let qty = $(this).find(".qty").val();

                    if (productId && qty) {
                        orderList.push({
                            user_id: userId,
                            product_id: productId,
                            qty: qty,
                            total_amt: totalAmount,
                            order_code: orderCode,
                        });
                    }
                });

                console.log(orderList);

                $.ajax({
                    type: 'GET',
                    url: '/user/cart/temp',
                    data: Object.assign({}, orderList),
                    dataType: 'json',
                    success: function(res) {
                        if (res.status == 'success') {
                            location.href = '/user/payment';
                        }
                    }

                });
            });

        });
    </script>
@endsection
