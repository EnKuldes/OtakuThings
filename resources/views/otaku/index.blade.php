@extends('otaku.layouts.app')

@section('extra-lib-css')
<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/fonts/simple-line-icons/style.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/timeline.min.css') }}">
<!-- END: Page CSS-->
@endsection
@section('extra-lib-js')
{{-- BEGIN: Page Vendor JS --}}
<script src="{{ asset('app-assets/vendors/js/charts/raphael-min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/charts/morris.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/extensions/unslider-min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/js/timeline/horizontal-timeline.js') }}"></script>
{{-- BEGIN: Page JS --}}

@endsection
@section('extra-script')
<script type="text/javascript">
    function toggleAdvancedSearch() {
        $('#div_form_advanced').toggle('slow');
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
</script>
@endsection

@section('content')

<div class="content-overlay"></div>
<div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body">
        <div class="row full-height-vh-with-nav">
            <div class="col-12 d-flex align-items-center justify-content-center">
                <div class="col-lg-6 col-10">
                    <form id="form_query" method="get" action="{{ route('search') }}">
                        <img class="img-fluid mx-auto d-block pb-3 pt-4 width-30-per" src="{{ asset('app-assets/images/logo/stack-logo-dark-big.png') }}" alt="OtakuThings Search">
                        <fieldset class="form-group position-relative">
                            <input type="text" class="form-control form-control-xl input-xl" id="iconLeft1" placeholder="Explore OtakuThings ..." name="q" required="true" pattern=".{3,}">
                            {{-- <div class="form-control-position">
                                <i class="feather icon-mic font-medium-4"></i>
                            </div> --}}
                        </fieldset>
                    </form>
                    <div class="row py-2">
                        <div class="col-12 text-center">
                            <button type="submit" form="form_query" class="btn btn-primary btn-md"><i class="feather icon-search"></i> Search...</button>
                            <button type="button"class="btn btn-warning btn-md" onclick="toggleAdvancedSearch();"><i class="fa fa-cog"></i> Advanced search...</button>
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
                                                            <option value="-">Pilih Opsi</option>
                                                            <option value="tv">TV</option>
                                                            <option value="ova">OVA</option>
                                                            <option value="movie">MOVIE</option>
                                                            <option value="special">SPECIAL</option>
                                                            <option value="ona">ONA</option>
                                                            <option value="music">MUSIC</option>
                                                        </select>
                                                    </fieldset>
                                                </div>
                                                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <fieldset class="form-group">
                                                        <label for="StatusSelect">Status</label>
                                                        <select class="form-control" id="StatusSelect" name="status">
                                                            <option value="-">Pilih Opsi</option>
                                                            <option value="airing">AIRING</option>
                                                            <option value="completed">COMPLETED</option>
                                                            <option value="upcoming">UPCOMING</option>
                                                        </select>
                                                    </fieldset>
                                                </div>
                                                <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <fieldset class="form-group">
                                                        <label for="RatedSelect">Rated</label>
                                                        <select class="form-control" id="RatedSelect" name="rated">
                                                            <option value="-">Pilih Opsi</option>
                                                            <option value="g">G - All Ages</option>
                                                            <option value="pg">PG - Children</option>
                                                            <option value="pg13">PG-13 - Teens 13 or older</option>
                                                            <option value="r17">R - 17+ recommended (violence & profanity)</option>
                                                            <option value="r">R+ - Mild Nudity (may also contain violence & profanity)</option>
                                                            <option value="rx">Rx - Hentai (extreme sexual content/nudity)</option>
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
                                                        while ($i < $baris) {
                                                            echo '<div class="row">';
                                                            $j = 0;
                                                            while ($j < $jmlhKolom) {
                                                                if ($idx >= count($kode_genre)) break;
                                                                echo '<div class="col-sm-4 col-12"><fieldset class="checkboxsas"><label><input type="checkbox" value="'.$kode_genre[$idx].'" name="genre[]"> '.$nama_genre[$idx].' </label></fieldset></div>';
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
                                                            <option value="-">Pilih Opsi</option>
                                                            <option value="manga">MANGA</option>
                                                            <option value="novel">NOVEL</option>
                                                            <option value="oneshot">ONESHOT</option>
                                                            <option value="doujin">DOUJIN</option>
                                                            <option value="manhwa">MANHWA</option>
                                                            <option value="manhua">MANHUA</option>
                                                        </select>
                                                    </fieldset>
                                                </div>
                                                <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <fieldset class="form-group">
                                                        <label for="StatusSelect">Status</label>
                                                        <select class="form-control" id="StatusSelect" name="status">
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
                                                                while ($i < $baris) {
                                                                    echo '<div class="row">';
                                                                    $j = 0;
                                                                    while ($j < $jmlhKolom) {
                                                                        if ($idx >= count($kode_genre)) break;
                                                                        echo '<div class="col-sm-4 col-12"><fieldset class="checkboxsas"><label><input type="checkbox" value="'.$kode_genre[$idx].'" name="genre[]"> '.$nama_genre[$idx].' </label></fieldset></div>';
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
