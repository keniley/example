<div id="footer" class="bg-gray-200 border-top mt-5 pt-3 pb-3">
    <div id="footer-container" class="container">
        <div class="row">
            <div class="col-12 col-lg-4">
                <div><a href="/">
                    @component('web.component.logo', ['class' => '', 'style' => 'height: 40px'])
                    @endcomponent</a></div>
                <div>{{ $office->street }}</div>
                <div class="mb-3">{{ $office->zip }}, {{ $office->city }}</div>
                <div><i class="fas fa-phone d-inline-block mr-1"></i><a class="tel has-tooltip" href="tel:+420{{ str_replace(' ','',$office->phone) }}" title="Zavolejte kdykoliv">{{ $office->phone }}</a></div>
                <div><i class="fas fa-envelope d-inline-block mr-1"></i>{{ $office->email }}</div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="mb-1">Přijďte se k nám podívat:</div>
                <div>informační a zápisová kancelář je otevřena</div>
                <div><strong>každé pondělí 16:00 - 18:00</strong></div>
                <div style="font-size:3rem">
                    <a href="#" target="_blank"><i class="fab fa-facebook-square"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <iframe src="{{ $office->map }}" height="150" style="border:0;width: 100%" allowfullscreen=""></iframe>
            </div>
            
        </div>
    </div>
</div>