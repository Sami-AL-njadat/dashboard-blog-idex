 @extends('layout.master')

 @section('content')
     <div class="content container-fluid">

         <div class="page-header">


             <div class="js-nav-scroller hs-nav-scroller-horizontal">
                 <ul class="nav nav-tabs page-header-tabs" id="pageHeaderTab" role="tablist">
                     <li class="nav-item">
                         <a class="nav-link " href="{{ route('user.index') }}">User</a>
                     </li>

                     <li class="nav-item">
                         <a class="nav-link active" href="{{ route('user.create') }}">New User</a>
                     </li>
                 </ul>
             </div>
         </div>
         <div class="row justify-content-lg-center">
             <div class="col-lg-9">
                 <div class="card card-lg mb-3 mb-lg-5">
                     <div class="card-header">
                         <h4 class="card-header-title">New User</h4>
                     </div>


                     {{-- form start here  --}}
                     <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                         @csrf
                         <div class="card-body">
                             <div class="mb-4">
                                 <label for="inputGroupLightFullName" class="form-label">Full name
                                     <i class="bi-question-circle text-body ms-1" data-bs-toggle="tooltip"
                                         data-bs-placement="top" title="The Namr Is Required"></i>
                                 </label>

                                 <div class="input-group input-group-merge input-group-light">
                                     <div class="input-group-prepend input-group-text" id="inputGroupLightFullNameAddOn">
                                         <i class="bi-person"></i>
                                     </div>
                                     <input name="name" type="text" class="form-control" id="inputGroupLightFullName"
                                         placeholder="Mark Williams" aria-label="Mark Williams"
                                         aria-describedby="inputGroupLightFullNameAddOn">
                                 </div>
                             </div>


                             <div class="mb-4">
                                 <label for="inputGroupLightEmail" class="form-label">Email
                                     <i class="bi-question-circle text-body ms-1" data-bs-toggle="tooltip"
                                         data-bs-placement="top" title="The Email Is Required"></i>
                                 </label>

                                 <div class="input-group input-group-merge input-group-light">
                                     <div class="input-group-prepend input-group-text" id="inputGroupLightEmailAddOn">
                                         <i class="bi-envelope-open"></i>
                                     </div>
                                     <input name="email" type="text" class="form-control" id="inputGroupLightEmail"
                                         placeholder="mark@example.com" aria-label="mark@example.com"
                                         aria-describedby="inputGroupLightEmailAddOn">
                                 </div>



                             </div>

                             <div class="mb-4">
                                 <label for="blog_lang" class="form-label">
                                     User Role
                                     <i class="bi-question-circle text-body ms-1" data-bs-toggle="tooltip"
                                         data-bs-placement="top" title="The Role Is Required"></i>
                                 </label>
                                 <div class="tom-select-custom input-group-light">
                                     <select name="role" id="role" class="js-select form-select" autocomplete="off">
                                         <option value="">Select Role</option>
                                         <option value="admin">Admin</option>
                                         <option value="user">User</option>
                                     </select>
                                 </div>
                             </div>
                             <div class="mb-4">

                                 <label for="inputGroupLightPhone" class="form-label">Phone
                                     <i class="bi-question-circle text-body ms-1" data-bs-toggle="tooltip"
                                         data-bs-placement="top" title="The Phone Is Required"></i>
                                 </label>

                                 <div class="input-group input-group-merge input-group-light">
                                     <div class="input-group-prepend input-group-text" id="inputGroupLightPhoneAddOn">
                                         <i class="bi-phone"></i>
                                     </div>
                                     <input name="phone" type="tel" class="form-control" id="inputGroupLightPhone"
                                         placeholder="+5200000" aria-label="mark@example.com"
                                         aria-describedby="inputGroupLightPhoneAddOn">
                                 </div>
                             </div>


                             <div class="mb-4">





                                 <label for="inputGroupLightPassword" class="form-label">Password</label>

                                 <div class="input-group input-group-merge input-group-light">
                                     <div class="input-group-prepend input-group-text" id="inputGroupLightPasswordAddOn">
                                         <i class="bi-key"></i>
                                     </div>
                                     <input name="password" type="password" class="form-control"
                                         id="inputGroupLightPassword" placeholder="Password (4-12 characters)">
                                 </div>
                             </div>



                             <div class="mb-4">
                                 <label for="inputGroupLightPasswordConfirmation" class="form-label">Confirm
                                     Password</label>
                                 <div class="input-group input-group-merge input-group-light">
                                     <div class="input-group-prepend input-group-text"
                                         id="inputGroupLightPasswordConfirmationAddOn">
                                         <i class="bi-key"></i>
                                     </div>
                                     <input name="password_confirmation" type="password" class="form-control"
                                         id="inputGroupLightPasswordConfirmation" placeholder="Confirm Password !">
                                 </div>

                             </div>



                             {{-- my  image  --}}

                             <div class="card mb-3 mb-lg-5 mt-2">
                                 <div class="card-header card-header-content-between">
                                     <h4 class="card-header-title">Image <i class="bi-question-circle text-body ms-1"
                                             data-bs-toggle="tooltip" data-bs-placement="top"
                                             title="The Image Is Required"></i></h4>
                                 </div>
                                 <div class="dz-dropzone-card ">
                                     <div style="width: 100%; text-align: center;">
                                         <img id="showImageDefault" class="avatar avatar-xl avatar-4x3 mb-3"
                                             src="{{ asset('dist/assets/svg/illustrations/oc-browse.svg') }}"
                                             alt="Image Description" data-hs-theme-appearance="default">
                                         <img id="showImageLight" class="avatar avatar-xl avatar-4x3 mb-3"
                                             src="{{ asset('dist/assets/svg/illustrations-light/oc-browse.svg') }}"
                                             alt="Image Description" data-hs-theme-appearance="dark">
                                         <h5>Drag and drop your file here</h5>
                                         <input hidden id="image" accept="image/*" name="image" type="file"
                                             class="form-control">
                                         <label class="btn btn-primary btn-lg mt-3" for="image">Upload Image</label>

                                     </div>
                                 </div>
                             </div>
                             {{-- my  image  --}}


                             <div class="card-footer d-flex justify-content-end align-items-center gap-3">
                                 <a href="{{ route('user.index') }}" class="btn btn-white">Cancel</a>
                                 <button type="submit" class="btn btn-primary">Submit</button>
                             </div>
                     </form>

                     {{-- form end here  --}}



                 </div>
             </div>
         </div>
     </div>




     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <script>
         document.addEventListener("DOMContentLoaded", function() {
             new TomSelect("#role", {
                 persist: false,
                 createOnBlur: true,
                 create: true
             });
         });
     </script>


     <script>
         $(document).ready(function() {
             function previewImage(file) {
                 var reader = new FileReader();
                 reader.onload = function(e) {
                     $('#showImageDefault').attr('src', e.target.result);
                     $('#showImageLight').attr('src', e.target.result);
                 }
                 reader.readAsDataURL(file);
             }

             $('#image').change(function(e) {
                 var file = e.target.files[0];
                 if (file) {
                     previewImage(file);
                 }
             });

             var dropzone = $('.dz-dropzone-card');

             dropzone.on('dragover', function(e) {
                 e.preventDefault();
                 e.stopPropagation();
                 dropzone.addClass('dragover');
             });

             dropzone.on('dragleave', function(e) {
                 e.preventDefault();
                 e.stopPropagation();
                 dropzone.removeClass('dragover');
             });

             dropzone.on('drop', function(e) {
                 e.preventDefault();
                 e.stopPropagation();
                 dropzone.removeClass('dragover');

                 var files = e.originalEvent.dataTransfer.files;
                 if (files.length) {
                     $('#image').prop('files', files);
                     previewImage(files[0]);
                 }
             });
         });
     </script>
 @endsection
