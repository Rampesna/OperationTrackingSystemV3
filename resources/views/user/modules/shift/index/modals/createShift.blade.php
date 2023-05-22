<div class="modal fade show" id="CreateShiftModal" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered mw-900px">
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
                <input type="hidden" id="create_shift_clicked_date">
                <div class="form fv-plugins-bootstrap5 fv-plugins-framework">
                    <div class="mb-13 text-center">
                        <h1 class="mb-3">Yeni Vardiya Oluştur</h1>
                    </div>
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <div class="row mb-5">
                            <div class="input-group flex-nowrap">
                                <button id="createShiftSelectAllEmployeesButton" class="btn btn-sm btn-success btn-icon">
                                    <i class="fas fa-check-double"></i>
                                </button>
                                <select id="create_shift_employees" class="form-select form-select-solid select2Input" data-control="select2" data-close-on-select="false" data-placeholder="Personeller" aria-label="Personeller" multiple></select>
                                <button id="createShiftUnselectAllEmployeesButton" class="btn btn-sm btn-danger btn-icon">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <hr>
                        <div class="row mb-5">
                            <div class="col-xl-8 mt-3">
                                <label for="create_shift_shift_group_id" class="font-weight-bolder">Vardiya Grubu</label>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group">
                                    <select id="create_shift_shift_group_id" class="form-select form-select-solid select2Input" data-control="select2" data-placeholder="Vardiya Grubu"></select>
                                </div>
                            </div>
                        </div>
                        <hr class="text-muted">
                        <div class="row mb-5">
                            <div class="col-xl-8 mt-3">
                                <label for="create_shift_start_date" class="font-weight-bolder">Vardiya Başlangıcı</label>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group">
                                    <input id="create_shift_start_date" type="datetime-local" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-8 mt-3">
                                <label for="create_shift_end_date" class="font-weight-bolder">Vardiya Bitişi</label>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group">
                                    <input id="create_shift_end_date" type="datetime-local" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                        <hr class="text-muted">
                        <div class="row mb-5">
                            <div class="col-xl-8 mt-3">
                                <label for="create_shift_food_break_start" class="font-weight-bolder">Yemek Molası Başlangıç Saati</label>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group">
                                    <input id="create_shift_food_break_start" type="time" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-8 mt-3">
                                <label for="create_shift_food_break_end" class="font-weight-bolder">Yemek Molası Bitiş Saati</label>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group">
                                    <input id="create_shift_food_break_end" type="time" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                        <hr class="text-muted">
                        <div class="row mb-5">
                            <div class="col-xl-8 mt-3">
                                <label for="create_shift_get_break_while_food_time" class="font-weight-bolder">Yemek Molası Saatlerinde İhtiyaç Molası Alabilmek</label>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group">
                                    <select id="create_shift_get_break_while_food_time" class="form-select form-select-solid">
                                        <option value="1">Evet</option>
                                        <option value="0">Hayır</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-8 mt-3">
                                <label for="create_shift_get_food_break_without_food_time" class="font-weight-bolder">Yemek Saatleri Dışında Yemek Molası Alabilmek</label>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group">
                                    <select id="create_shift_get_food_break_without_food_time" class="form-select form-select-solid">
                                        <option value="1">Evet</option>
                                        <option value="0">Hayır</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-8 mt-3">
                                <label for="create_shift_single_break_duration" class="font-weight-bolder">Kaç Dakikada Bir Mola Hakkı Kazanılır</label>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group">
                                    <input id="create_shift_single_break_duration" type="number" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-8 mt-3">
                                <label for="create_shift_get_first_break_after_shift_start" class="font-weight-bolder">İlk Mola Vardiya Başlangıcından Kaç Dakika Sonra Kullanılabilir</label>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group">
                                    <input id="create_shift_get_first_break_after_shift_start" type="number" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-8 mt-3">
                                <label for="create_shift_get_last_break_before_shift_end" class="font-weight-bolder">Vardiya Bitimine Kaç Dakika Kala Mola Alınamaz</label>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group">
                                    <input id="create_shift_get_last_break_before_shift_end" type="number" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-8 mt-3">
                                <label for="create_shift_get_break_after_last_break" class="font-weight-bolder">Son Moladan Kaç Dakika Sonra Tekrar Mola Alınabilir</label>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group">
                                    <input id="create_shift_get_break_after_last_break" type="number" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-8 mt-3">
                                <label for="create_shift_daily_food_break_amount" class="font-weight-bolder">Günlük Yemek Molası Hakkı Sayısı</label>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group">
                                    <input id="create_shift_daily_food_break_amount" type="number" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-8 mt-3">
                                <label for="create_shift_daily_break_duration" class="font-weight-bolder">Günlük Toplam Mola Süresi</label>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group">
                                    <input id="create_shift_daily_break_duration" type="number" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-8 mt-3">
                                <label for="create_shift_daily_food_break_duration" class="font-weight-bolder">Günlük Yemek Molası Süresi</label>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group">
                                    <input id="create_shift_daily_food_break_duration" type="number" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-8 mt-3">
                                <label for="create_shift_daily_break_break_duration" class="font-weight-bolder">Günlük İhtiyaç Molası Süresi</label>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group">
                                    <input id="create_shift_daily_break_break_duration" type="number" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-8 mt-3">
                                <label for="create_shift_momentary_food_break_duration" class="font-weight-bolder">Anlık Yemek Molası Süresi</label>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group">
                                    <input id="create_shift_momentary_food_break_duration" type="number" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-8 mt-3">
                                <label for="create_shift_momentary_break_break_duration" class="font-weight-bolder">Anlık İhtiyaç Molası Süresi</label>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group">
                                    <input id="create_shift_momentary_break_break_duration" type="number" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-8 mt-3">
                                <label for="create_shift_friday_additional_break_duration" class="font-weight-bolder">Cuma Günü Ek Mola Süresi</label>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group">
                                    <input id="create_shift_friday_additional_break_duration" type="number" class="form-control form-control-solid">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-xl-8 mt-3">
                                <label for="create_shift_suspend_break_using" class="font-weight-bolder">Mola Kullanım Kuralları</label>
                            </div>
                            <div class="col-xl-4">
                                <div class="form-group">
                                    <select id="create_shift_suspend_break_using" class="form-select form-select-solid">
                                        <option value="1">Aktif</option>
                                        <option value="0">Pasif</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="button" data-bs-dismiss="modal" class="btn btn-light me-3">Vazgeç</button>
                        <button type="button" class="btn btn-success" id="CreateShiftButton">Oluştur</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
