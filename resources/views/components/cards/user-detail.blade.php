<div class="card">
    @isset($cardSubTitle)
        <div class="card-header">
            <div class="card-title">{{ $cardTitle ?? '' }}</div>
            <div>
                {{ $cardSubTitle }}
            </div>
        </div>
    @endisset
    <div class="card-body">
        <div class="user-avatar-section">
            <div class="d-flex align-items-center flex-column">
                @isset($photo)
                    {{ $photo }}
                @endisset
                {{-- @if ($user->photo==NULL)
                    @if ($santri->jk=='Laki-Laki')
                        <img class="img-fluid rounded mt-3 mb-2" src="{{ asset('style/app-assets/images/avatars/user-ikhwan.png') }}" height="110" width="110" />
                    @else
                        <img class="img-fluid rounded mt-3 mb-2" src="{{ asset('style/app-assets/images/avatars/user-akhwat.png') }}" height="110" width="110" />
                    @endif
                @else
                <img class="img-fluid rounded mt-3 mb-2" src="{{ asset('style/app-assets/images/avatars/'.$user->photo) }}" height="110" width="110" />
                @endif --}}
                <div class="user-info text-center">
                    <h4>{{ $name }}</h4>
                    <span class="badge bg-light-primary">{{ $subTitle }}</span>
                </div>
            </div>
        </div>

        @isset($featured)
        <div class="d-flex justify-content-around my-2 pt-75">
            <div class="d-flex align-items-start">
                <span class="badge bg-light-primary p-75 rounded">
                    {{ $featuredIcon }}
                    {{-- <i data-feather="book-open" class="font-medium-2"></i> --}}
                </span>
                <div class="ms-75">
                    <h5 class="mb-0">{{ $featured }}</h5>
                    <small>{{ $note }}</small>
                </div>
            </div>

            @isset($featuredIcon2)
            <div class="d-flex align-items-start">
                <span class="badge bg-light-primary p-75 rounded">
                    {{ $featuredIcon2 }}
                    {{-- <i data-feather="book-open" class="font-medium-2"></i> --}}
                </span>
                <div class="ms-75">
                    <h5 class="mb-0">{{ $featured2 }}</h5>
                    <small>{{ $note2 }}</small>
                </div>
            </div>
            @endisset
        </div>
        @endisset

        <h4 class="fw-bolder border-bottom pb-50 mb-1 mt-2">{{ $addDetail }}</h4>
        <div class="info-container">
            <ul class="list-unstyled">
                {{ $detail }}
            </ul>
        </div>
    </div>
</div>
