@extends('layouts.admin')
@section('title', 'แก้ไขการตั้งค่า')
@section('content')
    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            แก้ไขการตั้งค่า
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-cards">
                    <form action="{{ route('admin.settings.update' , ['setting' => $config->id])}}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="card">
                            <div class="card-body">
                                @if(session('msg'))
                                    <div class="alert alert-success alert-dismissible" role="alert">
                                        <div class="d-flex">
                                            <div>
                                                <!-- Download SVG icon from http://tabler-icons.io/i/alert-circle -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon"
                                                     width="24" height="24"
                                                     viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                     fill="none"
                                                     stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <circle cx="12" cy="12" r="9"/>
                                                    <line x1="12" y1="8" x2="12" y2="12"/>
                                                    <line x1="12" y1="16" x2="12.01" y2="16"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 class="alert-title">{{session('msg')}}</h4>
                                            </div>
                                        </div>
                                        <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                                    </div>
                                @endif
                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                        <div class="d-flex">
                                            <div>
                                                <!-- Download SVG icon from http://tabler-icons.io/i/alert-circle -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon"
                                                     width="24" height="24"
                                                     viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                     fill="none"
                                                     stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                    <circle cx="12" cy="12" r="9"/>
                                                    <line x1="12" y1="8" x2="12" y2="12"/>
                                                    <line x1="12" y1="16" x2="12.01" y2="16"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <h4 class="alert-title">เกิดข้อผิดพลาด&hellip;</h4>
                                                <div class="text-muted">
                                                    <ul>
                                                        @foreach($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                                    </div>
                                @endif
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead>
                                        <tr>
                                            <th>ประเภท</th>
                                            <th>ราคา (บาท)</th>
                                            <th>หน่วยการคิด</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control" value="ค่าเช่าห้อง" disabled>
                                            </td>
                                            <td>
                                                <input type="number" name="rent_price" class="form-control"
                                                       value="{{ $config->rent_price }}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="ต่อเดือน" disabled>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <input type="text" class="form-control" value="ค่าไฟฟ้า" disabled>
                                            </td>
                                            <td>
                                                <input type="number" name="electric_price" class="form-control"
                                                       value="{{ $config->electric_price }}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="ต่อหน่วย" disabled>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <input type="text" class="form-control" value="ค่าน้ำประปา" disabled>
                                            </td>
                                            <td>
                                                <input type="number" name="water_price" class="form-control"
                                                       value="{{ $config->water_price }}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="ต่อหน่วย" disabled>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <input type="text" class="form-control" value="ค่าที่จอดรถ" disabled>
                                            </td>
                                            <td>
                                                <input type="number" name="parking_price" class="form-control"
                                                       value="{{ $config->parking_price }}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="ต่อเดือน" disabled>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <input type="text" class="form-control" value="ค่าส่วนกลาง" disabled>
                                            </td>
                                            <td>
                                                <input type="number" name="common_fee" class="form-control"
                                                       value="{{ $config->common_fee }}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="ต่อเดือน" disabled>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <input type="text" class="form-control" value="ค่าปรับชำระเลยกำหนด"
                                                       disabled>
                                            </td>
                                            <td>
                                                <input type="number" name="damages_price" class="form-control"
                                                       value="{{ $config->damages_price }}">
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" value="ต่อเดือน" disabled>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                                <a href="{{ route('admin.settings.index') }}"
                                   class="btn btn-ghost-secondary">ยกเลิก</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

