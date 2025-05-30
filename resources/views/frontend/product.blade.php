@extends('frontend.master')
@section('title',  config('app.name') . " | " . $product->full_name)
<style>
    .fa-star {
        color: grey;
        cursor: pointer;
        transition: color 0.3s ease;
    }
    .fa-star.selected {
        color: #fbd600;
    }
</style>
@section('banner')
    <!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>{{ $product->full_name }}</h1>
                    <nav class="d-flex align-items-center">
                        <a href="{{ route('frontend.index') }}">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="{{ route('frontend.contact') }}">Shop<span class="lnr lnr-arrow-right"></span></a>
                        <a href="{{ route('frontend.contact') }}">{{ $product->category->name }}</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->
@endsection

@section('content')
    <!--================Single Product Area =================-->
    <div class="product_image_area">
        <div class="container">
            <div class="row s_product_inner">
                <div class="col-lg-6">
                    <div class="s_Product_carousel">
                        @if(count($product->images) > 0)
                                <div class="single-prd-item">
                                    <img class="img-fluid" src="{{ asset($product->images->first()->path) }}" alt="">
                                </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1">
                    <div class="s_product_text">
                        <h3>{{ $product->full_name }}</h3>
                        <h2>{{Number::currency($product->price,'EGP')}}</h2>
                        <ul class="list">
                            <li><span>Category</span> : <a href="#">{{ $product->category->name }}</a></li>
                            <li><span>Availability</span> : @if($product->qty > 0) {{ $product->qty  }} In Stock @else Out Of Stock @endif </li>
                            <li><span>Color</span> : {{ $product->color }}</li>
                        </ul>
                        <div class="product_count mt-5">
                            <label for="qty">Quantity:</label>
                            <input type="text" name="qty" id="sst" maxlength="12" value="1" title="Quantity:" class="input-text qty">
                            <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                                    class="increase items-count" type="button"><i class="lnr lnr-chevron-up"></i></button>
                            <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
                                    class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>
                        </div>
                        <div class="card_area d-flex align-items-center">
                            <a href="" class="primary-btn addToCart3"
                               data-product-id="{{ route('frontend.cart.add', $product->id) }}"
                               data-quantity-selector="#sst">Add to Cart</a>
                            <a href="" class=" ml-2 addToWishlist3" data-product-id="{{ route('frontend.wishlist.add', $product->id) }}">
                                <span class="lnr lnr-heart"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--================End Single Product Area =================-->

    <!--================Product Description Area =================-->
    <section class="product_description_area">
        <div class="container">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Description</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                       aria-selected="false">Specification</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review"
                       aria-selected="false">Reviews</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <p>{{ $product->description }}</p>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>
                                    <h5>Width</h5>
                                </td>
                                <td>
                                    <h5>{{ $product->width }}mm</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>Height</h5>
                                </td>
                                <td>
                                    <h5>{{ $product->height }}mm</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>Depth</h5>
                                </td>
                                <td>
                                    <h5>{{ $product->depth }}mm</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>Weight</h5>
                                </td>
                                <td>
                                    <h5>{{ $product->weight }}gm</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>Color</h5>
                                </td>
                                <td>
                                    <h5>{{ $product->color }}</h5>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade show active" id="review" role="tabpanel" aria-labelledby="review-tab">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="row total_rate">
                                <div class="col-6">
                                    <div class="box_total">
                                        <h5>Overall</h5>
                                        <h4>{{ round($product->reviews->avg('rating'), 2) }}</h4>
                                        <h6>({{ $product->reviews->count() }} Reviews)</h6>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="rating_list">
                                        <h3>Based on {{ $product->reviews->count() }} Reviews</h3>
                                        <ul class="list">
                                            @for ($rating = 5; $rating >= 1; $rating--)
                                                <li>
                                                    {{ $rating }} Star
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <i class="fa fa-star {{ $i <= $rating ? 'selected' : '' }}"></i>
                                                    @endfor
                                                    {{ $product->reviews->where('rating', $rating)->count() }}
                                                </li>
                                            @endfor
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="review_list">
                                @if($product->reviews->count() > 0)
                                    @foreach($product->reviews as $review)
                                        <div class="review_item">
                                            <div class="media">
                                                <div class="media-body">
                                                    <h4>{{ $review->name }}</h4>
                                                    <!-- Highlight selected stars dynamically -->
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <i class="fa fa-star {{ $i <= $review->rating ? 'selected' : '' }}"></i>
                                                    @endfor
                                                </div>
                                            </div>
                                            <p>{!! $review->review !!}</p>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="review_box">
                                <h4>Add a Review</h4>
                                <p>Your Rating:</p>
                                <ul class="list" id="rating-stars">
                                    <li data-value="1"><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li data-value="2"><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li data-value="3"><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li data-value="4"><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li data-value="5"><a href="#"><i class="fa fa-star"></i></a></li>
                                </ul>
                                <p id="rating-text"></p>
                                <form class="row contact_form" action="{{ route('frontend.product.review') }}" method="post" id="contactForm">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="hidden" name="rating" id="rating-value" value="{{ old('rating') }}">
                                        </div>
                                        <x-input-error :messages="$errors->get('rating')" class="mt-2" />
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Your Full name">
                                        </div>
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Email Address">
                                        </div>
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea id="summernote" class="form-control" name="review" rows="1" placeholder="Review">{{ old('review') }}</textarea>
                                        </div>
                                        <x-input-error :messages="$errors->get('review')" class="mt-2" />
                                    </div>
                                    <div class="col-md-12 text-right">
                                        <button type="submit" class="primary-btn">Submit Now</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Product Description Area =================-->

    <!-- Start related-product Area -->
    <section class="related-product-area section_gap_bottom">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <div class="section-title">
                        <h1>Same Category</h1>
                    </div>
                </div>
            </div>
                <div class="col-lg-12">
                    <div class="row">
                        @if(count($relatedProducts) > 0)
                            @foreach($relatedProducts as $product)
                                <div class="col-lg-3 col-md-6">
                                    <div class="single-product">
                                        <a href="{{ route('frontend.product', $product->slug) }}"><img class="img-fluid" src="{{ asset($product->images->first()->path) }}" alt=""></a>
                                        <div class="desc">
                                            <a href="{{ route('frontend.product', $product->slug) }}" class="title">{{ $product->full_name }}</a>
                                            <div class="price">
                                                <h6>{{Number::currency($product->price,'EGP')}}</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
        </div>
    </section>
    <!-- End related-product Area -->
@endsection
@push('js')
    <script>
        const notyf = new Notyf({
            duration: 3000,
            types: [
                {
                    type: 'warning',
                    background: 'orange',
                    icon: {
                        className: 'material-icons',
                        tagName: 'i',
                        text: 'warning'
                    }
                },
                {
                    type: 'success',
                    background: 'green',
                }
            ]
        });

        document.addEventListener('DOMContentLoaded', function () {
            const stars = document.querySelectorAll('#rating-stars li');
            const ratingValue = document.getElementById('rating-value');
            const ratingText = document.getElementById('rating-text');

            const ratingDescriptions = ['Poor', 'Fair', 'Good', 'Very Good', 'Outstanding'];

            stars.forEach((star, index) => {
                // Handle click event
                star.addEventListener('click', function (event) {
                    event.preventDefault();
                    const value = index + 1;

                    // Update hidden input and text
                    ratingValue.value = value;
                    ratingText.textContent = ratingDescriptions[index];

                    // Update star colors dynamically
                    stars.forEach((s, i) => {
                        const starIcon = s.querySelector('i');
                        starIcon.classList.toggle('selected', i < value);
                    });
                });

                // Handle hover event
                star.addEventListener('mouseover', function () {
                    stars.forEach((s, i) => {
                        const starIcon = s.querySelector('i');
                        starIcon.classList.toggle('selected', i <= index);
                    });
                });

                // Reset stars on mouseout
                star.addEventListener('mouseout', function () {
                    const value = parseInt(ratingValue.value) || 0;
                    stars.forEach((s, i) => {
                        const starIcon = s.querySelector('i');
                        starIcon.classList.toggle('selected', i < value);
                    });
                });
            });
        });

        $(document).ready(function() {
            $('#summernote').summernote();

            $('.addToWishlist3').on('click', function (e) {
                e.preventDefault();

                @guest()
                Swal.fire({
                    title: "You Must Log In First",
                    icon: "warning",
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Ok"
                });
                @endguest

                $.ajax({
                    type: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: $(this).attr('data-product-id'),
                    success: function (data) {
                        if(data.message === "Product added to wishlist")
                            notyf.open({
                                type: 'success',
                                message: data.message
                            });
                        else
                            notyf.open({
                                type: 'warning',
                                message: data.message
                            });
                    }
                });
            });

            $('.addToCart3').on('click', function (e) {
                e.preventDefault();

                @guest()
                    Swal.fire({
                        title: "You Must Log In First",
                        icon: "warning",
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Ok"
                    });
                @endguest

                const quantitySelector = $(this).attr('data-quantity-selector');
                const quantity = $(quantitySelector).val();

                if (quantity <= 0 || isNaN(quantity)) {
                    Swal.fire({
                        title: "Invalid Quantity",
                        text: "Please enter a valid quantity.",
                        icon: "warning",
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "Ok"
                    });
                    return;
                }

                $.ajax({
                    type: 'post',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: $(this).attr('data-product-id'),
                    data: {
                        quantity: quantity // Send the quantity to the server
                    },
                    success: function (data) {
                        notyf.open({
                            type: 'success',
                            message: data.message
                        });
                    }
                });
            });
        });
    </script>
@endpush
