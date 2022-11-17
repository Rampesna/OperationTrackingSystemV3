<script src="{{ asset('assets/ck/ckeditor.js') }}"></script>

<script>

    var base64regex = /^([0-9a-zA-Z+/]{4})*(([0-9a-zA-Z+/]{2}==)|([0-9a-zA-Z+/]{3}=))?$/;

    var scriptId = parseInt(base64regex.test(`{{ $scriptId }}`) ? atob(`{{ $scriptId }}`) : 0);
    var scriptCode = parseInt(base64regex.test(`{{ $scriptCode }}`) ? atob(`{{ $scriptCode }}`) : 0);

    var updateSurveyDescriptionHtmlCkEditor = null;

    ClassicEditor.create(document.querySelector('#update_survey_description_html')).then(editor => {
        updateSurveyDescriptionHtmlCkEditor = editor;
    }).catch(error => {
        console.error(error);
    });

    var UpdateSurveyButton = $('#UpdateSurveyButton');

    function getSurvey() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.operationApi.surveySystem.getSurveyEdit') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: scriptId,
            },
            success: function (response) {
                console.log(response);
                $('#update_survey_code').val(response.response.kodu);
                $('#update_survey_name').val(response.response.adi);
                $('#update_survey_status').val(response.response.durum).trigger('change');
                $('#update_survey_is_survey').val(response.response.scriptAnketMi).trigger('change');
                $('#update_survey_is_new_marketing_screen').val(response.response.yeniPazarlamaEkraniMi).trigger('change');
                $('#update_survey_cant_call_group_code').val(response.response.aranmayacakGrupKodu);
                updateSurveyDescriptionHtmlCkEditor.setData(response.response.aciklamaHtml ?? '');
                $('#update_survey_service_product').val(response.response.uyumCrmHizmetUrun);
                $('#update_survey_call_reason').val(response.response.uyumCrmCagriNedeni);
                $('#update_survey_tags').val(response.response.etiketler);
                $('#update_survey_customer_information_1').val(response.response.musteriBilgilendirme);
                $('#update_survey_customer_information_2').val(response.response.musteriBilgilendirme2);
                $('#update_survey_description').val(response.response.aciklama);
                $('#update_survey_opportunity').val(response.response.uyumCrmFirsat).trigger('change');
                $('#update_survey_call').val(response.response.uyumCrmCagri).trigger('change');
                $('#update_survey_dial_plan').val(response.response.uyumCrmAramaPlani).trigger('change');
                $('#update_survey_opportunity_redirect_to_seller').val(response.response.uyumCrmFirsatSaticiyaYonlendir).trigger('change');
                $('#update_survey_dial_plan_redirect_to_seller').val(response.response.uyumCrmAramaPlaniSaticiyaYonlendir).trigger('change');
                $('#update_survey_additional_product_opportunity').val(response.response.uyumCrmEkUrunFirsat).trigger('change');
                $('#update_survey_additional_product_call_plan').val(response.response.uyumCrmEkUrunAramaPlani).trigger('change');
                $('#update_survey_seller_redirection_type').val(response.response.uyumCrmSaticiKoduTurKodu).trigger('change');
                $('#update_survey_job_resource').val(response.response.uyumCrmIsKaynagi);
                $('#update_survey_list_code').val(response.response.uyumCrmListeKod);
                $('#update_survey_call_list').val('');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Script Detayı Alınırken Serviste Bir Hata Oluştu');
                $('#loader').hide();
            }
        });
    }

    getSurvey();

    UpdateSurveyButton.click(function () {
        var name = $('#update_survey_name').val();
        var status = $('#update_survey_status').val();
        var isNewMarketingScreen = $('#update_survey_is_new_marketing_screen').val();
        var serviceProduct = $('#update_survey_service_product').val();
        var callReason = $('#update_survey_call_reason').val();
        var tags = $('#update_survey_tags').val();
        var customerInformation1 = $('#update_survey_customer_information_1').val();
        var customerInformation2 = $('#update_survey_customer_information_2').val();
        var description = $('#update_survey_description').val();
        var opportunity = $('#update_survey_opportunity').val();
        var call = $('#update_survey_call').val();
        var dialPlan = $('#update_survey_dial_plan').val();
        var opportunityRedirectToSeller = $('#update_survey_opportunity_redirect_to_seller').val();
        var dialPlanRedirectToSeller = $('#update_survey_dial_plan_redirect_to_seller').val();
        var additionalProductOpportunity = $('#update_survey_additional_product_opportunity').val();
        var additionalProductCallPlan = $('#update_survey_additional_product_call_plan').val();
        var sellerRedirectionType = $('#update_survey_seller_redirection_type').val();
        var jobResource = $('#update_survey_job_resource').val();
        var listCode = $('#update_survey_list_code').val();
        var callList = $('#update_survey_call_list')[0].files[0];
        var isSurvey = $('#update_survey_is_survey').val();
        var cantCallGroupCode = $('#update_survey_cant_call_group_code').val();
        var descriptionHtml = updateSurveyDescriptionHtmlCkEditor.getData();

        if (!scriptCode) {
            toastr.warning('Script Kodu Boş Olamaz!');
        } else if (!name) {
            toastr.warning('Script Adı Boş Olamaz!');
        } else if (!status) {
            toastr.warning('Script Durumu Boş Olamaz!');
        } else if (!callReason) {
            toastr.warning('Çağrı Nedeni Boş Olamaz!');
        } else if (!customerInformation1) {
            toastr.warning('Müşteri Bilgilendirmesi 1 Boş Olamaz!');
        } else if (!customerInformation2) {
            toastr.warning('Müşteri Bilgilendirmesi 2 Boş Olamaz!');
        } else if (!description) {
            toastr.warning('Bilgi Notu Boş Olamaz!');
        } else if (!opportunity) {
            toastr.warning('Fırsat Açılsın mı Boş Olamaz!');
        } else if (!call) {
            toastr.warning('Çağrı Kaydı Atılsın mı Boş Olamaz!');
        } else if (!dialPlan) {
            toastr.warning('Arama Planı Gönderilsin mi Boş Olamaz!');
        } else if (!opportunityRedirectToSeller) {
            toastr.warning('Satıcıya Yönlendir Durumunda Fırsat Gönderilsin mi Boş Olamaz!');
        } else if (!dialPlanRedirectToSeller) {
            toastr.warning('Satıcıya Yönlendir Durumunda Arama Planı Gönderilsin mi Boş Olamaz!');
        } else if (!additionalProductOpportunity) {
            toastr.warning('Ek Ürün İçin Fırsat Gönderilsin mi Boş Olamaz!');
        } else if (!additionalProductCallPlan) {
            toastr.warning('Ek Ürün İçin Arama Planı Gönderilsin mi Boş Olamaz!');
        } else if (!isNewMarketingScreen) {
            toastr.warning('Ek Ürün İçin Arama Planı Gönderilsin mi Boş Olamaz!');
        } else if (!sellerRedirectionType) {
            toastr.warning('Durum Kodu Yönlendirme Tipi Boş Olamaz!');
        } else if (!isSurvey) {
            toastr.warning('Script Anket mi Boş Olamaz!');
        } else if (!listCode) {
            toastr.warning('Liste Kodu Boş Olamaz!');
        } else {
            UpdateSurveyButton.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i>');
            var formData = new FormData();
            formData.append('id', scriptId);
            formData.append('code', scriptCode);
            formData.append('name', name);
            formData.append('status', status);
            formData.append('isNewMarketingScreen', isNewMarketingScreen);
            formData.append('isSurvey', isSurvey);
            formData.append('cantCallGroupCode', cantCallGroupCode);
            formData.append('descriptionHtml', descriptionHtml);
            formData.append('serviceProduct', serviceProduct);
            formData.append('callReason', callReason);
            formData.append('tags', tags);
            formData.append('customerInformation1', customerInformation1);
            formData.append('customerInformation2', customerInformation2);
            formData.append('description', description);
            formData.append('opportunity', parseInt(opportunity));
            formData.append('call', parseInt(call));
            formData.append('dialPlan', parseInt(dialPlan));
            formData.append('opportunityRedirectToSeller', parseInt(opportunityRedirectToSeller));
            formData.append('dialPlanRedirectToSeller', parseInt(dialPlanRedirectToSeller));
            formData.append('additionalProductOpportunity', parseInt(additionalProductOpportunity));
            formData.append('additionalProductCallPlan', parseInt(additionalProductCallPlan));
            formData.append('sellerRedirectionType', parseInt(sellerRedirectionType));
            formData.append('jobResource', jobResource);
            formData.append('listCode', listCode);
            formData.append('callList', callList);
            $.ajax({
                processData: false,
                contentType: false,
                type: 'post',
                url: '{{ route('user.api.operationApi.surveySystem.setSurvey') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: formData,
                success: function () {
                    toastr.success('Script Başarıyla Güncellendi');
                    setTimeout(function () {
                        window.open(`{{ route('user.web.salesAndMarketing.modules.survey.index') }}`, '_self');
                    }, 1000);
                },
                error: function (error) {
                    console.log(error);
                    UpdateSurveyButton.attr('disabled', false).html('Güncelle');
                    if (parseInt(error.status) === 422) {
                        $.each(error.responseJSON.response, function (i, error) {
                            toastr.error(error[0]);
                        });
                    } else {
                        toastr.error(error.responseJSON.message);
                    }
                }
            });
        }
    });

</script>
