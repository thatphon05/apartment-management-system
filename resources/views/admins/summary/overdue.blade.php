@extends('layouts.admin')
@section('title', 'สรุปยอดค้างชำระเกินกำหนด')
@section('breadcrumb', Breadcrumbs::render('admin.summary-overdue'))
@section('content')
    <div class="page-header d-print-none" xmlns="http://www.w3.org/1999/html">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        สรุปยอดค้างชำระเกินกำหนด
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.summary.export-overdue-pdf') }}"
                                  onsubmit="submitButton.disabled = true;
                                  submitButton.classList.add('btn-loading');
                                  return true;"
                                  method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label required">ประจำเดือน</label>
                                        <input value="{{ old('cycle')
                                                    ?? \Carbon\Carbon::today()->subMonth()->format('Y-m')
                                                }}"
                                               name="cycle" type="month"
                                               onchange="inputChange(event)"
                                               class="form-control @error('cycle') is-invalid @enderror"
                                               placeholder="จดประจำเดือน">
                                        @error('cycle')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <button type="submit" class="btn btn btn-primary" role="button"
                                        name="submitButton">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                         viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                         stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <circle cx="10" cy="10" r="7"></circle>
                                        <line x1="21" y1="21" x2="15" y2="15"></line>
                                    </svg>
                                    ค้นหา
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
