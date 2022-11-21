<script>

var substringMatcher = function(strs) {
  return function findMatches(q, cb) {
    var matches, substringRegex;

    // 
    matches = [];

    // regex used to determine if a string contains the substring `q`
    substrRegex = new RegExp(q, 'i');

    // iterate through the pool of strings and for any string that
    // contains the substring `q`, add it to the `matches` array
    $.each(strs, function(i, str) {
      if (substrRegex.test(str)) {
        matches.push(str);
      }
    });

    cb(matches);
  };
};


<?php 
  //Traigo los datos desde base de datos
  $consultaComun->jsonProductos();
  //Traigo los datos del provedor desde base de datos
  $consultaComun->jsonProvedores();

  $consultaComun->jsonClientes();
?>




// ---------- Bloodhound ----------

// constructs the suggestion engine
var productos = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.whitespace,
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  // `states` is an array of state names defined in "The Basics"
  local: productos
});

$('#listaProductos .typeahead').typeahead({
  hint: true,
  highlight: true,
  minLength: 1
},
{
  name: 'productos',
  source: productos
});






$('#typeaheadProvedores .typeahead').typeahead({
  hint: true,
  highlight: true,
  minLength: 1
},
{
  name: 'provedores',
  source: substringMatcher(provedores)
});



$('#typeaheadClientes .typeahead').typeahead({
  hint: true,
  highlight: true,
  minLength: 1
},
{
  name: 'clientes',
  source: substringMatcher(clientes)
});







</script>
