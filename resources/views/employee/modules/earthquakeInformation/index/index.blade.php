@extends('employee.layouts.master')
@section('title', 'Deprem Bilgilerim | ')

@section('subheader')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <div class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <h1 class="d-flex align-items-center text-dark fw-bolder fs-5 my-1">Deprem Bilgilerim</h1>
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
                        <h3 class="fw-bolder m-0"></h3>
                    </div>
                    <div class="card-toolbar">
                        <button type="button" class="btn btn-success" id="UpdateEarthquakeInformationButton">Güncelle</button>
                    </div>
                </div>
                <div class="card-body border-top p-9">
                    <div class="row mb-6">
                        <label for="city" class="col-lg-3 col-form-label fw-bold fs-6">Şuanda Hangi Şehirdesiniz</label>
                        <div class="col-lg-9">
                            <select id="city" class="form-select form-select-solid" data-control="select2" data-placeholder="Şuanda Hangi Şehirdesiniz">
                                <option value="Adana">Adana</option>
                                <option value="Adıyaman">Adıyaman</option>
                                <option value="Afyonkarahisar">Afyonkarahisar</option>
                                <option value="Ağrı">Ağrı</option>
                                <option value="Amasya">Amasya</option>
                                <option value="Ankara">Ankara</option>
                                <option value="Antalya">Antalya</option>
                                <option value="Artvin">Artvin</option>
                                <option value="Aydın">Aydın</option>
                                <option value="Balıkesir">Balıkesir</option>
                                <option value="Bilecik">Bilecik</option>
                                <option value="Bingöl">Bingöl</option>
                                <option value="Bitlis">Bitlis</option>
                                <option value="Bolu">Bolu</option>
                                <option value="Burdur">Burdur</option>
                                <option value="Bursa">Bursa</option>
                                <option value="Çanakkale">Çanakkale</option>
                                <option value="Çankırı">Çankırı</option>
                                <option value="Çorum">Çorum</option>
                                <option value="Denizli">Denizli</option>
                                <option value="Diyarbakır">Diyarbakır</option>
                                <option value="Edirne">Edirne</option>
                                <option value="Elazığ">Elazığ</option>
                                <option value="Erzincan">Erzincan</option>
                                <option value="Erzurum">Erzurum</option>
                                <option value="Eskişehir">Eskişehir</option>
                                <option value="Gaziantep">Gaziantep</option>
                                <option value="Giresun">Giresun</option>
                                <option value="Gümüşhane">Gümüşhane</option>
                                <option value="Hakkari">Hakkari</option>
                                <option value="Hatay">Hatay</option>
                                <option value="Isparta">Isparta</option>
                                <option value="Mersin">Mersin</option>
                                <option value="İstanbul">İstanbul</option>
                                <option value="İzmir">İzmir</option>
                                <option value="Kars">Kars</option>
                                <option value="Kastamonu">Kastamonu</option>
                                <option value="Kayseri">Kayseri</option>
                                <option value="Kırklareli">Kırklareli</option>
                                <option value="Kırşehir">Kırşehir</option>
                                <option value="Kocaeli">Kocaeli</option>
                                <option value="Konya">Konya</option>
                                <option value="Kütahya">Kütahya</option>
                                <option value="Malatya">Malatya</option>
                                <option value="Manisa">Manisa</option>
                                <option value="Kahramanmaraş">Kahramanmaraş</option>
                                <option value="Mardin">Mardin</option>
                                <option value="Muğla">Muğla</option>
                                <option value="Muş">Muş</option>
                                <option value="Nevşehir">Nevşehir</option>
                                <option value="Niğde">Niğde</option>
                                <option value="Ordu">Ordu</option>
                                <option value="Rize">Rize</option>
                                <option value="Sakarya">Sakarya</option>
                                <option value="Samsun">Samsun</option>
                                <option value="Siirt">Siirt</option>
                                <option value="Sinop">Sinop</option>
                                <option value="Sivas">Sivas</option>
                                <option value="Tekirdağ">Tekirdağ</option>
                                <option value="Tokat">Tokat</option>
                                <option value="Trabzon">Trabzon</option>
                                <option value="Tunceli">Tunceli</option>
                                <option value="Şanlıurfa">Şanlıurfa</option>
                                <option value="Uşak">Uşak</option>
                                <option value="Van">Van</option>
                                <option value="Yozgat">Yozgat</option>
                                <option value="Zonguldak">Zonguldak</option>
                                <option value="Aksaray">Aksaray</option>
                                <option value="Bayburt">Bayburt</option>
                                <option value="Karaman">Karaman</option>
                                <option value="Kırıkkale">Kırıkkale</option>
                                <option value="Batman">Batman</option>
                                <option value="Şırnak">Şırnak</option>
                                <option value="Bartın">Bartın</option>
                                <option value="Ardahan">Ardahan</option>
                                <option value="Iğdır">Iğdır</option>
                                <option value="Yalova">Yalova</option>
                                <option value="Karabük">Karabük</option>
                                <option value="Kilis">Kilis</option>
                                <option value="Osmaniye">Osmaniye</option>
                                <option value="Düzce">Düzce</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label for="address" class="col-lg-3 col-form-label fw-bold fs-6">Şuandaki Adresiniz</label>
                        <div class="col-lg-9">
                            <input id="address" type="text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Şuandaki Adresiniz">
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label for="home_status" class="col-lg-3 col-form-label fw-bold fs-6">Malatyadaki Evinizin Durumu</label>
                        <div class="col-lg-9">
                            <select id="home_status" class="form-select form-select-solid" data-control="select2" data-placeholder="Malatyadaki Evinizin Durumu">
                                <option disabled selected hidden></option>
                                <option value="Belirsiz">Belirsiz</option>
                                <option value="Yıkıldı">Yıkıldı</option>
                                <option value="Az Hasarlı">Az Hasarlı</option>
                                <option value="Orta Hasarlı">Orta Hasarlı</option>
                                <option value="Ağır Hasarlı">Ağır Hasarlı</option>
                                <option value="Acil Yıkılacak">Acil Yıkılacak</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label for="family_health_status" class="col-lg-3 col-form-label fw-bold fs-6">Aileden Vefat Eden Var mı?</label>
                        <div class="col-lg-9">
                            <select id="family_health_status" class="form-select form-select-solid" data-control="select2" data-placeholder="Aileden Vefat Eden Var mı?" data-minimum-results-for-search="Infinity">
                                <option value="" selected hidden disabled></option>
                                <option value="Hayır">Hayır</option>
                                <option value="Evet">Evet</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label for="working_status" class="col-lg-3 col-form-label fw-bold fs-6">Şuanda Çalışıyor Musunuz?</label>
                        <div class="col-lg-9">
                            <select id="working_status" class="form-select form-select-solid" data-control="select2" data-placeholder="Şuanda Çalışıyor Musunuz?" data-minimum-results-for-search="Infinity">
                                <option value="" selected hidden disabled></option>
                                <option value="Evet">Evet</option>
                                <option value="Hayır">Hayır</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label for="working_address" class="col-lg-3 col-form-label fw-bold fs-6">Hangi Ofiste Çalışıyorsunuz?</label>
                        <div class="col-lg-9">
                            <input id="working_address" type="text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Hangi Ofiste Çalışıyorsunuz?">
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label for="working_department" class="col-lg-3 col-form-label fw-bold fs-6">Hangi Kuyrukta/Departmanda Çalışıyorsunuz?</label>
                        <div class="col-lg-9">
                            <input id="working_department" type="text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Hangi Kuyrukta/Departmanda Çalışıyorsunuz?">
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label for="workable_date" class="col-lg-3 col-form-label fw-bold fs-6">Hangi Tarihte Çalışmaya Başlayabilirsiniz</label>
                        <div class="col-lg-9">
                            <input id="workable_date" type="date" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label for="computer_status" class="col-lg-3 col-form-label fw-bold fs-6">Bilgisayar Durumunuz</label>
                        <div class="col-lg-9">
                            <select id="computer_status" class="form-select form-select-solid" data-control="select2" data-placeholder="Bilgisayar Durumunuz" data-minimum-results-for-search="Infinity">
                                <option value="" selected hidden disabled></option>
                                <option value="Yok">Yok</option>
                                <option value="Var">Var</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label for="internet_status" class="col-lg-3 col-form-label fw-bold fs-6">İnternet Durumunuz</label>
                        <div class="col-lg-9">
                            <select id="internet_status" class="form-select form-select-solid" data-control="select2" data-placeholder="İnternet Durumunuz" data-minimum-results-for-search="Infinity">
                                <option value="" selected hidden disabled></option>
                                <option value="Yok">Yok</option>
                                <option value="Var">Var</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label for="headphone_status" class="col-lg-3 col-form-label fw-bold fs-6">Kulaklık Durumunuz</label>
                        <div class="col-lg-9">
                            <select id="headphone_status" class="form-select form-select-solid" data-control="select2" data-placeholder="Kulaklık Durumunuz" data-minimum-results-for-search="Infinity">
                                <option value="" selected hidden disabled></option>
                                <option value="Yok">Yok</option>
                                <option value="Var">Var</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-6">
                        <label for="general_notes" class="col-lg-3 col-form-label fw-bold fs-6">Genel Notlar</label>
                        <div class="col-lg-9">
                            <textarea rows="5" id="general_notes" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Genel Notlar"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('customStyles')
    @include('employee.modules.earthquakeInformation.index.components.style')
@endsection

@section('customScripts')
    @include('employee.modules.earthquakeInformation.index.components.script')
@endsection
