<div id="topnav" class="bg-gray-200 py-1 border-bottom shadow-sm materialize">
    <div id="topnav-container" class="container d-flex justify-content-between position-relative align-items-center">
        <div id="hamburger" class="mr-3 d-block-under-991">
            <div></div>
            <div></div>
            <div></div>
        </div>
        <div id="topnav-left" class="menu d-flex d-none-under-991">
                {{-- 1 menu --}}
                <a href="/" class="btn btn-outline-dark rounded mr-3 materialize"><h1>Avantina <small>- jazyková škola italština</small></h1></a>
                
                {{-- 2 menu --}}
                <div class="dropdown">
                  <a href="/kurzy" class="btn btn-outline-dark rounded mr-3 materialize" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><h2>Kurzy <small>italštiny</small></h2></a>
                  <div class="dropdown-menu w-100 p-3">
                    <div class="d-flex justify-content-around dropdown-menu-content p-3">
                        {{-- 1 submenu --}}
                        <div class="d-flex align-items-center mx-1">
                            <a href="/individualni-kurzy"><img src="/storage/default/bubble_individual_60.png" alt="Individuální kruzy"></a>
                            <a href="/individualni-kurzy" class="d-block text-dark no-hover-underline p-2">
                                <h3 class="font-weight-bold">INDIVIDUÁLNÍ <small>kurzy italštiny</small></h3>
                                <div class="size-0-9">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae aliquet nisi.</div>
                            </a>
                        </div>
                        {{-- 2 submenu --}}
                        <div class="d-flex align-items-center mx-1">
                            <a href="/skupinove-kurzy"><img src="/storage/default/bubble_skupina_60.png" alt="Skupinové kruzy"></a>
                            <a href="/skupinove-kurzy" class="d-block text-dark no-hover-underline p-2">
                                <h3 class="font-weight-bold">SKUPINOVÉ <small>kurzy italštiny</small></h3>
                                <div class="size-0-9">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae aliquet nisi.</div>
                            </a>
                        </div>
                        {{-- 3 submenu --}}
                        <div class="d-flex align-items-center mx-1">
                            <a href="/vikendove-kurzy"><img src="/storage/default/bubble_vikend_60.png" alt="Víkendové kruzy"></a>
                            <a href="/vikendove-kurzy" class="d-block text-dark no-hover-underline p-2">
                                <h3 class="font-weight-bold">VÍKENDOVÉ <small>kurzy italštiny</small></h3>
                                <div class="size-0-9">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In vitae aliquet nisi.</div>
                            </a>
                        </div>
                    </div>
                  </div>
                </div>

                {{-- 3 menu --}}
                <a href="/vyuka" class="btn btn-outline-dark rounded mr-3 materialize"><h2>Výuka <small>italštiny</small></h2></a>

                {{-- 4 menu --}}
                <a href="/kontakt" class="btn btn-outline-dark rounded mr-3 materialize"><h2>Kontakt</h2></a>
        </div>
        <div id="topnav-right" class="d-flex size-0-8">
            <div class="mx-2 d-none-under-991"><i class="fas fa-home d-inline-block mr-1"></i>
                {{ $office->street }}, {{ $office->city }}</div>
            <div class="mx-2 d-none-under-991"><i class="fas fa-phone d-inline-block mr-1"></i> <a class="tel has-tooltip" href="tel:+420{{ str_replace(' ','',$office->phone) }}" title="Zavolejte kdykoliv">{{ $office->phone }}</a></div>
            <div class="mx-2 d-none-under-991"><i class="fas fa-envelope d-inline-block mr-1"></i>{{ $office->email }}</div>
            <div class="mx-2"><a href="#" class="login-icon has-tooltip" title="Přhlásit se"><i class="fas fa-user"></i></a></div>
        </div>
    </div>
</div>