<script src="{{ asset('assets/ck/ckeditor.js') }}"></script>

<script>

    $(document).ready(function () {
        $('#loader').hide();
    });

    var createSurveyDescriptionHtmlCkEditor = null;

    ClassicEditor.create(document.querySelector('#create_survey_description_html')).then(editor => {
        createSurveyDescriptionHtmlCkEditor = editor;
        createSurveyDescriptionHtmlCkEditor.setData(`HTML Açıklama`);
    }).catch(error => {
        console.error(error);
    });

    var CreateSurveyButton = $('#CreateSurveyButton');

    function createRandomCode() {
        return parseInt(Math.floor((Math.random() * 100000) + 10000) / 10) * 10;
    }

    function reGenerateCreateSurveyCode() {
        return $('#create_survey_code').val(createRandomCode());
    }

    reGenerateCreateSurveyCode();

    CreateSurveyButton.click(function () {
        var code = $('#create_survey_code').val();
        var name = $('#create_survey_name').val();
        var status = $('#create_survey_status').val();
        // var serviceProduct = $('#create_survey_service_product').val();
        var serviceProduct = '';
        var callReason = $('#create_survey_call_reason').val();
        var tags = $('#create_survey_tags').val();
        var customerInformation1 = $('#create_survey_customer_information_1').val();
        var customerInformation2 = $('#create_survey_customer_information_2').val();
        var description = $('#create_survey_description').val();
        var opportunity = $('#create_survey_opportunity').val();
        var call = $('#create_survey_call').val();
        var dialPlan = $('#create_survey_dial_plan').val();
        var opportunityRedirectToSeller = $('#create_survey_opportunity_redirect_to_seller').val();
        var dialPlanRedirectToSeller = $('#create_survey_dial_plan_redirect_to_seller').val();
        var additionalProductOpportunity = $('#create_survey_additional_product_opportunity').val();
        var additionalProductCallPlan = $('#create_survey_additional_product_call_plan').val();
        var sellerRedirectionType = $('#create_survey_seller_redirection_type').val();
        var jobResource = $('#create_survey_job_resource').val();
        var listCode = $('#create_survey_list_code').val();
        var isNewMarketingScreen = $('#create_survey_is_new_marketing_screen').val();
        var callList = $('#create_survey_call_list')[0].files[0];
        var isSurvey = $('#create_survey_is_survey').val();
        var cantCallGroupCode = $('#create_survey_cant_call_group_code').val();
        var descriptionHtml = createSurveyDescriptionHtmlCkEditor.getData();

        if (!code) {
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
        } else if (!sellerRedirectionType) {
            toastr.warning('Satıcı Yönlendirme Tipi Boş Olamaz!');
        } else if (!isNewMarketingScreen) {
            toastr.warning('Durum Kodu Yönlendirme Tipi Boş Olamaz!');
        } else if (!isSurvey) {
            toastr.warning('Script Anket Mi Seçilmedi!');
        } else if (!listCode) {
            toastr.warning('Liste Kodu Boş Olamaz!');
        } else {
            CreateSurveyButton.attr('disabled', true).html(`<i class="fa fa-spinner fa-spin"></i>`);
            var formData = new FormData();
            formData.append('code', code);
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
                    toastr.success('Script Başarıyla Oluşturuldu, Yönlendiriliyorsunuz...');
                    setTimeout(function () {
                        window.open(`{{ route('user.web.salesAndMarketing.modules.survey.index') }}`, '_self');
                    }, 1000);
                },
                error: function (error) {
                    console.log(error);
                    CreateSurveyButton.attr('disabled', false).html('Oluştur');
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
