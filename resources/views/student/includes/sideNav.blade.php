<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <div class="nav-link">
                <div class="user-wrapper">
                    <div class="profile-image">
                        <img src="{{ asset('cmds/images/faces/face1.jpg') }}" alt="profile image">
                    </div>
                    <div class="text-wrapper">
                        <p class="profile-name">Nderitu Kelvin</p>
                        <div>
                            <small class="designation text-muted">Student</small>
                            <span class="status-indicator online"></span>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('studentHome') }}">
                <i class="menu-icon mdi mdi-home"></i>
                <span class="menu-title">Home</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('studentUnitList') }}">
                <i class="menu-icon mdi mdi-nature-people"></i>
                <span class="menu-title">Units</span>
            </a>
        </li>
    </ul>
</nav>