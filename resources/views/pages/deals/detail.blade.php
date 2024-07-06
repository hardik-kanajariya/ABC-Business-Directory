@php use App\classes\HelperFunctions; @endphp
@extends('layouts.user')
@section('head')
    <x-seo :modal="$deal" title="title"/>
@endsection
@section('content')
    <div class="container mx-auto">
        <x-user.bread-crumb :data="['Home', 'Deal', $deal->title]"/>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Image Side -->
            <div class="flex flex-col items-center justify-center">
                <div class="overflow-hidden rounded-lg md:w-3/4 border border-solid border-gray-300 bg-white">
                    <img src="{{ url('storage/'.$deal->thumbnail) }}" alt="Product Image" id="main-image"
                         class="h-80 w-full object-contain img-remove-bg">
                </div>
                <div class="lg:order-1 lg:mt-2 lg:pl-4">
                    <div class="mt-2">
                        <div class="grid grid-cols-5 gap-10 overflow-x-auto">
                            <button type="button"
                                    class="thumbnail-button aspect-square mb-3 h-20 overflow-hidden rounded-lg border-2 border-transparent text-center"
                                    data-image="{{ url('storage/'.$deal->thumbnail) }}">
                                <img src="{{ url('storage/'.$deal->thumbnail) }}" alt="Product Image"
                                     class="h-full w-full object-contain bg-transparent img-remove-bg">
                            </button>
                            @forelse($deal->gallery as $image)
                                <button type="button"
                                        class="thumbnail-button aspect-square mb-3 h-20 overflow-hidden rounded-lg border-2 border-transparent text-center"
                                        data-image="{{ url('storage/'.$image) }}">
                                    <img src="{{ url('storage/'.$image) }}" alt="Product Image"
                                         class="h-full w-full object-contain bg-transparent img-remove-bg">
                                </button>
                            @empty
                                <!-- No Gallery Images -->
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- Deals Details -->
            <div class="flex-col p-4">
                <div class="flex flex-col items-center">
                    <h1 class="text-2xl font-semibold text-gray-800">Sold By</h1>
                    <img src="{{ url('storage/'.$deal->company->logo) }}" alt="Company Logo"
                         class="h-32 w-32 object-contain">
                    <span class="text-base md:text-lg font-bold text-gray-500">{{ $deal->company->name }}</span>
                    <div class="flex items-center justify-start mb-2">
                        @if($deal->company->is_featured)
                            <span
                                class="px-1 bg-green-200 text-green-700 rounded text-sm flex items-center justify-center">
                            <i class='bx bx-star text-green-700 mr-2'></i>
                            Featured
                        </span>
                        @endif
                        @if($deal->company->is_approved)
                            <span
                                class="px-1 bg-blue-200 text-blue-500 rounded m-1 text-sm flex items-center justify-center">
                            <i class='bx bx-badge-check text-blue-500 mr-2'></i>Verified
                        </span>
                        @endif
                    </div>
                    <!-- Location -->
                    <div class="flex items-center justify-center my-2">
                        <i class="bx bx-map text-lg text-indigo-500 mr-2 rounded-full p-2"></i>
                        <span
                            class="text-base font-semibold text-gray-500">{{ $deal->company->address->city }}, {{ $deal->company->address->country->name }}</span>
                    </div>
                    <div class="flex items-center">
                        <button class="inline-flex items-center mr-1 text-gray-500">
                            <i class='bx bxs-star text-green-400 text-sm'></i>
                            <span
                                class="mx-1 text-gray-500 text-sm">{{HelperFunctions::getRatingAverage('company', $deal->id)}}</span>
                            <span class="mx-1 text-gray-500 text-sm">({{HelperFunctions::getRatingCount('company', $deal->id)}} Review)</span>
                        </button>
                    </div>

                </div>
                <div class="flex flex-col items-center justify-center my-4">
                    <div class="flex items-center justify-center">
                        @if($deal->discount_price && $deal->original_price)
                            <p class="text-3xl font-bold text-purple-500">
                                ${{ HelperFunctions::formatCurrency($deal->discount_price) }}</p>
                            <p class="text-sm text-gray-400 line-through ml-2">
                                ${{ HelperFunctions::formatCurrency($deal->original_price) }}</p>
                        @endif
                    </div>
                    <div class="flex items-center justify-center mt-2">
                        <p class="text-sm text-gray-400">Inclusive of all taxes</p>
                    </div>
                </div>

                <div class="flex justify-center items-center my-4">
                    <a href="{{route('view.company', [$deal->company->slug])}}"
                       class="hidden md:flex text-purple-600 md:bg-purple-500 md:text-white md:py-2 md:px-4 rounded focus:outline-none focus:shadow-outline-blue justify-center items-center">
                        Contact Seller
                        <i class='bx bx-link-external ml-2'></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Tab Group -->
        <x-bladewind.tab-group name="product-info">
            <x-slot name="headings">
                <x-custom-tab-heading active="true" name="desc" label="Description"/>
                <x-custom-tab-heading name="rate" label="Rate & Reviews"/>
                <x-custom-tab-heading name="tos" label="Terms & Condition"/>
            </x-slot>

            <x-bladewind.tab-body>
                <x-bladewind.tab-content name="desc" active="true">
                    <table class="w-full rounded-lg mt-4">
                        <!-- Category Section -->
                        <tr>
                            <td class="w-1/2 py-3 px-4 border-b border-lightgray">
                                <div class="flex items-center">
                                    <i class="bx bx-category text-lg text-indigo-500 mr-2 border border-collapse rounded-full p-2"></i>
                                    <span class="text-base font-semibold text-gray-500">Category</span>
                                </div>
                            </td>
                            <td class="w-1/2 py-3 px-4 border-b border-lightgray">
                                <span class="text-base text-purple-500">{{ $deal->category->name }}</span>
                            </td>
                        </tr>
                        <!-- Location Section -->
                        {{--                        <tr>--}}
                        {{--                            <td class="w-1/2 py-3 px-4 border-b border-lightgray">--}}
                        {{--                                <div class="flex items-center">--}}
                        {{--                                    <i class="bx bx-map text-lg text-indigo-500 mr-2 border border-collapse rounded-full p-2"></i>--}}
                        {{--                                    <span class="text-base font-semibold text-gray-500">Location</span>--}}
                        {{--                                </div>--}}
                        {{--                            </td>--}}
                        {{--                            <td class="w-1/2 py-3 px-4 border-b border-lightgray">--}}
                        {{--                                <span class="text-base text-gray-500">{{ $deal->company->address->country->name }}</span>--}}
                        {{--                            </td>--}}
                        {{--                        </tr>--}}
                    </table>
                    <div class="text-sm text-gray-500 bg-white p-4 rounded mt-4">
                        <h1 class="text-2xl font-semibold text-gray-800 my-4">{{$deal->title}}</h1>
                        {!! $deal->description !!}
                    </div>
                </x-bladewind.tab-content>
                <x-bladewind.tab-content name="rate">
                    <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3 lg:gap-12">
                        <div>
                            <div class="rounded-lg border p-4">
                                <h2 class="mb-3 text-lg font-bold text-gray-800 lg:text-xl">Customer Reviews</h2>

                                <div class="mb-0.5 flex items-center gap-2">
                                    <x-bladewind.rating name="star-rating" size="medium" clickable="false"
                                                        rating="{{HelperFunctions::getRatingAverage('deal', $deal->id)}}"/>
                                    <span class="text-sm font-semibold">{{HelperFunctions::getRatingAverage('deal', $deal->id)}}/5</span>
                                </div>

                                <span class="block text-sm text-gray-500">Bases on {{$deal->getReviews()->count()}} reviews</span>

                                <hr class="my-4 border-t-2 border-gray-200">

                                @auth
                                    @if(auth()->user()->hasRated("deal", $deal->id))
                                        <p class="text-sm text-gray-500">You have already rated this Deal.</p>
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
                                @forelse($deal->getReviews() as $item)
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
                            {{ $deal->getReviews()->links() }}
                        </div>
                    </div>
                </x-bladewind.tab-content>
                <x-bladewind.tab-content name="tos">
                    <div class="text-sm text-gray-500 bg-white p-4 rounded">
                        <h1 class="text-2xl font-semibold text-gray-800 my-4">Terms & Conditions</h1>
                        {!! $deal->terms_and_conditions !!}
                    </div>
                </x-bladewind.tab-content>
            </x-bladewind.tab-body>
        </x-bladewind.tab-group>

        <!-- Related Deals Section -->
        <section class="mx-auto mt-8 p-4 bg-white">
            <h2 class="text-2xl font-semibold">Related Deals</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-8 mt-4">
                @forelse($related_deals as $item)
                    <div
                        class="reveal flex flex-col items-center justify-center bg-white rounded-lg shadow-md overflow-hidden transform transition-transform duration-300 ease-in-out hover:-translate-y-2 w-full">
                        <!-- Discount ribbon -->
                        <div class="absolute top-0 left-0 bg-red-500 text-white p-1">
                            <p class="text-xs font-bold">{{HelperFunctions::getDiscountedPercentage($item->discount_price, $item->original_price)}}
                                % off</p>
                        </div>
                        <a href="{{ route('view.deal', [$item->slug]) }}" class="h-100 mx-auto p-2">
                            <img alt="deal thumbnail" src="{{ url('storage/' . $item->thumbnail) }}"
                                 class="w-48 h-48 object-contain md:w-full md:h-48"/>
                        </a>
                        <div class="p-2 flex flex-col items-center justify-center w-full">
                            <p class="text-xs text-gray-400">{{ $item->category->name }}</p>
                            <p class="text-sm font-medium mb-2 text-center h-16 overflow-hidden">{{ strlen($item->title) > 80 ? substr($item->title, 0, 80) . '...' : $item->title }}</p>
                            <p class="text-gray-700 text-center text-xs md:text-sm flex justify-center items-center">
                                <span class="text-sm text-red-500 mr-1">
                                    <i class="bx bx-time text-lg"></i>
                                </span>
                                {{ $item->created_at->diffForHumans() }}
                            </p>
                        </div>
                        <div class="flex items-center justify-between w-full px-5">
                            <p class="text-xs text-gray-400 line-through">
                                ${{ HelperFunctions::formatCurrency($item->original_price) }}
                            </p>
                            <p class="text-lg font-bold text-gray-700">
                                {{HelperFunctions::formatCurrency($deal->discount_price)}}
                            </p>
                        </div>
                        <!-- Published time -->
                        <div class="flex items-center justify-center w-full px-5">
                            <p class="text-xs text-gray-400 flex items-center justify-center">
                                <i class='bx bx-time text-lg'></i>
                                {{ $deal->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>
                @empty
                    <p class="text-gray-700 text-center col-span-full">No listings found.</p>
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
            <input type="hidden" name="item_id" value="{{$deal->id}}">
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
            let url = '{{route('api.product.rate', ['type'=>'deal'])}}';
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
            }
            window.location.reload();
        }
        @endauth
    </script>
@endsection
