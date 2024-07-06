@extends('layouts.user')
@section('head')
    <style>
        img {
            height: auto;
            width: auto;
        }
    </style>
    <x-seo :modal="$forum" title="title"/>
@endsection
@section('content')
    <x-user.bread-crumb :data="['Home', 'Forum', $forum->title]"/>
    <div class="container py-6 mx-auto flex flex-wrap items-center justify-center">
        <div class="w-[95vw] md:w-full mx-auto">
            <div class="bg-white card md:p-6 p-2">
                <div class="flex md:flex-row flex-col md:items-center md:justify-between mb-4">
                    <div class="flex items-center">
                        <img src="{{ url('storage/' . $forum->company->logo) }}" alt="Company Logo"
                             class="w-8 h-8 md:w-10 md:h-10 rounded-full mr-2 md:mr-4">
                        <div>
                            <h2 class="text-base md:text-lg font-semibold text-gray-800">{{$forum->company->name}}</h2>
                            <p class="text-gray-500 text-xs md:text-sm">Posted
                                on {{date_format($forum->created_at, 'd M y')}}</p>
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <span class="text-gray-600 text-xs md:text-sm">Category: {{$forum->category->name}}</span>
                    </div>
                </div>
                <h1 class="text-lg md:text-xl font-semibold text-gray-900 mb-4">{{$forum->title}}</h1>
                <div id="content" class="text-xs md:text-sm text-gray-700">{!! $forum->body !!}</div>
                <hr class="my-4 border-t-2 border-gray-200">
                <div class="flex justify-between items-center">
                    <div>
                        <span class="text-gray-600 text-sm">{{$forum->countAnswers()}} Answers</span>
                        <span class="ml-4 text-gray-600 text-sm">{{$viewCount}} Views</span>
                        @if($forum->image)
                            <a href="{{url('storage/' . $forum->image)}}"
                               class="text-blue-500 hover:underline text-xs md:text-sm ml-2 inline-flex justify-center items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                     stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="m18.375 12.739-7.693 7.693a4.5 4.5 0 0 1-6.364-6.364l10.94-10.94A3 3 0 1 1 19.5 7.372L8.552 18.32m.009-.01-.01.01m5.699-9.941-7.81 7.81a1.5 1.5 0 0 0 2.112 2.13"/>
                                </svg>
                                &nbsp;View Attachments
                            </a>
                        @endif
                    </div>
                </div>
                <div class="sharethis-inline-share-buttons"></div>
            </div>
        </div>
        <div class="w-full my-5 p-2">
            <a href="{{route('forum.reply', ['id'=>$forum->id])}}" _target="_blank"
               class="block text-white bg-purple-500 hover:bg-purple-800 font-bold uppercase text-xs px-4 py-2 rounded-full focus:outline-none w-full text-center p-2">
                @auth
                    @if(auth()->id() === $forum->user_id)
                        <span class="text-white">You cannot answer your own question</span>
                    @else

                    @endif
                @endauth
                Leave an Answer
            </a>
        </div>
        <!-- Reply Form -->
        <div id="answer-block" class="mb-6 p-2 w-full hidden">
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Submit your Answer</h3>
            @livewire('forum-answer', ['forum' => $forum])
        </div>
        <div class="w-full mt-4 p-2">
            <h2 class="text-lg md:text-xl font-semibold text-gray-900 mb-4">Answers</h2>
            @forelse($forum->forumReplies as $ans)
                <div class="mb-3 md:mb-6 p-2 md:p-4 card card-hovered bg-white relative">
                    <!-- User Details (Left) -->
                    <div class="flex items-start mb-2">
                        <img src="https://via.placeholder.com/100x100" alt="User Avatar"
                             class="w-8 h-8 md:w-10 md:h-10 rounded-full mr-2 md:mr-4">
                        <div class="w-full">
                            <h3 class="text-base md:text-lg font-semibold text-gray-800">{{$ans->user->name}}</h3>
                            <p class="text-gray-500 text-xs md:text-sm">Answered
                                on {{date_format($ans->created_at, 'd M y')}}</p>
                            <!-- Answer Text -->
                            <div class="text-sm text-gray-700 mt-3 w-100">{!! $ans->body !!}</div>
                            <hr class="my-3 w-100">
                            <!-- Action Buttons -->
                            <div class="flex items center mt-2">
                                @auth
                                    @if(auth()->id() === $ans->user_id)
                                        <a href="{{url('/user/forum-replies/'.$ans->id.'/edit')}}"
                                           class="text-blue-500 hover:underline text-xs md:text-sm ml-2 flex justify-center items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"/>
                                            </svg> &nbsp;Edit
                                        </a>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="w-full md:p-2 p-6 card bg-white mb-5">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">No Answers Yet</h2>
                    <p class="text-gray-700">There are currently no answers to this question. Be the first to provide an
                        answer!</p>
                </div>
            @endforelse

        </div>
    </div>
@endsection

@section('page-scripts')
    <script>
        function showAnswerForm() {
            let checkAuth = '{{auth()->id()}}';
            if (checkAuth === '' || checkAuth === 'null') {
                window.location.href = '{{route('auth.login')}}';
                return;
            }
            // Toggle visibility of an answer form
            let answerBlock = document.getElementById('answer-block');
            answerBlock.classList.toggle('hidden');
        }
    </script>
@endsection
