<div class="modal fade show" id="CreateEarthquakeInformationModal" aria-modal="true" role="dialog" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered mw-1000px">
        <div class="modal-content rounded">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black"></rect>
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black"></rect>
                        </svg>
                    </span>
                </div>
            </div>
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                <div class="form fv-plugins-bootstrap5 fv-plugins-framework">
                    <div class="mb-13 text-center">
                        <h1 class="mb-3">Yeni Kayıt Ekle</h1>
                    </div>
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <div class="row mb-5">
                            <div class="col-xl-3 mt-3">
                                <label for="create_earthquake_information_employee_id" class="font-weight-bolder">Personel</label>
                            </div>
                            <div class="col-xl-9">
                                <div class="form-group">
                                    <select id="create_earthquake_information_employee_id" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Personel"></select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <label for="create_earthquake_information_city" class="col-lg-3 col-form-label fw-bold fs-6">Şuanda Hangi Şehirdesiniz</label>
                            <div class="col-lg-9">
                                <select id="create_earthquake_information_city" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Şuanda Hangi Şehirdesiniz">
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
                        <div class="row mb-5">
                            <label for="create_earthquake_information_address" class="col-lg-3 col-form-label fw-bold fs-6">Şuandaki Adresiniz</label>
                            <div class="col-lg-9">
                                <input id="create_earthquake_information_address" type="text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Şuandaki Adresiniz">
                            </div>
                        </div>
                        <div class="row mb-5">
                            <label for="create_earthquake_information_home_status" class="col-lg-3 col-form-label fw-bold fs-6">Malatyadaki Evinizin Durumu</label>
                            <div class="col-lg-9">
                                <select id="create_earthquake_information_home_status" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Malatyadaki Evinizin Durumu">
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
                        <div class="row mb-5">
                            <label for="create_earthquake_information_family_health_status" class="col-lg-3 col-form-label fw-bold fs-6">Aileden Vefat Eden Var mı?</label>
                            <div class="col-lg-9">
                                <select id="create_earthquake_information_family_health_status" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Aileden Vefat Eden Var mı?" data-minimum-results-for-search="Infinity">
                                    <option value="" selected hidden disabled></option>
                                    <option value="Hayır">Hayır</option>
                                    <option value="Evet">Evet</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <label for="create_earthquake_information_working_status" class="col-lg-3 col-form-label fw-bold fs-6">Şuanda Çalışıyor Musunuz?</label>
                            <div class="col-lg-9">
                                <select id="create_earthquake_information_working_status" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Şuanda Çalışıyor Musunuz?" data-minimum-results-for-search="Infinity">
                                    <option value="" selected hidden disabled></option>
                                    <option value="Evet">Evet</option>
                                    <option value="Hayır">Hayır</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <label for="create_earthquake_information_working_address" class="col-lg-3 col-form-label fw-bold fs-6">Hangi Ofiste Çalışıyorsunuz?</label>
                            <div class="col-lg-9">
                                <input id="create_earthquake_information_working_address" type="text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Hangi Ofiste Çalışıyorsunuz?">
                            </div>
                        </div>
                        <div class="row mb-5">
                            <label for="create_earthquake_information_working_department" class="col-lg-3 col-form-label fw-bold fs-6">Hangi Kuyrukta/Departmanda Çalışıyorsunuz?</label>
                            <div class="col-lg-9">
                                <input id="create_earthquake_information_working_department" type="text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Hangi Kuyrukta/Departmanda Çalışıyorsunuz?">
                            </div>
                        </div>
                        <div class="row mb-5">
                            <label for="create_earthquake_information_workable_date" class="col-lg-3 col-form-label fw-bold fs-6">Hangi Tarihte Çalışmaya Başlayabilirsiniz</label>
                            <div class="col-lg-9">
                                <input id="create_earthquake_information_workable_date" type="date" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0">
                            </div>
                        </div>
                        <div class="row mb-5">
                            <label for="create_earthquake_information_computer_status" class="col-lg-3 col-form-label fw-bold fs-6">Bilgisayar Durumunuz</label>
                            <div class="col-lg-9">
                                <select id="create_earthquake_information_computer_status" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Bilgisayar Durumunuz" data-minimum-results-for-search="Infinity">
                                    <option value="" selected hidden disabled></option>
                                    <option value="Yok">Yok</option>
                                    <option value="Var">Var</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <label for="create_earthquake_information_internet_status" class="col-lg-3 col-form-label fw-bold fs-6">İnternet Durumunuz</label>
                            <div class="col-lg-9">
                                <select id="create_earthquake_information_internet_status" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="İnternet Durumunuz" data-minimum-results-for-search="Infinity">
                                    <option value="" selected hidden disabled></option>
                                    <option value="Yok">Yok</option>
                                    <option value="Var">Var</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <label for="create_earthquake_information_headphone_status" class="col-lg-3 col-form-label fw-bold fs-6">Kulaklık Durumunuz</label>
                            <div class="col-lg-9">
                                <select id="create_earthquake_information_headphone_status" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Kulaklık Durumunuz" data-minimum-results-for-search="Infinity">
                                    <option value="" selected hidden disabled></option>
                                    <option value="Yok">Yok</option>
                                    <option value="Var">Var</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <label for="create_earthquake_information_general_notes" class="col-lg-3 col-form-label fw-bold fs-6">Genel Notlar</label>
                            <div class="col-lg-9">
                                <textarea rows="5" id="create_earthquake_information_general_notes" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="Genel Notlar"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="button" data-bs-dismiss="modal" class="btn btn-light me-3">Vazgeç</button>
                        <button type="button" class="btn btn-success" id="CreateEarthquakeInformationButton">Oluştur</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
