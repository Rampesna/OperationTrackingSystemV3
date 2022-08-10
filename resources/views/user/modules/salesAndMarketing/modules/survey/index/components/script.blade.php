<script src="{{ asset('assets/jqwidgets/jqxcore.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxbuttons.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxscrollbar.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxlistbox.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxdropdownlist.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxmenu.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxgrid.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxgrid.selection.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxgrid.columnsreorder.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxgrid.columnsresize.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxgrid.filter.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxgrid.sort.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxdata.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxgrid.pager.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxnumberinput.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxwindow.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxdata.export.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxgrid.export.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxexport.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqxgrid.grouping.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/globalization/globalize.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jqgrid-localization.js') }}"></script>
<script src="{{ asset('assets/jqwidgets/jszip.min.js') }}"></script>

<script>

    var allSurveys = [];

    var surveysDiv = $('#surveys');

    var connectSubSurveySurveyId = $('#connect_sub_survey_survey_id');

    var CreateSurveyButton = $('#CreateSurveyButton');
    var UpdateSurveyButton = $('#UpdateSurveyButton');
    var DeleteSurveyButton = $('#DeleteSurveyButton');
    var ConnectSubSurveyButton = $('#ConnectSubSurveyButton');

    function createRandomCode() {
        return parseInt(Math.floor((Math.random() * 100000) + 10000) / 10) * 10;
    }

    function reGenerateCreateSurveyCode() {
        return $('#create_survey_code').val(createRandomCode());
    }

    function getSurveys() {
        $('#loader').show();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.operationApi.surveySystem.getSurveyList') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {

                allSurveys = response.response;

                var source = {
                    localdata: response.response,
                    datatype: "array",
                    datafields:
                        [
                            {name: 'id', type: 'integer'},
                            {name: 'kodu', type: 'integer'},
                            {name: 'adi', type: 'string'},
                            {name: 'uyumCrmCagriNedeni', type: 'string'},
                            {name: 'uyumCrmHizmetUrun', type: 'string'},
                            {name: 'uyumCrmFirsat', type: 'string'},
                            {name: 'uyumCrmCagri', type: 'string'},
                            {name: 'uyumCrmAramaPlani', type: 'string'},
                            {name: 'uyumCrmFirsatSaticiyaYonlendir', type: 'string'},
                            {name: 'uyumCrmAramaPlaniSaticiyaYonlendir', type: 'string'},
                            {name: 'durum', type: 'string'},
                        ]
                };
                var dataAdapter = new $.jqx.dataAdapter(source);
                surveysDiv.jqxGrid({
                    width: '100%',
                    height: '600',
                    source: dataAdapter,
                    columnsresize: true,
                    groupable: true,
                    theme: jqxGridGlobalTheme,
                    filterable: true,
                    showfilterrow: true,
                    pageable: false,
                    sortable: true,
                    pagesizeoptions: ['10', '20', '50', '1000'],
                    localization: getLocalization('tr'),
                    columns: [
                        {
                            text: '#',
                            dataField: 'id',
                            columntype: 'textbox',
                            width: '3%'

                        },
                        {
                            text: 'Script Kodu',
                            dataField: 'kodu',
                            columntype: 'textbox',
                            width: '5%'
                        },
                        {
                            text: 'Script Adı',
                            dataField: 'adi',
                            columntype: 'textbox',
                            width: '40%'
                        },
                        {
                            text: 'Çağrı Nedeni',
                            dataField: 'uyumCrmCagriNedeni',
                            columntype: 'textbox',
                            width: '6%'
                        },
                        {
                            text: 'Hizmet/Ürün',
                            dataField: 'uyumCrmHizmetUrun',
                            columntype: 'textbox',
                            width: '11%'
                        },
                        {
                            text: 'Fırsat Oluşturulsun Mu',
                            dataField: 'uyumCrmFirsat',
                            columntype: 'textbox',
                            width: '5%'
                        },
                        {
                            text: 'Çağrı Kaydı Oluşturulsun Mu',
                            dataField: 'uyumCrmCagri',
                            columntype: 'textbox',
                            width: '5%'
                        },
                        {
                            text: 'Arama Planı',
                            dataField: 'uyumCrmAramaPlani',
                            columntype: 'textbox',
                            width: '5%'
                        },
                        {
                            text: 'Satıcıya Yönlendir Durumunda Fırsat Gönderilsin mi?',
                            dataField: 'uyumCrmFirsatSaticiyaYonlendir',
                            columntype: 'textbox',
                            width: '5%'
                        },
                        {
                            text: 'Satıcıya Yönlendir Durumunda Arama Planı Gönderilsin mi?',
                            dataField: 'uyumCrmAramaPlaniSaticiyaYonlendir',
                            columntype: 'textbox',
                            width: '5%'
                        },
                        {
                            text: 'Durum',
                            dataField: 'durum',
                            columntype: 'textbox',
                            width: '10%'
                        }
                    ],
                });
                surveysDiv.on('rowclick', function (event) {
                    surveysDiv.jqxGrid('selectrow', event.args.rowindex);
                    var rowindex = surveysDiv.jqxGrid('getselectedrowindex');
                    $('#selected_survey_row_index').val(rowindex);
                    var dataRecord = surveysDiv.jqxGrid('getrowdata', rowindex);
                    $('#selected_survey_id').val(dataRecord.id);
                    $('#selected_survey_code').val(dataRecord.kodu);
                    return false;
                });
                surveysDiv.jqxGrid('sortby', 'id', 'desc');

                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Script Listesi Alınırken Serviste Bir Hata Oluştu');
                $('#loader').hide();
            }
        });
    }

    getSurveys();

    function transactions() {
        var selectedSurveyId = $('#selected_survey_id').val();
        if (!selectedSurveyId) {
            $('.editingTransaction').hide();
        } else {
            $('.editingTransaction').show();
        }
        $('#TransactionsModal').modal('show');
    }

    function createSurvey() {
        $('#TransactionsModal').modal('hide');
        $('#create_survey_code').val(createRandomCode());
        $('#create_survey_name').val('');
        $('#create_survey_status').val('');
        $('#create_survey_service_product').val('');
        $('#create_survey_call_reason').val('');
        $('#create_survey_tags').val('');
        $('#create_survey_customer_information_1').val('');
        $('#create_survey_customer_information_2').val('');
        $('#create_survey_description').val('');
        $('#create_survey_opportunity').val('');
        $('#create_survey_call').val('');
        $('#create_survey_dial_plan').val('');
        $('#create_survey_opportunity_redirect_to_seller').val('');
        $('#create_survey_dial_plan_redirect_to_seller').val('');
        $('#create_survey_additional_product_opportunity').val('');
        $('#create_survey_additional_product_call_plan').val('');
        $('#create_survey_seller_redirection_type').val('');
        $('#create_survey_job_resource').val('');
        $('#create_survey_list_code').val('');
        $('#create_survey_call_list').val('');
        $('#CreateSurveyModal').modal('show');
    }

    function updateSurvey() {
        $('#loader').show();
        var id = parseInt($('#selected_survey_id').val());
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.operationApi.surveySystem.getSurveyEdit') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function (response) {
                $('#TransactionsModal').modal('hide');
                $('#update_survey_code').val(response.response.kodu);
                $('#update_survey_name').val(response.response.adi);
                $('#update_survey_status').val(response.response.durum);
                $('#update_survey_service_product').val(response.response.uyumCrmHizmetUrun);
                $('#update_survey_call_reason').val(response.response.uyumCrmCagriNedeni);
                $('#update_survey_tags').val(response.response.etiketler);
                $('#update_survey_customer_information_1').val(response.response.musteriBilgilendirme);
                $('#update_survey_customer_information_2').val(response.response.musteriBilgilendirme2);
                $('#update_survey_description').val(response.response.aciklama);
                $('#update_survey_opportunity').val(response.response.uyumCrmFirsat);
                $('#update_survey_call').val(response.response.uyumCrmCagri);
                $('#update_survey_dial_plan').val(response.response.uyumCrmAramaPlani);
                $('#update_survey_opportunity_redirect_to_seller').val(response.response.uyumCrmFirsatSaticiyaYonlendir);
                $('#update_survey_dial_plan_redirect_to_seller').val(response.response.uyumCrmAramaPlaniSaticiyaYonlendir);
                $('#update_survey_additional_product_opportunity').val(response.response.uyumCrmEkUrunFirsat);
                $('#update_survey_additional_product_call_plan').val(response.response.uyumCrmEkUrunAramaPlani);
                $('#update_survey_seller_redirection_type').val(response.response.uyumCrmSaticiKoduTurKodu);
                $('#update_survey_job_resource').val(response.response.uyumCrmIsKaynagi);
                $('#update_survey_list_code').val(response.response.uyumCrmListeKod);
                $('#update_survey_call_list').val('');
                $('#UpdateSurveyModal').modal('show');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Script Detayı Alınırken Serviste Bir Hata Oluştu');
                $('#loader').hide();
            }
        });
    }

    function deleteSurvey() {
        $('#TransactionsModal').modal('hide');
        $('#DeleteSurveyModal').modal('show');
    }

    function connectSubSurvey() {
        $('#TransactionsModal').modal('hide');
        var selectedSurveyId = $('#selected_survey_id').val();
        connectSubSurveySurveyId.empty();
        $.each(allSurveys, function (i, survey) {
            if (parseInt(selectedSurveyId) !== parseInt(survey.id)) {
                connectSubSurveySurveyId.append(`<option value="${survey.id}" data-code="${survey.kodu}">(${survey.kodu}) ${survey.adi}</option>`);
            }
        });
        connectSubSurveySurveyId.val('');
        $('#ConnectSubSurveyModal').modal('show');
    }

    function surveyQuestions() {
        var id = parseInt($('#selected_survey_id').val());
        var code = parseInt($('#selected_survey_code').val());
        window.open(`{{ route('user.web.salesAndMarketing.modules.survey.question') }}?id=${id}&code=${code}`, '_blank');
    }

    function surveyExamine() {
        var id = parseInt($('#selected_survey_id').val());
        var code = parseInt($('#selected_survey_code').val());
        window.open(`{{ route('user.web.salesAndMarketing.modules.survey.examine') }}?id=${id}&code=${code}`, '_blank');
    }

    function surveyReportGeneral() {
        var id = parseInt($('#selected_survey_id').val());
        var code = parseInt($('#selected_survey_code').val());
        window.open(`{{ route('user.web.salesAndMarketing.modules.survey.report.general') }}?id=${id}&code=${code}`, '_blank');
    }

    function surveyReportDetail() {
        var id = parseInt($('#selected_survey_id').val());
        var code = parseInt($('#selected_survey_code').val());
        window.open(`{{ route('user.web.salesAndMarketing.modules.survey.report.detail') }}?id=${id}&code=${code}`, '_blank');
    }

    function surveyReportEmployee() {
        var id = parseInt($('#selected_survey_id').val());
        var code = parseInt($('#selected_survey_code').val());
        window.open(`{{ route('user.web.salesAndMarketing.modules.survey.report.employee') }}?id=${id}&code=${code}`, '_blank');
    }

    CreateSurveyButton.click(function () {
        var id = null;
        var code = $('#create_survey_code').val();
        var name = $('#create_survey_name').val();
        var status = $('#create_survey_status').val();
        var serviceProduct = $('#create_survey_service_product').val();
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
        var callList = $('#create_survey_call_list')[0].files[0];

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
        } else if (!jobResource) {
            toastr.warning('İş Kaynağı Boş Olamaz!');
        } else if (!listCode) {
            toastr.warning('Liste Kodu Boş Olamaz!');
        } else {
            $('#loader').show();
            var formData = new FormData();
            formData.append('code', code);
            formData.append('name', name);
            formData.append('status', status);
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
                success: function (response) {
                    getSurveys();
                    $('#CreateSurveyModal').modal('hide');
                    toastr.success('Script Başarıyla Oluşturuldu');
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Script Oluşturulurken Serviste Bir Hata Oluştu!');
                    $('#loader').hide();
                }
            });
        }
    });

    UpdateSurveyButton.click(function () {
        var id = parseInt($('#selected_survey_id').val());
        var code = $('#update_survey_code').val();
        var name = $('#update_survey_name').val();
        var status = $('#update_survey_status').val();
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
        } else if (!jobResource) {
            toastr.warning('İş Kaynağı Boş Olamaz!');
        } else if (!listCode) {
            toastr.warning('Liste Kodu Boş Olamaz!');
        } else {
            $('#loader').show();
            var formData = new FormData();
            formData.append('id', id);
            formData.append('code', code);
            formData.append('name', name);
            formData.append('status', status);
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
                    getSurveys();
                    $('#UpdateSurveyModal').modal('hide');
                    toastr.success('Script Başarıyla Güncellendi');
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Script Güncellenirken Serviste Bir Hata Oluştu!');
                    $('#loader').hide();
                }
            });
        }
    });

    DeleteSurveyButton.click(function () {
        var id = $('#selected_survey_id').val();
        if (!id) {
            toastr.warning('Script Seçiminde Hata Var, Sayfayı Yenilemeyi Deneyebilirsiniz');
        } else {
            $('#loader').show();
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.operationApi.surveySystem.setSurveyDelete') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: id,
                },
                success: function () {
                    getSurveys();
                    $('#DeleteSurveyModal').modal('hide');
                    toastr.success('Script Başarıyla Silindi');
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Script Silinirken Serviste Bir Hata Oluştu!');
                    $('#loader').hide();
                }
            });
        }
    });

    ConnectSubSurveyButton.click(function () {
        var surveyCode = parseInt($('#selected_survey_id').val());
        var subSurveyCode = parseInt(connectSubSurveySurveyId.find('option:selected').data('code'));

        if (!surveyCode) {
            toastr.warning('Script Seçiminde Hata Var, Sayfayı Yenilemeyi Deneyebilirsiniz');
        } else if (!subSurveyCode) {
            toastr.warning('Alt Script Seçimi Zorunludur!');
        } else {
            $('#loader').show();
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.operationApi.surveySystem.setSurveyGroupConnect') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    surveyCode: surveyCode,
                    subSurveyCode: subSurveyCode,
                },
                success: function () {
                    $('#ConnectSubSurveyModal').modal('hide');
                    toastr.success('Alt Script Başarıyla Bağlandı');
                    $('#loader').hide();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Alt Script Bağlanırken Serviste Bir Hata Oluştu!');
                    $('#loader').hide();
                }
            });
        }
    });

    $('body').on('contextmenu', function () {
        transactions();
        return false;
    });

</script>
