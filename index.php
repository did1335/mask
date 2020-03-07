<style>
*{font-family:"Helvetica", "微軟正黑體", "Microsoft JhengHei";}
tr:nth-child(even) {background: #CCC}
tr:nth-child(odd) {background: #FFF}
#mask_table{margin-left:auto; margin-right:auto;}
</style>
<h1 style='text-align:center;'>台中市北屯區口罩剩餘數量</h1>
<p style='text-align:center;'>朱庭宏</p>
<p id='num' style='text-align:center;'></p>
<p id='sum' style='text-align:center;'></p>
<p id='update' style='text-align:center;'></p>
<table id='mask_table'>
<tr>
   <th>醫事機構名稱</th>
   <th>醫事機構地址</th>
   <th>成人口罩剩餘數</th>
</tr>
</table>
<script src="https://d3js.org/d3.v5.min.js"></script>
<script>
var i=0;
const cors = "https://cors-anywhere.herokuapp.com/";
const url = "https://data.nhi.gov.tw/Datasets/Download.ashx?rid=A21030000I-D50001-001&l=https://data.nhi.gov.tw/resource/mask/maskdata.csv";

d3.csv(`${cors}${url}`, function(data) {
    //console.log(data);
    var pharmacy = data["醫事機構名稱"];
    var address = data["醫事機構地址"];
    var adult = data["成人口罩剩餘數"];
    var update = data["來源資料時間"];
    
    var region = address.indexOf("臺中市北屯區");
    if (region>-1){
      var tr = document.createElement("tr");
      var td1 = document.createElement("td");
      td1.innerHTML = pharmacy;
      var td2 = document.createElement("td");
      td2.innerHTML = address;
      var td3 = document.createElement("td");
      td3.innerHTML = adult;

      tr.appendChild(td1);
      tr.appendChild(td2);
      tr.appendChild(td3);

      document.getElementById('mask_table').appendChild(tr);
      i ++;
    }
    document.getElementById('num').innerText = "共" + i + "間";
    count(i);
    document.getElementById('update').innerText = "資料更新時間" + update;
});
clearvar();


function count(i){
    var sum = 0;
    for (let r=1; r<=i; r++){
        sum = sum+Number(document.getElementById('mask_table').rows[r].cells[2].innerText);
    }
    document.getElementById('sum').innerText = "共計" + sum + "個成人口罩";
}

function clearvar(){
    i = null;
}
</script>