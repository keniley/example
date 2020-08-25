@extends ('web.layout.html')

@section ('seo_title')@endsection

@section ('seo_description')@endsection

@section ('javascript')
@endsection

@section ('css')
@endsection

@section ('body')
    
    <div class="container mt-5">
            <div class="bd-example">
              <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                  <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                  <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="/storage/user/melouny_v2.jpg" class="d-block w-100" alt="melouny">
                    <div class="carousel-caption d-none d-md-block">
                      <button class="btn btn-success" style="width: 40%; font-size: 2rem">Prohlédnout kruzy</button>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img src="/storage/user/pic2.jpg" class="d-block w-100" alt="San Valentino">
                    <div class="carousel-caption d-none d-md-block">
                      <button class="btn btn-success" style="width: 40%; font-size: 2rem">Prohlédnout kruzy</button>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img src="/storage/user/pic3.jpg" class="d-block w-100" alt="Kurzy u kafé">
                    <div class="carousel-caption d-none d-md-block">
                      <button class="btn btn-success" style="width: 40%; font-size: 2rem">Prohlédnout kruzy</button>
                    </div>
                  </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Předchozí</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Následující</span>
                </a>
              </div>
            </div>
    </div>
@endsection