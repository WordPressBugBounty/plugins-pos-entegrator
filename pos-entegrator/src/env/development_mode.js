var { glob } = require("glob");
var fs = require("fs");

const development = async () => {
  const files = await glob("gurmepos.php");
  files.forEach(function (item) {
    var data = fs.readFileSync(item, "utf8");
    var mapObj = {
      GPOS_PRODUCTION: "GPOS_DEVELOPMENT",
    };
    var result = data.replace(/GPOS_PRODUCTION/gi, function (matched) {
      return mapObj[matched];
    });
    fs.writeFile(item, result, "utf8", function (err) {
      if (err) return console.log(err);
    });
    console.log("✅  Plugin is building for production...");
  });
};

development();
