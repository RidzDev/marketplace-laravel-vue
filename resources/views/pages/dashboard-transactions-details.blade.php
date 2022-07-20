@extends('layouts.dashboard')

@section('title')
    Store Dashboard Transaction Detail
@endsection

@section('content')
          <!-- Section Content -->
          <div class="section-content section-dashboard-home" data-aos="fade-up">
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">#STORE09829</h2>
                <p class="dashboard-subtitle">Transactions / <span style="color: #0c0d36ee;">Details</span>
                </p>
              </div>
              <div class="dashboard-content" id="transactionDetails">
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-12 col-md-4">
                            <img src="/assets/images/product-details-1.jpg" alt="" class="w-100 mb-3">
                          </div>
                          <div class="col-12 col-md-8">
                            <div class="row">
                              <div class="col-12 col-md-6">
                                <div class="product-title">Customer Name</div>
                                <div class="product-subtitle">Nama Pelanggan</div>
                              </div>
                              <div class="col-12 col-md-6">
                                <div class="product-title">Product Name</div>
                                <div class="product-subtitle">Shirup Marzan</div>
                              </div>
                              <div class="col-12 col-md-6">
                                <div class="product-title">Date of Transaction</div>
                                <div class="product-subtitle">July 13, 2022</div>
                              </div>
                              <div class="col-12 col-md-6">
                                <div class="product-title">Payment Status</div>
                                <div class="product-subtitle text-danger">Pending</div>
                              </div>
                              <div class="col-12 col-md-6">
                                <div class="product-title">Total Amount</div>
                                <div class="product-subtitle">$280,400</div>
                              </div>
                              <div class="col-12 col-md-6">
                                <div class="product-title">Mobile</div>
                                <div class="product-subtitle">+62 082 0349 9834</div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-12 mt-4 mb-3">
                            <h5>Shipping Information</h5>
                          </div>
                          <div class="col-12 col-md-8">
                            <div class="row">
                              <div class="col-12 col-md-6">
                                <div class="product-title">Address 1</div>
                                <div class="product-subtitle">Jalan 1</div>
                              </div>
                              <div class="col-12 col-md-6">
                                <div class="product-title">Address 2</div>
                                <div class="product-subtitle">Blok A</div>
                              </div>
                              <div class="col-12 col-md-6">
                                <div class="product-title">Proveice</div>
                                <div class="product-subtitle">Yogyakarta</div>
                              </div>
                              <div class="col-12 col-md-6">
                                <div class="product-title">City</div>
                                <div class="product-subtitle">Bantul</div>
                              </div>
                              <div class="col-12 col-md-6">
                                <div class="product-title">Postal Code</div>
                                <div class="product-subtitle">55781</div>
                              </div>
                              <div class="col-12 col-md-6">
                                <div class="product-title">Country</div>
                                <div class="product-subtitle">Indonesia</div>
                              </div>
                            </div>
                          </div>
                          <div class="col-12">
                            <div class="row">
                              <div class="col-12 col-md-4">
                                <div class="product-title">Sipping Status</div>
                                <select name="status" id="status" class="form-control" v-model="status">
                                  <option value="PENDING">Pending</option>
                                  <option value="SHIPPING">Shipping</option>
                                  <option value="SUCCESS">Success</option>
                                </select>
                              </div>
                              <template v-if="status == 'SHIPPING'">
                                <div class="col-md-4">
                                  <div class="product-title">Input Resi</div>
                                  <input type="text" name="resi" class="form-control" v-model="resi">
                                </div>
                                <div class="col-md-4">
                                  <button type="submit" class="btn btn-success btn-block mt-4">Update</button>
                                </div>
                              </template>
                            </div>
                          </div>
                        </div>
                        <div class="row mt-4">
                          <div class="col-12">
                              <button type="submit" class="btn btn-success btn-block">Save</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
@endsection

@push('addon-script')
        <script src="/vendor/vue/vue.js"></script>
    <script>
      var transactionDetails = new Vue({
        el: '#transactionDetails',
        data: {
          status: 'SHIPPING', 
          resi: 'YGY2309489800',
        }
      });
    </script>
@endpush