 @extends('layout.master')

 @section('content')
     <!-- Content -->
     <div class="content container-fluid">
         <!-- Page Header -->
         <div class="page-header">
             <div class="row align-items-center">
                 <div class="col">
                     <h1 class="page-header-title">Dashboard</h1>
                 </div>

                 <div>
                    <strong>
                        SAMI
                    </strong>
                 </div>

             </div>
             <!-- End Row -->
         </div>



         <div class="row justify-content-center align-items-sm-center w-100 ">
             <div class="col-9 col-sm-6 col-lg-4">
                 <div class="text-center text-sm-end me-sm-4 mb-5 mb-sm-0">
                     <img style="opacity: 0.1" class="img-fluid" src="{{ asset('images/logoidex.png') }}" alt="Image Description"
                         data-hs-theme-appearance="default">
                     <img class="img-fluid" src="{{ asset('images/logoidex.png') }}" alt="Image Description"
                         data-hs-theme-appearance="dark">
                 </div>
             </div>
             <!-- End Col -->


             <!-- End Col -->
         </div>
         <!-- End Row -->
         {{-- </div> --}}

     </div>



     <!-- End Content -->

     <!-- Footer -->


     <!-- End Footer -->
 @endsection
