@php use App\classes\HelperFunctions; @endphp
@extends('layouts.user')
@section('head')
    <x-seo :modal="$product" title="name"/>
@endsection
@section('content')
    <div class="container mx-auto">
        <x-user.bread-crumb :data="['Home', 'Product', $product->name]"/>
        <div class="w-full overflow-hidden shadow-md backdrop-blur bg-white rounded-lg">
            <img src="{{ url('storage/'.$product->thumbnail) }}" alt="Product Image" id="main-image"
                 class="h-80 w-full max-w-full object-contain img-remove-bg">
        </div>

        <div class="mt-2 w-full lg:order-1 flex items-center justify-center">
            <div class="grid grid-cols-3 md:grid-cols-5 gap-4">
                <button type="button" class="thumbnail-button flex-0 aspect-square mb-3 h-20 overflow-hidden rounded-lg border-2 border-transparent text-center"
                        data-image="{{ url('storage/'.$product->thumbnail) }}">
                    <img src="{{ url('storage/'.$product->thumbnail) }}" alt="Product Image"
                         class="h-full w-full max-w-full object-contain bg-transparent img-remove-bg">
                </button>

                @forelse($product->gallery as $image)
                    <button type="button" class="thumbnail-button flex-0 aspect-square mb-3 h-20 overflow-hidden rounded-lg border-2 border-transparent text-center" data-image="{{ url('storage/'.$image) }}">
                        <img src="{{ url('storage/'.$image) }}" alt="Product Image"
                             class="h-full w-full max-w-full object-contain bg-transparent img-remove-bg">
                    </button>
                @empty
                    <!-- No Gallery Images -->
                @endforelse
            </div>
        </div>

        <div class="lg:col-span-2 lg:row-span-2 lg:row-end-2 flex md:flex-row flex-col md:items-center justify-between p-4">
            <div class="flex flex-auto">
                <img src="{{ url('storage/'.$product->company->logo) }}" alt="Company Logo"
                     class="h-16 w-16 rounded-full object-contain mr-4 mt-4 hidden">
                <!-- Published Details  -->
                <div class="flex flex-col">
                    <span class="text-base md:text-xl sm:text-base font-bold">{{ $product->name }}
                        @if($product->is_featured)
                            <span>
                                <button
                                    class="inline-flex items-center bg-neutral-100 mr-1 text-white border border-solid-400 rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5"
                                         stroke="currentColor" class="w-4 h-4 text-white bg-green-500">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z"/>
                                    </svg>
                                    <span class="mx-1 text-gray-500 text-xs">Featured</span>
                                </button>
                            </span>
                        @endif
                    </span>
                    <span class="text-xs md:text-base text-gray-500">Price: <span class="text-purple-500">${{ HelperFunctions::formatCurrency($product->price) }}</span></span>
                    <hr>
                    <span class="text-xs md:text-sm text-gray-500">Published by {{ $product->company->name }}</span>
                    <span class="text-xs md:text-sm text-gray-500">Published on {{ $product->created_at->format('d M Y') }} ({{ $product->created_at->diffForHumans() }})</span>
                    <a href="{{route('view.company', [$product->company->slug])}}" class="border border-purple-600 text-purple-600 hover:bg-purple-600 hover:text-white py-1 px-2 md:ml-5 text-center mt-2 rounded-full hover:rounded-full transition-all duration-300 ease-in-out md:w-auto w-full md:hidden">
                        Contact Seller
                        <i class='bx bx-link-external ml-2'></i>
                    </a>
                </div>
            </div>
            <a href="{{route('view.company', [$product->company->slug])}}" class="hidden md:flex text-purple-600 md:bg-purple-500 md:text-white md:py-2 md:px-4 rounded focus:outline-none focus:shadow-outline-blue hover:bg-purple-800">
                Contact Seller
                <i class='bx bx-link-external ml-2'></i>
            </a>
        </div>
        <x-bladewind.tab-group name="product-info" color="blue">
            <x-slot name="headings">
                <x-custom-tab-heading active="true" name="desc" label="Description"/>
                <x-custom-tab-heading name="rate" label="Rate & Reviews"/>
            </x-slot>

            <x-bladewind.tab-body>
                <x-bladewind.tab-content name="desc" active="true">
                    <table class="w-full border border-collapse rounded-lg">
                        <!-- Category Section -->
                        <tr>
                            <td class="w-1/2 py-3 px-4 border-b border-lightgray">
                                <div class="flex items-center justify-start">
                                <span class="text-lg font-semibold text-indigo-500 mr-2 border border-collapse rounded-full p-2 flex items-center justify-center">
                                    <i class='bx bx-category'></i>
                                </span>
                                    <div>
                                        <span class="text-sm md:text-base font-semibold text-gray-500">Category</span>
                                    </div>
                                </div>
                            </td>
                            <td class="w-1/2 py-3 px-4 border-b border-lightgray">
                                <span class="text-sm md:text-base text-justify text-purple-500">{{ $product->category->name ?? 'N/A' }}</span>
                            </td>
                        </tr>
                        <tr>
                            <!-- Location Section -->
                            <td class="w-1/2 py-3 px-4 border-b border-lightgray">
                                <div class="flex items-center justify-start">
                                <span class="text-lg font-semibold text-indigo-500 mr-2 border border-collapse rounded-full p-2 flex items-center justify-center">
                                    <i class='bx bx-map'></i>
                                </span>
                                    <div>
                                        <span class="text-sm md:text-base font-semibold text-gray-500">Country of Origin</span>
                                    </div>
                                </div>
                            </td>
                            <td class="w-1/2 py-3 px-4 border-b border-lightgray">
                                <span class="text-sm: md:text-base text-gray-500">{{ $product->brand ?? 'N/A' }}</span>
                            </td>
                        </tr>
                        <tr>
                            <!-- Location Section -->
                            <td class="w-1/2 py-3 px-4 border-b border-lightgray">
                                <div class="flex items-center justify-start">
                                <span class="text-lg font-semibold text-indigo-500 mr-2 border border-collapse rounded-full p-2 flex items-center justify-center">
                                    <i class='bx bx-palette'></i>
                                </span>
                                    <div>
                                        <span class="text-sm md:text-base font-semibold text-gray-500">Color</span>
                                    </div>
                                </div>
                            </td>
                            <td class="w-1/2 py-3 px-4 border-b border-lightgray">
                                <span class="text-sm: md:text-base text-gray-500">{{ $product->color ?? 'N/A' }}</span>
                            </td>
                        </tr>
                        <tr>
                            <!-- Location Section -->
                            <td class="w-1/2 py-3 px-4 border-b border-lightgray">
                                <div class="flex items-center justify-start">
                                <span class="text-lg font-semibold text-indigo-500 mr-2 border border-collapse rounded-full p-2 flex items-center justify-center">
                                    <i class='bx bx-expand'></i>
                                </span>
                                    <div>
                                        <span class="text-sm md:text-base font-semibold text-gray-500">Size</span>
                                    </div>
                                </div>
                            </td>
                            <td class="w-1/2 py-3 px-4 border-b border-lightgray">
                                <span class="text-sm: md:text-base text-gray-500">{{ $product->size ?? 'N/A' }}</span>
                            </td>
                        </tr>
                        <tr>
                            <!-- Location Section -->
                            <td class="w-1/2 py-3 px-4 border-b border-lightgray">
                                <div class="flex items-center justify-start">
                                <span class="text-lg font-semibold text-indigo-500 mr-2 border border-collapse rounded-full p-2 flex items-center justify-center">
                                   <i class='bx bxs-layer'></i>
                                </span>
                                    <div>
                                        <span class="text-sm md:text-base font-semibold text-gray-500">Material</span>
                                    </div>
                                </div>
                            </td>
                            <td class="w-1/2 py-3 px-4 border-b border-lightgray">
                                <span class="text-sm: md:text-base text-gray-500">{{ $product->material ?? 'N/A' }}</span>
                            </td>
                        </tr>
                    </table>
                    <hr class="my-4">
                    <p class="text-sm text-gray-500 bg-white p-4 shadow-md rounded">{!! $product->description !!}</p>
                    <div class="relative bottom-0 md:static right-1 mb-2 md:w-[calc(80%-1rem)] mt-4"
                         style="width: max-content;">
                        <a href="{{route('view.company', [$product->company->slug])}}"
                           class="text-purple-500 mb-1 bg-purple-100 hover:bg-purple-500 hover:text-white rounded-full p-2 transition duration-300 ease-in-out flex items-center justify-center transform hover:-translate-y-1 hover:scale-60 text-center text-xs md:text-base border border-purple-600">
                            <span class="ml-1">Contact Seller&nbsp;</span>
                            <i class='bx bx-link-external mr-2'></i>
                        </a>
                    </div>
                </x-bladewind.tab-content>
                <x-bladewind.tab-content name="rate">
                    <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3 lg:gap-12">
                        <div>
                            <div class="rounded-lg border p-4">
                                <h2 class="mb-3 text-lg font-bold text-gray-800 lg:text-xl">Customer Reviews</h2>

                                <div class="mb-0.5 flex items-center gap-2">
                                    <x-bladewind.rating name="star-rating" size="medium" clickable="false"
                                                        rating="{{\App\classes\HelperFunctions::getRatingAverage('product', $product->id)}}"/>
                                    <span class="text-sm font-semibold">{{\App\classes\HelperFunctions::getRatingAverage('product', $product->id)}}/5</span>
                                </div>

                                <span class="block text-sm text-gray-500">Bases on {{$product->getReviews()->count()}} reviews</span>

                                <hr class="my-4 border-t-2 border-gray-200">

                                @auth
                                    @if(auth()->user()->hasRated("product", $product->id))
                                        <p class="text-sm text-gray-500">You have already rated this Product.</p>
                                    @else
                                        <a href="#" onclick="showModal('rate')"
                                           class="mt-2 block rounded-lg border px-4 py-2 text-center text-sm font-semibold text-gray-500 outline-none ring-indigo-300 transition duration-100 bg-gray-100 hover:bg-gray-300 focus-visible:ring active:bg-gray-200 md:px-8 md:py-3 md:text-base">Write
                                            a review</a>
                                    @endif
                                @else
                                    <a href="{{route('auth.login')}}"
                                       class="mt-2 block rounded-lg border px-4 py-2 text-center text-sm font-semibold text-gray-500 outline-none ring-indigo-300 transition duration-100 bg-gray-100 hover:bg-gray-300 focus-visible:ring active:bg-gray-200 md:px-8 md:py-3 md:text-base">Login
                                        to write a review</a>
                                @endauth
                            </div>
                        </div>
                        <div class="lg:col-span-2">
                            <div class="border-b pb-4 md:pb-6">
                                <h2 class="text-lg font-bold text-gray-800 lg:text-xl">Top Reviews</h2>
                            </div>
                            <hr>
                            <br>
                            <div class="divide-y">
                                @forelse($product->getReviews() as $item)
                                    <div class="flex flex-col gap-3 p-4 mb-2 bg-gray-100">
                                        <div class="flex justify-between items-center">
                                            <div>
                                                <span class="block text-sm font-bold">{{$item->user->name}}</span>
                                                <span
                                                    class="block text-sm text-gray-500">{{$item->created_at->diffForHumans()}}</span>
                                            </div>
                                            <x-bladewind.rating name="star-rating" size="small" clickable="false"
                                                                rating="{{$item->rating}}"/>
                                        </div>
                                        <p class="text-gray-600">{{$item->review}}</p>
                                    </div>
                                @empty
                                    <div class="flex flex-col gap-3 p-4 mb-2 bg-gray-100">
                                        <p class="text-gray-600">No reviews yet.</p>
                                    </div>
                                @endforelse
                            </div>
                            <!-- Pagination -->
                            {{ $product->getReviews()->links() }}
                        </div>
                    </div>
                </x-bladewind.tab-content>
            </x-bladewind.tab-body>
        </x-bladewind.tab-group>
        <!-- Related Products Section -->
        <section class="mx-auto mt-8 p-4 bg-white">
            <h2 class="text-2xl font-semibold">Related Products</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-8 mt-4">
                <!-- Related Product 1 -->
                @forelse($related_products as $item)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transform transition-transform duration-300 ease-in-out hover:-translate-y-2 flex md:flex-col items-start md:items-center md:justify-center">
                        @if($item->is_featured)
                            <div class="absolute top-0 left-0 bg-red-500 text-white p-1 px-2 text-xs font-bold rounded" style="z-index: 99">
                                Featured
                            </div>
                        @endif
                        <a href="{{ route('view.product', [$item->slug]) }}" class="w-[100px] md:w-full h-[80px] md:p-4 md:m-auto md:block md:h-full object-contain">
                            <img alt="company photo" src="{{ url('storage/' . $item->thumbnail) }}" class="w-full h-full object-cover img-remove-bg"/>
                        </a>
                        <div class="p-1 ml-2 md:p-2 flex flex-col items-start md:items-center md:justify-center w-full">
                            <header class="flex my-2 font-light text-xs md:text-base items-center">
                                <i class="bx bx-category text-indigo-500 mr-1"></i>
                                <p>{{ $item->category->name }}</p>
                            </header>
                            <p class="text-sm md:text-xl font-medium mb-2">{{ $item->name }}</p>
                            <p class="text-red-700 text-xs md:text-sm">{{ $item->company ? $item->company->name: '' }}</p>
                            <p class="text-gray-700 text-xs md:text-sm">{{ $item->company? $item->company->address->country->name : '' }}</p>
                            <p class="text-gray-700 text-xs md:text-sm">Price: ${{ HelperFunctions::formatCurrency($item->price) }}</p>
                            <div class="block md:hidden md:static mb-2 w-full">
                                <a href="{{ route('view.product', [$item->slug]) }}" class="text-purple-500 mb-1 bg-purple-100 hover:bg-purple-500 rounded-full p-1 transition duration-300 ease-in-out flex items-center justify-center transform hover:-translate-y-1 hover:scale-60 text-center text-xs md:text-base w-[calc(80%-1rem)]">
                                    <span class="ml-1">Enquire Now &nbsp;</span>
                                    <i class='bx bx-link-external mr-2'></i>
                                </a>
                            </div>
                        </div>
                        <div class="hidden md:block absolute bottom-0 md:static right-1 mb-2 w-full md:w-[calc(80%-1rem)]">
                            <a href="{{ route('view.product', [$item->slug]) }}" class="text-purple-500 mb-1 bg-purple-100 hover:bg-purple-500 hover:text-white rounded-full p-1 transition duration-300 ease-in-out flex items-center justify-center transform hover:-translate-y-1 hover:scale-60 text-center text-xs md:text-base">
                                <span class="ml-1">Enquire Now &nbsp;</span>
                                <i class='bx bx-link-external mr-2'></i>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="dark:bg-neutral-700">
                        <div class="p-4">
                            <h2 class="text-gray-900 text-base font-semibold mb-1">No Product Found</h2>
                        </div>
                    </div>
                @endforelse
            </div>
        </section>
    </div>
    <x-bladewind::modal
        backdrop_can_close="false"
        name="rate"
        ok_button_action="saveRating('rate-product')"
        ok_button_label="Submit"
        close_after_action="false"
        center_action_buttons="true">
        <form method="post" action="" id="rate-form">
            @csrf
            <b class="mt-0">Add your review</b>
            <x-bladewind.rating name="rate-product" rating="1"/>
            <x-bladewind.textarea name="review" label="Review" rows="3"/>
            <input type="hidden" name="item_id" value="{{$product->id}}">
        </form>
        <x-bladewind::processing
            name="rate-processing"
            message="Submitting your rating..."/>

        <x-bladewind::process-complete
            name="rate-complete"
            process_completed_as="passed"
            button_label="Done"
            button_action="hideModal('rate')"
            message="Your rating has been submitted successfully."/>
    </x-bladewind::modal>
@endsection

@section('page-scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Gallery View
            const thumbnailButtons = document.querySelectorAll(".thumbnail-button");
            const mainImage = document.getElementById("main-image");

            thumbnailButtons.forEach((button) => {
                button.addEventListener("click", function () {
                    mainImage.src = button.getAttribute("data-image");
                });
            });
        });

        @auth
            saveRating = async function (element) {
            let form = document.getElementById('rate-form');
            let item_id = form.querySelector('input[name="item_id"]').value;
            let rating = dom_el(`.rating-value-${element}`).value;
            let review = form.querySelector('textarea[name="review"]').value;
            let url = '{{route('api.product.rate', ['type'=>'product'])}}';
            let headersList = {
                "Accept": "application/json",
                "Content-Type": "application/json"
            }

            let bodyContent = JSON.stringify({
                "item_id": item_id,
                "rating": rating,
                "review": review,
                "user_id": "{{auth()->user()->id}}"
            });

            let response = await fetch(url, {
                method: "POST",
                body: bodyContent,
                headers: headersList
            });

            let data = await response.json();
            if (data.status === 'success') {
                hideModal('rate');
                showModal('rate-complete');
                window.location.reload();
            }
        }
        @endauth
    </script>
@endsection
