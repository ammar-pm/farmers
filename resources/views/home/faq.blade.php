@extends('layouts.site')
@section('content')

<div class="page-cover faq-cover">
  
  <div class="container">
    
    <div class="cover-content">
      
        <h1> {{ __('common.faq') }} </h1>
        <div class="breadcrumbs">
            <a href="/"> {{ __('common.home') }} </a> / <span> {{ __('common.faq') }} </span>
        </div>
          
    </div>

  </div>

</div>

    <div class="container">

        <div class="page page-box">



            @if(App::getLocale() === 'ar')

                <div id="accordion">
                  <div class="card">
                    <div class="card-header" id="headingOne">
                      <h5 class="mb-0 mt-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          <b>1. كم يبلغ عدد السكان الفلسطينيون في الضفة الغربية و قطاع غزة حسب نتائج تعداد عام 2017 ؟</b>
                        </button>
                      </h5>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                      <div class="card-body">
                        &nbsp;   بلغ عدد السكان الفلسطينيون لعام 2017 كالتالي:</br>
                                        &nbsp; الاراضي الفلسطينية&nbsp; 4.781.248&nbsp; نسمة.</br>
                                        &nbsp;&nbsp; الضفة الغربية &nbsp;2.881.957  نسمة . </br>
                                        &nbsp;  قطاع غزة 1.889.291 &nbsp; نسمة.&nbsp;</br>
                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header" id="headingTwo">
                      <h5 class="mb-0 mt-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                          <b>2. ما هو عدد المنشآت العاملة في الاراضي الفلسطينية حسب تعداد عام 2017 ؟</b>
                        </button>
                      </h5>
                    </div>
                    <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordion">
                      <div class="card-body">
                        بلغ عدد المنشآت العاملة في الاراضي الفلسطينية بناءا على نتائج التعداد لعام 2017  ( 153.922 منشأه)
                      </div>
                    </div>
                  </div>

                  <div class="card">
                    <div class="card-header" id="headingThree">
                      <h5 class="mb-0 mt-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                          <b> 3.ما هو عدد العاملين في فلسطين من واقع بيانات تعداد عام 2017 ؟
                          </b>
                        </button>
                      </h5>
                    </div>
                    <div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-parent="#accordion">
                      <div class="card-body">
                        بلغ عدد العاملين في فلسطين حسب نتائج التعداد لعام 2017 حوالي 881,500 عامل.
                      </div>
                    </div>
                  </div>

                  <div class="card">
                    <div class="card-header" id="heading4">
                      <h5 class="mb-0 mt-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                          <b> 4. ما هو عدد العاطلين عن العمل في فلسطين من واقع بيانات تعداد عام 2017 ؟</b>
                        </button>
                      </h5>
                    </div>
                    <div id="collapse4" class="collapse show" aria-labelledby="heading4" data-parent="#accordion">
                      <div class="card-body">
                        بلغ عدد العاطلين عن العمل في فلسطين حوالي 328,900  عاطل عن العمل حسب نتائج التعداد لعام 2017.
                      </div>
                    </div>
                  </div>

                  <div class="card">
                    <div class="card-header" id="heading5">
                      <h5 class="mb-0 mt-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                          <b>5. هل يمكن توفير نسبة الفقر في الاراضي الفلسطينية ؟</b>
                        </button>
                      </h5>
                    </div>
                    <div id="collapse5" class="collapse show" aria-labelledby="heading5" data-parent="#accordion">
                      <div class="card-body">
                        نسبة الفقر في الاراضي الفلسطينية لعام 2017 هي 2.29%.
                      </div>
                    </div>
                  </div>

                  <div class="card">
                    <div class="card-header" id="heading13">
                      <h5 class="mb-0 mt-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse13" aria-expanded="false" aria-controls="collapse13">
                          <b>6. كم تنفق الاسرة الفلسطينية في الشهر؟</b>
                        </button>
                      </h5>
                    </div>
                    <div id="collapse13" class="collapse show" aria-labelledby="heading13" data-parent="#accordion">
                      <div class="card-body">
                        بلغ متوسط انفاق الاسرة الشهري المكونة من 5.5 فرد 934.9  دينار اردني.
                      </div>
                    </div>
                  </div>

                  <div class="card">
                    <div class="card-header" id="heading6">
                      <h5 class="mb-0 mt-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse6" aria-expanded="false" aria-controls="collapse6">
                          <b>7. يرجى توفير عدد الافراد ذوي الاعاقة في فلسطين من واقع بيانات التعداد لعام 2017.</b>
                        </button>
                      </h5>
                    </div>
                    <div id="collapse6" class="collapse show" aria-labelledby="heading6" data-parent="#accordion">
                      <div class="card-body">
                        عدد الاشخاص الذين يعانون من الاعاقة بمختلف اشكالها لعام 2017 هو 710.  92 اشخاص.
                      </div>
                    </div>
                  </div>

                  <div class="card">
                    <div class="card-header" id="heading7">
                      <h5 class="mb-0 mt-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse7" aria-expanded="false" aria-controls="collapse7">
                          <b>8. ما هي نسبة العاملين في القطاع الخاص الذين يتقاضون اجراً شهريا اقل من الحد الادنى للأجور في فلسطين في 2018؟</b>
                        </button>
                      </h5>
                    </div>
                    <div id="collapse7" class="collapse show" aria-labelledby="heading7" data-parent="#accordion">
                      <div class="card-body">
                        حوالي 33% من المستخدمين بأجر في القطاع الخاص يتقاضون اجرا شهريا اقل من الحد الادنى للأجور في فلسطين و البالغ 1450 شيكل.
                      </div>
                    </div>
                  </div>

                  <div class="card">
                    <div class="card-header" id="heading8">
                      <h5 class="mb-0 mt-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse8" aria-expanded="false" aria-controls="collapse8">
                          <b>9. ما هي نسبة مؤشر غلاء المعيشة في الاراضي الفلسطينية لعام 2018؟</b>
                        </button>
                      </h5>
                    </div>
                    <div id="collapse8" class="collapse show" aria-labelledby="heading8" data-parent="#accordion">
                      <div class="card-body">
                        سجل مؤشر غلاء المعيشة لعام 2018 انخفاضا بمقدار(  0.19%- )مقارنة مع العام السابق.
                      </div>
                    </div>
                  </div>


                  <div class="card">
                    <div class="card-header" id="heading9">
                      <h5 class="mb-0 mt-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse9" aria-expanded="false" aria-controls="collapse9">
                          <b>10. ما هي اعداد الحاصلين على شهادات جامعية من السكان الفلسطينيين لعام 2017 ؟</b>
                        </button>
                      </h5>
                    </div>
                    <div id="collapse9" class="collapse show" aria-labelledby="heading9" data-parent="#accordion">
                      <div class="card-body">
                        بناءا على النتائج النهائية للتعداد لعام 2017 بلغ عدد الحاصلين على شهادات جامعية من السكان الفلسطينيين نحو 684. 656 شخص.
                      </div>
                    </div>
                  </div>

                  <div class="card">
                    <div class="card-header" id="heading10">
                      <h5 class="mb-0 mt-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse10" aria-expanded="false" aria-controls="collapse10">
                          <b> 11. كم يبلغ عدد افراد الاسرة الفلسطينية من واقع بيانات التعداد العام لعام 2017؟</b>
                        </button>
                      </h5>
                    </div>
                    <div id="collapse10" class="collapse show" aria-labelledby="heading10" data-parent="#accordion">
                      <div class="card-body">
                        بلغ متوسط حجم الاسرة الفلسطينية لعام 2017 حسب نتائج التعداد 1   5. فرد لكل اسرة.
                      </div>
                    </div>
                  </div>

                  <div class="card">
                    <div class="card-header" id="heading11">
                      <h5 class="mb-0 mt-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse11" aria-expanded="false" aria-controls="collapse11">
                          <b> 12. ما هي اعداد المساكن الموجودة في فلسطين ؟</b>
                        </button>
                      </h5>
                    </div>
                    <div id="collapse11" class="collapse show" aria-labelledby="heading11" data-parent="#accordion">
                      <div class="card-body">
                        بلغ عدد المساكن في الاراضي الفلسطينية من العام 2017 و بناءا على نتائج التعداد حوالي 848.195. 1مسكن.
                      </div>
                    </div>
                  </div>

                  <div class="card">
                    <div class="card-header" id="heading12">
                      <h5 class="mb-0 mt-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse12" aria-expanded="false" aria-controls="collapse12">
                          <b>13. ما هو عدد المباني في فلسطين بناءً على بيانات التعداد 2017؟</b>
                        </button>
                      </h5>
                    </div>
                    <div id="collapse12" class="collapse show" aria-labelledby="heading12" data-parent="#accordion">
                      <div class="card-body">
                         بلغ عدد المباني في الاراضي الفلسطينية من العام 2017 و بناءا على نتائج التعداد حوالي 609.394
                      </div>
                    </div>
                  </div>

                </div><!-- /accordion -->
                    
            @else

                <div id="accordion">
                  <div class="card">
                    <div class="card-header" id="headingOne">
                      <h5 class="mb-0 mt-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          <b>1. How many Palestinian Population in the West Bank and Gaza Strip according to the 2017 census results?</b>
                        </button>
                      </h5>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                      <div class="card-body">
                        The 2017 Palestinian population is as follows:</br>
                        <ul>
                            <li> Palestine: 4.781,248 inhabitants.</li>
                            <li> West Bank: 2. 881,957 inhabitants.</li>
                            <li> Gaza Strip: 1.899, 291 inhabitants.</li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header" id="headingTwo">
                      <h5 class="mb-0 mt-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                          <b>2. What is the number of establishments operating in Palestine according to the 2017 census?</b>
                        </button>
                      </h5>
                    </div>
                    <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordion">
                      <div class="card-body">
                        The number of establishments operating in Palestine , based on the results of the census for 2017, is 153.922 establishments.
                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-header" id="headingThree">
                      <h5 class="mb-0 mt-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                          <b>3. What are the numbers of workers in Palestine according to the 2017 census data?</b>
                        </button>
                      </h5>
                    </div>
                    <div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-parent="#accordion">
                      <div class="card-body">
                        The number of workers in Palestine according to the results of the census for 2017 is 881,500 workers..
                      </div>
                    </div>
                  </div>

                  <div class="card">
                    <div class="card-header" id="heading4">
                      <h5 class="mb-0 mt-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                          <b>4. What is the number of unemployed in Palestine from the 2017 census data?</b>
                        </button>
                      </h5>
                    </div>
                    <div id="collapse4" class="collapse show" aria-labelledby="heading4" data-parent="#accordion">
                      <div class="card-body">
                        The number of unemployed in Palestine according to the 2017 census results is about          328.900 unemployed.
                      </div>
                    </div>
                  </div>

                  <div class="card">
                    <div class="card-header" id="heading5">
                      <h5 class="mb-0 mt-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                          <b>5. Is it possible to provide the poverty rate in Palestine?</b>
                        </button>
                      </h5>
                    </div>
                    <div id="collapse5" class="collapse show" aria-labelledby="heading5" data-parent="#accordion">
                      <div class="card-body">
                        The poverty rate in Palestine , in 2017, is 29.2%.
                      </div>
                    </div>
                  </div>

                  <div class="card">
                    <div class="card-header" id="heading6">
                      <h5 class="mb-0 mt-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse6" aria-expanded="false" aria-controls="collapse6">
                          <b>6. How much do the Palestinian family spend per month?</b>
                        </button>
                      </h5>
                    </div>
                    <div id="collapse6" class="collapse show" aria-labelledby="heading6" data-parent="#accordion">
                      <div class="card-body">
                        Average monthly household expenditure of 5.5 individuals. 934.9 JD.
                      </div>
                    </div>
                  </div>

                  <div class="card">
                    <div class="card-header" id="heading7">
                      <h5 class="mb-0 mt-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse7" aria-expanded="false" aria-controls="collapse7">
                          <b>7. Please provide the number of persons with disabilities in Palestine from the 2017 census data?</b>
                        </button>
                      </h5>
                    </div>
                    <div id="collapse7" class="collapse show" aria-labelledby="heading7" data-parent="#accordion">
                      <div class="card-body">
                        The number of people with disabilities in various forms for 2017 is 92.710..
                      </div>
                    </div>
                  </div>

                  <div class="card">
                    <div class="card-header" id="heading8">
                      <h5 class="mb-0 mt-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse8" aria-expanded="false" aria-controls="collapse8">
                          <b>8. What is the percentage of employees in the private sector , who received less than the minimum monthly wage in Palestine?</b>
                        </button>
                      </h5>
                    </div>
                    <div id="collapse8" class="collapse show" aria-labelledby="heading8" data-parent="#accordion">
                      <div class="card-body">
                        About 33% of wage employees in the private sector received less than the minimum  monthly wage ( 1450 NIS ) in Palestine in 2018.
                      </div>
                    </div>
                  </div>

                  <div class="card">
                    <div class="card-header" id="heading9">
                      <h5 class="mb-0 mt-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse9" aria-expanded="false" aria-controls="collapse9">
                          <b>9. What is the ratio of the cost of living index in Palestine for 2018?</b>
                        </button>
                      </h5>
                    </div>
                    <div id="collapse9" class="collapse show" aria-labelledby="heading9" data-parent="#accordion">
                      <div class="card-body">
                        The cost of living index for 2018 is decreased by (-0.19%) compared to the previous year.
                      </div>
                    </div>
                  </div>

                  <div class="card">
                    <div class="card-header" id="heading10">
                      <h5 class="mb-0 mt-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse10" aria-expanded="false" aria-controls="collapse10">
                          <b>10. What are the numbers of university graduates of the Palestinian population for 2017?</b>
                        </button>
                      </h5>
                    </div>
                    <div id="collapse10" class="collapse show" aria-labelledby="heading10" data-parent="#accordion">
                      <div class="card-body">
                        Based on the final results of the 2017 census, the number of students with university degrees in Palestine is 656.684.
                      </div>
                    </div>
                  </div>


                  <div class="card">
                    <div class="card-header" id="heading11">
                      <h5 class="mb-0 mt-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse11" aria-expanded="false" aria-controls="collapse11">
                          <b> 11. What is the household size based on the data of the Census 2017?</b>
                        </button>
                      </h5>
                    </div>
                    <div id="collapse11" class="collapse show" aria-labelledby="heading11" data-parent="#accordion">
                      <div class="card-body">
                        The average size of the Palestinian family for the year 2017 according to census results is 5.1 Individual per family.
                      </div>
                    </div>
                  </div>

                  <div class="card">
                    <div class="card-header" id="heading12">
                      <h5 class="mb-0 mt-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse12" aria-expanded="false" aria-controls="collapse12">
                          <b>12. What is the number of dwellings in Palestine?</b>
                        </button>
                      </h5>
                    </div>
                    <div id="collapse12" class="collapse show" aria-labelledby="heading12" data-parent="#accordion">
                      <div class="card-body">
                        The number of dwellings in Palestine in 2017 and based on the census results is about 1.195.848 dwelling.
                      </div>
                    </div>
                  </div>

                  <div class="card">
                    <div class="card-header" id="heading13">
                      <h5 class="mb-0 mt-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse13" aria-expanded="false" aria-controls="collapse13">
                          <b>13. What is the  number of buildings in Palestine based on the data of the census 2017?</b>
                        </button>
                      </h5>
                    </div>
                    <div id="collapse13" class="collapse show" aria-labelledby="heading13" data-parent="#accordion">
                      <div class="card-body">
                        The number of buildings in Palestine , based on the data of the census 2017,  is about 609.394 buildings.
                      </div>
                    </div>
                  </div>

                  
                  

                </div><!-- /accordion -->


            @endif
        </div>

    </div>

@endsection
