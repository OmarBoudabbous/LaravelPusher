<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!-- User details -->
        @php
            // Get the authenticated user's ID
            $userId = Auth::user()->id;
            $profileData = App\Models\User::find($userId);
        @endphp

        <div class="user-profile text-center mt-3">
            <div class="">

                <img class="avatar-md rounded-circle"
                    src="{{ !empty($profileData->photo) ? url('images/' . $profileData->photo) : url('images/no_image.jpeg') }}"
                    alt="Header Avatar">
            </div>
            <div class="mt-3">
                <h4 class="font-size-16 mb-1">{{ $profileData->matricule }}</h4>
                <span class="text-muted"><i class="ri-record-circle-line align-middle font-size-14 text-success"></i>
                    Online</span>
            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    @if ($profileData->role === 'admin')
                        <a href="{{ route('admin.index') }}" class="waves-effect">
                            <i class="ri-dashboard-line"></i>
                            <span>Dashboard</span>
                        </a>

                </li>
                <li>
                    <a href="{{ route('admin.chef') }}" class=" waves-effect">
                        <i class="ri-user-line"></i>
                        <span>Ajouter Chef</span>
                    </a>
                </li>
                @endif
                @if ($profileData->role === 'chef')
                <li>
                    <a href="{{ route('panne') }}" class=" waves-effect">
                        <i class="ri-building-2-line"></i>
                        <span>Panne</span>
                    </a>
                </li>
                @endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
