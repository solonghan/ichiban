function getChartColorsArray(e){if(console.log(e),null!==document.getElementById(e)){var e=document.getElementById(e).getAttribute("data-colors");return(e=JSON.parse(e)).map(function(e){var r=e.replace(" ","");if(-1===r.indexOf(",")){var t=getComputedStyle(document.documentElement).getPropertyValue(r);return t||r}e=e.split(",");return 2!=e.length?r:"rgba("+getComputedStyle(document.documentElement).getPropertyValue(e[0])+","+e[1]+")"})}}var sellerlinecolor1=getChartColorsArray("chart-seller1"),sparklineoptions1={series:[{data:[12,14,2,47,42,15,47,75,65,19,14]}],chart:{type:"area",height:50,sparkline:{enabled:!0}},fill:{type:"gradient",gradient:{shadeIntensity:1,inverseColors:!1,opacityFrom:.45,opacityTo:.05,stops:[20,100,100,100]}},stroke:{curve:"smooth",width:2},colors:sellerlinecolor1,tooltip:{fixed:{enabled:!1},x:{show:!1},y:{title:{formatter:function(e){return""}}},marker:{show:!1}}},sparklinechart1=new ApexCharts(document.querySelector("#chart-seller1"),sparklineoptions1);sparklinechart1.render();var sellerlinecolor2=getChartColorsArray("chart-seller2"),sparklineoptions1={series:[{data:[12,14,2,47,42,15,35,75,20,67,89]}],chart:{type:"area",height:50,sparkline:{enabled:!0}},fill:{type:"gradient",gradient:{shadeIntensity:1,inverseColors:!1,opacityFrom:.45,opacityTo:.05,stops:[20,100,100,100]}},stroke:{curve:"smooth",width:2},colors:sellerlinecolor2,tooltip:{fixed:{enabled:!1},x:{show:!1},y:{title:{formatter:function(e){return""}}},marker:{show:!1}}},sparklinechart2=new ApexCharts(document.querySelector("#chart-seller2"),sparklineoptions1);sparklinechart2.render();var sellerlinecolor3=getChartColorsArray("chart-seller3"),sparklineoptions1={series:[{data:[45,20,8,42,30,5,35,79,22,54,64]}],chart:{type:"area",height:50,sparkline:{enabled:!0}},fill:{type:"gradient",gradient:{shadeIntensity:1,inverseColors:!1,opacityFrom:.45,opacityTo:.05,stops:[20,100,100,100]}},stroke:{curve:"smooth",width:2},colors:sellerlinecolor3,tooltip:{fixed:{enabled:!1},x:{show:!1},y:{title:{formatter:function(e){return""}}},marker:{show:!1}}};(sparklinechart2=new ApexCharts(document.querySelector("#chart-seller3"),sparklineoptions1)).render();var sellerlinecolor4=getChartColorsArray("chart-seller4"),sparklineoptions1={series:[{data:[26,15,48,12,47,19,35,19,85,68,50]}],chart:{type:"area",height:50,sparkline:{enabled:!0}},fill:{type:"gradient",gradient:{shadeIntensity:1,inverseColors:!1,opacityFrom:.45,opacityTo:.05,stops:[20,100,100,100]}},stroke:{curve:"smooth",width:2},colors:sellerlinecolor4,tooltip:{fixed:{enabled:!1},x:{show:!1},y:{title:{formatter:function(e){return""}}},marker:{show:!1}}};(sparklinechart2=new ApexCharts(document.querySelector("#chart-seller4"),sparklineoptions1)).render();var sellerlinecolor5=getChartColorsArray("chart-seller5"),sparklineoptions1={series:[{data:[60,67,12,49,6,78,63,51,33,8,16]}],chart:{type:"area",height:50,sparkline:{enabled:!0}},fill:{type:"gradient",gradient:{shadeIntensity:1,inverseColors:!1,opacityFrom:.45,opacityTo:.05,stops:[20,100,100,100]}},stroke:{curve:"smooth",width:2},colors:sellerlinecolor5,tooltip:{fixed:{enabled:!1},x:{show:!1},y:{title:{formatter:function(e){return""}}},marker:{show:!1}}};(sparklinechart2=new ApexCharts(document.querySelector("#chart-seller5"),sparklineoptions1)).render();var sellerlinecolor6=getChartColorsArray("chart-seller6"),sparklineoptions1={series:[{data:[78,63,51,33,8,16,60,67,12,49]}],chart:{type:"area",height:50,sparkline:{enabled:!0}},fill:{type:"gradient",gradient:{shadeIntensity:1,inverseColors:!1,opacityFrom:.45,opacityTo:.05,stops:[20,100,100,100]}},stroke:{curve:"smooth",width:2},colors:sellerlinecolor6,tooltip:{fixed:{enabled:!1},x:{show:!1},y:{title:{formatter:function(e){return""}}},marker:{show:!1}}};(sparklinechart2=new ApexCharts(document.querySelector("#chart-seller6"),sparklineoptions1)).render();var sellerlinecolor7=getChartColorsArray("chart-seller7"),sparklineoptions1={series:[{data:[15,35,75,20,67,8,42,30,5,35]}],chart:{type:"area",height:50,sparkline:{enabled:!0}},fill:{type:"gradient",gradient:{shadeIntensity:1,inverseColors:!1,opacityFrom:.45,opacityTo:.05,stops:[20,100,100,100]}},stroke:{curve:"smooth",width:2},colors:sellerlinecolor7,tooltip:{fixed:{enabled:!1},x:{show:!1},y:{title:{formatter:function(e){return""}}},marker:{show:!1}}};(sparklinechart2=new ApexCharts(document.querySelector("#chart-seller7"),sparklineoptions1)).render();var sellerlinecolor8=getChartColorsArray("chart-seller8"),sparklineoptions1={series:[{data:[45,32,68,55,36,10,48,25,74,54]}],chart:{type:"area",height:50,sparkline:{enabled:!0}},fill:{type:"gradient",gradient:{shadeIntensity:1,inverseColors:!1,opacityFrom:.45,opacityTo:.05,stops:[20,100,100,100]}},stroke:{curve:"smooth",width:2},colors:sellerlinecolor8,tooltip:{fixed:{enabled:!1},x:{show:!1},y:{title:{formatter:function(e){return""}}},marker:{show:!1}}};(sparklinechart2=new ApexCharts(document.querySelector("#chart-seller8"),sparklineoptions1)).render();