@extends('user.layouts.master')
@section('title', 'Beceri Envanteri | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-5 my-1">Beceri Envanteri</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-xl-12">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0" id="employeeNameSpan"></h3>
                    </div>
                    <div class="card-toolbar">
                        <button type="button" class="btn btn-success" id="UpdateEmployeeSkillInventoryButton">Güncelle</button>
                    </div>
                </div>
                <div class="card-body border-top p-9">
                    <div class="row mb-6">
                        <label for="central_code" class="col-lg-3 col-form-label fw-bold fs-6">Dahili</label>
                        <div class="col-lg-9">
                            <input id="central_code" type="text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Dahili">
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label for="department" class="col-lg-3 col-form-label fw-bold fs-6">Departman</label>
                        <div class="col-lg-9">
                            <input id="department" type="text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Departman">
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label for="education_level" class="col-lg-3 col-form-label fw-bold fs-6">Eğitim Düzeyi</label>
                        <div class="col-lg-9">
                            <select id="education_level" class="form-select form-select-solid" data-control="select2" data-placeholder="Eğitim Düzeyi">
                                <option value="İlkokul">İlkokul</option>
                                <option value="Ortaokul">Ortaokul</option>
                                <option value="Lise">Lise</option>
                                <option value="Önlisans">Önlisans</option>
                                <option value="Lisans">Lisans</option>
                                <option value="Yüksek Lisans">Yüksek Lisans</option>
                                <option value="Doktora">Doktora</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label for="languages" class="col-lg-3 col-form-label fw-bold fs-6">Yabancı Diller ve Düzeyi</label>
                        <div class="col-lg-9">
                            <input id="languages" type="text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Yabancı Diller ve Düzeyi">
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label for="certificates" class="col-lg-3 col-form-label fw-bold fs-6">Sertifikalar ve Katıldığı Eğitimler</label>
                        <div class="col-lg-9">
                            <input id="certificates" type="text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Sertifikalar ve Katıldığı Eğitimler">
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label for="job_start_date" class="col-lg-3 col-form-label fw-bold fs-6">İşe Giriş Tarihi</label>
                        <div class="col-lg-9">
                            <input id="job_start_date" type="date" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label for="products" class="col-lg-3 col-form-label fw-bold fs-6">Hangi Ürünlere Destek veriyor</label>
                        <div class="col-lg-9">
                            <input id="products" type="text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Hangi Ürünlere Destek veriyor">
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label for="total_work_experience" class="col-lg-3 col-form-label fw-bold fs-6">Toplam İş Deneyimi (Yıl - Ay)</label>
                        <div class="col-lg-9">
                            <input id="total_work_experience" type="text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Toplam İş Deneyimi (Yıl - Ay)">
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label for="age" class="col-lg-3 col-form-label fw-bold fs-6">Yaş</label>
                        <div class="col-lg-9">
                            <input id="age" type="text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Yaş">
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label for="gender" class="col-lg-3 col-form-label fw-bold fs-6">Cinsiyet</label>
                        <div class="col-lg-9">
                            <select id="gender" class="form-select form-select-solid" data-control="select2" data-placeholder="Cinsiyet">
                                <option value="Erkek">Erkek</option>
                                <option value="Kadın">Kadın</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label for="hobbies" class="col-lg-3 col-form-label fw-bold fs-6">İlgi, Hobi ve Becerileri</label>
                        <div class="col-lg-9">
                            <input id="hobbies" type="text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="İlgi, Hobi ve Becerileri">
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label for="old_work_companies" class="col-lg-3 col-form-label fw-bold fs-6">Bugüne Kadar Çalıştığı Yerler</label>
                        <div class="col-lg-9">
                            <input id="old_work_companies" type="text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Bugüne Kadar Çalıştığı Yerler">
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label for="old_work_positions" class="col-lg-3 col-form-label fw-bold fs-6">Çalıştığı Pozisyonlar</label>
                        <div class="col-lg-9">
                            <input id="old_work_positions" type="text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Çalıştığı Pozisyonlar">
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label for="future_works_taken" class="col-lg-3 col-form-label fw-bold fs-6">Gelecekte Üstlenebileceği İşler</label>
                        <div class="col-lg-9">
                            <input id="future_works_taken" type="text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Gelecekte Üstlenebileceği İşler">
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label for="notes" class="col-lg-3 col-form-label fw-bold fs-6">Genel Notlar</label>
                        <div class="col-lg-9">
                            <textarea rows="5" id="notes" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Genel Notlar"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('customStyles')
    @include('user.modules.employee.skillInventory.index.components.style')
@endsection

@section('customScripts')
    @include('user.modules.employee.skillInventory.index.components.script')
@endsection
