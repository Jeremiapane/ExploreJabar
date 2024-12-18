<style>
    .profile-menu {
        position: relative;
        display: inline-block;
    }

    .profile-pic {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        cursor: pointer;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        right: 0;
        background-color: #ffffff;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {
        background-color: #f1f1f1;
    }
</style>

<div class="header-margin"></div>
<header data-add-bg="bg-white" class="header -fixed js-header" data-x="header" data-x-toggle="is-menu-opened">
    <div data-anim="fade" class="header__container header__container-1500 mx-auto px-30 sm:px-20">
        <div class="row justify-between items-center">

            <div class="col-auto">
                <div class="d-flex items-center">
                    <a href="{{route('wisatawan.landingpage')}}" class="header-logo mr-50" data-x="header-logo" data-x-toggle="is-logo-dark">
                        <img style="max-width: 85px" src="{{ asset('images/logo.png') }}" alt="logo icon">

                    </a>

                    <div class="header-menu " data-x="mobile-menu" data-x-toggle="is-menu-active">
                        <div class="mobile-overlay"></div>

                        <div class="header-menu__content">
                            <div class="mobile-bg js-mobile-bg"></div>

                            <div class="menu js-navList">
                                <ul class="menu__nav text-dark-1 -is-active">
                                    <li>
                                        <a href="{{route('wisatawan.landingpage')}}">Home</a>
                                    </li>
                                    <li>
                                        <a href="{{route('wisatawan.destination')}}">Wisata</a>
                                    </li>
                                    <li>
                                        <a href="{{route('wisatawan.aboutpage')}}">About</a>
                                    </li>
                                    <li>
                                        <a href="{{route('wisatawan.blogpage')}}">Artikel</a>
                                    </li>
                                    @if ($user)
                                    <li>
                                        <a href="{{route('wisatawan.pengaduan')}}">Pengaduan</a>
                                    </li>
                                    @endif
                                </ul>
                            </div>

                            <div class="mobile-footer px-20 py-20 border-top-light js-mobile-footer">
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-auto">
                <div class="d-flex items-center">
                    @if ($user)
                    @php
                    $profile_picture = \App\Models\Wisatawan::with('attachment')->where('id_user',$user->id)->first();
                    @endphp
                    <div class="profile-menu">
                        <img src="{{ asset(optional($profile_picture->attachment)->path) }}" alt="Image"
                            class="profile-pic" onclick="toggleDropdown()">
                        <div id="dropdownMenu" class="dropdown-content">
                            <a href="/booking">Booking</a>
                            <a href="/profile">Settings</a>
                            <a href="/logout">Logout</a>
                        </div>
                    </div>
                    @else
                    <div class="d-flex items-center ml-20 is-menu-opened-hide md:d-none">
                        <a href="/login" class="button px-30 fw-400 text-14 -blue-1 bg-dark-4 h-50 text-white">Masuk</a>
                        <a href="/signup"
                            class="button px-30 fw-400 text-14 border-dark-4 -blue-1 h-50 text-dark-4 ml-20">Daftar</a>
                    </div>
                    @endif
                    <div class="d-none xl:d-flex x-gap-20 items-center pl-30" data-x="header-mobile-icons"
                        data-x-toggle="text-white">
                        {{-- <div><a href="/login" class="d-flex items-center icon-user text-inherit text-22"></a></div>
                        --}}
                        <div><button class="d-flex items-center icon-menu text-inherit text-20"
                                data-x-click="html, header, header-logo, header-mobile-icons, mobile-menu"></button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</header>

<script>
    document.addEventListener("DOMContentLoaded", function() {
      const titleElement = document.querySelector(".js-dropdown-title");
      const currentPath = window.location.pathname;

      switch (currentPath) {
        case "/booking":
          titleElement.textContent = "Booking";
          break;
        case "/pengaduan":
          titleElement.textContent = "Pengaduan";
          break;
        case "/profile":
        default:
          titleElement.textContent = "Profile";
          break;
      }
    });

    function toggleDropdown() {
  var dropdown = document.getElementById("dropdownMenu");
  dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.profile-pic')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    for (var i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.style.display === "block") {
        openDropdown.style.display = "none";
      }
    }
  }
}

</script>
