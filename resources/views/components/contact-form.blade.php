 @if ($errors->any())
     <div class="alert alert-danger">
         <ul>
             @foreach ($errors->all() as $error)
                 <li>{{ $error }}</li>
             @endforeach
         </ul>
     </div>
 @endif



  <form action="{{ Helper::AppUrl('save/contact-us') }}" method="post" class="row g-lg-3 gx-1 gy-4 py-3 px-2  shadow-lg rounded-4 h-100 ">
    @csrf
            <div class="col-md-6">

              <input type="text" class="form-control py-2" placeholder="{{ trans('home.name') }}" name="name">
            </div>
            <div class="col-md-6">

              <input type="email" class="form-control py-2" placeholder="{{ trans('home.email') }}" name="email">
            </div>

            <div class="col-md-12">

              <input type="tel" class="form-control py-2" placeholder="{{ trans('home.phone') }}" name="phone">
            </div>
            <div class="col-md-12">

              <textarea cols="30" rows="10" class="form-control " placeholder="{{ trans('home.message') }}" name="message"></textarea>
            </div>
            <div class="col-md-12 col-12">

              <button class="btn btn-send px-3 py-2   w-100 me-auto">
                {{ trans('home.send') }} <i class="fa-solid fa-paper-plane ms-2"></i>
              </button>
            </div>


          </form>
