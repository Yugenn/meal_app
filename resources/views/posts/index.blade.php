<x-app-layout>

    <x-flash-message :message="session('notice')" />

    <div class="container max-w-7xl mx-auto px-4 md:px-12 pb-3 mt-3">
        <div class="flex flex-wrap -mx-1 lg:-mx-4 mb-4">
            @foreach ($posts as $post)
                <article class="w-full px-4 md:w-1/2 text-xl text-gray-800 leading-normal">
                    <a href="{{ route('posts.show', $post) }}">
                        <h2 class="font-bold font-sans break-normal text-gray-900 pt-6 pb-1 text-3xl md:text-4xl">
                            {{ $post->title }}</h2>
                        <h3>{{ $post->user->name }}</h3>
                        <p class="text-sm mb-2 md:text-base font-normal text-gray-600">
                            現在時刻:<span class="text-red-400 font-bold">{{ date('Y-m-d H:i:s') }}</span> <br>
                            記事作成日:{{ $post->created_at }} <br>
                            経過時間:<?php $interval = strtotime(date('Y-m-d H:i:s')) - strtotime($post->created_at); ?>

                            @if ($interval < 60)
                                {{ $interval }} 秒
                            @elseif ($interval < 3600) 
                                {{ floor($interval / 60) }} 分 
                            @elseif ($interval < 86400)
                                {{ floor($interval / (60 * 60)) }} 時間 
                            @elseif ($interval < 604800)
                                {{ floor($interval / (24 * 60 * 60)) }} 日
                            @else
                                {{ floor($interval / (30 * 24 * 60 * 60)) }} ヶ月 
                            @endif
                    </p>
                    <img class="w-full mb-2" src="{{ $post->image_url }}" alt="">
                    <p class="text-gray-700 text-base">{{ Str::limit($post->body, 50) }}</p>
                </a>
                <div>
                    お気に入り数:{{ $post->likes->count() }}
                </div>
            </article>
        @endforeach
    </div>
    {{ $posts->links() }}
</div>
</x-app-layout>
