<x-app-layout>
    <div class="container-fluid">
        <div class="row">
            <div class="col-2 vertical-menu bg-admin" style="position: sticky; top: 0;">
                <!-- vertical menubar -->
                <nav>
                    <div class="logo d-flex align-items-center pt-3">
                        <img src="{{ asset('img/favicon/stud_com.png') }}" alt="logo" class="logo-image mt-1">
                        <h4 class="logo-title d-none d-lg-inline px-3 text-ucsp" style="font-size: x-large;">Studcom <span class="pageuser-role">(admin)</span></h>
                    </div>
                    <div class="divider bg-muted m-0 p-0 my-3" style="height: 1.1px;"></div>
                    <div class="d-flex flex-column flex-shrink-0">
                        <ul class="nav nav-pills flex-column mb-auto">
                            <h6 class="text-ucsp p-1 d-none d-lg-inline" style="font-size: 14px;">General</h6>
                            <li class="nav-item">
                                <a href="{{route('user@home')}}" class="nav-link link-body-emphasis" aria-current="page">
                                    <i class="bi-grid"></i>
                                    <span class="d-none d-lg-inline ms-3">Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('admin@manageAnnounce')}}" class="nav-link link-body-emphasis">
                                    <i class="bi-megaphone"></i>
                                    <span class="d-none d-lg-inline ms-3">Announcement</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('admin@manageUser')}}" class="nav-link link-body-emphasis">
                                    <i class="fa-solid fa-user-tie fa-lg"></i>
                                    <span class="d-none d-lg-inline ms-3">User</span>
                                </a>
                            </li>
                            <div class="divider bg-muted m-0 p-0 my-3" style="height: 0.7px;"></div>

                            <h6 class="text-ucsp p-1 d-none d-lg-inline mb-2" style="font-size: 14px;">Managemant</h6>
                            <li>
                                <a href="{{route('admin@manageTimetable')}}" class="nav-link link-body-emphasis">
                                    <i class="bi-table"></i>
                                    <span class="d-none d-lg-inline ms-3">Timetable</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('admin@manageDepartment')}}" class="nav-link link-body-emphasis">
                                    <i class="fa-solid fa-briefcase"></i>
                                    <span class="d-none d-lg-inline ms-3">Department</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('admin@manageGroup')}}" class="nav-link link-body-emphasis">
                                    <i class="bi bi-people-fill"></i>
                                    <span class="d-none d-lg-inline ms-3">Group</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('admin@manageGrade')}}" class="nav-link link-body-emphasis">
                                    <i class="fa-solid fa-medal"></i>
                                    <span class="d-none d-lg-inline ms-3">Grade</span>
                                </a>
                            </li>
                            <div class="divider bg-muted m-0 p-0 my-3" style="height: 1.1px;"></div>

                            <h6 class="text-ucsp p-1 d-none d-lg-inline mb-2" style="font-size: 14px;">Personal</h6>
                            <li class="d-none d-lg-inline">
                                <a href="{{route('admin@manageProfile')}}" class="nav-link active-vertical-menu">
                                    <i class="bi bi-gear-wide"></i>
                                    <span class="d-none d-lg-inline ms-3">Profile Settings</span>
                                </a>
                            </li>
                            <li class="d-none d-lg-inline mt-1">
                                <form action="{{route("logout")}}" method="post">
                                    @csrf
                                    <button type="submit" class="nav-link link-body-emphasis">
                                        <i class="bi bi-box-arrow-left"></i>
                                        <span class="d-none d-lg-inline ms-3">Log out</span>
                                    </button>
                                </form>
                            </li>
                        </ul>

                        <div class="d-lg-none">
                            <div class="dropdown">
                                <a href="#"
                                    class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    @if ($user->profile_photo == null)
                                    <i class="fa-solid fa-user-circle" style="font-size: 35px; color: #0097b2"></i>
                                    @else
                                    <img src="{{ asset('storage/upload/'.$user->profile_photo) }}" alt="profile" class="profile-icon rounded-circle">
                                    @endif
                                </a>
                                <ul class="dropdown-menu text-small shadow">
                                    <li>
                                        <a href="{{route('admin@manageProfile')}}" class="nav-link link-body-emphasis">
                                            <i class="bi bi-gear-wide"></i>
                                            <span class="d-none d-lg-inline ms-3">Profile Settings</span>
                                        </a>
                                    </li>
                                    <li>
                                        <form action="{{route("logout")}}" method="post">
                                            @csrf
                                            <button type="submit" class="nav-link link-body-emphasis">
                                                <i class="bi bi-box-arrow-left"></i>
                                                <span class="d-none d-lg-inline ms-3">Log out</span>
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>

            <!-- main content -->
            <div class="col-10 bg-light">
                <div class="horizontal-menu py-2 mt-1 d-flex justify-content-between align-items-center bg-light" style="position: sticky; top: 5px; z-index: 5;">
                    <h3 class="text-ucsp fw-bold fs-6 px-2">My Profile Settings</h3>
                    <div class="lg-profile d-flex justify-content-between">
                        <div class="d-flex">
                            <div class="position-relative p-2">
                                <a href="{{route('user@chat', ['back' => 'admin@manageProfile'])}}">
                                    <i class="bi bi-chat-fill text-ucsp px-2"></i>
                                <span
                                    class="position-absolute translate-middle  p-1 bg-danger border border-2 border-light rounded-circle absolute-message" style="top: 0.8rem; right: 0.4rem;"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="divider bg-muted m-0 p-0 mt-1" style="height: 1px;"></div>


                <div class="row text-dark">

                    <div>
                        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                                @livewire('profile.update-profile-information-form')

                                <x-section-border />
                            @endif

                            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                                <div class="mt-10 sm:mt-0">
                                    @livewire('profile.update-password-form')
                                </div>

                                <x-section-border />
                            @endif

                            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                                <div class="mt-10 sm:mt-0">
                                    @livewire('profile.two-factor-authentication-form')
                                </div>

                                <x-section-border />
                            @endif

                            <div class="mt-10 sm:mt-0">
                                @livewire('profile.logout-other-browser-sessions-form')
                            </div>

                            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                                <x-section-border />

                                <div class="mt-10 sm:mt-0">
                                    @livewire('profile.delete-user-form')
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@section('content')

@endsection
