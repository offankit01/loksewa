@extends('layouts.main')

@section('title', config('app.name', 'LokSewa Tayari') . ' - Services Roadmap')

@section('extra_css')
    <style>
        .page-header {
            background: linear-gradient(135deg, var(--primary-blue), #152c6e);
            color: white;
            padding: 4rem 0;
            position: relative;
            overflow: hidden;
        }
        .header-shape {
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(249, 115, 22, 0.1);
            border-radius: 50%;
            filter: blur(40px);
        }
        .accordion-item {
            border: none;
            border-radius: 1rem !important;
            margin-bottom: 1rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.02);
            overflow: hidden;
        }
        .accordion-button {
            padding: 1.5rem;
            font-weight: 600;
            font-size: 1.1rem;
            color: var(--primary-blue);
            background-color: white;
            box-shadow: none !important;
        }
        .accordion-button:not(.collapsed) {
            background-color: rgba(30, 58, 138, 0.03);
            color: var(--accent-orange);
        }
        .accordion-button::after {
            filter: invert(18%) sepia(51%) saturate(3015%) hue-rotate(212deg) brightness(85%) contrast(100%);
        }
        .accordion-button:not(.collapsed)::after {
            filter: invert(53%) sepia(85%) saturate(2250%) hue-rotate(349deg) brightness(99%) contrast(97%);
        }
        .service-category {
            background: rgba(0,0,0,0.02);
            border-radius: 0.5rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        .service-category h5 {
            color: var(--primary-blue);
            border-bottom: 2px solid rgba(30, 58, 138, 0.1);
            padding-bottom: 0.5rem;
            margin-bottom: 1rem;
            font-weight: 700;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .service-list {
            list-style: none;
            padding-left: 0;
            margin-bottom: 0;
        }
        .service-list li {
            padding: 0.5rem 0;
            position: relative;
            padding-left: 1.5rem;
            color: var(--dark-text);
            font-weight: 500;
        }
        .service-list li::before {
            content: "\F287";
            font-family: "bootstrap-icons";
            position: absolute;
            left: 0;
            color: var(--accent-orange);
            font-size: 0.875rem;
        }
    </style>
@endsection

@section('content')

    <!-- Page Header -->
    <header class="page-header">
        <div class="header-shape" style="top: -100px; right: -50px;"></div>
        <div class="header-shape" style="bottom: -150px; left: 10%;"></div>
        <div class="container position-relative z-1 text-center">
            <h1 class="display-5 fw-bold mb-3">LOKSEWA AAYOG</h1>
            <p class="lead text-white-50 mb-0">Complete Service Roadmap & Structure (लोकसेवा आयोग)</p>
        </div>
    </header>

    <!-- Roadmap Content -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    
                    <div class="accordion" id="servicesAccordion">
                        
                        <!-- 1. Administrative Service -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true">
                                    <i class="bi bi-building me-3"></i> 1. Nepal Administrative Service (नेपाल प्रशासन सेवा)
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#servicesAccordion">
                                <div class="accordion-body p-4 p-md-5">
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <div class="service-category">
                                                <h5>NON-GAZETTED (गैर-राजपत्रांकित)</h5>
                                                <ul class="service-list">
                                                    <li><a href="{{ route('service.show', 'kharidar') }}" class="text-decoration-none text-dark hover-text-primary">Kharidar (खरिदार)</a></li>
                                                    <li><a href="{{ route('service.show', 'nayab-subba') }}" class="text-decoration-none text-dark hover-text-primary">Nayab Subba (नायब सुब्बा)</a></li>
                                                </ul>
                                            </div>
                                            <div class="service-category">
                                                <h5>SPECIAL CLASS (विशिष्ट श्रेणी)</h5>
                                                <ul class="service-list">
                                                    <li><a href="{{ route('service.show', 'chief-secretary') }}" class="text-decoration-none text-dark hover-text-primary">Chief Secretary (मुख्य सचिव)</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="service-category h-100">
                                                <h5>GAZETTED (राजपत्रांकित)</h5>
                                                <ul class="service-list">
                                                    <li><a href="{{ route('service.show', 'section-officer') }}" class="text-decoration-none text-dark hover-text-primary">Section Officer (शाखा अधिकृत)</a></li>
                                                    <li><a href="{{ route('service.show', 'under-secretary') }}" class="text-decoration-none text-dark hover-text-primary">Under Secretary (उपसचिव)</a></li>
                                                    <li><a href="{{ route('service.show', 'joint-secretary') }}" class="text-decoration-none text-dark hover-text-primary">Joint Secretary (सहसचिव)</a></li>
                                                    <li><a href="{{ route('service.show', 'secretary') }}" class="text-decoration-none text-dark hover-text-primary">Secretary (सचिव)</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 2. Police Service -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                                    <i class="bi bi-shield-check me-3"></i> 2. Nepal Police Service (नेपाल प्रहरी सेवा)
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#servicesAccordion">
                                <div class="accordion-body p-4 p-md-5">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <ul class="service-list">
                                                <li><a href="{{ route('service.show', 'police-constable') }}" class="text-decoration-none text-dark hover-text-primary">Constable (प्रहरी जवान)</a></li>
                                                <li><a href="{{ route('service.show', 'police-head-constable') }}" class="text-decoration-none text-dark hover-text-primary">Head Constable (प्रहरी हवल्दार)</a></li>
                                                <li><a href="{{ route('service.show', 'police-asi') }}" class="text-decoration-none text-dark hover-text-primary">Assistant Sub Inspector (प्रहरी सहायक निरीक्षक - ASI)</a></li>
                                                <li><a href="{{ route('service.show', 'police-si') }}" class="text-decoration-none text-dark hover-text-primary">Sub Inspector (प्रहरी निरीक्षक - SI)</a></li>
                                                <li><a href="{{ route('service.show', 'police-inspector') }}" class="text-decoration-none text-dark hover-text-primary">Inspector (प्रहरी नायब उपरीक्षक - Inspector)</a></li>
                                                <li><a href="{{ route('service.show', 'police-dsp') }}" class="text-decoration-none text-dark hover-text-primary">Deputy Superintendent (प्रहरी उपरीक्षक - DSP)</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6 mt-3 mt-md-0">
                                            <ul class="service-list">
                                                <li><a href="{{ route('service.show', 'police-sp') }}" class="text-decoration-none text-dark hover-text-primary">Superintendent (प्रहरी वरिष्ठ उपरीक्षक - SP)</a></li>
                                                <li><a href="{{ route('service.show', 'police-ssp') }}" class="text-decoration-none text-dark hover-text-primary">Senior Superintendent (प्रहरी नायब महानिरीक्षक - SSP)</a></li>
                                                <li><a href="{{ route('service.show', 'police-dig') }}" class="text-decoration-none text-dark hover-text-primary">Deputy Inspector General (प्रहरी उप महानिरीक्षक - DIG)</a></li>
                                                <li><a href="{{ route('service.show', 'police-aig') }}" class="text-decoration-none text-dark hover-text-primary">Additional Inspector General (प्रहरी अतिरिक्त महानिरीक्षक - AIG)</a></li>
                                                <li><a href="{{ route('service.show', 'police-igp') }}" class="text-decoration-none text-dark hover-text-primary">Inspector General (प्रहरी महानिरीक्षक - IGP)</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 3. Army Service -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                                    <i class="bi bi-star-fill me-3"></i> 3. Nepal Army Service (नेपाली सेना सेवा)
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#servicesAccordion">
                                <div class="accordion-body p-4 p-md-5">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <ul class="service-list">
                                                <li><a href="{{ route('service.show', 'army-sainik') }}" class="text-decoration-none text-dark hover-text-primary">Sainik (सैनिक / Soldier)</a></li>
                                                <li><a href="{{ route('service.show', 'army-lance-corporal') }}" class="text-decoration-none text-dark hover-text-primary">Lance Corporal (लान्स कर्पोरल)</a></li>
                                                <li><a href="{{ route('service.show', 'army-corporal') }}" class="text-decoration-none text-dark hover-text-primary">Corporal (कर्पोरल)</a></li>
                                                <li><a href="{{ route('service.show', 'army-sergeant') }}" class="text-decoration-none text-dark hover-text-primary">Sergeant (हवल्दार)</a></li>
                                                <li><a href="{{ route('service.show', 'army-warrant-officer') }}" class="text-decoration-none text-dark hover-text-primary">Warrant Officer (वारेन्ट अफिसर)</a></li>
                                                <li><a href="{{ route('service.show', 'army-second-lieutenant') }}" class="text-decoration-none text-dark hover-text-primary">Second Lieutenant (द्वितीय लेफ्टिनेन्ट)</a></li>
                                                <li><a href="{{ route('service.show', 'army-lieutenant') }}" class="text-decoration-none text-dark hover-text-primary">Lieutenant (लेफ्टिनेन्ट)</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6 mt-3 mt-md-0">
                                            <ul class="service-list">
                                                <li><a href="{{ route('service.show', 'army-captain') }}" class="text-decoration-none text-dark hover-text-primary">Captain (क्याप्टेन)</a></li>
                                                <li><a href="{{ route('service.show', 'army-major') }}" class="text-decoration-none text-dark hover-text-primary">Major (मेजर)</a></li>
                                                <li><a href="{{ route('service.show', 'army-lieutenant-colonel') }}" class="text-decoration-none text-dark hover-text-primary">Lieutenant Colonel (लेफ्टिनेन्ट कर्नल)</a></li>
                                                <li><a href="{{ route('service.show', 'army-colonel') }}" class="text-decoration-none text-dark hover-text-primary">Colonel (कर्नल)</a></li>
                                                <li><a href="{{ route('service.show', 'army-brigadier-general') }}" class="text-decoration-none text-dark hover-text-primary">Brigadier General (ब्रिगेडियर जनरल)</a></li>
                                                <li><a href="{{ route('service.show', 'army-major-general') }}" class="text-decoration-none text-dark hover-text-primary">Major General (मेजर जनरल)</a></li>
                                                <li><a href="{{ route('service.show', 'army-general') }}" class="text-decoration-none text-dark hover-text-primary">General (जनरल / रथी)</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 4. Judicial Service -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour">
                                    <i class="bi bi-bank me-3"></i> 4. Nepal Judicial Service (नेपाल न्याय सेवा)
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#servicesAccordion">
                                <div class="accordion-body p-4 p-md-5">
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <div class="service-category">
                                                <h5>NON-GAZETTED (गैर-राजपत्रांकित)</h5>
                                                <ul class="service-list">
                                                    <li><a href="{{ route('service.show', 'kharidar') }}" class="text-decoration-none text-dark hover-text-primary">Kharidar (खरिदार)</a></li>
                                                    <li><a href="{{ route('service.show', 'nayab-subba') }}" class="text-decoration-none text-dark hover-text-primary">Nayab Subba (नायब सुब्बा)</a></li>
                                                </ul>
                                            </div>
                                            <div class="service-category">
                                                <h5>GAZETTED (राजपत्रांकित)</h5>
                                                <ul class="service-list">
                                                    <li><a href="{{ route('service.show', 'section-officer') }}" class="text-decoration-none text-dark hover-text-primary">Section Officer (शाखा अधिकृत)</a></li>
                                                    <li><a href="{{ route('service.show', 'under-secretary') }}" class="text-decoration-none text-dark hover-text-primary">Under Secretary (उपसचिव)</a></li>
                                                    <li><a href="{{ route('service.show', 'joint-secretary') }}" class="text-decoration-none text-dark hover-text-primary">Joint Secretary (सहसचिव)</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="service-category h-100">
                                                <h5>JUDICIAL OFFICERS (न्यायिक अधिकारी)</h5>
                                                <ul class="service-list">
                                                    <li><a href="{{ route('service.show', 'judge') }}" class="text-decoration-none text-dark hover-text-primary">Judge (न्यायाधीश)</a></li>
                                                    <li><a href="{{ route('service.show', 'district-judge') }}" class="text-decoration-none text-dark hover-text-primary">District Judge (जिल्ला न्यायाधीश)</a></li>
                                                    <li><a href="{{ route('service.show', 'high-court-judge') }}" class="text-decoration-none text-dark hover-text-primary">High Court Judge (उच्च अदालत न्यायाधीश)</a></li>
                                                    <li><a href="{{ route('service.show', 'supreme-court-judge') }}" class="text-decoration-none text-dark hover-text-primary">Supreme Court Judge (सर्वोच्च अदालत न्यायाधीश)</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 5. Foreign Affairs -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive">
                                    <i class="bi bi-globe me-3"></i> 5. Nepal Foreign Affairs Service (नेपाल परराष्ट्र सेवा)
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#servicesAccordion">
                                <div class="accordion-body p-4 p-md-5">
                                    <ul class="service-list">
                                        <li><a href="{{ route('service.show', 'section-officer') }}" class="text-decoration-none text-dark hover-text-primary">Section Officer (शाखा अधिकृत)</a></li>
                                        <li><a href="{{ route('service.show', 'under-secretary') }}" class="text-decoration-none text-dark hover-text-primary">Under Secretary (उपसचिव)</a></li>
                                        <li><a href="{{ route('service.show', 'joint-secretary') }}" class="text-decoration-none text-dark hover-text-primary">Joint Secretary (सहसचिव)</a></li>
                                        <li><a href="{{ route('service.show', 'ambassador') }}" class="text-decoration-none text-dark hover-text-primary">Ambassador (राजदूत)</a></li>
                                        <li><a href="{{ route('service.show', 'foreign-secretary') }}" class="text-decoration-none text-dark hover-text-primary">Foreign Secretary (परराष्ट्र सचिव)</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- 6. Audit -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix">
                                    <i class="bi bi-calculator me-3"></i> 6. Nepal Audit Service (नेपाल लेखापरीक्षण सेवा)
                                </button>
                            </h2>
                            <div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#servicesAccordion">
                                <div class="accordion-body p-4 p-md-5">
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <div class="service-category h-100">
                                                <h5>NON-GAZETTED (गैर-राजपत्रांकित)</h5>
                                                <ul class="service-list">
                                                    <li><a href="{{ route('service.show', 'kharidar') }}" class="text-decoration-none text-dark hover-text-primary">Kharidar (खरिदार)</a></li>
                                                    <li><a href="{{ route('service.show', 'nayab-subba') }}" class="text-decoration-none text-dark hover-text-primary">Nayab Subba (नायब सुब्बा)</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="service-category h-100">
                                                <h5>GAZETTED (राजपत्रांकित)</h5>
                                                <ul class="service-list">
                                                    <li><a href="{{ route('service.show', 'section-officer') }}" class="text-decoration-none text-dark hover-text-primary">Section Officer (शाखा अधिकृत)</a></li>
                                                    <li><a href="{{ route('service.show', 'under-secretary') }}" class="text-decoration-none text-dark hover-text-primary">Under Secretary (उपसचिव)</a></li>
                                                    <li><a href="{{ route('service.show', 'auditor-general') }}" class="text-decoration-none text-dark hover-text-primary">Auditor General (महालेखापरीक्षक)</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 7. Parliamentary -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven">
                                    <i class="bi bi-mic me-3"></i> 7. Nepal Parliamentary Service (नेपाल संसदीय सेवा)
                                </button>
                            </h2>
                            <div id="collapseSeven" class="accordion-collapse collapse" data-bs-parent="#servicesAccordion">
                                <div class="accordion-body p-4 p-md-5">
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <div class="service-category h-100">
                                                <h5>NON-GAZETTED (गैर-राजपत्रांकित)</h5>
                                                <ul class="service-list">
                                                    <li><a href="{{ route('service.show', 'kharidar') }}" class="text-decoration-none text-dark hover-text-primary">Kharidar (खरिदार)</a></li>
                                                    <li><a href="{{ route('service.show', 'nayab-subba') }}" class="text-decoration-none text-dark hover-text-primary">Nayab Subba (नायब सुब्बा)</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="service-category h-100">
                                                <h5>GAZETTED (राजपत्रांकित)</h5>
                                                <ul class="service-list">
                                                    <li><a href="{{ route('service.show', 'section-officer') }}" class="text-decoration-none text-dark hover-text-primary">Section Officer (शाखा अधिकृत)</a></li>
                                                    <li><a href="{{ route('service.show', 'under-secretary') }}" class="text-decoration-none text-dark hover-text-primary">Under Secretary (उपसचिव)</a></li>
                                                    <li><a href="{{ route('service.show', 'secretary-general') }}" class="text-decoration-none text-dark hover-text-primary">Secretary General (महासचिव)</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 8. Technical -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight">
                                    <i class="bi bi-tools me-3"></i> 8. Technical Services (प्राविधिक सेवाहरू)
                                </button>
                            </h2>
                            <div id="collapseEight" class="accordion-collapse collapse" data-bs-parent="#servicesAccordion">
                                <div class="accordion-body p-4 p-md-5">
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <div class="service-category">
                                                <h5>Engineering (इञ्जिनियरिङ सेवा)</h5>
                                                <ul class="service-list">
                                                    <li><a href="{{ route('service.show', 'sub-engineer') }}" class="text-decoration-none text-dark hover-text-primary">Sub Engineer (सब इञ्जिनियर)</a></li>
                                                    <li><a href="{{ route('service.show', 'engineer') }}" class="text-decoration-none text-dark hover-text-primary">Engineer (इञ्जिनियर)</a></li>
                                                    <li><a href="{{ route('service.show', 'senior-engineer') }}" class="text-decoration-none text-dark hover-text-primary">Senior Engineer (वरिष्ठ इञ्जिनियर)</a></li>
                                                </ul>
                                            </div>
                                            <div class="service-category">
                                                <h5>Agriculture (कृषि सेवा)</h5>
                                                <ul class="service-list">
                                                    <li><a href="{{ route('service.show', 'jta') }}" class="text-decoration-none text-dark hover-text-primary">Junior Technical Assistant (कनिष्ठ प्राविधिक सहायक)</a></li>
                                                    <li><a href="{{ route('service.show', 'technical-assistant') }}" class="text-decoration-none text-dark hover-text-primary">Technical Assistant (प्राविधिक सहायक)</a></li>
                                                    <li><a href="{{ route('service.show', 'agriculture-officer') }}" class="text-decoration-none text-dark hover-text-primary">Agriculture Officer (कृषि अधिकृत)</a></li>
                                                </ul>
                                            </div>
                                            <div class="service-category mb-0">
                                                <h5>Forest (वन सेवा)</h5>
                                                <ul class="service-list">
                                                    <li><a href="{{ route('service.show', 'forest-guard') }}" class="text-decoration-none text-dark hover-text-primary">Forest Guard (वन रक्षक)</a></li>
                                                    <li><a href="{{ route('service.show', 'forest-ranger') }}" class="text-decoration-none text-dark hover-text-primary">Forest Ranger (वन रेञ्जर)</a></li>
                                                    <li><a href="{{ route('service.show', 'forest-officer') }}" class="text-decoration-none text-dark hover-text-primary">Forest Officer (वन अधिकृत)</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="service-category">
                                                <h5>Health (स्वास्थ्य सेवा)</h5>
                                                <ul class="service-list">
                                                    <li><a href="{{ route('service.show', 'health-assistant') }}" class="text-decoration-none text-dark hover-text-primary">Health Assistant (स्वास्थ्य सहायक)</a></li>
                                                    <li><a href="{{ route('service.show', 'staff-nurse') }}" class="text-decoration-none text-dark hover-text-primary">Staff Nurse (स्टाफ नर्स)</a></li>
                                                    <li><a href="{{ route('service.show', 'lab-technician') }}" class="text-decoration-none text-dark hover-text-primary">Lab Technician (प्रयोगशाला प्राविधिक)</a></li>
                                                    <li><a href="{{ route('service.show', 'health-officer') }}" class="text-decoration-none text-dark hover-text-primary">Health Officer (स्वास्थ्य अधिकृत)</a></li>
                                                    <li><a href="{{ route('service.show', 'doctor') }}" class="text-decoration-none text-dark hover-text-primary">Doctor/Medical Officer (चिकित्सक)</a></li>
                                                </ul>
                                            </div>
                                            <div class="service-category mb-0">
                                                <h5>Education (शिक्षा सेवा)</h5>
                                                <ul class="service-list">
                                                    <li><a href="{{ route('service.show', 'primary-teacher') }}" class="text-decoration-none text-dark hover-text-primary">Primary Teacher (प्राथमिक शिक्षक)</a></li>
                                                    <li><a href="{{ route('service.show', 'lower-secondary-teacher') }}" class="text-decoration-none text-dark hover-text-primary">Lower Secondary Teacher (निम्न माध्यमिक शिक्षक)</a></li>
                                                    <li><a href="{{ route('service.show', 'secondary-teacher') }}" class="text-decoration-none text-dark hover-text-primary">Secondary Teacher (माध्यमिक शिक्षक)</a></li>
                                                    <li><a href="{{ route('service.show', 'education-officer') }}" class="text-decoration-none text-dark hover-text-primary">Education Officer (शिक्षा अधिकृत)</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 9. Provincial -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine">
                                    <i class="bi bi-map me-3"></i> 9. Provincial Services (प्रदेश सेवाहरू)
                                </button>
                            </h2>
                            <div id="collapseNine" class="accordion-collapse collapse" data-bs-parent="#servicesAccordion">
                                <div class="accordion-body p-4 p-md-5">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <ul class="service-list">
                                                <li><a href="{{ route('service.show', 'province-1') }}" class="text-decoration-none text-dark hover-text-primary">Province No. 1 (कोशी प्रदेश)</a></li>
                                                <li><a href="{{ route('service.show', 'province-2') }}" class="text-decoration-none text-dark hover-text-primary">Province No. 2 (मधेश प्रदेश)</a></li>
                                                <li><a href="{{ route('service.show', 'bagmati-province') }}" class="text-decoration-none text-dark hover-text-primary">Bagmati Province (बागमती प्रदेश)</a></li>
                                                <li><a href="{{ route('service.show', 'gandaki-province') }}" class="text-decoration-none text-dark hover-text-primary">Gandaki Province (गण्डकी प्रदेश)</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6 mt-3 mt-md-0">
                                            <ul class="service-list">
                                                <li><a href="{{ route('service.show', 'lumbini-province') }}" class="text-decoration-none text-dark hover-text-primary">Lumbini Province (लुम्बिनी प्रदेश)</a></li>
                                                <li><a href="{{ route('service.show', 'karnali-province') }}" class="text-decoration-none text-dark hover-text-primary">Karnali Province (कर्णाली प्रदेश)</a></li>
                                                <li><a href="{{ route('service.show', 'sudurpashchim-province') }}" class="text-decoration-none text-dark hover-text-primary">Sudurpashchim Province (सुदूरपश्चिम प्रदेश)</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    
                </div>
            </div>
        </div>
    </section>

@endsection
