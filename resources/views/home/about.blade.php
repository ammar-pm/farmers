@extends('layouts.site')
@section('content')

<div class="page-cover about-cover">
  
  <div class="container">
    
    <div class="cover-content">
      
        <h1> {{ __('common.about') }} </h1>
        <div class="breadcrumbs">
            <a href="/"> {{ __('common.home') }} </a> / <span> {{ __('common.about') }} </span>
        </div>
          
    </div>

  </div>

</div>



    <div class="container">

        <div class="page page-box text-center">
            <img src="/img/logo-only.png" title="PCBS" alt="PCBS">
            @if(App::getLocale() === 'ar')
                <div>
                    <h5> الجهاز المركزي للإحصاء الفلسطيني (PCBS)</h5>
                    <p class="text-center">يعتبر الجهاز المركزي للإحصاء الفلسطيني المرجع الوحيد للرقم الإحصائي الرسمي الفلسطيني وفقا لقانون الإحصاءات العامة رقم (4) لسنة 2000، ومهمتنا الاساسية توفير الاحصاءات في مجالات كثيرة مثل السكان والتعليم والصحة والبطالة والفقر والاقتصاد والبيئة والمياه وغيرها؛ لتلبية احتياجات المستخدمين، مؤسسات كانوا أم أفرادا بمختلف الاعمار، وتماشيا مع المعايير العالمية والممارسات الجيدة والتوجهات لنشر البيانات بطرق تفاعلية واستخدام تقنيات متطورة لنشر البيانات باستخدام التصورات المرئية لتلبية احتياجات المستخدمين وسهولة الوصول واستخدام البيانات، يسعدنا ان نعلن عن اطلاق الموقع الالكتروني "المؤشرات الاحصائية" والذي سيوفر بيانات احصائية رسمية وحديثة وشاملة حول مواضيع مختلفة مع التركيز على مؤشرات التعداد العام للسكان والمساكن والمنشات  2017 حيث ان موقع مؤشرات يتيح للمستخدم عرض البيانات باستخدام التصورات المرئية الـــData Visualization وإمكانية البحث والفلترة الديناميكية للمؤشرات حسب الموضوع والموضوع الفرعي، المحافظة، السنة، الفئات العمرية وغيرها، وكذلك اتاحة خاصية عمل تنزيل او تصدير للبيانات بصيغ مختلفة. وسنقوم باغناء موقع مؤشرات بشكل دوري لضمان حداثة البيانات ووجود بيانات ومؤشرات ضمن سلاسل زمنية لإتاحة خاصية المقارنة من قبل المستخدم. </p>
                </div>
            @else
                <div>
                    <h5> The Palestinian Central Bureau of Statistics (PCBS)</h5>
                    <p class="text-center">
                    Indicators is an initiative of the Palestinian Central Bureau of Statistics (PCBS), the institution officially mandated to produce national statistics. PCBS’s mission is to provide data encompassing all aspects of Palestinian life, and Indicators in particular highlights the results of the 2017 Population, Housing, and Establishments Census.

                    PCBS strives to meet all users' needs, whether institutions or individuals, in accordance with international statistical best practices. Indicators aligns with efforts to expand interactive, technology-driven data dissemination and visualization while advancing data accessibility. PCBS will regularly update Indicators to ensure data accuracy for reliable visualizations and analysis.
                    </p>
                </div>
            @endif
        </div>

    </div>

@endsection
