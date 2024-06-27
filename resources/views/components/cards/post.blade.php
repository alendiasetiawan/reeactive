<div class="widget widget-card-one">
    <div class="widget-content">
        <div class="media">
            @isset($avatar)
            <div class="w-img">
                {{ $avatar }}
                {{-- <img src="../src/assets/img/profile-19.jpeg" alt="avatar"> --}}
            </div>
            @endisset
            <div class="media-body">
                <h6>{{ $title }}</h6>
                <p class="meta-date-time">{{ $subTitle }}</p>
            </div>
        </div>

        <p>{{ $content }}</p>

        <div class="w-action">
            @isset($label)
                <div class="card-like">
                    {{ $label }}
                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-thumbs-up"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path></svg>
                    <span>551 Likes</span> --}}
                </div>
            @endisset

            <div class="read-more">
                {{ $action }}
                {{-- <a href="javascript:void(0);">Read More <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-right"><polyline points="13 17 18 12 13 7"></polyline><polyline points="6 17 11 12 6 7"></polyline></svg></a> --}}
            </div>
        </div>
    </div>
</div>
