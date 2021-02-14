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

@endsection
@section('extra-script')
<script type="text/javascript">
    function toggle_element(marking) {
        $(marking).toggle('fast');
        return true;
    }
    function f_seasonal(type) {
        $.ajax({
         type:"get",
         url:'https://api.jikan.moe/v3/season',
         // data: dataForm,
         success: function(data){
          var content = '';
          if (data['anime'].length > 0) {
            for (var i = 0; i < data['anime'].length; i++) {
                content = '<div class="grid-item">'
                content += '<figure class="card border-grey border-lighten-2" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">'
                content += '<a href="{{ url('detail') }}/'+type+'/'+data['anime'][i]['mal_id']+'" itemprop="contentUrl" data-size="600x446">'
                content += '<img class="gallery-thumbnail card-img-top" src="'+data['anime'][i]['image_url']+'" itemprop="thumbnail" alt="'+data['anime'][i]['title']+'" />'
                content += '</a>'
                content += '<div class="card-body px-0">'
                content += '<h4 class="card-title">'+data['anime'][i]['title']+' ['+data['anime'][i]['score']
                content += ' - '+data['anime'][i]['type'];
                content += ']</h4>'
                content += '</div>'
                content += '</figure>'
                content += '</div>\n'
                var $items = $(content);
                $('#'+type+'_result .image-result').append($items).masonry( 'appended', $items );
            }
            $('#'+type+'_result .image-result').masonry( 'reloadItems' );
            // console.log(content);
            // $('#'+type+'_result .image-result').html(content);
          }
          else {
            content = 'Tidak ditemukan.';
            $('#'+type+'_result .image-result').html(content);
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
            toggle_element('#'+type+'_result div .spinner-border');
        });
    }
    $( document ).ready(function() {
        toggle_element('.spinner-border');
        $('#anime_result .image-result').masonry({
          columnWidth: 200,
          itemSelector: '.grid-item'
        });
        f_seasonal('anime');
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
            <div class="col-lg-12 col-md-12 col-sm-12 col-12 ">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center">Anime Musim Ini</h4>

                    </div>
                    <div class="card-body" id="anime_result">

                        <div class="text-center">
                            <div class="spinner-border" role="status" style="display: none;">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        <div class="{{-- masonry-grid my-gallery --}} mx-1 image-result" itemscope itemtype="http://schema.org/ImageGallery">
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
