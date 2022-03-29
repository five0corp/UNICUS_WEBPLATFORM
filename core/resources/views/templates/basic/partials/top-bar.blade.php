 <!--topbar-->
 <section class="top-main">
 <!-- <div class="top-main"> -->
   <div class="container">
     <div class="row">
       <div class="col-xxl-2 col-lg-4 col-md-3 logo p-1 d-block d-sm-block d-md-block d-lg-none"><a href="{{ route('home')}}"> <img class="img-fluid" src="{{ asset('assets/images/frontend/logo.png') }}" alt=""></a></div>
       <div class="col-xxl-2 col-lg-2 col-md-12 logo p-1 d-none d-sm-none d-md-none d-lg-block"><a href="{{ route('home')}}"> <img class="img-fluid" src="{{ asset('assets/images/frontend/logo.png') }}" alt=""></a></div>
       <!-- <div class="col-xxl-3 col-lg-3 col-md-6 col-10 m-auto">
         <form class="form-inline my-2 my-lg-0">
           <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
         </form>
       </div> -->
       <div class="col-xxl-8 col-lg-8 col-md-2 col-2 text-center d-none d-sm-none d-md-none d-lg-block">
         <nav class="navbar navbar-expand-lg navbar-light d-inline-block">
           <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
           </button>

           <div class="collapse navbar-collapse" id="navbarSupportedContent">
             <ul class="navbar-nav mr-auto">
               <li class="nav-item active">
                 <a class="nav-link" href="{{route('blog')}}">Notice</a>
               </li>


               <!-- <li class="nav-item">
                 <a class="nav-link" href="list.php">Auction</a>
               </li> -->
               <li class="nav-item">
                 <a class="nav-link" href="{{route('product') }}">Artworks</a>
               </li>
               <li class="nav-item">
                 <a class="nav-link" href="{{route('community') }}">Community</a>
               </li>
               <li class="nav-item">
                 <a class="nav-link" href="https://unic-a.io/" target="_blank">Unicus Coin</a>
               </li>
             </ul>

           </div>
         </nav>
       </div>
       <div class="col-xxl-5 col-lg-5 col-md-2 col-2  d-block d-sm-block d-md-block d-lg-none">
         <nav class="navbar navbar-expand-lg navbar-light ">
           <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
           </button>
           </nav>
       </div>
       <div class="col-xxl-5 col-lg-5 col-md-2 col-12  d-block d-sm-block d-md-block d-lg-none">
           <div class="collapse navbar-collapse" id="navbarSupportedContent">
             <ul class="navbar-nav mr-auto">
               <li class="nav-item active">
                 <a class="nav-link" href="{{route('blog')}}">Notice</a>
               </li>


               <!-- <li class="nav-item">
                 <a class="nav-link" href="list.php">Auction</a>
               </li> -->
               <li class="nav-item">
                 <a class="nav-link" href="{{route('product') }}">Artworks</a>
               </li>
               <li class="nav-item">
                 <a class="nav-link" href="{{route('community') }}">Community</a>
               </li>
               @if(auth()->user())
               <li class="nav-item">
                 <a class="nav-link" href="{{ route('profile','dashboard') }}">My Profile</a>
               </li>
               <li>
                 <a class="nav-link" href="{{ route('user.logout') }}">Logout</a>
               </li>
               @else
               <li>
                 <a class="nav-link" href="{{ route('user.login') }}">Login</a>
               </li>
               @endif
             </ul>

           </div>
         
       </div>
       <div class="col-xxl-2 col-lg-2 col-md-12 col-12 d-none d-sm-none d-md-none d-lg-block">
         <div class="top-icon pull-right">
           <ul>
             <li><a href="{{ route('profile','dashboard') }}"><img src="{{ asset('assets/images/frontend/user.png') }}" width="30px" alt=""></a></li>
             @if(auth()->user())
             <li><a href="{{ route('user.logout') }}"><img src="{{ asset('assets/images/frontend/switch.png') }}" style="width:30px" alt=""></a></li>
             @endif
             <!-- <li><a href=""><img src="{{ asset('assets/images/frontend/icon2.png') }}" alt=""></a></li>
             <li><a href=""><img src="{{ asset('assets/images/frontend/icon3.png') }}" alt=""></a></li>
             <li><a href=""><img src="{{ asset('assets/images/frontend/icon4.png') }}" alt=""></a></li> -->
           </ul>
         </div>
       </div>
     </div>
   </div>
 <!-- </div> -->
 </section>
 <!--topbar-->