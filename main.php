
<body id='page'>
<select id="brand_category" name="brand_category">
  <option value="None">SELECT</option>
    <option value="HRW">HRW</option>
  <option value="VMS">VMS</option>
  <option value="IFCN">IFCN</option>
</select>

<table id="people" border="1" >
  <thead>
    <th>ASIN</th>
    <th>BRAND</th>
    <th>BRAND_CATEGORY</th>
  </thead>
  <tbody>

  </tbody>
</table>
</body>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script>
$( window ).load(function(){
$.ajax({
    type: "GET",
    // data: {
    //   "brand_category":'None'
    // },
    url: "response.php?brand_category=None",
    dataType: "json",
    success: function(JSONObject) {
      var peopleHTML = "";
      // alert('Ilove ypou');
      // Loop through Object and create peopleHTML
      for (var key in JSONObject) {
        if (JSONObject.hasOwnProperty(key)) {
          peopleHTML += "<tr>";
            peopleHTML += "<td>" + JSONObject[key]["asin"] + "</td>";
            peopleHTML += "<td>" + JSONObject[key]["brand"] + "</td>";
            peopleHTML += "<td>" + JSONObject[key]["brand_category"] + "</td>";
          peopleHTML += "</tr>";
        }
      }

      // Replace table’s tbody html with peopleHTML
      $("#people tbody").html(peopleHTML);
    }
  });
});





  var brand_category  =  $("#test").val();
$("#brand_category").on("change", function() {
  $.ajax({
    type: "GET",
    data: {
      "brand_category": $("#brand_category").val()
    },
    url: "response.php",
    dataType: "json",
    success: function(JSONObject) {
      var peopleHTML = "";
      // alert('Ilove ypou');
      // Loop through Object and create peopleHTML
      for (var key in JSONObject) {
        if (JSONObject.hasOwnProperty(key)) {
          peopleHTML += "<tr>";
            peopleHTML += "<td>" + JSONObject[key]["asin"] + "</td>";
            peopleHTML += "<td>" + JSONObject[key]["brand"] + "</td>";
            peopleHTML += "<td>" + JSONObject[key]["brand_category"] + "</td>";
          peopleHTML += "</tr>";
        }
      }

      // Replace table’s tbody html with peopleHTML
      $("#people tbody").html(peopleHTML);
    }
  });
});




</script>
