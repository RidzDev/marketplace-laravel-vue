@extends('layouts.admin')

@section('title')
    Store Dashboard
@endsection

@section('content')
              <!-- Section Content -->
          <div class="section-content section-dashboard-home" data-aos="fade-up">
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">Admin Dashboard</h2>
                <p class="dashboard-subtitle">This is a admin administrator panel</p>
              </div>
              <div class="dashboard-content">
                <div class="row">
                  <div class="col-md-4">
                    <div class="card mb-2">
                      <div class="card-body">
                        <div class="dashboard-card-title">Customer</div>
                        <div class="dashboard-card-subtitle">{{ $customer }}</div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="card mb-2">
                      <div class="card-body">
                        <div class="dashboard-card-title">Revenue</div>
                        <div class="dashboard-card-subtitle">${{ $revenue }}</div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="card mb-2">
                      <div class="card-body">
                        <div class="dashboard-card-title">Transaction</div>
                        <div class="dashboard-card-subtitle">{{ $transaction }}</div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-12 mt-2">
                    <h5 class="mb-3">Recent Transactions</h5>
                    <a href="/dashboard-transactions-details.html" class="card card-list d-block">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-1">
                            <img src="/assets/images/dashboard-icon-product-1.png" alt="">
                          </div>
                          <div class="col-md-4">Shirup Marzan</div>
                          <div class="col-md-3">Nana X</div>
                          <div class="col-md-3">13 July 2020</div>
                          <div class="col-md-1 d-none d-md-block">
                            <img src="/assets/images/dashboard-arrow-right.svg" alt="">
                          </div>
                        </div>
                      </div>
                    </a>
                    <a href="/dashboard-transactions-details.html" class="card card-list d-block">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-1">
                            <img src="/assets/images/dashboard-icon-product-2.png" alt="">
                          </div>
                          <div class="col-md-4">Air Tawar</div>
                          <div class="col-md-3">Anya</div>
                          <div class="col-md-3">14 July 2020</div>
                          <div class="col-md-1 d-none d-md-block">
                            <img src="/assets/images/dashboard-arrow-right.svg" alt="">
                          </div>
                        </div>
                      </div>
                    </a>
                    <a href="/dashboard-transactions-details.html" class="card card-list d-block">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-1">
                            <img src="/assets/images/dashboard-icon-product-3.png" alt="">
                          </div>
                          <div class="col-md-4">Banyu Anget</div>
                          <div class="col-md-3">Layla</div>
                          <div class="col-md-3">13 July 2020</div>
                          <div class="col-md-1 d-none d-md-block">
                            <img src="/assets/images/dashboard-arrow-right.svg" alt="">
                          </div>
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
@endsection