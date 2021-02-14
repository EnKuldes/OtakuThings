@extends('otaku.layouts.app')

@section('extra-lib-css')
<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/fonts/simple-line-icons/style.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/js/gallery/photo-swipe/photoswipe.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/js/gallery/photo-swipe/default-skin/default-skin.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/gallery.min.css') }}">
<!-- END: Page CSS-->
@endsection
@section('extra-lib-js')
{{-- BEGIN: Page Vendor JS --}}
<script src="{{ asset('app-assets/vendors/js/gallery/masonry/masonry.pkgd.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/gallery/masonry/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/gallery/photo-swipe/photoswipe.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/gallery/photo-swipe/photoswipe-ui-default.min.js') }}"></script>
<script src="{{ asset('app-assets/js/scripts/gallery/photo-swipe/photoswipe-script.min.js') }}"></script>
{{-- BEGIN: Page JS --}}
{{-- <script src="{{ asset('app-assets/js/scripts/ui/scrollable.min.js') }}"></script> --}}

@endsection
@section('extra-script')
<script type="text/javascript">
    {{-- Variabel --}}
    var day_idx = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

    function toggle_element(marking) {
        $(marking).toggle('fast');
        return true;
    }
    function f_schedule(type) {
        $.ajax({
         type:"get",
         url:'https://api.jikan.moe/v3/schedule',
         // data: dataForm,
         success: function(data){
            var content = '';
            for (var j = 0; j < day_idx.length; j++) {
                if (data[day_idx[j]].length > 0) {
                    for (var i = 0; i < data[day_idx[j]].length; i++) {
                        content = '<div class="grid-item">'
                        content += '<figure class="card border-grey border-lighten-2" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">'
                        content += '<a href="{{ url('detail') }}/'+type+'/'+data[day_idx[j]][i]['mal_id']+'" itemprop="contentUrl" data-size="300x225">'
                        content += '<img class="gallery-thumbnail card-img-top" src="'+data[day_idx[j]][i]['image_url']+'" itemprop="thumbnail" alt="'+data[day_idx[j]][i]['title']+'" />'
                        content += '</a>'
                        content += '<div class="card-body px-0">'
                        content += '<h4 class="card-title">'+data[day_idx[j]][i]['title']+' ['+data[day_idx[j]][i]['score']
                        content += ' - '+data[day_idx[j]][i]['type'];
                        content += ']</h4>'
                        content += '</div>'
                        content += '</figure>'
                        content += '</div>\n'
                        var $items = $(content);
                        $('#'+day_idx[j]+'-schedule .image-result').append($items).masonry( 'appended', $items );
                    }
                    $('#'+day_idx[j]+'-schedule .image-result').masonry( 'reloadItems' );
                }
                else {
                    content = 'Tidak ditemukan.';
                    $('#'+day_idx[j]+'-schedule .image-result').html(content);
                }
            }
        },
          error: function(jqXhr, json, errorThrown){// this are default for ajax errors
            var errors = jqXhr.responseJSON;
            var errorsHtml = '<div class="alert alert-danger alert-dismissible" role="alert" style="margin-bottom: 0;"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Error ' + jqXhr.status + ': ' + errorThrown + '</div>';
            toastr_me("error", "Error " + jqXhr.status, errorThrown);
            $.each(errors['errors'], function (index, value) {
              errorsHtml += '<div class="alert alert-danger alert-dismissible" role="alert" style="margin-bottom: 0;><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + value + '</div>';
              toastr_me("error", "Error Field", value);
            });
          }
        }).always(function(){
            for (var i = 0; i < day_idx.length; i++) {
                toggle_element('#'+day_idx[i]+'-schedule div .spinner-border');
            }
        });
    }
    $( document ).ready(function() {
        toggle_element('.spinner-border');
        for (var i = 0; i < day_idx.length; i++) {
            $('#'+day_idx[i]+'-schedule .image-result').masonry({
              columnWidth: 200,
              itemSelector: '.grid-item'
            });
            new PerfectScrollbar('#'+day_idx[i]+'-schedule .image-result',{wheelPropagation:!0})
        }
        f_schedule('anime');
    });
</script>
@endsection

@section('content')

<div class="content-overlay"></div>
<div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body">
        <section id="search-results" class="row overflow-hidden ml-4 mr-0 mt-0">
            <div class="col-lg-4 col-md-12 col-sm-12 col-12 ">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center">Senin</h4>

                    </div>
                    <div class="card-body" id="monday-schedule">

                        <div class="text-center">
                            <div class="spinner-border" role="status" style="display: none;">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        <div class="{{-- masonry-grid my-gallery --}}  height-300 mx-1 image-result" itemscope itemtype="http://schema.org/ImageGallery">
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 col-12 ">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center">Selasa</h4>

                    </div>
                    <div class="card-body" id="tuesday-schedule">

                        <div class="text-center">
                            <div class="spinner-border" role="status" style="display: none;">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        <div class="{{-- masonry-grid my-gallery --}}  height-300 mx-1 image-result" itemscope itemtype="http://schema.org/ImageGallery">
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 col-12 ">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center">Rabu</h4>

                    </div>
                    <div class="card-body" id="wednesday-schedule">

                        <div class="text-center">
                            <div class="spinner-border" role="status" style="display: none;">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        <div class="{{-- masonry-grid my-gallery --}}  height-300 mx-1 image-result" itemscope itemtype="http://schema.org/ImageGallery">
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 col-12 ">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center">Kamis</h4>

                    </div>
                    <div class="card-body" id="thursday-schedule">

                        <div class="text-center">
                            <div class="spinner-border" role="status" style="display: none;">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        <div class="{{-- masonry-grid my-gallery --}}  height-300 mx-1 image-result" itemscope itemtype="http://schema.org/ImageGallery">
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 col-12 ">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center">Jum'at</h4>

                    </div>
                    <div class="card-body" id="friday-schedule">

                        <div class="text-center">
                            <div class="spinner-border" role="status" style="display: none;">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        <div class="{{-- masonry-grid my-gallery --}}  height-300 mx-1 image-result" itemscope itemtype="http://schema.org/ImageGallery">
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 col-12 ">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center">Sabtu</h4>

                    </div>
                    <div class="card-body" id="saturday-schedule">

                        <div class="text-center">
                            <div class="spinner-border" role="status" style="display: none;">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        <div class="{{-- masonry-grid my-gallery --}}  height-300 mx-1 image-result" itemscope itemtype="http://schema.org/ImageGallery">
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 col-12 ">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center">Minggu</h4>

                    </div>
                    <div class="card-body" id="sunday-schedule">

                        <div class="text-center">
                            <div class="spinner-border" role="status" style="display: none;">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        <div class="{{-- masonry-grid my-gallery --}}  height-300 mx-1 image-result" itemscope itemtype="http://schema.org/ImageGallery">
                        </div>
                    </div>

                </div>
            </div>

        </section>
        {{-- Photowipe --}}
        <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="pswp__bg"></div>
            <div class="pswp__scroll-wrap">
                <div class="pswp__container">
                    <div class="pswp__item"></div>
                    <div class="pswp__item"></div>
                    <div class="pswp__item"></div>
                </div>
                <div class="pswp__ui pswp__ui--hidden">
                    <div class="pswp__top-bar">
                        <div class="pswp__counter"></div>
                        <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                        <button class="pswp__button pswp__button--share" title="Share"></button>
                        <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                        <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                        <div class="pswp__preloader">
                            <div class="pswp__preloader__icn">
                                <div class="pswp__preloader__cut">
                                    <div class="pswp__preloader__donut"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                        <div class="pswp__share-tooltip"></div>
                    </div>
                    <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
                    </button>
                    <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
                    </button>
                    <div class="pswp__caption">
                        <div class="pswp__caption__center"></div>
                    </div>
                </div>
            </div>
        </div>
    {{-- Photowipe --}}
    </div>
</div>
@endsection
