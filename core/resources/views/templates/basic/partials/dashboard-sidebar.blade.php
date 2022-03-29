<div class="left-side wallet-left">
            
        
            <ul>
              <li><a href="{{ route('user.home') }}" class="{{request()->routeIs('user.home') ? 'active' : ''}}"> Dashboard</a></li>
              <li ><a href="{{ route('user.my-bids') }}" class="{{request()->routeIs('user.my-bids') ? 'active' : ''}}"> My Bidding History</a></li>
              <li><a href="{{ route('user.won-bids') }}" class="{{request()->routeIs('user.won-bids') ? 'active' : ''}}"> Won Bids</a></li>
              <li><a href="{{ route('user.profile.setting') }}" class="{{request()->routeIs('user.profile.setting') ? 'active' : ''}}"> Profile Setting</a></li>
              <li><a href="{{ route('user.change.password') }}" class="{{request()->routeIs('user.change.password') ? 'active' : ''}}"> Change Password</a></li>
              <li><a href="{{ route('user.logout') }}" class="{{request()->routeIs('user.logout') ? 'active' : ''}}"> Logout</a></li>
             
            </ul> 
         </div>