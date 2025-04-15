@extends('users.layouts.master')

@section('content')
    <!-- Single Product Start -->
    <div class="container-fluid mt-5 py-5">
        <div class="container py-5">
            <div class="row g-4 mb-5">
                <div class="col-lg-8 col-xl-9">
                    <span class="my-2">
                        <a href="{{ route('userHome') }}">Home</a> <i class="fa fa-greater-than mx-1 mb-2"></i> Details
                    </span>
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="rounded border">
                                <a href="#">
                                    <img src="{{ asset('products/' . $product->image) }}" class="img-fluid rounded"
                                        alt="Image">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h4 class="fw-bold mb-3">{{ $product->name }}</h4>
                            <p class="{{ $product->available_stock < 3 ? 'text-danger' : '' }} mb-3">
                                Available Stock : {{ $product->available_stock }}
                                @if ($product->available_stock < 3)
                                    items only left!
                                @endif
                            </p>
                            <p class="mb-3">Category: {{ $product->category_name }}</p>
                            <h5 class="fw-bold mb-3">{{ $product->price }} mmk</h5>
                            <div class="d-flex align-items-center mb-4 gap-2">
                                <div class="">
                                    @php
                                        $stars = number_format($rating);
                                    @endphp
                                    @for ($i = 1; $i <= $stars; $i++)
                                        <i class="fa fa-star text-secondary"></i>
                                    @endfor
                                    @for ($j = $stars + 1; $j <= 5; $j++)
                                        <i class="fa fa-star"></i>
                                    @endfor
                                </div>
                                <div class="">
                                    <i class="fa-solid fa-eye"></i> {{ $unique_views }} people watch this product!
                                </div>
                            </div>
                            <p class="mb-4">{{ $product->description }}</p>
                            <form action="{{ route('user.product.addToCart') }}" method="POST">
                                @csrf
                                <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="productId" value="{{ $product->id }}">
                                <div class="input-group quantity mb-5" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-minus rounded-circle bg-light border">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" name="count"
                                        class="form-control form-control-sm border-0 text-center" value="1"
                                        min="1" max="{{ $product->available_stock }}">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-plus rounded-circle bg-light border">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>

                                <button type="submit"
                                    class="btn border-secondary rounded-pill text-primary mb-4 border px-4 py-2"><i
                                        class="fa fa-shopping-bag text-primary me-2"></i> Add to cart
                                </button>
                            </form>

                            <!-- Modal Trigger Button -->
                            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                class="btn border-primary rounded-pill text-primary mb-4 border px-4 py-2">
                                <i class="fa-solid fa-star text-secondary me-2"></i> Rate this product
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form action="{{ route('user.product.rating') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="productId" value="{{ $product->id }}">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Rate this product</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="rating-css">
                                                    <div class="star-icon">
                                                        @if ($user_rating == 0)
                                                            <input type="radio" value="1" name="productRating"
                                                                checked id="rating1">
                                                            <label for="rating1" class="fa fa-star"></label>
                                                            <input type="radio" value="2" name="productRating"
                                                                id="rating2">
                                                            <label for="rating2" class="fa fa-star"></label>
                                                            <input type="radio" value="3" name="productRating"
                                                                id="rating3">
                                                            <label for="rating3" class="fa fa-star"></label>
                                                            <input type="radio" value="4" name="productRating"
                                                                id="rating4">
                                                            <label for="rating4" class="fa fa-star"></label>
                                                            <input type="radio" value="5" name="productRating"
                                                                id="rating5">
                                                            <label for="rating5" class="fa fa-star"></label>
                                                        @else
                                                            @php
                                                                $userRating = number_format($user_rating);
                                                            @endphp
                                                            @for ($i = 1; $i <= $userRating; $i++)
                                                                <input type="radio" value="{{ $i }}"
                                                                    name="productRating" id="rating{{ $i }}"
                                                                    checked>
                                                                <label for="rating{{ $i }}"
                                                                    class="fa fa-star"></label>
                                                            @endfor
                                                            @for ($j = $userRating + 1; $j <= 5; $j++)
                                                                <input type="radio" value="{{ $j }}"
                                                                    name="productRating" id="rating{{ $j }}">
                                                                <label for="rating{{ $j }}"
                                                                    class="fa fa-star"></label>
                                                            @endfor
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Rate</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <nav>
                    <div class="nav nav-tabs mb-3">
                        <button class="nav-link active border-bottom-0 border-white" type="button" role="tab"
                            id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about"
                            aria-controls="nav-about" aria-selected="true">Description</button>
                        <button class="nav-link border-bottom-0 border-white" type="button" role="tab"
                            id="nav-mission-tab" data-bs-toggle="tab" data-bs-target="#nav-mission"
                            aria-controls="nav-mission" aria-selected="false">Comments
                            <span class="btn btn-danger btn-sm rounded-sm-circle">
                                {{ count($comments) }}
                            </span>
                        </button>
                    </div>
                </nav>
                <div class="tab-content mb-5">
                    <div class="tab-pane active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                        <p>{{ $product->description }}</p>

                    </div>
                    <div class="tab-pane" id="nav-mission" role="tabpanel" aria-labelledby="nav-mission-tab">
                        @foreach ($comments as $comment)
                            <div class="d-flex align-items-start mb-4">
                                <!-- Profile Picture -->
                                <img src="{{ asset($comment->user_profile == null ? 'admins/img/undraw_profile.svg' : 'profiles/' . $comment->user_profile) }}"
                                    class="img-fluid rounded-circle border-secondary me-3 border"
                                    style="width: 80px; height: 80px; object-fit: cover;" alt="User Profile">

                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h6 class="text-primary mb-1">{{ $comment->user_name }}</h6>
                                            <p class="text-muted mb-2" style="font-size: 12px;">
                                                {{ $comment->created_at->format('j-F-Y h:i A') }}
                                            </p>
                                        </div>

                                        @if ($comment->user_id == Auth::user()->id)
                                            <div>
                                                <a href="{{ route('user.product.commentDelete', Auth::user()->id) }}"
                                                    class="btn btn-outline-danger btn-sm">
                                                    <i class="fa-solid fa-trash"></i>
                                                </a>
                                            </div>
                                        @endif
                                    </div>

                                    <p class="mb-0">{{ $comment->message }}</p>
                                </div>
                            </div>
                            <hr>
                        @endforeach

                    </div>
                    <div class="tab-pane" id="nav-vision" role="tabpanel">
                        <p class="text-dark">Tempor erat elitr rebum at clita. Diam dolor diam ipsum et tempor
                            sit. Aliqu diam
                            amet diam et eos labore. 3</p>
                        <p class="mb-0">Diam dolor diam ipsum et tempor sit. Aliqu diam amet diam et eos
                            labore.
                            Clita erat ipsum et lorem et sit</p>
                    </div>
                </div>
            </div>
            <form action="{{ route('user.product.comment') }}" method="POST">
                @csrf
                <h4 class="fw-bold mb-5">Write Comments</h4>

                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <div class="row g-1">
                    <div class="col-lg-12">
                        <div class="border-bottom my-4 rounded">
                            <textarea name="comment" id="" class="form-control border-0 shadow-sm" cols="30" rows="8"
                                placeholder="Share your thoughts..." spellcheck="false"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="d-flex justify-content-between mb-5 py-3">
                            {{-- <div class="d-flex align-items-center">
                                            <p class="mb-0 me-3">Please rate:</p>
                                            <div class="d-flex align-items-center" style="font-size: 12px;">
                                                <i class="fa fa-star text-muted"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div> --}}
                            <button type="submit"
                                class="btn border-secondary text-primary rounded-pill border px-4 py-3"> Post
                                Comment</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    </div>
    @if (count($relatedProducts))
        <h1 class="fw-bold mb-3">Related products</h1>
    @endif
    <div class="vesitable">
        <div
            class="{{ $relatedProducts->count() >= 3 ? 'owl-carousel vegetable-carousel justify-content-center' : 'd-flex justify-content-start flex-wrap' }}">
            @foreach ($relatedProducts as $relatedProduct)
                <div class="border-primary position-relative vesitable-item mx-2 rounded border" style="width: 300px;">
                    <div class="vesitable-img">
                        <img src="{{ asset('products/' . $relatedProduct->image) }}" class="img-fluid w-100 rounded-top"
                            alt="{{ $relatedProduct->name }}" style="height: 200px;">
                    </div>
                    <div class="bg-primary position-absolute rounded px-3 py-1 text-white"
                        style="top: 10px; right: 10px;">{{ $relatedProduct->category_name }}</div>
                    <div class="rounded-bottom p-4 pb-0">
                        <h4>{{ $relatedProduct->name }}</h4>
                        <p>{{ Str::words($relatedProduct->description, 10, '...') }}</p>
                        <div class="d-flex justify-content-between flex-lg-wrap">
                            <p class="text-dark fs-5 fw-bold">{{ $relatedProduct->price }} mmk</p>
                            <a href="#"
                                class="btn border-secondary rounded-pill text-primary mb-4 border px-3 py-1">
                                <i class="fa fa-shopping-bag text-primary me-2"></i> Add to cart
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    </div>
    </div>
    <!-- Single Product End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i
            class="fa fa-arrow-up"></i></a>
@endsection
