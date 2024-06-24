@extends('layout.master')

@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="js-nav-scroller hs-nav-scroller-horizontal">
                <ul class="nav nav-tabs page-header-tabs" id="pageHeaderTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard.home') }}">home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('profile.page') }}">Profile page</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="row justify-content-lg-center">
            <div class="col-lg-9">
                <div class="card card-lg mb-3 mb-lg-5">
                    <div class="card-header">
                        <h4 class="card-header-title">Profile</h4>
                    </div>

                    {{-- form start here  --}}
                    <div class="d-grid gap-3 gap-lg-5">
                        <!-- Card -->
                        <div class="card">
                            <!-- Profile Cover -->
                            <div class="profile-cover">
                                <div class="profile-cover-img-wrapper">
                                    <img id="profileCoverImg" class="profile-cover-img"
                                        src="{{ asset('dist/assets/img/1920x400/img2.jpg') }}" alt="Image Description">
                                </div>
                            </div>

                            <form method="post" action="{{ route('updateInfo', ['user' => auth()->user()]) }}"
                                class="mt-6 space-y-6" enctype="multipart/form-data">
                                @csrf
                                @method('patch')
                                <!-- Avatar -->
                                <label class="avatar avatar-xxl avatar-circle avatar-uploader profile-cover-avatar"
                                    for="editAvatarUploaderModal">
                                    <img id="editAvatarImgModal" class="avatar-img"
                                        src="{{ $user->image != null ? asset($user->image) : asset('images/no-image1.jpg') }}"
                                        alt="Image Description">

                                    <input name="image" type="file" class="js-file-attach avatar-uploader-input"
                                        id="editAvatarUploaderModal"
                                        data-hs-file-attach-options='{
                                               "textTarget": "#editAvatarImgModal",
                                               "mode": "image",
                                               "targetAttr": "src",
                                               "allowTypes": [".png", ".jpeg", ".jpg", ".jpg", ".gif"]
                                           }'>
                                    <span class="avatar-uploader-trigger">
                                        <i class="bi-pencil-fill avatar-uploader-icon shadow-sm"></i>
                                    </span>
                                </label>


                                <div class="text-center">

                                    <h1 class="page-header-title">{{ Auth::user()->name }}<i
                                            class="bi-patch-check-fill fs-2 text-primary" data-bs-toggle="tooltip"
                                            data-bs-placement="top" title="Top endorsed"></i></h1>

                                    <!-- List -->
                                    <ul class="list-inline list-px-2">
                                        <li class="list-inline-item">
                                            <i class="bi-phone me-1"></i>
                                            <span> Tel: {{ Auth::user()->phone ?? 'No phone' }}</span>
                                        </li>

                                        <li class="list-inline-item">
                                            <i class="bi bi-person me-1"></i>
                                            <span>Role: {{ Auth::user()->role ?? 'No Role' }}</span>


                                        </li>

                                        <li class="list-inline-item">
                                            <i class="bi bi-envelope me-1"></i>
                                            <span>Email: {{ Auth::user()->email ?? 'No Email' }}</span>
                                        </li>
                                    </ul>
                                </div>
                                <!-- End Avatar -->

                                <!-- Body -->
                                          <div class="card-header">
                            <h4 class="card-title">Change your Information</h4>
                        </div>
                                <div class="card-body">
                         
                                    <div class="row mb-4">
                                        <label for="newEmailLabel" class="col-sm-3 col-form-label form-label">
                                            New User Name
                                        </label>
                                        <div class="col-sm-9">
                                            <input id="name" name="name" type="text" class="form-control"
                                                placeholder="{{ Auth::user()->name }}">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <label for="newEmailLabel" class="col-sm-3 col-form-label form-label">
                                            New email address
                                        </label>
                                        <div class="col-sm-9">
                                            <input type="email" class="form-control" name="newEmail" id="newEmailLabel"
                                                placeholder="{{ Auth::user()->email }}">
                                        </div>
                                    </div>


                                        <div class="row mb-4">
                                        <label for="newEmailLabel" class="col-sm-3 col-form-label form-label">
                                            New Phone Number
                                        </label>
                                        <div class="col-sm-9">
                                            <input type="tel" class="form-control" name="newPhone" id="newEmailLabel"
                                                placeholder="{{ Auth::user()->phone }}">
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div id="passwordSection" class="card mt-3">
                        <div class="card-header">
                            <h4 class="card-title">Change your password</h4>
                        </div>
                        <!-- Body -->
                        <div class="card-body">
                            <!-- Form -->
                            <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6"
                                id="changePasswordForm">
                                @csrf
                                @method('put')
                                <div class="row mb-4">
                                    <label for="currentPasswordLabel" class="col-sm-3 col-form-label form-label">
                                        Current password
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" name="current_password"
                                            id="currentPasswordLabel" placeholder="Enter current password"
                                            aria-label="Enter current password">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="newPassword" class="col-sm-3 col-form-label form-label">
                                        New password
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" name="password" id="newPassword"
                                            placeholder="Enter new password" aria-label="Enter new password">
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <label for="confirmNewPasswordLabel" class="col-sm-3 col-form-label form-label">
                                        Confirm new password
                                    </label>
                                    <div class="col-sm-9">
                                        <div class="mb-3">
                                            <input type="password" class="form-control" name="password_confirmation"
                                                id="confirmNewPasswordLabel" placeholder="Confirm your new password"
                                                aria-label="Confirm your new password">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="stickyBlockEndPoint"></div>
    </div>
@endsection
