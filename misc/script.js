const fs = require('fs')
const mysql = require('mysql');

fs.readFile('city.json', 'utf8' , (err, data) => {
  if (err) {
    console.error(err)
    return
  }
  
  
  var con = mysql.createConnection({
    host: "localhost",
    user: "",
    password: "",
    database: ""
  });




  con.connect(function(err) {
    if (err) throw err;
    console.log("Connected!");
    data = JSON.parse(data)
    let cities = data.rajaongkir.results
    for (let i = 0; i < cities.length; i++) {
      let cityName = cities[i].city_name
      let type = cities[i].type
      let fullName = ''
      if (type == "Kabupaten"){
          type = "kab."
      } else {
          type = "kota"
      }
  
      fullName = type + " " + cityName.toLowerCase()
      var sql = `Update wilayah_2020 set kode_ongkir = ${cities[i].city_id} where nama like '%${fullName}%'`
      con.query(sql, function (err, result) {
        if (err) throw err;
        console.log("1 record inserted");
      });
    }
  
  });

})
