<div id="menu">
    <a href="/" class="d-block text-center mt-1 mb-2">
        @component('web.component.logo', ['class' => '', 'style' => 'width: 100px'])
        @endcomponent
   </a>
    <ul class="mb-3">
        <li class="menu-item">
            <a href="/" class="bg-gray-300 border-bottom border-white">Avantina</a>  
        </li>

        <li class="menu-item border-bottom border-white">
            <span class="menu-collapse position-relative bg-gray-300">
                <span class="">Kurzy</span>
            </span>
            <div class="menu-subitem collapse" style="">
                <ul>
                    <li>
                        <a href="/individualni-kurzy" class="bg-gray-300">Individuální kurzy</a>
                    </li>
                    <li>
                        <a href="/skupinove-kurzy" class="bg-gray-300">Skupinové kurzy</a>
                    </li>
                    <li>
                        <a href="/vikendove-kurzy" class="bg-gray-300">Víkendové kurzy</a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="menu-item">
            <a href="/vyuka" class="bg-gray-300 border-bottom border-white">Výuka</a>  
        </li>

        <li class="menu-item">
            <a href="/kontakt" class="bg-gray-300 border-bottom border-white">Kontakt</a>  
        </li>

    </ul>

    <div class="px-2 mb-4 size-0-8 d-flex align-items-center"><i class="fas fa-home mr-2 size-1-2"></i>{{ $office->street }}, {{ $office->city }}</div>
    <div class="px-2 mb-4 size-0-8 d-flex align-items-center"><i class="fas fa-envelope mr-2 size-1-2"></i>{{ $office->email }}</div>
    <div class="px-2 mb-4 size-0-8 d-flex align-items-center"><i class="fas fa-phone mr-2 size-1-2"></i> <a href="tel:+420{{ str_replace(' ','',$office->phone) }}">{{ $office->phone }}</a></div>
</div>