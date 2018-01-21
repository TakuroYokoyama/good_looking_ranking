<html>
<head>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
<script>
    function getFilterValue(){
        var str = document.getElementById("dataFilter").value;
        $.ajax({
            type: "POST",
            data: {filter: $("#dataFilter").val()},
            url: "/clients/aggregate",
         })
        //ステータスコードは正常で、dataTypeで定義したようにパース出来たとき
        .done(function (response) {
            alert('成功');
            console.log(response);
        })
        .fail(function (XMLHttpRequest, textStatus, errorThrown) {
            console.log("ajax通信に失敗しました");
            console.log("XMLHttpRequest : " + XMLHttpRequest.status);
            console.log("textStatus     : " + textStatus);
            console.log("errorThrown    : " + errorThrown.message);
        });
    }
</script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>グラフ</title>
</head>
<body>
	<h1>グラフ画面</h1>
        <div>
            <?=$this->Form->input( "dataFilter", 
                                        ["type" => "select",
                                         "options" => ["votedesc"  => "得票数：降順",
                                                       "voteasc"  => "得票数：昇順",
                                                       "voteman"   => "得票数：性別(男)",
                                                       "votewoman" => "得票数：性別(女)"
                                                      ],
                                        "id"    => "dataFilter",
                                        "onChange" => "getFilterValue()",
                                        ])
            ?>
        </div>
        <p><?= $test ?></p>
        <div>
	       <canvas id="myChart" width="100px" height="500px"></canvas>
        </div>
</body>

<script>

$(document).ready(function() {
    $("#dataFilter").on("DOMSubtreeModified propertychange", function() {
        var str = document.getElementById("dataFilter").value;
        alert(str);
    });
});

var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange", "aaa", "aaa", "aaa", "aaa", "aaa", "aaa", "aaa", "aaa", "aaa", "aaa", "aaa", "aaa", "aaa", "ccc"],
        datasets: [{
            data: [12, 10, 3, 5, 15, 3, 7, 7, 7, 7],
            backgroundColor: [
                'rgba(255,  99, 132, 1)',
                'rgba( 54, 162, 235, 1)',
                'rgba(255, 206,  86, 1)',
                'rgba( 75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159,  64, 1)'
            ]
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {                          //凡例設定
            display: false                 //表示設定
        },
        scales: {
            yAxes: [{
                ticks: {                      //最大値最小値設定
                    min: 0,
                    fontSize: 18,             //フォントサイズ
                },
            }],
            xAxes: [{                         //x軸設定
                display: true,                //表示設定
                barPercentage: 0.7,           //棒グラフ幅
                ticks: {
                    stepSize: 5,
                },
            }],
        },
        animation: false
        
    }
});
</script>
</html>