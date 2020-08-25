@extends ('web.layout.html')

@section ('seo_title'){{ $content->seo_title }}@endsection

@section ('seo_description'){{ $content->seo_description }}@endsection

@section ('javascript')
@endsection

@section ('css')
@endsection

@section ('body')
    {!! $content->body !!}
@endsection