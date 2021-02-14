@extends('otaku.layouts.app')

@section('extra-lib-css')
<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/fonts/simple-line-icons/style.min.css') }}">
<!-- END: Page CSS-->
@endsection
@section('extra-lib-js')
{{-- BEGIN: Page Vendor JS --}}

{{-- BEGIN: Page JS --}}

@endsection
@section('extra-script')
<script type="text/javascript">
    function toggle_element(marking) {
        $(marking).toggle('fast');
        return true;
    }
    function f_detail(type, mal_id) {
        $.ajax({
         type:"get",
         url:'https://api.jikan.moe/v3/'+type+'/'+mal_id,
         // data: dataForm,
         success: function(data){
          console.log(data)
          var name_idx = ['type', 'status', 'rating', 'popularity', 'favorites', 'score', 'episodes', 'rank', 'members', 'synopsis', 'title'];
          // Pasang Link Image URl
          $('#information_image_url').attr('src',data['image_url']);

          for (var i = 0; i < name_idx.length; i++) {
              var tmpValue = '-';
              // kalo type manga dan idx name nya episode
              if (type == 'manga' && name_idx[i] == 'episodes') { 
                tmpValue = data['chapters']+'/'+data['volumes']; 
                $('#information_'+name_idx[i]).next().html('Jumlah Chapter/Volume')
              }
              // check data ada atau tidak, kalo ada ambil value-nya
              else if (data[name_idx[i]]) { tmpValue = data[name_idx[i]]; }
              $('#information_'+name_idx[i]).html(tmpValue)
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
            toggle_element('#loader-section');
            toggle_element('#header-section');
            toggle_element('#body-section');
        });
    }
    $( document ).ready(function() {
        f_detail("{{ $data['type'] }}", {{ $data['mal_id'] }})
    });
</script>
@endsection

@section('content')

<div class="content-overlay"></div>
<div class="content-wrapper">
    <div class="content-header row">
    </div>
    <div class="content-body">
        <section id="loader-section" class="card overflow-hidden ml-4 mr-0 mt-0">
            <div class="card-body">
                <div class="text-center">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
        </section>
        <section id="header-section" class="card overflow-hidden ml-4 mr-0 mt-0" style="display: none;">
            <div class="card-header">
                <h4 class="card-title" id="information_title"></h4>
                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
            </div>
        </section>
        <section id="body-section" class="card overflow-hidden ml-4 mr-0 mt-0" style="display: none;">
            <div class="card-content">
                <div class="row">
                    <div class="col-lg-3 col-md-5 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <figure class="col-lg-12 col-xl-12 col-12" itemprop="associatedMedia" itemscope="" itemtype="http://schema.org/ImageObject">
                                        <a href="#" itemprop="contentUrl" data-size="600x446">
                                            <img class="img-thumbnail img-fluid rounded mx-auto d-block" id="information_image_url" src="" itemprop="thumbnail" alt="Image description">
                                        </a>
                                    </figure>
                                </div>
                                <div class="row pt-1">
                                    <div class="card-header">
                                        <h5 class="card-title">Informasi</h5>
                                        <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 border-bottom pb-2 pt-1">
                                                <span class="text-capitalize text-dark">Tipe: </span>
                                                <span id="information_type" class="float-right text-dark text-capitalize">Type nya</span>
                                            </div>
                                            <div class="col-12 border-bottom pb-2 pt-1">
                                                <span class="text-capitalize text-dark">Status: </span>
                                                <span id="information_status" class="float-right text-dark text-capitalize">Type nya</span>
                                            </div>
                                            <div class="col-12 border-bottom pb-2 pt-1">
                                                <span class="text-capitalize text-dark">Rating: </span>
                                                <span id="information_rating" class="float-right text-dark text-capitalize">Type nya</span>
                                            </div>
                                            <div class="col-12 border-bottom pb-2 pt-1">
                                                <span class="text-capitalize text-dark">Kepopuleran: </span>
                                                <span id="information_popularity" class="float-right text-dark text-capitalize">Type nya</span>
                                            </div>
                                            <div class="col-12 border-bottom pb-2 pt-1">
                                                <span class="text-capitalize text-dark">Favorites: </span>
                                                <span id="information_favorites" class="float-right text-dark text-capitalize">Type nya</span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-7 col-sm-12 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
                                        <div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
                                            <span class="card-icon primary d-flex justify-content-center mr-3">
                                                <i class="icon p-1 icon-bar-chart customize-icon font-large-2 p-1"></i>
                                            </span>
                                            <div class="stats-amount mr-3">
                                                <h3 class="heading-text text-bold-600" id="information_score"></h3>
                                                <p class="sub-heading">Skor</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
                                        <div class="d-flex align-items-start mb-sm-1 mb-xl-0 border-right-blue-grey border-right-lighten-5">
                                            <span class="card-icon danger d-flex justify-content-center mr-3">
                                                <i class="icon p-1 icon-pie-chart customize-icon font-large-2 p-1"></i>
                                            </span>
                                            <div class="stats-amount mr-3">
                                                <h3 class="heading-text text-bold-600" id="information_episodes"></h3>
                                                <p class="sub-heading">Jumlah Episode</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
                                        <div class="d-flex align-items-start border-right-blue-grey border-right-lighten-5">
                                            <span class="card-icon success d-flex justify-content-center mr-3">
                                                <i class="icon p-1 icon-graph customize-icon font-large-2 p-1"></i>
                                            </span>
                                            <div class="stats-amount mr-3">
                                                <h3 class="heading-text text-bold-600" id="information_rank"></h3>
                                                <p class="sub-heading">Rank</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xl-3 col-sm-6 col-12">
                                        <div class="d-flex align-items-start">
                                            <span class="card-icon warning d-flex justify-content-center mr-3">
                                                <i class="icon p-1 icon-basket-loaded customize-icon font-large-2 p-1"></i>
                                            </span>
                                            <div class="stats-amount mr-3">
                                                <h3 class="heading-text text-bold-600" id="information_members"></h3>
                                                <p class="sub-heading">Member</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-xl-12 col-12 col-md-12">
                                        <div class="card-header">
                                            <h4 class="card-title">Sinopsis</h4>
                                            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                        </div>
                                        <div class="card-body">
                                            <p id="information_synopsis"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </section>
    </div>

</div>
@endsection
