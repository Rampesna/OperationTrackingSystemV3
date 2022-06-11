<div class="modal fade show" id="UpdateShiftGroupModal" tabindex="-1" aria-modal="true" role="dialog" data-bs-backdrop="static">
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
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0">
                <input type="hidden" id="update_shift_group_id">
                <div class="row">
                    <div id="UpdateShiftGroupWizardStepper" class="stepper stepper-links d-flex flex-column pt-15 between" data-kt-stepper="true">
                        <div class="stepper-nav mb-5">
                            <div class="stepper-item current" data-kt-stepper-element="nav" data-kt-stepper-action="step">
                                <h3 class="stepper-title">Genel Bilgiler</h3>
                            </div>
                            <div class="stepper-item pending" data-kt-stepper-element="nav" data-kt-stepper-action="step">
                                <h3 class="stepper-title">Çalışma Saatleri</h3>
                            </div>
                            <div class="stepper-item pending" data-kt-stepper-element="nav" data-kt-stepper-action="step">
                                <h3 class="stepper-title">OTS Ayarları</h3>
                            </div>
                            <div class="stepper-item pending" data-kt-stepper-element="nav" data-kt-stepper-action="step">
                                <h3 class="stepper-title">Ek Ayarlar</h3>
                            </div>
                        </div>
                        <form class="mx-auto mw-700px w-100 pt-15 pb-10 fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate" id="createEmployeeForm">
                            <div class="current" data-kt-stepper-element="content">
                                <div class="row w-xl-1000px">
                                    <div class="col-xl-2 mb-5">
                                        <div class="form-group">
                                            <label for="update_shift_group_order" class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                <span class="required">Sıra</span>
                                            </label>
                                            <input id="update_shift_group_order" type="text" class="form-control form-control-solid onlyNumber" placeholder="Sıra" aria-hidden="true">
                                        </div>
                                    </div>
                                    <div class="col-xl-10 mb-5">
                                        <div class="form-group">
                                            <label for="update_shift_group_name" class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                <span class="required">Vardiya Grubu Adı</span>
                                            </label>
                                            <input id="update_shift_group_name" type="text" class="form-control form-control-solid" placeholder="Vardiya Grubu Adı" aria-hidden="true">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 mb-5">
                                        <div class="form-group">
                                            <label for="update_shift_group_add_type" class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                <span class="required">Eklenme Türü</span>
                                            </label>
                                            <select id="update_shift_group_add_type" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Eklenme Türü">
                                                <option value="1">Her Güne Herkes Eklensin</option>
                                                <option value="0">Her Güne Belirli Sayıda Kişi Eklensin</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 mb-5">
                                        <div class="form-group">
                                            <label for="update_shift_group_per_day" class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                <span class="required">Her Güne Eklenecek Kişi Sayısı</span>
                                            </label>
                                            <input id="update_shift_group_per_day" type="text" class="form-control form-control-solid onlyNumber" placeholder="Her Güne Eklenecek Kişi Sayısı" aria-hidden="true" disabled>
                                        </div>
                                    </div>
                                    <div class="col-xl-10 mb-5">
                                        <div class="form-group">
                                            <label for="update_shift_group_employees" class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                <span class="required">Personeller</span>
                                            </label>
                                            <select id="update_shift_group_employees" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Personeller" multiple></select>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 mb-5">
                                        <button type="button" class="btn btn-sm btn-icon btn-success mt-9" id="UpdateShiftGroupSelectAllEmployeesButton"><i class="fas fa-check-double"></i></button>
                                        <button type="button" class="btn btn-sm btn-icon btn-danger mt-9" id="UpdateShiftGroupUnSelectAllEmployeesButton"><i class="fa fa-times-circle"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div data-kt-stepper-element="content">
                                <div class="row w-xl-1000px">
                                    <div class="col-xl-12">
                                        <div class="row">
                                            <div class="col-xl-2 mt-4 mb-5">
                                                <div class="form-check form-check-success form-check-solid">
                                                    <input class="form-check-input" type="checkbox" id="update_shift_group_day1" checked />
                                                    <label class="form-check-label" for="update_shift_group_day1">
                                                        Pazartesi
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-xl-10 mb-5">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <label for="update_shift_group_day1_start_time"></label>
                                                        <input value="09:00" id="update_shift_group_day1_start_time" type="time" class="form-control form-control-solid">
                                                        <label for="update_shift_group_day1_end_time"></label>
                                                        <input value="18:00" id="update_shift_group_day1_end_time" type="time" class="form-control form-control-solid">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="row">
                                            <div class="col-xl-2 mt-4 mb-5">
                                                <div class="form-check form-check-success form-check-solid">
                                                    <input class="form-check-input" type="checkbox" id="update_shift_group_day2" checked />
                                                    <label class="form-check-label" for="update_shift_group_day2">
                                                        Salı
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-xl-10 mb-5">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <label for="update_shift_group_day2_start_time"></label>
                                                        <input value="09:00" id="update_shift_group_day2_start_time" type="time" class="form-control form-control-solid">
                                                        <label for="update_shift_group_day2_end_time"></label>
                                                        <input value="18:00" id="update_shift_group_day2_end_time" type="time" class="form-control form-control-solid">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="row">
                                            <div class="col-xl-2 mt-4 mb-5">
                                                <div class="form-check form-check-success form-check-solid">
                                                    <input class="form-check-input" type="checkbox" id="update_shift_group_day3" checked />
                                                    <label class="form-check-label" for="update_shift_group_day3">
                                                        Çarşamba
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-xl-10 mb-5">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <label for="update_shift_group_day3_start_time"></label>
                                                        <input value="09:00" id="update_shift_group_day3_start_time" type="time" class="form-control form-control-solid">
                                                        <label for="update_shift_group_day3_end_time"></label>
                                                        <input value="18:00" id="update_shift_group_day3_end_time" type="time" class="form-control form-control-solid">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="row">
                                            <div class="col-xl-2 mt-4 mb-5">
                                                <div class="form-check form-check-success form-check-solid">
                                                    <input class="form-check-input" type="checkbox" id="update_shift_group_day4" checked />
                                                    <label class="form-check-label" for="update_shift_group_day4">
                                                        Perşembe
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-xl-10 mb-5">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <label for="update_shift_group_day4_start_time"></label>
                                                        <input value="09:00" id="update_shift_group_day4_start_time" type="time" class="form-control form-control-solid">
                                                        <label for="update_shift_group_day4_end_time"></label>
                                                        <input value="18:00" id="update_shift_group_day4_end_time" type="time" class="form-control form-control-solid">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="row">
                                            <div class="col-xl-2 mt-4 mb-5">
                                                <div class="form-check form-check-success form-check-solid">
                                                    <input class="form-check-input" type="checkbox" id="update_shift_group_day5" checked />
                                                    <label class="form-check-label" for="update_shift_group_day5">
                                                        Cuma
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-xl-10 mb-5">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <label for="update_shift_group_day5_start_time"></label>
                                                        <input value="09:00" id="update_shift_group_day5_start_time" type="time" class="form-control form-control-solid">
                                                        <label for="update_shift_group_day5_end_time"></label>
                                                        <input value="18:00" id="update_shift_group_day5_end_time" type="time" class="form-control form-control-solid">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="row">
                                            <div class="col-xl-2 mt-4 mb-5">
                                                <div class="form-check form-check-success form-check-solid">
                                                    <input class="form-check-input" type="checkbox" id="update_shift_group_day6" checked />
                                                    <label class="form-check-label" for="update_shift_group_day6">
                                                        Cumartesi
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-xl-10 mb-5">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <label for="update_shift_group_day6_start_time"></label>
                                                        <input value="09:00" id="update_shift_group_day6_start_time" type="time" class="form-control form-control-solid">
                                                        <label for="update_shift_group_day6_end_time"></label>
                                                        <input value="18:00" id="update_shift_group_day6_end_time" type="time" class="form-control form-control-solid">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="row">
                                            <div class="col-xl-2 mt-4 mb-5">
                                                <div class="form-check form-check-success form-check-solid">
                                                    <input class="form-check-input" type="checkbox" id="update_shift_group_day0" />
                                                    <label class="form-check-label" for="update_shift_group_day0">
                                                        Pazar
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-xl-10 mb-5">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <label for="update_shift_group_day0_start_time"></label>
                                                        <input value="09:00" id="update_shift_group_day0_start_time" type="time" class="form-control form-control-solid">
                                                        <label for="update_shift_group_day0_end_time"></label>
                                                        <input value="18:00" id="update_shift_group_day0_end_time" type="time" class="form-control form-control-solid">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div data-kt-stepper-element="content">
                                <div class="row w-xl-1000px">
                                    <div class="col-xl-6 mb-5">
                                        <div class="form-group">
                                            <label for="update_shift_group_food_break_start">Yemek Molası Başlangıç Saati</label>
                                            <input id="update_shift_group_food_break_start" type="time" class="form-control form-control-solid">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 mb-5">
                                        <div class="form-group">
                                            <label for="update_shift_group_food_break_end">Yemek Molası Bitiş Saati</label>
                                            <input id="update_shift_group_food_break_end" type="time" class="form-control form-control-solid">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 mb-5">
                                        <div class="form-group">
                                            <label for="update_shift_group_get_break_while_food_time">Yemek Molasındayken Mola Alabilmek</label>
                                            <select id="update_shift_group_get_break_while_food_time" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Yemek Molasındayken Mola Alabilmek">
                                                <option value="0">Hayır</option>
                                                <option value="1">Evet</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 mb-5">
                                        <div class="form-group">
                                            <label for="update_shift_group_get_food_break_without_food_time">Yemek Zamanı Dışında Yemek Molası Alabilmek</label>
                                            <select id="update_shift_group_get_food_break_without_food_time" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Yemek Zamanı Dışında Yemek Molası Alabilmek">
                                                <option value="0">Hayır</option>
                                                <option value="1">Evet</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 mb-5">
                                        <div class="form-group">
                                            <label for="update_shift_group_single_break_duration">Kaç Dakikada Bir Mola Hakkı Kazanılır</label>
                                            <input id="update_shift_group_single_break_duration" type="number" class="form-control form-control-solid onlyNumber">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 mb-5">
                                        <div class="form-group">
                                            <label for="update_shift_group_get_first_break_after_shift_start">İlk Mola Kaç Dakika Sonra Kullanılabilir</label>
                                            <input id="update_shift_group_get_first_break_after_shift_start" type="number" class="form-control form-control-solid onlyNumber">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 mb-5">
                                        <div class="form-group">
                                            <label for="update_shift_group_get_last_break_before_shift_end">Vardiya Bitimine Kaç Dakika Kala Mola Alınamaz</label>
                                            <input id="update_shift_group_get_last_break_before_shift_end" type="number" class="form-control form-control-solid onlyNumber">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 mb-5">
                                        <div class="form-group">
                                            <label for="update_shift_group_get_break_after_last_break">Son Moladan Kaç Dakika Sonra Tekrar Mola Alınabilir</label>
                                            <input id="update_shift_group_get_break_after_last_break" type="number" class="form-control form-control-solid onlyNumber">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 mb-5">
                                        <div class="form-group">
                                            <label for="update_shift_group_daily_food_break_amount">Günlük Yemek Molası Hakkı Sayısı</label>
                                            <input id="update_shift_group_daily_food_break_amount" type="number" class="form-control form-control-solid onlyNumber">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 mb-5">
                                        <div class="form-group">
                                            <label for="update_shift_group_daily_break_duration">Günlük Toplam Mola Süresi</label>
                                            <input id="update_shift_group_daily_break_duration" type="number" class="form-control form-control-solid onlyNumber">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 mb-5">
                                        <div class="form-group">
                                            <label for="update_shift_group_daily_food_break_duration">Günlük Toplam Yemek Molası Süresi</label>
                                            <input id="update_shift_group_daily_food_break_duration" type="number" class="form-control form-control-solid onlyNumber">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 mb-5">
                                        <div class="form-group">
                                            <label for="update_shift_group_daily_break_break_duration">Günlük Toplam İhtiyaç Molası Süresi</label>
                                            <input id="update_shift_group_daily_break_break_duration" type="number" class="form-control form-control-solid onlyNumber">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 mb-5">
                                        <div class="form-group">
                                            <label for="update_shift_group_momentary_food_break_duration">Anlık Yemek Molası Süresi</label>
                                            <input id="update_shift_group_momentary_food_break_duration" type="number" class="form-control form-control-solid onlyNumber">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 mb-5">
                                        <div class="form-group">
                                            <label for="update_shift_group_momentary_break_break_duration">Anlık İhtiyaç Molası Süresi</label>
                                            <input id="update_shift_group_momentary_break_break_duration" type="number" class="form-control form-control-solid onlyNumber">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 mb-5">
                                        <div class="form-group">
                                            <label for="update_shift_group_friday_additional_break_duration">Cuma Günü Ek Mola Süresi</label>
                                            <input id="update_shift_group_friday_additional_break_duration" type="number" class="form-control form-control-solid onlyNumber">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 mb-5">
                                        <div class="form-group">
                                            <label for="update_shift_group_suspend_break_using">Mola Kısıtlaması Var mı?</label>
                                            <select id="update_shift_group_suspend_break_using" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Yemek Zamanı Dışında Yemek Molası Alabilmek">
                                                <option value="0">Hayır</option>
                                                <option value="1">Evet</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div data-kt-stepper-element="content">
                                <div class="row w-xl-1000px">
                                    <div class="col-xl-12">
                                        <div class="row">
                                            <div class="col-xl-12 mb-5">
                                                <div class="form-check form-check-success form-check-solid">
                                                    <input class="form-check-input" type="checkbox" id="update_shift_group_delete_if_exist" checked />
                                                    <label class="form-check-label" for="update_shift_group_delete_if_exist">
                                                        Zaten Vardiya Mevcutsa, Var Olan Silinsin Yenisi Eklensin
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="row">
                                            <div class="col-xl-8 mt-3 mb-5">
                                                <div class="form-check form-check-success form-check-solid">
                                                    <input class="form-check-input" type="checkbox" id="update_shift_group_week_permit" />
                                                    <label class="form-check-label" for="update_shift_group_week_permit">
                                                        Pazar Vardiyası Olan Personele, Seçili Gün Vardiya Eklenmesin
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 mb-5">
                                                <div class="form-group">
                                                    <label style="width: 100%">
                                                        <select id="update_shift_group_number_of_week_permit_day" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Gün">
                                                            <option value="1">Pazartesi</option>
                                                            <option value="2">Salı</option>
                                                            <option value="3">Çarşamba</option>
                                                            <option value="4">Perşembe</option>
                                                            <option value="5">Cuma</option>
                                                            <option value="6">Cumartesi</option>
                                                        </select>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="row">
                                            <div class="col-xl-12 mb-5">
                                                <div class="form-check form-check-success form-check-solid">
                                                    <input class="form-check-input" type="checkbox" id="update_shift_group_set_group_weekly" />
                                                    <label class="form-check-label" for="update_shift_group_set_group_weekly">
                                                        Seçili Grup Hafta Boyunca Sabit Eklensin
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="row">
                                            <div class="col-xl-8 mt-3 mb-5">
                                                <div class="form-check form-check-success form-check-solid">
                                                    <input class="form-check-input" type="checkbox" id="update_shift_group_sunday_employee_from_shift_group" />
                                                    <label class="form-check-label" for="update_shift_group_sunday_employee_from_shift_group">
                                                        Pazar Günü Vardiyasını Sadece Seçili Gruba Ait Personellerden Seç
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 mb-5">
                                                <div class="form-group">
                                                    <label style="width: 100%">
                                                        <select id="update_shift_group_sunday_employee_from_shift_group_id" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Vardiya Grubu"></select>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-stack pt-15">
                                <div class="mr-2">
                                    <button type="button" class="btn btn-lg btn-light-primary me-3" data-kt-stepper-action="previous">
                                        <span class="svg-icon svg-icon-4 me-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="6" y="11" width="13" height="2" rx="1" fill="black"></rect>
                                                <path d="M8.56569 11.4343L12.75 7.25C13.1642 6.83579 13.1642 6.16421 12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75L5.70711 11.2929C5.31658 11.6834 5.31658 12.3166 5.70711 12.7071L11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25C13.1642 17.8358 13.1642 17.1642 12.75 16.75L8.56569 12.5657C8.25327 12.2533 8.25327 11.7467 8.56569 11.4343Z" fill="black"></path>
                                            </svg>
                                        </span>Geri
                                    </button>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-lg btn-primary me-3" data-kt-stepper-action="submit" id="UpdateShiftGroupButton">
                                        <span class="indicator-label">Kaydet
                                            <span class="svg-icon svg-icon-3 ms-2 me-0">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black"></rect>
                                                    <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black"></path>
                                                </svg>
                                            </span>
                                        </span>
                                    </button>
                                    <button type="button" class="btn btn-lg btn-primary" data-kt-stepper-action="next">İleri
                                        <span class="svg-icon svg-icon-4 ms-1 me-0">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black"></rect>
                                                <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black"></path>
                                            </svg>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
