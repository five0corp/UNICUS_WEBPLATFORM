<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{$general->sitename}}</title>

  <meta name="csrf-token" content="{{ csrf_token() }}" />

  <link rel="stylesheet" type="text/css" href="{{asset('assets/global/css/bootstrap.min.css')}}" />

  <!-- main -->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/global/css/main.css')}}?v={{time()}}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/global/css/responsive.css') }}?v={{time()}}" />
  <link rel="stylesheet" href="{{ asset('assets/global/css/bootstrap-icons.css') }}">
  <!-- fontawesome -->
  <link rel="stylesheet" href="{{ asset('assets/global/css/font-awesome.min.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/global/css/owl.carousel.min.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/global/css/owl.theme.default.min.css') }}" />

  <!-- fonts -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;900&display=swap" rel="stylesheet">



  <!-- <link href="{{ asset('core/public/css/app.css').'?v='.time() }}" rel="stylesheet"> -->
  <script src="{{ asset('core/public/js/app.js').'?v='.time() }}"></script>
  <!-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/global/css/main.css').'?v='.time() }}" /> -->
  <!-- <link href="https://cdn.quilljs.com/1.0.0/quill.snow.css" rel="stylesheet" /> -->
  @stack('style')
</head>

<body>
  @include($activeTemplate . 'partials.top-bar')
  @include('partials.notify')
  @yield('content')

  @include($activeTemplate . 'partials.bottom-bar')
  <br>
  <script type="text/javascript" src="{{ asset('assets/global/js/jquery-2.1.4.min.js') }}"></script>
  <script src="{{ asset('assets/global/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/global/js/owl.carousel.js') }}"></script>

  <script src="{{ asset('assets/global/js/nicEdit.js') }}"></script>

  <!--fixed topbar-->
  <script>
    // document.addEventListener("DOMContentLoaded", function(){
    //   window.addEventListener('scroll', function() {
    //       if (window.scrollY > 0) {
    //         document.getElementById('navbar_top').classList.add('fixed-top');
    //         // add padding top to show content behind navbar
    //         navbar_height = document.querySelector('.navbar').offsetHeight;
    //         document.body.style.paddingTop = navbar_height + 'px';
    //       } else {
    //         document.getElementById('navbar_top').classList.remove('fixed-top');
    //         // remove padding top from body
    //         document.body.style.paddingTop = '0';
    //       } 
    //   });
    // }); 
    // DOMContentLoaded  end
  </script>

  <!--fixed topbar-->
  @stack('script')

  <script>
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  </script>

  <script>
    $(document).ready(function() {
      var owl = $('#artist');
      owl.owlCarousel({
        margin: 20,
        nav: true,
        loop: true,
        responsive: {
          0: {
            items: 1
          },
          768: {
            items: 2
          },
          1000: {
            items: 4
          }
        }
      })

      var owl = $('#collection');
      owl.owlCarousel({
        margin: 20,
        nav: true,
        loop: true,
        responsive: {
          0: {
            items: 1
          },
          768: {
            items: 2
          },
          1000: {
            items: 4
          },
        }
      })
    })



    $(document).ready(function() {
      var owl = $('#live');
      owl.owlCarousel({
        margin: 10,
        nav: false,
        loop: true,
        stagePadding: 50,
        responsive: {
          0: {
            items: 1
          },
          768: {
            items: 2
          },
          1000: {
            items: 4
          },
          1920: {
            items: 4
          },
        }
      });

      var owl = $('#partnerSlider');
      owl.owlCarousel({
        margin: 10,
        nav: true,
        loop: true,
        responsive: {
          0: {
            items: 1
          },
          768: {
            items: 4
          },
          1000: {
            items: 4
          },
          1920: {
            items: 4
          },
        }
      });

      var owl = $('#articalSlider');
      owl.owlCarousel({
        margin: 10,
        nav: true,
        loop: true,
        responsive: {
          0: {
            items: 1
          },
          768: {
            items: 2
          },
          1000: {
            items: 4
          },
          1920: {
            items: 4
          },
        }
      });

      var width = $('#artist.owl-carousel .owl-item img').width();
      $('#artist.owl-carousel .owl-item img').css('height', width);
      $('#collection.owl-carousel .owl-item img').css('height', width);

    //   var lwidth = $('.listing-product .caro-img img').width();
    //   $('.listing-product .caro-img img').css('height', lwidth);

      var myCarousel = document.querySelector('#myCarousel')
      var carousel = new bootstrap.Carousel(myCarousel, {
        interval: 500,
        wrap: true
      })
      var slides = document.querySelectorAll('#myCarousel.carousel .carousel-item')

      slides.forEach((el) => {
        // number of slides per carousel-item
        const minPerSlide = slides.length
        let next = el.nextElementSibling
        for (var i = 1; i < minPerSlide; i++) {
          if (!next) {
            // wrap carousel by using first child
            next = slides[0]
          }
          let cloneChild = next.cloneNode(true)
          el.appendChild(cloneChild.children[0])
          next = next.nextElementSibling
        }
      })
    })

    function copyText() {
      /* Get the text field */
      var copyText = document.getElementById("contract-address");
      copyText.select();
      copyText.setSelectionRange(0, 99999);
      navigator.clipboard.writeText(copyText.value);
      var tooltip = document.getElementById("myTooltip1");
      tooltip.innerHTML = "Copied: " + copyText.value;
    }

    function outFunc() {
      var tooltip = document.getElementById("myTooltip1");
      tooltip.innerHTML = "Copy to clipboard";
    }
  </script>
  <script>
    "use strict";
    bkLib.onDomLoaded(function() {
      $(".nicEdit").each(function(index) {
        $(this).attr("id", "nicEditor" + index);
        new nicEditor({
          fullPanel: true
        }).panelInstance('nicEditor' + index, {
          hasPanel: true
        });
      });
    });
    (function($) {
      $(document).on('mouseover ', '.nicEdit-main,.nicEdit-panelContain', function() {
        $('.nicEdit-main').focus();
      });
    })(jQuery);
  </script>
</body>

</html>