@extends('layouts.auth')

@section('content')
    <div class="page-content page-auth" id="register" style="margin-top: 120px">
      <div class="section-store-auth" data-aos="fade-up">
        <div class="container">
          <div class="row align-items-center justify-content-center row-login">
            <div class="col-lg-5">
              <h2>Memulai untuk berjual-beli<br>
              dengan cara terbaru</h2>
              <form action="" class="mt-3">
                <div class="form-group">
                  <label for="">Name</label>
                  <input type="text" name="" id="" class="form-control is-valid" autofocus v-model="name">
                </div>
                <div class="form-group">
                  <label for="">Email Address</label>
                  <input type="email" name="" id="" class="form-control is-invalid" aria-describedby="emailHelp" v-model="email">
                </div>
                <div class="form-group">
                  <label for="">Password</label>
                  <input type="password" name="" id="" class="form-control">
                </div>
                <div class="form-group mt-4">
                  <label for="">Store</label>
                  <p class="text-muted">
                    Apakah anda juga ingin membuaka toko?
                  </p>
                  <div class="custom-control custom-radio custom-control-inline"> 
                    <input type="radio" class="custom-control-input" name="is_store_open" id="openStoreTrue" v-model="is_store_open" :value="true">
                    <label for="openStoreTrue" class="custom-control-label">Iya, boleh.</label>
                  </div>
                  <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" class="custom-control-input" name="is_store_open" id="openStoreFalse" v-model="is_store_open" :value="false">
                    <label for="openStoreFalse" class="custom-control-label" >Enggak, makasih.</label>
                  </div>
                </div>
                <div class="form-group" v-if="is_store_open">
                  <label for="">Nama Toko</label>
                  <input type="text" name="" id="" class="form-control">
                </div>
                <div class="form-group" v-if="is_store_open">
                  <label for="">Category</label>
                  <select name="category" id="" class="form-control">
                    <option value="" disabled>Select Category</option>
                  </select>
                </div>
                <a href="/dashboard.html" class="btn btn-success btn-block mt-4">
                  Sign-up Now
                </a>
                <a href="/login.html" class="btn btn-signup btn-block mt-4">
                  Back to Sign-in
                </a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>


<div class="container" style="display: none">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
    <script>
      Vue.use(Toasted);
      var register = new Vue({
        el : '#register',
        mounted() {
          AOS.init();
          this.$toasted.error(
            'Maaf, tampaknya email anda sudah terdaftar pada sistem kami.', {
              position: 'top-center',
              className: 'rounded',
              duration: 1500
            }
          );
        },
        data: {
          name: 'Si Jago',
          email: 'kamujago@master.id',
          password: '',
          is_store_open: true,
          store_name: ''
        }
      });
    </script>
@endpush
