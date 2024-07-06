@extends('layouts.user')

@section('head')
    <x-seo :modal="$blog" title="title"/>
@endsection

@section('content')
    <x-user.bread-crumb :data="['Home', 'Blog', $blog->title]"/>
    <div class="container py-6 mx-auto flex flex-wrap">
        <div class="w-full mb-10 lg:mb-0 overflow-hidden px-2">
            <div class="my-2 md:px-6">
                <img src="{{url('storage/' . $blog->thumbnail)}}" class="mb-6 w-full rounded-lg shadow-lg dark:shadow-black/20" alt="image"/>
                <div class="mb-6 flex items-center justify-start">
                    <img src="{{ url('storage/' . $blog->company->logo) }}"
                         class="mr-2 w-10 h-10 md:w-[80px] md:h-[80px] rounded" alt="avatar" loading="lazy"/>
                    <div>
                        <span class="text-sm md:text-base"> Published <u>{{$blog->created_at->diffForHumans()}}</u> by </span>
                        <a href="{{ route('view.company', [$blog->company->slug]) }}"
                           class="font-medium text-sm md:text-base">{{$blog->company->name}}</a>
                    </div>
                </div>
                <h1 class="mb-6 text-3xl font-bold">{{$blog->title}}</h1>
                <div class="text-sm">{!! $blog->content !!}</div>
                <!-- ShareThis BEGIN --><div class="sharethis-inline-reaction-buttons"></div><!-- ShareThis END -->
            </div>
            <!-- Leave Reply -->
            <section class="my-8">
                <h5 class="mb-10 text-center text-xl font-semibold">Leave a reply</h5>
                <form method="post" action="{{route('blog.comment.submit')}}">
                    @csrf
                    <div class="relative mb-6" data-te-input-wrapper-init>
                        <x-bladewind::input type="text" name="name" placeholder="Name" :required="true"/>
                    </div>
                    <div class="relative mb-6" data-te-input-wrapper-init>
                        <x-bladewind::textarea type="text" id="message" placeholder="Message" :required="true"
                                               name="comment"/>
                    </div>
                    @auth
                        <input type="hidden" name="blog_id" value="{{$blog->id}}">
                        <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                        <x-bladewind::button class="w-full bg-purple-500 text-white" can_submit="true">Submit
                        </x-bladewind::button>
                    @else
                        <span id="login-to-continue">
                                <x-bladewind::button class="w-full bg-purple-500 text-white" type="button">Login to Comment</x-bladewind::button>
                            </span>
                        <script>
                            document.getElementById('login-to-continue').addEventListener('click', function () {
                                Swal.fire({
                                    title: 'Login to continue',
                                    text: "You need to login to comment on this blog.",
                                    icon: 'info',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Login',
                                    cancelButtonText: 'Cancel'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = '{{url('user/dashboard')}}';
                                    }
                                })
                            })
                        </script>
                    @endauth
                </form>
            </section>
            <!-- Comment Section -->
            <section class="my-8">
                <h5 class="mb-10 text-xl font-semibold md:mb-6">
                    Comments: <span class="text-gray-500 text-base">({{$blog->comments->count()}})</span>
                </h5>

                <!-- Comment -->
                @forelse($blog->comments as $comment)
                    <div class="mb-12 flex flex-wrap md:mb-0">
                        <div class="w-full md:w-2/12 shrink-0 grow-0 basis-auto">
                            <img src="https://ui-avatars.com/api/?name={{$comment->user->name}}"
                                 class="mb-6 w-full rounded-lg shadow-lg dark:shadow-black/20" alt="Avatar"/>
                        </div>

                        <div class="w-full md:w-10/12 shrink-0 grow-0 basis-auto md:pl-6">
                            <p class="mb-3 font-semibold">{{$comment->user->name}}</p>
                            <p class="mb-3 text-gray-500 text-sm">{{$comment->created_at->diffForHumans()}}</p>
                            <p>{!! $comment->comment !!}</p>

                        </div>
                    </div>
                @empty
                    <p class="text-gray-500 text-center mt-10">No comments found.</p>
                @endforelse
            </section>
            <!-- Related Blogs Section -->
            <section class="mt-8 p-1">
                <h2 class="text-2xl font-semibold mb-5">Related Blogs</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    @forelse($related_blogs as $item)
                        <div class="bg-white rounded-lg shadow-md flex flex-col items-center justify-between">
                            <div class="p-6  flex flex-col items-center justify-between">
                                <img src="{{url('storage/'.$item->thumbnail)}}" alt="Blog Thumbnail"
                                     class="w-full h-40 object-cover mb-4 rounded-md">
                                <h2 class="text-lg font-semibold text-gray-800 mb-2">{{$item->title}}</h2>
                                <p class="text-gray-600 mb-4">
                                    {!! Str::limit($item->summary, 80) !!}
                                </p>
                            </div>

                            <a href="{{route('view.blog', $item->slug)}}"
                               class="text-blue-500 hover:underline text-center accent-auto mx-auto my-4 pt-2 w-full"
                               style="border-top: 1px solid lightgray;">
                                Continue Reading
                            </a>
                        </div>
                    @empty
                        <div class="w-full text-center">
                            <p class="text-gray-500 text-center">No Blogs Found</p>
                        </div>
                    @endforelse
                </div>
            </section>
        </div>
    </div>
@endsection
