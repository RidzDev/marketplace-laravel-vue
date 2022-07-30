@extends('layouts.auth')

@section('content')
  <div class="page-content page-auth" id="register" style="margin-top: 120px">
    <div class="section-store-auth" data-aos="fade-up">
      <div class="container">
        <div class="row align-items-center justify-content-center row-login">
          <div class="col-lg-5">
            <h2>Memulai untuk berjual-beli<br>
              dengan cara terbaru</h2>
            <form method="POST" action="{{ route('register') }}" class="mt-3">
              @csrf
              <div class="form-group">
                <label for="">Username</label>
                {{-- <input type="text" name="" id="" class="form-control is-valid" autofocus v-model="name"> --}}
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                  name="name" value="{{ old('name') }}" required autocomplete="name" v-model="name"
                  placeholder="Enter your username">
                @error('name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="form-group">
                <label for="">Email Address</label>
                {{-- <input type="email" name="" id="" class="form-control is-invalid" aria-describedby="emailHelp" v-model="email"> --}}
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                  :class="{ 'is-invalid': this.email_unavailable }" name="email" value="{{ old('email') }}" required
                  autocomplete="email" placeholder="e.g. yourname@example.com"
                  v-model="email"@change="checkForEmailAvailability()">
                @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="form-group">
                <label for="">Password</label>
                {{-- <input type="password" name="" id="" class="form-control"> --}}
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                  name="password" required autocomplete="new-password" placeholder="Enter your password">
                @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="form-group">
                <label for="">Confirm Password</label>
                {{-- <input type="password" name="" id="" class="form-control"> --}}
                <input id="password-confirm" type="password"
                  class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation"
                  required autocomplete="new-password" placeholder="Confirm password">
                @error('password_confirmation')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="form-group mt-4">
                <label for="">Store</label>
                <p class="text-muted">
                  Apakah anda juga ingin membuaka toko?
                </p>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" class="custom-control-input" name="is_store_open" id="openStoreTrue"
                    v-model="is_store_open" :value="true">
                  <label for="openStoreTrue" class="custom-control-label">Iya, boleh.</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" class="custom-control-input" name="is_store_open" id="openStoreFalse"
                    v-model="is_store_open" :value="false">
                  <label for="openStoreFalse" class="custom-control-label">Enggak, makasih.</label>
                </div>
              </div>
              <div class="form-group" v-if="is_store_open">
                <label for="">Store Name</label>
                <input type="text" v-model="store_name" id="store_name"
                  class="form-control @error('password_confirm') is-invalid @enderror" name="store_name" required
                  autocomplete="new-store" placeholder="e.g. Shoes Store">
                @error('store_name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
              <div class="form-group" v-if="is_store_open">
                <label for="">Category</label>
                <select name="categories_id" id="" class="form-control">
                  <option value="" disabled>Select Category</option>
                  @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                  @endforeach
                </select>
              </div>
              <button type="submit" class="btn btn-success btn-block mt-4" :disabled="this.email_unavailable">
                Sign-up Now
              </button>
              <a href="{{ route('login') }}" class="btn btn-signup btn-block mt-4">
                Back to Sign-in
              </a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- <div class="container" style="display: none">
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
</div> --}}
@endsection

@push('addon-script')
  <script src="/vendor/vue/vue.js"></script>
  <script src="https://unpkg.com/vue-toasted"></script>
  {{-- axios cdn on github --}}
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script>
    Vue.use(Toasted);
    var register = new Vue({
      el: '#register',
      mounted() {
        AOS.init();
      },
      methods: {
        checkForEmailAvailability: function() {
          var self = this;
          axios.get('{{ route('api-register-check') }}', {
              params: {
                email: this.email,
              }
            })
            .then(function(response) {

              if (response.data == 'Available') {
                self.$toasted.show(
                  'Email Anda tersedia! Silakan lanjut langkah berikutnya.', {
                    position: 'top-center',
                    className: 'rounded',
                    duration: 1500
                  })
                self.email_unavailable = false;

              } else {
                self.$toasted.error(
                  'Maaf, tampaknya email anda sudah terdaftar pada sistem kami.', {
                    position: 'top-center',
                    className: 'rounded',
                    duration: 1500
                  })
                self.email_unavailable = true;
              }
              // handle success
              console.log(response);
            });
        }
      },
      data() {
        return {
          name: '',
          email: '',
          is_store_open: false,
          store_name: '',
          email_unavailable: false,
        }
      },
    });
  </script>
@endpush
