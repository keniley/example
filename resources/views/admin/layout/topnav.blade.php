@inject('alert', 'App\Service\AlertService')
@inject('messageService', 'App\Service\MessageService')
@php 
    $alert = $alert->get();
@endphp

<div id="hamburger" class="mr-3 d-block-under-800">
    <div></div>
    <div></div>
    <div></div>
</div>
@yield('breadcrumb')
<div class="d-flex justify-content-end flex-grow-1 align-items-center">

    <div class="mr-3 has-tooltip" data-placement="bottom" title="Nepřečtených <br>zpráv z webu: {{ $messageService->count() }}">
        <a href="/admin/message"><i class="icon fas fa-envelope size-1-4 @if($messageService->count() > 0) text-danger @else text-gray-500 @endif"></i></a>
    </div>

    <div class="ml-3 dropdown dropdown-left">
        <a href="#" class="dropdown-toggle without-arrow" data-toggle="dropdown">
            <i class="icon fas fa-bell size-1-4 @empty($alert) text-gray-500 @else text-danger animation-ring @endempty"></i>
        </a>
        <div class="dropdown-menu py-0 pb-1" style="width: 300px">
            <div class="list-group">
                @empty($alert)
                    <div class="list-group-item list-group-item-action">Nemáte žádné zprávy</div>
                @endempty
                @foreach ($alert as $item)
                    <div class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1 size-0-9 text-danger">{!! __('alert.'.$item['id'].'.header') !!}</h5>
                        </div>
                        <p class="mb-1 size-0-8">{!! __('alert.'.$item['id'].'.text') !!}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="dropdown mx-3 dropdown-left">
        <a href="#" class="dropdown-toggle without-arrow" data-toggle="dropdown">
            <img src="{{ Avatar::create(Auth::guard('admin')->user()->name)->toBase64() }}" style="max-width: 35px">
        </a>
        <div class="dropdown-menu py-0 pb-1">
            <div class="d-flex align-items-center px-3 py-4 bg-gray-600 text-white mb-1" style="width: 250px">
                <img src="{{ Avatar::create(Auth::guard('admin')->user()->name)->toBase64() }}" style="max-width: 45px">
                <div class="ml-2">
                    <div>{{ Auth::guard('admin')->user()->name }}</div>
                    <div style="font-size: 0.7rem">{{ Auth::guard('admin')->user()->email }}</div>
                </div>
            </div>
            <div>
                <a class="dropdown-item py-2 d-flex align-items-center" href="/admin/me"><span class="fas fa-user pr-2"></span>Můj profil</a>
                <div class="d-flex justify-content-center my-2 pt-2">
                    <a href="/admin/logout" class="btn btn-danger btn-sm materialize waves-button-light">Odhlásit</a>
                </div>
            </div>
        </div>
    </div>
</div>

