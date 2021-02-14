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
    function toggleAdvancedSearch() {
        $('#div_form_advanced').toggle('slow');
    }
    function toggle_element(marking) {
        $(marking).toggle('fast');
        return true;
    }
    $('#form_query').on('submit', function(e){
        // e.preventDefault();
        var tempArray = $('#form_advanced_anime').serializeArray();
        for (var i = 0; i < tempArray.length; i++) {
            $("<input />").attr("type", "hidden")
              .attr("name", "advanced_anime_"+ tempArray[i]['name'])
              .attr("value", tempArray[i]['value'])
              .appendTo("#form_query");
        }
        var tempArray = $('#form_advanced_manga').serializeArray();
        for (var i = 0; i < tempArray.length; i++) {
            $("<input />").attr("type", "hidden")
              .attr("name", "advanced_manga_"+ tempArray[i]['name'])
              .attr("value", tempArray[i]['value'])
              .appendTo("#form_query");
        }
        // console.log($('#form_query').serializeArray())
        return true;
    });
    function f_search(type, form_query, form_advanced) {
        var dataForm = $(form_query).serializeArray();
        var tmpArray = $(form_advanced).serializeArray();
        for (var i = 0; i < tmpArray.length; i++) {
            dataForm.push(tmpArray[i]);
        }

        $.ajax({
         type:"get",
         url:'https://api.jikan.moe/v3/search/'+type,
         data: dataForm,
         success: function(data){
          var content = '';
          if (data['results'].length > 0) {
            for (var i = 0; i < data['results'].length; i++) {
                content = '<div class="grid-item">'
                content += '<figure class="card border-grey border-lighten-2" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">'
                content += '<a href="{{ url('detail') }}/'+type+'/'+data['results'][i]['mal_id']+'" itemprop="contentUrl" data-size="600x446">'
                content += '<img class="gallery-thumbnail card-img-top" src="'+data['results'][i]['image_url']+'" itemprop="thumbnail" alt="'+data['results'][i]['title']+'" />'
                content += '</a>'
                content += '<div class="card-body px-0">'
                content += '<h4 class="card-title">'+data['results'][i]['title']+' ['+data['results'][i]['score']
                if (type == 'anime') {
                    content += ' - '+data['results'][i]['rated'];
                }
                else{
                    content += ' - '+data['results'][i]['type'];
                }
                content += ']</h4>'
                content += '<p class="card-text">'+data['results'][i]['synopsis']+'</p>'
                content += '</div>'
                content += '</figure>'
                content += '</div>\n'
                var $items = $(content);
                $('#'+type+'_result .image-result').append($items).masonry( 'appended', $items );
            }
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
        $('#manga_result .image-result').masonry({
          columnWidth: 200,
          itemSelector: '.grid-item'
        });
        f_search('anime','#form_query', '#form_advanced_anime');
        f_search('manga','#form_query', '#form_advanced_manga');
    });
</script>
@endsection

@section('content')

<div class="content-overlay"></div>
<div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body">
        <section id="search-input" class="card overflow-hidden ml-4 mr-0 mt-0">
            <div class="card-header">
                <h4 class="card-title">Hasil pencarian</h4>
                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
            </div>
            <div class="card-content collapse show">
                <div class="card-body pb-0">
                    <fieldset class="form-group position-relative mb-0">
                        <form id="form_query" method="get" action="{{ route('search') }}">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-xl input-xl" id="iconLeft1" placeholder="Explore OtakuThings ..." name="q" required="true" value="{{ $data['q'] }}">
                                <div class="input-group-append" id="button-addon1">
                                    <button type="submit" form="form_query" class="btn btn-primary btn-md"><i class="feather icon-search"></i> Search...</button>
                                    <button type="button"class="btn btn-warning btn-md" onclick="toggleAdvancedSearch();"><i class="fa fa-cog"></i> Advanced search...</button>
                                </div>
                            </div>
                        </form>
                    </fieldset>
                </div>
                <!--Advanced Search-->
                <div class="row pt-3">
                    
                </div>
            </div>
            <div class="row py-1" id="div_form_advanced" style="display: none;">
                <div class="col-6 border-right">
                    <div class="card">
                        <div class="card-header">
                            <label for="basicTextarea" class="card-title">Anime</label>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form id="form_advanced_anime">
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <fieldset class="form-group">
                                                <label for="TypeSelect">Type</label>
                                                <select class="form-control" id="TypeSelect" name="type">
                                                    @php
                                                    $opt_value = ['-', 'tv', 'ova', 'movie', 'special', 'ona', 'music'];
                                                    $opt_desc = ['Pilih Opsi', 'TV', 'OVA', 'MOVIE', 'SPECIAL', 'ONA', 'MUSIC'];
                                                    for ($i=0; $i < count($opt_value) ; $i++) {
                                                        $selected = "";
                                                        if ($data['advanced_anime_type'] == $opt_value[$i]) {
                                                             $selected = "selected";
                                                         } 
                                                        echo '<option value="'.$opt_value[$i].'" '.$selected.'>'.$opt_desc[$i].'</option>';
                                                    }
                                                    @endphp
                                                </select>
                                            </fieldset>
                                        </div>
                                        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <fieldset class="form-group">
                                                <label for="StatusSelect">Status</label>
                                                <select class="form-control" id="StatusSelect" name="status">
                                                    @php
                                                    $opt_value = ['-', 'airing', 'completed', 'upcoming'];
                                                    $opt_desc = ['Pilih Opsi', 'AIRING', 'COMPLETED', 'UPCOMING'];
                                                    for ($i=0; $i < count($opt_value) ; $i++) {
                                                        $selected = "";
                                                        if ($data['advanced_anime_status'] == $opt_value[$i]) {
                                                             $selected = "selected";
                                                         } 
                                                        echo '<option value="'.$opt_value[$i].'" '.$selected.'>'.$opt_desc[$i].'</option>';
                                                    }
                                                    @endphp
                                                </select>
                                            </fieldset>
                                        </div>
                                        <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <fieldset class="form-group">
                                                <label for="RatedSelect">Rated</label>
                                                <select class="form-control" id="RatedSelect" name="rated">
                                                    @php
                                                    $opt_value = ['-', 'g', 'pg', 'pg13', 'r17', 'r', 'rx'];
                                                    $opt_desc = ['Pilih Opsi', 'G - All Ages', 'PG - Children', 'PG-13 - Teens 13 or older', 'R - 17+ recommended (violence & profanity)', 'R+ - Mild Nudity (may also contain violence & profanity)', 'Rx - Hentai (extreme sexual content/nudity)'];
                                                    for ($i=0; $i < count($opt_value) ; $i++) {
                                                        $selected = "";
                                                        if ($data['advanced_anime_rated'] == $opt_value[$i]) {
                                                             $selected = "selected";
                                                         } 
                                                        echo '<option value="'.$opt_value[$i].'" '.$selected.'>'.$opt_desc[$i].'</option>';
                                                    }
                                                    @endphp
                                                </select>
                                            </fieldset>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                            <fieldset class="checkboxsas">
                                                <label for="GenreCheckBox">Genre</label>
                                                @php
                                                $kode_genre = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43];
                                                $nama_genre = ['Action', 'Adventure', 'Cars', 'Comedy', 'Dementia', 'Demons', 'Mystery', 'Drama', 'Ecchi', 'Fantasy', 'Game', 'Hentai', 'Historical', 'Horror', 'Kids', 'Magic', 'MartialArts', 'Mecha', 'Music', 'Parody', 'Samurai', 'Romance', 'School', 'SciFi', 'Shoujo', 'ShoujoAi', 'Shounen', 'ShounenAi', 'Space', 'Sports', 'SuperPower', 'Vampire', 'Yaoi', 'Yuri', 'Harem', 'SliceOfLife', 'Supernatural', 'Military', 'Police', 'Psychological', 'Thriller', 'Seinen', 'Josei'];
                                                $jmlhKolom = 3;
                                                $baris = ceil(count($kode_genre)/$jmlhKolom);
                                                $idx = 0;
                                                $i = 0;
                                                $idxGenre = 0;
                                                while ($i < $baris) {
                                                    echo '<div class="row">';
                                                    $j = 0;
                                                    while ($j < $jmlhKolom) {
                                                        if ($idx >= count($kode_genre)) break;
                                                        $selected = "";
                                                        if (!empty($data['advanced_anime_genre'])) {
                                                            if ($idxGenre < count($data['advanced_anime_genre']) AND $data['advanced_anime_genre'][$idxGenre] == $kode_genre[$idx]) {
                                                                 $selected = "checked";
                                                                 $idxGenre++;
                                                             } 
                                                        }
                                                        echo '<div class="col-sm-4 col-12"><fieldset class="checkboxsas"><label><input type="checkbox" value="'.$kode_genre[$idx].'" name="genre[]" '.$selected.'> '.$nama_genre[$idx].' </label></fieldset></div>';
                                                        $idx++;
                                                        $j++;
                                                    }
                                                    echo '</div>';
                                                    $i++;
                                                }
                                                @endphp
                                            </fieldset>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 border-left">
                    <div class="card">
                        <div class="card-header">
                            <label for="basicTextarea" class="card-title">Manga</label>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form id="form_advanced_manga">
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <fieldset class="form-group">
                                                <label for="TypeSelect">Type</label>
                                                <select class="form-control" id="TypeSelect" name="type">
                                                    @php
                                                    $opt_value = ['-', 'manga', 'novel', 'oneshot', 'doujin', 'manhwa', 'manhua'];
                                                    $opt_desc = ['Pilih Opsi', 'MANGA', 'NOVEL', 'ONESHOT', 'DOUJIN', 'MANHWA', 'MANHUA'];
                                                    for ($i=0; $i < count($opt_value) ; $i++) {
                                                        $selected = "";
                                                        if ($data['advanced_manga_type'] == $opt_value[$i]) {
                                                             $selected = "selected";
                                                         } 
                                                        echo '<option value="'.$opt_value[$i].'" '.$selected.'>'.$opt_desc[$i].'</option>';
                                                    }
                                                    @endphp
                                                </select>
                                            </fieldset>
                                        </div>
                                        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <fieldset class="form-group">
                                                <label for="StatusSelect">Status</label>
                                                <select class="form-control" id="StatusSelect" name="status">
                                                    @php
                                                    $opt_value = ['-', 'publishing', 'completed', 'upcoming'];
                                                    $opt_desc = ['Pilih Opsi', 'PUBLISHING', 'COMPLETED', 'UPCOMING'];
                                                    for ($i=0; $i < count($opt_value) ; $i++) {
                                                        $selected = "";
                                                        if ($data['advanced_manga_status'] == $opt_value[$i]) {
                                                             $selected = "selected";
                                                         } 
                                                        echo '<option value="'.$opt_value[$i].'" '.$selected.'>'.$opt_desc[$i].'</option>';
                                                    }
                                                    @endphp
                                                    <option value="-">Pilih Opsi</option>
                                                    <option value="publishing">PUBLISHING</option>
                                                    <option value="completed">COMPLETED</option>
                                                    <option value="upcoming">UPCOMING</option>
                                                </select>
                                            </fieldset>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                            <fieldset class="checkboxsas">
                                                <label for="GenreCheckBox">Genre</label>
                                                <table id="GenreCheckBox" class="table">
                                                    <tbody>
                                                        @php
                                                        $kode_genre = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45];
                                                        $nama_genre = ['Action', 'Adventure', 'Cars', 'Comedy', 'Dementia', 'Demons', 'Mystery', 'Drama', 'Ecchi', 'Fantasy', 'Game', 'Hentai', 'Historical', 'Horror', 'Kids', 'Magic', 'MartialArts', 'Mecha', 'Music', 'Parody', 'Samurai', 'Romance', 'School', 'SciFi', 'Shoujo', 'ShoujoAi', 'Shounen', 'ShounenAi', 'Space', 'Sports', 'SuperPower', 'Vampire', 'Yaoi', 'Yuri', 'Harem', 'SliceOfLife', 'Supernatural', 'Military', 'Police', 'Psychological', 'Seinen', 'Josei', 'Doujinshi', 'GenderBender', 'Thriller'];
                                                        $jmlhKolom = 3;
                                                        $baris = ceil(count($kode_genre)/$jmlhKolom);
                                                        $idx = 0;
                                                        $i = 0;
                                                        $idxGenre = 0;
                                                        while ($i < $baris) {
                                                            echo '<div class="row">';
                                                            $j = 0;
                                                            while ($j < $jmlhKolom) {
                                                                if ($idx >= count($kode_genre)) break;
                                                                $selected = "";
                                                                if (!empty($data['advanced_manga_genre'])) {
                                                                    if ($idxGenre < count($data['advanced_manga_genre']) AND $data['advanced_manga_genre'][$idxGenre] == $kode_genre[$idx]) {
                                                                       $selected = "checked";
                                                                       $idxGenre++;
                                                                    } 
                                                                }
                                                                echo '<div class="col-sm-4 col-12"><fieldset class="checkboxsas"><label><input type="checkbox" value="'.$kode_genre[$idx].'" name="genre[]" '.$selected.'> '.$nama_genre[$idx].' </label></fieldset></div>';
                                                                $idx++;
                                                                $j++;
                                                            }
                                                            echo '</div>';
                                                            $i++;
                                                        }
                                                        @endphp
                                                    </tbody>
                                                </table>
                                            </fieldset>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <section id="search-results" class="row overflow-hidden ml-4 mr-0 mt-0">
            <div class="col-lg-6 col-md-12 col-sm-12 col-12 ">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center">Anime</h4>

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
            <div class="col-lg-6 col-md-12 col-sm-12 col-12 ">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center">Manga</h4>

                    </div>
                    <div class="card-body" id="manga_result">

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
