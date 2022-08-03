@extends('user.layouts.master')
@section('title', 'İnsan Kaynakları / Personeller / Kişisel Bilgiler | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">İnsan Kaynakları / Personeller / Kişisel Bilgiler</h1>
        </div>
        <div class="d-flex align-items-center gap-2 gap-lg-3">

        </div>
    </div>
@endsection

@section('content')

    @include('user.modules.humanResources.employee.layouts.overview')

    <div class="row">
        <div class="col-xl-8">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header border-0">
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">Kişisel Bilgileri Düzenle</h3>
                    </div>
                    <div class="card-toolbar">
                        <button type="button" class="btn btn-success" id="UpdatePersonalInformationButton">Güncelle</button>
                    </div>
                </div>
                <div class="card-body border-top p-9">
                    <input type="hidden" id="employee_personal_information_id">
                    <div class="row mb-6">
                        <label for="identity" class="col-lg-3 col-form-label fw-bold fs-6">TCKN</label>
                        <div class="col-lg-9">
                            <input id="identity" type="number" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 onlyNumber" placeholder="TCKN">
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label for="birth_date" class="col-lg-3 col-form-label fw-bold fs-6">Doğum Tarihi</label>
                        <div class="col-lg-9">
                            <input id="birth_date" type="date" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Doğum Tarihi">
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label for="gender" class="col-lg-3 col-form-label fw-bold fs-6">Cinsiyet</label>
                        <div class="col-lg-9">
                            <select id="gender" class="form-select form-select-solid" data-control="select2" data-placeholder="Cinsiyet" data-minimum-results-for-search="Infinity">
                                <option value="" selected hidden disabled></option>
                                <option value="0">Kadın</option>
                                <option value="1">Erkek</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label for="nationality" class="col-lg-3 col-form-label fw-bold fs-6">Uyruk</label>
                        <div class="col-lg-9">
                            <input id="nationality" type="text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Uyruk">
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label for="civil_status" class="col-lg-3 col-form-label fw-bold fs-6">Medeni Hal</label>
                        <div class="col-lg-9">
                            <select id="civil_status" class="form-select form-select-solid" data-control="select2" data-placeholder="Medeni Hal" data-minimum-results-for-search="Infinity">
                                <option value="" selected hidden disabled></option>
                                <option value="0">Bekar</option>
                                <option value="1">Evli</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label for="wife_working_status" class="col-lg-3 col-form-label fw-bold fs-6">Eş Çalışma Durumu</label>
                        <div class="col-lg-9">
                            <select id="wife_working_status" class="form-select form-select-solid" data-control="select2" data-placeholder="Eş Çalışma Durumu" data-minimum-results-for-search="Infinity">
                                <option value="" selected hidden disabled></option>
                                <option value="0">Hayır</option>
                                <option value="1">Evet</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label for="number_of_child" class="col-lg-3 col-form-label fw-bold fs-6">Çocuk Sayısı</label>
                        <div class="col-lg-9">
                            <input id="number_of_child" type="number" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 onlyNumber" placeholder="Çocuk Sayısı">
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label for="blood_group" class="col-lg-3 col-form-label fw-bold fs-6">Kan Grubu</label>
                        <div class="col-lg-9">
                            <select id="blood_group" class="form-select form-select-solid" data-control="select2" data-placeholder="Kan Grubu">
                                <option value="" selected hidden disabled></option>
                                <option value="A RH-">A RH-</option>
                                <option value="A RH+">A RH+</option>
                                <option value="B RH-">B RH-</option>
                                <option value="B RH+">B RH+</option>
                                <option value="AB RH-">AB RH-</option>
                                <option value="AB RH+">AB RH+</option>
                                <option value="0 RH-">0 RH-</option>
                                <option value="0 RH+">0 RH+</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label for="education_status" class="col-lg-3 col-form-label fw-bold fs-6">Mezuniyet Durumu</label>
                        <div class="col-lg-9">
                            <select id="education_status" class="form-select form-select-solid" data-control="select2" data-placeholder="Mezuniyet Durumu">
                                <option value="" selected hidden disabled></option>
                                <option value="0">Öğrenci</option>
                                <option value="1">Mezun</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label for="education" class="col-lg-3 col-form-label fw-bold fs-6">Öğrenim Durumu</label>
                        <div class="col-lg-9">
                            <select id="education" class="form-select form-select-solid" data-control="select2" data-placeholder="Öğrenim Durumu">
                                <option value="" selected hidden disabled></option>
                                <option value="Yok">Yok</option>
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
                        <label for="last_completed_school" class="col-lg-3 col-form-label fw-bold fs-6">Son Tamamlanan Okul</label>
                        <div class="col-lg-9">
                            <input id="last_completed_school" type="text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Son Tamamlanan Okul">
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label for="degree_of_obstacle" class="col-lg-3 col-form-label fw-bold fs-6">Engellilik Derecesi</label>
                        <div class="col-lg-9">
                            <select id="degree_of_obstacle" class="form-select form-select-solid" data-control="select2" data-placeholder="Engellilik Derecesi">
                                <option value="" selected hidden disabled></option>
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                    </div>
                    <hr class="text-muted">
                    <div class="row mb-6">
                        <label for="city" class="col-lg-3 col-form-label fw-bold fs-6">Şehir</label>
                        <div class="col-lg-9">
                            <input id="city" type="text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Şehir">
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label for="postal_code" class="col-lg-3 col-form-label fw-bold fs-6">Posta Kodu</label>
                        <div class="col-lg-9">
                            <input id="postal_code" type="text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Posta Kodu">
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label for="home_phone_number" class="col-lg-3 col-form-label fw-bold fs-6">Ev Telefonu</label>
                        <div class="col-lg-9">
                            <input id="home_phone_number" type="text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Ev Telefonu">
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label for="address" class="col-lg-3 col-form-label fw-bold fs-6">Adres</label>
                        <div class="col-lg-9">
                            <textarea id="address" class="form-control form-control-solid" rows="4" placeholder="Adres"></textarea>
                        </div>
                    </div>
                    <hr class="text-muted">
                    <div class="row mb-6">
                        <label for="bank_name" class="col-lg-3 col-form-label fw-bold fs-6">Banka Adı</label>
                        <div class="col-lg-9">
                            <input id="bank_name" type="text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Banka Adı">
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label for="bank_account_type" class="col-lg-3 col-form-label fw-bold fs-6">Hesap Türü</label>
                        <div class="col-lg-9">
                            <select id="bank_account_type" class="form-select form-select-solid" data-control="select2" data-placeholder="Hesap Türü">
                                <option value="" selected hidden disabled></option>
                                <option value="Vadeli">Vadeli</option>
                                <option value="Vadesiz">Vadesiz</option>
                                <option value="Çek">Çek</option>
                                <option value="Diğer">Diğer</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label for="account_number" class="col-lg-3 col-form-label fw-bold fs-6">Hesap Numarası</label>
                        <div class="col-lg-9">
                            <input id="account_number" type="text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Hesap Numarası">
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label for="iban" class="col-lg-3 col-form-label fw-bold fs-6">IBAN</label>
                        <div class="col-lg-9">
                            <input id="iban" type="text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="IBAN">
                        </div>
                    </div>
                    <hr class="text-muted">
                    <div class="row mb-6">
                        <label for="emergency_person" class="col-lg-3 col-form-label fw-bold fs-6">Acil Durumlarda Aranacak Kişi</label>
                        <div class="col-lg-9">
                            <input id="emergency_person" type="text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Acil Durumlarda Aranacak Kişi">
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label for="emergency_person_degree" class="col-lg-3 col-form-label fw-bold fs-6">Yakınlık Derecesi</label>
                        <div class="col-lg-9">
                            <input id="emergency_person_degree" type="text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Yakınlık Derecesi">
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label for="emergency_person_phone_number" class="col-lg-3 col-form-label fw-bold fs-6">Telefon Numarası</label>
                        <div class="col-lg-9">
                            <input id="emergency_person_phone_number" type="text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Telefon Numarası">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('customStyles')
    @include('user.modules.humanResources.employee.personalInformation.components.style')
@endsection

@section('customScripts')
    @include('user.modules.humanResources.employee.personalInformation.components.script')
@endsection
