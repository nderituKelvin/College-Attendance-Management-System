<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <div class="nav-link">
                <div class="user-wrapper">
                    <div class="profile-image">
                        <img src="{{ asset('storage/images/'.\App\Photo::where('native', 'user')->where('nativeid', \Illuminate\Support\Facades\Auth::user()->getAuthIdentifier())->first()->name) }}" alt="profile image">
                    </div>
                    <div class="text-wrapper">
                        <p class="profile-name">{{ \Illuminate\Support\Facades\Auth::user()->name }}</p>
                        <div>
                            <small class="designation text-muted">Lecturer</small>
                            <span class="status-indicator online"></span>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('lecturerHome') }}">
                <i class="menu-icon mdi mdi-home"></i>
                <span class="menu-title">Home</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('lecturerUnits') }}">
                <i class="menu-icon mdi mdi-nature-people"></i>
                <span class="menu-title">Units</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('lecturerLectureList') }}">
                <i class="menu-icon mdi mdi-book-open"></i>
                <span class="menu-title">Lectures</span>
            </a>
        </li>
    </ul>
</nav>